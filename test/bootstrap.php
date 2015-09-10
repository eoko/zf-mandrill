<?php

namespace Eoko\Mandrill\Test;

use SlmQueue\Job\JobPluginManager;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Renderer\PhpRenderer;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

/**
 * Test bootstrap, for setting up autoloading
 */
class Bootstrap
{
    protected static $serviceManager;
    protected static $jobServiceManager;

    public static function init()
    {
        $zf2ModulePaths = [dirname(dirname(__DIR__))];
        if (($path = static::findParentPath('vendor'))) {
            $zf2ModulePaths[] = $path;
        }
        if (($path = static::findParentPath('module')) !== $zf2ModulePaths[0]) {
            $zf2ModulePaths[] = $path;
        }

        static::initAutoloader();

        $cfg = include __DIR__ . '/../config/module.config.php';
        $cfg['service_manager']['invokables']['Zend\View\Renderer\PhpRenderer'] = PhpRenderer::class;
        $cfg['eoko'] = [
            'mandrill' => [
                'apiKey' => 'you_api_key',
                'default' => [
                    // Leave blank if no subaccount
                    'subaccount' => 'my_subaccount',

                    // Leave blank if no default from email
                    'from_email' => 'jane@doe.com',

                    // Leave blank if no from name
                    'from_name' => 'Jane Doe',
                ],

                // Boolean, true if you want to send async email
                'async' => false,

                // String, your Mandrill ip pool
                'ip_pool' => null,

                // Date, scheduled email
                'send_at' => null,
            ],
        ];

        $serviceManager = new ServiceManager(new Config($cfg['service_manager']));

        $serviceManager->setService('Configuration', $cfg);
        $serviceManager->setAlias('Config', 'Configuration');

        static::$serviceManager = $serviceManager;

        $jobServiceManager = new JobPluginManager(new Config($cfg['slm_queue']['job_manager']));
        $jobServiceManager->setServiceLocator(static::$serviceManager);
        static::$jobServiceManager = $jobServiceManager;
    }

    /**
     * @return ServiceManager
     */
    public static function getServiceManager()
    {
        return static::$serviceManager;
    }

    public static function getJobServiceManager()
    {
        return static::$jobServiceManager;
    }

    protected static function initAutoloader()
    {
        $vendorPath = static::findParentPath('vendor');

        if (file_exists($vendorPath . '/autoload.php')) {
            include $vendorPath . '/autoload.php';
        }
    }

    protected static function findParentPath($path)
    {
        $dir = __DIR__;
        $previousDir = '.';
        while (!is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) {
                return false;
            }
            $previousDir = $dir;
        }
        return $dir . '/' . $path;
    }
}

Bootstrap::init();

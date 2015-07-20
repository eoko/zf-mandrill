# zf-mandrill

[![Build Status](https://travis-ci.org/eoko/zf-mandrill.svg?branch=master)](https://travis-ci.org/eoko/zf-mandrill)
[![Coverage Status](https://coveralls.io/repos/eoko/zf-mandrill/badge.svg)](https://coveralls.io/r/eoko/zf-mandrill)
[![Coverage Status](https://coveralls.io/repos/eoko/zf-mandrill/badge.svg)](https://coveralls.io/r/eoko/zf-mandrill)
[![Build Status](https://codeship.com/projects/c50bf920-10dc-0133-e383-5a9b1173a114/status?branch=master)](https://codeship.com/projects/92092)


## Introduction

zf-mandrill is a simple wrapper for the Mandrill API. It permit to use the Mandrill API using a pre-configure client in 
a Zend Framework context.

With this module, you can :

- pre-configure Mandrill client
- check your configuration using zend-diagnostic
- send email from CLI (for testing purpose)
- send email directly from controller
- use email service to send email

## Installation

zf-mandrill works with [Composer](http://getcomposer.org). Make sure you have the composer.phar downloaded and you have a
`composer.json` file at the root of your project. To install it, you can do it from CLI `composer require eoko/zf-mandrill` or add the following line into your `composer.json` file:

```json
"require": {
    "eoko/zf-mandrill": "dev-master"
}
```

## Configuration

Copy/Paste in your local configuration `config/mandrill.local.php.dist` and rename it to `mandrill.local.php`. 
There are all the informations required for zf-mandrill configuration.

## Service Available

The following services are pre-configured in the service locator :

- Mandrill client : `eoko.mandrill.client`
- Email service : `eoko.mandrill.service.email`

## Command

- Check your configuration : `php public/index.php diag`
- Send an email :  `php public/index.php mandrill send email jane@doe.com subject htmlContent_or_filename`
 
## Controller plugin

Inside a controller, we can use the email plugin : `$this->email()->setSubject('hello')->setTo('jane@doe.com')->send()`

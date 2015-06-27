# zf-mandrill

[![Build Status](https://travis-ci.org/eoko/zf-mandrill.svg?branch=master)](https://travis-ci.org/eoko/zf-mandrill)
[![Coverage Status](https://coveralls.io/repos/eoko/zf-mandrill/badge.svg)](https://coveralls.io/r/eoko/zf-mandrill)

## Introduction

zf-mandrill is a simple wrapper for the Mandrill API. It permit to use the Mandrill API using a pre-configure client in a zend-framework context.

With this module, you can :

- pre-configure Mandrill
- check your configuration using zend-diagnostic
- send email from CLI (test purpose)
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

Copy/Paster in your local configuration `config/mandrill.local.php.dist` and rename it to `mandrill.local.php`. You can see in all informations needs for configuration.

## Service Available

The following service are pre-configure :

- Mandrill Client : `eoko.mandrill.client`
- Email Service : `eoko.mandrill.service.email`

## Command

- Check your configuration : `php public/index.php diag`
- Send an email :  `php public/index.php mandrill send email jane@doe.com subject htmlContent_or_filename`
 
## Controller plugin

Inside a controller, we can use the email plugin : `$this->email()->setSubject('hello')->setTo('jane@doe.com')->send()`

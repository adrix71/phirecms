Welcome to Phire CMS
====================

RELEASE INFORMATION
-------------------
Phire CMS 2 is here!  

Version 2.0.2  
July 2, 2016

OVERVIEW
--------
Phire CMS is a simple and robust content management system that is built
on the [Pop PHP Framework](http://www.popphp.org/). By itself, it provides
very basic features and functionality for user and user role management,
as well as module installation and management. The module functionality is
where the strength of Phire lies. With it, you can install any of the
pre-written modules, or write ones of your own and easily extend the
functionality of Phire.

REQUIREMENTS
------------
The basic requirements for Phire CMS 2 are as follows:

* PHP 5.4.0+
* Apache 2+, IIS 7+, or any web server with URL rewrite support
* Supported Databases:
    - MySQL 5.0+
    - PostgreSQL 9.0+
    - SQLite 3+

INSTALL
-------
To install Phire from this repo, you can simply clone it or install
it via composer:

```console
$ composer create-project phirecms/phirecms
```

Once it's one your system, make sure the
`/phire-content` folder and everything below it is writable, and then
hit the domain:

```
http://www.yourdomain.com/phirecms/
```

Of course, you can move all of the files and folders in `/phirecms/` to
whatever folder you need to, or just move them up to the document root, so you
can just go to:

```
http://www.yourdomain.com/
```

Once you go to your domain, you'll be redirected to the install screen,
which will take you through 3 easy steps:

1. Input the initial database and configuration settings
2. Copy and save the configuration to the `config.php` file (The step may be skipped if the `config.php` file is writable)
3. Set up the initial user

### Standalone Version

You can download a standalone version of the CMS that comes packaged
with 6 basic modules to give you some common CMS features right
out of the gate. Head over to the [main Phire website](http://www.phirecms.org/) to download a copy of it.
The 6 modules included in the standalone version are:

* phire-content
* phire-media
* phire-templates
* phire-navigation
* phire-categories
* phire-fields

THAT'S IT!
----------
You can then login it at:

```
http://www.yourdomain.com/phire
```

Or whatever you set the application URI to.

MODULES
-------
Modules are available and in the works at [https://github.com/phirecms](https://github.com/phirecms).
If you choose to download and install any of those modules, then you need to copy
the module ZIP file under the modules folder `/phire-content/modules`. When you do
that, and then visit the Modules screen in Phire, you'll see a button alerting you
that there are new modules available to be installed.

STAY TUNED FOR MORE!
--------------------
The a new website and documentation will be coming soon!

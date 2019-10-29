---
title: LinkAce Setup
layout: default
---

LinkAce itself does not require a high-performance server to run at. Indeed there is just this PHP app that needs access
to a database. However, your environment must fulfill the following requirements to run properly.

There will be **no** support for environments which do not meet the requirements!

## Requirements for Docker

* Shell access to your server
* Docker version 19 or greater
* docker-compose is recommended for the setup, must support compose version 2

## Requirements for setup without Docker

* Shell access to your server
* **PHP 7.2 or 7.3**, with the following extenstions
    * OpenSSL
    * PDO
    * Mbstring
    * Tokenizer
    * XML
    * Ctype
    * JSON
* Composer must be installed
* A database server with one of the following databases running:
    * MySQL 5.6+ (recommended)
    * PostgreSQL 9.4+
    * SQLite 3.8.8+ (not tested, may work)
    * SQL Server 2017+ (not tested, may work)

Older PHP versions will not be supported in any way. Please do yourself a favor and do not expose yourself or your users
to any risks by using an outdated PHP version.

## Continue with the setup

If you are confident that your environment meets the requirements, continue with the setup:

* [Setup with Docker](/docs/v1/setup/setup)
* [Setup without Docker](/docs/v1/setup/setup-without-docker)

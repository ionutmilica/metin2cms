Metin2CMS
=========
[![Build Status](https://travis-ci.org/ionutmilica/metin2cms.svg)](https://travis-ci.org/ionutmilica/metin2cms)

Metin2CMS it's a full-stack site with admin panel and apis for anyone who wants to start a server without bothering with the website. It's designed to be complex and flexible.

Technologies used:
  - PHP 5.4+ with Laravel 5,
  - Mysql 5.*
  - Bootstrap (HTML, CSS)

Installation
--------------

```sh
git clone https://github.com/ionutxp/metin2cms metin2cms
cd metin2cms
composer update
php artisan migrate
php db:seed
```
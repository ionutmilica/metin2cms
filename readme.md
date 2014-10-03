Metin2CMS
=========

Metin2CMS it's a full-stack site with admin panel and apis for anyone who wants to start a server without bothering with the webpage. It's designed to be complex and flexible.
The code it is splitted it 3 main modules:
Core - Here we have the main functionality that contains validators, repositories, entities
Api - Provides the REST API that allow front-end devs to make simple call with javascript and build a nice Single Page App with AngularJS/Backbone.
Site - Provides controllers and theme support for classic pages.

Technologies used:
  - PHP 5.3+ with Laravel 4.1, 
  - Mysql 5.* 
  - Bootstrap (HTML, CSS)

DEV - Github Workflow:
---
We'll keep committing to the master branch until the first stable release. After that we'll make a second branch named "develop" and all commits will go here. In this phase it's important to make unbreakable changes because of the user-made modules. All changes will be merged in master then we'll release an update.
Note: Use additional branches to work on a new feature and then merge it to the develop for more testing.

Version
----

1.0.0 on the first stable release


Installation
--------------

```sh
git clone https://github.com/ionutxp/metin2cms metin2cms
cd metin2cms
composer update
Set the env in httacces if needed an create a .env.local.php or .env.production.php with database info
php artisan migrate
php db:seed
```

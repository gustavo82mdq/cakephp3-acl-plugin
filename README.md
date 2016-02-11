ACL Plugin for CakePHP 3.X
==========================

This plugin includes
[Bootstrap](https://github.com/elboletaire/twbs-cake-plugin#bootstrap-plugin-for-cakephp-3.X) for Bootstrap theme.

General Features
----------------

- Users and Permissions ABM.
- Possibility of activate/deactivate users accounts.
- Autodetection of new Actions on the application.
- Possibility of assign default permissions for new users.

Installation
------------

### Adding the plugin

You can easily install this plugin using composer as follows:

```bash
composer require gustavo82mdq/Acl
```

After doing it, composer will ask you for a version. Checkout the
[package on packagist](https://packagist.org/packages/gustavo82mdq/acl)
to know every available version.

### Enabling the plugin

After adding the plugin remember to load it in your `config/bootstrap.php` file:

```php
Plugin::load('Acl', ['bootstrap' => true, 'routes' => true]);
```

### Apply Migrations

After enable the plugin remember to apply the migrations to create the ACL tables in your database:

```bash
bin/cake migrations migrate --plugin Acl
```

__ under construction __
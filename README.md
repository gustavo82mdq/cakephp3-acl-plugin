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

_under construction_

License
-------

    The MIT License (MIT)
    
    Copyright (c) 2016 Gustavo Tajes Genga (a.k.a gustavo82mdq)
    
    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:
    
    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.

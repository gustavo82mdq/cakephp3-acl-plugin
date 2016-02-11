<?php
use Cake\Core\Plugin;

use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;

Configure::load('Acl.app', 'default', false);
Configure::config('acl', new PhpConfig());
Configure::load('Acl.acl','acl', false);
Plugin::load('Bootstrap', ['bootstrap' => true]);
Plugin::load('Migrations');

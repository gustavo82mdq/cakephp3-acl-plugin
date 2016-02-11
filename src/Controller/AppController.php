<?php

namespace Acl\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;

class AppController extends BaseController
{
    public $helpers = [
        'Less.Less', // required for parsing less files
        'BootstrapUI.Form',
        'BootstrapUI.Html',
        'BootstrapUI.Flash',
        'BootstrapUI.Paginator'
    ];

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('Bootstrap');
    }
}

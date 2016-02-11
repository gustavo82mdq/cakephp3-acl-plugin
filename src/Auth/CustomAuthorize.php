<?php
namespace Acl\Auth;

use Cake\Auth\BaseAuthorize;
use Cake\Network\Request;
use Cake\ORM\TableRegistry;

class CustomAuthorize extends BaseAuthorize
{
    public function authorize($user, Request $request)
    {
        if ($user['username'] == 'admin' || $this->checkPermission($user, $request)) {
            return true;
        }
        return false;
    }

    private function checkPermission($user, Request $request) {
        $this->Actions = TableRegistry::get('Actions');
        $this->Permissions = TableRegistry::get('Permissions');
        $fullname = trim(implode('.',[$request->param('plugin'), $request->param('controller'), $request->param('action')]), '.');
        $action = $this->Actions->findByName($fullname)->first();
        return !$this->Permissions->findByActionId($action->id)->where(['Permissions.user_id' => $user['id']])->isEmpty();
    }
}

<?php
namespace Acl\Controller;

use Acl\Controller\AppController;
use Cake\Core\Configure;
use Cake\Utility\Security;
use ReflectionClass;
use ReflectionMethod;
use Cake\Filesystem\Folder;
use Cake\Core\App;

/**
 * Actions Controller
 *
 * @property \Acl\Model\Table\ActionsTable $Actions
 */
class ActionsController extends AppController
{
    private function checkStatus() {
        $actions = $this->getActions();
        $hash = Security::hash(json_encode($actions));
        if (!Configure::check('acl.hash') || (Configure::read('acl.hash') != $hash)){
            $this->Flash->error(__('Actions list is outdated. Please, rebuild it'));
        }
    }

    private function getActions() {
        $controllers = array();
        $controllers = array_merge($controllers, $this->getControllers(APP, 'App'));
        //Plugins
        $plugins_folder = new Folder(Configure::read('App.paths.plugins')[0]);
        $plugins = $plugins_folder->read(true)[0];
        foreach ($plugins as $plugin) {
            $controllers = array_merge($controllers, $this->getControllers($plugins_folder->path . $plugin . DS . APP_DIR . DS, $plugin));
        }
        $results = array();
        foreach ($controllers as $controller) {
            $className = $controller['plugin'].'\\Controller\\'.$controller['controller'].'Controller';
            $class = new ReflectionClass($className);
            $actions = $class->getMethods(ReflectionMethod::IS_PUBLIC);
            $ignoreList = ['beforeFilter', 'afterFilter', 'initialize'];
            foreach($actions as $action){
                $prefix = '';
                if ($controller['plugin'] != 'App') {
                    $prefix = $controller['plugin'] . '.';
                }
                if($action->class == $className && !in_array($action->name, $ignoreList)){
                    $results[] = $prefix . ucfirst($controller['controller']) . '.' . $action->name;
                }
            }
        }
        return $results;
    }

    private function getControllers($path, $plugin = null) {
        $files = scandir($path . 'Controller/');
        $results = [];
        $ignoreList = [
            '.',
            '..',
            'Component',
            'AppController.php',
        ];
        foreach($files as $file){
            if(!in_array($file, $ignoreList)) {
                $controller = explode('.', $file)[0];
                array_push($results, array('controller' => str_replace('Controller', '', $controller), 'plugin' => $plugin));
            }
        }
        return $results;
    }

    public function rebuild() {
        $actions = $this->getActions();
        $query = $this->Actions->find('list', ['fields' => 'name'])->toArray();

        $deletes = array_diff($query,$actions);
        $inserts = array_diff($actions,$query);

        if (count($deletes) > 0) {
            $this->Actions->deleteAll(['name IN' => $deletes]);
        }

        foreach ($inserts as $a) {
            $action = $this->Actions->newEntity();
            $action = $this->Actions->patchEntity($action, ['name' => $a, 'isdefault' => false]);
            if ($this->Actions->save($action)) {
                $this->Flash->success(__('The Action ' . $a . ' has been saved.'));
            } else {
                $this->Flash->error(__('The Action ' . $a . ' could not be saved. Please, try again.'));
            }
        }
        $hash = Security::hash(json_encode($actions));
        Configure::write('acl.hash', $hash);
        Configure::dump('Acl.acl', 'acl', ['acl']);
        return $this->redirect(['action' => 'index']);
    }

    public function setDefault($id = null) {
        $action = $this->Actions->get($id, [
            'contain' => []
        ]);
        $val = (boolval($action->isdefault) xor true);
        $action->set('isdefault', (int)$val);
        if ($this->Actions->save($action)) {
            $this->Flash->success(__('The Action has been saved.'));
        } else {
            $this->Flash->error(__('The Action could not be saved. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->checkStatus();
        $actions = $this->paginate($this->Actions);

        $this->set(compact('actions'));
        $this->set('_serialize', ['actions']);
    }

    /**
     * View method
     *
     * @param string|null $id Action id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $action = $this->Actions->get($id, [
            'contain' => ['Permissions.Users']
        ]);

        $this->set('action', $action);
        $this->set('_serialize', ['action']);
    }
}

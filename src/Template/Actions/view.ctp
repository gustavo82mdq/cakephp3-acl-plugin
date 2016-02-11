<div class="actions columns col-lg-2 col-md-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="nav nav-stacked nav-pills">
        <li><?= $this->Html->link(__('List Actions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('List Permissions'), ['controller' => 'Permissions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Permission'), ['controller' => 'Permissions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="actions view col-lg-10 col-md-9 columns">
    <h2><?= h($action->name) ?></h2>
    <div class="row">
        <div class="col-lg-5 columns strings">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h6 class="subheader"><?= __('Name') ?></h6>
                    <p><?= h($action->name) ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-2 columns numbers end">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h6 class="subheader"><?= __('Id') ?></h6>
                    <p><?= $this->Number->format($action->id) ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-2 columns dates end">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h6 class="subheader"><?= __('Created') ?></h6>
                    <p><?= h($action->created) ?></p>
                    <h6 class="subheader"><?= __('Modified') ?></h6>
                    <p><?= h($action->modified) ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-2 columns booleans end">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h6 class="subheader"><?= __('Isdefault') ?></h6>
                    <p><?= $action->isdefault ? __('Yes') : __('No'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column col-lg-12">
    <h4 class="subheader"><?= __('Related Permissions') ?></h4>
    <?php if (!empty($action->permissions)): ?>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('User') ?></th>
                <th><?= __('Username') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($action->permissions as $permissions): ?>
            <tr>
                <td><?= h($permissions->action_id) ?></td>
                <td><?= $this->Html->link($permissions->user->fullname, ['controller' => 'Users', 'action' => 'view', $permissions->user->id]) ?></td>
                <td><?= h($permissions->user->username) ?></td>
                <td><?= h($permissions->created) ?></td>
                <td><?= h($permissions->modified) ?></td>
                <td class="actions">
                    <?= $this->Form->postLink('<span class="glyphicon glyphicon-trash"></span><span class="sr-only">' . __('Delete') . '</span>', ['controller' => 'Permissions', 'action' => 'delete', $permissions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $permissions->id), 'escape' => false, 'class' => 'btn btn-xs btn-danger', 'title' => __('Delete')]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php endif; ?>
    </div>
</div>

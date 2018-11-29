<?php

use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
    ?>
    <?php if (!empty($error->queryString)) : ?>
        <p class="notice">
            <strong>SQL Query: </strong>
            <?= h($error->queryString) ?>
        </p>
    <?php endif; ?>
    <?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
    <?php endif; ?>
    <?= $this->element('auto_table_warning') ?>
    <?php
    if (extension_loaded('xdebug')) :
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>
<!--=== Error Title ===-->
<div class="title">
    <h1>404</h1> <!-- You can use something like <h1 class="red">500</h1> for other error codes -->
</div>
<!-- /Error Title -->

<div class="actions">
    <div class="list-group">
        <li class="list-group-item list-group-header align-center">
            Ooops! It looks like you have taken a wrong turn.
        </li>
        <?= $this->Html->link(__('<i class="icon-angle-left align-left"></i>Go Back'), 'javascript:history.back()', ['class' => 'list-group-item','escape'=>false]) ?>
        <!--<a href="index.html" class=""><i class="icon-home"></i> Go Back <i class="icon-angle-right align-right"></i></a>-->
    </div>
</div>

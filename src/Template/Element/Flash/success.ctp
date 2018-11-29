<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-success" onclick="this.classList.add('hidden');">
    <i class="icon-remove close" data-dismiss="alert"></i>
    <strong>Success!</strong> <?= $message ?>
</div>
<!--<div class="message success" onclick="this.classList.add('hidden')"><?= $message ?></div>-->

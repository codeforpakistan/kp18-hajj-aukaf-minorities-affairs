<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-danger fade in message error" onclick="this.classList.add('hidden');">
    <i class="icon-remove close" data-dismiss="alert"></i>
    <strong>Error!</strong> <?= $message ?>
</div>
<!--<div class="message error" onclick="this.classList.add('hidden');">< $message ?></div>-->

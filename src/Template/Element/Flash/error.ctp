<<<<<<< HEAD
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
=======
<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message error" onclick="this.classList.add('hidden');"><?= $message ?></div>
>>>>>>> parent of 5c021008... code cleaned

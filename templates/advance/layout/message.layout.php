<?php if(!empty($message['errors'])) foreach ($message['errors'] as $error): ?>
    <div class="error"><?php echo $error ?></div>
<?php endforeach ?>

<?php if(!empty($message['notices'])) foreach ($message['notices'] as $notice): ?>
    <div class="notice"><?php echo $notice ?></div>
<?php endforeach ?>

<?php if(!empty($message['success'])) foreach ($message['success'] as $success): ?>
    <div class="success"><?php echo $success ?></div>
<?php endforeach ?>
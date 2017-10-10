<div id="<?php echo $key; ?>Message" class="alert alert-<?php echo !empty($params['class']) ? $params['class'] : 'message'; ?> alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo $message; ?>
</div>
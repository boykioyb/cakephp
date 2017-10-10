<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h1><?php echo h($post['Post']['title']); ?></h1>
                </div>
                <div class="box-body">
                    <p>
                        <?php
                        $date = $post['Post']['created'];
                        $fixed = date('d-m-Y', $date->sec);
                        ?>
                        <small>Created: <?= $fixed; ?></small>
                    </p>
                    <p><?php echo h($post['Post']['body']); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
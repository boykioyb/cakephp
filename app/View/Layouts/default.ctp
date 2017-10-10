<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: Demo ');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
        <!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');
    //    echo $this->Html->css('cake.generic');
    echo $this->Html->css('https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css');
    echo $this->Html->css('style');
    echo $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <?php
    echo $this->Html->script('require');
    ?>
    <style>
        .loadImage {
            position: absolute;
            z-index: 999999;
            left: calc(100% / 2.3);
            top: calc(100% / 3);
            display: none;
        }

        .loadImage img {
            width: 30%;
        }

        #backGr {
            position: absolute;
            display: none;
            width: 100%;
            height: 100%;
            background: rgb(253, 253, 253);
            z-index: 999998;
            opacity: 0.7;
        }
    </style>
</head>
<body>
<div id="backGr"></div>
<div id="container">
    <div id="content" style="background: #ddd;min-height: 645px">
        <div class="loadImage">

            <?=  $this->Html->image('ab79a231234507.564a1d23814ef.gif', array('alt' => 'gif'));?>
        </div>
        <?php echo $this->Flash->render(); ?>

        <?php echo $this->fetch('content'); ?>
    </div>

</div>
<?php //print_r($this->element('sql_dump')); ?>
</body>
</html>

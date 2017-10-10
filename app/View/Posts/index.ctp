<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default" style="margin-top: 20px">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <h3><a href="<?php echo Router::url(array('controller' => 'posts', 'action' => 'index'));?>">Blog
                                posts</a>
                            <a href="<?php echo Router::url(array('controller' => 'posts', 'action' => 'add'));?>"
                               class="btn btn-success btn-sm fa fa-plus-circle">
                                Add post
                            </a>
                        </h3>

                    </div>
                    <div class="collapse navbar-collapse">
                        <form id="formSubmit"
                              action="<?php echo Router::url(array('controller' => 'posts', 'action' => 'index'));?>"
                              method="post" class="navbar-form navbar-right form-inline">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type="text" class="form-control" name="start"
                                           value="<?= isset($dateStart) ? $dateStart : '' ?>"
                                           id="dateStart"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type="text" class="form-control" name="end"
                                           value="<?=isset($dateEnd) ? $dateEnd : '' ?>"
                                           id="dateEnd"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <input id="myInput" onkeyup="myFunction()" type="text" class="form-control">
                                <button id="submitForm" type="submit" class="btn btn-success btn-ms"><i
                                            class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div id="showData" class="box">

        <table id="myTable" class="table table-bordered table-striped dataTable">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="tBody">
            <!-- Here is where we loop through our $posts array, printing out post info -->
            <?php foreach ($posts as $key=>$post): ?>
            <tr>
                <?php echo $this->Form->input($post['Post']['id'], array('type' => 'hidden', 'class' => 'hide')); ?>
                <td><?php echo $key + 1; ?></td>
                <td>
                    <?php echo $this->Html->link($post['Post']['title'],
                        array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
                </td>
                <?php
                $date = $post['Post']['created'];
                $fixed = date('d-m-Y H:i:s', $date->sec);
                ?>
                <td><?= $fixed; ?></td>
                <td>
                    <?php echo $this->Html->link('',
                        array('controller' => 'posts', 'action' => 'edit', $post['Post']['id']), array('class' => 'btn btn-success btn-sm fa fa-pencil ')); ?>
                    <a id="<?php echo $post['Post']['id'];?>" href="#"
                       class="btn-xoa btn btn-danger btn-sm fa fa-times"></a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php unset($post); ?>
            </tbody>
        </table>
    </div>
</div>
<style>
    #btnSearch {
        position: absolute;
        top: 14%;
        right: 13%;
        padding: 6px 9px;
    }

</style>
<script>
    function myFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    $(document).ready(function () {
        $('#datetimepicker1').datetimepicker();
        $('#datetimepicker2').datetimepicker();

        $('.btn-xoa').click(function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            var $ele = $(this).parent().parent();
            swal({
                title: "Are you sure?",
                text: "Your want deleted record",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then(function (willDelete) {
                    if (willDelete) {
                        $.ajax({
                            url: '<?php echo Router::url(array('controller' => 'posts', 'action' => 'delete'));?>',
                            dataType: "html",
                            type: "POST",
                            data: {
                                id: id
                            },
                            beforeSend: function () {
                                $('.loadImage').show();
                                $('#backGr').show();
                            },
                            success: function (data) {
                                $('.loadImage').hide();
                                $('#backGr').hide();
                                $ele.fadeOut().remove();
                                swal("Poof! Your imaginary file has been deleted!", {
                                    icon: "success",
                                });
                            },
                            complete: function (data) {
                                console.log(data);
                            },
                            error: function (xhr, msg, error) {
                                swal({
                                    text: "Failed",
                                    icon: "error",
                                })
                            }
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        });
    });
</script>
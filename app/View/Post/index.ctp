<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Post</h4>
                        </div>
                        <form id="formAdd">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="control-label" for="name">Title</label>
                                    <input type="text" id="title" name="title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="email">Body </label>
                                    <textarea name="body" rows="3" class="form-control" maxlength="2000" cols="30"
                                              id="PostBody" required="required"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    <i class="fa fa-close"></i> Cancel
                                </button>
                                <button id="addPost" type="button"
                                        class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Save
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>

            <nav class="navbar navbar-default" style="margin-top: 20px">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <h3><a href="<?php echo Router::url(array('controller' => 'post', 'action' => 'index'));?>">Blog
                                posts</a>
                            <button href="#" class="btn btn-success btn-sm fa fa-plus-circle" data-toggle="modal"
                                    data-target="#myModal">
                                Add post
                            </button>
                        </h3>

                    </div>
                    <div class="collapse navbar-collapse">
                        <form id="formSubmit"
                              action="<?php echo Router::url(array('controller' => 'post', 'action' => 'index'));?>"
                              method="post" class="navbar-form navbar-right form-inline">
                            <div class="input-group">
                                <div class="input-group-addon"><i
                                            class="fa fa-calendar glyphicon glyphicon-calendar"></i></div>
                                <input type="text" class="form-control" name="start"
                                       value="<?=isset($dateStart) ? $dateStart : '' ?>"
                                       id="dateStart"/>
                            </div>
                            <div class="input-group">
                                <div class="input-group-addon"><i
                                            class="fa fa-calendar glyphicon glyphicon-calendar"></i></div>
                                <input type="text" class="form-control" name="end"
                                       value="<?=isset($dateEnd) ? $dateEnd : '' ?>"
                                       id="dateEnd"/>
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
                        array('controller' => 'post', 'action' => 'view', $post['Post']['id'])); ?>
                </td>
                <?php
                $date = $post['Post']['created'];
                $fixed = date('m-d-Y', $date->sec);
                ?>
                <td><?= $fixed; ?></td>
                <td>
                    <?php echo $this->Html->link('',
                        array('controller' => 'post', 'action' => 'edit', $post['Post']['id']), array('class' => 'btn btn-success btn-sm fa fa-pencil ')); ?>
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
        $('#dateStart').daterangepicker({
            "singleDatePicker": true,
            "showDropdowns": true,
            "format": 'YYYY-MM-DD',
            "opens": "left",
            'autoUpdateInput': true
        });
        $('#dateEnd').daterangepicker({
            "singleDatePicker": true,
            "showDropdowns": true,
            "format": 'YYYY-MM-DD',
            "opens": "left"
        });

        $('#addPost').click(function () {
            $.ajax({
                url: '<?php echo Router::url(array('controller' => 'post', 'action' => 'add'));?>',
                dataType: "html",
                type: "POST",
                data: {
                    title: $('#title').val(),
                    body: $('#PostBody').val()
                },
                beforeSend: function () {
                    $('.loadImage').show();
                    $('#backGr').show();
                },
                success: function () {
                    $('.loadImage').hide();
                    $('#backGr').hide();
                    swal("Create Post Success", {
                        icon: "success",
                        buttons: false
                    });
                },
                complete: function () {
                    setTimeout(function () {
                        window.location.reload();
                    }, 100);
                },
                error: function () {
                    swal("Create Post Failed", {
                        icon: "error",
                        buttons: false,
                    });
                }
            });
        });
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
                            url: '<?php echo Router::url(array('controller' => 'post', 'action' => 'delete'));?>',
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
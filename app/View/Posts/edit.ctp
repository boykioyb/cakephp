<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="">Edit Post</h2>
                </div>
                <div class="box-body">
                    <?php
                    echo $this->Form->create('Post');

                    echo $this->Form->input('title', ['class' => 'form-control']);
                    echo $this->Form->input('body', array('rows' => '3','class' => 'form-control'));
                    echo $this->Form->input('id', array('type' => 'hidden'));
                    echo $this->Form->button('Save Posts',['class'=>'btn btn-success','style'=>'margin-top:20px']);

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

class Post extends AppModel
{
    public $useTable = 'posts';
    public $customSchema = array(
        'id'       => null,
        'title'    => '',
        'body'     => '',
        'created'  => '',
        'modified' => null
    );
    public $validate = array(
        'title' => array(
            'rule2' => array(
                'rule' => array('minLength', 8),
                'message' => 'Minimum length of 8 characters'
            )
        ),
        'body'=> array(

            'rule2' => array(
                'rule' => array('minLength', 8),
                'message' => 'Minimum length of 8 characters'
            )
        )

    );

}

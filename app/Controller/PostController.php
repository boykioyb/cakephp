<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * PostController
 * Author: Hoa de Nhat
 * Create: 05/09/2017
 */
class PostController extends AppController
{
    public $helpers = array('Html', 'Form');

    /*public function index()
    {
        $this->set('posts', $this->Post->find('all'));
    }*/
    public function index()
    {
        $mongo = $this->Post;
        if ($this->request->is('post')) {
            $dateStart = $this->request->data['start'];
            $dateEnd   = $this->request->data['end'];
            $start     = new MongoDate(strtotime($dateStart));
            $end       = new MongoDate(strtotime($dateEnd));
            $condion   = array(
                'conditions' => array(
                    'Post.created' => array(
                        '$gte' => $start,
                        '$lt'  => $end
                    )
                ));
            $por       = $mongo->find('all', $condion);
            $this->set('posts', $por);
            $this->set('dateStart', $dateStart);
            $this->set('dateEnd ', $dateEnd);
        } else {
            $results = $mongo->find('all');
            $this->set('posts', $results);
        }
    }

    public function view($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }

    public function add()
    {
        if (!empty($this->data)) {
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }

    public function edit($id = null)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Post edit .'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete()
    {
        $id = $this->request->data['id'];
        if ($this->Post->delete($id)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
    }

    protected function logAnyFile($content, $file_name)
    {
        $log_path = Configure::read('env.log_path');
        if ($log_path) {
            CakeLog::config($file_name, array(
                'engine' => 'File',
                'types'  => array($file_name),
                'path'   => $log_path . DS,
                'file'   => $file_name,
            ));
            $this->log($content, $file_name);
        } else {
            CakeLog::config($file_name, array(
                'engine' => 'File',
                'types'  => array($file_name),
                'file'   => $file_name,
            ));
            $this->log($content, $file_name);
        }
    }

    public function find()
    {
        $mongo   = $this->Post;
        $start   = new MongoDate(strtotime($this->request->data['start']));
        $end     = new MongoDate(strtotime($this->request->data['end']));
        $condion = array(
            'conditions' => array(
                'Post.created' => array(
                    '$gte' => $start,
                    '$lt'  => $end
                )
            ));
        $por     = $mongo->find('all', $condion);

        $this->render(false);
//        debug($por);die();
        $member = array('username' => 'phucvh'
        , 'password'               => '123456'
        , 'email'                  => 'ahoangphuc@gmail.com');
        echo(json_encode($por));

    }
}


<?php

namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
<<<<<<< HEAD
use Cake\Mailer\Email;

=======
>>>>>>> parent of 5c021008... code cleaned
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {
<<<<<<< HEAD

=======
>>>>>>> parent of 5c021008... code cleaned
    public function isAuthorized($user) {
        if ($this->Auth->user('role_id') == 1) {
            return true;
        }
<<<<<<< HEAD
        if (isset($user['role_id']) && $user['role_id'] === 2) {
            $allow_user = array('logout');
            if (in_array($this->request->params['action'], $allow_user)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    private function image_validation($image_details = null) {
        $extentions = array('jpg', 'JPG', 'PNG', 'png', 'jpeg', 'JPEG', 'gif', 'GIF', 'svg', 'SVG');
        $continue = 1;
        $error = '';


        $img_ext = pathinfo($image_details['name'], PATHINFO_EXTENSION);

        if (!in_array($img_ext, $extentions)) {
            $error = 'only image can be uploaded';
            $continue = 0;
            return $error;
        }
        if ($image_details['size'] > 1000000) {
            $error = 'Image size is too big';
            $continue = 0;
            return $error;
        }

        if ($continue == 1) {
            return $continue;
        }
//        exit();
    }

    private function send_email_on_success($data = null) {
        $email = new Email();
        $email->template('default', 'default')
                ->emailFormat('html')
                ->to($data->email)
                ->from(['noreply@jcrecreation.com' => 'ahrma.kp.gov.pk'])
                ->subject('ahrma.kp.gov.pk - Reset Password')
                ->viewVars(['content' => $data])
                ->send();
    }

    public function login() {
        $this->viewBuilder()->layout('');
        if ($this->request->is('post')) {
//            debug($this->request->data);
//            exit;
            if (isset($this->request->data['forgot'])) {
                $this->loadModel('Users');
                $user = $this->Users->find('all')
                        ->where(['email' => $this->request->data['email']])
                        ->first();
//                debug();exit;
                if ($user == null || empty($user)) {
                    $this->Flash->error(__('Email does not exists. Please enter a valid email and try again'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                } else {
                    $this->send_email_on_success($user);
                    $this->Flash->success(__('Please check your email we have sent you a link'));
                    return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                }
            } else {

                $user = $this->Auth->identify();
                if ($user) {

                    if ($user['role_id'] == 1) {
                        $this->Auth->setUser($user);
                        return $this->redirect($this->Auth->redirectUrl());
                    } elseif ($user['role_id'] == 2) {
                        $this->Auth->setUser($user);
                        return $this->redirect(['controller' => 'Applicants', 'action' => 'index']);
                    } else {
                        $this->Flash->error(__('You are not autorize to access that location'));
                        $this->redirect('/admin');
                    }
                }
            }
            $this->Flash->error(__('Invalid email or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

=======
    }
    public function login() {
        $this->viewBuilder()->layout('');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        } else {
            $this->Flash->error(__('not found'));
        }
    }
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
>>>>>>> parent of 5c021008... code cleaned
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->viewBuilder()->layout('admin');
<<<<<<< HEAD
        $users = $this->Users->find('all', [
                    'contain' => ['Roles']
                ])->toArray();
=======
        $users = $this->paginate($this->Users);
>>>>>>> parent of 5c021008... code cleaned
        $this->set(compact('users'));
    }
    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
<<<<<<< HEAD
    public function view($id = null) {
        $this->viewBuilder()->layout('admin');
=======

    public function view($id = null) {
>>>>>>> parent of 5c021008... code cleaned
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->viewBuilder()->layout('admin');
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
<<<<<<< HEAD
            if ($this->request->data['photo'] <> '') {

                $valid_image = $this->image_validation($this->request->data['photo']);
                $u_img = $this->request->data['photo'];

                if ($valid_image == 1) {
                    debug($this->request->data);
                    $get_ext = pathinfo($u_img['name'], PATHINFO_EXTENSION);

                    $new_name = '0-' . date('ymdhis') . '.' . $get_ext;
                    $path = WWW_ROOT . 'img' . DS . 'applicants' . DS . $new_name;

                    move_uploaded_file($u_img['tmp_name'], $path);
                    $this->request->data['photo'] = $new_name;
                    //debug($this->request->data['photo']);
                    $hasher = new DefaultPasswordHasher();
                    $this->request->data['password'] = $hasher->hash($this->request->data['password']);
                    $user = $this->Users->patchEntity($user, $this->request->getData());


                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The user has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
=======
            $hasher = new DefaultPasswordHasher();
            $this->request->data['password'] = $hasher->hash($this->request->data['password']);
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['controller' => 'Applicantaddresses', 'action' => 'add']);
>>>>>>> parent of 5c021008... code cleaned
            }
        }
        $this->set(compact('user'));
    }
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
<<<<<<< HEAD
    public function edit($id = null) {
        if ($id != $this->Auth->user('id')) {
            $this->Flash->error(__('You are not auhorize to access that location'));
            return $this->redirect(['action' => 'index']);
        }
        $this->viewBuilder()->layout('admin');
=======

    public function edit($id = null) {
>>>>>>> parent of 5c021008... code cleaned
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            debug($this->request->data);
            exit();

            if ($this->request->data['photo']['name'] <> '') {
                $valid_image = $this->image_validation($this->request->data['photo']);
                $u_img = $this->request->data['photo'];

                if ($valid_image == 1) {
                    $get_ext = pathinfo($u_img['name'], PATHINFO_EXTENSION);

                    $new_name = '0-' . date('ymdhis') . '.' . $get_ext;
                    $path = WWW_ROOT . 'img' . DS . 'applicants' . DS . $new_name;

                    move_uploaded_file($u_img['tmp_name'], $path);
                    $this->request->data['photo'] = $new_name;
                } else {
                    $this->Flash->error($valid_image);
                }
            } else {
                unset($this->request->data['photo']);
            }
            if (!empty($this->request->data['password'])) {
                $hasher = new DefaultPasswordHasher();
                $this->request->data['password'] = $hasher->hash($this->request->data['password']);
            } else {
                unset($this->request->data['password']);
            }
            $user = $this->Users->patchEntity($user, $this->request->getData());
//            debug($user);
//            exit;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
<<<<<<< HEAD

}
=======
}
>>>>>>> parent of 5c021008... code cleaned

<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    public function beforeFilter(\Cake\Event\Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['login', 'emailValidate', 'dashboard', 'logout', 'reset']);
        $actions = [
            'reset'
        ];

        if (in_array($this->request->params['action'], $actions)) {
            // for csrf
            $this->eventManager()->off($this->Csrf);
            // for security component
            $this->Security->config('unlockedActions', $actions);
        }
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

    public function reset($id = null) {
        $this->viewBuilder()->layout('');
        $id = base64_decode(base64_decode($id));
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hasher = new DefaultPasswordHasher();
            $this->request->data['password'] = $hasher->hash($this->request->data['password']);
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                if ($user->role_id == 1) {
                    return $this->redirect('/admin');
//                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    return $this->redirect(['controller' => 'users', 'action' => 'login']);
                }
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function login() {
        $this->viewBuilder()->layout('');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

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
            } else if (isset($this->request->data['register'])) {

                $check_email = $this->emailValidate($this->request->data['email']);
                if ($check_email == 1) {
                    $hasher = new DefaultPasswordHasher();
                    $this->request->data['password'] = $hasher->hash($this->request->data['password']);
                    $this->request->data['role_id'] = 3;
                    $user = $this->Users->patchEntity($user, $this->request->getData());
                    if ($this->Users->save($user)) {
                        $this->request->data['password'] = $this->request->data['password_confirm'];
//                        $user = $this->request->data;
                        $user = $this->Auth->identify();
                        if ($user) {
                            $this->Auth->setUser($user);

                            return $this->redirect(['controller' => 'Institutes', 'action' => 'add']);
                        }
                        $this->Flash->success(__('The user has been saved.'));
                        return $this->redirect(['controller' => 'Applicants', 'action' => 'profile']);
                    }
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                } else {
                    $this->Flash->error(__($check_email));
                }
            } else {
                $user = $this->Auth->identify();
                if ($user) {
                    if ($user['role_id'] == 3) {
                        $this->Auth->setUser($user);
                        return $this->redirect(['controller' => 'Institutes', 'action' => 'add']);
                    } else {
                        $this->Flash->error(__('Your are not Authorize to access that location'));
                        return $this->redirect('/login');
                    }
//                    if ($user['role_id'] == 2) {
//                        return $this->redirect(['controller' => 'Applicants', 'action' => 'profile']);
//                    }
                }
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }
        $this->set(compact('user'));
    }

    public function emailValidate($id = null) {
        if (isset($id)) {
            $email = $id;
        } else {
            $email = $_GET['email'];
        }
        $message = 1;
        $tlds = $domains = array(".aero", ".biz", ".cat", ".com", ".coop", ".edu", ".gov", ".info", ".int", ".jobs", ".mil", ".mobi", ".museum",
            ".name", ".net", ".org", ".travel", ".ac", ".ad", ".ae", ".af", ".ag", ".ai", ".al", ".am", ".an", ".ao", ".aq", ".ar", ".as", ".at", ".au", ".aw",
            ".az", ".ba", ".bb", ".bd", ".be", ".bf", ".bg", ".bh", ".bi", ".bj", ".bm", ".bn", ".bo", ".br", ".bs", ".bt", ".bv", ".bw", ".by", ".bz", ".ca",
            ".cc", ".cd", ".cf", ".cg", ".ch", ".ci", ".ck", ".cl", ".cm", ".cn", ".co", ".cr", ".cs", ".cu", ".cv", ".cx", ".cy", ".cz", ".de", ".dj", ".dk", ".dm",
            ".do", ".dz", ".ec", ".ee", ".eg", ".eh", ".er", ".es", ".et", ".eu", ".fi", ".fj", ".fk", ".fm", ".fo", ".fr", ".ga", ".gb", ".gd", ".ge", ".gf", ".gg", ".gh",
            ".gi", ".gl", ".gm", ".gn", ".gp", ".gq", ".gr", ".gs", ".gt", ".gu", ".gw", ".gy", ".hk", ".hm", ".hn", ".hr", ".ht", ".hu", ".id", ".ie", ".il", ".im",
            ".in", ".io", ".iq", ".ir", ".is", ".it", ".je", ".jm", ".jo", ".jp", ".ke", ".kg", ".kh", ".ki", ".km", ".kn", ".kp", ".kr", ".kw", ".ky", ".kz", ".la", ".lb",
            ".lc", ".li", ".lk", ".lr", ".ls", ".lt", ".lu", ".lv", ".ly", ".ma", ".mc", ".md", ".mg", ".mh", ".mk", ".ml", ".mm", ".mn", ".mo", ".mp", ".mq",
            ".mr", ".ms", ".mt", ".mu", ".mv", ".mw", ".mx", ".my", ".mz", ".na", ".nc", ".ne", ".nf", ".ng", ".ni", ".nl", ".no", ".np", ".nr", ".nu",
            ".nz", ".om", ".pa", ".pe", ".pf", ".pg", ".ph", ".pk", ".pl", ".pm", ".pn", ".pr", ".ps", ".pt", ".pw", ".py", ".qa", ".re", ".ro", ".ru", ".rw",
            ".sa", ".sb", ".sc", ".sd", ".se", ".sg", ".sh", ".si", ".sj", ".sk", ".sl", ".sm", ".sn", ".so", ".sr", ".st", ".su", ".sv", ".sy", ".sz", ".tc", ".td", ".tf",
            ".tg", ".th", ".tj", ".tk", ".tm", ".tn", ".to", ".tp", ".tr", ".tt", ".tv", ".tw", ".tz", ".ua", ".ug", ".uk", ".um", ".us", ".uy", ".uz", ".va", ".vc",
            ".ve", ".vg", ".vi", ".vn", ".vu", ".wf", ".ws", ".ye", ".yt", ".yu", ".za", ".zm", ".zr", ".zw");
        $mytld = explode('.', $email);
        if (!in_array('.' . end($mytld), $tlds)) {
            $message = "Invalid email address";
        }
        $is_exists = $this->Users->find('all', ['conditions' => ['email LIKE ' => $email]])->count();
//        debug($is_exists);
        if ($is_exists >= 1) {
            $message = "This email is already reserved. Please enter a different email address";
        }
        if (isset($id)) {
            return $message;
        }
        echo $message;

        exit();
    }

    public function logout() {
        if($this->Auth->user('role_id')==2){
            $this->Auth->logout();
          return $this->redirect('/admin');  
        }
        return $this->redirect($this->Auth->logout());
    }

    public function add() {
        $this->viewBuilder()->layout('admin');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $hasher = new DefaultPasswordHasher();
            $this->request->data['password'] = $hasher->hash($this->request->data['password']);
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->viewBuilder()->layout('admin');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hasher = new DefaultPasswordHasher();
            $this->request->data['password'] = $hasher->hash($this->request->data['password']);
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
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

}

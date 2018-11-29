<<<<<<< HEAD
<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace Cewi\Excel\Controller;

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
            'viewClassMap' => [
                'xlsx' => 'Dakota/CakeExcel.Excel',
            ],
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         * 
         */


        $this->loadComponent('Security');

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ],
                    'userModel' => 'Users'
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
            'loginRedirect' => [
                'controller' => 'Applicants',
                'action' => 'dashboard',
                'admin' => true,
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'admin' => true
            ],
            'authorize' => array('Controller') // Added this line
        ]);

        $this->set('auth', $this->Auth);
    }

    public function beforeSave(Event $event) {
        
    }

    public function beforeFilter(Event $event) {

        // Allow users to register and logout.
        $this->Auth->allow(['login']);
        $this->set('user_name', '');
        if ($this->Auth->user('id')) {
            $this->loadModel('Users');
            $user = $this->Users->Applicants->find('all', ['fields' => ['Applicants.name'], 'conditions' => ['Applicants.user_id' => $this->Auth->user('id')]])->first();
            if ($user != null) {
                $this->set('user_name', $user->toArray());
            }
            $this->set('auth', $this->Auth);
        }
        $this->loadModel('Funds');
        $funds = $this->Funds->find('list')
                ->where(['active' => 1, 'sub_category_id' => 3]);
        
        $funds_list = $this->Funds->find('list', ['keyField' => 'fund_for_year', 'valueField' => 'fund_for_year', 'order' => 'fund_for_year DESC'])
                ->where(['Funds.sub_category_id' => 3]);
        $this->set('showlink',$funds_list->toArray());

        $institute_funds = $this->Funds->find('list', ['keyField' => 'id', 'valueField' => 'fund_name'])
                ->where(['sub_category_id' => 3, 'active' => '1', 'last_date >=' => date('Y-m-d')]);
        $this->set('institute_funds', $institute_funds);
        $this->set('edu_funds', $funds);
    }

    public function isAuthorized($user) {
        if ($this->Auth->user('role_id') == 1) {
            return true;
        }
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }

}
=======
<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        $this->loadComponent('Security');
        
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ],
                    'userModel' => 'Users'
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
                
            ],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'index',
                'admin' => true,
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'admin' => true
            ],
            'authorize' => array('Controller') // Added this line
        ]);

        $this->set('auth', $this->Auth);
    }
    
    
    
    public function beforeSave(Event $event)
    {
        
           
    }
    
    public function beforeFilter(Event $event) {
        
        // Allow users to register and logout.
        $this->Auth->allow(['add'],['login']);
    }
}
>>>>>>> parent of 5c021008... code cleaned

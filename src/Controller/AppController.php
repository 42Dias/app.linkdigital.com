<?php
/**
 * App Controler
 *
 * Controla todas as principais funções da aplicação.
 *
 * @copyright Copyright (c) Zeravat (http://zeravat.com.br)
 * @author The Oceaning - www.oceaning.com.br
 * @version 1
 * @subpackage AppController
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Auth\BaseAuthorize;
use Cake\Network\Request;
use Cake\Controller\Component\CookieComponent;
use Cake\Validation\Validation;
use Cake\Controller\Component\RequestHandlerComponent;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use Cake\I18n\Time;

/**
 * App Controler
 *
 * Funções Públicas:
 * initialize()
 * beforeRender()
 * beforeFilter()
 * index()
 * addBalances()
 */
class AppController extends Controller
{

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize()
    {
        ini_set('memory_limit', '256M');
        set_time_limit(0);

        // Inicializa principais componentes
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');
        $this->loadComponent('Cookie');

        // Configura Data e Hora da aplicação
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        // Configura os padrões para o login
        $this->Auth->config(
            'loginAction', [
                'controller' => 'Login',
                'action' => 'home'
            ],
            'loginRedirect', [
                'controller' => 'Login',
                'action' => 'home'
            ],
            'logoutRedirect', [
                'controller' => 'Login',
                'action' => 'home'
            ],
            'authenticate', [
                'Form' => [
                    'userModel' => 'Users',
                    'fields' => ['username' => 'email', 'password' => 'password']
                ]
            ],
            'storage', 'Session'
        );

        // Define variáveis
        $date_now = Time::now();

        // Disponibiliza dados para views
        $this->set('user_id', $this->Auth->user('id'));
        $this->set('user_name', $this->Auth->user('name'));
        $this->set('user_username', $this->Auth->user('username'));
        $this->set('today', $date_now);

    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        // Define _serialize do tipo Json ou Xml
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }

    }

    /**
     * Before filter callback.
     *
     * @param \Cake\Event\Event $event The beforeFilter event.
     * @return void
     */
    public function beforeFilter(Event $event)
    {

        // Define cabeçalhos de requisições
        $this->response->header('Access-Control-Allow-Origin','*');
        $this->response->header('Access-Control-Allow-Methods','OPTIONS, GET, PUT, POST');
        $this->response->header('Access-Control-Allow-Headers','Cache-Control, Pragma, Origin, Authorization, Content-Type, X-Requested-With');
        $this->response->header('Access-Control-Allow-Request-Method', '*');
        $this->response->header('Access-Control-Allow-Credentials','true');
        $this->response->header('Access-Control-Max-Age','1728000');

        // Disponibiliza Actions Publics
        // Public
        $this->Auth->allow(['home']);
        $this->Auth->allow(['display']);
        $this->Auth->allow(['sendContact']);
        $this->Auth->allow(['businessAddStep1']);
        $this->Auth->allow(['businessAddStep2']);
        $this->Auth->allow(['businessAddStep3']);
        $this->Auth->allow(['businessAddStep4']);
        $this->Auth->allow(['businessAddStep5']);
        $this->Auth->allow(['updateTaxation']);
        $this->Auth->allow(['businessUpdateSign']);
        $this->Auth->allow(['businessUpdateTerms']);
        $this->Auth->allow(['paymentsAddBillet']);
        $this->Auth->allow(['paymentsAddCredit']);
        $this->Auth->allow(['searchCep']);
        $this->Auth->allow(['updateService']);
        $this->Auth->allow(['updatePlan']);
        $this->Auth->allow(['searchCnpj']);
        $this->Auth->allow(['agendarLucroReal']);
        $this->Auth->allow(['paymentsTransfer']);

        // Simulations
        $this->Auth->allow(['searchCitys']);
        $this->Auth->allow(['searchAbertura']);

        // Login
        $this->Auth->allow(['email']);
        $this->Auth->allow(['password']);
        $this->Auth->allow(['rememberPassword']);
        $this->Auth->allow(['rememberEmail']);
        $this->Auth->allow(['validatePassword']);
        $this->Auth->allow(['validateEmail']);
        $this->Auth->allow(['validateCpf']);
        $this->Auth->allow(['deleteUser']);
        $this->Auth->allow(['sendPassword']);
        $this->Auth->allow(['alertPassword']);
        $this->Auth->allow(['CreatePassword']);
        $this->Auth->allow(['alertCreatePassword']);
        $this->Auth->allow(['updatePassword']);
        $this->Auth->allow(['logout']);

        // Register
        $this->Auth->allow(['addRegister']);
        $this->Auth->allow(['confirmEmail']);
        $this->Auth->allow(['success']);

        // Automate

    }
}

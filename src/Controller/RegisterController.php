<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validation;
use Cake\Mailer\Email;
use Cake\Controller\Component\RequestHandlerComponent;
use Cake\Network\Request;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use Cake\I18n\Time;

class RegisterController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function addRegister()
    {

        function generateToken($length = 500) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        if ($this->request->is('post')) {

            $date_now = Time::now();
            $token = generateToken();

            $type_register = $this->request->data['register-type'];

            if($type_register == 'pj'){
                $document_register_cnpj = $this->request->data['register-cnpj'];
                $document_register_cpf = '';
            }else{
                $document_register_cpf = $this->request->data['register-cpf'];
                $document_register_cnpj = '';
            }

            // Salva dados Users
            $users = TableRegistry::get('Users');
            $user = $users->newEntity();
            $user->cpf = $document_register_cpf;
            $user->name = $this->request->data['register-name'];
            $user->phone = $this->request->data['register-phone'];
            $user->username = $this->request->data['register-username'];
            $user->password = $this->request->data['register-password'];
            $user->permission = "1";
            $user->origin = $this->request->data['register-origin'];
            $user->image = 'default';
            $user->created = $date_now;
            $user->updated = $date_now;
            $user->last_login = $date_now;
            $user->status = "1";
            $user->token = $token;
            $users->save($user);

            // Cria nova Quotations
            $query = TableRegistry::get('Business');
            $business = $query->newEntity();
            $business->cpf = $document_register_cpf;
            $business->cnpj = $document_register_cnpj;
            $business->created = $date_now;
            $business->updated = $date_now;
            $business->status = 1;
            $query->save($business);

            // Cria nova Quotations
            $query = TableRegistry::get('AccessBusiness');
            $access = $query->newEntity();
            $access->user_id = $user->id;
            $access->business_id = $business->id;
            $access->status = 1;
            $query->save($access);

            // Buscar registros
            $query = TableRegistry::get('BusinessCategories');
            $query_users = $query
                    ->find()
                    ->where([
                        'business_id =' => $business->id
                    ]);

            if($query_users->isEmpty()){

                // Buscar registros
                $query = TableRegistry::get('CategoriesDefault');
                $query_categories_default = $query
                        ->find();

                foreach ($query_categories_default as $category_default) {

                    $query = TableRegistry::get('BusinessCategories'); 
                    $categories = $query->newEntity(); 
                    $categories->business_id =  $business->id;
                    $categories->type = $category_default->type;
                    $categories->group_categories = $category_default->group_categories;
                    $categories->name = $category_default->name;
                    $categories->created = $date_now; 
                    $query->save($categories);
                }
            }         

            // Envia e-mail de seja bem vindo
            $email = new Email();
            $email->viewVars(['id' => $user->id]);
            $email->viewVars(['name' => $user->name]);
            $email->viewVars(['token' => $user->token]);
            $email->template('welcome')
            ->subject('Seja bem vindo a Link Contabilidade!')
            ->emailFormat('html')
            ->to($user->username)
            ->from('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->send();

            // Retorna o status e dados do usuario
            $result = array(
                'status' => 'ok'
            );

            $this->set(compact('result'));

        }

    }

    public function confirmEmail()
    {

        $this->viewBuilder()->Layout('public');
        $this->set('title', 'E-mail confirmado com sucesso');
        $this->set('script', ['Register']);
        $this->set('css', ['Public', 'Login']);

        // Verifica se é uma requisição GET
        if ($this->request->is('get')) {

            $token = $this->request->query['token'];
            $user_id = $this->request->query['id'];

            // Buscar registros
            $users = TableRegistry::get('Users');
            $query_users = $users
                    ->find()
                    ->where([
                        'id =' => $user_id,
                        'token =' => $token
                    ]);

            // Retorna dados da consulta
            foreach ($query_users as $user) {
            }

            // Verifica se foi encontrado algum resultado
            if (!$query_users->isEmpty()){

                // Verifica status do usuário
                if ($user->status == '0'){

                    // Atualiza Status do usuário
                    $query_users = $users->query();
                    $query_users->update()
                            ->set(['status' => "1"])
                            ->where(['id' => $user_id])
                            ->execute();

                }else{

                    // Redireciona para página de App
                    return $this->redirect('/login');
                }
            }else{

                // Redireciona para página de App
                return $this->redirect('/login');
            }
        }
    }

}

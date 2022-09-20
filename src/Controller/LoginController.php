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


class LoginController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->set('description', '');
    }

    public function home()
    {
        
        // echo "Aguarde, em manutenção...";
        // die();
        
        $this->viewBuilder()->Layout('public');
        $this->set('title', 'Login - ');
        $this->set('script', ['login_auth', 'login', 'public']);
        $this->set('css', ['default', 'login']);
        $this->set('meta', '');
        $this->set('description', '');

        $recents = $this->Cookie->read('recent-logged');
        $users_logged = array();
        $i = 0;

        if (!empty($recents)){
            foreach ($recents as $row) {
                $i++;
                $users_logged[$i]['id'] = $row['id'];
                $users_logged[$i]['name'] = $row['name'];
                $users_logged[$i]['username'] = $row['username'];
                $users_logged[$i]['image'] = $row['image'];
            }
        }

        $this->set('users_logged', $users_logged);

        if($this->Auth->user('id') != ""){

            // 1) cliente 2) webmaster 3) direcao 4) fiscal 5) pessoal 6) financeiro 7) contabil 8) cadastro 9) administrativo 10) legalizacao 11) atendimento 12) treinamento 13) comercial 14) marketing

            if($this->Auth->user('permission') == 1){
                return $this->redirect('/client');
            }

            if($this->Auth->user('permission') == 2 || $this->Auth->user('permission') == 3){
                return $this->redirect('/admin');
            }

            if($this->Auth->user('permission') > 3){
                return $this->redirect('/accountant');
            }
        }

        if($_SERVER['REQUEST_URI'] == "/login-alert"){ 
            $this->viewBuilder()->template('login_alert');
        }

    }

    public function email()
    {
        $this->viewBuilder()->Layout('public');
        $this->set('title', 'Adicionar conta - ');
        $this->set('script', ['login_auth', 'login', 'public']);
        $this->set('css', ['default', 'login']);
        $this->set('meta', '');
    }

    public function password($id_login = null)
    {
        $this->viewBuilder()->Layout('public');
        $this->set('title', 'Acesse sua conta - ');
        $this->set('script', ['login_auth', 'login', 'public']);
        $this->set('css', ['default', 'login']);
        $this->set('meta', '');

        if (empty($id_login)){
            $username = $this->Cookie->read('last-username');
            $name = $this->Cookie->read('last-name');
            $id = $this->Cookie->read('last-id');
            $image = $this->Cookie->read('last-image');
            $this->set('id', $id);
            $this->set('username', $username);
            $this->set('name', $name);
            $this->set('image', $image);
        }else{
            $recents = $this->Cookie->read('recent-logged');

            foreach ($recents as $row) {
                if ($row['id'] == $id_login){
                    $this->set('id', $row['id']);
                    $this->set('username', $row['username']);
                    $this->set('name', $row['name']);
                    $this->set('image', $row['image']);
                }
            }
        }

    }

    public function validatePassword()
    {
        // Verifica requisição
        if ($this->request->is('post')) {

            // Verificar expiração
            $date_now = Date::now();

            // Buscar registros
            $users = TableRegistry::get('Users');
            $query_users = $users
                    ->find()
                    ->where([
                        'username =' => $this->request->data['username']
                    ]);

            foreach ($query_users as $user) {
                $permission_user = $user->permission;
                $create_user = $user->created;
            }

            $create_user = date_format($create_user, "Y-m-d 00:00:00");
            $create_user = new Date($create_user);

            $diff = date_diff($date_now, $create_user);
            $diff_days = $diff->format('%a');

            $date_now = Time::now();

            // Verifica e-mail
            if (Validation::email($this->request->data['username'])) {

                $password = $this->request->data['password'];

                // Identifica usuário
                $this->Auth->constructAuthenticate();
                $user = $this->Auth->identify();

                if ($user) {

                    $this->Auth->setUser($user);

                    if($this->Auth->user('status') == '1'){

                        // Define a permissão do usuário
                        if ($user['permission'] == 1) {
                            $redirect = "/client";
                        }

                        if ($user['permission'] == 2 || $user['permission'] == 3) {
                            $redirect = "/admin";
                        }

                        if($user['permission'] > 3){
                            $redirect = "/accountant";
                        }

                        $query = TableRegistry::get('Users');
                        $query_data = $query->query();
                        $query_data->update()
                            ->set([
                                'last_login' => $date_now,
                                'logged' => 1
                            ])
                            ->where(['id =' => $this->Auth->user('id')])
                            ->execute();

                        // Retorna o status e dados do usuario
                        $result = array(
                            'status' => 'ok',
                            'user_id' => $this->Auth->user('id'),
                            'redirect' => $redirect
                        );

                        // Salva Cookie dos recentes logados
                        $id = $this->Auth->user('id');
                        $cookie = $this->Cookie->read('recent-logged');

                        //  Security atual
                        $users = TableRegistry::get('Users');
                        $query_users = $users
                                ->find()
                                ->where([
                                    'id =' => $this->Auth->user('id')
                                ]);

                        // Retorna dados da consulta
                        foreach ($query_users as $user) {
                            $user_image = $user->image;
                        }

                        if ($cookie == ""){
                            $user_logged = array();
                            $user_logged['user-1']['id'] = $this->Auth->user('id');
                            $user_logged['user-1']['name'] = $this->Auth->user('name');
                            $user_logged['user-1']['username'] = $this->Auth->user('username');
                            $user_logged['user-1']['image'] = $user_image;
                            $this->Cookie->write('recent-logged', $user_logged);
                        }else{

                            // Verfica se já existe o usuário
                            $check = "false";

                            foreach ($cookie as $row) {
                                if ($row['id'] == $id){
                                    $check = "true";
                                }
                            }

                            if ($check == "false"){
                                $users = (count($cookie))+1;
                                $cookie['user-'.$users]['id'] = $this->Auth->user('id');
                                $cookie['user-'.$users]['name'] = $this->Auth->user('name');
                                $cookie['user-'.$users]['username'] = $this->Auth->user('username');
                                $cookie['user-'.$users]['image'] = $user_image;
                                $this->Cookie->write('recent-logged', $cookie);
                            }
                        }
                    }else{
                        $result = array(
                            'status' => 'E-mail não confirmado!',
                            'redirect' => ''
                        );

                        $this->Auth->logout();
                    }

                }else {
                    // Retorna o status e dados do usuario
                    $result = array(
                        'status' => 'Usuário ou senha inválidos!',
                        'redirect' => ''
                    );
                }

            }else {
                // E-mail inválido
                $result = array(
                    'status' => 'email-error',
                    'redirect' => ''
                );
            }

        }else{
            $result = array(
                'status' => 'no-post',
                'redirect' => ''
            );
        }
        $this->set(compact('result'));
    }

    public function validateEmail()
    {
        // Verifica requisição
        if ($this->request->is('post')) {

            // Verifica e-mail
            if (Validation::email($this->request->data['username'])) {

                // Verifica usuário válido
                $users = TableRegistry::get('Users');
                $query = $users
                        ->find()
                        ->where(['username =' => $this->request->data['username']]);

                // Verifica resultado
                if ($query->isEmpty()){
                    $result = array(
                        'status' => 'error',
                        'redirect' => ''
                    );
                }else{

                    $result = array(
                        'status' => 'ok',
                        'redirect' => '/login/password'
                    );

                    // Cookie last user
                    foreach ($query as $row) {
                        $this->Cookie->write('last-id', $row->id);
                        $this->Cookie->write('last-username', $row->username);
                        $this->Cookie->write('last-name', $row->name);
                        $this->Cookie->write('last-image', $row->image);

                        // Salva Cookie dos recentes logados
                        $id = $row->id;
                        $cookie = $this->Cookie->read('recent-logged');

                        if ($cookie == ""){
                            $user_logged = array();
                            $user_logged['user-1']['id'] = $row->id;
                            $user_logged['user-1']['name'] =  $row->name;
                            $user_logged['user-1']['username'] = $row->username;
                            $user_logged['user-1']['image'] = $row->image;
                            $this->Cookie->write('recent-logged', $user_logged);
                        }else{

                            // Verfica se já existe o usuário
                            $check = "false";

                            foreach ($cookie as $row_cookie) {
                                if ($row_cookie['id'] == $id){
                                    $check = "true";
                                }
                            }

                            if ($check == "false"){
                                $users = (count($cookie))+1;
                                $cookie['user-'.$users]['id'] = $row->id;
                                $cookie['user-'.$users]['name'] = $row->name;
                                $cookie['user-'.$users]['username'] = $row->username;
                                $cookie['user-'.$users]['image'] = $row->image;
                                $this->Cookie->write('recent-logged', $cookie);
                            }
                        }

                    }

                }
            }else{

                // E-mail inválido
                $result = array(
                    'status' => 'email-error',
                    'redirect' => ''
                );
            }
        }
        $this->set(compact('result'));
    }

    public function rememberPassword()
    {
        $this->viewBuilder()->Layout('public');
        $this->set('title', 'Esqueci minha senha - ');
        $this->set('script', ['login_auth', 'login', 'public']);
        $this->set('css', ['default', 'login']);
        $this->set('meta', '');

        if($this->Auth->user('id') != ""){

            // Redireciona para página de App
            return $this->redirect('/login');
        }
    }

    public function sendPassword()
    {

        // Verifica requisição
        if ($this->request->is('post')) {

            // Verifica e-mail
            if (Validation::email($this->request->data['username'])) {

                // Verifica usuário válido
                $users = TableRegistry::get('Users');
                $query = $users
                        ->find()
                        ->where(['username =' => $this->request->data['username']]);

                // Verifica resultado
                if ($query->isEmpty()){

                    $result = array(
                        'status' => 'error',
                        'redirect' => ''
                    );

                }else{

                    // Retorna dados da consulta
                    foreach ($query as $user) {

                        // Envia e-mail de Confirmação de e-mail
                        $email = new Email();
                        $email->viewVars(['id' => $user->id]);
                        $email->viewVars(['name' => $user->name]);
                        $email->viewVars(['token' => $user->token]);
                        $email->template('send-password')
                        ->subject('Recupere a sua senha - Link Contabilidade')
                        ->emailFormat('html')
                        ->to($user->username)
                        ->from('contato@linkcontabilidade.com.br', 'Link Contabilidade')
                        ->send();
                    }

                    $result = array(
                        'status' => 'ok',
                        'redirect' => '/login/recuperar-senha'
                    );
                }
            }
        }

        $this->set(compact('result'));
    }

    public function alertPassword()
    {
        $this->viewBuilder()->Layout('public');
        $this->set('title', 'Recuperar minha senha - ');
        $this->set('script', ['login_auth', 'login', 'public']);
        $this->set('css', ['default', 'login']);
        $this->set('meta', '');
    }

    public function createPassword()
    {
        $this->viewBuilder()->Layout('public');
        $this->set('title', 'Atualizar minha senha - ');
        $this->set('script', ['login_auth', 'login', 'public']);
        $this->set('css', ['default', 'login']);
        $this->set('meta', '');

        if($this->Auth->user('permission') == 1){
            return $this->redirect('/client');
        }

        if($this->Auth->user('permission') == 2 || $this->Auth->user('permission') == 3){
            return $this->redirect('/admin');
        }

        if($this->Auth->user('permission') > 3){
            return $this->redirect('/accountant');
        }

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
                $user_name = $user->name;
            }

            // Verifica se foi encontrado algum resultado
            if (!$query_users->isEmpty()){

                $this->set('email_recover', $user->username);

            }else{

                // Redireciona para página de App
                return $this->redirect('/login');
            }

            $this->set('user_name', $user_name);
        }

    }

    public function updatePassword()
    {

        if ($this->request->is('post')) {

            $date_now = Time::now();

            $new_password = $this->request->data['new-password'];
            $hasher = new DefaultPasswordHasher();

            $users = TableRegistry::get('Users');
            $query_users = $users->query();
            $query_users->update()
                    ->set([
                        'password' => $hasher->hash($new_password),
                        'updated' => $date_now,
                        'status' => 1
                    ])
                    ->where(['username' => $this->request->data['username']])
                    ->execute();

            // Retorna o status e dados do usuario
            $result = array(
                'status' => 'ok',
                'redirect' => '/login/atualizar-senha'
            );

        }

        $this->set(compact('result'));
    }

    public function alertCreatePassword()
    {
        $this->viewBuilder()->Layout('public');
        $this->set('title', 'Atualizar minha senha - ');
        $this->set('script', ['login_auth', 'login', 'public']);
        $this->set('css', ['default', 'login']);
        $this->set('meta', '');
    }

    public function rememberEmail()
    {
        $this->viewBuilder()->Layout('public');
        $this->set('title', 'Esqueci meu e-mail - ');
        $this->set('script', ['login_auth', 'login', 'public']);
        $this->set('css', ['default', 'login']);
        $this->set('meta', '');
    }

    public function validateCpf()
    {

    }

    public function deleteUser($id_login = null)
    {
        $i = 0;
        $x = 0;
        $users_logged = array();

        $cookie = $this->Cookie->read('recent-logged');

        foreach ($cookie as $row_cookie) {
            $i++;

            if ($row_cookie['id'] != $id_login){
                $x++;
                $users_logged['user-'.$i]["id"] = $row_cookie['id'];
                $users_logged['user-'.$i]["name"] = $row_cookie['name'];
                $users_logged['user-'.$i]["username"] = $row_cookie['username'];
                $users_logged['user-'.$i]["image"] = $row_cookie['image'];
            }
        }

        // print_r($cookie);

        $this->Cookie->write('recent-logged', $users_logged);

        if($x == 0){
            $result = array('status' => 'redirect');
            $this->Cookie->delete('last-id');
            $this->Cookie->delete('last-username');
            $this->Cookie->delete('last-name');
            $this->Cookie->delete('last-image');
            $this->Cookie->delete('recent-logged');
        }else{
            $result = array('status' => 'ok');
        }

        $this->set(compact('result'));

    }

    public function logout()
    {

        $last_login = "";

        // Buscar registros
        $users = TableRegistry::get('Users');
        $query_users = $users
                ->find()
                ->where([
                    'id =' => $this->Auth->user('id'),
                ]);

        // Retorna dados da consulta
        foreach ($query_users as $user) {
            $last_login = $user->last_login;
        }

        $query = TableRegistry::get('Users');
        $query_data = $query->query();
        $query_data->update()
            ->set([
                'active_login' => $last_login,
                'logged' => 0
            ])
            ->where(['id =' => $this->Auth->user('id')])
            ->execute();

        $this->Auth->logout();
        return $this->redirect('/login');
    }

}

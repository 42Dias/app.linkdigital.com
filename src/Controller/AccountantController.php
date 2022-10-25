<?php

/**
 * Routes Controller
 *
 * Controla as rotas do App
 *
 * @copyright Copyright (c) Zeravat (http://zeravat.com.br)
 * @author The Oceaning - www.oceaning.com.br
 * @version 1
 */

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


class AccountantController extends AppController
{

    public function initialize()
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Auth');

        $date_now = Date::now();

        $this->set('id_user', $this->Auth->user('id'));
        $this->set('image_user', $this->Auth->user('image'));
        $this->set('email_user', $this->Auth->user('username'));
        $this->set('phone_user', $this->Auth->user('phone'));
        $this->set('name_user', $this->Auth->user('name'));
        $this->set('lastname_user', $this->Auth->user('lastname'));
        $this->set('permission_user', $this->Auth->user('permission'));
        $this->set('active_login', $this->Auth->user('active_login'));
        $this->set('date_now', $date_now);
        $this->set('styles_page', '');
    }

    public function home()
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Visão Geral | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'home');

        $total_leads = 0;
        $total_contracts = 0;
        $total_pendentes = 0;
        $total_cancelamentos = 0;

        // Buscar registros
        $query_data = TableRegistry::get('Business');
        $query_data_business = $query_data
                ->find()
                ->order(['id DESC']);

        $query_user = TableRegistry::get('Users');
        $query_users = $query_user
                ->find();

        $query_access = TableRegistry::get('AccessBusiness');
        $query_access_business = $query_access
                ->find();

        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find();

        foreach ($query_business as $business) {

            if($business->status == 1){
                $total_leads++;
            }

            if($business->status == 2 || $business->status == 3 || $business->status == 4){
                $total_contracts++;
            }

            if($business->status == 2 || $business->status == 3){
                $total_pendentes++;
            }

            if($business->status == 6){
                $total_cancelamentos++;
            }
        }
        
        $this->set('all_users', $query_users);
        $this->set('all_contracts', $query_data_business);
        $this->set('all_access', $query_access_business);
        $this->set('total_leads', $total_leads);
        $this->set('total_contracts', $total_contracts);
        $this->set('total_pendentes', $total_pendentes);
        $this->set('total_cancelamentos', $total_cancelamentos);
    }

    public function business()
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Empresas | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'business');

        // GET
        if(isset($this->request->query['type'])){
            $type_select = $this->request->query['type'];
        }else{
            $type_select = "all";
        }

        if(isset($this->request->query['status'])){
            $status_select = $this->request->query['status'];
        }else{
            $status_select = "all";
        }

        if($type_select == "all" && $status_select == "all"){

            // Buscar registros
            $query = TableRegistry::get('Business');
            $query_business = $query
                    ->find()
                    ->order(['created DESC']);

        }else{

            if($type_select != "all" && $status_select == "all"){

                // Buscar registros
                $query = TableRegistry::get('Business');
                $query_business = $query
                        ->find()
                        ->where([
                            'type =' => $type_select
                        ])
                        ->order(['created DESC']);
            }

            if($type_select == "all" && $status_select != "all"){

                // Buscar registros
                $query = TableRegistry::get('Business');
                $query_business = $query
                        ->find()
                        ->where([
                            'status =' => $status_select
                        ])
                        ->order(['created DESC']);
            }

            if($type_select != "all" && $status_select != "all"){

                // Buscar registros
                $query = TableRegistry::get('Business');
                $query_business = $query
                        ->find()
                        ->where([
                            'type =' => $type_select,
                            'status =' => $status_select
                        ])
                        ->order(['created DESC']);
            }
        }

        $this->set('all_business', $query_business);
        $this->set('type_select', $type_select);
        $this->set('status_select', $status_select);
    }

    public function viewBusinessTasks($business_id = null)
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Empresas | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'business');
        $this->set('view_select', 'tasks');

        $date_now = Date::now();

        $styles_page = 'padding-left: 70px; padding-right: 0px;padding-top: 70px; padding-bottom: 0px;';

        $user_id = 0;
        $list_status_tasks = [];
        $list_date_tasks = [];
        $name_business = [];
        $infos_user_activity = [];
        $service_business = "";
        $taxation_business = "";
        $x = 0;

        if($this->Auth->user('permission') == 4){ $accountant_area = 'fiscal'; }
        if($this->Auth->user('permission') == 5){ $accountant_area = 'pessoal'; }
        if($this->Auth->user('permission') == 6){ $accountant_area = 'financeiro'; }
        if($this->Auth->user('permission') == 7){ $accountant_area = 'contabil'; }
        if($this->Auth->user('permission') == 8){ $accountant_area = 'cadastro'; }
        if($this->Auth->user('permission') == 9){ $accountant_area = 'administrativo'; }
        if($this->Auth->user('permission') == 10){ $accountant_area = 'legalizacao'; }
        if($this->Auth->user('permission') == 11){ $accountant_area = 'atendimento'; }
        if($this->Auth->user('permission') == 12){ $accountant_area = 'treinamento'; }
        if($this->Auth->user('permission') == 13){ $accountant_area = 'comercial'; }
        if($this->Auth->user('permission') == 14){ $accountant_area = 'marketing'; }

        // // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access_business = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ]);

        foreach ($query_access_business as $access_business) {
            $user_id = $access_business->user_id;
        }

        $query = TableRegistry::get('Users');
        $query_users = $query
            ->find()
            ->where([
                'id =' => $user_id
            ]);


        // // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_id
                ]);
  
        foreach ($query_business as $business) {
            $service_business = $business->type;
            $taxation_business = $business->taxation;
            $action_business = $business->action;
        }

        // Buscar registros
        $query = TableRegistry::get('Services');
        $query_services = $query
            ->find()
            ->where([
                'type =' => $service_business,
                'action =' => $action_business
            ]);

        // Buscar registros
        $query = TableRegistry::get('Accountants');
        $query_accountants = $query
                ->find();

        // // // Buscar registros
        $query = TableRegistry::get('Activities');
        $query_activities = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ])
                ->order([
                    'id DESC'
                ]);

        foreach ($query_activities as $activity) {

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users_activity = $query
                    ->find()
                    ->where([
                        'id =' => $activity->user_id
                    ]);

            foreach ($query_users_activity as $user_activity) {
                $infos_user_activity[$activity->id]["permission"] = $user_activity->permission;
                $infos_user_activity[$activity->id]["name"] = $user_activity->name." ".$user_activity->lastname;
            }
        }

        // Buscar registros
        $query = TableRegistry::get('Tasks');
        $query_all_tasks = $query
            ->find()
            ->where([
                'business_id =' => $business_id
            ]);

        foreach ($query_all_tasks as $task) {

            $list_status_tasks[$task->task_fixed_id] = $task->status;
            $list_date_tasks[$task->task_fixed_id][date_format($task->updated, 'Ymd')] = 'ok';
        }  

        // print_r($list_date_tasks);
        // echo $list_date_tasks[2][20200630];
        // die();

        // Buscar registros
        $query = TableRegistry::get('TasksFixed');
        $query_all_tasks_fixed = $query
            ->find()
            ->where([
                'service =' => $service_business,
                'taxation =' => $taxation_business,
                'area =' => $accountant_area,
                'notification_type =' => 'all'
            ])
            ->OrWhere([
                'service =' => $service_business,
                'taxation =' => $taxation_business,
                'area =' => $accountant_area,
                'notification_type =' => 'accountant'
            ])
            ->order([
                'id ASC'
            ]);


        $this->set('all_accountants', $query_accountants);
        $this->set('all_business', $query_business);
        $this->set('all_users', $query_users);
        $this->set('all_activities', $query_activities);
        $this->set('all_services', $query_services);
        $this->set('all_tasks', $query_all_tasks);
        $this->set('all_tasks_fixed', $query_all_tasks_fixed);
        $this->set('infos_user_activity', $infos_user_activity);
        $this->set('list_status_tasks', $list_status_tasks);
        $this->set('list_date_tasks', $list_date_tasks);
        $this->set('styles_page', $styles_page);
        $this->set('business_id', $business_id);

    }

    public function viewBusinessInvoices($business_id = null)
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Empresas | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'business');
        $this->set('view_select', 'invoices');

        $date_now = Date::now();

        $styles_page = 'padding-left: 70px; padding-right: 0px;padding-top: 70px; padding-bottom: 0px;';

        $user_id = 0;
        $list_status_tasks = [];
        $list_date_tasks = [];
        $name_business = [];
        $infos_user_activity = [];
        $service_business = "";
        $taxation_business = "";
        $x = 0;

        // // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access_business = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ]);

        foreach ($query_access_business as $access_business) {
            $user_id = $access_business->user_id;
        }

        $query = TableRegistry::get('Users');
        $query_users = $query
            ->find()
            ->where([
                'id =' => $user_id
            ]);


        // // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_id
                ]);
  
        foreach ($query_business as $business) {
            $service_business = $business->type;
            $taxation_business = $business->taxation;
            $action_business = $business->action;
        }

        // Buscar registros
        $query = TableRegistry::get('Services');
        $query_services = $query
            ->find()
            ->where([
                'type =' => $service_business,
                'action =' => $action_business
            ]);

        // Buscar registros
        $query = TableRegistry::get('Accountants');
        $query_accountants = $query
                ->find();

        // // // Buscar registros
        $query = TableRegistry::get('Activities');
        $query_activities = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ])
                ->order([
                    'id DESC'
                ]);

        foreach ($query_activities as $activity) {

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users_activity = $query
                    ->find()
                    ->where([
                        'id =' => $activity->user_id
                    ]);

            foreach ($query_users_activity as $user_activity) {
                $infos_user_activity[$activity->id]["permission"] = $user_activity->permission;
                $infos_user_activity[$activity->id]["name"] = $user_activity->name." ".$user_activity->lastname;
            }
        }

        $this->set('all_accountants', $query_accountants);
        $this->set('all_business', $query_business);
        $this->set('all_users', $query_users);
        $this->set('all_activities', $query_activities);
        $this->set('all_services', $query_services);
        $this->set('infos_user_activity', $infos_user_activity);
        $this->set('list_status_tasks', $list_status_tasks);
        $this->set('list_date_tasks', $list_date_tasks);
        $this->set('styles_page', $styles_page);
        $this->set('business_id', $business_id);

        // TAB 5
        // Month
        if(isset($this->request->query['month_tab_6'])){
            $month_tab_6 = $this->request->query['month_tab_6'];
        }else{
            $month_tab_6 = date_format($date_now, 'm');
        }

        // Year
        if(isset($this->request->query['year_tab_6'])){
            $year_tab_6 = $this->request->query['year_tab_6'];
        }else{
            $year_tab_6 = date_format($date_now, 'Y');
        }

        // Maturity
        if(isset($this->request->query['status_tab_6'])){
            $status_tab_6 = $this->request->query['status_tab_6'];
        }else{
            $status_tab_6 = "all";
        }

        // Todos
        if($status_tab_6 == "all"){

            // Buscar registros
            $query = TableRegistry::get('Payments');
            $query_invoices = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(maturity) =' => $month_tab_6,
                    'YEAR(maturity) =' => $year_tab_6
                ])
                ->order(['id ASC']);
        }

        // Todos
        if($status_tab_6 != 'all'){

            // Buscar registros
            $query = TableRegistry::get('Payments');
            $query_invoices = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(maturity) =' => $month_tab_6,
                    'YEAR(maturity) =' => $year_tab_6,
                    'status =' => $month_tab_6
                ])
                ->order(['id ASC']);
        }

        $this->set('month_tab_6', $month_tab_6);
        $this->set('year_tab_6', $year_tab_6);
        $this->set('status_tab_6', $status_tab_6);
        
        $this->set('all_invoices', $query_invoices);

    }

    public function viewBusinessDocuments($business_id = null)
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Empresas | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'business');
        $this->set('view_select', 'documents');

        $date_now = Date::now();

        $styles_page = 'padding-left: 70px; padding-right: 0px;padding-top: 70px; padding-bottom: 0px;';

        $user_id = 0;
        $list_status_tasks = [];
        $list_date_tasks = [];
        $name_business = [];
        $infos_user_activity = [];
        $service_business = "";
        $taxation_business = "";
        $x = 0;

        // // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access_business = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ]);

        foreach ($query_access_business as $access_business) {
            $user_id = $access_business->user_id;
        }

        $query = TableRegistry::get('Users');
        $query_users = $query
            ->find()
            ->where([
                'id =' => $user_id
            ]);


        // // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_id
                ]);
  
        foreach ($query_business as $business) {
            $service_business = $business->type;
            $taxation_business = $business->taxation;
            $action_business = $business->action;
        }

        // Buscar registros
        $query = TableRegistry::get('Services');
        $query_services = $query
            ->find()
            ->where([
                'type =' => $service_business,
                'action =' => $action_business
            ]);

        // Buscar registros
        $query = TableRegistry::get('Accountants');
        $query_accountants = $query
                ->find();

        // // // Buscar registros
        $query = TableRegistry::get('Activities');
        $query_activities = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ])
                ->order([
                    'id DESC'
                ]);

        foreach ($query_activities as $activity) {

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users_activity = $query
                    ->find()
                    ->where([
                        'id =' => $activity->user_id
                    ]);

            foreach ($query_users_activity as $user_activity) {
                $infos_user_activity[$activity->id]["permission"] = $user_activity->permission;
                $infos_user_activity[$activity->id]["name"] = $user_activity->name." ".$user_activity->lastname;
            }
        }

        $this->set('all_accountants', $query_accountants);
        $this->set('all_business', $query_business);
        $this->set('all_users', $query_users);
        $this->set('all_activities', $query_activities);
        $this->set('all_services', $query_services);
        $this->set('infos_user_activity', $infos_user_activity);
        $this->set('list_status_tasks', $list_status_tasks);
        $this->set('list_date_tasks', $list_date_tasks);
        $this->set('styles_page', $styles_page);
        $this->set('business_id', $business_id);

        // TAB 5
        // Month
        if(isset($this->request->query['month_tab_5'])){
            $month_tab_5 = $this->request->query['month_tab_5'];
        }else{
            $month_tab_5 = date_format($date_now, 'm');
        }

        // Year
        if(isset($this->request->query['year_tab_5'])){
            $year_tab_5 = $this->request->query['year_tab_5'];
        }else{
            $year_tab_5 = date_format($date_now, 'Y');
        }

        // Maturity
        if(isset($this->request->query['status_tab_5'])){
            $status_tab_5 = $this->request->query['status_tab_5'];
        }else{
            $status_tab_5 = "all";
        }

        // Todos
        if($status_tab_5 == "all"){

            // Buscar registros
            $query = TableRegistry::get('Documents');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(date) =' => $month_tab_5,
                    'YEAR(date) =' => $year_tab_5
                ])
                ->order(['date ASC']);
        }

        // Todos
        if($status_tab_5 != 'all'){

            // Buscar registros
            $query = TableRegistry::get('Documents');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(date) =' => $month_tab_5,
                    'YEAR(date) =' => $year_tab_5,
                    'status =' => $month_tab_5
                ])
                ->order(['date ASC']);
        }

        $this->set('month_tab_5', $month_tab_5);
        $this->set('year_tab_5', $year_tab_5);
        $this->set('status_tab_5', $status_tab_5);

        $this->set('all_documents', $query_documents);

    }

    public function viewBusinessExtracts($business_id = null)
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Empresas | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'business');
        $this->set('view_select', 'extracts');

        $date_now = Date::now();

        $styles_page = 'padding-left: 70px; padding-right: 0px;padding-top: 70px; padding-bottom: 0px;';

        $user_id = 0;
        $list_status_tasks = [];
        $list_date_tasks = [];
        $name_business = [];
        $infos_user_activity = [];
        $service_business = "";
        $taxation_business = "";
        $x = 0;

        // // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access_business = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ]);

        foreach ($query_access_business as $access_business) {
            $user_id = $access_business->user_id;
        }

        $query = TableRegistry::get('Users');
        $query_users = $query
            ->find()
            ->where([
                'id =' => $user_id
            ]);


        // // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_id
                ]);
  
        foreach ($query_business as $business) {
            $service_business = $business->type;
            $taxation_business = $business->taxation;
            $action_business = $business->action;
        }

        // Buscar registros
        $query = TableRegistry::get('Services');
        $query_services = $query
            ->find()
            ->where([
                'type =' => $service_business,
                'action =' => $action_business
            ]);

        // Buscar registros
        $query = TableRegistry::get('Accountants');
        $query_accountants = $query
                ->find();

        // // // Buscar registros
        $query = TableRegistry::get('Activities');
        $query_activities = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ])
                ->order([
                    'id DESC'
                ]);

        foreach ($query_activities as $activity) {

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users_activity = $query
                    ->find()
                    ->where([
                        'id =' => $activity->user_id
                    ]);

            foreach ($query_users_activity as $user_activity) {
                $infos_user_activity[$activity->id]["permission"] = $user_activity->permission;
                $infos_user_activity[$activity->id]["name"] = $user_activity->name." ".$user_activity->lastname;
            }
        }


        $this->set('all_accountants', $query_accountants);
        $this->set('all_business', $query_business);
        $this->set('all_users', $query_users);
        $this->set('all_activities', $query_activities);
        $this->set('all_services', $query_services);
        $this->set('infos_user_activity', $infos_user_activity);
        $this->set('list_status_tasks', $list_status_tasks);
        $this->set('list_date_tasks', $list_date_tasks);
        $this->set('styles_page', $styles_page);
        $this->set('business_id', $business_id);

        // TAB 4
        // Month
        if(isset($this->request->query['month_tab_4'])){
            $month_tab_4 = $this->request->query['month_tab_4'];
        }else{
            $month_tab_4 = date_format($date_now, 'm');
        }

        // Year
        if(isset($this->request->query['year_tab_4'])){
            $year_tab_4 = $this->request->query['year_tab_4'];
        }else{
            $year_tab_4 = date_format($date_now, 'Y');
        }

        // Maturity
        if(isset($this->request->query['status_tab_4'])){
            $status_tab_4 = $this->request->query['status_tab_4'];
        }else{
            $status_tab_4 = "all";
        }

        // Todos
        if($status_tab_4 == "all"){

            // Buscar registros
            $query = TableRegistry::get('Extracts');
            $query_extracts = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(date_inicial) =' => $month_tab_4,
                    'YEAR(date_inicial) =' => $year_tab_4
                ])
                ->order(['date ASC']);
        }

        // Todos
        if($status_tab_4 != 'all'){

            // Buscar registros
            $query = TableRegistry::get('Extracts');
            $query_extracts = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(date_inicial) =' => $month_tab_4,
                    'YEAR(date_inicial) =' => $year_tab_4,
                    'status =' => $month_tab_4
                ])
                ->order(['date ASC']);
        }

        $this->set('month_tab_4', $month_tab_4);
        $this->set('year_tab_4', $year_tab_4);
        $this->set('status_tab_4', $status_tab_4);

        $this->set('all_extracts', $query_extracts);
    }

    public function viewBusinessInfos($business_id = null)
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Empresas | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'business');
        $this->set('view_select', 'infos');

        $date_now = Date::now();

        $styles_page = 'padding-left: 70px; padding-right: 0px;padding-top: 70px; padding-bottom: 0px;';

        $user_id = 0;
        $list_status_tasks = [];
        $list_date_tasks = [];
        $name_business = [];
        $infos_user_activity = [];
        $service_business = "";
        $taxation_business = "";
        $x = 0;

        // // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access_business = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ]);

        foreach ($query_access_business as $access_business) {
            $user_id = $access_business->user_id;
        }

        $query = TableRegistry::get('Users');
        $query_users = $query
            ->find()
            ->where([
                'id =' => $user_id
            ]);


        // // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_id
                ]);
  
        foreach ($query_business as $business) {
            $service_business = $business->type;
            $taxation_business = $business->taxation;
            $action_business = $business->action;
        }

        // Buscar registros
        $query = TableRegistry::get('Services');
        $query_services = $query
            ->find()
            ->where([
                'type =' => $service_business,
                'action =' => $action_business
            ]);

        // Buscar registros
        $query = TableRegistry::get('Accountants');
        $query_accountants = $query
                ->find();

        // // // Buscar registros
        $query = TableRegistry::get('Activities');
        $query_activities = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ])
                ->order([
                    'id DESC'
                ]);

        foreach ($query_activities as $activity) {

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users_activity = $query
                    ->find()
                    ->where([
                        'id =' => $activity->user_id
                    ]);

            foreach ($query_users_activity as $user_activity) {
                $infos_user_activity[$activity->id]["permission"] = $user_activity->permission;
                $infos_user_activity[$activity->id]["name"] = $user_activity->name." ".$user_activity->lastname;
            }
        }

        // PAGAMENTOS
        // Buscar registros
        $query = TableRegistry::get('Payments');
        $query_payments = $query
            ->find()
            ->where([
                'business_id =' => $business_id,
                'status =' => 1
            ]);
            
        if(!$query_payments->isEmpty()){
            $status_payment = 'Aguardando pagamento';
        }else{
            $status_payment = 'Pago';
        }

        $this->set('all_accountants', $query_accountants);
        $this->set('all_business', $query_business);
        $this->set('all_users', $query_users);
        $this->set('all_activities', $query_activities);
        $this->set('all_services', $query_services);
        $this->set('infos_user_activity', $infos_user_activity);
        $this->set('list_status_tasks', $list_status_tasks);
        $this->set('list_date_tasks', $list_date_tasks);
        $this->set('styles_page', $styles_page);
        $this->set('business_id', $business_id);
        $this->set('status_payment', $status_payment);
    }

    public function viewBusinessNotes($business_id = null)
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Empresas | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'business');
        $this->set('view_select', 'notes');

        $date_now = Date::now();

        $styles_page = 'padding-left: 70px; padding-right: 0px;padding-top: 70px; padding-bottom: 0px;';

        $user_id = 0;
        $list_status_tasks = [];
        $list_date_tasks = [];
        $name_business = [];
        $infos_user_activity = [];
        $service_business = "";
        $taxation_business = "";
        $x = 0;

        // // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access_business = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ]);

        foreach ($query_access_business as $access_business) {
            $user_id = $access_business->user_id;
        }

        $query = TableRegistry::get('Users');
        $query_users = $query
            ->find()
            ->where([
                'id =' => $user_id
            ]);


        // // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_id
                ]);
  
        foreach ($query_business as $business) {
            $service_business = $business->type;
            $taxation_business = $business->taxation;
            $action_business = $business->action;
        }

        // Buscar registros
        $query = TableRegistry::get('Services');
        $query_services = $query
            ->find()
            ->where([
                'type =' => $service_business,
                'action =' => $action_business
            ]);

        // Buscar registros
        $query = TableRegistry::get('Accountants');
        $query_accountants = $query
                ->find();

        // // // Buscar registros
        $query = TableRegistry::get('Activities');
        $query_activities = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ])
                ->order([
                    'id DESC'
                ]);

        foreach ($query_activities as $activity) {

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users_activity = $query
                    ->find()
                    ->where([
                        'id =' => $activity->user_id
                    ]);

            foreach ($query_users_activity as $user_activity) {
                $infos_user_activity[$activity->id]["permission"] = $user_activity->permission;
                $infos_user_activity[$activity->id]["name"] = $user_activity->name." ".$user_activity->lastname;
            }
        }


        $this->set('all_accountants', $query_accountants);
        $this->set('all_business', $query_business);
        $this->set('all_users', $query_users);
        $this->set('all_activities', $query_activities);
        $this->set('all_services', $query_services);
        $this->set('infos_user_activity', $infos_user_activity);
        $this->set('list_status_tasks', $list_status_tasks);
        $this->set('list_date_tasks', $list_date_tasks);
        $this->set('styles_page', $styles_page);
        $this->set('business_id', $business_id);

        // TAB 3
        // Month
        if(isset($this->request->query['month_tab_3'])){
            $month_tab_3 = $this->request->query['month_tab_3'];
        }else{
            $month_tab_3 = date_format($date_now, 'm');
        }

        // Year
        if(isset($this->request->query['year_tab_3'])){
            $year_tab_3 = $this->request->query['year_tab_3'];
        }else{
            $year_tab_3 = date_format($date_now, 'Y');
        }

        // Maturity
        if(isset($this->request->query['status_tab_3'])){
            $status_tab_3 = $this->request->query['status_tab_3'];
        }else{
            $status_tab_3 = "all";
        }

        
        $date_note = $month_tab_3.'/'.$year_tab_3;

        // Todos
        if($status_tab_3 == "all"){

            $date_note = $month_tab_3.'/'.$year_tab_3;

            // Buscar registros
            $query = TableRegistry::get('Notes');
            $query_notes = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'date =' => $date_note
                ])
                ->order(['date ASC']);
        }

        // Todos
        if($status_tab_3 != 'all'){

            // Buscar registros
            $query = TableRegistry::get('Notes');
            $query_notes = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'date =' => $date_note,
                    'status =' => 1
                ])
                ->order(['date ASC']);
        }

        $this->set('month_tab_3', $month_tab_3);
        $this->set('year_tab_3', $year_tab_3);
        $this->set('status_tab_3', $status_tab_3);

        $this->set('all_notes', $query_notes);

    }

    public function viewBusinessTaxes($business_id = null)
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Empresas | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'business');
        $this->set('view_select', 'taxes');

        $date_now = Date::now();

        $styles_page = 'padding-left: 70px; padding-right: 0px;padding-top: 70px; padding-bottom: 0px;';

        $user_id = 0;
        $list_status_tasks = [];
        $list_date_tasks = [];
        $name_business = [];
        $infos_user_activity = [];
        $service_business = "";
        $taxation_business = "";
        $x = 0;

        // // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access_business = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ]);

        foreach ($query_access_business as $access_business) {
            $user_id = $access_business->user_id;
        }

        $query = TableRegistry::get('Users');
        $query_users = $query
            ->find()
            ->where([
                'id =' => $user_id
            ]);


        // // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_id
                ]);
  
        foreach ($query_business as $business) {
            $service_business = $business->type;
            $taxation_business = $business->taxation;
            $action_business = $business->action;
        }

        // Buscar registros
        $query = TableRegistry::get('Services');
        $query_services = $query
            ->find()
            ->where([
                'type =' => $service_business,
                'action =' => $action_business
            ]);

        // Buscar registros
        $query = TableRegistry::get('Accountants');
        $query_accountants = $query
                ->find();

        // // // Buscar registros
        $query = TableRegistry::get('Activities');
        $query_activities = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ])
                ->order([
                    'id DESC'
                ]);

        foreach ($query_activities as $activity) {

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users_activity = $query
                    ->find()
                    ->where([
                        'id =' => $activity->user_id
                    ]);

            foreach ($query_users_activity as $user_activity) {
                $infos_user_activity[$activity->id]["permission"] = $user_activity->permission;
                $infos_user_activity[$activity->id]["name"] = $user_activity->name." ".$user_activity->lastname;
            }
        }

        $this->set('all_accountants', $query_accountants);
        $this->set('all_business', $query_business);
        $this->set('all_users', $query_users);
        $this->set('all_activities', $query_activities);
        $this->set('all_services', $query_services);
        $this->set('infos_user_activity', $infos_user_activity);
        $this->set('list_status_tasks', $list_status_tasks);
        $this->set('list_date_tasks', $list_date_tasks);
        $this->set('styles_page', $styles_page);
        $this->set('business_id', $business_id);

        // TAB 2
        // Month
        if(isset($this->request->query['month_tab_2'])){
            $month_tab_2 = $this->request->query['month_tab_2'];
        }else{
            $month_tab_2 = date_format($date_now, 'm');
        }

        // Year
        if(isset($this->request->query['year_tab_2'])){
            $year_tab_2 = $this->request->query['year_tab_2'];
        }else{
            $year_tab_2 = date_format($date_now, 'Y');
        }

        // Maturity
        if(isset($this->request->query['status_tab_2'])){
            $status_tab_2 = $this->request->query['status_tab_2'];
        }else{
            $status_tab_2 = "all";
        }

        // Todos
        if($status_tab_2 == "all"){

            // Buscar registros
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(maturity) =' => $month_tab_2,
                    'YEAR(maturity) =' => $year_tab_2
                ])
                ->order(['status ASC', 'maturity ASC']);
        }

        // Todos
        if($status_tab_2 == '0'){

            // Buscar registros
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(maturity) =' => $month_tab_2,
                    'YEAR(maturity) =' => $year_tab_2,
                    'maturity <' => date_format($date_now, 'Y/m/d'),
                    'status =' => '1'
                ])
                ->order(['status ASC', 'maturity ASC']);
        }

        // Todos
        if($status_tab_2 == '1'){

            // Buscar registros
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(maturity) =' => $month_tab_2,
                    'YEAR(maturity) =' => $year_tab_2,
                    'maturity >=' => date_format($date_now, 'Y/m/d'),
                    'status =' => '1'
                ])
                ->order(['status ASC', 'maturity ASC']);
        }

        // Todos
        if($status_tab_2 == '2'){

            // Buscar registros
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(maturity) =' => $month_tab_2,
                    'YEAR(maturity) =' => $year_tab_2,
                    'status =' => '2'
                ])
                ->order(['status ASC', 'maturity ASC']);
        }

        $this->set('month_tab_2', $month_tab_2);
        $this->set('year_tab_2', $year_tab_2);
        $this->set('status_tab_2', $status_tab_2);

        $this->set('all_taxes', $query_taxes);

    }

    public function viewBusinessHistory($business_id = null)
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Abertura e Migração | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'business');
        $this->set('view_select', 'history');

        $date_now = Date::now();

        $styles_page = 'padding-left: 70px; padding-right: 0px;padding-top: 70px; padding-bottom: 0px;';

        $user_id = 0;
        $list_status_tasks = [];
        $list_date_tasks = [];
        $name_business = [];
        $infos_user_activity = [];
        $service_business = "";
        $taxation_business = "";
        $x = 0;

        // // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access_business = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ]);

        foreach ($query_access_business as $access_business) {
            $user_id = $access_business->user_id;
        }

        $query = TableRegistry::get('Users');
        $query_users = $query
            ->find()
            ->where([
                'id =' => $user_id
            ]);


        // // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_id
                ]);
  
        foreach ($query_business as $business) {
            $service_business = $business->type;
            $taxation_business = $business->taxation;
            $action_business = $business->action;
        }

        // Buscar registros
        $query = TableRegistry::get('Services');
        $query_services = $query
            ->find()
            ->where([
                'type =' => $service_business,
                'action =' => $action_business
            ]);

        // Buscar registros
        $query = TableRegistry::get('Accountants');
        $query_accountants = $query
                ->find();

        // // // Buscar registros
        $query = TableRegistry::get('Activities');
        $query_activities = $query
                ->find()
                ->where([
                    'business_id =' => $business_id
                ])
                ->order([
                    'id DESC'
                ]);

        foreach ($query_activities as $activity) {

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users_activity = $query
                    ->find()
                    ->where([
                        'id =' => $activity->user_id
                    ]);

            foreach ($query_users_activity as $user_activity) {
                $infos_user_activity[$activity->id]["permission"] = $user_activity->permission;
                $infos_user_activity[$activity->id]["name"] = $user_activity->name." ".$user_activity->lastname;
            }
        }

        $this->set('all_accountants', $query_accountants);
        $this->set('all_business', $query_business);
        $this->set('all_users', $query_users);
        $this->set('all_activities', $query_activities);
        $this->set('all_services', $query_services);
        $this->set('infos_user_activity', $infos_user_activity);
        $this->set('list_status_tasks', $list_status_tasks);
        $this->set('list_date_tasks', $list_date_tasks);
        $this->set('styles_page', $styles_page);
        $this->set('business_id', $business_id);

        // Buscar registros
        $query = TableRegistry::get('DocumentsAbertura');
        $query_docs_abertura = $query
            ->find();

        // Buscar registros
        $query = TableRegistry::get('DocumentsMigracao');
        $query_docs_migracao = $query
            ->find();

        // Buscar registros
        $query = TableRegistry::get('History');
        $query_history = $query
            ->find()
            ->where([
                'business_id =' => $business_id
            ]);

        // DOCUMENTS SEND
        // Buscar registros
        $query = TableRegistry::get('DocumentsBusiness');
        $query_documents_actions = $query
            ->find()
            ->where([
                'business_id =' => $business_id
            ]);

        $this->set('all_docs_migracao', $query_docs_migracao);
        $this->set('all_docs_abertura', $query_docs_abertura);
        $this->set('all_history', $query_history);
        $this->set('all_documents_actions', $query_documents_actions);

    }

    public function updateStatusBusiness($id = null, $status = null)
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();

            $data_business  = TableRegistry::get('Business');
            $query_business = $data_business 
                ->find()
                ->where([ 'id =' => $id ]);
            foreach($query_business as $business){

                if($business->status == 1 || $business->status == 0){
                    $old_status = "Lead";
                }

                if($business->status == 2){
                    $old_status = "Em abertura";
                }

                if($business->status == 3){
                    $old_status = "Em migração";
                }

                if($business->status == 4){
                    $old_status = "Ativo";
                }

                if($business->status == 5){
                    $old_status = "Bloqueado";
                }

                if($business->status == 6){
                    $old_status = "Cancelado";
                }
            }

            $query = TableRegistry::get('Business');
            $query_notes = $query->query();
            $query_notes->update()
                ->set([
                    'status' => $status
                ])
                ->where(['id' => $id])
                ->execute();

            if($status == 1){
                $new_status = "Lead";
            }

            if($status == 2){
                $new_status = "Em abertura";
            }

            if($status == 3){
                $new_status = "Em migração";
            }

            if($status == 4){
                $new_status = "Ativo";
            }

            if($status == 5){
                $new_status = "Bloqueado";
            }

            if($status == 6){
                $new_status = "Cancelado";
            }

            $activities = TableRegistry::get('Activities');
            $query_activities = $activities->newEntity();
            $query_activities->user_id = $this->Auth->user('id');
            $query_activities->business_id = $id;
            $query_activities->title = 'Status anterior: '.$old_status.'. Status atualizado: '.$new_status;
            $query_activities->link = '/accountant/business/'.$id.'/view';
            $query_activities->type = 'Atualização do status da empresa';
            $query_activities->created = $date_now;
            $activities->save($query_activities);


            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    public function tasks()
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Minhas obrigações | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'tasks');

        $date_now = Date::now();

        $styles_page = 'padding-left: 70px; padding-right: 0px;padding-top: 70px; padding-bottom: 0px;';

        $user_id = 0;
        $list_status_tasks = [];
        $list_date_tasks = [];
        $name_business = [];
        $infos_user_activity = [];
        $service_business = "";
        $taxation_business = "";
        $x = 0;

        if($this->Auth->user('permission') == 4){ $accountant_area = 'fiscal'; }
        if($this->Auth->user('permission') == 5){ $accountant_area = 'pessoal'; }
        if($this->Auth->user('permission') == 6){ $accountant_area = 'financeiro'; }
        if($this->Auth->user('permission') == 7){ $accountant_area = 'contabil'; }
        if($this->Auth->user('permission') == 8){ $accountant_area = 'cadastro'; }
        if($this->Auth->user('permission') == 9){ $accountant_area = 'administrativo'; }
        if($this->Auth->user('permission') == 10){ $accountant_area = 'legalizacao'; }
        if($this->Auth->user('permission') == 11){ $accountant_area = 'atendimento'; }
        if($this->Auth->user('permission') == 12){ $accountant_area = 'treinamento'; }
        if($this->Auth->user('permission') == 13){ $accountant_area = 'comercial'; }
        if($this->Auth->user('permission') == 14){ $accountant_area = 'marketing'; }

        // // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([ 'status =' => 2 ])
                ->OrWhere([ 'status =' => 3 ])
                ->OrWhere([ 'status =' => 4 ]);
  
        // foreach ($query_business as $business) {
        //     $service_business = $business->type;
        //     $taxation_business = $business->taxation;
        //     $action_business = $business->action;
        // }

        // Buscar registros
        $query = TableRegistry::get('Tasks');
        $query_all_tasks = $query
            ->find()
            ->where([
                'accountant_id =' => $this->Auth->user('id')
            ]);

        foreach ($query_all_tasks as $task) {
            $list_status_tasks[$task->task_fixed_id] = $task->status;
            $list_date_tasks[$task->task_fixed_id][date_format($task->updated, 'Ymd')] = 'ok';
        }  

        // Buscar registros
        $query = TableRegistry::get('TasksFixed');
        $query_all_tasks_fixed = $query
            ->find()
            ->where([
                'area =' => $accountant_area,
                'notification_type =' => 'all'
            ])
            ->OrWhere([
                'area =' => $accountant_area,
                'notification_type =' => 'accountant'
            ])
            ->order([
                'id ASC'
            ]);

        $this->set('all_business', $query_business);
        $this->set('all_tasks', $query_all_tasks);
        $this->set('all_tasks_fixed', $query_all_tasks_fixed);
        $this->set('list_status_tasks', $list_status_tasks);
        $this->set('list_date_tasks', $list_date_tasks);
        $this->set('styles_page', $styles_page);
    }

    public function crm()
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Meu CRM | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'crm');
    }

    public function invoices()
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Faturas | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'invoices');
    }

    public function account()
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Minha conta | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'account');
    }

    public function support()
    {
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Suporte | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'support');
    }

    public function tickets()
    {
        // Configura Layout da View
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Chamados | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'tickets');

        // Lista Franchises
        $tickets = TableRegistry::get('Tickets');
        $list_tickets = $tickets
                ->find()
                ->order(['created DESC']);

        $this->set('list_tickets', $list_tickets);
    }

    public function addTicket()
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();

            // Cria nova Quotations
            $query_note = TableRegistry::get('Tickets');
            $query_notes = $query_note->newEntity();
            $query_notes->user_id = $this->Auth->user('id');
            $query_notes->subject = $this->request->data['subject'];
            $query_notes->text = $this->request->data['text'];
            $query_notes->created = $date_now;
            $query_notes->status = 1;
            $query_note->save($query_notes);  

            if(!empty($_FILES['document_file'])){
                
                // Upload document
                $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/documents/';
                $ext = explode(".", $_FILES['document_file']['name']);
                $ext = end($ext);

                $url_document = $this->Auth->user('id').".".$ext;

                $uploadfile = $uploaddir.($url_document);
                move_uploaded_file($_FILES['document_file']['tmp_name'], $uploadfile);

                $doc = TableRegistry::get('TicketsDocuments');
                $docs = $doc->newEntity();
                $docs->user_id = $this->Auth->user('id');
                $docs->ticket_id = $query_notes->id;
                $docs->comment_id = 0;
                $docs->url = $url_document;
                $docs->created = $date_now;
                $docs->status = 1;
                $doc->save($docs);  
            }

            // Envia e-mail de Confirmação de e-mail
            $email = new Email();
            $email->viewVars(['id' => $query_notes->id]);
            $email->viewVars(['name' => $this->Auth->user('name')]);
            $email->viewVars(['email' => $this->Auth->user('username')]);
            $email->viewVars(['message' => $this->request->data['text']]);
            $email->viewVars(['date' => $date_now]);
            $email->template('chamado')
            ->subject('Abertura de chamado')
            ->emailFormat('html')
            // ->to('liliantobace@yahoo.com.br')
            ->to('contato@linkcontabilidade.com.br')
            ->from('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->send();
        }

        return $this->redirect('/accountant/tickets');
    }

    public function viewTicket($ticket_id = null)
    {
        // Configura Layout da View
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Chamados | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'tickets');

        $comment_names = [];
        $comment_permission = [];

        // Lista Franchises
        $tickets = TableRegistry::get('Tickets');
        $list_tickets = $tickets
                ->find()
                ->where(['id' => $ticket_id]);

        foreach ($list_tickets as $ticket) {

            // Lista Franchises
            $user_ticket = TableRegistry::get('Users');
            $list_user_ticket = $user_ticket
                    ->find()
                    ->where([
                        'id' => $ticket->user_id
                    ]);

            foreach ($list_user_ticket as $user_active) {
                $name_user = $user_active->name." ".$user_active->lastname;
                $email_user = $user_active->username;
                $phone_user = $user_active->phone;
            }

            // Lista Comment
            $comments = TableRegistry::get('TicketsComments');
            $list_comments = $comments
                    ->find()
                    ->where([
                        'ticket_id' => $ticket_id
                    ])
                    ->order(['created DESC']);

            foreach ($list_comments as $comment) {

                if($comment->user_id == 0){
                    $comment_names[$comment->id] = "Link";
                }else{

                    // Lista Franchises
                    $users = TableRegistry::get('Users');
                    $list_users = $users
                            ->find()
                            ->where([
                                'id' => $comment->user_id
                            ]);

                    foreach ($list_users as $user) {
                        $comment_names[$comment->id] = $user->name." ".$user->lastname;
                        $comment_permission[$comment->id] = $user->permission;
                    }
                }
            }
        }

        // Lista Franchises
        $documents = TableRegistry::get('TicketsDocuments');
        $list_documents = $documents
                ->find()
                ->where([
                    'user_id' => $ticket->user_id
                ]);

        $this->set('list_documents', $list_documents);
        $this->set('comment_names', $comment_names);
        $this->set('comment_permission', $comment_permission);
        $this->set('data_tickets', $list_tickets);
        $this->set('data_comments', $list_comments);
        $this->set('name_user', $name_user);
        $this->set('email_user', $email_user);
        $this->set('phone_user', $phone_user);
    }
    
    public function addCommentTicket()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Lista Franchises
            $tickets = TableRegistry::get('Tickets');
            $list_tickets = $tickets
                    ->find()
                    ->where(['id' => $this->request->data['ticket_id']]);

            foreach ($list_tickets as $ticket) {

                // Lista Franchises
                $user_ticket = TableRegistry::get('Users');
                $list_user_ticket = $user_ticket
                        ->find()
                        ->where([
                            'id' => $ticket->user_id
                        ]);

                foreach ($list_user_ticket as $user_active) {
                    $email_user = $user_active->username;
                }
            }

            // Cria produto
            $comments = TableRegistry::get('ticketsComments');
            $comment = $comments->newEntity();
            $comment->user_id = $this->Auth->user('id');
            $comment->ticket_id = $this->request->data['ticket_id'];
            $comment->text = $this->request->data['text'];
            $comment->created = $date_now;
            $comments->save($comment);

            if(!empty($_FILES['document_file']['name'])){

                $ext = end((explode(".", $_FILES['document_file']['name'])));
                $image_url = $this->request->data['ticket_id']."_".$comment->id.".".$ext;

                $uploadfile =  $_SERVER['DOCUMENT_ROOT'] . '/img/uploads/'.$image_url;

                move_uploaded_file($_FILES['document_file']['tmp_name'], $uploadfile);

                // Cria produto
                $documents = TableRegistry::get('TicketsDocuments');
                $document = $documents->newEntity();
                $document->user_id = $this->Auth->user('id');
                $document->ticket_id = $this->request->data['ticket_id'];
                $document->comment_id = $comment->id;
                $document->url = $image_url;
                $document->created = $date_now;
                $document->status = 1;
                $documents->save($document);
            }

            $date_ticket = date_format($date_now, 'd/m/Y H:m:s');

            // Envia e-mail para contato
            $email = new Email();
            $email->ViewVars(['name' => "Link Contabilidade"]);
            $email->ViewVars(['email' => "contato@linkcontabilidade.com.br"]);
            $email->ViewVars(['message' => $this->request->data['text']]);
            $email->ViewVars(['date' => $date_ticket]);
            $email->ViewVars(['id' => $id_ticket = $comment->id]);
            $email->Template('chamado_response')
            ->Subject('Link Contabilidade acabou de responder o seu chamado!')
            ->EmailFormat('html')
            // ->To($email_user)
            // ->From('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->To('webmaster@oceaning.com.br')
            ->From('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->send();

            $email = new Email();
            $email->ViewVars(['name' => "Link Contabilidade"]);
            $email->ViewVars(['email' => "contato@linkcontabilidade.com.br"]);
            $email->ViewVars(['message' => $this->request->data['text']]);
            $email->ViewVars(['date' => $date_ticket]);
            $email->ViewVars(['id' => $id_ticket = $comment->id]);
            $email->Template('chamado_response')
            ->Subject('#'.$this->request->data['ticket_id'].' - '.'chamado respondido pela Link Contabilidade!')
            ->EmailFormat('html')
            // ->To('contato@linkcontabilidade.com.br')
            // ->From('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->To('webmaster@oceaning.com.br')
            ->From('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->send();


            $result = array(
                'status' => 'ok'
            );

        }else{

            $result = array(
                'status' => 'error'
            );
        }

        $this->set(compact('result'));
    }

    public function closeTicket($ticket_id = null)
    {

        $date_now = Time::now();

        if ($this->request->is('post')) {

            $query = TableRegistry::get('Tickets');
            $query_itens = $query->query();
            $query_itens->update()
                ->set([
                    'status' => 0
                ])
                ->where(['id' => $ticket_id])
                ->execute();


            // Lista Franchises
            $tickets = TableRegistry::get('Tickets');
            $list_tickets = $tickets
                    ->find()
                    ->where(['id' => $ticket_id]);

            foreach ($list_tickets as $ticket) {

                $assunto = $ticket->text;

                // Lista Franchises
                $user_ticket = TableRegistry::get('Users');
                $list_user_ticket = $user_ticket
                        ->find()
                        ->where([
                            'id' => $ticket->user_id
                        ]);

                foreach ($list_user_ticket as $user_active) {
                    $email_user = $user_active->username;
                    $name_user = $user_active->name;
                }
            }

            $email = new Email();
            $email->ViewVars(['name' => $name_user]);
            $email->ViewVars(['email' => $email_user]);
            $email->ViewVars(['message' => $assunto]);
            $email->ViewVars(['date' => $date_now]);
            $email->ViewVars(['id' => $ticket_id]);
            $email->Template('close_chamado')
            ->Subject('#'.$ticket_id.' - '.'chamado fechado pela Link Contabilidade!')
            ->EmailFormat('html')
            // ->To('contato@linkcontabilidade.com.br')
            // ->From('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->To('webmaster@oceaning.com.br')
            ->From('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->send();


            $result = array(
                'status' => 'ok',
                'redirect' => 'tickets'
            );

        }else{

            $result = array(
                'status' => 'error'
            );
        }

        $this->set(compact('result'));
    }

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function findBusiness()
    {
        if ($this->request->is('post')) {

            $query = $this->request->data['query'];

            // 01234567890123
            // 39101740865
            // 46548498798456

            $query = str_replace(".", "", $query);
            $query = str_replace("/", "", $query);
            $query = str_replace("-", "", $query);

            // FANTASIA
            $query_fantasia = $query;

            // CNPJ
            if(strlen($query) < 3){
                $query_cnpj = substr($query, 0, 2);
            }

            if(strlen($query) > 2 && strlen($query) < 6){
                $query_cnpj = substr($query, 0, 2).".".substr($query, 2, 3);
            }

            if(strlen($query) > 5 && strlen($query) < 9){
                $query_cnpj = substr($query, 0, 2).".".substr($query, 2, 3).".".substr($query, 5, 3);
            }

            if(strlen($query) > 8 && strlen($query) < 13){
                $query_cnpj = substr($query, 0, 2).".".substr($query, 2, 3).".".substr($query, 5, 3)."/".substr($query, 8, 4);
            }

            if(strlen($query) > 12){
                $query_cnpj = substr($query, 0, 2).".".substr($query, 2, 3).".".substr($query, 5, 3)."/".substr($query, 8, 4)."-".substr($query, 12, 2);
            }

            // CPF
            if(strlen($query) < 4){
                $query_cpf = substr($query, 0, 3);
            }

            if(strlen($query) > 3 && strlen($query) < 7){
                $query_cpf = substr($query, 0, 3).".".substr($query, 3, 3);
            }

            if(strlen($query) > 6 && strlen($query) < 10){
                $query_cpf = substr($query, 0, 3).".".substr($query, 3, 3).".".substr($query, 6, 3);
            }

            if(strlen($query) > 9){
                $query_cpf = substr($query, 0, 3).".".substr($query, 3, 3).".".substr($query, 6, 3)."-".substr($query, 9, 2);
            }

            // Busca cliente existente
            $clients = TableRegistry::get('Business');
            $query_business = $clients
                    ->find()
                    ->where(['fantasia LIKE' => '%'.$query_fantasia.'%'])
                    ->orWhere(['cnpj LIKE' => '%'.$query_cnpj.'%'])
                    ->orWhere(['cpf LIKE' => '%'.$query_cpf.'%']);

            $result = array(
                'status' => 'ok',
                'business' => $query_business
            );

            $this->set(compact('result'));

        }
    }

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function tasksAdd()
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();

            if($this->request->data['group_type'] == "none"){
                $date_maturity = $this->request->data['maturity'];
                $date_maturity =  substr($date_maturity,6 ,4)."-".substr($date_maturity,3 ,2)."-".substr($date_maturity,0 ,2)." 00:00";
                $date_month = 0;
                $date_week = "";
                $date_day = "";
            }

            if($this->request->data['group_type'] == "diary"){
                $date_maturity = "";
                $date_month = 0;
                $date_week = "";
                $date_day = "";
            }

            if($this->request->data['group_type'] == "week"){
                $date_maturity = "";
                $date_month = 0;
                $date_week = $this->request->data['week'];
                $date_day = "";
            }
            
            if($this->request->data['group_type'] == "month"){
                $date_maturity = "";
                $date_month = 0;
                $date_week = "";
                $date_day = $this->request->data['day'];
            }

            if($this->request->data['group_type'] == "yearly"){
                $date_maturity = "";
                $date_month = $this->request->data['yearly_month'];
                $date_week = "";
                $date_day = $this->request->data['yearly_day'];
            }

            // Cria nova Quotations
            $query = TableRegistry::get('TasksFixed');
            $tasks = $query->newEntity();
            $tasks->accountant_id = $this->Auth->user('id');
            $tasks->business_id = $this->request->data['business_id'];
            $tasks->group_id = $this->request->data['group_id'];
            $tasks->title = $this->request->data['title'];
            $tasks->description = $this->request->data['description'];
            $tasks->type = $this->request->data['group_type'];
            $tasks->maturity = $date_maturity;
            $tasks->month = $date_month;
            $tasks->week = $date_week;
            $tasks->day = $date_day;
            $tasks->status = 1;
            $tasks->created = $date_now;
            $query->save($tasks);

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function tasksClose($business_id = null, $task_fixed_id = null, $task_date = null)
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();
            $task_date = substr($task_date, 0, 4)."-".substr($task_date, 4, 2)."-".substr($task_date, 6, 2);
            $task_date = date('Y-m-d', strtotime($task_date. ' + 0 days'));

            // Buscar registros
            $query = TableRegistry::get('Tasks');
            $query_all_tasks = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'task_fixed_id =' => $task_fixed_id,
                    'updated' => $task_date
                ]);

            if($query_all_tasks->isEmpty()){

                // Cria nova Quotations
                $query = TableRegistry::get('Tasks');
                $tasks = $query->newEntity();
                $tasks->accountant_id = $this->Auth->user('id');
                $tasks->business_id = $business_id;
                $tasks->task_fixed_id = $task_fixed_id;
                $tasks->status = 1;
                $tasks->updated = $task_date;
                $query->save($tasks);

            }else{

                // Atualiza Quotation
                $query = TableRegistry::get('Tasks');
                $query_tasks = $query->query();
                $query_tasks->update()
                    ->set([
                        'status' => 1,
                        'updated' => $task_date
                    ])
                    ->where([
                        'business_id =' => $business_id,
                        'task_fixed_id =' => $task_fixed_id
                    ])
                    ->execute();
            }

            $result = array(
                'status' => 'ok'
                // 'status' => $task_date
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function tasksOpen($business_id = null, $task_id = null)
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();

            // Atualiza Quotation
            $query = TableRegistry::get('Tasks');
            $query_tasks = $query->query();
            $query_tasks->update()
                ->set([
                    'status' => 0
                ])
                ->where([
                    'id =' => $task_id
                ])
                ->execute();

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function tasksView($task_id = null)
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();
            $status_task = 0;
            $id_task = 0;

            // Buscar registros
            $query_fixed = TableRegistry::get('TasksFixed');
            $query_all_tasks_fixed = $query_fixed
                ->find()
                ->where([
                    'id =' => $task_id
                ]);

            foreach ($query_all_tasks_fixed as $task_fixed) {

                $title = $task_fixed->title;
                $description = $task_fixed->description;
                $maturity = $task_fixed->maturity;
                $type = $task_fixed->type;
                $week = $task_fixed->week;
                $month = $task_fixed->month;
                $day = $task_fixed->day;
            }

            // Buscar registros
            $query = TableRegistry::get('Tasks');
            $query_all_tasks = $query
                ->find()
                ->where([
                    'task_fixed_id =' => $task_id
                ]);

            foreach ($query_all_tasks as $task) {
                $id_task = $task->id;
                $status_task = $task->status;
            }

            $result = array(
                'status' => 'ok',
                'status_task' => $status_task,
                'id_task' => $id_task,
                'title' => $title,
                'description' => $description,
                'maturity' => $maturity,
                'type' => $type,
                'week' => $week,
                'month' => $month,
                'day' => $day
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function tasksAddGroup()
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();

            // Cria nova Quotations
            $query = TableRegistry::get('GroupTasks');
            $tasks = $query->newEntity();
            $tasks->accountant_id = $this->Auth->user('id');
            $tasks->business_id = $this->request->data['business_id'];
            $tasks->title = $this->request->data['title'];
            $tasks->description = $this->request->data['description'];
            $tasks->type = $this->request->data['type'];
            $tasks->area = $this->request->data['area'];
            $tasks->status = 1;
            $tasks->created = $date_now;
            $query->save($tasks);

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function taxesAdd()
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();

            $date_maturity = $this->request->data['maturity'];
            $date_maturity =  substr($date_maturity,6 ,4)."-".substr($date_maturity,3 ,2)."-".substr($date_maturity,0 ,2)." 00:00";

            $business_active = $this->request->data['business_id'];
            $total = str_replace(".", "", $this->request->data['total']);

            // Cria nova Quotations
            $query = TableRegistry::get('Taxes');
            $taxes = $query->newEntity();
            $taxes->business_id = $this->request->data['business_id'];
            $taxes->title = $this->request->data['title'];
            $taxes->description = $this->request->data['description'];
            $taxes->total = $total;
            $taxes->maturity = $date_maturity;
            $taxes->url = '';
            $taxes->status = 1;
            $taxes->created = $date_now;
            $query->save($taxes);

            if(!empty($_FILES['file_taxe']['name'])){

                // Upload document
                $uploaddir =  $_SERVER['DOCUMENT_ROOT'] . '/uploads/taxes/';
                $ext = explode(".", $_FILES['file_taxe']['name']);
                $ext = end($ext);

                $url_document = $business_active."_".$taxes->id.".".$ext;

                $uploadfile = $uploaddir.($url_document);
                move_uploaded_file($_FILES['file_taxe']['tmp_name'], $uploadfile);

                // Atualiza Quotation
                $query = TableRegistry::get('Taxes');
                $query_taxes = $query->query();
                $query_taxes->update()
                    ->set([
                        'url' => $url_document
                    ])
                    ->where(['id' => $taxes->id])
                    ->execute();
            }

            $activities = TableRegistry::get('Activities');
            $query_activities = $activities->newEntity();
            $query_activities->user_id = $this->Auth->user('id');
            $query_activities->business_id = $this->request->data['business_id'];
            $query_activities->title = 'ID do imposto: '.$taxes->id.'. Título: '.$this->request->data['title'];
            $query_activities->link = '/accountant/business/'.$this->request->data['business_id'].'/view?tab_select=2';
            $query_activities->type = 'Adicionou um novo imposto para pagar.';
            $query_activities->created = $date_now;
            $activities->save($query_activities);


            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function documentsAdd()
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();

            for ($i=0; $i < count($_POST); $i++) {

                if(isset($this->request->data['title-'.$i])){

                    $date_document = $this->request->data['date-'.$i];
                    $date_document =  substr($date_document,6 ,4)."-".substr($date_document,3 ,2)."-".substr($date_document,0 ,2)." 00:00";

                    $business_active = $this->request->data['business_id-'.$i];

                    // Cria nova Quotations
                    $query = TableRegistry::get('Documents');
                    $documents = $query->newEntity();
                    $documents->business_id = $this->request->data['business_id-'.$i];
                    $documents->title = $this->request->data['title-'.$i];
                    $documents->description = $this->request->data['description-'.$i];
                    $documents->date = $date_document;
                    $documents->url = '';
                    $documents->type = $this->request->data['type-doc-'.$i];
                    $documents->status = 1;
                    $documents->origin = 'accountant';
                    $documents->created = $date_now;
                    $query->save($documents);

                    if(!empty($_FILES['file-document-'.$i]['name'])){

                        // Upload document
                        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/documents/';
                        $ext = explode(".", $_FILES['file-document-'.$i]['name']);
                        $ext = end($ext);

                        $url_document = $business_active."_".$documents->id.".".$ext;

                        $uploadfile = $uploaddir.($url_document);
                        move_uploaded_file($_FILES['file-document-'.$i]['tmp_name'], $uploadfile);

                        // Atualiza Quotation
                        $query = TableRegistry::get('Documents');
                        $query_documents = $query->query();
                        $query_documents->update()
                            ->set([
                                'url' => $url_document
                            ])
                            ->where(['id' => $documents->id])
                            ->execute();
                    }

                    $activities = TableRegistry::get('Activities');
                    $query_activities = $activities->newEntity();
                    $query_activities->user_id = $this->Auth->user('id');
                    $query_activities->business_id = $business_active;
                    $query_activities->title = 'ID: '.$documents->id.'. Título: '.$this->request->data['title-'.$i];
                    $query_activities->link = '/accountant/business/'.$business_active.'/view?tab_select=5';
                    $query_activities->type = 'Adicionou um novo documento.';
                    $query_activities->created = $date_now;
                    $activities->save($query_activities);

                     // EMAIL
                     // Buscar registros
                    $query = TableRegistry::get('AccessBusiness');
                    $query_access = $query
                            ->find()
                            ->where([
                                'business_id =' => $business_active
                            ]);

                    foreach ($query_access as $access) {
                        $user_active = $access->user_id;
                    }

                    // Buscar registros
                    $query = TableRegistry::get('Users');
                    $query_user = $query
                            ->find()
                            ->where([
                                'id =' => $user_active
                            ]);

                    foreach ($query_user as $user) {
                        $user_email = $user->username;
                    }

                    // Envia e-mail de seja bem vindo
                    $email = new Email();
                    $email->viewVars(['title' => 'Link Contabilidade enviou um documento']);
                    $email->viewVars(['subtitle' => 'Você recebeu um novo documento']);
                    $email->viewVars(['text' => 'A Link Contabilidade acabou de realizar o upload de um documento na plataforma.']);
                    $email->template('action')
                    ->subject('Link Contabilidade adicionou um documento')
                    ->emailFormat('html')
                    ->to($user_email)
                    ->from('contato@linkcontabilidade.com.br', 'Link Contabilidade')
                    ->send();
                }
            }

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function historyAdd()
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();

            if(isset($this->request->data['title'])){

                $date_document = $this->request->data['date'];
                $date_document =  substr($date_document,6 ,4)."-".substr($date_document,3 ,2)."-".substr($date_document,0 ,2)." 00:00";

                $business_active = $this->request->data['business_id'];

                // Cria nova Quotations
                $query = TableRegistry::get('History');
                $history = $query->newEntity();
                $history->business_id = $this->request->data['business_id'];
                $history->title = $this->request->data['title'];
                $history->created = $date_document;
                $query->save($history);

                $activities = TableRegistry::get('Activities');
                $query_activities = $activities->newEntity();
                $query_activities->user_id = $this->Auth->user('id');
                $query_activities->business_id = $business_active;
                $query_activities->title = $this->request->data['title'];
                $query_activities->link = '';
                $query_activities->type = '';
                $query_activities->created = $date_document;
                $activities->save($query_activities);

                // EMAIL
                // Buscar registros
                $query = TableRegistry::get('AccessBusiness');
                $query_access = $query
                        ->find()
                        ->where([
                            'business_id =' => $business_active
                        ]);

                foreach ($query_access as $access) {
                    $user_active = $access->user_id;
                }

                // Buscar registros
                $query = TableRegistry::get('Users');
                $query_user = $query
                        ->find()
                        ->where([
                            'id =' => $user_active
                        ]);

                foreach ($query_user as $user) {
                    $user_email = $user->username;
                }

                // Envia e-mail de seja bem vindo
                $email = new Email();
                $email->viewVars(['title' => 'Link Contabilidade enviou um documento']);
                $email->viewVars(['subtitle' => 'Você recebeu um novo documento']);
                $email->viewVars(['text' => 'A Link Contabilidade acabou de realizar o upload de um documento na plataforma.']);
                $email->template('action')
                ->subject('Link Contabilidade adicionou um documento')
                ->emailFormat('html')
                ->to($user_email)
                ->from('contato@linkcontabilidade.com.br', 'Link Contabilidade')
                ->send();
            }

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function activityAdd()
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();

            if(isset($this->request->data['title'])){

                $date_document = $this->request->data['date'];
                $date_document =  substr($date_document,6 ,4)."-".substr($date_document,3 ,2)."-".substr($date_document,0 ,2)." 00:00";

                $business_active = $this->request->data['business_id'];

                $activities = TableRegistry::get('Activities');
                $query_activities = $activities->newEntity();
                $query_activities->user_id = $this->Auth->user('id');
                $query_activities->business_id = $business_active;
                $query_activities->title = $this->request->data['title'];
                $query_activities->link = '';
                $query_activities->type = '';
                $query_activities->created = $date_document;
                $activities->save($query_activities);

                // EMAIL
                // Buscar registros
                $query = TableRegistry::get('AccessBusiness');
                $query_access = $query
                        ->find()
                        ->where([
                            'business_id =' => $business_active
                        ]);

                foreach ($query_access as $access) {
                    $user_active = $access->user_id;
                }

                // Buscar registros
                $query = TableRegistry::get('Users');
                $query_user = $query
                        ->find()
                        ->where([
                            'id =' => $user_active
                        ]);

                foreach ($query_user as $user) {
                    $user_email = $user->username;
                }

                // Envia e-mail de seja bem vindo
                $email = new Email();
                $email->viewVars(['title' => 'Link Contabilidade enviou um documento']);
                $email->viewVars(['subtitle' => 'Você recebeu um novo documento']);
                $email->viewVars(['text' => 'A Link Contabilidade acabou de realizar o upload de um documento na plataforma.']);
                $email->template('action')
                ->subject('Link Contabilidade adicionou um documento')
                ->emailFormat('html')
                ->to($user_email)
                ->from('contato@linkcontabilidade.com.br', 'Link Contabilidade')
                ->send();
            }

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // UPDATE
    // updateStatusTaxe
    public function tasksUpdateStatus($task_id = null, $status = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('Tasks');
            $query_tasks = $query->query();
            $query_tasks->update()
                ->set([
                    'status' => $status
                ])
                ->where(['id' => $task_id])
                ->execute();

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // UPDATE
    // updateStatusTaxe
    public function tasksDelete($task_id = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('Tasks');
            $query_tasks = $query->query();
            $query_tasks->delete()
                ->where(['id' => $task_id])
                ->execute();

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // UPDATE
    // updateStatusTaxe
    public function tasksDeleteFixed($task_id = null)
    {
        if ($this->request->is('post')) {

            // Buscar registros
            $query = TableRegistry::get('Tasks');
            $query_all_tasks = $query
                ->find()
                ->where([
                    'task_fixed_id =' => $task_id
                ]);

            foreach ($query_all_tasks as $task) {

                // Atualiza Quotation
                $query = TableRegistry::get('Tasks');
                $query_tasks = $query->query();
                $query_tasks->delete()
                    ->where(['id' => $task->id])
                    ->execute();
            }

            // Atualiza Quotation
            $query = TableRegistry::get('TasksFixed');
            $query_tasks = $query->query();
            $query_tasks->delete()
                ->where(['id' => $task_id])
                ->execute();

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // updateStatusTaxe
    public function taxesDelete($taxe_id = null)
    {
        if ($this->request->is('post')) {

            // Buscar registros
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query
                ->find()
                ->where([
                    'id =' => $taxe_id
                ]);

            foreach ($query_taxes as $taxe) {

                // Delete file
                unlink( $_SERVER['DOCUMENT_ROOT'] . '/uploads/taxes/'.$taxe->url);
            }

            // Atualiza Quotation
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query->query();
            $query_taxes->delete()
                ->where(['id' => $taxe_id])
                ->execute();

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // updateStatusTaxe
    public function documentsDelete($document_id = null)
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();
            // Buscar registros
            $query = TableRegistry::get('Documents');
            $query_documents = $query
                ->find()
                ->where([
                    'id =' => $document_id
                ]);

            foreach ($query_documents as $document) {
                $business_active = $document->business_id;
                $title = $document->title;
                if($document->url !== "" && $document->url !== NULL){
                    // Delete file
                    unlink($_SERVER['DOCUMENT_ROOT'] . '/uploads/documents/'.$document->url);
                }
            }

            // Atualiza Quotation
            $query = TableRegistry::get('Documents');
            $query_documents = $query->query();
            $query_documents->delete()
                ->where(['id' => $document_id])
                ->execute();


            $activities = TableRegistry::get('Activities');
            $query_activities = $activities->newEntity();
            $query_activities->user_id = $this->Auth->user('id');
            $query_activities->business_id = $business_active;
            $query_activities->title = 'ID: '.$document_id.'. Título: '.$title;
            $query_activities->link = '/accountant/business/'.$business_active.'/view?tab_select=5';
            $query_activities->type = 'Deletou um documento.';
            $query_activities->created = $date_now;
            $activities->save($query_activities);

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    public function reports()
    {

        // Limite de memória
        ini_set('memory_limit', '256M');
        set_time_limit(0);

        // Configura Layout da View
        $this->viewBuilder()->layout('accountant');
        $this->set('title', 'Obrigações | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'tasks');

        $contracts = TableRegistry::get('Business');
            
        // Busca Contracts
        $query_contracts = $contracts->find();

        // Report Geral
        $report_total_faturamento = 0;
        $report_total_clients = 0;
        $report_total_ticket = 0;
        $faturamento = 0;

        // Report Period
        $date_now = Date::now();
        $date_now = date('Y-m', strtotime("-36 months", strtotime($date_now)));

        $report_period = [];

        for ($i=0; $i < 62; $i++) {
            $total_faturamento[$i]['faturamento'] = 0;
        }

        for ($i=0; $i < 37; $i++) {
            $report_period[$i]['date'] = date('Y-m', strtotime("+".$i." months", strtotime($date_now)));
            $report_period[$i]['count'] = 0;
            $report_period[$i]['preenchimento'] = 0;
            $report_period[$i]['pendente'] = 0;
            $report_period[$i]['andamento'] = 0;
            $report_period[$i]['concluido'] = 0;
            $report_period[$i]['cancelado'] = 0;
            $report_period[$i]['excluido'] = 0;
            $report_period[$i]['protesto'] = 0;
            $report_period[$i]['phase'] = 0;
            $report_period[$i]['rescisao'] = 0;
        }

        // Report Status
        $report_status[1]['mensalidade'] = 0;
        $report_status[1]['quantidade'] = 0;
        $report_status[2]['mensalidade'] = 0;
        $report_status[2]['quantidade'] = 0;
        $report_status[3]['mensalidade'] = 0;
        $report_status[3]['quantidade'] = 0;
        $report_status[4]['mensalidade'] = 0;
        $report_status[4]['quantidade'] = 0;
        $report_status[5]['mensalidade'] = 0;
        $report_status[5]['quantidade'] = 0;
        $report_status[6]['mensalidade'] = 0;
        $report_status[6]['quantidade'] = 0;
        $report_status[7]['mensalidade'] = 0;
        $report_status[7]['quantidade'] = 0;
        $report_status[8]['mensalidade'] = 0;
        $report_status[8]['quantidade'] = 0;
        $report_status[9]['mensalidade'] = 0;
        $report_status[9]['quantidade'] = 0;
        $report_status[10]['mensalidade'] = 0;
        $report_status[10]['quantidade'] = 0;

        // Report Faturamento
        $report_faturamento_clients = 0;

        // Report Tipo
        $report_type['mei']['total'] = 0;
        $report_type['mei']['faturamento'] = 0;
        $report_type['industria']['total'] = 0;
        $report_type['industria']['faturamento'] = 0;
        $report_type['ss'] = 0;
        $report_type['sl'] = 0;
        $report_type['s']['faturamento'] = 0;
        $report_type['cs'] = 0;
        $report_type['cl'] = 0;
        $report_type['c']['faturamento'] = 0;
        $report_type['scs'] = 0;
        $report_type['scl'] = 0;
        $report_type['sc']['faturamento'] = 0;
        $report_type['autonomo']['total'] = 0;
        $report_type['autonomo']['faturamento'] = 0;
        $report_type['empregado']['total'] = 0;
        $report_type['empregado']['faturamento'] = 0;
        $report_type['total'] = 0;

        // Report States
        $report_states['SP']['total'] = 0;
        $report_states['SP']['faturamento'] = 0;
        $report_states['AC']['total'] = 0;
        $report_states['AC']['faturamento'] = 0;
        $report_states['AL']['total'] = 0;
        $report_states['AL']['faturamento'] = 0;
        $report_states['AP']['total'] = 0;
        $report_states['AP']['faturamento'] = 0;
        $report_states['AM']['total'] = 0;
        $report_states['AM']['faturamento'] = 0;
        $report_states['BA']['total'] = 0;
        $report_states['BA']['faturamento'] = 0;
        $report_states['CE']['total'] = 0;
        $report_states['CE']['faturamento'] = 0;
        $report_states['DF']['total'] = 0;
        $report_states['DF']['faturamento'] = 0;
        $report_states['ES']['total'] = 0;
        $report_states['ES']['faturamento'] = 0;
        $report_states['GO']['total'] = 0;
        $report_states['GO']['faturamento'] = 0;
        $report_states['MA']['total'] = 0;
        $report_states['MA']['faturamento'] = 0;
        $report_states['MT']['total'] = 0;
        $report_states['MT']['faturamento'] = 0;
        $report_states['MS']['total'] = 0;
        $report_states['MS']['faturamento'] = 0;
        $report_states['MG']['total'] = 0;
        $report_states['MG']['faturamento'] = 0;
        $report_states['PA']['total'] = 0;
        $report_states['PA']['faturamento'] = 0;
        $report_states['PB']['total'] = 0;
        $report_states['PB']['faturamento'] = 0;
        $report_states['PR']['total'] = 0;
        $report_states['PR']['faturamento'] = 0;
        $report_states['PE']['total'] = 0;
        $report_states['PE']['faturamento'] = 0;
        $report_states['PI']['total'] = 0;
        $report_states['PI']['faturamento'] = 0;
        $report_states['RJ']['total'] = 0;
        $report_states['RJ']['faturamento'] = 0;
        $report_states['RN']['total'] = 0;
        $report_states['RN']['faturamento'] = 0;
        $report_states['RS']['total'] = 0;
        $report_states['RS']['faturamento'] = 0;
        $report_states['RO']['total'] = 0;
        $report_states['RO']['faturamento'] = 0;
        $report_states['RR']['total'] = 0;
        $report_states['RR']['faturamento'] = 0;
        $report_states['SC']['total'] = 0;
        $report_states['SC']['faturamento'] = 0;
        $report_states['SE']['total'] = 0;
        $report_states['SE']['faturamento'] = 0;
        $report_states['TO']['total'] = 0;
        $report_states['TO']['faturamento'] = 0;
        

        for ($i=0; $i < 15; $i++) {
            $report_faturamento[$i]['faturamento'] = 0;
        }

        foreach ($query_contracts as $contract) {
            for ($i=0; $i < 37; $i++) {

                if(date_format($contract->created, 'Y-m') == $report_period[$i]['date']){
                    $report_period[$i]['count']++;
                }

                if(date_format($contract->created, 'Y-m') == $report_period[$i]['date'] && $contract->status == 1){
                    $report_period[$i]['preenchimento']++;
                }

                if(date_format($contract->created, 'Y-m') == $report_period[$i]['date'] && $contract->status == 2){
                    $report_period[$i]['pendente']++;
                }

                if(date_format($contract->created, 'Y-m') == $report_period[$i]['date'] && $contract->status == 3){
                    $report_period[$i]['andamento']++;
                }

                if(date_format($contract->created, 'Y-m') == $report_period[$i]['date'] && $contract->status == 4){
                    $report_period[$i]['concluido']++;
                }

                if(date_format($contract->created, 'Y-m') == $report_period[$i]['date'] && $contract->status == 6){
                    $report_period[$i]['cancelado']++;
                }

                if(date_format($contract->created, 'Y-m') == $report_period[$i]['date'] && $contract->status == 5){
                    $report_period[$i]['excluido']++;
                }

                // if(date_format($contract->created, 'Y-m') == $report_period[$i]['date'] && $contract->status == 6){
                //     $report_period[$i]['protesto']++;
                // }

                // if(date_format($contract->created, 'Y-m') == $report_period[$i]['date'] && $contract->status == 7){
                //     $report_period[$i]['phase']++;
                // }

                // if(date_format($contract->created, 'Y-m') == $report_period[$i]['date'] && $contract->status == 8){
                //     $report_period[$i]['rescisao']++;
                // }
            }

            $service = TableRegistry::get('Services');
            $query_service = $service
                ->find()
                ->where([
                    'type =' => $contract->type,
                    'action =' => $contract->action,
                    'taxation =' => $contract->taxation
                ]);
            $results = $query_service->toArray();
            if(isset($results[0])){
                $faturamento = $results[0]['price'];
            }
            
            if($contract->status < 5){
                if($contract->faturamento === 1){
                    $total_faturamento[0]['faturamento']++;
                }else{
                    if($contract->faturamento === 0){
                        $count = 1;
                        $total_faturamento[$count]['faturamento']++;
                    }else{

                    $count = $contract->faturamento  - 1;
                    $total_faturamento[$count]['faturamento']++;
                    }
                }
            }
            
            if($contract->status == 1){ //Em preenchimento
                $report_faturamento_clients++;
                $report_status[1]['mensalidade'] += $faturamento;
                $report_status[1]['quantidade']++;
            }
            if($contract->status == 2){ //Pendente
                $report_faturamento_clients++;
                $report_status[2]['mensalidade'] += $faturamento;
                $report_status[2]['quantidade']++;
            }
            if($contract->status == 3){ //Em andamento
                $report_faturamento_clients++;
                $report_status[3]['mensalidade'] += $faturamento;
                $report_status[3]['quantidade']++;
            }
            if($contract->status == 4){ //Concluído
                $report_faturamento_clients++;
                $report_status[4]['mensalidade'] += $faturamento;
                $report_status[4]['quantidade']++;
            }
            if($contract->status == 6){ //Cancelado
                $report_status[5]['mensalidade'] += $faturamento;
                $report_status[5]['quantidade']++;
            }
            if($contract->status == 5){ //Bloqueado
                $report_status[6]['mensalidade'] += $faturamento;
                $report_status[6]['quantidade']++;
            }

        
            // if($contract->status == 6){
            //     $report_status[7]['mensalidade'] += $faturamento;
            //     $report_status[7]['quantidade']++;
            // }
            // if($contract->status == 7){
            //     $report_status[8]['mensalidade'] += $faturamento;
            //     $report_status[8]['quantidade']++;
            // }
            // if($contract->status == 8){
            //     $report_status[9]['mensalidade'] += $faturamento;
            //     $report_status[9]['quantidade']++;
            // }

            // Total
            $report_status[10]['mensalidade'] += $faturamento;
            $report_status[10]['quantidade']++;

            if($contract->type == 'mei'){ 
                $report_type['mei']['total']++;
                $report_type['mei']['faturamento'] += $faturamento; 
            }
            if($contract->type == 's' && $contract->taxation == 'simples'){ 
                $report_type['ss']++; 
                $report_type['s']['faturamento'] += $faturamento; 
            }

            if($contract->type == 's' && $contract->taxation == 'lucro'){ 
                $report_type['sl']++; 
                $report_type['s']['faturamento'] += $faturamento;
            }

            if($contract->type == 'c' && $contract->taxation == 'simples'){ 
                $report_type['cs']++; 
                $report_type['c']['faturamento'] += $faturamento;
            }

            if($contract->type == 'c' && $contract->taxation == 'lucro'){ 
                $report_type['cl']++; 
                $report_type['c']['faturamento'] += $faturamento;
            }

            if($contract->type == 'sc' && $contract->taxation == 'simples'){ 
                $report_type['scs']++; 
                $report_type['sc']['faturamento'] += $faturamento;
            }

            if($contract->type == 'sc' && $contract->taxation == 'lucro'){ 
                $report_type['scl']++; 
                $report_type['sc']['faturamento'] += $faturamento;
            }

            if($contract->type == 'autonomo'){ 
                $report_type['autonomo']['total']++; 
                $report_type['autonomo']['faturamento'] += $faturamento;
            }

            if($contract->type == 'empregado'){ 
                $report_type['empregado']['total']++; 
                $report_type['empregado']['faturamento'] += $faturamento;
            }

            if($contract->type == 'industria'){ 
                $report_type['industria']['total']++; 
                $report_type['industria']['faturamento'] += $faturamento;
            }

            // ESTADOS
            if($contract->state == 'SP'){
                $report_states['SP']['total']++;
                $report_states['SP']['faturamento'] += $faturamento;
            }

            if($contract->state == 'AC'){
                $report_states['AC']['total']++;
                $report_states['AC']['faturamento'] += $faturamento;
            }

            if($contract->state == 'AL'){
                $report_states['AL']['total']++;
                $report_states['AL']['faturamento'] += $faturamento;
            }

            if($contract->state == 'AP'){
                $report_states['AP']['total']++;
                $report_states['AP']['faturamento'] += $faturamento;
            }

            if($contract->state == 'AM'){
                $report_states['AM']['total']++;
                $report_states['AM']['faturamento'] += $faturamento;
            }

            if($contract->state == 'BA'){
                $report_states['BA']['total']++;
                $report_states['BA']['faturamento'] += $faturamento;
            }

            if($contract->state == 'CE'){
                $report_states['CE']['total']++;
                $report_states['CE']['faturamento'] += $faturamento;
            }

            if($contract->state == 'DF'){
                $report_states['DF']['total']++;
                $report_states['DF']['faturamento'] += $faturamento;
            }

            if($contract->state == 'ES'){
                $report_states['ES']['total']++;
                $report_states['ES']['faturamento'] += $faturamento;
            }

            if($contract->state == 'GO'){
                $report_states['GO']['total']++;
                $report_states['GO']['faturamento'] += $faturamento;
            }

            if($contract->state == 'MT'){
                $report_states['MT']['total']++;
                $report_states['MT']['faturamento'] += $faturamento;
            }

            if($contract->state == 'MS'){
                $report_states['MS']['total']++;
                $report_states['MS']['faturamento'] += $faturamento;
            }

            if($contract->state == 'MG'){
                $report_states['MG']['total']++;
                $report_states['MG']['faturamento'] += $faturamento;
            }

            if($contract->state == 'PA'){
                $report_states['PA']['total']++;
                $report_states['PA']['faturamento'] += $faturamento;
            }

            if($contract->state == 'PB'){
                $report_states['PB']['total']++;
                $report_states['PB']['faturamento'] += $faturamento;
            }

            if($contract->state == 'PR'){
                $report_states['PR']['total']++;
                $report_states['PR']['faturamento'] += $faturamento;
            }

            if($contract->state == 'PE'){
                $report_states['PE']['total']++;
                $report_states['PE']['faturamento'] += $faturamento;
            }

            if($contract->state == 'PI'){
                $report_states['PI']['total']++;
                $report_states['PI']['faturamento'] += $faturamento;
            }

            if($contract->state == 'RJ'){
                $report_states['RJ']['total']++;
                $report_states['RJ']['faturamento'] += $faturamento;
            }

            if($contract->state == 'RN'){
                $report_states['RN']['total']++;
                $report_states['RN']['faturamento'] += $faturamento;
            }

            if($contract->state == 'RS'){
                $report_states['RS']['total']++;
                $report_states['RS']['faturamento'] += $faturamento;
            }

            if($contract->state == 'RO'){
                $report_states['RO']['total']++;
                $report_states['RO']['faturamento'] += $faturamento;
            }

            if($contract->state == 'RR'){
                $report_states['RR']['total']++;
                $report_states['RR']['faturamento'] += $faturamento;
            }

            if($contract->state == 'SC'){
                $report_states['SC']['total']++;
                $report_states['SC']['faturamento'] += $faturamento;
            }

            if($contract->state == 'SE'){
                $report_states['SE']['total']++;
                $report_states['SE']['faturamento'] += $faturamento;
            }

            if($contract->state == 'TO'){
                $report_states['TO']['total']++;
                $report_states['TO']['faturamento'] += $faturamento;
            }
        }

        $report_status[1]['percentual'] = $report_status[1]['quantidade'] / $report_status[10]['quantidade'] * 100;
        $report_status[2]['percentual'] = $report_status[2]['quantidade'] / $report_status[10]['quantidade'] * 100;
        $report_status[3]['percentual'] = $report_status[3]['quantidade'] / $report_status[10]['quantidade'] * 100;
        $report_status[4]['percentual'] = $report_status[4]['quantidade'] / $report_status[10]['quantidade'] * 100;
        $report_status[5]['percentual'] = $report_status[5]['quantidade'] / $report_status[10]['quantidade'] * 100;
        $report_status[6]['percentual'] = $report_status[6]['quantidade'] / $report_status[10]['quantidade'] * 100;
        $report_status[7]['percentual'] = $report_status[7]['quantidade'] / $report_status[10]['quantidade'] * 100;
        $report_status[8]['percentual'] = $report_status[8]['quantidade'] / $report_status[10]['quantidade'] * 100;
        $report_status[9]['percentual'] = $report_status[9]['quantidade'] / $report_status[10]['quantidade'] * 100;


        for ($i=0; $i < 60; $i++) {
            $report_faturamento[$i]['faturamento'] = 0;
        }


        if($contract->faturamento == 1 && $contract->type == 'mei'){ 
            $report_faturamento[0]['faturamento'] = $report_faturamento[0]['faturamento'] + $faturamento; 
            // $report_faturamento[0]['faturamento']++; 
            
        }else{

            for ($i=1; $i < 60; $i++) {

                if($contract->faturamento == $i){ 
                    $report_faturamento[$i]['faturamento'] = $report_faturamento[$i]['faturamento'] + $faturamento;
                    // $report_faturamento[$i]['faturamento']++;
                }
            }
        }

        $report_total_faturamento = $report_status[3]['mensalidade'] + $report_status[4]['mensalidade'] + $report_status[5]['mensalidade'];
        $report_total_clients = $report_status[3]['quantidade'] + $report_status[4]['quantidade'];
        $report_total_ticket = $report_total_faturamento / $report_total_clients;

        $report_type['total'] = $report_type['mei']['total'] + $report_type['ss'] + $report_type['sl'] + $report_type['cs'] + $report_type['cl'] + $report_type['scs'] + $report_type['scl'] + $report_type['autonomo']['total'] + $report_type['empregado']['total'] + $report_type['industria']['total'];

        $this->set('report_status', $report_status);
        $this->set('report_faturamento', $report_faturamento);
        $this->set('report_total_faturamento', $report_total_faturamento);
        $this->set('report_total_clients', $report_total_clients);
        $this->set('report_total_ticket', $report_total_ticket);
        $this->set('report_faturamento_clients', $report_faturamento_clients);
        $this->set('total_faturamento', $total_faturamento);
        $this->set('report_period', $report_period);
        $this->set('report_type', $report_type);
        $this->set('report_states', $report_states);

    }

    
    // UPDATE
    // updateStatusTaxe
    public function forcePayment($business_id = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('Payments');
            $query_tasks = $query->query();
            $query_tasks->update()
                ->set([
                    'status' => 2
                ])
                ->where(['business_id' => $business_id])
                ->execute();

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

}

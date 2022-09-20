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


class AdminController extends AppController
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
        $this->set('name_user', $this->Auth->user('name'));
        $this->set('lastname_user', $this->Auth->user('lastname'));
        $this->set('active_login', $this->Auth->user('active_login'));
        $this->set('date_now', $date_now);
        $this->set('styles_page', '');
    }

    public function home()
    {
        $this->viewBuilder()->layout('admin');
        $this->set('title', 'Visão Geral | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'home');

        $total_leads = 0;
        $total_contracts = 0;
        $total_pendentes = 0;
        $total_cancelamentos = 0;

        // Buscar registros
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

        $this->set('total_leads', $total_leads);
        $this->set('total_contracts', $total_contracts);
        $this->set('total_pendentes', $total_pendentes);
        $this->set('total_cancelamentos', $total_cancelamentos);
    }

    public function business()
    {
        $this->viewBuilder()->layout('admin');
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

    public function viewBusiness($business_id = null)
    {
        $this->viewBuilder()->layout('admin');
        $this->set('title', 'Empresas | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'business');

        $date_now = Date::now();

        // GENERATE TASKS

        // for($x = 1; $x < 6; $x++){

        // $date_maturity = date("Y-m-d", strtotime($date_now.' +'.$x.' days')); 
        // $date_week = date("N", strtotime($date_now.' +'.$x.' days')); 
        // $date_day = date("j", strtotime($date_now.' +'.$x.' days')); 

        // $date_maturity = date_format($date_now, "Y-m-d"); 
        // $date_month = date_format($date_now, "n");
        // $date_week = date_format($date_now, "N"); 
        // $date_day = date_format($date_now, "j"); 

        // // Buscar registros
        // $query = TableRegistry::get('TasksFixed');
        // $query_all_tasks_fixed = $query
        //     ->find();
        //     // ->where([
        //     //     'business_id =' => $business_id
        //     // ]);

        // foreach ($query_all_tasks_fixed as $task_fixed) {

        //     if($task_fixed->type == "none"){

        //         // Buscar registros
        //         $query = TableRegistry::get('Tasks');
        //         $query_all_tasks = $query
        //             ->find()
        //             ->where([
        //                 'task_fixed_id =' => $task_fixed->id
        //             ]);

        //         foreach ($query_all_tasks as $task) {
        //             $date_maturity_old = $task->maturity;
        //         }

        //         if($query_all_tasks->isEmpty()){

        //             // Cria Task
        //             $query = TableRegistry::get('Tasks');
        //             $tasks = $query->newEntity();
        //             $tasks->accountant_id = $this->Auth->user('id');
        //             $tasks->business_id = $business_id;
        //             $tasks->group_id = $task_fixed->group_id;
        //             $tasks->task_fixed_id = $task_fixed->id;
        //             $tasks->title = $task_fixed->title;
        //             $tasks->description = $task_fixed->description;
        //             $tasks->month = $task_fixed->month;
        //             $tasks->week = $task_fixed->week;
        //             $tasks->day = $task_fixed->day;
        //             $tasks->maturity = $task_fixed->maturity;
        //             $tasks->status = 1;
        //             $query->save($tasks);
        //         }
        //     }

        //     if($task_fixed->type == "diary"){

        //         // Buscar registros
        //         $query = TableRegistry::get('Tasks');
        //         $query_all_tasks = $query
        //             ->find()
        //             ->where([
        //                 'task_fixed_id =' => $task_fixed->id,
        //                 'maturity =' => $date_maturity
        //             ]);

        //         foreach ($query_all_tasks as $task) {
        //             $date_maturity_old = $task->maturity;
        //         }

        //         if($query_all_tasks->isEmpty()){

        //             // Cria Task
        //             $query = TableRegistry::get('Tasks');
        //             $tasks = $query->newEntity();
        //             $tasks->accountant_id = $this->Auth->user('id');
        //             $tasks->business_id = $business_id;
        //             $tasks->group_id = $task_fixed->group_id;
        //             $tasks->task_fixed_id = $task_fixed->id;
        //             $tasks->title = $task_fixed->title;
        //             $tasks->description = $task_fixed->description;
        //             $tasks->month = $task_fixed->month;
        //             $tasks->week = $task_fixed->week;
        //             $tasks->day = $task_fixed->day;
        //             $tasks->maturity = $date_maturity;
        //             $tasks->status = 1;
        //             $query->save($tasks);
        //         }
        //     }

        //     if($task_fixed->type == "week"){

        //         // Buscar registros
        //         $query = TableRegistry::get('Tasks');
        //         $query_all_tasks = $query
        //             ->find()
        //             ->where([
        //                 'task_fixed_id =' => $task_fixed->id,
        //                 'maturity =' => $date_maturity
        //             ]);

        //         foreach ($query_all_tasks as $task) {
        //             $date_maturity_old = $task->maturity;
        //         }

        //         if($query_all_tasks->isEmpty()){

        //             if($date_week == $task_fixed->week){

        //                 // Cria Task
        //                 $query = TableRegistry::get('Tasks');
        //                 $tasks = $query->newEntity();
        //                 $tasks->accountant_id = $this->Auth->user('id');
        //                 $tasks->business_id = $business_id;
        //                 $tasks->group_id = $task_fixed->group_id;
        //                 $tasks->task_fixed_id = $task_fixed->id;
        //                 $tasks->title = $task_fixed->title;
        //                 $tasks->description = $task_fixed->description;
        //                 $tasks->month = $task_fixed->month;
        //                 $tasks->week = $task_fixed->week;
        //                 $tasks->day = $task_fixed->day;
        //                 $tasks->maturity = $date_maturity;
        //                 $tasks->status = 1;
        //                 $query->save($tasks);
        //             }
        //         }
        //     }

        //     if($task_fixed->type == "month"){

        //         // Buscar registros
        //         $query = TableRegistry::get('Tasks');
        //         $query_all_tasks = $query
        //             ->find()
        //             ->where([
        //                 'task_fixed_id =' => $task_fixed->id,
        //                 'maturity =' => $date_maturity
        //             ]);

        //         foreach ($query_all_tasks as $task) {
        //             $date_maturity_old = $task->maturity;
        //         }

        //         if($query_all_tasks->isEmpty()){

        //             if($date_day == $task_fixed->day){

        //                 $date_maturity = $date_maturity;

        //                 // Cria Task
        //                 $query = TableRegistry::get('Tasks');
        //                 $tasks = $query->newEntity();
        //                 $tasks->accountant_id = $this->Auth->user('id');
        //                 $tasks->business_id = $task_fixed->business_id;
        //                 $tasks->group_id = $task_fixed->group_id;
        //                 $tasks->task_fixed_id = $task_fixed->id;
        //                 $tasks->title = $task_fixed->title;
        //                 $tasks->description = $task_fixed->description;
        //                 $tasks->month = $task_fixed->month;
        //                 $tasks->week = $task_fixed->week;
        //                 $tasks->day = $task_fixed->day;
        //                 $tasks->maturity = $date_maturity;
        //                 $tasks->status = 1;
        //                 $query->save($tasks);
        //             }
        //         }
        //     }

        //     if($task_fixed->type == "yearly"){

        //         // Buscar registros
        //         $query = TableRegistry::get('Tasks');
        //         $query_all_tasks = $query
        //             ->find()
        //             ->where([
        //                 'task_fixed_id =' => $task_fixed->id,
        //                 'maturity =' => $date_maturity
        //             ]);

        //         foreach ($query_all_tasks as $task) {
        //             $date_maturity_old = $task->maturity;
        //         }

        //         if($query_all_tasks->isEmpty()){

        //             if($date_month == $task_fixed->month && $date_day == $task_fixed->day){

        //                 $date_maturity = $date_maturity;

        //                 // Cria Task
        //                 $query = TableRegistry::get('Tasks');
        //                 $tasks = $query->newEntity();
        //                 $tasks->accountant_id = $this->Auth->user('id');
        //                 $tasks->business_id = $task_fixed->business_id;
        //                 $tasks->group_id = $task_fixed->group_id;
        //                 $tasks->task_fixed_id = $task_fixed->id;
        //                 $tasks->title = $task_fixed->title;
        //                 $tasks->description = $task_fixed->description;
        //                 $tasks->month = $task_fixed->month;
        //                 $tasks->week = $task_fixed->week;
        //                 $tasks->day = $task_fixed->day;
        //                 $tasks->maturity = $date_maturity;
        //                 $tasks->status = 1;
        //                 $query->save($tasks);
        //             }
        //         }
        //     }
        // }

        // }

        // VIEW
        
        $styles_page = 'padding-left: 70px; padding-right: 0px;padding-top: 70px; padding-bottom: 0px;';

        $user_id = 0;
        $type_group = [];
        $name_business = [];
        $infos_user_activity = [];
        $service_business = "";
        $taxation_business = "";
        $x = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access_business = $query
                ->find()
                ->where([
                    'id =' => $business_id
                ]);

        foreach ($query_access_business as $access_business) {
            $user_id = $access_business->user_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Users');
        $query_users = $query
                ->find()
                ->where([
                    'permission >' => 1
                ]);

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_id
                ]);

        foreach ($query_business as $business) {

            // Buscar registros
            $query = TableRegistry::get('Services');
            $query_services = $query
                ->find()
                ->where([
                    'type =' => $business->type,
                    'action =' => $business->action
                ]);

            $service_business = $business->type;
            $taxation_business = $business->taxation;
        }

        // Buscar registros
        $query = TableRegistry::get('Accountants');
        $query_accountants = $query
                ->find();

        // Buscar registros
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

        // // Buscar registros
        // $query = TableRegistry::get('GroupTasks');
        // $query_group_tasks = $query
        //     ->find()
        //     ->where([
        //         'business_id =' => $business_id
        //     ])
        //     ->order([
        //         'status DESC'
        //     ]);  

        // // Buscar registros
        // $query = TableRegistry::get('Tasks');
        // $query_all_tasks = $query
        //     ->find()
        //     ->where([
        //         'business_id =' => $business_id
        //     ])
        //     ->order([
        //         'status DESC',
        //         'id ASC'
        //     ]);

        // foreach ($query_all_tasks as $task) {

        //     // Buscar registros
        //     $query = TableRegistry::get('Business');
        //     $query_business = $query
        //         ->find()
        //         ->where([
        //             'id =' => $task->business_id,
        //         ]);

        //     foreach ($query_business as $business) {

        //         if($business->razao == ""){
        //             $name_business[$task->id] = $business->fantasia;
        //         }else{
        //             $name_business[$task->id] = $business->razao;
        //         }
        //     }

        //     // Buscar registros
        //     $query = TableRegistry::get('GroupTasks');
        //     $query_groups = $query
        //         ->find()
        //         ->where([
        //             'id =' => $task->group_id,
        //         ]);

        //     foreach ($query_groups as $group) {
        //         $type_group[$task->id] = $group->type;
        //     }
        // }  

        // // Buscar registros
        // $query = TableRegistry::get('TasksFixed');
        // $query_all_tasks_fixed = $query
        //     ->find()
        //     ->where([
        //         'service =' => $service_business,
        //         'taxation =' => $taxation_business
        //     ])
        //     ->order([
        //         'id ASC'
        //     ]);

        $this->set('all_accountants', $query_accountants);
        $this->set('all_business', $query_business);
        $this->set('all_users', $query_users);
        $this->set('all_activities', $query_activities);
        $this->set('all_services', $query_services);
        // $this->set('all_group_tasks', $query_group_tasks);
        // $this->set('all_tasks', $query_all_tasks);
        // $this->set('all_tasks_fixed', $query_all_tasks_fixed);
        $this->set('infos_user_activity', $infos_user_activity);
        $this->set('type_group', $type_group);
        $this->set('name_business', $name_business);
        $this->set('styles_page', $styles_page);
        $this->set('business_id', $business_id);


        // TAB SELECT
        // Maturity
        if(isset($this->request->query['tab_select'])){
            $tab_select = $this->request->query['tab_select'];
        }else{
            $tab_select = "all";
        }

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

        // Todos
        if($status_tab_3 == "all"){

            // Buscar registros
            $query = TableRegistry::get('Notes');
            $query_notes = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(date) =' => $month_tab_3,
                    'YEAR(date) =' => $year_tab_3
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
                    'MONTH(date) =' => $month_tab_3,
                    'YEAR(date) =' => $year_tab_3,
                    'status =' => $month_tab_3
                ])
                ->order(['date ASC']);
        }

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
            $query = TableRegistry::get('Invoices');
            $query_invoices = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(maturity) =' => $month_tab_6,
                    'YEAR(maturity) =' => $year_tab_6
                ])
                ->order(['created ASC']);
        }

        // Todos
        if($status_tab_6 != 'all'){

            // Buscar registros
            $query = TableRegistry::get('Invoices');
            $query_invoices = $query
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(maturity) =' => $month_tab_6,
                    'YEAR(maturity) =' => $year_tab_6,
                    'status =' => $month_tab_6
                ])
                ->order(['created ASC']);
        }

        // TAB 8
        // Month
        if(isset($this->request->query['month_tab_8'])){
            $month_tab_8 = $this->request->query['month_tab_8'];
        }else{
            $month_tab_8 = date_format($date_now, 'm');
        }

        // Year
        if(isset($this->request->query['year_tab_8'])){
            $year_tab_8 = $this->request->query['year_tab_8'];
        }else{
            $year_tab_8 = date_format($date_now, 'Y');
        }

        // Maturity
        if(isset($this->request->query['status_tab_8'])){
            $status_tab_8 = $this->request->query['status_tab_8'];
        }else{
            $status_tab_8 = "all";
        }

        // Todos
        if($status_tab_8 == "all"){

            // Buscar registros
            $query_expenses_receipt = TableRegistry::get('ExpensesReceipt');
            $query__expenses_receipt = $query_expenses_receipt
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(date) =' => $month_tab_8,
                    'YEAR(date) =' => $year_tab_8
                ])
                ->order(['date ASC']);
        }

        // Todos
        if($status_tab_8 != 'all'){

            // Buscar registros
            $query_expenses_receipt = TableRegistry::get('ExpensesReceipt');
            $query__expenses_receipt = $query_expenses_receipt
                ->find()
                ->where([
                    'business_id =' => $business_id,
                    'MONTH(date) =' => $month_tab_8,
                    'YEAR(date) =' => $year_tab_8,
                    'status =' => $month_tab_8
                ])
                ->order(['date ASC']);
        }

        $permission = "admin";

        $this->set('permission', $permission);
        $this->set('month_tab_2', $month_tab_2);
        $this->set('year_tab_2', $year_tab_2);
        $this->set('status_tab_2', $status_tab_2);

        $this->set('month_tab_3', $month_tab_3);
        $this->set('year_tab_3', $year_tab_3);
        $this->set('status_tab_3', $status_tab_3);

        $this->set('month_tab_4', $month_tab_4);
        $this->set('year_tab_4', $year_tab_4);
        $this->set('status_tab_4', $status_tab_4);

        $this->set('month_tab_5', $month_tab_5);
        $this->set('year_tab_5', $year_tab_5);
        $this->set('status_tab_5', $status_tab_5);

        $this->set('month_tab_6', $month_tab_6);
        $this->set('year_tab_6', $year_tab_6);
        $this->set('status_tab_6', $status_tab_6);

        $this->set('month_tab_8', $month_tab_8);
        $this->set('year_tab_8', $year_tab_8);
        $this->set('status_tab_8', $status_tab_8);

        $this->set('tab_select', $tab_select);
        $this->set('all_taxes', $query_taxes);
        $this->set('all_notes', $query_notes);
        $this->set('all_extracts', $query_extracts);
        $this->set('all_documents', $query_documents);
        $this->set('all_expenses_receipt', $query__expenses_receipt);
        $this->set('all_invoices', $query_invoices);

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
        $this->viewBuilder()->layout('admin');
        $this->set('title', 'Obrigações | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'tasks');

        $date_now = Date::now();

        $type_group = [];
        $name_business = [];

        // Buscar registros
        $query = TableRegistry::get('GroupTasks');
        $query_group_tasks = $query
            ->find()
            ->order([
                'status DESC'
            ]);  

        // Buscar registros
        $query = TableRegistry::get('Tasks');
        $query_all_tasks = $query
            ->find()
            ->order([
                'status DESC',
                'id ASC'
            ]);

        foreach ($query_all_tasks as $task) {

            // Buscar registros
            $query = TableRegistry::get('Business');
            $query_business = $query
                ->find()
                ->where([
                    'id =' => $task->business_id,
                ]);

            foreach ($query_business as $business) {

                if($business->razao == ""){
                    $name_business[$task->id] = $business->fantasia;
                }else{
                    $name_business[$task->id] = $business->razao;
                }
            }

            // Buscar registros
            $query = TableRegistry::get('GroupTasks');
            $query_groups = $query
                ->find()
                ->where([
                    'id =' => $task->group_id,
                ]);

            foreach ($query_groups as $group) {
                $type_group[$task->id] = $group->type;
            }
        }  

        // Buscar registros
        $query = TableRegistry::get('TasksFixed');
        $query_all_tasks_fixed = $query
            ->find()
            ->order([
                'id ASC'
            ]);

        $this->set('all_group_tasks', $query_group_tasks);
        $this->set('all_tasks', $query_all_tasks);
        $this->set('all_tasks_fixed', $query_all_tasks_fixed);
        $this->set('type_group', $type_group);
        $this->set('name_business', $name_business);
    }

    public function crm()
    {
        $this->viewBuilder()->layout('admin');
        $this->set('title', 'Meu CRM | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'crm');

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

        $total_step_1 = 0; 
        $total_step_2 = 0; 
        $total_step_3 = 0; 
        $total_step_4 = 0; 
        $total_step_5 = 0; 
        
        foreach ($query_business as $business) { 
            
            if($business->steps == 1){ $total_step_1++; }
            if($business->steps == 2){ $total_step_2++; }
            if($business->steps == 3){ $total_step_3++; }
            if($business->steps == 4){ $total_step_4++; }
            if($business->steps == 5){ $total_step_5++; }
        }

        $this->set('all_business', $query_business);
        $this->set('type_select', $type_select);
        $this->set('status_select', $status_select);

        $this->set('total_step_1', $total_step_1);
        $this->set('total_step_2', $total_step_2);
        $this->set('total_step_3', $total_step_3);
        $this->set('total_step_4', $total_step_4);
        $this->set('total_step_5', $total_step_5);
    }

    public function invoices()
    {
        $this->viewBuilder()->layout('admin');
        $this->set('title', 'Faturas | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'invoices');
    }

    public function account()
    {
        $this->viewBuilder()->layout('admin');
        $this->set('title', 'Minha conta | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'account');
    }

    public function support()
    {
        $this->viewBuilder()->layout('admin');
        $this->set('title', 'Suporte | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'support');
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
                $uploaddir = '../webroot/uploads/taxes/';
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
            $query_activities->business_id = $business_active;
            $query_activities->title = 'ID: '.$taxes->id.'. Título: '.$this->request->data['title'];
            $query_activities->link = '/accountant/business/'.$business_active.'/view?tab_select=2';
            $query_activities->type = 'Adicionou um imposto para pagar.';
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
                    $documents->status = 1;
                    $documents->origin = 'accountant';
                    $documents->created = $date_now;
                    $query->save($documents);

                    if(!empty($_FILES['file-document-'.$i]['name'])){

                        // Upload document
                        $uploaddir = '../webroot/uploads/documents/';
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

            $date_now = Date::now();

            // Buscar registros
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query
                ->find()
                ->where([
                    'id =' => $taxe_id
                ]);

            foreach ($query_taxes as $taxe) {
                $business_active = $taxe->business_id;
                $title = $taxe->title;
                if($taxe->url !== "" && $taxe->url !== NULL){
                    // Delete file
                    unlink('../webroot/uploads/taxes/'.$taxe->url);
                }
            }

            // Atualiza Quotation
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query->query();
            $query_taxes->delete()
                ->where(['id' => $taxe_id])
                ->execute();


            $activities = TableRegistry::get('Activities');
            $query_activities = $activities->newEntity();
            $query_activities->user_id = $this->Auth->user('id');
            $query_activities->business_id = $business_active;
            $query_activities->title = 'ID: '.$taxe_id.'. Título: '.$title;
            $query_activities->link = '/accountant/business/'.$business_active.'/view?tab_select=2';
            $query_activities->type = 'Deletou um imposto.';
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
                $title = $document->$title;
                if($document->url !== "" && $document->url !== NULL){
                    // Delete file
                    unlink('../webroot/uploads/documents/'.$document->url);
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

    public function permissions()
    {
        $this->viewBuilder()->layout('admin');
        $this->set('title', 'Nível de Permissão | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'business');

        $query = TableRegistry::get('Users');
        $query_business = $query
                ->find()
                ->where([
                    'permission >' => 1
                ])
                ->order(['name ASC']);
            
        $this->set('all_business', $query_business);
    }

    
    public function updatePermission()
    {
        if ($this->request->is('post')) {

            $date_now = Date::now();

            $query = TableRegistry::get('Users');
            $query_users = $query->query();
            $query_users->update()
                ->set([
                    'permission' => $this->request->data['permission']
                ])
                ->where(['id' => $this->request->data['id']])
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

    public function addUser()
    {
    
        if ($this->request->is('post')) {

            // Token
            function generateToken($length = 500) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }

            $date_now = Time::now();
            $token = generateToken();

            $query = TableRegistry::get('Users');
            $query_data = $query
                    ->find()
                    ->where([
                        'username =' => $this->request->data['email']
                    ]);
            $results = $query_data->toArray();
            if(isset($results[0])){
                $result = array(
                    'status' => 'Este e-mail já existe!'
                );
    
            }else{

                $password = $this->request->data['password'];
                $hasher = new DefaultPasswordHasher();

                // Cria nova Quotations
                $users = TableRegistry::get('Users');
                $user = $users->newEntity();
                $user->name = $this->request->data['name'];
                $user->lastname = $this->request->data['lastname'];
                $user->username = $this->request->data['email'];
                $user->password = $hasher->hash($password);
                $user->token = $token;
                $user->created = $date_now;
                $user->updated = $date_now;
                $user->active_login = $date_now;
                $user->origin = "adicionado pelo admin";
                $user->permission = $this->request->data['permission'];
                $user->logged = 0;
                $user->status = 1;
                $users->save($user);

                $result = array(
                    'status' => 'ok'
                );

            }

        }

        $this->set(compact('result'));
    }

    public function deleteUser()
    {
    
        if ($this->request->is('post')) {

            $query = TableRegistry::get('Users');
            $query_users = $query->query();
            $query_users->delete()
                ->where(['id' => $this->request->data['id']])
                ->execute();

            $result = array(
                'status' => 'ok'
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
        $this->viewBuilder()->layout('admin');
        $this->set('title', 'Relatórios | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'reports');

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

    public function indicators()
    {

        // Limite de memória
        ini_set('memory_limit', '256M');
        set_time_limit(0);

        // Configura Layout da View
        $this->viewBuilder()->layout('admin');
        $this->set('title', 'Indicadores | ');
        $this->set('script', ['accountant']);
        $this->set('css', ['default', 'accountant']);
        $this->set('menu_active', 'indicators');

        $total_clients = 0;
        $total_mensalidades = 0;

        $contracts = TableRegistry::get('Business');
        $query_contracts = $contracts
            ->find()
            ->where(['status' => '2'])
            ->Orwhere(['status' => '3'])
            ->Orwhere(['status' => '4'])
            ->order(['id' => 'ASC']);

        foreach ($query_contracts as $contract) {

            $total_clients++;
            $total_mensalidades = $total_mensalidades + $contract->mensalidade;
        }

        $indicators = TableRegistry::get('Indicators');
        $query_indicators = $indicators
            ->find();

        $this->set('all_indicators', $query_indicators);
        $this->set('total_clients', $total_clients);
        $this->set('total_mensalidades', $total_mensalidades);

    }

    /**
     * Lista de corretores
     *
     * Exibe a conta do usuário
     *
     * @access public
     * @return void
     */
    public function updateIndicators()
    {

        if ($this->request->is('post')) {

            // Atualiza Quotation
            $indicators = TableRegistry::get('Indicators');
            $query_indicators = $indicators->query();
            $query_indicators->update()
                    ->set([
                        'value_1' => $this->request->data['value_1'],
                        'value_2' => $this->request->data['value_2'],
                        'value_3' => $this->request->data['value_3'],
                        'value_4' => $this->request->data['value_4'],
                        'value_5' => $this->request->data['value_5'],
                        'value_6' => $this->request->data['value_6'],
                        'value_7' => $this->request->data['value_7'],
                        'value_8' => $this->request->data['value_8'],
                        'value_9' => $this->request->data['value_9'],
                        'value_10' => $this->request->data['value_10'],
                        'value_11' => $this->request->data['value_11'],
                        'value_12' => $this->request->data['value_12'],
                        'value_13' => $this->request->data['value_13'],
                        'value_14' => $this->request->data['value_14'],
                        'value_15' => $this->request->data['value_15'],
                        'value_16' => $this->request->data['value_16'],
                        'value_17' => $this->request->data['value_17'],
                        'value_18' => $this->request->data['value_18'],
                        'value_19' => $this->request->data['value_19'],
                        'value_20' => $this->request->data['value_20'],
                        'value_21' => $this->request->data['value_21'],
                        'value_22' => $this->request->data['value_22'],
                        'value_23' => $this->request->data['value_23'],
                        'value_24' => $this->request->data['value_24'],
                        'value_25' => $this->request->data['value_25'],
                        'value_26' => $this->request->data['value_26'],
                        'value_27' => $this->request->data['value_27'],
                        'value_28' => $this->request->data['value_28'],
                        'value_29' => $this->request->data['value_29'],
                        'value_30' => $this->request->data['value_30']
                    ])
                    ->execute();

            $result = array(
                'status' => 'ok'
            );

            $this->set(compact('result'));
        }
    }

}
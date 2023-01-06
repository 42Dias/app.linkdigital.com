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
use Cake\Log\Log;


class ClientController extends AppController
{

    public function initialize()
    {

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Auth');


        $date_now = Time::now();
        $business_active = 0;
        $business_name = "";
        $business_cnpj = "";


        $this->set('id_user',       $this->Auth->user('id') or [] );
        $this->set('image_user',    $this->Auth->user('image') or [] );
        $this->set('email_user',    $this->Auth->user('username') or [] );
        $this->set('name_user',     $this->Auth->user('name') or [] );
        $this->set('cpf_user',      $this->Auth->user('cpf') or [] );
        $this->set('lastname_user', $this->Auth->user('lastname') or [] );
        $this->set('active_login',  $this->Auth->user('active_login') or [] );
        $this->set('origin_user',   $this->Auth->user('origin') or [] );
        $this->set('date_now',      $date_now);
        $this->set('finances_select', '');

        // // TERMS
        // // Buscar registros
        // $query = TableRegistry::get('Users');
        // $query_access = $query
        //         ->find()
        //         ->where([
        //             'id =' => $this->Auth->user('id')
        //         ]);

        // foreach ($query_access as $access) {
        //     $business_origin = $access->origin;
        //     $business_created = $access->created;
        // }

        // // Expiração periodo gratuito
        // $date_active = Date::now();
        // $date_active = date_format($date_active, "Y-m-d H:m:s");

        // $data_expirada = strtotime(date("Y-m-d H:m:s", strtotime($business_created)) . " +21 day");
        // $data_expirada = date("Y-m-d H:m:s", $data_expirada);

        // $diff = strtotime($data_expirada) - strtotime($date_active);
        // $expire_days = floor($diff / (60 * 60 * 24));  

        $expire_days = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);


        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);
            

        foreach ($query_business as $business) {
            
            $business_cpf = $business->cpf;
            $business_cnpj = $business->cnpj;
            $business_name = $business->razao;

            if($business_cnpj == ''){
                $business_cnpj = 'CNPJ em abertura';
            }    
            
            if($business_name == ''){
                $business_name = $business->fantasia;
            }  

            // if($business_origin == 'cadastro'){
            //     $business_cnpj = 'Faltam';
            //     $business_name = 'Período grátis';
            // }
        }

        
        $this->set('business_cnpj', $business_cnpj);
        $this->set('business_name', $business_name);
        $this->set('expire_days', $expire_days);

    }

    public function home()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Visão Geral | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'home');

        $date_now = Date::now();
        $date_now = date_format($date_now, "Y-m-d H:i:s");


        if($this->request->is('post')) {

            $date_begin = $this->request->data['date_begin'];
            $date_begin = substr($date_begin,6 ,4)."-".substr($date_begin,3 ,2)."-".substr($date_begin,0 ,2).' 00:00:00';

            $date_end = $this->request->data['date_end'];
            $date_end = substr($date_end,6 ,4)."-".substr($date_end,3 ,2)."-".substr($date_end,0 ,2).' 00:00:00';

            $date_begin_input = $this->request->data['date_begin'];
            $date_end_input = $this->request->data['date_end'];
        }else{
           $date = Date::now();
            date_sub($date, date_interval_create_from_date_string('1 year'));
            $date_begin = $date;
            $date_end = date('Y-m-d H:i:s', strtotime($date_now));
            $date_begin_input = date('d/m/Y', strtotime($date_begin));
            $date_end_input = date('d/m/Y', strtotime($date_now));
        }

        $total_receipt = 0;
        $total_payment = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // TERMS
        // Buscar registros
        $query = TableRegistry::get('Users');
        $query_access = $query
                ->find()
                ->where([
                    'id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_terms = $access->terms;
            $business_origin = $access->origin;
            $business_created = $access->created;
        }

        // Expiração periodo gratuito
        $data_expirada = strtotime(date("Y-m-d H:m:s", strtotime($business_created)) . " +21 day");
        $data_expirada = date("Y-m-d H:m:s", $data_expirada);

        $diff = strtotime($data_expirada) - strtotime($date_now);
        $expire_days = floor($diff / (60 * 60 * 24));  
        
        if ($date_now > $data_expirada){
            // return $this->redirect('/client/expired/');
        }

        if($business_terms == 0 && $business_origin != 'cadastro'){
            return $this->redirect('/client/terms/');
        }

        // PAGAMENTOS
        // Buscar registros
        $query = TableRegistry::get('Payments');
        $query_payments = $query
            ->find()
            ->where([
                'business_id =' => $business_active,
                'status =' => 1
            ]);
            
        if(!$query_payments->isEmpty() && $business_origin != 'cadastro'){
            return $this->redirect('/client/payments');
        }

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        $categories_values = [];
        
        foreach ($query_categories as $category) {
            $categories_values[$category->group_categories] = 0;
        }

       

        // Buscar registros
        $query = TableRegistry::get('FinancesReleases');
        $query_releases = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'created >=' => $date_begin,
                'created <=' => $date_end
            ])
            ->order([ 'created ASC' ]);

        foreach ($query_releases as $release) {

            if($release->type == 'receipt'){
                $total_receipt += $release->value;
            }

            if($release->type == 'payment'){
                $total_payment += $release->value;
            }          
            
            // FINANCES
            // Buscar registros
            $query = TableRegistry::get('BusinessCategories');
            $query_categories = $query
                ->find()
                ->where([ 'id =' => $release->category_id ]);
            
            foreach ($query_categories as $category) {
                $categories_values[$category->group_categories] += $release->value;
            }
            
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
            ->find()
            ->where([
                'id =' => $business_active
            ]);

        foreach ($query_business as $business) {
            $status_business = $business->status;
        }

        // NOTES
        // Buscar registros
        $count_notes = 0;
        $total_notes = 0;

        $query = TableRegistry::get('Notes');
        $query_notes = $query
                ->find()
                ->where([
                    'business_id =' => $business_active
                ]);

        foreach ($query_notes as $notes) {
            $count_notes++;
            $total_notes += $notes->total;
        }

        // EXTRACTS
        // Buscar registros
        $expenses_extracts = 0;
        $recipes_extracts = 0;

        $query = TableRegistry::get('Extracts');
        $query_extracts = $query
                ->find()
                ->where([
                    'business_id =' => $business_active
                ]);

        foreach ($query_extracts as $extract) {
            $expenses_extracts += $extract->expenses;
            $recipes_extracts += $extract->recipes;
        }

        // EXTRACTS
        // Buscar registros
        $total_taxes = 0;

        $query = TableRegistry::get('Taxes');
        $query_taxes = $query
                ->find()
                ->where([
                    'business_id =' => $business_active
                ]);

        foreach ($query_taxes as $taxes) {

            if($taxes->status == 2){
                $total_taxes += $taxes->total;
            }
        }

        $list_status_tasks = [];
        $list_date_tasks = [];

        // Buscar registros
        $query = TableRegistry::get('Tasks');
        $query_all_tasks = $query
            ->find()
            ->where([ 'business_id =' => $business_active ]);

        foreach ($query_all_tasks as $task) {
            $list_status_tasks[$task->task_fixed_id] = $task->status;
            $list_date_tasks[$task->task_fixed_id][date_format($task->updated, 'Ymd')] = 'ok';
        }  

        // Buscar registros
        $query = TableRegistry::get('TasksFixed');
        $query_all_tasks_fixed = $query
            ->find()
            ->where([
                'notification_type =' => 'all'
            ])
            ->OrWhere([
                'notification_type =' => 'client'
            ])
            ->order([
                'id ASC'
            ]);

        $this->set('all_tasks', $query_all_tasks);
        $this->set('all_tasks_fixed', $query_all_tasks_fixed);
        $this->set('list_status_tasks', $list_status_tasks);
        $this->set('list_date_tasks', $list_date_tasks);

        $this->set('all_business', $query_business);
        $this->set('all_notes', $query_notes);
        $this->set('all_extracts', $query_extracts);
        $this->set('all_taxes', $query_taxes);
        $this->set('count_notes', $count_notes);
        $this->set('total_receipt', $total_receipt);
        $this->set('total_payment', $total_payment);
        $this->set('expenses_extracts', $expenses_extracts);
        $this->set('total_taxes', $total_taxes);
        $this->set('status_business', $status_business);
        $this->set('expire_days', $expire_days);

        $this->set('date_begin_input', $date_begin_input);
        $this->set('date_end_input', $date_end_input);


        $this->set('categories_values', $categories_values);
        $this->set('query_releases', $query_releases);
        
    }

    public function business()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Minha empresa | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'business');

        $business_active = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        foreach ($query_business as $business) {
            $service_business = $business->type;
            $taxation_business = $business->taxation;
            $action_business = $business->action;
        }

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
                'business_id =' => $business_active
            ]);

        // DOCUMENTS SEND
        // Buscar registros
        $query = TableRegistry::get('DocumentsBusiness');
        $query_documents_actions = $query
            ->find()
            ->where([
                'business_id =' => $business_active
            ]);

        // Buscar registros
        $query = TableRegistry::get('Services');
        $query_services = $query
            ->find()
            ->where([
                'type =' => $service_business,
                'action =' => $action_business
            ]);

        $this->set('all_business', $query_business);
        $this->set('all_docs_migracao', $query_docs_migracao);
        $this->set('all_docs_abertura', $query_docs_abertura);
        $this->set('all_history', $query_history);
        $this->set('all_documents_actions', $query_documents_actions);
        $this->set('all_services', $query_services);
    }

    public function taxes()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Impostos a pagar | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'taxes');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);

        // Date
        $date_now = Time::now();

        // Month
        if(isset($this->request->query['month_select'])){
            $month_select = $this->request->query['month_select'];
        }else{
            $month_select = date_format($date_now, 'm');
        }

        // Year
        if(isset($this->request->query['year_select'])){
            $year_select = $this->request->query['year_select'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        // Maturity
        if(isset($this->request->query['status'])){
            $status_select = $this->request->query['status'];
        }else{
            $status_select = "all";
        }

        // Todos
        if($status_select == "all"){

            // Buscar registros
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(maturity) =' => $month_select,
                    'YEAR(maturity) =' => $year_select
                ])
                ->order(['status ASC', 'maturity ASC']);
        }

        // Todos
        if($status_select == '0'){

            // Buscar registros
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(maturity) =' => $month_select,
                    'YEAR(maturity) =' => $year_select,
                    'maturity <' => date_format($date_now, 'Y/m/d'),
                    'status =' => '1'
                ])
                ->order(['status ASC', 'maturity ASC']);
        }

        // Todos
        if($status_select == '1'){

            // Buscar registros
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(maturity) =' => $month_select,
                    'YEAR(maturity) =' => $year_select,
                    'maturity >=' => date_format($date_now, 'Y/m/d'),
                    'status =' => '1'
                ])
                ->order(['status ASC', 'maturity ASC']);
        }

        // Todos
        if($status_select == '2'){

            // Buscar registros
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(maturity) =' => $month_select,
                    'YEAR(maturity) =' => $year_select,
                    'status =' => '2'
                ])
                ->order(['status ASC', 'maturity ASC']);
        }

        $this->set('all_taxes', $query_taxes);
        $this->set('month_select', $month_select);
        $this->set('year_select', $year_select);
        $this->set('status_select', $status_select);
    }

    public function notes()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Notas Fiscais | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'notes');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);

        // Date
        $date_now = Time::now();

        // Month
        if(isset($this->request->query['month_select'])){
            $month_select = $this->request->query['month_select'];
        }else{
            $month_select = date_format($date_now, 'm');
        }

        // Year
        if(isset($this->request->query['year_select'])){
            $year_select = $this->request->query['year_select'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        // Maturity
        if(isset($this->request->query['status'])){
            $status_select = $this->request->query['status'];
        }else{
            $status_select = "all";
        }

        // Todos
        if($status_select == "all"){

            $period = $month_select.'/'.$year_select;

            // Buscar registros
            $query = TableRegistry::get('Notes');
            $query_notes = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'date =' => $period
                ])
                ->order(['status ASC', 'date ASC']);
        }

        // Todos
        if($status_select == '0'){

            $period = $month_select.'/'.$year_select;

            // Buscar registros
            $query = TableRegistry::get('Notes');
            $query_notes = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'date =' => $period,
                    'status =' => '1'
                ])
                ->order(['status ASC', 'date ASC']);
        }

        // Todos
        if($status_select == '1'){

            $period = $month_select.'/'.$year_select;

            // Buscar registros
            $query = TableRegistry::get('Notes');
            $query_notes = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'date =' => $period,
                    'status =' => '1'
                ])
                ->order(['status ASC', 'date ASC']);
        }

        // Todos
        if($status_select == '2'){

            $period = $month_select.'/'.$year_select;

            // Buscar registros
            $query = TableRegistry::get('Notes');
            $query_notes = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'date =' => $period,
                    'status =' => '2'
                ])
                ->order(['status ASC', 'date ASC']);
        }

        $this->set('all_notes', $query_notes);
        $this->set('month_select', $month_select);
        $this->set('year_select', $year_select);
        $this->set('status_select', $status_select);
    }

    public function finances()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Financeiro | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');

        $total_accounts = 0;
        $account_selected_id = 0;
        $customer_selected_id = 0;
        $provider_selected_id = 0;
        $employee_selected_id = 0;
        $partner_selected_id = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // FILTROS
        if(isset($this->request->query['tab_select'])){
            $tab_select = $this->request->query['tab_select'];
        }else{
            $tab_select = 8;
        }

        if(isset($this->request->query['account_id'])){
            $account_selected_id = $this->request->query['account_id'];
        }else{
            $account_selected_id = 'all';
        }

        if(isset($this->request->query['customer_id'])){
            $customer_selected_id = $this->request->query['customer_id'];
        }else{
            
            // Buscar registros
            $query = TableRegistry::get('BusinessCustomers');
            $query_customers = $query
                ->find()
                ->where([ 'business_id =' => $business_active ])
                ->order([ 'id DESC' ]);

            foreach ($query_customers as $customer) {
                $customer_selected_id = $customer->id;
            }
        }

        if(isset($this->request->query['provider_id'])){
            $provider_selected_id = $this->request->query['provider_id'];
        }else{
            
            // Buscar registros
            $query = TableRegistry::get('BusinessProviders');
            $query_providers = $query
                ->find()
                ->where([ 'business_id =' => $business_active ])
                ->order([ 'id DESC' ]);

            foreach ($query_providers as $provider) {
                $provider_selected_id = $provider->id;
            }
        }

        if(isset($this->request->query['employee_id'])){
            $employee_selected_id = $this->request->query['employee_id'];
        }else{
            
            // Buscar registros
            $query = TableRegistry::get('BusinessEmployees');
            $query_employees = $query
                ->find()
                ->where([ 'business_id =' => $business_active ])
                ->order([ 'id DESC' ]);

            foreach ($query_employees as $employee) {
                $employee_selected_id = $employee->id;
            }
        }

        if(isset($this->request->query['partner_id'])){
            $partner_selected_id = $this->request->query['partner_id'];
        }else{
            
            // Buscar registros
            $query = TableRegistry::get('BusinessPartners');
            $query_partners = $query
                ->find()
                ->where([ 'business_id =' => $business_active ])
                ->order([ 'id DESC' ]);

            foreach ($query_partners as $partner) {
                $partner_selected_id = $partner->id;
            }
        }

        
        // ITENS
        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessCustomers');
        $query_customers = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessEmployees');
        $query_employees = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessPartners');
        $query_partners = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessProviders');
        $query_providers = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('FinancesAccounts');
        $query_accounts = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        foreach ($query_accounts as $account) {
            $total_accounts += $account->total;
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesPayments');
        $query_payments = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

            // Buscar registros
        $query = TableRegistry::get('FinancesReceipts');
        $query_receipts = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);


        if($account_selected_id == 'all'){

            // Buscar registros
            $query = TableRegistry::get('FinancesReleases');
            $query_releases = $query
                ->find()
                ->where([ 'business_id =' => $business_active ])
                ->order([ 'id DESC' ]);

        }else{
            
            // Buscar registros
            $query = TableRegistry::get('FinancesReleases');
            $query_releases = $query
                ->find()
                ->where([ 
                    'business_id =' => $business_active,
                    'account_id =' => $account_selected_id
                ])
                ->order([ 'id DESC' ]);
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesConciliations');
        $query_conciliations = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'status =' => 0
            ])
            ->order([ 'id ASC' ]);
    
    

        $this->set('query_categories', $query_categories);
        $this->set('query_customers', $query_customers);
        $this->set('query_employees', $query_employees);
        $this->set('query_partners', $query_partners);
        $this->set('query_providers', $query_providers);
        $this->set('query_accounts', $query_accounts);
        $this->set('query_payments', $query_payments);
        $this->set('query_receipts', $query_receipts);
        $this->set('query_releases', $query_releases);
        $this->set('query_conciliations', $query_conciliations);

        $this->set('tab_select', $tab_select);
        $this->set('business_id', $business_active);
        $this->set('account_selected_id', $account_selected_id);
        $this->set('customer_selected_id', $customer_selected_id);
        $this->set('provider_selected_id', $provider_selected_id);
        $this->set('employee_selected_id', $employee_selected_id);
        $this->set('partner_selected_id', $partner_selected_id);
        $this->set('total_accounts', $total_accounts);
        
    }

    public function financesCategories()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Financeiro | Categorias | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'categories');

        // Date
        $date_now = Time::now();

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // ITENS
        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
        $this->set('business_id', $business_active);

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        $this->set('query_categories', $query_categories);     
        
        // // Buscar registros
        // $query = TableRegistry::get('CategoriesDefault');
        // $query_categories_default = $query
        //         ->find();

        // foreach ($query_categories_default as $category_default) {

        //     $query = TableRegistry::get('BusinessCategories'); 
        //     $categories = $query->newEntity(); 
        //     $categories->business_id =  $business_active;
        //     $categories->type = $category_default->type;
        //     $categories->group_categories = $category_default->group_categories;
        //     $categories->origin_id = $category_default->id;
        //     $categories->name = $category_default->name;
        //     $categories->created = $date_now; 
        //     $query->save($categories);
        // }

    }

    public function financesCustomers()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Financeiro | Clientes | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'customers');

        // Date
        $date_now = Time::now();

        $customer_selected_id = 0;

        $total_closed = 0;
        $total_open = 0;
        $total_loser = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // ITENS
        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
        $this->set('business_id', $business_active);

        if(isset($this->request->query['customer_id'])){
            $customer_selected_id = $this->request->query['customer_id'];
        }else{
            
            // Buscar registros
            $query = TableRegistry::get('BusinessCustomers');
            $query_customers = $query
                ->find()
                ->where([ 'business_id =' => $business_active ])
                ->order([ 'id DESC' ]);

            foreach ($query_customers as $customer) {
                $customer_selected_id = $customer->id;
            }
        }      
        
        // Buscar registros
        $query = TableRegistry::get('BusinessCustomers');
        $query_customers = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('FinancesFiles');
        $query_files = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'item_id =' => $customer_selected_id  
            ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('FinancesNotes');
        $query_notes = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'item_id =' => $customer_selected_id  
            ])
            ->order([ 'id ASC' ]);

            // Buscar registros
        $query = TableRegistry::get('FinancesReceipts');
        $query_receipts = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'type =' => 'customer',
                'type_id =' => $customer_selected_id  
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_receipts as $receipt) {
            if($receipt->status == 1){
                $total_closed += $receipt->value;
            }

            if($receipt->status == 0){
                $total_open += $receipt->value;
            }

            if($receipt->maturity < $date_now && $receipt->status == 0){
                $total_loser += $receipt->value;
            }
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesPayments');
        $query_payments = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'type =' => 'customer',
                'type_id =' => $customer_selected_id  
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_payments as $payment) {
            if($payment->status == 1){
                $total_closed += $payment->value;
            }

            if($payment->status == 0){
                $total_open += $payment->value;
            }

            if($payment->maturity < $date_now && $payment->status == 0){
                $total_loser += $payment->value;
            }
        }

        $this->set('query_receipts', $query_receipts);
        $this->set('query_payments', $query_payments);
        $this->set('total_closed', $total_closed);
        $this->set('total_open', $total_open);
        $this->set('total_loser', $total_loser);
        $this->set('query_files', $query_files);
        $this->set('query_notes', $query_notes);
        $this->set('query_customers', $query_customers);
        $this->set('customer_selected_id', $customer_selected_id);

    }

    public function financesProviders()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Financeiro | Fornecedores | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'providers');

        // Date
        $date_now = Time::now();

        $provider_selected_id = 0;

        $total_closed = 0;
        $total_open = 0;
        $total_loser = 0;
        
        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // ITENS
        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
        $this->set('business_id', $business_active);

        if(isset($this->request->query['provider_id'])){
            $provider_selected_id = $this->request->query['provider_id'];
        }else{
            
            // Buscar registros
            $query = TableRegistry::get('BusinessProviders');
            $query_providers = $query
                ->find()
                ->where([ 'business_id =' => $business_active ])
                ->order([ 'id DESC' ]);

            foreach ($query_providers as $provider) {
                $provider_selected_id = $provider->id;
            }
        }
        
        // Buscar registros
        $query = TableRegistry::get('BusinessProviders');
        $query_providers = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('FinancesFiles');
        $query_files = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'item_id =' => $provider_selected_id  
            ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('FinancesNotes');
        $query_notes = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'item_id =' => $provider_selected_id  
            ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('FinancesReceipts');
        $query_receipts = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'type =' => 'provider',
                'type_id =' => $provider_selected_id  
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_receipts as $receipt) {
            if($receipt->status == 1){
                $total_closed += $receipt->value;
            }

            if($receipt->status == 0){
                $total_open += $receipt->value;
            }

            if($receipt->maturity < $date_now && $receipt->status == 0){
                $total_loser += $receipt->value;
            }
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesPayments');
        $query_payments = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'type =' => 'provider',
                'type_id =' => $provider_selected_id  
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_payments as $payment) {
            if($payment->status == 1){
                $total_closed += $payment->value;
            }

            if($payment->status == 0){
                $total_open += $payment->value;
            }

            if($payment->maturity < $date_now && $payment->status == 0){
                $total_loser += $payment->value;
            }
        }

        $this->set('query_receipts', $query_receipts);
        $this->set('query_payments', $query_payments);
        $this->set('total_closed', $total_closed);
        $this->set('total_open', $total_open);
        $this->set('total_loser', $total_loser);
        $this->set('query_files', $query_files);
        $this->set('query_notes', $query_notes);
        $this->set('query_providers', $query_providers);
        $this->set('provider_selected_id', $provider_selected_id);

    }

    public function financesEmployees()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Financeiro | Funcionários | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'employees');

        // Date
        $date_now = Time::now();

        $employee_selected_id = 0;

        $total_closed = 0;
        $total_open = 0;
        $total_loser = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // ITENS
        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
        $this->set('business_id', $business_active);

        if(isset($this->request->query['employee_id'])){
            $employee_selected_id = $this->request->query['employee_id'];
        }else{
            
            // Buscar registros
            $query = TableRegistry::get('BusinessEmployees');
            $query_employees = $query
                ->find()
                ->where([ 'business_id =' => $business_active ])
                ->order([ 'id DESC' ]);

            foreach ($query_employees as $employee) {
                $employee_selected_id = $employee->id;
            }
        }
        
        // Buscar registros
        $query = TableRegistry::get('BusinessEmployees');
        $query_employees = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('FinancesFiles');
        $query_files = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'item_id =' => $employee_selected_id  
            ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('FinancesNotes');
        $query_notes = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'item_id =' => $employee_selected_id  
            ])
            ->order([ 'id ASC' ]);

            // Buscar registros
        $query = TableRegistry::get('FinancesReceipts');
        $query_receipts = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'type =' => 'employee',
                'type_id =' => $employee_selected_id  
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_receipts as $receipt) {
            if($receipt->status == 1){
                $total_closed += $receipt->value;
            }

            if($receipt->status == 0){
                $total_open += $receipt->value;
            }

            if($receipt->maturity < $date_now && $receipt->status == 0){
                $total_loser += $receipt->value;
            }
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesPayments');
        $query_payments = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'type =' => 'employee',
                'type_id =' => $employee_selected_id  
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_payments as $payment) {
            if($payment->status == 1){
                $total_closed += $payment->value;
            }

            if($payment->status == 0){
                $total_open += $payment->value;
            }

            if($payment->maturity < $date_now && $payment->status == 0){
                $total_loser += $payment->value;
            }
        }

        $this->set('query_receipts', $query_receipts);
        $this->set('query_payments', $query_payments);
        $this->set('total_closed', $total_closed);
        $this->set('total_open', $total_open);
        $this->set('total_loser', $total_loser);
        $this->set('query_files', $query_files);
        $this->set('query_notes', $query_notes);
        $this->set('query_employees', $query_employees);
        $this->set('employee_selected_id', $employee_selected_id);

    }

    public function financesPartners()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Financeiro | Sócios | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'partners');

        // Date
        $date_now = Time::now();

        $partner_selected_id = 0;

        $total_closed = 0;
        $total_open = 0;
        $total_loser = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // ITENS
        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
        $this->set('business_id', $business_active);

        if(isset($this->request->query['partner_id'])){
            $partner_selected_id = $this->request->query['partner_id'];
        }else{
            
            // Buscar registros
            $query = TableRegistry::get('BusinessPartners');
            $query_partners = $query
                ->find()
                ->where([ 'business_id =' => $business_active ])
                ->order([ 'id DESC' ]);

            foreach ($query_partners as $partner) {
                $partner_selected_id = $partner->id;
            }
        }

        // Buscar registros
        $query = TableRegistry::get('BusinessPartners');
        $query_partners = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

            // Buscar registros
        $query = TableRegistry::get('FinancesFiles');
        $query_files = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'item_id =' => $partner_selected_id  
            ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('FinancesNotes');
        $query_notes = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'item_id =' => $partner_selected_id  
            ])
            ->order([ 'id ASC' ]);

            // Buscar registros
        $query = TableRegistry::get('FinancesReceipts');
        $query_receipts = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'type =' => 'partner',
                'type_id =' => $partner_selected_id  
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_receipts as $receipt) {
            if($receipt->status == 1){
                $total_closed += $receipt->value;
            }

            if($receipt->status == 0){
                $total_open += $receipt->value;
            }

            if($receipt->maturity < $date_now && $receipt->status == 0){
                $total_loser += $receipt->value;
            }
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesPayments');
        $query_payments = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'type =' => 'partner',
                'type_id =' => $partner_selected_id  
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_payments as $payment) {
            if($payment->status == 1){
                $total_closed += $payment->value;
            }

            if($payment->status == 0){
                $total_open += $payment->value;
            }

            if($payment->maturity < $date_now && $payment->status == 0){
                $total_loser += $payment->value;
            }
        }

        $this->set('query_receipts', $query_receipts);
        $this->set('query_payments', $query_payments);
        $this->set('total_closed', $total_closed);
        $this->set('total_open', $total_open);
        $this->set('total_loser', $total_loser);
        $this->set('query_files', $query_files);
        $this->set('query_notes', $query_notes);
        $this->set('query_partners', $query_partners);
        $this->set('partner_selected_id', $partner_selected_id);

    }

    public function financesAccounts()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Financeiro | Contas | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'accounts');

        $total_accounts = 0;
        $account_selected_id = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // ITENS
        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
        $this->set('business_id', $business_active);

        if(isset($this->request->query['account_id'])){
            $account_selected_id = $this->request->query['account_id'];
        }else{
            $account_selected_id = 'all';
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesAccounts');
        $query_accounts = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        foreach ($query_accounts as $account) {
            $total_accounts += $account->total;
        }

        $this->set('query_accounts', $query_accounts);
        $this->set('account_selected_id', $account_selected_id);
        $this->set('total_accounts', $total_accounts);

    }

    public function financesPayments()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Financeiro | Pagamentos | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'payments');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // ITENS
        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
        $this->set('business_id', $business_active);

        // Buscar registros
        $query = TableRegistry::get('FinancesPayments');
        $query_payments = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

            // Buscar registros
        $query = TableRegistry::get('FinancesAccounts');
        $query_accounts = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessPartners');
        $query_partners = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessEmployees');
        $query_employees = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessProviders');
        $query_providers = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessCustomers');
        $query_customers = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        $this->set('query_customers', $query_customers);
        $this->set('query_providers', $query_providers);
        $this->set('query_employees', $query_employees);
        $this->set('query_partners', $query_partners);
        $this->set('query_accounts', $query_accounts);
        $this->set('query_categories', $query_categories);
        $this->set('query_payments', $query_payments);

    }

    public function financesReceipts()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Financeiro | Recebimentos | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'receipts');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // ITENS
        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
        $this->set('business_id', $business_active);

        // Buscar registros
        $query = TableRegistry::get('FinancesReceipts');
        $query_receipts = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('FinancesAccounts');
        $query_accounts = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessPartners');
        $query_partners = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessEmployees');
        $query_employees = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessProviders');
        $query_providers = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessCustomers');
        $query_customers = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        $this->set('query_customers', $query_customers);
        $this->set('query_providers', $query_providers);
        $this->set('query_employees', $query_employees);
        $this->set('query_partners', $query_partners);
        $this->set('query_receipts', $query_receipts);
        $this->set('query_accounts', $query_accounts);
        $this->set('query_categories', $query_categories);

    }

    public function financesReleases()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Financeiro | Extrato | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'releases');

        $date_now = Date::now();
        $date_now = date_format($date_now, "Y-m-d H:i:s");


        if($this->request->is('post')) {

            $date_begin = $this->request->data['date_begin'];
            $date_begin = substr($date_begin,6 ,4)."-".substr($date_begin,3 ,2)."-".substr($date_begin,0 ,2).' 00:00:00';

            $date_end = $this->request->data['date_end'];
            $date_end = substr($date_end,6 ,4)."-".substr($date_end,3 ,2)."-".substr($date_end,0 ,2).' 00:00:00';

            $date_begin_input = $this->request->data['date_begin'];
            $date_end_input = $this->request->data['date_end'];
        }else{
            $date = Date::now();
            date_sub($date, date_interval_create_from_date_string('1 year'));
            $date_begin = $date;
            $date_end = date('Y-m-d H:i:s', strtotime($date_now));
            $date_begin_input = date('d/m/Y', strtotime($date_begin));
            $date_end_input = date('d/m/Y', strtotime($date_now));
        }

        $total_receipt = 0;
        $total_payment = 0;
        $total_accounts = 0;
        $account_selected_id = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // ITENS
        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
        $this->set('business_id', $business_active);

        if(isset($this->request->query['account_id'])){
            $account_selected_id = $this->request->query['account_id'];
        }else{
            $account_selected_id = 'all';
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesAccounts');
        $query_accounts = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        foreach ($query_accounts as $account) {
            $total_accounts += $account->total;
        }

        // RELEASES
        $month_lucratividade = [];
        $month_despesas = [];
        $month_receitas = [];

        for ($i=1; $i < 13; $i++) { 
            $month_lucratividade[$i] = 0;                
            $month_despesas[$i] = 0;
            $month_receitas[$i] = 0;
        }

        if($account_selected_id == 'all'){

            // Buscar registros
            $query = TableRegistry::get('FinancesReleases');
            $query_releases = $query
                ->find()
                ->where([ 
                    'business_id =' => $business_active,
                    'created >=' => $date_begin,
                    'created <=' => $date_end
                ])
                ->order([ 'created ASC' ]);

        }else{
            
            // Buscar registros
            $query = TableRegistry::get('FinancesReleases');
            $query_releases = $query
                ->find()
                ->where([ 
                    'business_id =' => $business_active,
                    'account_id =' => $account_selected_id,
                    // 'created >=' => $date_begin,
                    // 'created <=' => $date_end
                ])
                ->order([ 'id DESC' ]);
        }

        error_log(
            print_r( [
                    'created >=' => $date_begin,
                    'created <=' => $date_end
            ], true)
        );
        foreach ($query_releases as $release) {

            $month_active = date_format($release->created, "m");

            for ($i=1; $i < 13; $i++) { 
                
                if($month_active == $i){

                    if($release->type == 'receipt'){
                        $month_receitas[$i] += $release->value;
                    }
        
                    if($release->type == 'payment'){
                        $month_despesas[$i] += $release->value;
                    }

                    $month_lucratividade[$i] = $month_receitas[$i] - ($month_despesas[$i] * -1);
                }
            }
        }

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        $this->set('query_categories', $query_categories);
        $this->set('query_accounts', $query_accounts);
        $this->set('query_releases', $query_releases);
        $this->set('account_selected_id', $account_selected_id);
        $this->set('total_accounts', $total_accounts);

        $this->set('date_begin_input', $date_begin_input);
        $this->set('date_end_input', $date_end_input);

        $this->set('month_lucratividade', $month_lucratividade);
        $this->set('month_despesas', $month_despesas);
        $this->set('month_receitas', $month_receitas);

    }

    public function financesConciliations()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Financeiro | Conciliação | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'conciliations');

        $total_accounts = 0;
        $account_selected_id = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // ITENS
        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
        $this->set('business_id', $business_active);

        // Buscar registros
        $query = TableRegistry::get('FinancesConciliations');
        $query_conciliations = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'status =' => 0
            ])
            ->order([ 'id ASC' ]);

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('FinancesAccounts');
        $query_accounts = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        $this->set('query_categories', $query_categories);
        $this->set('query_accounts', $query_accounts);
        $this->set('query_conciliations', $query_conciliations);

    }


    public function extracts()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Extratos | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'extracts');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);

        // Date
        $date_now = Time::now();

        // Month
        if(isset($this->request->query['month_select'])){
            $month_select = $this->request->query['month_select'];
        }else{
            $month_select = date_format($date_now, 'm');
        }

        // Year
        if(isset($this->request->query['year_select'])){
            $year_select = $this->request->query['year_select'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        // Maturity
        if(isset($this->request->query['status'])){
            $status_select = $this->request->query['status'];
        }else{
            $status_select = "all";
        }

        // Todos
        if($status_select == "all"){

            // Buscar registros
            $query = TableRegistry::get('Extracts');
            $query_extracts = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(date_inicial) =' => $month_select,
                    'YEAR(date_inicial) =' => $year_select
                ])
                ->order(['status ASC', 'date ASC']);
        }

        // Todos
        if($status_select == '0'){

            // Buscar registros
            $query = TableRegistry::get('Extracts');
            $query_extracts = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(date_inicial) =' => $month_select,
                    'YEAR(date_inicial) =' => $year_select,
                    'status =' => '1'
                ])
                ->order(['status ASC', 'date ASC']);
        }

        // Todos
        if($status_select == '1'){

            // Buscar registros
            $query = TableRegistry::get('Extracts');
            $query_extracts = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(date_inicial) =' => $month_select,
                    'YEAR(date_inicial) =' => $year_select,
                    'status =' => '1'
                ])
                ->order(['status ASC', 'date ASC']);
        }

        // Todos
        if($status_select == '2'){

            // Buscar registros
            $query = TableRegistry::get('Extracts');
            $query_extracts = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(date_inicial) =' => $month_select,
                    'YEAR(date_inicial) =' => $year_select,
                    'status =' => '2'
                ])
                ->order(['status ASC', 'date ASC']);
        }

        $this->set('all_extracts', $query_extracts);
        $this->set('month_select', $month_select);
        $this->set('year_select', $year_select);
        $this->set('status_select', $status_select);
    }

    public function documents()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Documentos | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'documents');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);

        // Date
        $date_now = Time::now();

        // Month
        if(isset($this->request->query['month_select'])){
            $month_select = $this->request->query['month_select'];
        }else{
            $month_select = date_format($date_now, 'm');
        }

        // Year
        if(isset($this->request->query['year_select'])){
            $year_select = $this->request->query['year_select'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        // Maturity
        if(isset($this->request->query['status'])){
            $status_select = $this->request->query['status'];
        }else{
            $status_select = "all";
        }

        // Todos
        if($status_select == "all"){

            // Buscar registros
            $query = TableRegistry::get('Documents');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(date) =' => $month_select,
                    'YEAR(date) =' => $year_select
                ])
                ->order(['status ASC', 'date ASC']);
        }

        // Todos
        if($status_select == '0'){

            // Buscar registros
            $query = TableRegistry::get('Documents');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(date) =' => $month_select,
                    'YEAR(date) =' => $year_select,
                    'status =' => '1'
                ])
                ->order(['status ASC', 'date ASC']);
        }

        // Todos
        if($status_select == '1'){

            // Buscar registros
            $query = TableRegistry::get('Documents');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(date) =' => $month_select,
                    'YEAR(date) =' => $year_select,
                    'status =' => '1'
                ])
                ->order(['status ASC', 'date ASC']);
        }

        // Todos
        if($status_select == '2'){

            // Buscar registros
            $query = TableRegistry::get('Documents');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(date) =' => $month_select,
                    'YEAR(date) =' => $year_select,
                    'status =' => '2'
                ])
                ->order(['status ASC', 'date ASC']);
        }

        $this->set('all_documents', $query_documents);
        $this->set('business_id', $business_active);
        $this->set('month_select', $month_select);
        $this->set('year_select', $year_select);
        $this->set('status_select', $status_select);
    }

    public function expensesReceipt()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'expensesReceipt | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'expensesReceipt');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);

        // Date
        $date_now = Time::now();

        // Month
        if(isset($this->request->query['month_select'])){
            $month_select = $this->request->query['month_select'];
        }else{
            $month_select = date_format($date_now, 'm');
        }

        // Year
        if(isset($this->request->query['year_select'])){
            $year_select = $this->request->query['year_select'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        // Maturity
        if(isset($this->request->query['status'])){
            $status_select = $this->request->query['status'];
        }else{
            $status_select = "all";
        }

        // Todos
        if($status_select == "all"){

            // Buscar registros
            $query = TableRegistry::get('ExpensesReceipt');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(date) =' => $month_select,
                    'YEAR(date) =' => $year_select
                ])
                ->order(['status ASC', 'date ASC']);

        }

        // Todos
        if($status_select == '0'){

            // Buscar registros
            $query = TableRegistry::get('ExpensesReceipt');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(date) =' => $month_select,
                    'YEAR(date) =' => $year_select,
                    'status =' => '1'
                ])
                ->order(['status ASC', 'date ASC']);

        }

        // Todos
        if($status_select == '1'){

            // Buscar registros
            $query = TableRegistry::get('ExpensesReceipt');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(date) =' => $month_select,
                    'YEAR(date) =' => $year_select,
                    'status =' => '1'
                ])
                ->order(['status ASC', 'date ASC']);
        }

        // Todos
        if($status_select == '2'){

            /// Buscar registros
            $query = TableRegistry::get('ExpensesReceipt');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(date) =' => $month_select,
                    'YEAR(date) =' => $year_select,
                    'status =' => '2'
                ])
                ->order(['status ASC', 'date ASC']);
            
        }

        $this->set('all_documents', $query_documents);
        $this->set('month_select', $month_select);
        $this->set('year_select', $year_select);
        $this->set('status_select', $status_select);
    }

    public function services()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Meus serviços | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'services');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
    }

    public function account()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Minha conta | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'account');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
    }

    public function tickets()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Chamados | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'tickets');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);
  
          // Date
        $date_now = Time::now();
  
        // Buscar registros
        $query = TableRegistry::get('Tickets');
        $query_documents = $query
            ->find()
            ->where([
                'user_id =' => $this->Auth->user('id')
            ])
            ->order(['created ASC']);

          $this->set('list_tickets', $query_documents);
          $this->set('all_business', $query_business);
          $this->set('business_id', $business_active);
    }

    public function viewTicket($id = null)
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Chamados | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'tickets');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);
  
          // Date
        $date_now = Time::now();
  
        $comment_permission = [];
        $comment_names = [];

        // Buscar registros
        $query = TableRegistry::get('Tickets');
        $query_documents = $query
            ->find()
            ->where([
                'id =' => $id
            ]);

        $docs = TableRegistry::get('TicketsDocuments');
        $query_docs = $docs
            ->find()
            ->where([
                'ticket_id =' => $id
            ]);

        $comment = TableRegistry::get('TicketsComments');
        $query_comment = $comment
            ->find()
            ->where([
                'ticket_id =' => $id
            ]);
        foreach($query_comment as $comments){
            $user_id = $comments->user_id;

            $users = TableRegistry::get('Users');
            $query_users = $users
            ->find()
            ->where([
                'id =' => $user_id
            ]);

            foreach($query_users as $user){
                if($user->permission == "1"){
                    $comment_permission[$comments->id] = 1;
                    $comment_names[$comments->id] = $user->name;
                }else{
                    $comment_names[$comments->id] = $user->name;
                    $comment_permission[$comments->id] = 0;
                }
            }
        }

        $this->set('data_comments',      $query_comment);
        $this->set('list_documents',     $query_docs);
        $this->set('data_tickets',       $query_documents);
        $this->set('all_business',       $query_business);
        $this->set('business_id',        $business_active);
        $this->set('comment_permission', $comment_permission);
        $this->set('comment_names',      $comment_names);
    }
    
    public function addCommentTicket($id = null)
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            $query = TableRegistry::get('AccessBusiness');
            $query_access = $query
                    ->find()
                    ->where([
                        'user_id =' => $this->Auth->user('id')
                    ]);

            foreach ($query_access as $access){
                $business_active = $access->business_id;
            }

            // Cria nova Quotations
            $query_note = TableRegistry::get('TicketsComments');
            $query_notes = $query_note->newEntity();
            $query_notes->user_id = $this->Auth->user('id');
            $query_notes->ticket_id = $id;
            $query_notes->text = $this->request->data['text'];
            $query_notes->created = $date_now;
            $query_note->save($query_notes);  

            if(!empty($_FILES['document_file'])){

                // Upload document
                $uploaddir = getcwd() . '/webroot'  . '/uploads/documents/';
                $ext = explode(".", $_FILES['document_file']['name']);
                $ext = end($ext);
                $url_document = $business_active."_".$query_notes->id.".".$ext;

                $uploadfile = $uploaddir.($url_document);
                move_uploaded_file($_FILES['document_file']['tmp_name'], $uploadfile);

                $doc = TableRegistry::get('TicketsDocuments');
                $docs = $doc->newEntity();
                $docs->user_id = $this->Auth->user('id');
                $docs->ticket_id = $id;
                $docs->comment_id = $query_notes->id;
                $docs->url = $url_document;
                $docs->created = $date_now;
                $docs->status = 1;
                $doc->save($docs);  
            }

            // Envia e-mail de Confirmação de e-mail
            $email = new Email();
            $email->viewVars(['name' => $this->Auth->user('name')]);
            $email->viewVars(['email' => $this->Auth->user('username')]);
            $email->viewVars(['message' => $this->request->data['text']]);
            $email->template('chamado_response')
            ->subject('Chamado respondido')
            ->emailFormat('html')
            // ->to('liliantobace@yahoo.com.br')
            ->to('contato@linkcontabilidade.com.br')
            ->from('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->send();
        }

        return $this->redirect('/client/tickets/'.$id.'/view');
    }
    
    public function addTicket()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            $query = TableRegistry::get('AccessBusiness');
            $query_access = $query
                    ->find()
                    ->where([
                        'user_id =' => $this->Auth->user('id')
                    ]);

            foreach ($query_access as $access){
                $business_active = $access->business_id;
            }

            // Cria nova Quotations
            $query_note = TableRegistry::get('Tickets');
            $query_notes = $query_note->newEntity();
            $query_notes->user_id = $this->Auth->user('id');
            $query_notes->subject = $this->request->data['subject'];
            $query_notes->text = $this->request->data['text'];
            $query_notes->area = $this->request->data['area'];
            $query_notes->created = $date_now;
            $query_notes->status = 1;
            $query_note->save($query_notes);  

            if(!empty($_FILES['document_file'])){

                // Upload document
                $uploaddir = getcwd() . '/webroot'  . '/uploads/documents/';
                $ext = explode(".", $_FILES['document_file']['name']);
                $ext = end($ext);

                $url_document = $business_active.".".$ext;

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

        return $this->redirect('/client/tickets');
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

            $email_user = ' '; 
            $name_user  = ' ';
            $assunto = ' ';
            $date_now = ' ';

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

            $email = new Email('default');
            
            // $email->ViewVars(['name' => $name_user]);
            // $email->ViewVars(['email' => $email_user]);
            // $email->ViewVars(['message' => $assunto]);
            // $email->ViewVars(['date' => $date_now]);
            // $email->ViewVars(['id' => $ticket_id]);

            $email->Template('close_chamado')
            ->Subject('#'.$ticket_id.' - '.'chamado fechado pelo cliente!')
            ->EmailFormat('html')
            ->To('contato@linkcontabilidade.com.br')
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


    public function invoices()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Faturas | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'invoices');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);

        // Date
        $date_now = Time::now();

        // Month
        if(isset($this->request->query['month_select'])){
            $month_select = $this->request->query['month_select'];
        }else{
            $month_select = date_format($date_now, 'm');
        }

        // Year
        if(isset($this->request->query['year_select'])){
            $year_select = $this->request->query['year_select'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        // Maturity
        if(isset($this->request->query['status'])){
            $status_select = $this->request->query['status'];
        }else{
            $status_select = "all";
        }

        // Todos
        if($status_select == "all"){

            // Buscar registros
            $query = TableRegistry::get('Payments');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(maturity) =' => $month_select,
                    'YEAR(maturity) =' => $year_select
                ])
                ->order(['status ASC', 'maturity ASC']);
        }

        // Todos
        if($status_select == '0'){

            // Buscar registros
            $query = TableRegistry::get('Payments');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(maturity) =' => $month_select,
                    'YEAR(maturity) =' => $year_select,
                    'status =' => '1'
                ])
                ->order(['status ASC', 'maturity ASC']);
        }

        // Todos
        if($status_select == '1'){

            // Buscar registros
            $query = TableRegistry::get('Payments');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(maturity) =' => $month_select,
                    'YEAR(maturity) =' => $year_select,
                    'status =' => '1'
                ])
                ->order(['status ASC', 'maturity ASC']);
        }

        // Todos
        if($status_select == '2'){

            // Buscar registros
            $query = TableRegistry::get('Payments');
            $query_documents = $query
                ->find()
                ->where([
                    'business_id =' => $business_active,
                    'MONTH(maturity) =' => $month_select,
                    'YEAR(maturity) =' => $year_select,
                    'status =' => '2'
                ])
                ->order(['status ASC', 'maturity ASC']);
        }

        $this->set('all_invoices', $query_documents);
        $this->set('business_id', $business_active);
        $this->set('month_select', $month_select);
        $this->set('year_select', $year_select);
        $this->set('status_select', $status_select);

    }

    public function support()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Suporte | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'support');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
    }

    public function partners()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Parceiros | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'partners');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
    }

    public function notifications()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Notificações | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'support');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
    }


    // UPDATE
    // updateStatusTaxe
    public function updateStatusTaxe($taxe_id = null, $status = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('Taxes');
            $query_taxes = $query->query();
            $query_taxes->update()
                ->set([
                    'status' => $status
                ])
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

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function notesAdd()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Buscar registros
            $query = TableRegistry::get('AccessBusiness');
            $query_access = $query
                    ->find()
                    ->where([
                        'user_id =' => $this->Auth->user('id')
                    ]);

            foreach ($query_access as $access) {
                $business_active = $access->business_id;
            }

            $arquivo = isset($_FILES['file_note']) ? $_FILES['file_note'] : FALSE;

            for ($i = 0; $i < count($arquivo['name']); $i++){ 

                $date_note = $this->request->data['date'];
                // $date_note =  substr($date_note,6 ,4)."-".substr($date_note,3 ,2)."-".substr($date_note,0 ,2)." 00:00";

                $total = str_replace(".", "", $this->request->data['total']);

                // Cria nova Quotations
                $query = TableRegistry::get('Notes');
                $notes = $query->newEntity();
                $notes->business_id = $business_active;
                $notes->title = $this->request->data['title'];
                $notes->description = $this->request->data['description'];
                $notes->total = $total;
                $notes->date = $date_note;
                $notes->url = '';
                $notes->status = 1;
                $notes->created = $date_now;
                $query->save($notes);  


                if(!empty($arquivo['name'][$i])){

                    // Upload document
                    $uploaddir =  getcwd() . '/webroot'  . '/uploads/notes/';
                    $ext = explode(".", $arquivo['name'][$i]);
                    $ext = end($ext);

                    $url_document = $business_active."_".$notes->id.".".$ext;

                    $uploadfile = $uploaddir.($url_document);
                    move_uploaded_file($arquivo['tmp_name'][$i], $uploadfile);

                    // Atualiza Quotation
                    $query = TableRegistry::get('Notes');
                    $query_notes = $query->query();
                    $query_notes->update()
                        ->set([
                            'url' => $url_document
                        ])
                        ->where(['id' => $notes->id])
                        ->execute();
                }

                $activities = TableRegistry::get('Activities');
                $query_activities = $activities->newEntity();
                $query_activities->user_id = $this->Auth->user('id');
                $query_activities->business_id = $business_active;
                $query_activities->title = 'ID: '.$notes->id.'. Título: '.$this->request->data['title'];
                $query_activities->link = '/accountant/business/'.$business_active.'/view?tab_select=3';
                $query_activities->type = 'Adicionou uma nota fiscal.';
                $query_activities->created = $date_now;
                $activities->save($query_activities);


                // EMAIL
                // Buscar registros
                $query = TableRegistry::get('Business');
                $query_business = $query
                        ->find()
                        ->where([
                            'id =' => $business_active
                        ]);

                foreach ($query_business as $business) {
                    $business_name = $business->razao;
                }

                // Envia e-mail de seja bem vindo
                $email = new Email();
                $email->viewVars(['title' => 'Cliente adicionou nota fiscal']);
                $email->viewVars(['subtitle' => $business_name]);
                $email->viewVars(['text' => 'O cliente acabou de realizar o upload de uma nota fiscal na plataforma.']);
                $email->template('action')
                ->subject($business_name.' adicionou nota fiscal')
                ->emailFormat('html')
                ->to('contato@linkcontabilidade.com.br')
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

    // updateStatusTaxe
    public function notesDelete($note_id = null)
    {
        if ($this->request->is('post')) {
            
            $date_now = Time::now();

            // Buscar registros
            $query = TableRegistry::get('Notes');
            $query_notes = $query
                ->find()
                ->where([
                    'id =' => $note_id
                ]);

            foreach ($query_notes as $note) {
                $business_active = $note->business_id;
                $title = $note->title;
                if($note->url !== "" && $note->url !== NULL){
                    // Delete file
                    unlink( getcwd() . '/webroot'  . '/uploads/notes/'.$note->url);
                }
            }

            // Atualiza Quotation
            $query = TableRegistry::get('Notes');
            $query_notes = $query->query();
            $query_notes->delete()
                ->where(['id' => $note_id])
                ->execute();

            $activities = TableRegistry::get('Activities');
            $query_activities = $activities->newEntity();
            $query_activities->user_id = $this->Auth->user('id');
            $query_activities->business_id = $business_active;
            $query_activities->title = 'ID: '.$note_id.'. Título: '.$title;
            $query_activities->link = '/accountant/business/'.$business_active.'/view?tab_select=5';
            $query_activities->type = 'Deletou uma nota fiscal.';
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
    public function extractsAdd()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Buscar registros
            $query = TableRegistry::get('AccessBusiness');
            $query_access = $query
                    ->find()
                    ->where([
                        'user_id =' => $this->Auth->user('id')
                    ]);

            foreach ($query_access as $access) {
                $business_active = $access->business_id;
            }

            $date_inicial = $this->request->data['date_inicial'];
            $date_inicial =  substr($date_inicial,6 ,4)."-".substr($date_inicial,3 ,2)."-".substr($date_inicial,0 ,2)." 00:00";
            
            $date_final = $this->request->data['date_final'];
            $date_final =  substr($date_final,6 ,4)."-".substr($date_final,3 ,2)."-".substr($date_final,0 ,2)." 00:00";

            // Cria nova Quotations
            $query = TableRegistry::get('Extracts');
            $extracts = $query->newEntity();
            $extracts->business_id = $business_active;
            $extracts->bank = $this->request->data['bank'];
            $extracts->description = $this->request->data['description'];
            $extracts->date_inicial = $date_inicial;
            $extracts->date_final = $date_final;
            $extracts->url = '';
            $extracts->status = 1;
            $extracts->created = $date_now;
            $query->save($extracts);

            if(!empty($_FILES['file_extract']['name'])){

                // Upload document
                $uploaddir =  getcwd() . '/webroot'  . '/uploads/extracts/';
                $ext = explode(".", $_FILES['file_extract']['name']);
                $ext = end($ext);

                $url_document = $business_active."_".$extracts->id.".".$ext;

                $uploadfile = $uploaddir.($url_document);
                move_uploaded_file($_FILES['file_extract']['tmp_name'], $uploadfile);

                // Atualiza Quotation
                $query = TableRegistry::get('Extracts');
                $query_notes = $query->query();
                $query_notes->update()
                    ->set([
                        'url' => $url_document
                    ])
                    ->where(['id' => $extracts->id])
                    ->execute();
            }

            $activities = TableRegistry::get('Activities');
            $query_activities = $activities->newEntity();
            $query_activities->user_id = $this->Auth->user('id');
            $query_activities->business_id = $business_active;
            $query_activities->title = 'ID: '.$extracts->id.'. Banco: '.$this->request->data['bank'];
            $query_activities->link = '/accountant/business/'.$business_active.'/view?tab_select=4';
            $query_activities->type = 'Adicionou um extrato.';
            $query_activities->created = $date_now;
            $activities->save($query_activities);

            // EMAIL
            // Buscar registros
            $query = TableRegistry::get('Business');
            $query_business = $query
                    ->find()
                    ->where([
                        'id =' => $business_active
                    ]);

            foreach ($query_business as $business) {
                $business_name = $business->razao;
            }

            // Envia e-mail de seja bem vindo
            $email = new Email();
            $email->viewVars(['title' => 'Cliente adicionou extrato']);
            $email->viewVars(['subtitle' => $business_name]);
            $email->viewVars(['text' => 'O cliente acabou de realizar o upload de um extrato na plataforma.']);
            $email->template('action')
            ->subject($business_name.' adicionou extrato')
            ->emailFormat('html')
            ->to('contato@linkcontabilidade.com.br')
            ->from('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->send();

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
    public function extractsDelete($extract_id = null)
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Buscar registros
            $query = TableRegistry::get('Extracts');
            $query_extracts = $query
                ->find()
                ->where([
                    'id =' => $extract_id
                ]);

            foreach ($query_extracts as $extract) {
                $business_active = $extract->business_id;
                $bank = $extract->bank;
                if($extract->url !== "" && $extract->url !== NULL){
                    // Delete file
                    unlink( getcwd() . '/webroot'  . '/uploads/extracts/'.$extract->url);
                }
            }

            $activities = TableRegistry::get('Activities');
            $query_activities = $activities->newEntity();
            $query_activities->user_id = $this->Auth->user('id');
            $query_activities->business_id = $business_active;
            $query_activities->title = 'ID: '.$extract_id.'. Banco: '.$bank;
            $query_activities->link = '/accountant/business/'.$business_active.'/view?tab_select=4';
            $query_activities->type = 'Deletou um extrato.';
            $query_activities->created = $date_now;
            $activities->save($query_activities);

            // Atualiza Quotation
            $query = TableRegistry::get('Extracts');
            $query_extracts = $query->query();
            $query_extracts->delete()
                ->where(['id' => $extract_id])
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
    public function documentsAdd()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Buscar registros
            $query = TableRegistry::get('AccessBusiness');
            $query_access = $query
                    ->find()
                    ->where([
                        'user_id =' => $this->Auth->user('id')
                    ]);

            foreach ($query_access as $access) {
                $business_active = $access->business_id;
            }

            for ($i=0; $i < count($_POST); $i++) {

                if(isset($this->request->data['title-'.$i])){

                    $date_document = $this->request->data['date-'.$i];
                    $date_document =  substr($date_document,6 ,4)."-".substr($date_document,3 ,2)."-".substr($date_document,0 ,2)." 00:00";


                    // Cria nova Quotations
                    $query = TableRegistry::get('Documents');
                    $documents = $query->newEntity();
                    $documents->business_id = $business_active;
                    $documents->title = $this->request->data['title-'.$i];
                    $documents->description = $this->request->data['description-'.$i];
                    $documents->date = $date_document;
                    $documents->url = '';
                    $documents->type = $this->request->data['type-doc-'.$i];
                    $documents->status = 1;
                    $documents->origin = 'client';
                    $documents->created = $date_now;
                    $query->save($documents);

                   if(!empty($_FILES['file-document-'.$i]['name'])){

                        // Upload document
                        $uploaddir = getcwd() . '/webroot'  . '/uploads/documents/';
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
                    $query_activities->type = 'Adicinou um documento.';
                    $query_activities->created = $date_now;
                    $activities->save($query_activities);

                     // EMAIL
                    // Buscar registros
                    $query = TableRegistry::get('Business');
                    $query_business = $query
                            ->find()
                            ->where([
                                'id =' => $business_active
                            ]);

                    foreach ($query_business as $business) {
                        $business_name = $business->razao;
                    }

                    // Envia e-mail de seja bem vindo
                    $email = new Email();
                    $email->viewVars(['title' => 'Cliente adicionou documento']);
                    $email->viewVars(['subtitle' => $business_name]);
                    $email->viewVars(['text' => 'O cliente acabou de realizar o upload de um documento na plataforma.']);
                    $email->template('action')
                    ->subject($business_name.' adicionou documento')
                    ->emailFormat('html')
                    ->to('contato@linkcontabilidade.com.br')
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
    public function documentsAddAction()
    {
        if ($this->request->is('post')) {
            $date_now = Time::now();
            $document_id_select = $this->request->data['document_id'];

            $query = TableRegistry::get('AccessBusiness');
            $query_access = $query
                    ->find()
                    ->where([
                        'user_id =' => $this->Auth->user('id')
                    ]);

            foreach ($query_access as $access) {
                $business_active = $access->business_id;
            }


            if(!empty($_FILES['file-document-action-'.$document_id_select]['name'])){

                // Upload document
                $uploaddir = getcwd() . '/webroot'  . '/uploads/documents/';
                $ext = explode(".", $_FILES['file-document-action-'.$document_id_select]['name']);

                $ext = end($ext);

                // criou um arquivo temporário, criou o nome do arquivo corretamente, mas no momento em que move-se o arquivo ele gera erro. Cria a url do documento baseado em sua função dentro do sistema
                $url_document = $business_active."_".$this->request->data['type']."_".$document_id_select.".".$ext;
                $uploadfile = $uploaddir.($url_document);
                $is_moved = move_uploaded_file($_FILES['file-document-action-'.$document_id_select]['tmp_name'], $uploadfile);
            }

            // Cria nova Quotations
            $query = TableRegistry::get('DocumentsBusiness');
            $documents = $query->newEntity();
            $documents->business_id = $business_active;
            $documents->document_id = $this->request->data['document_id'];
            $documents->type = $this->request->data['type'];
            $documents->url = $url_document;
            $documents->created = $date_now;
            $query->save($documents);

           
            $activities = TableRegistry::get('Activities');
            $query_activities = $activities->newEntity();
            $query_activities->user_id = $this->Auth->user('id');
            $query_activities->business_id = $business_active;
            $query_activities->title = 'Cliente enviou um novo documento';
            $query_activities->link = '/';
            $query_activities->type = 'Adicinou um documento';
            $query_activities->created = $date_now;
            $activities->save($query_activities);

             // EMAIL
            // Buscar registros
            $query = TableRegistry::get('Business');
            $query_business = $query
                    ->find()
                    ->where([
                        'id =' => $business_active
                    ]);

            foreach ($query_business as $business) {
                $business_name = $business->razao;
            }

            // Envia e-mail de seja bem vindo
            $email = new Email();
            $email->viewVars(['title' => 'Cliente adicionou documento']);
            $email->viewVars(['subtitle' => $business_name]);
            $email->viewVars(['text' => 'O cliente acabou de realizar o upload de um documento na plataforma.']);
            $email->template('action')
            ->subject($business_name.' adicionou documento')
            ->emailFormat('html')
            ->to('contato@linkcontabilidade.com.br')
            ->from('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->send();

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
    public function documentsRemoveAction($document_id_select = null)
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Buscar registros
            $query = TableRegistry::get('AccessBusiness');
            $query_access = $query
                    ->find()
                    ->where([
                        'user_id =' => $this->Auth->user('id')
                    ]);

            foreach ($query_access as $access) {
                $business_active = $access->business_id;
            }

            // Buscar registros
            $query = TableRegistry::get('DocumentsBusiness');
            $query_documents = $query
                ->find()
                ->where([
                    'document_id =' => $document_id_select
                ]);

            foreach ($query_documents as $document) {
                unlink(getcwd() . '/webroot'  . '/uploads/documents/'.$document->url);
            }

            // Atualiza Quotation
            $query = TableRegistry::get('DocumentsBusiness');
            $query_documents = $query->query();
            $query_documents->delete()
                ->where(['document_id' => $document_id_select])
                ->execute();


           
            $activities = TableRegistry::get('Activities');
            $query_activities = $activities->newEntity();
            $query_activities->user_id = $this->Auth->user('id');
            $query_activities->business_id = $business_active;
            $query_activities->title = 'Cliente removeu um novo documento';
            $query_activities->link = '/';
            $query_activities->type = 'Adicinou um documento';
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

    public function expensesReceiptAdd()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Buscar registros
            $query = TableRegistry::get('AccessBusiness');
            $query_access = $query
                    ->find()
                    ->where([
                        'user_id =' => $this->Auth->user('id')
                    ]);

            foreach ($query_access as $access) {
                $business_active = $access->business_id;
            }

            for ($i=0; $i < count($_POST); $i++) {
                
                if(isset($this->request->data['name-'.$i])){

                    $date_document = $this->request->data['date-'.$i];
                    $date_document =  substr($date_document,6 ,4)."-".substr($date_document,3 ,2)."-".substr($date_document,0 ,2)." 00:00";

                    $query = TableRegistry::get('ExpensesReceipt');
                    $expenses_receipt = $query->newEntity();
                    $expenses_receipt->business_id = $business_active;
                    $expenses_receipt->name = $this->request->data['name-'.$i];
                    $expenses_receipt->value = $this->request->data['value-'.$i];
                    $expenses_receipt->date = $date_document;
                    $expenses_receipt->type = $this->request->data['type-'.$i];
                    $expenses_receipt->status = 1;
                    $expenses_receipt->updated = $date_now;
                    $expenses_receipt->created = $date_now;
                    $query->save($expenses_receipt);
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

    // updateStatusTaxe
    public function documentsDelete($document_id = null)
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

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
                    unlink(getcwd() . '/webroot'  . '/uploads/documents/'.$document->url);
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

    // updateStatusTaxe
    public function categoriesDelete($category_id = null)
    {
        if ($this->request->is('post')) {
            
            $date_now = Time::now();

            // Atualiza Quotation
            $query = TableRegistry::get('BusinessCategories');
            $query_notes = $query->query();
            $query_notes->delete()
                ->where(['id' => $category_id])
                ->execute();

            $activities = TableRegistry::get('Activities');
            $query_activities = $activities->newEntity();
            $query_activities->user_id = $this->Auth->user('id');
            // $query_activities->business_id = $business_active;
            $query_activities->title = 'Removeu uma categoria';
            // $query_activities->link = '/accountant/business/'.$business_active.'/view?tab_select=5';
            $query_activities->type = 'Deletou uma categoria';
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

    public function expensesReceiptDelete($document_id = null)
    {
        if ($this->request->is('post')) {

            // Buscar registros
            $query = TableRegistry::get('ExpensesReceipt');
            $query_documents = $query
                ->find()
                ->where([
                    'id =' => $document_id
                ]);

            // Atualiza Quotation
            $query = TableRegistry::get('ExpensesReceipt');
            $query_documents = $query->query();
            $query_documents->delete()
                ->where(['id' => $document_id])
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

    public function terms()
    {
        $this->viewBuilder()->layout('terms');
        $this->set('title', 'Termos de Responsabilidade | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']); 
        $this->set('menu_active', 'home');
    }

    public function expired()
    {
        $this->viewBuilder()->layout('terms');
        $this->set('title', 'Acesso expirado | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']); 
        $this->set('menu_active', 'home');
    }

    public function payments()
    {
        $this->viewBuilder()->layout('terms');
        $this->set('title', 'Pagamentos pendentes | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'home');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Payments');
        $query_payments = $query
            ->find()
            ->where([
                'business_id =' => $business_active,
                'status =' => '1'
            ]);

        $this->set('all_payments', $query_payments);
    }

    // updateStatusTaxe
    public function updateTerms()
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('Users');
            $query_taxes = $query->query();
            $query_taxes->update()
                ->set([
                    'terms' => 1
                ])
                ->where(['id' => $this->Auth->user('id')])
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
    public function approveConciliationItem($conciliation_id = null, $account_id = null, $category_id = null)
    {
        $date_now = Time::now();
        
        if ($this->request->is('post')) {

                        

            // ATUALIZA CONCILIATION
            // Atualiza Quotation
            $query = TableRegistry::get('FinancesConciliations');
            $query_conciliations = $query->query();


            $query_conciliations->update()
                ->set([
                    'status' => 1
                ])
                ->where(['id' => $conciliation_id])
                ->execute();
            
            // NOVO RELEASE
            // Buscar registros
            $query = TableRegistry::get('FinancesConciliations');
            $query_conciliation = $query
                    ->find()
                    ->where([
                        'id =' => $conciliation_id
                    ]);


            foreach ($query_conciliation as $conciliation) {
                $conciliation_type = $conciliation->type;
                $conciliation_type_id = $conciliation->type_id;
                $conciliation_title = $conciliation->title;
                $conciliation_value = $conciliation->value;
                $conciliation_created = /*$conciliation->created or*/ $date_now;
            }

            // Buscar registros
            $query = TableRegistry::get('AccessBusiness');
            $query_access = $query
                    ->find()
                    ->where([
                        'user_id =' => $this->Auth->user('id')
                    ]);

            foreach ($query_access as $access) {
                $business_active = $access->business_id;
            }

            // Buscar registros
            $query = TableRegistry::get('FinancesAccounts');
            $query_accounts = $query
                    ->find()
                    ->where([
                        'id =' => $account_id
                    ]);

            foreach ($query_accounts as $account) {
                $account_total = $account->total;
            }

            $new_balance = $account_total + ($conciliation_value);

            // Cria nova Quotations
            $query = TableRegistry::get('FinancesReleases');
            $releases = $query->newEntity();
            $releases->business_id = $business_active;
            $releases->account_id = $account_id;
            $releases->category_id = $category_id;
            $releases->type = $conciliation_type;
            $releases->title = $conciliation_title;
            $releases->value = $conciliation_value;
            $releases->balance = $new_balance;
            $releases->type_id = $conciliation_type_id;
            $releases->created = $conciliation_created or $date_now;
            $releases->updated = $conciliation_created or $date_now;
            $query->save($releases);

            $query = TableRegistry::get('FinancesAccounts');
            $query_accounts = $query->query();
            $query_accounts->update()
                ->set([
                    'total' => $new_balance
                ])
                ->where(['id' => $account_id])
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
    public function removeAll()
    {
        if ($this->request->is('post')) {

            // Buscar registros
            $query = TableRegistry::get('AccessBusiness');
            $query_access = $query
                    ->find()
                    ->where([
                        'user_id =' => $this->Auth->user('id')
                    ]);

            foreach ($query_access as $access) {
                $business_active = $access->business_id;
            }

            // NOVO RELEASE
            // Buscar registros
            $query = TableRegistry::get('FinancesConciliations');
            $query_conciliation = $query
                    ->find()
                    ->where([
                        'business_id =' => $business_active,
                        'status =' => 0
                    ]);

            foreach ($query_conciliation as $conciliation) {

                // ATUALIZA CONCILIATION
                // Atualiza Quotation
                $query = TableRegistry::get('FinancesConciliations');
                $query_conciliations = $query->query();
                $query_conciliations->delete()
                    ->where(['id' => $conciliation->id])
                    ->execute();
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

    public function financesReports()
    {

        // Limite de memória
        ini_set('memory_limit', '256M');
        set_time_limit(0);

        // Configura Layout da View
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Relatórios | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'reports');

        $contracts = TableRegistry::get('Business');
            
        // Busca Contracts
        $query_contracts = $contracts->find();

        // Report Geral
        $report_total_faturamento = 0;
        $report_total_clients = 0;
        $report_total_ticket = 0;
        $faturamento = 0;

        // Report Period
        $date_now = Time::now();
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

    public function financesReportsFluxoPrevisto()
    {

        // Configura Layout da View
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Relatórios | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'reports');

        $date_now = Time::now();
        
        // Year
        if(isset($this->request->data['report_year'])){
            $year_select = $this->request->data['report_year'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        $total_accounts = 0;
        $account_selected_id = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
            ->find()
            ->where([
                'user_id =' => $this->Auth->user('id')
            ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        $main_categories = [];
        $sub_categories = [];

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories_all = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active 
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_categories_all as $category_all) {

            // YEAR
            $main_categories[$category_all->group_categories][$year_select] = 0;
            $sub_categories[$category_all->origin_id][$year_select] = 0;

            // MONTHS
            for ($i=1; $i < 13; $i++) { 
                $main_categories[$category_all->group_categories][$i] = 0;
                $sub_categories[$category_all->origin_id][$i] = 0;
            }            
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesReleases');
        $query_releases = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'YEAR(created) =' => $year_select
            ])
            ->order([ 'id DESC' ]);

        foreach ($query_releases as $release) {
        
            // Buscar registros
            $query = TableRegistry::get('BusinessCategories');
            $query_categories = $query
                ->find()
                ->where(['id =' => $release->category_id ]);

            foreach ($query_categories as $category) {

                // YEAR
                $main_categories[$category->group_categories][$year_select] += $release->value; 
                $sub_categories[$category->origin_id][$year_select] += $release->value;

                // MONTHS
                for ($i=1; $i < 13; $i++) { 

                    if(date_format($release->created, 'n') == $i){
                        $main_categories[$category->group_categories][$i] += $release->value;
                        $sub_categories[$category->origin_id][$i] += $release->value;
                    }
                }   
            }
        }

        $this->set('year_select', $year_select);
        $this->set('query_categories', $query_categories_all);
        $this->set('query_releases', $query_releases);
        $this->set('main_categories', $main_categories);
        $this->set('sub_categories', $sub_categories);

        // echo "<pre>";
        // print_r($main_categories);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($sub_categories);
        // echo "</pre>";

        // die();
    }

    public function financesReportsFluxoRealizado()
    {

        // Configura Layout da View
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Relatórios | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'reports');

        $date_now = Time::now();
        
        // Year
        if(isset($this->request->data['report_year'])){
            $year_select = $this->request->data['report_year'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        $total_accounts = 0;
        $account_selected_id = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
            ->find()
            ->where([
                'user_id =' => $this->Auth->user('id')
            ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        $main_categories = [];
        $sub_categories = [];

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories_all = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active 
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_categories_all as $category_all) {

            // YEAR
            $main_categories[$category_all->group_categories][$year_select] = 0;
            $sub_categories[$category_all->origin_id][$year_select] = 0;

            // MONTHS
            for ($i=1; $i < 13; $i++) { 
                $main_categories[$category_all->group_categories][$i] = 0;
                $sub_categories[$category_all->origin_id][$i] = 0;
            }            
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesReleases');
        $query_releases = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'YEAR(created) =' => $year_select
            ])
            ->order([ 'id DESC' ]);

        foreach ($query_releases as $release) {
        
            // Buscar registros
            $query = TableRegistry::get('BusinessCategories');
            $query_categories = $query
                ->find()
                ->where(['id =' => $release->category_id ]);

            foreach ($query_categories as $category) {

                // YEAR
                $main_categories[$category->group_categories][$year_select] += $release->value; 
                $sub_categories[$category->origin_id][$year_select] += $release->value;

                // MONTHS
                for ($i=1; $i < 13; $i++) { 

                    if(date_format($release->created, 'n') == $i){
                        $main_categories[$category->group_categories][$i] += $release->value;
                        $sub_categories[$category->origin_id][$i] += $release->value;
                    }
                }   
            }
        }

        $this->set('year_select', $year_select);
        $this->set('query_categories', $query_categories_all);
        $this->set('query_releases', $query_releases);
        $this->set('main_categories', $main_categories);
        $this->set('sub_categories', $sub_categories);

        // echo "<pre>";
        // print_r($main_categories);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($sub_categories);
        // echo "</pre>";

        // die();
    }

    public function financesReportsFluxoPrevistoRealizado()
    {

        // Configura Layout da View
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Relatórios | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'reports');

        $date_now = Time::now();
        
        // Year
        if(isset($this->request->data['report_year'])){
            $year_select = $this->request->data['report_year'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        $total_accounts = 0;
        $account_selected_id = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
            ->find()
            ->where([
                'user_id =' => $this->Auth->user('id')
            ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        $main_categories = [];
        $sub_categories = [];

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories_all = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active 
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_categories_all as $category_all) {

            // YEAR
            $main_categories[$category_all->group_categories][$year_select] = 0;
            $sub_categories[$category_all->origin_id][$year_select] = 0;

            // MONTHS
            for ($i=1; $i < 13; $i++) { 
                $main_categories[$category_all->group_categories][$i] = 0;
                $sub_categories[$category_all->origin_id][$i] = 0;
            }            
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesReleases');
        $query_releases = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'YEAR(created) =' => $year_select
            ])
            ->order([ 'id DESC' ]);

        foreach ($query_releases as $release) {
        
            // Buscar registros
            $query = TableRegistry::get('BusinessCategories');
            $query_categories = $query
                ->find()
                ->where(['id =' => $release->category_id ]);

            foreach ($query_categories as $category) {

                // YEAR
                $main_categories[$category->group_categories][$year_select] += $release->value; 
                $sub_categories[$category->origin_id][$year_select] += $release->value;

                // MONTHS
                for ($i=1; $i < 13; $i++) { 

                    if(date_format($release->created, 'n') == $i){
                        $main_categories[$category->group_categories][$i] += $release->value;
                        $sub_categories[$category->origin_id][$i] += $release->value;
                    }
                }   
            }
        }

        $this->set('year_select', $year_select);
        $this->set('query_categories', $query_categories_all);
        $this->set('query_releases', $query_releases);
        $this->set('main_categories', $main_categories);
        $this->set('sub_categories', $sub_categories);

        // echo "<pre>";
        // print_r($main_categories);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($sub_categories);
        // echo "</pre>";

        // die();
    }

    public function financesReportsDreAnualHorizontal()
    {

        // Configura Layout da View
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Relatórios | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'reports');

        $date_now = Time::now();
        
        // Year
        if(isset($this->request->data['report_year'])){
            $year_select = $this->request->data['report_year'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        $total_accounts = 0;
        $account_selected_id = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
            ->find()
            ->where([
                'user_id =' => $this->Auth->user('id')
            ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        $main_categories = [];
        $sub_categories = [];

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories_all = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active 
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_categories_all as $category_all) {

            // YEAR
            $main_categories[$category_all->group_categories][$year_select] = 0;
            $sub_categories[$category_all->origin_id][$year_select] = 0;

            // MONTHS
            for ($i=1; $i < 13; $i++) { 
                $main_categories[$category_all->group_categories][$i] = 0;
                $sub_categories[$category_all->origin_id][$i] = 0;
            }            
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesReleases');
        $query_releases = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'YEAR(created) =' => $year_select
            ])
            ->order([ 'id DESC' ]);

        foreach ($query_releases as $release) {
        
            // Buscar registros
            $query = TableRegistry::get('BusinessCategories');
            $query_categories = $query
                ->find()
                ->where(['id =' => $release->category_id ]);

            foreach ($query_categories as $category) {

                // YEAR
                $main_categories[$category->group_categories][$year_select] += $release->value; 
                $sub_categories[$category->origin_id][$year_select] += $release->value;

                // MONTHS
                for ($i=1; $i < 13; $i++) { 

                    if(date_format($release->created, 'n') == $i){
                        $main_categories[$category->group_categories][$i] += $release->value;
                        $sub_categories[$category->origin_id][$i] += $release->value;
                    }
                }   
            }
        }

        $this->set('year_select', $year_select);
        $this->set('query_categories', $query_categories_all);
        $this->set('query_releases', $query_releases);
        $this->set('main_categories', $main_categories);
        $this->set('sub_categories', $sub_categories);

        // echo "<pre>";
        // print_r($main_categories);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($sub_categories);
        // echo "</pre>";

        // die();
    }

    public function financesReportsDreAnualVertical()
    {

        // Configura Layout da View
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Relatórios | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'reports');

        $date_now = Time::now();
        
        // Year
        if(isset($this->request->data['report_year'])){
            $year_select = $this->request->data['report_year'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        $total_accounts = 0;
        $account_selected_id = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
            ->find()
            ->where([
                'user_id =' => $this->Auth->user('id')
            ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        $main_categories = [];
        $sub_categories = [];

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories_all = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active 
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_categories_all as $category_all) {

            // YEAR
            $main_categories[$category_all->group_categories][$year_select] = 0;
            $sub_categories[$category_all->origin_id][$year_select] = 0;

            // MONTHS
            for ($i=1; $i < 13; $i++) { 
                $main_categories[$category_all->group_categories][$i] = 0;
                $sub_categories[$category_all->origin_id][$i] = 0;
            }            
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesReleases');
        $query_releases = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'YEAR(created) =' => $year_select
            ])
            ->order([ 'id DESC' ]);

        foreach ($query_releases as $release) {
        
            // Buscar registros
            $query = TableRegistry::get('BusinessCategories');
            $query_categories = $query
                ->find()
                ->where(['id =' => $release->category_id ]);

            foreach ($query_categories as $category) {

                // YEAR
                $main_categories[$category->group_categories][$year_select] += $release->value; 
                $sub_categories[$category->origin_id][$year_select] += $release->value;

                // MONTHS
                for ($i=1; $i < 13; $i++) { 

                    if(date_format($release->created, 'n') == $i){
                        $main_categories[$category->group_categories][$i] += $release->value;
                        $sub_categories[$category->origin_id][$i] += $release->value;
                    }
                }   
            }
        }

        $this->set('year_select', $year_select);
        $this->set('query_categories', $query_categories_all);
        $this->set('query_releases', $query_releases);
        $this->set('main_categories', $main_categories);
        $this->set('sub_categories', $sub_categories);

        // echo "<pre>";
        // print_r($main_categories);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($sub_categories);
        // echo "</pre>";

        // die();
    }

    public function financesReportsDreMensalDemonstracao()
    {

        // Configura Layout da View
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Relatórios | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'reports');

        $date_now = Time::now();
        
        // Year
        if(isset($this->request->data['report_year'])){
            $year_select = $this->request->data['report_year'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        $total_accounts = 0;
        $account_selected_id = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
            ->find()
            ->where([
                'user_id =' => $this->Auth->user('id')
            ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        $main_categories = [];
        $sub_categories = [];

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories_all = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active 
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_categories_all as $category_all) {

            // YEAR
            $main_categories[$category_all->group_categories][$year_select] = 0;
            $sub_categories[$category_all->origin_id][$year_select] = 0;

            // MONTHS
            for ($i=1; $i < 13; $i++) { 
                $main_categories[$category_all->group_categories][$i] = 0;
                $sub_categories[$category_all->origin_id][$i] = 0;
            }            
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesReleases');
        $query_releases = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'YEAR(created) =' => $year_select
            ])
            ->order([ 'id DESC' ]);

        foreach ($query_releases as $release) {
        
            // Buscar registros
            $query = TableRegistry::get('BusinessCategories');
            $query_categories = $query
                ->find()
                ->where(['id =' => $release->category_id ]);

            foreach ($query_categories as $category) {

                // YEAR
                $main_categories[$category->group_categories][$year_select] += $release->value; 
                $sub_categories[$category->origin_id][$year_select] += $release->value;

                // MONTHS
                for ($i=1; $i < 13; $i++) { 

                    if(date_format($release->created, 'n') == $i){
                        $main_categories[$category->group_categories][$i] += $release->value;
                        $sub_categories[$category->origin_id][$i] += $release->value;
                    }
                }   
            }
        }

        $this->set('year_select', $year_select);
        $this->set('query_categories', $query_categories_all);
        $this->set('query_releases', $query_releases);
        $this->set('main_categories', $main_categories);
        $this->set('sub_categories', $sub_categories);

        // echo "<pre>";
        // print_r($main_categories);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($sub_categories);
        // echo "</pre>";

        // die();
    }

    public function financesReportsDreMensalHorizontal()
    {

        // Configura Layout da View
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Relatórios | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'reports');

        $date_now = Time::now();
        
        // Year
        if(isset($this->request->data['report_year'])){
            $year_select = $this->request->data['report_year'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        $total_accounts = 0;
        $account_selected_id = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
            ->find()
            ->where([
                'user_id =' => $this->Auth->user('id')
            ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        $main_categories = [];
        $sub_categories = [];

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories_all = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active 
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_categories_all as $category_all) {

            // YEAR
            $main_categories[$category_all->group_categories][$year_select] = 0;
            $sub_categories[$category_all->origin_id][$year_select] = 0;

            // MONTHS
            for ($i=1; $i < 13; $i++) { 
                $main_categories[$category_all->group_categories][$i] = 0;
                $sub_categories[$category_all->origin_id][$i] = 0;
            }            
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesReleases');
        $query_releases = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'YEAR(created) =' => $year_select
            ])
            ->order([ 'id DESC' ]);

        foreach ($query_releases as $release) {
        
            // Buscar registros
            $query = TableRegistry::get('BusinessCategories');
            $query_categories = $query
                ->find()
                ->where(['id =' => $release->category_id ]);

            foreach ($query_categories as $category) {

                // YEAR
                $main_categories[$category->group_categories][$year_select] += $release->value; 
                $sub_categories[$category->origin_id][$year_select] += $release->value;

                // MONTHS
                for ($i=1; $i < 13; $i++) { 

                    if(date_format($release->created, 'n') == $i){
                        $main_categories[$category->group_categories][$i] += $release->value;
                        $sub_categories[$category->origin_id][$i] += $release->value;
                    }
                }   
            }
        }

        $this->set('year_select', $year_select);
        $this->set('query_categories', $query_categories_all);
        $this->set('query_releases', $query_releases);
        $this->set('main_categories', $main_categories);
        $this->set('sub_categories', $sub_categories);

        // echo "<pre>";
        // print_r($main_categories);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($sub_categories);
        // echo "</pre>";

        // die();
    }

    public function financesReportsDreMensalVertical()
    {

        // Configura Layout da View
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Relatórios | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'reports');

        $date_now = Time::now();
        
        // Year
        if(isset($this->request->data['report_year'])){
            $year_select = $this->request->data['report_year'];
        }else{
            $year_select = date_format($date_now, 'Y');
        }

        $total_accounts = 0;
        $account_selected_id = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
            ->find()
            ->where([
                'user_id =' => $this->Auth->user('id')
            ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        $main_categories = [];
        $sub_categories = [];

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories_all = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active 
            ])
            ->order([ 'id ASC' ]);

        foreach ($query_categories_all as $category_all) {

            // YEAR
            $main_categories[$category_all->group_categories][$year_select] = 0;
            $sub_categories[$category_all->origin_id][$year_select] = 0;

            // MONTHS
            for ($i=1; $i < 13; $i++) { 
                $main_categories[$category_all->group_categories][$i] = 0;
                $sub_categories[$category_all->origin_id][$i] = 0;
            }            
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesReleases');
        $query_releases = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'YEAR(created) =' => $year_select
            ])
            ->order([ 'id DESC' ]);

        foreach ($query_releases as $release) {
        
            // Buscar registros
            $query = TableRegistry::get('BusinessCategories');
            $query_categories = $query
                ->find()
                ->where(['id =' => $release->category_id ]);

            foreach ($query_categories as $category) {

                // YEAR
                $main_categories[$category->group_categories][$year_select] += $release->value; 
                $sub_categories[$category->origin_id][$year_select] += $release->value;

                // MONTHS
                for ($i=1; $i < 13; $i++) { 

                    if(date_format($release->created, 'n') == $i){
                        $main_categories[$category->group_categories][$i] += $release->value;
                        $sub_categories[$category->origin_id][$i] += $release->value;
                    }
                }   
            }
        }

        $this->set('year_select', $year_select);
        $this->set('query_categories', $query_categories_all);
        $this->set('query_releases', $query_releases);
        $this->set('main_categories', $main_categories);
        $this->set('sub_categories', $sub_categories);

        // echo "<pre>";
        // print_r($main_categories);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($sub_categories);
        // echo "</pre>";

        // die();
    }

    public function financesIndicators()
    {

        // Limite de memória
        ini_set('memory_limit', '256M');
        set_time_limit(0);

        // Configura Layout da View
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Indicadores | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'finances');
        $this->set('finances_select', 'indicators');

        $date_now = Date::now();
        $date_now = date_format($date_now, "Y-m-d H:i:s");

        if($this->request->is('post')) {
            $date_begin = $this->request->data['date_begin'];
            $date_begin = substr($date_begin,6 ,4)."-".substr($date_begin,3 ,2)."-".substr($date_begin,0 ,2).' 00:00:00';

            $date_end = $this->request->data['date_end'];
            $date_end = substr($date_end,6 ,4)."-".substr($date_end,3 ,2)."-".substr($date_end,0 ,2).' 00:00:00';

            $date_begin_input = $this->request->data['date_begin'];
            $date_end_input = $this->request->data['date_end'];
        }else{
            $date_begin = date('Y-m-', strtotime($date_now)).'01'.date(' H:i:s', strtotime($date_now));
            $date_end = date('Y-m-d H:i:s', strtotime($date_now));
            $date_begin_input = '';
            $date_end_input = '';
        }

        $total_receipt = 0;
        $total_payment = 0;

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // TERMS
        // Buscar registros
        $query = TableRegistry::get('Users');
        $query_access = $query
                ->find()
                ->where([
                    'id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_terms = $access->terms;
            $business_origin = $access->origin;
            $business_created = $access->created;
        }

        // FINANCES
        // Buscar registros
        $query = TableRegistry::get('BusinessCategories');
        $query_categories = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        $categories_values = [];
        
        foreach ($query_categories as $category) {
            $categories_values[$category->group_categories] = 0;
        }

        // RELEASES
        $month_vendas = [];
        $month_ticket_count = [];
        $month_ticket = [];
        $month_bruto = [];
        $month_liquido = [];

        for ($i=1; $i < 13; $i++) { 
            $month_vendas[$i] = 0;   
            $month_ticket_count[$i] = 0;
            $month_ticket[$i] = 0;
            $month_bruto[$i] = 0;
            $month_liquido[$i] = 0;
        }

        // Buscar registros
        $query = TableRegistry::get('FinancesReleases');
        $query_releases = $query
            ->find()
            ->where([ 
                'business_id =' => $business_active,
                'created >=' => $date_begin,
                'created <=' => $date_end
            ])
            ->order([ 'id DESC' ]);

        foreach ($query_releases as $release) {

            $month_active = date_format($release->created, "m");

            for ($i=1; $i < 13; $i++) { 
                
                if($month_active == $i){

                    $month_ticket_count[$i]++;

                    if($release->type == 'receipt'){
                        $month_vendas[$i] += $release->value;
                        $month_bruto[$i] += $release->value;
                        $month_liquido[$i] += $release->value;
                    }
        
                    if($release->type == 'payment'){
                        $month_liquido[$i] -= $release->value;
                    }

                    $month_ticket[$i] = $month_bruto[$i] / $month_ticket_count[$i];
                }
            }
            
            // FINANCES
            // Buscar registros
            $query = TableRegistry::get('BusinessCategories');
            $query_categories = $query
                ->find()
                ->where([ 'id =' => $release->category_id ]);
            
            foreach ($query_categories as $category) {
                $categories_values[$category->group_categories] += $release->value;
            }
        }

        $this->set('date_begin_input', $date_begin_input);
        $this->set('date_end_input', $date_end_input);
        $this->set('month_vendas', $month_vendas);
        $this->set('month_bruto', $month_bruto);
        $this->set('month_liquido', $month_liquido);
        $this->set('month_ticket', $month_ticket);
    }

    public function searchCnpj($cnpj_selected = null)
    {
        $date_now = Time::now();

        if ($this->request->is('post')) {
            
            $curl_handle=curl_init();
            curl_setopt($curl_handle, CURLOPT_URL,"https://www.receitaws.com.br/v1/cnpj/".$cnpj_selected);
            curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($curl_handle, CURLOPT_TIMEOUT, 5);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Link Contabilidade');
            $query = curl_exec($curl_handle);
            $resultado = json_decode($query, true);
            curl_close($curl_handle);

            if(isset($resultado['status'])){

                if($resultado['status'] != "ERROR"){
                                                    
                    $result = array(
                        'status' => 'ok',
                        'razao' => $resultado['nome'],
                        'fantasia' => $resultado['fantasia'],
                        'cep' => $resultado['cep'],
                        'logradouro' => $resultado['logradouro'],
                        'numero' => $resultado['numero'],
                        'complemento' => $resultado['complemento'],
                        'bairro' => $resultado['bairro'],
                        'municipio' => $resultado['municipio'],
                        'uf' => $resultado['uf'],
                        'telefone' => $resultado['telefone'],
                        'email' => $resultado['email']
                    );

                }else{
                    $result = array(
                        'status' => 'CNPJ inválido!'
                    );
                }

            }else{
                $result = array(
                    'status' => 'error'
                );
            }

            $this->set(compact('result'));
        }

    }

    public function tasks()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Minhas obrigações | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
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

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([ 'id =' => $business_active ]);
  
        // foreach ($query_business as $business) {
        //     $service_business = $business->type;
        //     $taxation_business = $business->taxation;
        //     $action_business = $business->action;

        //     echo $service_business;
        // }


        // Buscar registros
        $query = TableRegistry::get('Tasks');
        $query_all_tasks = $query
            ->find()
            ->where([ 'business_id =' => $business_active ]);

        foreach ($query_all_tasks as $task) {
            $list_status_tasks[$task->task_fixed_id] = $task->status;
            $list_date_tasks[$task->task_fixed_id][date_format($task->updated, 'Ymd')] = 'ok';
        }  

        // Buscar registros
        $query = TableRegistry::get('TasksFixed');
        $query_all_tasks_fixed = $query
            ->find()
            ->where([
                'notification_type =' => 'all'
            ])
            ->OrWhere([
                'notification_type =' => 'client'
            ])
            ->order([
                'id ASC'
            ]);

        // foreach ($query_all_tasks_fixed as $task) {
        //     echo $task->title."<br>";
        // }

        // die();

        $this->set('all_business', $query_business);
        $this->set('all_tasks', $query_all_tasks);
        $this->set('all_tasks_fixed', $query_all_tasks_fixed);
        $this->set('list_status_tasks', $list_status_tasks);
        $this->set('list_date_tasks', $list_date_tasks);
        $this->set('styles_page', $styles_page);

    }

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function importItens($type = null)
    {

        $row = 0;
        $date_now = Time::now();

        if ($this->request->is('post')) {

            $business_id = $this->request->data['file_business_id'];

            if($type == "customers"){ $import_table = 'BusinessCustomers'; }
            if($type == "partners"){ $import_table = 'BusinessPartners'; }
            if($type == "employees"){ $import_table = 'BusinessEmployees'; }
            if($type == "providers"){ $import_table = 'BusinessProviders'; }

            // Import Supert
            if (isset($_FILES['file_upload_import'])){

                $file_import = $_FILES['file_upload_import']['tmp_name'];
                $handle = fopen($file_import, "r");

                while(($filesop = fgetcsv($handle, 1000, ";")) !== false){

                    if($row > 0){

                        // Cria novo cliente
                        $customers = TableRegistry::get($import_table);
                        $customer = $customers->newEntity();
                        $customer->business_id = $business_id;
                        $customer->phone = $filesop[0];
                        $customer->email = $filesop[1];
                        $customer->type = $filesop[2];
                        $customer->pj_document = $filesop[3];
                        $customer->pj_fantasia = utf8_encode($filesop[4]);
                        $customer->pj_razao = utf8_encode($filesop[5]);
                        $customer->pj_insc = $filesop[6];
                        $customer->pf_document = $filesop[7];
                        $customer->pf_name = utf8_encode($filesop[8]);
                        $customer->mobile = $filesop[9];
                        $customer->contact = utf8_encode($filesop[10]);
                        $customer->zipcode = $filesop[11];
                        $customer->address = utf8_encode($filesop[12]);
                        $customer->number = $filesop[13];
                        $customer->complement = utf8_encode($filesop[14]);
                        $customer->district = utf8_encode($filesop[15]);
                        $customer->city = utf8_encode($filesop[16]);
                        $customer->state = utf8_encode($filesop[17]);
                        $customer->country = utf8_encode($filesop[18]);
                        $customer->bank = utf8_encode($filesop[19]);
                        $customer->agency = $filesop[20];
                        $customer->account = $filesop[21];
                        $customer->account_type = utf8_encode($filesop[22]);
                        $customer->site = $filesop[23];
                        $customer->created = $date_now;
                        $customer->updated = $date_now;
                        $customers->save($customer);   
                    }
                    
                    $row++;
                }

                fclose($handle);
            }
        }

        $result = array(
            'status' => 'ok'
        );

        $this->set(compact('result'));
    }

    // ::::::::::::::::::::::::::::::::::::::::::
    // ::::  
    // ::::  NOTAS FISCAIS
    // ::::  
    // ::::::::::::::::::::::::::::::::::::::::::

    public function nf()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Notas fiscais | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'nf');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
        $this->set('business_id', $business_active);

        // Buscar registros
        $query = TableRegistry::get('Nf');
        $query_nf = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

            // Buscar registros
        $query = TableRegistry::get('FinancesAccounts');
        $query_accounts = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessPartners');
        $query_partners = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessEmployees');
        $query_employees = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessProviders');
        $query_providers = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        // Buscar registros
        $query = TableRegistry::get('BusinessCustomers');
        $query_customers = $query
            ->find()
            ->where([ 'business_id =' => $business_active ])
            ->order([ 'id ASC' ]);

        $this->set('query_customers', $query_customers);
        $this->set('query_providers', $query_providers);
        $this->set('query_employees', $query_employees);
        $this->set('query_partners', $query_partners);
        $this->set('query_accounts', $query_accounts);
        $this->set('query_nf', $query_nf);

    }

    
    // ::::::::::::::::::::::::::::::::::::::::::
    // ::::  
    // ::::  ESTOQUE
    // ::::  
    // ::::::::::::::::::::::::::::::::::::::::::

    public function stock()
    {
        $this->viewBuilder()->layout('client');
        $this->set('title', 'Estoque | ');
        $this->set('script', ['client']);
        $this->set('css', ['default', 'client']);
        $this->set('menu_active', 'nf');

        // Buscar registros
        $query = TableRegistry::get('AccessBusiness');
        $query_access = $query
                ->find()
                ->where([
                    'user_id =' => $this->Auth->user('id')
                ]);

        foreach ($query_access as $access) {
            $business_active = $access->business_id;
        }

        // Buscar registros
        $query = TableRegistry::get('Business');
        $query_business = $query
                ->find()
                ->where([
                    'id =' => $business_active
                ]);

        $this->set('all_business', $query_business);
    }
}
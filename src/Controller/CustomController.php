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
use Cake\Utility\Xml;


class CustomController extends AppController
{

    public function initialize()
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Auth');

        $date_now = Time::now();

        $this->set('id_user', $this->Auth->user('id'));
        $this->set('image_user', $this->Auth->user('image'));
        $this->set('email_user', $this->Auth->user('username'));
        $this->set('name_user', $this->Auth->user('name'));
        $this->set('lastname_user', $this->Auth->user('lastname'));
        $this->set('active_login', $this->Auth->user('active_login'));
        $this->set('date_now', $date_now);
        $this->set('styles_page', '');
    }

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
     public function customersAdd()
     {
         if ($this->request->is('post')) {
 
             $date_now = Time::now();
 
             // Cria nova Quotations
             $query = TableRegistry::get('BusinessCustomers');
             $customers = $query->newEntity();
             $customers->business_id = $this->request->data['business_id'];
             $customers->type = $this->request->data['customer_type'];
             $customers->pj_document = $this->request->data['customer_pj_document'];
             $customers->pj_fantasia = $this->request->data['customer_pj_fantasia'];
             $customers->pj_razao = $this->request->data['customer_pj_razao'];
             $customers->pj_insc = $this->request->data['customer_pj_insc'];
             $customers->pf_document = $this->request->data['customer_pf_document'];
             $customers->pf_name = $this->request->data['customer_pf_name'];
             $customers->email = $this->request->data['customer_email'];
             $customers->phone = $this->request->data['customer_phone'];
             $customers->mobile = $this->request->data['customer_mobile'];
             $customers->contact = $this->request->data['customer_contact'];
             $customers->zipcode = $this->request->data['customer_zipcode'];
             $customers->address = $this->request->data['customer_address'];
             $customers->number = $this->request->data['customer_number'];
             $customers->complement = $this->request->data['customer_complement'];
             $customers->district = $this->request->data['customer_district'];
             $customers->city = $this->request->data['customer_city'];
             $customers->state = $this->request->data['customer_state'];
             $customers->country = $this->request->data['customer_country'];
             $customers->bank = $this->request->data['customer_bank'];
             $customers->agency = $this->request->data['customer_agency'];
             $customers->account = $this->request->data['customer_account'];
             $customers->account_type = $this->request->data['customer_account_type'];
             $customers->site = $this->request->data['customer_site'];
             $customers->created = $date_now;
             $query->save($customers);
 
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
     public function providersAdd()
     {
         if ($this->request->is('post')) {
 
             $date_now = Time::now();
 
             // Cria nova Quotations
             $query = TableRegistry::get('BusinessProviders');
             $providers = $query->newEntity();
             $providers->business_id = $this->request->data['business_id'];
             $providers->type = $this->request->data['provider_type'];
             $providers->pj_document = $this->request->data['provider_pj_document'];
             $providers->pj_fantasia = $this->request->data['provider_pj_fantasia'];
             $providers->pj_razao = $this->request->data['provider_pj_razao'];
             $providers->pj_insc = $this->request->data['provider_pj_insc'];
             $providers->pf_document = $this->request->data['provider_pf_document'];
             $providers->pf_name = $this->request->data['provider_pf_name'];
             $providers->email = $this->request->data['provider_email'];
             $providers->phone = $this->request->data['provider_phone'];
             $providers->mobile = $this->request->data['provider_mobile'];
             $providers->contact = $this->request->data['provider_contact'];
             $providers->zipcode = $this->request->data['provider_zipcode'];
             $providers->address = $this->request->data['provider_address'];
             $providers->number = $this->request->data['provider_number'];
             $providers->complement = $this->request->data['provider_complement'];
             $providers->district = $this->request->data['provider_district'];
             $providers->city = $this->request->data['provider_city'];
             $providers->state = $this->request->data['provider_state'];
             $providers->country = $this->request->data['provider_country'];
             $providers->bank = $this->request->data['provider_bank'];
             $providers->agency = $this->request->data['provider_agency'];
             $providers->account = $this->request->data['provider_account'];
             $providers->account_type = $this->request->data['provider_account_type'];
             $providers->site = $this->request->data['provider_site'];
             $providers->created = $date_now;
             $query->save($providers);
 
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
     public function partnersAdd()
     {
         if ($this->request->is('post')) {
 
             $date_now = Time::now();
 
             // Cria nova Quotations
             $query = TableRegistry::get('BusinessPartners');
             $partners = $query->newEntity();
             $partners->business_id = $this->request->data['business_id'];
             $partners->type = $this->request->data['partner_type'];
             $partners->pj_document = $this->request->data['partner_pj_document'];
             $partners->pj_fantasia = $this->request->data['partner_pj_fantasia'];
             $partners->pj_razao = $this->request->data['partner_pj_razao'];
             $partners->pj_insc = $this->request->data['partner_pj_insc'];
             $partners->pf_document = $this->request->data['partner_pf_document'];
             $partners->pf_name = $this->request->data['partner_pf_name'];
             $partners->email = $this->request->data['partner_email'];
             $partners->phone = $this->request->data['partner_phone'];
             $partners->mobile = $this->request->data['partner_mobile'];
             $partners->contact = $this->request->data['partner_contact'];
             $partners->zipcode = $this->request->data['partner_zipcode'];
             $partners->address = $this->request->data['partner_address'];
             $partners->number = $this->request->data['partner_number'];
             $partners->complement = $this->request->data['partner_complement'];
             $partners->district = $this->request->data['partner_district'];
             $partners->city = $this->request->data['partner_city'];
             $partners->state = $this->request->data['partner_state'];
             $partners->country = $this->request->data['partner_country'];
             $partners->bank = $this->request->data['partner_bank'];
             $partners->agency = $this->request->data['partner_agency'];
             $partners->account = $this->request->data['partner_account'];
             $partners->account_type = $this->request->data['partner_account_type'];
             $partners->site = $this->request->data['partner_site'];
             $partners->created = $date_now;
             $query->save($partners);
 
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
     public function employeesAdd()
     {
         if ($this->request->is('post')) {
 
             $date_now = Time::now();
 
             // Cria nova Quotations
             $query = TableRegistry::get('BusinessEmployees');
             $employees = $query->newEntity();
             $employees->business_id = $this->request->data['business_id'];
             $employees->type = $this->request->data['employee_type'];
             $employees->pj_document = $this->request->data['employee_pj_document'];
             $employees->pj_fantasia = $this->request->data['employee_pj_fantasia'];
             $employees->pj_razao = $this->request->data['employee_pj_razao'];
             $employees->pj_insc = $this->request->data['employee_pj_insc'];
             $employees->pf_document = $this->request->data['employee_pf_document'];
             $employees->pf_name = $this->request->data['employee_pf_name'];
             $employees->email = $this->request->data['employee_email'];
             $employees->phone = $this->request->data['employee_phone'];
             $employees->mobile = $this->request->data['employee_mobile'];
             $employees->contact = $this->request->data['employee_contact'];
             $employees->zipcode = $this->request->data['employee_zipcode'];
             $employees->address = $this->request->data['employee_address'];
             $employees->number = $this->request->data['employee_number'];
             $employees->complement = $this->request->data['employee_complement'];
             $employees->district = $this->request->data['employee_district'];
             $employees->city = $this->request->data['employee_city'];
             $employees->state = $this->request->data['employee_state'];
             $employees->country = $this->request->data['employee_country'];
             $employees->bank = $this->request->data['employee_bank'];
             $employees->agency = $this->request->data['employee_agency'];
             $employees->account = $this->request->data['employee_account'];
             $employees->account_type = $this->request->data['employee_account_type'];
             $employees->site = $this->request->data['employee_site'];
             $employees->created = $date_now;
             $query->save($employees);
 
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


    //  UPDATE
    // ::::::::::::::::::

    /**
     * Index
     *
     * Exibe a visão Geral da aplicação
     *
     * @access public
     * @return void
     */
    public function customersUpdate()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Atualiza Quotation
            $query = TableRegistry::get('BusinessCustomers');
            $query_customers = $query->query();
            $query_customers->update()
                ->set([
                    'type' => $this->request->data['customer_type'],
                    'pj_document' => $this->request->data['customer_pj_document'],
                    'pj_fantasia' => $this->request->data['customer_pj_fantasia'],
                    'pj_razao' => $this->request->data['customer_pj_razao'],
                    'pj_insc' => $this->request->data['customer_pj_insc'],
                    'pf_document' => $this->request->data['customer_pf_document'],
                    'pf_name' => $this->request->data['customer_pf_name'],
                    'email' => $this->request->data['customer_email'],
                    'phone' => $this->request->data['customer_phone'],
                    'mobile' => $this->request->data['customer_mobile'],
                    'contact' => $this->request->data['customer_contact'],
                    'zipcode' => $this->request->data['customer_zipcode'],
                    'address' => $this->request->data['customer_address'],
                    'number' => $this->request->data['customer_number'],
                    'complement' => $this->request->data['customer_complement'],
                    'district' => $this->request->data['customer_district'],
                    'city' => $this->request->data['customer_city'],
                    'state' => $this->request->data['customer_state'],
                    'country' => $this->request->data['customer_country'],
                    'bank' => $this->request->data['customer_bank'],
                    'agency' => $this->request->data['customer_agency'],
                    'account' => $this->request->data['customer_account'],
                    'account_type' => $this->request->data['customer_account_type'],
                    'site' => $this->request->data['customer_site']
                ])
                ->where(['id' => $this->request->data['customer_id']])
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
    public function providersUpdate()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Atualiza Quotation
            $query = TableRegistry::get('BusinessProviders');
            $query_customers = $query->query();
            $query_customers->update()
                ->set([
                    'type' => $this->request->data['provider_type'],
                    'pj_document' => $this->request->data['provider_pj_document'],
                    'pj_fantasia' => $this->request->data['provider_pj_fantasia'],
                    'pj_razao' => $this->request->data['provider_pj_razao'],
                    'pj_insc' => $this->request->data['provider_pj_insc'],
                    'pf_document' => $this->request->data['provider_pf_document'],
                    'pf_name' => $this->request->data['provider_pf_name'],
                    'email' => $this->request->data['provider_email'],
                    'phone' => $this->request->data['provider_phone'],
                    'mobile' => $this->request->data['provider_mobile'],
                    'contact' => $this->request->data['provider_contact'],
                    'zipcode' => $this->request->data['provider_zipcode'],
                    'address' => $this->request->data['provider_address'],
                    'number' => $this->request->data['provider_number'],
                    'complement' => $this->request->data['provider_complement'],
                    'district' => $this->request->data['provider_district'],
                    'city' => $this->request->data['provider_city'],
                    'state' => $this->request->data['provider_state'],
                    'country' => $this->request->data['provider_country'],
                    'bank' => $this->request->data['provider_bank'],
                    'agency' => $this->request->data['provider_agency'],
                    'account' => $this->request->data['provider_account'],
                    'account_type' => $this->request->data['provider_account_type'],
                    'site' => $this->request->data['provider_site']
                ])
                ->where(['id' => $this->request->data['provider_id']])
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
    public function partnersUpdate()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Atualiza Quotation
            $query = TableRegistry::get('BusinessPartners');
            $query_customers = $query->query();
            $query_customers->update()
                ->set([
                    'type' => $this->request->data['partner_type'],
                    'pj_document' => $this->request->data['partner_pj_document'],
                    'pj_fantasia' => $this->request->data['partner_pj_fantasia'],
                    'pj_razao' => $this->request->data['partner_pj_razao'],
                    'pj_insc' => $this->request->data['partner_pj_insc'],
                    'pf_document' => $this->request->data['partner_pf_document'],
                    'pf_name' => $this->request->data['partner_pf_name'],
                    'email' => $this->request->data['partner_email'],
                    'phone' => $this->request->data['partner_phone'],
                    'mobile' => $this->request->data['partner_mobile'],
                    'contact' => $this->request->data['partner_contact'],
                    'zipcode' => $this->request->data['partner_zipcode'],
                    'address' => $this->request->data['partner_address'],
                    'number' => $this->request->data['partner_number'],
                    'complement' => $this->request->data['partner_complement'],
                    'district' => $this->request->data['partner_district'],
                    'city' => $this->request->data['partner_city'],
                    'state' => $this->request->data['partner_state'],
                    'country' => $this->request->data['partner_country'],
                    'bank' => $this->request->data['partner_bank'],
                    'agency' => $this->request->data['partner_agency'],
                    'account' => $this->request->data['partner_account'],
                    'account_type' => $this->request->data['partner_account_type'],
                    'site' => $this->request->data['partner_site']
                ])
                ->where(['id' => $this->request->data['partner_id']])
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
    public function employeesUpdate()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Atualiza Quotation
            $query = TableRegistry::get('BusinessEmployees');
            $query_customers = $query->query();
            $query_customers->update()
                ->set([
                    'type' => $this->request->data['employee_type'],
                    'pj_document' => $this->request->data['employee_pj_document'],
                    'pj_fantasia' => $this->request->data['employee_pj_fantasia'],
                    'pj_razao' => $this->request->data['employee_pj_razao'],
                    'pj_insc' => $this->request->data['employee_pj_insc'],
                    'pf_document' => $this->request->data['employee_pf_document'],
                    'pf_name' => $this->request->data['employee_pf_name'],
                    'email' => $this->request->data['employee_email'],
                    'phone' => $this->request->data['employee_phone'],
                    'mobile' => $this->request->data['employee_mobile'],
                    'contact' => $this->request->data['employee_contact'],
                    'zipcode' => $this->request->data['employee_zipcode'],
                    'address' => $this->request->data['employee_address'],
                    'number' => $this->request->data['employee_number'],
                    'complement' => $this->request->data['employee_complement'],
                    'district' => $this->request->data['employee_district'],
                    'city' => $this->request->data['employee_city'],
                    'state' => $this->request->data['employee_state'],
                    'country' => $this->request->data['employee_country'],
                    'bank' => $this->request->data['employee_bank'],
                    'agency' => $this->request->data['employee_agency'],
                    'account' => $this->request->data['employee_account'],
                    'account_type' => $this->request->data['employee_account_type'],
                    'site' => $this->request->data['employee_site']
                ])
                ->where(['id' => $this->request->data['employee_id']])
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
    public function paymentsUpdate()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            $date_maturity = $this->request->data['payment_maturity'];
             $date_maturity =  substr($date_maturity,6 ,4)."-".substr($date_maturity,3 ,2)."-".substr($date_maturity,0 ,2)." 00:00";
 
             $value = str_replace(".", "", $this->request->data['payment_value']);
             $value = str_replace(",", ".", $value);

             if($this->request->data['payment_type'] == "customer"){
                $type = 'customer';
                $type_id = $this->request->data['payment_customer'];
             }

             if($this->request->data['payment_type'] == "provider"){
                $type = 'provider';
                $type_id = $this->request->data['payment_provider'] ;
             }

             if($this->request->data['payment_type'] == "employee"){
                $type = 'employee';
                $type_id = $this->request->data['payment_employee'] ;
             }

             if($this->request->data['payment_type'] == "partner"){
                $type = 'partner';
                $type_id = $this->request->data['payment_partner'] ;
             }

             if($this->request->data['payment_type'] == "none"){
                $type = 'none';
                $type_id = 0;
             }

            // Atualiza Quotation
            $query = TableRegistry::get('FinancesPayments');
            $query_customers = $query->query();
            $query_customers->update()
                ->set([
                    'business_id' => $this->request->data['business_id'],
                    'account_id' => $this->request->data['payment_account'],
                    'category_id' => $this->request->data['payment_category_id'],
                    'type_id' => $type_id,
                    'type' => $type,
                    'title' => $this->request->data['payment_title'],
                    'maturity' => $date_maturity,
                    'value' => $value,
                    'status' => $this->request->data['payment_status'],
                    'created' => $date_now
                ])
                ->where(['id' => $this->request->data['payment_id']])
                ->execute();

            if($this->request->data['payment_status'] == 1){

                // Cria nova Quotations
                $query = TableRegistry::get('FinancesReleases');
                $releases = $query->newEntity();
                $releases->business_id = $this->request->data['business_id'];
                $releases->account_id = $this->request->data['payment_account'];
                $releases->category_id = $this->request->data['payment_category_id'];
                $releases->type_id = $this->request->data['payment_id'];
                $releases->type = 'payment';
                $releases->title = $this->request->data['payment_title'];
                $releases->value = $value * (-1);
                $releases->created = $date_maturity;
                $query->save($releases);
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
    public function receiptsUpdate()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            $date_maturity = $this->request->data['receipt_maturity'];
            $date_maturity =  substr($date_maturity,6 ,4)."-".substr($date_maturity,3 ,2)."-".substr($date_maturity,0 ,2)." 00:00";
 
             $value = str_replace(".", "", $this->request->data['receipt_value']);
             $value = str_replace(",", ".", $value);

             if($this->request->data['receipt_type'] == "customer"){
                $type = 'customer';
                $type_id = $this->request->data['receipt_customer'];
             }

             if($this->request->data['receipt_type'] == "provider"){
                $type = 'provider';
                $type_id = $this->request->data['receipt_provider'] or $this->request->data['receipt_customer'] ;
             }

             if($this->request->data['receipt_type'] == "employee"){
                $type = 'employee';
                $type_id = $this->request->data['receipt_employee'] or $this->request->data['receipt_customer'] ;
             }

             if($this->request->data['receipt_type'] == "partner"){
                $type = 'partner';
                $type_id = $this->request->data['receipt_partner'] or $this->request->data['receipt_customer'] ;
             }

             if($this->request->data['receipt_type'] == "none"){
                $type = 'none';
                $type_id = 0;
             }

            // Atualiza Quotation
            $query = TableRegistry::get('FinancesReceipts');
            $query_customers = $query->query();
            $query_customers->update()
                ->set([
                    'business_id' => $this->request->data['business_id'],
                    'account_id' => $this->request->data['receipt_account'],
                    'category_id' => $this->request->data['receipt_category_id'],
                    'type_id' => $type_id,
                    'type' => $type,
                    'title' => $this->request->data['receipt_title'],
                    'maturity' => $date_maturity,
                    'value' => $value,
                    'status' => $this->request->data['receipt_status'],
                    'created' => $date_now
                ])
                ->where(['id' => $this->request->data['receipt_id']])
                ->execute();

            if($this->request->data['receipt_status'] == 1){

                // Cria nova Quotations
                $query = TableRegistry::get('FinancesReleases');
                $releases = $query->newEntity();
                $releases->business_id = $this->request->data['business_id'];
                $releases->account_id = $this->request->data['receipt_account'];
                $releases->category_id = $this->request->data['receipt_category_id'];
                $releases->type_id = $this->request->data['receipt_id'];
                $releases->type = 'receipt';
                $releases->title = $this->request->data['receipt_title'];
                $releases->value = $value;
                $releases->balance = $value;
                $releases->created = $date_maturity;
                $releases->updated = $date_maturity;
                $query->save($releases);
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
     public function accountsAdd()
     {
         if ($this->request->is('post')) {
 
             $date_now = Time::now();

             $total = str_replace(".", "", $this->request->data['account_total']);

             $date_note =  $this->request->data['account_date'];
             $date_note =  substr($date_note,6 ,4)."-".substr($date_note,3 ,2)."-".substr($date_note,0 ,2);
 
             // Cria nova Quotations
             $query = TableRegistry::get('FinancesAccounts');
             $accounts = $query->newEntity();
             $accounts->business_id = $this->request->data['business_id'];
             $accounts->bank = $this->request->data['account_bank'];
             $accounts->agency = $this->request->data['account_agency'];
             $accounts->account = $this->request->data['account_account'];
             $accounts->account_type = $this->request->data['account_account_type'];
             $accounts->date = $this->request->data['account_date'];
             $accounts->total = $total;
             $accounts->created = $date_now;
             $query->save($accounts);

             // Cria nova Quotations
             $query = TableRegistry::get('FinancesReleases');
             $releases = $query->newEntity();
             $releases->business_id = $this->request->data['business_id'];
             $releases->account_id = $accounts->id;
             $releases->category_id = 0;
             $releases->type_id = 0;
             $releases->type = 'receipt';
             $releases->title = 'Saldo inicial';
             $releases->value = $total;
             $releases->balance = $total;
             $releases->created = $date_note." 00:00";
             $query->save($releases);
 
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
     public function paymentsAdd()
     {
         if ($this->request->is('post')) {
 
             $date_now = Time::now();

             $date_maturity = $this->request->data['payment_maturity'];
             $date_maturity =  substr($date_maturity,6 ,4)."-".substr($date_maturity,3 ,2)."-".substr($date_maturity,0 ,2)." 00:00";
 
             $value = str_replace(".", "", $this->request->data['payment_value']);
             $value = str_replace(",", ".", $value);

             if($this->request->data['payment_type'] == "customer"){
                $type = 'customer';
                $type_id = $this->request->data['payment_customer'];
             }

             if($this->request->data['payment_type'] == "provider"){
                $type = 'provider';
                $type_id = $this->request->data['payment_provider'];
             }

             if($this->request->data['payment_type'] == "employee"){
                $type = 'employee';
                $type_id = $this->request->data['payment_employee'];
             }

             if($this->request->data['payment_type'] == "partner"){
                $type = 'partner';
                $type_id = $this->request->data['payment_partner'];
             }

             if($this->request->data['payment_type'] == "none"){
                $type = 'none';
                $type_id = 0;
             }

             error_log(
                print_r(
                    $this->request->data, true
                )
                );

             // Cria nova Quotations
             $query = TableRegistry::get('FinancesPayments');
             $payments = $query->newEntity();
             $payments->business_id = $this->request->data['business_id'];
             $payments->account_id = $this->request->data['payment_account'];
             $payments->category_id = $this->request->data['payment_category_id'];
             $payments->type_id = $type_id;
             $payments->type = $type;
             $payments->title = $this->request->data['payment_title'];
             $payments->maturity = $date_maturity;
             $payments->value = $value;
             $payments->created = $date_now;
             $payments->updated = $date_now;

             // Missing Values  
             $payments->fees = $this->request->data['payment_juros'];
             $payments->fine = $this->request->data['payment_multa'];
             $payments->recurrent = $this->request->data['payment_recurrent'];
             $payments->division = $this->request->data['payment_division'];
             $payments->status = 0;

             $query->save($payments);
 
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
     public function receiptsAdd()
     {
         if ($this->request->is('post')) {
 
             $date_now = Time::now();

             $date_maturity = $this->request->data['receipt_maturity'];
             $date_maturity =  substr($date_maturity,6 ,4)."-".substr($date_maturity,3 ,2)."-".substr($date_maturity,0 ,2)." 00:00";
 
             $value = str_replace(".", "", $this->request->data['receipt_value']);
             $value = str_replace(",", ".", $value);
 
             if($this->request->data['receipt_type'] == "customer"){
                $type = 'customer';
                $type_id = $this->request->data['receipt_customer'];
             }

             if($this->request->data['receipt_type'] == "provider"){
                $type = 'provider';
                $type_id = $this->request->data['receipt_provider'];
             }

             if($this->request->data['receipt_type'] == "employee"){
                $type = 'employee';
                $type_id = $this->request->data['receipt_employee'];
             }

             if($this->request->data['receipt_type'] == "partner"){
                $type = 'partner';
                $type_id = $this->request->data['receipt_partner'];
             }

             if($this->request->data['receipt_type'] == "none"){
                $type = 'none';
                $type_id = 0;
             }

             // Cria nova Quotations
             $query = TableRegistry::get('FinancesReceipts');
             $receipts = $query->newEntity();
             $receipts->business_id = $this->request->data['business_id'];
             $receipts->account_id = $this->request->data['receipt_account'];
             $receipts->category_id = $this->request->data['receipt_category_id'];
             $receipts->type = $type;
             $receipts->type_id = $type_id;
             $receipts->title = $this->request->data['receipt_title'];
             $receipts->maturity = $date_maturity;
             $receipts->value = $value;
             $receipts->created = $date_now;
             $receipts->updated = $date_now;

             // Missing Values  
             $receipts->fees = $this->request->data['receipt_juros'];
             $receipts->fine = $this->request->data['receipt_multa'];
             $receipts->recurrent = $this->request->data['receipt_recurrent'];
             $receipts->division = $this->request->data['receipt_division'];
             $receipts->status = 0;

             $query->save($receipts);
 
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
    public function categoriesAdd()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Cria nova Quotations
            $query = TableRegistry::get('BusinessCategories');
            $categories = $query->newEntity();
            $categories->business_id = $this->request->data['business_id'];
            $categories->type = $this->request->data['category_type'];
            $categories->group_categories = $this->request->data['category_group'];
            $categories->name = $this->request->data['category_name'];
            $categories->created = $date_now;
            $query->save($categories);

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
    public function filesAdd()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();
            

            if(!empty($_FILES['file_upload']['name'])){

                // Upload document
                $uploaddir =  $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/';
                $ext = explode(".", $_FILES['file_upload']['name']);
                $ext = end($ext);

                $url_document = $this->request->data['file_business_id']."_".date_format($date_now, 'dmYHms')."_".$this->request->data['file_item_id'].".".$ext;

                $uploadfile = $uploaddir.($url_document);
                move_uploaded_file($_FILES['file_upload']['tmp_name'], $uploadfile);
            }

            // Cria nova Quotations
            $query = TableRegistry::get('FinancesFiles');
            $files = $query->newEntity();
            $files->business_id = $this->request->data['file_business_id'];
            $files->item_id = $this->request->data['file_item_id'];
            $files->url = $url_document;
            $files->created = $date_now;
            $query->save($files);

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

            // Cria nova Quotations
            $query = TableRegistry::get('FinancesNotes');
            $notes = $query->newEntity();
            $notes->business_id = $this->request->data['note_business_id'];
            $notes->item_id = $this->request->data['note_item_id'];
            $notes->text = $this->request->data['note_text'];
            $notes->created = $date_now;
            $query->save($notes);

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
     public function nfAdd()
     {
         if ($this->request->is('post')) {
 
             $date_now = Time::now();

             $date_maturity = $this->request->data['nf_maturity'];
             $date_maturity =  substr($date_maturity,6 ,4)."-".substr($date_maturity,3 ,2)."-".substr($date_maturity,0 ,2)." 00:00";
 
             $value = str_replace(".", "", $this->request->data['nf_value']);
             $value = str_replace(",", ".", $value);
 
             if($this->request->data['nf_client_type'] == "customer"){
                $type = 'customer';
                $type_id = $this->request->data['nf_customer'];
             }

             if($this->request->data['nf_client_type'] == "provider"){
                $type = 'provider';
                $type_id = $this->request->data['nf_provider'];
             }

             if($this->request->data['nf_client_type'] == "employee"){
                $type = 'employee';
                $type_id = $this->request->data['nf_employee'];
             }

             if($this->request->data['nf_client_type'] == "partner"){
                $type = 'partner';
                $type_id = $this->request->data['nf_partner'];
             }

             if($this->request->data['nf_client_type'] == "none"){
                $type = 'none';
                $type_id = 0;
             }
             
             // Cria nova Quotations
             $query = TableRegistry::get('nf');
             $nf = $query->newEntity();
             $nf->business_id = $this->request->data['business_id'];
             $nf->type_client = $type;
             $nf->client_id = $type_id;
             $nf->type = $this->request->data['nf_type'];
             $nf->description = $this->request->data['nf_description'];
             $nf->maturity = $date_maturity;
             $nf->amount = $value;
             $nf->plug_idIntegracao = "";
            //  $nf-plug_prestador = 
            //  $nf-plug_id = 
            //  $nf-plug_protocol = 
             $nf->status = 1;
             $nf->created = $date_now;
             $query->save($nf);
 
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


    // DELETE
    // updateStatusTaxe
    public function customersDelete($customer_id = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('BusinessCustomers');
            $query_customers = $query->query();
            $query_customers->delete()
                ->where(['id' => $customer_id])
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
    public function providersDelete($provider_id = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('BusinessProviders');
            $query_providers = $query->query();
            $query_providers->delete()
                ->where(['id' => $provider_id])
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
    public function employeesDelete($employee_id = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('BusinessEmployees');
            $query_employees = $query->query();
            $query_employees->delete()
                ->where(['id' => $employee_id])
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
    public function partnersDelete($partner_id = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('BusinessPartners');
            $query_partners = $query->query();
            $query_partners->delete()
                ->where(['id' => $partner_id])
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
    public function receiptsDelete($receipt_id = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('FinancesReceipts');
            $query_receipts = $query->query();
            $query_receipts->delete()
                ->where(['id' => $receipt_id])
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
    public function paymentsDelete($payment_id = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('FinancesPayments');
            $query_payments = $query->query();
            $query_payments->delete()
                ->where(['id' => $payment_id])
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
    public function categoriesDelete($categorie_id = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('BusinessCategories');
            $query_categories = $query->query();
            $query_categories->delete()
                ->where(['id' => $categorie_id])
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

    // DELETE
    // updateStatusTaxe
    public function accountsDelete($account_id = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('FinancesAccounts');
            $query_accounts = $query->query();
            $query_accounts->delete()
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

    // DELETE
    // updateStatusTaxe
    public function filesDelete($file_id = null)
    {
        if ($this->request->is('post')) {

            // Buscar registros
            $query = TableRegistry::get('FinancesFiles');
            $query_documents = $query
                ->find()
                ->where([
                    'id =' => $file_id
                ]);

            foreach ($query_documents as $document) {
                unlink( $_SERVER['DOCUMENT_ROOT'] . '/uploads/files/'.$document->url);
            }

            // Atualiza Quotation
            $query = TableRegistry::get('FinancesFiles');
            $query_files = $query->query();
            $query_files->delete()
                ->where(['id' => $file_id])
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

    // DELETE
    // updateStatusTaxe
    public function notesDelete($note_id = null)
    {
        if ($this->request->is('post')) {

            // Atualiza Quotation
            $query = TableRegistry::get('FinancesNotes');
            $query_notes = $query->query();
            $query_notes->delete()
                ->where(['id' => $note_id])
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
    public function conciliationsImport()
    {
            
        if ($this->request->is('post')) {

            // Import 
            if (isset($_FILES['upload_import'])){
                
                $date_now = Time::now();
                
                $file_import = $_FILES['upload_import']['tmp_name'];
                $handle = fopen($file_import, "r");
                // $content = file_get_contents($handle);
                
                // Load Data String    
                $str = file_get_contents($file_import);
                $MArr = array(); // Final assembled master array
            // Fetch all transactions
                preg_match_all("/<STMTTRN>(.*)<\/STMTTRN>/msU",$str,$m); 
                if ( !empty($m[1]) ) {
                    $recArr = $m[1]; unset($str,$m);
                    // Parse each transaction record
                    foreach ( $recArr as $i => $str ) {
                        $_arr = array();
                        preg_match_all("/(^\s*<(?'key'.*)>(?'val'.*)\s*$)/m",$str,$m); 
                        foreach ( $m["key"] as $i => $key ) {
                            $_arr[$key] = trim($m["val"][$i]); // Reassemble array key => val
                            
                            if(substr($key, 0, 4) == "DTPO"){ 
                                $conciliation_date = str_replace("DTPOSTED>", "", $key);
                                $conciliation_date = str_replace("[-3:BRT]</DTPOSTED", "", $conciliation_date);
                                echo $conciliation_date." / ";
                            }
                            
                            if(substr($key, 0, 4) == "TRNA"){ 
                                $conciliation_value = str_replace("TRNAMT>", "", $key);
                                $conciliation_value = str_replace("</TRNAMT", "", $conciliation_value);
                                echo $conciliation_value." / ";
                            }
                                
                            if(substr($key, 0, 4) == "MEMO"){ 
                                $conciliation_title = str_replace("MEMO>", "", $key);
                                $conciliation_title = str_replace("</MEMO", "", $conciliation_title);
                                echo $conciliation_title." / ";
                                
                            }
                            
                        }
                        array_push($MArr,$_arr);
                        // print_r($MArr);
                        // print_r($_arr);
                        
                        echo "<br>";
                        echo "----";
                        echo "<br>";
                        
                        $conciliation_type = "payment";
                        $conciliation_value = number_format($conciliation_value,2);
                        $conciliation_date = substr($conciliation_date,0 ,4)."-".substr($conciliation_date,5 ,2)."-".substr($conciliation_date,3 ,2)." 00:00";
                        
                        if($conciliation_value > 0){ $conciliation_type = "receipt"; }
                        if($conciliation_value < 0){ $conciliation_type = "payment"; }
                        
                        // Cria nova Quotations
                        $query = TableRegistry::get('FinancesConciliations');
                        $conciliations = $query->newEntity();
                        $conciliations->business_id = $this->request->data['business_id'];
                        $conciliations->account_id = $this->request->data['account_id'];
                        $conciliations->category_id = 0;
                        $conciliations->type = $conciliation_type;
                        $conciliations->title = $conciliation_title;
                        $conciliations->value = $conciliation_value;
                        $conciliations->status = 0;
                        $conciliations->suggest = 0;
                        $conciliations->created = $conciliation_date;
                        $query->save($conciliations);
                        
                    }
                }
            }
            
            // die();


            //     $file_import = $_FILES['upload_import']['tmp_name'];
            //     $handle = fopen($file_import, "r");

            //     while(($filesop = fgetcsv($handle, 1000, ";")) !== false){

            //         $conciliation_date = $filesop[0];
            //         $conciliation_date = substr($conciliation_date,6 ,4)."-".substr($conciliation_date,3 ,2)."-".substr($conciliation_date,0 ,2)." 00:00";

            //         $conciliation_value = str_replace(".", "", $filesop[2]);

            //         if($filesop[2] > 0){ $conciliation_type = "receipt"; }
            //         if($filesop[2] < 0){ $conciliation_type = "payment"; }

            //         // Sugestão de categoria
            //         $suggest_category_id = '';

            //         // Buscar registros
            //         $query = TableRegistry::get('FinancesReleases');
            //         $query_releases = $query
            //             ->find()
            //             ->where([ 
            //                 'business_id =' => $this->request->data['business_id'],
            //                 'title LIKE' => '%'.$filesop[1].'%'
            //             ])
            //             ->order([ 'id DESC' ]);

            //         foreach ($query_releases as $release) {
            //             $suggest_category_id = $release->category_id;
            //         }

            //         if($suggest_category_id == ''){

            //             // Cria nova Quotations
            //             $query = TableRegistry::get('FinancesConciliations');
            //             $conciliations = $query->newEntity();
            //             $conciliations->business_id = $this->request->data['business_id'];
            //             $conciliations->account_id = $this->request->data['account_id'];
            //             $conciliations->category_id = 0;
            //             $conciliations->type = $conciliation_type;
            //             $conciliations->title = $filesop[1];
            //             $conciliations->value = $conciliation_value;
            //             $conciliations->status = 0;
            //             $conciliations->suggest = 0;
            //             $conciliations->created = $conciliation_date;
            //             $query->save($conciliations);

            //         }else{

            //             // Cria nova Quotations
            //             $query = TableRegistry::get('FinancesConciliations');
            //             $conciliations = $query->newEntity();
            //             $conciliations->business_id = $this->request->data['business_id'];
            //             $conciliations->account_id = $this->request->data['account_id'];
            //             $conciliations->category_id = $suggest_category_id;
            //             $conciliations->type = $conciliation_type;
            //             $conciliations->title = $filesop[1];
            //             $conciliations->value = $conciliation_value;
            //             $conciliations->status = 0;
            //             $conciliations->suggest = 1;
            //             $conciliations->created = $conciliation_date;
            //             $query->save($conciliations);
            //         }                    
            //     }

            //     fclose($handle);
            // }

    
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
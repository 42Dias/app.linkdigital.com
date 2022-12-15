<?php

/**
 * Routes Controller
 *
 * Controla as rotas do App
 *
 * @copyright Copyright (c) Contabify (http://contabify.com.br)
 * @author The Oceaning - www.oceaning.com.br
 * @version 1
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

// View e-mails
Router::scope('/email/', function ($routes) {
    $routes->connect('/**', ['controller' => 'Email', 'action' => 'display']);
});

// Root
Router::scope('/', function (RouteBuilder $routes) {

    // Pages
    $routes->connect('/', ['controller' => 'Public', 'action' => 'home']);
    $routes->connect('/**', ['controller' => 'Public', 'action' => 'display']);

    // Login
    $routes->connect('/login', ['controller' => 'Login', 'action' => 'home']);
    $routes->connect('/login-alert', ['controller' => 'Login', 'action' => 'home']);
    $routes->connect('/login/email', ['controller' => 'Login', 'action' => 'email']);
    $routes->connect('/login/password', ['controller' => 'Login', 'action' => 'password']);
    $routes->connect('/login/password/:id', ['controller' => 'Login', 'action' => 'password'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/login/esqueci-minha-senha', ['controller' => 'Login', 'action' => 'rememberPassword']);
    $routes->connect('/login/recuperar-senha', ['controller' => 'Login', 'action' => 'alertPassword']);
    $routes->connect('/login/criar-nova-senha', ['controller' => 'Login', 'action' => 'createPassword']);
    $routes->connect('/login/atualizar-senha', ['controller' => 'Login', 'action' => 'alertCreatePassword']);
    $routes->connect('/login/logout', ['controller' => 'Login', 'action' => 'logout']);

    // Client
    $routes->connect('/client', ['controller' => 'Client', 'action' => 'home']);
    $routes->connect('/client/terms', ['controller' => 'Client', 'action' => 'terms']);
    $routes->connect('/client/payments', ['controller' => 'Client', 'action' => 'payments']);
    $routes->connect('/client/expired', ['controller' => 'Client', 'action' => 'expired']);
    $routes->connect('/client/business', ['controller' => 'Client', 'action' => 'business']);
    $routes->connect('/client/business/:id/view', ['controller' => 'Client', 'action' => 'businessView']);
    $routes->connect('/client/business/:id/edit', ['controller' => 'Client', 'action' => 'businessEdit']);
    $routes->connect('/client/finances', ['controller' => 'Client', 'action' => 'finances']);
    $routes->connect('/client/finances/customers', ['controller' => 'Client', 'action' => 'financesCustomers']);
    $routes->connect('/client/finances/employees', ['controller' => 'Client', 'action' => 'financesEmployees']);
    $routes->connect('/client/finances/providers', ['controller' => 'Client', 'action' => 'financesProviders']);
    $routes->connect('/client/finances/partners', ['controller' => 'Client', 'action' => 'financesPartners']);
    $routes->connect('/client/finances/accounts', ['controller' => 'Client', 'action' => 'financesAccounts']);
    $routes->connect('/client/finances/receipts', ['controller' => 'Client', 'action' => 'financesReceipts']);
    $routes->connect('/client/finances/payments', ['controller' => 'Client', 'action' => 'financesPayments']);
    $routes->connect('/client/finances/releases', ['controller' => 'Client', 'action' => 'financesReleases']);
    $routes->connect('/client/finances/conciliations', ['controller' => 'Client', 'action' => 'financesConciliations']);
    $routes->connect('/client/finances/categories', ['controller' => 'Client', 'action' => 'financesCategories']);
    $routes->connect('/client/finances/reports', ['controller' => 'Client', 'action' => 'financesReports']);
    $routes->connect('/client/finances/reports/fluxo-previsto', ['controller' => 'Client', 'action' => 'financesReportsFluxoPrevisto']);
    $routes->connect('/client/finances/reports/fluxo-realizado', ['controller' => 'Client', 'action' => 'financesReportsFluxoRealizado']);
    $routes->connect('/client/finances/reports/fluxo-previsto-realizado', ['controller' => 'Client', 'action' => 'financesReportsFluxoPrevistoRealizado']);
    $routes->connect('/client/finances/reports/dre-anual-horizontal', ['controller' => 'Client', 'action' => 'financesReportsDreAnualHorizontal']);
    $routes->connect('/client/finances/reports/dre-anual-vertical', ['controller' => 'Client', 'action' => 'financesReportsDreAnualVertical']);
    $routes->connect('/client/finances/reports/dre-mensal-demonstracao', ['controller' => 'Client', 'action' => 'financesReportsDreMensalDemonstracao']);
    $routes->connect('/client/finances/reports/dre-mensal-horizontal', ['controller' => 'Client', 'action' => 'financesReportsDreMensalHorizontal']);
    $routes->connect('/client/finances/reports/dre-mensal-vertical', ['controller' => 'Client', 'action' => 'financesReportsDreMensalVertical']);
    $routes->connect('/client/finances/indicators', ['controller' => 'Client', 'action' => 'financesIndicators']);
    $routes->connect('/client/taxes', ['controller' => 'Client', 'action' => 'taxes']);
    $routes->connect('/client/notes', ['controller' => 'Client', 'action' => 'notes']);
    $routes->connect('/client/extracts', ['controller' => 'Client', 'action' => 'extracts']);
    $routes->connect('/client/documents', ['controller' => 'Client', 'action' => 'documents']);
    $routes->connect('/client/expenses-receipt', ['controller' => 'Client', 'action' => 'expensesReceipt']);
    $routes->connect('/client/services', ['controller' => 'Client', 'action' => 'services']);
    $routes->connect('/client/services/edit', ['controller' => 'Client', 'action' => 'servicesEdit']);
    $routes->connect('/client/invoices', ['controller' => 'Client', 'action' => 'invoices']);
    $routes->connect('/client/invoices/history', ['controller' => 'Client', 'action' => 'invoicesHistory']);
    $routes->connect('/client/invoices/:id/view', ['controller' => 'Client', 'action' => 'invoicesView']);
    $routes->connect('/client/invoices/generate', ['controller' => 'Client', 'action' => 'invoicesGenerate']);
    $routes->connect('/client/account', ['controller' => 'Client', 'action' => 'account']);
    $routes->connect('/client/support', ['controller' => 'Client', 'action' => 'support']);
    $routes->connect('/client/partners', ['controller' => 'Client', 'action' => 'partners']);
    $routes->connect('/client/notifications', ['controller' => 'Client', 'action' => 'notifications']);
    $routes->connect('/client/tickets', ['controller' => 'Client', 'action' => 'tickets']);
    $routes->connect('/client/tickets/:id/view', ['controller' => 'Client', 'action' => 'viewTicket'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/client/notifications', ['controller' => 'Client', 'action' => 'notifications']);
    $routes->connect('/client/tickets/addticket', ['controller' => 'Client', 'action' => 'addTicket']);
    $routes->connect('/client/tickets/addcomment/:id', ['controller' => 'Client', 'action' => 'addCommentTicket'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/client/tasks', ['controller' => 'Client', 'action' => 'tasks']);
    $routes->connect('/client/nf', ['controller' => 'Client', 'action' => 'nf']);
    $routes->connect('/client/stock', ['controller' => 'Client', 'action' => 'stock']);
    
    // Accountant
    $routes->connect('/accountant', ['controller' => 'Accountant', 'action' => 'home']);
    $routes->connect('/accountant/business', ['controller' => 'Accountant', 'action' => 'business']);
    $routes->connect('/accountant/business/:id/view-infos', ['controller' => 'Accountant', 'action' => 'viewBusinessInfos'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/business/:id/view-taxes', ['controller' => 'Accountant', 'action' => 'viewBusinessTaxes'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/business/:id/view-notes', ['controller' => 'Accountant', 'action' => 'viewBusinessNotes'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/business/:id/view-extracts', ['controller' => 'Accountant', 'action' => 'viewBusinessExtracts'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/business/:id/view-documents', ['controller' => 'Accountant', 'action' => 'viewBusinessDocuments'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/business/:id/view-tasks', ['controller' => 'Accountant', 'action' => 'viewBusinessTasks'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/business/:id/view-invoices', ['controller' => 'Accountant', 'action' => 'viewBusinessInvoices'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/business/:id/view-history', ['controller' => 'Accountant', 'action' => 'viewBusinessHistory'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/business/:id/edit', ['controller' => 'Accountant', 'action' => 'editBusiness']);
    $routes->connect('/accountant/invoices', ['controller' => 'Accountant', 'action' => 'invoices']);
    $routes->connect('/accountant/invoices/history', ['controller' => 'Accountant', 'action' => 'invoicesHistory']);
    $routes->connect('/accountant/invoices/:id/view', ['controller' => 'Accountant', 'action' => 'invoicesView']);
    $routes->connect('/accountant/tasks', ['controller' => 'Accountant', 'action' => 'tasks']);
    $routes->connect('/accountant/tasks/:id/view', ['controller' => 'Accountant', 'action' => 'tasksView']);
    $routes->connect('/accountant/crm', ['controller' => 'Accountant', 'action' => 'crm']);
    $routes->connect('/accountant/crm/history', ['controller' => 'Accountant', 'action' => 'crmHistory']);
    $routes->connect('/accountant/account', ['controller' => 'Accountant', 'action' => 'account']);
    $routes->connect('/accountant/support', ['controller' => 'Accountant', 'action' => 'support']);
    $routes->connect('/accountant/notifications', ['controller' => 'Accountant', 'action' => 'notifications']);
    $routes->connect('/accountant/tickets', ['controller' => 'Accountant', 'action' => 'tickets']);
    $routes->connect('/accountant/tickets/:id/view', ['controller' => 'Accountant', 'action' => 'viewTicket'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/reports', ['controller' => 'Accountant', 'action' => 'reports']);

    // Accountant
    $routes->connect('/admin', ['controller' => 'Admin', 'action' => 'home']);
    $routes->connect('/admin/business', ['controller' => 'Admin', 'action' => 'business']);
    $routes->connect('/admin/business/:id/view', ['controller' => 'Admin', 'action' => 'viewBusiness'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/admin/business/:id/edit', ['controller' => 'Admin', 'action' => 'editBusiness']);
    $routes->connect('/admin/invoices', ['controller' => 'Admin', 'action' => 'invoices']);
    $routes->connect('/admin/invoices/history', ['controller' => 'Admin', 'action' => 'invoicesHistory']);
    $routes->connect('/admin/invoices/:id/view', ['controller' => 'Admin', 'action' => 'invoicesView']);
    $routes->connect('/admin/tasks', ['controller' => 'Admin', 'action' => 'tasks']);
    $routes->connect('/admin/tasks/:id/view', ['controller' => 'Admin', 'action' => 'tasksView']);
    $routes->connect('/admin/crm', ['controller' => 'Admin', 'action' => 'crm']);
    $routes->connect('/admin/crm/history', ['controller' => 'Admin', 'action' => 'crmHistory']);
    $routes->connect('/admin/account', ['controller' => 'Admin', 'action' => 'account']);
    $routes->connect('/admin/support', ['controller' => 'Admin', 'action' => 'support']);
    $routes->connect('/admin/notifications', ['controller' => 'Admin', 'action' => 'notifications']);
    $routes->connect('/admin/permissions', ['controller' => 'Admin', 'action' => 'permissions']);
    $routes->connect('/admin/reports', ['controller' => 'Admin', 'action' => 'reports']);
    $routes->connect('/admin/indicators', ['controller' => 'Admin', 'action' => 'indicators']);


    $routes->fallbacks(DashedRoute::class);
});

// API Web
Router::scope('/api/web/', function (RouteBuilder $routes) {
    $routes->extensions(['json']);

    // Public
    $routes->connect('/send-contact', ['controller' => 'Public', 'action' => 'sendContact']);
    $routes->connect('/simulation/search-citys', ['controller' => 'Public', 'action' => 'searchCitys']);
    $routes->connect('/simulation/search-abertura', ['controller' => 'Public', 'action' => 'searchAbertura']);

    // Public - Login
    $routes->connect('/login/validate-password', ['controller' => 'Login', 'action' => 'validatePassword']);
    $routes->connect('/login/validate-email', ['controller' => 'Login', 'action' => 'validateEmail']);
    $routes->connect('/login/validate-cpf', ['controller' => 'Login', 'action' => 'validateCpf']);
    $routes->connect('/login/delete/:id', ['controller' => 'Login', 'action' => 'deleteUser'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/login/send-password', ['controller' => 'Login', 'action' => 'sendPassword']);
    $routes->connect('/login/update-password', ['controller' => 'Login', 'action' => 'updatePassword']);

    // Public - Register
    $routes->connect('/register/add-register', ['controller' => 'Register', 'action' => 'addRegister']);

    //Public
    $routes->connect('/business/add-step-1', ['controller' => 'Public', 'action' => 'businessAddStep1']);
    $routes->connect('/business/update-taxation/:type', ['controller' => 'Public', 'action' => 'updateTaxation'],['pass' => ['type'], 'type' => '[a-z]+']);
    $routes->connect('/business/update-service/:type', ['controller' => 'Public', 'action' => 'updateService'],['pass' => ['type'], 'type' => '[a-z]+']);
    $routes->connect('/business/update-plan/:type', ['controller' => 'Public', 'action' => 'updatePlan'],['pass' => ['type'], 'type' => '[a-z]+']);
    $routes->connect('/business/add-step-2', ['controller' => 'Public', 'action' => 'businessAddStep2']);
    $routes->connect('/business/add-step-3', ['controller' => 'Public', 'action' => 'businessAddStep3']);
    $routes->connect('/business/add-step-4', ['controller' => 'Public', 'action' => 'businessAddStep4']);
    $routes->connect('/business/add-step-5', ['controller' => 'Public', 'action' => 'businessAddStep5']);
    $routes->connect('/business/update-sign', ['controller' => 'Public', 'action' => 'businessUpdateSign']);
    $routes->connect('/business/update-terms', ['controller' => 'Public', 'action' => 'businessUpdateTerms']);
    $routes->connect('/business/search-cnpj', ['controller' => 'Public', 'action' => 'searchCnpj']);
    $routes->connect('/business/agendar-lucro-real', ['controller' => 'Public', 'action' => 'agendarLucroReal']);
    
    // payments
    $routes->connect('/payments/add-billet', ['controller' => 'Public', 'action' => 'paymentsAddBillet']);
    $routes->connect('/payments/add-credit', ['controller' => 'Public', 'action' => 'paymentsAddCredit']);
    $routes->connect('/payments/add-pix', ['controller' => 'Public', 'action' => 'paymentsAddPix']);
    $routes->connect('/payments/transfer', ['controller' => 'Public', 'action' => 'paymentsTransfer']);

    //Search
    $routes->connect('/search/cep', ['controller' => 'Public', 'action' => 'searchCep']);

    //Client
    $routes->connect('/client/business/update', ['controller' => 'Client', 'action' => 'businessUpdate']);
    $routes->connect('/client/notes/add', ['controller' => 'Client', 'action' => 'notesAdd']);
    $routes->connect('/client/notes/:id/delete', ['controller' => 'Client', 'action' => 'notesDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/client/extracts/add', ['controller' => 'Client', 'action' => 'extractsAdd']);
    $routes->connect('/client/extracts/:id/delete', ['controller' => 'Client', 'action' => 'extractsDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/client/documents/add', ['controller' => 'Client', 'action' => 'documentsAdd']);
    $routes->connect('/client/documents/add-action', ['controller' => 'Client', 'action' => 'documentsAddAction']);
    $routes->connect('/client/documents/:id/remove-action', ['controller' => 'Client', 'action' => 'documentsRemoveAction'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/client/expenses-receipt/add', ['controller' => 'Client', 'action' => 'expensesReceiptAdd']);
    $routes->connect('/client/documents/:id/delete', ['controller' => 'Client', 'action' => 'documentsDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/client/expenses-receipt/:id/delete', ['controller' => 'Client', 'action' => 'expensesReceiptDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/client/services/update', ['controller' => 'Client', 'action' => 'servicesUpdate']);
    $routes->connect('/client/invoices/update', ['controller' => 'Client', 'action' => 'invoicesUpdate']);
    $routes->connect('/client/invoices/generate', ['controller' => 'Client', 'action' => 'invoicesGenerate']);
    $routes->connect('/client/account/update', ['controller' => 'Client', 'action' => 'accountUpdate']);
    $routes->connect('/client/notifications/update', ['controller' => 'Client', 'action' => 'notificationsUpdate']);
    $routes->connect('/client/taxes/:id/:status/update-status', ['controller' => 'Client', 'action' => 'updateStatusTaxe'],['pass' => ['id', 'status'], 'id' => '[0-9]+', 'status' => '[0-9]+']);
    $routes->connect('/client/add/ticket', ['controller' => 'Client', 'action' => 'addTicket']);
    $routes->connect('/client/add/comment-ticket', ['controller' => 'Client', 'action' => 'addCommentTicket']);
    $routes->connect('/client/update-terms', ['controller' => 'Client', 'action' => 'updateTerms']); 
    $routes->connect('/client/tickets/:id/close', ['controller' => 'Client', 'action' => 'closeTicket'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/client/conciliations/:id/approve/:account_id/:category_id', ['controller' => 'Client', 'action' => 'approveConciliationItem'],['pass' => ['id', 'account_id', 'category_id'], 'id' => '[0-9]+', 'account_id' => '[0-9]+', 'category_id' => '[0-9]+']);
    $routes->connect('/client/conciliations/approve-all', ['controller' => 'Client', 'action' => 'approveAll']);
    $routes->connect('/client/conciliations/remove-all', ['controller' => 'Client', 'action' => 'removeAll']);
    $routes->connect('/client/:id/search-cnpj', ['controller' => 'Client', 'action' => 'searchCnpj'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/client/:type/import', ['controller' => 'Client', 'action' => 'importItens'],['pass' => ['type'], 'type' => '[a-z0-9-_]+']); 

    //Accountant
    $routes->connect('/accountant/business/update', ['controller' => 'Accountant', 'action' => 'businessUpdate']);
    $routes->connect('/accountant/tasks/add', ['controller' => 'Accountant', 'action' => 'tasksAdd']);
    $routes->connect('/accountant/tasks/add-group', ['controller' => 'Accountant', 'action' => 'tasksAddGroup']);
    $routes->connect('/accountant/tasks/update', ['controller' => 'Accountant', 'action' => 'tasksUpdate']);
    $routes->connect('/accountant/tasks/:id/:status/update-status', ['controller' => 'Accountant', 'action' => 'tasksUpdateStatus'],['pass' => ['id', 'status'], 'id' => '[0-9]+', 'status' => '[0-9]+']);
    $routes->connect('/accountant/tasks/:business/:id/:date/close', ['controller' => 'Accountant', 'action' => 'tasksClose'],['pass' => ['business', 'id', 'date'], 'business' => '[0-9]+', 'id' => '[0-9]+', 'date' => '[0-9]+']);
    $routes->connect('/accountant/tasks/:business/:id/:date/open', ['controller' => 'Accountant', 'action' => 'tasksOpen'],['pass' => ['business', 'id', 'date'], 'business' => '[0-9]+', 'id' => '[0-9]+', 'date' => '[0-9]+']);
    $routes->connect('/accountant/tasks/:id/view', ['controller' => 'Accountant', 'action' => 'tasksView'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/tasks/:id/delete', ['controller' => 'Accountant', 'action' => 'tasksDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/tasks/:id/delete-fixed', ['controller' => 'Accountant', 'action' => 'tasksDeleteFixed'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/crm/update', ['controller' => 'Accountant', 'action' => 'crmUpdate']);
    $routes->connect('/accountant/taxes/add', ['controller' => 'Accountant', 'action' => 'taxesAdd']);
    $routes->connect('/accountant/taxes/:id/delete', ['controller' => 'Accountant', 'action' => 'taxesDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/documents/add', ['controller' => 'Accountant', 'action' => 'documentsAdd']);
    $routes->connect('/accountant/documents/:id/delete', ['controller' => 'Accountant', 'action' => 'documentsDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/invoices/update', ['controller' => 'Accountant', 'action' => 'invoicesUpdate']);
    $routes->connect('/accountant/account/update', ['controller' => 'Accountant', 'action' => 'accountUpdate']);
    $routes->connect('/accountant/notifications/update', ['controller' => 'Accountant', 'action' => 'notificationsUpdate']);
    $routes->connect('/accountant/find/business', ['controller' => 'Accountant', 'action' => 'findBusiness']);
    $routes->connect('/accountant/update-status/:id/:status', ['controller' => 'Accountant', 'action' => 'updateStatusBusiness'],['pass' => ['id', 'status'], 'id' => '[0-9]+', 'status' => '[0-9]+']);
    $routes->connect('/accountant/add/comment-ticket', ['controller' => 'Accountant', 'action' => 'addCommentTicket']);
    $routes->connect('/accountant/tickets/:id/close', ['controller' => 'Accountant', 'action' => 'closeTicket'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/accountant/history/add', ['controller' => 'Accountant', 'action' => 'historyAdd']);
    $routes->connect('/accountant/activity/add', ['controller' => 'Accountant', 'action' => 'activityAdd']);
    $routes->connect('/accountant/business/:id/force-payment', ['controller' => 'Accountant', 'action' => 'forcePayment'],['pass' => ['id'], 'id' => '[0-9]+']);

    //Admin
    $routes->connect('/admin/business/update', ['controller' => 'Admin', 'action' => 'businessUpdate']);
    $routes->connect('/admin/tasks/add', ['controller' => 'Admin', 'action' => 'tasksAdd']);
    $routes->connect('/admin/tasks/update', ['controller' => 'Admin', 'action' => 'tasksUpdate']);
    $routes->connect('/admin/tasks/delete', ['controller' => 'Admin', 'action' => 'tasksDelete']);
    $routes->connect('/admin/crm/update', ['controller' => 'Admin', 'action' => 'crmUpdate']);
    $routes->connect('/admin/taxations/add', ['controller' => 'Admin', 'action' => 'taxationsAdd']);
    $routes->connect('/admin/taxations/delete', ['controller' => 'Admin', 'action' => 'taxationsDelete']);
    $routes->connect('/admin/documents/add', ['controller' => 'Admin', 'action' => 'documentsAdd']);
    $routes->connect('/admin/documents/delete', ['controller' => 'Admin', 'action' => 'documentsDelete']);
    $routes->connect('/admin/invoices/update', ['controller' => 'Admin', 'action' => 'invoicesUpdate']);
    $routes->connect('/admin/users/add', ['controller' => 'Admin', 'action' => 'usersAdd']);
    $routes->connect('/admin/users/update', ['controller' => 'Admin', 'action' => 'usersUpdate']);
    $routes->connect('/admin/users/delete', ['controller' => 'Admin', 'action' => 'usersDelete']);
    $routes->connect('/admin/account/update', ['controller' => 'Admin', 'action' => 'accountUpdate']);
    $routes->connect('/admin/notifications/update', ['controller' => 'Admin', 'action' => 'notificationsUpdate']);
    $routes->connect('/admin/uppdate-permission', ['controller' => 'Admin', 'action' => 'updatePermission']);
    $routes->connect('/admin/update-status/:id/:status', ['controller' => 'Admin', 'action' => 'updateStatusBusiness'],['pass' => ['id', 'status'], 'id' => '[0-9]+', 'status' => '[0-9]+']);
    $routes->connect('/accountant/update-status/:id/:status', ['controller' => 'Admin', 'action' => 'updateStatusBusiness'],['pass' => ['id', 'status'], 'id' => '[0-9]+', 'status' => '[0-9]+']);
    $routes->connect('/admin/taxes/:id/delete', ['controller' => 'Admin', 'action' => 'taxesDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/admin/add-user', ['controller' => 'Admin', 'action' => 'addUser']);
    $routes->connect('/admin/delete-user', ['controller' => 'Admin', 'action' => 'deleteUser']);
    
    // Custom
    $routes->connect('/custom/customers/add', ['controller' => 'custom', 'action' => 'customersAdd']);
    $routes->connect('/custom/providers/add', ['controller' => 'custom', 'action' => 'providersAdd']);
    $routes->connect('/custom/partners/add', ['controller' => 'custom', 'action' => 'partnersAdd']);
    $routes->connect('/custom/employees/add', ['controller' => 'custom', 'action' => 'employeesAdd']);
    $routes->connect('/custom/accounts/add', ['controller' => 'custom', 'action' => 'accountsAdd']);
    $routes->connect('/custom/payments/add', ['controller' => 'custom', 'action' => 'paymentsAdd']);
    $routes->connect('/custom/receipts/add', ['controller' => 'custom', 'action' => 'receiptsAdd']);
    $routes->connect('/custom/categories/add', ['controller' => 'custom', 'action' => 'categoriesAdd']);
    $routes->connect('/custom/files/add', ['controller' => 'custom', 'action' => 'filesAdd']);
    $routes->connect('/custom/notes/add', ['controller' => 'custom', 'action' => 'notesAdd']);
    $routes->connect('/custom/nf/add', ['controller' => 'custom', 'action' => 'nfAdd']);
    
    $routes->connect('/custom/customers/update', ['controller' => 'custom', 'action' => 'customersUpdate']);
    $routes->connect('/custom/providers/update', ['controller' => 'custom', 'action' => 'providersUpdate']);
    $routes->connect('/custom/partners/update', ['controller' => 'custom', 'action' => 'partnersUpdate']);
    $routes->connect('/custom/employees/update', ['controller' => 'custom', 'action' => 'employeesUpdate']);
    $routes->connect('/custom/payments/update', ['controller' => 'custom', 'action' => 'paymentsUpdate']);
    $routes->connect('/custom/receipts/update', ['controller' => 'custom', 'action' => 'receiptsUpdate']);

    $routes->connect('/custom/customers/:id/delete', ['controller' => 'custom', 'action' => 'customersDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/custom/providers/:id/delete', ['controller' => 'custom', 'action' => 'providersDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/custom/partners/:id/delete', ['controller' => 'custom', 'action' => 'partnersDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/custom/employees/:id/delete', ['controller' => 'custom', 'action' => 'employeesDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/custom/accounts/:id/delete', ['controller' => 'custom', 'action' => 'accountsDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/custom/payments/:id/delete', ['controller' => 'custom', 'action' => 'paymentsDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/custom/receipts/:id/delete', ['controller' => 'custom', 'action' => 'receiptsDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/custom/categories/:id/delete', ['controller' => 'custom', 'action' => 'categoriesDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/custom/files/:id/delete', ['controller' => 'custom', 'action' => 'filesDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/custom/notes/:id/delete', ['controller' => 'custom', 'action' => 'notesDelete'],['pass' => ['id'], 'id' => '[0-9]+']);

    //  CRUD FLUXO DE CAIXA
    //  client/finances/releases
    $routes->connect('/custom/releases/:id/delete',['controller' => 'custom', 'action' => 'releasesDelete'],['pass' => ['id'], 'id' => '[0-9]+']);
    $routes->connect('/custom/releases/update', ['controller' => 'custom', 'action' => 'releasesUpdate']);

    $routes->connect('/custom/conciliations/import', ['controller' => 'custom', 'action' => 'conciliationsImport']);

});

/**
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * Router::scope('/api', function (RouteBuilder $routes) {
 *     // No $routes->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */

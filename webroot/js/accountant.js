$(function(){

    // openModalAlert
    openModalAlert = function(title, text){

        $("#modal_title").html(title);
        $("#modal_text").html(text);
        $('#alert_modal').modal('show');
    }


    // Abre Menus
    openMenu = function(item){

        // Verifica se está ativo
        if($(item).hasClass("active")){

            $(item).toggleClass("active");
            setTimeout(function() {
                $(item).toggleClass("display");
            }, 500);

        }else{

            $(item).toggleClass("display");
            setTimeout(function() {
                $(item).toggleClass("active");
            }, 100);
        }

        // Fecha outros Menus
        if(item !== ".box-user-tooltip"){
            $(".box-user-tooltip").removeClass("active");
            $(".box-user-tooltip").removeClass("display");
        }
        if(item !== ".box-menu-notifications"){
            $(".box-menu-notifications").removeClass("active");
            $(".box-menu-notifications").removeClass("display");
        }
        // if(item !== ".box-menu-tools"){
        //     $(".box-menu-tools").removeClass("active");
        //     $(".box-menu-tools").removeClass("display");
        // }

    }

    // Search Global
    findBusiness = function(){

        $.ajax({
            'url': "/api/web/accountant/find/business",
            'data': $("#form-search-business").serialize(),
            'type': 'POST',
            'dataType': 'json',
            beforeSend: function () {
                // $('.box-loading').show();
            },
            complete: function () {
            },
            success: function (data) {
                // $(".box-loading").hide();

                if (data.result.status == "ok"){

                    $('.area-result-search-business').removeClass("active");
                    $('.area-result-search-business').html("");

                    var business = data.result.business;

                    for (i = 0; i < business.length; i++) {

                        if(business[i].status === "2"){
                            var status_text = business[i].cpf;
                        }else{
                            var status_text = "";
                        }

                        item_business = '<a href="/accountant/business/'+business[i].id+'/view" class="item-result"><span class="title">'+business[i].fantasia+'</span><span class="text">'+ business[i].cnpj + status_text +'</span></a>';
                        $('.area-result-search-business').append(item_business);
                    }

                    $('.area-result-search-business').addClass("active");

                }else{
                    alert(data.result.status);
                }
            }
        });
    }


    // Send Contact
    sendForm = function(url, form, redirect){

        if(url === "/api/web/custom/releases/import"){

            var file_import = $('#file_import').prop('files')[0];
        
            var form_data = new FormData();
            form_data.append('upload_import', file_import);
            form_data.append('business_id', $("#input_import_business_id").val());
            form_data.append('account_id', $("#input_import_account_id").val());
    
            $.ajax({
                'url': url,
                'type': 'POST',
                'dataType': 'text',
                'cache': false,
                'contentType': false,
                'processData': false,
                'data': form_data,
                beforeSend: function () {
                    $('.box-loading').show();
                },
                complete: function () {
                },
                success: function (data) {

                    if (data == '{"result":{"status":"ok"}}'){

                        setTimeout(function(){
                            location.reload();
                        }, 500);

                    }else{

                        setTimeout(function(){
                            $(".box-loading").hide();
                        }, 500);

                    }
                }
            });

        }else{


            if(url === "/api/web/accountant/taxes/add" || url === "/api/web/accountant/documents/add"){

                var form_data = new FormData($(form)[0]);

                $.ajax({
                    'url': url,
                    'data': form_data,
                    'type': 'POST',
                    'dataType': 'json',
                    'cache': false,
                    'contentType': false,
                    'processData': false,
                    beforeSend: function () {
                        $('.box-loading').show();
                    },
                    complete: function () {
                    },
                    success: function (data) {

                        if (data.result.status == "ok"){

                            setTimeout(function() {
                                $(".box-loading").hide();

                                // Verifica
                                if(redirect !== "none"){
                                    window.location.replace(redirect);
                                }else{
                                    location.reload();
                                }

                            }, 1500);

                        }else{
                            openModalAlert("Atenção!", data.result.status);
                        }
                    }
                });

            }else{

                var form_data = $(form).serialize();

                $.ajax({
                    'url': url,
                    'data': form_data,
                    'type': 'POST',
                    'dataType': 'json',
                    beforeSend: function () {
                        $('.box-loading').show();
                    },
                    complete: function () {
                    },
                    success: function (data) {

                        if (data.result.status == "ok"){

                            setTimeout(function() {
                                $(".box-loading").hide();

                                // Verifica
                                if(redirect !== "none"){
                                    window.location.replace(redirect);
                                }else{
                                    location.reload();
                                }

                            }, 1500);

                        }else{
                            openModalAlert("Atenção!", data.result.status);
                        }
                    }
                });
            }
        }
    }

});

// Carrega página
$(document).ready(function() {

    // Open Loading Page
    setTimeout(function(){
        $(".loading-page").fadeOut("slow");
    }, 500);

    // Href
    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top - 100
        }, 500);
    });

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Aplica mascaras
    $('.mask-date').mask('00/00/0000');
    $('.mask-dd-yy').mask('00/00');
    $('.mask-time').mask('00:00:00');
    $('.mask-date_time').mask('00/00/0000 00:00:00');
    $('.mask-cep').mask('00000-000');
    $('.mask-phone').mask('(00) 00000-0000');
    $('.mask-mixed').mask('AAA 000-S0S');
    $('.mask-cpf').mask('000.000.000-00', {reverse: true});
    $('.mask-cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.mask-money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#.##0,00", {reverse: true});
    $('.mask-creditcard').mask('0000 0000 0000 0000');

    // Datepicker
    $('.datepicker').datepicker({
        language: "pt-BR",
        todayHighlight: true,
        format: "yyyy-mm-dd"
    });

    // Scrollbar
    $(".scroll-active").perfectScrollbar({
        wheelSpeed: .3
    });

    $(".update-status-business").click(function () {
        var id = $(this).data("id");
        var status = $(this).data("status");
        updateStatusBusiness(id, status);
    });

    $(".update-status-admin").click(function () {
        var id = $(this).data("id");
        var status = $(this).data("status");
        updateStatusAdmin(id, status);
    });

    updateStatusAdmin = function(id, status){

        $.ajax({
            'url': "/api/web/admin/update-status/"+id+"/"+status,
            'data': "",
            'type': 'POST',
            'dataType': 'json',
            beforeSend: function () {
                $('.box-loading').show();
            },
            complete: function () {
            },
            success: function (data) {

                if (data.result.status == "ok"){

                    setTimeout(function() {
                        $(".box-loading").hide();
                        location.reload();
                    }, 1500);

                }else{
                    $(".box-loading").hide();
                    openModalAlert("Atenção!", data.result.status);
                }
            }
        });
    }

    updateStatusBusiness = function(id, status){

        $.ajax({
            'url': "/api/web/accountant/update-status/"+id+"/"+status,
            'data': "",
            'type': 'POST',
            'dataType': 'json',
            beforeSend: function () {
                $('.box-loading').show();
            },
            complete: function () {
            },
            success: function (data) {

                if (data.result.status == "ok"){

                    setTimeout(function() {
                        $(".box-loading").hide();
                        location.reload();
                    }, 1500);

                }else{
                    $(".box-loading").hide();
                    openModalAlert("Atenção!", data.result.status);
                }
            }
        });
    }


    // OPEN MENU COLLAPSE
    $(".content-admin, .btn-close-search-business").click(function () {
        $(".main-menu").removeClass("active");
        $(".box-search-business").removeClass("active");
    });

    // OPEN MENU COLLAPSE
    $("#btn-open-menu-mobile").click(function () {
        $(".main-menu").toggleClass("active");
    });

    $(".btn-close-mobile").click(function () {
        $(".main-menu").removeClass("active");
        $(".sub-menu").removeClass("active");
    });

    // Open Menu Profile
    $('.menu-top .box-user, .menu-top .name-advisor').click(function(event){
        event.stopPropagation();
        $(".box-notifications-tooltip").removeClass("active");
        $(".box-notifications-tooltip").removeClass("display");
        openMenu(".box-user-tooltip");
    });

    // Open Menu Notification
    $('.menu-top .box-notification').click(function(event){
        event.stopPropagation();
        openMenu(".box-notifications-tooltip");
    });

    // Open sub menu
    $('.main-menu .item').click(function(){

        if($(this).data("item") !== "default"){

            //Habilita item
            if($(this).hasClass("active")){
                // $('.main-menu .item').removeClass("active");

                // Open Sub menu
                $('.sub-menu').removeClass("active");
                $('.sub-menu').toggleClass("active");
                $('.sub-menu .list').css("display", "none");
                $('.sub-menu .list').removeClass("active");
                $('.sub-menu .list.'+$(this).data("item")).css("display", "block");

                // setTimeout(function(){
                    $('.sub-menu .list.'+$(this).data("item")).addClass("active");

            }else{
                // $('.main-menu .item').removeClass("active");
                // $(this).toggleClass("active");

                // Open Sub menu
                $('.sub-menu').removeClass("active");
                $('.sub-menu').toggleClass("active");
                $('.sub-menu .list').css("display", "none");
                $('.sub-menu .list').removeClass("active");
                $('.sub-menu .list.'+$(this).data("item")).css("display", "block");

                // setTimeout(function(){
                    $('.sub-menu .list.'+$(this).data("item")).addClass("active");
                // }, 500);
            }

            // disabledSearch();
        }

    });

    // Ocultar sub menu
    $(".content-admin, .menu-top").click(function(){
        // $('.main-menu .item').removeClass("active");
        $('.sub-menu').removeClass("active");
        $('.sub-menu .list').css("display", "none");
        $('.sub-menu .list').removeClass("active");

        if($(".box-user-tooltip").hasClass("active")){
            openMenu(".box-user-tooltip");
        }

        if($(".box-notifications-tooltip").hasClass("active")){
            openMenu(".box-notifications-tooltip");
        }
    });

    // Desativar campo de busca
    // $(".content-admin, .box-results-search, #btn-search .ion-android-close").click(function(){
    //     disabledSearch();
    // });

    // Open Import Files
    $("#btn-search .ion-android-search, #btn-search .text").click(function(){
        activeSearch();
    });

    // Open Box Results Search
    $("#input-search-business").on("keyup", function() {

        search = $(this).val();
        size_search = search.length;

        if(size_search > 2){

            findBusiness();
            $(".area-result-search-business").addClass("active");

        }else{

            $(".area-result-search-business").removeClass("active");
        }
    });

    // Option Date
    $('.input-date').click(function(event){
        $('.box-datepicker').toggleClass("display");

        setTimeout(function() {
            $('.box-datepicker').toggleClass("active");
        }, 100);
    });

    // Change Date picker
    $('.input-date .datepicker').on('changeDate', function() {
        var date = $(this).datepicker('getFormattedDate');
        var new_date = (date.substr(8,2)) +"/"+ (date.substr(5,2)) +"/"+ (date.substr(0,4)) ;

        // $('#date-text').html(new_date);
        // $('#task-date').val( $(this).datepicker('getFormattedDate') );
        $($(this).data("id")).val(new_date);

        $(".box-datepicker").removeClass("active");
        $(".box-datepicker").removeClass("display");
    });

    // Open Import Files
    // $(".tab-item").click(function(){
    //     $('.tab-item').removeClass("active");
    //     $('.box-tab-content').removeClass("active");
    //
    //     var tab_open = $(this).data("open");
    //
    //     $(this).addClass("active");
    //     $(tab_open).addClass("active");
    // });

    $(".btn-open-taxe").click(function(){
        $('#open_taxe_accountant').modal('show');
        $('.item-taxe').css("display", "none");

        var item_open = $(this).data("id");
        $('#item-taxe-' + item_open).css("display", "block");
    });

    // Open Import Files
    $(".btn-open-note").click(function(){
        $('#open_note_accountant').modal('show');
        $('.item-notes').css("display", "none");

        var item_open = $(this).data("id");
        $('#item-notes-' + item_open).css("display", "block");
    });

    // Open Import Files
    $(".btn-open-extract").click(function(){
        $('#open_extract_accountant').modal('show');
        $('.item-extracts').css("display", "none");

        var item_open = $(this).data("id");
        $('#item-extracts-' + item_open).css("display", "block");
    });

    // Open Import Files
    $(".btn-open-document").click(function(){
        $('#open_document_accountant').modal('show');
        $('.item-documents').css("display", "none");

        var item_open = $(this).data("id");
        $('#item-documents-' + item_open).css("display", "block");
    });


    $(".btn-search-business").click(function(){

        $(".box-search-business").addClass("active");
        $("#input-search-business").focus();
    });

    // Submit Contact
    $(".btn_send_form").click(function(){

        var url = $(this).data("url");
        var form = $(this).data("form");
        var redirect = $(this).data("redirect");
        var errors = 0;

        $(form + " .required").each( function(){

            if($(this).val() === ""){
                errors++;
                $(this).addClass("input-error");
            }else{
                $(this).removeClass("input-error");
            }
        });

        if(errors > 0){
            openModalAlert("Atenção!", "Preencha todos os campos corretamente.");
        }else{
            sendForm(url, form, redirect);
        }
    });

    $("#btn-add-user").click(function(){
        
        var errors = 0;

        $("#form_add_user .required").each( function(){

            if($(this).val() === ""){
                errors++;
                $(this).addClass("input-error");
            }else{
                $(this).removeClass("input-error");
            }
        });

        if($("#password").val() !== ($("#confirm_password").val())){
            errors++;
            $("#password").addClass("input-error");
            $("#confirm_password").addClass("input-error");
        }
        
        if(errors > 0){
            $('#alert_modal').css("z-index", "1042");
            $('#add_user').css("z-index", "1041");
            openModalAlert("Atenção!", "Preencha todos os campos corretamente.");
        }else{
            addUser();
        }
    });      

    addUser = function(form){

        $.ajax({
            'url': '/api/web/admin/add-user',
            'data': $("#form_add_user").serialize(),
            'type': 'POST',
            'dataType': 'json',
            beforeSend: function () {
                $('.box-loading').show();
            },
            complete: function () {
            },
            success: function (data) {

                if (data.result.status == "ok"){

                    setTimeout(function(){
                        $(".box-loading").hide();
                        location.reload();
                    }, 1000);

                }else{

                    setTimeout(function(){
                        $('#alert_modal').css("z-index", "1042");
                        $('#add_user').css("z-index", "1041");
                        $(".box-loading").hide();
                        openModalAlert("Atenção!", data.result.status);
                    }, 1000);
                }
            }
        });
    }


    // item-task
    $(".btn-open-task").click(function(){

        $('#open_task_accountant').modal('show');
        $('.item-tasks').css("display", "none");

        var item_open = $(this).data("id");
        $('#item-tasks-' + item_open).css("display", "block");
    });
    
    $("#btn-add-document").click(function(event){
        event.preventDefault();
        addItem();
    });

    // Open Import Files
    $(".btn-open-documents-accountant").click(function(){
        $('#open_expenses_receipt_accountant').modal('show');
        $('.item-documents').css("display", "none");

        var item_open = $(this).data("id");
        $('#item-documents-' + item_open).css("display", "block");
    });


    // item-task
    $(".btn-open-task-fixed").click(function(){

        $('#open_task_fixed_accountant').modal('show');
        $('.item-tasks-fixed').css("display", "none");

        var item_open = $(this).data("id");
        $('#item-tasks-fixed-' + item_open).css("display", "block");
    });


    // Add-task-group
    $(".btn-add-task-group").click(function(){
        $("#input-accountant-group-id").val($(this).data("group"));
        $("#input-accountant-group-type").val($(this).data("type"));

        if($(this).data("type") == "none"){
            $("#input-group-type-none").css('display', 'block');
            $("#input-group-type-week").css('display', 'none');
            $("#input-group-type-month").css('display', 'none');
            $("#input-group-type-yearly").css('display', 'none');
        }

        if($(this).data("type") == "diary"){
            $("#input-group-type-none").css('display', 'none');
            $("#input-group-type-week").css('display', 'none');
            $("#input-group-type-month").css('display', 'none');
            $("#input-group-type-yearly").css('display', 'none');
        }

        if($(this).data("type") == "week"){
            $("#input-group-type-none").css('display', 'none');
            $("#input-group-type-week").css('display', 'block');
            $("#input-group-type-month").css('display', 'none');
            $("#input-group-type-yearly").css('display', 'none');
        }

        if($(this).data("type") == "month"){
            $("#input-group-type-none").css('display', 'none');
            $("#input-group-type-week").css('display', 'none');
            $("#input-group-type-month").css('display', 'block');
            $("#input-group-type-yearly").css('display', 'none');
        }

        if($(this).data("type") == "yearly"){
            $("#input-group-type-none").css('display', 'none');
            $("#input-group-type-week").css('display', 'none');
            $("#input-group-type-month").css('display', 'none');
            $("#input-group-type-yearly").css('display', 'block');
        }
    });

    // Action Add Product
    $("#btnAddTicket").click(function(){
        addTicket();
    });
    
    $(".btnUpdatePermission").click(function(){
        var id = $(this).data("id");
        var errors = 0;
        var form = "form-update-permission-" + id;

        $("#form-update-permission-" + id + " .required").each( function(){

            if($(this).val() === ""){
                errors++;
                $(this).addClass("input-error");
            }else{
                $(this).removeClass("input-error");
            }
        });

        if(errors == 0){
            updatePermission(form);
        }
    });

    $(".btnDeleteUser").click(function(){
        var id = $(this).data("id");
        var form = "form-update-permission-" + id;
        deleteUser(form);
    });

    $("#btnAddCommentTicketBusiness").click(function(){
        addCommentTicket();
    });

    $("#btnCloseTicketBusiness").click(function(){
        closeTicket($(this).data('ticket'));
    });
        
    $(".btn-open-permission").click(function(){
        $('#update_permission').modal('show');
        $('.item-permission').css("display", "none");

        var id = $(this).data("id");
        $('#item-permission-' + id).css("display", "block");
    });

    // Add Advisor
    addTicket = function(){

        var form_active = new FormData($('#form-add-ticket')[0]);

        $.ajax({
            'url': '/api/web/accountant/add/ticket',
            'data': form_active,
            'type': 'POST',
            'dataType': 'json',
            'cache': false,
            'contentType': false,
            'processData': false,
            beforeSend: function () {
                $('.box-loading').show();
            },
            complete: function () {
            },
            success: function (data) {

                if (data.result.status == "ok"){

                    setTimeout(function(){
                        $(".box-loading").hide();
                        location.reload();
                    }, 1000);

                }else{

                    setTimeout(function(){
                        $(".box-loading").hide();
                        alert(data.result.status);
                    }, 1000);
                }
            }
        });
    }

    deleteUser = function(form){

        $.ajax({
            'url': '/api/web/admin/delete-user',
            'data': $("#" + form).serialize(),
            'type': 'POST',
            'dataType': 'json',
            beforeSend: function () {
                $('.box-loading').show();
            },
            complete: function () {
            },
            success: function (data) {

                if (data.result.status == "ok"){

                    setTimeout(function(){
                        $(".box-loading").hide();
                        location.reload();
                    }, 1000);

                }else{

                    setTimeout(function(){
                        $(".box-loading").hide();
                        alert(data.result.status);
                    }, 1000);
                }
            }
        });
    }

    updatePermission = function(form){

        $.ajax({
            'url': '/api/web/admin/uppdate-permission',
            'data': $("#" + form).serialize(),
            'type': 'POST',
            'dataType': 'json',
            beforeSend: function () {
                $('.box-loading').show();
            },
            complete: function () {
            },
            success: function (data) {

                if (data.result.status == "ok"){

                    setTimeout(function(){
                        $(".box-loading").hide();
                        location.reload();
                    }, 1000);

                }else{

                    setTimeout(function(){
                        $(".box-loading").hide();
                        alert(data.result.status);
                    }, 1000);
                }
            }
        });
    }

    // Add Advisor
    addCommentTicket = function(){

        var form_active = new FormData($('#form-add-comment-ticket')[0]);

        $.ajax({
            'url': '/api/web/accountant/add/comment-ticket',
            'data': form_active,
            'type': 'POST',
            'dataType': 'json',
            'cache': false,
            'contentType': false,
            'processData': false,
            beforeSend: function () {
                $('.box-loading').show();
            },
            complete: function () {
            },
            success: function (data) {

                if (data.result.status == "ok"){

                    setTimeout(function(){
                        $(".box-loading").hide();
                        location.reload();
                    }, 1000);

                }else{

                    setTimeout(function(){
                        $(".box-loading").hide();
                        alert(data.result.status);
                    }, 1000);
                }
            }
        });
    }

    // Add Advisor
    closeTicket = function(ticket_id){

        $.ajax({
            'url': '/api/web/accountant/tickets/'+ticket_id+'/close',
            'type': 'POST',
            'dataType': 'json',
            beforeSend: function () {
                $('.box-loading').show();
            },
            complete: function () {
            },
            success: function (data) {

                if (data.result.status == "ok"){

                    setTimeout(function(){
                        $(".box-loading").hide();
                        location.reload();
                    }, 1000);

                }else{

                    setTimeout(function(){
                        $(".box-loading").hide();
                        alert(data.result.status);
                    }, 1000);
                }
            }
        });
    }

    $("#input_payment_type").click(function(){

        if($(this).val() === "customer"){
            $("#text_payment_type").css("display", "block");
            $("#select_payment_customer").css("display", "block");

            $("#select_payment_provider").css("display", "none");
            $("#select_payment_employee").css("display", "none");
            $("#select_payment_partner").css("display", "none");
        }

        if($(this).val() === "provider"){
            $("#text_payment_type").css("display", "block");
            $("#select_payment_provider").css("display", "block");

            $("#select_payment_customer").css("display", "none");
            $("#select_payment_employee").css("display", "none");
            $("#select_payment_partner").css("display", "none");
        }

        if($(this).val() === "employee"){
            $("#text_payment_type").css("display", "block");
            $("#select_payment_employee").css("display", "block");

            $("#select_payment_customer").css("display", "none");
            $("#select_payment_provider").css("display", "none");
            $("#select_payment_partner").css("display", "none");
        }

        if($(this).val() === "partner"){
            $("#text_payment_type").css("display", "block");
            $("#select_payment_partner").css("display", "block");

            $("#select_payment_customer").css("display", "none");
            $("#select_payment_provider").css("display", "none");
            $("#select_payment_employee").css("display", "none");
        }

        if($(this).val() === "none"){
            $("#text_payment_type").css("display", "none");
            $("#select_payment_partner").css("display", "none");
            $("#select_payment_customer").css("display", "none");
            $("#select_payment_provider").css("display", "none");
            $("#select_payment_employee").css("display", "none");
        }
    });

    $("#input_receipt_type").click(function(){

        if($(this).val() === "customer"){
            $("#text_receipt_type").css("display", "block");
            $("#select_receipt_customer").css("display", "block");

            $("#select_receipt_provider").css("display", "none");
            $("#select_receipt_employee").css("display", "none");
            $("#select_receipt_partner").css("display", "none");
        }

        if($(this).val() === "provider"){
            $("#text_receipt_type").css("display", "block");
            $("#select_receipt_provider").css("display", "block");

            $("#select_receipt_customer").css("display", "none");
            $("#select_receipt_employee").css("display", "none");
            $("#select_receipt_partner").css("display", "none");
        }

        if($(this).val() === "employee"){
            $("#text_receipt_type").css("display", "block");
            $("#select_receipt_employee").css("display", "block");

            $("#select_receipt_customer").css("display", "none");
            $("#select_receipt_provider").css("display", "none");
            $("#select_receipt_partner").css("display", "none");
        }

        if($(this).val() === "partner"){
            $("#text_receipt_type").css("display", "block");
            $("#select_receipt_partner").css("display", "block");

            $("#select_receipt_customer").css("display", "none");
            $("#select_receipt_provider").css("display", "none");
            $("#select_receipt_employee").css("display", "none");
        }

        if($(this).val() === "none"){
            $("#text_receipt_type").css("display", "none");
            $("#select_receipt_partner").css("display", "none");
            $("#select_receipt_customer").css("display", "none");
            $("#select_receipt_provider").css("display", "none");
            $("#select_receipt_employee").css("display", "none");
        }
    });

    $("#input_customer_type, #input_employee_type, #input_partner_type, #input_provider_type").change(function(){
        var input_type = $(this).data('type');

        if($(this).val() === "pf"){
            $("#area_"+input_type+"_pf").css("display", "block");
            $("#area_"+input_type+"_pj").css("display", "none");
        }

        if($(this).val() === "pj"){
            $("#area_"+input_type+"_pf").css("display", "none");
            $("#area_"+input_type+"_pj").css("display", "block");
        }
    });

    $(".box-tabs.no-link .tab-item").click(function(){

        var tab_open = $(this).data('open');
        var tab_type = $(this).data('type');

        $('.box-tabs.no-link .tab-item').removeClass('active');
        $(this).addClass('active');
        
        $('#tab_content_'+tab_type+'_1').removeClass('active');
        $('#tab_content_'+tab_type+'_2').removeClass('active');
        $('#tab_content_'+tab_type+'_3').removeClass('active');
        $('#tab_content_'+tab_type+'_4').removeClass('active');
        
        $(tab_open).addClass('active');
    });

    $("#btn-change-status-business .item-filter").click(function(){

        var item_id = $(this).data('id');
        var item_status = $(this).data('status');

        changeStatusBusiness(item_id, item_status);
    });
    
    
});

addItem = function(){

    var html_itens = "";
    var dateInput = $('#document-date').val();
    var business_id = $('#business_id').val();
    var itens_job = $('#total-itens').val();

    itens_job++;

    html_itens += '<div id="area-add-documents-"'+ itens_job +'">';
    html_itens += '<p class="text margin-t-40 btn-close" style=" margin-bottom: 10px; color: #969696; font-weight: 600; float: left;">Documento '+ itens_job +'</p>';
    html_itens += '<button class="text margin-t-40 btn-line-gray" id="remove-'+ itens_job +'"; type="button" style=" margin-bottom: 10px; color: #969696; font-weight: 600; float: right;">X</button>';
    html_itens += '<br />';
    html_itens += '<br />';
    html_itens += '<br />';
    html_itens += '<input type="hidden" name="business_id-'+ itens_job +'" value="'+ business_id +'">';
    html_itens += '<p class="text" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Título</p>';
    html_itens += '<input type="text" class="form-control accountant required" name="title-'+ itens_job +'" style="font-size: 14px; background-color: #fff;">';
    html_itens += '<p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Descrição</p>';
    html_itens += '<input type="text" class="form-control accountant required" name="description-'+ itens_job +'" style="font-size: 14px; background-color: #fff;">';
    html_itens += '<p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de Documento</p>';
    html_itens += '<select type="text" class="form-control required" name="type-doc-'+ itens_job +'" style="font-size: 14px; background-color: #fff;">';
    html_itens += '<option value="Fiscal">Fiscal</option>';
    html_itens += '<option value="RH">RH</option>';
    html_itens += '<option value="Contábil">Contábil</option>';
    html_itens += '<option value="Legalização">Legalização</option>';
    html_itens += '<option value="Administrativo">Administrativo</option>';
    html_itens += '<option value="Financeiro">Financeiro</option>';
    html_itens += '<option value="Atendimento">Atendimento</option>';
    html_itens += '<option value="Cadastro">Cadastro</option>';
    html_itens += '<option value="Treinamento">Treinamento</option>';
    html_itens += '<option value="Outros">Outros</option>';
    html_itens += '</select>';
    html_itens += '<p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Data</p>';
    html_itens += '<div class="input-date">';
    html_itens += '<div class="icon ion-android-calendar arrow"></div>';
    html_itens += '<input type="text" class="form-control accountant add-date" name="date-'+ itens_job +'" value="'+ dateInput +'" placeholder="" style="cursor: pointer;" id="document-date">';
    html_itens += '<div class="box-datepicker accountant">';
    html_itens += '<div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#document-date-'+ itens_job +'"></div>';
    html_itens += '</div>';
    html_itens += '</div>';
    html_itens += '<p class="text margin-t-40" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Upload do documento</p>';
    html_itens += '<label class="fileContainer ">';
    html_itens += '<div for="file_document" class="btn btn-line-gray size-sm margin-t-0">SELECIONAR ARQUIVO</div>';
    html_itens += '<input type="file" style="display: none;" id="file-document-'+ itens_job +'" class="form-control-file" name="file-document-'+ itens_job +'" onchange="readURL(this);">';
    html_itens += '</label>';
    html_itens += '<label  id="text-file-'+ itens_job +'" style="font-weight: 600; color: #ff3576; margin-left: 10px;"></label>';
    html_itens += '</div>';

    $("#total-itens").val(itens_job);
    var element_itens = $(html_itens);
    $("#area-add-documents").append(element_itens);

    //REMOVE
    $('#remove-'+ itens_job + '').on('click', function(e) {
        e.preventDefault();
        $(this).parent().remove();
        itens_job--;
        $("#total-itens").val(itens_job);
    });

}


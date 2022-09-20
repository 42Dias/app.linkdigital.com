
function createOptions(){

    var options = {
        cutoutPercentage : 90,
        animation: {
            duration: 3000
        },
        hover: {
            mode: 'average',
            intersect: false
        },
        legend: {
            display: false,
        },
        scales: {
            xAxes: [{
                display: false
            }],
            yAxes: [{
                display: false
            }]
        },
        elements: {
            point: {
                radius: 0
            }
        },
        tooltips: {
            enabled: false,
            mode: 'index',
            intersect: false
        },
        layout: {
            padding: {
                left: 5,
                right: 5,
                top: 5,
                bottom: 5
            }
        }
    };

    return options;

}

$(function(){

    // Cria Chart
    createChart = function(item, values){

        var ctx = $(item);
        var chartCreate = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: values,
                    backgroundColor: ['#b0d469', '#69d48f', '#69c0d4', '#7069d4', '#d46987', '#d4ae69', '#d46969', '#69d4ac'],
                    borderWidth: 0,
                    pointBorderWidth: 0
                }],
                labels: ['Renda fixa','Renda variável','Fundos imobiliários','Fundos','Financeiro','Previdência','Outros',]
            },
            options: createOptions()
        });
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

    // Add Advisor
    sendForm = function(form){

        if(form === "form-reputacao"){
            var url = "/api/web/form/send-share";
        }else{
            var url = "/api/web/admin/send-form";
        }

        $.ajax({
            'url': url,
            'data': $("#"+form).serialize(),
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

                        if(form === "form-reputacao"){
                            location.reload();
                        }else{
                            location.href = "/admin";
                        }

                    }, 1000);

                }else{

                    setTimeout(function(){
                        $(".box-loading").hide();
                    }, 1000);
                }
            }
        });
    }

    // Add Advisor
    addContacts = function(){

        $.ajax({
            'url': '/api/web/admin/add/contacts',
            'data': $("#form-add-contacts").serialize(),
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
                    }, 1000);
                }
            }
        });
    }


    // Add Advisor
    shareContacts = function(){

        $.ajax({
            'url': '/api/web/admin/share/contacts',
            'data': $("#form-share-contacts").serialize(),
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
                    }, 1000);
                }
            }
        });
    }

    // Add Advisor
    rememberContacts = function(){

        $.ajax({
            'url': '/api/web/admin/remember/contacts',
            'data': $("#form-remember-contacts").serialize(),
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
                    }, 1000);
                }
            }
        });
    }

    // Add Advisor
    sendMessageThanks = function(){

        $.ajax({
            'url': '/api/web/admin/message/thanks',
            'data': $("#form-message-thanks").serialize(),
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
                    }, 1000);
                }
            }
        });
    }

    // Add Advisor
    generateReport = function(){

        $.ajax({
            'url': '/api/web/admin/generate/report',
            'data': $("#form-generate-report").serialize(),
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

                        window.open('/admin/report/download', '_blank');

                    }, 1000);

                }else{

                    setTimeout(function(){
                        $(".box-loading").hide();
                    }, 1000);
                }
            }
        });
    }

    // Autenticação do e-mail
    importContacts = function(){

        var file_excel = $('#file_excel').prop('files')[0];

        var form_data = new FormData();
        form_data.append('upload_excel', file_excel);

        $.ajax({
            'url': "/api/web/admin/import/contacts",
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
    }

    // Add Advisor
    addUser = function(){

        $.ajax({
            'url': '/api/web/business/add/user',
            'data': $("#form-add-user").serialize(),
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
    addUserCredit = function(){

        $.ajax({
            'url': '/api/web/client/add/user',
            'data': $("#form-add-user-credit").serialize(),
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

    // Ativar box de busca
    activeSearch = function(){

        // Text Search
        $('.menu-top .text').addClass("active");
        setTimeout(function(){
            $('.menu-top .text').css("display", "none");
        }, 500);

        // Input Search
        $('.menu-top .input-search').css("display", "block");
        setTimeout(function(){
            $('.menu-top .input-search').addClass("active");
        }, 100);

        $('#input-search-global').focus();

        // Icon Search
        $('.menu-top .ion-android-search').addClass("active");
        $('.menu-top .ion-android-close').addClass("active");

    }

    // Ativar box de busca
    disabledSearch = function(){

        // Box Results Search
        $('.box-results-search').removeClass("active");
        setTimeout(function(){
            $('.box-results-search').css("display", "none");
        }, 100);

        // Text Search
        $('.menu-top .text').removeClass("active");
        setTimeout(function(){
            $('.menu-top .text').css("display", "block");
        }, 100);

        // Input Search
        $('.menu-top .input-search').removeClass("active");
        setTimeout(function(){
            $('.menu-top .input-search').css("display", "none");
        }, 100);

        $('#input-search-global').val("");

        // Icon Search
        $('.menu-top .ion-android-search').removeClass("active");
        $('.menu-top .ion-android-close').removeClass("active");

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
            scrollTop: $($.attr(this, 'href')).offset().top - 50
        }, 500);
    });

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Aplica mascaras
    $(".mask-date").mask("99/99/9999");
    $(".mask-cpf").mask("999.999.999-99");
    $(".mask-cep").mask("99999-999");
    $(".mask-placa").mask("aaa-9999");
    $(".mask-cnpj").mask("99.999.999/9999-99");

    $(".mask-phone").mask("(99) 9999-9999?9").focusout(function (event) {
        var target, phone, element;
        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
        phone = target.value.replace(/\D/g, '');
        element = $(target);
        element.unmask();
        if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    });

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

    $(".update-status-admin").click(function () {
        var id = $(this).data("id");
        var status = $(this).data("status");
        updateStatusBusiness(id, status);
    });

    updateStatusBusiness = function(id, status){

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



    // OPEN MENU COLLAPSE
    $(".content-admin").click(function () {
        $(".main-menu").removeClass("active");
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

    // Show video
    $(".btn-video, .box-shadow-video, .btn-close-video").click(function(){

        $(".box-video").toggleClass("active");
        $(".box-shadow-video").toggleClass("active");
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

            disabledSearch();
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
    $(".content-admin, .box-results-search, #btn-search .ion-android-close").click(function(){
        disabledSearch();
    });

    // Open Import Files
    $("#btn-search .ion-android-search, #btn-search .text").click(function(){
        activeSearch();
    });

    // Open Box Results Search
    $("#input-search-global").on("keyup", function() {

        search = $(this).val();
        size_search = search.length;

        if(size_search > 2){

            $('.box-results-search').css("display", "block");
            setTimeout(function(){
                $('.box-results-search').addClass("active");
            }, 100);

            findAll();

        }else{

            $('.box-results-search').removeClass("active");
            setTimeout(function(){
                $('.box-results-search').css("display", "none");
            }, 100);
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
        $('#task-date').val(new_date);

        $(".box-datepicker").removeClass("active");
        $(".box-datepicker").removeClass("display");
    });


    // FORM

    // Check input
    $("form input[type='text'], form select").on("change", function() {

        if($(this).val() !== ""){
            $(this).removeClass("input-empty");
        }
    });

    // Check radio checkbox
    $("form input[type='radio'], form input[type='checkbox']").click(function() {
        var input_select = $(this).attr("id");
        var input_name = $(this).attr("name");

        // Verifica se foi preenchido
        if($("form input[name='" + $(this).attr("name") + "']:checked").val() !== undefined){

            $("form input[name='" + $(this).attr("name") + "']").each(function(){
                $(this).parent().find(".check").removeClass("check-empty");
            });
        }

        // RADIO
        // Verifica o campo Outros
        $("form input[type='radio']").each(function(){

            //Verifica se clicou no Outros
            if($(this).data("input") !== undefined && $(this).attr("id") === input_select && $(this).attr("name") === input_name){
                if($(this).is(":checked")){
                    $("#" + $(this).data("input")).removeClass("no-required");
                    $("#" + $(this).data("input")).parent().css("display", "block");
                }else{
                    $("#" + $(this).data("input")).addClass("no-required");
                    $("#" + $(this).data("input")).parent().css("display", "none");
                }
            }

            //Verifica se clicou em outras opções
            if($(this).data("input") !== undefined && $(this).attr("id") !== input_select && $(this).attr("name") === input_name){
                $("#" + $(this).data("input")).addClass("no-required");
                $("#" + $(this).data("input")).parent().css("display", "none");
            }
        });

        // CHECKBOX
        // Verifica o campo Outros
        $("form input[type='checkbox']").each(function(){

            //Verifica se clicou no Outrous
            if($(this).data("input") !== undefined && $(this).attr("id") === input_select && $(this).attr("name") === input_name){

                if($(this).is(":checked")){
                    $("#" + $(this).data("input")).removeClass("no-required");
                    $("#" + $(this).data("input")).parent().css("display", "block");
                }else{
                    $("#" + $(this).data("input")).addClass("no-required");
                    $("#" + $(this).data("input")).parent().css("display", "none");
                }
            }
        });
    });

    // Send Form
    $("#btnSendForm").click(function(){

        var check_form = true;
        var data_form = $(this).data("form");

        // Input
        $("#" + data_form + " input[type='text'], " + "#" + data_form + " select").each(function(){

            if(!$(this).hasClass("no-required")){

                if($(this).val() === ""){
                    check_form = false;
                    $(this).addClass("input-empty");
                }
            }
        });

        // Radio Checkbox
        $("#" + data_form + " input[type='radio'], " + "#" + data_form + " input[type='checkbox']").each(function(){

            if($("#" + data_form + " input[name='" + $(this).attr("name") + "']:checked").val() === undefined){
                check_form = false;
                $(this).parent().find(".check").addClass("check-empty");
            }
        });

        if(check_form === true){
            sendForm($(this).data("form"));
        }else{
            alert("Atenção! Verifique se todos os campos foram preenchidos corretamente.");

            event.preventDefault();

            $('html, body').animate({
                scrollTop: $("#" + data_form).offset().top - 100
            }, 500);
        }
    });

    // Open Import Files
    $("#btnImportContacts").click(function(){
        importContacts();
    });

    // Open Import Files
    $("#btnAddContacts").click(function(){
        addContacts();
    });

    // Open Import Files
    $("#btnShareContacts").click(function(){
        shareContacts();
    });

    // Open Import Files
    $("#btnRememberContacts").click(function(){
        rememberContacts();
    });

    // Open Import Files
    $("#btnMessageThanks").click(function(){
        sendMessageThanks();
    });

    // Open Import Files
    $("#btnGenerateReport").click(function(){
        generateReport();
    });


    // BUSINESS
    $("#input-tipo").change(function(){

        $("#input-cliente").fadeOut("fast");
        $("#input-consultor").fadeOut("fast");

        if($(this).val() == "1"){
            $("#input-cliente").fadeIn("fast");
        }

        if($(this).val() == "2"){
            $("#input-consultor").fadeIn("fast");
        }

        if($(this).val() == "3"){
            $("#input-cliente").fadeOut("fast");
            $("#input-consultor").fadeOut("fast");
        }
    });

    // Open Import Files
    $("#btnAddUser").click(function(){
        addUser();
    });

    // Open Import Files
    $("#btnAddUserCredit").click(function(){
        addUserCredit();
    });

});

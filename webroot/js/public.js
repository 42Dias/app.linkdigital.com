function open_box_video(){$(".box-video").toggleClass("active"),$(".box-shadow-video").toggleClass("active")}sendSimulation=function(e){$.ajax({url:"/api/simulations/send",data:$("#form-simulation-"+e).serialize(),type:"POST",dataType:"json",beforeSend:function(){$(".box-loading").show()},complete:function(){},success:function(e){"ok"==e.result.status?setTimeout(function(){$(".box-loading").hide(),window.location.replace("/simulation-sucesso")},1500):alert(e.result.status)}})},sendContact=function(e){if($("#upload_document").length){var o=$("#upload_document").prop("files")[0],a=new FormData;a.append("upload_document",o),a.append("type_send",$("#upload-type").val()),a.append("name",$("#upload-name").val()),a.append("email",$("#upload-email").val()),a.append("phone",$("#upload-phone").val()),a.append("message",$("#upload-message").val()),$.ajax({url:"/api/send-contact",type:"POST",dataType:"text",cache:!1,contentType:!1,processData:!1,data:a,beforeSend:function(){$(".box-loading").show()},complete:function(){},success:function(e){setTimeout(function(){$(".box-loading").hide(),window.location.replace("/contato-sucesso")},1500)}})}else $.ajax({url:"/api/send-contact",data:$("#form-contact").serialize(),type:"POST",dataType:"json",beforeSend:function(){$(".box-loading").show()},complete:function(){},success:function(e){"ok"==e.result.status?setTimeout(function(){$(".box-loading").hide(),window.location.replace("/contato-sucesso")},1500):alert(e.result.status)}})},createLead=function(){$.ajax({url:"/api/contract/create-lead",data:$("#form-lead").serialize(),type:"POST",dataType:"json",beforeSend:function(){$(".box-loading").show()},complete:function(){},success:function(e){"ok"==e.result.status?setTimeout(function(){$(".box-loading").hide(),window.location.replace("/contato-sucesso")},1500):alert(e.result.status)}})},createLeadService=function(e){$.ajax({url:"/api/contract/create-lead",data:$("#form-service").serialize(),type:"POST",dataType:"json",beforeSend:function(){$(".box-loading").show()},complete:function(){},success:function(o){"ok"==o.result.status?setTimeout(function(){$(".box-loading").hide(),window.location.replace("/servico-sucesso?service="+e)},1500):alert(o.result.status)}})},$(function(){var e=!1;$(document).mousemove(function(o){o.pageY<=5&&!1===e&&(e=!0,$("#popupExit").modal("show"))}),$(document).on("click",'a[href^="#"]',function(e){e.preventDefault(),$("html, body").animate({scrollTop:$($.attr(this,"href")).offset().top-150},500)}),$(window).scrollTop()>=150&&$("header").addClass("fixed"),$(window).scrollTop()<150&&$("header").removeClass("fixed"),$(".video-play").click(function(){open_box_video(),$(".box-video iframe").attr({src:$(this).data("video")})}),$(".box-video, .box-shadow-video").click(function(){$(".box-video").toggleClass("active"),$(".box-video iframe").attr({src:""}),$(".box-shadow-video").toggleClass("active")}),$("#btn-menu-bars, #btn-collapse-menu-bars").click(function(){$(".box-menu-collapse").toggleClass("active"),$(".box-menu-collapse").hasClass("active")?($(".box-shadow").css("display","block"),$(".box-menu-collapse").animate({right:"0px"},200),$(".img-left-menu-collapse").animate({right:"250px"},200),$(".shadow-bottom-white").animate({right:"0px"},200)):($(".box-shadow").css("display","none"),$(".box-menu-collapse").animate({right:"-300px"},200),$(".img-left-menu-collapse").animate({right:"-90px"},200),$(".shadow-bottom-white").animate({right:"-250px"},200))}),$(".box-shadow, .btn-close-collapse, .box-menu-collapse a").click(function(){$(".box-menu-collapse").toggleClass("active"),$(".box-shadow").css("display","none"),$(".box-menu-collapse").animate({right:"-300px"},200),$(".img-left-menu-collapse").animate({right:"-90px"},200),$(".shadow-bottom-white").animate({right:"-250px"},200)}),$("#carouselProductsMobile").carousel(),$("#carouselProducts").carousel(),$(".mask-date").mask("99/99/9999"),$(".mask-cpf").mask("999.999.999-99"),$(".mask-cep").mask("99999-999"),$(".mask-placa").mask("aaa-9999"),$(".mask-cnpj").mask("99.999.999/9999-99"),$(".mask-phone").mask("(99) 99999-9999").focusout(function(e){var o,a,t;a=(o=e.currentTarget?e.currentTarget:e.srcElement).value.replace(/\D/g,""),(t=$(o)).unmask(),a.length>10?t.mask("(99) 99999-9999"):t.mask("(99) 9999-9999")});var o="";$(".simulation-document").click(function(){$(this).val("")}),$(".simulation-document").focusout(function(){""!==o?$(this).val(o):$(this).val("")}),$(".simulation-document").change(function(){var e=$(this).val();""!==e&&(e.length<11?$(this).val(""):e.length>11&&e.length<14?$(this).val(""):18==e.length?o=$(this).val():14==e.length&&"."==e.substr(3,1)?o=$(this).val():e.length>11?(o=e.substr(0,2)+"."+e.substr(2,3)+"."+e.substr(5,3)+"/"+e.substr(8,4)+"-"+e.substr(12,2),$(this).val(o)):(o=e.substr(0,3)+"."+e.substr(3,3)+"."+e.substr(6,3)+"-"+e.substr(9,2),$(this).val(o)))}),$("#simulationAuto").on("show.bs.modal",function(e){$("#preSimulationAuto").modal("hide")}),$(".btnSendSimulation").click(function(){sendSimulation($(this).data("type"))}),$(window).scroll(function(){$(window).scrollTop()>=150&&$("header").addClass("fixed"),$(window).scrollTop()<150&&$("header").removeClass("fixed")}),$(".btnSendLead").click(function(){""===$(".required").val()?alert("Preencha todos os campos"):createLead()}),$(".btnSendService").click(function(){""===$(".required").val()?alert("Preencha todos os campos"):createLeadService($(this).data("service"))}),$(".btnSendContactxxx").click(function(){""===$(".required").val()?alert("Preencha todos os campos"):sendContact()}),$(".btn-open-cart").click(function(){$(".box-cart").toggleClass("active"),$(this).toggleClass("active"),$(this).hasClass("active")?($(".btn-open-cart .icon").removeClass("ion-android-cart"),$(".btn-open-cart .icon").addClass("ion-android-close")):($(".btn-open-cart .icon").addClass("ion-android-cart"),$(".btn-open-cart .icon").removeClass("ion-android-close"))})});

function validarCNPJ(cnpj) {
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
    
}

// openModalAlert
openModalAlert = function(title, text){

    $("#modal_title").html(title);
    $("#modal_text").html(text);
    $('#alert_modal').modal('show');
}

// updateTotalMonth
updateTotalMonth = function(){

    var service_price = $("#service-price").val();
    var active_socios = $("#input-socios").val();
    var active_funcionarios = $("#input-funcionarios").val();
    var active_faturamento = $("#input-faturamento").val();
    var total_price_socios = 0;
    var total_price_funcionarios = 0;
    var total_price_faturamento = 0;
    var total_pessoal = 0;
    var total_extra = 0;

    service_price = service_price.replace(",", ".");
    total_pessoal = eval(active_socios) + eval(active_funcionarios);

    if(total_pessoal > 5){
        total_extra = (total_pessoal - 5) * 60.00;
    }

    // if(active_socios > 1){
    //     total_price_socios = (active_socios - 1) * 60.00;
    // }

    // if(active_funcionarios > 6){
    //     total_price_funcionarios = (active_funcionarios - 6) * 60.00;
    // }

    if(active_faturamento > 1){
        total_price_faturamento = (active_faturamento - 1) * 200;
    }

    total_month = eval(service_price) + total_extra + total_price_faturamento;
    total_month = total_month.toFixed(2);
    total_month = total_month.toString();
    total_month = total_month.replace(".", ",");

    $("#sidebar-total-month").html("R$ " + total_month);
}

// Validade CPF
validateCpf = function(strCPF) {

    strCPF = strCPF.substr(0, 3) + strCPF.substr(4, 3) + strCPF.substr(8, 3) + strCPF.substr(12, 2);

    var Soma;
    var Resto;
    Soma = 0;
	if (strCPF == "00000000000") return false;
    if (strCPF == "11111111111") return false;
    if (strCPF == "22222222222") return false;
    if (strCPF == "33333333333") return false;
    if (strCPF == "44444444444") return false;
    if (strCPF == "55555555555") return false;
    if (strCPF == "66666666666") return false;
    if (strCPF == "77777777777") return false;
    if (strCPF == "88888888888") return false;
    if (strCPF == "99999999999") return false;

	for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
	Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

	Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}

// Send Contact
sendForm = function(url, form, redirect){

    $.ajax({
        'url': url,
        'data': $(form).serialize(),
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
                    }

                    // Busca CEP
                    if(url === "/api/web/search/cep"){
                        $("#input-address").val(data.result.address);
                        $("#input-district").val(data.result.district);
                        $("#input-city").val(data.result.city);
                        $("#input-state").val(data.result.state);
                    }

                }, 1500);

            }else{
                openModalAlert("Atenção!", data.result.status);
            }
        }
    });
}

updateTaxation = function(type){

    $.ajax({
        'url': "/api/web/business/update-taxation/" + type,
        'data': $("form_step_2").serialize(),
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
                    window.location.reload();
                    // location.reload();
                }, 1500);

            }else{
                setTimeout(function() {
                    $(".box-loading").hide();
                    openModalAlert("Atenção!", data.result.status);

                }, 1500);
            }
        }
    });
}

updateService = function(type){

    $.ajax({
        'url': "/api/web/business/update-service/" + type,
        'data': $("form_step_2").serialize(),
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
                    window.location.reload();
                    // location.reload();
                }, 1500);

            }else{
                setTimeout(function() {
                    $(".box-loading").hide();
                    openModalAlert("Atenção!", data.result.status);

                }, 1500);
            }
        }
    });
}

updatePlan = function(type){

    $.ajax({
        'url': "/api/web/business/update-plan/" + type,
        'data': $("form_step_2").serialize(),
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
                    window.location.reload();
                    // location.reload();
                }, 1500);

            }else{
                setTimeout(function() {
                    $(".box-loading").hide();
                    openModalAlert("Atenção!", data.result.status);

                }, 1500);
            }
        }
    });
}


agendarLucroReal = function(){

    $.ajax({
        'url': "/api/web/business/agendar-lucro-real",
        'data': $("#form_step_2_agendamento").serialize(),
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
                    $("#alert_lucro_real").modal("hide"); 
                    $("#btn-step-2").show(); 
                }, 1500);

            }else{
                setTimeout(function() {
                    $(".box-loading").hide();
                    openModalAlert("Atenção!", data.result.status);

                }, 1500);
            }
        }
    });
}

// Send Contact
sendContact = function(type){

    $.ajax({
        'url': "/api/web/send-contact",
        'data': $("#form-contact").serialize(),
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
                    // window.location.reload();
                    // window.location.replace("/contato-sucesso");
                    openModalAlert("Contato enviado!", data.result.message);

                    $("#form-contact input, #form-contact textarea").val('');
                }, 1500);

            }else{
                openModalAlert("Atenção!", data.result.message);
            }
        }
    });
}

searchCnpj = function(){

    $.ajax({
        'url': "/api/web/business/search-cnpj",
        'data': $("#form_step_2").serialize(),
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
                    // window.location.reload();
                    $(".box-loading").hide();

                    $("#step-2-razao").val(data.result.razao);
                    $("#step-2-fantasia").val(data.result.fantasia);

                    // Principal
                    var principal = data.result.principal;
                    var principal_text = "";

                    for (i = 0; i < principal.length; i++) {
                        principal_text += "- " + principal[i]['text'] + "<br>";
                    }
                    $("#step-2-principal").html(principal_text);

                    // Atividades secundárias
                    var atividades = data.result.secundarias;
                    var atividades_text = "";

                    for (i = 0; i < atividades.length; i++) {
                        atividades_text += "- " + atividades[i]['text'] + "<br>";
                    }

                    $("#step-2-secundarias").html(atividades_text);

                    // Sócios
                    var admin = data.result.admin;
                    var admin_text = "";

                    for (i = 0; i < admin.length; i++) {
                        admin_text += admin[i]['qual'] + "<br>";
                        admin_text += admin[i]['nome'] + "<br><br>";
                    }

                    $("#step-2-admin").html(admin_text);

                    // Show Box
                    $(".box-info-cnpj").fadeIn("slow");
                }, 1500);

            }else{
                $(".box-loading").hide();
                openModalAlert("Atenção!", data.result.status);
            }
        }
    });

}

$(document).ready(function () {

    // tooltip
    $('[data-toggle="tooltip"]').tooltip({
        'animation': false
    });

    // Href
    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top + 10
        }, 500);
    });

    // OPEN MENU COLLAPSE
    $("#btn-menu-mobile").click(function () {
        $(".box-menu-mobile").toggleClass("active");
    });

    $(".btn-close-mobile").click(function () {
        $(".box-menu-mobile").toggleClass("active");
    });

    $('.mask-date').mask('00/00/0000');
    $('.mask-dd-yy').mask('00/0000');
    $('.mask-time').mask('00:00:00');
    $('.mask-date_time').mask('00/00/0000 00:00:00');
    $('.mask-cep').mask('00000-000');
    $('.mask-mixed').mask('AAA 000-S0S');
    $('.mask-cpf').mask('000.000.000-00', {reverse: true});
    $('.mask-cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.mask-money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("#.##0,00", {reverse: true});
    $('.mask-creditcard').mask('0000 0000 0000 0000');
    $('#mask-phone-whatsapp').mask('(00) 00000-0000');

    $('.mask-phone').on('keyup', function() {
        if(($(this).val()).length = "" || ($(this).val()).length < 10){
            $('.mask-phone').mask('(00) 00000-0000');
        }
    });

    $('.mask-phone').on('blur', function() {
        if(($(this).val()).length == 11 || ($(this).val()).length == 15){
            $('.mask-phone').mask('(00) 00000-0000');
        }

        if(($(this).val()).length == 10 || ($('.mask-phone').val()).length == 14){
            $('.mask-phone').mask('(00) 0000-0000');
        }
    });

    $('#step-2-socios-mei, #step-2-funcionarios-mei').on('blur', function() {
        
        if($('#step-2-socios-mei').val() > 1){
            $('#step-2-socios-mei').val("1");
        }

        if($('#step-2-funcionarios-mei').val() > 1){
            $('#step-2-funcionarios-mei').val("0");
        }
    });


    $('#btn-step-1').hide();

    $('#input-confirm-password').on('blur', function() {
        if($('#input-confirm-password').val() == $('#input-password').val()){
            $('#btn-step-1-disabled').hide();
            $('#btn-step-1').show();
        }else{
            $('#btn-step-1').hide();
            $('#btn-step-1-disabled').show();
            openModalAlert("Atenção!", "As senhas são diferentes!")
        }
    });   
    
    $("#step-2-cnpj").on("blur",function(e){
        var char = $(this).val();

        if(char.length == 18){
            searchCnpj();
        }else{
            openModalAlert("Atenção!", "CNPJ inválido");
        }
    });

    // Scrool Menu
    $(window).scroll(function() {
        if($(window).scrollTop() >= 130){
            $("header").addClass("fixed");
            $(".header-logo img").attr("src", "/img/logo-link.png");
            $("#btn_menu_login").addClass("btn-yellow");
            $("#btn_menu_login").removeClass("btn-line-white");
        }

        if($(window).scrollTop() < 130){
            $("header").removeClass("fixed");
            $(".header-logo img").attr("src", "/img/logo-link-white.png");
            $("#btn_menu_login").removeClass("btn-yellow");
            $("#btn_menu_login").addClass("btn-line-white");
        }
    });

    // Validate CPF
    $("#input-cpf").keyup(function(){

        var char = $(this).val();

        if(validateCpf(char) === false){
            $(this).addClass("input-error");
            $(this).parent().find("p").html("CPF Inválido");
            $(this).parent().find("p").css("color", "#e70e55");
        }else{
            $(this).removeClass("input-error");
            $(this).css("border", "1px solid #00c221");
            $(this).parent().find("p").html("CPF válido");
            $(this).parent().find("p").css("color", "#00c221");
        }
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

        // Valida CPF
        if(form === "#form_step_1"){

            if(validateCpf($("#input-cpf").val()) === false){
                errors++;
                $("#input-cpf").addClass("input-error");
            }
        }

        if(errors > 0){
            openModalAlert("Atenção!", "Preencha todos os campos corretamente.");
        }else{

            if(form === "#form_add_credit"){

                $("#form_add_credit").submit();

                setTimeout(function() {
                    sendForm(url, form, redirect);
                }, 500);

            }else{
                sendForm(url, form, redirect);
            }

        }
    });

    // Change socios
    // var price_socios = 0;
    var total_extra = 0;

    $("#input-socios, #input-funcionarios").change(function(){

        var service_price = $("#service-price").val();
        var active_socios = $("#input-socios").val();
        var active_funcionarios = $("#input-funcionarios").val();
        var total_month = 0;

        // Update text
        var attr_element = $(this).attr("id");

        if(attr_element === "input-socios"){
            
            if(eval(active_socios) === 1){
                $("#text-socios").html(active_socios + " Sócio");
            }else{
                $("#text-socios").html(active_socios + " Sócios");
            }
        }

        if(attr_element === "input-funcionarios"){

            if(eval(active_funcionarios) == 0){
                $("#text-funcionarios").html("Nenhum Funcionário");
            }
            if(eval(active_funcionarios) == 1){
                $("#text-funcionarios").html(active_funcionarios + " Funcionário");
            }
            if(eval(active_funcionarios) > 1){
                $("#text-funcionarios").html(active_funcionarios + " Funcionários");
            }
        }

        service_price = service_price.replace(",", ".");
        total_pessoal = eval(active_socios) + eval(active_funcionarios);

        if(total_pessoal > 5){
            // price_socios = (active_socios - 1) * 60.00;

            // $("#text-socios, #sidebar-text-socios").html(active_socios + " Sócios");
            // $("#price-socios, #sidebar-price-socios").html("+ R$ " + price_socios.toFixed(2) + " / Mensal");
            // $("#price-socios").css("color", "#e70e55");

            // // Box sidebar
            // $("#box-socios").fadeIn("fast");

            total_extra = (total_pessoal - 5) * 60.00;

            if((total_pessoal - 5) === 1){
                $("#sidebar-text-extra").html((total_pessoal - 5) + " Adicional");
            }else{
                $("#sidebar-text-extra").html((total_pessoal - 5) + " Adicionais");
            }

            $("#sidebar-price-extra").html("+ R$ " + total_extra.toFixed(2) + " / Mensal");

            // Box sidebar
            $("#box-extra").fadeIn("fast");

            updateTotalMonth();

        }else{
            // $("#text-socios, #sidebar-text-socios").html("1 Sócio");
            // $("#price-socios, #sidebar-price-socios").html("GRÁTIS");
            // $("#price-socios").css("color", "#00c221");

            // // Box sidebar
            // $("#box-socios").fadeOut("fast");

            // Box sidebar
            $("#box-extra").fadeOut("fast");

            updateTotalMonth();
        }
    });

    // Change funcionarios
    // var price_funcionarios = 0;

    // $("#input-funcionarios").change(function(){

    //     var service_price = $("#service-price").val();
    //     var active_funcionarios = $(this).val();
    //     var total_month = 0;

    //     service_price = service_price.replace(",", ".");

    //     if(active_funcionarios > 6){
    //         price_funcionarios = (active_funcionarios - 6) * 60.00;

    //         $("#text-funcionarios, #sidebar-text-funcionarios").html(active_funcionarios + " Funcionários");
    //         $("#price-funcionarios, #sidebar-price-funcionarios").html("+ R$ " + price_funcionarios.toFixed(2) + " / Mensal");
    //         $("#price-funcionarios").css("color", "#e70e55");

    //         // Box sidebar
    //         $("#box-funcionarios").fadeIn("fast");

    //         updateTotalMonth();

    //     }else{

    //         price_funcionarios = 0;

    //         if(active_funcionarios == 0){
    //             $("#text-funcionarios, #sidebar-text-funcionarios").html("Nenhum funcionário");
    //         }else{
    //             $("#text-funcionarios, #sidebar-text-funcionarios").html(active_funcionarios + " Funcionários");
    //         }

    //         $("#price-funcionarios, #sidebar-price-funcionarios").html("GRÁTIS");
    //         $("#price-funcionarios").css("color", "#00c221");

    //         // Box sidebar
    //         $("#box-funcionarios").fadeOut("fast");

    //         updateTotalMonth();
    //     }
    // });

    // Change socios
    var price_faturamento = 0;


    if($("#input-faturamento").val() == null){
        var active_faturamento = $(this).val();
        $("#sidebar-text-faturamento-title").html("Faixa de Faturamento");
        price_faturamento = (active_faturamento - 1) * 200;

        $("#price-faturamento, #sidebar-price-faturamento").html("+ R$ " + price_faturamento.toFixed(2) + " / Mensal");
        $("#price-faturamento").css("color", "#e70e55");

        // Box sidebar
        $("#box-faturamento").fadeIn("fast");
    }

    $("#input-faturamento").change(function(){

        var service_price = $("#service-price").val();
        var active_faturamento = $(this).val();
        var total_month = 0;

        service_price = service_price.replace(",", ".");

        $("#sidebar-text-faturamento-title").html("Faixa de Faturamento");
            
        if(active_faturamento > 1){
            price_faturamento = (active_faturamento - 1) * 200;

            $("#text-faturamento, #sidebar-text-faturamento").html($("#input-faturamento option:selected").text());
            $("#price-faturamento, #sidebar-price-faturamento").html("+ R$ " + price_faturamento.toFixed(2) + " / Mensal");
            $("#price-faturamento").css("color", "#e70e55");

            // Box sidebar
            $("#box-faturamento").fadeIn("fast");

            updateTotalMonth();

        }else{
            
            $("#text-faturamento, #sidebar-text-faturamento").html("R$ 0,00 a R$ 15.000,00");
            $("#price-faturamento, #sidebar-price-faturamento").html("GRÁTIS");
            $("#price-faturamento").css("color", "#00c221");

            // Box sidebar
            // $("#box-faturamento").fadeOut("fast");

            updateTotalMonth();
        }
    });

    // Change Taxation
    $("#input-taxation").change(function(){
        // sendForm("/api/web/business/add-step-2", "#form_step_2", "/contratar/etapa-2");
        var type = $("#input-taxation option:selected").val();
        updateTaxation(type);
    });
    
    // $("#btn-agendamento-step-2").hide(); 

    if($("#input-taxation").val() == "real"){ 
        $("#btn-agendamento-step-2").show(); 
        $("#btn-step-2").hide(); 
        $("#alert_lucro_real").modal('show'); 
        $("#btn-agendamento-step-2").hide(); 
    }

    $("#btn-formulario-step-2").click(function() {
        var errors = 0;

        var valida_cnpj = validarCNPJ($('#input-cnpj-lucro-real').val());

        if(valida_cnpj === true){

            $("#form_step_2_agendamento" + " .required").each( function(){
                if($(this).val() === ""){
                    errors++;
                    $(this).addClass("input-error");
                }else{
                    $(this).removeClass("input-error");
                }
            });

            if(errors == 0){
                agendarLucroReal();
            }

        }else{
            errors++;
            alert("Atenção! CNPJ inválido, tente novamente.")
            $('#input-cnpj-lucro-real').addClass("input-error");
        }
        
    });
    
    // $("#btn-agendar-step-2").click(function() {
    //     $("#btn-agendamento-step-2").hide(); 
    //     $("#btn-step-2").show(); 
    //     $("#alert_lucro_real").modal('hide'); 
    // });

    // $("#btn-agendamento-step-2").on('click', function() {
        
    //     var errors = 0;

    //     $("#form_step_2" + " .required").each( function(){
    //         if($(this).val() === ""){
    //             errors++;
    //             $(this).addClass("input-error");
    //         }else{
    //             $(this).removeClass("input-error");
    //         }
    //     });

    //     if(errors > 0){
    //         openModalAlert("Atenção!", "Preencha todos os campos corretamente.");
    //     }else{
    //         agendarLucroReal();
    //     }
    // });

    $("#input-service-type").change(function(){
        var type = $("#input-service-type option:selected").val();
        updateService(type);
    });

    $(".input-plano").click(function(){
        var type = $(this).data('type');
        updatePlan(type);
    });

    // btn_search_cep
    $(".btn_search_cep").click(function(){

        var url = $(this).data("url");
        var form = $(this).data("form");
        var redirect = $(this).data("redirect");

        if($("#input-cep").val() === ""){

            $("#input-cep").addClass("input-error");
            openModalAlert("Atenção!", "Preencha todos o CEP corretamente.");
        }else{

            $("#input-cep").removeClass("input-error");
            sendForm(url, form, redirect);
        }
    });

    // creditcard
    $("#input-credit-number").keyup(function(){
        $("#text-credit-number").html($(this).val());
    });

    $("#input-credit-name").keyup(function(){
        $("#text-credit-name").html($(this).val());
    });

    $("#input-credit-maturity").keyup(function(){
        $("#text-credit-maturity").html($(this).val());
    });

    $("#input-credit-security").keyup(function(){
        $("#text-credit-security").html('<i class="icon material-icons-outlined" style="font-size: 14px; color: #75757d; top: 3px; position: relative;">lock</i>&nbsp; ' + $(this).val());
    });

    // Contact
    $("#btnSendContact").click(function(){
        sendContact();
    });
    
    $("#btnSendContactFaleConosco").click(function(){
        $('#agenda').modal('show');
    });

    $(".payment-credit").hide(); 
    $(".payment-credit-validate").hide();
    $(".payment-transfer").hide();
    $(".payment-transfer-validate").hide();
    $("#payment-transfer-checkout").hide();

    $("#payment-credit").click(function(){
        $(".payment-credit").show();
        $(".payment-transfer").hide();
        $(".payment-transfer-validate").hide();
        $("#payment-transfer-checkout").hide();
    });

    $("#payment-transfer").click(function(){
        $(".payment-transfer").show();
        $(".payment-transfer-validate").show();
        $(".payment-credit").hide(); 
        $(".payment-credit-validate").hide();
        $("#payment-transfer-checkout").show();
    });

    $("#payment-transfer-checkout").click(function(){
        paymentTransfer();
    });

    $("#payment-credit-validate").click(function(){
        paymentCreditCard();
    });

    paymentTransfer = function(){

        $.ajax({
            'url': "/api/web/payments/transfer",
            'data': $("form_transfer").serialize(),
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
                        window.location.replace('/contratar/etapa-final');
                    }, 1500);
    
                }else{
                    setTimeout(function() {
                        $(".box-loading").hide();
                        openModalAlert("Atenção!", data.result.status);
    
                    }, 1500);
                }
            }
        });
    }   

    paymentCreditCard = function(type){

        $.ajax({
            'url': "/api/web/payments/add-credit",
            'data': $("#form_add_credit").serialize(),
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
                        // window.location.reload();
                        window.location.replace('/contratar/etapa-final');
                        
                        
                    }, 1500);
    
                }else{
                    openModalAlert("Atenção!", data.result.status);
                }
            }
        });
    }   

    $("#modal-tranferir-mei-me").hide(); 

    $("#btn-tranferir-mei-me").click(function(){
        $("#modal-tranferir-mei-text").hide(); 
        $("#modal-tranferir-mei-me").show(); 
    });
    
    $('#transferir_mei_me').on('hide.bs.modal', function (event) {
        $("#modal-tranferir-mei-text").show(); 
        $("#modal-tranferir-mei-me").hide(); 
      })

    $.getJSON('/js/faturamento.json', function (data) {

        var options = '';

        $.each(data, function (key, val) {
            options += '<option value="' + val.value + '">' + val.faturamento + '</option>';
        });

        $(".input-faturamento").html(options);

    });

    // Select Como conheceu - Step 1
    $('#input-como-conheceu').change(function(){
        
        var input = $(this);

        $('#input-indication').fadeOut('fast');
        $('#input-outros').fadeOut('fast');

        setTimeout(function() {
                       
            if(input.val() === 'Indicação'){
                $('#input-indication').fadeIn('fast');
            }
    
            if(input.val() === 'Outros'){
                $('#input-outros').fadeIn('fast');
            }

        }, 200);
        
    });

    $("#input-register-type").change(function(){
        if($(this).val() === 'pj'){
            $("#input-register-document-cnpj").fadeIn('fast');
            $("#input-register-document-cpf").css('display', 'none');
        }else{
            $("#input-register-document-cpf").fadeIn('fast');
            $("#input-register-document-cnpj").css('display', 'none');
        }
    });

    $gn.ready(function(checkout) {
        var callback = function(error, response) {
            if(error) {
                // console.error(error);
                $(".payment-credit-validate").hide();
                openModalAlert("Atenção!", "Verifique se todos os dados do cartão estão corretos!");
            } else {
                // console.log(response.data.payment_token);
                $(".payment-credit-validate").show();    
                
                $(".btn_send_form").hide();           
                $("#input-payment-id").val(response.data.payment_token);
            }
        };

        $("#payment-credit-checkout").click(function(){

            if($("#input-credit-number").val() === "" || $("#input-credit-band").val() === "" || $("#input-credit-maturity").val() === "" || $("#input-credit-security").val() === ""){
                openModalAlert("Atenção!", "Preencha todos o campos!");
            }else{
                
                checkout.getPaymentToken({
                    brand: $("#input-credit-band").val(), // bandeira do cartão
                    number: $("#input-credit-number").val(), // número do cartão
                    cvv: $("#input-credit-security").val(), // código de segurança
                    expiration_month: ($("#input-credit-maturity").val()).split("/")[0], // mês de vencimento
                    expiration_year: ($("#input-credit-maturity").val()).split("/")[1] // ano de vencimento
                }, callback);

                openModalAlert("Sucesso!", "Cartão validado com sucesso, finalize sua compra!");
            }
        });
    });
    

});


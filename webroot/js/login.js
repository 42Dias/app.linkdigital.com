var password = "";

// openModalAlert
openModalAlert = function(title, text){

    $("#modal_title").html(title);
    $("#modal_text").html(text);
    $('#alert_modal').modal('show');
}

$(function(){

    // Autenticação do e-mail
    sendPassword = function(){

        $.ajax({
            'url': "/api/web/login/send-password",
            'data': $("#form-email").serialize(),
            'type': 'POST',
            'dataType': 'json',
            beforeSend: function () {
                $('.box-loading').show();
            },
            complete: function () {
            },
            success: function (data) {
                $(".box-loading").hide();

                if (data.result.status == "ok"){
                    window.location.replace(data.result.redirect);
                }else{
                    openModalAlert("Atenção!", data.result.status);
                }
            }
        });

    }

    // Autenticação do e-mail
    updatePassword = function(){

        $.ajax({
            'url': "/api/web/login/update-password",
            'data': $("#form-password").serialize(),
            'type': 'POST',
            'dataType': 'json',
            beforeSend: function () {
                $('.box-loading').show();
            },
            complete: function () {
            },
            success: function (data) {
                $(".box-loading").hide();

                if (data.result.status == "ok"){
                    window.location.replace(data.result.redirect);
                }else{
                    openModalAlert("Atenção!", data.result.status);
                }
            }
        });

    }

    // Autenticação do usuário
    deleteUser = function(user_id){

        $.ajax({
            'url': "/api/web/login/delete/"+user_id,
            'type': 'POST',
            'dataType': 'json',
            beforeSend: function () {
                $('.box-loading').show();
            },
            complete: function () {
            },
            success: function (data) {
                $(".box-loading").hide();

                if (data.result.status == "ok"){
                    window.location.replace("/login");
                }

                if (data.result.status == "redirect"){
                    window.location.replace("/login");
                }
            }
        });

    }

    // Autenticação do e-mail
    $('#validate-email').click(function(){
        authEmail();
    });

    // Autenticação da senha
    $('#validate-password').click(function(){
        authLogin();
    });

    $('#form-login, #form-email').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    // Autenticação do e-mail
    $("#username").bind("keyup",function(e){
        var code = e.keyCode || e.which;

        if(code == 13) {
            authEmail();
        }
    });

    // Autenticação da senha
    $("#password").bind("keyup",function(e){
        var code = e.keyCode || e.which;

        if(code == 13) {
            authLogin();
        }
    });

    // Enviar senha
    $('#send-password').click(function(){
        sendPassword();
    });

    // Atualiza senha
    $('#update-password').click(function(){
        updatePassword();
    });

    $('.card-user .box-user').click(function(event){
        event.stopPropagation();

        if($(this).data("id") === 0){
            window.location.replace($(this).data("redirect"));
        }else{
            window.location.replace($(this).data("redirect")+$(this).data("id"));
        }
    });


    // Verifica se está na página de Password
    if ($('.btn-password').data("position") !== undefined){

        // Gera números das senhas
        generatePassword();

        // Autenticação da senha
        var letters = "";
        var hash = "";

        // Gera números da senha
        $('.btn-password').click(function(){
            if (password.length < 4){
                password = password + ($(this).data("position"));
                $("#password").val(password);
                $(".input-password").html(password);

                // Ativa campo de senha
                hash = hash + "●";
                $(".input-password").addClass("active");
                $(".input-password").html(hash);
            }
        });

        // Apaga números da senha
        $('#btn-password-clear').click(function(){
            letters = (password.length) - 1;
            password = password.substring(0,letters);
            $("#password").val(password);

            // Desativa campo de senha
            if (password.length === 1){ hash = "●" }
            if (password.length === 2){ hash = "●●" }
            if (password.length === 3){ hash = "●●●" }

            $(".input-password").html(hash);

            if (password.length === 0){
                $(".input-password").html("Senha");
                hash = "";
                $(".input-password").removeClass("active");
            }
        });

        // Bloqueia input
        $("#password").blur(function(e) {
            $(this).val("");
        });

        $("#password").focusout(function(e) {
            $(this).val("");
        });

    }

    // Autenticação do e-mail
    $('.btn-delete-user').click(function(event){
        event.stopPropagation();
        deleteUser($(this).data("id"));

        // $(this).parent().parent().remove();
        //
        // var check = 0;
        //
        // $(".card-user").each(function(){
        //     check = check + 1;
        // });
        //
        // if(check === 1){
        //     // window.location.replace("/entrar/email");
        // }
    });
});

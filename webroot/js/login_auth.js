
// openModalAlert
openModalAlert = function(title, text){

    $("#modal_title").html(title);
    $("#modal_text").html(text);
    $('#alert_modal').modal('show');
}

$(function(){

    // Autenticação do e-mail
    authEmail = function(){

        $.ajax({
            'url': "/api/web/login/validate-email",
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

    // Autenticação do usuário
    authLogin = function(){

        $.ajax({
            'url': "/api/web/login/validate-password",
            'data': $("#form-login").serialize(),
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
                    $("#password").val("");
                    password = "";
                }
            }
        });

    }

});

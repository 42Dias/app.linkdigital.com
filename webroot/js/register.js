
var password = "";

// openModalAlert
openModalAlert = function(title, text){

    $("#modal_title").html(title);
    $("#modal_text").html(text);
    $('#alert_modal').modal('show');
}

$(function(){

    // Autenticação do e-mail
    addRegister = function(){

        $.ajax({
            'url': "/api/web/register/add-register",
            'data': $("#form-register").serialize(),
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
                    window.location.replace('/cadastro-sucesso');
                }else{
                    openModalAlert("Atenção!", data.result.status);
                }
            }
        });

    }

    // Autenticação do e-mail
    $('#add-register').click(function(event){
      addRegister();
    });

});

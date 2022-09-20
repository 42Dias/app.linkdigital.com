
<div class="modal" id="popupExit" tabindex="-1" role="dialog" aria-labelledby="popupExitLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content status positive" style="padding: 50px;">

            <div class="btn-close-modal dark" data-dismiss="modal" aria-label="Close" id="btn-close-exit">
                <span class="icon ion-ios-close-empty"></span>
            </div>

            <span class="top-title margin-t-10" style="color: black; font-size: 26px; font-weight: 600; line-height: 30px;">
                Ops,
            </span>
            <span class="top-title margin-b-20" style="color: black; font-size: 26px; font-weight: 600; line-height: 30px;">
                Já vai embora?!
            </span>

            <p class="top-title margin-t-20" style="color: black; font-size: 18px; font-weight: 300; line-height: 26px;">
                Não antes de checar as VANTAGENS DE SER NOSSO CLIENTE!!!<br>
            </p>

            <p class="top-title margin-t-20" style="color: black; font-size: 14px; font-weight: 300; line-height: 26px;">
                Aqui você tem:
                <br>
                <br> ● Apoio gerencial de forma clara e objetiva
                <br> ● Reuniões periódicas para análise dos resultados
                <br> ● Gráficos e indicadores para melhor controle
                <br> ● Aproveitamentos de crédito e benefícios fiscais
                <br> ● Investimentos adequados
            </p>

            <div class="text-center margin-t-40">

                <a href="#simular-mensalidade" data-dismiss="modal"  aria-label="Close" class="btn btn-yellow size-lg margin-t-0">
                    QUERO CONTRATAR
                </a>

            </div>

        </div>
    </div>
</div>



<script>

function getCookie(name) {
    // Split cookie string and get all individual name=value pairs in an array
    var cookieArr = document.cookie.split(";");
    
    // Loop through the array elements
    for(var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        
        /* Removing whitespace at the beginning of the cookie name
        and compare it with the given string */
        if(name == cookiePair[0].trim()) {
            // Decode the cookie value and return
            return decodeURIComponent(cookiePair[1]);
        }
    }
    
    // Return null if not found
    return null;
}

$(document).ready(function () {

    var cookie_active = getCookie("exit");

    // alert(cookie_active);
    
    if(cookie_active === 'true'){
        $("#popupExit").remove();
    }

    $("#btn-close-exit").click(function () {
        $("#popupExit").fadeOut("fast");
        document.cookie = "exit=true";
    });

});

</script>
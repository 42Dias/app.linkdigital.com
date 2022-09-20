
<style>

.popup-cookies {
    display: none;
    position: fixed;
    bottom: 0px;
    width: 100%;
    background: #333;
    padding: 30px;
    z-index: 999;
    color: #fff;
    font-size: 12px;
}

.popup-cookies a {
    color: #ffce2c;
}

.popup-cookies btn {
}

</style>

<div class="popup-cookies">

    <p style=" display: contents; font-size: 12px;">
        Utilizamos seus dados para analisar e personalizar nossos conteúdos e anúncios durante a sua navegação 
        em nossa plataforma e em serviços de terceiros parceiros. Ao navegar pelo site, você autoriza a Link Contabilidade
        a coletar tais informações e utilizá-las para estas finalidades. 
        Em caso de dúvidas, acesse nossa <a href="/politica-de-privacidade">Política de Privacidade </a>.
    </p>

    <div class="btn btn-yellow size-sm margin-t-0" id="btn-close-cookies" style="display: inline-block; margin-left: 10px; padding: 7px 26px; margin-top: 5px;">
        ENTENDI E ACEITO
    </div>
    
    <div class="text-left">
       
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

    var cookie_active = getCookie("popup");

    // alert(cookie_active);
    
    if(cookie_active === null){
        $(".popup-cookies").fadeIn("slow");
    }

    $("#btn-close-cookies").click(function () {
        $(".popup-cookies").fadeOut("fast");
        document.cookie = "popup=true";
    });

});

</script>
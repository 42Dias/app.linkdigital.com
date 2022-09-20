<script type='text/javascript'>var s=document.createElement('script');s.type='text/javascript';var v=parseInt(Math.random()*1000000);s.src='https://sandbox.gerencianet.com.br/v1/cdn/e392c5005a697acb8bca243c5055fffc/'+v;s.async=false;s.id='e392c5005a697acb8bca243c5055fffc';if(!document.getElementById('e392c5005a697acb8bca243c5055fffc')){document.getElementsByTagName('head')[0].appendChild(s);};$gn={validForm:true,processed:false,done:{},ready:function(fn){$gn.done=fn;}};</script>
<script>
$gn.ready(function(checkout) {
 
 var callback = function(error, response) {
   if(error) {
     // Trata o erro ocorrido
     console.error(error);
   } else {
     // Trata a resposta
     console.log(response);
   }
 };

 checkout.getPaymentToken({
   brand: 'visa', // bandeira do cartão
   number: '4012001038443335', // número do cartão
   cvv: '123', // código de segurança
   expiration_month: '05', // mês de vencimento
   expiration_year: '2021' // ano de vencimento
 }, callback);

});
</script>
<button type="button" id="btn-credit">cartao</button>
<?php

    // $this->layout = null;
    // echo json_encode(compact('result'));

 ?>


<?php

$month_name = [
    "01" => "Janeiro", "02" => "Fevereiro", "03" => "Março",
    "04" => "Abril", "05" => "Maio", "06" => "Junho",
    "07" => "Julho", "08" => "Agosto", "09" => "Setembro",
    "10" => "Outubro", "11" => "Novembro", "12" => "Dezembro"
];

?>

<!-- Menu Page -->
<div class="menu-page">
  <span class="title-page">Seu período grátis expirou!</span>
</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs">
                
                <p>
                    Seu período grátis de 21 dias terminou e sua conta foi desativada temporariamente, 
                    clique no botão abaixo e contrate a Link Contabilidade Consultiva para cuidar da sua empresa.
                </p>

                <a href="/abrir-empresa-gratis" class="btn btn-yellow size-lg margin-t-20">
                    QUERO CONTRATAR
                </a>

            </div>
        </div>
    </div>

</div>

<?php
    echo $this->element('footer_panel');
?>

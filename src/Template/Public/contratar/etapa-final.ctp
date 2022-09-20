
<?php

    if($service_action == "abertura"){ $color_menu = "#fff"; $color_btn = "btn-yellow"; }
    if($service_action == "migracao"){ $color_menu = "#fff"; $color_btn = "btn-yellow"; }

    $color_menu = "#fff"; $color_btn = "btn-yellow";

?>


<div class=""
    style="position: relative; background-color: #efefef; background-image: url(../img/bg-homepage-v6.jpg); min-height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover;">

    <!-- Section 1 -->
    <section style="padding-top: 30px;">

        <div class="container" style="padding-top: 10px; padding-bottom: 40px;">

            <a class="animate-scroll" href="/">
                <img src="/img/logo-link-white.png" style="width: 170px;">
            </a>

            <div class="row" style="margin-top: 20px;">
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12 text-left animate-scroll" style="padding-top: 50px;">

                    <span style="font-size: 40px; color: #fff; font-weight: 600; line-height: 42px;">
                        Seja bem vindo a Link Contabilidade
                    </span>

                    <br><br>

                    <p style="font-size: 14px; color: #999; font-weight: 400; margin-top: 10px;">
                        Um e-mail de confirmação foi enviado para validar o seu cadastro.
                        <br><br>
                        Caso não encontre o e-mail na sua Caixa de Entrada, por favor procurar
                        em sua caixa de SPAM ou Lixeira. Ao validar seu e-mail você já pode criar
                        seu perfil e utilizar os recursos do Link Contabilidade.
                    </p>
                </div>
            </div>

            <div class="row margin-t-30">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">

                    <a href="/" class="btn btn-line-white size-lg margin-r-20 margin-t-20">VOLTAR PARA O SITE</a>
                    <a href="/login" class="btn <?php echo $color_btn; ?> size-lg margin-t-20">ACESSAR MINHA CONTA</a>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                </div>
            </div>

        </div>

    </section>

</div>

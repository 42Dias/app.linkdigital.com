
<?php
    echo $this->element('menu_public');
?>
<!-- Section 1 -->
<section class="hidden-mobile visible-lg"
    style="background-color: #272e31; background-image: url(../img/bg-homepage-v9.jpg); background-repeat: no-repeat; background-size: cover; background-position: right top; height: auto; ">

    <div class="container" style="padding-top: 150px; padding-bottom: 150px;">

        <div class="row" style="margin-top: 0px;">
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12 text-left animate-scroll" style="padding-top: 50px;">

                <span style="font-size: 34px; color: #fff; font-weight: 600;">
                    Parabéns!
                </span>

                <p style="font-size: 16px; color: #fff; font-weight: 400; margin-top: 10px;">
                    <span style="color: #ffce2c;">Sua conta foi criada com sucesso.</span>
                    <br><br>
                    Lembre-se de acessar sua conta de e-mail e validar a sua conta através do e-mail que acabamos de enviar.
                    <br><br>
                    Caso não encontre, favor verificar a caixa de spam ou lixo eletrônico.
                </p>

                <a href="/login" class="btn btn-yellow size-lg margin-t-20 margin-r-10">
                    ACESSAR MINHA CONTA
                </a>

            </div>
        </div>

    </div>

</section>

<?php
    echo $this->element('footer_public');
?>

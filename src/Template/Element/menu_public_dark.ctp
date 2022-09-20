
<!-- Menu mobile -->
<div class="box-menu-mobile">
    <span class="btn-close-mobile icon ion-android-close">
    </span>

    <ul class="text-right box-itens">
        <li>
            <a class="item-menu-mobile" href="/">HOME</a>
        </li>
        <li>
            <a class="item-menu-mobile" href="/login">FAZER LOGIN</a>
        </li>
        <li>
            <a class="item-menu-mobile" href="/cadastro" style="color: #a3d30c;">CADASTRE-SE</a>
        </li>

        <div class="clear"></div>
    </ul>

</div>

<!-- Header -->
<header class="dark">
    <div class="container" style="position: relative; padding: 0px !important;">

        <!-- <div class="row"> -->
            <a class="header-logo hidden-mobile visible-lg animate-scroll" href="/">
                <img src="/img/logo-link-white.png" style="width: 150px;">
            </a>

            <a class="header-logo hidden-mobile visible-md visible-xs animate-scroll" href="/" style="margin-left: 10px;">
                <img src="/img/logo-link-white.png" style="width: 150px;">
            </a>

            <ul class="nav justify-content-end animate-scroll">
                <li class="nav-item nav-hover hidden-mobile visible-md visible-xs" style="padding: 6px 0px;">
                    <div class="nav-link btn btn-default size-sm" id="btn-menu-mobile" style="padding: 0px 15px; background: none; border-radius: 100px; color: #fff; border: none;">
                        <span class="icon ion-navicon" style="font-size: 36px;"></span>
                    </div>
                </li>

                <li class="nav-item nav-hover hidden-mobile visible-lg">
                    <a href="/abrir-empresa-gratis" class="nav-link">Abrir empresa grátis</a>
                </li>

                <li class="nav-item nav-hover hidden-mobile visible-lg">
                    <a href="/ja-tenho-empresa" class="nav-link">Já tenho empresa</a>
                </li>

                <li class="nav-item nav-hover hidden-mobile visible-lg margin-r-10">
                    <a href="/" class="nav-link">Serviços &nbsp;<ion-icon name="ios-arrow-down" style="position: absolute; top: 22px;"></ion-icon></a>

                    <div class="icon-arrow" style="margin-left: 80px;"></div>

                    <div class="menu-itens" style="width: 240px;">
                        <div class="box-menu" style="padding: 20px 30px; ">

                            <div class="content" style="padding: 0; width: 100%;">
                                <a href="/abrir-empresa-gratis" class="box-product"><span>Abertura de empresa</span></a>
                                <a href="/ja-tenho-empresa" class="box-product"><span>Transferência de empresa</span></a>
                                <!-- <a href="/empregado-domestico" class="box-product"><span>Empregado doméstico</span></a> -->
                                <a href="/" class="box-product"><span>MEI</span></a>
                                <a href="/" class="box-product"><span>Certificado digital</span></a>
                                <a href="/" class="box-product"><span>Imposto de renda</span></a>
                            </div>

                            <div class="clear"></div>

                        </div>
                    </div>
                </li>

                <li class="nav-item nav-hover hidden-mobile visible-lg margin-r-10">
                    <a href="/" class="nav-link">Sobre &nbsp;<ion-icon name="ios-arrow-down" style="position: absolute; top: 22px;"></ion-icon></a>

                    <div class="icon-arrow" style="margin-left: 80px;"></div>

                    <div class="menu-itens" style="width: 240px;">
                        <div class="box-menu" style="padding: 20px 30px; ">

                            <div class="content" style="padding: 0; width: 100%;">
                                <a href="/" class="box-product"><span>Quem somos</span></a>
                                <!-- <a href="/faca-parte-da-equipe" class="box-product"><span>Faça parte da equipe</span></a> -->
                                <a href="/" class="box-product"><span>Fale conosco</span></a>
                                <a href="/" class="box-product"><span>Política de privacidade</span></a>
                                <a href="/" class="box-product"><span>Termos de uso</span></a>
                            </div>

                            <div class="clear"></div>

                        </div>
                    </div>
                </li>

                <!-- <li class="nav-item nav-hover hidden-mobile visible-lg margin-r-10">
                    <a href="#faq" class="nav-link">Blog</a>
                </li> -->

                <li class="nav-item hidden-mobile visible-lg">
                    <!-- <a href="/login" class="nav-link btn btn-line-gray size-sm">MINHA CONTA</a> -->

                    <a href="/login" class="btn btn-dark size-sm" style="font-size: 12px; color: #fff;" id="btn_menu_login">

                        <?php if ($user_name){ ?>
                            <?php echo '<ion-icon name="person" style="position: relative; top: 1px;"></ion-icon>&nbsp;&nbsp;'.$user_name; ?>
                        <?php }else{ ?>
                            <?php echo 'Entrar'; ?>
                        <?php } ?>

                    </a>
                </li>

                <!-- <li class="nav-item hidden-mobile visible-lg margin-t-5">
                    <a href="https://www.facebook.com/brandyou360/" target="_blank" style="color: #666; margin-left: 10px;">
                        <ion-icon name="logo-facebook" style="font-size: 24px;"></ion-icon>
                    </a>
                </li>

                <li class="nav-item hidden-mobile visible-lg margin-t-5">
                    <a href="https://www.linkedin.com/company/23744529/admin/" target="_blank" style="color: #666; margin-left: 10px;">
                        <ion-icon name="logo-linkedin" style="font-size: 24px;"></ion-icon>
                    </a>
                </li>

                <li class="nav-item hidden-mobile visible-lg margin-t-5">
                    <a  href="https://www.instagram.com/brandyou360/" target="_blank" style="color: #666; margin-left: 10px;">
                        <ion-icon name="logo-instagram" style="font-size: 24px;"></ion-icon>
                    </a>
                </li> -->

                <div class="clear"></div>
            </ul>
        <!-- </div> -->

    </div>
</header>

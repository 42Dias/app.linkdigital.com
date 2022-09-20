<?php

    echo $this->element('agenda');
    echo $this->element('help_senha');

    if($service_action == "abertura"){ $color_menu = "#fff"; }
    if($service_action == "migracao"){ $color_menu = "#fff"; }

    $user_name = "";
    $user_lastname = "";
    $user_username = "";
    $user_cpf = "";
    $user_birthday = "";
    $user_phone = "";
    $user_whatsapp = "";
    $como_conheceu = "";
    $indication = "";

    foreach ($all_users as $user) {
        $user_name = $user->name;
        $user_lastname = $user->lastname;
        $user_username = $user->username;
        $user_cpf = $user->cpf;
        $user_birthday = $user->birthday;
        $user_phone = $user->phone;
        $user_whatsapp = $user->whatsapp;
        $como_conheceu = $user->como_conheceu;
        $indication = $user->indication;
        $outros = $user->outros;
    }

?>

<!-- Header -->
<!-- <div style="position: fixed; top: 0px; left: 0px; width: 100%; background-color: <?php echo $color_menu; ?>; z-index: 1;">
    <div class="" style="position: relative; padding: 0px 40px;">

        <a class="animate-scroll" href="/" style="position: absolute; left: 40px; top: 8px;">
            <img src="/img/logo-link.png" style="width: 100px;">
        </a>

        <div class="text-right">
            <span style="display: block; color: #fff; padding: 15px 20px; font-size: 18px; font-weight: 700;">&nbsp;</span>
        </div>

    </div>
</div> -->


<div style="padding-right: 280px; background-color: #fff;">

    <div class="hidden-mobile visible-md visible-lg" style="position: relative; background-color: #efefef; background-image: url(../img/bg-homepage-v6.jpg); background-position: center; background-repeat: no-repeat; background-size: cover; padding: 40px; padding-top: 20px;">

        <a class="animate-scroll" href="/">
            <img src="/img/logo-link-white.png" style="width: 130px;">
        </a>

        <br><br><br>

        <div class="clear"></div>

        <div style="position: absolute; bottom: -12px; left: 80px; width: 20px; height: 20px; background-color: #fff; transform: rotate(45deg);"></div>

        <a href="/contratar/etapa-1" class="link-steps">
            <strong style="font-size: 24px; color: #fff;">1</strong> &nbsp;
            <strong style="font-size: 14px; color: #fff;">Sobre você</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-2" class="link-steps">
            <strong style="font-size: 24px; color: #7d7f8a;">2</strong> &nbsp;
            <strong style="font-size: 14px; color: #7d7f8a;">Sobre a empresa</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-3" class="link-steps">
            <strong style="font-size: 24px; color: #7d7f8a;">3</strong> &nbsp;
            <strong style="font-size: 14px; color: #7d7f8a;">Localização</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-4" class="link-steps">
            <strong style="font-size: 24px; color: #7d7f8a;">4</strong> &nbsp;
            <strong style="font-size: 14px; color: #7d7f8a;">Contrato</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-5" class="link-steps">
            <strong style="font-size: 24px; color: #7d7f8a;">5</strong> &nbsp;
            <strong style="font-size: 14px; color: #7d7f8a;">Pagamento</strong> &nbsp;&nbsp;&nbsp;
        </a>
    </div>

    <!-- Section 1 -->
    <section>

        <div class="" style="padding: 100px 40px; padding-top: 30px; padding-bottom: 40px;">

            <div class="row" style="margin-top: 0px;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll" style="padding-top: 50px;">

                    <span style="font-size: 28px; line-height: 30px; color: #666; font-weight: 600;">
                        Conte um pouco sobre você
                    </span>

                    <p style="font-size: 14px; color: #999; font-weight: 400; margin-top: 10px;">
                        Preencha os dados abaixo e inicie a contratação da sua contabilidade digital
                    </p>

                    <p style="font-size: 14px; color: #999; font-weight: 400; margin-top: 50px;">
                        <strong style="color: #666;">Informações em segurança</strong><br>
                        Suas informações estão 100% seguras, todas as nossas informações são transmitidas por uma conexão segura por senha criptografada.
                    </p>

                </div>
            </div>

            <form id="form_step_1" method="POST" style="padding: 0; margin-top: 30px;">

                <div class="row">

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                        <input type="text" class="form-control required" name="name" style="font-size: 14px; background-color: #fff;" id="input-name-step-1"
                            value="<?php echo $user_name; ?>">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Sobrenome</p>
                        <input type="text" class="form-control required" name="lastname" style="font-size: 14px; background-color: #fff;"  id="input-lastname-step-1"
                            value="<?php echo $user_lastname; ?>">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Data de nascimento</p>
                        <input type="text" class="form-control mask-date" name="birthday" style="font-size: 14px; background-color: #fff;" id="input-date-step-1"
                            value="<?php echo $user_birthday; ?>">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CPF</p>
                        <input type="text" class="form-control required mask-cpf" name="cpf" id="input-cpf" style="font-size: 14px; background-color: #fff;"  id="input-cpf-step-1"
                            value="<?php echo $user_cpf; ?>">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">E-mail</p>
                        <input type="text" class="form-control required" name="username" style="font-size: 14px; background-color: #fff;" id="input-email-step-1"
                            value="<?php echo $user_username; ?>">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Telefone</p>
                        <input type="text" class="form-control required mask-phone" name="phone" style="font-size: 14px; background-color: #fff;"  id="input-phone-step-1" value="<?php echo $user_phone; ?>">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Whatsapp / Celular</p>
                        <input type="text" class="form-control" name="whatsapp" style="font-size: 14px; background-color: #fff;" id="mask-phone-whatsapp" value="<?php echo $user_whatsapp; ?>">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">
                            Senha
                            <span class="icon ion-help-circled" data-toggle="modal" data-target="#help_senha" style="margin-left: 8px; font-size: 18px; color: #929292; cursor: pointer;"></span>
                        </p>
                        <input type="password" class="form-control required" name="password" style="font-size: 14px; background-color: #fff;" id="input-password">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Confirmar senha</p>
                        <input type="password" class="form-control required" name="confirm_password" style="font-size: 14px; background-color: #fff;" id="input-confirm-password">
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Como nos conheceu?</p>
                        <!-- <input type="text" class="form-control required" name="como_conheceu" style="font-size: 14px; background-color: #fff;"  value="<?php echo $como_conheceu; ?>"> -->

                        <select class="form-control margin-b-40" name="como_conheceu" style="width: 100%; margin-top: 10px;" id="input-como-conheceu">
                                <option value="" <?php if($como_conheceu == ""){ echo 'selected'; } ?>>Selecione uma opção</option>
                                <option value="Indicação" <?php if($como_conheceu == "Indicação"){ echo 'selected'; } ?>>Indicação</option>
                                <option value="Google" <?php if($como_conheceu == "Google"){ echo 'selected'; } ?>>Google</option>
                                <option value="Youtube" <?php if($como_conheceu == "Youtube"){ echo 'selected'; } ?>>Youtube</option>
                                <option value="Instagram" <?php if($como_conheceu == "Instagram"){ echo 'selected'; } ?>>Instagram</option>
                                <option value="Facebook" <?php if($como_conheceu == "Facebook"){ echo 'selected'; } ?>>Facebook</option>
                                <option value="Linkedin" <?php if($como_conheceu == "Linkedin"){ echo 'selected'; } ?>>Linkedin</option>
                                <option value="Twitter" <?php if($como_conheceu == "Twitter"){ echo 'selected'; } ?>>Twitter</option>
                                <option value="Consultor Link" <?php if($como_conheceu == "Consultor Link"){ echo 'selected'; } ?>>Consultor Link</option>
                                <option value="Palestra" <?php if($como_conheceu == "Palestra"){ echo 'selected'; } ?>>Palestra</option>
                                <option value="Outros" <?php if($como_conheceu == "Outros"){ echo 'selected'; } ?>>Outros</option>

                            </select>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll" id="input-indication" style="<?php if($como_conheceu == "Indicação"){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Quem indicou a Link?</p>
                        <input type="text" class="form-control" name="indication" value="<?php echo $indication; ?>" style="font-size: 14px; background-color: #fff;" id="input-indication-step-1">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll" id="input-outros" style="<?php if($como_conheceu == "Outros"){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Outros (opcional)</p>
                        <input type="text" class="form-control" name="outros" value="<?php echo $outros; ?>" style="font-size: 14px; background-color: #fff;" id="input-outros-step-1">
                    </div>

                </div>

            </form>

            <div class="row">

                <div class="col-6">
                    <button data-toggle="modal" data-target="#agenda" class="btn btn-yellow size- margin-t-50" type="button">Agendar atendimento digital</button>
                    <p class="text margin-t-20" style=" margin-bottom: 10px; font-weight: 600; font-size: 11px;">
                        Caso seja necessário agende seu atendimento digital, clicando no botão acima
                    </p>
                    <!-- <br> -->
                    <!-- <strong style="font-size: 14px; color: #7d7f8a;">Caso seje necessário agende seu atendimento digital</strong>                     -->
                </div>

                <div class="text-right col-6">
                    <button class="btn btn-yellow size-lg margin-t-50 btn_send_form" id="btn-step-1-disabled" disabled>PRÓXIMA ETAPA</button>

                    <button class="btn btn-yellow size-lg margin-t-50 btn_send_form" id="btn-step-1"
                            data-url="/api/web/business/add-step-1" data-form="#form_step_1" data-redirect="/contratar/etapa-2">
                            PRÓXIMA ETAPA
                    </button>
                </div>
            </div>

            <br><br>

            <?php
                echo $this->element('footer_steps');
            ?>

        </div>

    </section>

</div>

<?php
    echo $this->element('sidebar_steps');
?>

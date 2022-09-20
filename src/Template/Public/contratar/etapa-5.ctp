<script type='text/javascript'>var s=document.createElement('script');s.type='text/javascript';var v=parseInt(Math.random()*1000000);s.src='https://sandbox.gerencianet.com.br/v1/cdn/e392c5005a697acb8bca243c5055fffc/'+v;s.async=false;s.id='e392c5005a697acb8bca243c5055fffc';if(!document.getElementById('e392c5005a697acb8bca243c5055fffc')){document.getElementsByTagName('head')[0].appendChild(s);};$gn={validForm:true,processed:false,done:{},ready:function(fn){$gn.done=fn;}};</script>
<script type='text/javascript'>var s=document.createElement('script');s.type='text/javascript';var v=parseInt(Math.random()*1000000);s.src='https://api.gerencianet.com.br/v1/cdn/Client_Id_d751f7214dcccea322d43684a97888dec278b82c/'+v;s.async=false;s.id='Client_Id_d751f7214dcccea322d43684a97888dec278b82c';if(!document.getElementById('Client_Id_d751f7214dcccea322d43684a97888dec278b82c')){document.getElementsByTagName('head')[0].appendChild(s);};$gn={validForm:true,processed:false,done:{},ready:function(fn){$gn.done=fn;}};</script>

<?php
    
    echo $this->element('agenda');

    if($service_action == "abertura"){ $color_menu = "#fff"; }
    if($service_action == "migracao"){ $color_menu = "#fff"; }

    $payment_id = 0;
    $payment_type = '';
    $payment_credit_number = '-';
    $payment_credit_name = '-';
    $payment_credit_maturity = '-';
    $payment_credit_security = '-';
    $payment_billet_codebar	 = '-';
    $payment_billet_link = '-';
    $payment_billet_maturity = '-';

    foreach ($all_payments as $payment) {
        $payment_id = $payment->id;
        $payment_type = $payment->type;
        $payment_credit_number = $payment->credit_number;
        $payment_credit_name = $payment->credit_name;
        $payment_credit_maturity = $payment->credit_maturity;
        $payment_credit_security = $payment->credit_security;
        $payment_billet_codebar	 = $payment->billet_codebar;
        $payment_billet_link = $payment->billet_link;
        $payment_billet_maturity = $payment->billet_maturity;
        $payment_pix_qrcode = $payment->pix_qrcode;
    }

?>

<div style="padding-right: 280px; background-color: #fff;">

    <div class="hidden-mobile visible-md visible-lg" style="position: relative; background-color: #efefef; background-image: url(../img/bg-homepage-v6.jpg); background-position: center; background-repeat: no-repeat; background-size: cover; padding: 40px; padding-top: 20px;">

        <a class="animate-scroll" href="/">
            <img src="/img/logo-link-white.png" style="width: 130px;">
        </a>

        <br><br><br>
        
        <div style="position: absolute; bottom: -12px; left: 615px; width: 20px; height: 20px; background-color: #fff; transform: rotate(45deg);"></div>

        <a href="/contratar/etapa-1" class="link-steps">
            <strong style="font-size: 24px; color: #ffce2c;">1</strong> &nbsp;
            <strong style="font-size: 14px; color: #ffce2c;">Sobre você</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-2" class="link-steps">
            <strong style="font-size: 24px; color: #ffce2c;">2</strong> &nbsp;
            <strong style="font-size: 14px; color: #ffce2c;">Sobre a empresa</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-3" class="link-steps">
            <strong style="font-size: 24px; color: #ffce2c;">3</strong> &nbsp;
            <strong style="font-size: 14px; color: #ffce2c;">Localização</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-4" class="link-steps">
            <strong style="font-size: 24px; color: #ffce2c;">4</strong> &nbsp;
            <strong style="font-size: 14px; color: #ffce2c;">Contrato</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-5" class="link-steps">
            <strong style="font-size: 24px; color: #fff;">5</strong> &nbsp;
            <strong style="font-size: 14px; color: #fff;">Pagamento</strong> &nbsp;&nbsp;&nbsp;
        </a>

    </div>

    <!-- Section 1 -->
    <section>

        <div class="" style="padding: 100px 40px; padding-top: 30px; padding-bottom: 40px;">

            <div class="row" style="margin-top: 0px;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll" style="padding-top: 50px;">

                    <span style="font-size: 28px; line-height: 30px; color: #666; font-weight: 600;">
                        Pagamento
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

            <div class="row margin-t-40">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">

                    <div class="box-selected" style="min-height: 200px;">

                        <?php if($payment_type == "billet"){ ?>

                            <i class="icon material-icons-outlined"
                                style="top: 30px; right: 50px; font-size: 50px; color: #35e052; position: absolute;">check_circle_outline</i>

                        <?php } ?>

                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Pagar com
                        </strong>
                        <br>

                        <span style="font-size: 20px; color: #666; font-weight: 600;">
                            Boleto bancário
                        </span>
                        <br>

                        <?php if($payment_type == "billet"){ ?>

                            <div class="box-billet">

                                <div style="position: absolute; left: 25px; top: 35px;">
                                    <img src="/img/cards/billet.png" width="70%">
                                </div>

                                <div style="position: absolute; left: 100px; top: 35px;">
                                    <span class="number"><?php if($payment_billet_codebar == ""){ echo '5465187165989768415687154651871659897684156871'; }else{ echo $payment_billet_codebar; } ?></span>
                                </div>

                                <div style="position: absolute; left: 30px; bottom: 35px;">
                                    <span class="title">VENCIMENTO</span>

                                    <?php 
                                        $maturity_date = "";
                                        $maturity_date = DateTime::createFromFormat('Y-m-d', $payment_billet_maturity);
                                        $maturity_date = $maturity_date->format('d/m/Y');
                                    ?>

                                    <span class="text"><?php if($payment_billet_maturity == ""){ echo '00/00/0000'; }else{ echo $maturity_date; } ?></span>
                                </div>

                                <div style="position: absolute; left: 240px; bottom: 35px;">
                                    <a href="<?php echo $payment_billet_link; ?>" target="_blank" class="btn btn-line-gray size-sm margin-t-30">
                                        FAZER DOWNLOAD
                                    </a>
                                </div>
                            </div>

                            <br><br>

                        <?php }else{ ?>

                            <div class="btn btn-line-gray size-sm margin-t-30 btn_send_form" data-url="/api/web/payments/add-billet" data-form="#form_add_billet" data-redirect="/contratar/etapa-5">
                                SELECIONAR
                            </div>

                        <?php } ?>

                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">

                    <div class="box-selected" style="min-height: 200px;">

                        <?php if($payment_type == "credit"){ ?>

                            <i class="icon material-icons-outlined payment-credit-validate"
                                style="top: 30px; right: 50px; font-size: 50px; color: #35e052; position: absolute;">check_circle_outline</i>

                        <?php } ?>

                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Pagar com
                        </strong>
                        <br>

                        <span style="font-size: 20px; color: #666; font-weight: 600;">
                            Cartão de crédito
                        </span>
                        <br>

                        <?php //if($payment_type == "credit"){ ?>

                        <div class="box-credit-card payment-credit">

                            <div style="position: absolute; left: 25px; bottom: 140px;">
                                <img src="/img/cards/mastercard.png" width="70%">
                            </div>

                            <div style="position: absolute; right: 30px; bottom: 140px; border: 1px solid #5d5d65; background-color: #2e2e35; padding: 6px 12px; border-radius: 6px;">
                                <span class="text" id="text-credit-security" style="color: #fff;">

                                    <i class="icon material-icons-outlined" style="font-size: 14px; color: #afafaf;">lock</i>

                                    <?php if($payment_credit_security == ""){ echo ''; }else{ echo '&nbsp; '.$payment_credit_security; } ?>
                                </span>
                            </div>

                            <div style="position: absolute; left: 30px; bottom: 90px;">
                                <span class="number" id="text-credit-number"><?php if($payment_credit_number == ""){ echo '0000 0000 0000 0000'; }else{ echo $payment_credit_number; } ?></span>
                            </div>

                            <div style="position: absolute; left: 30px; bottom: 30px;">
                                <span class="title">NOME</span>
                                <span class="text" id="text-credit-name" style="text-transform: uppercase;"><?php if($payment_credit_name == ""){ echo '&nbsp;'; }else{ echo $payment_credit_name; } ?></span>
                            </div>

                            <div style="position: absolute; left: 240px; bottom: 30px;">
                                <span class="title">VENCIMENTO</span>
                                <span class="text" id="text-credit-maturity"><?php if($payment_credit_maturity == ""){ echo '&nbsp;'; }else{ echo $payment_credit_maturity; } ?></span>
                            </div>
                        </div>

                        <form class="payment-credit" id="form_add_credit" method="POST" style="padding: 0;">

                            <input type="hidden" class="form-control required credit_card_name" data-iugu="full_name" name="bandeira" style="font-size: 14px; background-color: #fff;" id="input-credit-band" value="mastercard">

                            <div class="row margin-t-40">

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Número do cartão</p>

                                    <input type="text" class="form-control required mask-creditcard credit_card_number" name="number" data-iugu="number" style="font-size: 14px; background-color: #fff;" id="input-credit-number">
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome do titular</p>

                                    <input type="text" class="form-control required credit_card_name" name="name" data-iugu="name" style="font-size: 14px; background-color: #fff;" id="input-credit-name">
                                </div>

                                <!-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Bandeira</p>

                                    <input type="text" class="form-control required credit_card_name" data-iugu="full_name" name="bandeira" style="font-size: 14px; background-color: #fff;" id="input-credit-band">
                                </div> -->

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Vencimento</p>
                                    <input type="text" class="form-control required mask-dd-yy credit_card_expiration" name="maturity" data-iugu="expiration" style="font-size: 14px; background-color: #fff;" id="input-credit-maturity">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Código</p>

                                    <input type="text" class="form-control required credit_card_cvv" name="security" data-iugu="verification_value" maxlength="4" style="font-size: 14px; background-color: #fff;" id="input-credit-security">
                                </div>
                            </div>

                            <input type="hidden" name="paymentId" id="input-payment-id" value="" style="text-align:center" />

                        </form>

                            <!-- <br><br> -->

                        <?php //}else{ ?>
                            
                        <div class="row">
                            <div class="col-6">
                                <div class="btn btn-line-gray size-sm margin-t-30" id="payment-credit">SELECIONAR</div>
                            </div>

                            <div class="col-6">
                                <div class="btn btn-green payment-credit size-sm margin-t-30" id="payment-credit-checkout">VALIDAR CARTÃO</div>
                            </div>
                        </div>
                            <!-- <div class="btn btn-line-gray size-sm margin-t-30 btn_send_form"
                                data-url="/api/web/payments/add-credit" data-form="#form_add_credit" data-redirect="/contratar/etapa-5">
                                SELECIONAR
                            </div> -->

                        <?php //} ?>

                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">

                    <div class="box-selected" style="min-height: 200px;">

                        <?php if($payment_type == "transfer"){ ?>

                        <i class="icon material-icons-outlined payment-transfer-validate"
                            style="top: 30px; right: 50px; font-size: 50px; color: #35e052; position: absolute;">check_circle_outline</i>

                        <?php } ?>

                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Realizar
                        </strong>
                        <br>

                        <span style="font-size: 20px; color: #666; font-weight: 600;">
                            Transferencia Bancária
                        </span>
                        <br>

                        <?php //if($payment_type == "transfer"){ ?>

                            <form class="payment-transfer" id="form_transfer" method="POST" style="padding: 0;">

                                <div class="row margin-t-40">

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">
                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Banco</p>
                                        <p class="form-control"style="font-size: 14px; background-color: #fff;">Caixa Econômica Federal</p>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">
                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Agencia</p>
                                        <p class="form-control" style="font-size: 14px; background-color: #fff;">2143</p>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Operação</p>
                                        <p class="form-control" style="font-size: 14px; background-color: #fff;">001</p>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Conta corrente</p>
                                        <p class="form-control" style="font-size: 14px; background-color: #fff;">832-1</p>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                                        <p class="form-control" style="font-size: 14px; background-color: #fff;">Fabrícia Cabral Paparele</p>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CPF</p>
                                        <p class="form-control" style="font-size: 14px; background-color: #fff;">159.440.908-04</p>
                                    </div>
                                </div>

                            </form>

                        <?php //}else{ ?>
                                                   
                            <div class="btn btn-line-gray size-sm margin-t-30" id="payment-transfer">SELECIONAR</div>
                        
                        <?php //} ?> 

                    </div>
                </div>

                <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">

                    <div class="box-selected" style="min-height: 200px;">

                        <i class="icon material-icons-outlined payment-transfer-validate" style="top: 30px; right: 50px; font-size: 50px; color: #35e052; position: absolute;">check_circle_outline</i>

                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Pagar com
                        </strong>
                        <br>

                        <span style="font-size: 20px; color: #666; font-weight: 600;">
                            Transferencia PIX
                        </span>
                        <br>

                        <?php //if($payment_type == "pix"){ ?>

                            <div class="box-billet">

                                <div style="position: absolute; left: 25px; top: 35px;">
                                    <img src="<?php //echo $payment_pix_qrcode; ?>" width="300">
                                </div>

                            </div>

                            <br><br>

                        <?php //}else{ ?>

                            <div class="btn btn-line-gray size-sm margin-t-30 btn_send_form" data-url="/api/web/payments/add-pix" data-form="#form_add_pix" data-redirect="/contratar/etapa-5">
                                SELECIONAR
                            </div>

                        <?php //} ?>                        

                    </div>
                </div> -->
            </div>

            <div class="row">


                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                    <div class="col-6">
                        <button data-toggle="modal" data-target="#agenda"class="btn btn-yellow size- margin-t-10" type="button">Agendar atendimento digital</button>
                        <p class="text margin-t-20" style=" margin-bottom: 10px; font-weight: 600; font-size: 11px;">
                        Caso seja necessário agende seu atendimento digital, clicando no botão acima
                        </p>
                    </div>
                    <!-- <a href="/contratar/etapa-4" class="btn btn-line-gray size-lg margin-t-50">VOLTAR</a> -->
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    <?php if($payment_type == "billet"){ ?>

                        <div class="btn btn-yellow size-lg margin-t-30 btn_send_form"
                            data-url="/api/web/business/add-step-5" data-form="#form_" data-redirect="/contratar/etapa-final">
                            FINALIZAR COMPRA
                        </div>

                    <?php } ?>

                    <div class="btn btn-yellow size-lg margin-t-30 payment-credit-validate" id="payment-credit-validate">
                        FINALIZAR COMPRA
                    </div>

                    <div class="btn btn-yellow size-lg margin-t-30"  id="payment-transfer-checkout">
                        FINALIZAR COMPRA
                    </div>

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

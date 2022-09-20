
<div style="position: fixed;  background-image: url(../img/flag-payment-pendent.png); top: -5px; right: -4px; height: 160px; width: 160px; z-index: 999; background-size: cover; background-position: center;"></div>

<div class="container">

    <!-- Menu Page -->
    <div class="menu-page">
        <span class="title-page">Pagamentos pendentes</span>
        <br>
        <span style="color: #999; font-size: 14px;">
            O acesso será liberado assim que for compensado o pagamento da adesão.
            <br>
            Caso queira efetuar o pagamento agora, clique no botõ abaixo.
        </span>
    </div>
    
    <div class="area-actions" style="padding-top: 0px;">

        <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Fatura</p>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Descrição</p>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Valor</p>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Vencimento</p>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;"></p>
            </div>
        </div>

        <?php $x=0; foreach ($all_payments as $payment) { $x++; ?>

            <?php
                if($payment->maturity < $date_now){
                    $status_active = "atrasado";
                    $status_icon = "error_outline";
                }else{
                    $status_active = "";
                    $status_icon = "outlined_flag";
                }

                if($payment->status == 2){
                    $status_active = "pago";
                    $status_icon = "check_circle_outline";
                }
            ?>

            <a href="<?= $payment->billet_link; ?>" target="_blank" class="box-file client row" data-id="<?= $payment->id; ?>" style="padding-left: 30px; text-decoration: none;">
                
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <span class="date"><?php echo 'Fatura #'.$payment->id; ?></span>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <span class="date"><?php echo 'Adesão - Link Contabilidade'; ?></span>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                    <span class="title">R$ <?php echo number_format($payment->amount, 2, ',', '.'); ?></span>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                    <span class="title"><?php echo $payment->billet_maturity; ?></span>
                </div>

                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                    <div class="btn btn-line-gray size-sm">DOWNLOAD</div>
                </div>

            </a>

        <?php } ?>

        <div class="clear"></div>

    </div>
</div>


<?php
    echo $this->element('footer_panel');
?>


<div class="modal fade" id="open_taxe_accountant" tabindex="-1" role="dialog" aria-labelledby="open_taxe_accountantLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Imposto a pagar</h4>
            </div>
            <div class="modal-body">

                <?php $x=0; foreach ($all_taxes as $taxes) { $x++; ?>

                    <?php
                        if($taxes->maturity < $date_now && $taxes->status == 1){
                            $status_active = "Atrasado";
                            $status_icon = "error_outline";
                            $status_color = "#f55454";
                        }else{
                            $status_active = "Pendente";
                            $status_icon = "outlined_flag";
                            $status_color = "#b5b5b5";
                        }

                        if($taxes->status == 2){
                            $status_active = "Pago";
                            $status_icon = "check_circle_outline";
                            $status_color = "#6df554";
                        }
                    ?>

                    <div class="text-left item-taxe" id="item-taxe-<?= $taxes->id; ?>" style="display: none;">

                        <div style="color: <?= $status_color; ?>; font-size: 18px;">
                            <i class="material-icons-outlined"><?= $status_icon; ?></i>
                            <span style="display: inline-block; vertical-align: top; line-height: 25px;"><?= $status_active; ?></span>
                        </div>

                        <h3 style="font-weight: 500; color: #333; margin-top: 10px;"><?= $taxes->title; ?></h3>
                        <p style="font-weight: 500; color: #666; margin-top: 10px;"><?= $taxes->description; ?></p>
                        <br>

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Vencimento:</span>
                                <br>
                                <strong style="color: #333; font-size: 14px;"><?= date_format($taxes->maturity, 'd/m/Y'); ?></strong>
                                <br>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Documento:</span>
                                <br>
                                <a href="/uploads/taxes/<?= $taxes->url; ?>" target="_blank" style="color: #333; font-size: 14px; font-weight: 600;">Fazer download</a>
                                <br>
                            </div>
                        </div>

                        <div class="row margin-t-10">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Valor:</span>
                                <br>
                                <strong style="color: #333; font-size: 14px;">R$ <?= number_format($taxes->total, 2, ',', '.'); ?></strong>
                                <br>
                            </div>
                        </div>

                        <div class="text-center">
                            <?php if(isset($permission)){ ?>
                                <div class="btn btn-line-gray size-lg margin-t-50 btn_send_form" data-url="/api/web/admin/taxes/<?= $taxes->id; ?>/delete" data-form="#form" data-redirect="none">EXCLUIR IMPOSTO</div>
                            <?php }else{ ?>
                                <div class="btn btn-line-gray size-lg margin-t-50 btn_send_form" data-url="/api/web/accountant/taxes/<?= $taxes->id; ?>/delete" data-form="#form" data-redirect="none">EXCLUIR IMPOSTO</div>
                            <?php } ?>  
                        </div>

                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
</div>

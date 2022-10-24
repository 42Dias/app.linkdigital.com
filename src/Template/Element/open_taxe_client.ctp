
<div class="modal fade" id="open_taxe_client" tabindex="-1" role="dialog" aria-labelledby="open_taxe_clientLabel" aria-hidden="true">
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
                        if($taxes->maturity < $date_now){
                            $status_active = "Atrasado";
                            $status_icon = "error_outline";
                            $status_color = "#f55454";
                        }else{
                            $status_active = "";
                            $status_active = "Pendente";
                            $status_icon = "outlined_flag";
                            $status_color = "#b5b5b5";
                        }

                        if($taxes->status == 2){
                            $status_active = "Pago";
                            $status_icon = "check_circle_outline";
                            $status_color = "#5cce6f";
                        }
                    ?>

                    <div class="text-left item-taxes" id="item-taxes-<?= $taxes->id; ?>" style="display: none;">

                        <div style="color: <?= $status_color; ?>; font-size: 18px;">
                            <i class="material-icons-outlined"><?= $status_icon; ?></i>
                            <span style="display: inline-block; vertical-align: top; line-height: 25px;"><?= $status_active; ?></span>
                        </div>

                        <h3 style="font-weight: 500; color: #666; margin-top: 10px;"><?= strval($taxes->title); ?></h3>
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

                            <?php if($taxes->status == 1){ ?>
                                <div class="btn btn-green size-lg margin-t-50 btn-update-status-taxe" data-id="<?= $taxes->id; ?>" data-status="2">PAGUEI O IMPOSTO</div>
                            <?php } ?>

                            <?php if($taxes->status == 2){ ?>
                                <div class="btn btn-magenta-panel size-lg margin-t-50 btn-update-status-taxe" data-id="<?= $taxes->id; ?>" data-status="1">NÃO PAGUEI O IMPOSTO</div>
                            <?php } ?>
                        </div>

                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
</div>

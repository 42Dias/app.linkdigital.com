
<div class="modal fade" id="open_extract_accountant" tabindex="-1" role="dialog" aria-labelledby="open_extract_accountantLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Extrato bancário</h4>
            </div>
            <div class="modal-body">

                <?php $x=0; foreach ($all_extracts as $extracts) { $x++; ?>

                    <div class="text-left item-extracts" id="item-extracts-<?= $extracts->id; ?>" style="display: none;">

                        <h3 style="font-weight: 500; color: #666; margin-top: 10px;">Extrato bancário</h3>
                        <br>

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Data inicial:</span>
                                <br>
                                <strong style="color: #333; font-size: 14px;"><?= date_format($extracts->date_inicial, 'd/m/Y'); ?></strong>
                                <br>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Data final:</span>
                                <br>
                                <strong style="color: #333; font-size: 14px;"><?= date_format($extracts->date_final, 'd/m/Y'); ?></strong>
                                <br>
                            </div>
                        </div>

                        <div class="row margin-t-10">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Banco:</span>
                                <br>
                                <strong style="color: #333; font-size: 14px;"><?= $extracts->bank; ?></strong>
                                <br>
                            </div>

                            
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Documento:</span>
                                <br>
                                <a href="/uploads/extracts/<?= $extracts->url; ?>" target="_blank" style="color: #333; font-size: 14px; font-weight: 600;">Fazer download</a>
                                <br>
                            </div>

                        </div>

                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
</div>

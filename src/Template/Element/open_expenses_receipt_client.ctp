
<div class="modal fade" id="open_expenses_receipt_client" tabindex="-1" role="dialog" aria-labelledby="open_document_clientLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Documento</h4>
            </div>
            <div class="modal-body">

                <?php $x=0; foreach ($all_documents as $documents) { $x++; ?>

                    <div class="text-left item-documents" id="item-documents-<?= $documents->id; ?>" style="display: none;">

                        <h3 style="font-weight: 500; color: #666; margin-top: 10px;"><?= $documents->name; ?></h3>
                        <p style="font-weight: 500; color: #666; margin-top: 10px;">R$<?= $documents->value; ?></p>
                        <br>

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Data:</span>
                                <br>
                                <strong style="color: #333; font-size: 14px;"><?= date_format($documents->date, 'd/m/Y'); ?></strong>
                                <br>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Tipo de documento:</span>
                                <br>
                                <p style="color: #333; font-size: 14px; font-weight: 600; text-transform:capitalize;"><?= $documents->type; ?></p>
                                <br>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="btn btn-line-gray size-lg margin-t-50 btn_send_form"
                            data-url="/api/web/client/expenses-receipt/<?= $documents->id; ?>/delete" data-form="#form" data-redirect="none">EXCLUIR DOCUMENTO</div>
                           
                        </div>

                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="open_note_accountant" tabindex="-1" role="dialog" aria-labelledby="open_note_accountantLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Nota fiscal</h4>
            </div>
            <div class="modal-body">

                <?php $x=0; foreach ($all_notes as $notes) { $x++; ?>

                    <div class="text-left item-notes" id="item-notes-<?= $notes->id; ?>" style="display: none;">

                        <h3 style="font-weight: 500; color: #666; margin-top: 10px;"><?= $notes->title; ?></h3>
                        <p style="font-weight: 500; color: #666; margin-top: 10px;"><?= $notes->description; ?></p>
                        <br>

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Data:</span>
                                <br>
                                <strong style="color: #333; font-size: 14px;"><?= $notes->date; ?></strong>
                                <br>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Documento:</span>
                                <br>
                                <a href="/uploads/notes/<?= $notes->url; ?>" target="_blank" style="color: #333; font-size: 14px; font-weight: 600;">Fazer download</a>
                                <br>
                            </div>
                        </div>

                        <div class="row margin-t-10">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Valor:</span>
                                <br>
                                <strong style="color: #333; font-size: 14px;">R$ <?= number_format($notes->total, 2, ',', '.'); ?></strong>
                                <br>
                            </div>
                        </div>

                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
</div>

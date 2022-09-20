
<div class="modal fade" id="addHistory" tabindex="-1" role="dialog" aria-labelledby="addHistoryLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Nova atividade de Abertura ou Migração</h4>
            </div>
            <div class="modal-body">

                <?php
                    $date = date_format($date_now, 'd/m/Y');
                    $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);
                ?>

                <form method="POST" id="form_add_history_accountant" enctype="multipart/form-data">

                    <input type='hidden' name="business_id" value="<?= $business_id; ?>" id="business_id">

                    <div class="form-group margin-b-20">
                        <label>Título</label>
                        <input type="text" class="form-control" name="title" value=""  autocomplete="off">
                    </div>

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Data</p>

                    <div class="input-date">
                        <div class="icon ion-android-calendar arrow"></div>

                        <input type="text" class="form-control accountant add-date" name="date"
                        value="<?= $date; ?>" placeholder="" style="cursor: pointer;" id="history-date">

                        <!-- Datepicker -->
                        <div class="box-datepicker accountant">
                            <div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#history-date"></div>
                        </div>

                    </div>

                    
                    <div class="text-center">
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                data-url="/api/web/accountant/history/add" data-form="#form_add_history_accountant" data-redirect="none">
                                ADICIONAR
                        </div>
                    </div>

                </form>

                <div class="clear"></div>

            </div>
        </div>
    </div>
</div>

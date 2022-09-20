<div class="modal fade" id="add_expenses_receipt_client" tabindex="-1" role="dialog" aria-labelledby="add_document_clientLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar despesa e/ou receita</h4>
            </div>
            <div class="modal-body">

                <?php

                $date = date_format($date_now, 'd/m/Y');
                $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

                ?>

                <form id="form_add_client">

                    <div  id="area-add-documents">
                        <p class="text margin-t-40 add-item-value" style=" margin-bottom: 10px; color: #969696; font-weight: 600; value="1">Item 1</p>
                        
                        <br>

                        <p class="text" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                        <input type="text" class="form-control required" name="name-1" style="font-size: 14px; background-color: #fff;">

                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Valor</p>
                        <input type="number" min="0" class="form-control required" name="value-1" style="font-size: 14px; background-color: #fff;">

                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo</p>
                        <select class="form-control required" name="type-1" style="font-size: 14px; background-color: #fff;">
                            <option></option>
                            <option value="receita">Receita</option>
                            <option value="despesa">Despesa</option>
                        </select>

                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Data</p>

                        <div class="input-date">
                            <div class="icon ion-android-calendar arrow"></div>

                            <input type="text" class="form-control add-date required" name="date-1"
                            value="<?= $date; ?>" placeholder="" style="cursor: pointer;" id="document-date">

                            <!-- Datepicker -->
                            <div class="box-datepicker client">
                                <div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#document-date"></div>
                            </div>

                        </div> 
                    
                    </div>

                    <br />

                    <label class="fileContainer ">
                        <input type="hidden" name="total_itens" value="1" id="total-itens" />
                        <button type="button" class="btn btn-default" id="btn-add-expenses-receipt">Adicionar mais itens +</button>
                    </label>

                    <div class="text-center">
                        <div class="btn btn-blue-panel size-lg margin-t-50 btn_send_form_expenses_receipt"
                                data-url="/api/web/client/expenses-receipt/add" data-form="#form_add_client" data-redirect="none">
                                ADICIONAR
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

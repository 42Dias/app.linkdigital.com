
<div class="modal fade" id="add_note" tabindex="-1" role="dialog" aria-labelledby="add_noteLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar anotação</h4>
            </div>
            <div class="modal-body">

                <?php
                    if(isset($customer_selected_id)){ $item_selected_id = $customer_selected_id; }
                    if(isset($provider_selected_id)){ $item_selected_id = $provider_selected_id; }
                    if(isset($employee_selected_id)){ $item_selected_id = $employee_selected_id; }
                    if(isset($partner_selected_id)){ $item_selected_id = $partner_selected_id; }
                ?>

                <form id="form_add_note">

                    <input type='hidden' name="note_business_id" value="<?= $business_id; ?>" id="note_business_id">
                    <input type='hidden' name="note_item_id" value="<?= $item_selected_id; ?>" id="note_item_id">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Anotação</p>
                    <textarea rows="8" class="form-control accountant required" name="note_text" style="font-size: 14px; background-color: #fff; height: auto !important;"></textarea>

                    <div class="text-center">
                    
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                             data-url="/api/web/custom/notes/add" data-form="#form_add_note" data-redirect="none">
                                ADICIONAR
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

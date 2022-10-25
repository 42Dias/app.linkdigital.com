
<div class="modal fade" id="add_file" tabindex="-1" role="dialog" aria-labelledby="add_fileLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar arquivo</h4>
            </div>
            <div class="modal-body">

                <?php
                    if(isset($customer_selected_id)){ $item_selected_id = $customer_selected_id; }
                    if(isset($provider_selected_id)){ $item_selected_id = $provider_selected_id; }
                    if(isset($employee_selected_id)){ $item_selected_id = $employee_selected_id; }
                    if(isset($partner_selected_id)){ $item_selected_id = $partner_selected_id; }
                ?>

                <form id="form_add_file">

                    <input type='hidden' name="file_business_id" value="<?= $business_id or " "; ?>" id="file_business_id">
                    <input type='hidden' name="file_item_id" value="<?= $item_selected_id or " "; ?>" id="file_item_id">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">
                        Faça upload de um arquivo
                    </p>

                    <label class="fileContainer ">
                        <div for="file_document_action" class="btn btn-line-gray size-sm margin-t-0">FAZER UPLOAD</div>
                        <input type="file" style="display: none;" class="form-control-file" id="file_upload" name="file_upload" onchange="readURL(this);">
                    </label>

                    <label id="file_upload_text"style="font-weight: 600; color: #8541ff; font-size: 10px;"></label>

                    <div class="text-center">
                    
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                             data-url="/api/web/custom/files/add" data-form="#form_add_file" data-redirect="none">
                                ADICIONAR
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function readURL(input) {

        var type = input.name;
        var type = type.replace(/\D/gim, '');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var fullPath = document.getElementById('file_upload').value;
                if (fullPath) {
                    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                    var filename = fullPath.substring(startIndex);
                    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                        filename = filename.substring(1);
                    }
                }

                $('#file_upload_text').html(filename);

            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

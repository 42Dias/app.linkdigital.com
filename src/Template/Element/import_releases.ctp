
<div class="modal fade" id="import_conciliations" tabindex="-1" role="dialog" aria-labelledby="import_releasesLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Importar lançamentos</h4>
            </div>
            <div class="modal-body">

                <form id="form_import_conciliations">

                    <input type='hidden' name="business_id" value="<?= $business_id; ?>" id="input_import_business_id">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Conta bancária</p>
                    
                    <select type="text" class="form-control required" name="receipt_account" id="input_import_account_id" style="font-size: 14px; background-color: #fff;">
                        <?php $x=0; foreach ($query_accounts as $account) { $x++; ?>
                            <option value="<?php echo $account->id; ?>"><?php echo $account->bank; ?></option>
                        <?php } ?>
                    </select>

                    <p class="text margin-t-40" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">
                        Selecione o arquivo para iniciar a importação de lançamentos
                    </p>

                    <label class="fileContainer ">
                        <div for="file_import" class="btn btn-line-gray size-sm margin-t-0">CARREGAR ARQUIVO</div>
                        <input type="file" style="display: none;" class="form-control-file"
                            id="file_import" name="file_import" onchange="readURL(this, 'import');">
                    </label>

                    <label id="text-import"style="font-weight: 600; color: #333;"></label>

                    <div class="text-center">
                    
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                             data-url="/api/web/custom/conciliations/import" data-form="#form_import_conciliations" data-redirect="none">
                                IMPORTAR
                        </div>
                    </div>

                </form>

                <script>
                    function readURL(input, type) {

                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                var fullPath = document.getElementById('file_'+type).value;
                                if (fullPath) {
                                    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                                    var filename = fullPath.substring(startIndex);
                                    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                                        filename = filename.substring(1);
                                    }
                                }

                                $('#text-'+type).html(filename);
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>

            </div>
        </div>
    </div>
</div>

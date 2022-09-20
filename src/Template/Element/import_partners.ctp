
<div class="modal fade" id="import_partners" tabindex="-1" role="dialog" aria-labelledby="import_partnersLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Importar sócios</h4>
            </div>
            <div class="modal-body">

                <form id="form_import_partners">

                    <input type='hidden' name="file_business_id_partners" value="<?= $business_id; ?>" id="file_business_id_partners">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">
                        Para importar a sua lista de sócios, siga o arquivo modelo que preparamos para você, 
                        clique no link e faça o <a target="_blank" href="../../webroot/uploads/import/Modelo-Importacao-Socios.csv">download do modelo</a>
                    </p>

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">
                        Faça upload de um arquivo .CSV com a sua lista de clientes
                    </p>

                    <label class="fileContainer ">
                        <div for="file_upload_import_partners" class="btn btn-line-gray size-sm margin-t-0">FAZER UPLOAD</div>
                        <input type="file" style="display: none;" class="form-control-file" id="file_upload_import_partners" name="file_upload_import_partners" onchange="readURL(this);">
                    </label>

                    <label id="file_upload_text_import_partners"style="font-weight: 600; color: #000; font-size: 10px;"></label>

                    <div class="text-center">
                    
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                             data-url="/api/web/client/partners/import" data-form="#form_import_partners" data-redirect="none">
                                IMPORTAR SÓCIOS
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
                var fullPath = document.getElementById('file_upload_import_partners').value;
                if (fullPath) {
                    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                    var filename = fullPath.substring(startIndex);
                    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                        filename = filename.substring(1);
                    }
                }

                $('#file_upload_text_import_partners').html(filename);

            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

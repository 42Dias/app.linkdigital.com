
<div class="modal fade" id="add_document_accountant" tabindex="-1" role="dialog" aria-labelledby="add_document_accountantLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar documento</h4>
            </div>
            <div class="modal-body">

                <?php

                $date = date_format($date_now, 'd/m/Y');
                $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

                ?>

                <form id="form_add_document_accountant">

                    <div  id="area-add-documents">
                        <p class="text margin-t-40 add-item-value" style=" margin-bottom: 10px; color: #969696; font-weight: 600; value="1">Documento 1</p>
                        
                        <br>

                        <input type='hidden' name="business_id-1" value="<?= $business_id; ?>" id="business_id">

                        <p class="text" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Área</p>
                        <select type="text" class="form-control required" name="title-1" style="font-size: 14px; background-color: #fff;">
                            <option value="Fiscal">Fiscal</option>
                            <option value="RH">RH</option>
                            <option value="Contábil">Contábil</option>
                            <option value="Legalização">Legalização</option>
                            <option value="Administrativo">Administrativo</option>
                            <option value="Financeiro">Financeiro</option>
                            <option value="Atendimento">Atendimento</option>
                            <option value="Cadastro">Cadastro</option>
                            <option value="Treinamento">Treinamento</option>
                            <option value="Outros">Outros</option>
                        </select>

                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Descrição</p>
                        <input type="text" class="form-control accountant required" name="description-1" style="font-size: 14px; background-color: #fff;">

                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de Documento</p>
                        <input type="text" class="form-control accountant required" name="type-doc-1" style="font-size: 14px; background-color: #fff;">

                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Data</p>

                        <div class="input-date">
                            <div class="icon ion-android-calendar arrow"></div>

                            <input type="text" class="form-control accountant add-date" name="date-1"
                            value="<?= $date; ?>" placeholder="" style="cursor: pointer;" id="document-date">

                            <!-- Datepicker -->
                            <div class="box-datepicker accountant">
                                <div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#document-date"></div>
                            </div>

                        </div>

                        <p class="text margin-t-40" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Upload do documento</p>

                        <label class="fileContainer ">
                            <div for="file_document" class="btn btn-line-gray size-sm margin-t-0">SELECIONAR ARQUIVO</div>
                            <input type="file" style="display: none;" class="form-control-file" id="file-document-1" name="file-document-1" onchange="readURL(this);">
                        </label>

                        <label id="text-file-1"style="font-weight: 600; color: #ff3576; margin-left: 10px;"></label>
                    </div>

                    <br />
                    <br />
                    
                    <label class="fileContainer ">
                        <input type="hidden" name="total_itens" value="1" id="total-itens" />
                        <button type="button" class="btn btn-default" id="btn-add-document">Adicionar mais itens +</button>
                    </label>

                    <div class="text-center">
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                data-url="/api/web/accountant/documents/add" data-form="#form_add_document_accountant" data-redirect="none">
                                ADICIONAR
                        </div>
                    </div>

                </form>

                <script>
                    function readURL(input) {

                        var type = input.name;
                        var type = type.replace(/\D/gim, '');

                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                var fullPath = document.getElementById('file-document-'+type).value;
                                if (fullPath) {
                                    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                                    var filename = fullPath.substring(startIndex);
                                    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                                        filename = filename.substring(1);
                                    }
                                }

                                $('#text-file-'+type).html(filename);
                            };

                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                </script>

            </div>
        </div>
    </div>
</div>

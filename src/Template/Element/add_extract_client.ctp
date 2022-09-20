
<div class="modal fade" id="add_extract_client" tabindex="-1" role="dialog" aria-labelledby="add_extract_clientLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar extrato bancário</h4>
            </div>
            <div class="modal-body">

                <?php

                $date = date_format($date_now, 'd/m/Y');
                $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

                ?>

                <form id="form_add_extract_client">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome do banco</p>
                    <input type="text" class="form-control required" name="bank" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Descrição</p>
                    <select type="text" class="form-control required" name="description" style="font-size: 14px; background-color: #fff;">
                        <option value="Extrato conta corrente">Extrato conta corrente</option>
                        <option value="Extrato aplicação">Extrato aplicação</option>
                        <option value="Extrato DIRF">Extrato DIRF</option>
                        <option value="Outros">Outros</option>
                    </select>

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Período Inicial</p>
                    <!-- <input type="text" class="form-control required money2" name="recipes" style="font-size: 14px; background-color: #fff;"> -->

                    <div class="input-date1">
                        <div class="icon ion-android-calendar arrow"></div>

                        <input type="text" class="form-control add-date" name="date_inicial"
                        value="<?= $date; ?>" placeholder="" style="cursor: pointer;" id="dateI1">

                        <!-- Datepicker -->
                        <div class="box-datepicker1 client">
                            <div class="datepicker1" data-date="<?= h($date_input); ?>" data-id="#dateI1"></div>
                        </div>

                    </div>

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Período Final</p>

                    <div class="input-date">
                        <div class="icon ion-android-calendar arrow"></div>

                        <input type="text" class="form-control add-date" name="date_final"
                        value="<?= $date; ?>" placeholder="" style="cursor: pointer;" id="extract-date">

                        <!-- Datepicker -->
                        <div class="box-datepicker client">
                            <div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#extract-date"></div>
                        </div>

                    </div>

                    <p class="text margin-t-40" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">
                        Upload do documento<br>
                        Envie seus documentos no formato XML ou PDF.
                    </p>

                    <label class="fileContainer ">
                        <div for="file_extract" class="btn btn-line-gray size-sm margin-t-0">SELECIONAR ARQUIVO</div>
                        <input type="file" style="display: none;" class="form-control-file"
                            id="file_extract" name="file_extract" onchange="readURLExtract(this, 'extract');">
                    </label>

                    <label id="text-file-extract"style="font-weight: 600; color: #54b6f5; margin-left: 10px;"></label>

                    <div class="text-center">
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                data-url="/api/web/client/extracts/add" data-form="#form_add_extract_client" data-redirect="none">
                                ADICIONAR
                        </div>
                    </div>

                </form>

                <script>
                    function readURLExtract(input, type) {

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

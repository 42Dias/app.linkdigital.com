
<div class="modal fade" id="add_note_client" tabindex="-1" role="dialog" aria-labelledby="add_note_clientLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar nota fiscal</h4>
            </div>
            <div class="modal-body">

                <?php

                $date = date_format($date_now, 'd/m/Y');
                $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

                ?>

                <form id="form_add_note_client">

                    <p class="text" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Área</p>
                    <input type="text" class="form-control required" name="title" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Descrição</p>
                    <select type="text" class="form-control required" name="description" style="font-size: 14px; background-color: #fff;">
                        <option value="Serviços Prestados">Serviços Prestados</option>
                        <option value="Serviços Tomados">Serviços Tomados</option>
                        <option value="Venda de Mercadorias">Venda de Mercadorias</option>
                        <option value="Compra de Mercadoria">Compra de Mercadoria</option>
                        <option value="Conhecimento de Transporte">Conhecimento de Transporte</option>
                    </select>
                    
                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Valor total do faturamento do mês</p>
                    <input type="text" class="form-control required money2" name="total" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Período</p>
                    <input type="text" class="form-control add-date required mask-dd-yyyy" name="date" id="note-date">

                    <!-- <div class="input-date">
                        <div class="icon ion-android-calendar arrow"></div>

                        <input type="text" class="form-control add-date" name="date"
                        value="<?= $date; ?>" placeholder="" style="cursor: pointer;" id="note-date"> -->

                        <!-- Datepicker -->
                        <!-- <div class="box-datepicker client">
                            <div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#note-date"></div>
                        </div>

                    </div> -->

                    <p class="text margin-t-40" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">
                        Upload do documento<br>
                        Envie seus documentos no formato XML ou PDF.
                    </p>


                    <label class="fileContainer ">
                        <div for="file_note" class="btn btn-line-gray size-sm margin-t-0">SELECIONAR ARQUIVO</div>
                        <input type="file" style="display: none;" class="form-control-file" id="file_note" name="file_note[]" multiple="multiple" onchange="readURLNotes(this, 'note');">
                    </label>
                    <!-- <label class="fileContainer ">
                        <div for="file_note" class="btn btn-line-gray size-sm margin-t-0">SELECIONAR ARQUIVO</div>
                        <input type="file" style="display: none;" class="form-control-file"
                            id="file_note" name="file_note" onchange="readURL(this, 'note');">
                    </label> -->

                    <label id="text-file-note"style="font-weight: 600; color: #54b6f5; margin-left: 10px;"></label>

                    <div class="text-center">
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                data-url="/api/web/client/notes/add" data-form="#form_add_note_client" data-redirect="none">
                                ADICIONAR
                        </div>
                    </div>

                </form>

                <script>
                    function readURLNotes(input, type) {

                        var fileInput = document.getElementById('file_'+type);
                        var files = fileInput.files;

                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                var fullPath = files.length;
                                
                                if(fullPath == "1"){
                                    var filename = fullPath + " arquivo";
                                }else{
                                    var filename = fullPath + " arquivos";
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

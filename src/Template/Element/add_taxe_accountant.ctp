
<div class="modal fade" id="add_taxe_accountant" tabindex="-1" role="dialog" aria-labelledby="add_taxe_accountantLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar imposto a pagar</h4>
            </div>
            <div class="modal-body">

                <?php

                $date = date_format($date_now, 'd/m/Y');
                $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

                ?>

                <form id="form_add_taxe_accountant">

                    <input type='hidden' name="business_id" value="<?= $business_id; ?>">

                    <p class="text" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Título</p>
                    <input type="text" class="form-control accountant required" name="title" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Descrição</p>
                    <input type="text" class="form-control accountant required" name="description" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Valor do imposto (R$)</p>
                    <input type="text" class="form-control accountant required money2" name="total" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Vencimento</p>

                    <div class="input-date">
                        <div class="icon ion-android-calendar arrow"></div>

                        <input type="text" class="form-control accountant add-date" name="maturity"
                        value="<?= $date; ?>" placeholder="" style="cursor: pointer;" id="taxe-maturity">

                        <!-- Datepicker -->
                        <div class="box-datepicker accountant">
                            <div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#taxe-maturity"></div>
                        </div>

                    </div>

                    <p class="text margin-t-40" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Upload do documento</p>

                    <label class="fileContainer ">
                        <div for="file_taxe" class="btn btn-line-gray size-sm margin-t-0">SELECIONAR ARQUIVO</div>
                        <input type="file" style="display: none;" class="form-control-file"
                            id="file_taxe" name="file_taxe" onchange="readURL(this, 'taxe');">
                    </label>

                    <label id="text-file-taxe"style="font-weight: 600; color: #ff3576; margin-left: 10px;"></label>

                    <div class="text-center">
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                data-url="/api/web/accountant/taxes/add" data-form="#form_add_taxe_accountant" data-redirect="none">
                                ADICIONAR
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

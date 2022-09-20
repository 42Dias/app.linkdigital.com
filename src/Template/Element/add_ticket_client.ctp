
<div class="modal fade" id="addTicket" tabindex="-1" role="dialog" aria-labelledby="addTicketLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Criar chamado</h4>
            </div>
            <div class="modal-body">

                <form method="POST" id="form-add-ticket" enctype="multipart/form-data" action="/client/tickets/addticket" autocomplete="off">

                    <div class="form-group margin-b-20">
                        <label>Área responsável</label>
                        <select type="text" class="form-control accountant" name="area" style="font-size: 14px; background-color: #fff;">

                        <?php if($origin_user != 'cadastro'){ ?>
                            <option value="fiscal">Fiscal</option>
                            <option value="pessoal">Pessoal</option>
                            <option value="financeiro">Financeiro</option>
                            <option value="contabil">Contábil</option>
                            <option value="administracao">Administração</option>
                            <option value="legalizacao">Legalização</option>
                            <option value="atendimento">Atendimento</option>
                            <option value="treinamento">Treinamento</option>
                            <option value="comercial">Comercial</option>
                            <option value="marketing">Marketing</option>
                        <?php } ?>

                        <?php if($origin_user == 'cadastro'){ ?>
                            <option value="atendimento">Atendimento</option>
                            <option value="treinamento">Treinamento</option>
                            <option value="comercial">Comercial</option>
                            <option value="marketing">Marketing</option>
                        <?php } ?>
                        </select>
                    </div>

                    <div class="form-group margin-b-20">
                        <label>Assunto</label>
                        <input type="text" class="form-control" name="subject" value=""  autocomplete="off">
                    </div>

                    <div class="form-group margin-b-20">
                        <label>No que podemos te ajudar?</label>
                        <textarea class="form-control client" name="text" rows="6"  id="input-client-text"
                        value="" style="font-size: 14px; height: auto !important;"></textarea>
                    </div>

                    <div class="form-group" style="position: relative;">
                        <label for="name" class="label margin-t-10 text-left">Anexar documento</label>
                        <br><br>
                        <input type="file" name="document_file" style="font-size: 12px;">
                    </div>

                    
                    <div class="text-center">

                    <button type="submit" style="margin-top: 40px; font-size: 12px; padding: 15px 40px;" class="btn btn-yellow size-lg margin-t-50">CRIAR CHAMADO</button>
                    <!-- <div style="margin-top: 40px; font-size: 12px; padding: 15px 40px;"
                            class="btn btn-yellow size-lg margin-t-50" id="btnAddTicket">CRIAR CHAMADO</div> -->
                    </div>

                </form>

                <div class="clear"></div>

            </div>
        </div>
    </div>
</div>

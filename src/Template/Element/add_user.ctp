<div class="modal fade" id="add_user" role="dialog" aria-labelledby="add_userLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar Novo Usuário</h4>
            </div>
            <div class="modal-body">

                <form id="form_add_user">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                    <input type="text" class="form-control accountant required" name="name" style="font-size: 14px; background-color: #fff;">
                    
                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Sobrenome</p>
                    <input type="text" class="form-control accountant required" name="lastname" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Permissão</p>
                    <select class="form-control required margin-t-20" name="permission" style="font-size: 14px; background-color: #fff;">
                        <option value="">Selecionar Nova Permissão</option>
                        <option value="2">WebMaster</option>
                        <option value="3">Direção</option>
                        <option value="4">Fiscal</option>
                        <option value="5">Pessoal</option>
                        <option value="6">Financeiro</option>
                        <option value="7">Contábil</option>
                        <option value="8">Cadastro</option>
                        <option value="9">Administrativo</option>
                        <option value="10">Legalização</option>
                        <option value="11">Atendimento</option>
                        <option value="12">Treinamento</option>
                        <option value="13">Comercial</option>
                        <option value="14">Marketing</option>
                    </select>

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">E-mail</p>
                    <input type="email" class="form-control accountant required" name="email" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Senha</p>
                    <input type="password" id="password" class="form-control accountant required" name="password" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Confirmar Senha</p>
                    <input type="password" id="confirm_password" class="form-control accountant required" name="confirmar_senha" style="font-size: 14px; background-color: #fff;">

                    <div class="text-center">
                        <div class="btn btn-yellow size-lg margin-t-50" id="btn-add-user">ADICIONAR</div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

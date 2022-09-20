
<div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="add_categoryLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar categoria</h4>
            </div>
            <div class="modal-body">

                <form id="form_add_category">

                    <input type='hidden' name="business_id" value="<?= $business_id; ?>" id="business_id">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo</p>
                    <select type="text" class="form-control required" name="category_type" data-type="category" style="font-size: 14px; background-color: #fff;">
                        <option value="receipt">Receita</option>
                        <option value="payment">Despesa</option>
                    </select>

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Grupo</p>
                    <select type="text" class="form-control required" name="category_group" data-type="category" style="font-size: 14px; background-color: #fff;">
                        <option value="receitas_operacionais">Receitas operacionais</option>
                        <option value="custos_operacionais">Custos operacionais</option>
                        <option value="despesas_opercionais_e_outras_receitas">Despesas opercionais e outras receitas</option>
                        <option value="atividade_de_investimento">Atividade de investimento</option>
                        <option value="atividade_de_financiamento">Atividade de financiamento</option>
                    </select>

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                    <input type="text" class="form-control accountant required" name="category_name" style="font-size: 14px; background-color: #fff;">

                    <div class="text-center">
                    
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                             data-url="/api/web/custom/categories/add" data-form="#form_add_category" data-redirect="none">
                                ADICIONAR
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="add_group_task_accountant" tabindex="-1" role="dialog" aria-labelledby="add_group_task_accountantLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar grupo de obrigações</h4>
            </div>
            <div class="modal-body">

                <?php

                $date = date_format($date_now, 'd/m/Y');
                $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

                ?>

                <form id="form_add_group_task_accountant">

                    <input type='hidden' name="business_id" value="<?= $business_id; ?>">

                    <p class="text" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Título</p>
                    <input type="text" class="form-control accountant required" name="title" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Descrição</p>
                    <input type="text" class="form-control accountant required" name="description" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Recorrência</p>
                    <select class="form-control accountant required" name="type" style="font-size: 14px; background-color: #fff;">
                        <option value="none">Nenhuma</option>    
                        <option value="diary">Diário</option>    
                        <option value="week">Semanal</option>
                        <option value="month">Mensal</option>
                        <option value="yearly">Anual</option>
                    </select>

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Setor responsável</p>
                    <select class="form-control accountant required" name="area" style="font-size: 14px; background-color: #fff;">   
                        <option value="3">Administrativo</option>
                        <option value="4">Financeiro</option>
                        <option value="5">Consultor</option>
                        <option value="6">Técnico</option>
                        <option value="7">Treinamento</option>
                        <option value="8">Vendas</option>
                    </select>

                    <div class="text-center">
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                data-url="/api/web/accountant/tasks/add-group" data-form="#form_add_group_task_accountant" data-redirect="none">
                                ADICIONAR
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="update_releases" tabindex="-1" role="dialog" aria-labelledby="update_releasesLabel" aria-hidden="true">
    <div class="modal-dialog size-medium" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Atualizar</h4>
            </div>
            <div class="modal-body">
                <form id="form_update_releases">

                    <input type="hidden" name="business_id" value="<?= $business_id; ?>" id="business_id">
                    <input type="hidden" name="type_id" id="type_id">
                    <input type="hidden" name="account_id" id="account_id">
                    <input type="hidden" name="release_id" id="release_id">

                    <div class="row margin-t-20">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Título</p>
                            <input type="text" class="form-control accountant required" name="releases_title" style="font-size: 14px; background-color: #fff;" id="input_update_releases_title">

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Categoria</p>
                            <select type="text" class="form-control required" name="releases_category_id" style="font-size: 14px; background-color: #fff;" id="input_update_releases_category">

                                <?php $x=0; foreach ($query_categories as $category) { $x++; ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                <?php } ?>

                            </select>
                           
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Valor</p>
                            <input type='number' step="0.01" class="form-control accountant required" name="releases_value" style="font-size: 14px; background-color: #fff;" id="input_update_releases_value">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Conta bancária</p>
                            
                            <select type="text" class="form-control required" name="releases_account" style="font-size: 14px; background-color: #fff;" id="input_update_releases_account">
                                <?php $x=0; foreach ($query_accounts as $account) { $x++; ?>
                                    <option value="<?php echo $account->id; ?>"><?php echo $account->bank; ?></option>
                                <?php } ?>
                            </select>

                            

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Entrada/Saida</p>
                            <select type="text" class="form-control required" name="releases_type" style="font-size: 14px; background-color: #fff;" id="input_update_releases_type">
                                <option value="receipt">Entrada</option>
                                <option value="payment">Saida</option>
                            </select>  

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Saldo</p>
                            <input type='number' step="0.01" class="form-control accountant required" name="releases_balance" style="font-size: 14px; background-color: #fff;" id="input_update_releases_balance">

                            <div class="btn btn-line-gray size-lg margin-t-50 btn_send_form"
                                data-url="/api/web/custom/releases/update" data-form="#form_update_releases" data-redirect="none">
                                    ATUALIZAR
                            </div>

                        </div>

                        
                    </div>


                </form>

            </div>
        </div>
    </div>
    
</div>

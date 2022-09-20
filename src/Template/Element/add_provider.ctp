
<div class="modal fade" id="add_provider" tabindex="-1" role="dialog" aria-labelledby="add_providerLabel" aria-hidden="true">
    <div class="modal-dialog size-medium" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar fornecedor</h4>
            </div>
            <div class="modal-body">

                <form id="form_add_provider">

                    <input type='hidden' name="business_id" value="<?= $business_id; ?>" id="business_id">

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de fornecedor</p>
                            <select type="text" class="form-control required" name="provider_type" id="input_provider_type" data-type="provider" style="font-size: 14px; background-color: #fff;">
                                <option value="pj">Pessoa jurídica</option>
                                <option value="pf">Pessoa física</option>
                            </select>

                        </div>
                    </div>

                    <div id="area_provider_pj">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CNPJ</p>
                                <input type="text" class="form-control accountant mask-cnpj" name="provider_pj_document" id="input-search-cnpj" data-type="modal" style="font-size: 14px; background-color: #fff;">

                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome Fantasia</p>
                                <input type="text" class="form-control accountant" name="provider_pj_fantasia" style="font-size: 14px; background-color: #fff;">
                            
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Razão social</p>
                                <input type="text" class="form-control accountant" name="provider_pj_razao" style="font-size: 14px; background-color: #fff;">
                                
                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Insc. Mun.</p>
                                <input type="text" class="form-control accountant" name="provider_pj_insc" style="font-size: 14px; background-color: #fff;">
                            
                            </div>
                        </div>
                    </div>

                    <div id="area_provider_pf" style="display: none;">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CPF</p>
                                <input type="text" class="form-control accountant mask-cpf" name="provider_pf_document" id="input-cpf" style="font-size: 14px; background-color: #fff;">
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                                <input type="text" class="form-control accountant" name="provider_pf_name" style="font-size: 14px; background-color: #fff;">
                            </div>
                        </div>
                    </div>

                     <!-- TABS -->
                     <div class="box-tabs no-link">
                        <a class="tab-item active" data-open="#tab_content_provider_1" data-type="provider" style="font-size: 12px;">Contato</a>
                        <a class="tab-item" data-open="#tab_content_provider_2" data-type="provider" style="font-size: 12px;">Endereço</a>
                        <a class="tab-item" data-open="#tab_content_provider_3" data-type="provider" style="font-size: 12px;">Dados bancários</a>
                        <a class="tab-item" data-open="#tab_content_provider_4" data-type="provider" style="font-size: 12px;">Adicionais</a>
                        <div class="clear"></div>
                    </div>

                    <!-- TAB 1 -->
                    <div class="box-tab-content active" id="tab_content_provider_1" style="padding-top: 0px; background-color: #f9f9f9;">
                        <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">E-mail</p>
                                    <input type="text" class="form-control accountant" name="provider_email" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Telefone</p>
                                    <input type="text" class="form-control accountant mask-phonefixed" name="provider_phone" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Celular</p>
                                    <input type="text" class="form-control accountant mask-phone" name="provider_mobile" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Pessoa de contato</p>
                                    <input type="text" class="form-control accountant" name="provider_contact" style="font-size: 14px; background-color: #fff;">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- TAB 2 -->
                    <div class="box-tab-content" id="tab_content_provider_2" style="padding-top: 0px; background-color: #f9f9f9;">
                        <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CEP</p>
                                    <input type="text" class="form-control accountant mask-cep" name="provider_zipcode" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Endereço</p>
                                    <input type="text" class="form-control accountant" name="provider_address" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Número</p>
                                    <input type="text" class="form-control accountant" name="provider_number" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Complemento</p>
                                    <input type="text" class="form-control accountant" name="provider_complement" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Bairro</p>
                                    <input type="text" class="form-control accountant" name="provider_district" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Cidade</p>
                                    <input type="text" class="form-control accountant" name="provider_city" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Estado</p>
                                    <input type="text" class="form-control accountant" name="provider_state" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">País</p>
                                    <input type="text" class="form-control accountant" name="provider_country" style="font-size: 14px; background-color: #fff;">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- TAB 3 -->
                    <div class="box-tab-content" id="tab_content_provider_3" style="padding-top: 0px; background-color: #f9f9f9;">
                        <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Banco</p>
                                    <input type="text" class="form-control accountant" name="provider_bank" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Agência</p>
                                    <input type="text" class="form-control accountant" name="provider_agency" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Conta</p>
                                    <input type="text" class="form-control accountant" name="provider_account" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de conta</p>
                                    <input type="text" class="form-control accountant" name="provider_account_type" style="font-size: 14px; background-color: #fff;">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- TAB 4 -->
                    <div class="box-tab-content" id="tab_content_provider_4" style="padding-top: 0px; background-color: #f9f9f9;">
                        <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Website</p>
                                    <input type="text" class="form-control accountant" name="provider_site" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Observações</p>
                                    <textarea rows="5" class="form-control accountant" name="provider_obs" style="font-size: 14px; background-color: #fff; height: auto !important;"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="text-center">
                    
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                             data-url="/api/web/custom/providers/add" data-form="#form_add_provider" data-redirect="none">
                                ADICIONAR
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

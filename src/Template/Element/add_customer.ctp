
<div class="modal fade" id="add_customer" tabindex="-1" role="dialog" aria-labelledby="add_customerLabel" aria-hidden="true">
    <div class="modal-dialog size-medium" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar cliente</h4>
            </div>
            <div class="modal-body">

                <form id="form_add_customer">

                    <input type='hidden' name="business_id" value="<?= $business_id; ?>" id="business_id">

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de cliente</p>
                            <select type="text" class="form-control required" name="customer_type" id="input_customer_type" data-type="customer" style="font-size: 14px; background-color: #fff;">
                                <option value="pj">Pessoa jurídica</option>
                                <option value="pf">Pessoa física</option>
                            </select>

                        </div>
                    </div>

                    <div id="area_customer_pj">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CNPJ</p>
                                <input type="text" class="form-control accountant mask-cnpj" name="customer_pj_document" id="input-search-cnpj" data-type="modal" style="font-size: 14px; background-color: #fff;">

                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome Fantasia</p>
                                <input type="text" class="form-control accountant" name="customer_pj_fantasia" id="input-cnpj-fantasia" style="font-size: 14px; background-color: #fff;">
                            
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Razão social</p>
                                <input type="text" class="form-control accountant" name="customer_pj_razao" id="input-cnpj-razao" style="font-size: 14px; background-color: #fff;">
                                
                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Insc. Mun.</p>
                                <input type="text" class="form-control accountant" name="customer_pj_insc" style="font-size: 14px; background-color: #fff;">
                            
                            </div>
                        </div>
                    </div>

                    <div id="area_customer_pf" style="display: none;">

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CPF</p>
                                <input type="text" class="form-control accountant mask-cpf" name="customer_pf_document" id="input-cpf" style="font-size: 14px; background-color: #fff;">
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                                <input type="text" class="form-control accountant" name="customer_pf_name" style="font-size: 14px; background-color: #fff;">
                            </div>
                        </div>
                    </div>

                     <!-- TABS -->
                     <div class="box-tabs no-link">
                        <a class="tab-item active" data-open="#tab_content_customer_1" data-type="customer" style="font-size: 12px;">Contato</a>
                        <a class="tab-item" data-open="#tab_content_customer_2" data-type="customer" style="font-size: 12px;">Endereço</a>
                        <a class="tab-item" data-open="#tab_content_customer_3" data-type="customer" style="font-size: 12px;">Dados bancários</a>
                        <a class="tab-item" data-open="#tab_content_customer_4" data-type="customer" style="font-size: 12px;">Adicionais</a>
                        <div class="clear"></div>
                    </div>

                    <!-- TAB 1 -->
                    <div class="box-tab-content active" id="tab_content_customer_1" style="padding-top: 0px; background-color: #f9f9f9;">
                        <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">E-mail</p>
                                    <input type="text" class="form-control accountant" name="customer_email" id="input-cnpj-email" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Telefone</p>
                                    <input type="text" class="form-control accountant mask-phonefixed" name="customer_phone" id="input-cnpj-telefone" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Celular</p>
                                    <input type="text" class="form-control accountant mask-phone" name="customer_mobile" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Pessoa de contato</p>
                                    <input type="text" class="form-control accountant" name="customer_contact" style="font-size: 14px; background-color: #fff;">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- TAB 2 -->
                    <div class="box-tab-content" id="tab_content_customer_2" style="padding-top: 0px; background-color: #f9f9f9;">
                        <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CEP</p>
                                    <input type="text" class="form-control accountant mask-cep" name="customer_zipcode" id="input-cnpj-cep" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Endereço</p>
                                    <input type="text" class="form-control accountant" name="customer_address" id="input-cnpj-logradouro" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Número</p>
                                    <input type="text" class="form-control accountant" name="customer_number" id="input-cnpj-numero" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Complemento</p>
                                    <input type="text" class="form-control accountant" name="customer_complement" id="input-cnpj-complemento" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Bairro</p>
                                    <input type="text" class="form-control accountant" name="customer_district" id="input-cnpj-bairro" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Cidade</p>
                                    <input type="text" class="form-control accountant" name="customer_city" id="input-cnpj-municipio" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Estado</p>
                                    <input type="text" class="form-control accountant" name="customer_state" id="input-cnpj-uf" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">País</p>
                                    <input type="text" class="form-control accountant" name="customer_country" id="input-cnpj-pais" style="font-size: 14px; background-color: #fff;">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- TAB 3 -->
                    <div class="box-tab-content" id="tab_content_customer_3" style="padding-top: 0px; background-color: #f9f9f9;">
                        <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Banco</p>
                                    <input type="text" class="form-control accountant" name="customer_bank" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Agência</p>
                                    <input type="text" class="form-control accountant" name="customer_agency" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Conta</p>
                                    <input type="text" class="form-control accountant" name="customer_account" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de conta</p>
                                    <input type="text" class="form-control accountant" name="customer_account_type" style="font-size: 14px; background-color: #fff;">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- TAB 4 -->
                    <div class="box-tab-content" id="tab_content_customer_4" style="padding-top: 0px; background-color: #f9f9f9;">
                        <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Website</p>
                                    <input type="text" class="form-control accountant" name="customer_site" style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Observações</p>
                                    <textarea rows="5" class="form-control accountant" name="customer_obs" style="font-size: 14px; background-color: #fff; height: auto !important;"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="text-center">
                    
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                             data-url="/api/web/custom/customers/add" data-form="#form_add_customer" data-redirect="none">
                                ADICIONAR CLIENTE
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="open_customer" tabindex="-1" role="dialog" aria-labelledby="open_customerLabel" aria-hidden="true">
    <div class="modal-dialog size-medium" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <!-- <h4 style="font-weight: 500; color: #333;">Visualizar cliente</h4> -->
            </div>
            <div class="modal-body" style="border-top: none;">

                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <h3 style="font-weight: 600; color: #333;">Willian LTDA</h3>
                        <p style="font-weight: 600; color: #999; font-size: 14px; margin-top: 5px;">
                            50.460.799/0001-77&nbsp; | &nbsp;webmaster@oceaning.com.br&nbsp; | &nbsp;(12) 57987-5562
                        </p>

                        <hr class="margin-t-30">

                        <div class="row margin-t-30">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <p class="text" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Contas recebidas</p>
                                <p class="text" style="font-size: 18px; margin-bottom: 10px; color: #1bda44; font-weight: 600;">R$ 0,00</p>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                <p class="text" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Contas em aberto</p>
                                <p class="text" style="font-size: 18px; margin-bottom: 10px; color: #333; font-weight: 600;">R$ 0,00</p>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                
                                <p class="text" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Contas vencidas</p>
                                <p class="text" style="font-size: 18px; margin-bottom: 10px; color: #f33535; font-weight: 600;">R$ 0,00</p>
                            </div>
                        </div>

                        <br><br>
                        <h4 style="font-weight: 500; color: #333;">Últimos Recebimentos</h4>
                        <hr>
                        
                        <div class="text-left" style="padding-bottom: 30px;">
                            <span class="title" style="font-size: 12px; color: #999;">Nenhum recebimento.</span>
                        </div>

                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <br>
                        <h4 style="font-weight: 500; color: #333;">Arquivos</h4>
                        <hr>

                        <div class="text-left" style="padding-bottom: 30px;">
                            <span class="title" style="font-size: 12px; color: #999;">Nenhum arquivo.</span>
                        </div>

                        <br>
                        <h4 style="font-weight: 500; color: #333;">Anotações</h4>
                        <hr>

                        <div class="text-left" style="padding-bottom: 30px;">
                            <span class="title" style="font-size: 12px; color: #999;">Nenhuma anotação.</span>
                        </div>

                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <br>
                        <h4 style="font-weight: 500; color: #333;">Editar cliente</h4>
                        <hr>

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
                                        <input type="text" class="form-control accountant mask-cnpj" name="customer_pj_document" style="font-size: 14px; background-color: #fff;">

                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome Fantasia</p>
                                        <input type="text" class="form-control accountant" name="customer_pj_fantasia" style="font-size: 14px; background-color: #fff;">
                                    
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Razão social</p>
                                        <input type="text" class="form-control accountant" name="customer_pj_razao" style="font-size: 14px; background-color: #fff;">
                                        
                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Insc. Mun.</p>
                                        <input type="text" class="form-control accountant" name="customer_pj_insc" style="font-size: 14px; background-color: #fff;">
                                    
                                    </div>
                                </div>
                            </div>

                            <div id="area_customer_pf" style="display: none;">

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CPF</p>
                                        <input type="text" class="form-control accountant mask-cpf" name="customer_pf_document" style="font-size: 14px; background-color: #fff;">
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
                                            <input type="text" class="form-control accountant" name="customer_email" style="font-size: 14px; background-color: #fff;">
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Telefone</p>
                                            <input type="text" class="form-control accountant mask-phone" name="customer_phone" style="font-size: 14px; background-color: #fff;">
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
                                            <input type="text" class="form-control accountant mask-cep" name="customer_zipcode" style="font-size: 14px; background-color: #fff;">
                                        </div>

                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Endereço</p>
                                            <input type="text" class="form-control accountant" name="customer_address" style="font-size: 14px; background-color: #fff;">
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Número</p>
                                            <input type="text" class="form-control accountant" name="customer_number" style="font-size: 14px; background-color: #fff;">
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Complemento</p>
                                            <input type="text" class="form-control accountant" name="customer_complement" style="font-size: 14px; background-color: #fff;">
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Bairro</p>
                                            <input type="text" class="form-control accountant" name="customer_district" style="font-size: 14px; background-color: #fff;">
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Cidade</p>
                                            <input type="text" class="form-control accountant" name="customer_city" style="font-size: 14px; background-color: #fff;">
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Estado</p>
                                            <input type="text" class="form-control accountant" name="customer_state" style="font-size: 14px; background-color: #fff;">
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">País</p>
                                            <input type="text" class="form-control accountant" name="customer_country" style="font-size: 14px; background-color: #fff;">
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
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Website</p>
                                            <input type="text" class="form-control accountant" name="customer_site" style="font-size: 14px; background-color: #fff;">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="text-left">
                            
                                <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                    data-url="/api/web/custom/customers/add" data-form="#form_add_customer" data-redirect="none">
                                        ATUALIZAR
                                </div>
                            </div>

                        </form>

                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <br><br>
                        <h4 style="font-weight: 500; color: #333;">Excluir cliente</h4>
                        <hr>

                        <p style="font-weight: 500; color: #666; font-size: 12px; margin-top: 5px;">
                            Tem certeza que deseja excluir esse cliente? Essa ação não poderá ser desfeita.
                        </p>

                        <div class="text-left">
                        
                            <div class="btn btn-line-gray size-lg margin-t-10 btn_send_form"
                                data-url="/api/web/custom/customers/add" data-form="#form_add_customer" data-redirect="none">
                                    EXCLUIR CLIENTE
                            </div>
                        </div>

                        <br><br>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

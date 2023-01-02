
<?php

    echo $this->element('add_employee');
    echo $this->element('add_file');
    echo $this->element('add_note');

    echo $this->element('import_employees');
    // echo $this->element('export_employees');

    $month_format_date['01'] = "Janeiro";
    $month_format_date['02'] = "Fevereiro";
    $month_format_date['03'] = "Março";
    $month_format_date['04'] = "Abril";
    $month_format_date['05'] = "Maio";
    $month_format_date['06'] = "Junho";
    $month_format_date['07'] = "Julho";
    $month_format_date['08'] = "Agosto";
    $month_format_date['09'] = "Setembro";
    $month_format_date['10'] = "Outubro";
    $month_format_date['11'] = "Novembro";
    $month_format_date['12'] = "Dezembro";
?>

<!-- Menu Page -->
<div class="menu-page">

    <div class="row">

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">
            <span class="title-page">Funcionários</span>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="btn btn-yellow size-sm" style="display: block; float: right; margin-left: 0px;"
                    data-toggle="modal" data-target="#import_employees">
                    IMPORTAR
            </div>

            <div class="btn btn-line-gray size-sm margin-r-10" style="display: block; float: right; margin-left: 0px;"
                    data-toggle="modal" data-target="#export_employees">
                    EXPORTAR
            </div>

        </div>
    </div>

</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <!-- TAB 10 -->
            <div class="box-tab-content active margin-t-20">

                <div style="padding: 20px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

                    <div class="row margin-t-20">

                        <!-- ACCOUNTS -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <div style="max-height: 400px; overflow: scroll; overflow-x: hidden;">

                                <div data-toggle="modal" data-target="#add_employee" class="box-client-item" style="cursor: pointer; text-align: center; background-color: #ffcf31; border: #ffcf31; margin-bottom: 20px;">
                                    <strong style="color: #333; font-size: 12px;">
                                        NOVO FUNCIONÁRIO
                                    </strong>
                                </div>

                                <?php $total_employees=0; foreach ($query_employees as $employee) { $total_employees++; ?>

                                    <a href="?tab_select=10&employee_id=<?php echo $employee->id; ?>" class="box-client-item <?php if($employee_selected_id == $employee->id){ echo "active"; } ?>" style="">
                                        <strong style="color: #333; font-size: 12px;">
                                        
                                            <?php
                                                if($employee->type == 'pj'){
                                                    echo $employee->pj_razao;
                                                }else{
                                                    echo $employee->pf_name;
                                                }
                                            ?>

                                        </strong>
                                    </a>

                                <?php } ?>

                            </div>

                        </div>

                        <!-- RELEASES -->
                        <div class="col-xl-9 col-lg-9 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <?php if($total_employees > 0){ ?>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <?php 
                                        $employee_name = '';
                                        $employee_document = '';
                                        $employee_phone = '';
                                        $employee_email = '';
                                        $employee_type = '';
                                        $employee_pj_document = '';
                                        $employee_pj_fantasia = '';
                                        $employee_pj_razao = '';
                                        $employee_pj_insc = '';
                                        $employee_pf_document = '';
                                        $employee_pf_name = '';
                                        $employee_mobile = '';
                                        $employee_contact = '';
                                        $employee_zipcode = '';
                                        $employee_address = '';
                                        $employee_number = '';
                                        $employee_complement = '';
                                        $employee_district = '';
                                        $employee_city = '';
                                        $employee_state = '';
                                        $employee_country = '';
                                        $employee_bank = '';
                                        $employee_agency = '';
                                        $employee_account = '';
                                        $employee_account_type = '';
                                        $employee_site = '';
                                        $employee_created = '';
                                        $employee_updated = '';

                                        foreach ($query_employees as $employee){ 
                                            if($employee->id == $employee_selected_id){
                                                
                                                if($employee->type == 'pj'){
                                                    $employee_name =  $employee->pj_razao;
                                                }else{
                                                    $employee_name = $employee->pf_name;
                                                }

                                                if($employee->type == 'pj'){
                                                    $employee_document =  $employee->pj_document;
                                                }else{
                                                    $employee_document = $employee->pf_document;
                                                }

                                                $employee_phone = $employee->phone;
                                                $employee_email = $employee->email;
                                                $employee_type = $employee->type;
                                                $employee_pj_document = $employee->pj_document;
                                                $employee_pj_fantasia = $employee->pj_fantasia;
                                                $employee_pj_razao = $employee->pj_razao;
                                                $employee_pj_insc = $employee->pj_insc;
                                                $employee_pf_document = $employee->pf_document;
                                                $employee_pf_name = $employee->pf_name;
                                                $employee_mobile = $employee->mobile;
                                                $employee_contact = $employee->contact;
                                                $employee_zipcode = $employee->zipcode;
                                                $employee_address = $employee->address;
                                                $employee_number = $employee->number;
                                                $employee_complement = $employee->complement;
                                                $employee_district = $employee->district;
                                                $employee_city = $employee->city;
                                                $employee_state = $employee->state;
                                                $employee_country = $employee->country;
                                                $employee_bank = $employee->bank;
                                                $employee_agency = $employee->agency;
                                                $employee_account = $employee->account;
                                                $employee_account_type = $employee->account_type;
                                                $employee_site = $employee->site;
                                                $employee_created = $employee->created;
                                                $employee_updated = $employee->updated;

                                            }
                                        }
                                    ?>

                                    <h3 style="font-weight: 600; color: #333;"><?= $employee_name; ?></h3>
                                    <p style="font-weight: 600; color: #999; font-size: 14px; margin-top: 5px;">
                                    <?= $employee_document; ?>&nbsp; | &nbsp;<?= $employee_email; ?>&nbsp; | &nbsp;<?= $employee_phone; ?>
                                    </p>

                                    <hr class="margin-t-30">

                                    <div class="row margin-t-30">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <p class="text" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Contas pagas</p>
                                            <p class="text" style="font-size: 18px; margin-bottom: 10px; color: #1bda44; font-weight: 600;">R$ <?php echo number_format($total_closed, 2, ',', '.'); ?></p>
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <p class="text" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Contas a pagar</p>
                                            <p class="text" style="font-size: 18px; margin-bottom: 10px; color: #333; font-weight: 600;">R$ <?php echo number_format($total_open, 2, ',', '.'); ?></p>
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            
                                            <p class="text" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Contas vencidas</p>
                                            <p class="text" style="font-size: 18px; margin-bottom: 10px; color: #f33535; font-weight: 600;">R$ <?php echo number_format($total_loser, 2, ',', '.'); ?></p>
                                        </div>
                                    </div>

                                    <br><br>
                                    <h4 style="font-weight: 500; color: #333;">Últimos Recebimentos</h4>
                                    <br>
                                    
                                    <?php $x=0; foreach ($query_receipts as $receipt) { $x++; ?>

                                        <div class="box-file client" data-id="<?= $receipt->id; ?>" style="padding-left: 30px;">
                                            <!-- <i class="material-icons-outlined">description</i> -->
                                            
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                                                    <span class="title"><?php echo strval($receipt->title); ?></span>
                                                </div>

                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                                                    <span class="title"><?php echo $receipt->value; ?></span>
                                                </div>

                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                                                    <span class="date"><?= date_format($receipt->maturity, 'd/m/Y'); ?></span>
                                                </div>
                                            </div>

                                        </div>

                                        <hr>

                                    <?php } ?>

                                    <div class="clear"></div>

                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <br>

                                    <h4 style="font-weight: 500; color: #333;">Arquivos</h4>

                                    <div class="box-file add client btn-add-document" data-toggle="modal" data-target="#add_file">
                                        <i class="material-icons-outlined" style="top: 12px;">add</i>
                                        <span class="date"></span>
                                        <span class="title" style="color: #999;">Adicionar arquivo</span>
                                    </div>

                                    <div class="clear"></div>

                                    <?php $x=0; foreach ($query_files as $file) { $x++; ?>

                                        <div class="box-file client" data-id="<?= $file->id; ?>" style="padding-left: 30px;">
                                            <!-- <i class="material-icons-outlined">description</i> -->
                                            
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                                                    <span class="title"><?php echo $file->url; ?></span>
                                                </div>

                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                                                    <span class="date">Enviado <?= date_format($file->created, 'd/m/Y H:m'); ?></span>
                                                </div>

                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                                    <a href="../../uploads/files/<?php echo $file->url; ?>" target="blank_" class="btn btn-line-gray size-sm">Download</a>
                                                </div>

                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                                    <div class="btn btn-line-gray size-sm btn_send_form" data-url="/api/web/custom/files/<?php echo $file->id; ?>/delete" data-form="none" data-redirect="none">Excluir</div>
                                                </div>
                                            </div>

                                        </div>

                                        <hr>

                                    <?php } ?>

                                    <div class="clear"></div>

                                    <br><br>

                                    <h4 style="font-weight: 500; color: #333;">Anotações</h4>
                                    
                                    <div class="box-file add client btn-add-document" data-toggle="modal" data-target="#add_note">
                                        <i class="material-icons-outlined" style="top: 12px;">add</i>
                                        <span class="date"></span>
                                        <span class="title" style="color: #999;">Adicionar anotação</span>
                                    </div>

                                    <div class="clear"></div>

                                    <?php $x=0; foreach ($query_notes as $note) { $x++; ?>

                                        <div class="box-file client" data-id="<?= $note->id; ?>" style="padding-left: 30px;">
                                            <!-- <i class="material-icons-outlined">description</i> -->
                                            
                                            <div class="row">
                                                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 animate-scroll">
                                                    <span class="date"><?= date_format($note->created, 'd/m/Y'); ?></span>
                                                    <span class="title"><?php echo $note->text; ?></span>
                                                </div>

                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                                    <div class="btn btn-line-gray size-sm btn_send_form" data-url="/api/web/custom/notes/<?php echo $note->id; ?>/delete" data-form="none" data-redirect="none">Excluir</div>
                                                </div>
                                            </div>

                                        </div>

                                        <hr>

                                    <?php } ?>

                                    <div class="clear"></div>

                                    <br><br>

                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <br>
                                    <h4 style="font-weight: 500; color: #333;">Editar funcionário</h4>
                                    <hr>

                                    <form id="form_update_employee">

                                        <input type='hidden' name="employee_id" value="<?= $employee->id; ?>" id="employee_id">

                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de cliente</p>
                                                <select type="text" class="form-control required" name="employee_type" id="input_employee_type" data-type="employee" style="font-size: 14px; background-color: #fff;">
                                                    <option value="pj" <?php if($employee->type == 'pj'){ echo 'selected'; } ?>>Pessoa jurídica</option>
                                                    <option value="pf" <?php if($employee->type == 'pf'){ echo 'selected'; } ?>>Pessoa física</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div id="area_employee_pj">

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CNPJ</p>
                                                    <input type="text" class="form-control accountant mask-cnpj" name="employee_pj_document" style="font-size: 14px; background-color: #fff;" value="<?= $employee_pj_document; ?>">

                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome Fantasia</p>
                                                    <input type="text" class="form-control accountant" name="employee_pj_fantasia" style="font-size: 14px; background-color: #fff;" value="<?= $employee_pj_fantasia; ?>">
                                                
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Razão social</p>
                                                    <input type="text" class="form-control accountant" name="employee_pj_razao" style="font-size: 14px; background-color: #fff;" value="<?= $employee_pj_razao; ?>">
                                                    
                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Insc. Mun.</p>
                                                    <input type="text" class="form-control accountant" name="employee_pj_insc" style="font-size: 14px; background-color: #fff;" value="<?= $employee_pj_insc; ?>">
                                                
                                                </div>
                                            </div>
                                        </div>

                                        <div id="area_employee_pf" style="display: none;">

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CPF</p>
                                                    <input type="text" class="form-control accountant mask-cpf" name="employee_pf_document" style="font-size: 14px; background-color: #fff;" value="<?= $employee_pf_document; ?>">
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                                                    <input type="text" class="form-control accountant" name="employee_pf_name" style="font-size: 14px; background-color: #fff;" value="<?= $employee_pf_name; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- TABS -->
                                        <div class="box-tabs update no-link">
                                            <a class="tab-item active" data-open="#tab_content_update_employee_1" data-type="employee" style="font-size: 12px;">Contato</a>
                                            <a class="tab-item" data-open="#tab_content_update_employee_2" data-type="employee" style="font-size: 12px;">Endereço</a>
                                            <a class="tab-item" data-open="#tab_content_update_employee_3" data-type="employee" style="font-size: 12px;">Dados bancários</a>
                                            <a class="tab-item" data-open="#tab_content_update_employee_4" data-type="employee" style="font-size: 12px;">Adicionais</a>
                                            <div class="clear"></div>
                                        </div>

                                        <!-- TAB 1 -->
                                        <div class="box-tab-content active" id="tab_content_update_employee_1" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">E-mail</p>
                                                        <input type="text" class="form-control accountant" name="employee_email" style="font-size: 14px; background-color: #fff;" value="<?= $employee_email; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Telefone</p>
                                                        <input type="text" class="form-control accountant mask-phonefixed" name="employee_phone" style="font-size: 14px; background-color: #fff;" value="<?= $employee_phone; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Celular</p>
                                                        <input type="text" class="form-control accountant mask-phone" name="employee_mobile" style="font-size: 14px; background-color: #fff;" value="<?= $employee_mobile; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Pessoa de contato</p>
                                                        <input type="text" class="form-control accountant" name="employee_contact" style="font-size: 14px; background-color: #fff;" value="<?= $employee_contact; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- TAB 2 -->
                                        <div class="box-tab-content" id="tab_content_update_employee_2" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CEP</p>
                                                        <input type="text" class="form-control accountant mask-cep" name="employee_zipcode" style="font-size: 14px; background-color: #fff;" value="<?= $employee_zipcode; ?>">
                                                    </div>

                                                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Endereço</p>
                                                        <input type="text" class="form-control accountant" name="employee_address" style="font-size: 14px; background-color: #fff;" value="<?= $employee_address; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Número</p>
                                                        <input type="text" class="form-control accountant" name="employee_number" style="font-size: 14px; background-color: #fff;" value="<?= $employee_number; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Complemento</p>
                                                        <input type="text" class="form-control accountant" name="employee_complement" style="font-size: 14px; background-color: #fff;" value="<?= $employee_complement; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Bairro</p>
                                                        <input type="text" class="form-control accountant" name="employee_district" style="font-size: 14px; background-color: #fff;" value="<?= $employee_district; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Cidade</p>
                                                        <input type="text" class="form-control accountant" name="employee_city" style="font-size: 14px; background-color: #fff;" value="<?= $employee_city; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Estado</p>
                                                        <input type="text" class="form-control accountant" name="employee_state" style="font-size: 14px; background-color: #fff;" value="<?= $employee_state; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">País</p>
                                                        <input type="text" class="form-control accountant" name="employee_country" style="font-size: 14px; background-color: #fff;" value="<?= $employee_country; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- TAB 3 -->
                                        <div class="box-tab-content" id="tab_content_update_employee_3" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Banco</p>
                                                        <input type="text" class="form-control accountant" name="employee_bank" style="font-size: 14px; background-color: #fff;" value="<?= $employee_bank; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Agência</p>
                                                        <input type="text" class="form-control accountant" name="employee_agency" style="font-size: 14px; background-color: #fff;" value="<?= $employee_agency; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Conta</p>
                                                        <input type="text" class="form-control accountant" name="employee_account" style="font-size: 14px; background-color: #fff;" value="<?= $employee_account; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de conta</p>
                                                        <input type="text" class="form-control accountant" name="employee_account_type" style="font-size: 14px; background-color: #fff;" value="<?= $employee_account_type; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- TAB 4 -->
                                        <div class="box-tab-content" id="tab_content_update_employee_4" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Website</p>
                                                        <input type="text" class="form-control accountant" name="employee_site" style="font-size: 14px; background-color: #fff;" value="<?= $employee_site; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="text-left">
                                        
                                            <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                                data-url="/api/web/custom/employees/update" data-form="#form_update_employee" data-redirect="none">
                                                    ATUALIZAR
                                            </div>
                                        </div>

                                    </form>

                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <br><br>
                                    <h4 style="font-weight: 500; color: #333;">Excluir funcionário</h4>
                                    <hr>

                                    <p style="font-weight: 500; color: #666; font-size: 12px; margin-top: 5px;">
                                        Tem certeza que deseja excluir esse funcionário? Essa ação não poderá ser desfeita.
                                    </p>

                                    <div class="text-left">
                                    
                                        <div class="btn btn-line-gray size-lg margin-t-10 btn_send_form"
                                            data-url="/api/web/custom/customers/add" data-form="#form_add_customer" data-redirect="none">
                                                EXCLUIR FUNCIONÁRIO
                                        </div>
                                    </div>

                                    <br><br>

                                </div>
                            </div>

                            <?php }else{ ?>

                                <div class="row margin-t-20" style="padding-top: 150px; padding-bottom: 150px; ">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center animate-scroll">

                                        <h4 style="font-weight: 500; color: #333;">Nenhum funcionário selecionado</h4>

                                        <p style="font-weight: 500; color: #666; font-size: 12px; margin-top: 5px;">
                                            Selecione um cliente para que apareça mais detalhes
                                        </p>

                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
    // echo $this->element('footer_panel');
?>

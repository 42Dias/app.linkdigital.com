

<?php

    foreach ($all_business as $business) {

        if($business->taxation == "simei"){ $taxation_text = "Simples Nacional"; }
        if($business->taxation == "simples"){ $taxation_text = "Simples Nacional"; }
        if($business->taxation == "lucro"){ $taxation_text = "Lucro presumido"; }
        if($business->taxation == "real"){ $taxation_text = "Lucro real"; }

        if($business->type == "mei"){ $business_type = "Micro empreendedor individual (MEI)"; }
        if($business->type == "s"){ $business_type = "Prestação de serviços"; }
        if($business->type == "c"){ $business_type = "Comércio"; }
        if($business->type == "sc"){ $business_type = "Prestação de serviços e Comércio"; }
        if($business->type == "liberal"){ $business_type = "Profissionais Liberais e Autônomos"; }
        if($business->type == "empregado"){ $business_type = "Empregado domêstico"; }
        if($business->type == "ind"){ $business_type = "Indústria"; }

        if($business->status == "1"){ $business_status = "Em preenchimento"; $badge_color = "yellow"; }
        if($business->status == "2"){ $business_status = "Em abertura"; $badge_color = "yellow"; }
        if($business->status == "3"){ $business_status = "Em migração"; $badge_color = "yellow"; }
        if($business->status == "4"){ $business_status = "Empresa ativa"; $badge_color = "green"; }
        if($business->status == "5"){ $business_status = "Empresa inativa"; $badge_color = "gray"; }

        $business_name = $business->fantasia;
        $business_cnpj = $business->cnpj;
        $business_razao = $business->razao;
        $business_fantasia = $business->fantasia;
        $business_taxation = $business->taxation;
        $business_faturamento = $business->faturamento;
        $business_socios = $business->socios;
        $business_funcionarios = $business->funcionarios;
        $business_atividades = $business->atividades;
        $business_zipcode = $business->zipcode;
        $business_address = $business->address;
        $business_number = $business->number;
        $business_complement = $business->complement;
        $business_district = $business->district;
        $business_city = $business->city;
        $business_state = $business->state;
        $user_step = $business->steps;
        
        $service_action = $business->action;
        $service_type = $business->type;

        if($service_action == "migracao"){ $service_action_text = "Migração de empresa"; }
        if($service_action == "abertura"){ $service_action_text = "Abertura de empresa"; }

        // Services
        foreach ($all_services as $service) {
            $service_name = $service->name;
            $service_price = $service->price;

            // Taxation
            if($service->taxation == "simples"){ $service_taxation = "Simples Nacional"; }
            if($service->taxation == "lucro"){ $service_taxation = "Lucro Presumido"; }

            // Cycle
            if($service->cycle == "monthly"){ $service_cycle = "Mensal"; }
            if($service->cycle == "yearly"){ $service_cycle = "Anual"; }
        }

        $total_month = $service_price;
        $total_month += ($business_socios - 1) * 29.90;
        $total_month += $business_funcionarios * 29.90;


        $business_address = $business->address;
        $business_complement = $business->complement;
        $business_district = $business->district;
        $business_number = $business->number;
        $business_zipcode = $business->zipcode;
        $business_cnpj = $business->cnpj;
        $business_city = $business->city;
        $business_state = $business->state;
        $business_socios = $business->socios;
        $business_funcionarios = $business->funcionarios;

        if($business_cnpj == ""){
            $business_cnpj = "CNPJ em abertura";
        }
    }
?>

<!-- Menu Page -->
    <div class="menu-page">
  <span class="title-page">Minha contabilidade</span>
</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs" style="min-height: 100px;">
                <div class="badge-status <?php echo $badge_color; ?>" style="color: #333; font-size: 12px;"><?php echo $business_status; ?></div>

                <span class="title-box" style="margin-top: 5px; margin-bottom: 5px; line-height: 24px; font-size: 18px; color: #394556;">
                    Informações da empresa
                </span>

                <hr>

                <div class="row">

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll margin-t-20">                 
                        <span class="title-box" style="margin-top: 5px; margin-bottom: 5px; line-height: 24px; font-size: 18px; color: #394556;">
                            <?php echo $business_name; ?>
                        </span>
                        <span class="title" style="font-size: 12px;"><?php echo $business_address.", ".$business_number.", ".$business_complement.", ".$business_district.", ".$business_zipcode.", ".$business_city." - ".$business_state; ?></span>
                        <br>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll margin-t-20">
                        <div class="box-selected">
                            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                Tipo de empresa
                            </strong>
                            <br>
                            <span style="font-size: 20px; color: #666; font-weight: 600;">
                                <?php echo $service_name; ?>
                            </span>
                            <br>
                            <strong style="font-size: 14px; color: #ff3576; line-height: 24px;">
                                R$ <?php echo number_format($service_price, 2, ',', '.'); ?> / <?php echo $service_cycle; ?>
                            </strong>
                            <br>

                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll margin-t-20">
                        <div class="box-selected">
                            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                Tipo de tributação
                            </strong>
                            <br>
                            <span style="font-size: 20px; color: #666; font-weight: 600;">
                                <?php echo $service_taxation; ?>
                            </span>
                            <br>
                            <strong style="font-size: 12px; color: #32dc4f; line-height: 24px;">
                                INCLUSO
                            </strong>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll margin-t-20">
                        <div class="box-selected">
                            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                Faturamento mensal
                            </strong>
                            <br>
                            <span style="font-size: 20px; color: #666; font-weight: 600;">
                                Até R$ 15.000,00
                            </span>
                            <br>
                            <strong style="font-size: 12px; color: #32dc4f; line-height: 24px;">
                                INCLUSO
                            </strong>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll margin-t-20">
                        <div class="box-selected">
                            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                Quantidade de sócios
                            </strong>
                            <br>
                            <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-socios">

                                <?php
                                    if($business_socios > 1){
                                        echo $business_socios." Sócios";
                                    }else{
                                        echo "1 sócio";
                                    }
                                ?>

                            </span>
                            <br>
                            <strong style="font-size: 12px; color: <?php if($business_socios > 1){ echo '#ff3576'; }else{ echo '#32dc4f'; } ?>; line-height: 24px;" id="price-socios">

                                <?php
                                    $price_socios = ($business_socios - 1) * 29.90;

                                    if($business_socios > 1){
                                        echo "+ R$ ".number_format($price_socios, 2, ',', '.')." / Mensal";
                                    }else{
                                        echo "GRÁTIS";
                                    }
                                ?>

                            </strong>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll margin-t-30">
                        <div class="box-selected">
                            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                Quantidade de funcionários
                            </strong>
                            <br>
                            <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-funcionarios">

                                <?php
                                    if($business_funcionarios > 0){
                                        echo $business_funcionarios." Funcionários";
                                    }else{
                                        echo "Nenhum funcionário";
                                    }
                                ?>

                            </span>
                            <br>
                            <strong style="font-size: 12px; color: <?php if($business_funcionarios > 0){ echo '#ff3576'; }else{ echo '#32dc4f'; } ?>; line-height: 24px;" id="price-funcionarios">

                                <?php
                                    $price_funcionarios = $business_funcionarios * 29.90;

                                    if($business_funcionarios > 0){
                                        echo "+ R$ ".number_format($price_funcionarios, 2, ',', '.')." / Mensal";
                                    }else{
                                        echo "GRÁTIS";
                                    }
                                ?>

                            </strong>
                        </div>
                    </div>
                </div>

                <br>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs" style="min-height: 300px;">

                <!-- <span class="title" style="font-size: 14px;">Abertura de empresa</span> -->

                <span class="title-box" style="margin-top: 5px; margin-bottom: 5px; line-height: 24px; font-size: 18px; color: #394556;">
                    Equipe Link Contabilidade
                </span>

                <hr>
                <br>

                <div class="row">

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center animate-scroll margin-t-30">
                        <img src="/img/equipe/equipe-1.png" class="img-fluid">  
                        <br>                          
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Área Fiscal
                        </strong>
                        <br>
                        <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-socios">
                            Fabrícia Cabral
                        </span>
                        <br>
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            fiscal@linkcontabilidade.com.br
                        </strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center animate-scroll margin-t-30">
                        <img src="/img/equipe/equipe-1.png" class="img-fluid">  
                        <br>                          
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Área Fiscal
                        </strong>
                        <br>
                        <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-socios">
                            Fabrícia Cabral
                        </span>
                        <br>
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            fiscal@linkcontabilidade.com.br
                        </strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center animate-scroll margin-t-30">
                        <img src="/img/equipe/equipe-1.png" class="img-fluid">  
                        <br>                          
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Área Fiscal
                        </strong>
                        <br>
                        <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-socios">
                            Fabrícia Cabral
                        </span>
                        <br>
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            fiscal@linkcontabilidade.com.br
                        </strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center animate-scroll margin-t-30">
                        <img src="/img/equipe/equipe-1.png" class="img-fluid">  
                        <br>                          
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Área Fiscal
                        </strong>
                        <br>
                        <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-socios">
                            Fabrícia Cabral
                        </span>
                        <br>
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            fiscal@linkcontabilidade.com.br
                        </strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center animate-scroll margin-t-30">
                        <img src="/img/equipe/equipe-1.png" class="img-fluid">  
                        <br>                          
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Área Fiscal
                        </strong>
                        <br>
                        <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-socios">
                            Fabrícia Cabral
                        </span>
                        <br>
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            fiscal@linkcontabilidade.com.br
                        </strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center animate-scroll margin-t-30">
                        <img src="/img/equipe/equipe-1.png" class="img-fluid">  
                        <br>                          
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Área Fiscal
                        </strong>
                        <br>
                        <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-socios">
                            Fabrícia Cabral
                        </span>
                        <br>
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            fiscal@linkcontabilidade.com.br
                        </strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center animate-scroll margin-t-30">
                        <img src="/img/equipe/equipe-1.png" class="img-fluid">  
                        <br>                          
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Área Fiscal
                        </strong>
                        <br>
                        <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-socios">
                            Fabrícia Cabral
                        </span>
                        <br>
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            fiscal@linkcontabilidade.com.br
                        </strong>
                    </div>
                </div>

                <br><br>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs" style="min-height: 300px;">

                <!-- <span class="title" style="font-size: 14px;">Abertura de empresa</span> -->

                <span class="title-box" style="margin-top: 5px; margin-bottom: 5px; line-height: 24px; font-size: 18px; color: #394556;">
                    Documentos necessários
                </span>

                <hr>
                <br>
                               
                <?php

                    if($business_status == "Em abertura"){
                        foreach ($all_docs_abertura as $doc) {

                            $document_send_status = '';
                            $document_send_url = '';

                            foreach($all_documents_actions as $document_send){ 
                                if($document_send->document_id == $doc->id && $document_send->type == 'abertura'){
                                    $document_send_status = 'send';
                                    $document_send_url = $document_send->url;
                                }
                            }
                ?>
                            <div class="box-document-action <?php echo $document_send_status; ?>">
                                <span class="check"></span>
                                <span class="name"><?php echo strval($doc->title); ?></span>

                                <?php if($document_send_status == 'send'){ ?>
                                    <span class="name send">Documento enviado</span>
                                <?php } ?>

                                <?php if($document_send_status == ''){ ?>

                                    <form id="form_add_document_action_<?php echo $doc->id; ?>">
                                        <input type="hidden" name='document_id' value="<?php echo $doc->id; ?>">
                                        <input type="hidden" name='type' value="abertura">

                                        <label class="fileContainer ">
                                            <div for="file_document_action" class="btn btn-line-gray size-sm margin-t-0">FAZER UPLOAD</div>
                                            <input type="file" style="display: none;" class="form-control-file" id="file-document-action-<?php echo $doc->id; ?>" name="file-document-action-<?php echo $doc->id; ?>" onchange="readURL(this);">
                                        </label>

                                        <label id="text-file-action-<?php echo $doc->id; ?>"style="font-weight: 600; color: #8541ff; font-size: 10px;"></label>
                                    </form>

                                <?php }else{ ?>

                                    <div class="btn btn-line-gray btn-block size-sm btn_send_form" data-url="/api/web/client/documents/<?php echo $doc->id; ?>/remove-action" data-form="none" data-redirect="none">REMOVER</div>                                    
                                    <a href="../uploads/documents/<?php echo $document_send_url; ?>" target="_blank" class="btn btn-green btn-block size-sm" style="bottom: 70px;">FAZER DOWNLOAD</a>

                                <?php } ?>
                            </div>
                <?php
                        }

                    }else{

                        foreach ($all_docs_migracao as $doc) {

                            $document_send_status = '';
                            $document_send_url = '';

                            foreach($all_documents_actions as $document_send){ 
                                if($document_send->document_id == $doc->id && $document_send->type == 'migracao'){
                                    $document_send_status = 'send';
                                    $document_send_url = $document_send->url;
                                }
                            }
                               
                ?>
                            <div class="box-document-action <?php echo $document_send_status; ?>">
                                <span class="check"></span>
                                <span class="name"><?php echo strval($doc->title); ?></span>

                                <?php if($document_send_status == 'send'){ ?>
                                    <span class="name send">Documento enviado</span>
                                <?php } ?>

                                <?php if($document_send_status == ''){ ?>

                                    <form id="form_add_document_action_<?php echo $doc->id; ?>">
                                        <input type="hidden" name='document_id' value="<?php echo $doc->id; ?>">
                                        <input type="hidden" name='type' value="migracao">

                                        <label class="fileContainer ">
                                            <div for="file_document_action" class="btn btn-line-gray size-sm margin-t-0">FAZER UPLOAD</div>
                                            <input type="file" style="display: none;" class="form-control-file" id="file-document-action-<?php echo $doc->id; ?>" name="file-document-action-<?php echo $doc->id; ?>" onchange="readURL(this);">
                                        </label>

                                        <label id="text-file-action-<?php echo $doc->id; ?>"style="font-weight: 600; color: #8541ff; font-size: 10px;"></label>
                                    </form>

                                <?php }else{ ?>

                                    <div class="btn btn-line-gray btn-block size-sm btn_send_form" data-url="/api/web/client/documents/<?php echo $doc->id; ?>/remove-action" data-form="none" data-redirect="none">REMOVER</div>                                    
                                    <a href="../uploads/documents/<?php echo $document_send_url; ?>" target="_blank" class="btn btn-green btn-block size-sm" style="bottom: 70px;">FAZER DOWNLOAD</a>

                                <?php } ?>
                            </div>

                <?php
                        }
                    }                    
                ?>

                <div class="clear"></div>

                <br>
            </div>
        </div>
    </div>
    
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs">

                <!-- <span class="title" style="font-size: 14px;">Abertura de empresa</span> -->

                <span class="title-box" style="margin-top: 5px; margin-bottom: 5px; line-height: 24px; font-size: 18px; color: #394556;">
                    Histórico de atividades
                </span>

                <hr>
                <br>

                <?php
                    foreach ($all_history as $history) {
                        echo '<span class="title" style="font-size: 12px;">'.date_format($history->created, 'd/m/Y').' às '.date_format($history->created, 'H:m').'</span>';
                        echo '<span class="title" style="font-size: 14px; color: #394556;">'. strval($history->title).'</span><br>';
                    }                
                ?>
                
            </div>
        </div>
    </div>

</div>

<script>
    function readURL(input) {

        var type = input.name;
        var type = type.replace(/\D/gim, '');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var fullPath = document.getElementById('file-document-action-'+type).value;
                if (fullPath) {
                    var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                    var filename = fullPath.substring(startIndex);
                    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                        filename = filename.substring(1);
                    }
                }

                $('#text-file-action-'+type).html(filename);

                // Send document
                sendForm('/api/web/client/documents/add-action', '#form_add_document_action_'+type, 'none');

            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?php
    echo $this->element('footer_panel');
?>

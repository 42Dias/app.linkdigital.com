
<?php

    echo $this->element('agenda');
    
    function valorPorExtenso( $valor = 0, $bolExibirMoeda = true, $bolPalavraFeminina = false )
    {

        $singular = null;
        $plural = null;

        if ( $bolExibirMoeda )
        {
            $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
        }
        else
        {
            $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("", "", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
        }

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");


        if ( $bolPalavraFeminina )
        {

            if ($valor == 1)
            {
                $u = array("", "uma", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
            }
            else
            {
                $u = array("", "um", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
            }


            $c = array("", "cem", "duzentas", "trezentas", "quatrocentas","quinhentas", "seiscentas", "setecentas", "oitocentas", "novecentas");


        }


        $z = 0;

        $valor = number_format( $valor, 2, ".", "." );
        $inteiro = explode( ".", $valor );

        for ( $i = 0; $i < count( $inteiro ); $i++ )
        {
            for ( $ii = mb_strlen( $inteiro[$i] ); $ii < 3; $ii++ )
            {
                $inteiro[$i] = "0" . $inteiro[$i];
            }
        }

        // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
        $rt = null;
        $fim = count( $inteiro ) - ($inteiro[count( $inteiro ) - 1] > 0 ? 1 : 2);
        for ( $i = 0; $i < count( $inteiro ); $i++ )
        {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
            $t = count( $inteiro ) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ( $valor == "000")
                $z++;
            elseif ( $z > 0 )
                $z--;

            if ( ($t == 1) && ($z > 0) && ($inteiro[0] > 0) )
                $r .= ( ($z > 1) ? " de " : "") . $plural[$t];

            if ( $r )
                $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        $rt = mb_substr( $rt, 1 );

        return($rt ? trim( $rt ) : "zero");

    }

    $month_name = [
        "01" => "Janeiro", "02" => "Fevereiro", "03" => "Março",
        "04" => "Abril", "05" => "Maio", "06" => "Junho",
        "07" => "Julho", "08" => "Agosto", "09" => "Setembro",
        "10" => "Outubro", "11" => "Novembro", "12" => "Dezembro"
    ];

    echo $this->element('update_sign');
    echo $this->element('update_terms');

    if($service_action == "abertura"){ $color_menu = "#fff"; }
    if($service_action == "migracao"){ $color_menu = "#fff"; }

    $user_name = "";
    $user_lastname = "";
    $user_username = "";
    $user_cpf = "";
    $user_birthday = "";
    $user_phone = "";
    $user_whatsapp = "";

    foreach ($all_users as $user) {
        $user_name = $user->name;
        $user_lastname = $user->lastname;
        $user_username = $user->username;
        $user_cpf = $user->cpf;
        $user_birthday = $user->birthday;
        $user_phone = $user->phone;
        $user_whatsapp = $user->whatsapp;
    }

    $business_name = "";
    $business_cnpj = "";
    $business_razao = "";
    $business_fantasia = "";
    $business_taxation = 0;
    $business_faturamento = 0;
    $business_socios = 1;
    $business_funcionarios = 0;
    $business_atividades = "";
    $business_zipcode = "";
    $business_address = "";
    $business_number = "";
    $business_complement = "";
    $business_district = 0;
    $business_city = 0;
    $business_state = 1;
    $business_sign = 0;
    $business_terms = 0;
    $business_sign_date = "";
    $business_terms_date = "";

    foreach ($all_business as $business) {
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
        $business_sign = $business->sign;
        $business_terms = $business->terms;
        $business_sign_date = $business->sign_date;
        $business_terms_date =  $business->terms_date;
    }

    // Services
    foreach ($all_services as $service) {
        $service_name = $service->name;
        $service_price = $service->price;

        // Taxation
        if($service->taxation == "simples"){ $service_taxation = "Simples Nacional"; }
        if($service->taxation == "lucro"){ $service_taxation = "Lucro Presumido"; }
        if($service->taxation == "real"){ $service_taxation = "Lucro Real"; }

        // Cycle
        if($service->cycle == "monthly"){ $service_cycle = "Mensal"; }
        if($service->cycle == "yearly"){ $service_cycle = "Anual"; }
    }

    // Business
    $business_socios = 1;
    $business_funcionarios = 0;
    $business_faturamento = 0;

    foreach ($all_business as $business) {
        $business_socios = $business->socios;
        $business_funcionarios = $business->funcionarios;
        $business_faturamento = $business->faturamento;
    }

    $total_month = $service_price;

    if($business_socios > 1){
        $total_month += ($business_socios - 1) * 60.00;
    }

    if($business_funcionarios > 6){
        $total_month += ($business_funcionarios - 6) * 60.00;
    }

    if($business_faturamento > 1){
        $total_month += ($business_faturamento - 1) * 200;
    }


    if($business_sign == 1){
        echo '<script> $(document).ready(function () { $("html, body").animate({ scrollTop: $("#box-sign-contract").offset().top }, 1000); });</script>';
    }

?>

<!-- Header -->
<!-- <div style="position: fixed; top: 0px; left: 0px; width: 100%; background-color: <?php echo $color_menu; ?>; z-index: 1;">
    <div class="" style="position: relative; padding: 0px 40px;">

        <a class="animate-scroll" href="/" style="position: absolute; left: 40px; top: 8px;">
            <img src="/img/logo-link-white.png" style="width: 170px;">
        </a>

        <div class="text-right">
            <span style="display: block; color: #fff; padding: 15px 20px; font-size: 18px; font-weight: 700;;">&nbsp;</span>
        </div>

    </div>
</div> -->


<div style="padding-right: 280px; background-color: #fff;">

    <div class="hidden-mobile visible-md visible-lg" style="position: relative; background-color: #efefef; background-image: url(../img/bg-homepage-v6.jpg); background-position: center; background-repeat: no-repeat; background-size: cover; padding: 40px; padding-top: 20px;">

        <a class="animate-scroll" href="/">
            <img src="/img/logo-link-white.png" style="width: 130px;">
        </a>

        <br><br><br>
        
        <div style="position: absolute; bottom: -12px; left: 495px; width: 20px; height: 20px; background-color: #fff; transform: rotate(45deg);"></div>

        <a href="/contratar/etapa-1" class="link-steps">
            <strong style="font-size: 24px; color: #ffce2c;">1</strong> &nbsp;
            <strong style="font-size: 14px; color: #ffce2c;">Sobre você</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-2" class="link-steps">
            <strong style="font-size: 24px; color: #ffce2c;">2</strong> &nbsp;
            <strong style="font-size: 14px; color: #ffce2c;">Sobre a empresa</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-3" class="link-steps">
            <strong style="font-size: 24px; color: #ffce2c;">3</strong> &nbsp;
            <strong style="font-size: 14px; color: #ffce2c;">Localização</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-4" class="link-steps">
            <strong style="font-size: 24px; color: #fff;">4</strong> &nbsp;
            <strong style="font-size: 14px; color: #fff;">Contrato</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-5" class="link-steps">
            <strong style="font-size: 24px; color: #7d7f8a;">5</strong> &nbsp;
            <strong style="font-size: 14px; color: #7d7f8a;">Pagamento</strong> &nbsp;&nbsp;&nbsp;
        </a>

    </div>

    <!-- Section 1 -->
    <section>

        <div class="" style="padding: 100px 40px; padding-top: 30px; padding-bottom: 40px;">

            <div class="row" style="margin-top: 0px;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll" style="padding-top: 50px;">

                    <span style="font-size: 28px; line-height: 30px; color: #666; font-weight: 600;">
                        Revise suas informações e assine o contrato
                    </span>

                    <p style="font-size: 14px; color: #999; font-weight: 400; margin-top: 10px;">
                        Preencha os dados abaixo e inicie a contratação da sua contabilidade digital
                    </p>

                    <p style="font-size: 14px; color: #999; font-weight: 400; margin-top: 50px;">
                        <strong style="color: #666;">Informações em segurança</strong><br>
                        Suas informações estão 100% seguras, todas as nossas informações são transmitidas por uma conexão segura por senha criptografada.
                    </p>
                </div>
            </div>

            <br><br>


            <?php if($service_action == "abertura"){ ?>

                <!-- Section 1 -->
                <section class="">
                            
                    <span style="font-size: 20px; color: #666; font-weight: 600;">
                        Abertura da empresa
                    </span>

                    <form id="simulation-abertura">

                        <div class="row margin-t-20  margin-b-0">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 margin-t-20">
                                <span style="color: #333;">Estado</span>
                                <select class="form-control active required" name="answer_23"
                                    style="width: 100%; margin-top: 10px; font-size: 14px; text-transform: uppercase;" id="abertura-estado">
                                    <!-- <option value=""></option> -->
                                    <option value="SP" selected>São Paulo</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 margin-t-20">
                                <span style="color: #333;">Cidade</span>
                                <select class="form-control active required" name="answer_22" style="width: 100%; margin-top: 10px; font-size: 14px;" id="abertura-cidade">

                                <?php
                                    $estado = "SP";

                                    if($query_citys != ""){
                                        foreach ($query_citys as $city) {

                                            if($city->uf == $estado){
                                                echo '<option data-uf="'.$city->uf.'" value="'.$city->id.'">'.$city->titulo.'</option>';
                                            }
                                        }
                                    }
                                ?>

                                </select>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 margin-t-20">
                                <span style="color: #333;">Quantos sócios?</span>
                                <input type="number" value="1" class="form-control margin-b-40" id="abertura-socios" name="abertura-socios"
                                style="width: 100%; margin-top: 10px; font-size: 24px;" min="0">
                            </div>
                        </div>

                    </form>

                    <div class="row margin-t-0 margin-b-50">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-t-50">
                            <span class="sub-title" style="margin-bottom: 0px; color: #333;">Honorários Link</span><br>
                            <!-- <span class="sub-title" style="margin-bottom: 20px; color: #00e2de; font-size: 26px; font-weight: 600;">*</span> -->
                            <span class="sub-title" style="margin-bottom: 20px; color: #333; font-size: 26px; font-weight: 600;">R$ 0,00</span>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-t-50">
                            <span class="sub-title" style="margin-bottom: 0px; color: #333;">Taxas Junta e Receita</span><br>
                            <span class="sub-title" style="margin-bottom: 20px; color: #333; font-size: 26px; font-weight: 600;">**</span>
                            <span class="sub-title" style="margin-bottom: 20px; color: #333; font-size: 26px; font-weight: 600;" id="taxa-receita">R$ 0,00</span>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-t-50">
                            <span class="sub-title" style="margin-bottom: 0px; color: #333;">Taxas Municipais</span><br>
                            <span class="sub-title" style="margin-bottom: 20px; color: #6a8333498; font-size: 26px; font-weight: 600;">**</span>
                            <span class="sub-title" style="margin-bottom: 20px; color: #333; font-size: 26px; font-weight: 600;" id="taxa-prefeitura">R$ 0,00</span>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-t-50" data-toggle="modal" data-target="#help_certificado">
                            <span class="sub-title" style="margin-bottom: 0px; color: #333;">eCPF A1 - Certificado Digital</span>
                            <span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Sobre o eCPF"  style="margin-left: 8px; font-size: 18px; color: #929292; cursor: pointer;"></span>
                            <br>
                            <span class="sub-title" style="margin-bottom: 20px; color: #333; font-size: 26px; font-weight: 600;">R$ 124,00</span>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-t-50" data-toggle="modal" data-target="#help_certificado">
                            <span class="sub-title" style="margin-bottom: 0px; color: #333;">eCNPJ A1 - Certificado Digital</span>
                            <span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Sobre o eCNPJ" style="margin-left: 8px; font-size: 18px; color: #929292; cursor: pointer;"></span>
                            <br>
                            <span class="sub-title" style="margin-bottom: 20px; color: #333; font-size: 26px; font-weight: 600;">R$ 185,60</span>
                        </div>
                    </div>

                    <!-- <span class="sub-title" style="margin-bottom: 50px; font-size: 12px; color: #8ea4b5;">
                        * Condicionado a contratação da gestão de sua empresa pela Link por no mínimo 12 meses.<br>
                        ** Valores aproximados a serem confirmado pela Link no momento da contratação.<br>
                        ** Caso a empresa a ser aberta tenha vínculo direto com alguma atividade pertencente a qualquer Associação de Classe, haverá a cobrança adicional de taxas de registro na referida Associação de Classe (p.ex.: CREA, CRM, CRO etc), com valor médio de R$ 1.000,00.<br>
                    </span> -->

                    <div class="row margin-t-50">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <span class="sub-title" style="margin-bottom: 0px; font-size: 12px; color: #333; line-height: 24px;">
                                ** Valores aproximados a serem confirmado pela Link no momento da contratação.
                                <br>
                                ** As taxas municipais são cobradas pelas prefeituras, normalmente, após 1 mês da abertura da empresa, tempo que poderá mudar em função de cada prefeitura.
                                <br>
                            </span>
                        </div>

                    </div>

                </section>

                <br><br><br>

            <?php } ?>

            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 text-left animate-scroll">
                    <span style="font-size: 20px; color: #666; font-weight: 600;">
                        Dados pessoais
                    </span>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right animate-scroll">
                    <a href="/contratar/etapa-1" class="btn btn-line-gray size-sm ">EDITAR DADOS</a>
                </div>
            </div>

            <div class="row margin-t-20">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Nome</p>
                    <strong style="color: #666;"><?php echo $user_name; ?></strong>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Sobrenome</p>
                    <strong style="color: #666;"><?php echo $user_lastname; ?></strong>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Data de nascimento</p>
                    <strong style="color: #666;"><?php echo $user_birthday; ?></strong>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">CPF</p>
                    <strong style="color: #666;"><?php echo $user_cpf; ?></strong>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">E-mail</p>
                    <strong style="color: #666;"><?php echo $user_username; ?></strong>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Telefone / Celular</p>
                    <strong style="color: #666;"><?php echo $user_phone; ?></strong>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Whatsapp</p>
                    <strong style="color: #666;"><?php echo $user_whatsapp; ?></strong>
                </div>

            </div>

            <br><br>
            <hr>
            <br><br>

            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 text-left animate-scroll">
                    <span style="font-size: 20px; color: #666; font-weight: 600;">
                        Dados da empresa
                    </span>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right animate-scroll">
                    <a href="/contratar/etapa-2" class="btn btn-line-gray size-sm ">EDITAR DADOS</a>
                </div>
            </div>

            <div class="row margin-t-20">

                <?php if($service_action == "abertura"){ ?>

                    <!-- ABERTURA -->
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Qual será o nome da sua empresa?</p>
                        <strong style="color: #666;"><?php echo $business_name; ?></strong>
                    </div>

                <?php }else{ ?>

                    <!-- MIGRACAO -->
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">CNPJ da empresa</p>
                        <strong style="color: #666;"><?php echo $business_cnpj; ?></strong>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Razão social</p>
                        <strong style="color: #666;"><?php echo $business_razao; ?></strong>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Nome fantasia</p>
                        <strong style="color: #666;"><?php echo $business_fantasia; ?></strong>
                    </div>

                <?php } ?>
            </div>

            <div class="row margin-t-50">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <div class="box-selected" style="min-height: 200px;">
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Tipo de empresa
                        </strong>
                        <br><br>
                        <span style="font-size: 20px; color: #666; font-weight: 600;">
                            <?php echo $service_name; ?>
                        </span>

                        <?php if($service_taxation !== "Lucro Real"){ ?>
                            
                            <br>
                            <strong style="font-size: 14px; color: #00c221; line-height: 24px;">
                                R$ <?php echo number_format($service_price, 2, ',', '.'); ?> / <?php echo $service_cycle; ?>
                            </strong>

                        <?php } ?> 
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <div class="box-selected" style="min-height: 200px;">
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Tipo de tributação
                        </strong>
                        <br><br>
                        <span style="font-size: 20px; color: #666; font-weight: 600;">
                            <?php echo $service_taxation; ?>
                        </span>
                        <br>
                        <strong style="font-size: 12px; color: #00c221; line-height: 24px;">
                            INCLUSO
                        </strong>

                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <div class="box-selected" style="min-height: 200px;">
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Faturamento mensal
                        </strong>
                        <br><br>
                        <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-faturamento">

                            <?php
                                if($business_faturamento > 1){

                                    $begin = 15000.01;
                                    $end = 30000.00;

                                    for ($i=2; $i < 50; $i++) {

                                        if($business_faturamento == $i){
                                            echo 'R$ '.number_format($begin, 2, ',', '.').' a R$ '.number_format($end, 2, ',', '.');
                                        }

                                        if($i == 1){
                                            $begin = $begin + 0.01;
                                        }

                                        $begin = $end;
                                        $end = $begin + 30000;
                                        // $begin = $begin + 25000;
                                        // $end = $end + 25000;
                                    }

                                }else{
                                    echo "R$ 0,00 a R$ 15.000,00";
                                }
                            ?>
                        </span>
                        <br>
                        <!-- <strong style="font-size: 12px; line-height: 24px; color: <?php if($business_faturamento > 1){ echo '#e70e55'; }else{ echo '#00c221'; } ?>;" id="price-faturamento">

                            <?php
                                $price_faturamento = ($business_faturamento - 1) * 200;

                                if($business_faturamento > 1){
                                    echo "+ R$ ".number_format($price_faturamento, 2, ',', '.')." / Mensal";
                                }else{
                                    echo "GRÁTIS";
                                }
                            ?>

                        </strong> -->
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <div class="box-selected" style="min-height: 200px;">
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Quantidade de sócios
                        </strong>
                        <br><br>
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
                        <!-- <strong style="font-size: 12px; color: <?php if($business_socios > 1){ echo '#e70e55'; }else{ echo '#00c221'; } ?>; line-height: 24px;" id="price-socios">

                            <?php
                                $price_socios = ($business_socios - 1) * 60.00;

                                if($business_socios > 1){
                                    echo "+ R$ ".number_format($price_socios, 2, ',', '.')." / Mensal";
                                }else{
                                    echo "GRÁTIS";
                                }
                            ?>

                        </strong> -->
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <div class="box-selected" style="min-height: 200px;">
                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            Quantidade de funcionários
                        </strong>
                        <br><br>
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
                        <!-- <strong style="font-size: 12px; color: <?php if($business_funcionarios > 6){ echo '#e70e55'; }else{ echo '#00c221'; } ?>; line-height: 24px;" id="price-funcionarios">

                            <?php
                                $price_funcionarios = ($business_funcionarios - 6) * 60.00;

                                if($business_funcionarios > 6){
                                    echo "+ R$ ".number_format($price_funcionarios, 2, ',', '.')." / Mensal";
                                }else{
                                    echo "GRÁTIS";
                                }
                            ?>

                        </strong> -->
                    </div>
                </div>
            </div>

            <?php if($service_action == "abertura"){ ?>

            <div class="row margin-t-10">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Quais serão as atividades da sua empresa?</p>

                    <textarea rows="6" class="form-control margin-t-30" name="atividades"
                        style="font-size: 14px; background-color: #fff; height: auto !important; padding-top: 20px;"><?php echo $business_atividades; ?></textarea>

                </div>
            </div>

            <?php } ?>

            <br><br>
            <hr>
            <br><br>

            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 text-left animate-scroll">
                    <span style="font-size: 20px; color: #666; font-weight: 600;">
                        Localização da empresa
                    </span>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right animate-scroll">
                    <a href="/contratar/etapa-3" class="btn btn-line-gray size-sm ">EDITAR DADOS</a>
                </div>
            </div>

            <div class="row margin-t-20">

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">CEP</p>
                    <strong style="color: #666;"><?php echo $business_zipcode; ?></strong>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Endereço</p>
                    <strong style="color: #666;"><?php echo $business_address; ?></strong>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Número</p>
                    <strong style="color: #666;"><?php echo $business_number; ?></strong>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Complemento</p>
                    <strong style="color: #666;"><?php echo $business_complement; ?></strong>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Bairro</p>
                    <strong style="color: #666;"><?php echo $business_district; ?></strong>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Cidade</p>
                    <strong style="color: #666;"><?php echo $business_city; ?></strong>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Estado</p>
                    <strong style="color: #666;"><?php echo $business_state; ?></strong>
                </div>

            </div>

            <br><br>
            <hr>
            <br><br>


            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">

                    <span style="font-size: 20px; color: #666; font-weight: 600;">
                        Contrato Link contabilidade
                    </span>

                    <br><br><br>

                    <div id='container_document' style="border-radius: 10px; border: 1px solid #d5dde2; background-color: #fff; font-size: 12px; padding: 40px; color: #666; height: 600px; overflow: scroll; overflow-x: hidden;">

                        <!-- <iframe src="/img/contrato-link-contabilidade.pdf" border="0" width="100%" height="100%" style="border: none; border-radius: 10px;"></iframe> -->

                        <h4><b>CONTRATO DE PRESTAÇÃO DE SERVIÇOS DE CONTABILIDADE E ESCRITA FISCAL</b></h4>
                        <br><br>
                        <p>LINK ASSESSORIA CONTÁBIL EIRLI, inscrita no CNPJ sob o n° 05.857.936/0001-57, situada na Av. Dr. João Batista Soares de Queiroz Jr, nº 235, no bairro Jd. das Indústrias, no município de São José dos Campos, no Estado de São Paulo, doravante denominada LINK CONTABILIDADE CONSULTIVA, neste ato representada por sua representante legal Fabrícia Cabral Paparele, registrada no CPF sob o n° 159.440.904-08 e no CRC sob o n° 1SP 225868/O-0, vem apresentar os termos do contrato de prestação de serviços de abertura de empresa, escrita contábil, fiscal e de folha de pagamento, o qual, após lido e aceito, passa a produzir efeito entre as partes, quais sejam, a LINK CONTABILIDADE CONSULTIVA e 
                        <?php echo "<b>".$business_razao."</b>"; ?>, inscrito no CNPJ sob o nº 
                        <?php echo "<b>".$business_cnpj."</b>"; ?>, situada(o) à Rua 
                        <?php echo "<b>".$business_address.", ".$business_number.", ".$business_complement.", ".$business_district."</b>"; ?>, CEP 
                        <?php echo "<b>".$business_zipcode."</b>"; ?>, 
                        <?php echo "<b>".$business_city." / ".$business_state."</b>"; ?>, representada(o) por seu representante legal 
                        <?php echo "<b>".$user_name." ".$user_lastname."</b>"; ?>, inscrito no CPF sob o nº 
                        <?php echo "<b>".$user_cpf."</b>"; ?> doravante denominada(o) CLIENTE.  
                        </p>
                        <p>
                            CLÁUSULA 1ª - DO OBJETO: Este contrato tem por objeto a prestação de serviços de contabilidade, relacionando os de constituição/abertura de empresa, escrita contábil, fiscal e de folha de pagamento (quando aplicável) a serem prestados pela CONTRATADA, bem como todas as demais informações inerentes à relação contratual entre as partes.  
                        </p>   
                        <p>
                        CLÁUSULA 2ª - DOS SERVIÇOS DE CONSTITUIÇÃO DE EMPRESA: Especificamente, se contratado o serviço de CONSTITUIÇÃO/ABERTURA DE EMPRESAS: Os serviços a serem prestados são aqueles referentes à constituição/abertura de empresas em geral enquadradas como: Microempreendedor Individual (MEI), Microempresas (ME), Empresas de Pequeno (EPP), Empresas de Médio Porte (EMP) e demais empresas com atividades permitidas ao enquadramento no regime de tributação do Simples Nacional, Lucro Presumido ou Lucro Real, tais como:

                        </p>
                        <p>
                            2.1- CONSULTA EM ÓRGÃOS PÚBLICOS
                            <br>
                            <br> 2.1.1. Realização da consulta prévia de localização na Prefeitura (quando disponível de forma online);  
                            <br>2.1.2. Realização da consulta de viabilidade de nome na Junta Comercial;
                        </p>
                        <p>2.2- ELABORAÇÃO DOS DOCUMENTOS</p>
                        <p>
                            2.2.1 - Contrato Social/Requerimento de Empresário/Estatuto/Ata de Fundação; 
                            <br>2.2.2 - Documento Básico de Entrada (DBE) na Receita Federal;  
                            <br>2.2.3 - Demais documentos obrigatórios para registro na Junta Comercial ou Cartório de Pessoa Jurídica, Prefeitura Municipal, Caixa Econômica Federal, Previdência Social e Estado;  
                            <br>2.2.4 - Solicitação de Enquadramento no Simples Nacional, quando aplicável;
                            <br>2.2.5 - Solicitação de Enquadramento como ME ou EPP, quando aplicável. 
                        </p>
                        <p> 2.3- PROTOCOLO DOS DOCUMENTOS</p>
                        <p>Devido à natureza da prestação de serviços da Contabilidade Digital, o protocolo presencial dos documentos nos órgãos públicos envolvidos no processo de abertura de empresa somente será executado pela CONTRATADA ou por seus parceiros, caso a CONTRATANTE efetue a contratação deste serviço em apartado, mediante o pagamento do valor estipulado na tabela de serviços listada na Plataforma Link na área exclusiva da CONTRATANTE.</p>
                        <p>2.4 - SERVIÇOS SOCIETÁRIOS NÃO INCLUSOS:</p>
                        <p>
                            2.4.1 -  Registro da empresa e/ou sócios em órgãos de classe (exemplo: CRM, CRA, CRC, CREA, CRO, OAB, etc);
                            <br>2.4.2 - Coordenação de vistorias e avaliações do Corpo de Bombeiros e demais órgãos, tais como ANVISA, Secretaria do Meio Ambiente, etc.;
                            <br>2.4.3 - Projeto técnico para obtenção do alvará;
                            <br>2.4.4 - Demais serviços ou atividades não descritas no item 2.2.
                        </p>               
                        <p>CLÁUSULA 3ª - DOS SERVIÇOS MENSAIS DE ESCRITA CONTÁBIL, FISCAL, FOLHA DE PAGAMENTO E CONSULTIVA: Os serviços a serem prestados pela CONTRATADA são aqueles referentes à escrituração contábil, fiscal, folha de pagamento e consultiva, tais como:</p>
                        <p>3.1. ESCRITA CONTÁBIL</p>
                        <p>
                            3.1.1 - Classificação da contabilidade de acordo com as normas e princípios contábeis vigentes dentro do padrão ITG 1000, até o dia 31 (trinta e um) de março do ano subsequente, mediante o recebimento de todos os documentos descritos na cláusula 10ª, itens 10.10 e 10.11;  
                            <br>3.1.2 - Emissão dos relatórios diário, razão e balancete, a serem disponibilizados até o dia 31 (trinta e um) de março do ano subsequente;  
                            <br>3.1.3 - Emissão do balanço patrimonial e da demonstração do resultado do exercício, a ser realizada até o dia 31 (trinta e um) de março do ano subsequente;  
                            <br>3.1.4 - Elaboração e entrega das declarações anuais, como o SPED ECD e ECF, a ser realizada até a data limite definida pelo governo.
                            <br>3.1.5 -  Atendimento  das demais  exigências  previstas na  legislação, bem  como das  exigências documentais de eventuais procedimentos fiscais somente enquanto a CONTRATANTE mantiver o contrato de prestação de serviços ativo.
                            <br>3.1.6 – Opcionalmente, a critério da CONTRATADA, em relação as cláusulas 3.1.1 a 3.1.3, elaboração do Livro Caixa exigido pelo parag. 2º do art. 26 da Lei Complementar 123/2006, no caso da CONTRATANTE não se encontrar na situação escrita no parágrafo 2º do art. 14 da referida Lei.
                        </p>
                        <p> 3.2- ESCRITA FISCAL</p>
                        <p>
                            3.2.1 - Escrituração dos registros fiscais e elaboração dos livros obrigatórios, declarações e guias de recolhimento dos tributos devidos, com entrega em até 02 (dois) dias úteis antes do vencimento de cada obrigação, mediante o recebimento dos arquivos digitais dos documentos fisco-contábeis até o dia 04 (quatro) do mês subsequente; 
                            <br>3.2.2 - Orientação acerca do cumprimento das obrigações acessórias de natureza fiscal, como o código de serviço nas NFSe e CFOP nas NFe e NFCe.
                            <br>3.2.3 - Atendimento das demais exigências previstas na legislação, bem como das exigências documentais de eventuais procedimentos fiscais somente enquanto a CONTRATANTE mantiver o contrato de prestação de serviços ativo.  
                        </p>
                        <p>3.3- FOLHA DE PAGAMENTO</p>
                        <p>
                            3.3.1 - Registro de admissão de empregados, formalização dos contratos de trabalho, envio de etiquetas para que a CONTRATANTE assine a CTPS e transmissão das informações ao eSocial, em até 03 (três) dias úteis, mediante o recebimento pela CONTRATADA dos arquivos digitais dos documentos do profissional admitido, que deve ser feito até 03 (três) dias úteis antes do início das atividades; 
                            <br>3.3.2 - Geração mensal da folha de pagamento dos empregados, de pró-labore dos sócios e recibos de pagamento a autônomos, além da emissão de declarações e guias de recolhimento de tributos decorrentes, recibos de salário família, guia de recolhimento sindical e demais obrigações trabalhistas e previdenciárias, como o eSocial, com entrega em até  02 (dois) dias úteis antes do vencimento de cada obrigação, mediante o recebimento pela CONTRATADA dos eventos variáveis até o dia 25 (vinte e cinco) do mês corrente; 
                            <br>3.3.3 - Emissão de comunicado e recibo de férias de empregados e transmissão das informações ao eSocial, em até 03 (três) dias úteis que antecedem os 30 (trinta) dias de gozo das férias;
                            <br>3.3.4 - Emissão de comunicado de demissão de empregados, geração da rescisão trabalhista, emissão das guias de recolhimento de tributos decorrentes, preparação de documentos para o seguro desemprego e transmissão das informações ao eSocial, em até 05 (cinco) dias úteis após o recebimento da solicitação da CONTRATANTE;
                            <br>3.3.5 - Atendimento das demais exigências previstas na legislação, bem como das exigências documentais de eventuais procedimentos fiscais somente enquanto a CONTRATANTE mantiver o contrato de prestação de serviços ativo.
                        </p>
                        <p>
                            3.4 - CONSULTIVA: Serviços específicos somente para contratação da Contabilidade Consultiva Digital:
                            <br>3.4.1 - Apoio gerencial na tomada de decisão através de reuniões semestrais pré-agendadas para 
                            <br>3.4.2 - Emissão do balanço patrimonial e da demonstração do resultado do exercício, em até 60 (sessenta) dias após o recebimento de todos os documentos descritos nas obrigações da CONTRATANTE;
                            <br>3.4.3 - Apuração dos índices contábeis de endividamento, liquidez, investimento e rentabilidade, análise vertical e horizontal do balanço patrimonial e da demonstração do resultado do exercício, em até 60 (sessenta) dias após a entrega de todos os documentos descritos nas obrigações da CONTRATANTE.
                        </p>
                        <p>CLÁUSULA 4ª - DOS PLANOS DE SERVIÇOS:</p>
                        <p>
                            4.1 - A CONTRATADA disponibiliza 02 (dois) tipos de planos de serviços, cuja opção é feita pela CONTRATANTE no ato da contratação, são eles:
                            <br>4.1.1 - CONTABILIDADE DIGITAL inclui todas as obrigações para manter a empresa legalizada, ferramenta chamada “Gestão de Fluxo de Caixa”, consultoria empresarial gratuita por vídeo conferencia com duração máxima de 1h com cada parceiro da CONTRATADA. Os assuntos das consultorias estarão disponibilizados no site, podendo sofrer alteração sem prévio aviso.
                            <br>4.1.2 - CONTABILIDADE CONSULTIVA DIGITAL inclui todos os itens mencionados no item 4.1.1 mais o sistema de “Gestão Empresarial”.
                            <br>
                            <br>4.2 - A CONTRATANTE enquadrada como Empregador Doméstico, não terá acesso as ferramentas “Gestão de Fluxo de Caixa” e “Gestão Empresarial”.
                        </p>
                        <p>CLÁUSULA 5ª - DA PLATAFORMA:</p>
                        <p>5.1 - A CONTRATADA, na qualidade de legítima licenciadora, concede gratuitamente à CONTRATANTE o direito temporário, não incluso, opcional, limitado, intrasferível e não exclusivo do uso do Sistema (software) denominado Plataforma Link, disponibilizado na nuvem de propriedade da CONTRATADA, em que faz o armazenamento de documentos e o gerenciamento das informações da CONTRATANTE.</p>
                        <p>5.2 - A CONTRATANTE, aceita e reconhece que a Plataforma Link e o material nela disponível (“Documentação”), e quaisquer modificações, atualizações e novas versões são protegidos pela legislação de direitos autorais e demais direitos de propriedade intelectual e de software.</p>
                        <p>5.3 - O uso da Plataforma Link ficará restrito ao seu cadastrado no website, a quantidade de usuários e/ou acessos estará restrita àquela quantidade informada no momento da contratação de nossos serviços.</p>
                        <p>5.4 - O presente contrato não gera direitos de aquisição ou quaisquer outros direitos para além do uso na forma estabelecido no item 5.3 ou outros contidos neste contrato sobre Plataforma Link, sendo expressamente proibido que a CONTRATANTE ou terceiro: i) transfiram, comercializem,  sublicenciem,  emprestem,  aluguem,  arrendem ou,  de  qualquer  outra  forma, alienem a Plataforma Link, salvo autorização expressa da CONTRATADA; ii) efetuem modificações, acréscimos ou derivações da Plataforma Link, por si próprio ou através da contratação de terceiros; iii) façam engenharia reversa, descompilem ou desmontem a Plataforma Link, ou tomem qualquer outra medida que possibilite o acesso ao código fonte do mesmo, sem o consentimento prévio e por escrito da CONTRATADA; e iv) copiem, total ou parcialmente, a Plataforma Link, ou sua “Documentação”, ou usar de modo diverso do expressamente estipulado no presente contrato.</p>
                        <p>5.5 - Caso a CONTRATANTE introduza quaisquer modificações ou alterações na Plataforma Link, nenhuma responsabilidade poderá ser direcionada à CONTRATADA e seu contrato estará sujeito à rescisão imediata, sem que a CONTRATANTE tenha direito ao aviso prévio.</p>
                        <p>5.6 - Respeitada toda a legislação aplicável, a CONTRATADA não oferecerá garantias e condições além daquelas identificadas expressamente neste Contrato, sejam garantias ou condições de não violação de direitos, de adequação da Plataforma Link ou dos serviços para o comércio e/ou para fins determinados.</p>
                        <p>5.7 - A CONTRATADA garante que a Plataforma Link funcionará de acordo com a Documentação fornecida pela CONTRATANTE. Esta garantia não se aplicará: i) se uma falha na Plataforma Link resultar de acidente, violação, mau uso ou culpa exclusiva da CONTRATANTE ou de terceiros; ii) na ocorrência de problemas, erros ou danos causados por uso concomitante de outros softwares que não tenham sido licenciados ou desenvolvidos com consentimento da CONTRATADA; e iii) em decorrência de qualquer descumprimento do presente Contrato pela CONTRATANTE.</p>
                        <p>5.8 - A CONTRATANTE declara sua ciência e concordância de que o funcionamento adequado da Plataforma Link dependerá de sistemas operacionais e de infraestrutura, tais como acesso à Internet e serviços de telecomunicações, fornecidos por terceiros, cuja responsabilidade de contratação é exclusivamente da CONTRATANTE, não podendo a CONTRATADA ser responsabilizada pelo funcionamento inadequado da Plataforma Link em razão de problemas decorrentes de tais sistemas operacionais e infraestrutura fornecidos por terceiros, inclusive equipamentos e navegadores de internet.</p>
                        <p>5.9 - A CONTRATADA envidará todos os seus esforços para resolver, interromper ou cessar, problemas decorrentes de modificações, acréscimos, atualizações, customizações e novas versões da Plataforma Link. A CONTRATANTE, entretanto, concorda e reconhece que eventuais problemas na Plataforma Link decorrentes de ataques de programas de terceiros à Plataforma Link, com ou sem o seu conhecimento/consentimento, incluindo vírus, não serão de responsabilidade da CONTRATADA.</p>
                        <p>5.10 - A responsabilidade total da CONTRATADA por danos de qualquer espécie decorrentes da licença e do fornecimento da Plataforma Link e da “Documentação”, é limitada aos danos diretos efetivamente incorridos e comprovados pela CONTRATANTE, e em nenhum caso excederá a quantia paga pela CONTRATANTE durante a vigência deste Contrato.</p>
                        <p>5.11 - A Plataforma Link disponibilizada é uma ferramenta destinada a comunicações entre CONTRATANTE  e  a  CONTRATADA  e  ao controle da CONTRATANTE  referente:  contas a pagar, contas a receber, relatórios de pagamentos, relatórios de recebimentos; saldos de contas bancárias diariamente de forma simples e prática, conciliação bancária através da importação de arquivos OFX ou Excel, cadastro de clientes e fornecedores, relatórios financeiro e contábil, sistema de gestão eletrônica de documentos da empresa compartilhados com a contabilidade e solicitação de atendimento ao seu contador.</p>
                        <p>
                            5.11.1 - A Plataforma Link contempla dentre outros, dois módulos a depender do plano contratado conforme itens a seguir, chamados: 
                            <br>5.11.1.1 - “Gestão de Fluxo de Caixa” para fins de controle de receitas e despesas, conciliações bancárias, relatórios gerenciais e controle de fluxo de caixa. 
                            <br>5.11.1.2 - “Gestão Empresarial” para fins de controle de receitas e despesas, contas a pagar e receber, conciliações bancárias, relatórios gerenciais, controle de fluxo de caixa, gráficos e indicadores financeiros.
                        </p>
                        <p> 5.12 - A CONTRATADA disponibiliza na Plataforma Link na área exclusiva da CONTRATANTE a possibilidade de contratar diretamente com nossos parceiros, serviços como abertura de Conta Digital, aquisição de Certificado Digital e outros que surjam ou que estejam disponíveis durante a vigência deste contrato com condições especiais e, às vezes, com integração com nossa plataforma, para que a CONTRATANTE tenha mais facilidade na gestão de seus negócios (“Serviços em Parceria”).</p>
                        <p>
                            5.12.1 - A CONTRATADA não se responsabiliza pelos serviços prestados por nossos parceiros, nem pela emissão de suas correspondentes Notas Fiscais.
                        </p>
                        <p>CLÁUSULA 6ª - DA COMUNICAÇÃO E SEGURANÇA DAS INFORMAÇÕES:</p>
                        <p>6.1 - A comunicação entre CONTRATANTE e CONTRATADA deverá ser realizada através da Plataforma Link, ou na ausência desta pelo e-mail fornecido pela CONTRATANTE no seu cadastro.</p>
                        <p>
                            6.1.1 - A CONTRATANTE deverá manter suas informações atualizadas, verdadeiras e precisas na Plataforma Link para garantir a boa prestação de serviços.
                            <br>6.1.2 - A CONTRATADA poderá solicitar ou instituir procedimentos para confirmar a identificação da CONTRATANTE, conforme exclusivo critério da CONTRATADA.
                        </p>
                        <p>6.2 - Ao assinar este Contrato, a CONTRATANTE estará autorizando a CONTRATADA a acessar e usar todas as informações fornecidas pela CONTRATANTE durante o cadastro ou durante o atendimento e a prestação de serviços.</p>
                        <p>6.3 - A CONTRATADA não irá compartilhar as informações da CONTRATANTE com terceiros, salvo se:</p>
                        <p>
                            6.3.1 - expressamente autorizado pela CONTRATANTE;  
                            <br>6.3.2 - forem solicitadas por órgãos governamentais, administrativos ou judiciais;
                            <br>6.3.3 - forem solicitadas pelo CRC ou pelo CFC; 
                            <br>6.3.4 - forem necessárias para instruir processo administrativo ou judicial;
                            <br>6.3.5 - forem necessárias - e no limite da necessidade - para contratar empresas especializadas em cobrança no caso de inadimplência por parte da CONTRATANTE.
                            </p>      
                        <p>CLÁUSULA 7ª - DOS SERVIÇOS EXTRAORDINÁRIOS:</p>
                        <p>7.1 - A CONTRATADA declara que oferece outros serviços contábeis, fiscais, trabalhistas e societários, os quais não estão incluídos nas cláusulas 1ª e 2ª, podendo ser contratados mediante acordo e solicitação expressa via Plataforma Link ou na ausência dela através do e-mail administracao@linkcontabilidade.com.br, definidos como serviços extraordinários, serão cobrados conforme nova proposta comercial e valores constantes da tabela de serviços disponibilizada na área exclusiva da CONTRATANTE no site da CONTRATADA.</P>
                            <P>
                            7.1.1 - São considerados serviços extraordinários ou para-contábeis, exemplificativamente a regularização de pendências anteriores ao início do contrato, recálculo de guias de recolhimento, mesmo que dentro do período de vigência do contrato; constituição/abertura de filiais; alteração contratual; encerramento/baixa da empresa; registro da empresa e/ou sócios em órgãos de classe (exemplo: CRM, CRA, CRC, CREA, CRO, OAB, etc); coordenação de vistorias e avaliações do Corpo de Bombeiros e demais órgãos, tais como ANVISA, Secretaria do Meio Ambiente, etc.; projeto técnico para obtenção do alvará; certidões negativas do INSS, FGTS, Federais, ICMS, ISS quando não emitida pela internet; obtenção de certidão negativa de falência ou protestos; diligencias presencias em órgãos públicos e privados; acompanhamento de empregado em homologação de rescisão contratual; parcelamento de impostos e contribuições; atendimento a fiscalizações de natureza fiscal ou trabalhista; contratação e renovação de PPRA, PCMSO e PPP; a defesa de fiscalizações tributárias ou trabalhistas; participação em audiências administrativas e judiciais; autenticação/registro de livros; encadernação de livros societários, fiscais e contábeis; declaração de imposto de renda pessoa física dos sócios; preenchimento de fichas cadastrais, IBGE, SICAF; cadastro no município de interesse CPOM (Cadastro de Prestadores de Outros Municípios); declaração comprobatória de percepção de rendimentos (Decore); planejamento tributário; consultorias; conversão de MEI para ME e demais listados na área exclusiva da CONTRATANTE no site da CONTRATADA.
                            <br>7.1.2 - Para emissão de certidões negativas, caso haja pendências que impeçam a emissão da certidão, sendo tais pendências relativos a períodos fora da responsabilidade da CONTRATADA, serão propostos honorários específicos para regularização das mesmas sem prejuízo dos honorários já pagos para contratação dos serviços.
                            </p>
                        <p>CLÁUSULA 8ª - DAS CONDIÇÕES DE EXECUÇÃO DOS SERVIÇOS: Os serviços serão executados nas dependências da CONTRATADA, em obediência às seguintes condições:</p>
                            <p>8.1 - A execução dos serviços fica condicionada à entrega correta e em tempo hábil de todos os arquivos digitais dos documentos e informações descritos na cláusula 10ª, itens 10.10 e 10.11, não cabendo à CONTRATADA nenhuma responsabilidade no caso de recebimento intempestivo dos documentos e facultando a mesma a cobrança de honorários adicionais para realizar os serviços depois dos prazos avençados.</p>  
                            <p>8.2 - Os serviços da CONTRATADA se limitam às atividades econômicas previstas em contrato, não sendo estendidos para outros segmentos ou empresas do grupo sem a realização de um novo diagnóstico e a assinatura de um novo contrato de prestação de serviços.</p>
                            <p>8.3 - O presente contrato tem escopo fechado, ou seja, a CONTRATADA se compromete a realizar estritamente os serviços que estão descritos nas cláusulas 1ª, 2ª e 3ª conforme plano contratado. Outros tipos de serviços, mesmo que correlatos, chamados de serviços extraordinários mencionados na cláusula 7ª, item 7.1.1 são de responsabilidade exclusiva da CONTRATANTE e não estão contemplados no plano de serviços, podendo ser contratados a parte conforme tabela de serviços extraordinários listada na Plataforma Link na área exclusiva da CONTRATANTE.</p> 
                            <p>8.4 - Por se tratar de objeto social da sociedade, sujeita ao controle permanente e de informações ao COAF, a CONTRATANTE declara ter pleno conhecimento das obrigações da CONTRATADA perante ao referido órgão de controle e fiscalização, autorizando, desde já, a CONTRATADA a prestar todas as informações necessárias e previstas nas instruções do COAF (Conselho de Controle de Atividades Financeiras).</p>
                            <p>8.5 - A CONTRATANTE, além das empresas do mesmo grupo econômico, se compromete a não contratar quaisquer empregados da CONTRATADA durante a vigência deste contrato e pelo período de 24 (vinte e quatro) meses após o seu término. Em caso de descumprimento desta norma, a CONTRATANTE ficará sujeita ao pagamento de multa equivalente a 10 (dez) vezes o valor dos honorários vigentes à época.</p>
                            <p>8.6 - Todos os documentos entregues pela CONTRATANTE, deverão ser feitos através da Plataforma Link disponibilizada pela CONTRATADA, na falta dela através do e-mail administracao@linkcontabilidade.com.br</p>
                        <p>CLÁUSULA 9ª - DOS DEVERES DA CONTRATADA:</p>  
                            <p>9.1 - A CONTRATADA desempenhará os serviços descritos na cláusula 1ª com todo zelo, diligência e honestidade, observada a legislação vigente, resguardando os interesses da CONTRATANTE, sem prejuízo a dignidade e independência profissionais, sujeitando-se, ainda, às normas do Novo Código de Ética Profissional do Contador, aprovado pela NBC PG Nº  001, de 07 de fevereiro de 2019. </p>
                            <p>9.2 - A CONTRATADA se responsabilizará por todos os documentos a ela entregues pela CONTRATANTE, enquanto permanecerem sob sua guarda para a consecução dos serviços pactuados.</p>
                            <p>9.3 - A CONTRATADA não se responsabilizará pela guarda dos arquivos digitais das notas fiscais eletrônicas recebidas pela CONTRATANTE, de seus fornecedores e nem pelas notas fiscais eletrônicas emitidas pela CONTRATANTE.</p>
                            <p>9.4 - A CONTRATADA não assume nenhuma responsabilidade pelas consequências de informações, declarações ou documentação inidôneas ou incompletas que lhe forem apresentadas bem como por omissões próprias da CONTRATANTE ou decorrente do desrespeito à orientação prestada.</p>
                            <p>9.5 - No caso de transferência dos serviços contábeis da CONTRATANTE, a CONTRATADA poderá a sua escolha e mediante prévia aprovação de orçamento por parte da CONTRATANTE, promover a elaboração e entrega de informativos anuais do ano base da transferência, caso tais serviços não sejam feitos pelo escritório contábil anteriormente contratado.</p>
                            <p>9.6 - A CONTRATADA compromete-se a emitir avisos eletrônicos por meio da área de comunicação da Plataforma Link e por meio de mensagem eletrônica enviada para o e-mail cadastrado pelo usuário responsável da CONTRATANTE, com antecedência mínima de 02 (dois) dias úteis para pagamento dos tributos, contribuições, taxas dentre outros aos quais a CONTRATANTE estiver sujeita, bem como, quaisquer outros pagamentos ou obrigações que devam ser cumpridos pela CONTRATANTE, incluindo os boletos mensais dos honorários contábeis.</p>
                        <p>CLÁUSULA 10ª - DOS DEVERES DA CONTRATANTE:</p>  
                            <br>10.1 - A CONTRATANTE ao concordar com os termos do presente contrato, compromete-se a:  
                            <br>10.1.1 - Coletar documentos físicos ou digitais com o contador responsável pelas competências anteriores e enviar digitalmente pela Plataforma Link, na área exclusiva da CONTRATANTE, no prazo de 60 (sessenta) dias contados a partir da data de aceite deste contrato.  
                        <P>10.2 - No ato da aceitação deste contrato a CONTRATANTE, através de seu representante legal, declara que as informações que serão fornecidas para a escrituração e elaboração das demonstrações contábeis, obrigações acessórias, apuração de tributos e arquivos eletrônicos exigidos pela fiscalização federal, estadual, municipal, trabalhista e previdenciária são fidedignas e precisas.</P>    
                        <p>10.3 - A CONTRATANTE é responsável pela veracidade de todas as informações enviadas para a CONTRATADA seja pela Plataforma Link, por correio eletrônico, whatsapp ou qualquer outro meio de comunicação que por ventura a CONTRATANTE utilize.</p>
                        <p>10.4 - A CONTRATANTE declara não existir quaisquer fatos ocorridos até a data de contratação dos serviços da CONTRATADA que afetam ou possam afetar as demonstrações contábeis ou, ainda: a continuidade das operações da empresa, comprometendo-se a declará-los imediatamente caso venham a ocorrer durante o período de vigência deste contrato.</p>
                        <p>10.5 -  A CONTRATANTE declara que não realizou e nem realizará nenhum tipo de operação que possa ser considerada ilegal, frente a legislação vigente; bem como não ter havido violação de leis, normas e regulamentos cujo os efeitos deveriam  ser  considerados  para  divulgação das demonstrações contábeis, ou mesmo dar origem ao registro de provisão para contingências passivas.</p>
                        <p>10.6 - A CONTRATANTE deverá limitar o acesso da Plataforma Link disponibilizado pela CONTRATADA, aquele cujo o acesso seja necessário para utilização dos serviços.</p>
                        <p>10.7 - A CONTRATANTE é a única responsável pelo gerenciamento de sua conta na Plataforma Link disponibilizada pela CONTRATADA, pelas informações constantes no sistema e pelo acesso a mesma.</p>
                        <p>10.8 - A CONTRATANTE é responsável por acessar regularmente a Plataforma Link, Sistema Gestão Fluxo de Caixa ou Gestão Empresarial e a Caixa Postal referente ao endereço eletrônico do usuário responsável fornecido quando da contratação dos serviços de contabilidade digital afim de poder tomar ciência dos comunicados, avisos e lembretes enviados pela equipe da CONTRATADA, principalmente em relação as datas de vencimentos para pagamentos de tributos, contribuições e taxas dentre outros, conforme disposto no itens 9.6.</p>
                        <p>10.9 - A CONTRATANTE deverá assegurar a correta classificação fiscal dos produtos industrializados conforme NCM (Nomenclatura Comum do Mercosul), quando da industrialização de produtos. O ajuste Sinief 11/09 e 12/09 traz a obrigatoriedade da informação do NCM nas NF-e Modelo 55, a CONTRATANTE é responsável pelo cumprimento dessa obrigação onde deverá informar o NCM a cada nota fiscal emitida, bem como, de analisar e exigir dos fornecedores que encaminhe as notas fiscais com NCM das NF-e das aquisições realizadas.</p>
                        <p>10.10 - A CONTRATANTE ficará responsável pelo envio mensal dos extratos bancários no formato OFX, PDF ou Excel gerados no site do seu banco até o dia 04 (quatro) do mês subsequente, preferencialmente através da Plataforma Link, ou em último caso pelo e-mail:  administracao@linkcontabilidade.com.br podendo a CONTRATADA restaurar o arquivo em seu programa contábil.</p>
                        <p>10.11 - A CONTRATANTE se compromete a fornecer todas as informações e arquivos eletrônicos dos documentos solicitados para a execução dos serviços, a serem disponibilizados por meio de serviço de compartilhamento de arquivos digitais através da Plataforma Link ou na ausência dela pelo e-mail administracao@linkcontabilidade.com.br , nos prazos ajustados, de forma organizada, sendo compostos por:</p>
                        <p>
                            10.11.1 - Extratos de todas as contas bancárias, inclusive cartões de crédito, poupança e aplicações, e arquivos digitalizados dos documentos relativos aos movimentos financeiros, tais como notas fiscais de compra, notas fiscais de serviços tomados, recibos de aluguel, recibos de pagamentos diversos, boletos bancários, borderôs de cobrança, contratos de locação, contratos diversos, apólice de seguros, títulos descontados e contratos de crédito dentre outros, até o dia 04 (quatro) do mês subsequente;
                            <br>10.11.2 - Relatório de movimentação financeira de todas as contas bancárias e caixa, devidamente conciliadas, identificando a cliente/fornecedor, categoria do recebimento/pagamento, descrição, data de emissão, data de vencimento, data de pagamento e valor, até dia 04 (quatro) do mês subsequente;
                            <br>10.11.3 - Relação de proventos e descontos a serem lançados na folha de pagamento dos funcionários, até o dia 25 (vinte e cinco) do mês corrente.
                            <br>10.11.4 - Comunicação para concessão de férias, admissão ou rescisão contratual, até 03 (três) dias úteis de antecedência em relação a data de referência; 
                            <br>10.11.5 - Comunicação de afastamento de empregado por acidente de trabalho, até 02 (duas) horas após a ocorrência do acidente;
                            <br>10.11.6 - Arquivo SPED Fiscal, SINTEGRA ou XML das notas fiscais de entrada e de saída, no caso de empresas com atividade de comércio e indústria, até o dia 04 (quatro) do mês subsequente;
                            <br>10.11.7 - Notas fiscais de serviços tomados que tenham impostos retidos destacados na nota, até 03 (três) dias úteis depois de recebida a nota fiscal;
                            <br>10.11.8 - Inventário de estoques trimestral para empresas tributadas no lucro real e anual para as demais empresas, no caso de empresas com atividade de comércio e indústria, até 10 (dez) dias após o encerramento do período indicado neste item;
                            <br>10.11.9 - Analisar e dar parecer, no prazo máximo de 05 (cinco) dias, sobre a solicitações feitas por escrito pela CONTRATADA, referente a casos omissos e não previstos neste contrato, cuja a solução seja necessária a execução dos serviços. Caso não seja dado a resposta no prazo supracitado, presumisse aceitas as solicitações da CONTRATADA.
                        </p>
                        <p>10.12 - A CONTRATADA se reserva ao direito de não executar os serviços listados nas cláusulas 2ª, 3ª e 7ª em casos de omissão, envio incompleto ou não envio das informações listadas na cláusula 10ª, itens 10.1.1, 10.10, 10.11 e 10.11.1 a 10.11.9.</p>
                        <p>10.12.1 - O disposto no caput não exime a CONTRATANTE do pagamento das mensalidades conforme disposto na cláusula 11ª.</p>   
                        <p>10.13 - A indisponibilidade da Plataforma Link não isenta a responsabilidade da CONTRATANTE no envio dos documentos, devendo os mesmos serem remetidos para o e-mail administracao@linkcontabilidade.com.br.</p>
                        <p>10.14 - Caso a CONTRATANTE não registre mensalmente os dados da documentação fiscal-contábil na Plataforma Link, conforme descrito na cláusula 10ª, itens 10.10 e 10.11, necessários para realização dos serviços de escrita contábil, fiscal e de folha de pagamento, a CONTRATADA ficará isenta de qualquer tipo de ônus que possa advir desta falha, inclusive, da sua responsabilidade de efetuar a contabilidade da empresa da CONTRATENTE.</p>
                        <p>10.15 - A CONTRATANTE se compromete a enviar um profissional capacitado aos treinamentos, palestras e eventos de atualização realizada pela CONTRATADA. Caso haja necessidade de repetir os referidos treinamentos, serão cobrados da CONTRATANTE os valores conforme tabela de serviços listada na Plataforma Link na área exclusiva da CONTRATANTE.</p>
                        <p>10.16 - Obriga-se a CONTRATANTE a fornecer à CONTRATADA todos os dados, documentos e informações que se façam necessários ao bom desempenho dos serviços ora contratados, não cabendo nenhuma responsabilidade à CONTRATADA em acaso de documentos recebidos intempestivamente, incompletos e inidôneos.</p>
                        <p>10.17 - Fica comprovada a ciência da informação pela CONTRATANTE, na assinatura de protocolo de entrega de circulares, confirmação de leitura da Plataforma Link, de e-mail’s, whatsapp, skype, bem como na comprovação da comunicação dos eventos realizados pela CONTRATADA.</p>
                        <p>10.18 - A CONTRATANTE se responsabilizará pela guarda dos arquivos digitais no formato XML das notas fiscais eletrônicas recebidas de seus fornecedores e pelas notas fiscais eletrônicas por ela emitidas.</p>
                        <p>10.19 - A CONTRATANTE obriga-se a atender os requisitos mencionados, além dos prazos e observações descritos nas cláusulas acima e no código civil.</p>
                        <p>10.20 - Obriga-se a CONTRATANTE a efetuar o pagamento em dia dos honorários ordinários mensais e de serviços extraordinários contratados.</p>
                        <p>10.21 - Participar da reunião de ambientação (integração), a ser agendada pela CONTRATADA, para conhecer a forma de execução dos serviços e esclarecer dúvidas.</p>
                        <p>10.22 - Fazer solicitações à CONTRATADA sempre através da Plataforma Link na área exclusiva da CONTRATANTE, somente na ausência desta fazer pelo e-mail – administracao@linkcontabilidade.com.br</p>
                        <p>10.23 - Seguir rigorosamente todas as orientações técnicas fornecidas pela CONTRATADA, eximindo-se esta das consequências do seu descumprimento.</p>
                        <p>10.24 - Emitir notas fiscais para todos os produtos comercializados ou serviços prestados, no momento da entrega ao cliente, independente da forma ou data de recebimento.</p>
                        <p>10.25 - Somente efetuar os pagamentos mediante a apresentação do documento fiscal idôneo, como a nota fiscal ou recibo de pagamento de autônomo com retenções tributárias.</p>
                        <p>10.26 -  Contratar a realização de PCMSO (Programa de Controle Médico de Saúde Ocupacional), PPRA (Programa de Prevenção de Riscos Ambientais) e PPP (Perfil Profissiográfico Previdenciário) com empresa especializada e homologada no eSocial, dentro dos prazos previstos em lei.</p>
                        <p>10.27 - Comparecer pessoalmente em todos os atos que dependam da presença do administrador, no prazo determinado, como para a emissão de certificados digitais.</p>
                        <p>10.28 - Providenciar certificado digital para a empresa no formato A1 e-CNPJ para que seja possível cumprir as obrigações acessórias, no caso de abertura de empresa os sócios deverão adquirir individualmente no formato A1 e-CPF.</p>
                        <p>10.29 - A CONTRATANTE compromete-se a fornecer os usuários e senhas de acesso de sua empresa nos sistemas da Prefeitura Municipal, Receita Federal do Brasil, Posto Fiscal Eletrônico (quando aplicável) e certificado digital tipo A1 (se já possuir) para a transmissão das informações contábeis da empresa junto aos sistemas dos respectivos órgãos.</p>
                        <p>10.30 - Informar caso tenha ocorrido o recebimento de valor em espécie superior a R$ 30.000,00 (trinta mil reais) até o dia 05 (cinco) do mês subsequente, para que a CONTRATADA possa entregar a DME (Declaração de Operações Liquidadas com Moeda em Espécie) no prazo legal.</p>
                        <p>10.31 - Informar caso a CONTRATANTE pretenda prestar serviço em município diferente do seu domicílio fiscal ou pretenda contratar serviço de empresa sediada em outro município, até 20 (vinte) dias úteis antes da contratação, para obter orientação se haverá necessidade de destacar ou reter ISS (Imposto Sobre Serviços de Qualquer Natureza) e/ou realizar o cadastro no município  de interesse. CPOM (Cadastro de Prestadores de Outros Municípios).</p>
                        <p>10.32 - No caso de contratação de constituição/abertura de empresa, para que os serviços constantes na cláusula 2ª sejam prestados, a CONTRATANTE se compromete a:</p>
                        <p>
                            10.32.1. - Enviar a documentação solicitada pela CONTRATADA para que sejam elaboradas as consultas e documentos descritos na cláusula 2ª, itens 2.1. e 2.2.
                            <br>10.32.2 - A CONTRATANTE assumi inteira responsabilidade pelo nome (razão social e nome fantasia) que der à empresa que será aberta pela CONTRATADA, bem como descrição das atividades econômicas que vai explorar, mesmo nos casos em que a CONTRATADA fizer sugestões, estas somente serão implementadas com o seu consentimento, que ocorrerá com o seu aceite ou assinatura no contrato social.
                            <br>10.32.3 - A CONTRATANTE declara estar ciente de que NÃO PODERÁ EXERCER ATIVIDADE EMPRESARIAL ANTES DA CONCLUSÃO DO REGISTRO, nos termos do art. 966 Código Civil.
                            <br>10.32.3.1 - Caso a CONTRATANTE dê início às atividades antes da conclusão do processo de abertura de empresas, a CONTRATADA não se responsabilizará por qualquer investimento, danos, custos, lucros cessantes, reclamações de terceiros, custo fornecimento de bens ou serviços substitutos e também por custo com paralisações, ou qualquer fato que possa-lhe resultar em prejuízo.
                            <br>10.32.4 - Realizar o protocolo do processo de abertura de empresa e eventuais documentos nos órgãos públicos (salvo campanhas promocionais especiais).
                            <br>10.32.5 - Realizar o registro da empresa nos órgãos que regulamentam a sua atividade comercial (se for necessário);
                            <br>10.32.6 - Cumprir todos os prazos indicados pela CONTRATADA através da Plataforma Link, por e-mail, por whatsapp, skype, bem como na comprovação da comunicação através dos eventos realizados;
                            <br>10.32.7 - Protocolar TODOS os documentos solicitados na forma, local e prazos indicados pela CONTRATANTE;
                            <br>10.32.8 - A atender toda e qualquer exigência, sempre que necessário e solicitado por quaisquer órgãos públicos, dentro do prazo concedido pela autoridade competente.
                            </p>
                        <p>10.33 - A CONTRATANTE se compromete a fornecer antes do encerramento de cada exercício; carta de responsabilidade da administração, conforme art. 2º da Resolução nº 987/03 do CFC (Conselho Federal de Contabilidade) disponibilazada na época oportuna na Plataforma Link na área exclusiva da CONTRATANTE.</p>

                        <p>CLÁUSULA 11ª - DA REMUNERAÇÃO:</p> 
                        <p>11.1 - Para a execução dos serviços constantes da cláusula 1ª a CONTRATANTE pagará à CONTRATADA os honorários profissionais correspondentes a R$ <Valor do Honorário> (<Valor por extenso>) mensais até o dia 15 de cada mês correspondentes a prestação de serviços que serão executados no mês subsequente, o que caracteriza serviços mensais pré-pagos, via cobrança bancária ou via recibo emitido e quitado no endereço da CONTRATADA.</p>
                        <p>11.2 - Os honorários pagos após a data avençada na cláusula 11ª, item 11.1 acarretarão à CONTRATANTE o acréscimo de multa de 2% (dois por cento), sem prejuízo de juros moratórios de 1% (um por cento) ao mês ou fração, acrescidos de correção monetária equivalente ao IGP-M da Fundação Getúlio Vargas, na ausência deste qualquer outro que venha a substitui-lo e que traduza uma correção adequada dos valores contratados.</p>
                        <p>11.3 - Os honorários mensais mencionados na cláusula 11ª, item 11.1 e honorários referentes aos serviços extraordinários mencionados na cláusula 7ª serão reajustados anualmente, tendo como data base o início de vigência do presente contrato, e automaticamente de acordo com a variação do salário mínimo nacional, o qual fica desde já eleito, ou, na ausência do mesmo pelo índice acumulado dos últimos 12 (doze) meses do IGP-M da Fundação Getúlio Vargas ou por qualquer outro que venha substituí-lo e que traduza uma correção adequada dos valores contratados.</p>
                        <p>11.4 - Haverá alteração automaticamente no honorário mensal caso seja alterado o critério de revisão que é determinado pela atividade da empresa (comércio/serviço/indústria), tipo de regime tributário (Simei/Simples Nacional/Lucro Presumido/Lucro Real), faixa de faturamento (conforme calculadora existente no site da CONTRATADA) e a soma dos números de vínculos de CPF na folha de pagamento de sócios, funcionários e autônomos da CONTRATANTE.</p>
                        <p>11.5 - Quando o resultado da somatória dos vínculos de CPF da folha de pagamento de sócios, funcionários, autônomos mais estagiários da CONTRATANTE ultrapassar 05 (cinco) será cobrado automaticamente o valor de R$ <?php echo number_format($total_month,2,".",""); ?> (<?php echo valorPorExtenso($total_month, true, false); ?>) por vínculo excedente a partir do mês de inclusão na folha de pagamento.</p>
                        <p>11.6 - Para atendimento ao acréscimo de serviços e encargos no final do exercício, a CONTRATANTE pagará à CONTRATADA o honorário adicional equivalente ao honorário mensal vigente a época, dividido em 02 (duas) parcelas iguais, vencíveis nos dias 20 de novembro e 20 de dezembro de cada exercício.</p>
                        <p>11.7 - Para a CONTRATANTE que fizer a adesão no site da CONTRATADA após e inclusive no mês de novembro até o mês de dezembro, deverá efetuar o pagamento do honorário adicional nos meses subsequentes a sua entrada, em duas parcelas iguais.</p>
                        <p>11.8 - No caso de transferência de contabilidade da CONTRATANTE, será cobrado 01 (uma) mensalidade correspondente ao plano contratado a título de pagamento do primeiro honorário para o início da responsabilidade técnica da CONTRATADA.</p>
                        <p>11.9 - No decorrer do exercício, caso haja rescisão dos serviços prestados pela CONTRATADA, a parcela adicional será devida proporcionalmente aos meses de vigência da avença.</p>
                        <p>11.10 - Os serviços solicitados pela CONTRATANTE não especificados na cláusula 1ª serão cobrados como extraordinários pela CONTRATADA em apartado conforme estipulado na cláusula 7ª e valores constantes na tabela de serviços extraordinários listada na Plataforma Link na área exclusiva da CONTRATANTE que serão fixos ou variáveis, cabendo às partes negociá-los, mediante Plataforma Link, aditamento de contrato e/ou autorização, via e-mail, whatsapp ou skype, conforme valor aprovado pela CONTRATANTE, englobando nessa previsão toda e qualquer inovação da legislação relativamente ao regime contábil, tributário, trabalhista ou previdenciário.</p>
                        <p>
                            11.10.1 - O pagamento relativo a contratação dos serviços extraordinários deve ocorrer no ato da contratação do serviço a ser prestado.
                            <br>11.10.2 - Os serviços extraordinários pagos após a data avençada no item 11.10.1 acarretarão à CONTRATANTE o acréscimo de multa de 2% (dois por cento), sem prejuízo de juros moratórios de 1% (um por cento) ao mês ou fração, acrescidos de correção monetária equivalente ao IGP-M da Fundação Getúlio Vargas ou na ausência deste qualquer outro que venha a substitui-lo e que traduza uma correção adequada dos valores contratados.
                        </p>
                        <p>11.11 - Caso os serviços contratados envolvam a recuperação de serviços não realizados ou atrasados com data anterior a responsabilidade técnica da CONTRATADA, a mensalidade será cobrada integralmente correspondentes a quantidade de meses a ser realizado e devido pela CONTRATANTE, desde o 1º (primeiro) mês de atualização.</p>
                        <p>11.12 - A CONTRATADA sempre priorizará a execução dos serviços e armazenamentos dos documentos relativos à CONTRATANTE em formato digital. Entretanto, caso não haja opção digital disponível a CONTRATANTE reembolsará à CONTRATADA o custo de todos os materiais utilizados na execução dos serviços ora ajustados, impressos fiscais, trabalhistas e contábeis, bem como livros fiscais, cópias reprográficas, autenticações, reconhecimento de firmas, custas, emolumentos e taxas exigidas pelos serviços públicos e viagens, sempre que utilizados e mediante recibo discriminado acompanhado dos respectivos comprovantes de desembolso. </p>

                        <p>CLÁUSULA 12ª - DA ABERTURA GRATUITA DE EMPRESAS:</p>
                            <br>12.1 - A CONTRATADA concederá desconto de 100% (cem por cento) na prestação de serviços de abertura de empresas que se enquadrem nas empresas definidas pela cláusula 2ª com exceção das empresas do terceiro setor, na condição de que a CONTRATANTE fidelize o atendimento da empresa aberta com a CONTRATADA, através de contrato de prestação de serviços pelo prazo mínimo de 12 (doze) meses, respeitadas a cláusula 14ª, itens 14.1 e 14.4.
                            <br>12.1.1 - A gratuidade mencionada no item acima não contempla eventuais taxas e emolumentos cobrados pelos órgãos públicos para fins de registro de empresas.
                        <p>12.2 - A mensalidade paga no ato da adesão refere-se ao honorário contábil do mês de abertura da empresa (obtenção do CNPJ), as demais mensalidades serão cobradas a partir do 1º (primeiro) dia do mês subsequente à liberação do CNPJ, de forma pré-paga conforme previsto na cláusula 11ª, item 11.1.</p>
                        <p>12.3 - No caso de solicitação de alterações no processo de abertura por parte da CONTRATANTE em data posterior ao envio dos documentos preparados por parte da CONTRATADA, haverá cobrança dos honorários conforme tabela de serviços listada na Plataforma Link na área exclusiva da CONTRATANTE.</p>
                        <p>12.4 - Caso a abertura da empresa não ocorra em até 90 (noventa) dias, a partir da data de adesão aos serviços, por falta de informação e entrega de documentação por parte da CONTRATANTE, o contrato será cancelado automaticamente por falta de condições de prosseguimento do processo.  Para retomar os  serviços, após o  referido período, será  necessária nova  adesão  dos serviços no site.</p>
                        <p>12.5 - Caso a CONTRATANTE opte unicamente pelo serviço de abertura da empresa, excluindo os serviços previstos na cláusula 3ª, será obrigatório o pagamento da taxa de abertura para não clientes no valor de R$ <?php echo number_format($total_month,2,".",""); ?> (<?php echo valorPorExtenso($total_month, true, false); ?>) conforme tabela de serviços constante na área exclusiva da CONTRATANTE no site da CONTRATADA, mais as taxas governamentais.</p>
                        <p>12.6 - A solicitação de rescisão de contrato com a CONTRATADA antes da conclusão do processo de abertura da empresa não desobriga a CONTRATANTE ao pagamento mencionado na cláusula 11ª, item 11.1.</p>
                        <p>12.7 - A CONTRATADA se obriga a entrega dos documentos e informações relacionados ao processo de abertura de empresa em andamento até o momento da rescisão para que o novo profissional contratado pela CONTRATANTE possa dar continuidade.</p>

                        <p>CLÁUSULA 13ª - DA LEI GERAL DE PROTEÇÃO DE DADOS (LGPD - LEI 13.709/2018):</p>
                        <p>13.1 - As partes comprometem-se a respeitar o tratamento de dados pessoais, inclusive nos meios digitais, por pessoa natural ou por pessoa jurídica de direito público ou privado, com o objetivo de proteger os direitos fundamentais de liberdade e de privacidade e o livre desenvolvimento da personalidade da pessoa natural.</p>
                        <p>13.2 - Conforme incisos VI e VII da Lei 13.709/2018 LGPD, a CONTRATANTE é a CONTROLADORA e a CONTRATADA é a OPERADORA no tratamento dos dados, pois a CONTRATANTE é a responsável por colher os dados dos seus clientes, fornecedores e empregados. A OPERADORA, ora CONTRATADA, poderá realizar o tratamento de dados, mas isso ocorrerá a partir das ordens da CONTROLADORA (CONTRATANTE), que, por sua vez, apresenta-se como a “dona” ou responsável por essas informações. A CONTROLADORA que está no topo da cadeia de tratamento de dados, e deve respeitar todos os artigos da supramencionada Lei sob pena das sanções civis e penais cabíveis.</p>
                        <p>13.3 - Caso a CONTRATADA (OPERADORA) faça algum tratamento de dados pessoais para a CONTRATANTE (CONTROLADORA), essa obrigação cessará quando o presente contrato de prestação de serviços finalizar, não podendo a CONTRATADA (OPERADORA), manter qualquer dado de terceiros em seus registros, caso em que serão excluídos definitivamente de seus arquivos, conforme artigo 15 da Lei 13.709/2018.</p>
                        <p>13.4 - A CONTRATANTE (CONTROLADORA), desde já concede formalmente o tratamento de dados pessoais das pessoas físicas representadas por seus sócios, empregados, clientes e fornecedores  imprescindíveis para execução dos serviços mencionados na cláusula 1ª, tendo sido informada quanto ao tratamento de dados que será realizado pela CONTRATADA (OPERADORA), nos termos da Lei Geral de Proteção de Dados (Lei nº 13.709/2018), que serão utilizados especificamente para o cumprimento de obrigações decorrentes da legislação trabalhista e previdenciária, incluindo o disposto em Acordo ou Convenção Coletiva da categoria da CONTRATANTE (CONTROLADORA) e, deverá essa solicitar a mesma autorização aos seus clientes e colaboradores, sob pena do presente contrato ser rescindido por justo motivo pela CONTRATADA (OPERADORA), conforme artigo 7º inciso I da Lei 13.709/2018.</p>

                        <p>CLÁUSULA 14ª - DA VIGÊNCIA E RESCISÃO:</p>
                        <p>14.1 - O contrato entra em vigor desde a data da aposição do aceite pela CONTRATANTE por meio do processo de contratação eletrônica realizado no site da CONTRATADA e confirmação do  pagamento conforme estipulado na cláusula 11ª tendo vigência por tempo indeterminado, podendo ser rescindido em qualquer época, por qualquer uma das partes, mediante aviso prévio de 60 (sessenta) dias, por e-mail enviado para administracao@linkcontabilidade.com.br , apresentando as razões da decisão, devendo ser efetuados todos os pagamentos eventualmente em aberto, tanto os vencidos quanto os a vencer entre a data da comunicação do interesse da parte em rescindir o contrato e a data da efetiva rescisão.</p>
                        <p>14.2 - A CONTRATADA passará a ser responsável pelo processo de abertura/constituição da empresa a partir de <?=date("d")?> de <?php echo $month_name[date("m")]; ?> de <?=date("Y")?>, às <?php echo date("H:i"); ?>, e pela contabilidade da empresa a partir da data de obtenção do CNPJ.</p>
                        <p>14.3 - A parte que não comunicar por escrito a rescisão ou efetuá-la de forma sumária, desrespeitando o pré-aviso previsto, ficará obrigada ao pagamento da multa no valor de 2 (duas) parcelas mensais dos honorários vigentes à época.</p>
                        <p>14.4 - Caso constem mensalidades em atraso, incluindo os serviços extraordinários, a CONTRATADA poderá suspender a entrega dos serviços a partir do 30º (trigésimo) dia, até o pagamento integral dos débitos ou a realização de acordo, inclusive o acesso da CONTRATANTE à área exclusiva da CONTRATANTE disponibilizada na Plataforma Link da CONTRATADA, eximindo-se de qualquer responsabilidade pelas multas e danos causados no período da paralisação, independentemente de notificação judicial ou extrajudicial. A partir da terceira mensalidade em atraso, a CONTRATADA poderá rescindir o contrato unilateralmente, independente de notificação judicial ou extrajudicial, sem o cumprimento de aviso prévio, além de protestar a obrigação nos cartórios, inscrever o nome da CONTRATANTE e dos seus sócios nos serviços de proteção ao crédito e executar a obrigação judicialmente, em face à pessoa jurídica e às pessoas físicas dos sócios, solidariamente. A tolerância de qualquer das partes no descumprimento das condições deste contrato, não será considerada novação do que está pactuado.</p>
                        <p>14.5 - Caso a CONTRATANTE tenha se beneficiado da gratuidade dos serviços de abertura de empresas conforme previsto no contrato de prestação de serviços e venha rescindir o contrato antes do prazo mínimo previsto de 12 (doze) meses, pagará multa equivalente a 30% (trinta por cento) dos honorários vincendos entre a data da rescisão e a data do primeiro aniversário, sem prejuízo do valor indicado na cláusula 12.5 referente ao processo de abertura de empresa, e finalmente, o valor pago pelos serviços previstos neste contrato não serão devolvidos.</p>
                        <p>14.6 - Ocorrendo a transferência dos serviços para outra Empresa Contábil, a CONTRATANTE deverá apresentar à CONTRATADA, conforme Resolução 1.493/15 estabelecida pelo Conselho Regional  de  Contabilidade,  o  representante legal  para recepcionar os  documentos, mediante autorização por escrito, sendo, de preferência, o novo responsável técnico.</p>
                        <p>14.7 - A CONTRATANTE obriga-se a manter atualizada sua certificação digital, como também valida as procurações eletrônicas substabelecidas à CONTRATADA, além das senhas  de acesso ao  Posto Fiscal, Prefeitura Municipal, Conectividade Social da Caixa Econômica Federal, FAP (fator acidentário de Prevenção) e todas relacionadas aos órgãos fiscalizadores para que a CONTRATADA cumpra com a entrega das obrigações acessórias, sem o que não será possível à CONTRATADA cumprir as formalidades ético-profissionais,  inclusive  a  transmissão  de  dados  e informações  necessárias  à  continuidade  dos serviços, em  relação  as  quais,  diante  da  eventual  inércia  da  CONTRATANTE, estará  desobrigada  de cumprimento e isenta de qualquer responsabilidade.</p>
                        <p>14.8 - Entre os dados e informações a serem fornecidos não se incluem detalhes técnicos dos sistemas de informática da CONTRATADA, os quais são de sua exclusiva propriedade.</p>
                        <p>14.9 - A falência ou a concordata da CONTRATANTE facultará a rescisão do presente contrato pela CONTRATADA, independente de notificação judicial ou extrajudicial, não estando incluídos nos serviços ora pactuados a elaboração de peças contábeis exigidas por lei.</p>
                        <p>14.10 - O presente contrato será rescindido, independentemente de notificação judicial ou extrajudicial, caso qualquer das partes venha a infringir qualquer cláusula do presente instrumento.</p>
                        <p>14.11 - Fica estipulada a multa contratual de uma parcela mensal vigente relativa aos honorários, exigível por inteiro em face da parte que der causa à rescisão motivada, sem prejuízo da penalidade relativa ao atraso no pagamento dos honorários.</p>
                        <p>14.12 - A parte que descumprir qualquer obrigação contratual, responderá pelas perdas e danos, mais juros, atualização monetária e honorários advocatícios.</p>
                        <p>14.13 - A assistência da CONTRATADA à CONTRATANTE, após a denúncia do contrato, ocorrerá no prazo de 15 dias, após o término do mesmo.</p>

                        <p>CLÁUSULA 15ª - DO FORO: O local da prestação dos serviços será o escritório da Link Contabilidade Consultiva, localizado na Av. Dr. João Batista de Soares Queiroz Jr, nº 235, no bairro Jardim das Indústrias, no município de São José dos Campos, no Estado de São Paulo.</p>
                        <p>Fica eleito o Foro da Comarca de São José dos Campos, Estado de São Paulo, para dirimir quaisquer dúvidas ou litígios decorrentes deste contrato, renunciando expressamente a qualquer outro, mesmo que privilegiados.</p>
                        <p>E, por estarem de pleno acordo, justos e contratados, após terem LIDO e ACEITO o presente contrato, nada tendo a OPOR ou RESSALVAR, firmam o presente confirmando por meio de aceite eletrônico. A versão digital em formato PDF estará disponível para download na área exclusiva da CONTRATANTE na Plataforma Link, após o aceite eletrônico e pagamento da primeira mensalidade pela CONTRATANTE.</p>
                        
                        
                        
                        
                        <br><br>E, por estarem de pleno acordo, justos e contratados, após terem LIDO e ACEITO o presente contrato, nada tendo a OPOR ou RESSALVAR, firmam o presente confirmando por meio de aceite eletrônico. A versão eletrônica em formato .PDF estará disponível para download no sistema de internet da LINK CONTABILIDADE CONSULTIVA após o aceite e cadastro dos dados do CLIENTE no Sistema LINK CONTABILIDADE CONSULTIVA.</p>
                        <p>SÃO JOSÉ DOS CAMPOS, 
                        <b><?=date("d")?> de <?php echo $month_name[date("m")]; ?> de <?=date("Y")?>, às <?php echo date("H:i"); ?>.</b>
                        <br>
                        IP: <?php echo $_SERVER["REMOTE_ADDR"]; ?>
                        </p>
                        <p></p>
                        <p></p>

                    </div>
                </div>

                <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">

                    <span style="font-size: 20px; color: <?php echo $color_menu; ?>; font-weight: 600;">
                        Termos de uso
                    </span>

                    <br><br><br>

                    <div style="border-radius: 10px; border: 1px solid #d5dde2; background-color: #fff; font-size: 12px; padding: 40px; color: #666; height: 350px; overflow-y: scroll; text-align: justify;">

                        <strong style="font-size: 16px; color: #333;">TERMOS DE USO DO CONTABIFY</strong>

                        <br><br>

                        O objetivo fundamental da contabilidade é assegurar que todos os relatórios e registros sejam feitos de acordo com os princípios e normas contábeis, prazos e procedimentos estabelecidos.
                        <br><br>

                        Estes registros terão duas finalidades:
                        Contabilidade fiscal, para atender às exigências dos órgãos reguladores e do poder público, controlar a arrecadação de impostos e desenvolver diversos serviços relativos a demonstrações financeiras e obrigações fiscais, incluindo o controle de patrimônio, apuração e demonstração de resultados, balancetes, consolidação de balanços patrimoniais, análises de balanço, entre outros.
                        <br><br>

                        Contabilidade gerencial, para gerar informações que auxiliem nos seus processos decisórios e contribuam para a formação de uma gestão empresarial sólida.
                        <br><br>

                        O objetivo fundamental da contabilidade é assegurar que todos os relatórios e registros sejam feitos de acordo com os princípios e normas contábeis, prazos e procedimentos estabelecidos.
                        <br><br>

                        Estes registros terão duas finalidades:
                        Contabilidade fiscal, para atender às exigências dos órgãos reguladores e do poder público, controlar a arrecadação de impostos e desenvolver diversos serviços relativos a demonstrações financeiras e obrigações fiscais, incluindo o controle de patrimônio, apuração e demonstração de resultados, balancetes, consolidação de balanços patrimoniais, análises de balanço, entre outros.
                        <br><br>

                        Contabilidade gerencial, para gerar informações que auxiliem nos seus processos decisórios e contribuam para a formação de uma gestão empresarial sólida.
                        <br><br>

                        O objetivo fundamental da contabilidade é assegurar que todos os relatórios e registros sejam feitos de acordo com os princípios e normas contábeis, prazos e procedimentos estabelecidos.
                        <br><br>

                        Estes registros terão duas finalidades:
                        Contabilidade fiscal, para atender às exigências dos órgãos reguladores e do poder público, controlar a arrecadação de impostos e desenvolver diversos serviços relativos a demonstrações financeiras e obrigações fiscais, incluindo o controle de patrimônio, apuração e demonstração de resultados, balancetes, consolidação de balanços patrimoniais, análises de balanço, entre outros.
                        <br><br>

                        Contabilidade gerencial, para gerar informações que auxiliem nos seus processos decisórios e contribuam para a formação de uma gestão empresarial sólida.
                        <br><br>

                    </div>
                </div> -->
            </div>

            <div id="box-sign-contract"></div>

            <br><br><br>

            <span style="font-size: 20px; color: #666; font-weight: 600;">
                Assinatura digital
            </span>

            <div class="row margin-t-40">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">

                    <div class="box-selected" style="padding-left: 150px; padding-top: 40px; position: relative; z-index: 0;">

                        <?php if($business_sign == 1){ ?>

                            <i class="icon material-icons-outlined"
                                style="top: 40px; left: 44px; font-size: 66px; color: #35e052; position: absolute;">mail_outline</i>

                        <?php }else{ ?>

                            <i class="icon material-icons-outlined"
                                style="top: 40px; left: 44px; font-size: 66px; color: #dadada; position: absolute;">radio_button_unchecked</i>

                        <?php } ?>

                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            <?php echo $user_cpf; ?>
                        </strong>
                        <br>
                        <strong style="font-size: 12px; color: #666; line-height: 18px; text-transform: uppercase;">
                            <?php echo $user_name." ".$user_lastname; ?>
                        </strong>
                        <br>

                        <br>
                        <p style="font-size: 20px; line-height: 16px; color: #666; font-weight: 600;">

                            <?php
                                if($business_sign == 1){
                                    echo "<span style='color: #35e052;'>Contrato assinado!</span><br><br>";
                                    echo "<span style='font-size: 12px;'>Seu contrato foi assinado digitalmente.</span>";
                                }else{
                                    echo "Contrato não assinado";
                                }
                            ?>

                        </p>

                        <?php if($business_sign == 0){ ?>

                            <div data-toggle="modal" data-target="#updateSign" class="btn btn-line-gray size-sm margin-t-10">
                                ASSINAR CONTRATO</div>

                        <?php } ?>

                    </div>
                </div>

                <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">

                    <div class="box-selected" style="padding-left: 150px; padding-top: 40px; position: relative; z-index: 0;">

                        <?php if($business_terms == 1){ ?>

                            <i class="icon material-icons-outlined"
                                style="top: 40px; left: 44px; font-size: 66px; color: #35e052; position: absolute;">verified_user</i>

                        <?php }else{ ?>

                            <i class="icon material-icons-outlined"
                                style="top: 40px; left: 44px; font-size: 66px; color: #dadada; position: absolute;">radio_button_unchecked</i>

                        <?php } ?>

                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                            <?php echo $user_cpf; ?>
                        </strong>
                        <br>
                        <strong style="font-size: 12px; color: #666; line-height: 18px; text-transform: uppercase;">
                            <?php echo $user_name." ".$user_lastname; ?>
                        </strong>
                        <br>

                        <br>
                        <p style="font-size: 20px; color: #666; font-weight: 600;">

                            <?php
                                if($business_terms == 1){
                                    echo "<span style='color: #35e052;'>Termos de uso assinado</span><br>";
                                    echo "<span style='font-size: 12px;'>Assinado em ".date_format($business_terms_date, 'd/m/Y')." às ".date_format($business_terms_date, 'H:i')."</span>";
                                }else{
                                    echo "Termos de uso não assinado";
                                }
                            ?>

                        </p>

                        <?php if($business_terms == 0){ ?>

                            <div data-toggle="modal" data-target="#updateTerms" class="btn btn-line-gray size-sm margin-t-10">
                                ASSINAR TERMOS DE USO</div>

                        <?php } ?>

                    </div>
                </div> -->
            </div>

            <div class="row">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                    <a href="/contratar/etapa-3" class="btn btn-line-gray size-lg margin-t-50" style="margin-left: 3%">VOLTAR</a>
                    
                    <div class="col-6 margin-t-50">
                        <button data-toggle="modal" data-target="#agenda"class="btn btn-yellow size- margin-t-10" type="button">Agendar atendimento digital</button>
                        
                    </div>
                    <p class="text margin-t-20" style=" margin-bottom: 10px; font-weight: 600; font-size: 11px;">
                        Caso seja necessário agende seu atendimento digital, clicando no botão acima
                    </p>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    <?php if($business_sign == 1){ ?>
                        <a href="/contratar/etapa-5" class="btn btn-yellow size-lg margin-t-50">PRÓXIMA ETAPA</a>
                    <?php } ?>

                </div>
            </div>

            <br><br>

            <?php
                echo $this->element('footer_steps');
            ?>

        </div>

    </section>

</div>

<?php
    echo $this->element('sidebar_steps');
?>

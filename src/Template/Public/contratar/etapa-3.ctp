
<?php

    echo $this->element('agenda');

    if($service_action == "abertura"){ $color_menu = "#fff"; }
    if($service_action == "migracao"){ $color_menu = "#fff"; }

    $business_zipcode = "";
    $business_address = "";
    $business_number = "";
    $business_complement = "";
    $business_district = 0;
    $business_city = 0;
    $business_state = 1;

    foreach ($all_business as $business) {
        $business_zipcode = $business->zipcode;
        $business_address = $business->address;
        $business_number = $business->number;
        $business_complement = $business->complement;
        $business_district = $business->district;
        $business_city = $business->city;
        $business_state = $business->state;
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
        
        <div style="position: absolute; bottom: -12px; left: 370px; width: 20px; height: 20px; background-color: #fff; transform: rotate(45deg);"></div>

        <a href="/contratar/etapa-1" class="link-steps">
            <strong style="font-size: 24px; color: #ffce2c;">1</strong> &nbsp;
            <strong style="font-size: 14px; color: #ffce2c;">Sobre você</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-2" class="link-steps">
            <strong style="font-size: 24px; color: #ffce2c;">2</strong> &nbsp;
            <strong style="font-size: 14px; color: #ffce2c;">Sobre a empresa</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-3" class="link-steps">
            <strong style="font-size: 24px; color: #fff;">3</strong> &nbsp;
            <strong style="font-size: 14px; color: #fff;">Localização</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-4" class="link-steps">
            <strong style="font-size: 24px; color: #7d7f8a;">4</strong> &nbsp;
            <strong style="font-size: 14px; color: #7d7f8a;">Contrato</strong> &nbsp;&nbsp;&nbsp;
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
                        Onde se localizará a sua empresa?
                    </span>

                    <p style="font-size: 14px; color: #999; font-weight: 400; margin-top: 10px;">
                        Preencha os dados abaixo e inicie a contratação da sua contabilidade.
                        <br>
                        Caso não tenha o endereço da empresa definido, preencha com o seu próprio endereço residencial. 
                    </p>

                    <p style="font-size: 14px; color: #999; font-weight: 400; margin-top: 50px;">
                        <strong style="color: #666;">Informações em segurança</strong><br>
                        Suas informações estão 100% seguras, todas as nossas informações são transmitidas por uma conexão segura por senha criptografada.
                    </p>
                </div>
            </div>

            <form id="form_step_3" method="POST" style="padding: 0; margin-top: 30px;">

                <div class="row">

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">

                        <div class="btn-search-cep btn_search_cep" data-url="/api/web/search/cep" data-form="#form_step_3" data-redirect="none">
                            Buscar
                        </div>

                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CEP</p>

                        <input type="text" class="form-control required mask-cep" name="zipcode" id="input-cep" value="<?php echo $business_zipcode; ?>"
                            style="font-size: 14px; background-color: #fff;">

                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Endereço</p>

                        <input type="text" class="form-control required" name="address" id="input-address"  value="<?php echo $business_address; ?>"
                            style="font-size: 14px; background-color: #fff;">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Número</p>

                        <input type="text" class="form-control required" name="number"   value="<?php echo $business_number; ?>"
                            style="font-size: 14px; background-color: #fff;">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Complemento</p>

                        <input type="text" class="form-control" name="complement"  value="<?php echo $business_complement; ?>"
                            style="font-size: 14px; background-color: #fff;">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Bairro</p>

                        <input type="text" class="form-control required" name="district" id="input-district"  value="<?php echo $business_district; ?>"
                            style="font-size: 14px; background-color: #fff;">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Cidade</p>

                        <input type="text" class="form-control required" name="city" id="input-city"  value="<?php echo $business_city; ?>"
                            style="font-size: 14px; background-color: #fff;">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Estado</p>

                        <select class="form-control required" name="state" id="input-state" style="font-size: 14px; background-color: #fff;">
                            <option value="">Selecione</option>
                            <option value="AC" <?php if($business_state == "AC"){ echo "selected"; } ?>>AC - Acre</option>
                            <option value="AL" <?php if($business_state == "AL"){ echo "selected"; } ?>>AL - Alagoas</option>
                            <option value="AP" <?php if($business_state == "AP"){ echo "selected"; } ?>>AP - Amapá</option>
                            <option value="AM" <?php if($business_state == "AM"){ echo "selected"; } ?>>AM - Amazonas</option>
                            <option value="BA" <?php if($business_state == "BA"){ echo "selected"; } ?>>BA - Bahia</option>
                            <option value="CE" <?php if($business_state == "CE"){ echo "selected"; } ?>>CE - Ceará</option>
                            <option value="DF" <?php if($business_state == "DF"){ echo "selected"; } ?>>DF - Distrito Federal</option>
                            <option value="ES" <?php if($business_state == "ES"){ echo "selected"; } ?>>ES - Espírito Santo</option>
                            <option value="GO" <?php if($business_state == "GO"){ echo "selected"; } ?>>GO - Goiás</option>
                            <option value="MA" <?php if($business_state == "MA"){ echo "selected"; } ?>>MA - Maranhão</option>
                            <option value="MT" <?php if($business_state == "MT"){ echo "selected"; } ?>>MT - Mato Grosso</option>
                            <option value="MS" <?php if($business_state == "MS"){ echo "selected"; } ?>>MS - Mato Grosso do Sul</option>
                            <option value="MG" <?php if($business_state == "MG"){ echo "selected"; } ?>>MG - Minas Gerais</option>
                            <option value="PA" <?php if($business_state == "PA"){ echo "selected"; } ?>>PA - Pará</option>
                            <option value="PB" <?php if($business_state == "PB"){ echo "selected"; } ?>>PB - Paraíba</option>
                            <option value="PR" <?php if($business_state == "PR"){ echo "selected"; } ?>>PR - Paraná</option>
                            <option value="PE" <?php if($business_state == "PE"){ echo "selected"; } ?>>PE - Pernambuco</option>
                            <option value="PI" <?php if($business_state == "PI"){ echo "selected"; } ?>>PI - Piauí</option>
                            <option value="RJ" <?php if($business_state == "RJ"){ echo "selected"; } ?>>RJ - Rio de Janeiro</option>
                            <option value="RN" <?php if($business_state == "RN"){ echo "selected"; } ?>>RN - Rio Grande do Norte</option>
                            <option value="RS" <?php if($business_state == "RS"){ echo "selected"; } ?>>RS - Rio Grande do Sul</option>
                            <option value="RO" <?php if($business_state == "RO"){ echo "selected"; } ?>>RO - Rondônia</option>
                            <option value="RR" <?php if($business_state == "RR"){ echo "selected"; } ?>>RR - Roraima</option>
                            <option value="SC" <?php if($business_state == "SC"){ echo "selected"; } ?>>SC - Santa Catarina</option>
                            <option value="SP" <?php if($business_state == "SP"){ echo "selected"; } ?>>SP - São Paulo</option>
                            <option value="SE" <?php if($business_state == "SE"){ echo "selected"; } ?>>SE - Sergipe</option>
                            <option value="TO" <?php if($business_state == "TO"){ echo "selected"; } ?>>TO - Tocantins</option>
                        </select>

                    </div>
                </div>

            </form>


            <div class="row">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                    <a href="/contratar/etapa-2" class="btn btn-line-gray size-lg margin-t-50" style="margin-left: 3%">VOLTAR</a>
                    
                    <div class="col-6 margin-t-50">
                        <button data-toggle="modal" data-target="#agenda"class="btn btn-yellow size- margin-t-10" type="button">Agendar atendimento digital</button>
                        
                    </div>
                    <p class="text margin-t-20" style=" margin-bottom: 10px; font-weight: 600; font-size: 11px;">
                        Caso seja necessário agende seu atendimento digital, clicando no botão acima
                    </p>
                </div>
                
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                        data-url="/api/web/business/add-step-3" data-form="#form_step_3" data-redirect="/contratar/etapa-4">
                        PRÓXIMA ETAPA
                    </div>
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

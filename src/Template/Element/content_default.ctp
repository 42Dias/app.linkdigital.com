

<?php
    echo $this->element('block_especialidades');
?>


<!-- Section 1 -->
<section class="" style="background-color: #ececec;" id="simular-mensalidade">

    <div class="container" style="padding-top: 100px; padding-bottom: 30px;">

        <div class="row" style="margin-top: 0px;">            
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">

                <h3 style="font-size: 34px; margin-top: 25px; font-weight: 600; color: #202020; line-height: 40px;">
                    Faça sua simulação e saiba quanto vai custar a sua mensalidade 
                </h3>

            </div>
        </div>

        <div class="row simulation" id="calculadora-consultiva" style="padding-top: 20px; margin-top: 50px;">
            
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-xs-8">

                <form id="form-service-1" class="box-simulation"  style="border: none;">
                    <!-- <h4>Contabilidade Consultiva</h4> -->
                    <!-- <br> -->

                    <h3 class="margin-t-0 margin-b-50" style="color: #333;">
                        <strong>Preencha os dados da sua empresa</strong>
                    </h3>

                    <span style="color: #666;">Qual plano de serviços você deseja?</span> 
                    <span class="icon ion-help-circled" data-toggle="modal" data-target="#help_package" style="margin-left: 8px; font-size: 18px; color: #929292; cursor: pointer;"></span>

                    <div class="margin-t-20 margin-b-20">
                    
                        <div class="package active" data-type="consultiva">
                            <span class="icon ion-android-star"></span> Contabilidade Consultiva
                        </div>
                    
                        <div id="btn-calculadora-digital" class="package" data-type="digital">
                            <span class="icon ion-android-star-outline"></span> Contabilidade Digital
                        </div>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-t-20">

                            <span style="color: #666;">Qual é o tipo da sua empresa?</span>

                            <br><br>

                            <div class="type active" data-type="simples">
                                <span class="icon ion-checkmark-round"></span> SIMPLES NACIONAL
                            </div>

                            <div class="type" data-type="lucro">
                                <span class="icon ion-checkmark-round"></span> LUCRO PRESUMIDO
                            </div>

                            <div class="type" data-type="real">
                                <span class="icon ion-checkmark-round"></span> LUCRO REAL
                            </div>

                            <div class="clear"></div>
                            
                            <br>
                            <span style="color: #666;">Ramo de atividade</span>

                            <select class="form-control active margin-b-40" name="form-type" style="width: 100%; margin-top: 10px;" id="form-type">
                                <option value="s" selected>Prestação de serviços</option>
                                <option value="c">Comércio</option>
                                <option value="sc">Prestação de serviços e Comércio</option>
                                <option value="ind">Indústria</option>
                                <option value="liberal">Profissionais Liberais e Autônomos</option>
                                <option value="mei">Micro empreendedor individual (MEI)</option>
                                <option value="empregado">Empregado doméstico</option>
                                <option value="inativa">Empresa inativa</option>
                            </select>

                            <!-- <span style="color: #666;">Tipo de Tributação:</span>
                            <br><br> -->

                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-t-20">

                            <span style="color: #666;" id="text-socios">Quantos sócios têm sua empresa?</span>
                            <input type="number" value="0" class="form-control margin-b-20 text-center" id="form-socios" name="form-socios"
                            style="width: 100%; margin-top: 10px; font-size: 24px;" min="0">

                            <span style="color: #666;" id="text-funcionarios">Quantos funcionários?</span>
                            <input type="number" value="0" class="form-control margin-b-20 text-center" id="form-funcionarios" name="form-funcionarios"
                            style="width: 100%; margin-top: 10px; font-size: 24px;" min="0">

                            <span style="color: #666;">Qual a faixa de faturamento mensal?</span>

                            <select class="form-control active  margin-b-40" style="width: 100%; margin-top: 0px; display: none;" id="text-faturamento-5k">
                                <option value="1">R$ 0,00 a R$ 6.750,00</option>
                            </select>

                            <select class="form-control active margin-b-40" name="form-faturamento" style="width: 100%; margin-top: 10px;" id="form-faturamento">
  
                                <?php

                                    echo '<option value="1">R$ 0,00 a R$ 15.000,00</option>';

                                    $begin = 15000.01;
                                    $end = 30000.00;

                                    for ($i=2; $i < 50; $i++) {

                                        echo '<option value="'.$i.'">R$ '.number_format($begin, 2, ',', '.').' a R$ '.number_format($end, 2, ',', '.').'</option>';
                                        
                                        if($i == 1){
                                            $begin = $begin + 0.01;
                                        }

                                        $begin = $end;
                                        $end = $begin + 30000;
                                        // $begin = $begin + 25000;
                                        // $end = $end + 25000;
                                    }
                                ?>
                            </select>

                        </div>
                    </div>


                    <!-- <span style="color: #999;">Pacote de Serviços  &nbsp;&nbsp;<i class="icon ion-ios-help-outline" style="font-size: 20px; cursor: pointer;" data-toggle="modal" data-target="#helpPackage"></i></span> -->
                    <!-- <input type="text" class="form-control-line margin-b-40 text-center " id="form-faturamento" name="form-faturamento"
                    style="width: 100%; margin-top: 10px; font-size: 24px;" placeholder="R$ 0,00"> -->

                    <!-- <select class="form-control-line active  margin-b-40" name="form-package" style="width: 100%; margin-top: 0px;" id="form-package">
                        <option value="basic" selected>Pacote Básico</option>
                        <option value="premium">Pacote Premium</option>
                    </select> -->

                    <!-- <hr class="margin-t-40" style="border-bottom: 1px solid #d6e1ea; border-top: 1px solid #fff;">

                    <h5 class="margin-t-40 margin-b-30 text-center" style="color: #788c9c;">
                        Preencha os dados abaixo e veja a simulação ao lado:
                    </h5> --> 

                </form>

            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="box-result" style="border: none; background-color: #333;">

                    <img src="/img/logo-link-white.png" style="width: 130px;">

                    <h3 class="margin-t-20 margin-b-30" style="color: #fff; display: inline-block; ">
                        <strong>Contratando a Link Contabilidade</strong>
                    </h3>

                    <h4 class="margin-t-20" style="color: #999;">Abertura de empresa</h4>
                    <h3 class="margin-t-10" style="color: #fff;"><strong>GRÁTIS *</strong></h3>


                    <h4 class="margin-t-20" style="color: #999;">
                        Valor da sua mensalidade na Link Contabilidade
                    </h4>

                    <h2 class="margin-t-10" style="color: #fff;">
                        <strong id="result-mensalidade"></strong> <span style="font-size: 11px;" id="text-month">/ mês</span>
                    </h2>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 margin-t-20">
                        
                        <a href="/abrir-empresa-gratis" class="btn btn-yellow margin-t-20 size-lg">QUERO CONTRATAR</a>
                        
                    </div>

                    <!-- <div id="area-lucro-real" style="display: none;">
                        
                        <div class="row margin-t-20">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

                                <h4 class="margin-t-20" style="color: #999;">
                                    Abertura de empresa
                                </h4>

                                <h3 class="margin-t-10" style="color: #fff;">
                                    <strong>GRÁTIS *</strong>
                                </h3>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

                            <h4 class="margin-t-20" style="color: #999;">
                                    Valor da sua mensalidade na Link Contabilidade
                                </h4>

                                <h2 class="margin-t-10" style="color: #fff;">
                                    <strong>Sob consulta</strong>
                                </h2>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 margin-t-20">

                                <a href="/fale-conosco" class="btn btn-yellow margin-t-20 size-lg">QUERO CONTRATAR</a>
                                
                            </div>
                        </div>

                    </div> -->

                </div>
            </div>

            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xs-5 margin-t-30">
                <div id="area-lucro-real" style="display: none;">
                    
                    <div class="row margin-t-20">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

                            <h4 class="margin-t-20" style="color: #999;">
                                Abertura de empresa
                            </h4>

                            <h3 class="margin-t-10" style="color: #fff;">
                                <strong>GRÁTIS *</strong>
                            </h3>

                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

                        <h4 class="margin-t-20" style="color: #999;">
                                Valor da sua mensalidade na Link Contabilidade
                            </h4>

                            <h2 class="margin-t-10" style="color: #fff;">
                                <strong>Sob consulta</strong>
                            </h2>

                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 margin-t-20">

                            <a href="/fale-conosco" class="btn btn-yellow margin-t-20 size-lg">QUERO CONTRATAR</a>
                            
                        </div>
                    </div>

                </div>
            </div>

        <!--<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-t-30">
                    <div class="box-result" style="border: none; background-color: #333;">

                    <img src="/img/logo-link-white.png" style="width: 150px; display: inline-block; margin-right: 30px;">
                    
                    <h3 class="margin-t-20 margin-b-50" style="color: #fff; display: inline-block; ">
                        <strong>Contratando a Link Contabilidade</strong>
                    </h3>

                    <div id="area-simulation">

                        <div class="row margin-t-20">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

                                <h4 class="margin-t-20" style="color: #999;">
                                    Abertura de empresa
                                </h4>

                                <h3 class="margin-t-10" style="color: #fff;">
                                    <strong>GRÁTIS *</strong>
                                </h3>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

                                <h4 class="margin-t-20" style="color: #999;">
                                    Valor da sua mensalidade na Link Contabilidade
                                </h4>

                                <h2 class="margin-t-10" style="color: #fff;">
                                    <strong id="result-mensalidade"></strong> <span style="font-size: 11px;" id="text-month">/ mês</span>
                                </h2>

                                 <h4 class="margin-t-20" style="color: #999;">
                                    Custo total anual na Link Contabilidade
                                </h4>

                                <h2 class="margin-t-10" style="color: #999;">
                                    <strong id="result-custo">R$ 1000,90</strong> <span style="font-size: 12px;">/ano</span>
                                </h2>

                                <h4 class="margin-t-30" style="color: #999;">
                                    Economia anual com a Link Contabilidade
                                </h4>

                                <h2 class="margin-t-10" style="color: #ffce2c;">
                                    <strong id="result-economia">R$ 560,00</strong> <span style="font-size: 11px;"> / ano</span>
                                </h2> 

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 margin-t-20">

                                 <h4 class="margin-t-20" style="color: #999;">
                                    Redução de custo anual
                                </h4>

                                <h2 class=" margin-t-10" style="color: #999;">
                                    <strong id="result-percent" style="font-size: 82px; line-height: 110px; color: #666;">0%</strong>
                                </h2> 

                                
                                <a href="/abrir-empresa-gratis" class="btn btn-yellow margin-t-20 size-lg">QUERO CONTRATAR</a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->

            <!-- <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 margin-t-20">

                <div class="box-simulation" style="background-color: #f9fafb;">

                    <h3 class="text-center margin-t-0" style="color: #333;">
                        <strong>Contabilidade <br>Tradicional</strong>
                    </h3>

                    <hr class="margin-t-50" style="border-bottom: 1px solid #d6e1ea; border-top: 1px solid #fff;">

                    <h4 class="text-center margin-t-30" style="color: #889daf;">
                        Abertura de empresa
                    </h4>

                    <h3 class="text-center margin-t-10" style="color: #5c6d7b;">
                        <strong>R$ 1.045,00</strong>
                    </h3>

                    <hr class="margin-t-30" style="border-bottom: 1px solid #d6e1ea; border-top: 1px solid #fff;">

                    <h4 class="text-center margin-t-30" style="color: #889daf;">
                        Mensalidade atual
                    </h4>

                    <h3 class="text-center margin-t-10" style="color: #5c6d7b;">
                        <strong id="result-custo-mensal">R$ 965,00</strong> <span style="font-size: 11px;">/ mês</span>
                    </h3>

                    <hr class="margin-t-30" style="border-bottom: 1px solid #d6e1ea; border-top: 1px solid #fff;">

                    <h4 class="text-center margin-t-30" style="color: #889daf;">
                        Custo anual
                    </h4>

                    <h2 class="text-center margin-t-10" style="color: #ee8903;">
                        <strong id="compare-anual">R$ 560,00</strong> <span style="font-size: 11px;">/ ano</span>
                    </h2>

                </div>

            </div> -->
        
        </div>
        
        <div class="row simulation simulation-digital" id="calculadora-digital" style="padding-top: 20px; margin-top: 50px; display: none;">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-xs-8">

                <form id="form-service-2" class="box-simulation box-simulation-digital"  style="border: none;">

                    <h3 class="margin-t-0 margin-b-50" style="color: #333;">
                        <strong>Preencha os dados da sua empresa</strong>
                    </h3>

                    <span style="color: #666;">Qual plano de serviços você deseja?</span>
                    <span class="icon ion-help-circled" data-toggle="modal" data-target="#help_package" style="margin-left: 8px; font-size: 18px; color: #929292; cursor: pointer;"></span>

                    <div class="margin-t-20 margin-b-20">

                        <div id="btn-calculadora-consultiva" class="package" data-type="consultiva">
                            <span class="icon ion-android-star"></span> Contabilidade Consultiva
                        </div>

                        <div class="package active" data-type="digital">
                            <span class="icon ion-android-star-outline"></span> Contabilidade Digital
                        </div>

                        <div class="clear"></div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-t-20">

                            <span style="color: #666;">Qual é o tipo da sua empresa?</span>

                            <br><br>

                            <div class="type digital active tributo-digital" data-type="simples">
                                <span class="icon ion-checkmark-round"></span> SIMPLES NACIONAL
                            </div>

                            <div class="type digital tributo-digital" data-type="lucro">
                                <span class="icon ion-checkmark-round"></span> LUCRO PRESUMIDO
                            </div>

                            <div class="type digital tributo-digital" data-type="real">
                                <span class="icon ion-checkmark-round"></span> LUCRO REAL
                            </div>

                            <div class="clear"></div>
                            
                            <br>
                            <span style="color: #666;">Ramo de atividade</span>

                            <select class="form-control active margin-b-40" name="form-type" style="width: 100%; margin-top: 10px;" id="form-type-digital">
                                <option value="s" selected>Prestação de serviços</option>
                                <option value="c">Comércio</option>
                                <option value="sc">Prestação de serviços e Comércio</option>
                                <option value="ind">Indústria</option>
                                <option value="liberal">Profissionais Liberais e Autônomos</option>
                                <option value="mei">Micro empreendedor individual (MEI)</option>
                                <option value="empregado">Empregado doméstico</option>
                                <option value="inativa">Empresa inativa</option>
                            </select>

                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-t-20">

                            <span style="color: #666;" id="text-socios">Quantos sócios têm sua empresa?</span>
                            <input type="number" value="0" class="form-control margin-b-20 text-center" id="form-socios-digital" name="form-socios"
                            style="width: 100%; margin-top: 10px; font-size: 24px;" min="0">

                            <span style="color: #666;" id="text-funcionarios">Quantos funcionários?</span>
                            <input type="number" value="0" class="form-control margin-b-20 text-center" id="form-funcionarios-digital" name="form-funcionarios"
                            style="width: 100%; margin-top: 10px; font-size: 24px;" min="0">

                            <span style="color: #666;">Qual a faixa de faturamento mensal?</span>

                            <select class="form-control active  margin-b-40" style="width: 100%; margin-top: 0px; display: none;" id="text-faturamento-5k-digital">
                                <option value="1">R$ 0,00 a R$ 6.750,00</option>
                            </select>

                            <select class="form-control active  margin-b-40" name="form-faturamento" style="width: 100%; margin-top: 10px;" id="form-faturamento-digital">
  
                                <?php

                                    echo '<option value="1">R$ 0,00 a R$ 15.000,00</option>';

                                    $begin = 15000.01;
                                    $end = 30000.00;

                                    for ($i=2; $i < 50; $i++) {

                                        echo '<option value="'.$i.'">R$ '.number_format($begin, 2, ',', '.').' a R$ '.number_format($end, 2, ',', '.').'</option>';
                                        
                                        if($i == 1){
                                            $begin = $begin + 0.01;
                                        }

                                        $begin = $end;
                                        $end = $begin + 30000;
                                        // $begin = $begin + 25000;
                                        // $end = $end + 25000;
                                    }
                                ?>
                            </select>

                        </div>
                    </div>

                </form>

            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="box-result" style="border: none; background-color: #333;">

                    <img src="/img/logo-link-white.png" style="width: 130px;">

                    <h3 class="margin-t-20 margin-b-30" style="color: #fff; display: inline-block; ">
                        <strong>Contratando a Link Contabilidade</strong>
                    </h3>

                    <h4 class="margin-t-20" style="color: #999;">Abertura de empresa</h4>
                    <h3 class="margin-t-10" style="color: #fff;"><strong>GRÁTIS *</strong></h3>


                    <h4 class="margin-t-20" style="color: #999;">
                        Valor da sua mensalidade na Link Contabilidade
                    </h4>

                    <h2 class="margin-t-10" style="color: #fff;">
                        <strong id="result-mensalidade-digital"></strong> <span style="font-size: 11px;" id="text-month-digital">/ mês</span>
                    </h2>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 margin-t-20">
                        
                        <a href="/abrir-empresa-gratis" class="btn btn-yellow margin-t-20 size-lg">QUERO CONTRATAR</a>
                        
                    </div>

                    <div id="area-lucro-real" style="display: none;">
                        
                        <div class="row margin-t-20">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

                                <h4 class="margin-t-20" style="color: #999;">
                                    Abertura de empresa
                                </h4>

                                <h3 class="margin-t-10" style="color: #fff;">
                                    <strong>GRÁTIS *</strong>
                                </h3>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

                            <h4 class="margin-t-20" style="color: #999;">
                                    Valor da sua mensalidade na Link Contabilidade
                                </h4>

                                <h2 class="margin-t-10" style="color: #fff;">
                                    <strong>Sob consulta</strong>
                                </h2>

                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 margin-t-20">

                                <a href="/fale-conosco" class="btn btn-yellow margin-t-20 size-lg">QUERO CONTRATAR</a>
                                
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-xs-5 margin-t-30">
                <div id="area-lucro-real" style="display: none;">
                    
                    <div class="row margin-t-20">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

                            <h4 class="margin-t-20" style="color: #999;">
                                Abertura de empresa
                            </h4>

                            <h3 class="margin-t-10" style="color: #fff;">
                                <strong>GRÁTIS *</strong>
                            </h3>

                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

                        <h4 class="margin-t-20" style="color: #999;">
                                Valor da sua mensalidade na Link Contabilidade
                            </h4>

                            <h2 class="margin-t-10" style="color: #fff;">
                                <strong>Sob consulta</strong>
                            </h2>

                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 margin-t-20">

                            <a href="/fale-conosco" class="btn btn-yellow margin-t-20 size-lg">QUERO CONTRATAR</a>
                            
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</section>


<!-- RATES -->

<!-- Section 1 -->
<section class="" style="background-color: #ececec;">

    <div class="container" style="padding-bottom: 60px;">
            
        <h3 style="font-size: 34px; font-weight: 600; color: #202020; line-height: 40px;">
            Simule qual será o custo das taxas governamentais para abrir a sua empresa
        </h3>

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

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-t-50">
                <span class="sub-title" style="margin-bottom: 0px; color: #333;">eCPF A1 - Certificado Digital</span>
                <span class="icon ion-help-circled" data-toggle="modal" data-target="#help_certificado" style="margin-left: 8px; font-size: 18px; color: #929292; cursor: pointer;"></span>
                <br>
                <span class="sub-title" style="margin-bottom: 20px; color: #333; font-size: 26px; font-weight: 600;">R$ 124,00</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-t-50">
                <span class="sub-title" style="margin-bottom: 0px; color: #333;">eCNPJ A1 - Certificado Digital</span>
                <span class="icon ion-help-circled" data-toggle="modal" data-target="#help_certificado" style="margin-left: 8px; font-size: 18px; color: #929292; cursor: pointer;"></span>
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
    </div>
    
</section>

<style>

.table td, .table th {
    padding: 0 !important;
    vertical-align: middle !important;
    line-height: auto !important;
}

</style>

<!-- Section 1 -->
<section class="" style="background-color: #fff;" id="simular-mensalidade">

    <div class="container" style="padding-top: 100px; padding-bottom: 120px;">

        <div class="row" style="margin-top: 0px;">   

            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">
            </div>

            <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-xs-12 text-center animate-scroll">

                <h3 style="display: inline-block; font-size: 34px; margin-top: 25px; font-weight: 600; color: #202020; line-height: 40px; background-color: #ffce2c; border-radius: 10px; padding: 4px 40px;">
                    Comparativo
                </h3>

                <h3 style="font-size: 34px; margin-top: 25px; font-weight: 600; color: #202020; line-height: 40px; text-align: center;">
                    Contabilidade Consultiva e Contabilidade Digital
                </h3>
                
            </div>

            <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">

                
                <br><br><br><br>


                <div class="table-responsive">
                <table style="width: 100%;" class="table">

                <tr>
                <td style="width: 70%; background-color: #333; padding: 10px !important;">
                    <h3 style="font-size: 14px; font-weight: 600; color: #fff; line-height: 40px;">
                        GESTÃO EMPRESARIAL
                    </h3>
                </td>
                <td style="width: 15%; text-align: center; background-color: #ffce2c;  padding: 10px !important;">
                    <h3 style="font-size: 14px; font-weight: 600; color: #333; line-height: 20px;">
                        CONTABILIDADE <br>CONSULTIVA
                    </h3>
                </td>
                <td style="width: 15%; text-align: center; background-color: #ffce2c;  padding: 10px !important;">
                    <h3 style="font-size: 14px; font-weight: 600; color: #333; line-height: 20px;">
                        CONTABILIDADE <br>DIGITAL
                    </h3>
                </td>
                </tr>

                <tr>
                <td><br></td>
                <td><br></td>
                <td><br></td>
                </tr>
                
                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Apoio gerencial na tomada de decisão
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Reuniões periódicas para análise dos resultados
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Gráficos e indicadores que evidenciam pontos de melhoria e controle na gestão da empresa
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Análise das principais melhorias para a empresa
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Apuração de orçamentos anuais
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Apuração de fluxo de caixa
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Controle de custos
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Controle de despesas fixas e variáveis
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Controle de passivos fiscais
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Aproveitamentos de créditos e benefícios fiscais
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Investimentos adequados
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Sistema de gestão financeira
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>





                <tr>
                <td><br></td>
                <td><br></td>
                <td><br></td>
                </tr>

                <tr>
                <td style="width: 70%; background-color: #333; padding: 10px !important;">
                    <h3 style="font-size: 14px; font-weight: 600; color: #fff; line-height: 40px;">
                        RAMOS DE ATIVIDADES
                    </h3>
                </td>
                <td style="width: 15%; background-color: #333; padding: 10px !important;">
                </td>
                <td style="width: 15%; background-color: #333; padding: 10px !important;">
                </td>
                </tr>
                
                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Prestação de Serviços
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Comércio
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Prestação de Serviços e Comércio
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Indústrias
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>



                <tr>
                <td><br></td>
                <td><br></td>
                <td><br></td>
                </tr>

                <tr>
                <td style="width: 70%; background-color: #333; padding: 10px !important;">
                    <h3 style="font-size: 14px; font-weight: 600; color: #fff; line-height: 40px;">
                    ATENDIMENTO
                    </h3>
                </td>
                <td style="width: 15%; background-color: #333; padding: 10px !important;">
                </td>
                <td style="width: 15%; background-color: #333; padding: 10px !important;">
                </td>
                </tr>
                
                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Atendimento presencial
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Atendimento digital via plataforma, whatsapp, chat, vídeo conferência, email, telefone
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>




                <tr>
                <td><br></td>
                <td><br></td>
                <td><br></td>
                </tr>

                <tr>
                <td style="width: 70%; background-color: #333; padding: 10px !important;">
                    <h3 style="font-size: 14px; font-weight: 600; color: #fff; line-height: 40px;">
                    TÉCNICA
                    </h3>
                </td>
                <td style="width: 15%; background-color: #333; padding: 10px !important;">
                </td>
                <td style="width: 15%; background-color: #333; padding: 10px !important;">
                </td>
                </tr>
                
                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                        Obrigações federais, estaduais e municipais
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                    Emissão e cálculo de impostos
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                    Declaração de imposto de renda pessoa jurídica
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                    Obrigações com a folha de pagamento
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                    Pró-labore dos sócios
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                    Obrigações acessórias como DCTF, SPED e outras
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>

                <tr>
                <td style="width: 70%;">
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                    Relatórios contábeis anuais (Balanço Patrimonial, DRE, etc)
                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>





                <tr>
                <td><br></td>
                <td><br></td>
                <td><br></td>
                </tr>

                <tr>
                <td style="width: 70%; background-color: #333; padding: 10px !important;">
                    <h3 style="font-size: 14px; font-weight: 600; color: #fff; line-height: 40px;">
                    PARCEIROS
                    </h3>
                </td>
                <td style="width: 15%; background-color: #333; padding: 10px !important;">
                </td>
                <td style="width: 15%; background-color: #333; padding: 10px !important;">
                </td>
                </tr>
                
                <tr>
                <td style="width: 70%;">
                <br>
                    <span class="sub-title" style="margin-bottom: 0px; color: #333; font-size: 12px;">
                    Consultoria gratuita por vídeo conferência nas áreas: Jurídica Empresarial,  Marketing Digital, Finanças Pessoais, Mapeamento de Processos e Registro de Marcas e Patentes.

                    </span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                <td style="width: 15%; text-align: center;">
                    <span class="icon ion-android-done" style="display: block; margin-bottom: 14px; font-size: 26px; color: #929292;"></span>
                </td>
                </tr>

                </table>

                </div>

            </div>

        </div>
    </div>

</section>


<!-- Section 1 -->
<section class=""
    style="background-color: #fff; ">

    <div class="container" style="padding-top: 20px; padding-bottom: 50px;">

        <div class="row" style="margin-top: 0px;">

            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-center">
            </div>

            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 text-center">

                <!-- <img src="/img/image-1.jpg" class="img-fluid"> -->

                <h3 style="font-size: 34px; margin-top: 25px; font-weight: 600; color: #202020; line-height: 40px;">
                    Nosso diferencial
                </h3>
            </div>

            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 text-center">
            </div>
        </div>

        <div class="row" style="margin-top: 60px;">

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll text-center" style="padding: 10px;">

                <div style="background-color: #ffce2c; height: 100%; padding: 40px 20px; border-radius: 20px;">
                    <img src="/img/icon-diferencial-2.png" class="img-fluid" width="140px">

                    <h3 style="font-size: 20px; margin-top: 25px; font-weight: 600; color: #202020; line-height: 30px;">
                        Redução da carga tributária
                    </h3>

                    <p style="margin-top: 16px; font-size: 14px; color: #333; line-height: 24px;">
                        Tenha as melhores estratégias para redução os tributos de acordo com a legislação.
                    </p>
                </div>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll text-center" style="padding: 10px;">

                <div style="background-color: #ffce2c; height: 100%; padding: 40px 20px; border-radius: 20px;">
                    <img src="/img/icon-diferencial-1.png" class="img-fluid" width="140px">

                    <h3 style="font-size: 20px; margin-top: 25px; font-weight: 600; color: #202020; line-height: 30px;">
                        Tenha um contador consultor perto de você
                    </h3>

                    <p style="margin-top: 16px; font-size: 14px; color: #333; line-height: 24px;">
                        Receba orientações, visitas e ligações do seu contador para aumentar os resultados do seu negócio.
                    </p>
                </div>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll text-center" style="padding: 10px;">

                <div style="background-color: #ffce2c; height: 100%; padding: 40px 20px; border-radius: 20px;">
                    <img src="/img/icon-diferencial-4.png" class="img-fluid" width="140px">

                    <h3 style="font-size: 20px; margin-top: 25px; font-weight: 600; color: #202020; line-height: 30px;">
                        Domine os números do seu negócio
                    </h3>

                    <p style="margin-top: 16px; font-size: 14px; color: #333; line-height: 24px;">
                        Analise as finanças de seu negócio medindo, monitorando e melhorando as receitas, custos, despesas e investimentos com apoio de um contador especialista.
                    </p>
                </div>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll text-center" style="padding: 10px;">

                <div style="background-color: #ffce2c; height: 100%; padding: 40px 20px; border-radius: 20px;">
                    <img src="/img/icon-diferencial-3.png" class="img-fluid" width="140px">

                    <h3 style="font-size: 20px; margin-top: 25px; font-weight: 600; color: #202020; line-height: 30px;">
                        Siga as melhores práticas de gestão

                    </h3>

                    <p style="margin-top: 16px; font-size: 14px; color: #333; line-height: 24px;">
                        Alcance o sucesso através de uma técnica testado e exclusivo, dividido em 8 passos que vai transformar sua vida empresarial.
                    </p>
                </div>

            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll text-center" style="padding: 10px;">
                
                <br><br>

                <h3 style="display: inline-block; font-size: 34px; margin-top: 25px; font-weight: 600; color: #202020; line-height: 40px; background-color: ; margin-bottom: 10px;">
                    Vamos te ajudar a transformar a sua ideia em um negócio de sucesso
                </h3>
                
            </div>
            
        </div>

    </div>

</section>



<!-- Section 1 -->
<section class=""
    style="background-color: #ffce2c; ">

    <div class="container" style="padding-top: 50px; padding-bottom: 50px;">

        <div class="row" style="margin-top: 0px;">
            
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">

                <h3 style="font-size: 30px; font-weight: 600; color: #202020; line-height: 40px;">
                    Saiba quanto vai custar a sua Contabilidade Consultiva Digital!
                </h3>

            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

                <a href="#simular-mensalidade" class="btn btn-dark size-lg margin-t-20">
                    FAZER SIMULAÇÃO
                </a>

            </div>
        </div>

    </div>

</section>
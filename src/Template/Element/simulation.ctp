
<div class="modal fade" id="modalSimulation" tabindex="-1" role="dialog" aria-labelledby="modalSimulationLabel" aria-hidden="true">
    <div class="modal-dialog size-medium" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
            </div>
            <div class="modal-body" style="border: none;">

                <div class="row simulation" id="calculadora-consultiva" style="padding-top: 0px;">
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
                        <form id="form-service-1" class="box-simulation"  style="border: none; padding-top: 0px;">
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
                
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

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
        </div>
    </div>
</div>


<div class="modal fade" id="alert_lucro_real" tabindex="-1" role="dialog" aria-labelledby="alert_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

            <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h3 style="font-weight: 500; color: #666;">Formulário para consulta de precificação</h3>
            </div>
            <div class="modal-body">

                <br>
                <p style="display: block;padding: 20px;border: 1px solid #ffce2c;border-radius: 10px;background-color: #ffffff;color: #666;margin-top: 20px;">
                    <strong>ABERTURA GRATUITA</strong><br>
                    Abertura de empresa grátis mediante a contratação de 12 meses de serviços contábeis.                
                </p>

                <br>
                <p style="color: #666;">
                Para precificação no Lucro Real precisamos saber um pouco mais sobre sua empresa, por isso sugerimos que nos chame via whatsapp ou preencha o formulário clicando em um dos botões abaixo.
                </p>

                <form id="form_step_2_agendamento" method="POST" style="padding: 0; margin-top: 30px;">

                    <div class="row">

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                            <p class="text margin-t-20" style="margin-bottom: 10px; color: #969696; font-weight: 600;">CNPJ / MF</p>

                            <input type="text" class="form-control required mask-cnpj required" name="lucro_real_cnpj" id="input-cnpj-lucro-real" style="font-size: 14px; background-color: #fff;">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Regime de Tributação:</p>

                            <input type="number" min="0" class="form-control required required" name="lucro_real_tributacao" style="font-size: 14px; background-color: #fff;">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Quantidade de sócios</p>

                            <input type="number" min="0" class="form-control required required" name="lucro_real_socios" style="font-size: 14px; background-color: #fff;">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Quantidade de Funcionários</p>

                            <input type="number" min="0" class="form-control required required" name="lucro_real_funcionarios" style="font-size: 14px; background-color: #fff;">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Média de Faturamento/mês</p>

                            <input type="number" min="0" class="form-control required required" name="lucro_real_faturamento" style="font-size: 14px; background-color: #fff;">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">A empresa possui filial</p>

                            <input type="text" class="form-control required required" name="lucro_real_filial" style="font-size: 14px; background-color: #fff;">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">A empresa faz processo Importação/Exportação</p>

                            <input type="text"class="form-control required" name="lucro_real_exportacao" style="font-size: 14px; background-color: #fff;">
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Utiliza ERP ou algum sistema de gestão. Caso afirmativo, qual?</p>

                            <input type="text" id="input-lucro-real" class="form-control required" name="lucro_real_gestao" style="font-size: 14px; background-color: #fff;">
                        </div>

                    </div>

                    

                    <div class="text-center">
                        <button  type="button" class="btn btn-yellow size-lg margin-t-30"  id="btn-formulario-step-2">ENVIAR</button>
                        <a class="btn btn-yellow size-lg margin-t-30" id="btn-agendar-step-2" target="_blank" href="https://api.whatsapp.com/send?phone=5512981473602">FALAR VIA WHATSAPP</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

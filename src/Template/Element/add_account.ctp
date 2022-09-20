
<div class="modal fade" id="add_account" tabindex="-1" role="dialog" aria-labelledby="add_accountLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar conta</h4>
            </div>
            <div class="modal-body">

                <form id="form_add_account">

                    <input type='hidden' name="business_id" value="<?= $business_id; ?>" id="business_id">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Banco</p>
                    <select type="text" class="form-control accountant" name="account_bank" style="font-size: 14px; background-color: #fff;">
                        <option value="	Caixa interno	">	Caixa interno	</option>
                        <option value="	Banco ABC Brasil S.A.	">	Banco ABC Brasil S.A.	</option>
                        <option value="	Banco Cooperativo Sicredi S.A.	">	Banco Cooperativo Sicredi S.A.	</option>
                        <option value="	Advanced Cc Ltda	">	Advanced Cc Ltda	</option>
                        <option value="	Banco Agibank S.A.	">	Banco Agibank S.A.	</option>
                        <option value="	Albatross Ccv S.A	">	Albatross Ccv S.A	</option>
                        <option value="	Ativa Investimentos S.A	">	Ativa Investimentos S.A	</option>
                        <option value="	Avista S.A. Crédito, Financiamento e Investimento	">	Avista S.A. Crédito, Financiamento e Investimento	</option>
                        <option value="	B&T Cc Ltda	">	B&T Cc Ltda	</option>
                        <option value="	Banco A.J.Renner S.A.	">	Banco A.J.Renner S.A.	</option>
                        <option value="	Banco ABC Brasil S.A.	">	Banco ABC Brasil S.A.	</option>
                        <option value="	Banco ABN AMRO S.A	">	Banco ABN AMRO S.A	</option>
                        <option value="	Banco Agibank S.A.	">	Banco Agibank S.A.	</option>
                        <option value="	Banco Alfa S.A.	">	Banco Alfa S.A.	</option>
                        <option value="	Banco Alvorada S.A.	">	Banco Alvorada S.A.	</option>
                        <option value="	Banco Andbank (Brasil) S.A.	">	Banco Andbank (Brasil) S.A.	</option>
                        <option value="	Banco Arbi S.A.	">	Banco Arbi S.A.	</option>
                        <option value="	Banco B3 S.A.	">	Banco B3 S.A.	</option>
                        <option value="	Banco BANDEPE S.A.	">	Banco BANDEPE S.A.	</option>
                        <option value="	Banco BMG S.A.	">	Banco BMG S.A.	</option>
                        <option value="	Banco BNP Paribas Brasil S.A.	">	Banco BNP Paribas Brasil S.A.	</option>
                        <option value="	Banco BOCOM BBM S.A.	">	Banco BOCOM BBM S.A.	</option>
                        <option value="	Banco Bradescard S.A.	">	Banco Bradescard S.A.	</option>
                        <option value="	Banco Bradesco BBI S.A.	">	Banco Bradesco BBI S.A.	</option>
                        <option value="	Banco Bradesco BERJ S.A.	">	Banco Bradesco BERJ S.A.	</option>
                        <option value="	Banco Bradesco Cartões S.A.	">	Banco Bradesco Cartões S.A.	</option>
                        <option value="	Banco Bradesco Financiamentos S.A.	">	Banco Bradesco Financiamentos S.A.	</option>
                        <option value="	Banco Bradesco S.A.	">	Banco Bradesco S.A.	</option>
                        <option value="	Banco BS2 S.A.	">	Banco BS2 S.A.	</option>
                        <option value="	Banco BTG Pactual S.A.	">	Banco BTG Pactual S.A.	</option>
                        <option value="	Banco C6 S.A – C6 Bank	">	Banco C6 S.A – C6 Bank	</option>
                        <option value="	Banco Caixa Geral – Brasil S.A.	">	Banco Caixa Geral – Brasil S.A.	</option>
                        <option value="	Banco Capital S.A.	">	Banco Capital S.A.	</option>
                        <option value="	Banco Cargill S.A.	">	Banco Cargill S.A.	</option>
                        <option value="	Banco Carrefour	">	Banco Carrefour	</option>
                        <option value="	Banco Cédula S.A.	">	Banco Cédula S.A.	</option>
                        <option value="	Banco Cetelem S.A.	">	Banco Cetelem S.A.	</option>
                        <option value="	Banco Cifra S.A.	">	Banco Cifra S.A.	</option>
                        <option value="	Banco Citibank S.A.	">	Banco Citibank S.A.	</option>
                        <option value="	Banco Clássico S.A.	">	Banco Clássico S.A.	</option>
                        <option value="	Banco Cooperativo do Brasil S.A. – BANCOOB	">	Banco Cooperativo do Brasil S.A. – BANCOOB	</option>
                        <option value="	Banco Cooperativo Sicredi S.A.	">	Banco Cooperativo Sicredi S.A.	</option>
                        <option value="	Banco Credit Agricole Brasil S.A.	">	Banco Credit Agricole Brasil S.A.	</option>
                        <option value="	Banco Credit Suisse (Brasil) S.A.	">	Banco Credit Suisse (Brasil) S.A.	</option>
                        <option value="	Banco Crefisa S.A.	">	Banco Crefisa S.A.	</option>
                        <option value="	Banco da Amazônia S.A.	">	Banco da Amazônia S.A.	</option>
                        <option value="	Banco da China Brasil S.A.	">	Banco da China Brasil S.A.	</option>
                        <option value="	Banco Daycoval S.A.	">	Banco Daycoval S.A.	</option>
                        <option value="	Banco de Desenvolvimento do Espírito Santo S.A.	">	Banco de Desenvolvimento do Espírito Santo S.A.	</option>
                        <option value="	Banco de La Nacion Argentina	">	Banco de La Nacion Argentina	</option>
                        <option value="	Banco de La Provincia de Buenos Aires	">	Banco de La Provincia de Buenos Aires	</option>
                        <option value="	Banco de La Republica Oriental del Uruguay	">	Banco de La Republica Oriental del Uruguay	</option>
                        <option value="	Banco Digio S.A	">	Banco Digio S.A	</option>
                        <option value="	Banco do Brasil S.A.	">	Banco do Brasil S.A.	</option>
                        <option value="	Banco do Estado de Sergipe S.A.	">	Banco do Estado de Sergipe S.A.	</option>
                        <option value="	Banco do Estado do Pará S.A.	">	Banco do Estado do Pará S.A.	</option>
                        <option value="	Banco do Estado do Rio Grande do Sul S.A.	">	Banco do Estado do Rio Grande do Sul S.A.	</option>
                        <option value="	Banco do Nordeste do Brasil S.A.	">	Banco do Nordeste do Brasil S.A.	</option>
                        <option value="	Banco Fair Corretora de Câmbio S.A	">	Banco Fair Corretora de Câmbio S.A	</option>
                        <option value="	Banco Fator S.A.	">	Banco Fator S.A.	</option>
                        <option value="	Banco Fibra S.A.	">	Banco Fibra S.A.	</option>
                        <option value="	Banco Ficsa S.A.	">	Banco Ficsa S.A.	</option>
                        <option value="	Banco Finaxis S.A.	">	Banco Finaxis S.A.	</option>
                        <option value="	Banco Guanabara S.A.	">	Banco Guanabara S.A.	</option>
                        <option value="	Banco Inbursa S.A.	">	Banco Inbursa S.A.	</option>
                        <option value="	Banco Industrial do Brasil S.A.	">	Banco Industrial do Brasil S.A.	</option>
                        <option value="	Banco Indusval S.A.	">	Banco Indusval S.A.	</option>
                        <option value="	Banco Inter S.A.	">	Banco Inter S.A.	</option>
                        <option value="	Banco Investcred Unibanco S.A.	">	Banco Investcred Unibanco S.A.	</option>
                        <option value="	Banco Itaú BBA S.A.	">	Banco Itaú BBA S.A.	</option>
                        <option value="	Banco Itaú Consignado S.A.	">	Banco Itaú Consignado S.A.	</option>
                        <option value="	Banco ItauBank S.A	">	Banco ItauBank S.A	</option>
                        <option value="	Banco J. P. Morgan S.A.	">	Banco J. P. Morgan S.A.	</option>
                        <option value="	Banco J. Safra S.A.	">	Banco J. Safra S.A.	</option>
                        <option value="	Banco John Deere S.A.	">	Banco John Deere S.A.	</option>
                        <option value="	Banco KDB S.A.	">	Banco KDB S.A.	</option>
                        <option value="	Banco KEB HANA do Brasil S.A.	">	Banco KEB HANA do Brasil S.A.	</option>
                        <option value="	Banco Luso Brasileiro S.A.	">	Banco Luso Brasileiro S.A.	</option>
                        <option value="	Banco Máxima S.A.	">	Banco Máxima S.A.	</option>
                        <option value="	Banco Maxinvest S.A.	">	Banco Maxinvest S.A.	</option>
                        <option value="	Banco Mercantil de Investimentos S.A.	">	Banco Mercantil de Investimentos S.A.	</option>
                        <option value="	Banco Mercantil do Brasil S.A.	">	Banco Mercantil do Brasil S.A.	</option>
                        <option value="	Banco Mizuho do Brasil S.A.	">	Banco Mizuho do Brasil S.A.	</option>
                        <option value="	Banco Modal S.A.	">	Banco Modal S.A.	</option>
                        <option value="	Banco Morgan Stanley S.A.	">	Banco Morgan Stanley S.A.	</option>
                        <option value="	Banco MUFG Brasil S.A.	">	Banco MUFG Brasil S.A.	</option>
                        <option value="	Banco Nacional de Desenvolvimento Econômico e Social – BNDES	">	Banco Nacional de Desenvolvimento Econômico e Social – BNDES	</option>
                        <option value="	Banco Olé Bonsucesso Consignado S.A.	">	Banco Olé Bonsucesso Consignado S.A.	</option>
                        <option value="	Banco Oliveira Trust Dtvm S.A	">	Banco Oliveira Trust Dtvm S.A	</option>
                        <option value="	Banco Original do Agronegócio S.A.	">	Banco Original do Agronegócio S.A.	</option>
                        <option value="	Banco Original S.A.	">	Banco Original S.A.	</option>
                        <option value="	Banco Ourinvest S.A.	">	Banco Ourinvest S.A.	</option>
                        <option value="	Banco PAN S.A.	">	Banco PAN S.A.	</option>
                        <option value="	Banco Paulista S.A.	">	Banco Paulista S.A.	</option>
                        <option value="	Banco Pine S.A.	">	Banco Pine S.A.	</option>
                        <option value="	Banco Porto Real de Investimentos S.A.	">	Banco Porto Real de Investimentos S.A.	</option>
                        <option value="	Banco Rabobank International Brasil S.A.	">	Banco Rabobank International Brasil S.A.	</option>
                        <option value="	Banco Rendimento S.A.	">	Banco Rendimento S.A.	</option>
                        <option value="	Banco Ribeirão Preto S.A.	">	Banco Ribeirão Preto S.A.	</option>
                        <option value="	Banco Rodobens S.A.	">	Banco Rodobens S.A.	</option>
                        <option value="	Banco Safra S.A.	">	Banco Safra S.A.	</option>
                        <option value="	Banco Santander (Brasil) S.A.	">	Banco Santander (Brasil) S.A.	</option>
                        <option value="	Banco Semear S.A.	">	Banco Semear S.A.	</option>
                        <option value="	Banco Sistema S.A.	">	Banco Sistema S.A.	</option>
                        <option value="	Banco Smartbank S.A.	">	Banco Smartbank S.A.	</option>
                        <option value="	Banco Société Générale Brasil S.A.	">	Banco Société Générale Brasil S.A.	</option>
                        <option value="	Banco Sofisa S.A.	">	Banco Sofisa S.A.	</option>
                        <option value="	Banco Sumitomo Mitsui Brasileiro S.A.	">	Banco Sumitomo Mitsui Brasileiro S.A.	</option>
                        <option value="	Banco Topázio S.A.	">	Banco Topázio S.A.	</option>
                        <option value="	Banco Triângulo S.A.	">	Banco Triângulo S.A.	</option>
                        <option value="	Banco Tricury S.A.	">	Banco Tricury S.A.	</option>
                        <option value="	Banco Votorantim S.A.	">	Banco Votorantim S.A.	</option>
                        <option value="	Banco VR S.A.	">	Banco VR S.A.	</option>
                        <option value="	Banco Western Union do Brasil S.A.	">	Banco Western Union do Brasil S.A.	</option>
                        <option value="	Banco Woori Bank do Brasil S.A.	">	Banco Woori Bank do Brasil S.A.	</option>
                        <option value="	Banco Xp S/A	">	Banco Xp S/A	</option>
                        <option value="	BancoSeguro S.A.	">	BancoSeguro S.A.	</option>
                        <option value="	BANESTES S.A. Banco do Estado do Espírito Santo	">	BANESTES S.A. Banco do Estado do Espírito Santo	</option>
                        <option value="	Bank of America Merrill Lynch Banco Múltiplo S.A.	">	Bank of America Merrill Lynch Banco Múltiplo S.A.	</option>
                        <option value="	Barigui Companhia Hipotecária	">	Barigui Companhia Hipotecária	</option>
                        <option value="	BCV – Banco de Crédito e Varejo S.A.	">	BCV – Banco de Crédito e Varejo S.A.	</option>
                        <option value="	BEXS Banco de Câmbio S.A.	">	BEXS Banco de Câmbio S.A.	</option>
                        <option value="	Bexs Corretora de Câmbio S/A	">	Bexs Corretora de Câmbio S/A	</option>
                        <option value="	Bgc Liquidez Dtvm Ltda	">	Bgc Liquidez Dtvm Ltda	</option>
                        <option value="	BNY Mellon Banco S.A.	">	BNY Mellon Banco S.A.	</option>
                        <option value="	Bpp Instituição De Pagamentos S.A	">	Bpp Instituição De Pagamentos S.A	</option>
                        <option value="	BR Partners Banco de Investimento S.A.	">	BR Partners Banco de Investimento S.A.	</option>
                        <option value="	BRB – Banco de Brasília S.A.	">	BRB – Banco de Brasília S.A.	</option>
                        <option value="	Brickell S.A. Crédito, Financiamento e Investimento	">	Brickell S.A. Crédito, Financiamento e Investimento	</option>
                        <option value="	BRL Trust Distribuidora de Títulos e Valores Mobiliários S.A.	">	BRL Trust Distribuidora de Títulos e Valores Mobiliários S.A.	</option>
                        <option value="	Broker Brasil Cc Ltda	">	Broker Brasil Cc Ltda	</option>
                        <option value="	BS2 Distribuidora de Títulos e Valores Mobiliários S.A.	">	BS2 Distribuidora de Títulos e Valores Mobiliários S.A.	</option>
                        <option value="	C.Suisse Hedging-Griffo Cv S.A (Credit Suisse)	">	C.Suisse Hedging-Griffo Cv S.A (Credit Suisse)	</option>
                        <option value="	Caixa Econômica Federal	">	Caixa Econômica Federal	</option>
                        <option value="	Carol Distribuidora de Títulos e Valor Mobiliários Ltda	">	Carol Distribuidora de Títulos e Valor Mobiliários Ltda	</option>
                        <option value="	Caruana Scfi	">	Caruana Scfi	</option>
                        <option value="	Casa Credito S.A	">	Casa Credito S.A	</option>
                        <option value="	Ccm Desp Trâns Sc E Rs	">	Ccm Desp Trâns Sc E Rs	</option>
                        <option value="	Ccr Reg Mogiana	">	Ccr Reg Mogiana	</option>
                        <option value="	Central Cooperativa De Crédito No Estado Do Espírito Santo	">	Central Cooperativa De Crédito No Estado Do Espírito Santo	</option>
                        <option value="	Central das Cooperativas de Economia e Crédito Mútuo doEstado do Espírito Santo Ltda.	">	Central das Cooperativas de Economia e Crédito Mútuo doEstado do Espírito Santo Ltda.	</option>
                        <option value="	China Construction Bank (Brasil) Banco Múltiplo S.A.	">	China Construction Bank (Brasil) Banco Múltiplo S.A.	</option>
                        <option value="	Citibank N.A.	">	Citibank N.A.	</option>
                        <option value="	Cm Capital Markets Cctvm Ltda	">	Cm Capital Markets Cctvm Ltda	</option>
                        <option value="	Codepe Cvc S.A	">	Codepe Cvc S.A	</option>
                        <option value="	Commerzbank Brasil S.A. – Banco Múltiplo	">	Commerzbank Brasil S.A. – Banco Múltiplo	</option>
                        <option value="	Confidence Cc S.A	">	Confidence Cc S.A	</option>
                        <option value="	Coop Central Ailos	">	Coop Central Ailos	</option>
                        <option value="	Cooperativa Central de Crédito Noroeste Brasileiro Ltda.	">	Cooperativa Central de Crédito Noroeste Brasileiro Ltda.	</option>
                        <option value="	Cooperativa Central de Crédito Urbano-CECRED	">	Cooperativa Central de Crédito Urbano-CECRED	</option>
                        <option value="	Cooperativa Central de Economia e Crédito Mutuo – SICOOB UNIMAIS	">	Cooperativa Central de Economia e Crédito Mutuo – SICOOB UNIMAIS	</option>
                        <option value="	Cooperativa Central de Economia e Crédito Mútuo das Unicredsde Santa Catarina e Paraná	">	Cooperativa Central de Economia e Crédito Mútuo das Unicredsde Santa Catarina e Paraná	</option>
                        <option value="	Cooperativa de Crédito Rural da Região da Mogiana	">	Cooperativa de Crédito Rural da Região da Mogiana	</option>
                        <option value="	Cooperativa de Crédito Rural De Ouro	">	Cooperativa de Crédito Rural De Ouro	</option>
                        <option value="	Cooperativa de Crédito Rural de Primavera Do Leste	">	Cooperativa de Crédito Rural de Primavera Do Leste	</option>
                        <option value="	Cooperativa de Crédito Rural de São Miguel do Oeste – Sulcredi/São Miguel	">	Cooperativa de Crédito Rural de São Miguel do Oeste – Sulcredi/São Miguel	</option>
                        <option value="	Credialiança Ccr	">	Credialiança Ccr	</option>
                        <option value="	CREDIALIANÇA COOPERATIVA DE CRÉDITO RURAL	">	CREDIALIANÇA COOPERATIVA DE CRÉDITO RURAL	</option>
                        <option value="	Credicoamo	">	Credicoamo	</option>
                        <option value="	Cresol Confederação	">	Cresol Confederação	</option>
                        <option value="	Dacasa Financeira S/A	">	Dacasa Financeira S/A	</option>
                        <option value="	Banco Daycoval S.A.	">	Banco Daycoval S.A.	</option>
                        <option value="	Deutsche Bank S.A. – Banco Alemão	">	Deutsche Bank S.A. – Banco Alemão	</option>
                        <option value="	Easynvest – Título Cv S.A	">	Easynvest – Título Cv S.A	</option>
                        <option value="	Facta S.A. Cfi	">	Facta S.A. Cfi	</option>
                        <option value="	Frente Corretora de Câmbio Ltda.	">	Frente Corretora de Câmbio Ltda.	</option>
                        <option value="	Genial Investimentos Corretora de Valores Mobiliários S.A.	">	Genial Investimentos Corretora de Valores Mobiliários S.A.	</option>
                        <option value="	Get Money Cc Ltda	">	Get Money Cc Ltda	</option>
                        <option value="	Goldman Sachs do Brasil Banco Múltiplo S.A.	">	Goldman Sachs do Brasil Banco Múltiplo S.A.	</option>
                        <option value="	Guide Investimentos S.A. Corretora de Valores	">	Guide Investimentos S.A. Corretora de Valores	</option>
                        <option value="	Guitta Corretora de Câmbio Ltda	">	Guitta Corretora de Câmbio Ltda	</option>
                        <option value="	Haitong Banco de Investimento do Brasil S.A.	">	Haitong Banco de Investimento do Brasil S.A.	</option>
                        <option value="	Hipercard Banco Múltiplo S.A.	">	Hipercard Banco Múltiplo S.A.	</option>
                        <option value="	HS Financeira S/A Crédito, Financiamento e Investimentos	">	HS Financeira S/A Crédito, Financiamento e Investimentos	</option>
                        <option value="	HSBC Brasil S.A. – Banco de Investimento	">	HSBC Brasil S.A. – Banco de Investimento	</option>
                        <option value="	IB Corretora de Câmbio, Títulos e Valores Mobiliários S.A.	">	IB Corretora de Câmbio, Títulos e Valores Mobiliários S.A.	</option>
                        <option value="	Icap Do Brasil Ctvm Ltda	">	Icap Do Brasil Ctvm Ltda	</option>
                        <option value="	ICBC do Brasil Banco Múltiplo S.A.	">	ICBC do Brasil Banco Múltiplo S.A.	</option>
                        <option value="	ING Bank N.V.	">	ING Bank N.V.	</option>
                        <option value="	Intesa Sanpaolo Brasil S.A. – Banco Múltiplo	">	Intesa Sanpaolo Brasil S.A. – Banco Múltiplo	</option>
                        <option value="	Itaú Unibanco Holding S.A.	">	Itaú Unibanco Holding S.A.	</option>
                        <option value="	Itaú Unibanco S.A.	">	Itaú Unibanco S.A.	</option>
                        <option value="	JPMorgan Chase Bank, National Association	">	JPMorgan Chase Bank, National Association	</option>
                        <option value="	Kirton Bank S.A. – Banco Múltiplo	">	Kirton Bank S.A. – Banco Múltiplo	</option>
                        <option value="	Lastro RDV Distribuidora de Títulos e Valores Mobiliários Ltda.	">	Lastro RDV Distribuidora de Títulos e Valores Mobiliários Ltda.	</option>
                        <option value="	Lecca Crédito, Financiamento e Investimento S/A	">	Lecca Crédito, Financiamento e Investimento S/A	</option>
                        <option value="	Levycam Ccv Ltda	">	Levycam Ccv Ltda	</option>
                        <option value="	Magliano S.A	">	Magliano S.A	</option>
                        <option value="	Mercado Pago – Conta Do Mercado Livre	">	Mercado Pago – Conta Do Mercado Livre	</option>
                        <option value="	MS Bank S.A. Banco de Câmbio	">	MS Bank S.A. Banco de Câmbio	</option>
                        <option value="	Multimoney Cc Ltda	">	Multimoney Cc Ltda	</option>
                        <option value="	Natixis Brasil S.A. Banco Múltiplo	">	Natixis Brasil S.A. Banco Múltiplo	</option>
                        <option value="	Nova Futura Corretora de Títulos e Valores Mobiliários Ltda.	">	Nova Futura Corretora de Títulos e Valores Mobiliários Ltda.	</option>
                        <option value="	Novo Banco Continental S.A. – Banco Múltiplo	">	Novo Banco Continental S.A. – Banco Múltiplo	</option>
                        <option value="	Nu Pagamentos S.A (Nubank)	">	Nu Pagamentos S.A (Nubank)	</option>
                        <option value="	Omni Banco S.A.	">	Omni Banco S.A.	</option>
                        <option value="	Omni Banco S.A.	">	Omni Banco S.A.	</option>
                        <option value="	Pagseguro Internet S.A	">	Pagseguro Internet S.A	</option>
                        <option value="	Paraná Banco S.A.	">	Paraná Banco S.A.	</option>
                        <option value="	Parati – Crédito Financiamento e Investimento S.A.	">	Parati – Crédito Financiamento e Investimento S.A.	</option>
                        <option value="	Parmetal Distribuidora de Títulos e Valores Mobiliários Ltda	">	Parmetal Distribuidora de Títulos e Valores Mobiliários Ltda	</option>
                        <option value="	Pernambucanas Financ S.A	">	Pernambucanas Financ S.A	</option>
                        <option value="	Planner Corretora De Valores S.A	">	Planner Corretora De Valores S.A	</option>
                        <option value="	Plural S.A. – Banco Múltiplo	">	Plural S.A. – Banco Múltiplo	</option>
                        <option value="	Pólocred Scmepp Ltda	">	Pólocred Scmepp Ltda	</option>
                        <option value="	Portocred S.A	">	Portocred S.A	</option>
                        <option value="	Rb Capital Investimentos Dtvm Ltda	">	Rb Capital Investimentos Dtvm Ltda	</option>
                        <option value="	Renascenca Dtvm Ltda	">	Renascenca Dtvm Ltda	</option>
                        <option value="	Sagitur Corretora de Câmbio Ltda.	">	Sagitur Corretora de Câmbio Ltda.	</option>
                        <option value="	Scotiabank Brasil S.A. Banco Múltiplo	">	Scotiabank Brasil S.A. Banco Múltiplo	</option>
                        <option value="	Senff S.A. – Crédito, Financiamento e Investimento	">	Senff S.A. – Crédito, Financiamento e Investimento	</option>
                        <option value="	Senso Ccvm S.A	">	Senso Ccvm S.A	</option>
                        <option value="	Servicoop	">	Servicoop	</option>
                        <option value="	Socred S.A	">	Socred S.A	</option>
                        <option value="	Sorocred Crédito, Financiamento e Investimento S.A.	">	Sorocred Crédito, Financiamento e Investimento S.A.	</option>
                        <option value="	Standard Chartered Bank (Brasil) S/A–Bco Invest.	">	Standard Chartered Bank (Brasil) S/A–Bco Invest.	</option>
                        <option value="	Stone Pagamentos S.A	">	Stone Pagamentos S.A	</option>
                        <option value="	Super Pagamentos e Administração de Meios Eletrônicos S.A.	">	Super Pagamentos e Administração de Meios Eletrônicos S.A.	</option>
                        <option value="	Travelex Banco de Câmbio S.A.	">	Travelex Banco de Câmbio S.A.	</option>
                        <option value="	Treviso Corretora de Câmbio S.A.	">	Treviso Corretora de Câmbio S.A.	</option>
                        <option value="	Tullett Prebon Brasil Cvc Ltda	">	Tullett Prebon Brasil Cvc Ltda	</option>
                        <option value="	UBS Brasil Banco de Investimento S.A.	">	UBS Brasil Banco de Investimento S.A.	</option>
                        <option value="	Unicred Central do Rio Grande do Sul	">	Unicred Central do Rio Grande do Sul	</option>
                        <option value="	Unicred Central Rs	">	Unicred Central Rs	</option>
                        <option value="	Unicred Cooperativa	">	Unicred Cooperativa	</option>
                        <option value="	UNIPRIME Central – Central Interestadual de Cooperativas de Crédito Ltda.	">	UNIPRIME Central – Central Interestadual de Cooperativas de Crédito Ltda.	</option>
                        <option value="	Uniprime Norte do Paraná – Coop de Economia eCrédito Mútuo dos Médicos, Profissionais das Ciências	">	Uniprime Norte do Paraná – Coop de Economia eCrédito Mútuo dos Médicos, Profissionais das Ciências	</option>
                        <option value="	Vips Cc Ltda	">	Vips Cc Ltda	</option>
                        <option value="	Vortx Distribuidora de Títulos e Valores Mobiliários Ltda	">	Vortx Distribuidora de Títulos e Valores Mobiliários Ltda	</option>
                        <option value="	Vortx Distribuidora de Títulos e Valores Mobiliários Ltda	">	Xp Investimentos S.A	</option>
                    </select>

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de conta</p>
                    <select type="text" class="form-control accountant" name="account_account_type" style="font-size: 14px; background-color: #fff;">
                        <option value="corrente">Conta corrente</option>
                        <option value="poupanca">Conta poupança</option>
                        <option value="investimento">Conta investimento</option>
                    </select>

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Agência</p>
                    <input type="text" class="form-control accountant" name="account_agency" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Conta</p>
                    <input type="text" class="form-control accountant" name="account_account" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Saldo disponível (R$)</p>
                    <input type="text" class="form-control accountant required money2" name="account_total" style="font-size: 14px; background-color: #fff;">

                    <?php

                        $date = date_format($date_now, 'd/m/Y');
                        $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

                    ?>

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Data do saldo</p>

                    <div class="input-date">
                        <div class="icon ion-android-calendar arrow"></div>

                        <input type="text" class="form-control add-date" name="account_date"
                        value="<?= $date; ?>" placeholder="" style="cursor: pointer;" id="account-date-total">

                        <!-- Datepicker -->
                        <div class="box-datepicker client">
                            <div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#account-date-total"></div>
                        </div>

                    </div>

                    <div class="text-center">
                    
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                             data-url="/api/web/custom/accounts/add" data-form="#form_add_account" data-redirect="none">
                                ADICIONAR
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


<?php

$month_name = [
    "01" => "Janeiro", "02" => "Fevereiro", "03" => "Março",
    "04" => "Abril", "05" => "Maio", "06" => "Junho",
    "07" => "Julho", "08" => "Agosto", "09" => "Setembro",
    "10" => "Outubro", "11" => "Novembro", "12" => "Dezembro"
];

?>

<div class="container">

    <!-- Menu Page -->
    <div class="menu-page">
    <span class="title-page">Termo de Responsabilidade de Informação Contábil</span>
    </div>

    <div class="area-actions" style="padding-top: 0px;">

        <!-- QUADROS -->
        <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

                <div class="box-white size-xs">
                    
                    <br><br>
                    À 
                    <br>
                    LINK ASS CONTABIL EIRELI 
                    <br>
                    CRC n.º 2SP022975/0-8
                    <br>
                    Endereço: Av. Doutor João Batista Soares de Queiroz Júnior, nº 235 – Jardim das Indústrias  
                    <br>
                    Município: São José dos Campos/SP - CEP 12240-000
                    <br><br>

                    Prezados Senhores,
                    <br><br>

                    Eu, <?php echo $name_user; ?>, CPF/MF sob nº <?php echo $cpf_user; ?>, como administrador e responsável legal da empresa <?php echo $business_name; ?>, com CNPJ/MF sob nº <?php echo $business_cnpj; ?>, declaro que as informações para utilização do sistema disponibilizado pela Link Contabilidade Consultiva, transmitidas nesta data, foram totalmente compreendidas e absorvidas.
                    <br>
                    Declaro também que as informações registradas no sistema de gestão e controle interno, são controladas e validadas com documentação idônea, sendo de nossa inteira responsabilidade todo o conteúdo do banco de dados e arquivos eletrônicos fornecidos, sendo disponibilizadas mensalmente até o dia quatro de cada mês, contendo a movimentação do mês anterior.
                    <br>
                    Tenho ciência de que o não preenchimento ou preenchimento parcial do sistema Link, impossibilitará a realização do fechamento do balanço patrimonial, distribuição de lucros e a entrega de declarações fiscais obrigatórias, que se não forem entregues no prazo, por falta das informações, poderão trazer prejuízos financeiros a minha empresa, através de multas por atraso.
                    <br><br>
                    Também declaramos:
                    <br>
                    (a) que os controles internos adotados pela nossa empresa são de responsabilidade da administração e estão adequados ao tipo de atividade e volume de transações;
                    <br>
                    (b) que não realizamos nenhum tipo de operação que possa ser considerada ilegal, frente à legislação vigente;
                    <br>
                    (c) que todos os documentos e/ou informações que geramos e recebemos de nossos fornecedores, encaminhados para a elaboração da escrituração contábil e demais serviços contratados, estão revestidos de total idoneidade;
                    <br>
                    (d) que os estoques registrados em conta própria são por nós contados e levantados fisicamente e avaliados de acordo com a política de mensuração de estoque determinada pela empresa e perfazem a realidade do período;
                    <br>
                    (e) que as informações registradas no sistema de gestão e controle interno, denominado (SISTEMA EM USO), são controladas e validadas com documentação suporte adequada, sendo de nossa inteira responsabilidade todo o conteúdo do banco de dados e arquivos eletrônicos gerados. 
                    <br><br>

                    Além disso, declaramos que não existem quaisquer fatos ocorridos no período base que afetam ou possam afetar as demonstrações contábeis ou, ainda, a continuidade das operações da empresa.
                    <br><br>

                    Também confirmamos que estaremos atentos para não promover:
                    <br>
                    (a) fraude envolvendo a administração ou empregados em cargos de responsabilidade ou confiança;
                    <br>
                    (b) fraude envolvendo terceiros que poderiam ter efeito material nas demonstrações contábeis;
                    <br>
                    (c) violação de leis, normas ou regulamentos cujos efeitos deveriam ser considerados para divulgação nas demonstrações contábeis, ou mesmo dar origem ao registro de provisão para contingências passivas.

                    <br><br>

                    Atenciosamente,
                    <br>
                    <strong style="text-transform: uppercase;"><?php echo $name_user; ?></strong>
                    <br>
                    <?php echo date_format($date_now, 'd'); ?> de <?php echo $month_name[date_format($date_now, 'm')]; ?> de <?php echo date_format($date_now, 'Y'); ?>, às <?php echo date_format($date_now, 'H:i'); ?> 
                    <br>
                    IP: <?php echo $_SERVER["REMOTE_ADDR"]; ?>
                    <br><br>

                    <div class="btn btn-yellow size-lg margin-t-50" id="btn-sign-terms">ACEITO OS TERMOS</div>
                    
                    <br><br><br>

                </div>
            </div>
        </div>

    </div>

</div>

<?php
    echo $this->element('footer_panel');
?>

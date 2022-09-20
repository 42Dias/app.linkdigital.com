

    <?php

        foreach ($all_indicators as $indicator) {
            $value_1 = $indicator->value_1;
            $value_2 = $indicator->value_2;
            $value_3 = $indicator->value_3;
            $value_4 = $indicator->value_4;
            $value_5 = $indicator->value_5;
            $value_6 = $indicator->value_6;
            $value_7 = $indicator->value_7;
            $value_8 = $indicator->value_8;
            $value_9 = $indicator->value_9;
            $value_10 = $indicator->value_10;
            $value_11 = $indicator->value_11;
            $value_12 = $indicator->value_12;
            $value_13 = $indicator->value_13;
            $value_14 = $indicator->value_14;
            $value_15 = $indicator->value_15;
            $value_16 = $indicator->value_16;
            $value_17 = $indicator->value_17;
            $value_18 = $indicator->value_18;
            $value_19 = $indicator->value_19;
            $value_20 = $indicator->value_20;
            $value_21 = $indicator->value_21;
            $value_22 = $indicator->value_22;
            $value_23 = $indicator->value_23;
            $value_24 = $indicator->value_24;
            $value_25 = $indicator->value_25;
            $value_26 = $indicator->value_26;
            $value_27 = $indicator->value_27;
            $value_28 = $indicator->value_28;
            $value_29 = $indicator->value_29;
            $value_30 = $indicator->value_30;
        }

        $value_1_client = $value_1 / $total_clients;
        $value_2_client = $value_2 / $total_clients;
        $value_3_client = $value_3 / $total_clients;
        $value_4_client = $value_4 / $total_clients;
        $value_5_client = $value_5 / $total_clients;
        $value_6_client = $value_6 / $total_clients;
        $value_7_client = $value_7 / $total_clients;
        $value_8_client = $value_8 / $total_clients;
        $value_9_client = $value_9 / $total_clients;
        $value_10_client = $value_10 / $total_clients;
        $value_11_client = $value_11 / $total_clients;
        $value_12_client = $value_12 / $total_clients;
        $value_13_client = $value_13 / $total_clients;
        $value_14_client = $value_14 / $total_clients;
        $value_15_client = $value_15 / $total_clients;
        $value_16_client = $value_16 / $total_clients;
        $value_17_client = $value_17 / $total_clients;
        $value_18_client = $value_18 / $total_clients;
        $value_19_client = $value_19 / $total_clients;
        $value_20_client = $value_20 / $total_clients;
        $value_21_client = $value_21 / $total_clients;
        $value_22_client = $value_22 / $total_clients;
        $value_23_client = $value_23 / $total_clients;
        $value_24_client = $value_24 / $total_clients;
        $value_25_client = $value_25 / $total_clients;
        $value_26_client = $value_26 / $total_clients;
        $value_27_client = $value_27 / $total_clients;
        $value_28_client = $value_28 / $total_clients;
        $value_29_client = $value_29 / $total_clients;
        $value_30_client = $value_30 / $total_clients;

        $custo_client = 0;
        $custo_client = $custo_client + ($value_3_client + $value_4_client + $value_5_client);
        $custo_client = $custo_client + ($value_6_client + $value_7_client + $value_8_client + $value_9_client + $value_10_client);
        $custo_client = $custo_client + ($value_11_client + $value_12_client + $value_13_client + $value_14_client + $value_15_client);
        $custo_client = $custo_client + ($value_16_client + $value_17_client + $value_18_client + $value_19_client + $value_20_client);
        $custo_client = $custo_client + ($value_21_client + $value_22_client + $value_23_client + $value_24_client + $value_25_client);
        $custo_client = $custo_client + ($value_26_client + $value_27_client + $value_28_client + $value_29_client + $value_30_client);

        $LB = ($value_1 + $value_2)-($value_3 + $value_4 + $value_5 + $value_6 + $value_7);
        $MB = $LB / ($value_1 + $value_2);

        $mkt = 1500;
        $clientes_mes = $total_clients / 12;
        $churn = 7 / $total_clients;
        $lt = 1 / $churn;
        $ltv = $value_1_client*$MB*$lt;
        $cac = $mkt / $clientes_mes;
        $payback = $cac / ($value_1_client*$MB);
        $ltv_cac = $ltv / $cac;

    ?>

    
<!-- Menu Page -->
<div class="menu-page">

<span class="title-page">Indicadores</span>

</div>

<div class="area-actions" style="padding: 0px;">

    <!-- Atividades -->
    <div class="box-files margin-t-30 margin-b-30" style="background-color: #fff; padding: 30px; padding-top: 0px; border-radius: 20px;">

    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            <h3 class="margin-t-40" style="font-weight: 600; color: #adb5c3;">Clientes &nbsp;<span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Clientes com status Em andamento e Concluído"></span></h3>
            <span style="font-weight: 600; font-size: 22px; color: #ffc107;"><?php echo $total_clients; ?></span>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            <h3 class="margin-t-40" style="font-weight: 600; color: #adb5c3;">MKT & VEN &nbsp;<span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Gastos com marketing e esforço de vendas"></span></h3>
            <span style="font-weight: 600; font-size: 22px; color: #ffc107;">R$ <?php echo number_format($mkt, 2, ',', ''); ?></span>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            <h3 class="margin-t-40" style="font-weight: 600; color: #adb5c3;">Clientes / mês &nbsp;<span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Quantidade de clientes conquistados no periodo"></span></h3>
            <span style="font-weight: 600; font-size: 22px; color: #ffc107;"><?php echo number_format($clientes_mes, 0, ',', ''); ?></span>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            <h3 class="margin-t-40" style="font-weight: 600; color: #adb5c3;">Churn &nbsp;<span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="% de saída de clientes no mês. Para recorrência deve <= 2,5%"></span></h3>
            <span style="font-weight: 600; font-size: 22px; color: #ffc107;"><?php echo number_format(($churn*100), 2, ',', ''); ?> %</span>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            <h3 class="margin-t-40" style="font-weight: 600; color: #adb5c3;">MB &nbsp;<span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Margem Bruta. Nos EUA para Contabilidade o valor tipico é 20%"></span></h3>
            <span style="font-weight: 600; font-size: 22px; color: #ffc107;"><?php echo number_format(($MB*100), 2, ',', ''); ?> %</span>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            <h3 class="margin-t-40" style="font-weight: 600; color: #adb5c3;">Ticket médio &nbsp;<span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Ticket Médio mensal de cada cliente (receita/ nr de clientes no msm período)"></span></h3>
            <span style="font-weight: 600; font-size: 22px; color: #ffc107;">R$ <?php echo number_format($value_1_client, 2, ',', ''); ?></span>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            <h3 class="margin-t-40" style="font-weight: 600; color: #adb5c3;">LT &nbsp;<span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Tempo de vida médio dos clientes (meses)"></span></h3>
            <span style="font-weight: 600; font-size: 22px; color: #ffc107;"><?php echo number_format($lt, 2, ',', ''); ?></span>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            <h3 class="margin-t-40" style="font-weight: 600; color: #adb5c3;">LTV &nbsp;<span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Valor do tempo de vida médio dos clientes"></span></h3>
            <span style="font-weight: 600; font-size: 22px; color: #ffc107;">R$ <?php echo number_format($ltv, 2, ',', ''); ?></span>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            <h3 class="margin-t-40" style="font-weight: 600; color: #adb5c3;">CAC &nbsp;<span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Custo de Aquisição de Clientes, tem que estar abaixo do valor do Ticket médio, senão está tendo prejuízo. Esforços em mkt e vendas aumentam o CAC"></span></h3>
            <span style="font-weight: 600; font-size: 22px; color: #ffc107;">R$ <?php echo number_format($cac, 2, ',', ''); ?></span>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            <h3 class="margin-t-40" style="font-weight: 600; color: #adb5c3;">PAYBACK &nbsp;<span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Tempo de retorno do investimento de mkt e vendas por cliente (meses)"></span></h3>
            <span style="font-weight: 600; font-size: 22px; color: #ffc107;"><?php echo number_format($payback, 2, ',', ''); ?></span>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            <h3 class="margin-t-40" style="font-weight: 600; color: #adb5c3;">LTV/CAC &nbsp;<span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Tem que ser maior do que 3 para o negócio ser viável"></span></h3>
            <span style="font-weight: 600; font-size: 22px; color: #ffc107;"><?php echo number_format($ltv_cac, 2, ',', ''); ?></span>
        </div>
    </div>

    <hr style="margin-top: 50px;">

    <form id="form-update-indicators">

        <h3 class="margin-t-40" style="font-weight: 600;">Receitas</h3>

        <div class="row margin-t-30">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Receita média de mensalidades (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_1" value="<?php echo number_format($value_1, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_1_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Receita Média de venda de serviços adicionais (certificado digital, serviços adicionais da contabilidade) (R$)
                <input type="text" class="form-control margin-b-30 required mask-money" id="step-1-lastname" name="value_2" value="<?php echo number_format($value_2, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_2_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            </div>
        </div>

        <hr style="margin-top: 50px;">

        <h3 class="margin-t-40" style="font-weight: 600;">Custos Fixos</h3>

        <div class="row margin-t-30">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                MOD/MOI: Folha de pagamento/fgts/inss, menos ADM (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_3" value="<?php echo number_format($value_3, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_3_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Depreciação de Computadores e Servidores (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_4" value="<?php echo number_format($value_4, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_4_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Matéria Prima (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_5" value="<?php echo number_format($value_5, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_5_client, 2, ',', ''); ?> / cliente</span>
            </div>
        </div>

        <hr style="margin-top: 50px;">

        <h3 class="margin-t-40" style="font-weight: 600;">Custos Variáveis</h3>

        <div class="row margin-t-30">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Software Contmatic/Nibo/Nucont (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_6" value="<?php echo number_format($value_6, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_6_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Impostos (8,65%) (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_7" value="<?php echo number_format($value_7, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_7_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            </div>
        </div>

        <hr style="margin-top: 50px;">

        <h3 class="margin-t-40" style="font-weight: 600;">Despesas Fixas</h3>

        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                ADM: Folha de pagamento/fgts/inss (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_8" value="<?php echo number_format($value_8, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_8_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Aluguel (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_9" value="<?php echo number_format($value_9, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_9_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Condominio (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_10" value="<?php echo number_format($value_10, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_10_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Ajuda de custo (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_11" value="<?php echo number_format($value_11, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_11_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Alimentação (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_12" value="<?php echo number_format($value_12, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_12_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Transporte (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_13" value="<?php echo number_format($value_13, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_13_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Convênio Estacionamento (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_14" value="<?php echo number_format($value_14, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_14_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Energia (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_15" value="<?php echo number_format($value_15, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_15_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Telefones (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_16" value="<?php echo number_format($value_16, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_16_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Internet (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_17" value="<?php echo number_format($value_17, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_17_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                TI manutenção (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_18" value="<?php echo number_format($value_18, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_18_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                GPS (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_19" value="<?php echo number_format($value_19, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_19_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Convênio médico (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_20" value="<?php echo number_format($value_20, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_20_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Seguros (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_21" value="<?php echo number_format($value_21, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_21_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Software Econet (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_22" value="<?php echo number_format($value_22, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_22_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Desenvolvimento Site (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_23" value="<?php echo number_format($value_23, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_23_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Material de expediente (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_24" value="<?php echo number_format($value_24, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_24_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                GAAC (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_25" value="<?php echo number_format($value_25, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_25_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Outros (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_26" value="<?php echo number_format($value_26, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_26_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Pro-labore (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_27" value="<?php echo number_format($value_27, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_27_client, 2, ',', ''); ?> / cliente</span>
            </div>

        </div>

        <hr style="margin-top: 50px;">

        <h3 class="margin-t-40" style="font-weight: 600;">Despesas variáveis</h3>

        <div class="row margin-t-30">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Marketing (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_28" value="<?php echo number_format($value_28, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_28_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Comissões (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_29" value="<?php echo number_format($value_29, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_29_client, 2, ',', ''); ?> / cliente</span>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
                Taxas bancárias (R$)
                <input type="text" class="form-control margin-b-30 required" id="step-1-lastname" name="value_30" value="<?php echo number_format($value_30, 2, ',', ''); ?>"
                style="width: 100%; font-size: 14px; margin-top: 10px;">
                <span style="font-weight: 600; font-size: 18px; color: #ffc107;">R$ <?php echo number_format($value_30_client, 2, ',', ''); ?> / cliente</span>
            </div>
        </div>

    </form>

    <hr style="margin-top: 50px;">

    <h3 class="margin-t-40" style="font-weight: 600;">Resultados</h3>

    <div class="row margin-t-30">
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            Custo atual por cliente<br>
            <span style="font-weight: 600; font-size: 24px; color: #ffc107;">R$ <?php echo number_format($custo_client, 2, ',', ''); ?></span>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            LB - Lucro Bruto<br>
            <span style="font-weight: 600; font-size: 24px; color: #ffc107;">R$ <?php echo number_format($LB, 2, ',', ''); ?></span>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 margin-t-30">
            MB - Margem de Lucro<br>
            <span style="font-weight: 600; font-size: 24px; color: #ffc107;"><?php echo number_format(($MB*100), 1, ',', ''); ?>%</span>
        </div>
    </div>

    <div class="text-right">
        <div class="btn btn-yellow margin-t-50 margin-b-50 size-lg" id="btn-update-indicators">ATUALIZAR DADOS</div>
    </div>

    </div>

</div>

<?php
  echo $this->element('footer_panel');
?>

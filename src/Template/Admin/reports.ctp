<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


<!-- Menu Page -->
<div class="menu-page">

  <span class="title-page">Relatórios</span>

</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs">

                <!-- ::::: REPORT STATUS ::::: -->

                <?php //if($filters == "status"){ ?>

                <h3 style="font-weight: 600; font-size: 20px; color: #4a4c65;" class="margin-t-20 margin-b-40">Relatório Geral <?php //echo $filter_text; ?></h3>

                <br>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                        <!-- Faturamento -->
                        <table class="table table-reports">
                            <tbody>
                                <tr>
                                    <td><span class="table-title">Clientes ativos</span></td>
                                    <td><span class="table-result-fixed"><?php echo $report_total_clients; ?> clientes</span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">Faturamento</span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_total_faturamento, 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">Ticket médio</span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_total_ticket, 2, ',', '.'); ?></span></td>
                                </tr> 
                            </tbody>
                        </table>

                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 margin-t-50">

                        <canvas id="myChart2" height="100"></canvas>

                        <script>
                            var ctx = document.getElementById('myChart2').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: [
                                        <?php
                                            for ($i=1; $i < 37; $i++) {
                                                echo "'".$report_period[$i]['date']."',";
                                            }
                                        ?>
                                    ],
                                    datasets: [{
                                        label: 'Clientes',
                                        data: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo ($report_period[$i]['pendente'] + $report_period[$i]['andamento'] + $report_period[$i]['concluido'] + $report_period[$i]['cancelado']).",";
                                                }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo "'#93e22a',";
                                                }
                                            ?>
                                        ],
                                        borderWidth: 0
                                    },{
                                        label: 'Leads',
                                        data: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo $report_period[$i]['count'].",";
                                                }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo "'#ffce2c',";
                                                }
                                            ?>
                                        ],
                                        borderWidth: 0
                                    }]
                                },
                                options: {
                                    scales: {
                                        display: 'none'
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            });
                        </script>

                    </div>
                </div>

                <br><br>
                <h3 style="font-weight: 600; font-size: 20px; color: #4a4c65;" class="margin-t-20 margin-b-40">Relatório de Status</h3>

                <br>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                        <!-- Status -->
                        <table class="table table-reports">
                        <thead>
                            <tr>
                            <td><span class="table-title">Status</span></td>
                            <td><span class="table-title">Mensalidades</span></td>
                            <td><span class="table-title">Participação %</span></td>
                            <td><span class="table-title">Quantidade</span></td>
                            </tr> 
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="table-title">Em preenchimento</span></td>
                                <td><span class="table-result">R$ <?php echo number_format($report_status[1]['mensalidade'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format($report_status[1]['percentual'], 2, ',', '.'); ?>%</span></td>
                                <td><span class="table-result"><?php echo $report_status[1]['quantidade']; ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Pendente</span></td>
                                <td><span class="table-result">R$ <?php echo number_format($report_status[2]['mensalidade'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format($report_status[2]['percentual'], 2, ',', '.'); ?>%</span></td>
                                <td><span class="table-result"><?php echo $report_status[2]['quantidade']; ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Em andamento</span></td>
                                <td><span class="table-result">R$ <?php echo number_format($report_status[3]['mensalidade'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format($report_status[3]['percentual'], 2, ',', '.'); ?>%</span></td>
                                <td><span class="table-result"><?php echo $report_status[3]['quantidade']; ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Concluído</span></td>
                                <td><span class="table-result">R$ <?php echo number_format($report_status[4]['mensalidade'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format($report_status[4]['percentual'], 2, ',', '.'); ?>%</span></td>
                                <td><span class="table-result"><?php echo $report_status[4]['quantidade']; ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Cancelado</span></td>
                                <td><span class="table-result">R$ <?php echo number_format($report_status[5]['mensalidade'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format($report_status[5]['percentual'], 2, ',', '.'); ?>%</span></td>
                                <td><span class="table-result"><?php echo $report_status[5]['quantidade']; ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Bloqueado</span></td>
                                <!-- <td><span class="table-title">Excluido</span></td> -->
                                <td><span class="table-result">R$ <?php echo number_format($report_status[6]['mensalidade'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format($report_status[6]['percentual'], 2, ',', '.'); ?>%</span></td>
                                <td><span class="table-result"><?php echo $report_status[6]['quantidade']; ?></span></td>
                            </tr>
                            <!-- <tr>
                                <td><span class="table-title">Protesto</span></td>
                                <td><span class="table-result">R$ <?php echo number_format($report_status[7]['mensalidade'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format($report_status[7]['percentual'], 2, ',', '.'); ?>%</span></td>
                                <td><span class="table-result"><?php echo $report_status[7]['quantidade']; ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Phase-out</span></td>
                                <td><span class="table-result">R$ <?php echo number_format($report_status[8]['mensalidade'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format($report_status[8]['percentual'], 2, ',', '.'); ?>%</span></td>
                                <td><span class="table-result"><?php echo $report_status[8]['quantidade']; ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Rescisão</span></td>
                                <td><span class="table-result">R$ <?php echo number_format($report_status[9]['mensalidade'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format($report_status[9]['percentual'], 2, ',', '.'); ?>%</span></td>
                                <td><span class="table-result"><?php echo $report_status[9]['quantidade']; ?></span></td>
                            </tr> -->
                            <tr>
                                <td><span class="table-title">Total Geral</span></td>
                                <td><span class="table-result-fixed">R$ <?php echo number_format($report_status[10]['mensalidade'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result-fixed">100%</span></td>
                                <td><span class="table-result-fixed"><?php echo $report_status[10]['quantidade']; ?></span></td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>

                <br><br><br>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                        <canvas id="myChart3" height="100"></canvas>

                        <script>
                            var ctx = document.getElementById('myChart3').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: [
                                        <?php
                                            for ($i=1; $i < 37; $i++) {
                                                echo "'".$report_period[$i]['date']."',";
                                            }
                                        ?>
                                    ],
                                    datasets: [{
                                        label: 'Em preenchimento',
                                        data: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo $report_period[$i]['preenchimento'].",";
                                                }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo "'#e4771a',";
                                                }
                                            ?>
                                        ],
                                        borderWidth: 0
                                    },{
                                        label: 'Pendente',
                                        data: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo $report_period[$i]['pendente'].",";
                                                }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo "'#e2ba2a',";
                                                }
                                            ?>
                                        ],
                                        borderWidth: 0
                                    },{
                                        label: 'Em andamento',
                                        data: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo $report_period[$i]['andamento'].",";
                                                }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo "'#93e22a',";
                                                }
                                            ?>
                                        ],
                                        borderWidth: 0
                                    },{
                                        label: 'Concluído',
                                        data: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo $report_period[$i]['concluido'].",";
                                                }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo "'#2ae263',";
                                                }
                                            ?>
                                        ],
                                        borderWidth: 0
                                    },{
                                        label: 'Cancelado',
                                        data: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo $report_period[$i]['cancelado'].",";
                                                }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo "'#454d5a',";
                                                }
                                            ?>
                                        ],
                                        borderWidth: 0
                                    },{
                                        label: 'Bloqueado',
                                        data: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo $report_period[$i]['excluido'].",";
                                                }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            <?php
                                                for ($i=1; $i < 37; $i++) {
                                                    echo "'#2ad1e2',";
                                                }
                                            ?>
                                        ],
                                        borderWidth: 0
                                    // },{
                                    //     label: 'Protesto',
                                    //     data: [
                                    //         <?php
                                    //             for ($i=1; $i < 37; $i++) {
                                    //                 echo $report_period[$i]['protesto'].",";
                                    //             }
                                    //         ?>
                                    //     ],
                                    //     backgroundColor: [
                                    //         <?php
                                    //             for ($i=1; $i < 37; $i++) {
                                    //                 echo "'#f1c40f',";
                                    //             }
                                    //         ?>
                                    //     ],
                                    //     borderWidth: 0
                                    // },{
                                    //     label: 'Phase-out',
                                    //     data: [
                                    //         <?php
                                    //             for ($i=1; $i < 37; $i++) {
                                    //                 echo $report_period[$i]['phase'].",";
                                    //             }
                                    //         ?>
                                    //     ],
                                    //     backgroundColor: [
                                    //         <?php
                                    //             for ($i=1; $i < 37; $i++) {
                                    //                 echo "'#e77e23',";
                                    //             }
                                    //         ?>
                                    //     ],
                                    //     borderWidth: 0
                                    // },{
                                    //     label: 'Recisão',
                                    //     data: [
                                    //         <?php
                                    //             for ($i=1; $i < 37; $i++) {
                                    //                 echo $report_period[$i]['rescisao'].",";
                                    //             }
                                    //         ?>
                                    //     ],
                                    //     backgroundColor: [
                                    //         <?php
                                    //             for ($i=1; $i < 37; $i++) {
                                    //                 echo "'#e84c3d',";
                                    //             }
                                    //         ?>
                                    //     ],
                                    //     borderWidth: 0
                                    }]
                                },
                                options: {
                                    scales: {
                                        display: 'none'
                                    },
                                    legend: {
                                        position: 'bottom'
                                    },
                                    scales: {
                                        xAxes: [{
                                            stacked: true,
                                        }],
                                        yAxes: [{
                                            stacked: true
                                        }]
                                    }
                                }
                            });
                        </script>

                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 margin-t-50">

                        <canvas id="myChart1" height="100"></canvas>

                        <script>
                            var ctx = document.getElementById('myChart1').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Em preenchimento', 'Pendente', 'Em andamento', 'Concluído', 'Cancelado', 'Bloqueado'],
                                    // labels: ['Em preenchimento', 'Pendente', 'Em andamento', 'Concluído', 'Cancelado', 'Excluído', 'Em protesto', 'Phase-out', 'Recisão'],
                                    datasets: [{
                                        label: '# of Votes',
                                        data: [
                                            <?php echo number_format($report_status[1]['mensalidade'], 0, ',', ''); ?>,
                                            <?php echo number_format($report_status[2]['mensalidade'], 0, ',', ''); ?>,
                                            <?php echo number_format($report_status[3]['mensalidade'], 0, ',', ''); ?>,
                                            <?php echo number_format($report_status[4]['mensalidade'], 0, ',', ''); ?>,
                                            <?php echo number_format($report_status[5]['mensalidade'], 0, ',', ''); ?>,
                                            <?php echo number_format($report_status[6]['mensalidade'], 0, ',', ''); ?>
                                            // <?php echo number_format($report_status[7]['mensalidade'], 0, ',', ''); ?>,
                                            // <?php echo number_format($report_status[8]['mensalidade'], 0, ',', ''); ?>,
                                            // <?php echo number_format($report_status[9]['mensalidade'], 0, ',', ''); ?>
                                        ],
                                        backgroundColor: [
                                            '#e4771a',
                                            '#e2ba2a',
                                            '#93e22a',
                                            '#2ae263',
                                            '#454d5a',
                                            '#2ad1e2'
                                            // '#f1c40f',
                                            // '#e77e23',
                                            // '#e84c3d'
                                        ],
                                        borderWidth: 0
                                    }]
                                },
                                options: {
                                    scales: {
                                        display: 'none'
                                    },
                                    legend: {
                                        position: 'right'
                                    }
                                }
                            });
                        </script>

                    </div>
                </div>

                <br><br>
                <h3 style="font-weight: 600; font-size: 20px; color: #4a4c65;" class="margin-t-20 margin-b-40">Relatório de Tipos de empresa</h3>

                <br>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                        <!-- Status -->
                        <table class="table table-reports">
                        <thead>
                            <tr>
                            <td><span class="table-title">Tipo de empresa</span></td>
                            <td><span class="table-title">Simples nacional</span></td>
                            <td><span class="table-title">Lucro presumido</span></td>
                            <td><span class="table-title">Total</span></td>
                            <td><span class="table-title">Faturamento</span></td>
                            <td><span class="table-title">Participação %</span></td>
                            </tr> 
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="table-title">Micro empreendedor individual (MEI)</span></td>
                                <td><span class="table-result"><?php echo $report_type['mei']['total']; ?></span></td>
                                <td><span class="table-result">-</span></td>
                                <td><span class="table-result-fixed"><?php echo $report_type['mei']['total']; ?></span></td>
                                <td><span class="table-result-fixed">R$ <?php echo number_format($report_type['mei']['faturamento'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format(($report_type['mei']['total'] / $report_type['total'] * 100), 2, ',', '.'); ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Prestação de serviços</span></td>
                                <td><span class="table-result"><?php echo $report_type['ss']; ?></span></td>
                                <td><span class="table-result"><?php echo $report_type['sl']; ?></span></td>
                                <td><span class="table-result-fixed"><?php echo $report_type['ss'] + $report_type['sl']; ?></span></td>
                                <td><span class="table-result-fixed">R$ <?php echo number_format($report_type['s']['faturamento'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format((($report_type['ss'] + $report_type['sl']) / $report_type['total'] * 100), 2, ',', '.'); ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Comércio</span></td>
                                <td><span class="table-result"><?php echo $report_type['cs']; ?></span></td>
                                <td><span class="table-result"><?php echo $report_type['cl']; ?></span></td>
                                <td><span class="table-result-fixed"><?php echo $report_type['cs'] + $report_type['cl']; ?></span></td>
                                <td><span class="table-result-fixed">R$ <?php echo number_format($report_type['c']['faturamento'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format((($report_type['cs'] + $report_type['cl']) / $report_type['total'] * 100), 2, ',', '.'); ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Prestação de serviços e Comércio</span></td>
                                <td><span class="table-result"><?php echo $report_type['scs']; ?></span></td>
                                <td><span class="table-result"><?php echo $report_type['scl']; ?></span></td>
                                <td><span class="table-result-fixed"><?php echo $report_type['scs'] + $report_type['scl']; ?></span></td>
                                <td><span class="table-result-fixed">R$ <?php echo number_format($report_type['sc']['faturamento'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format((($report_type['scs'] + $report_type['scl']) / $report_type['total'] * 100), 2, ',', '.'); ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Autônomo e Profissional liberal</span></td>
                                <td><span class="table-result"><?php echo $report_type['autonomo']['total']; ?></span></td>
                                <td><span class="table-result">-</span></td>
                                <td><span class="table-result-fixed"><?php echo $report_type['autonomo']['total']; ?></span></td>
                                <td><span class="table-result-fixed">R$ <?php echo number_format($report_type['autonomo']['faturamento'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format(($report_type['autonomo']['total'] / $report_type['total'] * 100), 2, ',', '.'); ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Empregado domêstico</span></td>
                                <td><span class="table-result"><?php echo $report_type['empregado']['total']; ?></span></td>
                                <td><span class="table-result">-</span></td>
                                <td><span class="table-result-fixed"><?php echo $report_type['empregado']['total']; ?></span></td>
                                <td><span class="table-result-fixed">R$ <?php echo number_format($report_type['empregado']['faturamento'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format(($report_type['empregado']['total'] / $report_type['total'] * 100), 2, ',', '.'); ?></span></td>
                            </tr>
                            <tr>
                                <td><span class="table-title">Indústria</span></td>
                                <td><span class="table-result"><?php echo $report_type['industria']['total']; ?></span></td>
                                <td><span class="table-result">-</span></td>
                                <td><span class="table-result-fixed"><?php echo $report_type['industria']['total']; ?></span></td>
                                <td><span class="table-result-fixed">R$ <?php echo number_format($report_type['industria']['faturamento'], 2, ',', '.'); ?></span></td>
                                <td><span class="table-result"><?php echo number_format(($report_type['industria']['total'] / $report_type['total'] * 100), 2, ',', '.'); ?></span></td>
                            </tr>
                        </tbody>
                        </table>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 margin-t-50">

                        <canvas id="myChart4" height="100"></canvas>

                        <script>
                            var ctx = document.getElementById('myChart4').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Micro empreendedor individual (MEI)', 'Prestação de serviços', 'Comércio', 'Prestação de serviços e Comércio', 'Autônomo e Profissional liberal', 'Empregado domêstico', 'Industria'],
                                    datasets: [{
                                        label: '# of Votes',
                                        data: [
                                            <?php echo $report_type['mei']['total']; ?>,
                                            <?php echo ($report_type['ss'] + $report_type['sl']); ?>,
                                            <?php echo ($report_type['cs'] + $report_type['cl']); ?>,
                                            <?php echo ($report_type['scs'] + $report_type['scl']); ?>,
                                            <?php echo $report_type['autonomo']['total']; ?>,
                                            <?php echo $report_type['empregado']['total']; ?>,
                                            <?php echo $report_type['industria']['total']; ?>
                                        ],
                                        backgroundColor: [
                                            '#2ad1e2',
                                            '#f1c40f',
                                            '#e77e23',
                                            '#e84c3d',
                                            '#9b58b5',
                                            '#34495e',
                                            '#93e22a'

                                        ],
                                        borderWidth: 0
                                    }]
                                },
                                options: {
                                    scales: {
                                        display: 'none'
                                    },
                                    legend: {
                                        position: 'right'
                                    }
                                }
                            });
                        </script>

                    </div>
                </div>

                <br><br>

                <h3 style="font-weight: 600; font-size: 20px; color: #4a4c65;" class="margin-t-20 margin-b-40">Relatório de Estados <?php //echo $filter_text; ?></h3>

                <br>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    
                        <!-- Faturamento -->
                        <table class="table table-reports">
                            <tbody>
                                <tr>
                                    <td><span class="table-title">SP</span></td>
                                    <td><span class="table-result"><?php echo $report_states['SP']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['SP']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">AC</span></td>
                                    <td><span class="table-result"><?php echo $report_states['AC']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['AC']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">AL</span></td>
                                    <td><span class="table-result"><?php echo $report_states['AL']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['AL']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">AP</span></td>
                                    <td><span class="table-result"><?php echo $report_states['AP']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['AP']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">AM</span></td>
                                    <td><span class="table-result"><?php echo $report_states['AM']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['AM']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">BA</span></td>
                                    <td><span class="table-result"><?php echo $report_states['BA']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['BA']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">CE</span></td>
                                    <td><span class="table-result"><?php echo $report_states['CE']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['CE']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">DF</span></td>
                                    <td><span class="table-result"><?php echo $report_states['DF']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['DF']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">ES</span></td>
                                    <td><span class="table-result"><?php echo $report_states['ES']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['ES']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">GO</span></td>
                                    <td><span class="table-result"><?php echo $report_states['GO']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['GO']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">MA</span></td>
                                    <td><span class="table-result"><?php echo $report_states['MA']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['MA']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">MT</span></td>
                                    <td><span class="table-result"><?php echo $report_states['MT']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['MT']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">MS</span></td>
                                    <td><span class="table-result"><?php echo $report_states['MS']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['MS']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">MG</span></td>
                                    <td><span class="table-result"><?php echo $report_states['MG']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['MG']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">PA</span></td>
                                    <td><span class="table-result"><?php echo $report_states['PA']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['PA']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">PB</span></td>
                                    <td><span class="table-result"><?php echo $report_states['PB']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['PB']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">PR</span></td>
                                    <td><span class="table-result"><?php echo $report_states['PR']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['PR']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">PE</span></td>
                                    <td><span class="table-result"><?php echo $report_states['PE']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['PE']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">PI</span></td>
                                    <td><span class="table-result"><?php echo $report_states['PI']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['PI']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">RJ</span></td>
                                    <td><span class="table-result"><?php echo $report_states['RJ']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['RJ']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">RN</span></td>
                                    <td><span class="table-result"><?php echo $report_states['RN']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['RN']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">RS</span></td>
                                    <td><span class="table-result"><?php echo $report_states['RS']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['RS']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">RO</span></td>
                                    <td><span class="table-result"><?php echo $report_states['RO']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['RO']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">RR</span></td>
                                    <td><span class="table-result"><?php echo $report_states['RR']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['RR']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">SC</span></td>
                                    <td><span class="table-result"><?php echo $report_states['SC']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['SC']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">SE</span></td>
                                    <td><span class="table-result"><?php echo $report_states['SE']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['SE']['faturamento'], 2, ',', '.'); ?></span></td>
                                </tr>
                                <tr>
                                    <td><span class="table-title">TO</span></td>
                                    <td><span class="table-result"><?php echo $report_states['TO']['total']; ?></span></td>
                                    <td><span class="table-result-fixed">R$ <?php echo number_format($report_states['TO']['faturamento'], 2, ',', '.'); ?></span></</tr>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 margin-t-50">

                        <canvas id="myChartEstates" height="100"></canvas>

                        <script>
                            var ctx = document.getElementById('myChartEstates').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: [
                                        'SP','AC','AL','AP',
                                        'AM','BA','CE','DF',
                                        'ES','GO','MA','MT',
                                        'MS','MG','PA','PB',
                                        'PR','PE','PI','RJ',
                                        'RN','RS','RO','RR',
                                        'SC','SE','TO'
                                    ],
                                    datasets: [{
                                        label: 'Clientes',
                                        data: [
                                            <?php echo $report_states['SP']['total']; ?>,
                                            <?php echo $report_states['AC']['total']; ?>,
                                            <?php echo $report_states['AL']['total']; ?>,
                                            <?php echo $report_states['AP']['total']; ?>,
                                            <?php echo $report_states['AM']['total']; ?>,
                                            <?php echo $report_states['BA']['total']; ?>,
                                            <?php echo $report_states['CE']['total']; ?>,
                                            <?php echo $report_states['DF']['total']; ?>,
                                            <?php echo $report_states['ES']['total']; ?>,
                                            <?php echo $report_states['GO']['total']; ?>,
                                            <?php echo $report_states['MA']['total']; ?>,
                                            <?php echo $report_states['MT']['total']; ?>,
                                            <?php echo $report_states['MS']['total']; ?>,
                                            <?php echo $report_states['MG']['total']; ?>,
                                            <?php echo $report_states['PA']['total']; ?>,
                                            <?php echo $report_states['PB']['total']; ?>,
                                            <?php echo $report_states['PR']['total']; ?>,
                                            <?php echo $report_states['PE']['total']; ?>,
                                            <?php echo $report_states['PI']['total']; ?>,
                                            <?php echo $report_states['RJ']['total']; ?>,
                                            <?php echo $report_states['RN']['total']; ?>,
                                            <?php echo $report_states['RS']['total']; ?>,
                                            <?php echo $report_states['RO']['total']; ?>,
                                            <?php echo $report_states['RR']['total']; ?>,
                                            <?php echo $report_states['SC']['total']; ?>,
                                            <?php echo $report_states['SE']['total']; ?>,
                                            <?php echo $report_states['TO']['total']; ?>
                                        ],
                                        backgroundColor: [
                                            '#93e22a','#93e22a','#93e22a','#93e22a','#93e22a','#93e22a',
                                            '#93e22a','#93e22a','#93e22a','#93e22a','#93e22a','#93e22a',
                                            '#93e22a','#93e22a','#93e22a','#93e22a','#93e22a','#93e22a',
                                            '#93e22a','#93e22a','#93e22a','#93e22a','#93e22a','#93e22a',
                                            '#93e22a','#93e22a','#93e22a','#93e22a','#93e22a','#93e22a',
                                            '#93e22a','#93e22a','#93e22a'
                                        ],
                                        borderWidth: 0
                                    }]
                                },
                                options: {
                                    scales: {
                                        display: 'none'
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            });
                        </script>

                    </div>
                </div>

                <br><br>

                <h3 style="font-weight: 600; font-size: 20px; color: #4a4c65;" class="margin-t-20 margin-b-40">Relatório de Faturamentos</h3>

                <!-- Faturamento -->
                <table class="table table-reports margin-t-40">
                <thead>
                    <tr>
                    <td><span class="table-title">Faturamento</span></td>
                    <td><span class="table-title">Quantidade</span></td>
                    <td><span class="table-title">Participação %</span></td>
                    </tr> 
                </thead>
                <tbody>
                    <tr>
                        <td><span class="table-title">R$ 0,00 a R$ 15.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[0]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[0]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 15.000,01 a R$ 30.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[1]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[1]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 30.000,01 a R$ 60.000,0</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[2]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[2]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 60.000,01 a R$ 90.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[3]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[3]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 90.000,01 a R$ 120.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[4]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[4]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 12.000,01 a R$ 150.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[5]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[5]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 150.000,01 a R$ 180.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[6]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[6]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 180.000,01 a R$ 210.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[7]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[7]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 210.000,01 a R$ 240.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[8]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[8]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 240.000,01 a R$ 270.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[9]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[9]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 270.000,01 a R$ 300.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[10]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[10]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 300.000,01 a R$ 330.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[11]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[11]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 330.000,01 a R$ 360.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[12]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[12]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 360.000,01 a R$ 390.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[13]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[13]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 390.000,01 a R$ 420.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[14]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[14]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 420.000,01 a R$ 450.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[15]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[15]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 450.000,01 a R$ 480.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[16]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[16]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 480.000,01 a R$ 510.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[17]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[17]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 510.000,01 a R$ 540.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[18]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[18]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 540.000,01 a R$ 570.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[19]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[19]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 570.000,01 a R$ 600.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[20]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[20]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 600.000,01 a R$ 630.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[21]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[21]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 630.000,01 a R$ 660.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[22]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[22]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 660.000,01 a R$ 690.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[23]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[23]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 690.000,01 a R$ 720.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[24]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[24]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 720.000,01 a R$ 750.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[25]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[25]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 750.000,01 a R$ 780.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[26]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[26]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 780.000,01 a R$ 810.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[27]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[27]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 810.000,01 a R$ 840.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[28]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[28]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 840.000,01 a R$ 870.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[29]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[29]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 870.000,01 a R$ 900.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[30]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[30]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 900.000,01 a R$ 930.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[31]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[31]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 930.000,01 a R$ 960.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[32]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[32]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 960.000,01 a R$ 990.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[33]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[33]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 990.000,01 a R$ 1020.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[34]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[34]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1020.000,01 a R$ 1050.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[35]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[35]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1050.000,01 a R$ 1080.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[36]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[36]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1080.000,01 a R$ 1110.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[37]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[37]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1110.000,01 a R$ 1140.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[38]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[38]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1140.000,01 a R$ 1170.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[39]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[39]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1170.000,01 a R$ 1200.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[40]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[40]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1200.000,01 a R$ 1230.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[41]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[41]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1230.000,01 a R$ 1260.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[42]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[42]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1260.000,01 a R$ 1290.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[43]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[43]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1290.000,01 a R$ 1320.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[44]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[44]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1320.000,01 a R$ 1350.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[45]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[45]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1350.000,01 a R$ 1380.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[46]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[46]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1380.000,01 a R$ 1410.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[47]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[47]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1410.000,01 a R$ 1440.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[48]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[48]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1440.000,01 a R$ 1470.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[49]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[49]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1470.000,01 a R$ 1500.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[50]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[50]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1500.000,01 a R$ 1530.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[51]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[51]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1530.000,01 a R$ 1560.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[52]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[52]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1560.000,01 a R$ 1590.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[53]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[53]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1590.000,01 a R$ 1620.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[54]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[54]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1620.000,01 a R$ 1650.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[55]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[55]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1650.000,01 a R$ 1680.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[56]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[56]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1680.000,01 a R$ 1710.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[57]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[57]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1710.000,01 a R$ 1740.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[58]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[58]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1740.000,01 a R$ 1770.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[59]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[59]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1770.000,01 a R$ 1800.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[60]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[60]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>
                    <tr>
                        <td><span class="table-title">R$ 1800.000,01 a R$ 1830.000,00</span></td>
                        <td><span class="table-result-fixed"><?php echo $total_faturamento[61]['faturamento']; ?></span></td>
                        <td><span class="table-result"><?php echo number_format(($total_faturamento[61]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.'); ?>%</span></td>
                    </tr>


                    <!-- <?php
                        $begin = 30000.01;
                        $end = 60000.00;

                        for ($i=0; $i < 50; $i++) {

                            echo '<tr>';
                            echo '<td><span class="table-title">R$ '.number_format($begin, 2, ',', '.').' a R$ '.number_format($end, 2, ',', '.').'</span></td>';
                            echo '<td><span class="table-result-fixed">'.$total_faturamento[($i + 3)]['faturamento'].'</span></td>';
                            echo '<td><span class="table-result">'.number_format(($total_faturamento[($i + 3)]['faturamento'] / $report_faturamento_clients * 100) , 2, ',', '.').'%</span></td>';
                            echo '</tr>';

                            if($i == 1){
                                $begin = $begin + 0.01;
                            }

                            $begin = $begin + 30000;
                            $end = $end + 30000;
                        }
                    ?> -->
                    
                </tbody>
                </table>

                <?php //} ?>

            </div>
        </div>
    </div>
</div>

<?php
    echo $this->element('footer_panel');
?>



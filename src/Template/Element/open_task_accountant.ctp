
<div class="modal fade" id="open_task_accountant" tabindex="-1" role="dialog" aria-labelledby="open_task_accountantLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Obrigação</h4>

            </div>
            <div class="modal-body">

                <div class="text-left margin-t-20 item-tasks"">

                    <div id="task_badge"></div>
                    <!-- <span id="task_name" style="color: #999; font-size: 12px;">Name</span> -->
                    <h3 id="task_title" style="font-weight: 500; color: #333;"></h3>
                    <p id="task_description" style="font-weight: 500; color: #666; margin-top: 10px;"></p>

                    <div class="row margin-t-30">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                            <span style="color: #999; font-size: 12px;">Data de entrega:</span>
                            <br>
                            <strong id="task_maturity" style="color: #333; font-size: 14px;"></strong>
                            <br>
                        </div>
                    </div>

                    <div class="text-left">

                        <div id="task_button_close" class="btn btn-green size-lg margin-t-50 margin-l-10 btn_send_form" style="display: none;"
                                data-url="" data-form="#form" data-redirect="none">CONCLUIR</div>
                    
                        <div id="task_button_open" class="btn btn-magenta-panel size-lg margin-t-50 margin-l-10 btn_send_form" style="display: none;"
                                data-url="" data-form="#form" data-redirect="none">NÃO FINALIZADA</div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

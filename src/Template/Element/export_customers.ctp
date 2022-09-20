
<div class="modal fade" id="export_customers" tabindex="-1" role="dialog" aria-labelledby="export_customersLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Exportar clientes</h4>
            </div>
            <div class="modal-body">

                <form id="form_export_customers">

                    <input type='hidden' name="file_business_id" value="<?= $business_id; ?>" id="file_business_id">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">
                        Exporte todos os dados de cada cliente para dentro de uma planilha no Excel
                    </p>

                    <div class="text-center">
                    
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                             data-url="/api/web/custom/customers/export" data-form="#form_export_customers" data-redirect="none">
                                EXPORTAR CLIENTES
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
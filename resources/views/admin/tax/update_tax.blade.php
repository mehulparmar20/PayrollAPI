<div class="modal fade" id="ListTaxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tax</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Buy4me Fee</th>
                                <th>Payment Proccessing Tax</th>
                                <th>Travel Tax</th>
                            </tr>
                        </thead>
                        <tbody id="viewTaxData">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="update_tax" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update tax (%)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="input35" class="col-sm-3 col-form-label">Buy for me fee (%)</label>
                    <div class="col-sm-9">
                        <input type="hidden" id="tax_id">
                        <input type="number" class="form-control" name="buy4me_fee" id="buy4me_fee" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="input36" class="col-sm-3 col-form-label">payment Proccessing tax (%)</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="payment_proccessing_tax" id="payment_proccessing_tax" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="input36" class="col-sm-3 col-form-label">Travel Tax (%)</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="travel_tax" id="travel_tax" required>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button class="btn btn-primary px-4"  id="update_taxData">Submit</button>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
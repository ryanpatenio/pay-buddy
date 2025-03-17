<!-- Modal --->
<div class="modal fade editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Edit Fee</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editForm" >
                    @csrf
                    <input type="hidden" id="hidden_id" name="id">
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Transaction Type</label>
                        <select name="transaction_type" id="transaction-type" class="form-control" required>
                            <option value="send_money">Send Money</option>
                            <option value="external_api">External Api</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="">Currency</label>
                        <select name="currency" id="currencies-edit" class="form-control" required>
                            <option value="" id="current-currency"></option>
                        </select>
                      </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Amount</label>
                      <input type="number" id="amount" class="form-control" name="amount" min="0.1" step="0.01" placeholder="1.0" required>

                    </div>
                    
                </div>

                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close </button >
                    <button type="submit" class="btn btn-primary">Save </button >
               </div >
            </form>
            </div>
        </div>
    </div>
</div>
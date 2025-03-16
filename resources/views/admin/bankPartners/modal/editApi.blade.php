<!-- Modal --->
<div class="modal fade editApiModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Edit Bank Api Key</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editApiForm">
                    @csrf
                    <input type="hidden" id="b_id" name="b_id">  
                <div class="row mb-5">
                    <div class="col">
                        <label for="Bank Name">Bank Name</label>
                        <input type="text" class="form-control" id="bank-name" name="bankName" readonly>
                    </div>
                </div> 
                <div class="row mb-5">                   
                    <div class="col">
                      <label for="">Api Key</label>
                      <input type="text" class="form-control"  placeholder="Api Key" id="" name="api_key" required>
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
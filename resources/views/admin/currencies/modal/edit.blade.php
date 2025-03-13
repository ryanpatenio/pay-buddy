<!-- Modal --->
<div class="modal fade editModal" tabindex="-1" role="dialog" >
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Edit Currency</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editForm">
                    <input type="hidden" id="hidden_id" name="hidden_id">
                    @csrf
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Code</label>
                      <input type="text" class="form-control" id="code"  placeholder="PHP" name="code" required>
                    </div>
                    <div class="col">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="name"  placeholder="🇵🇭 PHP"  name="name" required>
                      </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Symbol</label>
                      <input type="text" class="form-control" id="symbol" placeholder="₱" name="symbol"  required>
                    </div>
                   
                </div>

                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close </button >
                    <button type="submit" class="btn btn-primary">Save</button >
               </div >
            </form>
            </div>
        </div>
    </div>
</div>
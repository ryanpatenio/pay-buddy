<!-- Modal --->
<div class="modal fade editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Edit User Balance</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editForm" >
                    @csrf
                    <input type="hidden" id="hh-id" name="id">
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Current Balance</label>
                      <input type="text" class="form-control" value="" id="current-balance" name="balance">
                       
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
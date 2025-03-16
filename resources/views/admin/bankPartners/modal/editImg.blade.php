<!-- Modal --->
<div class="modal fade editImgModal" tabindex="-1" role="dialog" >
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Edit Bank Image</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editImgForm" enctype="multipart/form-data">
                    <input type="hidden" id="bank-hidden-id" name="id">
                    @csrf
                <div class="row mb-5">
                    <div class="col">
                        <label for="Bank Name"> Bank Name</label>
                        <input type="text" class="form-control" id="bank_name" value="" readonly>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
    
                      <div class="loading-indicator">Loading...</div>
                      <img src="" alt="Bank picture" id="current-img" class="" width="112" height="112">
                    </div>
                    <div class="col">
                        <label for="">Name</label>
                        <input type="file" class="form-control" id="new-img"  name="new_img" required>
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
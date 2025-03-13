<!-- Modal --->
<div class="modal fade editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Edit Bank</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editBForm">
                    @csrf
                    <input type="hidden" id="hidden_id" name="hidden_id">   
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Name</label>
                      <input type="text" class="form-control"  placeholder="Name" id="name" name="name" required>
                    </div>
                    <div class="col">
                        <label for="">Url</label>
                        <input type="text" class="form-control"  placeholder="http://pay-buddy.test/" id="url"  name="url" required>
                      </div>
                </div>
               
                <div class="row mb-5">
                   <div class="col">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="10" rows="5" required>

                        </textarea>
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
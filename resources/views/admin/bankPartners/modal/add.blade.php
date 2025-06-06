<!-- Modal --->
<div class="modal fade addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Create</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="bForm" enctype="multipart/form-data">
                    @csrf
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Name</label>
                      <input type="text" class="form-control"  placeholder="Name" name="name" required>
                    </div>
                    <div class="col">
                        <label for="">Url</label>
                        <input type="text" class="form-control"  placeholder="Url"  name="url" required>
                      </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Api Key</label>
                      <input type="text" class="form-control" placeholder="api-key" name="api_key"  required>
                    </div>
                    <div class="col">
                        <label for="">Image Url</label>
                        <input type="file" class="form-control" id="img_url" name="img_url" required>
                      </div>
                </div>
                <div class="row mb-5">
                   <div class="col">
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" id="" cols="10" rows="5"></textarea>
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
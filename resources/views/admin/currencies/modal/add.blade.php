<!-- Modal --->
<div class="modal fade userModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Create new currencies</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="currencyForm" enctype="multipart/form-data">
                    @csrf
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Code</label>
                      <input type="text" class="form-control"  placeholder="PHP" name="code" required>
                    </div>
                    <div class="col">
                        <label for="">Name</label>
                        <input type="text" class="form-control"  placeholder="🇵🇭 PHP"  name="name" required>
                      </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                      <label for="">Symbol</label>
                      <input type="text" class="form-control" placeholder="₱" name="symbol"  required>
                    </div>
                    <div class="col">
                        <label for="">Image Symbol</label>
                        <input type="file" name="img_url" id="img-input" class="form-control">
                      </div>
                </div>

                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close </button >
                    <button type="submit" class="btn btn-primary">Create </button >
               </div >
            </form>
            </div>
        </div>
    </div>
</div>
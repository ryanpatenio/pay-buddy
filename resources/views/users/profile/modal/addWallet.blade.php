<!-- Modal --->
<div class="modal fade " id="addNewWalletModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Wallet(s)</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  method="POST" id="addWalletForm">
                    @csrf
                <div class="row">
                    <div class="col">
                        <label for="" class="mb-2">Select Wallet to add</label>
                        <select name="currency" id="cur-id" class="form-control" required>
                            <?php
                            foreach ($availableCurrencies as $curr) { ?>
                                <option value="<?=$curr->id ?? 0 ?>"><?=$curr->name ?? '' ?></option>
                                <?php }  
                                
                            ?>
                            
                        </select>
                    </div>
                    
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="submit" id="mark-as-read-btn" class="btn btn-primary">Save</button >
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close </button >                   
           </div >
        </form>
        </div>
    </div>
</div>

<!-- Modal --->
<style>
    #api-key {
    word-wrap: break-word; /* Ensures long words break to fit within the container */
    white-space: normal;   /* Allows the text to wrap to the next line */
    overflow-wrap: break-word; /* Breaks long words at the end of a line if necessary */
    word-break: break-all;  /* Breaks the word at any character to fit within the container */
    display: block; /* Ensures the strong tag behaves like a block element to prevent overflow */
}
</style>
<div class="modal fade viewLogModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Logs Details</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="viewForm">
                <div class="row mb-2" style="margin-top: -25px">
                    <div class="col">
                       <label for="">Name : </label>
                       <strong id="name">Ryan Wong</strong>
                    </div>
                    <div class="col">
                        <label for="">Api Key : </label>
                        <strong id="api-key"></strong>
                     </div>
                    
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                       
                        <label for="">Request : </label>
                        <textarea name="" class="form-control" id="request-data" cols="30" rows="10" >
                        </textarea>
                        
                    </div>
                   
                </div>
                <div class="row mt-5">
                    <div class="col">
                       
                            <label for="">Response : </label>
                            <textarea name="response" class="form-control"id="response-data" cols="20" rows="10" >

                            </textarea>
                        
                    </div>
              
                </div>
                <div class="row mt-5">
                    <div class="col">
                        <label for="">Date : </label>
                        <strong id="date"> January 5, 2025</strong>
                    </div>
                </div>
                
                
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close </button >
                    
               </div >
            </form>
            </div>
        </div>
    </div>
</div>
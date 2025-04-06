<div class="modal fade" id="global-Notification-Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Message</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="g-notif-form">
                    <input type="hidden" name="id" id="ntif-id">
                <div class="row">
                    <div class="col">
                        <label for="" ></label>
                        <strong class="h3" id="g-title"></strong>
                        <hr style="margin-top: 0px">
       
                    </div>                
                </div>
                <div class="row">
                    <div class="col">
                        <span class="h4" id="g-msg">
                           
                        </span>
                    </div>
                </div>
                <hr style="margin-bottom:0px;">
                <div class="row">
                    <div class="col">
                        <label for="">Date : </label>
                        <strong id="g-date"></strong>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" id="g-mark-as-read-btn" class="btn btn-primary">mark as read </button >
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close </button >                   
               </div >
            </form>
            </div>
        </div>
    </div>
</div>
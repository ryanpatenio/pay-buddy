$(document).ready(function(){

   const viewModal = $('#notifModal');

   $(document).on('click', '.notif-row', async function (e) {
        e.preventDefault();
        resetForm($('#notif-Form'));
        $('#mark-as-read-btn').prop('disabled',false);

            let ID = $(this).attr('data-id');
            if (!ID) {
                alert('ID not Found!');
                return;
            }
            $('#hidden_notif_id').val(ID);
            toggleLoader(true);
            try {
                const response = await axios.get(`/Notifications/${ID}`);
                if (response.status !== 200) {
                    console.error('Failed to fetch Data:', response.status);
                    return;
                }
                $('#title').text(response.data.data.title);
                $('#msg').text(response.data.data.message);
                $('#date').text(response.data.data.date_created);
                $('#mark-as-read-btn').prop('disabled',response.data.data.status === "read" ? true : false);
               
            } catch (error) {
               
                const errorMessage = error.response?.data?.message || 
                error.message || 'Failed to mark all as read';
                msg(errorMessage, 'error');

            }finally{
                toggleLoader(false);
                viewModal.modal('show');
            }
    });

    $(document).on('click','#mark-as-read-btn', async function(e){
        e.preventDefault();
        
        let button = $(this);
        let ID = $('#hidden_notif_id').val();
        if(!ID){
            alert('No ID Selected');
            return;
        }
        try {
             animateBtn(1000,button,'mark as read');
            const response = await axios.post('/Notifications-update', { id: ID });
            if(response.status === 200){
                message('success','success');
                resetForm($('#notif-Form'));
                
            }
            console.log('failed to update',response.status);

        } catch (error) {
           const errorMessage = error.response?.data?.message || 
                error.message || 'Failed to mark all as read';
                msg(errorMessage, 'error');
        }finally{
            viewModal.modal('hide');
        }
    });


});


const is_empty = (value) => value === null || value === undefined;
$(document).ready(function(){

   const viewModal = $('.notifModal');

   $(document).on('click', '.notif-row', async function (e) {
        e.preventDefault();
        $('#mark-as-read-btn').prop('disabled',false);

            let ID = $(this).attr('data-id');
            if (!ID) { // Check for null, undefined, or empty
                alert('ID not Found!');
                return;
            }
            $('#hidden_notif_id').val(ID);

            try {
                // Run both requests in parallel
                // const [response, update] = await Promise.all([
                    
                //     axios.post('/Notifications-update', { id: ID })
                // ]);

                const response = await axios.get(`/Notifications/${ID}`);

                if (response.status !== 200) {
                    console.error('Failed to fetch Data:', response.status);
                    return;
                }

                // Show modal and update content
                viewModal.modal('show');
                $('#title').text(response.data.data.title);
                $('#msg').text(response.data.data.message);
                $('#date').text(response.data.data.date_created);
                $('#mark-as-read-btn').prop('disabled',response.data.data.status === "read" ? true : false);
                console.log(response)
            } catch (error) {
                console.error('Error:', error.response ? error.response.data : error.message);
                alert('An error occurred while fetching the notification.');
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
            if(response.status !== 200){
                console.log('failed to update',response.status);
                return;
            }
            console.log(response)

        } catch (error) {
            console.log(error)
        }

       

    });


});


const is_empty = (value) => value === null || value === undefined;
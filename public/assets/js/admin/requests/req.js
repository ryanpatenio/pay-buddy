$(document).ready(function(){

    const modal = $('.approveModal');

  $(document).on('click','.requestedRow',async (e) => {
     e.preventDefault();

     resetForm($('#requestForm'));

     let id = $(e.currentTarget).attr('data-id');
     let name = $(e.currentTarget).attr('data-name');

     if(id === ""|| id === 0){
        return alert('ID not found!');
     }

        try {
            const response = await axios.get(`/Dashboard-Requests-req/${id}`);
            
            if(response.status === 200){
                let data  = response.data;

                $('#hidden_u_id').val(data.user_id);
                $('#hidden_req_id').val(data.id);

                $('#name').val(name);
                $('#message').text(data.message);

                modal.modal('show');               
            }
        } catch (error) {
           if(error.status === 404){
            alert('failed to fetch requests!');
            
           }else{
            alert('failed to fetch request!');
           }
           
        }
  });
  $(document).on('click','#approve-btn',async (e) => {
        e.preventDefault();

        let u_id = $('#hidden_u_id').val();
        let req_id = $('#hidden_req_id').val();
        const data = {
            user_id : u_id,
            request_id : req_id
        };

        swalMessage('custom','Are you sure you want to approve this Request?',async () => {
            try {
                
                const response = await axios.post('/Dashboard-request-approve',data);
                if(response.status === 200){
                    message('User Request Approved successfully!','success');
                }else{
                    msg('Unexpected error, Failed to approved!','error');
                }
            } catch (error) {
                //console.log(error)
                let err = error.response.data;
                if(error.status === 422){
                    msg(err.message,'error');
                    return;
                }
                if(error.status === 404){
                    msg(err.message,'error');
                    return;
                }
                if(error.status === 500){
                    msg(err.message,'error');
                    return;
                }
                //alert('failed to approved Requests!');
            } 
        });

  })
  $(document).on('click','#decline-btn',async (e) => {
        e.preventDefault();

        let u_id = $('#hidden_u_id').val();
        let req_id = $('#hidden_req_id').val();
        const data = {
            user_id : u_id,
            request_id : req_id
        };

        swalMessage('custom','Are you sure you want to Decline this Request?',async () => {
            try {
                
                const response = await axios.post('/Dashboard-request-decline',data);
                if(response.status === 200){
                    message('user request Declined Successfully!','success');
                }
            } catch (error) {
                let err = error.response.data;
                if(error.status == 404){
                    msg(err.message,'error');
                    return;
                }

                if(error.status === 422){
                    msg(err.message,'info');
                    return;
                }
                if(error.status === 500){
                    msg(err.message,'error');
                }
                
            }
        });
  })

});


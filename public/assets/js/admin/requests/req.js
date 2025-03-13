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
        toggleLoader(true);
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
           
        }finally{
            res('hide loader');
            toggleLoader(false);
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

            toggleLoader(true); //loader

            try {
                
                const response = await axios.post('/Dashboard-request-approve',data);
                if(response.status === 200){             
                    message('User Request Approved successfully!','success');
                    formModalClose(modal,$('#requestForm'));
                }else{
                    msg('Unexpected error, Failed to approved!','error');
                }
            } catch (error) {
                //console.log(error) 
                res(error);             
                const {response}  = error;
                const err = response?.data;

                if(response.status === 422){
                    msg(err.message,'error');
                }else if(response.status === 404){
                    msg(err.message,'error');
                }else if(response.status === 500){
                    msg(err.message,'error');
                }else{
                    msg('Internal Server Error!','error');
                }
  
            }finally{
                res('Hide loader');
                toggleLoader(false);
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
                
                toggleLoader(true);

                const response = await axios.post('/Dashboard-request-decline',data);
                if(response.status === 200){
                    formModalClose(modal,$('#requestForm'));
                    message('user request Declined Successfully!','success');
                }else{
                    msg('Internal Server Error!','error');
                }
            } catch (error) {
                res(error);
                const {response} = error;
                const err = response?.data;

                if(response.status === 404){
                    msg(err.message,'error');
                   
                }else if(response.status === 422){
                    msg(err.message,'info');
                }else if(response.status === 500){
                    msg(err.message,'error');
                }else{
                    msg('Internal Server Error!','error');
                }
 
            }finally{
                res('Hide Loader');
                toggleLoader(false);
            }
        });
  })

});




$(document).ready(function(){

    const modal = $('.userModal');

    $('#userForm').submit(async (e) => {
        e.preventDefault();

        let data = $(e.target).serialize();

        try {
            const response = await axios.post('/Dashboard-User-create',data);
            if(response.status === 200){
                 message('New user created Successfully!','success');
                 formModalClose(modal,$('#userForm'));
            }
        } catch (error) {
            console.log(error);
            const { response } = error;
            const err = response?.data; // Use optional chaining to avoid errors if `response` is undefined
        
            if (err?.code === "EXIT_FORM_NULL") {
                if (Array.isArray(err.data?.email) && err.data.email.length > 0) {
                    err.data.email.forEach((errorMessage) => {
                        msg(errorMessage, 'error');
                    });
                }
        
                if (Array.isArray(err.data?.password) && err.data.password.length > 0) {
                    err.data.password.forEach((errorMessage) => {
                        msg(errorMessage, 'error');
                    });
                }
            } else if (err?.code === "EXIT_BE_ERROR" || response?.status === 500) {
                msg(err?.message ?? 'Unexpected Error: Failed to create new user!', 'error');
            }
        }
    });

    $(document).on('click','#action-status-btn',async (e) => {
       e.preventDefault();
    
       const action = $(e.target).attr('data-status');
       const id = $(e.target).attr('data-id');
       const trimStatus = action.trim();
       const name = $(e.target).attr('data-name');
      
       const data = {
            status : trimStatus,
            id : id
       };
      
       swalMessage('custom',`Are you sure you want to ${trimStatus} this ${name} account?`,async () => {
            try {
                const response = await axios.post('/Dashboard-Users-action-status',data)
                if(response.status === 200){
                    message(name+' Status Updated Successfully!','success');
                }
            } catch (error)  {
                res(error);
                const {response} = error;
                const err = response?.data;
                if(error.status === 422){
                    displayFieldErrors(err.errors?.id, '', msg);
                    displayFieldErrors(err.errors?.status, '', msg);
                }else if(error.status === 500 || err?.code === "EXIT_BE_ERROR"){
                    msg('Failed to update User Status! Please try again!','error');
                }else{
                    msg('Failed to update User Status!','error');
                }
            }
       });
       
    });
    
});
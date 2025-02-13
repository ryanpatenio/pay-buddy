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
    
});
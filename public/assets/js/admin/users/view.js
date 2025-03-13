$(document).ready(function(){

    const urlParams = new URLSearchParams(window.location.search);
    const user_id = urlParams.get('user_id');

    if(!user_id){
        alert('No ID found!');
        window.location.href = '/Dashboard-Users';
        return;
    }

    fetchBasicDetails(user_id);
    fetchEmail(user_id);
    checkStatus(user_id);

    $('#basicForm').submit(async (e) => {
        e.preventDefault();
        
        const serializedData = $(e.target).serialize();
    
        //Convert the serialized string into an object
        const formData = serializeToObject(serializedData);
       
        formData.id = user_id;

        toggleLoader(true);

        try {
            const response = await axios.post('/Dashboard-user-updateDetails',formData);
            if(response.status === 200){
                msg('User details updated successfully','success');
                fetchBasicDetails(user_id);
            }    

        } catch (error) {
            //console.log(error);
            const {response} = error;
           // console.log(response);
            const err = response?.data;
           // console.log(err)
            if(response.status === 422){
                displayFieldErrors(err.errors?.zip_code, 'Zip Code', msg);
                displayFieldErrors(err.errors?.name, 'Name : ', msg);
                displayFieldErrors(err.errors?.phone_number, 'Phone Number', msg);
                displayFieldErrors(err.errors?.country, 'country', msg);
                displayFieldErrors(err.errors?.city, 'Brgy', msg);
                displayFieldErrors(err.errors?.province, 'Province', msg);
                displayFieldErrors(err.errors?.overview, 'Overview', msg);
                displayFieldErrors(err.errors?.id, 'ID', msg);
            }else{
                msg('Unexpected Error! Please try again!','error');
            }
        } finally{
            toggleLoader(false);
        }
    });
    
    $('#form-user-email').submit(async function(e){
        e.preventDefault();

        const data = $(e.target).serialize();
        const formData = serializeToObject(data);

        formData.id = user_id;

        swalMessage('custom','Are you sure you want to update you Email?',async () => {

            toggleLoader(true);
            try {
                const response = await axios.patch('/Dashboard-user-upEmail',formData);
                if(response.status === 200){
                     msg('Email updated successfully!','success');
                     fetchEmail(user_id);
                } 
             } catch (error) {
               
                 const {response} = error;
                 const err = response?.data;
                 if(response.status === 422){
                     msg(err?.message,'error');
                 }else{
                     msg('Failed to update Email. Please try again!','error');
                 }
                
             }finally{
                toggleLoader(false);
             }
        });

    });

    $('#passwordForm').submit(async (e) => {
        e.preventDefault();
        
        const data = $(e.target).serialize();
        const formData = serializeToObject(data);
        formData.id = user_id;

        if(validatePassword()){
            swalMessage('custom','are you sure you want to update your password?',async () => {
                toggleLoader(true);
                try {
                    const response = await axios.patch('/Dashboard-user-pass-update',formData);
                    if(response.status === 200){
                       message("Password Updated successfully!",'success');
                    }
                } catch (error) {
                    //res(error);
                    const {response} = error;
                    const err = response?.data;

                    if(error.status === 422){
                        displayFieldErrors(err.errors?.id, '', msg);
                        displayFieldErrors(err.errors?.newPassword, '', msg);
                    }else if(error.status === 401){
                        msg('Invalid current Password!','info');
                    }
                    else if(error.status === 500){
                        msg('Failed to update Password','error');
                    }


                } finally{
                    toggleLoader(false);
                }
            });
        }
    });
    
    $('#deactivateForm').submit(async (e) => {
        e.preventDefault();

        const data = $(e.target).serialize();
        const formData = serializeToObject(data);
        formData.id = user_id;

        swalMessage('custom','Are you sure you want to Deactivate this User?',async () => {
            toggleLoader(true);
            try {
                const response = await axios.post('/Dashboard-user-deactivate',formData);
                if(response.status === 200){
                    msg('User Deactivated Successfully!','success');

                    setTimeout(() => {
                        window.location.href ='/Dashboard-Users';
                    }, 2000); //2seconds delay
                   
                }
            } catch (error) {
              // res(error);
               const {response} = error;
               const err = response?.data;
               if(error.status === 422){
                    //expect validation error
                    displayFieldErrors(err.errors?.id, '', msg);
                    displayFieldErrors(err.errors?.confirmDeactivate, '', msg);
                    
               }else if(error.status === 500){
                    msg('Failed to delete account Please try again!','error');
               }else{
                    msg('Internal Server Error!','error');
               }

            } finally{
                toggleLoader(false);
            }
        });

    })
    $(document).on('click','#activate-btn',async (e) => {
        e.preventDefault();

        const data = {
            id:user_id
        };
        
        swalMessage('custom','Are you sure you want to Activate this User?',async () => {
            toggleLoader(true);
            try {
                const response = await axios.post('/Dashboard-user-activate',data);
                if(response.status === 200){
                    message('User Activate successfully!','success');
                }else{
                    alert('Failed');
                }
                
            } catch (error) {
                res(error);
                const {response} = error;
                const err = response?.data;
                if(error.status === 422){
                    displayFieldErrors(err.errors?.id, '', msg);
                }else if(error.status === 500 || err?.code === "EXIT_BE_ERROR"){
                    msg('Failed to Activate User Please try again!','error');
                }else{
                    msg('Internal Server Error!','error');
                }
            }finally{
                toggleLoader(false);
            }
        })
    });

    async function fetchBasicDetails(id){
        const fullname = $('#fullName');
        const phone = $('#phoneNumber');
        const country = $('#country');
        const city = $('#city');
        const brgy = $('#brgy');
        const province = $('#province');
        const zip_code = $('#zip-code');
        const overview = $('#overview');

        try {
            const response = await axios.get(`/Dashboard-user-details/${id}`);
            if(response.status === 200){               
                const data = response?.data;
                
                fullname.val(data?.name);
                phone.val(data?.phone_number);
                country.val(data?.country ?? "Philippines");
                city.val(data?.city);
                brgy.val(data?.brgy);
                province.val(data?.province);
                zip_code.val(data?.zip_code);
                overview.val(data?.overview);

            }
        } catch (error) {
            console.log(error)
            const { response } = error;
            const err = response?.data;

            if(err?.code ==="EXIT_404"){
                msg('failed to fetch data','error');              
                setTimeout(() => {
                    window.location.href = '/Dashboard-Users';
                }, 2000);
            }else if(err?.code === "EXIT_BE_ERROR" || response.status === 500){
                msg('Failed to fetch Details','error');
                setTimeout(() => {
                    window.location.href = '/Dashboard-Users';
                }, 2000);
                
            }
        }
    }

    async function fetchEmail(id){
        const email_input = $('#user-email-input');
        const email_head = $('#user-email-head');
        try {
            const response = await axios.get(`/Dashboard-user-email/${id}`)
            if(response.status === 200){
                const data = response?.data;
                email_head.text(data?.data);
                email_input.val(data?.data);
            }
           
        } catch (error)  {          
            const {response} = error;
            const err = response?.data;
            //res(err);
            if(err?.code === "EXIT_404" || response.status === 404){
                msg('Invalid or missing ID','error');
                setTimeout(() => {
                    window.location.href='/Dashboard-Users';
                }, 2000);
            }else if(err?.code === "EXIT_BE_ERROR" || response.status === 500){
                msg('Failed to fetch Data!','error');
                setTimeout(() => {
                    window.location.href='/Dashboard-Users';
                }, 2000);
            }
        }
    }

    async function checkStatus(id) {
        const delBtn = $('#delete-btn');
        const actBtn = $('#activate-btn');

        try {
            const response = await axios.get(`/Dashboard-user-status/${id}`);
            if (response.status === 200) {
                const resData = response.data;
    
                // Validate the response data
                if (resData?.data !== undefined) {
                    // Update button visibility based on the status
                    if (resData.data === 1) {
                        delBtn.hide();
                        actBtn.show();
                    } else {
                        delBtn.show();
                        actBtn.hide();
                    }
                } else {
                    console.error('Invalid response data:', resData);

                    msg('Invalid response Data!'+resData,'error');
                    setTimeout(() => {
                        window.location.href ='/Dashboard-Users';
                    }, 2000);
                }
            } else {
                console.error('Unexpected status code:', response.status);
                msg('Unexpected Error!'+response.status,'error');
                setTimeout(() => {
                    window.location.href ='/Dashboard-Users';
                }, 2000);
                
            }
        } catch (error) {   
            const {response} = error;
            const err = response.data;
            
            if(err?.code === "EXIT_404" || error.status === 404){
                msg(err?.message,'error');
                setTimeout(() => {
                    window.location.href ='/Dashboard-Users';
                }, 2000);
            }else{
                msg("Failed to fetch status",'error');
                setTimeout(() => {
                    window.location.href ='/Dashboard-Users';
                }, 2000);
            }
        }
    }

    function validatePassword() {
        var newPassword = $('#newPassword').val();
        var confirmPassword = $('#newPasswordAgain').val();
        var isValid = true;

        // Check if passwords match
        if (newPassword !== confirmPassword) {           
            $('.new-pass-invalid-feedback').text('Passwords do not match').css('display', 'block');
            isValid = false;
        } else {          
            $('.new-pass-invalid-feedback').hide();
  
        }

        // Check password strength using zxcvbn
        var result = zxcvbn(newPassword);
        if (result.score < 2) { // Adjust the score threshold as needed           
            $('.confirm-pass-invalid').text('Password is too weak').show();
            isValid = false;
        } else {           
            $('.confirm-pass-invalid').hide();
            
        }

        return isValid;
    }

    
});
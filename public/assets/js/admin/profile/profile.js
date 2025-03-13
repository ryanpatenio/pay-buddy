$(document).ready(function(){
    const avatarInput = $('#avatar-input');
    const saveButton = $('#save-button');
    const loading = $('.loading');
   

    fetchBasicDetails();
    fetchEmail();
   
    $('#basicForm').submit(async (e) => {
        e.preventDefault();
        
        const formData = $(e.target).serialize();

        swalMessage('custom','Are you sure you want to update your Profile?',async () => {
            toggleLoader(true);
            try {
                const response = await axios.patch('/Dashboard-user-updateDetails',formData);
                if(response.status === 200){
                    msg('User details updated successfully','success');
                    fetchBasicDetails();
                }else{
                    msg('Failed to update profile Please try again Later!','info');
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
    
                }else if(error.status === 500 || err?.code === "EXIT_BE_ERROR"){
                    msg('Failed to update Profile! Please try again!','error');
                }else{
                    msg('Internal Server Error!','error');
                }
    
            }finally{
                toggleLoader(false);
            }
        });
        
    });

    $('#form-user-email').submit(async function(e){
        e.preventDefault();

        const data = $(e.target).serialize();
       
        swalMessage('custom','Are you sure you want to update you Email?',async () => {
            toggleLoader(true);
            try {
                const response = await axios.patch('/Dashboard-profile-upEmail',data);
                if(response.status === 200){
                     msg('Email updated successfully!','success');
                     fetchEmail();
                } 
             } catch (error) {
               
                 const {response} = error;
                 const err = response?.data;
              
                 if(error.status === 422 || err?.code === "EXIT_FORM_NULL"){
                    displayFieldErrors(err.data.user_email, '', msg);

                 }else if(error.status === 500 || err?.code === "EXIT_BE_ERROR"){
                    msg('Failed to update email Please try again later','error');
                 }
                 else{
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
      

        if(validatePassword()){
            swalMessage('custom','are you sure you want to update your password?',async () => {
                toggleLoader(true);
                try {
                    const response = await axios.patch('/Dashboard-profile-pass-update',data);
                    if(response.status === 200){
                       message("Password Updated successfully!",'success');
                    }
                } catch (error) {
                    res(error);
                    const {response} = error;
                    const err = response?.data;

                    if(error.status === 422){
                        displayFieldErrors(err.errors?.id, '', msg);
                        displayFieldErrors(err.errors?.newPassword, '', msg);
                    }else if(error.status === 404){
                        msg('Invalid current Password!','info');
                    }
                    else if(error.status === 500 || err?.code === "EXIT_BE_ERROR"){
                        msg('Failed to update Password','error');
                    }

                } finally{
                    toggleLoader(false);
                }
            });
        }
    });

    $('#avatar-input').on('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            $('.loading').show(); // Show loading indicator

            reader.onload = function(e) {
                $('.avatar-img').attr('src', e.target.result); // Update image src
                $('.loading').hide(); // Hide loading indicator
                $('#save-button').show(); // Show save button
            };

            reader.readAsDataURL(file); // Read the file as a Data URL
        }
    });

    saveButton.on('click', async function () {
        const file = avatarInput[0].files[0]; // Get the selected file
        if (!file) {
            alert('Please select an image first!');
            return;
        }

        const formData = new FormData();
        formData.append('avatar', file); // Append the file to FormData
       
        try {
            loading.show(); // Show loading indicator
            saveButton.prop('disabled', true); // Disable the save button

            // Send the file to the Laravel backend using Axios
            const response = await axios.post('/Dashboard-profile-upload-avatar', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data', // Important for file uploads
                },
            });

            if(response.status === 200){             
                message('Avatar updated successfully!','success');
            }else{
                msg('Internal Sever Error!','error');
            }

            
        } catch (error) {
            //alert('Error uploading profile image.')          
            const {response} = error;
            const err = response?.data;

            if(err?.code === "EXIT_FORM_NULL"){
                message('Internal Server Error!'+err?.message,'error');
            }else if(error.status === 422){
                displayFieldErrors(err.errors?.avatar, '', msg);
            }else if(error.status === 500 || err?.code === "EXIT_BE_ERROR"){
                msg('Failed to update Avatar Please try again later!','info');
            }else{
                message('Internal Server Error!','error');
            }

        } finally {
            loading.hide(); // Hide loading indicator
            saveButton.prop('disabled', false); // Re-enable the save button
        }
    });

    async function fetchBasicDetails(){
        const fullname = $('#fullName');
        const phone = $('#phoneNumber');
        const country = $('#country');
        const city = $('#city');
        const brgy = $('#brgy');
        const province = $('#province');
        const zip_code = $('#zip-code');
        const overview = $('#overview');

        try {
            const response = await axios.get(`/Dashboard-profile-details`);
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

            }else{
                console.log("Internal server Error!");
            }
        } catch (error) {
            console.log(error)
            const { response } = error;
            const err = response?.data;

            if(err?.code ==="EXIT_404"){
                msg('failed to fetch data','error');              
               
            }else if(err?.code === "EXIT_BE_ERROR" || response.status === 500){
                msg('Failed to fetch Details','error'); 
                
            }
        }
    }
    async function fetchEmail(){
        const email_input = $('#user-email-input');
        const email_head = $('#user-email-head');
        try {
            const response = await axios.get(`/Dashboard-profile-email`)
            if(response.status === 200){
                const data = response?.data;
                email_head.text(data?.data);
                email_input.val(data?.data);
            }else{
                console.log("internal Server Error!");
            }
           
        } catch (error)  {          
            const {response} = error;
            const err = response?.data;
            //res(err);
            if(err?.code === "EXIT_404" || response.status === 404){
                msg('Invalid or missing ID','error');
               
            }else if(err?.code === "EXIT_BE_ERROR" || response.status === 500){
                msg('Failed to fetch Data!','error');
               
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
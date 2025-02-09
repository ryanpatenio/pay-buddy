$(document).ready(function(){
    fetchEmail();

    $('#basicForm').on('submit', function(e){
        e.preventDefault();

        let Data = $(this).serialize();
        swalMessage('custom','Are you sure you want to update your profile?',async function(){

            try {
           
                const response = await axios.patch('/Profile-update',Data);
                if(response.status !== 200){
                   console.log('failed to update',response.status);
                   return;
                }
                message("Profile update Successfully!",'success');
   
               // console.log(response);
           } catch (error) {
               console.log(error)
           }

        });

    });

    $('#form-user-email').submit(function(e){
        e.preventDefault();

        let Data = $(this).serialize();

        swalMessage('custom','Are you sure you want to update your Email?',async function(){
            try {
                const response = await axios.patch('/Profile-update-email',Data);
                if(response.status === 200){
                   message('Email updated Successfully!','success');
                    
                }else{
                    console.log('faied to update Email',response.status);
                }

            } catch (error) {   
                let err = error.response.data;
                console.log(err)
                if(err.code === "EXIT_FORM_NULL"){
                    alert(err.data.user_email[0])
                }
            }

        });

    });
 
    //submit password Form
    $('#passwordForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        let Data = $(this).serialize();

        if (validatePassword()) {           
            swalMessage('custom','Are you sure you want to change your password?', async function () {
               try {
                const response = await axios.patch('/Profile-password-update',Data);
                if(response.status === 200){
                   message('Pasword updated successfully!','success');
                }

               } catch (error) {                
                let err = error.response.data;
                // console.log(err)
                if(err.codeStatus === "EXIT_FORM_NULL"){
                    msg(err.message,'error');
                }
                if(err.code === "EXIT_FORM_NULL"){
                   alert(err.data.current_password[0]);
                }
               }
                
                
            });
            
          
        }
    });
    
    $('#deactivateForm').submit(function(e){
        e.preventDefault();

        let data = $(this).serialize();

        swalMessage('custom','Are you sure you want to deactivate your account? This action is irreversible, and your account cannot be recovered.',async function () {
           
            try {
                const response = await axios.post('/Profile-deactivate',data);
                if(response.status === 200){
                    window.location.href='/';
                }
                console.log(response)

            } catch (error) {
                console.log(error)
            }

        });

    });

    $('#addWalletForm').submit(function(e){
        e.preventDefault();

        let data = $(this).serialize();

        swalMessage('custom','Are you sure you want to add new wallet?',async () => {
            try {
                const response = await axios.post('/Profile-new-wallet',data);
                if(response.status === 200){
                    message('New wallet added successfully!','success');
                }
            } catch (error) {   
                let err = error.response.data;
                console.log(error)
            } 
        });
        
    });

    async function fetchEmail(){
      
        try {
            const fetch = await axios.get('/Profile-email');          
            if(fetch.status === 200){
                $('#user-email-head').text(fetch.data.email);
                $('#user-email-input').val(fetch.data.email);
                $('#side-name').text(fetch.data.name);
                $('#role').text(fetch.data.role);
                
            }else{
                console.log(error.status);
            }
           
        } catch (error) {
            console.log(error.response)
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
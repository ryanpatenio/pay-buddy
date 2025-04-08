$(document).ready( async function(){

    const urlParams = new URLSearchParams(window.location.search);
    const user_id = urlParams.get('user_id');
    const avatarInput = $('#avatar-input');
    const saveButton = $('#save-button');
    const loading = $('#loading');

    const editModal = $('.editModal');
    const addModal = $('#addNewWalletModal');

    
    if(!user_id){
        alert('No ID found!');
        window.location.href = '/Dashboard-Users';
        return;
    }
    fetchBasicDetails(user_id)
    fetchEmail(user_id)
    checkStatus(user_id)
    fetchNameAndAvatar(user_id)
    fetchUserWallets(user_id);
    fetchAvailableCurrencies(user_id)

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

    $('#save-button').click( async function (e){
        e.preventDefault();

        const file = avatarInput[0].files[0]; // Get the selected file
        if (!file) {
            alert('Please select an image first!');
            return;
        }

        const formData = new FormData();
        formData.append('avatar', file);
        formData.append('id',user_id);

        const url = '/User-update-avatar';

       swalMessage('custom','Are you sure you want to update this User profile?', async () => {
            toggleLoader(true);
            try {
                loading.show(); // Show loading indicator
                saveButton.prop('disabled', true); // Disable the save button

                const response = await axios.post(url, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data', // Important for file uploads
                    },
                });
                
                if(response.status === 200){                
                    const data = response?.data;
                    msg(data?.message,'success');
                    await fetchNameAndAvatar(user_id);
                }
        } catch (error) {          
            const {response} = error;
            const err = response?.data;
            if(response.status === 422 || err?.code === "EXIT_FORM_NULL"){
                displayFieldErrors(err.errors?.avatar, '', msg);
                displayFieldErrors(err.errors?.id, '', msg);

            }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                msg('Internal Server Error!','error');
            }else{
                msg('Internal Server Error!','error');
            }

        }finally{
            toggleLoader(false);
            loading.hide();
            saveButton.prop('disabled', false);
            saveButton.hide();
        }
       });

    });
    $(document).on('click','.edit-wallet-btn',async function(e){
        e.preventDefault();

        resetForm($('#editForm'));

        const id = $(this).data('id');
        const balance = $(this).data('balance');
         
        const hidden_id = $('#hh-id');
        const bal = $('#current-balance');

        hidden_id.val(id);
        bal.val(balance);

        editModal.modal('show');
    });
    $('#editForm').submit(async function (e)  {
        e.preventDefault();

        const data = $(this).serialize();

        swalMessage('custom','Are you sure you want to update this user Balance?',async () => {
            toggleLoader(true);
            try {
                const url = '/update-user-walletBalance';
                const response = await axios.patch(url,data);
                if(response.status === 200){
                    
                    const data = response?.data;
                    msg(data?.message,'success');
                    await fetchUserWallets(user_id);
                }else{
                    msg('Error Overlap','error');
                }
            } catch (error) {
                
                const {response} = error;
                const err = response?.data;
                if(response.status === 422){
                    displayFieldErrors(err.errors?.id, '', msg);
                    displayFieldErrors(err.errors?.balance, '', msg);
                }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                    msg(err?.message || "Failed to update user wallet balance",'error');
                }else{
                    msg('Internal Server Error!','error');
                }

            }finally{
                toggleLoader(false);
                formModalClose(editModal,$('#editForm'));
            }
            
        });
    });

    $('#addWalletForm').submit(async function (e){
        e.preventDefault();

        const data = $(this).serialize();
        const url = '/add-newCurrency-toUserWallet';

        swalMessage('custom','Are you sure you want to add new E-Wallet in this User?',async () => {
            toggleLoader(true);
            try {
                const response = await axios.post(url,data);
                if(response.status === 200){
                   const data = response?.data;
                   msg(data?.message,'success');
                   
                }else{
                    msg('Error Overlap','error');
                }
            } catch (error) {
               
                const {response} = error;
                const err = response?.data;
                if(response.status === 422){
                    displayFieldErrors(err.errors?.id, '', msg);
                    displayFieldErrors(err.errors?.currency, '', msg);
                }else if(response.status === 404 || err?.code === "EXIT_404"){
                    msg(err?.message || "404 not found!",'error');
                }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                    msg(err?.message || "Internal Server Error!",'error');
                }else{
                    msg('Internal server Error!','error');
                }

            }finally{
               toggleLoader(false);
               formModalClose(addModal,$('#addWalletForm'));
               await fetchUserWallets(user_id);
               await fetchAvailableCurrencies(user_id);
            }
        });
    });


    async function fetchNameAndAvatar(id){
        const fullName = $('#side-name');
        const u_img = $('#u-profile');

        try {
            const url = `/fetch-user/${id}`;
            const response = await axios.get(url);
            if(response.status === 200){              
                const data = response?.data?.data;
                           
                const defaultAvatar = 'assets/img/avatar/default.jpg';
                const userAvatar = data?.user_details?.img_url;
                const imgPath = userAvatar ? `/storage/${userAvatar}` : defaultAvatar;

                fullName.text(data?.name);
                u_img.attr('src',imgPath);
            }
        } catch (error) {
            res(error);
            const {response} = error;
            const err = error?.data;

            if(err?.code === "EXIT_BE_ERROR"){
                msg(err?.message || "failed to fetch avatar",'error');
            }else{
                res(err?.message || "Internal server Error!");
            }
        }
    
    }
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
    async function fetchUserWallets(id){

        try {
            const url = `/user-wallets/${id}`;
            const response = await axios.get(url);
            if(response.status === 200){
                const data = response?.data?.data;
                const walletList = $('#wallet-list');

                walletList.empty();//clear list

                data.forEach(wallet => {
                    const listItem = `
                     <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div class="d-flex align-items-center">
                                        <!--SVG for VISA CARD-->
                                        
                                        <div class="ms-4 d-flex">
                                            <h3 class="h4 mb-0 px-4 nav-link">(${wallet.currency.code}) <strong> ${wallet.balance}</strong></h3>
        
                                            <input id="key-0${wallet.id}" class="form-control w-200px me-3 " value="${wallet.account_number}" style="margin-left: 18px;" readonly>
                                            <!-- Button -->
                                            <button class="clipboard btn btn-link px-0" data-clipboard-target="#key-0${wallet.id}" data-bs-toggle="tooltip" data-bs-title="Copy to clipboard">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="18" width="18">
                                                    <g>
                                                        <path d="M13.4,4.73a.24.24,0,0,0,.2.26,1.09,1.09,0,0,1,.82,1.11V7.5a1.24,1.24,0,0,0,1.25,1.24h0A1.23,1.23,0,0,0,16.91,7.5V4a1.5,1.5,0,0,0-1.49-1.5H13.69a.29.29,0,0,0-.18.07.26.26,0,0,0-.07.18C13.44,3.2,13.44,4.22,13.4,4.73Z" style="fill: currentColor"/>
                                                        <path d="M9,21.26A1.23,1.23,0,0,0,7.71,20H3.48a1.07,1.07,0,0,1-1-1.14V6.1A1.08,1.08,0,0,1,3.33,5a.25.25,0,0,0,.2-.26c0-.77,0-1.6,0-2a.25.25,0,0,0-.25-.25H1.5A1.5,1.5,0,0,0,0,4V21a1.5,1.5,0,0,0,1.49,1.5H7.71A1.24,1.24,0,0,0,9,21.26Z" style="fill: currentColor"/>
                                                        <path d="M11.94,4.47v-2a.5.5,0,0,0-.5-.49h-.76a.26.26,0,0,1-.25-.22,2,2,0,0,0-3.95,0A.25.25,0,0,1,6.23,2H5.47A.49.49,0,0,0,5,2.48v2a.49.49,0,0,0,.49.5h6A.5.5,0,0,0,11.94,4.47Z" style="fill: currentColor"/>
                                                        <path d="M19,17.27H15a.75.75,0,0,0,0,1.5h4a.75.75,0,0,0,0-1.5Z" style="fill: currentColor"/>
                                                        <path d="M14.29,14.54a.76.76,0,0,0,.75.75h2.49a.75.75,0,0,0,0-1.5H15A.76.76,0,0,0,14.29,14.54Z" style="fill: currentColor"/>
                                                        <path d="M23.5,13.46a2,2,0,0,0-.58-1.41l-1.41-1.4a2,2,0,0,0-1.41-.59H12.49a2,2,0,0,0-2,2V22a2,2,0,0,0,2,2h9a2,2,0,0,0,2-2Zm-11-.4a1,1,0,0,1,1-1h6.19a1,1,0,0,1,.71.29l.82.82a1,1,0,0,1,.29.7V21a1,1,0,0,1-1,1h-7a1,1,0,0,1-1-1Z" style="fill: currentColor"/>
                                                    </g>
                                                </svg>
                                            </button>
                                            <button class="clipboard btn btn-link px-3 edit-wallet-btn" data-balance="${wallet.balance}" data-id="${wallet.id}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                  </svg>
                                            </button>
                                        </div>
                                    </div>
                                   
                                </li>
                    `;
                    walletList.append(listItem);
                });
                new ClipboardJS('.clipboard');
                $('[data-bs-toggle="tooltip"]').tooltip();
            }else{
                res('Error overlap');
            }
        } catch (error) {
           
            const {response} = error?.data;
            const err = response.data;
            if(response.status === 404 || err?.code === "EXIT_404"){
                res('no data found1');
            }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                res(err?.message || 'Failed to fetch user wallets');
            }else{
                res('Internal Server Error!');
            }
        }
    }

    async function fetchAvailableCurrencies(id){
        $('#user-id').val(id);
        const url = `/fetch-available-currenciesById/${id}`;
        try {
            const response = await axios.get(url);
            if(response.status === 200){
               
                const data = response?.data?.data;
                const currencyList = $('#currency-list');
                currencyList.empty();

                data.forEach(currency => {
                    const listItems = `
                       <option value="${currency.id}">${currency.code}</option> 
                    `;
                    currencyList.append(listItems);
                });
            }else{
                res('Internal Server Error!');
            }
        } catch (error) {
           const {response} = error;
           const err = response?.data;

           if(response.status === 404 || err?.code === "EXIT_404"){
             res(err?.message || 'unable to fetch currencies');
           }else if(response.status === 500){
             res('Internal Server Error!');
           }else{
            res('Internal Server Error!');
           }
        }
    }

    $('#avatar-input').on('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            $('.loading').show(); // Show loading indicator

            reader.onload = function(e) {
                $('#u-profile').attr('src', e.target.result); // Update image src
                $('.loading').hide(); // Hide loading indicator
                $('#save-button').show(); // Show save button
            };

            reader.readAsDataURL(file); // Read the file as a Data URL
        }
    });
    
});
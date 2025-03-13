$(document).ready(function () {
   // $('#loading-container').hide();

   const editModal = $('.editModal');
   const addModal = $('.addModal');
   const imgModal = $('.editImgModal');
  
    const imgInput = $('#img-input');
    const updateImg = $('#new-img');
    const name =  $('#name');
    const symbol = $('#symbol');
    const code = $('#code');
    const h_id = $('#hidden_id');

    $('#currencyForm').submit(async (e) => { 
        e.preventDefault();
        const file = imgInput[0].files[0];

        if (!file) {
            alert('Please select an image first!');
            return;
        }

        const formData = new FormData(e.target);
        formData.append('img_url', file);

        swalMessage('custom','Are you sure you want to add new Currency?',async () => {
            const url = '/Currencies-create';
            toggleLoader(true);
            try {
                const response = await axios.post(url,formData);
                if(response.status === 200){
                    formModalClose(addModal,$(e.target));
                    message('New Currency created successfully!','success');
                }else{
                    msg('Internal Server Error!','error');
                }
                
            } catch (error) {
                const {response} = error;
                const err = response?.data;
                
                if(response.status === 422){
                    displayFieldErrors(err.errors?.code, '', msg);
                    displayFieldErrors(err.errors?.name, '', msg);
                    displayFieldErrors(err.errors?.symbol, '', msg);
                    displayFieldErrors(err.errors?.img_url, '', msg);
                }else if(response.status === 500 || err.code === "EXIT_BE_ERROR" ){
                    msg('Internal Server Error! Please try again Later','error');
                }else{
                    msg('Server Error!','error');
                }
                

            }finally{
                res('Hide loader');
                toggleLoader(false);
            }
        });

    });

    $(document).on('click','#edit-btn', async (e) =>{
        e.preventDefault();

    resetForm($('#editForm')); //reset Form First

    let ID = $(e.target).attr('data-id');
    const url = `/Currency-get/${ID}`;

    // Show the loading spinner
    toggleLoader(true);

    try {
        const response = await axios.get(url);
        if(response.status === 200){
            const data = response?.data;
            code.val(data.code);
            name.val(data.name);
            symbol.val(data.symbol);
            h_id.val(data.id);

            editModal.modal('show');//show modal
        }else{
            msg('Internal Server Error','error');
        }
    } catch (error) {
        res(error);
        const {response} = error;
        const err = response?.data;
        if(response.status === 422){
            msg('Id is required','error');
        }else{
            msg('Internal Server error!','error');
        }

    }finally {
        // Hide the loading spinner
        console.log("Hiding loader now");
        toggleLoader(false);
    }


    });

    $('#editForm').submit(async (e) => { 
        e.preventDefault();
        
        const data = $(e.target).serialize();
        const url = '/Currency-update';

        toggleLoader(true);
        try {
            const response = await axios.patch(url,data);
            if(response.status === 200){
                res(response);
                formModalClose(editModal,$(e.target));
                message('Currency updated Successfully!','success');
            }else{
                msg('Internal Server Error!','error');
            }
        } catch (error) {
        
            const {response} = error;
            const err = response?.data;

            if(response.status === 422){
                displayFieldErrors(err.errors?.code, '', msg);
            }else if(response.status === 500 || err.code === "EXIT_BE_ERROR"){
                msg('Internal Server Error!','error');
            }else{
                msg('Internal Server Error!','error');
            }
        }finally{
            res('hide loader...');
            toggleLoader(false);
        }

    });

    $(document).on('click','#edit-btn-img', async (e) => {
        e.preventDefault();

        resetForm($('#editImgForm'));

        let ID = $(e.target).attr('data-id');
        const url = `/Currency-get/${ID}`;
        toggleLoader(true);
        try {
            const response = await axios.get(url);
            if(response.status === 200){

                const data = response?.data;
                $('#current-img').attr('src','/storage/'+data.img_url);
                $('#id').val(data.id);

                imgModal.modal('show');
            }
        } catch (error) {
            res(error);
            const {response} = error;
            const err = response?.data;
            if(response.status === 422){
                msg('Is is required','error');
            }else{
                msg('Internal server error!','error');
            }

        }finally{
            toggleLoader(false);
        }
        
    });

    $(document).on('submit','#editImgForm', async (e) => {
        e.preventDefault();
        const file = updateImg[0].files[0];

        if (!file) {
            alert('Please select an image first!');
            return;
        }

        const formData = new FormData(e.target);
        const url = '/Currency-update-img';

        toggleLoader(true);//loading state
        try {
            const response =  await axios.post(url,formData);
            if(response.status === 200){
                formModalClose(imgModal,$(e.target));
                message('Currency Image updated successfully!','success');
            }else{
                msg('Internal Server Error!','error');
            }
        } catch (error) {
           
            const {response}  = error;
            const err = response?.data;
            if(response.status === 422 || err.code === "EXIT_FORM_NULL"){
                displayFieldErrors(err.errors?.id, '', msg);
                displayFieldErrors(err.errors?.new_img, '', msg);
            }else if(response.status === 500){
                msg('Internal Server Error!','error');
            }else{
                msg('Internal Server Error!','error');
            }

        }finally{
            res('Hide loader');
            toggleLoader(false);
        }


    });

    $('#new-img').on('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            $('.loading-indicator').show(); // Show loading indicator

            reader.onload = function(e) {
                $('#current-img').attr('src', e.target.result); // Update image src
                $('.loading-indicator').hide(); // Hide loading indicator
               
            };

            reader.readAsDataURL(file); // Read the file as a Data URL
        }
    });

});
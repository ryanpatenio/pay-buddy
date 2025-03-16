
$(document).ready(function () {
   
    const addModal = $('.addModal');
    const editModal = $('.editModal');
    const imgModal = $('.editImgModal');
    const apiModal = $('.editApiModal');

    const inputFile  = $('#img_url');
    const editInputFile = $('#new-img');
    const name = $('#name');
    const inputUrl = $('#url');
    const description = $('#description');

    const h_id = $('#hidden_id');

    $('#bForm').submit(async (e) => { 
        e.preventDefault();

        const file = inputFile[0].files[0];

        if (!file) {
            alert('Please select an image first!');
            return;
        }

        const formData = new FormData(e.target);
        const url = '/Bank-create';

        swalMessage('custom','Are you sure you want to add new Bank Partners?',async ()=> {
            toggleLoader(true);
            
            try {
                const response = await axios.post(url,formData);
                if(response.status === 200){
                    formModalClose(addModal,$(e.target));
                    message('New Bank Created Successfully!','success');
                }else{
                    msg('Internal Server error!','error');
                }
            } catch (error) {               
                const {response} = error;
                const err = response?.data;
                if(response.status === 422 || err.code === "EXIT_FORM_NULL"){
                    displayFieldErrors(err.errors?.name, '', msg);
                    displayFieldErrors(err.errors?.url, '', msg);
                    displayFieldErrors(err.errors?.api_key, '', msg);
                    displayFieldErrors(err.errors?.img_url, '', msg);
                    displayFieldErrors(err.errors?.description, '', msg);
                }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                    msg('Internal Server error!','error');
                }else{
                    msg('Internal Server error!','error');
                }

            }finally{
                toggleLoader(false);
            }

        });
        
    });

    $(document).on('click','#edit-btn', async (e) => {
        e.preventDefault();

        resetForm($('#editBForm'));//reset form first

        const ID = $(e.target).attr('data-id');
        const url = `/Bank-get/${ID}`;
        toggleLoader(true);
        try {
            const response  = await axios.get(url);
            if(response.status === 200){
                
                const data = response?.data?.data;
                name.val(data.name);
                inputUrl.val(data.url);
                description.val(data.description);            
                h_id.val(data.id);

                editModal.modal('show');
            }else{
                msg('Internal Server error!');
            }
        } catch (error) {
        
          const {response} = error;
          const err = response?.data;
          if(response.status === 422){
            msg('Invalid ID or null','error');
          }else if(response.status === 500){
            msg('Internal Server Error!','error');
          }else{
            msg('Internal Server Error!','error');
          }

        }finally{
            toggleLoader(false);
        }
    });

    $('#editBForm').submit(async (e) => { 
        e.preventDefault();
        
        const  formData = $(e.target).serialize();
        const url = '/Bank-update';

        swalMessage('custom','Are you sure you want to update this Bank?',async ()=>{

            toggleLoader(true); //toggle loading state
            try {
                const response = await axios.patch(url,formData);
                if(response.status === 200){
                    formModalClose(editModal,$(e.target));
                    message('Bank updated Successfully!','success')
                }else{
                    msg('Internal Server Error!','error');
                }
                
            } catch (error) {
               
                const {response} = error;
                const err = response?.data;
                //res(err);
                if(response.status === 422 || err?.code === "EXIT_FORM_NULL"){
                    displayFieldErrors(err.errors?.hidden_id, '', msg);
                    displayFieldErrors(err.errors?.name, '', msg);
                    displayFieldErrors(err.errors?.url, '', msg);
                    displayFieldErrors(err.errors?.description, '', msg);
                }else if(err?.code === "EXIT_404"){
                    msg(err?.message,'error');
                }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                    msg('Internal Server Error!','error');
                }else{
                    msg('Internal Server Error!','error');
                }
    
            }finally{
                toggleLoader(false);
            }
        });
       
        
    });

    $(document).on('click','#edit-btn-api-key', async (e)=> {
        e.preventDefault();

        resetForm($('#editApiForm'));

        const ID = $(e.target).attr('data-id');
        const url = `/Bank-get/${ID}`;
        toggleLoader(true);
        try {
            const response = await axios.get(url);
            if(response.status === 200){
             
                const data = response?.data?.data;
                $('#b_id').val(data.id);
                $('#bank-name').val(data.name);
                apiModal.modal('show');
            }else{
                msg('Internal server Error!','error');
            }
        } catch (error) {
          
            const {response} = error;
            const err = response?.data;
            if(response.status === 422){
                msg('Invalid Id or No data found!','error');
            }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                msg('Internal Server error!','error');
            }else{
                msg('Internal Server error!','error');
            }

        }finally{
            toggleLoader(false);
        }
    });

    $('#editApiForm').submit(async (e) => { 
        e.preventDefault();
        
        const data = $(e.target).serialize();
        const url = '/Bank-update-api';

        swalMessage('custom','Are you sure you want to change Bank Api Key?',async ()=>{
            toggleLoader(true);
            try {
                const response = await axios.patch(url,data);
                if(response.status === 200){
                   formModalClose(apiModal,$(e.target));
                   message('Bank Api Key updated successfully!','success');
                }else{
                    msg('Internal Server Error!','error');
                }  
            } catch (error) {
                res(error);
                const {response} = error;
                const err = response?.data;
                if(response.status === 401 || err?.code === "EXIT_401"){
                    msg(err?.message,'error');
                }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                    msg('Internal Sever Error!','error');
                }else{
                    msg('Internal Sever Error!','error');
                }

            }finally{
                toggleLoader(false);
            }
        });
       
        

    });

    $(document).on('click','#edit-btn-img', async (e) => {
        e.preventDefault();

        resetForm($('#editImgForm'));
        const ID = $(e.target).attr('data-id');
        const url = `/Bank-get/${ID}`;

        toggleLoader(true);
        try {
            const response = await axios.get(url);
            if(response.status === 200){
              
                const data = response?.data?.data;
                $('#current-img').attr('src','/storage/'+data?.img_url);
                $('#bank-hidden-id').val(data?.id);
                $('#bank_name').val(data?.name);
                imgModal.modal('show');

            }else{
                msg('Internal Server Error!','error');
            }
        } catch (error) {
          
            const {response} = error;
            const err = response?.data; 

            if(response.status === 422 || err?.code === "EXIT_FORM_NULL"){
                msg('Invalid ID or No data found!','error');
            }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                msg('Internal Server Error!','error');
            }else{
                msg('Internal Server Error!','error');
            }
        }finally{
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

    $('#editImgForm').submit(async (e) =>{ 
        e.preventDefault();

        const file = editInputFile[0].files[0];

        if (!file) {
            alert('Please select an image first!');
            return;
        }
        
        const formData = new FormData(e.target);
        const url = '/Bank-update-img';

        swalMessage('custom','Are you sure you want to update Bank Image?',async ()=>{
            toggleLoader(true);

            try {
                const response = await axios.post(url,formData);
                if(response.status === 200){
                    formModalClose(imgModal,$(e.target));
                    message('Bank Image updated successfully!','success');
                }else{
                    msg('Internal Server Error!','error');
                }
            } catch (error) {       
                
                const {response} = error;
                const err = response?.data;
                if(response.status === 401 || err?.code === "EXIT_401"){
                    msg(err?.message,'error');
                }else if(response.status === 422){
                    displayFieldErrors(err.errors?.id, '', msg);
                    displayFieldErrors(err.errors?.new_img, '', msg);
                }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                    msg(err?.message,'error');
                }else{
                    msg('Internal Server Error!','error');
                }

            }finally{
                toggleLoader(false);
            }
        });
    });
});

$(document).ready(function () {
   
    const addModal = $('.addModal');
    const editModal = $('.editModal');
    const imgModal = $('.imgModal');

    const inputFile  = $('#img_url');
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


});
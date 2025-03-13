$(document).ready(function () {
   // $('#loading-container').hide();
   const editModal = $('.editModal');
   const addModal = $('.addModal');
  
    const imgInput = $('#img-input');
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

});
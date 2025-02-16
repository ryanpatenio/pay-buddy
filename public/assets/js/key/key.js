$(document).ready(function(){

   const responseModal = $('#displayKeyModal');
   

   $(document).on('click','#generateKeyBtn',async (e) => {
        e.preventDefault();
       
        const dKey = $('#key-01');

        swalMessage('custom','Note after generate new Api Key you must Copy it coz you will not be able to view it again! but you can generate new key!',async () => {
            try {
                const response = await axios.post('/Api-keys-create');
                if(response.status === 200){
                    let key = response?.data?.data;
                
                    msg('New Api Key Created Successfully!','success');

                    dKey.val(key);//fetch the api key in text field
                    responseModal.modal('show');  //show modal                                
                }
                //console.log(getGenerateKey)
            } catch (error) {
                console.log(error)
                const {response} = error;
                const err = response?.data;
            
                if(error.status === 422 || err?.code === "EXIT_FORM_NULL"){
                    msg(err?.message,'info');
                }else if(error.status == 500 || err?.code === "EXIT_BE_ERROR"){
                    msg('Failed to Create new Api Key','error');
                }else{
                    msg('Internal Server Error!','error');
                }
            }
        });
   
   });


   $(document).on('click','#regenerate-btn',async (e) => {
         e.preventDefault();

         const id = $(e.target).attr('data-id');
         const dKey = $('#key-01');

       swalMessage('custom','Note after generate new Api Key you must Copy it coz you will not be able to view it again! Please click `Ok` to Confirm',async () => {
            try {

                const response = await axios.post('/Api-keys-regenerate',{id:id});
                if(response.status === 200){
                   
                    let key = response?.data?.data;
                
                    msg('New Api Key Created Successfully!','success');

                    dKey.val(key);//fetch the api key in text field
                    responseModal.modal('show');  //show modal    

                }else{
                    msg('Internal Server Error!','error');
                }
                
            } catch (error) {
                const {response} = error;
                const err = response?.data;

                if(error.status === 422){
                    displayFieldErrors(err.errors?.id, '', msg);
                }else if(err?.code === "EXIT_BE_ERROR" || error.status === 500){
                    msg('Failed to Generate new Api key!','error');
                }else{
                    msg('Internal Server Error!','error');
                }
               
            }
       });  


   });

});
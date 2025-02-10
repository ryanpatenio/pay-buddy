$(document).ready(function(){

   const keyModal = $('#createKeyModal');

   $(document).on('click','#generateKeyBtn',async (e) => {
        e.preventDefault();
        const key = $('#key');
        try {
            keyModal.modal('show');
            const getGenerateKey = await axios.get('/Api-keys-gen');
            if(getGenerateKey.status === 200){
                key.val(getGenerateKey.data.data);
                console.log(getGenerateKey);
            }
            //console.log(getGenerateKey)
        } catch (error) {
            console.log(error)
        }
        
   });

   $('#keyForm').submit(function(e){
        e.preventDefault();

        let data = $(this).serialize();

        swalMessage('custom','This will create new Api key Please click ok to proceed!',async () => {
            
            try {
                const response = await axios.post('/Api-keys-create',data);
                if(response.status === 200){
                    message('New Api Key Create Successfully!','success');
                }

            } catch (error) {   
                let err = error.response.data;
                if(err.code === "EXIT_FORM_NULL"){
                    msg(err.message,'error');
                    return;
                }
                if(err.code === "EXIT_BE_ERROR"){
                    msg(err.message,'error');
                    return;
                }
                console.log(err)
            }
            
        });
   });

});
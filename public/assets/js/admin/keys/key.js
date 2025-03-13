$(document).ready(function(){

   $(document).on('click','#disabled-btn',async (e) => {
        e.preventDefault();

        const id = $(e.target).attr('data-id');
        const name = $(e.target).attr('data-name');
        const status = $(e.target).attr('data-status');
        if(!id){
            alert('ID missing!');
            return;
        }

        const data = {
            id: id,
            status : status
        }

        swalMessage('custom',`Are you sure you want to set Disable this (${name}) User Api key?`,async () => {

            toggleLoader(true);

            try {
                const response = await axios.post('/Api-Keys-disable',data);
                if(response.status === 200){
                    
                    message(`User ${name} Api Key Set ${status} `,'success')
                }else{
                    console.log("unexpected Error!");
                }

            } catch (error) {
               // console.log(error);
                const {response} = error;
                const err = response.data;
                if(error.status === 422){
                    displayFieldErrors(err.errors?.id, '', msg);
                    displayFieldErrors(err.errors?.status, '', msg);
                }else if(error.status === 500 || err?.code === "EXIT_BE_ERROR"){
                    msg('Failed to update User Api Key!','error');
                }else{
                    msg('Internal Server Error!','error');
                }

            } finally{
                res('Hide loader');
                toggleLoader(false);
            }
        });
   })

});
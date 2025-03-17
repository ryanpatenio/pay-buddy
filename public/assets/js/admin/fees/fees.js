$(document).ready(function () {
    const addModal = $('.addModal');
    const editModal = $('.editModal');

    $('#addBtn').click(async (e) => { 
        e.preventDefault();     
        const elementName = $('#currencies');

        addModal.modal('show');
        await  Currencies(elementName);
    });
   
    $('#feeForm').submit(async (e)=> { 
        e.preventDefault();
        
        const data = $(e.target).serialize();

        swalMessage('custom','Are you sure you want to add new Fee?',async ()=>{
            toggleLoader(true);
            try {
                const url = '/Fee-create';
                const response = await axios.post(url,data);
                if(response.status === 200){
                    formModalClose(addModal,$(e.target));
                    message('New Fee Created Successfully!','success');
                }else{
                    msg('Internal Server Error!','error');
                }
            } catch (error) {
               
                const {response} = error;
                const err = response?.data;
                if(response.status === 401 || err?.code === "EXIT_401"){
                    msg(err?.message,'error');
                }else if(response.status === 422){
                    displayFieldErrors(err.errors?.transaction_type, '', msg);
                    displayFieldErrors(err.errors?.currency, '', msg);
                    displayFieldErrors(err.errors?.amount, '', msg);
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

    $(document).on('click','#edit-btn', async (e) => {
        e.preventDefault();

        resetForm($('#editForm'));//reset the edit form first
        const elementName = $('#currencies-edit');
        
        const ID = $(e.target).attr('data-id');
        const url = `/Fee-get/${ID}`;

        toggleLoader(true);
        try {
            const response = await axios.get(url);
            if(response.status === 200){
                const data = response?.data?.data;
                $('#hidden_id').val(data.id);              
                $('#amount').val(data.amount);

                const currentCurrency = data.currency;

                await Currencies(elementName); //load & populate currencies in the select tag
                
               $('#currencies-edit').val(currentCurrency);
            }else{
                msg('Internal server Error: ','error');
            }
        } catch (error) {
            res(error);
            const {response} = error;
            const err = response?.data;
            if(response.status === 422){
                msg('Invalid Id or No data found!');
            }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                msg(err?.message,'error');
            }else{
                msg('Internal server Error!','error');
            }
        }finally{
            toggleLoader(false);
            editModal.modal('show');
        }
    });

    $('#editForm').submit(async (e) => { 
        e.preventDefault();
        
        const data = $(e.target).serialize();
        const url = '/Fee-update';
        
        swalMessage('custom','Are you sure you want to update this Fee?',async () => {
            toggleLoader(true);
            try {
                const response = await axios.patch(url,data);
                if(response.status === 200){
                   formModalClose(editModal,$(e.target));
                   message('Fee updated successfully!','success');
                }else{
                    msg('Internal Server Error!','error');
                }
            } catch (error) {
                
                const {response} = error;
                const err = response?.data;
                if(response.status === 422){
                    displayFieldErrors(err.errors?.id, '', msg);
                    displayFieldErrors(err.errors?.currency, '', msg);
                    displayFieldErrors(err.errors?.transaction_type, '', msg);
                    displayFieldErrors(err.errors?.amount, '', msg);
                }else if(response.status === 401 || err?.code === "EXIT_401"){
                    msg(err?.message, 'error');
                }else{
                    msg('Internal Server Error!','error');
                }
            }finally{
                toggleLoader(false);
            }
        });
       
    });

   async function Currencies($element){
        const url = '/Fee-Currencies';
        $element.html('<option value="">-- Select --</option>');

        toggleLoader(true);
        try {
            const response = await axios.get(url);
            if(response.status === 200){              
                const currencies = response?.data;
                // Populate the select box again
                const options = currencies.map(currency => 
                    `<option value="${currency.code}">${currency.name}</option>`
                ).join("");

                $($element).append(options);
                
            }else{
                msg('Internal Server Error!','error');
            }
        } catch (error) {
            res(error);
            
        }finally{
            toggleLoader(false);
        }
    }
});
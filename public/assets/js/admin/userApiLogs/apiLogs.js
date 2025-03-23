$(document).ready(function () {
    const viewModal = $('.viewLogModal');

    $(document).on('click','#view-btn', async (e) => {
        e.preventDefault();

        resetForm($('#viewForm'));//reset the modal field first

        const id = $(e.target).attr('data-id');
        const api_key = $(e.target).attr('data-api-key');

        const url = `/Dashboard-userLogs/${id}`;

        toggleLoader(true);
        try {
            const response = await axios.get(url);
            if(response.status === 200){
    res(response)
                const data = response?.data?.data;
                $('#name').text(data.name);
                $('#api-key').text(api_key);
                $('#request-data').val(JSON.stringify(JSON.parse(data.request_data)));
                $('#response-data').val(JSON.stringify(JSON.parse(data.response_data)));
                $('#date').text(data.created_at);
               
            }
        } catch (error) {
            const {response} = error;
            const err = response?.data;
            if(response.status === 404){
                msg('No data found!','error');
            }else if(response.status === 500 || err?.code === "EXIT_BE_ERROR"){
                msg(err?.message,'error');
            }else{
                msg('Internal Server Error: 500','error');
            }           
        }finally{
            toggleLoader(false);
            viewModal.modal('show');
        }
    });
});
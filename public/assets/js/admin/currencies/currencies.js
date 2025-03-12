$(document).ready(function () {

    const imgInput = $('#img-input');

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
            try {
                const response = await axios.post(url,formData);
                if(response.status === 200){
                    res(response);
                }else{
                    msg('Internal Server Error!','error');
                }
                
            } catch (error) {
                res(error);
                const {response} = error;
                const err = response?.data;


            }
        });

    });

});
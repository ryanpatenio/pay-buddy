$(document).ready(function(){

    const urlParams = new URLSearchParams(window.location.search);
    const user_id = urlParams.get('user_id');

    if(!user_id){
        alert('No ID found!');
        window.location.href = '/Dashboard-Users';
        return;
    }

    fetchBasicDetails(user_id);

    $('#basicForm').submit(async (e) => {
        e.preventDefault();
        
        const serializedData = $(e.target).serialize();
    
        //Convert the serialized string into an object
        const formData = serializeToObject(serializedData);
       
        formData.id = user_id;
        try {
            const response = await axios.post('/Dashboard-user-updateDetails',formData);
            if(response.status === 200){
                message('User details updated successfully','success');
            }    

        } catch (error) {
            //console.log(error);
            const {response} = error;
           // console.log(response);
            const err = response?.data;
           // console.log(err)
            if(response.status === 422){
                displayFieldErrors(err.errors?.zip_code, 'Zip Code', msg);
                displayFieldErrors(err.errors?.name, 'Name : ', msg);
                displayFieldErrors(err.errors?.phone_number, 'Phone Number', msg);
                displayFieldErrors(err.errors?.country, 'country', msg);
                displayFieldErrors(err.errors?.city, 'Brgy', msg);
                displayFieldErrors(err.errors?.province, 'Province', msg);
                displayFieldErrors(err.errors?.overview, 'Overview', msg);
                displayFieldErrors(err.errors?.id, 'ID', msg);
            }else{
                msg('Unexpected Error! Please try again!','error');
            }
        



        }
    });

    async function fetchBasicDetails(id){
        const fullname = $('#fullName');
        const phone = $('#phoneNumber');
        const country = $('#country');
        const city = $('#city');
        const brgy = $('#brgy');
        const province = $('#province');
        const zip_code = $('#zip-code');
        const overview = $('#overview');

        try {
            const response = await axios.get(`/Dashboard-user-details/${id}`);
            if(response.status === 200){               
                const data = response?.data;
                
                fullname.val(data?.name);
                phone.val(data?.phone_number);
                country.val(data?.country ?? "Philippines");
                city.val(data?.city);
                brgy.val(data?.brgy);
                province.val(data?.province);
                zip_code.val(data?.zip_code);
                overview.val(data?.overview);

            }
        } catch (error) {
            console.log(error)
            const { response } = error;
            const err = response?.data;

            if(err?.code ==="EXIT_404"){
                msg('failed to fetch data','error');              
                setTimeout(() => {
                    window.location.href = '/Dashboard-Users';
                }, 2000);
            }else if(err?.code === "EXIT_BE_ERROR" || response.status === 500){
                msg('Failed to fetch Details','error');
                setTimeout(() => {
                    window.location.href = '/Dashboard-Users';
                }, 2000);
                
            }
        }
    }
   

});
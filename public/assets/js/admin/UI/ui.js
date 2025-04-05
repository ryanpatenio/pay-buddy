$(document).ready(function(){
    const avatar_header = $('#avatar-header');
    const avatar_side_header = $('#avatar-img-side-header');

    const requestBanner = $('#request-banner-nav');

    fetchAvatar();
    fetchRequestCount();

    async function fetchAvatar() {
        try {
            
            const response = await axios.get('/UI-dashboard-admin-avatar');
            if(response.status === 200){
                
                const img = response?.data ? `/storage/${response.data}` : '/assets/img/avatar/default.jpg';

                avatar_header.attr('src',img);
                avatar_side_header.attr('src',img);
            }

        } catch (error) {
            res(error);
            const {response} = error;
            const err = response?.data;

        }
    }

    async function fetchRequestCount() {
        
        try {
            const response = await axios.get('/UI-admin-request');
            if(response.status === 200){ 

                const count = response?.data;
                requestBanner.text(count >= 100 ? '99+' : `${count}`);
            }else{
                res('failed to fetch request Count!');
            }
        } catch (error) {
            res(error);
            if(error.status === 500){
                res('Failed to fetch Request Count');
            }else{
                res('Failed to fetch Request Count');
            }
        }
    }

});
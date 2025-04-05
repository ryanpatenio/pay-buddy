$(document).ready( async () =>{

    const banner = $('#unread-banner');
    const navBanner = $('#unread-banner-nav');
    const user_avatar = $('#user-avatar');

   await fetchUi();
   await fetchAvatar();

    // Start polling
    const intervalId = setInterval(() => {
        fetchUnreadNotifCount();
        fetchNotificationMsg();
    }, 10000);

    // Stop polling after 1 minute (for example)
    setTimeout(() => {
        clearInterval(intervalId);
        console.log('Polling stopped.');
    }, 60000); // 1 minute = 60000 milliseconds

    async function fetchUi(){
        fetchUnreadNotifCount();
        fetchNotificationMsg();
    }

   async function fetchUnreadNotifCount() {

    try {
        const response = await axios.get('/Notifications-count');
        if(response.status === 200){
           console.log('unreadCount')
            const count = response?.data.data;

            banner.text(count >= 100 ? '99+' : `${count}`);
            navBanner.text(count >= 100 ? '99+' : `${count}`);
        } 
    } catch (error) {
      
        const {response}  = error;
        const err = response?.data;

        if(error.status === 500 || err?.code === "EXIT_BE_ERROR"){
            msg('Failed to fetch Notifications Count!','error');
        }else{
            console.log(error.status);
            console.log(error)
        }
    }
   }

   async function fetchNotificationMsg() {
    try {
        const response = await axios.get('/Notifications-all');
        if (response.status === 200) {
            console.log('notif')
            const data = response?.data?.data; // Assuming data is an array of notifications
            const notificationsList = $('#notifications-list'); // Get the notifications list container

           
            // Clear existing content (optional, if you want to refresh the list)
            notificationsList.empty();

            // Loop through the data and create list items
            data.forEach(notification => {
                const listItem = `
                    <a href="javascript:void(0);" data-id="${notification.id}" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="https://d33wubrfki0l68.cloudfront.net/5dfa4398a7f2beddbcfa617402e193f2f13aaa94/2ecb0/assets/images/profiles/profile-28.jpeg" alt="..." class="avatar-img" width="30" height="30">
                            </div>
                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">PayBuddy</h5>
                                    <small class="text-muted">${notification.date_created}</small>
                                </div>
                                <div class="d-flex flex-column">
                                    <p class="mb-1">${notification.title}</p>
                                    <small class="text-secondary">${notification.message}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                `;

                // Append the list item to the notifications list
                notificationsList.append(listItem);
            });
        }
    } catch (error) {
        console.error(error);
    }
}

async function fetchAvatar() {
    try {
        
        const response = await axios.get('/user-avatar');
        if(response.status === 200){
            
            const img = response?.data ? `/storage/${response.data}` : '/assets/img/avatar/default.jpg';
            user_avatar.attr('src',img);                             
        }else{
            res('Cannot load avatar');
        }

    } catch (error) {
        res(error);
        const {response} = error;
        const err = response?.data;
        if(response.status === 500){
            res('cannot load Image');
            
        }else{
            res(error);
        }

    }
}

});

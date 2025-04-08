$(document).ready( async () =>{

    const banner = $('#unread-banner');
    const navBanner = $('#unread-banner-nav');
    const user_avatar = $('#user-avatar');

    const notifModal = $('#global-Notification-Modal');

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

    $('#mark-all-read-btn').click(async (e) =>{ 
        e.preventDefault();
        const notificationCount = $('#hidden-count').val();

        if(notificationCount == 0){
             msg('Notification list is empty!','info');
             return;
        }
        const url = '/user-mark-all-read';
        swalMessage('custom','Mark all as read?',async () => {
            toggleLoader(true);
            try {
                const response = await axios.patch(url);
                if(response.status === 200){
                    const data = response?.data;
                    msg(data?.message,'success');
                    await fetchUi();
                }else{
                    msg('Internal Server Error!','error');
                }
            } catch (error) {
              const errorMessage = error.response?.data?.message || 
                        error.message || 
                        'Failed to mark all as read';
              msg(errorMessage, 'error');

            }finally{
                toggleLoader(false);
            }
        });
    
    });

    $('#g-notif-form').submit(async (e) =>{ 
        e.preventDefault();
    
        const data = $(e.target).serialize();
        const url = '/user-UI-mark-as-read';
        swalMessage('custom','Are you sure you want to mark this as read?', async () =>{
            toggleLoader(true);
            try {
                const response = await axios.patch(url,data);
                if(response.status === 200){
                    formModalClose(notifModal,$('#g-notif-form'));
                    await fetchUi();
                }
            } catch (error) {
                const errorMessage = error.response?.data?.message || 
                error.message || 'Failed to mark all as read';
                msg(errorMessage, 'error');
            }finally{
                toggleLoader(false);
            }
        });
    });
 
   async function fetchUnreadNotifCount() {

    try {
        const response = await axios.get('/Notifications-count');
        if(response.status === 200){
           console.log('unreadCount')
            const count = response?.data.data;

            banner.text(count >= 100 ? '99+' : `${count}`);
            navBanner.text(count >= 100 ? '99+' : `${count}`);
            $('#hidden-count').val(count ?? 0);
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

   $(document).on('click','.notification-item', async function (e){
        e.preventDefault();
        resetForm($('#g-notif-form'));

        const id = $(this).data('id');
        const url = `/user-UI-selected-notif-item/${id}`;
        try {
            toggleLoader(true);
            const response = await axios.get(url);
            if(response.status === 200){
                const data = response?.data?.data;
                $('#g-title').text(data?.title);
                $('#g-msg').text(data?.message);
                $('#g-date').text(data?.date_created);
                $('#ntif-id').val(data?.id);
            }else{
                msg('Internal Server Error!','error');
            }
        } catch (error) {
            const errorMessage = error.response?.data?.message || 
                        error.message || 
                        'Failed fetch Notification';
              msg(errorMessage, 'error');
        }finally{
            toggleLoader(false);
            notifModal.modal('show');
        }

   });

   async function fetchNotificationMsg() {
    try {
        const response = await axios.get('/Notifications-all');
        if (response.status === 200) {
           
            const data = response?.data?.data; 
            const notificationsList = $('#notifications-list'); // Get the notifications list container

           
            // Clear existing content (optional, if you want to refresh the list)
            notificationsList.empty();

            // Loop through the data and create list items
            data.forEach(notification => {
                const listItem = `
                    <a href="#" data-id="${notification.id}" class="notification-item list-group-item list-group-item-action ">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/img/root_img/p-buddy.webp" alt="..." class="avatar-img" width="30" height="30">
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
                $('#pop-up-profile-im').attr('src',img);                            
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

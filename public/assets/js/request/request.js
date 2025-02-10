$(document).ready(function(){


    $(document).on('click','#newRequestBtn',async (e) => {
        e.preventDefault();
        let req = 'req';
        let btn = $('#newRequestBtn');

        try {
            animateBtn(3000,btn,'+ New request');
            const response = await axios.post('/Profile-new-Request',{req:req});
            if(response.status === 200){
                message('Request submitted successfully! Please wait for admin approval!','success');
            }

        } catch (error) {
            let err = error.response.data;
            //console.log(err)
            if(err.code === "EXIT_FORM_NULL"){
                msg(err.message,'info');
            }
        }
  

    });
   

});
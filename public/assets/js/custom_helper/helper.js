function message($text = "", $msg_type = "") {
	swal($text, {
		icon: $msg_type,
	}).then((confirmed) => {
		swal.close();
		window.location.reload();
	});
}

function msgThenRedirect($text ="",$msg_type ="", _url){
	swal($text, {
		icon: $msg_type,
	}).then((confirmed) => {
		swal.close();
		window.location.href = _url;
	});
}


const toggleLoader = (show = true) => {
  if(show) {
    $('#loading-container').show();
  } else {
    $('#loading-container').attr('style', 'display: none !important');
  }
}
const animateBtn = (time,btn_name,btn_restore_text) => {
    btn_name.prop('disabled', true);
    btn_name.html('<i class="fa fa-spinner fa-spin"></i> Processing...');
    setTimeout(() => {
        btn_name.prop('disabled', false); // Re-enable the button
        btn_name.html(btn_restore_text); // Restore the original text
    }, time); // Simulate a 2-second delay 2000
}

//serialize object @example you want to add another data in the form.serialize()
function serializeToObject(serializedData) {
  const formData = {};
  serializedData.split('&').forEach(pair => {
      const [key, value] = pair.split('=');
      formData[decodeURIComponent(key)] = decodeURIComponent(value || '');
  });
  return formData;
}

// function message(_message, _msg_type, _url) {
// 	Swal.fire({
// 		title: _message,
// 		icon: _msg_type,
// 		allowOutsideClick: false,

// 		preConfirm: function () {
// 			return new Promise(function (resolve) {
// 				if (_url && _url !== "") {
// 					window.location.href = _url;
// 				} else {
// 					resolve(); // Resolve the promise without doing anything
// 				}
// 			});
// 		},
// 	});
// }

function msg(message = "", msg_type = "") {
	swal(message, {
		icon: msg_type,
	});
}

const resetForm = (thisForm) => {
	thisForm.get(0).reset();
};

const formModalClose = (modalName, thisForm) => {
	$(modalName).modal("hide");
	thisForm.get(0).reset();
};
const res = (param) => {
	console.log(param);
};

const modalClose = (modalName) => {
	$(modalName).modal("hide");
};



function successSwal(_message, _redirect = "") {
	swal({
		title: "Success!",
		html: _message,
		type: "success",
		allowEscapeKey: false,
		allowOutsideClick: false,
		showLoaderOnConfirm: true,
		preConfirm: function () {
			return new Promise(function (success) {
				if (_redirect == "") {
					swal.close();
				} else {
					// setTimeout(() => {
					window.location.href = _redirect;
					// success();
					// }, 500);
				}
				// setTimeout(() => {
				// 	((_redirect == '') ? swal.close() : window.location.href = _redirect);
				// 	success();
				// }, 500);
			});
		},
	});
}


function AjaxPost(url, method, formData, beforeSendCallback, successCallback, completeCallback) {
    $.ajax({
        url: url,
        method: method || 'POST',  // Default to POST if no method is provided
        data: formData,
        dataType: 'json',

        beforeSend: function() {
            if (beforeSendCallback && typeof beforeSendCallback === 'function') {
                beforeSendCallback();
            }
        },

        success: function(response) {
            if (successCallback && typeof successCallback === 'function') {
                successCallback(response);
            }
        },

        complete: function() {
            if (completeCallback && typeof completeCallback === 'function') {
                completeCallback();
            }
        },

        error: function(xhr, status, error) {
            console.error("AJAX Error: ", status, error);
			console.log(xhr.responseText);
        }
    });
}

function loader(_status){
	_status == false;
  
	if(_status === true){
	  $('#loader').show();
	}else{
	  $('#loader').hide();
	}
   }

   function Redirect(_url,_logs = ""){

	if(_logs == ""){
	  setTimeout(function() {
		// Delay 1 second to proceed
		window.location.href = _url;
  
	  }, 1000);
  
	}else{
	  console.log(_logs);
  
	  setTimeout(function() {
		// Delay 1 second to proceed
		window.location.href = _url;
  
	  }, 1000);
	}
  
	
   }


   function loader(_status){
	_status == false;
  
	if(_status === true){
	  $('#loader').show();
	}else{
	  $('#loader').hide();
	}
   }

   function logs(_logs) {

    if (_logs === true) {
      console.log('Sending Request to API...');
    } else if (_logs === false) {
      console.log('Request Completed...');
    } else {
      console.log(_logs);
    }
}

function swalMessage(swal_type, message, willConfirmedCallback) {
    let defaultMessages = {
        'update': "Are you sure you want to update this item?",
        'delete': "Are you sure you want to delete this item?",
        'custom': message || "Are you sure you want to proceed?",
    };

    swal({
        text: defaultMessages[swal_type] || defaultMessages['custom'],
        icon: "info",
        buttons: true,
        dangerMode: swal_type === 'delete',
    }).then((willconfirmed) => {
        if (willconfirmed && typeof willConfirmedCallback === 'function') {
            willConfirmedCallback();
        }
    });
}

/**
 * Displays validation errors for a specific field.
 * @param {Array} errorArray - The error array for the field (e.g., err.data?.zip_code).
 * @param {string} fieldName - The name of the field (e.g., "zip_code").
 * @param {Function} msg - The function to display the error message (e.g., toast, alert, etc.).
 */
function displayFieldErrors(errorArray, fieldName, msg) {
  if (Array.isArray(errorArray) && errorArray.length > 0) {
      errorArray.forEach((errorMessage) => {
          msg(`${fieldName}: ${errorMessage}`, 'error');
      });
  }
}



 /**
     * Displays validation errors to the user.
     * @param {Object} errors - The validation errors returned by the server.
     * <div class="error-message text-danger">The name field is required.</div>
     */
//  function displayValidationErrors(errors) {
//   // Clear previous errors
//   $('.error-message').remove();

//   // Loop through each field and display its errors
//   for (const [field, messages] of Object.entries(errors)) {
//       const input = $(`[name="${field}"]`);
//       const errorContainer = $('<div>').addClass('error-message text-danger').text(messages.join(', '));
//       input.after(errorContainer);
//   }
// }

    // const processRequests = async () => {
    //     const emailData = await fetchData('/Profile-email');
    //     if (!emailData) return; // Stop execution if fetching email fails
    
    //     const profileData = await fetchData('/Profile-info');
    //     if (!profileData) return; // Stop execution if fetching profile fails
    
    //     console.log('All requests succeeded!');
    // };

    // const fetchData = async (url) => {
    //     try {
    //         const response = await axios.get(url);
    //         return response.data; // Return the data if successful
    //     } catch (error) {
    //         if (error.response) {
    //             console.log(`Request failed. Status: ${error.response.status}`);
    //             console.log('Response Data:', error.response.data);
    //         } else {
    //             console.log('Request error:', error.message);
    //         }
    //         return null; // Return null if an error occurs
    //     }
    // };

    //dynmic
    function setBtnDisabledState(buttonSelectors, status) {
      buttonSelectors.forEach(selector => {
          const button = $(selector);
          if (button.length > 0) {
              button.prop('disabled', status);
          } else {
              console.error(`Button not found: ${selector}`);
          }
      });
  }

  function setButtonsDisabledState(btn1, btn2, status) {
    // Select the buttons using jQuery
    const button1 = $(btn1);
    const button2 = $(btn2);

    // Validate that the buttons exist
    if (button1.length === 0 || button2.length === 0) {
        console.error('One or both buttons not found.');
        return;
    }

    // Set the disabled state of the buttons
    button1.prop('disabled', status);
    button2.prop('disabled', status);
}
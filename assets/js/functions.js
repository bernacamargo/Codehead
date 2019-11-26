'use strict';

/**
* notifyUser
* 
* notifica o usuario
*
* @param String type [Tipo de notificação]
* @param String text [Conteúdo da notificação]
* @param Int delay [Tempo para a notificação sumir]
*/
function notifyUser(type, text, delay = 8000) {
	var icon = "";
	var title = "";

	// Toastr config
	toastr.options = {
		"closeButton": false,
		"debug": false,
		"newestOnTop": false,
		"progressBar": true,
		"positionClass": "toast-top-right",
		"preventDuplicates": true,
		"onclick": null,
		"showDuration": 300,
		"hideDuration": 1000,
		"timeOut": delay,
		"extendedTimeOut": 1000,
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}

	switch(type){
	  case 'success':
		toastr.success(text);
	  break;

	  case 'error':
		toastr.error(text);
	  break;

	  case 'warning':
		toastr.warning(text);
	  break;

	  case 'info':
		toastr.info(text);		
	  break;

	  case 'loading':
		icon = "<i class='fa fa-spin fa-spinner'></i>&ensp;";
		
		toastr.options.timeOut = 0;
		toastr.options.extendedTimeOut = 0;

		toastr.info("<i class='fa fa-spin fa-spinner'></i>&ensp;" + text);
		
	  break;

	  default:
	  	toastr.error('Houve um erro ao exibir a notificação');
	  break;
	}

};

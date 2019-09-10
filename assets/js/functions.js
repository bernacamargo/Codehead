'use strict';

function notifyUser(type, text, delay = 8000) {
	var icon = "error";
	var title = "error";

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
		"timeOut": 5000,
		"extendedTimeOut": 1000,
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}

	switch(type){
	  case 'success':
		icon = "<i class='fa fa-check'></i>&ensp;";
		title = "Sucesso!";

		toastr.success(text);
	  break;

	  case 'error':
		icon = "<i class='fa fa-times-circle'></i>&ensp;";
		title = "Erro";

		toastr.error(text);
	  break;

	  case 'warning':
		icon = "<i class='fa fa-exclamation-triangle'></i>&ensp;";
		title = "Atenção!";

		toastr.warning(text);
		
	  break;

	  case 'info':
		icon = "<i class='fa fa-info-circle'></i>&ensp;";
		title = "Atenção!";

		toastr.info(text);		

	  break;

	  case 'loading':

		icon = "<i class='fa fa-spin fa-spinner'></i>&ensp;";
		type = 'info';
		title = "Loading...";

		toastr.options.timeOut = 0;
		toastr.options.extendedTimeOut = 0;

		toastr.info(text);
		
	  break;
	}

	// new PNotify({
	//   text: text,
	//   title: icon + title,
	//   icon: false,
	//   styling: 'brighttheme',
	//   type: type,
	//   delay: delay,
	//   buttons: {
	// 	closer: true,
	// 	closerHover: true
	//   },
	//   animate: {
	// 	  animate: true,
	// 	  in_class: 'bounceIn',
	// 	  out_class: 'bounceOut'
	//   }       
	  
	// });
};

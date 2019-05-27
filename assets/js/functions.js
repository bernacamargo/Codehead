'use strict';

function notifyUser(type, text, delay = 8000) {
  var icon = "error";
  var title = "error";

	switch(type){
	  case 'success':
		icon = "<i class='fa fa-check'></i>&ensp;";
		title = "Sucesso!";
	  break;

	  case 'error':
		icon = "<i class='fa fa-times-circle'></i>&ensp;";
		title = "Erro";
	  break;

	  case 'warning':
		icon = "<i class='fa fa-exclamation-triangle'></i>&ensp;";
		title = "Atenção!";
	  break;

	  case 'info':
		icon = "<i class='fa fa-info-circle'></i>&ensp;";
		title = "Atenção!";
	  break;

	  case 'loading':
		icon = "<i class='fa fa-spin fa-spinner'></i>&ensp;";
		type = 'info';
		title = "Loading...";
	  break;
	}

	new PNotify({
	  text: text,
	  title: icon + title,
	  icon: false,
	  styling: 'brighttheme',
	  type: type,
	  delay: delay,
	  buttons: {
		closer: true,
		closerHover: true
	  },
	  animate: {
		  animate: true,
		  in_class: 'bounceIn',
		  out_class: 'bounceOut'
	  }       
	  
	});
};

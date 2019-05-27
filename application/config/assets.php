<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * assets
 *
 * Arquivo para definir as src dos CSS e JS através de módulos.
 * 
 * @author Bernardo Pinheiro Camargo
 * @since 2019
 */

// ORDER DE CARREGAMENTO DOS MODULOS
$config['default'] = ['bootstrap', 'vendors', 'pnotify', 'custom'];


/**
 * =====================
 * DEFINIÇÃO DOS MÓDULOS
 * =====================
 */

// Bootstrap
$config['bootstrap'] = [
    'css' => [ 
        'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
        site_url('assets/vendors/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css')
    ],
    'js'  => [
        'https://unpkg.com/popper.js/dist/umd/popper.min.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
        site_url('assets/vendors/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js')
    ]
];


// Notificação carregada por default
$config['pnotify'] = [
    'css'   =>  [
        site_url('assets/vendors/pnotify/dist/pnotify.css'), 
        site_url('assets/vendors/pnotify/dist/pnotify.buttons.css'),         
        site_url('assets/vendors/pnotify/dist/pnotify.nonblock.css'),         
        site_url('assets/vendors/pnotify/dist/pnotify.material.css'),         
        site_url('assets/vendors/pnotify/dist/pnotify.mobile.css'),         
        site_url('assets/vendors/pnotify/dist/pnotify.brighttheme.css'),         
        site_url('assets/vendors/pnotify/dist/pnotify.history.css'),         

    ],
    'js'    => [
        site_url('assets/vendors/pnotify/dist/pnotify.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.buttons.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.nonblock.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.animate.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.callbacks.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.confirm.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.history.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.mobile.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.reference.js'),         
        site_url('assets/vendors/pnotify/dist/pnotify.tooltip.js'),         

    ]
];




/**
 * ================================
 * ALTERAR SOMENTE OS ARRAYS ABAIXO
 * ================================
 */




// Plugins localizados na pasta assets/vendors
$config['vendors'] = [
    'css' => [

    ],

    'js' => [

    ]
];



// Ultimo módule a ser carregado
$config['custom'] = [
    'css' => [  
        site_url('assets/css/style.css'),
    ],
    'js' => [ 
        site_url('assets/js/functions.js'),         
    ]
];
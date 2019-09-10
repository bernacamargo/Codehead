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
$config['default'] = ['bootstrap', 'vendors', 'toastr', 'custom'];


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
// Toastr notification
$config['toastr'] = [
    'css'   =>  [
        site_url('assets/vendors/toastr/toastr.min.css')
    ],
    'js'    =>  [
        site_url('assets/vendors/toastr/toastr.min.js')
    ]
];






/**
 * ====================================
 * ADICIONAR OS PLUGINS NO ARRAY ABAIXO
 * ====================================
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
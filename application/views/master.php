<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Language" content="pt-br">
  
        <!-- TITLE -->
        <title><?PHP $template->print_title(); ?></title>
  
        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.3.1.js "></script>
        
        <!-- JQUERY UI -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>
        
        <!-- FONTAWESOME ICONS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/v4-shims.css">

        <!-- DEFINE BASE PATH IN JS -->
        <script>
            var SiteUrl = "<?php echo site_url(); ?>";
            var BaseUrl = "<?php echo base_url(); ?>";
        </script>
        
        <!-- PRINT CSS - CONFIG IN config/assets.php -->
        <?PHP $template->print_css(); ?>

        <style>
            
            /* Create montserrat font */
            @font-face{
                font-family: 'montserrat';
                src: url('<?php echo site_url('assets/fonts/montserrat/Montserrat-Regular.otf') ?>') format("opentype");
            }        
        </style>

    </head>
      <body>      

        <!-- HEADER LOAD IN views/components/header.php -->
        <header>
          <?= $template->print_component('header') ?>
        </header>


        <!-- CONTENT LOAD IN views/pages/[page].php -->
        <div id="content-wrapper">
            <?php $template->print_page(); ?>
        </div>

        <!-- FOOTER LOAD IN views/components/footer.php -->
        <footer>
          <?= $template->print_component('footer'); ?>
        </footer>
        
        <!-- PRINT JS - CONFIG IN config/assets.php -->
        <?php $template->print_js(); ?>
        

        <!-- ALERTS LOAD IN views/components/alerts.php -->  
        <!-- IF HAS FLASHDATA ON SESSION WITH NAMES: 'error', 'success', 'info' or 'loading' PRINT THE MSG IN ALERT CREATED USING PNotify.js -->
        <?php $template->print_component('alerts'); ?>

    </body>
</html>
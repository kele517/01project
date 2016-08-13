<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Tables - Ace Admin</title>

    <meta name="description" content="Static &amp; Dynamic Tables" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo ADMIN_STYLE_PATH.'/assets/css/bootstrap.min.css'?>" />
    <link rel="stylesheet" href="<?php echo ADMIN_STYLE_PATH.'/assets/css/font-awesome.min.css'?>" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="<?php echo ADMIN_STYLE_PATH.'/assets/css/jquery-ui.custom.min.css'?>" />
    <!--<link rel="stylesheet" href="<?php /*echo ADMIN_STYLE_PATH.'/assets/css/chosen.css'*/?>" />
    <link rel="stylesheet" href="<?php /*echo ADMIN_STYLE_PATH.'/assets/css/datepicker.css'*/?>" />
    <link rel="stylesheet" href="<?php /*echo ADMIN_STYLE_PATH.'/assets/css/bootstrap-timepicker.css'*/?>" />
    <link rel="stylesheet" href="<?php /*echo ADMIN_STYLE_PATH.'/assets/css/daterangepicker.css'*/?>" />
    <link rel="stylesheet" href="<?php /*echo ADMIN_STYLE_PATH.'/assets/css/bootstrap-datetimepicker.css'*/?>" />
    <link rel="stylesheet" href="<?php /*echo ADMIN_STYLE_PATH.'/assets/css/colorpicker.css'*/?>" />-->

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo ADMIN_STYLE_PATH.'/assets/css/ace-fonts.css'?>" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo ADMIN_STYLE_PATH.'/assets/css/ace.min.css'?>" id="main-ace-style" />
    <!--custom styles -->
    <link rel="stylesheet" href="<?php echo ADMIN_STYLE_PATH.'/assets/css/toastr.css'?>" />
    <script src="<?php echo ADMIN_STYLE_PATH.'/assets/js/toastr.min.js'?>"></script>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo ADMIN_STYLE_PATH.'/assets/css/ace-part2.min.css'?>" />
    <![endif]-->
    <link rel="stylesheet" href="<?php echo ADMIN_STYLE_PATH.'/assets/css/ace-skins.min.css'?>" />
    <link rel="stylesheet" href="<?php echo ADMIN_STYLE_PATH.'/assets/css/ace-rtl.min.css'?>" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo ADMIN_STYLE_PATH.'/assets/css/ace-ie.min.css'?>" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?php echo ADMIN_STYLE_PATH.'/assets/js/ace-extra.min.js'?>"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="<?php echo ADMIN_STYLE_PATH.'/assets/js/html5shiv.min.js'?>"></script>
    <script src="<?php echo ADMIN_STYLE_PATH.'/assets/js/respond.min.js'?>"></script>
    <![endif]-->
</head>

<body class="no-skin">
<!-- /section:basics/navbar.layout -->
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>
    <!-- /section:basics/sidebar -->

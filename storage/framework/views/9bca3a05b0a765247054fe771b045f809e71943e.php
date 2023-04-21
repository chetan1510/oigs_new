<!DOCTYPE html>
<html lang="en">
    <head>
        <title>OIGS</title>
        <link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="report_header.css" rel="stylesheet" type="text/css" >
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Combo&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/fonts.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(url('assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" />
        <style type="text/css">

            body {
               font-size: 13px !important;
            }

           @media  print {
               html, body {
                   height: 99%;   
                   margin-left:30px; 
                   margin-top:2px;
               }
           }

           tbody{
               display: inherit;
               height:180px !important;
               margin-top: -4px;
           }

           .box {
                position: relative;
                padding-left: 18px; height:20px;
            }

            @media  print {
               body {transform: scale(.7.8);}
               div #example2 {page-break-inside: avoid; margin-bottom:10px;}
            }

           @media  print {
               #printPageButton {
                   display: none;
               }
           }

           #example2,#exam2 {
               height: 303px !important;
               padding-left: 3px;
               background-size: 100% 100%;
           }

           #exam2{
               margin-left: 10px;
               border-left: dotted;
           }

           td{
               padding-left:1px;
               font-size:10px;
               margin-top:-15px;
           }

           td,h6{font-size:11px;}
           #r{margin-top:200px;font-size:13px;;
           }

           .h3, h3 {font-size: 15px !important;}

            @media  print {* { -webkit-print-color-adjust: exact;}}

            .a{padding-left:80px;}

           div{float:left}

           h6{margin-top:-8px;}

           .s{padding-left:15px;}

           .marg {padding-left: 20px;}

           .aaa{padding-left: 54px;}

           .sss {margin-left: 20px;}
                 
           .h1, .h2, .h3, h1, h2, h3 { margin-top: 2px;}

            .result{overflow: overlay; text-align: center; font-size:15px;}
            .description{font-weight: bold; font-size: 12px; text-align:center; white-space: nowrap; margin-left:-30px;}
            .front-image{height:286px;width:100%;margin-top: 5px;}
            .table-design{width: 430px; height:100%; margin-top:-208px;margin-left:6px;}
            .tbody-design{height: 190px; display: inherit;}
            .product-image{width: 90px; margin-top: -291px; margin-left: 273px;}
            .back-img-div{float:right;width:470px;height:360px; margin-top:5px; margin-left: 10px;}
            .back-img-div-top{float:left; height: 305px;}
            .back-img{width:100%; height: 286px;}

            .qr{width:100px; height: 100px;margin-top: -260px; margin-left: 84px;}
            .font{font-family: sans-serif;}
            svg {
                margin-top: -248px;
                margin-left: 84px;
                width: 70px !important;
                height: 108px !important;
            }
        </style>
    </head>
    <body style="width:1020px;">
        <?php echo $__env->yieldContent('content'); ?>
    </body>
</html><?php /**PATH C:\xampp\htdocs\oigs_new\resources\views/small_report.blade.php ENDPATH**/ ?>
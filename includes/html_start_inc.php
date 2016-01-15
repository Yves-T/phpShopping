<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="lib/ckeditor/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
    <link rel="stylesheet" href="css/style.min.css">
</head>
<body>
<div id="wrapper">

    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Shopping project</a>
        </div>

        <?php
        $pageNmae = basename($_SERVER['PHP_SELF']);
        ?>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?php print (($pageNmae == 'index.php') ? 'active' : ''); ?>">
                    <a href="index.php">Producten</a>
                </li>
                <li class="<?php print (($pageNmae == 'gastenboek.php') ? 'active' : ''); ?>">
                    <a href="gastenboek.php">Gastenboek</a>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION[USER])): ?>
                    <li>
                        <a href="logout.php">Uitloggen</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="admin.php">Inloggen</a>
                    </li>
                <?php endif; ?>
            </ul>

        </div><!-- /.navbar-collapse -->
    </nav>

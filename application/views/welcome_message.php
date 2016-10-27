<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeIgniter Contact Form Example</title>
    <!--load bootstrap css-->
    <!--<link href="<?php /*echo base_url("path/to/bootstrap/bootstrap.css"); */ ?>" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <?php include_once 'nav.php'?>
    <div class="jumbotron">
        <h1>MOBILE APP CMS</h1>
        <p> - No design is a good design</p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <ul>
                    <li><a href="create_team">Create Team</a></li>
                    <li><a href="create_tournament">Create Tournament</a></li>
                    <li><a href="create_points">Create Points</a></li>
                </ul>
            </div>
        </div>
    </div>
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong>
        seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </p>
</div>

</body>
</html>
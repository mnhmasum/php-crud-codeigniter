<!DOCTYPE html>
<html>
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
    <div class="jumbotron">
        <h1>CRICKFAN</h1>
        <p> - Cricket Tournament Point Table Management</p>
        <?php echo $this->session->flashdata('LogInMsg'); ?>
    </div>

    <div class="row">
        <?php $attributes = array("class" => "form-horizontal", "name" => "save-team-form");
        echo form_open(base_url() . "/loginSubmit", $attributes); ?>
        <div class="col-md-4">
            <div class="well">
                <h1 class="text-center login-title">Sign In</h1>
                <div class="account-wall">
                    <form class="form-signin">
                        <input type="text" class="form-control" name="username" placeholder="User" required autofocus>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <br>
                        <div class="">
                            <button class="btn btn-primary btn-block" type="submit">
                                Sign in
                            </button>
                        </div>

                        <a href="#" class="pull-right need-help well-sm">Need help? </a><span class="clearfix"></span>
                    </form>
                </div>
            </div>

        </div>
        <?php echo form_close(); ?>
    </div>
</div>
</body>
</html>

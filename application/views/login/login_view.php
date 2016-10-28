<?php $this->load->view('header.php'); ?>
<body>
<div class="container">
    <div class="jumbotron">
        <?php echo $this->session->flashdata('msg'); ?>
        <div class="row">
            <?php $attributes = array("class" => "form-horizontal", "name" => "save-team-form");
            echo form_open(base_url() . "Login/login_submit", $attributes); ?>
            <div class="col-md-4">
                <div class="well">
                    <h1 class="text-center login-title">Sign In</h1>

                    <div class="account-wall">
                        <form class="form-signin">
                            <input type="text" class="form-control" name="username" placeholder="User" required
                                   autofocus>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            <br>

                            <div class="">
                                <button class="btn btn-primary btn-block" type="submit">
                                    Sign in
                                </button>
                            </div>

                            <a href="#" class="pull-right need-help well-sm">Need help? </a><span
                                class="clearfix"></span>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="well">
                    User: masum<br>
                    Password: 123456
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

</div>
</body>
</html>

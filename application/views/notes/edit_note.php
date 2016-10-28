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
    <?php $this->load->view('nav.php'); ?>
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 well">
                <?php
                foreach ($notes as $note) {
                    $attributes = array("class" => "form-horizontal", "name" => "notesaveform");
                    echo form_open(base_url() . "Notes/update_note/" . $note->id, $attributes);
                    ?>
                    <fieldset>
                        <legend>Update Note</legend>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Title</label>
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" name="title" placeholder="Title" type="text"
                                       value="<?php echo $note->title; ?>"/>
                                <span class="text-danger"><?php echo form_error('title'); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="email" class="control-label">Description</label>
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" name="description" placeholder="Description" type="text"
                                       value="<?php echo $note->description; ?>"/>
                                <span class="text-danger"><?php echo form_error('description'); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input name="submit" type="submit" class="btn btn-primary" value="Save"/>
                            </div>
                        </div>
                    </fieldset>
                    <?php
                    echo form_close();
                    echo $this->session->flashdata('msg');
                } ?>
            </div>
        </div>
    </div>

</div>
</body>
</html>
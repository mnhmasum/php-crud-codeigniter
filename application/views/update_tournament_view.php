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
    <?php include_once 'nav.php' ?>
    <div class="jumbotron">
        <h1>CREATE NEW TOURNAMENT</h1>
        <p> - Create new tournament</p>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="well">
                <?php $attributes = array("class" => "form-horizontal", "name" => "save-team-form");
                echo form_open(base_url() . "Point/updateSubmitTournament", $attributes);
                foreach ($tournaments as $tournament) { ?>
                    <fieldset>
                        <legend>Tournament Create</legend>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Tournament Name</label>
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" name="id" placeholder="id" type="text"
                                       value="<?php echo $tournament->tournament_id; ?>"/>
                                <input class="form-control" name="name" placeholder="Tournament Name" type="text"
                                       value="<?php echo $tournament->tournament_name; ?>"/>
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>

                            <div class="col-md-12">
                                <label for="name" class="control-label">Tournament Status</label>
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" name="status" placeholder="Status" type="text"
                                       value="<?php echo $tournament->status; ?>"/>
                                <span class="text-danger"><?php echo form_error('status'); ?></span>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input name="submit" type="submit" class="btn btn-primary" value="Save"/>
                            </div>
                        </div>
                    </fieldset>

                <?php }
                echo form_close(); ?>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="well">
                <legend>Tournament List</legend>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Team Name</th>
                            <th>Tournament Status</th>
                            <th>Created</th>
                            <th colspan="2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach ($tournaments as $tournament) {
                            echo "<tr>";
                            echo "<td>" . $tournament->tournament_name . "</td>";
                            if ($tournament->status == 1) {
                                //echo "<td>" . $tournament->status . "</td>";
                                echo "<td><a href=\"#\" class=\"btn btn-success\">Running</a></td>";
                            } else {
                                echo "<td><a href=\"#\" class=\"btn btn-primary\">Closed</a></td>";
                            }

                            echo "<td>" . $tournament->created_date . "</td>";
                            echo "<td><a href='updateTournament?id=" . $tournament->tournament_id . "'>Update</a></td>";
                            echo "<td><a href='updateTournament?id=" . $tournament->tournament_id . "'>delete</a></td>";
                            echo "</tr>";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
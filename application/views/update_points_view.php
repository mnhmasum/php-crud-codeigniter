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
    <?php include_once 'nav.php'?>
    <div class="jumbotron">
        <h1>UPDATE POINTS</h1>
        <p> - Update point</p>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="well">
                <?php /*//print_r($teams);;

                foreach ($result as $message) {
                    echo $message->tournament_name;
                }
                */ ?>

                <?php $attributes = array("class" => "form-horizontal", "name" => "save-team-form");
                echo form_open(base_url() . "Point/updatePointsSubmit", $attributes); ?>
                <fieldset>
                    <?php
                    print_r($points);
                    foreach ($points as $point) {
                    /* foreach ($result as $message) {
                        echo '<option value="' . $message->tournament_id . '">' . $message->tournament_name . '</option>';
                    }
                    */?>
                    <legend>Update Points</legend>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="tournament_name" class="control-label">Tournament Name</label>
                            <input class="form-control" name="id" placeholder="Tournament Name" type="text" value="<?php echo $point->point_id; ?>"/>
                        </div>
                        <div class="col-md-12">
                            <!--<div>

                                <select name="tournament_name" class="form-control" id="sel1">


                                </select>


                            </div>-->
                            <input class="form-control" name="tournament_name" placeholder="Tournament Name" type="text"
                                   value="<?php echo $point->tournament_name; ?>"/>
                            <span class="text-danger"><?php echo form_error('tournament_name'); ?></span>
                        </div>

                        <div class="col-md-12">
                            <label for="team_name" class="control-label">Team Name</label>
                        </div>
                        <div class="col-md-12">
                            <!--<div>
                            <select name="team_name" class="form-control" id="sel1">
                            <?php
                            /*                                    print_r($teams);
                            foreach ($teams as $team) {
                            echo '<option value="' . $team->team_id . '">' . $team->team_name . '</option>';
                            }
                            */ ?>

                            </select>

                            </div>-->

                            <input class="form-control" name="team_name" placeholder="Team Name" type="text"
                                   value="<?php echo $point->team_name; ?>"/>
                            <span class="text-danger"><?php echo form_error('team_name'); ?></span>
                        </div>

                        <div class="col-md-12">
                            <label for="match_played" class="control-label">Match Played</label>
                        </div>
                        <div class="col-md-12">
                            <input class="form-control" name="match_played" placeholder="Match Played" type="text"
                                   value="<?php echo $point->no_of_played; ?>"/>
                            <span class="text-danger"><?php echo form_error('match_played'); ?></span>
                        </div>

                        <div class="col-md-12">
                            <label for="win" class="control-label">Win</label>
                        </div>
                        <div class="col-md-12">
                            <input class="form-control" name="win" placeholder="Win" type="text"
                                   value="<?php echo $point->win; ?>"/>
                            <span class="text-danger"><?php echo form_error('win'); ?></span>
                        </div>

                        <div class="col-md-12">
                            <label for="lost" class="control-label">Lost</label>
                        </div>
                        <div class="col-md-12">
                            <input class="form-control" name="lost" placeholder="Lost" type="text"
                                   value="<?php echo $point->lost; ?>"/>
                            <span class="text-danger"><?php echo form_error('lost'); ?></span>
                        </div>

                        <div class="col-md-12">
                            <label for="points" class="control-label">Points</label>
                        </div>
                        <div class="col-md-12">
                            <input class="form-control" name="points" placeholder="Points" type="text"
                                   value="<?php echo $point->points; ?>"/>
                            <span class="text-danger"><?php echo form_error('points'); ?></span>
                        </div>


                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input name="submit" type="submit" class="btn btn-primary" value="Save"/>
                        </div>
                    </div>
                    <?php } ?>
                </fieldset>
                <?php echo form_close(); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="well">
                <legend>Tournaments Points Table</legend>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Team Name</th>
                            <th>Match Played</th>
                            <th>Win</th>
                            <th>Lost</th>
                            <th>Points</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach ($points as $point) {
                            echo "<tr>";
                            echo "<td>**</td>";
                            echo "<td>" . $point->team_name . "</td>";
                            echo "<td>" . $point->no_of_played . "</td>";
                            echo "<td>" . $point->win . "</td>";
                            echo "<td>" . $point->lost . "</td>";
                            echo "<td>" . $point->points . "</td>";
                            echo "<td><a href='updatePoints?id=" . $point->point_id . "'>Update</a></td>";
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
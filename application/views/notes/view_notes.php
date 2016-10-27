<?php $this->load->view('header.php'); ?>
<body>
<div class="container">
    <?php $this->load->view('nav.php'); ?>
    <div class="jumbotron">
        <h1>CREATE NEW POINTS</h1>
        <p> - Create new points</p>
        <?php echo $this->session->flashdata('msg'); ?>
    </div>
    <div class="row">

        <div class="col-md-8">
            <div class="well">
                <legend>Tournaments Points Table</legend>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Team Name</th>
                            <th>Match Played</th>
                            <th colspan="2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach ($result as $note) {
                            echo "<tr>";
                            echo "<td>" . $note->id . "</td>";
                            echo "<td>" . $note->title . "</td>";
                            echo "<td>" . $note->description . "</td>";
                            echo "<td><a href='edit_note/".$note->id."'>Update</a></td>";
                            echo "<td><a href='delete_note/".$note->id."'>delete</a></td>";
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
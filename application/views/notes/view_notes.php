<?php $this->load->view('header.php'); ?>
<body>
<div class="container">
    <?php $this->load->view('nav.php'); ?>

    <h1>All Notes</h1>

    <p> - All notes are visible here in a table</p>
    <?php echo $this->session->flashdata('msg'); ?>

    <div class="row">

        <div class="col-md-12">
            <div class="well">
                <legend>Notes</legend>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
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
                            echo "<td><a href='edit_note/" . $note->id . "'>Update</a></td>";
                            echo "<td><a href='delete_note/" . $note->id . "'>delete</a></td>";
                            echo "</tr>";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong>
        seconds. <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
    </p>

</div>
</body>
</html>
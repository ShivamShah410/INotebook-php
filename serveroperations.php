<?php

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        if(isset($_GET['delete'])) {
            $srno = $_GET['delete'];
            $sql = "DELETE FROM `notes` WHERE `SRNO`=$srno";

            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Note deleted Successfully!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Error deleted Note!!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }

    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['srnoEdit'])) {

            $titleEdit = $_POST['titleEdit'];
            $descEdit = $_POST['descEdit'];
            $srnoEdit = $_POST['srnoEdit'];

            // echo $titleEdit . " " . $descEdit;
            // exit();

            $sql = "UPDATE `notes` set `TITLE`='$titleEdit', `DESCRIPTION`='$descEdit' WHERE `SRNO`=$srnoEdit";

            $result = mysqli_query($con, $sql);
            if ($result) {
                echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                Note Updated Successfully!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            } else {
                echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                Error Updating Note!!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            
        } else {

            $title = $_POST['titleAdd'];
            $description = $_POST['descAdd'];

            $sql = "INSERT INTO `notes` (`SRNO`, `TITLE`, `DESCRIPTION`, `TIMESTAMP`) VALUES (NULL, '$title', '$description', current_timestamp());";
            $result = mysqli_query($con, $sql);

            if ($result) {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Note Added Successfully!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            } else {
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Error Adding Note!!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    }

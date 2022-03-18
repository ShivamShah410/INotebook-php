<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iNotes- Note taking App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>

<body id="body">

    <?php include "./navabar.php" ?>
    <?php include "./dbconnect.php" ?>
    <?php include "./serveroperations.php" ?>


    <!-- Edit Modal -->

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/iNotebook/index.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit a note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="srnoEdit" id="srnoEdit">
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="descEdit" name="descEdit" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Modal -->

    <div class="container my-3">
        <button type="button" class="btn btn-primary" id="addNoteButton">
            Add Note
        </button>
    </div>


    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/iNotebook/index.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add a note</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- <input type="hidden" name="srnoAdd" id="srnoAdd"> -->
                        <div class="mb-3">
                            <label for="addTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="titleAdd" name="titleAdd" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="descAdd" name="descAdd" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Note</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($con, $sql);
        ?>

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">SRNO</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col">TIMESTAMP</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $srnum = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <th scope='row'>" . $srnum . "</th>
                    <td>" . $row['TITLE'] . "</td>
                    <td>" . $row['DESCRIPTION'] . "</td>
                    <td>" . $row['TIMESTAMP'] . "</td>
                    <td>" . "<button id=" . $row['SRNO'] . " class='edit btn btn-light'>Edit</button>" . "<form action='/iNotebook/index.php' method='POST'><input type='hidden' name='srnoDelete' id='srnoDelete' value='" . $row['SRNO'] . "'><button type='submit' id=d" . $row['SRNO'] . " class='delete btn btn-light'>Delete</button></form>" . "</td>
                    </tr>";
                    $srnum++;
                }
                ?>
            </tbody>
        </table>


    </div>

    <?php $con->close() ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $("#addNoteButton").on("click", () => {
                $("#addModal").modal("toggle");
            })
        });



        let deletes = document.getElementsByClassName("delete");
        let a = null;
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                // let sno = e.target.id.substring(1);
                // console.log(sno);

                // confirm("Do you really want to delete Note?")
            });
        });

        let edits = document.getElementsByClassName('edit');
        let b = null;
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                b = e.target.parentNode.parentNode;
                title = b.getElementsByTagName("td")[0].innerText;
                desc = b.getElementsByTagName("td")[1].innerText;
                titleEdit.value = title;
                descEdit.value = desc;
                srnoEdit.value = e.target.id;
                $("#editModal").modal("toggle");
            });
        });
    </script>
</body>

</html>
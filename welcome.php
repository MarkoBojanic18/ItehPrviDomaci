<?php

require "config.php";
require  "addNew.php";

session_start();

if(!isset($_SESSION["user_id"])){
    header("Location: index.php");
    exit();
  }

  $result = addNew::getAll($conn);

  if(!$result){
    echo "<script>alert('Error occurs! Problem is connected with the car base');</script>";
    die();
  }

  if($result->num_rows == 0){
      echo "There is no cars for promotion";
      die();
  }
  else{

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportCars</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="styleWelcome.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="alert alert alert-primary" role="alert">
            <h4 class="text-primary text-center">Find your own place and win the world!</h4>
        </div>

        <!-- add/edit form modal -->

        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add/Edit User <i class="fa fa-user-circle-o"
                                aria-hidden="true"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="addform" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Car model and mark:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-circle-o"
                                                aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control" id="username" name="carName"
                                        required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">User name:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="email" class="form-control" id="email" name="userName"
                                        required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Email:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="phone" class="form-control" id="phone" name="email" required="required"
                                        maxLength="10" minLength="10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Price:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="phone" class="form-control" id="phone" name="price" required="required"
                                        maxLength="10" minLength="10">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Photo:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01"><i
                                                class="fa fa-picture-o" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="photo" id="userphoto">
                                        <label class="custom-file-label" for="userphoto">Choose file</label>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="addButton">Submit</button>
                            <input type="hidden" name="action" value="adduser">
                            <input type="hidden" name="userid" id="userid" value="adduser">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- add/edit form modal end -->



        <!-- profile modal start -->
        <div class="modal fade" id="userViewModal" tabindex="-1" role="dialog" aria-labelledby="userViewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Profile <i class="fa fa-user-circle-o"
                                aria-hidden="true"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container" id="profile">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <img src="http://placehold.it/100x100" alt="" class="rounded responsive" />
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4 class="text-primary">Virat Kohli</h4>
                                    <p class="text-secondary">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i> email@example.com
                                        <br />
                                        <i class="fa fa-phone" aria-hidden="true"></i> xxxxxxxxxx
                                    </p>
                                    <!-- Split button -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- profile modal end -->




        <div class="row mb-3">

            <div class="col-3">
                <a href="logout.php" class="link">Logout</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal">Add New <i
                        class="fa fa-user-circle-o"></i></button>
            </div>
            <div class="col-9">
                <div class="input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"
                                aria-hidden="true"></i></span>
                    </div>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-lg" placeholder="Search..." id="searchinput">

                </div>

            </div>

        </div>



        <!-- table -->
        <table class="table" id="userstable">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Car model and name</th>
                    <th scope="col">User name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row=$result->fetch_array()):
                ?>
                <tr>
                    <td class="align-middle"><?php echo $row["photo"] ?><img src="http://placehold.it/80x80"
                            class="img-thumbnail rounded float-left"></td>
                    <td class="align-middle"><?php echo $row["carName"] ?></td>
                    <td class="align-middle"><?php echo $row["userName"] ?></td>
                    <td class="align-middle"><?php echo $row["email"] ?></td>
                    <td class="align-middle"><?php echo $row["price"] ?> euro/h</td>

                    <td class="align-middle">
                        <a href="#" class="btn btn-success mr-3 profile" data-toggle="modal"
                            data-target="#userViewModal" title="Prfile"><i class="fa fa-address-card-o"
                                aria-hidden="true"></i></a>
                        <?php if($_SESSION["user_id"] == $row["id"]): ?>
                        <a href="#" class="btn btn-warning mr-3 edituser" data-toggle="modal" data-target="#userModal"
                            title="Edit" value=<?php echo $row["id"] ?>><i class="fa fa-pencil-square-o fa-lg"></i></a>
                        <a href="#" class="btn btn-danger deleteuser" data-userid="14" title="Delete"><i
                                class="fa fa-trash-o fa-lg"></i></a>
                    </td>
                    <?php endif ?>
                </tr>

                <?php 
                endwhile;
            }
                ?>

            </tbody>
        </table>

        <!-- table -->



        <nav id="pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
        <input type="hidden" name="currentpage" id="currentpage" value="1">
    </div>
    <div>

        <!-- JS, Popper.js, and jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    </div>
    <div id="overlay" style="display:none;">
        <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;"></div>
        <br />
        Loading...
    </div>
</body>
<script>
$(document).ready(function() {
    // $('#overlay').fadeIn().delay(2000).fadeOut();
});
</script>

</html>
<?php

require "config.php";
require  "addNew.php";
require "user.php";
error_reporting(0);

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
    <div id="loginUserContainer" class="loginUserContainer">
        <div id="loginUserPicture" class="loginUserPicture">
            <img src="img/user.png" alt="">
        </div>
        <div id="loginUser" class="loginUser">
            <h1><?php 
            $result1 = User::getAll($conn);
            $ime = "";
            while($raw = $result1->fetch_array()){
                if($raw["id"] == $_SESSION["user_id"]){  
                    $ime = $raw["full_name"];
                }
            }
                echo $ime;
              ?></h1>

            <h3 id="imejl"><?php 
            $result1 = User::getAll($conn);
            $imejl = "";
            while($raw = $result1->fetch_array()){
                if($raw["id"] == $_SESSION["user_id"]){  
                    $imejl = $raw["email"];
                }
            }
                echo $imejl;
              ?></h3>
        </div>
        <div>

        </div>
    </div>
    <div class="container">
        <div class="alert alert alert-primary" role="alert">
            <h4 class="text-primary text-center">Find your own place and win the world!</h4>
        </div>



        <!-- ADD form modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User <i class="fa fa-user-circle-o"
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
                                    <input type="text" class="form-control" id="carName" name="carName"
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
                                    <input type="text" class="form-control" id="userName" name="userName"
                                        required="required" value=<?php 
            $result1 = User::getAll($conn);
            $ime = "";
            while($raw = $result1->fetch_array()){
                if($raw["id"] == $_SESSION["user_id"]){  
                    $ime = $raw["full_name"];
                }
            }
                echo $ime;
              ?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Email:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="email" class="form-control" id="email" name="email" required="required"
                                        value="<?php 
            $result1 = User::getAll($conn);
            $imejl = "";
            while($raw = $result1->fetch_array()){
                if($raw["id"] == $_SESSION["user_id"]){  
                    $imejl = $raw["email"];
                }
            }
                echo $imejl;
              ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Price:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="price" name="price" required="required"
                                        maxLength="" minLength="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Date of production:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01"><i
                                                class="fa fa-picture-o" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="date" id="date" name="date" class="form-control"
                                            required="required" />
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
        <!-- ADD form modal end -->














        <!-- EDIT form modal -->

        <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User <i class="fa fa-user-circle-o"
                                aria-hidden="true"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editform" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Car model and mark:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-circle-o"
                                                aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control" id="carName" name="carName"
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
                                    <input type="text" class="form-control" id="userName" name="userName"
                                        required="required" value=<?php 
            $result1 = User::getAll($conn);
            $ime = "";
            while($raw = $result1->fetch_array()){
                if($raw["id"] == $_SESSION["user_id"]){  
                    $ime = $raw["full_name"];
                }
            }
                echo $ime;
              ?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Email:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="email" class="form-control" id="email" name="email" required="required"
                                        value="<?php 
            $result1 = User::getAll($conn);
            $imejl = "";
            while($raw = $result1->fetch_array()){
                if($raw["id"] == $_SESSION["user_id"]){  
                    $imejl = $raw["email"];
                }
            }
                echo $imejl;
              ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Price:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"
                                                aria-hidden="true"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="price" name="price" required="required"
                                        maxLength="" minLength="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Date of production:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01"><i
                                                class="fa fa-picture-o" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="date" id="date" name="date" class="form-control"
                                            required="required" />
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
        <!-- EDIT form modal end -->



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
                                    <img src="http://placehold.it/100x100" id="Img" alt="" class="rounded responsive" />
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4 id="UserName" class="text-primary"></h4>
                                    <p class="text-secondary">
                                        <i id="Email" class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <br />
                                        <i class="fa fa-phone" id="Price" aria-hidden="true"></i>
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
                <!-- <a href="logout.php" class="link">Logout</a> -->
                <button type="button" id="btnLogout" class="btn btn-primary">Logout </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add
                    New <i class="fa fa-user-circle-o"></i></button>
                <button type="button" onclick="sortTable()" class="btn btn-primary">Sort </button>
                <label for="sort">Choose a criteria:</label>
                <select name="criteria" id="criteria" class="criteria">
                    <option value="myposts">My Posts</option>
                    <option value="price">Price</option>
                    <option value="date">Date</option>
                    <option value="carname">Car Name</option>
                </select>
            </div>
            <div class="col-9">
                <div class="input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"
                                aria-hidden="true"></i></span>
                    </div>
                    <input type="text" id="myInput" onkeyup="funkcijaZaPretragu()" class="form-control"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"
                        placeholder="Search for car..." id="searchinput">

                </div>

            </div>

        </div>



        <!-- table -->
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Date of production</th>
                    <th scope="col">Car model and name</th>
                    <th scope="col">User name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Price( euro/h)</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row=$result->fetch_array()):
                ?>
                <tr>
                    <td class="align-middle"><?php echo $row["date"] ?></td>
                    <td id="CarName" class="align-middle"><?php echo $row["carName"] ?></td>
                    <td id="Username" class="align-middle"><?php echo $row["userName"] ?></td>
                    <td id="EmaIL" class="align-middle"><?php echo $row["email"] ?></td>
                    <td id="PriCe" class="align-middle"><?php echo $row["price"] ?></td>

                    <td class="align-middle">
                        <a href="#" class="btn btn-success mr-3 profile" data-toggle="modal"
                            data-target="#userViewModal" title="Prfile"><i class="fa fa-address-card-o"
                                aria-hidden="true"></i></a>

                        <!-- Naredni php kod omogucava da korisnik moze da menja i brise samo one postove koji su napravljeni sa naloga koji je trenutno ulogovan ! -->
                        <?php 
                        $result1 = User::getAll($conn);
                            $imejl = "";
                            while($raw = $result1->fetch_array()){
                                if($raw["id"] == $_SESSION["user_id"]){  
                                    $imejl = $raw["email"];
                                }
                            }
                    
                            if(strcmp($imejl, $row["email"]) == 0):  ?>
                        <a href="#" id="btnChange" onclick="check()" class="btn btn-warning mr-3 edituser"
                            data-toggle="modal" data-target="#changeModal" title="Edit"
                            value=<?php echo $row["id"] ?>><i class="fa fa-pencil-square-o fa-lg"></i></a>
                        <a href="#" id="btnDelete" onclick="check()" formmethod="post" class="btn btn-danger deleteuser"
                            data-userid="14" title="Delete"><i class="fa fa-trash-o fa-lg"></i></a>
                    </td>
                    <td>
                        <label class="custom-radio-btn">
                            <input type="radio" id="box" name="checked-donut" value=<?php echo $row["id"] ?>>
                            <span class="checkmark"></span>
                        </label>
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



        <nav id=" pagination">
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

    <script src="js/main.js"></script>
    <!-- <script>
    $(document).ready(function() {
        // $('#overlay').fadeIn().delay(2000).fadeOut();
    });
    </script> -->




    <script>
    function sortTable() {
        var table, rows, switching, i, j, z, k, x, y, shouldSwitch;
        table = document.getElementById("myTable");
        switching = true;
        var newrows;

        var e = document.getElementById("criteria");
        var result = e.options[e.selectedIndex].value;
        var p = document.getElementById("imejl").innerHTML;

        //SORT my posts
        // sortira tako da uvek budu postovi osobe koja je ulogovana na vrhu pa onda svi ostali ispod
        if (result == "myposts") {
            rows = table.rows;
            for (i = 1; i < rows.length; i++) {
                x = rows[i].getElementsByTagName("TD")[3];
                if (x.innerHTML == p) {
                    for (j = 1; j < (rows.length - 1); j++) {
                        if (rows[j] != p) {
                            rows[j].parentNode.insertBefore(rows[i], rows[j]);
                            break;
                        }
                    }
                }

            }
        }

        //SORT po datumu
        // sortira tako da najsveziji datumu idu prvi 
        if (result == "date") {
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                for (j = i + 1; j < rows.length; j++) {
                    x = rows[i].getElementsByTagName("TD")[0];
                    y = rows[j].getElementsByTagName("TD")[0];

                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        rows[i].parentNode.insertBefore(rows[j], rows[i]);
                    }
                }
            }
        }



        //SORT po ceni
        // sortira tako da najjeftiniji postovi idu na vrh
        if (result == "price") {
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                for (j = i + 1; j < rows.length; j++) {
                    x = rows[i].getElementsByTagName("TD")[4];
                    y = rows[j].getElementsByTagName("TD")[4];
                    z = parseInt(x.innerHTML);
                    k = parseInt(y.innerHTML);
                    if (z > k) {
                        rows[i].parentNode.insertBefore(rows[j], rows[i]);
                    }
                }
            }

        }


        //SORT po imenu automobila
        //sortiranje vrsi po ASCII kodu
        if (result == "carname") {
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                for (j = i + 1; j < rows.length; j++) {
                    x = rows[i].getElementsByTagName("TD")[1];
                    y = rows[j].getElementsByTagName("TD")[1];

                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        rows[i].parentNode.insertBefore(rows[j], rows[i]);
                    }
                }
            }
        }


    }

    document.getElementById('btnLogout').onclick = function() {
        window.location.href = "logout.php";
    }

    function funkcijaZaPretragu() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    </script>

</body>



</html>
<?php

session_start();
$_SESSION['message']='';

$mysqli = new mysqli('localhost','root','','bookings');

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $name =$mysqli->real_escape_string($_POST['name']);
    $location =$mysqli->real_escape_string($_POST['location']);
    $contact =$mysqli->real_escape_string($_POST['contact']);
    $date =$mysqli->real_escape_string($_POST['date']);
    $eventType =$mysqli->real_escape_string($_POST['eventType']);


    $_SESSION['name']=$name;
    $_SESSION['location']=$location;
    $_SESSION['contact']=$contact;
    $_SESSION['date']=$date;
    $_SESSION['eventType']=$eventType;


    $sql="INSERT into info(name,location,contact,date,eventType)VALUES('$name','$location','$contact','$date','$eventType')";

    if ($mysqli->query($sql)===true) {
        $_SESSION['message']='Registration Succesfully added ';
        header("location:bookings.php");
    }else {
        $_SESSION['message']='Booking could not be added  to database';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style3.css">
    <?php include('header.html')?>
    <title>BOOK</title>
</head>
<body>


 <!--header-->
 <header>
        <div class="container">
            <div class="row">
                <div class="brand-name">
                <a href="" class="logo">STEPH KAPELLA</a>
                </div>

                <div class="navbar">
                    <ul>
                        <li><a href="index.php" >HOME</a></li>
                        <li><a href="book.php" class="active">BOOK</a></li>
                        <li><a href="">ALBUMS</a></li>
                        <li><a href="">CHAT</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>


    <!--start home-->
<section class="home">
    <div class="container">
      <div class=" full-screen">
        <div class="home-content">

                <!--Booking form-->

<div class="booking-form-box">

<div class="booking-form-header">
<div class="alert alert-error"><?= $_SESSION['message']?></div>
    <h3>Book Now!</h3>
</div>

    <div class="booking-form" name="bookform" method="POST"  action="book.php" enctype="multipart/form-data" autocomplete="off">
        <label>Enter Name</label>
        <input name="name" type="text" class="form-control" placeholder="Name"  required></input>

        <label>Location</label>
        <input name="location" type="text" class="form-control" placeholder="Area Code/City"  required></input>

        <label>Contact</label>
        <input name="contact" type="text" class="form-control" placeholder="Email Address/ Phone Number"  required></input>

        <div class="input-grp">
        <label>Date</label>
        <input name="date" type="date" class="form-control select-date"  required></input>
        </div>

        <div class="input-grp">
            <label>Event Type</label>
            <select name="eventType" class="custom-select"  required>
                <option value="1">Private Events</option>
                <option value="2">Public Events</option>
                <option value="3">Radio Interview</option>
                <option value="4">TV interview</option>
                <option value="5">Others</option>


            </select>
        </div>
        <div class="input-grp">
        <button class="btn btn-primary book" type="submit" id="bookingbtn" name="book">SUBMIT</button>
        </div>

       <div class="back" >
       <a href="index.php">BACK</a>
       </div>
    </div>
</div>

          </div>
          </div>
        </div>
      </div>
    </div>
</section>


<?php include('footer.html')?>
</body>
</html>
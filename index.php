<?php
  session_start();

  $conn = new PDO('mysql:host=localhost; dbname=school_management_system', 'root', '');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Management System</title>
  <link rel="stylesheet" href="custom.css">
  <?php require "link.php"; ?>
  <style>
    .cards-container{
      background-color: #f1dede;
      width: 85%;
      margin-left: 90px;
      /* height: 50%; */
      padding-bottom: 30px;
    }
    .title{
      text-align: center;
      font-family: verdana;
      font-size: 35px;
      padding-top: 23px;
      color: brown;
    }
    .cards{
      height: 343px;
      border-radius: 20px;
      width: 320px;
      display: inline-block;
      margin-left: 45px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      padding: 16px;
      text-align: center;
      background-color: #f1f1f1;
    }
    .teacherNm{
      color: #9e6969;
      font-family: verdana;
      text-align: center;
      margin-top: -4px;
      background-color: #dcd7d7;
      padding: 4%;
      border-radius: 20px;
    }
    .para{
      font-family: verdana;
      font-size: 15px;
      margin: 0px;
      padding: 0px;
      display: flex;
      text-align: justify;
  text-justify: inter-word;
    }
    .lb{
      font-family: verdana;
      font-size: 20px;
      font-weight: 500;
    }
    .input-box{
      height: 33px;
      width: 370px;
      font-family: verdana;
      margin-bottom: 20px;
    }
    .textarea-contactUs{
      margin-left: 269px;
      font-family: verdana;
    }
    .btn-contactUs{
      margin-left: 100px;
    }
  </style>
</head>
<body>
  <div class="nav-bar">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">School Management System</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#staff" class="link-font">Staff</a></li>
          <li><a href="#login" class="link-font">Login</a></li>
          <li><a href="adminPanel/login-admin.php" class="link-font">Admin Panel</a></li>
          <li><a href="#contactUs" class="link-font">Contact us</a></li>
        </ul>
      </div>
    </nav>
  </div>
  <div class="main-image">
    <img src="images/notebook-336634_960_720.jpg" class="main">
  </div>
  <div class="box" id="login">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <h3 class="title-login">Student Login</h3>
          <p style="color: brown; font-family: verdana;"><?php if(isset($_SESSION['studentLoginErr'])) { echo $_SESSION['studentLoginErr']; } ?></p>
          <form action="http://localhost/viral/school-system/studentAdminPanel/student-login.php" method="post">
            <input type="text" placeholder="Username" name="username" required><br><br>
            <input type="password" placeholder="Password" name="password" required><br><br>
            <button class="btn" name="submitStudentUandP">Login</button>
          </form>
        </div>
         <div class="col-sm-4">
          <h3 class="title-login">Teacher Login</h3>
          <p style="color: brown; font-family: verdana"><?php if(isset($_SESSION['error-username-techer'])) { echo $_SESSION['error-username-techer']; } ?></p>
          <form action="http://localhost/viral/school-system/teacherAdmin/teacherLogin.php" method="post">
            <input type="text" placeholder="Username" name="username" required><br><br>
            <input type="password" placeholder="Password" name="password" required><br><br>
            <button class="btn" name="teacherLoginSubmit">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <br><br>

  <!-- This is a card coding start -->
  <div class="cards-container">
    <h3 class="title" id="staff">School Staff......</h3>
    <br>
    <div class="card-line">
      <div class="cards">
        <h3 class="teacherNm">Principal</h3>
        <p class="para">Name : Viral Ghodadara</p>
        <p class="para">Qualification : BCA</p>
        <p class="para">Email : viralghodadra37@gmail.com</p>
        <p class="para" >Bio : I am a principal of vivekanand school and my goal is a very best principal in our school..</p>
        <br><br><br>
        <a href="https://www.facebook.com/viral.ghodadara.3"><i class="fa fa-facebook-square" style="font-size:36px; margin-left: 12px;"></i></a>
        <a href="#" style="color: black;"><i class="fa fa-linkedin" style="font-size:36px; margin-left: 25px;"></i></a>
        <a href="https://www.instagram.com/viral_ghodadara/" style="color: maroon;"><i class="fa fa-instagram" style="font-size:36px; margin-left: 25px;"></i></a>
        <a href="https://twitter.com/GhodadaraViral"><i class="fa fa-twitter" style="font-size:36px; margin-left: 25px;"></i></a>
      </div>

      <div class="cards">
        <h3 class="teacherNm">Vice Principal</h3>
        <p class="para">Name : Pradeep Dodiya</p>
        <p class="para">Qualification : Arts</p>
        <p class="para">Email : pradeepdodiya12@gmail.com</p>
        <p class="para">Bio : I am a vice principal of vivekanand school and my goal is a very best principal in our school..</p>
        <br><br><br>
          <a href="#"><i class="fa fa-facebook-square" style="font-size:36px; margin-left: 12px;"></i></a>
          <a href="#" style="color: black;"><i class="fa fa-linkedin" style="font-size:36px; margin-left: 25px;"></i></a>
          <a href="#" style="color: maroon;"><i class="fa fa-instagram" style="font-size:36px; margin-left: 25px;"></i></a>
          <a href="#"><i class="fa fa-twitter" style="font-size:36px; margin-left: 25px;"></i></a>
      </div>

      <div class="cards">
        <h3 class="teacherNm">Admin - Teacher</h3>
        <p class="para">Name : Jaydeep Suthar</p>
        <p class="para">Qualification : BCA</p>
        <p class="para">Email : jaydeepsuthar22@gmail.com</p>
        <p class="para">Bio : I am a admin of vivekanand school and i have try for my best in a our school ...</p>
        <br><br><br>
          <a href="#"><i class="fa fa-facebook-square" style="font-size:36px; margin-left: 12px;"></i></a>
          <a href="#" style="color: black;"><i class="fa fa-linkedin" style="font-size:36px; margin-left: 25px;"></i></a>
          <a href="#" style="color: maroon;"><i class="fa fa-instagram" style="font-size:36px; margin-left: 25px;"></i></a>
          <a href="#"><i class="fa fa-twitter" style="font-size: 36px; margin-left: 25px;"></i></a>
      </div>
    </div>
  </div>
  <!-- The card coding end -->

  <div>
      <h3 class="title" id="contactUs">Contact Us</h3>
      <br>
      <div>
        <p style="color: brown; font-family: verdana; margin-left: 269px; font-size: 17px;" id="err-contactUs"></p>
        <form method="post">
          <label class="lb">Name : </label><input type="text" name="name" placeholder="Enter the name" class="input-box" style="margin-left: 120px;" required><br>
          <label class="lb">Contact Number : </label>&nbsp;&nbsp;<input type="number" name="contactNumber" placeholder="Enter the contact number" class="input-box" style="margin-left: 7px;" required><br>
          <label class="lb">Email Id : </label>&nbsp;&nbsp;<input type="email" name="email" placeholder="Enter the email id " class="input-box" style="margin-left: 88px;"><br>
          <textarea name="aboutClient" cols="68" rows="7" class="textarea-contactUs" placeholder="About you......" required></textarea><br>
          <button type="submit" name="submit-clientData" class="btn" style="margin-left: 268px; margin-top: 14px;">Submit</button>
        </form>
      </div>
      <?php
        if (isset($_POST['submit-clientData'])) {
          $clientName = $_POST['name'];
          $clientContactNumber = $_POST['contactNumber'];
          $clientEmailId = $_POST['email'];
          $clientAbout = $_POST['aboutClient'];

          if (strlen($clientName) >= 3 && strlen($clientName) <= 10) {
            if (strlen($clientContactNumber) == 10) {
              $insertClientContactInfo = "INSERT INTO contactus (clientName, contact_number, email, aboutyou) VALUES (?, ?, ?, ?)";
              $statInsertClientContactInfo = $conn->prepare($insertClientContactInfo);

              if ($statInsertClientContactInfo->execute([$clientName, $clientContactNumber, $clientEmailId, $clientAbout])) {
              ?>
                <script>
                  alert("Your information has been successfully reached and our team will contact you as soon as possible");
                </script>
              <?php
              }
            } else {
            ?>
              <script>
                document.getElementById("err-contactUs").innerHTML = "***Please enter the valid contact number";
              </script>
            <?php  
            }  
          } else {
          ?>
            <script>
              document.getElementById("err-contactUs").innerHTML = "***Please enter the name greter than 2 and less than 9";
            </script>
          <?php
          }
        }
      ?>
  </div>
  <br><br><br>

<!-- This is a footer start -->

<!-- Footer -->
<footer class="page-footer font-small mdb-color" style="background-color: #222; color: white; padding-bottom: 20px;">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">

  <br><br>

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 mr-auto my-md-4 my-0 mt-4 mb-1">

        <!-- Content -->
        <h5 class="font-weight-bold text-uppercase mb-4">School Management System</h5>
        <p>Here, My school is a very best in our areas.</p>
        <p>I have thoughts for my school our school children top in every year .</p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 mx-auto my-md-4 my-0 mt-4 mb-1">

        <!-- Links -->
        <h5 class="font-weight-bold text-uppercase mb-4">About</h5>

        <ul class="list-unstyled">
          <li>
            <p>
              <a href="http://localhost/viral/school-system/adminPanel/login-admin.php">ADMIN PANEL</a>
            </p>
          </li>
          <li>
            <p>
              <a href="#staff">STAFF</a>
            </p>
          </li>
          <li>
            <p>
              <a href="#contactUs">CONTACT US</a>
            </p>
          </li>
          <li>
            <p>
              <a href="#login">LOG IN</a>
            </p>
          </li>
          <li>
            <p>
              <a href="https://github.com/ViralGhodadara/School_Management_system">DOWNLOAD SOURCE CODE FOR GITHUB</a>
            </p>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 mx-auto my-md-4 my-0 mt-4 mb-1">

        <!-- Contact details -->
        <h5 class="font-weight-bold text-uppercase mb-4">Address</h5>

        <ul class="list-unstyled">
          <li>
            <p>
              <i class="fa fa-home" style="font-size: 20px;"></i> &nbsp;&nbsp;Surat, Gujarat, India</p>
          </li>
          <li>
            <p>
              <i class="fa fa-envelope-o" style="font-size: 20px;"></i>&nbsp;&nbsp;viralghodadra37@gmail.com</p>
          </li>
          <li>
            <p>
              <i class="fa fa-mobile" style="font-size: 30px;"></i>&nbsp;&nbsp; + 91 76007 42473</p>
          </li>
          <li>
            <p>
              <i class="fa fa-phone" style="font-size: 30px;"></i>&nbsp;&nbsp; + 01 234 567 89</p>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 text-center mx-auto my-4">

        <!-- Social buttons -->
        <h5 class="font-weight-bold text-uppercase mb-4">Follow Us</h5>

        <!-- Facebook -->
        <a href="https://www.facebook.com/viral.ghodadara.3" class="btn-floating btn-fb">
          <i class="fa fa-facebook-square" style="font-size: 30px;"></i>
        </a>
        <br><br>
        <!-- Twitter -->
        <a href="https://twitter.com/GhodadaraViral" class="btn-floating btn-tw">
          <i class="fa fa-twitter" style="font-size: 30px;"></i>
        </a>
        <br><br>
        <!-- Google +-->
        <a type="button" class="btn-floating btn-gplus">
          <i class="fa fa-linkedin" style="font-size: 30px; color: black;"></i>
        </a>
        <br><br>
        <!-- Dribbble -->
        <a href="https://www.instagram.com/viral_ghodadara/" class="btn-floating btn-dribbble">
          <i class="fa fa-instagram" style="font-size: 30px; color: #994c9e"></i>
        </a>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->


</footer>
<!-- Footer -->

<!-- This is a footer end -->
</body>
</html>

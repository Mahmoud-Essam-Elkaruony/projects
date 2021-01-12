<?php

  if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['signin_button'])) {
       
      $signin_db->getFormData($_POST['first-name'], $_POST['last-name'], $_POST['email'], $_POST['password']);

    }
  }

?>

<!-- signin form-->
<div class="signin-page text-center" style="height: 500px;">

  <form method="POST" class="mt-5" style="max-width:480px;margin:auto;">
    <img src="assets/mobilesale.jpg" alt="login-page" style="width: 100px; height: 100px" class="mt-4 mb-2">
    <h5 class="font-baloo mb-2">Please Signin</h5>

    <label for="first-namee" class="sr-only">First Name</label>
    <input type="text" id="first-namee" name="first-name" class="form-control mb-2" placeholder="First Name" required>

    <label for="lest-namee" class="sr-only">Lest Name</label>
    <input type="text" id="last-namee" name="last-name" class="form-control mb-2" placeholder="Lest Name" required>

    <label for="emaill" class="sr-only">Email</label>
    <input type="email" id="emaill" name="email" class="form-control mb-2" placeholder="Email" required>

    <label for="passwordd" class="sr-only">Password</label>
    <input type="password" id="passwordd" name="password" class="form-control mb-2" placeholder="Password" required> 

    <div class="mt-3" ">
      <button type="submit" name="signin_button" style="width: 480px;" class="btn btn-lg btn btn-primary mb-2">Signin</button>
    </div>
  </form> 
  
</div>
<!--#signin form-->
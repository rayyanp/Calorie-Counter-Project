<?php
$path = substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], '/') + 1);
// Interface for signed-in users
if (isset($_SESSION['username'])) {
  $show_signin_form = false;
  
  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"caloriecounter");
  
  if (!$connection) {
    die("Connection failed: " . $mysqli_connect_error);
  }

  
  $calorieQuery = "SELECT SUM(calorie_intake) FROM calories WHERE uid = '$_SESSION[uid]' AND date(datetime) = curdate();";
  $calorieResult = mysqli_query($connection, $calorieQuery);
  $crTemp = mysqli_fetch_array($calorieResult);
  $cr = $crTemp[0];


  $query = "SELECT * FROM users WHERE uid = '$_SESSION[uid]'";
  $result = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    $sw = $row['start_weight'];
    $cw = $row['current_weight'];
    $gw = $row['goal_weight'];

  }

  // calculation for calorie goal
  $result1 = $cw * 2.205;
  $result2 = $result1 * 15;

  $x = $sw - $gw;
  $y = $sw - $cw;
  $z = $y / $x;
  $offset = 1 - $z;

  $reduction = $offset / 2;

  $reduction2 = $result2 * $reduction;

  // intake figures

  $ci = round($result2 - $reduction2);

  $ri = round($ci - $cr);


  echo <<<INTERFACE
  <div class="container-fluid" id="calorie">
    <legend class="title">Calories Remaining</legend> 
    <div class="row">
      <div class="col">
        <label>{$ci}<br>Goal</label>
      </div>
      <div class="col">
        <label>-</label>
      </div>
      <div class="col">
        <label>{$cr}<br>
        Food</label>
      </div>
      <div class="col">
        <label>=</label>
      </div>
      <div class="col">
        <label>{$ri}<br>
        Remaining</label>
      </div>
    </div>
  </div>
  INTERFACE;

  echo <<<NAV
  <nav class="navbar navbar-default" id="UserNav">
    <span class="container-fluid">
    <ul class="nav nav-pills navbar-right">
          <li class="nav-item">
            <a class="nav-link" href="home.php">
              <img src="img/home.png" width="80" alt="Home nav button">  
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="diary.php">
              <img src="img/diary.png" width="80" alt="Diary nav button">  
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="recipes.php">
              <img src="img/recipes.png" width="80" alt="Recipes nav button">  
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="me.php">
              <img src="img/me.png" width="80" alt="Me nav button"> 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="support.php">
              <img src="img/support.png" width="80" alt="Support nav button">  
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sign_out.php">
              <img src="img/signOut.png" width="80" alt="Sign Out nav button">  
            </a>
          </li>
        </ul>
    </span>
  </nav>
  NAV;
}

// Sign-in interface
elseif ($_SERVER['REQUEST_URI'] != $path .'sign_up.php' && 
$_SERVER['REQUEST_URI'] != $path .'tos.php') {
  include 'verify.php';
  $show_signin_form = false;
  
  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"caloriecounter");
  
  if (!$connection) {
    die("Connection failed: " . $mysqli_connect_error);
  }
  
  if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
  
    $error1 = validateString($username, 1, 16);
    $error2 = validateString($password, 1, 16);
    $errors = $error1.$error2;
      
    if ($errors == "") {
      $username = sanitise($username,$connection);
      $password = sanitise($password,$connection);
      $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
      $query_run = mysqli_query($connection,$query);

      if(mysqli_num_rows($query_run)) {
        $_SESSION['username'] = $_POST['username'];
        while($row = mysqli_fetch_assoc($query_run)) {
          $_SESSION['uid'] = $row['uid'];
          echo "<script> window.location.href = 'home.php';</script>";
        }
      }
    } 
    
    else {
      echo "<script>alert('Please Enter correct Username and Password');
      </script>";
    } 
    mysqli_close($connection);
  } 

  
  if (isset($_SESSION['uid'])) {
    echo 'You are already logged in, please log out first.<br>
    <a href="sign_out.php" type="button" class="btn btn-success btn-block testButton">Logout</a><br>';
  } 
  
  else {
      $show_signin_form = true;
  }

  if ($show_signin_form) {
    echo <<<LOGIN
      <div class="container-fluid" id="loginHeader">
        <legend class="title"><b>Welcome to The Calorie Counter</b></legend> 
        <i>Get started with your health journey!</i>
      </div>

      <fieldset>
        <div class="container-fluid" id="login">
          <div class="col-md-4 m-auto block"><br>
            <center><h4>Login</h4></center>
            
            <hr>
            
            <form action="home.php" method="post">
              <div class="row">
                <div class="col">
                  <label>Username:</label><br>
                  <label>Password:</label><Br>
                </div>

                <div class="col">
                  <div class="edit">
                    <div class="myInfo">
                      <input class="form-control" type="text" minlength="1" maxlength="16" name="username" 
                      placeholder="Enter your Username" required>
                      <input class="form-control" type="password" minlength="1" maxlength="16" name="password" 
                      placeholder="Enter your Password" required>
                      <br>
                    </div>    
                  </div>
                </div><br><br>

              </div>

              <div class="row">
                <button class="btn btn-primary" type="submit" name="login" width=100%>Login</button>
              </div>
            </form><br>
                  
            <span>Not registered? <a href="sign_up.php">Click here to sign up</a></span>
          </div><br>
        </div>
      </fieldset>
    LOGIN;
  }
}
elseif ($_SERVER['REQUEST_URI'] != $path .'tos.php') {
  include 'verify.php';

  $show_signup_form = true;

  $connection = mysqli_connect("localhost","root","");
  $db = mysqli_select_db($connection,"caloriecounter");

  if(isset($_POST['sign_up'])){
    $show_signup_form = false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $start_weight = $_POST['start_weight'];
    $current_weight = $_POST['start_weight'];
    $goal_weight = $_POST['goal_weight'];
    $height = $_POST['height'];
    $unit1 = $_POST['unit1'];
    $unit2 = $_POST['unit2'];


    $username = sanitise($username,$connection);
    $password = sanitise($password,$connection);
    $firstname = sanitise($firstname,$connection);
    $lastname = sanitise($lastname,$connection);
    $email = sanitise($email,$connection);
    $age = sanitise($age,$connection);
    $gender = sanitise($gender,$connection);
    $start_weight = sanitise($start_weight,$connection);
    $current_weight = sanitise($current_weight,$connection);
    $goal_weight = sanitise($goal_weight,$connection);
    $height = sanitise($height,$connection);
    $unit1 = sanitise($unit1,$connection);
    $unit2 = sanitise($unit2,$connection);
    $error1 = validateString($username, 1, 32);
    $error2 = validateString($password, 1, 64);
    $error3 = validateString($firstname, 1, 64);
    $error4 = validateString($lastname, 1, 64);
    $error5 = validateEmail($email, 1, 128);
    $error6 = validateString($age, 1, 3);
    $error7 = validateString($gender, 1, 6);
    $error8 = validateString($start_weight, 1, 3);
    $error9 = validateString($current_weight, 1, 3);
    $error10 = validateString($goal_weight, 1, 3);
    $error11 = validateString($height, 1, 3);
    $error12 = validateString($unit1, 1, 3);
    $error13 = validateString($unit2, 1, 3);
    $errors = $error1.$error2.$error3.$error4;$error5.$error6.$error7.$error8.$error9.$error10.$error11.$error12.$error13;

    if (!$errors) {
      
      $query = "INSERT INTO users VALUES(null,'$username','$password','$firstname','$lastname','$email','$age','$gender','$start_weight','$current_weight','$goal_weight','$height','$unit1','$unit2',null,null,null,null)";
      
      $query_run = mysqli_query($connection,$query);
      if($query_run){
        echo "<script>alert('You have signed up!...You can now login.');
        window.location.href = 'home.php';
        </script>";
      }
      else{
        echo "<script>alert('Your registration has failed. {$errors} Please try again.');
        window.location.href = 'sign_up.php';
        </script>";
      }
       mysqli_close($connection);
    }
  }

  if ($show_signup_form) {
    echo <<<SIGNUP
    
    <div class="container-fluid" id="loginHeader">
      <legend class="title"><b>Welcome to The Calorie Counter</b></legend> 
      <i>Get started with your health journey!</i>
    </div>

    <fieldset>
    <div class="container-fluid" id="login">
      <div class="col-md-4 m-auto block"><br>
        <center><h4>Sign Up</h4></center>

            <hr>

            <form action="home" method="post">
              <div class="row">
                <div class="col">
                  <label>Username:</label><br>
                  <label>Password:</label><br>
                  <label>First Name:</label><br>
                  <label>Last Name:</label><br>
                  <label>Email:</label><br>
                  <label>Age:</label><br>
                  <label>Gender:</label><br>
                </div>
              
                <div class="col">
                  <div class="edit">
                    <div class="myInfo">
                      <input class="form-control" type="text" minlength="1" maxlength="32" name="username" 
                      placeholder="Enter your username" required>
                      <input class="form-control" type="password" minlength="1" maxlength="64" name="password" 
                      placeholder="Enter your Password" required>
                      <input class="form-control" type="text" minlength="1" maxlength="64" name="firstname" 
                      placeholder="Enter your First Name" required>
                      <input class="form-control" type="text" minlength="1" maxlength="64" name="lastname" 
                      placeholder="Enter your Last Name" required>
                      <input class="form-control" type="email" minlength="1" maxlength="128" name="email" 
                      placeholder="Enter your email" required>
                      <input class="form-control" type="number" minlength="1" maxlength="3" name="age" 
                      placeholder="Enter your age" required>
                      <select name="gender" id="gender">
                          <option value="" selected disabled hidden>Select your Gender</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option><br>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col">
                  <label for="weight">Weight:</label><br>
                </div>
                
                <div class="col">
                  <div class="edit">
                    <div class="myInfo">
                      <input class="form-control" type="number" minlength="1" maxlength="3" name="start_weight" 
                      placeholder="Enter your weight in kg" required><br>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <select name="unit1" id="weight">
                      <option value="kg">kg</option>
                      <option value="lb">lb</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <label for="feet">Goal Weight:</label><br>
                </div>
                
                <div class="col">
                  <div class="edit">
                    <div class="myInfo">
                      <input class="form-control" type="number" minlength="1" maxlength="2" name="goal_weight" 
                      placeholder="Enter your height in feet" required><br>
                    </div>
                  </div>
                </div>

                <div class="col">
                
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <label for="inches">Height:</label><br>
                </div>
                
                <div class="col">
                  <div class="edit">
                    <div class="myInfo">
                      <input class="form-control" type="number" minlength="1" maxlength="2" name="height" 
                      placeholder="Enter your height in inches" required><br>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <select name="unit2" id="height">
                      <option value="cm">cm</option>
                      <option value="ft">Feet/Inches</option>
                  </select>
                </div>
              </div>

              <hr>

              <div class="row">

                <p>By clicking Sign Up, you agree to our Terms and that have read our Data Policy, including your Cookie use.<p>
                

                <input type="checkbox" id="TickBox" name="TickBox" value="checkbox">
                <label for="vehicle1">I have read and Accept  the <a href="tos.php"> Terms of Service</a></label><br>
              </div>

              <div class="row">
                <button class="btn btn-primary" type="submit" name="sign_up">Sign Up</button>
              </div>          
            </form><br>

            <span>Already registered? <a href="home.php">Click here to sign in</a></span>

          </div>
        </div>
      </div>
    </fieldset>
  SIGNUP;
  }
}

else {
  echo <<<TOS
    <div class="container-fluid" id="login">
      <div class="col-md-4 m-auto block"><br>
        <center><h4>Terms of Service</h4></center>

        <hr>
            
        <h4><b>MyFitnessFriend Terms and Conditions of Use</b></h4>
        Effective Date: 30 April 2022
        <p><i> Welcome to MyFitnessFriend. These Terms and Conditions of Use apply and govern your use of our website 
        and mobile application (the “App”) and are designed to create a positive, law-abiding community of our users. 
        By using MyFitnessFriend, you are agreeing to all the terms and conditions below.</i></p>

        <p>MyFitnessFriend, Inc. and any successor entity (referred to throughout as “MyFitnessFriend,” “we” or “us”), 
        offers a variety of content and services through the MyFitnessFriend website and App (collectively, the “Services”).</p>

        <p>THESE TERMS INCLUDE A BINDING ARBITRATION CLAUSE AND A CLASS ACTION WAIVER IN SECTION 14. THIS PROVISION 
        AFFECTS YOUR RIGHTS TO RESOLVE DISPUTES WITH MYFITNESSFRIEND AND YOU SHOULD REVIEW IT CAREFULLY. YOUR CHOICE 
        TO MAINTAIN AN ACCOUNT, ACCESS OR USE THE SERVICES (REGARDLESS OF WHETHER YOU CREATE AN ACCOUNT WITH US) 
        CONSTITUTES YOUR AGREEMENT TO THESE TERMS AND OUR PRIVACY POLICY, WHICH IS INCORPORATED INTO THE TERMS. IF YOU 
        DISAGREE WITH ANY PART OF THE TERMS, THEN YOU ARE NOT PERMITTED TO USE OUR SERVICES.</p>

        <p>Please note the summaries in shaded boxes at the top of most sections are provided to make the Terms easier to 
        understand. In the event of a conflict between any summary and any section of the Terms, the Terms will control.</p>
        
        <h4>1. Use of the Services and Your Account<h4>
        <h5>1.1 Who can use the Services</h5>

        <p>You must be at least 18 years old to use the Services.</p>

        <p>You must be at least 18 to use the Services (unless otherwise specified in the International Terms section applicable 
        to specific jurisdictions). No individual under the age of 18 may use the Services, provide any Personal Data (as 
        that term is defined in the Privacy Policy) to us, or otherwise submit Personal Data through the Services (e.g., a 
        name or email address).</p>

        <h5>1.2 Your Account</h5>

        <p><i>You may need to create a MyFitnessFriend account to access the Services, and it's important that you keep your 
        account accurate and up-to-date (particularly your email address - if you ever forget your password, a working email 
        address is often the only way for us to verify your identity and help you log back in).</i></p>

        <p>You will need to register for a MyFitnessFriend account to access or use certain Services. Your account may also 
        automatically provide you access and means to use any new Services.</p>

        <p>When you create an account for any of our Services, you must provide us with accurate and complete information as 
        prompted by the account creation and registration process, and keep that information up to date. Otherwise, some of 
        our Services may not operate correctly, and we may not be able to contact you with important notices.</p>

        <p>You are responsible for maintaining the confidentiality of any and all actions that take place while using your 
        account, and must notify our Support Team right away of any actual or suspected loss, theft, or unauthorized use of 
        your account or account password. We are not responsible for any loss that results from unauthorized use of your 
        username and password.</p>

        <p>You have the right to delete your account with us via your profile page. If you choose to permanently delete your 
        account, all Data that we have associated with your account will also be deleted.</p>

        <h5>1.3 Service Updates, Changes and Limitations</h5>

        <p><i>Our Services are constantly evolving. With the launch of new products, services, and features, we need the 
        flexibility to make changes, impose limits, and occasionally suspend or terminate certain Services. We may also update 
        our Services, which might not work properly if you don't install the updates.</i></p>

        <p>The Services change frequently, and their form and functionality may change without prior notice to you.</p>
        
        <p>We may provide updates (including automatic updates) for certain Services as and when we see fit. This may include 
        upgrades, modifications, bug fixes, patches and other error corrections and/or new features (collectively, “Updates”). 
        Certain portions of our Services may not properly operate if you do not install all Updates. You acknowledge and agree 
        that the Services may not work properly if you do not allow such Updates and you expressly consent to automatic Updates. 
        Further, you agree that the Terms (and any additional modifications of the same) will apply to any and all Updates to 
        the Services. We may change, suspend, or discontinue any or all of the Services at any time, including the availability 
        of any product, feature, database, or Content. In addition, we have no obligation to provide any Updates or to continue 
        to provide or enable any particular features or functionality of any Service. We may also impose limits on certain 
        Services or restrict your access to part or all of the Services without notice or liability.</p>

        <h5>1.4 Security</h5>

        <p><i>Please let us know right away if you believe your account has been hacked or compromised.</i></p>

        <p>We care about the security of our users. While we work hard to protect the security of your Personal Data, User-Generated 
        Content, and account, we cannot guarantee that unauthorized third parties will not be able to defeat our security measures. 
        Please notify our Support Team immediately of any actual or suspected breach or unauthorized access or use of your account.
        </i></p>

        <h4>2. Fitness and Wellness Activities and Dietary Guidance</h4>
        
        <p><i>It's important to us that users stay healthy while achieving their fitness and wellness goals. Please be responsible 
        and use your best judgment and common sense. We provide our Services for information purposes only, and can't be held liable 
        if you suffer an injury or experience a health condition. In particular, while most of the content posted by the other users 
        in our community is helpful, it is coming from strangers on the Internet and should never trump good judgment or actual medical 
        advice.</i></p>

        <h5>2.1 Safety First</h5>

        <p>MyFitnessFriend cares about your safety. You should consult with your healthcare provider(s) and consider the associated 
        risks before using our Services in connection with any fitness or wellness regimen-oriented Content or any dietary 
        program-oriented Content (“Programs”). By using our Services, you agree, represent and warrant that you have received consent 
        from your physician to participate in the Programs, or any of the related activities made available to you in connection with 
        the Services. Further, you agree, represent and warrant that you have consulted with your physician before making any dietary 
        changes based upon information available through the Services. Everyone’s condition and abilities are different, and 
        participating in the Programs and other activities promoted by our Services is at your own risk.</p>

        <p>Except as otherwise set out in these Terms, and to the maximum extent permitted by applicable law, we are not responsible 
        or liable, either directly or indirectly, for any injury, illness, or damages sustained from your use of, or inability to use, 
        any Services or features of the Services, including any Content or activities you access or learn about through our Services 
        even if caused in whole or part by the action, inaction or negligence of MyFitnessFriend or others.</p>

        <h5>2.2 Disclaimer Regarding Accuracy and Reliance on Content</h5>

        <p>We make no representations or warranties as to the accuracy, reliability, completeness or timeliness of any Content available 
        through the Services, and we make no commitment to update such Content.</p>

        <p>In addition, User-Generated Content, including advice, statements, or other information, including, without limitation, food, 
        nutrition, dietary guidance, are not produced by MyFitnessFriend, and should not be relied on without independent verification. 
        User-Generated Content, whether publicly posted or privately transmitted, is the sole responsibility of the user from whom such 
        User-Generated Content originated. All information is provided “as is” without any representation, warranty or condition as to 
        its accuracy or reliability.</p>

        <p>Not all users who may identify themselves as professional trainers or licensed dieticians are licensed in all applicable 
        jurisdictions. MyFitnessFriend has no and assumes no obligation to verify that users who identify themselves as licensed trainers 
        or dieticians are actually licensed. If you hold yourself out as a licensed trainer or dietician, you represent and warrant that 
        you are actually licensed for the services you provide in the jurisdiction in which you offer your services. Users should also 
        bear in mind that even if a user is a licensed trainer in one jurisdiction that does not mean the trainer user is licensed in the 
        jurisdiction from which other users access the trainer user’s advice. Accordingly, relying on any advice provided by other users 
        is at your own risk. To the extent permitted by applicable law, under no circumstances will MyFitnessFriend be responsible or liable 
        for any loss or damage resulting from your reliance on information or advice provided by any user of our Services.</p>

        <h5>2.3 Not Medical Advice</h5>
        
        <p>Any and all services provided by, in and/or through the Services (including but not limited to Content) are for informational 
        purposes only. MyFitnessFriend is not a medical professional, and MyFitnessFriend does not provide medical services or render medical 
        advice. Nothing contained in the Services should be construed as such advice or diagnosis. The information and reports generated 
        by us should not be interpreted as a substitute for physician consultation, evaluation, or treatment, and the information made 
        available on or through the Services should not be relied upon when making medical decisions, or to diagnose or treat a health 
        condition or illness. YOUR USE OF THE SERVICES DOES NOT CREATE A DOCTOR-PATIENT RELATIONSHIP BETWEEN YOU AND MYFITNESSFRIEND.<p>

        <p>You should seek the advice of a physician or a medical professional with any questions you may have regarding your health before 
        beginning any dietary programs or plans, exercise regimen or any other fitness or wellness activities or plans that may be referenced, 
        discussed or offered under the Services. If you are being treated for a health condition or illness, taking prescription medication 
        or following a therapeutic diet to treat a disease, you should consult with your physician before using the Services. You represent to 
        us (which representation shall be deemed to be made each time you use the Services), that you are not using the Services or participating 
        in any of the activities offered by the Services for purpose of seeking medical attention. You further agree that, before using the 
        Services, you will consult your physician, particularly if you are at risk for problems resulting from exercise or changes in your diet. 
        If any information you receive or obtain from using the Services is inconsistent with the medical advice from your physician, you should 
        follow the advice of your physician.</p>

        <p>The Support Services provide you access to certain specialized Content—namely coaching and guidance on fitness regimens and meal 
        planning (“Plans”). The Plans are not a medical or any other type of health service. No diagnosis or treatment of, or advice regarding, 
        any dietary or health condition is delivered by the Plans. The Plans are not a substitute for, and are not an alternative to healthcare 
        diagnosis and treatment when a dietary or health condition or illness is present. You should seek diagnosis, treatment and advice 
        regarding dietary or health conditions or illnesses from physicians practicing medicine and other licensed healthcare professionals. 
        Under no circumstances will any of your interactions with our Plans be deemed or construed to create a physician-patient relationship 
        or a fiduciary duty of any kind whatsoever. YOU ARE SOLELY RESPONSIBLE FOR YOUR INTERACTIONS WITH THE PLANS.</p>

        <h4>3. Modifications to the Terms</h4>
        
        <p><i>As the Services grow and improve, we might have to make changes to these Terms.</i></p>

        <h5>3.1 Updates to these Terms</h5>
        
        <p>We reserve the right to modify these Terms by (i) posting revised Terms on and/or through the Services, and/or (ii) providing 
        advance notice to you of material changes to the Terms, generally via email where practicable, and otherwise through the Services 
        (such as through a notification on the home page of the MyFitnessFriend website or in -app). Modifications will not apply retroactively 
        unless required by law.</p>

        <p>We may sometimes ask you to review and to explicitly agree to or reject a revised version of the Terms. In such cases, modifications 
        will be effective at the time of your agreement to the modified version of the Terms. If you do not agree at that time, you are not 
        permitted to use the Services. In cases where we do not ask for your explicit agreement to a modified version of the Terms, the modified 
        version of the Terms will become effective as of the date specified in the Terms. Your choice to maintain an account, access or use 
        the Services (regardless of whether you create an account with us) following that date constitutes your acceptance of the terms and 
        conditions of the Terms as modified. If you do not agree to the modifications, you are not permitted to use, and should discontinue your 
        use of, the Services.</p>

        <h4>4. No Warranties</h4>
        
        <p>EXCEPT WHERE PROHIBITED BY LAW, MYFITNESSFRIEND EXPRESSLY DISCLAIMS ALL WARRANTIES, REPRESENTATIONS AND GUARANTEES OF ANY KIND, 
        WHETHER ORAL OR WRITTEN, EXPRESS, IMPLIED, STATUTORY OR OTHERWISE, INCLUDING, BUT NOT LIMITED TO THE IMPLIED WARRANTIES OF MERCHANTABILITY, 
        FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT TO THE FULLEST EXTENT PERMISSIBLE UNDER THE LAW. THE SERVICES AND ALL CONTENT ARE 
        PROVIDED ON AN “AS IS” AND “AS AVAILABLE” WITH ALL FAULTS BASIS. Without limiting the foregoing, you understand that, to the maximum extent 
        permitted by applicable law, we make no warranty regarding the quality, accuracy, timeliness, truthfulness, completeness, availability, 
        or reliability of any of the Services or any Content. To the maximum extent permitted by applicable law, we do not warrant that (i) the 
        Services will meet your requirements or provide specific results, (ii) the operation of the Services will be uninterrupted, virus- or 
        error-free or free from other harmful elements or (iii) errors will be corrected. Any oral or written advice provided by our agents or 
        us does not and will not create any warranty. To the maximum extent permitted by applicable law, we also make no representations or 
        warranties of any kind with respect to any Content; User-Generated Content, in particular, is provided by and is solely the responsibility 
        of the users providing that Content. No advice or information, whether oral or written, obtained from other users or through the Services, 
        will create any warranty not expressly made herein. You therefore expressly acknowledge and agree that use of the Services is at your sole 
        risk and that the entire risk as to satisfactory quality, performance, accuracy and effort is with you.</p>
        
        <h4>5. Limitation of Liability</h4>

        <p><i>We are building the best Services we can for you but we can't promise they will be perfect. We're not liable for various things 
        that could go wrong as a result of your use of the Services.</i></p>

        <p>To the maximum extent permitted by applicable law, under no circumstances (including, without limitation, negligence) shall 
        MyFitnessFriend be liable to you or any third party for (a) any indirect, incidental, special, reliance, exemplary, punitive, or 
        consequential damages of any kind whatsoever; (b) loss of profits, revenue, data, use, goodwill, or other intangible losses; (c) damages 
        relating to your access to, use of, or inability to access or use the Services; (d) damages relating to any conduct or Content of any 
        third party or user of the Services, including without limitation, defamatory, offensive or illegal conduct or content; and/or (e) damages 
        in any manner relating to any Third-Party Content or Third-party Products accessed or used via the Services. To the maximum extent permitted 
        by applicable law, this limitation applies to all claims, whether based on warranty, contract, tort, or any other legal theory, whether or 
        not MyFitnessFriend has been informed of the possibility of such damage, and further where a remedy set forth herein is found to have 
        failed its essential purpose. To the maximum extent permitted by applicable law, the total liability of MyFitnessFriend, for any claim under 
        these Terms, including for any implied warranties, is limited to the greater of five hundred pounds (gbp £500.00) or the amount you paid us 
        to use the applicable Service(s) in the past twelve months.</p>

        <p>In particular, to the extent permitted by applicable law, we are not liable for any claims arising out of (a) your use of the Services, 
        (b) the use, disclosure, display, or maintenance of a user’s Personal Data, (c) any other interactions with us or any other users of the 
        Services, even if we have been advised of the possibility of such damages, or (d) other Content, information, services or goods received 
        through or advertised on the Services or received through any links provided with the Services.</p>

        <p>To the extent permitted by applicable law, you acknowledge and agree that we offer the Services and set the Services’ prices in reliance 
        upon the warranty disclaimers, releases, and limitations of liability set forth in the Terms, that these warranty disclaimers, releases, and 
        limitations of liability reflect a reasonable and fair allocation of risk between you and form an essential basis of the bargain between you 
        and us. We would not be able to provide the Services to you on an economically reasonable basis without these warranty disclaimers, releases, 
        and limitations of liability.</p>

        <h4>6. Indemnification</h4>
        
        <p>To the maximum extent permitted by applicable law, you agree to indemnify and hold MyFitnessFriend harmless from any claim or demand, 
        including reasonable accounting and attorneys’ fees, made by any third party due to or arising out of (a) the User-Generated Content you 
        access or share through the Services; (b) your use of the Services, (c) your activities in connection with the Services, (d) your connection 
        to the Services, (e) your violation of these Terms, (f) your use or misuse of any user’s Personal Data, (g) any violation of the rights 
        of any other person or entity by you, or (h) your employment of the Services to meet another user in person. We reserve the right, at your 
        expense, to assume the exclusive defence and control of any matter for which you are required to indemnify us under the Terms, and you agree 
        to cooperate with our defence of these claims.</p>
    </div>
  </div>
  TOS;
}

?>

<div class="container">
    <h1 class="mt-4 mb-3">Login</h1>
    <?php
    if($_POST){
      // FORM HAS BEEN POSTED - CHECK LOGIN CREDENTIALS
        
        //post params
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        //attempt login
        $stmt = $dbc->prepare("SELECT COUNT(*)FROM users WHERE email = :email");
        $stmt->bindValue(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
        $num_rows = $stmt->fetchColumn();
        
        if($num_rows==1){
            //valid email - test password
            //echo "Valid email!";
            //test actual login email & password pair
            $stmt = $dbc->prepare("SELECT pass FROM users
                                   WHERE email = :email");
            $stmt->bindValue(':email',$email,PDO::PARAM_STR);
            $stmt->execute();
            $row= $stmt->fetchColumn();
            
            //var_dump($row);
            //exit();
            if(password_verify($password, $row)){
                //echo "Valid password";
            }else{
                //echo "Invalid password";
            }
            exit();
        }else{
            //invalid email - show message
            //echo "Invalid email!";
        }
        exit();
        
        $success = true; // testing purposes only
        if($success){
            // Login success
            // For testing only - fictional user
            $_SESSION['user_id'] = 1; // pretend user id 1 is logged in
            $_SESSION['user_not_expired'] = true; // pretend user account is valid
            
            $_SESSION['admin'] = true; // pretend the admin user is logged in
            
            // show success and redirect user back to home page (countdown)
            //header('location: index.php');
            echo "<div class='alert alert-success' role='alert'>
                    <strong>Login Success</strong>
                    <p>You will be redirected to the homepage in <span id='count'></span> seconds...</p>
                  </div>";
            echo "<script> 
                var delay = 5;
                var url = 'index.php';
                function countdown(){
                    setTimeout(countdown,1000);
                    $('#count').html(delay);
                    delay --;
                    if(delay <0){
                        window.location = url;
                        delay = 0;
                    }
                }
                countdown();
                </script>";
            
            
        }else{
            // Login failure - show alert message
            echo "<div class='alert alert-danger' role='alert'>
                    <strong>Login Failed</strong>
                    <p>Invalid credentials entered, please try again</p>
                  </div>";
        }
    }
    
    ?>
            <div class="nav justify-content-center">
            <i class="fas fa-user-secret fa-5x"></i>
        </div>
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Please sign in</div>
                <div class="card-body">
                    <form method="post" action="login.php" novalidate>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input class="form-control" id="email" name="email" 
                                   type="email" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input class="form-control" id="password" name="password"
                                   type="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"> Remember Password</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                    <div class="text-center">
                        <a class="d-block small mt-3" href="register.php">Register an Account</a>
                        <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
                    </div>
            </div>
        </div>
    <div class="mt-4">&nbsp;</div>
</div>

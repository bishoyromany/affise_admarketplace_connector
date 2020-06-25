<?php
    require_once __DIR__.'/../backend/helpers.php';
    require_once __DIR__.'/../backend/DB.php';
    $base = getConfig('base');

    $error = '';
    /**
     * hadnle login
     */
    if(isset($_POST['serve'])){
        $firstname = isset($_POST['firstname']) && !empty($_POST['firstname']) ? filter_var($_POST['firstname'], FILTER_SANITIZE_STRING) : false;
        $lastname = isset($_POST['lastname']) && !empty($_POST['lastname']) ? filter_var($_POST['lastname'], FILTER_SANITIZE_STRING) : false;
        $email = isset($_POST['email']) && !empty($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_STRING) : false;
        $password = isset($_POST['password']) && !empty($_POST['password']) ? sha1($_POST['password']) : false;
        if(!$firstname){ $error = 'Make Sure to write Your First Name'; }
        if(!$lastname){ $error = 'Make Sure to write Your Last Name'; }
        if(!$email){ $error = 'Make Sure to write Your Email'; }
        if(!$password){ $error = 'Make Sure to write Your Password'; }
        if(empty($error)){
            $db = new DB();
            $prefix = $db->getPrefix();
            $checker = $db->query("SELECT * FROM `".$prefix."users` WHERE `email` = '$email'");
            if(!empty($checker)){
                $error = "Email Already Exist";
            }else{
                $query = $db->query("INSERT INTO `".$prefix."users` (firstname, lastname, email, password) VALUES('$firstname', '$lastname', '$email', '$password')");
                if(!empty($query) && $query){
                    header("LOCATION: $base"."/user/signin.php?target=login");
                }else{
                    $error = 'Something Went Wrong While Signing Up, Please Try Again Later';
                }
            }
        }
    }

    if(isLogged()){ header("LOCATION: $base"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
        .content{
            margin-top : 100px;
        }
        h3{
            margin-bottom : 40px;
        }
        form{
            padding : 20px;
            background-color : #f2f2f2f2;
            border : 1px solid #CCC;
            border-radius : 10px;
        }
    </style>
</head>
<body>
    <?php require_once __DIR__.'/../backend/navbar.php'; ?>
    
    <div class="contant" style="margin-top: 100px;">
        <h3 class="text-center" style="margin-bottom: 40px;">Signup</h3>
        <div class="container">
            <div class="col-md-6 offset-3">
                <form method="POST">
                    <!-- sub1 value for admarketplace -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="sub1">First Name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="firstname" value="" id="firstname" class="form-control" placeholder="Write Your First Name">
                            </div>
                        </div>
                    </div>

                    <!-- sub1 value for admarketplace -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="sub1">Last Name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="lastname" value="" id="lastname" class="form-control" placeholder="Write Your Last Name">
                            </div>
                        </div>
                    </div>

                    <!-- sub1 value for admarketplace -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="sub1">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input type="email" name="email" value="" id="email" class="form-control" placeholder="Write Your Login Email">
                            </div>
                        </div>
                    </div>

                    <!-- sub1 value for admarketplace -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="password">Password</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" name="password" value="" id="password" class="form-control" placeholder="Write Your Password">
                            </div>
                        </div>
                    </div>

                    <!-- start the script value, must be 1 to start the script -->
                    <input type="hidden" name="serve" value="1">
                    <!-- submit button -->
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <button class="btn btn-success btn-block">Signup</button>
                        </div>
                        <div class="col-md-12 text-center">
                            <a href="<?php echo $base; ?>/user/signin.php?target=signin">Sign in</a>
                        </div>
                    </div>
                </form> 
                <?php 
                    if(!empty($error)){ echo "<div class='alert alert-danger'>$error</div>"; }
                ?>
            </div>
        </div>

    </div>

    <?php require_once __DIR__.'/../boostrap.html'; ?>
</body>
</html>
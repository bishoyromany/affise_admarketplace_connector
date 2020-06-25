<?php
    require_once __DIR__.'/../backend/helpers.php';
    require_once __DIR__.'/../backend/DB.php';
    $base = getConfig('base');

    $error = '';
    /**
     * hadnle login
     */
    if(isset($_POST['serve'])){
        $email = isset($_POST['email']) && !empty($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_STRING) : false;
        $password = isset($_POST['password']) && !empty($_POST['password']) ? sha1($_POST['password']) : false;
        if(!$email){ $error = 'Make Sure to write Your Email'; }
        if(!$password){ $error = 'Make Sure to write Your Password'; }
        if(empty($error)){
            $db = new DB();
            $prefix = $db->getPrefix();
            $query = $db->query("SELECT * FROM `".$prefix."users` WHERE `email` = '$email' AND `password` = '$password' AND `isActive` = 1 LIMIT 1");
            if(!empty($query)){
                $_SESSION['logged_in'] = $query[0]['id'];
            }else{
                $error = 'Email Or Password Is Wrong';
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
        <h3 class="text-center" style="margin-bottom: 40px;">Login</h3>
        <div class="container">
            <div class="col-md-6 offset-3">
                <form method="POST">
                    <!-- sub1 value for admarketplace -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="sub1">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="email" value="" id="email" class="form-control" placeholder="Write Your Login Email">
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
                            <button class="btn btn-success btn-block">Login</button>
                        </div>
                        <div class="col-md-12 text-center">
                            <a href="<?php echo $base; ?>/user/signup.php?target=signup">Sign Up</a>
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
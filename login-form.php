<?php require_once("function.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/login.css">
    <title>Static Login</title>
</head>
<body>
    <div class="container">   
        <?php 
            if(isset($_POST['btnLogin'])){
                $con = openConnection();
                $username = CleanInput($con, $_POST['txtUsername']);
                $password = md5(CleanInput($con, $_POST['txtPassword']));

                $strSql = "
                        SELECT * FROM tbl_user
                        WHERE username = '$username'
                        AND password = '$password'
                ";
                login($con, $strSql);

                closeConnection($con);
            }

        ?>
        <div class="card card-container">  
            <i class="fa-solid fa-user text-center fa-5x"></i>
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post">
                <input type="text" name="txtUsername" id="txtUsername" class="form-control" placeholder="User Name" required autofocus>
                <input type="password" name="txtPassword" id="txtPassword" class="form-control" placeholder="Password" required>                
                <button name="btnLogin" class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Log in</button>
            </form><!-- /form -->            
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
<?php
    DEFINE("DB_SERVER", "localhost");
    DEFINE("DB_USERNAME", "root");
    DEFINE("DB_PASSWORD", "");
    DEFINE("DB_NAME", "shopping_db_cart");

    function openConnection(){
        $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if($con == false)
            die("ERROR: Could not connect to the Database");
        return $con;
    }
    function closeConnection($con){
        mysqli_close($con);
    }
    function login($con, $strSql){
        if($rsLogin = mysqli_query($con, $strSql)){
            if(mysqli_num_rows($rsLogin) > 0){
                header("location: dashboard.php");
                mysql_free_result($rsLogin);
            }
            else
                echo '
                    <div class="alert alert-danger alert-dismissible fade show col-4 offset-4 mt-5" role="alert">
                        <strong>Invalid Username/Password!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ';
        }
        else
            die("ERROR: Could not execute query");
    }
    function CleanInput($con, $input){
        return mysqli_real_escape_string($con, stripslashes(htmlspecialchars($input)));
    }
?>
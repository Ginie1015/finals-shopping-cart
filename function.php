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
    function validatePass($con, $strSql, $new, $confirm){
        if($rsLogin = mysqli_query($con, $strSql)){
            if(mysqli_num_rows($rsLogin) > 0){
                if($new == $confirm){
                    header("location: logout.php");
                    mysql_free_result($rsLogin);
                }
                else
                    echo '
                        <div class="alert alert-danger alert-dismissible fade show col-4 offset-4 mt-5" role="alert">
                            <strong>Password Mismatch!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    ';
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
    function getRecord($con, $strSql){
        $arrRec = [];
        $i = 0;

        if($rs = mysqli_query($con, $strSql)){
            if(mysqli_num_rows($rs) == 1){
                $rec = mysqli_fetch_array($rs);
                foreach ($rec as $key => $value) {
                    $arrRec[$key] = $value;
                }
            }
            elseif (mysqli_num_rows($rs) > 1) {
                while($rec = mysqli_fetch_array($rs)){
                    foreach ($rec as $key => $value) {
                        $arrRec[$i][$key] = $value;
                    }
                    $i++;
                }
            }
            mysqli_free_result($rs);
        }
        else
            die("ERROR: Could not execute your request!");
        return $arrRec;
    }
?>
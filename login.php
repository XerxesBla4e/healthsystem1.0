<?php include('config/constants.php');?>
<?php include('connection/conn1.php'); ?>
<html>
    
    <head>
        <title>Login-Patient Record System</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class="log">
           <h1 class="text-center ">Login Page</h1><br \><br \>
           <?php
              if(isset($_SESSION['login'])){
                  echo $_SESSION['login'];
                  unset($_SESSION['login']);
              }

              if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
               
           ?>
          <!--login form starts here-->
           <form action="#" method="POST" class="text-center login-des">
             Username:<br \>
             <input type="text" name="username" placeholder="Enter Username"><br \>
             Password:<br \>
             <input type="password" name="password" placeholder="Enter Password"><br \><br \>
             <input type="submit" name="submit" value="Login" class="btn-primary"><br \>
           </form>
           <!--login form ends here-->
           <br \><br \>
           <p class="text-center">Created By-<a href="www.xerxescodes.com">Patience Arinaitwe</a></p>
        </div>
    </body>
</html>

<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM accounts WHERE Username='$username' AND Password='$password'";
    $res = mysqli_query($conn,$sql);
    
    if($res==TRUE){
        $row = mysqli_fetch_assoc($res);
        $id = $row['role_id'];

        if($id == 1){
            $_SESSION['login']="<div class='success text-center'>Login Successful</div>";
            $_SESSION['user']=$username;
            header("location:".HOMEURL.'admin/Admin.php');
        }elseif($id == 2){
            $_SESSION['login']="<div class='success text-center'>Login Successful</div>";
            $_SESSION['user']=$username;
            header("location:".HOMEURL.'doctor/Doctor.php');
        }elseif($id == 3){
            $_SESSION['login']="<div class='error text-center'>Login Successful</div>";
            $_SESSION['user']=$username;
            header("location:".HOMEURL.'Nurse/Nurse.php');
        }
        elseif($id == 4){
            $_SESSION['login']="<div class='error text-center'>Login Successful</div>";
            $_SESSION['user']=$username;
            header("location:".HOMEURL.'LabTech/Patient.php');
        }else{
            $_SESSION['login']="<div class='error text-center'>Login Failed</div>";
            header("location:".HOMEURL.'login.php');
        }
    }

}

?>
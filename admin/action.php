<?php
include('../connection/conn.php');

 $update = false;

 $id = "";
 $photo="";
 $name ="";
 $email = "";
 $phone = "";
 $role = "";


 if(isset($_POST['add'])){
     $name = $_POST['name'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     $role = $_POST['roles'];
   
     $photo = $_FILES['image']['name'];
     $upload = "users_profiles/".$photo;

        $exec = $connect->prepare("INSERT INTO users(name,email,phone,role,image) VALUES(?,?,?,?,?)");
        $exec->bind_param('sssss',$name,$email,$phone,$role,$upload);

        if($exec->execute()){
            echo "success";
        }else{
            echo "Fail";
        }

     $success = move_uploaded_file($_FILES['image']['tmp_name'],$upload);
     
     $to = $success?"Admin.php":"Failed" ;
     header("Location:".$to);

     $_SESSION['response'] = "Successfully inserted User Record";
     $_SESSION['res_type'] = "success"; 
 }

 if(isset($_GET['delete'])){
     $id = $_GET['delete'];

     $exec = $connect->prepare("SELECT image FROM users WHERE id=?");
     $exec->bind_param('i',$id);
     $exec->execute();
     $res = $exec->get_result();
     $rows = $res->fetch_assoc();

    $image_url = $rows['image'];
  
     $path = unlink($image_url);


     $exec1 = $connect->prepare("DELETE FROM users WHERE id=?");
     $exec1->bind_param('i',$id);
     $exec1->execute();
     
     $scs = $exec1?"Admin.php":"Failed";
     header("Location:".$scs);
     $_SESSION['response'] = "Successfully Deleted User Record";
     $_SESSION['res_type'] = "danger"; 

 }

 if(isset($_GET['edit'])){
     $id = $_GET['edit'];

     $exec = $connect->prepare("SELECT * FROM users WHERE id=?");
     $exec->bind_param('i',$id);
     $exec->execute();
     $res = $exec->get_result();
     
     while($row = $res-> fetch_assoc())
     {
        $id = $row['id'];
        $photo = $row['image'];
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $role = $row['role'];

        $update = true;
    }
 }

 if(isset($_POST['update'])){

     $id = $_POST['id'];
     $name = $_POST['name'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     $role = $_POST['roles'];
     $old_image = $_POST['oldimage'];

     if(isset( $_FILES['image']['name'])&&($_FILES['image']['name'])!= ""){
        $new_img ="users_profiles/".$_FILES['image']['name'];
            unlink($old_image);
            move_uploaded_file($_FILES['image']['tmp_name'],$new_img);
     }else{
        $new_img =  $old_image ;
     }

     $exec = $connect->prepare("UPDATE users SET name=?,email=?,phone=?,role=?, image=? WHERE id=?");
     $exec->bind_param('sssssi',$name,$email,$phone,$role,$new_img,$id);
     $stmt = $exec->execute();
     
     $scs = $stmt?"Admin.php":"Failed" ;
     header("Location:".$scs);
     $_SESSION['response'] = "Successfully Updated User Record";
     $_SESSION['res_type'] = "primary";

 }

 if(isset($_GET['details'])){
     $id = $_GET['details'];

     $exec = $connect->prepare("SELECT * FROM users WHERE id=? and refer ='nurse'");
     $exec->bind_param('i',$id);
     $exec->execute();
     $res = $exec->get_result();
     
     while($row = $res-> fetch_assoc())
     {
        $vid = $row['id'];
        $vphoto = $row['image'];
        $vname = $row['name'];
        $vemail = $row['email'];
        $vphone = $row['phone'];
        $vrole = $row['role'];
 }
}
?>
<?php
include('../connection/conn.php');

 $update = false;

 $id = "";
 $photo = "";
 $name = "";
 $location = "";
 $diagnosis = "";
 $prescription = "";
 $refer = "";
 $next_visit = "";


 if(isset($_POST['add'])){
     $name = $_POST['name'];
     $location = $_POST['location'];
     $diagnosis = $_POST['diagnosis'];
     $prescription = $_POST['prescription'];
     $refer = $_POST['refer'];
     $next_visit = $_POST['nextvisit'];
   
     $photo = $_FILES['image']['name'];
     $upload = "patient_image/".$photo;

        $exec = $connect->prepare("INSERT INTO patient(name,location,diagnosis,prescription,refer,next_visit,image) VALUES(?,?,?,?,?,?,?)");
        $exec->bind_param('sssssss',$name,$location,$diagnosis,$prescription,$refer,$next_visit,$upload);

        if($exec->execute()){
            echo "success";
        }else{
            echo "Fail";
        }

     $success = move_uploaded_file($_FILES['image']['tmp_name'],$upload);
     
     $to = $success?"Doctor.php":"Failed" ;
     header("Location:".$to);

     $_SESSION['response'] = "Successfully inserted Patient Record";
     $_SESSION['res_type'] = "success"; 
 }

 if(isset($_GET['delete'])){
     $id = $_GET['delete'];

     $exec = $connect->prepare("SELECT image FROM patient WHERE id=?");
     $exec->bind_param('i',$id);
     $exec->execute();
     $res = $exec->get_result();
     $rows = $res->fetch_assoc();

    $image_url = $rows['image'];
  
     $path = unlink($image_url);


     $exec1 = $connect->prepare("DELETE FROM patient WHERE id=?");
     $exec1->bind_param('i',$id);
     $exec1->execute();
     
     $scs = $exec1?"Doctor.php":"Failed";
     header("Location:".$scs);
     $_SESSION['response'] = "Successfully Deleted Patient Record";
     $_SESSION['res_type'] = "danger"; 

 }

 if(isset($_GET['edit'])){
     $id = $_GET['edit'];

     $exec = $connect->prepare("SELECT * FROM patient WHERE id=?");
     $exec->bind_param('i',$id);
     $exec->execute();
     $res = $exec->get_result();
     
     while($row = $res-> fetch_assoc())
     {
        $id = $row['id'];
        $photo = $row['image'];
        $name = $row['name'];
        $location = $row['location'];
        $diagnosis = $row['diagnosis'];
        $prescription = $row['prescription'];
        $refer = $row['refer'];
        $next_visit = $row['next_visit'];

        $update = true;
    }
 }

 if(isset($_POST['update'])){

    $id = $_POST['id'];
    $photo = $_POST['image'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $diagnosis = $_POST['diagnosis'];
    $prescription = $_POST['prescription'];
    $refer = $_POST['refer'];
   // $next_visit = $_POST['nextvisit'];
    $old_image = $_POST['oldimage'];

    if(isset( $_FILES['image']['name'])&&($_FILES['image']['name'])!= ""){
        $new_img ="patient_image/".$_FILES['image']['name'];
            unlink($old_image);
            move_uploaded_file($_FILES['image']['tmp_name'],$new_img);
     }else{
        $new_img =  $old_image ;
     }

     $exec = $connect->prepare("UPDATE patient SET name=?,location=?,diagnosis=?,prescription=?,refer=?,image=? WHERE id=?");
     $exec->bind_param('ssssssi',$name,$location,$diagnosis,$prescription,$refer,$new_img,$id);
     $stmt = $exec->execute();
     
     $scs = $stmt?"Doctor.php":"Failed" ;
     header("Location:".$scs);
     $_SESSION['response'] = "Successfully Updated Patient Record";
     $_SESSION['res_type'] = "primary";


 }

 if(isset($_GET['pdetails'])){
     $id = $_GET['details'];

     $exec = $connect->prepare("SELECT * FROM patient WHERE id=?");
     $exec->bind_param('i',$id);
     $exec->execute();
     $res = $exec->get_result();
     
     while($row = $res-> fetch_assoc())
     {

        
    $vid = $row['id'];
    $vphoto = $row['image'];
    $vname = $row['name'];
    $vlocation = $row['location'];
    $vdiagnosis = $row['diagnosis'];
    $vprescription = $row['prescription'];
    $vrefer = $row['refer'];
    $vnext_visit = $row['next_visit'];
 }
}

if(isset($_GET['view'])){
$id = $_GET['view'];

$exec = $connect->prepare("SELECT * FROM patient WHERE id=?");
$exec->bind_param('i',$id);
$exec->execute();
$res = $exec->get_result();

while($row = $res-> fetch_assoc())
{
    $filepath = $row['patientfile'];
    
    $file = "../".$filepath;
    $document = file_get_contents($file);

    $ln = explode("\n",$document);

    foreach($ln as $newln){
        echo $newln."<br>";
    }
    

}
}
?>
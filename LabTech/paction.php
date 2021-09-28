<?php
include('../connection/conn.php');

 $id = "";
 $name = "";
 $refer = "";

 if(isset($_GET['edit'])){
     $id = $_GET['edit'];

     $exec = $connect->prepare("SELECT * FROM patient WHERE id=?");
     $exec->bind_param('i',$id);
     $exec->execute();
     $res = $exec->get_result();
     
     while($row = $res-> fetch_assoc())
     {
        $id = $row['id'];
        $name = $row['name'];
        $refer = $row['refer'];
    }
 }

 if(isset($_POST['update'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $refer = $_POST['refer'];
    $results = $_POST['tests'];
    
    $myfile = fopen($name."."."txt","w") or die("Unable to open file!");
    fwrite($myfile,$results);

     $myf = "LabTech/".$name."."."txt";
     $exec = $connect->prepare("UPDATE patient SET name=?,refer=?,patientfile=? WHERE id=?");
     $exec->bind_param('sssi',$name,$refer,$myf,$id);
     $stmt = $exec->execute();
     
     $scs = $stmt?"Patient.php":"Failed" ;
     header("Location:".$scs);
     $_SESSION['response'] = "Successfully Updated Patient Test Results";
     $_SESSION['res_type'] = "primary";

     fclose($myfile);

 }
?>
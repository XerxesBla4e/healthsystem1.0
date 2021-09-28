
<?php include("paction.php");  ?>
<?php include ('../login-check.php');?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">HealthSystem</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="Doctor.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Content</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="report.php">Report</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../logout.php">Logout</a>
        </li>
        </ul>
    </div>

    <form class="form-inline" action="/action_page.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center mt-2">Nyamitanga Health Center 3</h3>
                <hr>
                <?php if(isset($_SESSION['response'])){?>
                <div class="alert alert-<?= $_SESSION['res_type']; ?>
                      alert-dismissible text-center">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?=$_SESSION['response']; ?> 
                </div>
                <?php } unset($_SESSION['response']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
              <h3 class="text-center text-info">Admit Patient</h3>
              <form action="paction.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" value="<?=$name; ?>" placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <input type="text" name="location" class="form-control" value="<?=$location; ?>" placeholder="Enter Location">
                </div>
                <div class="form-group">
                  <input type="text" name="diagnosis" class="form-control" value="<?=$diagnosis; ?>" placeholder="Patient Diagnosis">
                </div>
                <div class="form-group">
                  <input type="text" name="prescription" class="form-control" value="<?=$prescription; ?>" placeholder="Enter Prescription">
                </div>
                <div class="form-group">
                  <input type="date" name="nextvisit" class="form-control" value="<?=$next_visit; ?>" >
                </div>
                <div class="form-group">
                  <input type="text" name="refer" class="form-control" value="<?=$refer; ?>" placeholder="Refer To">
                </div>
                <div class="form-group">
                 <input type="hidden" name="oldimage" value="<?=$photo; ?>">
                  <input type="file" name="image" class="custom-file">
                  <img src="<?= $photo; ?>" width="120" class="img-thumbnail">
                </div>
                <div class="form-group">
                    <?php  if($update==true){?>
                  <input type="submit" name="update" class="btn btn-success btn-block" value="Update Record">
                   <?php }else {?>
                    <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Patient Record">
                    <?php }?>
                </div>
              </form>
            </div>
            <div class="col-md-7">
                  <?php
                     $query = "SELECT * FROM patient";
                     $stmt = $connect->prepare($query);
                     $stmt->execute();
                     $result = $stmt->get_result();
                  ?>
            <h3 class="text-center text-info">Patient Records</h3>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Diagnosis</th>
                    <th>Prescription</th>
                    <th>Refered To</th>
                    <th>Next Visit</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
              <?php while($s = $result -> fetch_assoc()){?>
                <tr>
                    <td><?= $s['id'];?></td>
                    <td><img src="<?=$s['image']; ?>" alt="" width="25"></td>
                    <td><?= $s['name']; ?></td>
                    <td><?=  $s['location']; ?></td>
                    <td><?= $s['diagnosis'];?></td>
                    <td><?= $s['prescription'];?></td>
                    <td><?= $s['refer'];?></td>
                    <td><?= $s['next_visit'];?></td>
                    <td>
                        <a href="pdetails.php?pdetails=<?= $s['id']; ?>" class="badge badge-primary p-1">Details</a>
                        <a href="paction.php?delete=<?= $s['id']; ?>"class="badge badge-danger p-1"
                         onclick="return confirm('Do you want to delete this record')">Delete</a>
                        <a href="Doctor.php?edit=<?= $s['id']; ?>" class="badge badge-success p-1">Edit</a>
                        <a href="paction.php?view=<?= $s['id']; ?>" class="badge badge-success p-1">LabFile</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</body>
</html>
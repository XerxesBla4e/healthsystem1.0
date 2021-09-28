
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
            <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Content</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">About</a>
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
              <h3 class="text-center text-info">Patient Lab Results</h3>
              <form action="paction.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" value="<?=$name; ?>" placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <input type="text" name="refer" class="form-control" value="<?=$refer; ?>" placeholder="Refer To">
                </div>
                <div class="form-group">
                  <textarea name="tests" class="form-control" rows="5" placeholder="Enter Lab Results"></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" name="update" class="btn btn-success btn-block" value="Update Record">
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
                    <th>Name</th>
                    <th>Refered To</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
              <?php while($s = $result -> fetch_assoc()){?>
                <tr>
                    <td><?= $s['id'];?></td>
                    <td><?= $s['name']; ?></td>
                    <td><?= $s['refer'];?></td>
                    <td>
                        <a href="Patient.php?edit=<?= $s['id']; ?>" class="badge badge-success p-2">Create File</a>
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
<?php include("paction.php");?>

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
<body >
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">XerxesWap</a>

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
            <a class="nav-link" href="#">Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">About</a>
        </li>
        </ul>
    </div>

    <form class="form-inline" action="/action_page.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </nav>
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-md-6 mt-3 bg-info p-4 rounded">
                 <h2 class="bg-light p-2 rounded text-center text-dark">ID: <?= $vid; ?></h2>
                 <img src="<?= $vphoto; ?>" width="400" class="img-thumbnail ml-5">
                 <h4 class="text-light">Name: <?= $vname; ?> </h4>
                 <h4 class="text-light">Location: <?= $vlocation; ?> </h4>
                 <h4 class="text-light">Diagnosis: <?= $vdiagnosis; ?> </h4>
                 <h4 class="text-light">Prescription: <?= $vprescription; ?> </h4>
             </div>
         </div>
     </div>
</body>
</html>
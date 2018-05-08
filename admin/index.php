<?php

    if(session_id() === null) {
        session_start();
    }

    include_once('../functions/process.php');
    
    $json = $_SESSION['data'];
    $data = json_decode($json, true);
    //var_dump($data[0]["UN"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php if($_SESSION['data'] == null) {

        $output  = "<div class='container jumbotron'>";
        $output .= "<div class='row'>";
        $output .= "<div class='col-sm-12'>";
        $output .= "<h1 class='text-danger'>You are not logged in...</h1><hr>";
        $output .= "<a class='form-control btn btn-info' href='../index.php'>Go To Home Page</a>";
        $output .= "</div></div></div>";

        echo $output;
        
    } else { ?>

        <div class="loginBox">

        <h2>Update User</h2>

        <form action="../functions/process.php" method="POST">

            <input type="hidden" class="form-control" name="uid" id="uid" value="<?php echo $data[0]['ID'] ?>">

            <div class="form-group">
                <input type="text" class="form-control" name="user" id="user" placeholder="Username" value="<?php echo $data[0]['UN'] ?>" autofocus>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" value="<?php echo $data[0]['PW'] ?>">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="pass2" id="pass2" placeholder="Password" value="<?php echo $data[0]['PW'] ?>">
            </div>

            <div class="form-group">
                <input type="submit" class="form-control btn btn-warning" name="update" id="update" value="Update User" >
            </div>

            <div class="form-group">
                <input type="submit" class="form-control btn btn-danger" name="remove" id="remove" value="Remove User" >
            </div>

        </form>

        </div>

        <div class="all-users">

        <table class="table">
            <thead>
                <th>ID</th>
                <th>FNAME</th>
                <th>LNAME</th>
                <th>USERNAME</th>
            </thead>
            <tbody>
                <?php echo ShowAllUsers(); ?>
            </tbody>
        </table>

        </div>
    <?php } ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>
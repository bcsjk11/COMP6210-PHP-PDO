<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Screen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="loginBox">

        <h2>Simple Login</h2>

        <form action="functions/process.php" method="POST">

            <div class="form-group">
                <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" autofocus>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="user" id="user" placeholder="Username">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Password">
            </div>

            <div class="form-group">
                <input type="submit" class="form-control btn btn-primary" name="register" id="register" value="Register" >
            </div>

        </form>

    </div>

    <div class="modal fade" id="loginMessage" tabindex="-1" role="dialog" aria-labelledby="loginMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginMessageTitle">Ooppss... Something went wrong</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>Check that your username and password are filled in</li>
                        <li>Your password should be at least 8 characters long</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>

    <script src="js/script.js"></script>
</body>

</html>
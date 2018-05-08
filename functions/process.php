<?php

    session_start();
    include('creds.php');

    //var_dump($_POST);

    if(isset($_POST["submit"])) {

        $user = !empty($_POST["user"]);
        $pass = !empty($_POST["pass"]);

        if($user && $pass) {
            GetLoginData($_POST['user'], $_POST['pass']);
        }

    } else if (isset($_POST["register"])) {

        $fname = !empty($_POST["fname"]);
        $lname = !empty($_POST["lname"]);
        $user = !empty($_POST["user"]);
        $pass = !empty($_POST["pass"]);

        if($user && $pass && $fname && $lname) {
            Adduser($_POST['user'], $_POST['pass'], $_POST['fname'], $_POST['lname']);
        }

    } else if(isset($_POST["update"])) {

        $id = !empty($_POST["uid"]);
        $user = !empty($_POST["user"]);
        $pass = !empty($_POST["pass"]);
        $pass2 = !empty($_POST["pass2"]);

        if( $id && $user && $pass & $pass2 ) {
            if($_POST["pass"] === $_POST["pass2"]) {
                UpdateUser($_POST["uid"], $_POST["user"], $_POST["pass"]);
            }
        }
    } else if(isset($_POST["remove"])) {

        $id = !empty($_POST["uid"]);

        if( $id ) {
            RemoveUser($_POST["uid"]);
        }
    }


    // MySQL connection string using PDO

    function Connections() {

        try {

            $dsn = "mysql:host=".DBHOST.";dbname=".DBNAME;
            $pdo = new PDO($dsn, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;

        }catch (PDOException $e) {

            print "ERROR!: ". $e->getMessage() . "<br>";
            die();

        }

    }

    function GetLoginData($u , $p) {

        // Step 01 : Define your variables

        $db = Connections();
        $sql = "SELECT ID, UN, PW FROM tbl_users WHERE UN = :user and PW = :pass";
        $params = [":user" => $u, ":pass" => $p];

        // Stept 02 : Executing the SQL Query

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $results = $stmt->FETCHALL();

        // Step 03 : The handeling of the data

        $output = "";

        if( count($results) > 0 ) {

            $output = json_encode($results);
            $_SESSION['data'] = $output;

            $host = $_SERVER['HTTP_HOST'];
            $path = 'index.php';
            header("Location: ../admin/$path");
            exit;

        } else {

            $output   = "<h1> There was an error! </h1>";
            $output  .= "<br>";
            $output  .= "<p>Please Try again</p>";
            $output  .= "<br><br>";
            $output  .= "<a href='../index.php'>Go to login page</a>";

            echo $output;

        }

    }

    function ShowAllUsers() {

        $db = Connections();
        $sql = "SELECT ID, FN, LN, UN FROM tbl_users";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        $result = $stmt->FETCHALL();

        $output = "";

        if( count($result) > 0) {

            foreach($result as $item) {

                $output .= "<tr><td>".$item["ID"]."</td>";
                $output .= "<td>".$item["FN"]."</td>";
                $output .= "<td>".$item["LN"]."</td>";
                $output .= "<td>".$item["UN"]."</td></tr>";

            }

        } else {
            $output = "No Data in this Database";
        }

        return $output;

    }

    function Adduser($u, $p, $fn, $ln) {

        $db = Connections();
        $sql = "INSERT INTO tbl_users (FN, LN, UN, PW) VALUES (:fname, :lname, :user, :pass)";
        $params = [":fname" => $fn, ":lname" => $ln, ":user" => $u, ":pass" => $p];

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        $count = $stmt->rowCount();

        if($count == 1) {

            $host = $_SERVER['HTTP_HOST'];
            $path = 'index.php';
            header("Location: http://$host/$path");
            sessions_destroy();
            exit;

        } 

    } 

    function UpdateUser($id, $u, $p) {

        $db = Connections();
        $sql = "UPDATE tbl_users SET UN = :user, PW = :pass WHERE ID = :id";
        $params = [":user" => $u, ":pass" => $p, ":id" => $id];

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        $count = $stmt->rowCount();

        if($count == 1) {

            $host = $_SERVER['HTTP_HOST'];
            $path = 'index.php';
            header("Location: http://$host/$path");
            sessions_destroy();
            exit;

        } else {

            echo "SOMETHING WENT WRONG!";

        }
    }

    function RemoveUser($id) {

        $db = Connections();
        $sql = "DELETE FROM tbl_users WHERE ID = :id";
        $params = [":id" => $id];

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        $count = $stmt->rowCount();

        if($count == 1) {

            $host = $_SERVER['HTTP_HOST'];
            $path = 'index.php';
            header("Location: http://$host/$path");
            sessions_destroy();
            exit;

        }
    }

?>
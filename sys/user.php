<?php
    $conn = new mysqli("localhost","root","","userlog");

    // for login
    if(isset($_POST['type'])){
        if($_POST['type'] == "login"){
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $sql = "SELECT password FROM user WHERE username='{$username}'";
            $sql = $conn->query($sql);

            if($sql->num_rows == 1){
                $sql = $sql->fetch_assoc();
                if($password == $sql['password']){
                    echo "success";
                } else {
                    echo "wrong";
                }
            } else {
                echo "error";
            }
        } elseif ($_POST['type'] == "register"){
            $username = $_POST['username'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            $uch = "SELECT * FROM user WHERE username='$username'";
		    $reuch = $conn->query($uch);
		
		    if($reuch->num_rows > 0){
                echo "error";
            } else {
                $sql = "INSERT INTO user (username,password,fullname,email) VALUES ('$username','$password','$fullname','$email')";
                $sql = $conn->query($sql);
                echo "success";
            }
        }

    } else {
        header("location: ../index.html");
    }

?>
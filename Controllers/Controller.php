<?php
require_once ('../sphere_kit/kernel/Database/connection.php');
require_once ('../sphere_kit/kernel/controller_kernel.php');
require_once ('../sphere_kit/kernel/error_handler.php');


class Controller {
    public function login(){
        if(isset($_POST['email'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $all_user = DB_QUERY("SELECT * FROM users");
            $users = DB_QUERY("SELECT * FROM users WHERE email = '$email' LIMIT 1");
            if($users){
                if(HASH_CHECK_BCRYPT($password, $users['password'])){
                    session_start();
                    $_SESSION['username'] = $users['name'];
                    ViewRender("login/logged.php", ['all_user'=>$all_user]);
                }else{
                    echo "<p>Invalid Credentials</p>";
                }
            }else{
               echo "<p>Email Not Found</p>";
            }
        }
        ViewRender("login/login.php");
    }

    public function compact_test(){
        $data = [
            'name' => 'John',
        ];
        return $data;
    }

    public function register(){
        if(isset($_POST['email'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = HASH_BCRYPT($_POST['password']);
            $name = $_POST['name'];
            $phone = $_POST['phone'];

            $verify = DB_QUERY("SELECT * FROM users WHERE email = '$email' LIMIT 1");
            if($verify){
                echo "<p>Email Already Exist</p>";
            }else{
                DB_QUERY("INSERT INTO users (username, password, email, name, phone, role) VALUES ('$username','$password','$email','$name','$phone',1)");
            }
        }
        ViewRender("register/register.php");
    }
}
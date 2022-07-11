<?php
 require_once '../../inc/session.php';
 require_once '../../inc/config.php';


if(isset($_POST['staff_submit'])){
    $name = htmlentities($_POST['name']);
    $lastname = htmlentities($_POST['lastname']);
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);
    $password_confirm = htmlentities($_POST['confirmPass']);

    $_SESSION['name'] = $name;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['username'] = $username;


    if($password !== $password_confirm){
        $_SESSION['error'] = "password and current password was not the same";
        header('location:NewStaff.php');
    }else{
        $op = md5($password);
        $staff = $pdo->prepare("INSERT INTO addnewstaff(Name,Lastname,username,password) VALUES (:name,:Lastname,:username,:password)");
        $staff->bindValue(':name',$name);
        $staff->bindValue(':Lastname',$lastname);
        $staff->bindValue(':username',$username);
        $staff->bindValue(':password',$op);
        $staff->execute();

        unset($_SESSION['name']);
        unset($_SESSION['lastname']);
        unset($_SESSION['username']);
        $_SESSION['sucess-left'] = $name.'  '.$lastname."  has successfully added to your staff";
        header('location:NewStaff.php');
    }

  
}

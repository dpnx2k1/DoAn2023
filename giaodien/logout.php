<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
        <?php
        session_start();
        unset($_SESSION['current_user']);
        header("location:./dist/login2.php");
        ?>
    
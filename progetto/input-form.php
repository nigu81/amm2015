<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if(empty($_POST['usr'])||empty($_POST['psw'])||empty($_POST['email'])){
           echo "Username, password e/o email mancante <br/>";
        } 
        
        $usr = $_POST['usr'];
         $password = $_POST['psw'];
         $email = $_POST['email'];
         $sesso = $_POST['sesso'];
         echo "USer: $usr<br/> Pass: $password<br/>Email: $email<br/>Sesso: $sesso<br/>";
         
        ?>
    </body>
</html>

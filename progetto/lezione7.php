<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Esempio</title>
    </head>
    <body>
        
        <form action="input-form.php" method="post">
            <label for="usr">Username: </label>
            <input type="text" id="usr" name="usr" />
            <br/>
            
            <label for="psw">Password: </label>
            <input type="password" id="psw" name="psw" />
            <br/>
            
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" />
            <br/>
          
        
        <label for="femmina">Femmina</label>
        <input type="radio" id="femmina" name="sesso" value="F" checked/>
        <br/>
        
        <label for="maschio">Maschio</label>
        <input type="radio" id="Maschio" name="sesso" value="M"/>
        <br/>
        
        <input type="submit" value="Invia"/>
        </form>  
            
        <?php
        
        ?>
    </body>
</html>

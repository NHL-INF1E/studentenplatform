<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Beheerder's Paneel</title>
        <link href="adminPanel.css" rel="stylesheet">
    </head>
    <body>
        <form action="post">
            <input type="text" name="title" id="title" placeholder="title">
            <input type="text" name="image" id="image" placeholder="image.jpg">
            <textarea rows="4" cols="50" name="description" id="description" placeholder="description..."></textarea>
            <input type="submit" value="Opslaan" id="submit" name="submit">
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>

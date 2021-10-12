<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Contact Viewing</title>
        <link href="../css/admin.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="contentContainer">
            <?php
            include '../utilities/dataStoreUtil.php';
            $contacts = getContacts("../datastores/contacts.json");
            foreach($contacts as $contact){
                echo"<div class='contactContainer'>";
                echo $contact["name"];
                echo $contact["email"];
                echo $contact["subject"];
                echo $contact["message"];
                echo '</div>';
            }
            ?>
        </div>
    </body>
</html>

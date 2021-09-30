<?php

$filepathID = "../datastores/id.txt";
$filepathActivities = "../datastores/activities.json";

/**
 * adds an activity
 * @param array $content an activity in array form to be encoded and added
 */
function addActivity($content){
    global $filepathID, $filepathActivities;
    
    //add an ID to the activity and then write it to the datastore
    $activity = array(getID($filepathID) => $content);
    file_put_contents($filepathActivities, $activity);
}

/**
 * function that returns the next available activity ID
 * @param String $filepath path to the id.txt file
 */
function getID($filepath){
    //attempt to open file
    $file = fopen($filepath, "r");
    
    if(!$file){
        throw new RuntimeException("could not open " . $filepath);
    }else{
        //retrieves current ID and ups it by one for the next use
        $ID = fread($file, filesize($filepath));
        updateID($ID, $filepath);
        
        fclose($file);
        return $ID;
    }
}

/**
 * function that updates the next available ID
 * @param int $ID last used ID
 */
function updateID($ID, $filepath){
    //attempt to open file
    $file = fopen($filepath, "w");
    
    if(!$file){
        throw new RuntimeException("could not open " . $filepath);
    }else{
        //ups the current ID by one and rewrites the ID.txt file
        $ID++;
        fwrite($file, $ID);
        fclose($file);
    }
}

/**
 * adds an activity the the json datastore
 */


<?php

$filepathID = "../datastores/id.txt";
//Ik denk beter dat we de path mee kunnen sturen aangezien ik vanuit index.php geen ../ nodig ben en anders include errors krijg doordat hij het bestand niet vind/we moeten mijn systeem gebruiken dat niemand snapt :/
$filepathActivities = "datastores/activities.json";

/**
 * remove a activity
 * @param int $ID id of the activity to be deleted
 */
function removeActivity($ID){
    global $filepathActivities;
    $activities = getActivities();
    unset($activities[$ID]);
    json_encode($activities);
    file_put_contents($filename, $activities);
}

/**
 * edit an activity
 * @param int $ID id of the activity to be edited
 * @param array $content new content for the selected activity
 */
function editActivity($ID, $content){
    global $filepathActivities;
    $activities = getActivities();
    if($activities[$ID] == null){
        throw new RuntimeException("no such activity found");
    }else{
        array_replace($activities[$ID], $content);
        $activitiesString = json_encode($activities);
        file_put_contents($filepathActivities, $activitiesString);
    }
}

/**
 * find an activity
 * @param int $ID id of the activity to find
 * @return array $activities[$ID] activity with given ID in array form
 */
function getActivity($ID){
    $activities = getActivities();
    if($activities[$ID] == null){
        throw new RuntimeException("no such activity found");
    }else{
        return $activities[$ID];
    }
    
}

/**
 * adds an activity
 * @param array $content an activity in array form to be encoded and added
 */
function addActivity($content){
    global $filepathID, $filepathActivities;
    //get all activities
    $activities = getActivities();
    
    //add an ID to the activity and then add it to all activities
    $newActivity = array(getID($filepathID) => $content);
    array_push($activities, $newActivity);
    json_encode($activities);
    file_put_contents($filepathActivities, $activities);
}

/**
 * get all activities
 * @return array of all added activities
 */
function getActivities(){
    global $filepathActivities;
    if(!($activities = file_get_contents($filepathActivities))){
        throw new RuntimeException("filepath " . $filepathActivities . " incorrect");
    }else{
        return json_decode($activities);
    }
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


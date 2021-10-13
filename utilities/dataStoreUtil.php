<?php

/**
 * remove a activity
 * @param int $ID id of the activity to be deleted
 */
function removeActivity($ID, $filepathActivities){
    $activities = getActivities($filepathActivities);
    unset($activities[$ID]);
    json_encode($activities);
    file_put_contents($filepathActivities, $activities);
}

/**
 * edit an activity
 * @param int $ID id of the activity to be edited
 * @param array $content new content for the selected activity
 */
function editActivity($ID, $content, $filepathActivities){
    $activities = getActivities($filepathActivities);
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
function getActivity($ID, $filepathActivities){
    $activities = getActivities($filepathActivities);
    return $activities[$ID];
    
}

/**
 * adds an activity
 * @param array $content an activity in array form to be encoded and added
 */
function addActivity($content, $filepathID, $filepathActivities){
    //get all activities
    $activities = getActivities($filepathActivities);
    
    //add an ID to the activity and then add it to all activities
    $newActivity = array(getID($filepathID) => array($content));
    array_push($activities, $newActivity);
    echo json_encode($activities, JSON_PRETTY_PRINT);
    file_put_contents($filepathActivities, json_encode($activities, JSON_PRETTY_PRINT));
}

/**
 * get all activities
 * @return array of all added activities
 */
function getActivities($filepathActivities){
    if(!($activities = file_get_contents($filepathActivities))){
        throw new RuntimeException("filepath " . $filepathActivities . " incorrect");
    }else{
        return json_decode($activities, true);
    }
}

function getContacts($filepathContacts){
    if(!($contacts = file_get_contents($filepathContacts))){
        throw new RuntimeException();
    }else{
        return json_decode($contacts, true);
    }
}

/**
 * function that returns the next available activity ID
 * @param String $filepath path to the id.txt file
 */
function getID($filepath){
    //attempt to open file
    $file = fopen($filepath, "r+");
    
    if(!$file){
        throw new RuntimeException("could not open " . $filepath);
    }else{
        //retrieves current ID and ups it by one for the next use
        $ID = fread($file, filesize($filepath));
        updateID($ID, $filepath, $file);
        fclose($file);
        return $ID;
    }
}

/**
 * function that updates the next available ID
 * @param int $ID last used ID
 */
function updateID($ID, $filepath, $file){
    //attempt to open file
    if(!$file){
        throw new RuntimeException("could not open " . $filepath);
    }else{
        //ups the current ID by one and rewrites the ID.txt file
        $ID++;
        file_put_contents($filepath, $ID);
    }
}


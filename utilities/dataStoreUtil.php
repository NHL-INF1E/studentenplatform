<?php

function getActivity($ID, $filepathActivities){
    $activities = getActivities($filepathActivities);
    return ($activities[$ID]);
}

function removeActivity($ID, $filepathActivities){
    $activities = getActivities($filepathActivities);
    unset($activities[$ID]);
    file_put_contents($filepathActivities, json_encode($activities, JSON_PRETTY_PRINT));
    
}

function editActivity($ID, $content, $filepathActivities){
    $activities = getActivities($filepathActivities);
    $changedActivity = array($ID => array($ID => $content));
    
    $result = (array_replace($activities, $changedActivity));
    file_put_contents($filepathActivities, json_encode($result, JSON_PRETTY_PRINT));
}

function addActivity($content, $filepathID, $filepathActivities){
    $activities = getActivities($filepathActivities);
    
    $newActivity = array(getID($filepathID) => $content);
    array_push($activities, $newActivity);
    file_put_contents($filepathActivities, json_encode($activities, JSON_PRETTY_PRINT));
}

function getActivities($filepathActivities){
    if(!($activities = file_get_contents($filepathActivities))){
        throw new RuntimeException("filepath " . $filepathActivities . " incorrect");
    }else{
        $activitiesArray = json_decode($activities, true);
        $result = $activitiesArray;
        return $result;
    }
}

function getActivitiesTest($filepathActivities){
    /*if(!($activities = file_get_contents($filepathActivities))){
        throw new RuntimeException("filepath " . $filepathActivities . " incorrect");
    }else{*/
        $activities = file_get_contents($filepathActivities);
        $activitiesArray = json_decode($activities, true);
        $result = $activitiesArray;
        return $result;
    //}
}

function getContacts($filepathContacts){
    if(!($contacts = file_get_contents($filepathContacts))){
        throw new RuntimeException();
    }else{
        return json_decode($contacts, true);
    }
}

function getID($filepath){
    $file = fopen($filepath, "r+");
    
    if(!$file){
        throw new RuntimeException("could not open " . $filepath);
    }else{
        $ID = fread($file, filesize($filepath));
        updateID($ID, $filepath, $file);
        fclose($file);
        return $ID;
    }
}

function updateID($ID, $filepath, $file){
    if(!$file){
        throw new RuntimeException("could not open " . $filepath);
    }else{
        $ID++;
        file_put_contents($filepath, $ID);
    }
}


<?php

function getActivity($ID, $filepathActivities){
    $activities = getActivities($filepathActivities);
    return $activities[$ID];
    
}

function addActivity($content, $filepathID, $filepathActivities){
    $activities = getActivities($filepathActivities);
    
    $newActivity = array(getID($filepathID) => $content);
    array_push($activities, $newActivity);
    echo json_encode($activities, JSON_PRETTY_PRINT);
    file_put_contents($filepathActivities, json_encode($activities, JSON_PRETTY_PRINT));
}

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


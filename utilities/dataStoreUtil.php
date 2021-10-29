<?php

function getCategories($filepathActivities) {
    if(!($activities = file_get_contents($filepathActivities))){
        throw new RuntimeException("filepath " . $filepathActivities . " incorrect");
    }else{
        return json_decode($activities);
    }
}

function getActivity($categoryID, $ID, $filepathActivities){
    $activities = getActivities($filepathActivities);
    if(isset($activities[$categoryID]["activity"][$ID])){
        return ($activities[$categoryID]["activity"][$ID]);
    }else{
        return null;
    }
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

function removeActivity($categoryID, $ID, $filepathActivities){
    $activities = getActivities($filepathActivities);
    unset($activities[$categoryID]["activity"][$ID]);
    $jsonString = json_encode($activities, JSON_PRETTY_PRINT);
    file_put_contents($filepathActivities, $jsonString);
}

function editActivity($ID, $content, $oldCategory, $newCategory, $filepathActivities){
    removeActivity($oldCategory, $ID, $filepathActivities);
    addActivity($content, $newCategory, $filepathActivities);
}

function addActivity($content, $category, $filepathActivities){
    $activities = getActivities($filepathActivities);
    $activities[$category]["activity"] += $content;
    file_put_contents($filepathActivities, json_encode($activities, JSON_PRETTY_PRINT));
}

function getContacts($filepathContacts){
    if(!($contacts = file_get_contents($filepathContacts))){
        throw new RuntimeException();
    }else{
        return json_decode($contacts, true);
    }
}
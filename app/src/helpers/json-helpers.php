<?php

// Json helpers
function saveToJsonFile(string $filePath, array $data) : bool {

    $jsonData = json_encode($data, JSON_PRETTY_PRINT);

    if($jsonData === false) {
        throw new Exception("Error encoding data to JSON: " . json_last_error_msg());
    }

    // Use atomic file write
    $tempFilePath = tempnam(sys_get_temp_dir(), 'json_');
    if(file_put_contents($tempFilePath, $jsonData) === false){
        throw new Exception("Error writing JSON data to temporary file for file path : {$filePath}");
    }

    if(!rename($tempFilePath, $filePath)) {
        throw new Exception("Error renaming temporary file to {$filePath}");
    }

    return true;
}

function loadFromJsonFile(string $filePath) : array {

    if(!file_exists($filePath)) {
        return [];
    }

    $jsonData = file_get_contents($filePath);

    if($jsonData === false) {
        throw new Exception("Error reading file: {$filePath}");
    }
    $data = json_decode($jsonData, true);

    if(json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Error decoding JSON data from file: {$filePath}: " . json_last_error_msg());
    }

    return $data ?: [];
}

<?php

// Function to convert JSON to XML
function jsonToXml($json) {
    $xml = new SimpleXMLElement('<root/>');
    arrayToXml($json, $xml);
    return $xml->asXML();
}

// Helper function to convert arrays to XML
function arrayToXml($array, &$xml) {
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $subnode = $xml->addChild($key);
            arrayToXml($value, $subnode);
        } else {
            $xml->addChild($key, htmlspecialchars($value));
        }
    }
}

// Get JSON data from the frontend
$jsonData = json_decode(file_get_contents('php://input'), true);

// Check if JSON data is valid
if (json_last_error() !== JSON_ERROR_NONE) {
    // Handle invalid JSON input
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON data']);
    exit;
}

// Convert JSON to XML
$xmlData = jsonToXml($jsonData);

// Return XML response to the frontend
header('Content-Type: text/xml');
echo $xmlData;
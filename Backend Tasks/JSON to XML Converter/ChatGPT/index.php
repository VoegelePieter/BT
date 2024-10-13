<?php
// Set the content type to application/xml
header('Content-type: application/xml');

// Function to convert an array to XML
function array_to_xml($data, &$xml_data) {
    foreach ($data as $key => $value) {
        if (is_array($value)) {
            if (is_numeric($key)) {
                $key = 'item'.$key; //dealing with numeric keys in array
            }
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key", htmlspecialchars("$value"));
        }
     }
}

// Read JSON input from the request
$jsonInput = file_get_contents('php://input');

// Decode JSON input
$jsonData = json_decode($jsonInput, true);

// Check if JSON data is valid
if (json_last_error() === JSON_ERROR_NONE) {
    // Initialize the XML object
    $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');

    // Convert array to XML
    array_to_xml($jsonData, $xml_data);

    // Output XML
    echo $xml_data->asXML();
} else {
    // Return error message if JSON is invalid
    echo '<error>Invalid JSON</error>';
}
?>

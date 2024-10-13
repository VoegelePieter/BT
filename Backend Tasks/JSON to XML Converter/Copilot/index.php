<?php
header('Content-Type: application/json');

function jsonToXml($data, $rootElement = null, $xml = null) {
    if ($xml === null) {
        $xml = new SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>');
    }

    foreach ($data as $key => $value) {
        if (is_array($value)) {
            jsonToXml($value, $key, $xml->addChild($key));
        } else {
            $xml->addChild($key, htmlspecialchars($value));
        }
    }

    return $xml->asXML();
}

try {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON input: ' . json_last_error_msg());
    }

    $xml = jsonToXml($data);
    header('Content-Type: application/xml');
    echo $xml;
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
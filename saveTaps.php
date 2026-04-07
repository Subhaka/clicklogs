<?php
// 1. Silence non-critical warnings (like Deprecated) so they don't break the JSON/JS response
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 2. Collect the data from the JavaScript POST request
    $sessionId = $_POST['id'] ?? 'unknown';
    $devicePlatform = $_POST['var'] ?? 'unknown';
    $tapsData = $_POST['taps'] ?? '[]';

    $tapsArray = json_decode($tapsData, true);
    
    // Check if JSON is valid
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error: Invalid JSON data";
        exit;
    }

    // 3. Firebase Configuration
    $projectId = 'iitcoursework'; 
    $collection = 'tap_logs';
    $url = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collection";
    $apiKey = 'AIzaSyCbY3yYsBnIDZ3ZWv1aSmOKUFW1SZQmAUs';

    // 4. Loop through each tap and send to Firestore
    foreach ($tapsArray as $tap) {
        $record = [
            'fields' => [
                'session_id' => ['stringValue' => (string)$sessionId],
                'device' => ['stringValue' => (string)$devicePlatform],
                'sequence' => ['integerValue' => (string)$tap['tapSequenceNumber']],
                'start' => ['integerValue' => (string)$tap['startTimestamp']],
                'end' => ['integerValue' => (string)$tap['endTimestamp']],
                'duration' => ['integerValue' => (string)($tap['endTimestamp'] - $tap['startTimestamp'])],
                'interface' => ['stringValue' => (string)$tap['interface']],
                'interface_seq' => ['integerValue' => (string)$tap['interfaceSequence']],
                'timestamp' => ['integerValue' => (string)time()]
            ]
        ];

        // Initialize CURL
        $ch = curl_init($url . "?key=$apiKey");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($record));

        // Execute the request
        $response = curl_exec($ch);
        
        // Note: curl_close($ch) is removed here because it is deprecated in PHP 8.5+ 
        // and handled automatically by the engine.
    }

    // 5. Send the exact string the JavaScript is looking for
    echo "Data saved successfully";

} else {
    echo "Invalid request method";
}
?>

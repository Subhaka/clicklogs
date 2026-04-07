<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sessionId = $_POST['id'] ?? 'unknown';
    $devicePlatform = $_POST['var'] ?? 'unknown';
    $tapsData = $_POST['taps'] ?? '[]';

    $tapsArray = json_decode($tapsData, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "JSON decode error: " . json_last_error_msg();
        exit;
    }

    $projectId = 'iitcoursework';
    $collection = 'tap_logs';
    $url = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collection";
    $apiKey = 'AIzaSyCbY3yYsBnIDZ3ZWv1aSmOKUFW1SZQmAUs';

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
   
}

        $ch = curl_init($url . "?key=$apiKey");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($record));

        $response = curl_exec($ch);
        if(curl_errno($ch)){
            echo "Curl error: " . curl_error($ch);
        } else {
            echo "Firestore response: $response<br>";
        }
        curl_close($ch);
    }

    echo "Data sent successfully via REST API!";
} else {
    echo "Invalid request method";
}

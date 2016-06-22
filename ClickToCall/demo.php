<?php
/**
 * Click to Call
 *
 * @url https://platform.x-onweb.com/#clicktocall
 */

// Load Composer's autoloader - make sure you have installed the dependencies using Composer
require __DIR__ . '/../vendor/autoload.php';

/**
 * Your API Token
 * @todo Use your API Token here
 */
$token = 'ExampleTokenHere';

/**
 * Required Parameters
 *  - destination
 *  - target
 */

/**
 * @todo Update $destinationPhoneNumber with the phone number you wish to target
 */
$destinationPhoneNumber = '0333 332 0000';
/**
 * @todo Update $target with the user or group you want the call to target
 * This can be found in the [Configuration Console](https://config.x-onweb.com)
 */
$target = 'U0001';

$guzzle = new GuzzleHttp\Client(['base_uri' => 'https://platform.x-onweb.com/api/v1/']);

/*
 * Schedule a Click to Call
 */

$res = $guzzle->post(
    'clicktocall',
    [
        'headers' => [
            'Authorization' => 'Bearer ' . $token
        ],
        'json' => [
            'destination' => $destinationPhoneNumber,
            'target' => $target,
        ]
    ]
);

echo $res->getStatusCode();
// 202

$body = $res->getBody();

echo $body;
// {"status":"OK","callId":"20626903"}


$decodedBody = json_decode($body, true);

/*
 * Retrieve the call details
 *
 * **Note**: This will only work once the call has completed. If this gets called before the call has finished, it will
 * currently return a 404. This may be something that gets changed in the future.
 */

$callId = $decodedBody['callId'];

$res = $guzzle->get(
    'calls/' . $callId . '?includes=audio,callbacks',
    [
        'headers' => ['Authorization' => 'Bearer ' . $token]
    ]
);

echo $res->getStatusCode();
// 200

$body = $res->getBody();

echo $body;
// {"data":{"id":20626903,"direction":"OUTBOUND","caller":{"number":"033...

$decodedBody = json_decode($body, true);

$data = $decodedBody['data'];

echo "Call between {$data['caller']['number']} and {$data['dialled']['number']} spoke {$data['durations']['talk']} seconds";

/*
 * Retrieve the call recording
 *
 * **Note**: In the API method above, we included audio. This means that $decodedBody contains the audio details. We can
 * extract the link from this, and use that to save the recording locally
 */

// Extract the uri from the first link of the first audio
$audioLink = $data['audio']['data'][0]['links'][0]['uri'];

$res = $guzzle->get(
    $audioLink,
    [
        'headers' => [
            'Authorization' => 'Bearer ' . $token
        ]
    ]
);

file_put_contents($callId . '.mp3', $res->getBody());

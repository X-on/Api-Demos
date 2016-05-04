<?php
/**
 * Click to Call
 *
 * @url https://platform.x-onweb.com/#clicktocall
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Your API Token
 */
$token = 'ExampleTokenHere';

/**
 * Required Parameters
 *  - destination
 *  - target
 */

$destinationPhoneNumber = '0333 332 0000';
$target = 'U0050';

$guzzle = new GuzzleHttp\Client(['base_uri' => 'https://platform.x-onweb.com/api/v1/']);

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
// "200"

echo $res->getBody();
// "OK"

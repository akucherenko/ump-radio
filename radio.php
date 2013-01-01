<?php

isset($_GET['cmd']) || $_GET['cmd'] = 'list';
$response = array();
$stationList = array();
$stationList['Jazz'] = 'http://streaming208.radionomy.com:80/A-JAZZ-FM-WEB';
$stationList['Fox News'] = 'http://fnradio-shoutcast-32.ng.akacast.akamaistream.net/7/115/13873/v1/auth.akacast.akamaistream.net/fnradio-shoutcast-32';

session_start();
isset($_SESSION['volume']) || $_SESSION['volume'] = 4;

switch ($_GET['cmd'])
{
    case 'list':
        $response['list'] = $stationList;
        break;
    case 'play':
        $_SESSION['play'] = urldecode($_GET['param']);
        $response['station'] = $stationList[$_SESSION['play']];
        break;
    case 'stop':
        if(isset($_SESSION['play'])) unset($_SESSION['play']);
        $response['result'] = 1;
        break;
    case 'status':
        if (isset($_SESSION['play']))
        {
            $response['status'] = 'play';
            $response['station'] = $_SESSION['play'];
        }
        else
        {
            $response['status'] = 'stop';
        }
        break;
    case 'volume':
        isset($_GET['param']) && $_SESSION['volume'] = $_GET['param'];
        $response['level'] = $_SESSION['volume'];
        break;
    default:
}
header('Content-type:application/json');
echo json_encode(array('response' => $response));
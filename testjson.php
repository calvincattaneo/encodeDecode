<?php

$token = '0bfa7fb6d78d8f795a800dd7219775ee';
$domainname = 'http://localhost/moodle/';
$functionname = 'core_user_create_users';
$restformat = 'json';

//array to assign user details to create user

$user1 = new stdClass();
$user1->username = 'paul'; //should be unique
$user1->password = 'Paul#5';
$user1->firstname = 'paul';
$user1->lastname = 'paul';
$user1->email = 'paul@moodle.com'; //should be unique
$user1->auth = 'manual';
$user1->idnumber = 'testidnumber1';
$user1->lang = 'en';
$user1->theme = 'standard';
$user1->timezone = '-12.5';
$user1->mailformat = 0;
$user1->description = 'Hello World!';
$user1->city = 'testcity1';
$user1->country = 'au';
$preferencename1 = 'preference1';
$preferencename2 = 'preference2';
$user1->preferences = array(
    array('type' => $preferencename1, 'value' => 'preferencevalue1'),
    array('type' => $preferencename2, 'value' => 'preferencevalue2'));

$user2 = new stdClass();
$user2->username = 'jack'; //should be unique
$user2->password = 'Jack#5';
$user2->firstname = 'jack';
$user2->lastname = 'jack';
$user2->email = 'jack@moodle.com'; //should be unique
$user2->timezone = 'Pacific/Port_Moresby';

$users = array($user1, $user2);

$params = array('users' => $users);
var_dump($params);
die();
//header('Content-Type: text/plain');

$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;
$curl = curl_init();

$restformat = ($restformat == 'json')?'&moodlewsrestformat=' . $restformat:'';

curl_setopt($curl, CURLOPT_URL, $serverurl);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS,
            json_encode($params));

$response = curl_exec($curl);

// close the connection, release resources used
curl_close($curl);

// do anything you want with your response
print_r($response);
/*
$resp = $curl->post($serverurl . $restformat, $params);

var_dump($resp);*/
//print_r($params);

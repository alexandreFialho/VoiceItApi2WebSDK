<?php
require('../../voiceit-php-backend/VoiceIt2WebBackend.php');
include('../config.php');

$myVoiceIt = new VoiceIt2WebBackend($VOICEIT_API_KEY, $VOICEIT_API_TOKEN);

function voiceItResultCallback($jsonResponse){
  $jsonObj = json_decode($jsonResponse);
  $callType = strtolower($jsonObj["callType"]);
  $userId = $jsonObj["userId"];
  if(stripos($callType, "verification") !== false){
    if($jsonObj["jsonResponse"]["responseCode"] == "SUCC"){
      // User was successfully verified so lookup user details via
      // VoiceIt UserId and begin session
      session_start();
      $_SESSION["userId"] = $userId;
    }
  }
}

$myVoiceIt->InitBackend($_POST, $_FILES, voiceItResultCallback);
?>

<?php

$access_token = 'N0IzKf3n/tuu23eKxvUEkAY6Afzj8nu+lQYp+FyOAZXSVofsrCArcwRBOJKEbssASNnN5S35vUE5yiQ3dPcvlRqu9G0IVPHVxUHUHW63dUUUdxfcWpbZUj7iu8ImPFKK8LnAdy5wGDxvMhUD1A1fugdB04t89/1O/w1cDnyilFU='; 

$arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
$message = $arrayJson['events'][0]['message']['text'];

 if($message == "aa"){
        $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }


if($message == "video"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "video";
        $arrayPostData['messages'][0]['originalContentUrl'] = "https://www.youtube.com/watch?v=S1Sfvra6lQo";//ใส่ url ของ video ที่ต้องการส่ง
        $arrayPostData['messages'][0]['previewImageUrl'] = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIVqKvRiIJ86EkmZ7ifkHpChTp1Qt8GkqqVA&usqp=CAU";//ใส่รูป preview ของ video
        replyMsg($arrayHeader,$arrayPostData);
    }

function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
return ;
/**************/


//$sValue= getInputMessage() ;
$MessageInput = $sValue[0];  
$replyToken =  $sValue[1];  
$userID = $sValue[2] ;
$contact9 = $sValue[0] ;
pushMessage($contact9,$access_token,$replyToken) ;  return ;



 

$result = getPortImageURL($contact9,$userID) ;
$str    = getPortDataString($contact9) ;
$resultAr = explode("|",$result); 


if (trim($resultAr[0]) == "Fail") {
  pushMessage($resultAr[1],$access_token,$replyToken) ; 
  return;
}  else {
  $ImageFileName = $result ; 
  pushImage($ImageFileName,$access_token,$replyToken);  
  pushMessage($str,$access_token,$replyToken) ; 
}


function getInputMessage() { 

  $content = file_get_contents('php://input');
$events = json_decode($content, true);
// Validate parsed JSON data
  if (!is_null($events['events'])) {
      foreach ($events['events'] as $event) {
          if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
              $text = $event['message']['text'];
	      $replyToken = $event['replyToken'] ;  	
	      $sValue[] = $text;
	      $sValue[] = $replyToken ;  
	      $sValue[] = $event['source']['userId'];              
          }                
      }    
  }  
} // end func 

function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
exit;

function pushMessage($text,$access_token,$replyToken) {

	// Make a POST Request to Messaging API to reply to sender
	        $messages = [
				'type' => 'text',
				'text' => $text
			];

			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];

			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
}

function pushImage($ImageFileName,$access_token,$replyToken) {


	// Make a POST Request to Messaging API to reply to sender


	       

			$messages = [
				'type' => "image",
				 "originalContentUrl"=>$ImageFileName,
                 "previewImageUrl"=> $ImageFileName
			];

			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];

			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";

} 


function getPortImageURL($contact9No,$userID) { 


       $data = array (
        'contact9No' => $contact9No,
        'key2' => 'value2',
        'key3' => 'value3',
	    'userid' => $userID       
        );
        
        $params = '';
        foreach($data as $key=>$value)
                $params .= $key.'='.$value.'&';
         
        $params = trim($params, '&'); 

	$params = "contact9No=" . $contact9No ;
	$params .= "&userid=" . $userID ;

    $url= "https://talonplus.co.th/port/class/clsCreatePortImageByCurl.php" ;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url.'?'.$params ); //Url together with parameters
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 170); //Timeout after 7 seconds
    curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    
    $result = curl_exec($ch);
    curl_close($ch);

    if(curl_errno($ch))  //catch if curl error exists and show it
      $result =  'Curl error: ' . curl_error($ch);
    else
     echo $result;
         
    return $result ;

    
} // end func

return;
 
 ?>
 

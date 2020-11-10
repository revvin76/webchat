<?php
$apiKey = "d30de045bb6d5ff11cdec4e68d6d86a545802aaebabb390e52d903ff24f7656b";
//$apiKey = ossn_services_apikey();
$site_url = ossn_site_url('api/v1.0/');
$addURL = $siteURL."message_add?";
$listURL = $siteURL."message_list?";
$userURL = $siteURL."user_details?";
$notifsURL = $siteURL."notifications_count?";
$notifcountURL = $siteURL."unread_mesages_count_custom?";
$recentURL = $siteURL."message_recent?";
//******************************************************************************//

function CallAPI ($url,$post) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
/* 	file_put_contents ("api_log.txt","API called with ".print_r($_POST,true).'<br>',FILE_APPEND);
	file_put_contents ("api_log.txt","URL ".print_r($url,true).print_r($post,true).'<br>',FILE_APPEND);	
	file_put_contents ("api_log.txt","API results: ".print_r(json_decode($result),true).'<br>',FILE_APPEND); */
	return json_decode($result);
}
function elapsed_time($timestamp, $precision = 1) {
  $time = time() - $timestamp;
  $a = array('decade' => 315576000, 'year' => 31557600, 'month' => 2629800, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'min' => 60, 'sec' => 1);
  $i = 0;
  foreach($a as $k => $v) {
    $$k = floor($time/$v);
    if ($$k) $i++;
    $time = $i >= $precision ? 0 : $time - $$k * $v;
    $s = $$k > 1 ? 's' : '';
    $$k = $$k ? $$k.' '.$k.$s.' ' : '';
    @$result .= $$k;
  }
  return $result ? $result.'ago' : '1 sec to go';
}
function checkStatus($guidToCheck) {
	$friends = ossn_loggedin_user()->getFriends();
	if(!$friends) {
			return false;
	}
	foreach($friends as $friend) {
			$status = 0;
			if(($friend instanceof OssnUser) && $friend->guid == $guidToCheck) {
				return $friend->isOnline(10)==1?"online":"busy";
			}
	}
	return false;
}	

if (($_POST['action'] !== null) && ($_POST['action'] == 'send')) {
    $from = filter_var($_POST['from'], FILTER_SANITIZE_NUMBER_INT);
    $to = filter_var($_POST['to'], FILTER_SANITIZE_NUMBER_INT);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
	
	$addPARAM = array( 'api_key_token' => $apiKey , 'from' => $from,'to' => $to, 'message' => $message);
	$addMessage = CallAPI ($addURL , $addPARAM);
	return $addMessage;
}

if (($_POST['action'] !== null) && ($_POST['action'] == 'messages')) {
  	$with = filter_var($_POST['to'], FILTER_SANITIZE_NUMBER_INT);
	$userPARAM = array( 'api_key_token' => $apiKey , 'guid' =>  $with);
	$user2 = CallAPI ($userURL , $userPARAM);
	
 	$listPARAM = array( 'api_key_token' => $apiKey , 'guid' => ossn_loggedin_user()->guid , 'to' => $user2->payload->guid, 'markallread' => 1);
	$listMessages = CallAPI ($listURL , $listPARAM); 

	echo ('
		<div class="contact-profile">
			<img src="' . $user2->payload->icon->small . '" alt="' . $user2->payload->fullname . '" />
			<p>' . $user2->payload->first_name . '</p>
			<!--<div class="social-media">
				<i class="fa fa-facebook" aria-hidden="true"></i>
				<i class="fa fa-twitter" aria-hidden="true"></i>
				 <i class="fa fa-instagram" aria-hidden="true"></i>
			</div>-->
		</div>
		<div class="messages">
			<ul>');
			
					foreach($listMessages->payload->list as $message)
					{
						if ($message->message_from->guid == ossn_loggedin_user()->guid) {
							echo  '<li class="sent">';						
							echo  '<img src="' . ossn_loggedin_user()->iconURLS->small . '" alt="" />';
							echo  '<article><section class="message">' . $message->message . '</section><section class="message_time">' . elapsed_time($message->time) . '</section></article>';
						} else {
							echo  '<li class="replies">';
							echo  '<img src="' . $user2->payload->icon->small . '" alt="" />';
							echo  '<article><section class="message">' . $message->message . '</section><section class="message_time">' . elapsed_time($message->time) . '</section></article>';
						}
						$data .= '</li>';
					};
		echo  ('	</ul>
		</div>');
}

if (($_POST['action'] !== null) && ($_POST['action'] == 'recent')) {
	$recentPARAM = array( 'api_key_token' => $apiKey , 'guid' => ossn_loggedin_user()->guid );
	$recentMessages = CallAPI ($recentURL , $recentPARAM);

	echo '	<ul>';	
				$i = 0;
				foreach($recentMessages->payload->list as $messageThread)
					{
						if ( $messageThread->message_to->guid == ossn_loggedin_user()->guid ) {
							$current_message = $messageThread->message_from;
							$withguid = $messageThread->message_from->guid;
						} else {
							$current_message = $messageThread->message_to;
							$withguid = $messageThread->message_to->guid;						
						}
						echo '<li class="contact';
						if ($withguid == $_POST['active']) echo " active";
						echo '" id="'. $withguid .'">
							<div class="wrap">		
								<span class="contact-status ' . checkStatus($withguid) . '"></span>';
								
								if ($messageThread->viewed == 0) {
									echo '<i class="fa fa-comment contact-new" aria-hidden="true"></i>';
								}
								
						echo '<img src="' . $current_message->icon->small . '" alt="" />
								<div class="meta">
									<p class="name">' . $current_message->username . '</p>
									<p class="preview">' . $current_message->message . '</p>
								</div>
							</div>
						</li>';
						$i++;
					};
					
					
				echo "	<script>
				$(function() {
					$('li.contact').click(function() {
					  $('li.contact').removeClass('active');
					  $(this).find('.contact-new').remove();
					  $(this).addClass('active');
					  withguid = $(this).attr('id');
					  updateActive(withguid);
					  listMessages(withguid);
					});
				});	
				</script>	
				</ul>";
}

if (($_POST['action'] !== null) && ($_POST['action'] == 'notifs')) {
    $guid = filter_var($_POST['guid'], FILTER_SANITIZE_NUMBER_INT);	
	
    /* Get the live notification counts */
	$notifcountPARAM = array( 'api_key_token' => $apiKey , 'guid' => $guid);
	$notifcount = CallAPI ($notifcountURL , $notifcountPARAM);
	
	$notifs = $_POST['notifs'];
	
	// Check whether the stored notifications count match the live notifications count
	if ( $notifcount->payload === $notifs->payload || $notifcount->payload === false) {
		// We'll return false, as there is no need to perform any further actions when the live count hasn't changed
		$response = [ 
		'success' => false,
		'message' => 'Failed'
		];
		echo json_encode($response);
		return false;
	} else {
		// We know there has been a change, we just need to determine if it was from the user currently chatting
		$current_chat = false;
		$current_guid = $_POST['currentuser'];
		
 		foreach ( $notifcount->payload as $live_count ) {
			if ( $current_guid == $live_count->message_from) {
				// We've found notifications regarding the current chat, need to return whether the count has changed
				if ($notifs->payload) {
					foreach ($notifs->payload as $orig_count) {
						if ($live_count->message_from == $orig_count->message_from ) {
							if ( $live_count->total > $orig_count->total ) {
								$current_chat = true;
							}					
						}
					}
				} else {
					$current_chat = true;
				}
			}
		} 
		$response = [ 
		'success' => true,
		'current_chat' => $current_chat,
		'payload' => $notifcount->payload,
		'message' => 'Success'
		];
		echo json_encode($response);
		return true;
	}
}


			
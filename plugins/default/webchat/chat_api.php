<?php
$apiKey = ossn_services_apikey();
$siteURL = ossn_site_url('api/v1.0/');
$addURL = $siteURL."message_add?";
$listURL = $siteURL."message_list?";
$userURL = $siteURL."user_details?";
$notifsURL = $siteURL."notifications_count?";
$notifcountURL = $siteURL."unread_mesages_count_custom?";
$recentURL = $siteURL."message_recent?";

$component = new OssnComponents;
$WebChat  = $component->getSettings("webchat");
//******************************************************************************//
function CallAPI ($url,$post) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
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
function returnFriendStatuses() {
	$friends = ossn_loggedin_user()->getFriends();
	if(!$friends) {
			return false;
	}
	$friendStatuses = [];
	foreach($friends as $friend) {
		if($friend instanceof OssnUser) {
			$friendStatuses[$friend->guid] =  $friend->isOnline(10);
		}
	}
	return json_encode($friendStatuses);
}

if ((input('action') !== null) && (input('action') == 'getuser')) {
	$userPARAM = array( 'api_key_token' => $apiKey , 'guid' => input('guid'));
	$userDetails = CallAPI ($userURL , $userPARAM);
	echo json_encode($userDetails);
	exit;
}
if ((input('action') !== null) && (input('action') == 'send')) {
    $from = filter_var(input('from'), FILTER_SANITIZE_NUMBER_INT);
    $to = filter_var(input('to'), FILTER_SANITIZE_NUMBER_INT);

	$send = new OssnMessages;

	$nl2br = str_ireplace(array("\r\n","\r","\n",'\r','\n'),'<br />', input("message"));
	$message = str_ireplace(array('<br /><br />','<br />'),'\r\n', $nl2br);

	error_log('\n replaced?: ' . PHP_EOL . $message . PHP_EOL );
	
	if(trim(ossn_restore_new_lines($message)) == ''){
		echo 0;
		exit;
	}
	$to = input('to');
	if ($message_id = $send->send(ossn_loggedin_user()->guid, $to, $message)) {
		$user = ossn_user_by_guid(ossn_loggedin_user()->guid);
		
		$instance = ossn_get_message($message_id);
		$message = $instance->message;
		
		$params['message_id'] = $message_id;
		$params['user'] = $user;
		$params['message'] = $message;
		$params['instance'] = $instance;
		$params['view_type'] = 'actions/send';
		echo ossn_plugin_view('messages/templates/message-send', $params);
	} else {
		echo 0;
	}
exit;

}

if ((input('action') !== null) && (input('action') == 'messages')) {
  	$with = filter_var(input('to'), FILTER_SANITIZE_NUMBER_INT);
	$user2 = ossn_user_by_guid($with);
 	
	$listPARAM = array( 'api_key_token' => $apiKey , 'guid' => ossn_loggedin_user()->guid , 'to' => $user2->guid, 'markallread' => 1);
	if (input('offset')) $listPARAM['offset'] = input('offset'); 
	$listMessages = CallAPI ($listURL , $listPARAM); 

				if ($listMessages->payload->count > 0) {
					$maxPages = ceil($listMessages->payload->count / 10);
					if ($maxPages > 1) {
						// echo '<span id="loadMore" data-page="1"> ^^^ load more ^^^</span>';
					}
					$returnArray = array();
					$returnArray['maxpages'] = $maxPages;
					$returnArray['page'] = $listMessages->payload->offset;
					$returnArray['user1icon'] = ossn_loggedin_user()->iconURL()->small;
					$returnArray['user2icon'] = $user2->iconURL()->smaller;
					$returnArray['user2name'] = $user2->first_name;
					$returnArray['messages'] = array();
					$returnMessages = array();
					
					foreach($listMessages->payload->list as $message)
					{
						$returnRecord = array();		
						$returnRecord['id'] = json_decode($message->id);
						$returnRecord['elapsed'] = elapsed_time($message->time);
						
						// GIPHY
						$json = json_decode(html_entity_decode($message->message),true);

						// Lets check if its a single emoji, and if so make it bigger
						$lgemoji = "";
						// Check the message contains a single unicode character
						if ((strlen(html_entity_decode($message->message)) == 4) && (strlen($message->message) != strlen(html_entity_decode($message->message)))) {
							$lgemoji = "lg-emoji";														
						}
						$returnRecord['lgemoji']=$lgemoji;
						
						// Check whether the most recent message to contact has been viewed
						if ($message->viewed == 0) {
							$tick='<i class="fa fa-circle sent-unread" aria-hidden="true"></i>';
						} else {
							$tick='<i class="fa fa-circle sent-read" aria-hidden="true"></i>';
						}
						$returnRecord['viewed']=$message->viewed;
						
						if ($json['img']) {
							$returnRecord['json']="true";
							$returnRecord['giphyOriginal'] = $json[bigImg];
							$returnRecord['giphyPreview'] = $json[img];
							if ($message->message_from->guid == ossn_loggedin_user()->guid) {
								$returnRecord['direction'] = "sent";
							} else {
								$returnRecord['direction'] = "replies";
							}
						} else {
							$returnRecord['json']="false";
							$returnRecord['message'] = $message->message;
							if ($message->message_from->guid == ossn_loggedin_user()->guid) {
								$returnRecord['direction'] = "sent";
							} else {
								$returnRecord['direction'] = "replies";
							}
						}
						$returnMessages[]=$returnRecord;
					};
					$returnArray['messages'] = $returnMessages;
				}

		echo json_encode($returnArray);
		exit;
}

if ((input('action') !== null) && (input('action') == 'recent')) {
	$recentPARAM = array( 'api_key_token' => $apiKey , 'guid' => ossn_loggedin_user()->guid );
	$recentMessages = CallAPI ($recentURL , $recentPARAM);
	
	$recentMessages = addFriends($recentMessages);
 	if ($recentMessages->payload->count > 0) {
		$i = -1;	
		foreach($recentMessages->payload->list as $messageThread) {
			$i++;
			if ( $messageThread->message_to->guid == ossn_loggedin_user()->guid ) {
				$withguid = $messageThread->message_from->guid;
			} else {
				$withguid = $messageThread->message_to->guid;		
			}
			$recentMessages->payload->list[$i]->status = checkStatus($withguid)?checkStatus($withguid):'offline';
			$recentMessages->payload->list[$i]->elapsed = elapsed_time($messageThread->time);
		}
	} 
	echo json_encode($recentMessages);
}

if ((input('action') !== null) && (input('action') == 'notifs')) {
    $guid = filter_var(input('guid'), FILTER_SANITIZE_NUMBER_INT);	
	
    /* Get the live notification counts */
	$notifcountPARAM = array( 'api_key_token' => $apiKey , 'guid' => $guid);
	$notifcount = CallAPI ($notifcountURL , $notifcountPARAM);
	
	$notifs = json_decode(htmlspecialchars_decode(input('notifs')));

	
	// Check whether the stored notifications count match the live notifications count
	if ( $notifcount->payload === $notifs->payload || $notifcount->payload === false) {
		// We'll return false, as there is no need to perform any further actions when the live count hasn't changed
		$response = [ 
		'success' => false,
		'statuses' => returnFriendStatuses(),
		'message' => 'Failed'  // send "failed" if there are no unread messages
		];
		echo json_encode($response);
		return false;
	} else {
		// We know there has been a change, we just need to determine if it was from the user currently chatting
		$current_chat = false;
		$current_guid = intval(input('currentuser'));
		
		// If current_guid = -1, then we havent selected a chat to view yet, so we skip the below loops
		if ($current_guid !== -1) {
			$current_chat = true;
		}
		$response = [ 
		'success' => true,
		'current_chat' => $current_chat,
		'payload' => $notifcount,
		'message' => 'Success',
		'statuses' => returnFriendStatuses()
		];
		echo json_encode($response);
		return true;
	}

}

function addFriends ($recentMessages) {
		$friends = ossn_loggedin_user()->getFriends();
	if(!$friends) {
			return false;
	}
	
	$guids = array();
	foreach ($recentMessages->payload->list as $data) {
		if (!in_array($data->message_from->guid, $guids)) $guids[] = intval($data->message_from->guid,10);
		if (!in_array($data->message_to->guid, $guids)) $guids[] = intval($data->message_to->guid,10);
	}

	foreach($friends as $friend) {
		if($friend instanceof OssnUser) {
			if (!in_array($friend->guid,$guids)) {
				$recentMessages->payload->list[] = 
								array ("message_from" => array ( "guid" => $friend->guid,
														 "fullname" => $friend->fullname,
														 "username" => $friend->username,
														 "icon" => array ( "small" => $friend->iconURL()->small )
														),
								"message_to" => array ( "guid" => $friend->guid,
														 "fullname" => $friend->fullname,
														 "username" => $friend->username,
														 "icon" => array ( "small" => $friend->iconURL()->small )
														),
								"message" => "",
								"viewed" => "",
								"elapsed" => "" );
			}
		}
		
	}								
	return ($recentMessages);
}

/// Useful function below just for debugging. Console.log the returned data to see whats happening.
if ((input('action') !== null) && (input('action') == 'compare')) {
		$friends = ossn_loggedin_user()->getFriends();
	if(!$friends) {
			return false;
	}
	
	$guids = array();
	foreach ($recentMessages->payload->list as $data) {
		if (!in_array($data->message_from->guid, $guids)) $guids[] = intval($data->message_from->guid,10);
		if (!in_array($data->message_to->guid, $guids)) $guids[] = intval($data->message_to->guid,10);
	}

	foreach($friends as $friend) {
		if($friend instanceof OssnUser) {
			echo print_r($friend->iconURL()->small);
		}
		
	}								
}
			
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
$WebChat  = new WebChat;
$WebChatSettings  = $component->getSettings("webchat");
//******************************************************************************//

// Validate given token to ensure its valid. Redirect to webchat home if not, where you'll automatically redirect to login if required.
$ossnts = input('ossn_ts');
$ossntoken = input('ossn_token');
if(empty($ossnts) || empty($ossntoken)){
	header("Location: " . ossn_site_url('webchat'));
}
$generate = ossn_generate_action_token($ossnts);
if ($ossntoken != $generate) {
	header("Location: " . ossn_site_url('webchat'));
}


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
  $time = time() - strtotime($timestamp);
  $a = array('decade' => 315576000, 'year' => 31557600, 'month' => 2629800, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'min' => 60, 'sec' => 1);
  $i = 0;
  if ($time < 86400) {
	  $date = date_create($timestamp);
	  return date_format($date, 'H:i');
  }
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
							$returnRecord['giphyOriginal'] = $json["bigImg"];
							$returnRecord['giphyPreview'] = $json["img"];
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
			if ($withguid){
				$recentMessages->payload->list[$i]->status = checkStatus($withguid)?checkStatus($withguid):'offline';
				$recentMessages->payload->list[$i]->elapsed = elapsed_time($messageThread->time);
			}
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
								"time" => "",
								"status" => "",
								"payload" => "",
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
if ((input('action') !== null) && (input('action') == 'leaveGroup')) {
	if (empty(input('groupid'))) {
		echo setReturnArray ("Failed", "No groupid provided");
		return false;
	}
	
	if (!$group = $WebChat->removeMember(input('groupid'), ossn_loggedin_user()->guid)) {
		echo setReturnArray ("Success", ossn_print('com:webchat:group:leavegroup:success'),array('message' => ossn_loggedin_user()->fullname.ossn_print('com:webchat:group:leavegroup:info')));
		return;
	}
	echo setReturnArray ("Failed", $group );
	return;
}		
if ((input('action') !== null) && (input('action') == 'delegateAdmin')) {
	if (empty(input('groupid')) || empty(input('userid'))) {
		echo setReturnArray ("Failed", "No groupid or userid provided");
		return false;
	}
	$groupid = input('groupid');
	$userid = input('userid');
	
	if ($WebChat->delegateAdmin($groupid, $userid, ossn_loggedin_user()->guid)) {
		
		$user       = new OssnUser;
		$user->guid = ossn_loggedin_user()->guid;
		$member = $user->getUser();
		$olduser = $member->fullname;
		$user       = new OssnUser;
		$user->guid = $userid;
		$member = $user->getUser();
		$newuser = $member->fullname;
		echo setReturnArray ("Success", ossn_print('com:webchat:group:delegate:success'), array("message" => "$olduser has delegated admin of this group to $newuser"));
		return;
	}
	
	echo setReturnArray ("Fail", ossn_print('com:webchat:group:delegate:fail') );
	return;
}
if ((input('action') !== null) && (input('action') == 'getGroup')) {
	if (empty(input('groupid'))) return false;
	if (!$group = $WebChat->getGroup(input('groupid'))) {
		return;
	}
	if (!$members = $WebChat->getGroupMembers(input('groupid'))) {
		return;
	}
	$group = json_decode(json_encode($group), true);
	$members = json_decode(json_encode($members), true);
	$group['members'] = $members;
	echo json_encode($group);
	return;
}
if ((input('action') !== null) && (input('action') == 'getGroupMembers')) {
	if (empty(input('groupid'))) return false;

	$tmp = $WebChat->ownerCheck(input('groupid'));
	$tmp = json_decode(json_encode($tmp),true);
	if (!$tmp[0]['owner'] == ossn_loggedin_user()->guid) {
		echo setReturnArray ("Error", ossn_print('com:webchat:group:permissions'). " user:".ossn_loggedin_user()->guid);
		return false;	
	}
	
	if (!$group = $WebChat->getGroup(input('groupid'))) {
		echo setReturnArray ('Error', 'Unable to getGroup');
		return false;
	}
	if (!$members = $WebChat->getGroupMembers(input('groupid'))) {
		echo setReturnArray ('Error', 'Unable to getGroupMembers');
		return false;
	}
	if(!$friends = ossn_loggedin_user()->getFriends()) {
		setReturnArray ("Error","Failed to get Friends list");
		return false;
	}
	$memberStatuses = [];
	foreach($members as $member) {
		$user       = new OssnUser;
		$user->guid = $member->userid;
		$member = $user->getUser();
		$memberStatuses[$member->guid] =  array (
			"icon" => $member->iconURL()->small,
			"name" => $member->fullname
		);
	}
	$friendStatuses = [];
	foreach($friends as $friend) {
		if($friend instanceof OssnUser) {
			$friendStatuses[$friend->guid] =  array (
				"icon" => $friend->iconURL()->small,
				"name" => $friend->fullname
			);
		}
	}
	echo setReturnArray ("Success", "Members retrieved successfully",array('members' => $memberStatuses, 'friends' => $friendStatuses));
	return;
}					
if ((input('action') !== null) && (input('action') == 'getFriends')) {
	$returnArray=array();
		$record=array();
		$record["fullname"] = ossn_loggedin_user()->fullname;
		$record["username"] = ossn_loggedin_user()->username;
		$record["iconsmall"] = ossn_loggedin_user()->iconURL()->small;
		$record["iconsmaller"] = ossn_loggedin_user()->iconURL()->smaller;
		$returnArray[ossn_loggedin_user()->guid] = $record;
	
	foreach($WebChat->getMemberIDs(ossn_loggedin_user()->guid) as $key => $value) {
		$user       = new OssnUser;
		$user->guid = $value->userid;
		$friend = $user->getUser();
		$record=array();
		$record["fullname"] = $friend->fullname;
		$record["username"] = $friend->username;
		$record["iconsmall"] = $friend->iconURL()->small;
		$record["iconsmaller"] = $friend->iconURL()->smaller;
		$returnArray[$friend->guid] = $record;
	}

	foreach (ossn_loggedin_user()->getFriends() as $friend) {
		$record=array();
		$record["fullname"] = $friend->fullname;
		$record["username"] = $friend->username;
		$record["iconsmall"] = $friend->iconURL()->small;
		$record["iconsmaller"] = $friend->iconURL()->smaller;
		$returnArray[$friend->guid] = $record;
	}
	echo json_encode($returnArray);
	return;
}
if ((input('action') !== null) && (input('action') == 'getGroups')) {
	$owner = ossn_loggedin_user()->guid;
	if (!$groups = $WebChat->getGroups($owner)) {
		return false;
	}
	$groups = json_decode(json_encode($groups), true);
	
	foreach($groups as $index => $record) {
		$groups[$index]['time'] = elapsed_time($groups[$index]['time']);
		if (empty($groups[$index]['name'])) {
				$members = $WebChat->getGroupMembers($groups[$index]['groupid']);
				$members = json_decode(json_encode($members),true);
				$memberStatuses = [];
				foreach($members as $key => $member) {
					$user       = new OssnUser;
					$user->guid = $members[$key]['userid'];
					$member = $user->getUser();
					$memberStatuses[] = $member->fullname;
				}
				$groups[$index]['name'] = natural_language_join($memberStatuses);
		}
	}	
	
	echo json_encode($groups);
	return;
}				
if ((input('action') !== null) && (input('action') == 'renameGroup')) {
	
	if (empty(input('groupid'))) {
		echo setReturnArray ("Failed", "No group id provided.");
		return false;
	}
	
	$tmp = $WebChat->ownerCheck(input('groupid'));
	$tmp = json_decode(json_encode($tmp),true);
	if (!$tmp[0]['owner'] == ossn_loggedin_user()->guid) {
		echo setReturnArray ("Error", ossn_print('com:webchat:group:permissions'). " user:".ossn_loggedin_user()->guid);
		return false;	
	}

	$groupid = input('groupid');
	if (empty(input('name'))) {
		$name  = "";
	} else {
		$name  = input('name');
	}
	
	if (!$result = $WebChat->renameGroup($groupid, $name, ossn_loggedin_user()->guid)) {
		echo setReturnArray ("Failed", "There was an issue renaming the group.");
		// echo setReturnArray ("Error", $result);
		return false;
	}
	
	echo setReturnArray ("Success", "Successfully renamed the group.",array('message' => ossn_loggedin_user()->fullname.ossn_print('com:webchat:group:rename:info'), 'name' => $name));
	return;
}					
if ((input('action') !== null) && (input('action') == 'getGroupPhotos')) {
	if (empty(input('groupid'))) {
		echo setReturnArray ("Failed", "No group id provided: groupid = ".input('groupid'));
		return false;
	}
	$group = input('groupid');
	if (!$groupphotos = $WebChat->getGroupPhotos($group)) {
		echo setReturnArray ("Failed", "There was an issue getting the photos.", array("groupPhotos" => $groupphotos ));
		return false;
	}
	
	echo setReturnArray ("Success", "Successfully retrieved photos.", $groupphotos);
	return;
}		
if ((input('action') !== null) && (input('action') == 'getContacts')) {
	$friends = ossn_loggedin_user()->getFriends();
	if(!$friends) {
			return false;
	}
	$friendStatuses = [];
	foreach($friends as $friend) {
		if($friend instanceof OssnUser) {
			$friendStatuses[$friend->guid] =  array (
				//"status" => $friend->isOnline(10),
				"icon" => $friend->iconURL()->small,
				"name" => $friend->fullname
			);
		}
	}
	echo json_encode($friendStatuses);
	return;
}		
if ((input('action') !== null) && (input('action') == 'createGroup')) {
	$name = input('name') ? input('name') : '';
	$owner = ossn_loggedin_user()->guid;
	$guids = explode(',', input('guids'));
	if ($groupid = $WebChat->createGroup($name,$owner)) {
		if (!$WebChat->addMember($groupid, $owner)) {
			echo setReturnArray ("Failed", "Unable to set owner of group.");
			return false;
		}
		
		if ($guids){
			foreach ($guids as $guid) {
				if (!$WebChat->addMember($groupid, $guid)) {
					echo setReturnArray ("Failed", "Unable to add member " . $guid . " to group.");
					return false;
				}
			}
		}
	}
	echo setReturnArray ("Success", "Group created.", $groupid);

	return;
}
if ((input('action') !== null) && (input('action') == 'getGroupMessages')) {
	if (empty(input('groupid'))) {
		return false;
	}
	$userid = ossn_loggedin_user()->guid;
	$group = intVal(input('groupid'));

	if (!$messages = $WebChat->getMessages($group, $userid)) {
		return false;
	}
	$messages = json_decode(json_encode($messages), true);

	foreach ($messages as $i => $message) {
		$messages[$i]['message'] = str_ireplace("\r\n","<br />", $messages[$i]['message']);
		if ($message['preview']) {
			$preview = json_decode($message['preview'],true);		
			$tmp = json_decode(json_encode($WebChat->getThumbURL($preview['thumbid'])),true);
			$preview['thumb'] = $tmp[0]['photo'];
			$messages[$i]['preview'] = $preview;
			$messages[$i]['elapsed'] = elapsed_time($messages[$i]['time']);		
		}
	}
	echo json_encode($messages);
	return;
}		
if ((input('action') !== null) && (input('action') == 'send')) {
	if (empty(input('group')) || empty(input('message'))) {
		echo setReturnArray ("Failed", 'empty parameters');
		return false;
	}
	
    $group = filter_var(input('group'), FILTER_SANITIZE_NUMBER_INT);
    $message = input('message');

	$send = new WebChat;

	$nl2br = str_ireplace(array("\r\n","\r","\n",'\r','\n'),'<br />', $message);
	$message = str_ireplace(array('<br /><br />','<br />'),'\r\n', $nl2br);
	$message = str_ireplace(array('&amp;'),'&', $message);
	
	if(trim(ossn_restore_new_lines($message)) == ''){
		echo 0;
		exit;
	}
	$to = input('to');
	
	if (!empty(input('status')) && input('status') == 'info') {
		$userid = 0;
	} else {
		$userid = ossn_loggedin_user()->guid;
	}	

	// $url_pattern = '/[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/';
	// $url_pattern = '/((https?|ftp|file)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/';
	$url_pattern = '/((https?|ftp|file)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/';
	

	$preview = false;
	if(preg_match($url_pattern, $message, $m)) {
		$preview = wcGetURLPreview($m[0]);
	}
	
	if (!$message_id = $send->sendMessage($group, $userid, urldecode($message),$preview)) {
		echo setReturnArray ("Failed", $message_id );
		return false;
	}
	
	echo setReturnArray ("Success", "Succesfully sent message", $message_id);
	return;
}
if ((input('action') !== null) && (input('action') == 'setGroupPhoto')) {
	
	$filename = uniqid(rand(), true) . '.png';
	$groupimages_dir = ossn_route()->www . 'images/groups/' . input('groupid') . '/';
	$site  = new OssnFile;
	$site->setFile('group_image');
	$site->setExtension(array(
			'png',
	));

	if(isset($site->file['tmp_name'])){
		if(!is_dir($groupimages_dir)) {
			mkdir($groupimages_dir, 0755);
		}
		if(is_dir($groupimages_dir)) {
			$file = $site->file['tmp_name'];
			$size = filesize($file);
			if($size > 0){
				if($size > 1500000){ //1,500KB
					echo setReturnArray ("Failed", ossn_print('com:webchat:group:changephoto:toobig'));
					return false;
				}
				$image_info = getimagesize($file);
				if (!in_array($image_info['mime'], array('image/png', 'image/gif', 'image/jpeg'))) {
					echo setReturnArray ("Failed", ossn_print('com:webchat:group:changephoto:wrongtype'));
					return false;
				}
				// if($image_info[0] != $image_info[1]) {
					// echo setReturnArray ("Failed", ossn_print('wrong_aspect_ratio'));
					// return false;
				// }
				if($image_info[0] > 1920 || $image_info[1] > 1080) {
					echo setReturnArray ("Failed", ossn_print('com:webchat:group:changephoto:toolarge')." ".$image_info[0]);
					return false;
				}
				$contents = file_get_contents($file);
				if (!(strlen($contents) > 0 && file_put_contents($groupimages_dir . $filename, $contents))){
					echo setReturnArray ("Failed",'Image upload failed');
					return false;
				}
			}
		} else {
			echo setReturnArray ("Failed",'Error creating folder');
			return false;
		}


		if (!$groupphoto = $WebChat->changePhoto(input('groupid'), $filename, ossn_loggedin_user()->guid)) {
			echo setReturnArray ("Failed", "There was a problem changing the group's photo.");
			return false;
		}
		echo setReturnArray ("Success", ossn_print('com:webchat:group:changephoto:success'),array('message' => ossn_loggedin_user()->fullname.ossn_print('com:webchat:group:changephoto:info'), 'filename' => $filename));
		return;
	} 
	echo setReturnArray ("Failed", "There was a problem changing the group's photo.");
	return false;
}
if ((input('action') !== null) && (input('action') == 'getThumbs')) {
	
	$filename = uniqid(rand(), true);
	$userimages_dir = ossn_route()->www . 'images/users/' . ossn_loggedin_user()->guid . '/';
	$site  = new OssnFile;
	$site->setFile('image-upload');
	$site->setExtension(array(
			'png',
	));

	if(isset($site->file['tmp_name'])){
		if(!is_dir($userimages_dir)) {
			mkdir($userimages_dir, 0755);
		}
		if(is_dir($userimages_dir)) {
			$file = $site->file['tmp_name'];
			$size = filesize($file);
			if($size > 0){
				if($size > 5000000){ //5,000KB
					echo setReturnArray ("Failed", ossn_print('com:webchat:group:changephoto:toobig'));
					return false;
				}
				$image_info = getimagesize($file);
				if (!in_array($image_info['mime'], array('image/png', 'image/gif', 'image/jpeg'))) {
					echo setReturnArray ("Failed", ossn_print('com:webchat:group:changephoto:wrongtype'));
					return false;
				}
				
				///////////////////////////////////////////////////////////////////////////////////////////////				
				//path for the image
				$source_url = $file;

				//separate the file name and the extention
				$source_url_parts = pathinfo($source_url);

				if ($image_info['mime'] == 'image/png') {
					$extension = 'png';
				} else {
					$extension = 'jpg';
				}
				//define the quality from 1 to 100
				$quality = 10;

				//detect the width and the height of original image
				list($width, $height) = getimagesize($source_url);
				$width;
				$height;

				//define any width that you want as the output. mine is 200px.
				$after_width = 250;

				//resize only when the original image is larger than expected with.
				//this helps you to avoid from unwanted resizing.
				if ($width > $after_width) {

					//get the reduced width
					$reduced_width = ($width - $after_width);
					//now convert the reduced width to a percentage and round it to 2 decimal places
					$reduced_radio = round(($reduced_width / $width) * 100, 2);

					//ALL GOOD! let's reduce the same percentage from the height and round it to 2 decimal places
					$reduced_height = round(($height / 100) * $reduced_radio, 2);
					//reduce the calculated height from the original height
					$after_height = $height - $reduced_height;

					//Now detect the file extension
					//if the file extension is 'jpg', 'jpeg', 'JPG' or 'JPEG'
					if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'JPG' || $extension == 'JPEG') {
						//then return the image as a jpeg image for the next step
						$img = imagecreatefromjpeg($source_url);
					} elseif ($extension == 'png' || $extension == 'PNG') {
						//then return the image as a png image for the next step
						$img = imagecreatefrompng($source_url);
					} else {
						//show an error message if the file extension is not available
						echo 'image extension is not supported (getThumbs)';
					}

					//HERE YOU GO :)
					//Let's do the resize thing
					//imagescale([returned image], [width of the resized image], [height of the resized image], [quality of the resized image]);
					$imgResized = imagescale($img, $after_width, $after_height, $quality);

					//now save the resized image with a suffix called "-resized" and with its extension. 
					imagejpeg($imgResized, $userimages_dir . 'thumb_' . $filename . "." . $extension);
						// echo setReturnArray ("Failed",'Image thumb upload failed', array('filename' => $userimages_dir . 'thumb_' . $filename . $extension));
						// return false;
					// }	
					//Finally frees any memory associated with image
					//**NOTE THAT THIS WONT DELETE THE IMAGE
					imagedestroy($img);
					imagedestroy($imgResized);
				}
				///////////////////////////////////////////////////////////////////////////////////////////////				

				$contents = file_get_contents($file);
			
				if (!(strlen($contents) > 0 && file_put_contents($userimages_dir . $filename . "." . $extension, $contents))){
					echo setReturnArray ("Failed",'Image upload failed');
					return false;
				}
			}
		} else {
			echo setReturnArray ("Failed",'Error creating folder');
			return false;
		}

		echo setReturnArray ("Success", "Photo message sent",array('hd' => "/users/". ossn_loggedin_user()->guid  . '/' . $filename . "." . $extension, 'thumb' => "/users/". ossn_loggedin_user()->guid  . '/' . "thumb_" . $filename . "." . $extension));
		return;
	} 
	echo setReturnArray ("Failed", "There was a problem changing the group's photo.");
	return false;
}
if ((input('action') !== null) && (input('action') == 'selectPhoto')) {
	if (empty(input('groupid')) || empty(input('selected'))) {
		echo setReturnArray ("Failed", "No group id or photo provided");
		return false;
	}
	
	$tmp = $WebChat->ownerCheck(input('groupid'));
	$tmp = json_decode(json_encode($tmp),true);
	if (!$tmp[0]['owner'] == ossn_loggedin_user()->guid) {
		echo setReturnArray ("Error", ossn_print('com:webchat:group:permissions'). " user:".ossn_loggedin_user()->guid);
		return false;	
	}
	
	if (!$groupphoto = $WebChat->changePhoto(input('groupid'), input('selected'), ossn_loggedin_user()->guid, true)) {
		echo setReturnArray ("Failed", "There was a problem changing the group's photo.");
		return false;
	}
	echo setReturnArray ("Success", ossn_print('com:webchat:group:changephoto:success'),array('message' => ossn_loggedin_user()->fullname.ossn_print('com:webchat:group:changephoto:info'), 'filename' => input('selected')));
	return;
}
if ((input('action') !== null) && (input('action') == 'addMembers')) {
	if (empty(input('groupid')) || empty(input('guids'))) {
		echo setReturnArray ("Failed", "No group id or members");
		return false;
	}
	
	$tmp = $WebChat->ownerCheck(input('groupid'));
	$tmp = json_decode(json_encode($tmp),true);
	if (!$tmp[0]['owner'] == ossn_loggedin_user()->guid) {
		echo setReturnArray ("Error", ossn_print('com:webchat:group:permissions'). " user:".ossn_loggedin_user()->guid);
		return false;	
	}
	$groupid = input('groupid');
	$adds[]  = array_map('intval', explode(', ', input('guids')));	
	
	foreach ($adds[0] as $newmember) {
		if (!$WebChat->addMember($groupid, $newmember)) {
			echo setReturnArray ("Error", "There was an error adding member " . $newmember);
			return false;
		}
	}
	
	$addNames = array();
	
	if (count($adds[0]) == 1 ) {
		$user 		= new OssnUser();
		$user->guid = $adds[0][0];
		$user = $user->getUser();		
		$addSummary = $user->fullname . " has been added to the group.";
	} else if (count($adds[0]) >1 ) {
		foreach ($adds[0] as $member) {
			$user 		= new OssnUser();
			$user->guid = $member;
			$user = $user->getUser();
			$addNames[] = $user->fullname;
		}
		$addSummary = natural_language_join($addNames) . " have been added to the group.";
	} else $addSummary = null;
		
	echo setReturnArray ("Success", "Members added.", array('message' => $addSummary, 'added' => $adds[0]));
	return;
}
if ((input('action') !== null) && (input('action') == 'removeMembers')) {
	if (empty(input('groupid')) || empty(input('removes'))) {
		echo setReturnArray ("Failed", "No group id or members");
		return false;
	}
	
	$tmp = $WebChat->ownerCheck(input('groupid'));
	$tmp = json_decode(json_encode($tmp),true);
	if (!$tmp[0]['owner'] == ossn_loggedin_user()->guid) {
		echo setReturnArray ("Error", ossn_print('com:webchat:group:permissions'). " user:".ossn_loggedin_user()->guid);
		return false;	
	}
	$groupid = input('groupid');
	$removes[]  = array_map('intval', explode(', ', input('removes')));

	foreach ($removes[0] as $removemember) {
		if (!$WebChat->removeMember($groupid, $removemember)) {
			echo setReturnArray ("Error", "There was an error removing member " . $removemember, array('groupid'=>$groupid,'member'=>$removemember));
			return false;
		}
	}

	$removeNames = array();
	
	if (count($removes[0]) == 1 ) {
		$user 		= new OssnUser();
		$user->guid = $removes[0][0];
		$user = $user->getUser();		
		$removalSummary = $user->fullname . " has been removed from the group.";
	} else if (count($removes[0]) >1 ) {
		foreach ($removes[0] as $member) {
			$user 		= new OssnUser();
			$user->guid = $member;
			$user = $user->getUser();
			$removeNames[] = $user->fullname;
		}
		$removalSummary = natural_language_join($removeNames) . " have been removed from the group.";
	} else $removalSummary = null;
		
	echo setReturnArray ("Success", "Members removed.", array('message' => $removalSummary, 'removed' => $removes[0]));
	return;
}
if ((input('action') !== null) && (input('action') == 'deletePhoto')) {
	if (empty(input('groupid')) || empty(input('photoid'))) {
		echo setReturnArray ("Failed", "No group id or photoid");
		return false;
	}
	
	$tmp = $WebChat->ownerCheck(input('groupid'));
	$tmp = json_decode(json_encode($tmp),true);
	if (!$tmp[0]['owner'] == ossn_loggedin_user()->guid) {
		echo setReturnArray ("Error", ossn_print('com:webchat:group:permissions'). " user:".ossn_loggedin_user()->guid);
		return false;	
	}
	$groupid = input('groupid');
	$photoid = input('photoid');

	$tmp = $WebChat->removePhoto($groupid, $photoid, ossn_loggedin_user()->guid);
	$tmp = json_decode(json_encode($tmp),true);
	
	if (!$tmp[0]['filename']) {
		echo setReturnArray ("Error", "There was an error removing the image.", array('debug' => $tmp));
		return false;
	}
	
	
	$groupimages_dir = ossn_route()->www . 'images/' . input('groupid') . '/';
	if (!$del = unlink($groupimages_dir . $tmp[0]['filename'])) {
		echo setReturnArray ("Error", "There was an error deleting the image.", array("folder" => $groupimages_dir, "filename" => $tmp[0]['filename']));
		return false;
	}

	echo setReturnArray ("Success", "Photo removed.");
	return;
}
function setReturnArray( $status = null, $message = null, $payload = null) {
	$return_arr[] = array(  "status" => $status ,
						    "message" => $message,
							"payload" => $payload );
	return json_encode($return_arr);
}
function natural_language_join(array $list, $conjunction = 'and') {
  $last = array_pop($list);
  if ($list) {
    return implode(', ', $list) . ' ' . $conjunction . ' ' . $last;
  }
  return $last;
}

function file_get_contents_curl($url)
{
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
	$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
	$header[] = "Cache-Control: max-age=0";
	$header[] = "Connection: keep-alive";
	$header[] = "Keep-Alive: 300";
	$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$header[] = "Accept-Language: en-us,en;q=0.5";
	$header[] = "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.89 Safari/537.36";
	$header[] = "Pragma: "; // browsers keep this blank.
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	
	$data = curl_exec($ch);
	curl_close($ch);

	return $data;
}

function wcGetURLPreview ($url) {
	$html = file_get_contents_curl($url);

	//parsing begins here:
	$doc = new DOMDocument();
	@$doc->loadHTML($html);
	$nodes = $doc->getElementsByTagName('title');
	if(trim(ossn_restore_new_lines($html)) == ''){
		echo 0;
		exit;
	}
	preg_match_all("/<img.+?src=[\\'\"\/]([^\\'\"]+)[\\'\"].*?>/", $html, $images);
	$site = parse_url($url);
	$site = $site['host'];	
	$image = null;
	$extensions = array(".png", ".jpg", ".jpeg", ".gif", ".svg");
	
	foreach ($images[1] as $tmp) {
		if (!$image) {
			if ($ext = getExtension($tmp)) {
				if ($tmp[0] == "/") $tmp = $site . $tmp;
				if (strtolower($tmp[0]) != "h")  $tmp = "https://" . $tmp;
				error_log ("About to check $tmp with extension of $ext");
				if (checkImageDims($tmp, $ext)) $image = $tmp;
			}
		}
	}

	$url_stored = $url;
	
	//get and display what you need:
	$title = $nodes->item(0)->nodeValue;

	$metas = $doc->getElementsByTagName('meta');
	for ($i = 0; $i < $metas->length; $i++)
	{
		$meta = $metas->item($i);
		if($meta->getAttribute('name') ==	'keywords')							$keywords           	= $meta->getAttribute('content');
		if($meta->getAttribute('name') == 	'description')						$description        	= $meta->getAttribute('content');
		if($meta->getAttribute('name') == 	'author')							$author             	= $meta->getAttribute('content');
		if($meta->getAttribute('name') == 	'twitter:title')					$twittertitle      		= $meta->getAttribute('content');
		if($meta->getAttribute('name') == 	'twitter:description')				$twitterdescription		= $meta->getAttribute('content');
		if($meta->getAttribute('name') == 	'twitter:url')						$twitterurl        		= $meta->getAttribute('content');
		if($meta->getAttribute('name') == 	'twitter:image')					$twitterimage      		= $meta->getAttribute('content');
		if($meta->getAttribute('property')=='og:type')							$ogtype              	= $meta->getAttribute('content');
		if($meta->getAttribute('property')=='og:site_name')      				$ogsite_name         	= $meta->getAttribute('content');
		if($meta->getAttribute('property')=='og:image')      					$ogimage             	= $meta->getAttribute('content');
		if($meta->getAttribute('property')=='og:title')      					$ogtitle             	= $meta->getAttribute('content');
		if($meta->getAttribute('property')=='og:description')      				$ogdescription       	= $meta->getAttribute('content');
		if($meta->getAttribute('name')=='msapplication-TileImage')  			$msapptile       		= $meta->getAttribute('content');
		if($meta->getAttribute('name')=='msapplication-square70x70logo')    	$msappsq70       		= $meta->getAttribute('content');
		if($meta->getAttribute('name')=='msapplication-square150x150logo')  	$msappsq150       		= $meta->getAttribute('content');
		if($meta->getAttribute('name')=='msapplication-wide310x150logo')    	$msapp310x150      		= $meta->getAttribute('content');
		if($meta->getAttribute('name')=='msapplication-square310x310logo')  	$msapp310x310      		= $meta->getAttribute('content');

	}
	

	$wcDescription = $ogdescription ? $ogdescription : ( $twitterdescription ? $twitterdescription : ( $description ? $description : null ));
	$wcTitle = $ogtitle ? $ogtitle : ( $twittertitle ? $twittertitle : ( $title ? $title : null));
	$wcImage = $msapp310x310 ? $msapp310x310 : ($msapp310x150 ? $msapp310x150 : ( $msappsq150 ? $msappsq150 : ($msapptile ? $msapptile : ($ogimage ? $ogimage : ( $twitterimage ? $twitterimage : ( $image ? $image : null))))));
	$wcSite = $ogsite_name ? $ogsite_name : ( $site ? $site : $url);
	
	$debug = array('meta:keywords' => $keywords,
	               'meta:description' => $description,
	               'meta:author' => $author,
	               'meta:twitter:title' => $twittertitle,
	               'meta:twitter:description' =>	$twitterdescription,
	               'meta:twitter:url' => $twitterurl,
	               'meta:twitter:image' => $twitterimage,
	               'meta:og:type' => $ogtype,
	               'meta:og:site_name' => $ogsite_name,
	               'meta:og:image' => $ogimage,
	               'meta:og:title' => $ogtitle,
	               'meta:og:description' => $ogdescription,
				   '<title>' => $title,
				   'wcDescription' => $wcDescription,
				   'wcTitle' => $wcTitle,
				   'wcImage' => $wcImage,
				   'wcSite' => $wcSite				   
				   );

	$type = getExtension($wcImage);
		
	# In case the image is a relative reference, add the site name.
	if ($wcSite && $wcImage) {
		if ($wcImage[0] == "/") $wcImage = $wcSite . $wcImage;
		if (strtolower($wcImage[0]) != "h")  $wcImage = "https://" . $wcImage;
	}
	error_log ("getExtension($wcImage) = $type before sending to urlPreviewThumb($wcImage, $type)");
	if ($wcImage && $type) {
		if ($tempThumb = urlPreviewThumb($wcImage, $type)) $wcImage = $tempThumb['thumb'];
	}
	error_log ("Before proceeding to return the array $wcTitle  $wcDescription  $wcImage");

	
	if (($wcTitle || $wcDescription) && !$wcImage) {
		error_log ("Either Title or Description found and NO IMAGE");
		return array( "sitename" => $wcSite, "title" => $wcTitle, "description" => $wcDescription, "image" => null, "url" => $url_stored, "thumbcolour" => null, "debug" => $debug);
	} else if (($wcTitle || $wcDescription) && $wcImage) {
		error_log ("Either Title or Description found and includes IMAGE");
		return array( "sitename" => $wcSite, "title" => $wcTitle, "description" => $wcDescription, "image" => $wcImage, "url" => $url_stored, "thumbcolour" => $tempThumb["thumbcolour"], "debug" => $debug);
	}  else if ($wcTitle || $wcDescription) {
		error_log ("Either Title or Description found");
		return array( "sitename" => $wcSite, "title" => $wcTitle, "description" => $wcDescription, "image" => null, "url" => $url_stored, "thumbcolour" => null, "debug" => $debug);
	} else {
		return false;
	}
}
function getExtension ($file) {
	$extensions = array(".png", ".jpg", ".jpeg", ".gif", ".svg");
	$found;
	
	foreach ($extensions as $ext) {
		if (strpos($file, $ext)){
			if (!$found) $found = $ext;
		}
	}

	if ($found) return $found;
	return false;
}
function urlPreviewThumb($source_url, $type) {
	$filename = uniqid(rand(), true);
	$userimages_dir = ossn_route()->www . 'images/users/' . ossn_loggedin_user()->guid . '/';
	if(!is_dir($userimages_dir)) {
		mkdir($userimages_dir, 0755);
	}
	
	if(is_dir($userimages_dir)) {
		$source_url_parts = pathinfo($source_url);
		$extension = substr($type,1);
		$quality = 10;

		list($width, $height) = getimagesize($source_url);
		$width;
		$height;

		$after_width = 200;
		
		if ($width > $after_width) {
			$reduced_width = ($width - $after_width);
			$reduced_radio = round(($reduced_width / $width) * 100, 2);
			$reduced_height = round(($height / 100) * $reduced_radio, 2);
			$after_height = $height - $reduced_height;
			if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'JPG' || $extension == 'JPEG') {
				$img = imagecreatefromjpeg($source_url);
			} elseif ($extension == 'png' || $extension == 'PNG') {
				$img = imagecreatefrompng($source_url);
			} elseif ($extension == 'gif' || $extension == 'GIF') {
				$img = imagecreatefromgif($source_url);
			} elseif ($extension == 'bmp' || $extension == 'BMP') {
				$img = imagecreatefrombmp($source_url);
			} else {
				return array("thumb" => $source_url);
			}
			if ($img) {
				$imgResized = imagescale($img, $after_width, $after_height, $quality);
				imagejpeg($imgResized, $userimages_dir . $filename . "." . $extension);
				$rgb = imagecolorat($imgResized, 1, 1);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				$thumbrgb = "rgb($r, $g, $b)";
				imagedestroy($img);
				imagedestroy($imgResized);
				error_log ("Saved thumbnail to server");
				return array("thumb" => ossn_loggedin_user()->guid . '/' . $filename . "." . $extension, "thumbcolour" => $thumbrgb);
			} else {
				error_log ("Did not save a thumbnail to the server");
			}
		}
		error_log ("Finished URL Thumb Preview without doing anything???");
		
	}
	return false;
}

function checkImageDims($source_url, $extension) {
    #Create a new image from file or URL
	if ($extension == '.jpg' || $extension == '.jpeg' || $extension == '.JPG' || $extension == '.JPEG') {
		$img = imagecreatefromjpeg($source_url);
	} elseif ($extension == '.png' || $extension == '.PNG') {
		$img = imagecreatefrompng($source_url);
	} elseif ($extension == '.gif' || $extension == '.GIF') {
		$img = imagecreatefromgif($source_url);
	} elseif ($extension == '.bmp' || $extension == '.BMP') {
		$img = imagecreatefrombmp($source_url);
	} else {
		error_log ("No image type match");
		return false;
	}

	# Minimum height and width we want for a url preview thumbnail
	$minx = 250;
	$miny = 100;
	
    # Compare width/height against minimum requirement
	$ix = ImageSX($img);
	$iy = ImageSY($img);
    if ( $ix >= $minx &&  $iy >= $miny) {
		error_log ("Image size is acceptable $ix x $iy");
		return true;
	}
	# Size is not acceptable
	error_log ("Image too small $ix x $iy");
    return false;
}
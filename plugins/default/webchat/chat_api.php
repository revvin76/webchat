<?php
$component = new OssnComponents;
$WebChat  = new WebChat;
$WebChatSettings  = $component->getSettings("webchat");
$wall       = new OssnWall;

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

//** LOAD THE PUSHER LIBRARIES **//
require ossn_route()->www . 'components/webchat/plugins/default/webchat/Psr/Log/LoggerAwareInterface.php';
require ossn_route()->www . 'components/webchat/plugins/default/webchat/Psr/Log/LoggerAwareTrait.php';
require ossn_route()->www . 'components/webchat/plugins/default/webchat/Psr/Log/LoggerInterface.php';
require ossn_route()->www . 'components/webchat/plugins/default/webchat/Psr/Log/LogLevel.php';
require ossn_route()->www . 'components/webchat/plugins/default/webchat/pusher/Pusher.php';
require ossn_route()->www . 'components/webchat/plugins/default/webchat/pusher/PusherCrypto.php';
require ossn_route()->www . 'components/webchat/plugins/default/webchat/pusher/PusherException.php';
require ossn_route()->www . 'components/webchat/plugins/default/webchat/pusher/PusherInstance.php';
require ossn_route()->www . 'components/webchat/plugins/default/webchat/pusher/Webhook.php';
// Initialise Pusher
$options = array(
	'cluster' => 'eu',
	'useTLS' => true
);
$pusher = new Pusher\Pusher(
	$WebChatSettings->pusher_key,
	$WebChatSettings->pusher_secret,
	$WebChatSettings->pusher_app_id,
	$options
);

  // $data['message'] = array('message' => 'test message', 'debug' => 'debug stuff');
  // $pusher->trigger('my-channel', 'my-event', $data);


function elapsed_time($timestamp, $precision = 1) {
  $time = time() - strtotime($timestamp);
  
  // First check if this was today
	$dt = date_create_from_format('U', strtotime($timestamp));
	if ($dt) {
		$dt->setTime(0, 0); // set time to 00:00
		$now = new DateTime('now', new DateTimeZone('UTC')); // time now, but in UTC 
		$now->setTime(0, 0); // set time to 00:00
		$diff = $dt->diff($now);
	}
    
  $a = array('decade' => 315576000, 'year' => 31557600, 'month' => 2629800, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'min' => 60, 'sec' => 1);
  $i = 0;
  // if ($time < 86400) {
	  // $date = date_create($timestamp);
	  // return date_format($date, 'H:i');
  // }
  foreach($a as $k => $v) {
    $$k = floor($time/$v);
    if ($$k) $i++;
    $time = $i >= $precision ? 0 : $time - $$k * $v;
    $s = $$k > 1 ? 's' : '';
    $$k = $$k ? $$k.' '.$k.$s.' ' : '';
    @$result .= $$k;
  }
 if ($dt) {
  	switch ($diff->days) {
		case 0: 
			$date = date_create($timestamp);
			return date_format($date, 'H:i');
		case 1: 
			$date = date_create($timestamp);
			return 'Yesterday ' . date_format($date, 'H:i');
		default: 
			return $result ? $result.'ago' : '1 sec to go';
	}
 }
 return $result ? $result.'ago' : '1 sec to go';
}
if ((input('action') !== null) && (input('action') == 'welcome')) {

	if (!$response=$WebChat->welcome(ossn_loggedin_user()->guid)) {
		error_log ($response);
		$WebChat->welcomed(ossn_loggedin_user()->guid);
		echo setReturnArray ("Success", "Welcome message on first visit" );
		return;
	}
	echo setReturnArray ("Fail", "Already seen" );
	return;
}												
if ((input('action') !== null) && (input('action') == 'OssnWall')) {

	// $count = $wall->GetAllPosts();
	$posts = $wall->GetAllPosts();

	$content = "";
	$captured = array();
	if(ossn_user_is_friend(ossn_loggedin_user()->guid, $params['user']->guid) || ossn_loggedin_user()->guid == $params['user']->guid || ossn_isAdminLoggedin()) {
			$content .= '<div class="ossn-wall-container">';
			$content .= ossn_view_form('user/container', array(
					'action' => ossn_site_url() . 'action/wall/post/u',
					'component' => 'OssnWall',
					'id' => 'ossn-wall-form',
					'params' => array(
							'user' => $params['user']
					)
			), false);
			$content .= '</div>';
			$captured['wallcontainer'] = $content;
	}
	$content .= '<div class="user-activity">';
	if($posts) {
			foreach($posts as $post) {
				$object = $post->guid;
				$comments = new OssnComments;
				if($post->full_view !== true){
					$comments->limit = 5;
				}
				if($post->full_view == true){
					$comments->limit = false;
					$comments->page_limit = false;
				}
			
				
				
					$data     = json_decode(html_entity_decode($post->description));
					if(!is_object($data)){
						$data = new stdClass;
					}
				
					// $text     = ossn_restore_new_lines($data->post, true);
					$text     = $data->post;
					$location = '';
					if(isset($data->location)) {
							$location = '- ' . $data->location;
					}
					if(!isset($data->friend)) {
							$data->friend = '';
					}
					if(isset($post->{'file:wallphoto'})) {
							$image = str_replace('ossnwall/images/', '', $post->{'file:wallphoto'});
					} else {
							$image = '';
					}
					$user = ossn_user_by_guid($post->poster_guid);
					$reactions=array();
					if($post->access == OSSN_FRIENDS) {
							if (ossn_is_hook('post', 'likes')) {
								$reactions = ossn_call_hook('post', 'likes', $post);
							}
							if (ossn_is_hook('post', 'comments')) {
								$comments = json_decode(json_encode($comments->GetComments($object)),true);
								foreach ($comments as $i => $comment) {
									$poster = ossn_user_by_guid($comment['owner_guid']);
									$comments[$i]['user_icons'] = $poster->iconURL();
									$comments[$i]['user_fullname'] = $poster->fullname;
									$comments[$i]['user_profile'] = $poster->profileurl();
									if(isset($comment['comments:post'])) {
										$comments[$i]['text'] = $comment['comments:post'];
									} else {
										$comments[$i]['text'] = "";
									}
								}
							}						
							if(ossn_user_is_friend($post->owner_guid, ossn_loggedin_user()->guid) || ossn_loggedin_user()->guid == $post->owner_guid || ossn_isAdminLoggedin()) {
								$captured[] = array(
									'post' => $post,
									'friends' => explode(',', $data->friend),
									'text' => $text,
									'location' => $location,
									'user' => $user,
									'image' => $image,
									'reaction' => $reactions,
									'comments' => $comments
								);
							}

					}
					if($post->access == OSSN_PUBLIC) {
							if (ossn_is_hook('post', 'likes')) {
								$reactions = ossn_call_hook('post', 'likes', $post);
							}
							if (ossn_is_hook('post', 'comments')) {
								$comments = json_decode(json_encode($comments->GetComments($object)),true);
								foreach ($comments as $i => $comment) {
									$poster = ossn_user_by_guid($comment['owner_guid']);
									$comments[$i]['user_icons'] = $poster->iconURL();
									$comments[$i]['user_fullname'] = $poster->fullname;
									$comments[$i]['user_profile'] = $poster->profileurl();
									if(isset($comment['comments:post'])) {
										$comments[$i]['text'] = $comment['comments:post'];
									} else {
										$comments[$i]['text'] = "";
									}
								}
							}	

							$captured[] = array(
									'post' => $post,
									'friends' => explode(',', $data->friend),
									'text' => $text,
									'location' => $location,
									'user_fullname' => $user->fullname,
									'user_icons' => $user->iconURL(),
									'user_profile' => $user->profileurl(),
									'image' => $image,
									'reactions' => $reactions,
									'comments' => $comments
							);

					}
					
					
			}
	}
	// $captured[] = array("pagination" => ossn_view_pagination($count));

	$posts = json_decode(json_encode($posts),true);
	
	echo setReturnArray ("Success", "Finished", $captured);
	return;
}														
if ((input('action') !== null) && (input('action') == 'msgStatus')) {

	if (empty(input('groupid')) || empty(input('msgid')) || empty(input('msgaction'))) {
		echo setReturnArray ("Failed", "Empty parameters");
		return false;
	}
	$groupid = input('groupid');
	$msgid = input('msgid');
	$msgaction = input('msgaction');
	
	switch ($msgaction) {
		case 1:
			if (!$WebChat->markDelivered($groupid, $msgid, ossn_loggedin_user()->guid)) return false;
			$data['message'] = array("groupid" => $groupid, "msgid" => $msgid, "delivered" => true, "userid" => ossn_loggedin_user()->guid);
			break;
		case 2:
			if (!$WebChat->markRead($groupid, $msgid, ossn_loggedin_user()->guid)) return false;
			$data['message'] = array("groupid" => $groupid, "msgid" => $msgid, "read" => true, "userid" => ossn_loggedin_user()->guid);
			break;
	}

	$pusherChannel = "Group_".$groupid;
	$pusherEvent = "msgStatus";
	$pusher->trigger($pusherChannel, $pusherEvent, $data);
	return;
}	
if ((input('action') !== null) && (input('action') == 'leaveGroup')) {
	if (empty(input('groupid'))) {
		echo setReturnArray ("Failed", "No groupid provided");
		return false;
	}
	$groupid = input('groupid');
	if (!$group = $WebChat->removeMember(input('groupid'), ossn_loggedin_user()->guid)) {
		echo setReturnArray ("Success", ossn_print('com:webchat:group:leavegroup:success'),array('message' => ossn_loggedin_user()->fullname.ossn_print('com:webchat:group:leavegroup:info')));
		
		// Refresh everybodies group info - members and photo
		$pusherChannel = "Group_".$groupid;
		$pusherEvent = "groupMembership";
		$data['message'] = array("id" => $groupid, "action" => "Refresh");
		$pusher->trigger($pusherChannel, $pusherEvent, $data);
		
		return;
	}
	echo setReturnArray ("Failed", $group );
	return;
}	
if ((input('action') !== null) && (input('action') == 'deleteGroup')) {
	if (empty(input('groupid'))) {
		echo setReturnArray ("Failed", "No groupid provided");
		return false;
	}
	$owner = ossn_loggedin_user()->guid;	
	$groupid = input('groupid');
	
	if (!$group = $WebChat->getGroup($groupid)) {
		echo setReturnArray ('Error', 'Unable to getGroup');
		return false;
	}
	
	// STEPS TO DELETE GROUP
	// Find all user photos in messages - delete the files and messages
	if ($groupimages = $WebChat->getGroupImages($groupid)){
		$groupimages = json_decode(json_encode($groupimages),true);	
		foreach ($groupimages as $image) {
			$WebChat->deleteMessage($image['messageid'], $image['owner'], $groupid);
			$images = json_decode(json_encode(html_entity_decode($image['image'])),true);
			unlink($images['img']);
			unlink($images['bigImg']);
		}
	}
	
	// Remove group photos
	$groupphotos = $WebChat->getGroupPhotos($groupid);
	$groupimages_dir = ossn_route()->www . 'images/groups/' . $groupid . '/';

	if ($groupphotos = json_decode(json_encode($groupphotos),true)){
		foreach ($groupphotos as $photo) {
			$tmp = $WebChat->removePhoto($groupid, $photo['id'], $owner);
			$tmp = json_decode(json_encode($tmp),true);
			
			if (!$tmp[0]['filename']) {
				echo setReturnArray ("Error", "There was an error removing the image.", array('debug' => $tmp));
				return false;
			}
			
			if (!$del = unlink($groupimages_dir . $tmp[0]['filename'])) {
				echo setReturnArray ("Error", "There was an error deleting the image.", array("folder" => $groupimages_dir, "filename" => $tmp[0]['filename']));
				return false;
			}
		}
	} 
	// Delete the empty group folder if it exists
	if (is_dir($groupimages_dir)) {
		rmdir($groupimages_dir);
	}	
	
	
	// Find and delete all URL preview thumbs
	if ($grouppreviews = $WebChat->getGroupPreviews($groupid)) {
		$grouppreviews = json_decode(json_encode($grouppreviews),true);	
		foreach ($grouppreviews as $preview) {
			$preview = json_decode(json_encode(html_entity_decode($preview['preview'])),true);
			unlink(ossn_route()->www . 'images/users/' . $preview['img']);
		}
	}

	// Delete group
	if (!$response = $WebChat->deleteGroup($groupid, $owner)){
		echo setReturnArray ("Error", "Error deleting group.", array('response' => $response));
		return;
	}
	
	// Pusher - exit group page and refresh list /  unsubscribe
	$pusherChannel = "Group_".$groupid;
	$pusherEvent = "groupMembership";
	$data['message'] = array("id" => $groupid, "action" => "Removed");
	$pusher->trigger($pusherChannel, $pusherEvent, $data);

	echo setReturnArray ("Success", "Group has been removed." );
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
		$groups[$index]['msgstatus'] = $WebChat->getMsgStatus ($groups[$index]['groupid'], ossn_loggedin_user()->guid, $groups[$index]['messageid']);
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
	
	// Refresh everybodies group info - members and photo
	$pusherChannel = "Group_".$groupid;
	$pusherEvent = "groupMembership";
	$data['message'] = array("id" => $groupid, "action" => "Refresh");
	$pusher->trigger($pusherChannel, $pusherEvent, $data);
	
	error_log ("Sending the following to Pusher: ".print_r($data['message'],true));
	
	echo setReturnArray ("Success", "Successfully renamed the group.",array('message' => ossn_loggedin_user()->fullname.ossn_print('com:webchat:group:rename:info'), 'name' => $name));
	return;
}					
if ((input('action') !== null) && (input('action') == 'getGroupImages')) {
	if (empty(input('groupid'))) {
		echo setReturnArray ("Failed", "No group id provided: groupid = ".input('groupid'));
		return false;
	}
	
	$group = input('groupid');
	if (!$groupimages = $WebChat->getGroupImages($group)) {
		return false;
	}
	
	echo setReturnArray ("Success", "Successfully retrieved photos.", $groupimages);
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
	$guids = explode(', ', input('guids'));
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
	$guids[] = ossn_loggedin_user()->guid;
	foreach ($guids as $guid) {	
		$pusherChannel = "User_".$guid;
		$pusherEvent = "groupMembership";
		$data['message'] = array("id" => $groupid,
								 "groupname" => $name,
								 "groupowner" => $owner,
								"elapsed" => date("H:i"),
								"action" => "Added");
		$pusher->trigger($pusherChannel, $pusherEvent, $data);
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
		$messages[$i]['elapsed'] = elapsed_time($messages[$i]['time']);	
		$messages[$i]['statuses'] = json_decode(json_encode($WebChat->getMsgGroupStatus($group, $userid, $messages[$i]['id'])), true);
		if ($message['preview']) {
			$preview = json_decode($message['preview'],true);		
			$tmp = json_decode(json_encode($WebChat->getThumbURL($preview['thumbid'])),true);
			$preview['thumb'] = $tmp[0]['photo'];
			$messages[$i]['preview'] = $preview;
		}
	}
	
	echo json_encode($messages);
	return;
}		
if ((input('action') !== null) && (input('action') == 'send')) {						// pusher_newMessage
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
	
	// if(trim(ossn_restore_new_lines($message)) == ''){
		// echo 0;
		// exit;
	// }
	$to = input('to');
	
	
	empty(input('status')) ? $type = 0 : $type = (input('status'));
	
	if ($type == '2') {  //INFO MESSAGES ARE SENT FROM SYSTEM - UserID 0;
		$userid = 0;
	} else {
		$userid = ossn_loggedin_user()->guid;
	}	

	// $url_pattern = '/[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/';
	// $url_pattern = '/((https?|ftp|file)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/';
	$url_pattern = '/((https?|ftp|file)\:\/\/)?[a-zA-Z0-9\.\/\?\:@\-_=#]+\.([a-zA-Z0-9\&\.\/\?\:@\-_=#])*/';
	
	// Type 0 - Default, normal text message
	// Type 1 - GIPHY message
	// Type 2 - Info message
	// Type 3 - Upload Image Message
	
	$preview = false;
	if ($type == 0) {
		if(preg_match($url_pattern, $message, $m)) {
			$preview = wcGetURLPreview($m[0]);
		}
	}
	
	if (!$message_id = $send->sendMessage($group, $userid, urldecode($message),$preview, $type)) {
		echo setReturnArray ("Failed", $message_id );
		return false;
	}
	
	$pusherChannel = "Group_".$group;
	$pusherEvent = "newMessage";
    $data['message'] = array("id" => $message_id['messageid'],
							 "groupid" => $group,
							"message_from" => $userid,
							"message" => $message,
							"preview" => $message_id['preview'],
							"elapsed" => date("H:i"),
							"type" => input('status'));
    $pusher->trigger($pusherChannel, $pusherEvent, $data);
  
	echo setReturnArray("Success", "Succesfully sent message", $message_id);
	return;
}
if ((input('action') !== null) && (input('action') == 'setGroupPhoto')) {
	
	$groupid = input('groupid');
	$filename = uniqid(rand(), true) . '.png';
	$groupimages_dir = ossn_route()->www . 'images/groups/' . $groupid . '/';
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


		if (!$groupphoto = $WebChat->changePhoto($groupid, $filename, ossn_loggedin_user()->guid)) {
			echo setReturnArray ("Failed", "There was a problem changing the group's photo.");
			return false;
		}
		
		// Refresh everybodies group info - members and photo
		$pusherChannel = "Group_".$groupid;
		$pusherEvent = "groupMembership";
		$data['message'] = array("id" => $groupid, "action" => "Refresh");
		$pusher->trigger($pusherChannel, $pusherEvent, $data);
	
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
				} elseif ($image_info['mime'] == 'image/gif') {
					$extension = 'gif';
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
					} elseif ($extension == 'gif' || $extension == 'GIF') {
						//then return the image as a gif image for the next step
						$img = imagecreatefromgif($source_url);
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
		
		echo setReturnArray ("Success", "Photo message sent",array('bigImg' => "/users/". ossn_loggedin_user()->guid  . '/' . $filename . "." . $extension, 'img' => "/users/". ossn_loggedin_user()->guid  . '/' . "thumb_" . $filename . "." . $extension));
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
	$groupid = input('groupid');
	$tmp = $WebChat->ownerCheck($groupid);
	$tmp = json_decode(json_encode($tmp),true);
	if (!$tmp[0]['owner'] == ossn_loggedin_user()->guid) {
		echo setReturnArray ("Error", ossn_print('com:webchat:group:permissions'). " user:".ossn_loggedin_user()->guid);
		return false;	
	}
	
	if (!$groupphoto = $WebChat->changePhoto($groupid, input('selected'), ossn_loggedin_user()->guid, true)) {
		echo setReturnArray ("Failed", "There was a problem changing the group's photo.");
		return false;
	}
	
	// Refresh everybodies group info - members and photo
	$pusherChannel = "Group_".$groupid;
	$pusherEvent = "groupMembership";
	$data['message'] = array("id" => $groupid,
							 "action" => "Refresh");
	$pusher->trigger($pusherChannel, $pusherEvent, $data);
	
	echo setReturnArray ("Success", ossn_print('com:webchat:group:changephoto:success'),array('message' => ossn_loggedin_user()->fullname.ossn_print('com:webchat:group:changephoto:info'), 'filename' => input('selected')));
	return;
}
if ((input('action') !== null) && (input('action') == 'addMembers')) {					// pusher_groupMembership
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
	$group = json_decode(json_encode($WebChat->getGroup($groupid)), true);
	$adds[]  = array_map('intval', explode(', ', input('guids')));	
		
	foreach ($adds[0] as $newmember) {
		if (!$WebChat->addMember($groupid, $newmember)) {
			echo setReturnArray ("Error", "There was an error adding member " . $newmember);
			return false;
		}
		$pusherChannel = "User_".$newmember;
		$pusherEvent = "groupMembership";
		
		$data['message'] = array("id" => $group[0]['id'],
								 "groupname" => $group[0]['name'],
								 "photo" => $group[0]['photo'],
								 "elapsed" => date("H:i"),
								 "action" => "Added");
		$pusher->trigger($pusherChannel, $pusherEvent, $data);
	}

	// Refresh everybodies group info - members and photo
	$pusherChannel = "Group_".$groupid;
	$pusherEvent = "groupMembership";
	$data['message'] = array("id" => $groupid,
							 "action" => "Refresh");
	$pusher->trigger($pusherChannel, $pusherEvent, $data);
		
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
if ((input('action') !== null) && (input('action') == 'removeMembers')) {				// pusher_groupMembership
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
		$pusherChannel = "User_".$removemember;
		$pusherEvent = "groupMembership";
		$data['message'] = array("id" => $groupid,
								"action" => "Removed");
		$pusher->trigger($pusherChannel, $pusherEvent, $data);
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
	if (empty(input('groupid')) || (input('type')=="user" && (empty(input('messageid')) || empty(input('file1')) || empty(input('file2')))) || (input('type')=="group" && empty(input('photoid')))) {
		echo setReturnArray ("Failed", "Not enough parameters");
		return false;
	}
	$userid = ossn_loggedin_user()->guid;
	
	$tmp = $WebChat->ownerCheck(input('groupid'));
	$tmp = json_decode(json_encode($tmp),true);
	if (!$tmp[0]['owner'] == $userid) {
		echo setReturnArray ("Error", ossn_print('com:webchat:group:permissions'). " user:$userid");
		return false;	
	}
	$groupid 	= input('groupid');
	$photoid 	= input('photoid');
	$type 	 	= input ('type');
	$file	 	= input ('file1');
	$file_thumb	 	= input ('file2');
	$messageid	= input ('messageid');
	error_log ("About to delete a photo type='$type', group='$groupid', file='$file', file_thumb='$file_thumb', user='$userid', msgid='$messageid'");
	$msgValid = $WebChat->getMsgStatus ($groupid, $userid, $messageid);
	if ($type == "user" && $msgValid) {

		$WebChat->deleteMessage($messageid, ossn_loggedin_user()->guid, $groupid);
		
		unlink($file);
		unlink($file_thumb);
		
		// Refresh everybodies group info - members and photo
		$pusherChannel = "Group_".$groupid;
		$pusherEvent = "messageDeleted";
		$data['message'] = array("id" => $messageid, "group" => $groupid);
		$pusher->trigger($pusherChannel, $pusherEvent, $data);
		
	} else {
		$tmp = $WebChat->removePhoto($groupid, $photoid, ossn_loggedin_user()->guid);
		$tmp = json_decode(json_encode($tmp),true);
	
		if (!$tmp[0]['filename']) {
			echo setReturnArray ("Error", "There was an error removing the image.", array('debug' => $tmp));
			return false;
		}		
		$groupimages_dir = ossn_route()->www . 'images/groups/' . $groupid . '/';
		if (!$del = unlink($groupimages_dir . $tmp[0]['filename'])) {
			echo setReturnArray ("Error", "There was an error deleting the image.", array("folder" => $groupimages_dir, "filename" => $tmp[0]['filename']));
			return false;
		}
		// Refresh everybodies group info - members and photo
		$pusherChannel = "Group_".$groupid;
		$pusherEvent = "groupMembership";
		$data['message'] = array("id" => $groupid, "action" => "Refresh");
		$pusher->trigger($pusherChannel, $pusherEvent, $data);
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
	// if(trim(ossn_restore_new_lines($html)) == ''){
		// echo 0;
		// exit;
	// }
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
	if ($wcImage && $type) {
		if ($tempThumb = urlPreviewThumb($wcImage, $type)) $wcImage = $tempThumb['thumb'];
	}
	
	if (($wcTitle || $wcDescription) && !$wcImage) {
		return array( "sitename" => $wcSite, "title" => $wcTitle, "description" => $wcDescription, "image" => null, "url" => $url_stored, "thumbcolour" => null, "debug" => $debug);
	} else if (($wcTitle || $wcDescription) && $wcImage) {
		return array( "sitename" => $wcSite, "title" => $wcTitle, "description" => $wcDescription, "image" => $wcImage, "url" => $url_stored, "thumbcolour" => $tempThumb["thumbcolour"], "debug" => $debug);
	}  else if ($wcTitle || $wcDescription) {
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
				return array("thumb" => ossn_loggedin_user()->guid . '/' . $filename . "." . $extension, "thumbcolour" => $thumbrgb);
			}
		}	
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
		return false;
	}

	# Minimum height and width we want for a url preview thumbnail
	$minx = 250;
	$miny = 100;
	
    # Compare width/height against minimum requirement
	$ix = ImageSX($img);
	$iy = ImageSY($img);
    if ( $ix >= $minx &&  $iy >= $miny) {
		return true;
	}
	# Size is not acceptable
    return false;
}
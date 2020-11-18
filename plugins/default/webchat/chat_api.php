<?php
$apiKey = ossn_services_apikey();
$siteURL = ossn_site_url('api/v1.0/');
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

if ((input('action') !== null) && (input('action') == 'send')) {
    $from = filter_var(input('from'), FILTER_SANITIZE_NUMBER_INT);
    $to = filter_var(input('to'), FILTER_SANITIZE_NUMBER_INT);
    $message = html_entity_decode(input('message'));
	
	$addPARAM = array( 'api_key_token' => $apiKey , 'from' => $from,'to' => $to, 'message' => $message);
	$addMessage = CallAPI ($addURL , $addPARAM);
	return $addMessage;
}

if ((input('action') !== null) && (input('action') == 'messages')) {
  	$with = filter_var(input('to'), FILTER_SANITIZE_NUMBER_INT);
	$user2 = ossn_user_by_guid($with);
 	
	$listPARAM = array( 'api_key_token' => $apiKey , 'guid' => ossn_loggedin_user()->guid , 'to' => $user2->guid, 'markallread' => 1);
	$listMessages = CallAPI ($listURL , $listPARAM); 
	//error_log('CallAPI() --> $listMessages [chat_api.php:line 68] : ' . PHP_EOL . print_r($listMessages,true) . PHP_EOL );

	echo ('
		<div class="contact-profile">
			<div class="back-arrow">
				<i class="fa fa-arrow-left" aria-hidden="true"></i>
			</div>
			<script>
			$(".back-arrow").click(function() {
				$("#sidepanel").removeClass("outLeft");
				$("#sidepanel").addClass("onFromLeft");
				$("#frame .content").removeClass("onFromRight");
				$("#frame .content").addClass("outRight");	
				updateActive(-1);				
			});</script>			
			<img src="' . $user2->iconURL()->smaller . '" alt="' . $user2->fullname . '" />
			<p>' . $user2->first_name . '</p>
			<div class="media-options">
				<i class="fa fa-video-camera" aria-hidden="true"></i>
				<i class="fa fa-phone" aria-hidden="true"></i>
				<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
			</div>
		</div>
		<div class="messages">
			<ul>');
				if ($listMessages->payload->count > 0) {
					foreach($listMessages->payload->list as $message)
					{
						// Lets check if its a single emoji, and if so make it bigger
						$lgemoji = "";
						// Check the message contains a single unicode character
						if ((strlen(html_entity_decode($message->message)) == 4) && (strlen($message->message) != strlen(html_entity_decode($message->message)))) {
							$lgemoji = "lg-emoji";														
						}

						if ($message->message_from->guid == ossn_loggedin_user()->guid) {
							echo  '<li class="sent ' . $lgemoji . '" data-id="' . $message->id . '">';						
							echo  '<img src="' . ossn_loggedin_user()->iconURLS->small . '" alt="" />';
							echo  '<article><section class="message">' . $message->message . '</section><section class="message_time">' . elapsed_time($message->time) . '</section></article>';
						} else {
							echo  '<li class="replies ' . $lgemoji . '" data-id="' . $message->id . '">';
							echo  '<img src="' . $user2->iconURL()->smaller . '" alt="" />';
							echo  '<article><section class="message">' . $message->message . '</section><section class="message_time">' . elapsed_time($message->time) . '</section></article>';
						}
						$data .= '</li>';
					};
				}
		echo  ('	</ul>
		</div>');
}

if ((input('action') !== null) && (input('action') == 'recent')) {
	$recentPARAM = array( 'api_key_token' => $apiKey , 'guid' => ossn_loggedin_user()->guid );
	$recentMessages = CallAPI ($recentURL , $recentPARAM);

	echo '	<ul>';	
	if ($recentMessages->payload->count > 0) {
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
					if ($withguid == input('active')) echo " active";
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
				
				
			echo "<script>
			$(function() {
				$('li.contact').click(function() {
				  $('li.contact').removeClass('active');
				  $(this).find('.contact-new').remove();
				  $(this).addClass('active');
				  withguid = $(this).attr('id');
				  updateActive(withguid);
				  listMessages(withguid);
					  setTimeout(function(){
						  $('#sidepanel').removeClass('onFromLeft');
						  $('#sidepanel').addClass('outLeft');
						  $('#frame .content').removeClass('outRight');
						  $('#frame .content').addClass('onFromRight');
					  });
				});
			});	
			</script>";
	}
	echo "</ul>";
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
		'debug' => '',
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
			
			//  Below logic should make sure the currently viewed thread is only updated if you receive a new message in it. Currently, the current thread will refresh no matter which thread receives a message.
			// foreach ( $notifcount->payload as $updated_thread ) {
				// if ( $current_guid == $updated_thread->message_from) {
					// We've found notifications regarding the current chat, need to return whether the count has changed
					// if ($notifs->payload) {
						// foreach ($notifs->payload as $old_thread) {
							// if ($updated_thread->message_from == $old_thread->message_from ) {
								// if ( $updated_thread->total != $old_thread->total ) {
									// $current_chat = true;
								// }					
							// }
						// }
					// } else {
						// $current_chat = true;
					// }
				// }
			// }
		}
		$debug=$current_chat;
		$response = [ 
		'success' => true,
		'current_chat' => $current_chat,
		'payload' => $notifcount,
		'message' => 'Success',
		'debug' => $debug
		];
		echo json_encode($response);
		return true;
	}

}



			
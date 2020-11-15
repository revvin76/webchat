<?php
$chatUser = ossn_loggedin_user();
//******************* This section contains static variables *******************//
$apiKey = ossn_services_apikey();
//$apiKey = "d30de045bb6d5ff11cdec4e68d6d86a545802aaebabb390e52d903ff24f7656b";
$siteURL = ossn_site_url('api/v1.0/');
$addURL = $siteURL."message_add?";
$listURL = $siteURL."message_list?";
$userURL = $siteURL."user_details?";
$notifsURL = $siteURL."notifications_count?";
$notifcountURL = $siteURL."unread_mesages_count_custom?";
$recentURL = $siteURL."message_recent?";
//* api_key_token=<token>&guid=<user guid> *//
//******************************************************************************//
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
function checkStatus($guidToCheck) {
	$friends = ossn_loggedin_user()->getFriends();
	if(!$friends) {
			return false;
	}
	foreach($friends as $friend) {
			if(($friend instanceof OssnUser) && $friend->guid == $guidToCheck) {
				return $friend->isOnline(10)==1?"online":"busy";
			}
	}
	return false;
}	

// Debug: Save the API key variable to a log file.
/* file_put_contents ("api_log.txt","webchat_page.php : API KEY : " . $apiKey . PHP_EOL,FILE_APPEND);	
file_put_contents ("api_log.txt","webchat_page.php : SITE URL : " . $siteURL . PHP_EOL,FILE_APPEND); */	

/* Get the list of message threads */
$recentPARAM = array( 'api_key_token' => $apiKey , 'guid' => ossn_loggedin_user()->guid );
$recentMessages = CallAPI ($recentURL , $recentPARAM);

/* Capture the friends list */
$friends = ossn_loggedin_user()->getFriends();

	
if ($recentMessages) {
	if ( $recentMessages->payload->list[0]->message_to->guid == ossn_loggedin_user()->guid ) {
		$with = $recentMessages->payload->list[0]->message_from->guid;
	} else {
		$with = $recentMessages->payload->list[0]->message_to->guid;
	}
	
	/* Capture the user we are talking to in the first thread */
	$userPARAM = array( 'api_key_token' => $apiKey , 'guid' =>  $with);
	$user2 = CallAPI ($userURL , $userPARAM);
	
	/* Get the first message thread */
	$listPARAM = array( 'api_key_token' => $apiKey , 'guid' => $chatUser->guid , 'to' => $user2->payload->guid);
	$listMessages = CallAPI ($listURL , $listPARAM);
	
	/* Store the current notification counts */
	$notifcountPARAM = array( 'api_key_token' => $apiKey , 'guid' => $chatUser->guid);
	$notifcount = CallAPI ($notifcountURL , $notifcountPARAM);

}

?>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>

<div id="frame">
	<div id="sidepanel">
		<div id="profile">
			<!--<div class="wrap">-->
			<a href="<?php echo ossn_site_url('home'); ?>" class="button"><i class="fa fa-home fa-fw" aria-hidden="true"></i> <span><?php echo ossn_print('com:webchat:homebutton'); ?></span></a>
				<!--<img id="profile-img" src="<?php //echo ossn_loggedin_user()->iconURLS->small; ?>" class="online" alt="" />
				<p><?php //echo $chatUser->fullname; ?></p>
				<div id="status-options">
					<ul>
						<li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
						<li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
						<li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
						<li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
					</ul>
				</div>
			</div>-->
		</div>
 		<!--<div id="search">
			<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
			<input type="text" placeholder="Search contacts..." />
		</div> -->
		<div id="contacts">
			<ul>
				<?php 
				$i = 0;
				$activeFriends = [];
				if ($recentMessages->payload->count > 0) {
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
						if ($i==0) echo " active";
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
						$activeFriends[] = $withguid;
						$i++;
					}
				};
				if ($friends) {
					foreach ($friends as $friend) {
						if (!in_array($friend->guid,$activeFriends)) {
							echo '<li class="contact';
							echo '" id="'. $friend->guid .'">
								<div class="wrap">		
									<span class="contact-status ' . checkStatus($friend->guid) . '"></span>';
							echo '<img src="' . $friend->iconURL()->smaller . '" alt="" />
									<div class="meta">
										<p class="name">' . $friend->username . '</p>
										<p class="preview">' . $friend->message . '</p>
									</div>
								</div>
							</li>';
						}
					}
				}
				?>
				<script>
				$(function() {
					$('li.contact').click(function() {
					  $('li.contact').removeClass("active");
					  $(this).find(".contact-new").remove();
					  $(this).addClass("active");
					  withguid = $(this).attr('id');
					  updateActive(withguid);
					  listMessages(withguid);
					  setTimeout(function(){
						  $("#sidepanel").removeClass("onFromLeft");
						  $("#sidepanel").addClass("outLeft");
						  $("#frame .content").removeClass("outRight");
						  $("#frame .content").addClass("onFromRight");
					  });
					});
				});	
				</script>
			</ul>
		</div>
		<div id="bottom-bar">
			<button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span><?php echo ossn_print('com:webchat:menu:addcontact'); ?></span></button>
			<button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span><?php echo ossn_print('com:webchat:menu:settings'); ?></span></button>
		</div>
	</div>
	<div class="content">
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
			});</script>			
			<img src="<?php echo $user2->payload->icon->small;?>" alt="<?php echo $user2->payload->fullname;?>" />
			<p><?php echo $user2->payload->first_name;?></p>
			<div class="media-options">
				<i class="fa fa-video-camera" aria-hidden="true"></i>
				<i class="fa fa-phone" aria-hidden="true"></i>
				<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
			</div>
		</div>
		<div class="messages">
			<ul>
				<?php
					if ($listMessages->payload->count > 0) {
						foreach($listMessages->payload->list as $message)
						{
							if ($message->message_from->guid == ossn_loggedin_user()->guid) {
								echo '<li class="sent">';						
								echo '<img src="' . ossn_loggedin_user()->iconURLS->small . '" alt="" />';
								echo '<article><section class="message">' . $message->message . '</section><section class="message_time">' . elapsed_time($message->time) . '</section></article>';
							} else {
								echo '<li class="replies">';
								echo '<img src="' . $user2->payload->icon->small . '" alt="" />';
								echo '<article><section class="message">' . $message->message . '</section><section class="message_time">' . elapsed_time($message->time) . '</section></article>';
							}
							echo '</li>';
						}
					};?>								
			</ul>
		</div>
		<div class="message-input">
			<div class="wrap">
			<input type="text" placeholder="<?php echo ossn_print('com:webchat:input:placeholder'); ?>" />
			<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
			<i class="fa fa-camera camera" aria-hidden="true"></i>
			<div id="emojiPanel"><i class="fa fa-smile-o emoji" aria-hidden="true"></i></div>
			<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
			<div class="emojiPanel outBottom" tabindex="-1">
			&#128512
			</div>
			</div>
		</div>
	</div>
</div>
<audio id="newmessage" src="<?php echo ossn_site_url("components/OssnSounds/audios/pling.mp3"); ?>" type="audio/mp3"></audio>

<script>   
var activeContact = $('li.contact.active').attr("id");
var notifs_running = false;

$(".messages").animate({ scrollTop: $(document).height() }, "fast");

$("#profile-img").click(function() {
	$("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
	$("#contacts").toggleClass("expanded");
});

$("#emojiPanel").click(function() {
	$(".emojiPanel").addClass("onFromBottom").focus();
	$(".emojiPanel").removeClass("outBottom");
});

  $(".emojiPanel").focusout(function() {
	$(".emojiPanel").addClass("outBottom");
	$(".emojiPanel").removeClass("onFromBottom");
  })
			
$("#status-options ul li").click(function() {
	$("#profile-img").removeClass();
	$("#status-online").removeClass("active");
	$("#status-away").removeClass("active");
	$("#status-busy").removeClass("active");
	$("#status-offline").removeClass("active");
	$(this).addClass("active");
	
	if($("#status-online").hasClass("active")) {
		$("#profile-img").addClass("online");
	} else if ($("#status-away").hasClass("active")) {
		$("#profile-img").addClass("away");
	} else if ($("#status-busy").hasClass("active")) {
		$("#profile-img").addClass("busy");
	} else if ($("#status-offline").hasClass("active")) {
		$("#profile-img").addClass("offline");
	} else {
		$("#profile-img").removeClass();
	};
	
	$("#status-options").removeClass("active");
});

function newMessage() {
	message = $(".message-input input").val();
	if($.trim(message) == '') {
		return false;
	}
	$('<li class="sent"><img src="<?php echo ossn_loggedin_user()->iconURL()->small; ?>" alt="" /><article><section>' + message + '</section></article></li>').appendTo($('.messages ul'));
	$('.message-input input').val(null);
	$('.contact.active .preview').html('<span>You: </span>' + message);
	$(".messages").animate({ scrollTop: $(document).height() }, "fast");
	activeContact = $('li.contact.active').attr("id");
	$.post("/chat_api",
	{
	  action: 'send',  
	  from: <?php echo ossn_loggedin_user()->guid; ?>,
	  to: activeContact,
	  message: message
	});
};

function listMessages(withguid){	
	$.post( "/chat_api", { action: "messages", from: <?php echo ossn_loggedin_user()->guid; ?>, to: withguid })
     .done(function( data ) {
		$("div.contact-profile").remove();
		$("div.messages").remove();
		$("div.content").prepend(data);
		var d = $("div.messages");
		d.scrollTop(d.prop("scrollHeight"));
     });
	 notifs_running = false;
};

function updateActive(newContact) {
	activeContact = newContact;
	notifs_running = true;
}

function recentMessages(){	
	$.post( "/chat_api", { action: "recent", to: <?php echo ossn_loggedin_user()->guid; ?> , active: activeContact })
	 .done(function( data ) {
		$("div#contacts ul").remove();
		$("div#contacts").html(data);
	 });
};			
				
function checkNotifs(){
	if ( notifs_running == false ) {
		notifs_running = true;
		var activeContact_copy = activeContact;
		$.ajax({
			url: '/chat_api',
			data: {action: "notifs", currentuser: $('li.contact.active').attr("id"), guid: <?php echo ossn_loggedin_user()->guid; echo ", notifs: ".print_r(json_encode($notifcount),true); ?>},
			type: 'POST',
			dataType: 'json',
			success:  function(returnedData) {
				if (returnedData.success == true){
					if (returnedData.current_chat == true){
						listMessages (activeContact);
					} else {
						var unseen_notification = false;
						$.each(returnedData.payload, function(arrayID, thread) {
							if ( $("#contacts ul").find( "#" + thread.message_from + " .contact-new").length ) {
				 
							} else {
								unseen_notification = true;
							}
						});
						if (unseen_notification == true) {
							recentMessages();
							var audioElement = $("#newmessage");
							// Only play sound if user hasn't changed the active thread since the check started
							if (activeContact_copy == activeContact) audioElement.get(0).play(); 
						}
					}
				} else {
					//console.log ("Nothing to do");
				}
				running=false;
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		});
		notifs_running = false;
	}
};
var running = false;

setInterval(function() {
  // Check whether there are new mail notifications
	if (running == false) {
		running = true;
		checkNotifs();
	}
}, 3000); 

// Click the SEND button
$('.submit').click(function() {
  newMessage();
  return false;
});
// Press ENTER to send
$(window).on('keydown', function(e) {
  if (e.which == 13) {
    newMessage();
    return false;
  }
});</script>
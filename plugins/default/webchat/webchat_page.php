<?php
$chatUser = ossn_loggedin_user();
//******************* This section contains static variables *******************//
$apiKey = ossn_services_apikey();
$siteURL = ossn_site_url('api/v1.0/');
$addURL = $siteURL."message_add?";
$listURL = $siteURL."message_list?";
$userURL = $siteURL."user_details?";
$notifsURL = $siteURL."notifications_count?";
$notifcountURL = $siteURL."unread_mesages_count_custom?";
$recentURL = $siteURL."message_recent?";
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
	// $listPARAM = array( 'api_key_token' => $apiKey , 'guid' => $chatUser->guid , 'to' => $user2->payload->guid);
	// $listMessages = CallAPI ($listURL , $listPARAM);
	
	/* Store the current notification counts */
	$notifcountPARAM = array( 'api_key_token' => $apiKey , 'guid' => $chatUser->guid);
	$notifcount = CallAPI ($notifcountURL , $notifcountPARAM);

}

?>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>

<div id="frame">
	<input id="activeContact" type="number" value="-1" hidden />
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
							$sent=false;
						} else {
							$current_message = $messageThread->message_to;
							$withguid = $messageThread->message_to->guid;						
							$sent=true;
						}

						echo '<li class="contact';
						if ($i==0) echo " active";
						echo '" id="'. $withguid .'">
							<div class="wrap">		
								<span class="contact-status ' . checkStatus($withguid) . '"></span>';
								
						// Check whether the most recent unread message was to or from
						if ($messageThread->viewed == 0 && ( $messageThread->message_to->guid == ossn_loggedin_user()->guid )) {
							echo '<i class="fa fa-comment contact-new" aria-hidden="true"></i>';
						}
						
						// Check whether the most recent message to contact has been viewed
						if ($sent==true) {
							if ($messageThread->viewed == 0) {
								$tick='<i class="fa fa-circle sent-unread" aria-hidden="true"></i>';
							} else {
								$tick='<i class="fa fa-circle sent-read" aria-hidden="true"></i>';
							}
						}
								
						$preview = $messageThread->message;
						if (strlen($preview) >= 30) $preview=substr($preview,0,30) . "...";		
						echo '<img src="' . $current_message->icon->small . '" alt="" />
								<div class="meta">
									<p class="name">' . $current_message->username . '</p>
									<p class="preview">';
									if ($sent) echo $tick;
									echo	$preview . '</p>
								</div>
								<section class="message_time">'. elapsed_time($messageThread->time) . '</section>
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
	<div id="content" class="content">
		<div class="contact-profile">
			<div class="back-arrow">
				<i class="fa fa-arrow-left" aria-hidden="true"></i>
			</div>
			<script>
			$(".back-arrow").click(function() {
				updateActive(-1);
				$("#sidepanel").removeClass("outLeft");
				$("#sidepanel").addClass("onFromLeft");
				$("#frame .content").removeClass("onFromRight");
				$("#frame .content").addClass("outRight");
			});</script>			
			<img src="<?php echo $user2->payload->icon->small;?>" alt="<?php echo $user2->payload->fullname;?>" />
			<p><?php echo $user2->payload->first_name;?></p>

		</div>
		<div id="messages" class="messages">
			<ul>
				<!-- no need to display message content on first load. This will be populated when you click on a contact -->
			</ul>
		</div>
		<div id="message-input" class="message-input">
			<div class="wrap">
				<i class="fa fa-smile-o emoji" aria-hidden="true" id="emojiPanel"></i>
				<textarea id="main-input" type="text" rows="1" cols="40" placeholder="<?php echo ossn_print('com:webchat:input:placeholder'); ?>"></textarea>
				<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
				<i class="fa fa-camera camera" aria-hidden="true"></i>
				<i class="fa fa-paper-plane send" aria-hidden="true"></i>
			</div>
			<div class="emojiPanel outBottom" tabindex="-1">
			</div>
		</div>
	</div>
</div>
<audio id="newmessage" src="<?php echo ossn_site_url("components/OssnSounds/audios/pling.mp3"); ?>" type="audio/mp3"></audio>
<div class="clones" hidden>
			<div class="media-options">
				<i class="fa fa-video-camera" aria-hidden="true"></i>
				<i class="fa fa-phone" aria-hidden="true"></i>
				<i class="fa fa-ellipsis-v message-menu" aria-hidden="true"></i>
				<div id="message-menu" class="dropdown-content">
					<ul>
					<li id="view-user-btn">View User Details</li>
					<li id="report-user-btn">Report User</li>
					<li id="block-user-btn">Block User</li>
					<li id="clear-chat-btn">Clear Chat</li>
					</ul>
				</div>
			</div>
</div>
<div class="cd-popup" role="alert">
   <div class="cd-popup-container">
      <p>Are you sure you want to delete this element?</p>
      <ul class="cd-buttons">
         <li class="dialog-yes">Yes</li>
         <li class="dialog-no">Cancel</li>
      </ul>
   </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<div class="cd-popup-fade"></div>

<script>   
var notifs_running = false;
var notifcount = '<?php echo (print_r(json_encode($notifcount),true)); ?>';

$(function() {
    $.ajax({
	   type: 'GET',
	   url: '<?php echo ( ossn_site_url("components/WebChat/plugins/default/webchat/emojiPanel.php"));?>',
	   success: function(response)
	   {
		  $("#message-input .emojiPanel").html(response);
	   }
	});
});

$(".messages").animate({ scrollTop: $(document).height() }, "fast");

$("#profile-img").click(function() {
	$("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
	$("#contacts").toggleClass("expanded");
});

// Message Menu Buttons ///////////////////////////////////////////////////////////////////////////
// View user
$("#view-user-btn").click(function() {
   $("#message-menu").removeClass("show");
   $(".cd-popup p").html("Do you want to leave Web Chat to visit the users profile?");
   $(".cd-popup").addClass("show");
   $(".cd-popup-fade").addClass("show");
});
// Report user
$("#report-user-btn").click(function() {
   $("#message-menu").removeClass("show");
   $(".cd-popup p").html("Do you really want to report this user?");
   $(".cd-popup").addClass("show");
   $(".cd-popup-fade").addClass("show");
});
// Block user
$("#block-user-btn").click(function() {
   // $block = ossn_site_url("action/block/user?user={$user->guid}", true);
   $("#message-menu").removeClass("show");
   $(".cd-popup p").html("Do you really want to block this user?");
   var dataurl = "<?php echo ossn_site_url() . 'action/block/user?user=';?>" + $("#activeContact").val().toString();
   $(".cd-popup ul li.dialog-yes").attr("data-url", dataurl );
   $(".cd-popup").addClass("show");
   $(".cd-popup-fade").addClass("show");   
});
// Clear chat
$("#clear-chat-btn").click(function() {
   $("#message-menu").removeClass("show");
   $(".cd-popup p").html("Clear all messages?");
   $(".cd-popup").addClass("show");
   $(".cd-popup-fade").addClass("show");   
});
// Dismiss dialog
$(".dialog-no").click(function() {
   $(".cd-popup").removeClass("show");
   $(".cd-popup-fade").removeClass("show");
   $(".cd-popup ul li.dialog-yes").attr("href", "#");
});





// Clicking an emoji
$('.emojiPanel').on('click', '#emojiSelector .visibleChar input', function () {
    $(".message-input .wrap > textarea").val($(".message-input .wrap > textarea").val() + $(this).attr('value'));
});

// Clicking message menu
$('.media-options .message-menu').on('click', function () {
	$('#message-menu').toggleClass('show');
});

// Clicking outside of the emoji selection panel makes it disappear			
$( "body" ).click(function( event ) {
	var target = $(event.target);    
    if ((target.parents('div.messages, div.contact-info').length) || (event.target.id == 'main-input'))  {
		if ($(".emojiPanel").hasClass("onFromBottom")) {
			$(".emojiPanel").addClass("outBottom");
			$(".emojiPanel").removeClass("onFromBottom");
		}
    }
});

// Click the emoji icon for the emoji selector panel to appear
$("#emojiPanel").click(function(e) {
	$(".emojiPanel").addClass("onFromBottom").focus();
	$(".emojiPanel").removeClass("outBottom");
});
			
function newMessage() {
	$(".emojiPanel").addClass("outBottom");
	$(".emojiPanel").removeClass("onFromBottom");
	message = $("#main-input").val();
	if($.trim(message) == '') {
		return false;
	}
	
	// Lets check if its a single emoji, and if so make it bigger
	var lgemoji = null;
	if (message.length==2 & message.codePointAt(0) > 1000 ) { lgemoji = "lg-emoji"}
	
	$('<li class="sent ' + lgemoji + '"><img src="<?php echo ossn_loggedin_user()->iconURL()->small; ?>" alt="" /><article><section class="message im">' + message + '</section><section class="message_time">Just now</section><i class="fa fa-circle sent-unread" aria-hidden="true"></i></article></li>').appendTo($('.messages ul'));


	// Now we've sent the message, reset the size of the input box, icon locations and empty the input box.
	$('#main-input').val(null).blur();
	$('#main-input').css("height","15px");
	$("#frame .content .message-input .wrap i").css("padding-top",miniHeight + "px");
	$("#frame .content .message-input .wrap .fa").css("bottom","-32px");
	
	//$('.contact.active .preview').html('<i class="fa fa-circle sent-unread" aria-hidden="true"></i>' + message);
	recentMessages();
	
	activeContact = document.getElementById('activeContact').value;
	
	$.post("<?php echo ossn_site_url('chat_api'); ?>",
	{
	  action: 'send',  
	  from: <?php echo ossn_loggedin_user()->guid; ?>,
	  to: activeContact,
	  message: message
	});
	// Scroll to show the new message
	var d = $("div.messages");		
	$(".messages").animate({ scrollTop: d.prop("scrollHeight") }, "fast");
};

function listMessages(withguid){	
	$.post( "<?php echo ossn_site_url('chat_api'); ?>", { action: "messages", from: <?php echo ossn_loggedin_user()->guid; ?>, to: withguid })
     .done(function( data ) {
		$("div.contact-profile").remove();
		$("div.messages").remove();
		$("div.content").prepend(data);
		var d = $("div.messages");
		d.scrollTop(d.prop("scrollHeight"));
		$( ".clones .media-options" ).clone(true,true).appendTo( ".contact-profile" );
     });
	 notifs_running = false;
};

function updateActive(newContact) {
	$("#activeContact").val(newContact);
}

function recentMessages(){	
	$.post( "<?php echo ossn_site_url('chat_api'); ?>", { action: "recent", to: <?php echo ossn_loggedin_user()->guid; ?> , active: document.getElementById('activeContact').value })
	 .done(function( data ) {
		$("div#contacts ul").remove();
		$("div#contacts").html(data);
	 });
};			
				
function checkNotifs(){
	if ( notifs_running == false ) {
		notifs_running = true; 
		var activeContact_copy = document.getElementById('activeContact').value;
		$.ajax({
			url: '<?php echo ossn_site_url("chat_api"); ?>',
			data: {action: "notifs", currentuser: activeContact_copy, guid: <?php echo ossn_loggedin_user()->guid;?> , notifs: notifcount},
			type: 'POST',
			dataType: 'json',
			success:  function(returnedData) {
				if (returnedData.success === true){
					var oldPayload = JSON.stringify(JSON.parse(notifcount).payload);
					var newPayload = JSON.stringify(JSON.parse(JSON.stringify(returnedData.payload.payload)));
					
					if (newPayload != oldPayload) {
						if (returnedData.current_chat == true){
							listMessages (document.getElementById('activeContact').value);
						}

						var unseen_notification = false;						
						$.each(returnedData.payload, function(i, item) {
							if (i==="payload") {
								if (item.length){
									$.each(item, function(thread, v) {
										if ( $("#contacts ul").find( "#" + item[thread].message_from + " .contact-new").length ) {
										} else {								
											if (returnedData.current_chat == true && item[thread].message_from === activeContact_copy){
											} else {
												unseen_notification = true;
											};
										}
									});
								};
							}
						});
										
						if (unseen_notification == true) {
							recentMessages();
							var audioElement = $("#newmessage");
							// Only play sound if user hasn't changed the active thread since the check started
							if (activeContact_copy == document.getElementById('activeContact').value) audioElement.get(0).play(); 
							notifcount = JSON.stringify(returnedData.payload); // If the previous message count is different from the current, we'll take a copy
						}
						
						// After processing the notification, copy it for future checks.
						notifcount = JSON.stringify(returnedData.payload);						
					}
				} else {
					// No unread messages, so resetting notifcount to empty
					temp = JSON.parse(notifcount);
					temp.payload = '[]';
					notifcount= JSON.stringify(temp);
					jQuery.each(JSON.parse(returnedData.statuses), function(i, val) {
					  if (val == true) {
						$('#' + i + ' div span.contact-status').addClass('online');
						$('#' + i + ' div span.contact-status').removeClass('busy');
					  } else {
						$('#' + i + ' div span.contact-status').addClass('busy');
						$('#' + i + ' div span.contact-status').removeClass('online');
					  }
					});
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

var loadingMore = false
function loadMore(offset) {
	if (loadingMore === false) {
	  loadingMore = true;
	  $.post( "<?php echo ossn_site_url('chat_api'); ?>", { action: "moremessages", from: <?php echo ossn_loggedin_user()->guid; ?>, to: withguid, offset: offset+1 })
	  .done(function( data ) {
		$('#loadMore').remove();
		
		var d = $("div.messages");	
		var old_height = d.prop("scrollHeight");  //store document height before modifications
		var old_scroll = d.scrollTop(); //remember the scroll position
		$("div.messages ul").prepend(data);
		d.scrollTop(old_scroll + d.prop("scrollHeight") - old_height); //restore "scroll position"
		}); // done
	  
	  var d = $("div.messages");		
	  d.find("ul span").data('page',parseInt(offset)+1);
	  notifs_running = false;
	  loadingMore = false;
    }
}
setInterval(function() {
  // Check whether there are new mail notifications
	if (running == false) {
		running = true;
		checkNotifs();
	}
}, 3000); 

// Click the SEND button
$('.send').click(function() {
  newMessage();
  return false;
});

var inputStartHeight = parseInt($('#main-input').css("height"),10);
var miniHeight = 5;
var idiff = inputStartHeight - miniHeight;
// automatically adjust size to fit content
$('#main-input').on('input', function () {
// compute the height difference which is caused by border and outline
        var outerHeight = parseInt(window.getComputedStyle(this).height, 10);
        var diff = outerHeight - this.clientHeight;
		var minHeight = 15;
	
        // set the height to 0 in case of it has to be shrinked
        this.style.height = 0;

        // set the correct height
        // this.scrollHeight is the full height of the content, not just the visible part
        this.style.height = Math.max(minHeight, this.scrollHeight + diff) + 'px';
		$("#frame .content .message-input .wrap i").css("padding-top",(parseInt(this.style.height,10) - idiff) + "px");
		
 });

</script>
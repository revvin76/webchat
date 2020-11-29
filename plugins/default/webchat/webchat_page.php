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
	
	$component = new OssnComponents;
	$WebChat  = $component->getSettings("webchat");
}

?>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>

<div id="frame">
	<input id="activeContact" type="number" value="-1" hidden />
	<div id="sidepanel">
		<div id="profile">
			<!--<div class="wrap">-->
			<?php 
			  if ($WebChat->homeButton==1) {
				  if ($WebChat->homeURL==1) echo '<a href="' . ossn_site_url($WebChat->homeURLPath) . '" class="button">';
				  
				  if ($WebChat->homeButtonStyle==0)echo '<i class="fa ' . $WebChat->homeChar . '"></i>';
				  
				  if ($WebChat->homeButtonStyle==1)echo '<img src="' . $WebChat->homeImgPath . '" alt=""/>';
				  
				  echo '<span>' . ossn_print('com:webchat:homebutton') . '</span>';
				  
				  if ($WebChat->homeURL==1) echo '</a>';
				  
			  }?>
		</div>
		<div id="contacts">
			<ul>
			</ul>
		</div>
		<div id="addChatMenu">
			<div class="wrap">
				<header><?php echo ossn_print('com:webchat:menu:addchat'); ?><i class="fa fa-times" aria-hidden="true"></i></header>
				<input id="groupName" placeholder="Subject (optional)"/>
				<div class="newMembersContainer">
					<ul class="newMembers">
							<li class="addContact" >
								<div class="imgcontainer"><img src="https://kjbtech.co.uk/ossn/avatar/Kevinb/small/f951bd096c1f5c835e37bddc29ae0044.jpeg" alt=""></div>
								<div class="namecontainer"><p class="name">Aardvark</p></div>
								<div class="iconcontainer"><i class="fa fa-times removeMember" aria-hidden="true"></i></div>
							</li>
							<li class="addContact" >
								<div class="imgcontainer"><img src="https://kjbtech.co.uk/ossn/avatar/Kevinb/small/f951bd096c1f5c835e37bddc29ae0044.jpeg" alt=""></div>
								<div class="namecontainer"><p class="name">Boris</p></div>
								<div class="iconcontainer"><i class="fa fa-times removeMember" aria-hidden="true"></i></div>
							</li>
							<li class="addContact" >
								<div class="imgcontainer"><img src="https://kjbtech.co.uk/ossn/avatar/Kevinb/small/f951bd096c1f5c835e37bddc29ae0044.jpeg" alt=""></div>
								<div class="namecontainer"><p class="name">Crabapple</p></div>
								<div class="iconcontainer"><i class="fa fa-times removeMember" aria-hidden="true"></i></div>
							</li>
					</ul>
				</div>
				<div class="container">
					<ul class="contacts">
						<li class="addContact" >
							<div class="imgcontainer"><img src="https://kjbtech.co.uk/ossn/avatar/Kevinb/small/f951bd096c1f5c835e37bddc29ae0044.jpeg" alt=""></div>
							<div class="namecontainer"><p class="name">Deltoid</p></div>
							<div class="iconcontainer"><i class="fa fa-times removeMember" aria-hidden="true"></i></div>
						</li>
						<li class="addContact" >
							<div class="imgcontainer"><img src="https://kjbtech.co.uk/ossn/avatar/Kevinb/small/f951bd096c1f5c835e37bddc29ae0044.jpeg" alt=""></div>
							<div class="namecontainer"><p class="name">Efalump</p></div>
							<div class="iconcontainer"><i class="fa fa-times removeMember" aria-hidden="true"></i></div>
						</li>
						<li class="addContact" >
							<div class="imgcontainer"><img src="https://kjbtech.co.uk/ossn/avatar/Kevinb/small/f951bd096c1f5c835e37bddc29ae0044.jpeg" alt=""></div>
							<div class="namecontainer"><p class="name">Gertrude</p></div>
							<div class="iconcontainer"><i class="fa fa-times removeMember" aria-hidden="true"></i></div>
						</li>
					</ul>
				</div>
			</div>
			<div class="chatadd-button">
				<i class="fa fa-arrow-right send" aria-hidden="true"></i>
			</div>
		</div>
		<div id="bottom-bar">
			<button id="addChat">
				<i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>
				<span><?php echo ossn_print('com:webchat:menu:addchat'); ?></span>
			</button>
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
				recentMessages();
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
		<div id="messages" class="messages">
			<ul id="messageList">
			</ul>
		</div>
		<div id="message-input" class="message-input">
			<div class="wrap">
				<i class="fa fa-smile-o emoji" aria-hidden="true" id="emojiPanel"></i>
				<textarea id="main-input" type="text" rows="1" cols="40" placeholder="<?php echo ossn_print('com:webchat:input:placeholder'); ?>"></textarea>
				<i class="fa fa-picture-o giphy-logo" aria-hidden="true" id="giphyPanel"></i>
				
				<label for="image-upload">
				  <i class="fa fa-camera camera" aria-hidden="true"></i>
				</label>
				<input id="image-upload" class="file-input" type="file" accept="image/*" />
				
				<i class="fa fa-paper-plane send" aria-hidden="true"></i>
			</div>
			<div class="emojiPanel outBottom" tabindex="-1"></div>
			<div class="giphyPanel outBottomGiphy" tabindex="-1">
				<div id="giphySelector" class="giphys">
					<div class="topbar">
						<input class="giphy-input" placeholder="Search via Giphy" autocomplete="off"/>
						<div class="giphy-logo">
							<img src="<?php echo ossn_site_url("components/webchat/plugins/default/img/XEPINdXA.png"); ?>">
						</div>
					</div>
					<div class="resultsContainer">
						<div class="results left"><img src="<?php echo ossn_site_url("components/webchat/plugins/default/img/dV2TgmvQ.png"); ?>"></div>
						<div class="results right"><img src="<?php echo ossn_site_url("components/webchat/plugins/default/img/dV2TgmvQ.png"); ?>"></div>
					</div>
				</div>			
			</div>
		</div>
	</div>
</div>
<audio id="newmessage" src="<?php echo ossn_site_url("components/OssnSounds/audios/pling.mp3"); ?>" type="audio/mp3"></audio>
<div class="clones" hidden>
			<li class="sent giphy" data-id=""></li>
			<li class="replies giphy" data-id=""></li>
			<li class="sent std" data-id=""></li>
			<li class="replies std" data-id=""></li>
			<li class="contact"></li>
			<div class="giphy-img"></div>
			<span id="loadMore" data-page="0">more</span>
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
			<button class="siteappinstaller-install-button" >
				<i class="fa fa-download fa-fw\" aria-hidden="true"></i>
				<span><?php echo ossn_print('com:webchat:account_settings_section_button'); ?></span>
			</button>			
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
<div class="giphy-fs-container">
  <div class="giphy-fs-dismiss"><i class="fa fa-times" aria-hidden="true"></i></div>
  <div class="giphy-fs-image"></div>
</div>
<div id="loader"></div>

<script>   
var notifs_running = false;
var notifcount = '<?php echo (print_r(json_encode($notifcount),true)); ?>';


$(function() {
	if (window.matchMedia('(display-mode: standalone)').matches) {
		$('.siteappinstaller-install-button').hide();
	}	
	if ((window.matchMedia('(display-mode: browser)').matches) && (window.matchMedia('(max-width: 768px)').matches)) {
		$("#frame #sidepanel #bottom-bar").css("bottom","55px");
	}	

    $.ajax({
	   type: 'GET',
	   url: '<?php echo ( ossn_site_url("components/webchat/plugins/default/webchat/emojiPanel.php"));?>',
	   success: function(response)
	   {
		  $("#message-input .emojiPanel").html(response);
	   }
	});

	// Display the emojis for the selected category
	$('#giphySelector span').click(function() {
	  $('#giphySelector span').removeClass("activeCat");
	  $(this).addClass("activeCat");
	  $('div.giphycat div.visibleChar').removeClass("visibleChar").addClass("hiddenChar");	  
	  $('#giphycat' + $(this).data('filter') + ' div').addClass("visibleChar").removeClass("hiddenChar");
	});

	recentMessages();
	// compareArrays();
});

$(".messages").animate({ scrollTop: $(document).height() }, "fast");

var scrollPos = 0;
$(".messages").on("scroll", function() {
	scrollPos = $(this).scrollTop();
	if (($(this).scrollTop() == 0) && ($.isNumeric(($("div.messages #loadMore").data("page"))))) {
		$("div.messages #loadMore").html("Loading more messages...");
		loadMore($("div.messages #loadMore").data("page"));
	}
})
		
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

// Click a contact to open the messages
$('li.contact').click(function() {
  $('li.contact').removeClass("active");
  $(this).find(".contact-new").remove();
  $(this).addClass("active");
  withguid = $(this).attr('id');
  updateActive(withguid);
  $("#messages ul").empty();
  listMessages(withguid);
  setTimeout(function(){
	  $("#sidepanel").removeClass("onFromLeft");
	  $("#sidepanel").addClass("outLeft");
	  $("#frame .content").removeClass("outRight");
	  $("#frame .content").addClass("onFromRight");
  });
});
	
///////////////////////////////GIPHY//////////////////////////
// Clicking GIPHY button
$("#giphyPanel").click(function(e) {
	$(".giphyPanel").addClass("onFromBottomGiphy").focus();
	$(".giphyPanel").removeClass("outBottomGiphy");
	$(".emojiPanel").addClass("outBottom");
	$(".emojiPanel").removeClass("onFromBottom");	
	
	var xhr = $.get('<?php echo ( ossn_site_url("giphy"));?>?action=trending');
	xhr.done(function(data) {
		$('#giphySelector .results').html("");
		var json_response = JSON.parse(decodeURIComponent(data));
		var i;
		for (i = 0; i < 25; i++) {
		  $(".clones .giphy-img").clone(true,true).append('<img data-og="' + json_response.data[i].images.original.url + '" src="' + json_response.data[i].images.fixed_width.url + '">').appendTo($('#giphySelector .results.left'));
		}
		for (i = 25; i < 50; i++) {
		  $(".clones .giphy-img").clone(true,true).append('<img data-og="' + json_response.data[i].images.original.url + '" src="' + json_response.data[i].images.fixed_width.url + '">').appendTo($('#giphySelector .results.right'));
		}
	});
});
// Clicking GIPHY image from results
$('div.giphy-img').on('click', function () {
		if ($(".giphyPanel").hasClass("onFromBottomGiphy")) {
			$(".giphyPanel").addClass("outBottomGiphy");
			$(".giphyPanel").removeClass("onFromBottomGiphy");
		}
		var giphyImg = $(this).find("img").attr("src");
		var giphyBig = $(this).find("img").attr("data-og");

		$( ".clones .sent.giphy" ).clone(true,true).html('<img src="<?php echo ossn_loggedin_user()->iconURL()->small; ?>" alt="" /><article class="giphy"><section class="message im"><img class="giphy" og="' + giphyBig + '" src="' + giphyImg + '"/></section><section class="message_time">Just now</section><i class="fa fa-circle sent-unread" aria-hidden="true"></i></article>').attr("og",giphyBig).appendTo( $('.messages ul') );
		// Scroll to show the new message
		var d = $("div.messages");		
		$(".messages").animate({ scrollTop: d.prop("scrollHeight") }, "fast");

		// Now we've sent the message, reset the size of the input box, icon locations and empty the input box.
		$('#main-input').val(null).blur();
		$('#main-input').css("height","15px");
		$("#frame .content .message-input .wrap i").css("padding-top",miniHeight + "px");
		$("#frame .content .message-input .wrap .fa").css("bottom","-32px");
		
		// Send the message to OSSN
		message = '{"img": "' + giphyImg + '", "bigImg": "' + giphyBig + '"}'

		recentMessages();
		activeContact = document.getElementById('activeContact').value;
		
		$.post("<?php echo ossn_site_url('chat_api'); ?>",
		{
		  action: 'send',  
		  from: <?php echo ossn_loggedin_user()->guid; ?>,
		  to: activeContact,
		  message: message,
		  giphy: true,
		});
	
});
// Click GIPHY image in thread
$("li.sent.giphy").click(function() {
	var giphyFull = $(this).find("img.giphy").attr("og");
   $(".giphy-fs-container .giphy-fs-image").html("<img src='" + giphyFull + "'>");
   $(".giphy-fs-container").addClass("show");
});
// Click GIPHY dismiss
$(".giphy-fs-container .giphy-fs-dismiss i").click(function() {
   $(".giphy-fs-container .giphy-fs-image").html('');
   $(".giphy-fs-container").removeClass("show");
});
// Typing in GIPHY
function delay(callback, ms) {
  var timer = 0;
  return function() {
    var context = this, args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function () {
      callback.apply(context, args);
    }, ms || 0);
  };
}
$('.giphyPanel .giphy-input').keyup( delay ( function(){
   	var xhr = $.get('<?php echo ( ossn_site_url("giphy"));?>?action=search&query=' + $(this).val());
	xhr.done(function(data) {
		$('#giphySelector .results').html("");
		var json_response = JSON.parse(decodeURIComponent(data));
		var i;
		for (i = 0; i < 25; i++) {
		  $(".clones .giphy-img").clone(true,true).append('<img data-og="' + json_response.data[i].images.original.url + '" src="' + json_response.data[i].images.fixed_width.url + '">').appendTo($('#giphySelector .results.left'));
		}
		for (i = 25; i < 50; i++) {
		  $(".clones .giphy-img").clone(true,true).append('<img data-og="' + json_response.data[i].images.original.url + '" src="' + json_response.data[i].images.fixed_width.url + '">').appendTo($('#giphySelector .results.right'));
		}
	});
}, 500));

// Clicking outside of the emoji selection panel makes it disappear			
$( "body" ).click(function( event ) {
	var target = $(event.target);    
    if ((target.parents('div.messages, div.contact-info').length) || (event.target.id == 'main-input'))  {
		if ($(".emojiPanel").hasClass("onFromBottom")) {
			$(".emojiPanel").addClass("outBottom");
			$(".emojiPanel").removeClass("onFromBottom");
		}
		if ($(".giphyPanel").hasClass("onFromBottomGiphy")) {
			$(".giphyPanel").addClass("outBottomGiphy");
			$(".giphyPanel").removeClass("onFromBottomGiphy");
		}
    }
});

// Click the emoji icon for the emoji selector panel to appear
$("#emojiPanel").click(function(e) {
	$(".emojiPanel").addClass("onFromBottom").focus();
	$(".emojiPanel").removeClass("outBottom");
	$(".giphyPanel").addClass("outBottomGiphy");
	$(".giphyPanel").removeClass("onFromBottomGiphy").focus();
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

function listMessages(withguid, offset = 1){
	$("#loader").addClass("show");
	$.post( "<?php echo ossn_site_url('chat_api'); ?>", { action: "messages", from: <?php echo ossn_loggedin_user()->guid; ?>, to: withguid, offset: offset })
     .done(function( data ) {
		// $("div.contact-profile").remove();
		// $("div.messages").remove();
		// $("div.content").prepend(data);
		// var d = $("div.messages");
		// d.scrollTop(d.prop("scrollHeight"));
		//$( ".clones .media-options" ).clone(true,true).appendTo( ".contact-profile" );
		if (data != 'null') {
		  updateMessages(data, offset);
		} else {
			$("div.messages ul").empty();
		}
     });
	 notifs_running = false;
	 $("#loader").removeClass("show");
};

function updateMessages (data, offset) {
	// Must receive a json payload containing all the messages. Will update the message thread, and contact name/picture
	var obj = jQuery.parseJSON( data );
	
	var d = $(".messages");
	// Capture the current scroll position
	var old_height = d.prop("scrollHeight");;  //store document height before modifications

	// If this is the first page of messages, reset the thread
	if (offset == 0) {
		$("div.messages ul").empty();
	}

	// Find the most recent message, and delete any you've posted since
	// var mostRecentID = 0;
	// $('.messages ul li').each(function() {
		// mostRecentID = Math.max(this.id, mostRecentID);
	// });
	// $('#' + mostRecentID).nextAll('li').remove();

	// Find the first message index that we need to start adding to the screen
	// var closest = null;
	// console.log (obj[0]);
	// $.each(obj, function(index,message){
	  // if (closest == null || Math.abs(message.id - mostRecentID) < Math.abs(closest - mostRecentID)) {
		// closest = message.id;
		// firstMessage = index;
	  // }
	// });

	// Reverse the message order if neccessary
	if (obj.maxpages > 1 ) {
		if (obj.page) {
			if (obj.page >= 1) {
				obj.messages = obj.messages.reverse();
			}
		}
	}
		
	//Now start adding the messages to the screen
	$.each(obj.messages, function(index, message) {
		// if (index >= firstMessage) {
			
			var litype = 'std';
			var messagehtml = '<img src="';
			if (message.direction == 'sent') {
				messagehtml += obj.user1icon;
			} else {
				messagehtml += obj.user2icon;
			};
			messagehtml += '" alt="" /><article';
			if (message.json == 'true') { 
				litype = 'giphy';
				messagehtml += ' class="giphy"';
				messagehtml += '><section class="message"><img class="giphy" og="' + message.giphyOriginal + '" src=\"' + message.giphyPreview + '"/>';
			} else {
				messagehtml += '><section class="message">' + message.message;
			}
			messagehtml += '</section><section class="message_time">' + message.elapsed + '</section>';
			if (message.direction == 'sent') {
				if (message.viewed == 0) {
					messagehtml += '<i class="fa fa-circle sent-unread" aria-hidden="true"></i>';
				} else {
					messagehtml += '<i class="fa fa-circle sent-read" aria-hidden="true"></i>';	
				}
			}
			messagehtml += '</article>';
			
			if (parseInt(obj.page,10) == 1) {
				$( ".clones ." + message.direction + "." + litype).clone(true,true).html(messagehtml).attr("data-id",message.id).prependTo($(".messages ul"));
			} else {
				$( ".clones ." + message.direction + "." + litype).clone(true,true).html(messagehtml).attr("data-id",message.id).prependTo($(".messages ul"));				
			}
		// }
	});

	// Check whether to display a "load more" prompt
	if (obj.maxpages > 1 ) {
		if (obj.page) {
			if (obj.page > 0) reversed = obj.messages.reverse();
			if (parseInt(obj.page,10) < obj.maxpages) 
				$(".clones #loadMore").clone(true,true).attr("data-page",parseInt(obj.page,10) + 1).html("more").prependTo($(".messages ul"));
		} else {
			$(".clones #loadMore").clone(true,true).attr("data-page","1").html("more").prependTo($(".messages ul"));
		}
	}	
	
	// Scroll to show the new message
	if (offset == 0) {
		$(".messages").animate({ scrollTop: d.prop("scrollHeight") }, "fast");
	} else {
		$(".messages").animate({ scrollTop: d.prop("scrollHeight") - old_height }, "fast");
	}
}
function updateActive(newContact) {
	// Update the contact details at the top of the screen
	$.post( "<?php echo ossn_site_url('chat_api'); ?>", { action: "getuser", guid: newContact })
	 .done(function( data ) {
		try {
		  var obj = $.parseJSON( data );
		  $("div.contact-profile img").attr("src",obj.payload.icon.small);
		  $("div.contact-profile p").html(obj.payload.fullname);
		}
		catch (err) {
		  // Will be undefined on returning to contacts. Wont need to do anything
		}
	 });
	$("#activeContact").val(newContact);
}

function compareArrays(){	
	$.post( "<?php echo ossn_site_url('chat_api'); ?>", { action: "compare" })
.done(function( data ) {
	console.log (data);
})};

function recentMessages(){	
	$.post( "<?php echo ossn_site_url('chat_api'); ?>", { action: "recent", to: <?php echo ossn_loggedin_user()->guid; ?> , active: document.getElementById('activeContact').value })
	 .done(function( data ) {
		$("div#contacts ul").empty();
		
		obj = JSON.parse(data);
		$.each(obj.payload.list, function(i,message) {
			/*var newHTML = '<li class="contact';*/
			if ( message.message_to.guid == <?php echo ossn_loggedin_user()->guid; ?>) {
				var current_message = message.message_from;
				var withguid = message.message_from.guid;
				var sent=false;
			} else {
				var current_message = message.message_to;
				var withguid = message.message_to.guid;		
				var sent=true;	
			}			
			
			if (withguid == $("#activeContact").val()) {
				// newHTML += " active";
			}
			
			// newHTML += '" id="' + withguid + '">
			
			newHTML = '<div class="wrap"><span class="contact-status ' + message.status + '"></span>';
			

			
			// Check whether the most recent message to contact has been viewed
			if (sent==true) {
				if (message.viewed == 0) {
					var tick='<i class="fa fa-circle sent-unread" aria-hidden="true"></i>';
				} else {
					var tick='<i class="fa fa-circle sent-read" aria-hidden="true"></i>';
				}
			}

			var preview = message.message;
			if (preview.length >= 30) preview=preview.substr(0,30) + "...";
			newHTML += '<img src="' + current_message.icon.small + '" alt="" /><div class="meta"><p class="name">';
			newHTML += current_message.username + '</p><p class="preview">';
			if (sent) {
				newHTML += tick;
			} else {
				// Check whether the most recent unread message was to or from
				if (message.viewed == 0 && ( message.message_to.guid == <?php echo ossn_loggedin_user()->guid; ?> )) {
					newHTML += '<i class="fa fa-comment contact-new" aria-hidden="true"></i>';
				}
			}
			if (preview[0] == '{') {
				newHTML += '<i class=\"fa fa-picture-o giphy-preview\" aria-hidden=\"true\"></i>GIF';
			} else {
				newHTML +=  preview;
			}
			newHTML += '</p></div><section class="message_time">' + message.elapsed + '</section></div>';

			$('.clones li.contact').clone(true,true).html(newHTML).attr("id",withguid).appendTo("#contacts ul"); 
		});
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
				}

				// Update everybodies status
				jQuery.each(JSON.parse(returnedData.statuses), function(i, val) {
				  if (val == true) {
					$('#' + i + ' div span.contact-status').addClass('online');
					$('#' + i + ' div span.contact-status').removeClass('busy');
				  } else {
					$('#' + i + ' div span.contact-status').addClass('busy');
					$('#' + i + ' div span.contact-status').removeClass('online');
				  }
				});
				
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
	  $('div.messages #loadMore').remove();
	  listMessages (withguid,offset);
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

// Homescreen installation
/* if (/chrome/i.test(navigator.userAgent)) {
	console.log ("Chrome detected. Adding button to menu.");
	$(".clones .siteappinstaller-install-button").clone(true,true).appendTo($('#bottom-bar'));

	var promptEvent; 

    window.addEventListener('beforeinstallprompt', function (e) {
        e.preventDefault();
        promptEvent = e;
		console.log ("Removing 'disabled' attribute from button");
		$('#siteappinstaller-install-button').removeAttr('disabled');
		$('#siteappinstaller-install-button').show();
        listenToUserAction();
    });

    function listenToUserAction() {
		console.log ("listenToUserAction()");		
        const installBtn = document.getElementById("siteappinstaller-install-button");
        installBtn.addEventListener("click", presentAddToHome);
    }

    function presentAddToHome() {
		console.log ("presentAddToHome()");
		$('#bottom-bar #siteappinstaller-install-button').hide();
        promptEvent.prompt();
        promptEvent.userChoice.then(choice => {
			if (choice.outcome === 'accepted') {
				//console.log('User accepted');
				if (/android/i.test(navigator.userAgent)) {
					alert(Ossn.Print('com:webchat:account_settings_section_installed_message'));
				}
				Ossn.redirect('');
			} else {
				//console.log('User dismissed');
			}
		})
	}
} */
	/* NEW SECTION FOR WebChat Class based functionality  */

/* Page Ready functions */
$(function() {
});

$('#addChat').click(function() {
	$('#addChatMenu').addClass('show');
});
$('#addChatMenu .wrap header i').click(function() {
	$('#addChatMenu').removeClass('show');
});
$('#addChatMenu .wrap ul.contacts li').click(function() {
	if ($(this).parent().attr('class')=='contacts') {
		$(this).appendTo('#addChatMenu .wrap ul.newMembers');
	} else {
		$(this).appendTo('#addChatMenu .wrap ul.contacts');
		sortUL('#addChatMenu .wrap ul.contacts');
	}
});
$('#addChatMenu .wrap ul.newMembers li').click(function() {
	if ($(this).parent().attr('class')=='contacts') {
		$(this).appendTo('#addChatMenu .wrap ul.newMembers');
	} else {
		$(this).appendTo('#addChatMenu .wrap ul.contacts');
		sortUL('#addChatMenu .wrap ul.contacts');
	}
});

function sortUL(selector) {
	$(selector).each(function(){
		$(this).children('li').sort((a,b)=>a.innerText.localeCompare(b.innerText)).appendTo(this);
	});
}
</script>
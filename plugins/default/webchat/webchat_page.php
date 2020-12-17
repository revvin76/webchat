<?php
$chatUser = ossn_loggedin_user()->guid;
$path_img = ossn_site_url('components/webchat/plugins/default/img');
$path_wcroot = ossn_site_url('webchat');

/* Capture the friends list */
$friends = ossn_loggedin_user()->getFriends();

$component = new OssnComponents;
$WebChatSettings  = $component->getSettings("webchat");

$timestamp = time();
$token     = ossn_generate_action_token($timestamp);
$token   = array(
		'ossn_ts' => $timestamp,
		'ossn_token' => $token
);
$configs = array(
		'token' => $token,
		'cache' => array(
				'last_cache' => hash('crc32b', ossn_site_settings('last_cache')),
				'ossn_cache' => ossn_site_settings('cache')
		)
);
echo ("<script> var tokenurl = ('?ossn_ts=".json_encode($token['ossn_ts'])."&ossn_token=".$token['ossn_token']."');</script>");

?>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>

<div id="frame">
	<input id="activeContact" type="number" value="-1" hidden />
	<div id="sidepanel">
		<div id="profile">
			<!--<div class="wrap">-->
			<?php 
			 <button id="homeButton">
				<i class="fa fa-home fa-fw" aria-hidden="true"></i>
				<span><?php echo ossn_print('com:webchat:homebutton'); ?></span>
			</button>
			 <button id="chatButton" data-panel='contacts' class="option active">
				<span>Chats</span>
			</button>
			 <button id="newsButton" data-panel='newspanel' class="option">
				<span>Newsfeed</span>
			</button>
			 <button id="profileButton" data-panel='profilepanel' class="option">
				<span>Profile</span>
			</button>
			 <button id="searchButton" data-panel='searchpanel' class="option">
				<span>Search</span>
			</button>
			 <button id="accountButton" data-panel='accountpanel' class="option">
				<span>Account</span>
			</button>
			  if ($WebChatSettings->homeButton==1) {
				  if ($WebChatSettings->homeURL==1) echo '<a href="' . ossn_site_url($WebChatSettings->homeURLPath) . '" class="button">';
				  
				  if ($WebChatSettings->homeButtonStyle==0)echo '<i class="fa ' . $WebChatSettings->homeChar . '"></i>';
				  
				  if ($WebChatSettings->homeButtonStyle==1)echo '<img src="' . $WebChatSettings->homeImgPath . '" alt=""/>';
				  
				  echo '<span>' . ossn_print('com:webchat:homebutton') . '</span>';
				  
				  if ($WebChatSettings->homeURL==1) echo '</a>';
				  
			  }?>
		</div>
		<div id="contacts">
			<ul>
			</ul>
		</div>
		<div id="bottom-bar">
			<button id="addChat">
				<i class="fa fa-user-plus fa-fw" aria-hidden="true"></i>
				<span><?php echo ossn_print('com:webchat:menu:addchat'); ?></span>
			</button>
			<button id="fullscreen"><i class="fa fa-arrows-alt fa-fw" aria-hidden="true"></i> <span><?php echo ossn_print('com:webchat:menu:fullscreen'); ?></span></button>			
			<?php if(ossn_isAdminLoggedin()) {
					echo '<button onclick="location.href = \'' . ossn_site_url("administrator") . '\';" id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>' . ossn_print('com:webchat:menu:settings') . '</span></button>';
				}; ?>
			<button onclick="location.href='<?php echo ossn_site_url("action/user/logout?ossn_ts=") . $token['ossn_ts'] . "&ossn_token=" . $token['ossn_token']; ?>'" id="logout"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> <span><?php echo ossn_print('com:webchat:menu:logout'); ?></span></button>
		</div>
	</div>
	<div id="addChatMenu">
		<div class="wrap">
			<header><p></p><i class="fa fa-times" aria-hidden="true"></i></header>
			<input id="groupName" placeholder="Subject (optional)"/>
			<div class="newMembersContainer">
				<ul class="newMembers">
				</ul>
			</div>
			<div class="container">
				<ul class="contacts">

				</ul>
			</div>
			<div class="chatadd-button new">
				<i class="fa fa-arrow-right send" aria-hidden="true"></i>
			</div>				
		</div>
	</div>

	<div id="content" class="content">
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
				$('#message-menu').removeClass('show');
				$('#activeContact').val('-1');
			});</script>			
			<img src="" alt="" />
			<div class="groupinfo">
				<p class="groupname"></p>
				<p class="groupmembers"></p>
			</div>
			<div id="media-options" class="media-options">
				<!-- <i class="fa fa-video-camera" aria-hidden="true"></i> -->
				<!-- <i class="fa fa-phone" aria-hidden="true"></i> -->
				<i class="fa fa-ellipsis-v message-menu" aria-hidden="true"></i>
				<div id="message-menu" class="dropdown-content">
					<ul>
						<!-- <li id="view-user-btn"><span>View User Details</span></li> -->
						<!-- <li id="report-user-btn"><span>Report User</span></li> -->
					 	<!-- <li id="block-user-btn"><span>Block User</span></li> -->
						<!-- <li id="clear-chat-btn"><span>Clear Chat</span></li> -->

						<li class="media-group-btn"><i class="fa fa-picture-o" aria-hidden="true"></i><span>View Group Images</span></li>
						<li class="mute-group-btn"><i class="fa fa-bell-slash-o" aria-hidden="true"></i><span>Mute Notifications</span></li>
						
					</ul>
				</div>
			</div>
		</div>
		<div id="messages" class="messages">
			<span class="messages">
				<ul id="messageList">
				</ul>
			</span>
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
			<div class="group-photos-container"><ul></ul></div>
			<li class="sent std" data-id=""></li>
			<li class="replies std" data-id=""></li>
			<li class="message" data-id="#">
				<img class="profile" src="#" alt="">
				<article>
					<img class="giphy" src="#" alt="">
					<section class="name"><span class="section_name_span"></span></section>
					<section class="message"></section>
					<section class="message_time"></section>
				</article>
			</li>
			<li class="contact" id="#">
				<div class="wrap">
					<span class="contact-status"></span>
					<img src="" alt="">
					<div class="meta">
						<p class="name"></p>
						<p class="preview"></p>
					</div>
					<section class="message_time"></section>
				</div>
			</li>
			<div class="giphy-img"></div>
			<i class="fa fa-times delphoto"></i>
			<li class="group-photo"></li>
			<img class="giphy"></img>
			<span id="loadMore" data-page="0">more</span>
			<div class="url_preview">
				<img class="url_image"></img>
				<span class="previewholder">
					<p class="title"></p>
					<span class="descriptionholder">
						<span class="textholder"><p class="description"></p></span>
						<div class="fadeout"></div>
					</span>
					<p class="sitename"></p>
				</span>
			</div>
			<!-- <div class="media-options"> -->
				<!-- <i class="fa fa-video-camera" aria-hidden="true"></i> -->
				<!-- <i class="fa fa-phone" aria-hidden="true"></i> -->
				<!-- <i class="fa fa-ellipsis-v message-menu" aria-hidden="true"></i> -->
				<!-- <div id="message-menu" class="dropdown-content"> -->
					<!-- <ul> -->
					<!-- <li id="view-user-btn">View User Details</li> -->
					<!-- <li id="report-user-btn">Report User</li> -->
					<!-- <li id="block-user-btn">Block User</li> -->
					<!-- <li id="clear-chat-btn">Clear Chat</li> -->
					<!-- </ul> -->
				<!-- </div> -->
			<!-- </div> -->
			<button class="siteappinstaller-install-button" >
				<i class="fa fa-download fa-fw\" aria-hidden="true"></i>
				<span><?php echo ossn_print('com:webchat:account_settings_section_button'); ?></span>
			</button>		
			<li class="addContact" data-guid="#">
				<div class="imgcontainer"><img src="#" alt=""></div>
				<div class="namecontainer"><p class="name"></p></div>
				<div class="iconcontainer"><i class="fa fa-times removeMember" aria-hidden="true"></i></div>
			</li>	
			<div id="message-menu">
				<ul>
					<span class="group-owner-buttons">
						<li class="rename-group-btn"><i class="fa fa-pencil" aria-hidden="true"></i><span>Rename Group</span></li>
						<li class="manage-group-btn"><i class="fa fa-wrench" aria-hidden="true"></i><span>Manage Members</span></li>
						<li class="delete-group-btn"><i class="fa fa-ban" aria-hidden="true"></i><span>Delete Group</span></li>					
						<li class="delegate-group-btn"><i class="fa fa-ban" aria-hidden="true"></i><span>Delegate Admin</span></li>	
					</span>
					<span class="group-viewer-buttons">
						<li class="view-group-btn"><i class="fa fa-users" aria-hidden="true"></i><span>View Members</span></li>	
						<li class="leave-group-btn"><i class="fa fa-group"></i><span>Leave Group</span></li>
					</span>
				</ul>
			</div>
</div>
<div class="cd-popup" role="alert">
   <div class="cd-popup-container">
	  <span class="cd-header">
		<legend>legend</legend>
	  </span>
	  <span class="cd-content">
        <p>Are you sure you want to delete this element?</p>
		<input id="cd-popup-input" placeholder="placeholder"/>
	  </span>
	  <span class="cd-footer">
        <ul class="cd-buttons">
           <li class="dialog-yes">Yes</li>
           <li class="dialog-no"><?php echo ossn_print('com:webchat:generic:dismiss'); ?></li>
        </ul>
	  </span>
   </div> <!-- cd-popup-container -->
</div> <!-- cd-popup -->
<div class="cd-popup-fade"></div>
<div class="giphy-fs-container">
    <div class="giphy-fs-dismiss"><i class="fa fa-times" aria-hidden="true"></i></div>
    <div class="giphy-fs-image"><p class="image-owner"></p><img src="#" alt=""></img></div>
    <div id="bottom-bar-photo">
		<button id="group_image_button">
			<i class="fa fa-upload fa-fw" aria-hidden="true"></i>
			<?php echo ossn_print('com:webchat:group:changephoto:choose'); ?>
		</button>
		<button id="group_image_select">
			<i class="fa fa-picture-o fa-fw" aria-hidden="true"></i>
			<?php echo ossn_print('com:webchat:group:changephoto:select'); ?>
		</button>
		<input id="group_image" class="file-input" type="file" accept="image/*" />
    </div>	
</div>
<div class="powered"></div>

<script>   
var notifs_running = false;
var notifcount = '<?php echo (print_r(json_encode($notifcount),true)); ?>';

const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
const vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);

function amIMobile() {
 return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
};

$(function() {
	if (window.matchMedia('(display-mode: standalone)').matches) {
		$('.siteappinstaller-install-button').hide();
	}	

	<!-- console.log (amIMobile(),amIFullscreen()); -->
	<!-- if(!amIMobile()) { -->
	 <!-- $("#frame #sidepanel #bottom-bar").css("bottom","0vh"); -->
	 <!-- $("#frame #bottom-bar-photo").css("bottom","0vh"); -->
	<!-- } -->
	<!-- if ((window.matchMedia('(display-mode: browser)').matches) && (window.matchMedia('(max-width: 768px)').matches)) { -->
		<!-- $("#frame #sidepanel #bottom-bar").css("bottom","55px"); -->
	<!-- }	 -->

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

});

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

<!-- $(".expand-button").click(function() { -->
  <!-- $("#profile").toggleClass("expanded"); -->
	<!-- $("#contacts").toggleClass("expanded"); -->
<!-- }); -->
var running = false;
var owner = null;
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
		//checkNotifs();
	}
}, 3000); 



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

// Homescreen installation //
/*
 if (/chrome/i.test(navigator.userAgent)) {
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

/* VARIABLES FOR JAVASCRIPT / JQUERY */
webchat_root = "<?php echo $path_wcroot; ?>";
var friends = null;
var images_path = "<?php echo ossn_site_url('images'); ?>";

/* PAGE READY */
$(function() {
	channel = "User_<?php echo ossn_loggedin_user()->guid; ?>";
	var channel = pusher.subscribe(channel);
	channel.bind('groupMembership', function(data) {
		pusher_groupMembership(JSON.stringify(data));
	});	
	wcWelcome();
	wcGetFriends(1);
});

/* CLICK EVENTS */
$('div.url_preview').on('click', function () {																// Clicking URL Preview
	var url = $(this).attr('data-url');
	if (!url.match(/^[a-zA-Z]+:\/\//))
	{
		url = 'http://' + url;
	}
	var win = window.open(url, '_blank');
	win.focus();
});
$('#message-input .wrap .send').click(function() {															// Click the SEND button
  wcNewMessage();
  return false;
});
$('#addChat').click(function() {																			// Click the create new group button
	event.preventDefault();
	wcGetContacts(0);
});
$('#addChatMenu .wrap header i').click(function() {															// Dismiss the create new group dialog
	event.preventDefault();
	$('#addChatMenu').removeClass('show');
});
$('#addPhotoMenu .wrap header i').click(function() {														// Dismiss the addPhoto menu dialog
	event.preventDefault();
	$('#addPhotoMenu').removeClass('show');
});
$('.chatadd-button i').click(function() {																	// Confirm and create the new group
	event.preventDefault();
	var guids = null;
	var type = null;
	newGroup = false;
	editGroup = false;
	
	/// IF WE ARE EDITING //
	if ($('.chatadd-button i').hasClass('edit')) {
		editGroup = true;
		guids = $('#addChatMenu .wrap ul.newMembers li.addContact').map(function() { 
			if ($(this).attr('data-type') == 'new') return $(this).attr('data-guid'); 
		}).get().join(', ');
		name = $('#addChatMenu .wrap input').val();

		removes = $('#addChatMenu .wrap ul.contacts li.addContact').map(function() { 
			if ($(this).attr('data-type') == 'current') return $(this).attr('data-guid'); 
		}).get().join(', ');	

	} else if ($('.chatadd-button i').hasClass('new')) {
		newGroup = true;
		guids = $('#addChatMenu .wrap ul.newMembers li.addContact').map(function() { 
		 return $(this).attr('data-guid'); 
		}).get().join(', ');	
	}

	if (!$('.chatadd-button i').hasClass('view')) {
		name = $('#addChatMenu .wrap input').val();	
		if (newGroup) removes = null;
		
		if ((newGroup & !guids) || (editGroup & !guids & !removes)) {
				$(".cd-popup legend").html("<?php echo ossn_print('com:webchat:group:adderror'); ?>");
				if (editGroup) $(".cd-popup p").html("<?php echo ossn_print('com:webchat:group:noselection'); ?>");
				if (newGroup)  $(".cd-popup p").html("<?php echo ossn_print('com:webchat:group:nomembers'); ?>");
				$(".cd-popup .dialog-yes").hide();
				$(".cd-popup .dialog-no").show();
				$(".cd-popup .dialog-no").text("<?php echo ossn_print('com:webchat:generic:ok'); ?>");
				$(".cd-popup").addClass("show");
				$(".cd-popup-fade").addClass("show");  
				$("#cd-popup-input").hide();  
		} else {
			$('#addChatMenu').removeClass('show');
			if ($('.chatadd-button i').hasClass('edit')) {
				if (guids) wcAddMembers(guids);
				if (removes) {
					cdPopup("<?php echo ossn_print('com:webchat:generic:sure'); ?>",
					"<?php echo ossn_print('com:webchat:group:removeanddelete'); ?>",
					true,
					"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
					"callback_wcRemoveMembers('" + removes.toString() + "');",
					true,
					"<?php echo ossn_print('com:webchat:generic:cancel'); ?>",
					"callback_wcRemoveMembers(false);");	
					$("#cd-popup-input").hide();  
				}
			} else if ($('.chatadd-button i').hasClass('new')) {
				wcCreateGroup(name, guids);
			}
		}
	}
});
$('.addContact').click(function() {																			// Click a user name to add to a new group
	event.preventDefault();
	if ($(this).hasClass('delegate')) {
			if ($('.chatadd-button i').hasClass('edit')) {
				cdPopup("<?php echo ossn_print('com:webchat:generic:sure'); ?>",
				"<?php echo ossn_print('com:webchat:group:delegate:confirm'); ?>",
				true,
				"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
				"callback_wcDelegate('" + $(this).attr('data-guid') + "');",
				true,
				"<?php echo ossn_print('com:webchat:generic:cancel'); ?>",
				"callback_cancel();");	 
			}
	} 
	else if (!$(this).hasClass('view')) {
		if ($(this).parent().attr('class')=='contacts') {
			$(this).appendTo('#addChatMenu .wrap ul.newMembers');
		} else {
			$(this).appendTo('#addChatMenu .wrap ul.contacts');
			sortUL('#addChatMenu .wrap ul.contacts');
		}
	}
});
$('i.delphoto').click(function() {																			// Click the delete photo button
	event.preventDefault();
	var file = null;
	var file2 = null;
	var messageid = null;
	var photoid = null;
	
	var type = $(this).attr('data-type');
	if (type == "group") {
		photoid = $(this).attr('data-id');
		var cbText = "callback_wcDeletePhoto(" + photoid + ",'" + type + "', null, null, null)";
	}
	if (type == "user") {
		file = $(this).attr('data-file');
		file2 = $(this).parent().find('img').attr('src');
		messageid = $(this).attr('data-messageid');
		var cbText = "callback_wcDeletePhoto(null,'" + type + "','" + file + "','" + file2 + "', " + messageid + ")";
	}
	
	$('#addChatMenu').removeClass('show');
	cdPopup("<?php echo ossn_print('com:webchat:generic:sure'); ?>",
	"<?php echo ossn_print('com:webchat:group:deletephoto'); ?>",
	true,
	"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
	cbText,
	true,
	"<?php echo ossn_print('com:webchat:generic:cancel'); ?>",
	"callback_cancel();");	
});	
$( "body" ).click(function( event ) {																		// Clicking outside of the emoji selection panel makes it disappear
	var target = $(event.target);    
	if (target.parents('div.messages, div.message-input, .back-arrow').length || (event.target.id == 'media-options')) {
		if ($("#message-menu").hasClass("show")) $("#message-menu").removeClass("show");
	}
	
    if ((target.parents('div.messages, div.contact-info').length) || (event.target.id == 'main-input'))  {
		if ($(".emojiPanel").hasClass("onFromBottom")) {
			$(".emojiPanel").addClass("outBottom");
			$(".emojiPanel").removeClass("onFromBottom");
		}
		if ($(".giphyPanel").hasClass("onFromBottomGiphy")) {
			$(".giphyPanel").addClass("outBottomGiphy");
			$(".giphyPanel").removeClass("onFromBottomGiphy");
		}
		$("#messages").removeClass("emoji");
		$("#messages").removeClass("giphy");

    }
});
$("#emojiPanel").click(function(e) {																		// Click the emoji icon for the emoji selector panel to appear
	$(".emojiPanel").addClass("onFromBottom").focus();
	$(".emojiPanel").removeClass("outBottom");
	$(".giphyPanel").addClass("outBottomGiphy");
	$(".giphyPanel").removeClass("onFromBottomGiphy").focus();
	$("#messages").addClass("emoji");
	$("#messages").removeClass("giphy");	
	var d = $("div.messages");
	d.scrollTop(d.prop("scrollHeight"));
});
$("#fullscreen").click(function() {																			// Toggle fullscreen

	toggleFullScreen();
	<!-- if (amIMobile()) { -->
		<!-- if (amIFullscreen) { -->
			<!-- $("#frame #sidepanel #bottom-bar").css("bottom","0"); -->
			<!-- $("#bottom-bar-photo").css("bottom","0"); -->
		<!-- } else { -->
			<!-- $("#frame #sidepanel #bottom-bar").removeAttr("style"); -->
			<!-- $("#bottom-bar-photo").removeAttr("style"); -->
		<!-- } -->
	<!-- } -->
});
$("#group_image_button").click(function() {
	$("#group_image").click();
});
$("#group_image_select").click(function() {
	wcSelectGroupPhoto($(".giphy-fs-container .giphy-fs-image img").attr('src'));
	dismissFsContainer();
});
$("#group_image").change(function() {
	dismissFsContainer();
	//$('#group_image_button').hide();
	wcSetGroupPhoto(2);
});
$("#image-upload").change(function() {
	dismissFsContainer();
	wcNewMessage(3,$(this).val());
});
$(".dialog-no").click(function() {  																		// Dismiss dialog
   $(".cd-popup").removeClass("show");
   $(".cd-popup-fade").removeClass("show");
   $(".cd-popup ul li.dialog-yes").attr("href", "#");
});
$('.emojiPanel').on('click', '#emojiSelector .visibleChar input', function () {								// Clicking an emoji
    $(".message-input .wrap > textarea").val($(".message-input .wrap > textarea").val() + $(this).attr('value'));
});
$('.media-options .message-menu').on('click', function () {													// Clicking message menu
	$('#message-menu').toggleClass('show');
});
$('li.contact').click(function() {																			// Click a contact to open the messages
  $('li.contact').removeClass("active");
  $(this).find(".contact-new").remove();
  $(this).addClass("active");
  $(this).removeClass("new");
  withguid = $(this).attr('id');
  owner = $(this).attr('data-owner');
  // updateActive(withguid);
  $("#messages ul").empty();
  // listMessages(withguid);
  wcGetGroupMessages(withguid);
  $('#activeContact').val($(this).attr('id'));
  setTimeout(function(){
	  $("#sidepanel").removeClass("onFromLeft");
	  $("#sidepanel").addClass("outLeft");
	  $("#frame .content").removeClass("outRight");
	  $("#frame .content").addClass("onFromRight");
  });
});

/* CALLBACKS */

function callback_wcDeletePhoto(photoid=null, type=null, file1=null, file2=null, messageid=null) {																	// Confirm deleting photo from group
	$(".cd-popup .dialog-yes").attr('onclick','');
	$(".cd-popup .dialog-no").attr('onclick','');
	$(".cd-popup").removeClass("show");
	$(".cd-popup-fade").removeClass("show"); 	
	wcDeletePhoto(photoid, type, file1, file2, messageid);
}
function callback_wcLeaveGroup(selected) {																	// Confirm leaving group
	$(".cd-popup .dialog-yes").attr('onclick','');
	$(".cd-popup .dialog-no").attr('onclick','');
	$(".cd-popup").removeClass("show");
	$(".cd-popup-fade").removeClass("show"); 	
	if (selected) wcLeaveGroup();
}
function callback_wcDeleteGroup() {																			// Confirm leaving group
	$(".cd-popup .dialog-yes").attr('onclick','');
	$(".cd-popup .dialog-no").attr('onclick','');
	$(".cd-popup").removeClass("show");
	$(".cd-popup-fade").removeClass("show"); 	
	wcDeleteGroup();
}
function callback_wcRemoveMembers(removes) {																// Confirm member removal
	$(".cd-popup .dialog-yes").attr('onclick','');
	$(".cd-popup .dialog-no").attr('onclick','');
	$(".cd-popup").removeClass("show");
	$(".cd-popup-fade").removeClass("show"); 	
	if (removes) wcRemoveMembers(removes);
}
function callback_wcDelegate(userid) {																		// Click ok to confirm new Admin
	$(".cd-popup .dialog-yes").attr('onclick','');
	$(".cd-popup .dialog-no").attr('onclick','');
	$(".cd-popup").removeClass("show");
	$(".cd-popup-fade").removeClass("show"); 	
	if (userid) wcDelegate(userid);
	dismissAddChatMenu()	
}
function callback_cancel() {																				// Cancel the form dialog
	$(".cd-popup .dialog-yes").attr('onclick','');
	$(".cd-popup .dialog-no").attr('onclick','');
	$(".cd-popup").removeClass("show");
	$(".cd-popup-fade").removeClass("show"); 
}

/* WEBCHAT API FUNCTIONS 	*/
/* GET (SELECT) 			*/
function wcGetContacts(type = 0){	
	// Type 0 = Default "Add Chat" form
	// 		1 = Edit Chat form
	//		2 = View members
	//		3 = Delegate new group owner
	
	// Reset the form before making any changes
	$("#addChatMenu .wrap ul.contacts").empty();
	$("#addChatMenu #groupName").val('');
	$("#addChatMenu .newMembersContainer ul.newMembers").empty();
	$('#addChatMenu wrap').removeClass('view');
	$('.chatadd-button').hide();	

	// Setup the form for the type requested
	if (type == 1) {
		$('#addChatMenu .wrap header p').text('<?php echo ossn_print("com:webchat:group:editchat"); ?>');
		$("#addChatMenu #groupName").attr('placeholder',($('.contact-profile .groupinfo p.groupname').text()));
		$("#addChatMenu #groupName").prop( "disabled", true );
		$('.chatadd-button i').removeClass('new');
		$('.chatadd-button i').addClass('edit');
		$('.chatadd-button').show();		
										  
		$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "getGroupMembers", groupid : $("#activeContact").val().toString()})
			.fail(function() {
	location.reload();
	})
	.done(function( data ) {
			if (data != false) {
			obj = JSON.parse(data);
				data = JSON.parse(data);
				if (data[0].status == "Success") {
					$.each(data[0].payload.members, function(i,contact) {
						if (i != <?php echo ossn_loggedin_user()->guid; ?> ){
							temp = $(".clones .addContact").clone(true,true).attr("data-guid", i).appendTo("#addChatMenu .wrap ul.newMembers");
							$(temp).find("img").attr("src", data[0].payload.members[i].icon);
							$(temp).attr("data-type", "current");
							$(temp).find(".name").text(data[0].payload.members[i].name);
						}
					});

					// Lets remove users from the friends list that already exist as members
					var toRemove = [];
					$.each(data[0].payload.members, function(m,member) {
						$.each(data[0].payload.friends, function(f,friend) {
							if (m == f) toRemove.push(f);
						});
					});

					$.each(data[0].payload.friends, function(i,contact) {
						if (!intInArray(toRemove, i)) {
							temp = $(".clones .addContact").clone(true,true).attr("data-guid", i).appendTo("#addChatMenu .wrap ul.contacts");
							$(temp).find("img").attr("src", data[0].payload.friends[i].icon);
							$(temp).attr("data-type", "new");
							$(temp).find(".name").text(data[0].payload.friends[i].name);
						}
					});
					$('#addChatMenu').addClass('show');
				} else {
					$(".cd-popup legend").html(data[0].status);
					$(".cd-popup p").html(data[0].message);
					$(".cd-popup .dialog-yes").hide();
					$(".cd-popup").addClass("show");
					$(".cd-popup-fade").addClass("show");   
				}
			};
		});
	}
	else if (type == 2) {
		$('#addChatMenu header p').text('<?php echo ossn_print('com:webchat:group:viewchat'); ?>');
		$("#addChatMenu #groupName").attr('placeholder',($('.contact-profile .groupinfo p.groupname').text()));
		$("#addChatMenu #groupName").prop( "disabled", true );
		$('.chatadd-button i').removeClass('new');
		$('.chatadd-button i').addClass('edit');
		$('.chatadd-button').hide();
		$('#addChatMenu .wrap').addClass('view');
		
		$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "getGroupMembers", groupid : $("#activeContact").val().toString()})
			.fail(function() {
			// This may need to be remove when PWA is enabled - as that should use local cache whilst offline rather than trying to constantly refresh. 
				location.reload();
			})
	.done(function( data ) {
			if (data != false) {
			obj = JSON.parse(data);
				data = JSON.parse(data);
				if (data[0].status == "Success") {
					$.each(data[0].payload.members, function(i,contact) {
						if (i != <?php echo ossn_loggedin_user()->guid; ?> ){
							temp = $(".clones .addContact").clone(true,true).attr("data-guid", i).appendTo("#addChatMenu .wrap ul.contacts");
							$(temp).find("img").attr("src", data[0].payload.members[i].icon);
							$(temp).attr("data-type", "view");
							$(temp).addClass("view");
							$(temp).find(".name").text(data[0].payload.members[i].name);
						}
					});

					$('#addChatMenu').addClass('show');
				} else {
					$(".cd-popup legend").html(data[0].status);
					$(".cd-popup p").html(data[0].message);
					$(".cd-popup .dialog-yes").hide();
					$(".cd-popup").addClass("show");
					$(".cd-popup-fade").addClass("show");   
				}
			};
		});
	} 
	else if (type == 3) {
		$('#addChatMenu header p').text('<?php echo ossn_print('com:webchat:group:delegate'); ?>');
		$("#addChatMenu #groupName").attr('placeholder',($('.contact-profile .groupinfo p.groupname').text()));
		$("#addChatMenu #groupName").prop( "disabled", true );
		$('.chatadd-button i').removeClass('new');
		$('.chatadd-button i').addClass('edit');
		$('.chatadd-button').hide();
		$('#addChatMenu .wrap').addClass('view');
		$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "getGroupMembers", groupid : $("#activeContact").val().toString()})
			.fail(function() {
	location.reload();
	})
	.done(function( data ) {
			if (data != false) {
			obj = JSON.parse(data);
				data = JSON.parse(data);
				if (data[0].status == "Success") {
					$.each(data[0].payload.members, function(i,contact) {
						if (i != <?php echo ossn_loggedin_user()->guid; ?> ){
							temp = $(".clones .addContact").clone(true,true).attr("data-guid", i).appendTo("#addChatMenu .wrap ul.contacts");
							$(temp).find("img").attr("src", data[0].payload.members[i].icon);
							$(temp).attr("data-type", "delegate");
							$(temp).addClass("delegate");
							$(temp).find(".name").text(data[0].payload.members[i].name);
						}
					});

					$('#addChatMenu').addClass('show');
				} else {
					$(".cd-popup legend").html(data[0].status);
					$(".cd-popup p").html(data[0].message);
					$(".cd-popup .dialog-yes").hide();
					$(".cd-popup").addClass("show");
					$(".cd-popup-fade").addClass("show");   
				}
			};
		});
	} 
	else {
		$("#addChatMenu #groupName").prop('disabled', false );
		$('#addChatMenu header p').text('<?php echo ossn_print('com:webchat:group:newchat'); ?>');
		$("#addChatMenu #groupName").attr('placeholder','<?php echo ossn_print('com:webchat:group:rename:placeholder'); ?>');
		$('.chatadd-button i').addClass('new');
		$('.chatadd-button i').removeClass('edit');
		$('.chatadd-button').show();
		
		$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "getContacts"})
		 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {
			if (data != false) {
			obj = JSON.parse(data);
				$.each(obj, function(i,contact) {
					temp = $(".clones .addContact").clone(true,true).attr("data-guid", i).appendTo("#addChatMenu .wrap ul.contacts");
					$(temp).find("img").attr("src", obj[i].icon);
					$(temp).find(".name").text(obj[i].name);
				});
				
				$('#addChatMenu').addClass('show');
			};
		 });
	}
};		
function wcGetFriends(cb = 0, groupid){
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "getFriends"})
	 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {
		if (data != false) {
			friends = JSON.parse(data);
		}
		if (cb == 1) wcGetGroups();
		if (cb == 2) wcGetGroupMessages(groupid);
	 });
};
function wcGetGroupMessages(groupid){
	$('#activeContact').val(groupid);
	var d = $(".messages");
	
	wcUpdateGroupInfo();
	$('#media-options #message-menu ul .group-viewer-buttons').remove();	 
	$('#media-options #message-menu ul .group-owner-buttons').remove();
			
	if (owner == <?php echo ossn_loggedin_user()->guid; ?>) {
		$('.clones #message-menu ul .group-owner-buttons').clone(true, true).prependTo("#media-options #message-menu ul");
	} else {
		$('.clones #message-menu ul .group-viewer-buttons').clone(true, true).prependTo("#media-options #message-menu ul");
	}
	
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "getGroupMessages", groupid: groupid})
	 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {
		if (data != false) {
			obj = JSON.parse(data);
			
			$.each(obj, function(i,contact) {
				temp = $(".clones li.message").clone(true,true).appendTo("#messages ul");

				if (obj[i].preview) {
					var preview = obj[i].preview;
					urlPreview = $('.clones .url_preview').clone(true,true).prependTo($(temp));
					if (preview.url !=  null) $(urlPreview).attr('data-url',preview.url);
					if (preview.sitename !=  null) $(urlPreview).find("p.sitename").html('<i class="fa fa-globe" aria-hidden="true"></i> ' + preview.sitename);
					if (preview.title !=  null) $(urlPreview).find("p.title").html(preview.title);
					if (preview.description !=  null)$(urlPreview).find("p.description").html(preview.description);
					if (preview.image == null || preview.image == "No image found") {
						<!-- $(urlPreview).find("img.url_image").remove(); -->
					} else {
						var thumburl = preview.image;
						if ($.isNumeric(preview.image[0])) thumburl = "<?php echo ossn_site_url('images/users/'); ?>" + preview.image;
						$(urlPreview).find("img.url_image").attr('src',thumburl);

						if (preview.thumbcolour != null) {
							$(urlPreview).find("img.url_image").css("background-color",preview.thumbcolour);
						}
					}
					
					if (preview.url != null) {
						let str = obj[i].message;
						let newStr = str.replace(preview.url + ' ','');			
						<!-- obj[i].message = text; -->
						obj[i].message = str.replace(preview.url + ' ','');
					}
				}
				if (obj[i].message_from == <?php echo ossn_loggedin_user()->guid; ?>) {
					var response = false;
					$(temp).addClass("sent");
					$(temp).find("article .name").remove();
					$(temp).find("img.profile").remove();
				} else {
					var response = true;
					if (obj[i].message_from == 0) {
						$(temp).addClass("info");		
						$(temp).find("article .name").remove();
						$(temp).find("img.profile").remove();						
						$(temp).find("img.giphy").remove();						
					} else {
						$(temp).addClass("replies");
						$(temp).find("article .name .section_name_span").html(friends[obj[i].message_from].fullname);
						$(temp).find("img.profile").attr("src",friends[obj[i].message_from].iconsmall);
					}
				}
				
				var jsonmsg = decodeEntities(obj[i].message); 

				if (isJSON(jsonmsg) & (jsonmsg.charAt(0) == '{')) {
					jsonmsg = JSON.parse(jsonmsg);
					$(temp).addClass("giphy");
					$(temp).find("article").addClass("giphy");
					$(temp).find("img.giphy").attr("og",jsonmsg.bigImg);
					$(temp).find("img.giphy").attr("src",jsonmsg.img);
					$(temp).find("article .message").remove();
					if (response) {
						$(temp).find("article").prepend('<div class="fade-top"></div>');
					}
					$(temp).find("article").append('<div class="fade-bottom"></div>');
				} else {
					if (obj[i].message.length==9 & obj[i].message.codePointAt(0) == 38 & obj[i].message.codePointAt(1) == 35 & obj[i].message.codePointAt(2) == 120 ) temp.find(".message").addClass("lg-emoji");
					$(temp).find("article .message").html(obj[i].message);
				}
			
				$(temp).attr("data-id", obj[i].id);				
				$(temp).find("article .message_time").text(obj[i].elapsed);
				
			});
			
			// Set scroll position to bottom of newly added messages
			$(".messages").animate({ scrollTop: d.prop("scrollHeight") }, "fast");
			running = false;
		};
	 });
};
function wcGetGroupImages(){
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "getGroupImages", groupid : $("#activeContact").val().toString()})
	 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {
		if (data != false) {
		obj = JSON.parse(data);
			data = JSON.parse(data);
			console.log (data);
			if (data[0].status == "Success") {
				$.each(data[0].payload, function(i,contact) {
					if (data[0].payload[i].groupid == $("#activeContact").val()){
						temp = $(".clones li.group-photo").clone(true,true).appendTo(".giphy-fs-container .group-photos-container ul");
						var image = JSON.parse(decodeEntities(data[0].payload[i].image));
						$(temp).html('<img src="' + image.img + '"></img>');
						$(temp).attr('data-id',data[0].payload[i].owner);
						$(temp).attr('data-src',image.bigImg);
						$(temp).attr('data-owner',data[0].payload[i].owner);
						
						if (data[0].payload[i].owner == <?php echo ossn_loggedin_user()->guid; ?>) {
							delphoto = $('.clones .delphoto').clone(true,true).appendTo($(temp));
							//$(delphoto).attr('data-id',data[0].payload[i].id);
							$(delphoto).attr('data-owner',data[0].payload[i].id);
							$(delphoto).attr('data-type','user');
							$(delphoto).attr('data-file',image.bigImg);
							$(delphoto).attr('data-messageid',data[0].payload[i].messageid);
						}
					}
				});
				
				var firstowner = friends[data[0].payload[0].owner].fullname;
				var image = JSON.parse(decodeEntities(data[0].payload[0].image));
				$(".giphy-fs-container .giphy-fs-image img").attr("src",image.bigImg);
				$(".giphy-fs-container .giphy-fs-image .image-owner").html(firstowner);
			}
		};
	 });
};	
function wcGetGroupPhotos(){
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "getGroupPhotos", groupid : $("#activeContact").val().toString()})
	 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {
		if (data != false) {
		obj = JSON.parse(data);
			data = JSON.parse(data);
			if (data[0].status == "Success") {
				$.each(data[0].payload, function(i,contact) {
					temp = $(".clones li.group-photo").clone(true,true).appendTo(".giphy-fs-container .group-photos-container ul");
					$(temp).html('<img src="<?php echo ossn_site_url('images/groups/'); ?>' + $("#activeContact").val().toString() + '/' + data[0].payload[i].filename + '"></img>');
					$(temp).attr('data-id',data[0].payload[i].id);
					$(temp).attr('data-owner',data[0].payload[i].owner);
					$(temp).attr('data-src','<?php echo ossn_site_url('images/groups/'); ?>' + $("#activeContact").val().toString() + '/' + data[0].payload[i].filename);
					
					 if (owner == <?php echo ossn_loggedin_user()->guid; ?>) {
						delphoto = $('.clones .delphoto').clone(true,true).appendTo($(temp));
						$(delphoto).attr('data-id',data[0].payload[i].id);
						$(delphoto).attr('data-owner',data[0].payload[i].owner);
						$(delphoto).attr('data-type','group');
						$(delphoto).attr('data-file','<?php echo ossn_site_url('images/groups/'); ?>' + $("#activeContact").val().toString() + '/' + data[0].payload[i].filename);
						$(delphoto).attr('data-messageid',data[0].payload[i].messageid);						
					 }
				});
			}
		};
	 });
};	
function wcGetGroups(){
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "getGroups"})
	 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {
		if (data != false) {
			obj = JSON.parse(data);
			$("#contacts ul").empty();
			$.each(obj, function(i,contact) {
				temp = $(".clones .contact").clone(true,true).attr("data-guid", i).appendTo("#contacts ul");
				$(temp).attr("id", obj[i].groupid);
				$(temp).attr("data-owner", obj[i].owner);
				
				console.log (obj[i].msgstatus[0]);
				<!-- if (obj[i].msgstatus[0]){ -->
					if (obj[i].msgstatus && obj[i].msgstatus[0].viewed == 0){
						$(temp).addClass('new');
					}
					
					// Do we have a photo to display?
					if (obj[i].photo !== null & obj[i].photo != "") { 
						fullimgpath = "<?php echo ossn_site_url('images/groups/'); ?>" + obj[i].groupid + "/" + obj[i].photo;
						$(temp).find("img").attr("src",fullimgpath);
					} else {
						$(temp).find("img").attr("src","<?php echo $path_img; ?>/group-icon.png");
					}
					$(temp).find(".meta .name").text(obj[i].name);
					
					if (obj[i].preview) {
						if (decodeEntities(obj[i].preview).substr(0, 7) == '{"img":') obj[i].preview = '<i class="fa fa-picture-o"></i> IMAGE';
						if (obj[i].message_from == 0) {
							fullname = "Info";
						} else {
							fullname = friends[obj[i].message_from].fullname;
						}
						$(temp).find(".meta .preview").html(fullname + " : " + obj[i].preview);
						$(temp).find("section.message_time").text(obj[i].elapsed);
					}
					channel = "Group_" + obj[i].groupid;
					var channel = pusher.subscribe(channel);
					channel.bind('newMessage', function(data) {
						pusher_newMessage(JSON.stringify(data));
					});
					channel.bind('groupMembership', function(data) {
						pusher_groupMembership(JSON.stringify(data));
					});	
					channel.bind('messageDeleted', function(data) {
						pusher_messageDeleted(JSON.stringify(data));
					});	
					channel.bind('msgStatus', function(data) {
						pusher_msgStatus(JSON.stringify(data));
					});	
				<!-- } -->
			});
		}
	 });
};
function wcWelcome(){
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "welcome"})
	 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {
		if (data != false) {
			data = JSON.parse(data);
			if (data[0].status == "Success") {
				cdPopup ("Welcome to WebChat 2.0 Beta",
					"Please provide feedback on the community forum. Keep watching the forum for future updates. <br/> <a href=\"https://www.opensource-socialnetwork.org/\">Powered by the Open Source Social Network.</a>",
					false,
					false,
					false,
					true,
					"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
					false,
					false); 
				}
			}		
		});
};
function wcSelectGroupPhoto(selected) {
	newfile = filename(selected);
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "selectPhoto", groupid : $("#activeContact").val().toString(), selected: newfile})
			.fail(function() {
	location.reload();
	})
	.done(function( data ) {
		if (data != false) {
			data = JSON.parse(data);
			if (data[0].status == "Success") {
				cdPopup(data[0].status,
					data[0].message,
					false,
					null,
					null,
					true,
					"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
					null);
				$('#content .contact-profile img').attr('src',selected);
				wcNewMessage(2, null, null, data[0].payload.message);
			} else {
				cdPopup(data[0].status,
					data[0].message,
					false,
					null,
					null,
					true,
					"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
					null);			
			}			
		};
	});
};
/* UPDATE (SET) 			*/
function wcDelegate(userid){	
	var groupid = $('#activeContact').val();
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "delegateAdmin", userid: userid, groupid: groupid})
	 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {
	   
		data = JSON.parse(data);
		if (data[0].status == "Success") {
			$(".cd-popup legend").html(data[0].status);
			$(".cd-popup p").html(data[0].message);
			$(".cd-popup .dialog-yes").hide();
			$(".cd-popup .dialog-no").show();
			$(".cd-popup .dialog-no").text("<?php echo ossn_print('com:webchat:generic:ok'); ?>");
		    $(".cd-popup").addClass("show");
		    $(".cd-popup-fade").addClass("show");
			$(".back-arrow").click();
			wcNewMessage(2, null, null, data[0].payload.message);
			dismissFsContainer();
		} else {
			$(".cd-popup legend").html(data[0].status);
			$(".cd-popup p").html(data[0].message);
			$(".cd-popup .dialog-yes").hide();
		    $(".cd-popup").addClass("show");
		    $(".cd-popup-fade").addClass("show");   
		}
	});
};
function wcLeaveGroup(){	
	var groupid = $('#activeContact').val();
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "leaveGroup", groupid: groupid})
	 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {
	   
		data = JSON.parse(data);
		if (data[0].status == "Success") {
			$(".cd-popup legend").html(data[0].status);
			$(".cd-popup p").html(data[0].message);
			$(".cd-popup .dialog-yes").hide();
			$(".cd-popup .dialog-no").show();
			$(".cd-popup .dialog-no").text("<?php echo ossn_print('com:webchat:generic:ok'); ?>");
		    $(".cd-popup").addClass("show");
		    $(".cd-popup-fade").addClass("show");
			$(".back-arrow").click();
			wcNewMessage(2, null, null, data[0].payload.message);
		} else {
			$(".cd-popup legend").html(data[0].status);
			$(".cd-popup p").html(data[0].message);
			$(".cd-popup .dialog-yes").hide();
		    $(".cd-popup").addClass("show");
		    $(".cd-popup-fade").addClass("show");   
		}
	});
};
function wcMsgStatus(groupid, msgid, action){	
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "msgStatus", groupid: groupid, msgid: msgid, msgaction: action})
	 	.fail(function() {
	location.reload();
	});
};
function wcRenameGroup(newname){
	$(".cd-popup").removeClass("show");
	$(".cd-popup-fade").removeClass("show"); 	
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "renameGroup", groupid : $("#activeContact").val().toString(), name: newname})
	 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {

		if (data != false) {
			obj = JSON.parse(data);
			data = JSON.parse(data);
			
			if (data[0].status == "Success") {
				cdPopup(data[0].status,
					data[0].message,
					false,
					null,
					null,
					true,
					"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
					null);

				$('.contact-profile .groupname').html(data[0].payload.name);
				wcNewMessage(2, null, null, data[0].payload.message);
			} else {
				cdPopup(data[0].status,
					data[0].message,
					false,
					null,
					null,
					true,
					"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
					null);			
			}			
		};

	 });
};	
function wcSetGroupPhoto(reloadgroups = 0){
	/* 	0 = No callback on completion
		1 = Reload the group list
		2 = Replace the on-screen group photo
		*/
	var file_data = $('#group_image').prop('files')[0];
	var form_data = new FormData();
	form_data.append('group_image', file_data);
	$.ajax({
		url: '<?php echo ossn_site_url('chat_api'); ?>' + tokenurl + '&action=setGroupPhoto&groupid=' + $("#activeContact").val().toString(), // point to server-side controller method
		dataType: 'text', // what to expect back from the server
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,
		type: 'post',
		success: function (data) {
			data = JSON.parse(data);

			$('#group_image').val('');
			
			if (data[0].status == "Success") {
				$(".cd-popup legend").html(data[0].status);
				$(".cd-popup p").html(data[0].message);
				$(".cd-popup .dialog-yes").hide();
				$(".cd-popup .dialog-no").show();
				$(".cd-popup .dialog-no").text("<?php echo ossn_print('com:webchat:generic:ok'); ?>");
				$(".cd-popup").addClass("show");
				$(".cd-popup-fade").addClass("show");
				$(".cd-popup-input").removeClass("show");
				
				if (reloadgroups == 1) {
					wcGetGroups();
				} else if (reloadgroups == 2) {
					$('.contact-profile img').prop('src','<?php echo ossn_site_url('images/groups/'); ?>' + $("#activeContact").val().toString() + "/" + data[0].payload.filename);
				}
				wcNewMessage(2, null, null, data[0].payload.message);
			} else {
				$(".cd-popup legend").html(data[0].status);
				$(".cd-popup p").html(data[0].message);
				$(".cd-popup .dialog-yes").hide();
				$(".cd-popup").addClass("show");
				$(".cd-popup-fade").addClass("show");   
			}
		}
	});
};
function wcUpdateGroupInfo(groupid=null){
	var d = $(".messages");
	if (groupid == null ) {
		groupid = $('#activeContact').val();
	}
	
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "getGroup", groupid: groupid})
	 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {
		if (data != false) {
			group = JSON.parse(data);
			
			if (groupid == $('#activeContact').val()) {
				$("div.contact-profile p.groupname").html(group[0].name);
				if (group[0].photo != null & group[0].photo != "") {
					fullimgpath = "<?php echo ossn_site_url('images/groups/'); ?>" + group[0].id + "/" + group[0].photo;
					$("div.contact-profile img").attr("src",fullimgpath);
				} else {
					$("div.contact-profile img").attr("src","<?php echo $path_img; ?>/group-icon.png");
				}			
				var array = []; 
				var count = 0;
				$.each(group.members, function(i,contact) {
					count = count + 1;
					array.push(friends[group.members[i].userid].fullname);
				});

				if (count > 1) {
					groupmembers = natural_language_join(array);
				} else {
					groupmembers = array[0];
				}
				$("div.contact-profile p.groupmembers").html(groupmembers);
			}
			
			if (group[0].photo != null & group[0].photo != "") {
				fullimgpath = "<?php echo ossn_site_url('images/groups/'); ?>" + group[0].id + "/" + group[0].photo;
				$("#contacts ul").find(`[id='${group[0].id}']`).find('img').attr("src",fullimgpath);
			} else {
				$("#contacts ul").find(`[id='${group[0].id}']`).find('img').attr("src","<?php echo $path_img; ?>/group-icon.png");
			}

			
			$("#contacts ul").find(`[id='${group[0].id}']`).find('.meta .name').html(group[0].name);
		}
	 });
};
/* INSERT (ADD) 			*/
function wcAddMembers(guids){	
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "addMembers", groupid : $("#activeContact").val().toString(), guids: guids})
	 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {
		if (data != false) {
			obj = JSON.parse(data);
			data = JSON.parse(data);
			
			if (data[0].status == "Success") {
				wcNewMessage(2, null, null, data[0].payload.message);
				wcUpdateGroupInfo();
			} else {
				cdPopup(data[0].status,
					data[0].message,
					false,
					null,
					null,
					true,
					"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
					null);			
			}			
		};
	 });	
}
function wcCreateGroup(name, guids){
	var groupid = $.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "createGroup", guids: guids, name: name})
	 	.fail(function() {
	location.reload();
	})
	.done(function(data) {
	 
		data = JSON.parse(data);
		if (data[0].status == "Success") {		
			cdPopup (	data[0].status,
						data[0].message,
						false,
						false,
						false,
						true,
						"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
						false,
						false);
			wcGetFriends(0);
		} else {
			cdPopup (	data[0].status,
						data[0].message,
						false,
						false,
						false,
						true,
						"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
						false,
						false);  
		}
		return;
	 });
};
function wcNewMessage(type = 0, giphyImg = null, giphyBig = null, infoMsg = null) {
	console.log ("wcNewMessage (type='"+type+"', infoMsg='"+infoMsg+"')");
	// Type 0 - Default, normal text message
	// Type 1 - GIPHY message
	// Type 2 - Info message
	// Type 3 - Upload Image Message
	
	message = $("#main-input").val();
	
	$(".emojiPanel").addClass("outBottom");
	$(".emojiPanel").removeClass("onFromBottom");
	$("#messages").removeClass("emoji");

	var activeContact = document.getElementById('activeContact').value;	
	
	if (type == 1) {  // GIPHY Message
		message = '{"img": "' + giphyImg + '", "bigImg": "' + giphyBig + '"}';
	} else if (type == 2) {  // Info Message
		message = infoMsg;
	}
	else if (type == 3) {  // Upload Photo
		var file_data = $('#image-upload').prop('files')[0];
		var form_data = new FormData();
		form_data.append('image-upload', file_data);
		$.ajax({
			url: '<?php echo ossn_site_url('chat_api'); ?>' + tokenurl + '&action=getThumbs&groupid=' + $("#activeContact").val().toString(), // point to server-side controller method
			dataType: 'text', // what to expect back from the server
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,
			type: 'post',
			success: function (data) {
				data = JSON.parse(data);

				$('#image-upload').val('');
				
				if (data[0].status == "Success") {

					var hdpath = images_path + data[0].payload.bigImg;
					var thumbpath = images_path + data[0].payload.img;

					message = '{"img": "' + thumbpath + '", "bigImg": "' + hdpath + '"}';	
					var time = new Date();
					
					$.post("<?php echo ossn_site_url('chat_api'); ?>" + tokenurl,
					{
					  action: 'send',  
					  group: activeContact,
					  message: message,
					  status: type
					});
					$('#main-input').val(null).blur();
					$('#main-input').css("height","15px");
					$("#frame .content .message-input .wrap i").css("padding-top",miniHeight + "px");
					$("#frame .content .message-input .wrap .fa").css("bottom","-32px");				

					return;
				} else {
					$(".cd-popup legend").html(data[0].status);
					$(".cd-popup p").html(data[0].message);
					$(".cd-popup .dialog-yes").hide();
					$(".cd-popup").addClass("show");
					$(".cd-popup-fade").addClass("show"); 
					return false;
				}
			}
		});	
	}

	if (type != 3) {
		// Now we've sent the message, reset the size of the input box, icon locations and empty the input box.
		if (type != 1) {
			$('#main-input').val(null).blur();
		}
		$('#main-input').css("height","15px");
		$("#frame .content .message-input .wrap i").css("padding-top",miniHeight + "px");
		$("#frame .content .message-input .wrap .fa").css("bottom","-32px");
		$.post("<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: 'send', group: activeContact, message: message, status: type })
			.fail(function() {
			location.reload();
		});
	}
};
/* DELETE 		 			*/
function wcDeletePhoto(photoid = null, type, file1=null, file2=null, messageid){
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "deletePhoto", groupid : $("#activeContact").val().toString(), photoid: photoid, type: type, file1: file1, file2: file2, messageid: messageid})
	.fail(function() {
		location.reload();
	}).done(function(data) {
		data = JSON.parse(data);

		if (data[0].status == "Success") {
			$(".cd-popup legend").html(data[0].status);
			$(".cd-popup p").html(data[0].message);
			$(".cd-popup .dialog-yes").hide();
			$(".cd-popup .dialog-no").show();
			$(".cd-popup .dialog-no").text("<?php echo ossn_print('com:webchat:generic:ok'); ?>");
			$(".cd-popup").addClass("show");
			$(".cd-popup-fade").addClass("show");
			$(".cd-popup-input").removeClass("show");
			dismissFsContainer();
		} else {
			$(".cd-popup legend").html(data[0].status);
			$(".cd-popup p").html(data[0].message);
			$(".cd-popup .dialog-yes").hide();
			$(".cd-popup").addClass("show");
			$(".cd-popup-input").removeClass("show");
			$(".cd-popup-fade").addClass("show");   
		}
	})
};
function wcRemoveMembers(removes){	
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "removeMembers", groupid : $("#activeContact").val().toString(), removes: removes})
	 	.fail(function() {
	location.reload();
	})
	.done(function( data ) {
		if (data != false) {
			obj = JSON.parse(data);
			data = JSON.parse(data);
			if (data[0].status == "Success") {
				wcNewMessage(2, null, null, data[0].payload.message);
				wcUpdateGroupInfo();
			} else {
				cdPopup(data[0].status,
					data[0].message,
					false,
					null,
					null,
					true,
					"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
					null);			
			}			
		};
	 });	
}
function wcDeleteGroup(){	
	$.post( "<?php echo ossn_site_url('chat_api'); ?>" + tokenurl, { action: "deleteGroup", groupid : $("#activeContact").val().toString()})
	 	.fail(function() {
	location.reload();
	}).done(function(data) {
		data = JSON.parse(data);

		if (data[0].status == "Success") {
			$(".cd-popup legend").html(data[0].status);
			$(".cd-popup p").html(data[0].message);
			$(".cd-popup .dialog-yes").hide();
			$(".cd-popup .dialog-no").show();
			$(".cd-popup .dialog-no").text("<?php echo ossn_print('com:webchat:generic:ok'); ?>");
			$(".cd-popup").addClass("show");
			$(".cd-popup-fade").addClass("show");
			$(".cd-popup-input").removeClass("show");
			dismissFsContainer();
		} else {
			$(".cd-popup legend").html(data[0].status);
			$(".cd-popup p").html(data[0].message);
			$(".cd-popup .dialog-yes").hide();
			$(".cd-popup").addClass("show");
			$(".cd-popup-fade").addClass("show");   
		}
	})
}

///*****  GIPHY *****///
$("#giphyPanel").click(function(e) {																		// Clicking GIPHY button
	$(".giphyPanel").addClass("onFromBottomGiphy").focus();
	$(".giphyPanel").removeClass("outBottomGiphy");
	$(".emojiPanel").addClass("outBottom");
	$(".emojiPanel").removeClass("onFromBottom");	
	$("#messages").removeClass("emoji");
	$("#messages").addClass("giphy");
	var d = $("div.messages");
	d.scrollTop(d.prop("scrollHeight"));
	
	var xhr = $.get('<?php echo ( ossn_site_url("giphy"));?>?action=trending');
	xhr	.fail(function() {
	location.reload();
	})
	.done(function(data) {
		$('#giphySelector .results').html("");
		var json_response = JSON.parse(decodeURIComponent(data));
		var i;
		for (i = 0; i < 25; i++) {
		  var hiRes = null;
		  if (json_response.data[i].images.hd) {
			hiRes = json_response.data[i].images.hd.url;
		  } else hiRes = json_response.data[i].images.original.url;
		  
		  $(".clones .giphy-img").clone(true,true).append('<img data-og="' + hiRes + '" src="' + json_response.data[i].images.fixed_width_downsampled.url + '">').appendTo($('#giphySelector .results.left'));
		}
		for (i = 25; i < 50; i++) {
		  var hiRes = null;
		  if (json_response.data[i].images.hd) {
			hiRes = json_response.data[i].images.hd.url;
		  } else hiRes = json_response.data[i].images.original.url;
		  
		  $(".clones .giphy-img").clone(true,true).append('<img data-og="' + hiRes + '" src="' + json_response.data[i].images.fixed_width_downsampled.url + '">').appendTo($('#giphySelector .results.right'));
		}
	});
});
$('div.giphy-img').on('click', function () {																// Clicking GIPHY image from results
	if ($(".giphyPanel").hasClass("onFromBottomGiphy")) {
		$(".giphyPanel").addClass("outBottomGiphy");
		$(".giphyPanel").removeClass("onFromBottomGiphy");
	}		
	$("#messages").removeClass("giphy");
	var giphyImg = encodeURI($(this).find("img").attr("src"));
	var giphyBig = encodeURI($(this).find("img").attr("data-og"));
	wcNewMessage(1, giphyImg, giphyBig);
});
$("article img.giphy").click(function() {																	// Click GIPHY image in thread
   $(".giphy-fs-container .giphy-fs-image img").attr("src",$(this).attr('og'));
   $("#bottom-bar-photo").hide();
   $(".giphy-fs-container").addClass("show");
});
$('#message-menu li').click(function() {																	// Message Menu Option
    $('#message-menu').removeClass('show');
	if ( $(this).attr('class') == "rename-group-btn" ) {
		var statement = "<?php echo ossn_print('com:webchat:group:rename:p'); ?>";
		statement = statement.replace("*",$('.contact-profile .groupinfo .groupname').html());
		
		<!-- statement = statement.toString().replace("*",$("#addChatMenu #groupName").val()); -->
		cdPopup("<?php echo ossn_print('com:webchat:group:rename:legend'); ?>",
				statement,
				true,
				"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
				"wcRenameGroup($('#cd-popup-input').val());",
				true,
				"<?php echo ossn_print('com:webchat:generic:cancel'); ?>",
				"callback_cancel();",
				"<?php echo ossn_print('com:webchat:group:rename:placeholder'); ?>");		
	} else if ( $(this).attr('class') == "media-group-btn" ) {
		<!-- $(".giphy-fs-container .giphy-fs-image img").attr("src",$('.contact-profile img').attr('src')); -->
		<!-- $(".giphy-fs-container .giphy-fs-image .image-owner").html(friends[$(this).attr('data-id')].fullname); -->
		$('.group-photos-container').clone(true,true).appendTo('.giphy-fs-container');
		$(".giphy-fs-container").addClass("show");
	    if (owner == <?php echo ossn_loggedin_user()->guid; ?>) {
			$('#bottom-bar-photo').show();
		} else {
			$('#bottom-bar-photo').hide();
		}
	    if ($("#message-menu").hasClass("show")) $("#message-menu").removeClass("show");
		wcGetGroupImages();	
	} else if ( $(this).attr('class') == "mute-group-btn" ) {
	
	} else if ( $(this).attr('class') == "manage-group-btn" ) {
		wcGetContacts(1);
	} else if ( $(this).attr('class') == "view-group-btn" ) {
		wcGetContacts(2);
	} else if ( $(this).attr('class') == "delete-group-btn" ) {
		cdPopup("<?php echo ossn_print('com:webchat:generic:sure'); ?>",
				"<?php echo ossn_print('com:webchat:group:deletegroup'); ?>",
				true,
				"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
				"callback_wcDeleteGroup(true);",
				true,
				"<?php echo ossn_print('com:webchat:generic:cancel'); ?>",
				"callback_cancel()");			
	} else if ( $(this).attr('class') == "delegate-group-btn" ) {
		wcGetContacts(3);
	} else if ( $(this).attr('class') == "leave-group-btn" ) {
		cdPopup("<?php echo ossn_print('com:webchat:generic:sure'); ?>",
				"<?php echo ossn_print('com:webchat:group:leaveanddelete'); ?>",
				true,
				"<?php echo ossn_print('com:webchat:generic:ok'); ?>",
				"callback_wcLeaveGroup(true);",
				true,
				"<?php echo ossn_print('com:webchat:generic:cancel'); ?>",
				"callback_wcLeaveGroup(false);");	
	}
});

///*****  HELPERS *****///
function dismissFsContainer() {
	$(".giphy-fs-container .giphy-fs-image img").attr('src','#');
	$(".giphy-fs-container .giphy-fs-image p").html('');
    $(".giphy-fs-container").removeClass("show");
    //$(".giphy-fs-container .changephoto").removeClass("show");
	//$('#group_image_button').hide();
	$(".giphy-fs-container .group-photos-container").remove();
	var d = $("div.messages");
	var d = $("div.messages");
	d.scrollTop(d.prop("scrollHeight"));
}
function dismissAddChatMenu() {																				// Dismiss the form dialog
	$('#addChatMenu').removeClass('show');
}
function natural_language_join(list, conjunction = 'and') {
  last = list.pop();
  if (list) {
    return list.join(', ', list) + ' ' + conjunction + ' ' + last;
  }
  return last;
}
function cdPopup(legend, message, yesbutton, yestext, yescb, nobutton, notext, nocb, inputplaceholder = false) {
	<!-- console.log ('legend:',legend); -->
	<!-- console.log ('message:', message); -->
	<!-- console.log ('yesbutton:',yesbutton); -->
	<!-- console.log ('yestext:',yestext); -->
	<!-- console.log ('yescb:',yescb); -->
	<!-- console.log ('nobutton:',nobutton); -->
	<!-- console.log ('notext:',notext); -->
	<!-- console.log ('nocb:',nocb); -->
	<!-- console.log ('inputplaceholder:', inputplaceholder); -->
	if (inputplaceholder) {
		$('#cd-popup-input').attr('placeholder',inputplaceholder);
		$('#cd-popup-input').val('');
		$('#cd-popup-input').show();
	} else {
		$('#cd-popup-input').hide();
	}
	$(".cd-popup legend").html(legend);
	$(".cd-popup p").html(message);
	if (yesbutton) {
		$(".cd-popup .dialog-yes").text(yestext);
		if (yescb) {
			$(".cd-popup .dialog-yes").attr("onclick",yescb);
		} else {
			$(".cd-popup .dialog-yes").attr("onclick","");	
		}
		$(".cd-popup .dialog-yes").show();
	} else {
		$(".cd-popup .dialog-yes").hide();
	}
	if (nobutton) {
		$(".cd-popup .dialog-no").text(notext);
		if (nocb) {
			$(".cd-popup .dialog-no").attr("onclick",nocb);
		} else {
			$(".cd-popup .dialog-no").attr("onclick","");	
		}			
		$(".cd-popup .dialog-no").show();
	} else {
		$(".cd-popup .dialog-no").hide();
	}		
	$(".cd-popup").addClass("show");
	$(".cd-popup-fade").addClass("show"); 	
}
function intInArray (obj, value) {
	var ret_bool = false;
	$.each(obj, function(i,v) {
		if (v === value) {
			ret_bool = true;
		};
	});
	return ret_bool;
};
function toggleFullScreen() {
  if (!amIFullscreen()) {  // current working methods
    if (document.documentElement.requestFullscreen) {
      document.documentElement.requestFullscreen();
    } else if (document.documentElement.msRequestFullscreen) {
      document.documentElement.msRequestFullscreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullscreen) {
      document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
  }
}
function amIFullscreen () {
  if (!document.fullscreenElement &&
      !document.mozFullScreenElement &&
	  !document.webkitFullscreenElement &&
	  !document.msFullscreenElement ) {
		return false;
	} else {
		return true;
	}
}
function isJSON (something) {
    if (typeof something != 'string')
        something = JSON.stringify(something);

    try {
        JSON.parse(something);
        return true;
    } catch (e) {
        return false;
    }
}
function decodeEntities(encodedString) {
  var textArea = document.createElement('textarea');
  textArea.innerHTML = encodedString;
  return textArea.value;
}
function sortUL(selector) {
	$(selector).each(function(){
		$(this).children('li').sort((a,b)=>a.innerText.localeCompare(b.innerText)).appendTo(this);
	});
}
$("li.group-photo").click(function() {																		// Click group image from bottom bar
   $(".giphy-fs-container .giphy-fs-image img").attr("src",$(this).attr('data-src'));
   if ($(this).attr('data-owner') == <?php echo ossn_loggedin_user()->guid; ?>) {
		$(".giphy-fs-container .giphy-fs-image .image-owner").html("<?php echo ossn_loggedin_user()->fullname; ?>");
	} else {
		$(".giphy-fs-container .giphy-fs-image .image-owner").html(friends[$(this).attr('data-id')].fullname);
	}
});
$(".giphy-fs-container .giphy-fs-dismiss i").click(function() {												// Click FULLSCREEN dismiss
   dismissFsContainer();
});
$(".contact-profile img").click(function() {																// Click main chat image
    $(".giphy-fs-container .giphy-fs-image img").attr("src",$(this).attr('src'));
    $(".giphy-fs-container").addClass("show");
    //$(".giphy-fs-container .changephoto").addClass("show");
    //$('#group_image_button').show();
   
	$('.group-photos-container').clone(true,true).appendTo('.giphy-fs-container');

	if (owner == <?php echo ossn_loggedin_user()->guid; ?>) {
		$('#bottom-bar-photo').show();
	} else {
		$('#bottom-bar-photo').hide();
	}
	if ($("#message-menu").hasClass("show")) $("#message-menu").removeClass("show");
	wcGetGroupPhotos();	
});
function delay(callback, ms) {																				// Typing in GIPHY
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
	xhr	.fail(function() {
	location.reload();
	})
	.done(function(data) {
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
function filename(path){
    path = path.substring(path.lastIndexOf("/")+ 1);
    return (path.match(/[^.]+(\.[^?#]+)?/) || [])[0];
}
function containsEmojis(input, includeBasic) {

    if (typeof includeBasic == "undefined")
        includeBasic = true;

    for (var c of input) {
        var cHex = ("" + c).codePointAt(0).toString(16);
        var lHex = cHex.length;
        if (lHex > 3) {

            var prefix = cHex.substring(0, 2);

            if (lHex == 5 && prefix == "1f") {
                return true;
            }

            if (includeBasic && lHex == 4) {
                if (["20", "21", "23", "24", "25", "26", "27", "2B", "29", "30", "32"].indexOf(prefix) > -1)
                    return true;
            }
        }
    }

    return false;
}

var newmessagesound = new Audio('<?php echo ossn_site_url("components/OssnSounds/audios/pling.mp3"); ?>');
// Pusher Callback Functions
function pusher_newMessage(data) {
	if (data != false) {
		obj = JSON.parse(data);
		wcMsgStatus(obj.message.groupid, obj.message.id, 1);
		
		if ($("#activeContact").val() == obj.message.groupid) {
			
			message = obj.message;
			var newmsg = $('.clones li.message').clone(true,true).appendTo(".messages ul").hide();
			
			wcMsgStatus(message.groupid, message.id, 2);
			
			if (message.type == 1 || message.type == 3) {  // GIPHY and Photos
				message.message = JSON.parse(decodeEntities(message.message));
				$(newmsg).find("article").addClass("giphy");
				$(newmsg).addClass("giphy");
				$(newmsg).find("article").addClass("giphy");
				$(newmsg).find("article .message").remove();
				if (message.type == 3) $(newmsg).find("article").append('<div class="fade-top"></div>');
				$(newmsg).find("article").append('<div class="fade-bottom"></div>');		
				$(newmsg).find("img.giphy").attr("og",message.message.bigImg);
				$(newmsg).find("img.giphy").attr("src",message.message.img);
			}

			if (message.message_from == <?php echo ossn_loggedin_user()->guid; ?> ) {
				$(newmsg).addClass("sent");
				$(newmsg).find('img.profile').remove();
			} else {
				if (obj.message.message_from == 0) {
					$(newmsg).addClass("info");
					$(newmsg).find('img.profile').remove();
				} else {
					$(newmsg).find("section.name").html(friends[message.message_from].fullname);
					$(newmsg).find('img.profile').attr('src',friends[obj.message.message_from].iconsmall);
					$(newmsg).addClass("replies");
				}
			}
			message.message = pln2br(message.message);
			entity = decodeEntities(message.message);
			if (entity.length==2 & entity.codePointAt(0) > 128000 ) $(newmsg).find("section.message").addClass("lg-emoji");
			
			$(newmsg).find("section.message").html(message.message);
			$(newmsg).find("section.message_time").text(message.elapsed);
			$(newmsg).attr('data-id',message.id);
			$(newmsg).fadeIn();
		
		
			if (obj.message.preview){
				var preview = obj.message.preview;
				urlPreview = $('.clones .url_preview').clone(true,true).prependTo($(newmsg)).hide();
				$(urlPreview).attr('data-url',preview.url);
				$(urlPreview).find("p.sitename").html('<i class="fa fa-globe" aria-hidden="true"></i> ' + preview.sitename);
				$(urlPreview).find("p.title").text(preview.title);
				$(urlPreview).find("p.description").text(preview.description);
				if (preview.image == "No image found") {
					//$(urlPreview).find("img.url_image").remove();
				} else {
					var thumburl = preview.image;
					if ($.isNumeric(preview.image[0])) thumburl = "<?php echo ossn_site_url('images/users/'); ?>" + preview.image;
					$(urlPreview).find("img.url_image").attr('src',thumburl);

					if (preview.thumbcolour != null) {
						$(urlPreview).find("img.url_image").css('background-color',preview.thumbcolour);
					}
				}
				// Scroll to show the new message
				$(urlPreview).fadeIn();
			}
			
			var d = $("div.messages");		
			$(".messages").animate({ scrollTop: d.prop("scrollHeight") }, "fast");
		} else {
			newmessagesound.play();
		}
		
		// Update the main list
		newMessage = $("#contacts ul").find(`[id='${obj.message.groupid}']`).prependTo($("#contacts ul"));
		if (obj.message) {
			if (decodeEntities(obj.message.message).substr(0, 7) == '{"img":') obj.message.message = '<i class="fa fa-picture-o"></i> IMAGE';
			if (obj.message.message_from == 0) {
				fullname = "Info";
			} else {
				fullname = friends[obj.message.message_from].fullname;
			}

			$(newMessage).find(".meta .preview").html(fullname + " : " + obj.message.message);
			$(newMessage).find("section.message_time").text(obj.message.elapsed);
			if ($("#activeContact").val() != obj.message.groupid) {
				if (obj.message.message_from != <?php echo ossn_loggedin_user()->guid; ?> ) {
					if (!$(newMessage).hasClass('new')){
						$(newMessage).addClass('new');
					}
				}
			}
		}
	}	
}
function pusher_groupMembership(data) {
	if (data != false) {
		obj = JSON.parse(data);
		if (obj.message.action == "Added") {
			newMessage = $(".clones li.contact").clone(true,true).prependTo($("#contacts ul"));
			$(newMessage).attr('id',obj.message.id);			
			$(newMessage).attr('data-owner',obj.message.groupowner);
			$(newMessage).find(".meta .preview").html("<?php echo ossn_print('com:webchat:group:added'); ?>");
			if (obj.message.photo == null) {
				$(newMessage).find("img").attr("src","<?php echo $path_img; ?>/group-icon.png");
			} else {
				$(newMessage).find("img").attr("src",obj.message.photo);
			}
			$(newMessage).find(".meta .name").html(obj.message.groupname);
			$(newMessage).find("section.message_time").text(obj.message.elapsed);
			if (!$(newMessage).hasClass('new')){
				$(newMessage).addClass('new');
			}
			channel = "Group_" + obj.message.id;
			var channel = pusher.subscribe(channel);
			channel.bind('newMessage', function(data) {
				pusher_newMessage(JSON.stringify(data));
			});				
			channel.bind('groupMembership', function(data) {
				pusher_groupMembership(JSON.stringify(data));
			});	
			channel.bind('messageDeleted', function(data) {
				pusher_messageDeleted(JSON.stringify(data));
			});	
			channel.bind('msgStatus', function(data) {
				pusher_msgStatus(JSON.stringify(data));
			});	
		}		
		else if (obj.message.action == "Removed") {
			if ($("#activeContact").val() == obj.message.id) {
				$(".back-arrow").click();
				$('#activeContact').val('-1');
			}
			$("#contacts ul").find(`[id='${obj.message.id}']`).fadeOut().remove()
			channel = "Group_" + obj.message.id;
			var channel = pusher.unsubscribe(channel);
		}	
		else if (obj.message.action == "Refresh") {
			wcUpdateGroupInfo(obj.message.id);
		}
	}	
}
function pusher_messageDeleted(data) {
	console.log ("pusher_messageDeleted()");
	if (data != false) {
		obj = JSON.parse(data);
		console.log ("Finding and deleting message "+obj.message.id+" from group "+obj.message.group+" and current page is "+$("#activeContact").val());
		if (obj.message.group == $("#activeContact").val()) {
			console.log ("We are on the right page!");
			$("#messages li[data-id='" + obj.message.id + "']").remove();
		}		
	}	
}
function pusher_msgStatus(data) {
	console.log ("msgStatus:", data);
}
function pln2br (str) { 
    for (i = 0; i < str.length; i++) {
	  if (str[i] == "\\" && str[i+1] == "r" && str[i+2] == "\\" && str[i+3] == "n" ){
		str = str.slice(0, i) + "</br>" + str.slice(i+4);
	  }
	}
    return (str);
}

</script>
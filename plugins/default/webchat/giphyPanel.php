<?php 
header('Content-type: text/html; charset=UTF-8');?>
<style>
#frame .content .message-input .giphyPanel {
    width: 100%;
	float: right;
	overflow: hidden;
	position: relative;	
	bottom: 0;
	background: #fff;
}
#frame .content .message-input .giphyPanel:focus {
    outline: none;
}
#giphySelector {
  font-size:1.5em;
  display: grid;
  grid-template-columns: 1fr;
  grid-template-rows: 45px 1fr;
  gap: 0px 0px;
  grid-template-areas:
    "."
    ".";
  background-color: #000;
  color: #fff;
}
#giphySelector .resultsContainer{
    height: 300px;
    width: 100%;
    overflow-x: hidden;
    overflow-y: scroll;
    position: relative;
    padding-bottom: 30px;   
}
#giphySelector .resultsContainer img {
	width: 100%;
}
#giphySelector .results.right {
    height: 100%;
    width: 50%;
    position: relative;
    float: left;
}

#giphySelector .results.left {
    height: 100%;
    width: 50%;
    position: relative;
    float: right;
}
#giphySelector div.topbar {
    background-color: #121119;
}
#giphySelector div.topbar input {
    width: calc(100% - 107px);
    height: 35px;
    float: left;
    box-sizing: border-box;
    border-radius: 10px;
    border: none;
    padding: 10px;
    margin: 5px 0;
    margin-left: 5px;
}
#giphySelector div.topbar div.giphy-logo {
    width: 97px;
    height: 100%;
    float: right;
    display: block;
    position: absolute;
    right: 0;
}
#giphySelector div.topbar div.giphy-logo img {
	margin: calc(50% - 41px) 0;
}
</style>
<div id="giphySelector" class="giphys">
	<div class="topbar">
		<input class="giphy-input" placeholder="Search via Giphy"/>
		<div class="giphy-logo">
			<img src="changeme">
		</div>
	</div>
	<div class="resultsContainer">
		<div class="results left">hello</div>
		<div class="results right">hello</div>
	</div>
</div>
<script>

$(function() {
	// Display the emojis for the selected category
	$('#giphySelector span').click(function() {
	  $('#giphySelector span').removeClass("activeCat");
	  $(this).addClass("activeCat");
	  $('div.giphycat div.visibleChar').removeClass("visibleChar").addClass("hiddenChar");	  
	  $('#giphycat' + $(this).data('filter') + ' div').addClass("visibleChar").removeClass("hiddenChar");
	});
});	
</script>

<?php 
header('Content-type: text/html; charset=UTF-8');?>
<style>
#frame .content .message-input .emojiPanel {
    width: 100%;
	float: right;
	overflow: hidden;
	position: relative;	
	bottom: 0;
	background: #fff;
}
#frame .content .message-input .emojiPanel:focus {
    outline: none;
}
#emojiSelector 						{
	font-size:1.5em;
}
#emojiSelector div.emocat {
    overflow-y: auto;
    height: 24vh;
    position: absolute;
}
#emojiSelector div.emocat div.hiddenChar {display:none;}
#emojiSelector div.emocat div.visibleChar {
    float: left;
    width: 1.9em;
    height: 1.9em;
}
#emojiSelector div.emocat div.visibleChar:focused {
	border:none;
	outline: -webkit-focus-ring-color auto 0px;
}
@media screen and (max-width: 735px) {
	#emojiSelector div.emocat div.visibleChar {
		float: left;
		width: 1.9em;
		height: 1.9em;
	}
	#emojiSelector div.emocat div.visibleChar:focused {
		border:none;
		outline: -webkit-focus-ring-color auto 0px;
	}
	#emojiSelector div.emocat div.visibleChar > input[type=text] {
		font-size: 1.9em;
	}
}
#emojiSelector div.emocat div.visibleChar > input[type=text] {
	border:none;
    width: 100%;
    height: 100%;
	padding: 0;
	font-size: 1.3em;
}
#emojiSelector div.emocat div.visibleChar > input:focused {
	border:none;
}
#emojiSelector div.emocat div.visibleChar > span {display:none;}

#emojiSelector #categoryFilter {
	padding:5px;
    text-align: center;
    font-size: 0.6em;
    /*margin-bottom: 20px;*/
    font-weight: bold;
    border-bottom: 2px solid #435f7a;
	border: none;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
/*****************************************************/
#emojiSelector {
  padding: var(--gutter) 0;
  display: grid;
  grid-gap: var(--gutter) 0;
  grid-template-columns: var(--gutter) 1fr var(--gutter);
  align-content: start;
}

#emojiSelector > * {
  grid-column: 2 / -2;
}

#categoryFilter {
  display: grid;
  grid-gap: calc(var(--gutter) / 2);
  grid-template-columns: 10px;
  //grid-template-rows: minmax(150px, 1fr);
  grid-auto-flow: column;
  grid-auto-columns: calc(50% - var(--gutter) * 2);

  overflow-x: scroll;
  scroll-snap-type: x proximity;
  padding-bottom: calc(.75 * var(--gutter));
  margin-bottom: calc(-.25 * var(--gutter));
}

#categoryFilter:before,
#categoryFilter:after {
  content: '';
  width: 10px;
}
/****************************************/
#emojiSelector #categoryFilter > span {
    display: inline-block;
    padding: 8px;
    cursor: pointer;
    color: #555;
    border-radius: 8px;
	float: left;
}
#emojiSelector #categoryFilter > span.activeCat {
    background: #435f7a !important;
    color: #FFF !important;
}

#emojiSelector #categoryFilter span:hover {
	color: #000;
	background: #7897b5;
}
</style>
<div id="emojiSelector" class="emojis">
	<div id="categoryFilter">
		<span id="filterId0" data-filter="0" class="activeCat"><span>😀</span> Smileys</span>
		<span id="filterId1" data-filter="1"><span>👦</span> People</span>
		<span id="filterId2" data-filter="2"><span>😺</span> Animals</span>
		<span id="filterId3" data-filter="3"><span>💐</span> Plants</span>
		<span id="filterId4" data-filter="4"><span>🌍</span> Nature</span>
		<span id="filterId5" data-filter="5"><span>🍇</span> Food</span>
		<span id="filterId6" data-filter="6"><span>🏇</span> Activity</span>
		<span id="filterId7" data-filter="7"><span>🏖</span> Travel</span>
		<span id="filterId8" data-filter="8"><span>💎</span> Objects</span>
		<span id="filterId9" data-filter="9"><span>👍</span> Symbols</span>
		<span id="filterId10" data-filter="10"><span>⬆</span> Arrows</span>
		<span id="filterId11" data-filter="11"><span>💴</span> Currency</span>
		<span id="filterId12" data-filter="12"><span>©</span> HTML4</span>
		<span id="filterId13" data-filter="13"><span>○</span> Shapes</span>
	</div>
		<!--<div id="suggestionBubble" style="display: none;"><span>➤</span><em>Click<br>to&nbsp;copy</em></div>-->
	<div id="emojiContainer">	
		<div class="emocat" data-name="Smileys" id="emocat0">
			<div class="visibleChar"><input type="text" value="😀" readonly=""> <span>Grinning Face</span></div>
			<div class="visibleChar"><input type="text" value="😁" readonly=""> <span>Beaming Face With Smiling Eyes</span></div>
			<div class="visibleChar"><input type="text" value="😂" readonly=""> <span>Face With Tears of Joy</span></div>
			<div class="visibleChar"><input type="text" value="🤣" readonly=""> <span>Rolling on the Floor Laughing</span></div>
			<div class="visibleChar"><input type="text" value="😃" readonly=""> <span>Grinning Face With Big Eyes</span></div>
			<div class="visibleChar"><input type="text" value="😄" readonly=""> <span>Grinning Face With Smiling Eyes</span></div>
			<div class="visibleChar"><input type="text" value="😅" readonly=""> <span>Grinning Face With Sweat</span></div>
			<div class="visibleChar"><input type="text" value="😆" readonly=""> <span>Grinning Squinting Face</span></div>
			<div class="visibleChar"><input type="text" value="😉" readonly=""> <span>Winking Face</span></div>
			<div class="visibleChar"><input type="text" value="😊" readonly=""> <span>Smiling Face With Smiling Eyes</span></div>
			<div class="visibleChar"><input type="text" value="😋" readonly=""> <span>Face Savoring Food</span></div>
			<div class="visibleChar"><input type="text" value="😎" readonly=""> <span>Smiling Face With Sunglasses</span></div>
			<div class="visibleChar"><input type="text" value="😍" readonly=""> <span>Smiling Face With Heart-Eyes</span></div>
			<div class="visibleChar"><input type="text" value="😘" readonly=""> <span>Face Blowing a Kiss</span></div>
			<div class="visibleChar"><input type="text" value="😗" readonly=""> <span>Kissing Face</span></div>
			<div class="visibleChar"><input type="text" value="😙" readonly=""> <span>Kissing Face With Smiling Eyes</span></div>
			<div class="visibleChar"><input type="text" value="😚" readonly=""> <span>Kissing Face With Closed Eyes</span></div>
			<div class="visibleChar"><input type="text" value="🙂" readonly=""> <span>Slightly Smiling Face</span></div>
			<div class="visibleChar"><input type="text" value="🤗" readonly=""> <span>Hugging Face</span></div>
			<div class="visibleChar"><input type="text" value="🤩" readonly=""> <span>Star-Struck</span></div>
			<div class="visibleChar"><input type="text" value="🤔" readonly=""> <span>Thinking Face</span></div>
			<div class="visibleChar"><input type="text" value="🤨" readonly=""> <span>Face With Raised Eyebrow</span></div>
			<div class="visibleChar"><input type="text" value="😐" readonly=""> <span>Neutral Face</span></div>
			<div class="visibleChar"><input type="text" value="😑" readonly=""> <span>Expressionless Face</span></div>
			<div class="visibleChar"><input type="text" value="😶" readonly=""> <span>Face Without Mouth</span></div>
			<div class="visibleChar"><input type="text" value="🙄" readonly=""> <span>Face With Rolling Eyes</span></div>
			<div class="visibleChar"><input type="text" value="😏" readonly=""> <span>Smirking Face</span></div>
			<div class="visibleChar"><input type="text" value="😣" readonly=""> <span>Persevering Face</span></div>
			<div class="visibleChar"><input type="text" value="😥" readonly=""> <span>Sad but Relieved Face</span></div>
			<div class="visibleChar"><input type="text" value="😮" readonly=""> <span>Face With Open Mouth</span></div>
			<div class="visibleChar"><input type="text" value="🤐" readonly=""> <span>Zipper-Mouth Face</span></div>
			<div class="visibleChar"><input type="text" value="😯" readonly=""> <span>Hushed Face</span></div>
			<div class="visibleChar"><input type="text" value="😪" readonly=""> <span>Sleepy Face</span></div>
			<div class="visibleChar"><input type="text" value="😫" readonly=""> <span>Tired Face</span></div>
			<div class="visibleChar"><input type="text" value="😴" readonly=""> <span>Sleeping Face</span></div>
			<div class="visibleChar"><input type="text" value="😌" readonly=""> <span>Relieved Face</span></div>
			<div class="visibleChar"><input type="text" value="😛" readonly=""> <span>Face With Tongue</span></div>
			<div class="visibleChar"><input type="text" value="😜" readonly=""> <span>Winking Face With Tongue</span></div>
			<div class="visibleChar"><input type="text" value="😝" readonly=""> <span>Squinting Face With Tongue</span></div>
			<div class="visibleChar"><input type="text" value="🤤" readonly=""> <span>Drooling Face</span></div>
			<div class="visibleChar"><input type="text" value="😒" readonly=""> <span>Unamused Face</span></div>
			<div class="visibleChar"><input type="text" value="😓" readonly=""> <span>Downcast Face With Sweat</span></div>
			<div class="visibleChar"><input type="text" value="😔" readonly=""> <span>Pensive Face</span></div>
			<div class="visibleChar"><input type="text" value="😕" readonly=""> <span>Confused Face</span></div>
			<div class="visibleChar"><input type="text" value="🙃" readonly=""> <span>Upside-Down Face</span></div>
			<div class="visibleChar"><input type="text" value="🤑" readonly=""> <span>Money-Mouth Face</span></div>
			<div class="visibleChar"><input type="text" value="😲" readonly=""> <span>Astonished Face</span></div>
			<div class="visibleChar"><input type="text" value="☹" readonly=""> <span>Frowning Face</span></div>
			<div class="visibleChar"><input type="text" value="🙁" readonly=""> <span>Slightly Frowning Face</span></div>
			<div class="visibleChar"><input type="text" value="😖" readonly=""> <span>Confounded Face</span></div>
			<div class="visibleChar"><input type="text" value="😞" readonly=""> <span>Disappointed Face</span></div>
			<div class="visibleChar"><input type="text" value="😟" readonly=""> <span>Worried Face</span></div>
			<div class="visibleChar"><input type="text" value="😤" readonly=""> <span>Face With Steam From Nose</span></div>
			<div class="visibleChar"><input type="text" value="😢" readonly=""> <span>Crying Face</span></div>
			<div class="visibleChar"><input type="text" value="😭" readonly=""> <span>Loudly Crying Face</span></div>
			<div class="visibleChar"><input type="text" value="😦" readonly=""> <span>Frowning Face With Open Mouth</span></div>
			<div class="visibleChar"><input type="text" value="😧" readonly=""> <span>Anguished Face</span></div>
			<div class="visibleChar"><input type="text" value="😨" readonly=""> <span>Fearful Face</span></div>
			<div class="visibleChar"><input type="text" value="😩" readonly=""> <span>Weary Face</span></div>
			<div class="visibleChar"><input type="text" value="🤯" readonly=""> <span>Exploding Head</span></div>
			<div class="visibleChar"><input type="text" value="😬" readonly=""> <span>Grimacing Face</span></div>
			<div class="visibleChar"><input type="text" value="😰" readonly=""> <span>Anxious Face With Sweat</span></div>
			<div class="visibleChar"><input type="text" value="😱" readonly=""> <span>Face Screaming in Fear</span></div>
			<div class="visibleChar"><input type="text" value="😳" readonly=""> <span>Flushed Face</span></div>
			<div class="visibleChar"><input type="text" value="🤪" readonly=""> <span>Zany Face</span></div>
			<div class="visibleChar"><input type="text" value="😵" readonly=""> <span>Dizzy Face</span></div>
			<div class="visibleChar"><input type="text" value="😡" readonly=""> <span>Pouting Face</span></div>
			<div class="visibleChar"><input type="text" value="😠" readonly=""> <span>Angry Face</span></div>
			<div class="visibleChar"><input type="text" value="🤬" readonly=""> <span>Face With Symbols on Mouth</span></div>
			<div class="visibleChar"><input type="text" value="😷" readonly=""> <span>Face With Medical Mask</span></div>
			<div class="visibleChar"><input type="text" value="🤒" readonly=""> <span>Face With Thermometer</span></div>
			<div class="visibleChar"><input type="text" value="🤕" readonly=""> <span>Face With Head-Bandage</span></div>
			<div class="visibleChar"><input type="text" value="🤢" readonly=""> <span>Nauseated Face</span></div>
			<div class="visibleChar"><input type="text" value="🤮" readonly=""> <span>Face Vomiting</span></div>
			<div class="visibleChar"><input type="text" value="🤧" readonly=""> <span>Sneezing Face</span></div>
			<div class="visibleChar"><input type="text" value="😇" readonly=""> <span>Smiling Face With Halo</span></div>
			<div class="visibleChar"><input type="text" value="🤠" readonly=""> <span>Cowboy Hat Face</span></div>
			<div class="visibleChar"><input type="text" value="🤡" readonly=""> <span>Clown Face</span></div>
			<div class="visibleChar"><input type="text" value="🤥" readonly=""> <span>Lying Face</span></div>
			<div class="visibleChar"><input type="text" value="🤫" readonly=""> <span>Shushing Face</span></div>
			<div class="visibleChar"><input type="text" value="🤭" readonly=""> <span>Face With Hand Over Mouth</span></div>
			<div class="visibleChar"><input type="text" value="🧐" readonly=""> <span>Face With Monocle</span></div>
			<div class="visibleChar"><input type="text" value="🤓" readonly=""> <span>Nerd Face</span></div>
			<div class="visibleChar"><input type="text" value="😈" readonly=""> <span>Red Devil With Horns</span></div>
			<div class="visibleChar"><input type="text" value="👿" readonly=""> <span>Red Devil Face With Horns</span></div>
			<div class="visibleChar"><input type="text" value="👹" readonly=""> <span>Ogre</span></div>
			<div class="visibleChar"><input type="text" value="👺" readonly=""> <span>Goblin</span></div>
			<div class="visibleChar"><input type="text" value="💀" readonly=""> <span>Skull</span></div>
			<div class="visibleChar"><input type="text" value="👻" readonly=""> <span>Ghost</span></div>
			<div class="visibleChar"><input type="text" value="👽" readonly=""> <span>Alien</span></div>
			<div class="visibleChar"><input type="text" value="🤖" readonly=""> <span>Robot Face</span></div>
			<div class="visibleChar"><input type="text" value="💩" readonly=""> <span>Pile of Poo</span></div>
		</div>
		<div class="emocat" data-name="People" id="emocat1">
			<div class="hiddenChar"><input type="text" value="👦" readonly=""> <span>Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👶" readonly=""> <span>Baby</span></div>
			<div class="hiddenChar"><input type="text" value="👧" readonly=""> <span>Girl</span></div>
			<div class="hiddenChar"><input type="text" value="👨" readonly=""> <span>Man</span></div>
			<div class="hiddenChar"><input type="text" value="👩" readonly=""> <span>Woman</span></div>
			<div class="hiddenChar"><input type="text" value="👴" readonly=""> <span>Old Man</span></div>
			<div class="hiddenChar"><input type="text" value="👵" readonly=""> <span>Old Woman</span></div>
			<div class="hiddenChar"><input type="text" value="👾" readonly=""> <span>Alien Monster</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;⚕️" readonly=""> <span>Man Health Worker</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;⚕️" readonly=""> <span>Woman Health Worker</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;🎓" readonly=""> <span>Man Student</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;🎓" readonly=""> <span>Woman Student</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;⚖️" readonly=""> <span>Man Judge</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;⚖️" readonly=""> <span>Woman Judge</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;🌾" readonly=""> <span>Man Farmer</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;🌾" readonly=""> <span>Woman Farmer</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;🍳" readonly=""> <span>Man Cook</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;🍳" readonly=""> <span>Woman Cook</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;🔧" readonly=""> <span>Man Mechanic</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;🔧" readonly=""> <span>Woman Mechanic</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;🏭" readonly=""> <span>Man Factory Worker</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;🏭" readonly=""> <span>Woman Factory Worker</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;💼" readonly=""> <span>Man Office Worker</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;💼" readonly=""> <span>Woman Office Worker</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;🔬" readonly=""> <span>Man Scientist</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;🔬" readonly=""> <span>Woman Scientist</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;💻" readonly=""> <span>Man Technologist</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;💻" readonly=""> <span>Woman Technologist</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;🎤" readonly=""> <span>Man Singer</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;🎤" readonly=""> <span>Woman Singer</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;🎨" readonly=""> <span>Man Artist</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;🎨" readonly=""> <span>Woman Artist</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;✈️" readonly=""> <span>Man Pilot</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;✈️" readonly=""> <span>Woman Pilot</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;🚀" readonly=""> <span>Man Astronaut</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;🚀" readonly=""> <span>Woman Astronaut</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;🚒" readonly=""> <span>Man Firefighter</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;🚒" readonly=""> <span>Woman Firefighter</span></div>
			<div class="hiddenChar"><input type="text" value="👮" readonly=""> <span>Police Officer</span></div>
			<div class="hiddenChar"><input type="text" value="👮&zwj;♂️" readonly=""> <span>Man Police Officer</span></div>
			<div class="hiddenChar"><input type="text" value="👮&zwj;♀️" readonly=""> <span>Woman Police Officer</span></div>
			<div class="hiddenChar"><input type="text" value="🕵" readonly=""> <span>Detective</span></div>
			<div class="hiddenChar"><input type="text" value="🕵️&zwj;♂️" readonly=""> <span>Man Detective</span></div>
			<div class="hiddenChar"><input type="text" value="🕵️&zwj;♀️" readonly=""> <span>Woman Detective</span></div>
			<div class="hiddenChar"><input type="text" value="💂" readonly=""> <span>Guard</span></div>
			<div class="hiddenChar"><input type="text" value="💂&zwj;♂️" readonly=""> <span>Man Guard</span></div>
			<div class="hiddenChar"><input type="text" value="💂&zwj;♀️" readonly=""> <span>Woman Guard</span></div>
			<div class="hiddenChar"><input type="text" value="👷" readonly=""> <span>Construction Worker</span></div>
			<div class="hiddenChar"><input type="text" value="👷&zwj;♂️" readonly=""> <span>Man Construction Worker</span></div>
			<div class="hiddenChar"><input type="text" value="👷&zwj;♀️" readonly=""> <span>Woman Construction Worker</span></div>
			<div class="hiddenChar"><input type="text" value="🤴" readonly=""> <span>Prince</span></div>
			<div class="hiddenChar"><input type="text" value="👸" readonly=""> <span>Princess</span></div>
			<div class="hiddenChar"><input type="text" value="👳" readonly=""> <span>Person Wearing Turban</span></div>
			<div class="hiddenChar"><input type="text" value="👳&zwj;♂️" readonly=""> <span>Man Wearing Turban</span></div>
			<div class="hiddenChar"><input type="text" value="👳&zwj;♀️" readonly=""> <span>Woman Wearing Turban</span></div>
			<div class="hiddenChar"><input type="text" value="👲" readonly=""> <span>Man With Chinese Cap</span></div>
			<div class="hiddenChar"><input type="text" value="🧕" readonly=""> <span>Woman With Headscarf</span></div>
			<div class="hiddenChar"><input type="text" value="🧔" readonly=""> <span>Bearded Person</span></div>
			<div class="hiddenChar"><input type="text" value="👱" readonly=""> <span>Blond-Haired Person</span></div>
			<div class="hiddenChar"><input type="text" value="👱&zwj;♂️" readonly=""> <span>Blond-Haired Man</span></div>
			<div class="hiddenChar"><input type="text" value="👱&zwj;♀️" readonly=""> <span>Blond-Haired Woman</span></div>
			<div class="hiddenChar"><input type="text" value="🤵" readonly=""> <span>Man in Tuxedo</span></div>
			<div class="hiddenChar"><input type="text" value="👰" readonly=""> <span>Bride With Veil</span></div>
			<div class="hiddenChar"><input type="text" value="🤰" readonly=""> <span>Pregnant Woman</span></div>
			<div class="hiddenChar"><input type="text" value="🤱" readonly=""> <span>Breast-Feeding</span></div>
			<div class="hiddenChar"><input type="text" value="👼" readonly=""> <span>Baby Angel</span></div>
			<div class="hiddenChar"><input type="text" value="🎅" readonly=""> <span>Santa Claus</span></div>
			<div class="hiddenChar"><input type="text" value="🤶" readonly=""> <span>Mrs. Claus</span></div>
			<div class="hiddenChar"><input type="text" value="🧙&zwj;♀️" readonly=""> <span>Woman Mage</span></div>
			<div class="hiddenChar"><input type="text" value="🧙&zwj;♂️" readonly=""> <span>Man Mage</span></div>
			<div class="hiddenChar"><input type="text" value="🧚&zwj;♀️" readonly=""> <span>Woman Fairy</span></div>
			<div class="hiddenChar"><input type="text" value="🧚&zwj;♂️" readonly=""> <span>Man Fairy</span></div>
			<div class="hiddenChar"><input type="text" value="🧛&zwj;♀️" readonly=""> <span>Woman Vampire</span></div>
			<div class="hiddenChar"><input type="text" value="🧛&zwj;♂️" readonly=""> <span>Man Vampire</span></div>
			<div class="hiddenChar"><input type="text" value="🧜&zwj;♀️" readonly=""> <span>Mermaid</span></div>
			<div class="hiddenChar"><input type="text" value="🧜&zwj;♂️" readonly=""> <span>Merman</span></div>
			<div class="hiddenChar"><input type="text" value="🧝&zwj;♀️" readonly=""> <span>Woman Elf</span></div>
			<div class="hiddenChar"><input type="text" value="🧝&zwj;♂️" readonly=""> <span>Man Elf</span></div>
			<div class="hiddenChar"><input type="text" value="🧞&zwj;♀️" readonly=""> <span>Woman Genie</span></div>
			<div class="hiddenChar"><input type="text" value="🧞&zwj;♂️" readonly=""> <span>Man Genie</span></div>
			<div class="hiddenChar"><input type="text" value="🧟&zwj;♀️" readonly=""> <span>Woman Zombie</span></div>
			<div class="hiddenChar"><input type="text" value="🧟&zwj;♂️" readonly=""> <span>Man Zombie</span></div>
			<div class="hiddenChar"><input type="text" value="🙍" readonly=""> <span>Person Frowning</span></div>
			<div class="hiddenChar"><input type="text" value="🙍&zwj;♂️" readonly=""> <span>Man Frowning</span></div>
			<div class="hiddenChar"><input type="text" value="🙍&zwj;♀️" readonly=""> <span>Woman Frowning</span></div>
			<div class="hiddenChar"><input type="text" value="🙎" readonly=""> <span>Person Pouting</span></div>
			<div class="hiddenChar"><input type="text" value="🙎&zwj;♂️" readonly=""> <span>Man Pouting</span></div>
			<div class="hiddenChar"><input type="text" value="🙎&zwj;♀️" readonly=""> <span>Woman Pouting</span></div>
			<div class="hiddenChar"><input type="text" value="🙅" readonly=""> <span>Person Gesturing No</span></div>
			<div class="hiddenChar"><input type="text" value="🙅&zwj;♂️" readonly=""> <span>Man Gesturing No</span></div>
			<div class="hiddenChar"><input type="text" value="🙅&zwj;♀️" readonly=""> <span>Woman Gesturing No</span></div>
			<div class="hiddenChar"><input type="text" value="🙆" readonly=""> <span>Person Gesturing OK</span></div>
			<div class="hiddenChar"><input type="text" value="🙆&zwj;♂️" readonly=""> <span>Man Gesturing OK</span></div>
			<div class="hiddenChar"><input type="text" value="🙆&zwj;♀️" readonly=""> <span>Woman Gesturing OK</span></div>
			<div class="hiddenChar"><input type="text" value="💁" readonly=""> <span>Person Tipping Hand</span></div>
			<div class="hiddenChar"><input type="text" value="💁&zwj;♂️" readonly=""> <span>Man Tipping Hand</span></div>
			<div class="hiddenChar"><input type="text" value="💁&zwj;♀️" readonly=""> <span>Woman Tipping Hand</span></div>
			<div class="hiddenChar"><input type="text" value="🙋" readonly=""> <span>Person Raising Hand</span></div>
			<div class="hiddenChar"><input type="text" value="🙋&zwj;♂️" readonly=""> <span>Man Raising Hand</span></div>
			<div class="hiddenChar"><input type="text" value="🙋&zwj;♀️" readonly=""> <span>Woman Raising Hand</span></div>
			<div class="hiddenChar"><input type="text" value="🙇" readonly=""> <span>Person Bowing</span></div>
			<div class="hiddenChar"><input type="text" value="🙇&zwj;♂️" readonly=""> <span>Man Bowing</span></div>
			<div class="hiddenChar"><input type="text" value="🙇&zwj;♀️" readonly=""> <span>Woman Bowing</span></div>
			<div class="hiddenChar"><input type="text" value="🤦" readonly=""> <span>Person Facepalming</span></div>
			<div class="hiddenChar"><input type="text" value="🤦&zwj;♂️" readonly=""> <span>Man Facepalming</span></div>
			<div class="hiddenChar"><input type="text" value="🤦&zwj;♀️" readonly=""> <span>Woman Facepalming</span></div>
			<div class="hiddenChar"><input type="text" value="🤷" readonly=""> <span>Person Shrugging</span></div>
			<div class="hiddenChar"><input type="text" value="🤷&zwj;♂️" readonly=""> <span>Man Shrugging</span></div>
			<div class="hiddenChar"><input type="text" value="🤷&zwj;♀️" readonly=""> <span>Woman Shrugging</span></div>
			<div class="hiddenChar"><input type="text" value="💆" readonly=""> <span>Person Getting Massage</span></div>
			<div class="hiddenChar"><input type="text" value="💆&zwj;♂️" readonly=""> <span>Man Getting Massage</span></div>
			<div class="hiddenChar"><input type="text" value="💆&zwj;♀️" readonly=""> <span>Woman Getting Massage</span></div>
			<div class="hiddenChar"><input type="text" value="💇" readonly=""> <span>Person Getting Haircut</span></div>
			<div class="hiddenChar"><input type="text" value="💇&zwj;♂️" readonly=""> <span>Man Getting Haircut</span></div>
			<div class="hiddenChar"><input type="text" value="💇&zwj;♀️" readonly=""> <span>Woman Getting Haircut</span></div>
			<div class="hiddenChar"><input type="text" value="🚶" readonly=""> <span>Person Walking</span></div>
			<div class="hiddenChar"><input type="text" value="🚶&zwj;♂️" readonly=""> <span>Man Walking</span></div>
			<div class="hiddenChar"><input type="text" value="🚶&zwj;♀️" readonly=""> <span>Woman Walking</span></div>
			<div class="hiddenChar"><input type="text" value="🏃" readonly=""> <span>Person Running</span></div>
			<div class="hiddenChar"><input type="text" value="🏃&zwj;♂️" readonly=""> <span>Man Running</span></div>
			<div class="hiddenChar"><input type="text" value="🏃&zwj;♀️" readonly=""> <span>Woman Running</span></div>
			<div class="hiddenChar"><input type="text" value="💃" readonly=""> <span>Woman Dancing</span></div>
			<div class="hiddenChar"><input type="text" value="🕺" readonly=""> <span>Man Dancing</span></div>
			<div class="hiddenChar"><input type="text" value="👯" readonly=""> <span>People With Bunny Ears</span></div>
			<div class="hiddenChar"><input type="text" value="👯&zwj;♂️" readonly=""> <span>Men With Bunny Ears</span></div>
			<div class="hiddenChar"><input type="text" value="👯&zwj;♀️" readonly=""> <span>Women With Bunny Ears</span></div>
			<div class="hiddenChar"><input type="text" value="🧖&zwj;♀️" readonly=""> <span>Woman in Steamy Room</span></div>
			<div class="hiddenChar"><input type="text" value="🧖&zwj;♂️" readonly=""> <span>Man in Steamy Room</span></div>
			<div class="hiddenChar"><input type="text" value="🕴" readonly=""> <span>Man in Suit Levitating</span></div>
			<div class="hiddenChar"><input type="text" value="🗣" readonly=""> <span>Speaking Head</span></div>
			<div class="hiddenChar"><input type="text" value="👤" readonly=""> <span>Bust in Silhouette</span></div>
			<div class="hiddenChar"><input type="text" value="👥" readonly=""> <span>Busts in Silhouette</span></div>
			<div class="hiddenChar"><input type="text" value="👫" readonly=""> <span>Man and Woman Holding Hands</span></div>
			<div class="hiddenChar"><input type="text" value="👬" readonly=""> <span>Two Men Holding Hands</span></div>
			<div class="hiddenChar"><input type="text" value="👭" readonly=""> <span>Two Women Holding Hands</span></div>
			<div class="hiddenChar"><input type="text" value="💏" readonly=""> <span>Kiss</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;❤️&zwj;💋&zwj;👨" readonly=""> <span>Kiss: Man, Man</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;❤️&zwj;💋&zwj;👩" readonly=""> <span>Kiss: Woman, Woman</span></div>
			<div class="hiddenChar"><input type="text" value="💑" readonly=""> <span>Couple With Heart</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;❤️&zwj;👨" readonly=""> <span>Couple With Heart: Man, Man</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;❤️&zwj;👩" readonly=""> <span>Couple With Heart: Woman, Woman</span></div>
			<div class="hiddenChar"><input type="text" value="👪" readonly=""> <span>Family</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👩&zwj;👦" readonly=""> <span>Family: Man, Woman, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👩&zwj;👧" readonly=""> <span>Family: Man, Woman, Girl</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👩&zwj;👧&zwj;👦" readonly=""> <span>Family: Man, Woman, Girl, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👩&zwj;👦&zwj;👦" readonly=""> <span>Family: Man, Woman, Boy, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👩&zwj;👧&zwj;👧" readonly=""> <span>Family: Man, Woman, Girl, Girl</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👨&zwj;👦" readonly=""> <span>Family: Man, Man, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👨&zwj;👧" readonly=""> <span>Family: Man, Man, Girl</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👨&zwj;👧&zwj;👦" readonly=""> <span>Family: Man, Man, Girl, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👨&zwj;👦&zwj;👦" readonly=""> <span>Family: Man, Man, Boy, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👨&zwj;👧&zwj;👧" readonly=""> <span>Family: Man, Man, Girl, Girl</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;👩&zwj;👦" readonly=""> <span>Family: Woman, Woman, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;👩&zwj;👧" readonly=""> <span>Family: Woman, Woman, Girl</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;👩&zwj;👧&zwj;👦" readonly=""> <span>Family: Woman, Woman, Girl, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;👩&zwj;👦&zwj;👦" readonly=""> <span>Family: Woman, Woman, Boy, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;👩&zwj;👧&zwj;👧" readonly=""> <span>Family: Woman, Woman, Girl, Girl</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👦" readonly=""> <span>Family: Man, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👦&zwj;👦" readonly=""> <span>Family: Man, Boy, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👧" readonly=""> <span>Family: Man, Girl</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👧&zwj;👦" readonly=""> <span>Family: Man, Girl, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👨&zwj;👧&zwj;👧" readonly=""> <span>Family: Man, Girl, Girl</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;👦" readonly=""> <span>Family: Woman, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;👦&zwj;👦" readonly=""> <span>Family: Woman, Boy, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;👧" readonly=""> <span>Family: Woman, Girl</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;👧&zwj;👦" readonly=""> <span>Family: Woman, Girl, Boy</span></div>
			<div class="hiddenChar"><input type="text" value="👩&zwj;👧&zwj;👧" readonly=""> <span>Family: Woman, Girl, Girl</span></div>
		</div>
		<div class="emocat" data-name="Animals" id="emocat2">
			<div class="hiddenChar"><input type="text" value="😺" readonly=""> <span>Grinning Cat Face</span></div>
			<div class="hiddenChar"><input type="text" value="😸" readonly=""> <span>Grinning Cat Face With Smiling Eyes</span></div>
			<div class="hiddenChar"><input type="text" value="😹" readonly=""> <span>Cat Face With Tears of Joy</span></div>
			<div class="hiddenChar"><input type="text" value="😻" readonly=""> <span>Smiling Cat Face With Heart-Eyes</span></div>
			<div class="hiddenChar"><input type="text" value="😼" readonly=""> <span>Cat Face With Wry Smile</span></div>
			<div class="hiddenChar"><input type="text" value="😽" readonly=""> <span>Kissing Cat Face</span></div>
			<div class="hiddenChar"><input type="text" value="🙀" readonly=""> <span>Weary Cat Face</span></div>
			<div class="hiddenChar"><input type="text" value="😿" readonly=""> <span>Crying Cat Face</span></div>
			<div class="hiddenChar"><input type="text" value="😾" readonly=""> <span>Pouting Cat Face</span></div>
			<div class="hiddenChar"><input type="text" value="🙈" readonly=""> <span>See-No-Evil Monkey</span></div>
			<div class="hiddenChar"><input type="text" value="🙉" readonly=""> <span>Hear-No-Evil Monkey</span></div>
			<div class="hiddenChar"><input type="text" value="🙊" readonly=""> <span>Speak-No-Evil Monkey</span></div>
			<div class="hiddenChar"><input type="text" value="💥" readonly=""> <span>Collision</span></div>
			<div class="hiddenChar"><input type="text" value="🐵" readonly=""> <span>Monkey Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐒" readonly=""> <span>Monkey</span></div>
			<div class="hiddenChar"><input type="text" value="🦍" readonly=""> <span>Gorilla</span></div>
			<div class="hiddenChar"><input type="text" value="🐶" readonly=""> <span>Dog Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐕" readonly=""> <span>Dog</span></div>
			<div class="hiddenChar"><input type="text" value="🐩" readonly=""> <span>Poodle</span></div>
			<div class="hiddenChar"><input type="text" value="🐺" readonly=""> <span>Wolf Face</span></div>
			<div class="hiddenChar"><input type="text" value="🦊" readonly=""> <span>Fox Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐱" readonly=""> <span>Cat Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐈" readonly=""> <span>Cat</span></div>
			<div class="hiddenChar"><input type="text" value="🦁" readonly=""> <span>Lion Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐯" readonly=""> <span>Tiger Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐅" readonly=""> <span>Tiger</span></div>
			<div class="hiddenChar"><input type="text" value="🐆" readonly=""> <span>Leopard</span></div>
			<div class="hiddenChar"><input type="text" value="🐴" readonly=""> <span>Horse Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐎" readonly=""> <span>Horse</span></div>
			<div class="hiddenChar"><input type="text" value="🦄" readonly=""> <span>Unicorn Face</span></div>
			<div class="hiddenChar"><input type="text" value="🦓" readonly=""> <span>Zebra</span></div>
			<div class="hiddenChar"><input type="text" value="🐮" readonly=""> <span>Cow Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐂" readonly=""> <span>Ox</span></div>
			<div class="hiddenChar"><input type="text" value="🐃" readonly=""> <span>Water Buffalo</span></div>
			<div class="hiddenChar"><input type="text" value="🐄" readonly=""> <span>Cow</span></div>
			<div class="hiddenChar"><input type="text" value="🐷" readonly=""> <span>Pig Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐖" readonly=""> <span>Pig</span></div>
			<div class="hiddenChar"><input type="text" value="🐗" readonly=""> <span>Boar</span></div>
			<div class="hiddenChar"><input type="text" value="🐽" readonly=""> <span>Pig Nose</span></div>
			<div class="hiddenChar"><input type="text" value="🐏" readonly=""> <span>Ram</span></div>
			<div class="hiddenChar"><input type="text" value="🐑" readonly=""> <span>Ewe</span></div>
			<div class="hiddenChar"><input type="text" value="🐐" readonly=""> <span>Goat</span></div>
			<div class="hiddenChar"><input type="text" value="🐪" readonly=""> <span>Camel</span></div>
			<div class="hiddenChar"><input type="text" value="🐫" readonly=""> <span>Two-Hump Camel</span></div>
			<div class="hiddenChar"><input type="text" value="🦒" readonly=""> <span>Giraffe</span></div>
			<div class="hiddenChar"><input type="text" value="🐘" readonly=""> <span>Elephant</span></div>
			<div class="hiddenChar"><input type="text" value="🦏" readonly=""> <span>Rhinoceros</span></div>
			<div class="hiddenChar"><input type="text" value="🐭" readonly=""> <span>Mouse Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐁" readonly=""> <span>Mouse</span></div>
			<div class="hiddenChar"><input type="text" value="🐀" readonly=""> <span>Rat</span></div>
			<div class="hiddenChar"><input type="text" value="🐹" readonly=""> <span>Hamster Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐰" readonly=""> <span>Rabbit Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐇" readonly=""> <span>Rabbit</span></div>
			<div class="hiddenChar"><input type="text" value="🐿" readonly=""> <span>Chipmunk</span></div>
			<div class="hiddenChar"><input type="text" value="🦔" readonly=""> <span>Hedgehog</span></div>
			<div class="hiddenChar"><input type="text" value="🦇" readonly=""> <span>Bat</span></div>
			<div class="hiddenChar"><input type="text" value="🐻" readonly=""> <span>Bear Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐨" readonly=""> <span>Koala</span></div>
			<div class="hiddenChar"><input type="text" value="🐼" readonly=""> <span>Panda Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐾" readonly=""> <span>Paw Prints</span></div>
			<div class="hiddenChar"><input type="text" value="🦃" readonly=""> <span>Turkey</span></div>
			<div class="hiddenChar"><input type="text" value="🐔" readonly=""> <span>Chicken</span></div>
			<div class="hiddenChar"><input type="text" value="🐓" readonly=""> <span>Rooster</span></div>
			<div class="hiddenChar"><input type="text" value="🐣" readonly=""> <span>Hatching Chick</span></div>
			<div class="hiddenChar"><input type="text" value="🐤" readonly=""> <span>Baby Chick</span></div>
			<div class="hiddenChar"><input type="text" value="🐥" readonly=""> <span>Front-Facing Baby Chick</span></div>
			<div class="hiddenChar"><input type="text" value="🐦" readonly=""> <span>Bird</span></div>
			<div class="hiddenChar"><input type="text" value="🐧" readonly=""> <span>Penguin</span></div>
			<div class="hiddenChar"><input type="text" value="🕊" readonly=""> <span>White Dove</span></div>
			<div class="hiddenChar"><input type="text" value="🦅" readonly=""> <span>Eagle</span></div>
			<div class="hiddenChar"><input type="text" value="🦆" readonly=""> <span>Duck</span></div>
			<div class="hiddenChar"><input type="text" value="🦉" readonly=""> <span>Owl</span></div>
			<div class="hiddenChar"><input type="text" value="🐸" readonly=""> <span>Frog Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐊" readonly=""> <span>Crocodile</span></div>
			<div class="hiddenChar"><input type="text" value="🐢" readonly=""> <span>Turtle</span></div>
			<div class="hiddenChar"><input type="text" value="🦎" readonly=""> <span>Lizard</span></div>
			<div class="hiddenChar"><input type="text" value="🐍" readonly=""> <span>Snake</span></div>
			<div class="hiddenChar"><input type="text" value="🐲" readonly=""> <span>Dragon Face</span></div>
			<div class="hiddenChar"><input type="text" value="🐉" readonly=""> <span>Dragon</span></div>
			<div class="hiddenChar"><input type="text" value="🦕" readonly=""> <span>Sauropod</span></div>
			<div class="hiddenChar"><input type="text" value="🦖" readonly=""> <span>T-Rex</span></div>
			<div class="hiddenChar"><input type="text" value="🐳" readonly=""> <span>Spouting Whale</span></div>
			<div class="hiddenChar"><input type="text" value="🐋" readonly=""> <span>Whale</span></div>
			<div class="hiddenChar"><input type="text" value="🐬" readonly=""> <span>Dolphin</span></div>
			<div class="hiddenChar"><input type="text" value="🐟" readonly=""> <span>Fish</span></div>
			<div class="hiddenChar"><input type="text" value="🐠" readonly=""> <span>Tropical Fish</span></div>
			<div class="hiddenChar"><input type="text" value="🐡" readonly=""> <span>Blowfish</span></div>
			<div class="hiddenChar"><input type="text" value="🦈" readonly=""> <span>Shark</span></div>
			<div class="hiddenChar"><input type="text" value="🐙" readonly=""> <span>Octopus</span></div>
			<div class="hiddenChar"><input type="text" value="🐚" readonly=""> <span>Spiral Shell</span></div>
			<div class="hiddenChar"><input type="text" value="🦀" readonly=""> <span>Crab</span></div>
			<div class="hiddenChar"><input type="text" value="🦐" readonly=""> <span>Shrimp</span></div>
			<div class="hiddenChar"><input type="text" value="🦑" readonly=""> <span>Squid</span></div>
			<div class="hiddenChar"><input type="text" value="🐌" readonly=""> <span>Snail</span></div>
			<div class="hiddenChar"><input type="text" value="🦋" readonly=""> <span>Butterfly</span></div>
			<div class="hiddenChar"><input type="text" value="🐛" readonly=""> <span>Bug</span></div>
			<div class="hiddenChar"><input type="text" value="🐜" readonly=""> <span>Ant</span></div>
			<div class="hiddenChar"><input type="text" value="🐝" readonly=""> <span>Honeybee</span></div>
			<div class="hiddenChar"><input type="text" value="🐞" readonly=""> <span>Lady Beetle</span></div>
			<div class="hiddenChar"><input type="text" value="🦗" readonly=""> <span>Cricket</span></div>
			<div class="hiddenChar"><input type="text" value="🕷" readonly=""> <span>Spider</span></div>
			<div class="hiddenChar"><input type="text" value="🕸" readonly=""> <span>Spider Web</span></div>
			<div class="hiddenChar"><input type="text" value="🦂" readonly=""> <span>Scorpion</span></div>
		</div>
		<div class="emocat" data-name="Plants" id="emocat3">
			<div class="hiddenChar"><input type="text" value="💐" readonly=""> <span>Bouquet</span></div>
			<div class="hiddenChar"><input type="text" value="🌸" readonly=""> <span>Cherry Blossom</span></div>
			<div class="hiddenChar"><input type="text" value="💮" readonly=""> <span>White Flower</span></div>
			<div class="hiddenChar"><input type="text" value="🏵" readonly=""> <span>Rosette</span></div>
			<div class="hiddenChar"><input type="text" value="🌹" readonly=""> <span>Rose</span></div>
			<div class="hiddenChar"><input type="text" value="🥀" readonly=""> <span>Wilted Flower</span></div>
			<div class="hiddenChar"><input type="text" value="🌺" readonly=""> <span>Hibiscus</span></div>
			<div class="hiddenChar"><input type="text" value="🌻" readonly=""> <span>Sunflower</span></div>
			<div class="hiddenChar"><input type="text" value="🌼" readonly=""> <span>Blossom</span></div>
			<div class="hiddenChar"><input type="text" value="🌷" readonly=""> <span>Tulip</span></div>
			<div class="hiddenChar"><input type="text" value="🌱" readonly=""> <span>Seedling</span></div>
			<div class="hiddenChar"><input type="text" value="🌲" readonly=""> <span>Evergreen Tree</span></div>
			<div class="hiddenChar"><input type="text" value="🌳" readonly=""> <span>Deciduous Tree</span></div>
			<div class="hiddenChar"><input type="text" value="🌴" readonly=""> <span>Palm Tree</span></div>
			<div class="hiddenChar"><input type="text" value="🌵" readonly=""> <span>Cactus</span></div>
			<div class="hiddenChar"><input type="text" value="🌾" readonly=""> <span>Sheaf of Rice</span></div>
			<div class="hiddenChar"><input type="text" value="🌿" readonly=""> <span>Herb</span></div>
			<div class="hiddenChar"><input type="text" value="☘" readonly=""> <span>Shamrock</span></div>
			<div class="hiddenChar"><input type="text" value="🍀" readonly=""> <span>Four Leaf Clover</span></div>
			<div class="hiddenChar"><input type="text" value="🍁" readonly=""> <span>Maple Leaf</span></div>
			<div class="hiddenChar"><input type="text" value="🍂" readonly=""> <span>Fallen Leaf</span></div>
			<div class="hiddenChar"><input type="text" value="🍃" readonly=""> <span>Leaf Fluttering in Wind</span></div>
			<div class="hiddenChar"><input type="text" value="🍄" readonly=""> <span>Mushroom</span></div>
			<div class="hiddenChar"><input type="text" value="🌰" readonly=""> <span>Chestnut</span></div>
		</div>
		<div class="emocat" data-name="Nature" id="emocat4">
			<div class="hiddenChar"><input type="text" value="🌍" readonly=""> <span>Globe Showing Europe-Africa</span></div>
			<div class="hiddenChar"><input type="text" value="🌎" readonly=""> <span>Globe Showing Americas</span></div>
			<div class="hiddenChar"><input type="text" value="🌏" readonly=""> <span>Globe Showing Asia-Australia</span></div>
			<div class="hiddenChar"><input type="text" value="🌐" readonly=""> <span>Globe With Meridians</span></div>
			<div class="hiddenChar"><input type="text" value="🌑" readonly=""> <span>New Moon</span></div>
			<div class="hiddenChar"><input type="text" value="🌒" readonly=""> <span>Waxing Crescent Moon</span></div>
			<div class="hiddenChar"><input type="text" value="🌓" readonly=""> <span>First Quarter Moon</span></div>
			<div class="hiddenChar"><input type="text" value="🌔" readonly=""> <span>Waxing Gibbous Moon</span></div>
			<div class="hiddenChar"><input type="text" value="🌕" readonly=""> <span>Full Moon</span></div>
			<div class="hiddenChar"><input type="text" value="🌖" readonly=""> <span>Waning Gibbous Moon</span></div>
			<div class="hiddenChar"><input type="text" value="🌗" readonly=""> <span>Last Quarter Moon</span></div>
			<div class="hiddenChar"><input type="text" value="🌘" readonly=""> <span>Waning Crescent Moon</span></div>
			<div class="hiddenChar"><input type="text" value="🌙" readonly=""> <span>Crescent Moon</span></div>
			<div class="hiddenChar"><input type="text" value="🌚" readonly=""> <span>New Moon Face</span></div>
			<div class="hiddenChar"><input type="text" value="🌛" readonly=""> <span>First Quarter Moon Face</span></div>
			<div class="hiddenChar"><input type="text" value="🌜" readonly=""> <span>Last Quarter Moon Face</span></div>
			<div class="hiddenChar"><input type="text" value="☀" readonly=""> <span>Sun</span></div>
			<div class="hiddenChar"><input type="text" value="🌝" readonly=""> <span>Full Moon Face</span></div>
			<div class="hiddenChar"><input type="text" value="🌞" readonly=""> <span>Sun With Face</span></div>
			<div class="hiddenChar"><input type="text" value="⭐" readonly=""> <span>White Medium Star</span></div>
			<div class="hiddenChar"><input type="text" value="🌟" readonly=""> <span>Glowing Star</span></div>
			<div class="hiddenChar"><input type="text" value="🌠" readonly=""> <span>Shooting Star</span></div>
			<div class="hiddenChar"><input type="text" value="☁" readonly=""> <span>Cloud</span></div>
			<div class="hiddenChar"><input type="text" value="⛅" readonly=""> <span>Sun Behind Cloud</span></div>
			<div class="hiddenChar"><input type="text" value="⛈" readonly=""> <span>Cloud With Lightning and Rain</span></div>
			<div class="hiddenChar"><input type="text" value="🌤" readonly=""> <span>Sun Behind Small Cloud</span></div>
			<div class="hiddenChar"><input type="text" value="🌥" readonly=""> <span>Sun Behind Large Cloud</span></div>
			<div class="hiddenChar"><input type="text" value="🌦" readonly=""> <span>Sun Behind Rain Cloud</span></div>
			<div class="hiddenChar"><input type="text" value="🌧" readonly=""> <span>Cloud With Rain</span></div>
			<div class="hiddenChar"><input type="text" value="🌨" readonly=""> <span>Cloud With Snow</span></div>
			<div class="hiddenChar"><input type="text" value="🌩" readonly=""> <span>Cloud With Lightning</span></div>
			<div class="hiddenChar"><input type="text" value="🌪" readonly=""> <span>Tornado</span></div>
			<div class="hiddenChar"><input type="text" value="🌫" readonly=""> <span>Fog</span></div>
			<div class="hiddenChar"><input type="text" value="🌬" readonly=""> <span>Wind Face</span></div>
			<div class="hiddenChar"><input type="text" value="🌈" readonly=""> <span>Rainbow</span></div>
			<div class="hiddenChar"><input type="text" value="☔" readonly=""> <span>Umbrella With Rain Drops</span></div>
			<div class="hiddenChar"><input type="text" value="⚡" readonly=""> <span>High Voltage</span></div>
			<div class="hiddenChar"><input type="text" value="❄" readonly=""> <span>Snowflake</span></div>
			<div class="hiddenChar"><input type="text" value="☃" readonly=""> <span>Snowman</span></div>
			<div class="hiddenChar"><input type="text" value="⛄" readonly=""> <span>Snowman Without Snow</span></div>
			<div class="hiddenChar"><input type="text" value="☄" readonly=""> <span>Comet</span></div>
			<div class="hiddenChar"><input type="text" value="🔥" readonly=""> <span>Fire</span></div>
			<div class="hiddenChar"><input type="text" value="💧" readonly=""> <span>Droplet</span></div>
			<div class="hiddenChar"><input type="text" value="🌊" readonly=""> <span>Water Wave</span></div>
			<div class="hiddenChar"><input type="text" value="🎄" readonly=""> <span>Christmas Tree</span></div>
			<div class="hiddenChar"><input type="text" value="✨" readonly=""> <span>Sparkles</span></div>
			<div class="hiddenChar"><input type="text" value="🎋" readonly=""> <span>Tanabata Tree</span></div>
			<div class="hiddenChar"><input type="text" value="🎍" readonly=""> <span>Pine Decoration</span></div>
		</div>
		<div class="emocat" data-name="Food" id="emocat5">
			<div class="hiddenChar"><input type="text" value="🍇" readonly=""> <span>Grapes</span></div>
			<div class="hiddenChar"><input type="text" value="🍈" readonly=""> <span>Melon</span></div>
			<div class="hiddenChar"><input type="text" value="🍉" readonly=""> <span>Watermelon</span></div>
			<div class="hiddenChar"><input type="text" value="🍊" readonly=""> <span>Tangerine</span></div>
			<div class="hiddenChar"><input type="text" value="🍋" readonly=""> <span>Lemon</span></div>
			<div class="hiddenChar"><input type="text" value="🍌" readonly=""> <span>Banana</span></div>
			<div class="hiddenChar"><input type="text" value="🍍" readonly=""> <span>Pineapple</span></div>
			<div class="hiddenChar"><input type="text" value="🍎" readonly=""> <span>Red Apple</span></div>
			<div class="hiddenChar"><input type="text" value="🍏" readonly=""> <span>Green Apple</span></div>
			<div class="hiddenChar"><input type="text" value="🍐" readonly=""> <span>Pear</span></div>
			<div class="hiddenChar"><input type="text" value="🍑" readonly=""> <span>Peach</span></div>
			<div class="hiddenChar"><input type="text" value="🍒" readonly=""> <span>Cherries</span></div>
			<div class="hiddenChar"><input type="text" value="🍓" readonly=""> <span>Strawberry</span></div>
			<div class="hiddenChar"><input type="text" value="🥝" readonly=""> <span>Kiwi Fruit</span></div>
			<div class="hiddenChar"><input type="text" value="🍅" readonly=""> <span>Tomato</span></div>
			<div class="hiddenChar"><input type="text" value="🥥" readonly=""> <span>Coconut</span></div>
			<div class="hiddenChar"><input type="text" value="🥑" readonly=""> <span>Avocado</span></div>
			<div class="hiddenChar"><input type="text" value="🍆" readonly=""> <span>Eggplant</span></div>
			<div class="hiddenChar"><input type="text" value="🥔" readonly=""> <span>Potato</span></div>
			<div class="hiddenChar"><input type="text" value="🥕" readonly=""> <span>Carrot</span></div>
			<div class="hiddenChar"><input type="text" value="🌽" readonly=""> <span>Ear of Corn</span></div>
			<div class="hiddenChar"><input type="text" value="🌶" readonly=""> <span>Hot Pepper</span></div>
			<div class="hiddenChar"><input type="text" value="🥒" readonly=""> <span>Cucumber</span></div>
			<div class="hiddenChar"><input type="text" value="🥦" readonly=""> <span>Broccoli</span></div>
			<div class="hiddenChar"><input type="text" value="🥜" readonly=""> <span>Peanuts</span></div>
			<div class="hiddenChar"><input type="text" value="🍞" readonly=""> <span>Bread</span></div>
			<div class="hiddenChar"><input type="text" value="🥐" readonly=""> <span>Croissant</span></div>
			<div class="hiddenChar"><input type="text" value="🥖" readonly=""> <span>Baguette Bread</span></div>
			<div class="hiddenChar"><input type="text" value="🥨" readonly=""> <span>Pretzel</span></div>
			<div class="hiddenChar"><input type="text" value="🥞" readonly=""> <span>Pancakes</span></div>
			<div class="hiddenChar"><input type="text" value="🧀" readonly=""> <span>Cheese Wedge</span></div>
			<div class="hiddenChar"><input type="text" value="🍖" readonly=""> <span>Meat on Bone</span></div>
			<div class="hiddenChar"><input type="text" value="🍗" readonly=""> <span>Poultry Leg</span></div>
			<div class="hiddenChar"><input type="text" value="🥩" readonly=""> <span>Cut of Meat</span></div>
			<div class="hiddenChar"><input type="text" value="🥓" readonly=""> <span>Bacon</span></div>
			<div class="hiddenChar"><input type="text" value="🍔" readonly=""> <span>Hamburger</span></div>
			<div class="hiddenChar"><input type="text" value="🍟" readonly=""> <span>French Fries</span></div>
			<div class="hiddenChar"><input type="text" value="🍕" readonly=""> <span>Pizza</span></div>
			<div class="hiddenChar"><input type="text" value="🌭" readonly=""> <span>Hot Dog</span></div>
			<div class="hiddenChar"><input type="text" value="🥪" readonly=""> <span>Sandwich</span></div>
			<div class="hiddenChar"><input type="text" value="🌮" readonly=""> <span>Taco</span></div>
			<div class="hiddenChar"><input type="text" value="🌯" readonly=""> <span>Burrito</span></div>
			<div class="hiddenChar"><input type="text" value="🍳" readonly=""> <span>Cooking</span></div>
			<div class="hiddenChar"><input type="text" value="🍲" readonly=""> <span>Pot of Food</span></div>
			<div class="hiddenChar"><input type="text" value="🥣" readonly=""> <span>Bowl With Spoon</span></div>
			<div class="hiddenChar"><input type="text" value="🥗" readonly=""> <span>Green Salad</span></div>
			<div class="hiddenChar"><input type="text" value="🍿" readonly=""> <span>Popcorn</span></div>
			<div class="hiddenChar"><input type="text" value="🥫" readonly=""> <span>Canned Food</span></div>
			<div class="hiddenChar"><input type="text" value="🍱" readonly=""> <span>Bento Box</span></div>
			<div class="hiddenChar"><input type="text" value="🍘" readonly=""> <span>Rice Cracker</span></div>
			<div class="hiddenChar"><input type="text" value="🍙" readonly=""> <span>Rice Ball</span></div>
			<div class="hiddenChar"><input type="text" value="🍚" readonly=""> <span>Cooked Rice</span></div>
			<div class="hiddenChar"><input type="text" value="🍛" readonly=""> <span>Curry Rice</span></div>
			<div class="hiddenChar"><input type="text" value="🍜" readonly=""> <span>Steaming Bowl</span></div>
			<div class="hiddenChar"><input type="text" value="🍝" readonly=""> <span>Spaghetti</span></div>
			<div class="hiddenChar"><input type="text" value="🍠" readonly=""> <span>Roasted Sweet Potato</span></div>
			<div class="hiddenChar"><input type="text" value="🍢" readonly=""> <span>Oden</span></div>
			<div class="hiddenChar"><input type="text" value="🍣" readonly=""> <span>Sushi</span></div>
			<div class="hiddenChar"><input type="text" value="🍤" readonly=""> <span>Fried Shrimp</span></div>
			<div class="hiddenChar"><input type="text" value="🍥" readonly=""> <span>Fish Cake With Swirl</span></div>
			<div class="hiddenChar"><input type="text" value="🍡" readonly=""> <span>Dango</span></div>
			<div class="hiddenChar"><input type="text" value="🥟" readonly=""> <span>Dumpling</span></div>
			<div class="hiddenChar"><input type="text" value="🥠" readonly=""> <span>Fortune Cookie</span></div>
			<div class="hiddenChar"><input type="text" value="🥡" readonly=""> <span>Takeout Box</span></div>
			<div class="hiddenChar"><input type="text" value="🍦" readonly=""> <span>Soft Ice Cream</span></div>
			<div class="hiddenChar"><input type="text" value="🍧" readonly=""> <span>Shaved Ice</span></div>
			<div class="hiddenChar"><input type="text" value="🍨" readonly=""> <span>Ice Cream</span></div>
			<div class="hiddenChar"><input type="text" value="🍩" readonly=""> <span>Doughnut</span></div>
			<div class="hiddenChar"><input type="text" value="🍪" readonly=""> <span>Cookie</span></div>
			<div class="hiddenChar"><input type="text" value="🎂" readonly=""> <span>Birthday Cake</span></div>
			<div class="hiddenChar"><input type="text" value="🍰" readonly=""> <span>Shortcake</span></div>
			<div class="hiddenChar"><input type="text" value="🥧" readonly=""> <span>Pie</span></div>
			<div class="hiddenChar"><input type="text" value="🍫" readonly=""> <span>Chocolate Bar</span></div>
			<div class="hiddenChar"><input type="text" value="🍬" readonly=""> <span>Candy</span></div>
			<div class="hiddenChar"><input type="text" value="🍭" readonly=""> <span>Lollipop</span></div>
			<div class="hiddenChar"><input type="text" value="🍮" readonly=""> <span>Custard</span></div>
			<div class="hiddenChar"><input type="text" value="🍯" readonly=""> <span>Honey Pot</span></div>
			<div class="hiddenChar"><input type="text" value="🍼" readonly=""> <span>Baby Bottle</span></div>
			<div class="hiddenChar"><input type="text" value="🥛" readonly=""> <span>Glass of Milk</span></div>
			<div class="hiddenChar"><input type="text" value="☕" readonly=""> <span>Cup of Hot Beverage</span></div>
			<div class="hiddenChar"><input type="text" value="🍵" readonly=""> <span>Teacup Without Handle</span></div>
			<div class="hiddenChar"><input type="text" value="🍶" readonly=""> <span>Sake</span></div>
			<div class="hiddenChar"><input type="text" value="🍾" readonly=""> <span>Bottle With Popping Cork</span></div>
			<div class="hiddenChar"><input type="text" value="🍷" readonly=""> <span>Wine Glass</span></div>
			<div class="hiddenChar"><input type="text" value="🍸" readonly=""> <span>Cocktail Glass</span></div>
			<div class="hiddenChar"><input type="text" value="🍹" readonly=""> <span>Tropical Drink</span></div>
			<div class="hiddenChar"><input type="text" value="🍺" readonly=""> <span>Beer Mug</span></div>
			<div class="hiddenChar"><input type="text" value="🍻" readonly=""> <span>Clinking Beer Mugs</span></div>
			<div class="hiddenChar"><input type="text" value="🥂" readonly=""> <span>Clinking Glasses</span></div>
			<div class="hiddenChar"><input type="text" value="🥃" readonly=""> <span>Tumbler Glass</span></div>
			<div class="hiddenChar"><input type="text" value="🥤" readonly=""> <span>Cup With Straw</span></div>
			<div class="hiddenChar"><input type="text" value="🥢" readonly=""> <span>Chopsticks</span></div>
			<div class="hiddenChar"><input type="text" value="🍽" readonly=""> <span>Fork and Knife With Plate</span></div>
			<div class="hiddenChar"><input type="text" value="🍴" readonly=""> <span>Fork and Knife</span></div>
			<div class="hiddenChar"><input type="text" value="🥄" readonly=""> <span>Spoon</span></div>
		</div>
		<div class="emocat" data-name="Activity" id="emocat6">
			<div class="hiddenChar"><input type="text" value="🏇" readonly=""> <span>Horse Racing</span></div>
			<div class="hiddenChar"><input type="text" value="⛷" readonly=""> <span>Skier</span></div>
			<div class="hiddenChar"><input type="text" value="🏂" readonly=""> <span>Snowboarder</span></div>
			<div class="hiddenChar"><input type="text" value="🧗&zwj;♀️" readonly=""> <span>Woman Climbing</span></div>
			<div class="hiddenChar"><input type="text" value="🧗&zwj;♂️" readonly=""> <span>Man Climbing</span></div>
			<div class="hiddenChar"><input type="text" value="🧘&zwj;♀️" readonly=""> <span>Woman in Lotus Position</span></div>
			<div class="hiddenChar"><input type="text" value="🧘&zwj;♂️" readonly=""> <span>Man in Lotus Position</span></div>
			<div class="hiddenChar"><input type="text" value="🏌" readonly=""> <span>Person Golfing</span></div>
			<div class="hiddenChar"><input type="text" value="🏌️&zwj;♂️" readonly=""> <span>Man Golfing</span></div>
			<div class="hiddenChar"><input type="text" value="🏌️&zwj;♀️" readonly=""> <span>Woman Golfing</span></div>
			<div class="hiddenChar"><input type="text" value="🏄" readonly=""> <span>Person Surfing</span></div>
			<div class="hiddenChar"><input type="text" value="🏄&zwj;♂️" readonly=""> <span>Man Surfing</span></div>
			<div class="hiddenChar"><input type="text" value="🏄&zwj;♀️" readonly=""> <span>Woman Surfing</span></div>
			<div class="hiddenChar"><input type="text" value="🚣" readonly=""> <span>Person Rowing Boat</span></div>
			<div class="hiddenChar"><input type="text" value="🚣&zwj;♂️" readonly=""> <span>Man Rowing Boat</span></div>
			<div class="hiddenChar"><input type="text" value="🚣&zwj;♀️" readonly=""> <span>Woman Rowing Boat</span></div>
			<div class="hiddenChar"><input type="text" value="🏊" readonly=""> <span>Person Swimming</span></div>
			<div class="hiddenChar"><input type="text" value="🏊&zwj;♂️" readonly=""> <span>Man Swimming</span></div>
			<div class="hiddenChar"><input type="text" value="🏊&zwj;♀️" readonly=""> <span>Woman Swimming</span></div>
			<div class="hiddenChar"><input type="text" value="⛹" readonly=""> <span>Person Bouncing Ball</span></div>
			<div class="hiddenChar"><input type="text" value="⛹️&zwj;♂️" readonly=""> <span>Man Bouncing Ball</span></div>
			<div class="hiddenChar"><input type="text" value="⛹️&zwj;♀️" readonly=""> <span>Woman Bouncing Ball</span></div>
			<div class="hiddenChar"><input type="text" value="🏋" readonly=""> <span>Person Lifting Weights</span></div>
			<div class="hiddenChar"><input type="text" value="🏋️&zwj;♂️" readonly=""> <span>Man Lifting Weights</span></div>
			<div class="hiddenChar"><input type="text" value="🏋️&zwj;♀️" readonly=""> <span>Woman Lifting Weights</span></div>
			<div class="hiddenChar"><input type="text" value="🚴" readonly=""> <span>Person Biking</span></div>
			<div class="hiddenChar"><input type="text" value="🚴&zwj;♂️" readonly=""> <span>Man Biking</span></div>
			<div class="hiddenChar"><input type="text" value="🚴&zwj;♀️" readonly=""> <span>Woman Biking</span></div>
			<div class="hiddenChar"><input type="text" value="🚵" readonly=""> <span>Person Mountain Biking</span></div>
			<div class="hiddenChar"><input type="text" value="🚵&zwj;♂️" readonly=""> <span>Man Mountain Biking</span></div>
			<div class="hiddenChar"><input type="text" value="🚵&zwj;♀️" readonly=""> <span>Woman Mountain Biking</span></div>
			<div class="hiddenChar"><input type="text" value="🤸" readonly=""> <span>Person Cartwheeling</span></div>
			<div class="hiddenChar"><input type="text" value="🤸&zwj;♂️" readonly=""> <span>Man Cartwheeling</span></div>
			<div class="hiddenChar"><input type="text" value="🤸&zwj;♀️" readonly=""> <span>Woman Cartwheeling</span></div>
			<div class="hiddenChar"><input type="text" value="🤼" readonly=""> <span>People Wrestling</span></div>
			<div class="hiddenChar"><input type="text" value="🤼&zwj;♂️" readonly=""> <span>Men Wrestling</span></div>
			<div class="hiddenChar"><input type="text" value="🤼&zwj;♀️" readonly=""> <span>Women Wrestling</span></div>
			<div class="hiddenChar"><input type="text" value="🤽" readonly=""> <span>Person Playing Water Polo</span></div>
			<div class="hiddenChar"><input type="text" value="🤽&zwj;♂️" readonly=""> <span>Man Playing Water Polo</span></div>
			<div class="hiddenChar"><input type="text" value="🤽&zwj;♀️" readonly=""> <span>Woman Playing Water Polo</span></div>
			<div class="hiddenChar"><input type="text" value="🤾" readonly=""> <span>Person Playing Handball</span></div>
			<div class="hiddenChar"><input type="text" value="🤾&zwj;♂️" readonly=""> <span>Man Playing Handball</span></div>
			<div class="hiddenChar"><input type="text" value="🤾&zwj;♀️" readonly=""> <span>Woman Playing Handball</span></div>
			<div class="hiddenChar"><input type="text" value="🤹" readonly=""> <span>Person Juggling</span></div>
			<div class="hiddenChar"><input type="text" value="🤹&zwj;♂️" readonly=""> <span>Man Juggling</span></div>
			<div class="hiddenChar"><input type="text" value="🤹&zwj;♀️" readonly=""> <span>Woman Juggling</span></div>
			<div class="hiddenChar"><input type="text" value="🎪" readonly=""> <span>Circus Tent</span></div>
			<div class="hiddenChar"><input type="text" value="🎗" readonly=""> <span>Reminder Ribbon</span></div>
			<div class="hiddenChar"><input type="text" value="🎟" readonly=""> <span>Admission Tickets</span></div>
			<div class="hiddenChar"><input type="text" value="🎫" readonly=""> <span>Ticket</span></div>
			<div class="hiddenChar"><input type="text" value="🎖" readonly=""> <span>Military Medal</span></div>
			<div class="hiddenChar"><input type="text" value="🏆" readonly=""> <span>Trophy</span></div>
			<div class="hiddenChar"><input type="text" value="🏅" readonly=""> <span>Sports Medal</span></div>
			<div class="hiddenChar"><input type="text" value="🥇" readonly=""> <span>1st Place Medal</span></div>
			<div class="hiddenChar"><input type="text" value="🥈" readonly=""> <span>2nd Place Medal</span></div>
			<div class="hiddenChar"><input type="text" value="🥉" readonly=""> <span>3rd Place Medal</span></div>
			<div class="hiddenChar"><input type="text" value="⚽" readonly=""> <span>Soccer Ball</span></div>
			<div class="hiddenChar"><input type="text" value="⚾" readonly=""> <span>Baseball</span></div>
			<div class="hiddenChar"><input type="text" value="🏀" readonly=""> <span>Basketball</span></div>
			<div class="hiddenChar"><input type="text" value="🏐" readonly=""> <span>Volleyball</span></div>
			<div class="hiddenChar"><input type="text" value="🏈" readonly=""> <span>American Football</span></div>
			<div class="hiddenChar"><input type="text" value="🏉" readonly=""> <span>Rugby Football</span></div>
			<div class="hiddenChar"><input type="text" value="🎾" readonly=""> <span>Tennis</span></div>
			<div class="hiddenChar"><input type="text" value="🎳" readonly=""> <span>Bowling</span></div>
			<div class="hiddenChar"><input type="text" value="🏏" readonly=""> <span>Cricket Game</span></div>
			<div class="hiddenChar"><input type="text" value="🏑" readonly=""> <span>Field Hockey</span></div>
			<div class="hiddenChar"><input type="text" value="🏒" readonly=""> <span>Ice Hockey</span></div>
			<div class="hiddenChar"><input type="text" value="🏓" readonly=""> <span>Ping Pong</span></div>
			<div class="hiddenChar"><input type="text" value="🏸" readonly=""> <span>Badminton</span></div>
			<div class="hiddenChar"><input type="text" value="🥊" readonly=""> <span>Boxing Glove</span></div>
			<div class="hiddenChar"><input type="text" value="🥋" readonly=""> <span>Martial Arts Uniform</span></div>
			<div class="hiddenChar"><input type="text" value="⛳" readonly=""> <span>Flag in Hole</span></div>
			<div class="hiddenChar"><input type="text" value="⛸" readonly=""> <span>Ice Skate</span></div>
			<div class="hiddenChar"><input type="text" value="🎣" readonly=""> <span>Fishing Pole</span></div>
			<div class="hiddenChar"><input type="text" value="🎽" readonly=""> <span>Running Shirt</span></div>
			<div class="hiddenChar"><input type="text" value="🎿" readonly=""> <span>Skis</span></div>
			<div class="hiddenChar"><input type="text" value="🛷" readonly=""> <span>Sled</span></div>
			<div class="hiddenChar"><input type="text" value="🥌" readonly=""> <span>Curling Stone</span></div>
			<div class="hiddenChar"><input type="text" value="🎯" readonly=""> <span>Direct Hit</span></div>
			<div class="hiddenChar"><input type="text" value="🎱" readonly=""> <span>Pool 8 Ball</span></div>
			<div class="hiddenChar"><input type="text" value="🎮" readonly=""> <span>Video Game</span></div>
			<div class="hiddenChar"><input type="text" value="🎰" readonly=""> <span>Slot Machine</span></div>
			<div class="hiddenChar"><input type="text" value="🎲" readonly=""> <span>Game Die</span></div>
			<div class="hiddenChar"><input type="text" value="🎭" readonly=""> <span>Performing Arts</span></div>
			<div class="hiddenChar"><input type="text" value="🎨" readonly=""> <span>Artist Palette</span></div>
			<div class="hiddenChar"><input type="text" value="🎼" readonly=""> <span>Musical Score</span></div>
			<div class="hiddenChar"><input type="text" value="🎤" readonly=""> <span>Microphone</span></div>
			<div class="hiddenChar"><input type="text" value="🎧" readonly=""> <span>Headphone</span></div>
			<div class="hiddenChar"><input type="text" value="🎷" readonly=""> <span>Saxophone</span></div>
			<div class="hiddenChar"><input type="text" value="🎸" readonly=""> <span>Guitar</span></div>
			<div class="hiddenChar"><input type="text" value="🎹" readonly=""> <span>Musical Keyboard</span></div>
			<div class="hiddenChar"><input type="text" value="🎺" readonly=""> <span>Trumpet</span></div>
			<div class="hiddenChar"><input type="text" value="🎻" readonly=""> <span>Violin</span></div>
			<div class="hiddenChar"><input type="text" value="🥁" readonly=""> <span>Drum</span></div>
			<div class="hiddenChar"><input type="text" value="🎬" readonly=""> <span>Clapper Board</span></div>
			<div class="hiddenChar"><input type="text" value="🏹" readonly=""> <span>Bow and Arrow</span></div>
		</div>
		<div class="emocat" data-name="Travel" id="emocat7">
			<div class="hiddenChar"><input type="text" value="🏖" readonly=""> <span>Beach With Umbrella</span></div>
			<div class="hiddenChar"><input type="text" value="🏎" readonly=""> <span>Racing Car</span></div>
			<div class="hiddenChar"><input type="text" value="🏍" readonly=""> <span>Motorcycle</span></div>
			<div class="hiddenChar"><input type="text" value="🗾" readonly=""> <span>Map of Japan</span></div>
			<div class="hiddenChar"><input type="text" value="🏔" readonly=""> <span>Snow-Capped Mountain</span></div>
			<div class="hiddenChar"><input type="text" value="⛰" readonly=""> <span>Mountain</span></div>
			<div class="hiddenChar"><input type="text" value="🌋" readonly=""> <span>Volcano</span></div>
			<div class="hiddenChar"><input type="text" value="🗻" readonly=""> <span>Mount Fuji</span></div>
			<div class="hiddenChar"><input type="text" value="🏕" readonly=""> <span>Camping</span></div>
			<div class="hiddenChar"><input type="text" value="🏜" readonly=""> <span>Desert</span></div>
			<div class="hiddenChar"><input type="text" value="🏝" readonly=""> <span>Desert Island</span></div>
			<div class="hiddenChar"><input type="text" value="🏞" readonly=""> <span>National Park</span></div>
			<div class="hiddenChar"><input type="text" value="🏟" readonly=""> <span>Stadium</span></div>
			<div class="hiddenChar"><input type="text" value="🏛" readonly=""> <span>Classical Building</span></div>
			<div class="hiddenChar"><input type="text" value="🏗" readonly=""> <span>Building Construction</span></div>
			<div class="hiddenChar"><input type="text" value="🏘" readonly=""> <span>Houses</span></div>
			<div class="hiddenChar"><input type="text" value="🏚" readonly=""> <span>Derelict House</span></div>
			<div class="hiddenChar"><input type="text" value="🏠" readonly=""> <span>House</span></div>
			<div class="hiddenChar"><input type="text" value="🏡" readonly=""> <span>House With Garden</span></div>
			<div class="hiddenChar"><input type="text" value="🏢" readonly=""> <span>Office Building</span></div>
			<div class="hiddenChar"><input type="text" value="🏣" readonly=""> <span>Japanese Post Office</span></div>
			<div class="hiddenChar"><input type="text" value="🏤" readonly=""> <span>Post Office</span></div>
			<div class="hiddenChar"><input type="text" value="🏥" readonly=""> <span>Hospital</span></div>
			<div class="hiddenChar"><input type="text" value="🏦" readonly=""> <span>Bank</span></div>
			<div class="hiddenChar"><input type="text" value="🏨" readonly=""> <span>Hotel</span></div>
			<div class="hiddenChar"><input type="text" value="🏩" readonly=""> <span>Love Hotel</span></div>
			<div class="hiddenChar"><input type="text" value="🏪" readonly=""> <span>Convenience Store</span></div>
			<div class="hiddenChar"><input type="text" value="🏫" readonly=""> <span>School</span></div>
			<div class="hiddenChar"><input type="text" value="🏬" readonly=""> <span>Department Store</span></div>
			<div class="hiddenChar"><input type="text" value="🏭" readonly=""> <span>Factory</span></div>
			<div class="hiddenChar"><input type="text" value="🏯" readonly=""> <span>Japanese Castle</span></div>
			<div class="hiddenChar"><input type="text" value="🏰" readonly=""> <span>Castle</span></div>
			<div class="hiddenChar"><input type="text" value="💒" readonly=""> <span>Wedding</span></div>
			<div class="hiddenChar"><input type="text" value="🗼" readonly=""> <span>Tokyo Tower</span></div>
			<div class="hiddenChar"><input type="text" value="🗽" readonly=""> <span>Statue of Liberty</span></div>
			<div class="hiddenChar"><input type="text" value="⛪" readonly=""> <span>Church</span></div>
			<div class="hiddenChar"><input type="text" value="🕌" readonly=""> <span>Mosque</span></div>
			<div class="hiddenChar"><input type="text" value="🕍" readonly=""> <span>Synagogue</span></div>
			<div class="hiddenChar"><input type="text" value="⛩" readonly=""> <span>Shinto Shrine</span></div>
			<div class="hiddenChar"><input type="text" value="🕋" readonly=""> <span>Kaaba</span></div>
			<div class="hiddenChar"><input type="text" value="⛲" readonly=""> <span>Fountain</span></div>
			<div class="hiddenChar"><input type="text" value="⛺" readonly=""> <span>Tent</span></div>
			<div class="hiddenChar"><input type="text" value="🌁" readonly=""> <span>Foggy</span></div>
			<div class="hiddenChar"><input type="text" value="🌃" readonly=""> <span>Night With Stars</span></div>
			<div class="hiddenChar"><input type="text" value="🏙" readonly=""> <span>Cityscape</span></div>
			<div class="hiddenChar"><input type="text" value="🌄" readonly=""> <span>Sunrise Over Mountains</span></div>
			<div class="hiddenChar"><input type="text" value="🌅" readonly=""> <span>Sunrise</span></div>
			<div class="hiddenChar"><input type="text" value="🌆" readonly=""> <span>Cityscape at Dusk</span></div>
			<div class="hiddenChar"><input type="text" value="🌇" readonly=""> <span>Sunset</span></div>
			<div class="hiddenChar"><input type="text" value="🌉" readonly=""> <span>Bridge at Night</span></div>
			<div class="hiddenChar"><input type="text" value="🌌" readonly=""> <span>Milky Way</span></div>
			<div class="hiddenChar"><input type="text" value="🎠" readonly=""> <span>Carousel Horse</span></div>
			<div class="hiddenChar"><input type="text" value="🎡" readonly=""> <span>Ferris Wheel</span></div>
			<div class="hiddenChar"><input type="text" value="🎢" readonly=""> <span>Roller Coaster</span></div>
			<div class="hiddenChar"><input type="text" value="🚂" readonly=""> <span>Locomotive</span></div>
			<div class="hiddenChar"><input type="text" value="🚃" readonly=""> <span>Railway Car</span></div>
			<div class="hiddenChar"><input type="text" value="🚄" readonly=""> <span>High-Speed Train</span></div>
			<div class="hiddenChar"><input type="text" value="🚅" readonly=""> <span>Bullet Train</span></div>
			<div class="hiddenChar"><input type="text" value="🚆" readonly=""> <span>Train</span></div>
			<div class="hiddenChar"><input type="text" value="🚇" readonly=""> <span>Metro</span></div>
			<div class="hiddenChar"><input type="text" value="🚈" readonly=""> <span>Light Rail</span></div>
			<div class="hiddenChar"><input type="text" value="🚉" readonly=""> <span>Station</span></div>
			<div class="hiddenChar"><input type="text" value="🚊" readonly=""> <span>Tram</span></div>
			<div class="hiddenChar"><input type="text" value="🚝" readonly=""> <span>Monorail</span></div>
			<div class="hiddenChar"><input type="text" value="🚞" readonly=""> <span>Mountain Railway</span></div>
			<div class="hiddenChar"><input type="text" value="🚋" readonly=""> <span>Tram Car</span></div>
			<div class="hiddenChar"><input type="text" value="🚌" readonly=""> <span>Bus</span></div>
			<div class="hiddenChar"><input type="text" value="🚍" readonly=""> <span>Oncoming Bus</span></div>
			<div class="hiddenChar"><input type="text" value="🚎" readonly=""> <span>Trolleybus</span></div>
			<div class="hiddenChar"><input type="text" value="🚐" readonly=""> <span>Minibus</span></div>
			<div class="hiddenChar"><input type="text" value="🚑" readonly=""> <span>Ambulance</span></div>
			<div class="hiddenChar"><input type="text" value="🚒" readonly=""> <span>Fire Engine</span></div>
			<div class="hiddenChar"><input type="text" value="🚓" readonly=""> <span>Police Car</span></div>
			<div class="hiddenChar"><input type="text" value="🚔" readonly=""> <span>Oncoming Police Car</span></div>
			<div class="hiddenChar"><input type="text" value="🚕" readonly=""> <span>Taxi</span></div>
			<div class="hiddenChar"><input type="text" value="🚖" readonly=""> <span>Oncoming Taxi</span></div>
			<div class="hiddenChar"><input type="text" value="🚗" readonly=""> <span>Automobile</span></div>
			<div class="hiddenChar"><input type="text" value="🚘" readonly=""> <span>Oncoming Automobile</span></div>
			<div class="hiddenChar"><input type="text" value="🚚" readonly=""> <span>Delivery Truck</span></div>
			<div class="hiddenChar"><input type="text" value="🚛" readonly=""> <span>Articulated Lorry</span></div>
			<div class="hiddenChar"><input type="text" value="🚜" readonly=""> <span>Tractor</span></div>
			<div class="hiddenChar"><input type="text" value="🚲" readonly=""> <span>Bicycle</span></div>
			<div class="hiddenChar"><input type="text" value="🛴" readonly=""> <span>Kick Scooter</span></div>
			<div class="hiddenChar"><input type="text" value="🛵" readonly=""> <span>Motor Scooter</span></div>
			<div class="hiddenChar"><input type="text" value="🚏" readonly=""> <span>Bus Stop</span></div>
			<div class="hiddenChar"><input type="text" value="🛤" readonly=""> <span>Railway Track</span></div>
			<div class="hiddenChar"><input type="text" value="⛽" readonly=""> <span>Fuel Pump</span></div>
			<div class="hiddenChar"><input type="text" value="🚨" readonly=""> <span>Police Car Light</span></div>
			<div class="hiddenChar"><input type="text" value="⛵" readonly=""> <span>Sailboat</span></div>
			<div class="hiddenChar"><input type="text" value="🚤" readonly=""> <span>Speedboat</span></div>
			<div class="hiddenChar"><input type="text" value="🛳" readonly=""> <span>Passenger Ship</span></div>
			<div class="hiddenChar"><input type="text" value="⛴" readonly=""> <span>Ferry</span></div>
			<div class="hiddenChar"><input type="text" value="🛥" readonly=""> <span>Motor Boat</span></div>
			<div class="hiddenChar"><input type="text" value="🚢" readonly=""> <span>Ship</span></div>
			<div class="hiddenChar"><input type="text" value="✈" readonly=""> <span>Airplane</span></div>
			<div class="hiddenChar"><input type="text" value="🛩" readonly=""> <span>Small Airplane</span></div>
			<div class="hiddenChar"><input type="text" value="🛫" readonly=""> <span>Airplane Departure</span></div>
			<div class="hiddenChar"><input type="text" value="🛬" readonly=""> <span>Airplane Arrival</span></div>
			<div class="hiddenChar"><input type="text" value="💺" readonly=""> <span>Seat</span></div>
			<div class="hiddenChar"><input type="text" value="🚁" readonly=""> <span>Helicopter</span></div>
			<div class="hiddenChar"><input type="text" value="🚟" readonly=""> <span>Suspension Railway</span></div>
			<div class="hiddenChar"><input type="text" value="🚠" readonly=""> <span>Mountain Cableway</span></div>
			<div class="hiddenChar"><input type="text" value="🚡" readonly=""> <span>Aerial Tramway</span></div>
			<div class="hiddenChar"><input type="text" value="🛰" readonly=""> <span>Satellite</span></div>
			<div class="hiddenChar"><input type="text" value="🚀" readonly=""> <span>Rocket</span></div>
			<div class="hiddenChar"><input type="text" value="🛸" readonly=""> <span>Flying Saucer</span></div>
			<div class="hiddenChar"><input type="text" value="⛱" readonly=""> <span>Umbrella on the Beach</span></div>
			<div class="hiddenChar"><input type="text" value="🎆" readonly=""> <span>Fireworks</span></div>
			<div class="hiddenChar"><input type="text" value="🎇" readonly=""> <span>Sparkler</span></div>
			<div class="hiddenChar"><input type="text" value="🎑" readonly=""> <span>Moon Viewing Ceremony</span></div>
			<div class="hiddenChar"><input type="text" value="🗿" readonly=""> <span>Moai Statue</span></div>
			<div class="hiddenChar"><input type="text" value="🛂" readonly=""> <span>Passport Control</span></div>
			<div class="hiddenChar"><input type="text" value="🛃" readonly=""> <span>Customs</span></div>
			<div class="hiddenChar"><input type="text" value="🛄" readonly=""> <span>Baggage Claim</span></div>
			<div class="hiddenChar"><input type="text" value="🛅" readonly=""> <span>Left Luggage</span></div>
		</div>
		<div class="emocat" data-name="Objects" id="emocat8">
			<div class="hiddenChar"><input type="text" value="💎" readonly=""> <span>Gem Stone</span></div>
			<div class="hiddenChar"><input type="text" value="👓" readonly=""> <span>Glasses</span></div>
			<div class="hiddenChar"><input type="text" value="🕶" readonly=""> <span>Sunglasses</span></div>
			<div class="hiddenChar"><input type="text" value="👔" readonly=""> <span>Necktie</span></div>
			<div class="hiddenChar"><input type="text" value="👕" readonly=""> <span>T-Shirt</span></div>
			<div class="hiddenChar"><input type="text" value="👖" readonly=""> <span>Jeans</span></div>
			<div class="hiddenChar"><input type="text" value="🧣" readonly=""> <span>Scarf</span></div>
			<div class="hiddenChar"><input type="text" value="🧤" readonly=""> <span>Gloves</span></div>
			<div class="hiddenChar"><input type="text" value="🧥" readonly=""> <span>Coat</span></div>
			<div class="hiddenChar"><input type="text" value="🧦" readonly=""> <span>Socks</span></div>
			<div class="hiddenChar"><input type="text" value="👗" readonly=""> <span>Dress</span></div>
			<div class="hiddenChar"><input type="text" value="👘" readonly=""> <span>Kimono</span></div>
			<div class="hiddenChar"><input type="text" value="👙" readonly=""> <span>Bikini</span></div>
			<div class="hiddenChar"><input type="text" value="👚" readonly=""> <span>Woman’s Clothes</span></div>
			<div class="hiddenChar"><input type="text" value="👛" readonly=""> <span>Purse</span></div>
			<div class="hiddenChar"><input type="text" value="👜" readonly=""> <span>Handbag</span></div>
			<div class="hiddenChar"><input type="text" value="👝" readonly=""> <span>Clutch Bag</span></div>
			<div class="hiddenChar"><input type="text" value="🎒" readonly=""> <span>School Backpack</span></div>
			<div class="hiddenChar"><input type="text" value="👞" readonly=""> <span>Man’s Shoe</span></div>
			<div class="hiddenChar"><input type="text" value="👟" readonly=""> <span>Running Shoe</span></div>
			<div class="hiddenChar"><input type="text" value="👠" readonly=""> <span>High-Heeled Shoe</span></div>
			<div class="hiddenChar"><input type="text" value="👡" readonly=""> <span>Woman’s Sandal</span></div>
			<div class="hiddenChar"><input type="text" value="👢" readonly=""> <span>Woman’s Boot</span></div>
			<div class="hiddenChar"><input type="text" value="👑" readonly=""> <span>Crown</span></div>
			<div class="hiddenChar"><input type="text" value="👒" readonly=""> <span>Woman’s Hat</span></div>
			<div class="hiddenChar"><input type="text" value="🎩" readonly=""> <span>Top Hat</span></div>
			<div class="hiddenChar"><input type="text" value="🎓" readonly=""> <span>Graduation Cap</span></div>
			<div class="hiddenChar"><input type="text" value="🧢" readonly=""> <span>Billed Cap</span></div>
			<div class="hiddenChar"><input type="text" value="⛑" readonly=""> <span>Rescue Worker’s Helmet</span></div>
			<div class="hiddenChar"><input type="text" value="💄" readonly=""> <span>Lipstick</span></div>
			<div class="hiddenChar"><input type="text" value="💍" readonly=""> <span>Ring</span></div>
			<div class="hiddenChar"><input type="text" value="🌂" readonly=""> <span>Closed Umbrella</span></div>
			<div class="hiddenChar"><input type="text" value="☂" readonly=""> <span>Umbrella</span></div>
			<div class="hiddenChar"><input type="text" value="💼" readonly=""> <span>Briefcase</span></div>
			<div class="hiddenChar"><input type="text" value="☠" readonly=""> <span>Skull and Crossbones</span></div>
			<div class="hiddenChar"><input type="text" value="🛀" readonly=""> <span>Person Taking Bath</span></div>
			<div class="hiddenChar"><input type="text" value="🛌" readonly=""> <span>Person in Bed</span></div>
			<div class="hiddenChar"><input type="text" value="💌" readonly=""> <span>Love Letter</span></div>
			<div class="hiddenChar"><input type="text" value="💣" readonly=""> <span>Bomb</span></div>
			<div class="hiddenChar"><input type="text" value="🚥" readonly=""> <span>Horizontal Traffic Light</span></div>
			<div class="hiddenChar"><input type="text" value="🚦" readonly=""> <span>Vertical Traffic Light</span></div>
			<div class="hiddenChar"><input type="text" value="🚧" readonly=""> <span>Construction</span></div>
			<div class="hiddenChar"><input type="text" value="⚓" readonly=""> <span>Anchor</span></div>
			<div class="hiddenChar"><input type="text" value="🕳" readonly=""> <span>Hole</span></div>
			<div class="hiddenChar"><input type="text" value="🛍" readonly=""> <span>Shopping Bags</span></div>
			<div class="hiddenChar"><input type="text" value="📿" readonly=""> <span>Prayer Beads</span></div>
			<div class="hiddenChar"><input type="text" value="🔪" readonly=""> <span>Kitchen Knife</span></div>
			<div class="hiddenChar"><input type="text" value="🏺" readonly=""> <span>Amphora</span></div>
			<div class="hiddenChar"><input type="text" value="🗺" readonly=""> <span>World Map</span></div>
			<div class="hiddenChar"><input type="text" value="💈" readonly=""> <span>Barber Pole</span></div>
			<div class="hiddenChar"><input type="text" value="🛢" readonly=""> <span>Oil Drum</span></div>
			<div class="hiddenChar"><input type="text" value="🛎" readonly=""> <span>Bellhop Bell</span></div>
			<div class="hiddenChar"><input type="text" value="⌛" readonly=""> <span>Hourglass Done</span></div>
			<div class="hiddenChar"><input type="text" value="⏳" readonly=""> <span>Hourglass Not Done</span></div>
			<div class="hiddenChar"><input type="text" value="⌚" readonly=""> <span>Watch</span></div>
			<div class="hiddenChar"><input type="text" value="⏰" readonly=""> <span>Alarm Clock</span></div>
			<div class="hiddenChar"><input type="text" value="⏱" readonly=""> <span>Stopwatch</span></div>
			<div class="hiddenChar"><input type="text" value="⏲" readonly=""> <span>Timer Clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕰" readonly=""> <span>Mantelpiece Clock</span></div>
			<div class="hiddenChar"><input type="text" value="🌡" readonly=""> <span>Thermometer</span></div>
			<div class="hiddenChar"><input type="text" value="🎈" readonly=""> <span>Balloon</span></div>
			<div class="hiddenChar"><input type="text" value="🎉" readonly=""> <span>Party Popper</span></div>
			<div class="hiddenChar"><input type="text" value="🎊" readonly=""> <span>Confetti Ball</span></div>
			<div class="hiddenChar"><input type="text" value="🎎" readonly=""> <span>Japanese Dolls</span></div>
			<div class="hiddenChar"><input type="text" value="🎏" readonly=""> <span>Carp Streamer</span></div>
			<div class="hiddenChar"><input type="text" value="🎐" readonly=""> <span>Wind Chime</span></div>
			<div class="hiddenChar"><input type="text" value="🎀" readonly=""> <span>Ribbon</span></div>
			<div class="hiddenChar"><input type="text" value="🎁" readonly=""> <span>Wrapped Gift</span></div>
			<div class="hiddenChar"><input type="text" value="🔮" readonly=""> <span>Crystal Ball</span></div>
			<div class="hiddenChar"><input type="text" value="🕹" readonly=""> <span>Joystick</span></div>
			<div class="hiddenChar"><input type="text" value="🖼" readonly=""> <span>Framed Picture</span></div>
			<div class="hiddenChar"><input type="text" value="🎙" readonly=""> <span>Studio Microphone</span></div>
			<div class="hiddenChar"><input type="text" value="🎚" readonly=""> <span>Level Slider</span></div>
			<div class="hiddenChar"><input type="text" value="🎛" readonly=""> <span>Control Knobs</span></div>
			<div class="hiddenChar"><input type="text" value="📻" readonly=""> <span>Radio</span></div>
			<div class="hiddenChar"><input type="text" value="📱" readonly=""> <span>Mobile Phone</span></div>
			<div class="hiddenChar"><input type="text" value="📲" readonly=""> <span>Mobile Phone With Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="☎" readonly=""> <span>Telephone</span></div>
			<div class="hiddenChar"><input type="text" value="📞" readonly=""> <span>Telephone Receiver</span></div>
			<div class="hiddenChar"><input type="text" value="📟" readonly=""> <span>Pager</span></div>
			<div class="hiddenChar"><input type="text" value="📠" readonly=""> <span>Fax Machine</span></div>
			<div class="hiddenChar"><input type="text" value="🔋" readonly=""> <span>Battery</span></div>
			<div class="hiddenChar"><input type="text" value="🔌" readonly=""> <span>Electric Plug</span></div>
			<div class="hiddenChar"><input type="text" value="💻" readonly=""> <span>Laptop Computer</span></div>
			<div class="hiddenChar"><input type="text" value="🖥" readonly=""> <span>Desktop Computer</span></div>
			<div class="hiddenChar"><input type="text" value="🖨" readonly=""> <span>Printer</span></div>
			<div class="hiddenChar"><input type="text" value="⌨" readonly=""> <span>Keyboard</span></div>
			<div class="hiddenChar"><input type="text" value="🖱" readonly=""> <span>Computer Mouse</span></div>
			<div class="hiddenChar"><input type="text" value="🖲" readonly=""> <span>Trackball</span></div>
			<div class="hiddenChar"><input type="text" value="💽" readonly=""> <span>Computer Disk</span></div>
			<div class="hiddenChar"><input type="text" value="💾" readonly=""> <span>Floppy Disk</span></div>
			<div class="hiddenChar"><input type="text" value="💿" readonly=""> <span>Optical Disk</span></div>
			<div class="hiddenChar"><input type="text" value="📀" readonly=""> <span>DVD</span></div>
			<div class="hiddenChar"><input type="text" value="🎥" readonly=""> <span>Movie Camera</span></div>
			<div class="hiddenChar"><input type="text" value="🎞" readonly=""> <span>Film Frames</span></div>
			<div class="hiddenChar"><input type="text" value="📽" readonly=""> <span>Film Projector</span></div>
			<div class="hiddenChar"><input type="text" value="📺" readonly=""> <span>Television</span></div>
			<div class="hiddenChar"><input type="text" value="📷" readonly=""> <span>Camera</span></div>
			<div class="hiddenChar"><input type="text" value="📸" readonly=""> <span>Camera With Flash</span></div>
			<div class="hiddenChar"><input type="text" value="📹" readonly=""> <span>Video Camera</span></div>
			<div class="hiddenChar"><input type="text" value="📼" readonly=""> <span>Videocassette</span></div>
			<div class="hiddenChar"><input type="text" value="🔍" readonly=""> <span>Magnifying Glass Tilted Left</span></div>
			<div class="hiddenChar"><input type="text" value="🔎" readonly=""> <span>Magnifying Glass Tilted Right</span></div>
			<div class="hiddenChar"><input type="text" value="🕯" readonly=""> <span>Candle</span></div>
			<div class="hiddenChar"><input type="text" value="💡" readonly=""> <span>Light Bulb</span></div>
			<div class="hiddenChar"><input type="text" value="🔦" readonly=""> <span>Flashlight</span></div>
			<div class="hiddenChar"><input type="text" value="🏮" readonly=""> <span>Red Paper Lantern</span></div>
			<div class="hiddenChar"><input type="text" value="📔" readonly=""> <span>Notebook With Decorative Cover</span></div>
			<div class="hiddenChar"><input type="text" value="📕" readonly=""> <span>Closed Book</span></div>
			<div class="hiddenChar"><input type="text" value="📖" readonly=""> <span>Open Book</span></div>
			<div class="hiddenChar"><input type="text" value="📗" readonly=""> <span>Green Book</span></div>
			<div class="hiddenChar"><input type="text" value="📘" readonly=""> <span>Blue Book</span></div>
			<div class="hiddenChar"><input type="text" value="📙" readonly=""> <span>Orange Book</span></div>
			<div class="hiddenChar"><input type="text" value="📚" readonly=""> <span>Books</span></div>
			<div class="hiddenChar"><input type="text" value="📓" readonly=""> <span>Notebook</span></div>
			<div class="hiddenChar"><input type="text" value="📃" readonly=""> <span>Page With Curl</span></div>
			<div class="hiddenChar"><input type="text" value="📜" readonly=""> <span>Scroll</span></div>
			<div class="hiddenChar"><input type="text" value="📄" readonly=""> <span>Page Facing Up</span></div>
			<div class="hiddenChar"><input type="text" value="📰" readonly=""> <span>Newspaper</span></div>
			<div class="hiddenChar"><input type="text" value="🗞" readonly=""> <span>Rolled-Up Newspaper</span></div>
			<div class="hiddenChar"><input type="text" value="📑" readonly=""> <span>Bookmark Tabs</span></div>
			<div class="hiddenChar"><input type="text" value="🔖" readonly=""> <span>Bookmark</span></div>
			<div class="hiddenChar"><input type="text" value="🏷" readonly=""> <span>Label</span></div>
			<div class="hiddenChar"><input type="text" value="💰" readonly=""> <span>Money Bag</span></div>
			<div class="hiddenChar"><input type="text" value="💸" readonly=""> <span>Money With Wings</span></div>
			<div class="hiddenChar"><input type="text" value="💳" readonly=""> <span>Credit Card</span></div>
			<div class="hiddenChar"><input type="text" value="✉" readonly=""> <span>Envelope</span></div>
			<div class="hiddenChar"><input type="text" value="📧" readonly=""> <span>E-Mail</span></div>
			<div class="hiddenChar"><input type="text" value="📨" readonly=""> <span>Incoming Envelope</span></div>
			<div class="hiddenChar"><input type="text" value="📩" readonly=""> <span>Envelope With Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="📤" readonly=""> <span>Outbox Tray</span></div>
			<div class="hiddenChar"><input type="text" value="📥" readonly=""> <span>Inbox Tray</span></div>
			<div class="hiddenChar"><input type="text" value="📦" readonly=""> <span>Package</span></div>
			<div class="hiddenChar"><input type="text" value="📫" readonly=""> <span>Closed Mailbox With Raised Flag</span></div>
			<div class="hiddenChar"><input type="text" value="📪" readonly=""> <span>Closed Mailbox With Lowered Flag</span></div>
			<div class="hiddenChar"><input type="text" value="📬" readonly=""> <span>Open Mailbox With Raised Flag</span></div>
			<div class="hiddenChar"><input type="text" value="📭" readonly=""> <span>Open Mailbox With Lowered Flag</span></div>
			<div class="hiddenChar"><input type="text" value="📮" readonly=""> <span>Postbox</span></div>
			<div class="hiddenChar"><input type="text" value="🗳" readonly=""> <span>Ballot Box With Ballot</span></div>
			<div class="hiddenChar"><input type="text" value="✏" readonly=""> <span>Pencil</span></div>
			<div class="hiddenChar"><input type="text" value="✎" readonly=""> <span>Pencil</span></div>
			<div class="hiddenChar"><input type="text" value="🖉" readonly=""> <span>Pencil</span></div>
			<div class="hiddenChar"><input type="text" value="✒" readonly=""> <span>Black Nib</span></div>
			<div class="hiddenChar"><input type="text" value="🖋" readonly=""> <span>Fountain Pen</span></div>
			<div class="hiddenChar"><input type="text" value="🖊" readonly=""> <span>Pen</span></div>
			<div class="hiddenChar"><input type="text" value="🖌" readonly=""> <span>Paintbrush</span></div>
			<div class="hiddenChar"><input type="text" value="🖍" readonly=""> <span>Crayon</span></div>
			<div class="hiddenChar"><input type="text" value="📝" readonly=""> <span>Memo</span></div>
			<div class="hiddenChar"><input type="text" value="📁" readonly=""> <span>File Folder</span></div>
			<div class="hiddenChar"><input type="text" value="📂" readonly=""> <span>Open File Folder</span></div>
			<div class="hiddenChar"><input type="text" value="🗂" readonly=""> <span>Card Index Dividers</span></div>
			<div class="hiddenChar"><input type="text" value="📅" readonly=""> <span>Calendar</span></div>
			<div class="hiddenChar"><input type="text" value="📆" readonly=""> <span>Tear-Off Calendar</span></div>
			<div class="hiddenChar"><input type="text" value="🗒" readonly=""> <span>Spiral Notepad</span></div>
			<div class="hiddenChar"><input type="text" value="🗓" readonly=""> <span>Spiral Calendar</span></div>
			<div class="hiddenChar"><input type="text" value="📇" readonly=""> <span>Card Index</span></div>
			<div class="hiddenChar"><input type="text" value="📈" readonly=""> <span>Chart Increasing</span></div>
			<div class="hiddenChar"><input type="text" value="📉" readonly=""> <span>Chart Decreasing</span></div>
			<div class="hiddenChar"><input type="text" value="📊" readonly=""> <span>Bar Chart</span></div>
			<div class="hiddenChar"><input type="text" value="📋" readonly=""> <span>Clipboard</span></div>
			<div class="hiddenChar"><input type="text" value="📌" readonly=""> <span>Pushpin</span></div>
			<div class="hiddenChar"><input type="text" value="📍" readonly=""> <span>Round Pushpin</span></div>
			<div class="hiddenChar"><input type="text" value="📎" readonly=""> <span>Paperclip</span></div>
			<div class="hiddenChar"><input type="text" value="🖇" readonly=""> <span>Linked Paperclips</span></div>
			<div class="hiddenChar"><input type="text" value="📏" readonly=""> <span>Straight Ruler</span></div>
			<div class="hiddenChar"><input type="text" value="📐" readonly=""> <span>Triangular Ruler</span></div>
			<div class="hiddenChar"><input type="text" value="✂" readonly=""> <span>Scissors</span></div>
			<div class="hiddenChar"><input type="text" value="🗃" readonly=""> <span>Card File Box</span></div>
			<div class="hiddenChar"><input type="text" value="🗄" readonly=""> <span>File Cabinet</span></div>
			<div class="hiddenChar"><input type="text" value="🗑" readonly=""> <span>Wastebasket</span></div>
			<div class="hiddenChar"><input type="text" value="🔒" readonly=""> <span>Locked</span></div>
			<div class="hiddenChar"><input type="text" value="🔓" readonly=""> <span>Unlocked</span></div>
			<div class="hiddenChar"><input type="text" value="🔏" readonly=""> <span>Locked With Pen</span></div>
			<div class="hiddenChar"><input type="text" value="🔐" readonly=""> <span>Locked With Key</span></div>
			<div class="hiddenChar"><input type="text" value="🔑" readonly=""> <span>Key</span></div>
			<div class="hiddenChar"><input type="text" value="🗝" readonly=""> <span>Old Key</span></div>
			<div class="hiddenChar"><input type="text" value="🔨" readonly=""> <span>Hammer</span></div>
			<div class="hiddenChar"><input type="text" value="⛏" readonly=""> <span>Pick</span></div>
			<div class="hiddenChar"><input type="text" value="⚒" readonly=""> <span>Hammer and Pick</span></div>
			<div class="hiddenChar"><input type="text" value="🛠" readonly=""> <span>Hammer and Wrench</span></div>
			<div class="hiddenChar"><input type="text" value="🗡" readonly=""> <span>Dagger</span></div>
			<div class="hiddenChar"><input type="text" value="⚔" readonly=""> <span>Crossed Swords</span></div>
			<div class="hiddenChar"><input type="text" value="🔫" readonly=""> <span>Pistol</span></div>
			<div class="hiddenChar"><input type="text" value="🛡" readonly=""> <span>Shield</span></div>
			<div class="hiddenChar"><input type="text" value="🔧" readonly=""> <span>Wrench</span></div>
			<div class="hiddenChar"><input type="text" value="🔩" readonly=""> <span>Nut and Bolt</span></div>
			<div class="hiddenChar"><input type="text" value="⚙" readonly=""> <span>Gear</span></div>
			<div class="hiddenChar"><input type="text" value="🗜" readonly=""> <span>Clamp</span></div>
			<div class="hiddenChar"><input type="text" value="⚖" readonly=""> <span>Balance Scale</span></div>
			<div class="hiddenChar"><input type="text" value="🔗" readonly=""> <span>Link</span></div>
			<div class="hiddenChar"><input type="text" value="⛓" readonly=""> <span>Chains</span></div>
			<div class="hiddenChar"><input type="text" value="⚗" readonly=""> <span>Alembic</span></div>
			<div class="hiddenChar"><input type="text" value="🔬" readonly=""> <span>Microscope</span></div>
			<div class="hiddenChar"><input type="text" value="🔭" readonly=""> <span>Telescope</span></div>
			<div class="hiddenChar"><input type="text" value="📡" readonly=""> <span>Satellite Antenna</span></div>
			<div class="hiddenChar"><input type="text" value="💉" readonly=""> <span>Syringe</span></div>
			<div class="hiddenChar"><input type="text" value="💊" readonly=""> <span>Pill</span></div>
			<div class="hiddenChar"><input type="text" value="🚪" readonly=""> <span>Door</span></div>
			<div class="hiddenChar"><input type="text" value="🛏" readonly=""> <span>Bed</span></div>
			<div class="hiddenChar"><input type="text" value="🛋" readonly=""> <span>Couch and Lamp</span></div>
			<div class="hiddenChar"><input type="text" value="🚽" readonly=""> <span>Toilet</span></div>
			<div class="hiddenChar"><input type="text" value="🚿" readonly=""> <span>Shower</span></div>
			<div class="hiddenChar"><input type="text" value="🛁" readonly=""> <span>Bathtub</span></div>
			<div class="hiddenChar"><input type="text" value="🚬" readonly=""> <span>Cigarette</span></div>
			<div class="hiddenChar"><input type="text" value="⚰" readonly=""> <span>Coffin</span></div>
			<div class="hiddenChar"><input type="text" value="⚱" readonly=""> <span>Funeral Urn</span></div>
			<div class="hiddenChar"><input type="text" value="💘" readonly=""> <span>Heart With Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="❤" readonly=""> <span>Red Heart</span></div>
			<div class="hiddenChar"><input type="text" value="💓" readonly=""> <span>Beating Heart</span></div>
			<div class="hiddenChar"><input type="text" value="💔" readonly=""> <span>Broken Heart</span></div>
			<div class="hiddenChar"><input type="text" value="💕" readonly=""> <span>Two Hearts</span></div>
			<div class="hiddenChar"><input type="text" value="💖" readonly=""> <span>Sparkling Heart</span></div>
			<div class="hiddenChar"><input type="text" value="💗" readonly=""> <span>Growing Heart</span></div>
			<div class="hiddenChar"><input type="text" value="💙" readonly=""> <span>Blue Heart</span></div>
			<div class="hiddenChar"><input type="text" value="💚" readonly=""> <span>Green Heart</span></div>
			<div class="hiddenChar"><input type="text" value="💛" readonly=""> <span>Yellow Heart</span></div>
			<div class="hiddenChar"><input type="text" value="🧡" readonly=""> <span>Orange Heart</span></div>
			<div class="hiddenChar"><input type="text" value="💜" readonly=""> <span>Purple Heart</span></div>
			<div class="hiddenChar"><input type="text" value="🖤" readonly=""> <span>Black Heart</span></div>
			<div class="hiddenChar"><input type="text" value="💝" readonly=""> <span>Heart With Ribbon</span></div>
			<div class="hiddenChar"><input type="text" value="💞" readonly=""> <span>Revolving Hearts</span></div>
			<div class="hiddenChar"><input type="text" value="💟" readonly=""> <span>Heart Decoration</span></div>
			<div class="hiddenChar"><input type="text" value="❣" readonly=""> <span>Heavy Heart Exclamation</span></div>
			<div class="hiddenChar"><input type="text" value="💦" readonly=""> <span>Sweat Droplets</span></div>
			<div class="hiddenChar"><input type="text" value="💨" readonly=""> <span>Dashing Away</span></div>
			<div class="hiddenChar"><input type="text" value="💫" readonly=""> <span>Dizzy Stars</span></div>
			<div class="hiddenChar"><input type="text" value="🏁" readonly=""> <span>Chequered Flag</span></div>
			<div class="hiddenChar"><input type="text" value="🚩" readonly=""> <span>Triangular Flag</span></div>
			<div class="hiddenChar"><input type="text" value="🎌" readonly=""> <span>Crossed Flags</span></div>
			<div class="hiddenChar"><input type="text" value="🏴" readonly=""> <span>Black Flag</span></div>
			<div class="hiddenChar"><input type="text" value="🏳" readonly=""> <span>White Flag</span></div>
			<div class="hiddenChar"><input type="text" value="🏳️&zwj;🌈" readonly=""> <span>Rainbow Flag</span></div>
			<div class="hiddenChar"><input type="text" value="🏴&zwj;☠️" readonly=""> <span>Pirate Flag</span></div>
		</div>
		<div class="emocat" data-name="Symbols" id="emocat9">
			<div class="hiddenChar"><input type="text" value="👍" readonly=""> <span>Thumbs Up</span></div>
			<div class="hiddenChar"><input type="text" value="👎" readonly=""> <span>Thumbs Down</span></div>
			<div class="hiddenChar"><input type="text" value="💪" readonly=""> <span>Flexed Biceps</span></div>
			<div class="hiddenChar"><input type="text" value="🤳" readonly=""> <span>Selfie</span></div>
			<div class="hiddenChar"><input type="text" value="👈" readonly=""> <span>Backhand Index Pointing Left</span></div>
			<div class="hiddenChar"><input type="text" value="👉" readonly=""> <span>Backhand Index Pointing Right</span></div>
			<div class="hiddenChar"><input type="text" value="☝" readonly=""> <span>Index Pointing Up</span></div>
			<div class="hiddenChar"><input type="text" value="👆" readonly=""> <span>Backhand Index Pointing Up</span></div>
			<div class="hiddenChar"><input type="text" value="🖕" readonly=""> <span>Middle Finger</span></div>
			<div class="hiddenChar"><input type="text" value="👇" readonly=""> <span>Backhand Index Pointing Down</span></div>
			<div class="hiddenChar"><input type="text" value="✌" readonly=""> <span>Victory Hand</span></div>
			<div class="hiddenChar"><input type="text" value="🤞" readonly=""> <span>Crossed Fingers</span></div>
			<div class="hiddenChar"><input type="text" value="🖖" readonly=""> <span>Vulcan Salute</span></div>
			<div class="hiddenChar"><input type="text" value="🤘" readonly=""> <span>Sign of the Horns</span></div>
			<div class="hiddenChar"><input type="text" value="🖐" readonly=""> <span>Hand With Fingers Splayed</span></div>
			<div class="hiddenChar"><input type="text" value="✋" readonly=""> <span>Raised Hand</span></div>
			<div class="hiddenChar"><input type="text" value="👌" readonly=""> <span>OK Hand</span></div>
			<div class="hiddenChar"><input type="text" value="✊" readonly=""> <span>Raised Fist</span></div>
			<div class="hiddenChar"><input type="text" value="👊" readonly=""> <span>Oncoming Fist</span></div>
			<div class="hiddenChar"><input type="text" value="🤛" readonly=""> <span>Left-Facing Fist</span></div>
			<div class="hiddenChar"><input type="text" value="🤜" readonly=""> <span>Right-Facing Fist</span></div>
			<div class="hiddenChar"><input type="text" value="🤚" readonly=""> <span>Raised Back of Hand</span></div>
			<div class="hiddenChar"><input type="text" value="👋" readonly=""> <span>Waving Hand</span></div>
			<div class="hiddenChar"><input type="text" value="🤟" readonly=""> <span>Love-You Gesture</span></div>
			<div class="hiddenChar"><input type="text" value="✍" readonly=""> <span>Writing Hand</span></div>
			<div class="hiddenChar"><input type="text" value="👏" readonly=""> <span>Clapping Hands</span></div>
			<div class="hiddenChar"><input type="text" value="👐" readonly=""> <span>Open Hands</span></div>
			<div class="hiddenChar"><input type="text" value="🙌" readonly=""> <span>Raising Hands</span></div>
			<div class="hiddenChar"><input type="text" value="🤲" readonly=""> <span>Palms Up Together</span></div>
			<div class="hiddenChar"><input type="text" value="🙏" readonly=""> <span>Folded Hands</span></div>
			<div class="hiddenChar"><input type="text" value="🤝" readonly=""> <span>Handshake</span></div>
			<div class="hiddenChar"><input type="text" value="💅" readonly=""> <span>Nail Polish</span></div>
			<div class="hiddenChar"><input type="text" value="👂" readonly=""> <span>Ear</span></div>
			<div class="hiddenChar"><input type="text" value="👃" readonly=""> <span>Nose</span></div>
			<div class="hiddenChar"><input type="text" value="⚕️" readonly=""> <span>Aesculapius: pharmacy, medical</span></div>
			<div class="hiddenChar"><input type="text" value="👣" readonly=""> <span>Footprints</span></div>
			<div class="hiddenChar"><input type="text" value="👀" readonly=""> <span>Eyes</span></div>
			<div class="hiddenChar"><input type="text" value="👁" readonly=""> <span>Eye</span></div>
			<div class="hiddenChar"><input type="text" value="🧠" readonly=""> <span>Brain</span></div>
			<div class="hiddenChar"><input type="text" value="👅" readonly=""> <span>Tongue</span></div>
			<div class="hiddenChar"><input type="text" value="👄" readonly=""> <span>Mouth</span></div>
			<div class="hiddenChar"><input type="text" value="💋" readonly=""> <span>Kiss Mark</span></div>
			<div class="hiddenChar"><input type="text" value="👁️&zwj;🗨️" readonly=""> <span>Eye in Speech Bubble</span></div>
			<div class="hiddenChar"><input type="text" value="💤" readonly=""> <span>Zzz</span></div>
			<div class="hiddenChar"><input type="text" value="💢" readonly=""> <span>Anger Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="💬" readonly=""> <span>Speech Balloon</span></div>
			<div class="hiddenChar"><input type="text" value="🗯" readonly=""> <span>Right Anger Bubble</span></div>
			<div class="hiddenChar"><input type="text" value="💭" readonly=""> <span>Thought Balloon</span></div>
			<div class="hiddenChar"><input type="text" value="♨" readonly=""> <span>Hot Springs</span></div>
			<div class="hiddenChar"><input type="text" value="🛑" readonly=""> <span>Stop Sign</span></div>
			<div class="hiddenChar"><input type="text" value="🕛" readonly=""> <span>Twelve O’clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕧" readonly=""> <span>Twelve-Thirty</span></div>
			<div class="hiddenChar"><input type="text" value="🕐" readonly=""> <span>One O’clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕜" readonly=""> <span>One-Thirty</span></div>
			<div class="hiddenChar"><input type="text" value="🕑" readonly=""> <span>Two O’clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕝" readonly=""> <span>Two-Thirty</span></div>
			<div class="hiddenChar"><input type="text" value="🕒" readonly=""> <span>Three O’clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕞" readonly=""> <span>Three-Thirty</span></div>
			<div class="hiddenChar"><input type="text" value="🕓" readonly=""> <span>Four O’clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕟" readonly=""> <span>Four-Thirty</span></div>
			<div class="hiddenChar"><input type="text" value="🕔" readonly=""> <span>Five O’clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕠" readonly=""> <span>Five-Thirty</span></div>
			<div class="hiddenChar"><input type="text" value="🕕" readonly=""> <span>Six O’clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕡" readonly=""> <span>Six-Thirty</span></div>
			<div class="hiddenChar"><input type="text" value="🕖" readonly=""> <span>Seven O’clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕢" readonly=""> <span>Seven-Thirty</span></div>
			<div class="hiddenChar"><input type="text" value="🕗" readonly=""> <span>Eight O’clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕣" readonly=""> <span>Eight-Thirty</span></div>
			<div class="hiddenChar"><input type="text" value="🕘" readonly=""> <span>Nine O’clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕤" readonly=""> <span>Nine-Thirty</span></div>
			<div class="hiddenChar"><input type="text" value="🕙" readonly=""> <span>Ten O’clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕥" readonly=""> <span>Ten-Thirty</span></div>
			<div class="hiddenChar"><input type="text" value="🕚" readonly=""> <span>Eleven O’clock</span></div>
			<div class="hiddenChar"><input type="text" value="🕦" readonly=""> <span>Eleven-Thirty</span></div>
			<div class="hiddenChar"><input type="text" value="🌀" readonly=""> <span>Cyclone</span></div>
			<div class="hiddenChar"><input type="text" value="🃏" readonly=""> <span>Joker</span></div>
			<div class="hiddenChar"><input type="text" value="🀄" readonly=""> <span>Mahjong Red Dragon</span></div>
			<div class="hiddenChar"><input type="text" value="🎴" readonly=""> <span>Flower Playing Cards</span></div>
			<div class="hiddenChar"><input type="text" value="🔇" readonly=""> <span>Muted Speaker</span></div>
			<div class="hiddenChar"><input type="text" value="🔈" readonly=""> <span>Speaker Low Volume</span></div>
			<div class="hiddenChar"><input type="text" value="🔉" readonly=""> <span>Speaker Medium Volume</span></div>
			<div class="hiddenChar"><input type="text" value="🔊" readonly=""> <span>Speaker High Volume</span></div>
			<div class="hiddenChar"><input type="text" value="📢" readonly=""> <span>Loudspeaker</span></div>
			<div class="hiddenChar"><input type="text" value="📣" readonly=""> <span>Megaphone</span></div>
			<div class="hiddenChar"><input type="text" value="📯" readonly=""> <span>Postal Horn</span></div>
			<div class="hiddenChar"><input type="text" value="🔔" readonly=""> <span>Bell</span></div>
			<div class="hiddenChar"><input type="text" value="🔕" readonly=""> <span>Bell With Slash</span></div>
			<div class="hiddenChar"><input type="text" value="🎵" readonly=""> <span>Musical Note</span></div>
			<div class="hiddenChar"><input type="text" value="🎶" readonly=""> <span>Musical Notes</span></div>
			<div class="hiddenChar"><input type="text" value="🏧" readonly=""> <span>Atm Sign</span></div>
			<div class="hiddenChar"><input type="text" value="🚮" readonly=""> <span>Litter in Bin Sign</span></div>
			<div class="hiddenChar"><input type="text" value="🚰" readonly=""> <span>Potable Water</span></div>
			<div class="hiddenChar"><input type="text" value="♿" readonly=""> <span>Wheelchair Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="🚹" readonly=""> <span>Men’s Room</span></div>
			<div class="hiddenChar"><input type="text" value="🚺" readonly=""> <span>Women’s Room</span></div>
			<div class="hiddenChar"><input type="text" value="🚻" readonly=""> <span>Restroom</span></div>
			<div class="hiddenChar"><input type="text" value="🚼" readonly=""> <span>Baby Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="🚾" readonly=""> <span>Water Closet</span></div>
			<div class="hiddenChar"><input type="text" value="⚠" readonly=""> <span>Warning</span></div>
			<div class="hiddenChar"><input type="text" value="🚸" readonly=""> <span>Children Crossing</span></div>
			<div class="hiddenChar"><input type="text" value="⛔" readonly=""> <span>No Entry</span></div>
			<div class="hiddenChar"><input type="text" value="🚫" readonly=""> <span>Prohibited</span></div>
			<div class="hiddenChar"><input type="text" value="🚳" readonly=""> <span>No Bicycles</span></div>
			<div class="hiddenChar"><input type="text" value="🚭" readonly=""> <span>No Smoking</span></div>
			<div class="hiddenChar"><input type="text" value="🚯" readonly=""> <span>No Littering</span></div>
			<div class="hiddenChar"><input type="text" value="🚱" readonly=""> <span>Non-Potable Water</span></div>
			<div class="hiddenChar"><input type="text" value="🚷" readonly=""> <span>No Pedestrians</span></div>
			<div class="hiddenChar"><input type="text" value="🔞" readonly=""> <span>No One Under Eighteen</span></div>
			<div class="hiddenChar"><input type="text" value="☢" readonly=""> <span>Radioactive</span></div>
			<div class="hiddenChar"><input type="text" value="☣" readonly=""> <span>Biohazard</span></div>
			<div class="hiddenChar"><input type="text" value="🛐" readonly=""> <span>Place of Worship</span></div>
			<div class="hiddenChar"><input type="text" value="⚛" readonly=""> <span>Atom Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="🕉" readonly=""> <span>Om</span></div>
			<div class="hiddenChar"><input type="text" value="✡" readonly=""> <span>Star of David</span></div>
			<div class="hiddenChar"><input type="text" value="☸" readonly=""> <span>Wheel of Dharma</span></div>
			<div class="hiddenChar"><input type="text" value="☯" readonly=""> <span>Yin Yang</span></div>
			<div class="hiddenChar"><input type="text" value="✝" readonly=""> <span>Latin Cross</span></div>
			<div class="hiddenChar"><input type="text" value="☦" readonly=""> <span>Orthodox Cross</span></div>
			<div class="hiddenChar"><input type="text" value="☪" readonly=""> <span>Star and Crescent</span></div>
			<div class="hiddenChar"><input type="text" value="☮" readonly=""> <span>Peace Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="🕎" readonly=""> <span>Menorah</span></div>
			<div class="hiddenChar"><input type="text" value="🔯" readonly=""> <span>Dotted Six-Pointed Star</span></div>
			<div class="hiddenChar"><input type="text" value="♈" readonly=""> <span>Aries</span></div>
			<div class="hiddenChar"><input type="text" value="♉" readonly=""> <span>Taurus</span></div>
			<div class="hiddenChar"><input type="text" value="♊" readonly=""> <span>Gemini</span></div>
			<div class="hiddenChar"><input type="text" value="♋" readonly=""> <span>Cancer</span></div>
			<div class="hiddenChar"><input type="text" value="♌" readonly=""> <span>Leo</span></div>
			<div class="hiddenChar"><input type="text" value="♍" readonly=""> <span>Virgo</span></div>
			<div class="hiddenChar"><input type="text" value="♎" readonly=""> <span>Libra</span></div>
			<div class="hiddenChar"><input type="text" value="♏" readonly=""> <span>Scorpio</span></div>
			<div class="hiddenChar"><input type="text" value="♐" readonly=""> <span>Sagittarius</span></div>
			<div class="hiddenChar"><input type="text" value="♑" readonly=""> <span>Capricorn</span></div>
			<div class="hiddenChar"><input type="text" value="♒" readonly=""> <span>Aquarius</span></div>
			<div class="hiddenChar"><input type="text" value="♓" readonly=""> <span>Pisces</span></div>
			<div class="hiddenChar"><input type="text" value="⛎" readonly=""> <span>Ophiuchus</span></div>
			<div class="hiddenChar"><input type="text" value="🔀" readonly=""> <span>Shuffle Tracks Button</span></div>
			<div class="hiddenChar"><input type="text" value="🔁" readonly=""> <span>Repeat Button</span></div>
			<div class="hiddenChar"><input type="text" value="🔂" readonly=""> <span>Repeat Single Button</span></div>
			<div class="hiddenChar"><input type="text" value="▶" readonly=""> <span>Play Button</span></div>
			<div class="hiddenChar"><input type="text" value="⏩" readonly=""> <span>Fast-Forward Button</span></div>
			<div class="hiddenChar"><input type="text" value="◀" readonly=""> <span>Reverse Button</span></div>
			<div class="hiddenChar"><input type="text" value="⏪" readonly=""> <span>Fast Reverse Button</span></div>
			<div class="hiddenChar"><input type="text" value="🔼" readonly=""> <span>Upwards Button</span></div>
			<div class="hiddenChar"><input type="text" value="⏫" readonly=""> <span>Fast Up Button</span></div>
			<div class="hiddenChar"><input type="text" value="🔽" readonly=""> <span>Downwards Button</span></div>
			<div class="hiddenChar"><input type="text" value="⏬" readonly=""> <span>Fast Down Button</span></div>
			<div class="hiddenChar"><input type="text" value="⏹" readonly=""> <span>Stop Button</span></div>
			<div class="hiddenChar"><input type="text" value="⏏" readonly=""> <span>Eject Button</span></div>
			<div class="hiddenChar"><input type="text" value="🎦" readonly=""> <span>Cinema</span></div>
			<div class="hiddenChar"><input type="text" value="🔅" readonly=""> <span>Dim Button</span></div>
			<div class="hiddenChar"><input type="text" value="🔆" readonly=""> <span>Bright Button</span></div>
			<div class="hiddenChar"><input type="text" value="📶" readonly=""> <span>Antenna Bars</span></div>
			<div class="hiddenChar"><input type="text" value="📳" readonly=""> <span>Vibration Mode</span></div>
			<div class="hiddenChar"><input type="text" value="📴" readonly=""> <span>Mobile Phone Off</span></div>
			<div class="hiddenChar"><input type="text" value="♻" readonly=""> <span>Recycling Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="🔱" readonly=""> <span>Trident Emblem</span></div>
			<div class="hiddenChar"><input type="text" value="📛" readonly=""> <span>Name Badge</span></div>
			<div class="hiddenChar"><input type="text" value="🔰" readonly=""> <span>Japanese Symbol for Beginner</span></div>
			<div class="hiddenChar"><input type="text" value="⭕" readonly=""> <span>Heavy Large Circle</span></div>
			<div class="hiddenChar"><input type="text" value="✅" readonly=""> <span>White Heavy Check Mark</span></div>
			<div class="hiddenChar"><input type="text" value="☑" readonly=""> <span>Ballot Box With Check</span></div>
			<div class="hiddenChar"><input type="text" value="✔" readonly=""> <span>Heavy Check Mark</span></div>
			<div class="hiddenChar"><input type="text" value="✖" readonly=""> <span>Heavy Multiplication X</span></div>
			<div class="hiddenChar"><input type="text" value="❌" readonly=""> <span>Cross Mark</span></div>
			<div class="hiddenChar"><input type="text" value="❎" readonly=""> <span>Cross Mark Button</span></div>
			<div class="hiddenChar"><input type="text" value="➕" readonly=""> <span>Heavy Plus Sign</span></div>
			<div class="hiddenChar"><input type="text" value="➖" readonly=""> <span>Heavy Minus Sign</span></div>
			<div class="hiddenChar"><input type="text" value="➗" readonly=""> <span>Heavy Division Sign</span></div>
			<div class="hiddenChar"><input type="text" value="➰" readonly=""> <span>Curly Loop</span></div>
			<div class="hiddenChar"><input type="text" value="➿" readonly=""> <span>Double Curly Loop</span></div>
			<div class="hiddenChar"><input type="text" value="〽" readonly=""> <span>Part Alternation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="✳" readonly=""> <span>Eight-Spoked Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="✴" readonly=""> <span>Eight-Pointed Star</span></div>
			<div class="hiddenChar"><input type="text" value="❇" readonly=""> <span>Sparkle</span></div>
			<div class="hiddenChar"><input type="text" value="‼" readonly=""> <span>Double Exclamation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="⁉" readonly=""> <span>Exclamation Question Mark</span></div>
			<div class="hiddenChar"><input type="text" value="❓" readonly=""> <span>Question Mark</span></div>
			<div class="hiddenChar"><input type="text" value="❔" readonly=""> <span>White Question Mark</span></div>
			<div class="hiddenChar"><input type="text" value="❕" readonly=""> <span>White Exclamation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="❗" readonly=""> <span>Exclamation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="#️⃣" readonly=""> <span>Keycap Number Sign</span></div>
			<div class="hiddenChar"><input type="text" value="0️⃣" readonly=""> <span>Keycap Digit Zero</span></div>
			<div class="hiddenChar"><input type="text" value="1️⃣" readonly=""> <span>Keycap Digit One</span></div>
			<div class="hiddenChar"><input type="text" value="2️⃣" readonly=""> <span>Keycap Digit Two</span></div>
			<div class="hiddenChar"><input type="text" value="3️⃣" readonly=""> <span>Keycap Digit Three</span></div>
			<div class="hiddenChar"><input type="text" value="4️⃣" readonly=""> <span>Keycap Digit Four</span></div>
			<div class="hiddenChar"><input type="text" value="5️⃣" readonly=""> <span>Keycap Digit Five</span></div>
			<div class="hiddenChar"><input type="text" value="6️⃣" readonly=""> <span>Keycap Digit Six</span></div>
			<div class="hiddenChar"><input type="text" value="7️⃣" readonly=""> <span>Keycap Digit Seven</span></div>
			<div class="hiddenChar"><input type="text" value="8️⃣" readonly=""> <span>Keycap Digit Eight</span></div>
			<div class="hiddenChar"><input type="text" value="9️⃣" readonly=""> <span>Keycap Digit Nine</span></div>
			<div class="hiddenChar"><input type="text" value="🔟" readonly=""> <span>Keycap 10</span></div>
			<div class="hiddenChar"><input type="text" value="💯" readonly=""> <span>Hundred Points</span></div>
			<div class="hiddenChar"><input type="text" value="🔠" readonly=""> <span>Input Latin Uppercase</span></div>
			<div class="hiddenChar"><input type="text" value="🔡" readonly=""> <span>Input Latin Lowercase</span></div>
			<div class="hiddenChar"><input type="text" value="🔢" readonly=""> <span>Input Numbers</span></div>
			<div class="hiddenChar"><input type="text" value="🔣" readonly=""> <span>Input Symbols</span></div>
			<div class="hiddenChar"><input type="text" value="🔤" readonly=""> <span>Input Latin Letters</span></div>
			<div class="hiddenChar"><input type="text" value="🅰" readonly=""> <span>A Button (blood Type)</span></div>
			<div class="hiddenChar"><input type="text" value="🆎" readonly=""> <span>Ab Button (blood Type)</span></div>
			<div class="hiddenChar"><input type="text" value="🅱" readonly=""> <span>B Button (blood Type)</span></div>
			<div class="hiddenChar"><input type="text" value="🆑" readonly=""> <span>CL Button</span></div>
			<div class="hiddenChar"><input type="text" value="🆒" readonly=""> <span>Cool Button</span></div>
			<div class="hiddenChar"><input type="text" value="🆓" readonly=""> <span>Free Button</span></div>
			<div class="hiddenChar"><input type="text" value="ℹ" readonly=""> <span>Information</span></div>
			<div class="hiddenChar"><input type="text" value="🆔" readonly=""> <span>ID Button</span></div>
			<div class="hiddenChar"><input type="text" value="Ⓜ" readonly=""> <span>Circled M</span></div>
			<div class="hiddenChar"><input type="text" value="🆕" readonly=""> <span>New Button</span></div>
			<div class="hiddenChar"><input type="text" value="🆖" readonly=""> <span>NG Button</span></div>
			<div class="hiddenChar"><input type="text" value="🅾" readonly=""> <span>O Button (blood Type)</span></div>
			<div class="hiddenChar"><input type="text" value="🆗" readonly=""> <span>OK Button</span></div>
			<div class="hiddenChar"><input type="text" value="🅿" readonly=""> <span>P Button</span></div>
			<div class="hiddenChar"><input type="text" value="🆘" readonly=""> <span>SOS Button</span></div>
			<div class="hiddenChar"><input type="text" value="🆙" readonly=""> <span>Up! Button</span></div>
			<div class="hiddenChar"><input type="text" value="🆚" readonly=""> <span>Vs Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈁" readonly=""> <span>Japanese “here” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈂" readonly=""> <span>Japanese “service Charge” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈷" readonly=""> <span>Japanese “monthly Amount” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈶" readonly=""> <span>Japanese “not Free of Charge” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈯" readonly=""> <span>Japanese “reserved” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🉐" readonly=""> <span>Japanese “bargain” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈹" readonly=""> <span>Japanese “discount” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈚" readonly=""> <span>Japanese “free of Charge” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈲" readonly=""> <span>Japanese “prohibited” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🉑" readonly=""> <span>Japanese “acceptable” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈸" readonly=""> <span>Japanese “application” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈴" readonly=""> <span>Japanese “passing Grade” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈳" readonly=""> <span>Japanese “vacancy” Button</span></div>
			<div class="hiddenChar"><input type="text" value="㊗" readonly=""> <span>Japanese “congratulations” Button</span></div>
			<div class="hiddenChar"><input type="text" value="㊙" readonly=""> <span>Japanese “secret” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈺" readonly=""> <span>Japanese “open for Business” Button</span></div>
			<div class="hiddenChar"><input type="text" value="🈵" readonly=""> <span>Japanese “no Vacancy” Button</span></div>
			<div class="hiddenChar"><input type="text" value="▪" readonly=""> <span>Black Small Square</span></div>
			<div class="hiddenChar"><input type="text" value="▫" readonly=""> <span>White Small Square</span></div>
			<div class="hiddenChar"><input type="text" value="◻" readonly=""> <span>White Medium Square</span></div>
			<div class="hiddenChar"><input type="text" value="◼" readonly=""> <span>Black Medium Square</span></div>
			<div class="hiddenChar"><input type="text" value="◽" readonly=""> <span>White Medium-Small Square</span></div>
			<div class="hiddenChar"><input type="text" value="◾" readonly=""> <span>Black Medium-Small Square</span></div>
			<div class="hiddenChar"><input type="text" value="⬛" readonly=""> <span>Black Large Square</span></div>
			<div class="hiddenChar"><input type="text" value="⬜" readonly=""> <span>White Large Square</span></div>
			<div class="hiddenChar"><input type="text" value="🔶" readonly=""> <span>Large Orange Diamond</span></div>
			<div class="hiddenChar"><input type="text" value="🔷" readonly=""> <span>Large Blue Diamond</span></div>
			<div class="hiddenChar"><input type="text" value="🔸" readonly=""> <span>Small Orange Diamond</span></div>
			<div class="hiddenChar"><input type="text" value="🔹" readonly=""> <span>Small Blue Diamond</span></div>
			<div class="hiddenChar"><input type="text" value="🔺" readonly=""> <span>Red Triangle Pointed Up</span></div>
			<div class="hiddenChar"><input type="text" value="🔻" readonly=""> <span>Red Triangle Pointed Down</span></div>
			<div class="hiddenChar"><input type="text" value="💠" readonly=""> <span>Diamond With a Dot</span></div>
			<div class="hiddenChar"><input type="text" value="🔲" readonly=""> <span>Black Square Button</span></div>
			<div class="hiddenChar"><input type="text" value="🔳" readonly=""> <span>White Square Button</span></div>
			<div class="hiddenChar"><input type="text" value="⚪" readonly=""> <span>White Circle</span></div>
			<div class="hiddenChar"><input type="text" value="⚫" readonly=""> <span>Black Circle</span></div>
			<div class="hiddenChar"><input type="text" value="🔴" readonly=""> <span>Red Circle</span></div>
			<div class="hiddenChar"><input type="text" value="🔵" readonly=""> <span>Blue Circle</span></div>
			<div class="hiddenChar"><input type="text" value="‐" readonly=""> <span>Hyphen</span></div>
			<div class="hiddenChar"><input type="text" value="‑" readonly=""> <span>Non-breaking Hyphen</span></div>
			<div class="hiddenChar"><input type="text" value="‒" readonly=""> <span>Figure Dash</span></div>
			<div class="hiddenChar"><input type="text" value="–" readonly=""> <span>En Dash</span></div>
			<div class="hiddenChar"><input type="text" value="—" readonly=""> <span>Em Dash</span></div>
			<div class="hiddenChar"><input type="text" value="―" readonly=""> <span>Horizontal Bar</span></div>
			<div class="hiddenChar"><input type="text" value="‖" readonly=""> <span>Double Vertical Line</span></div>
			<div class="hiddenChar"><input type="text" value="‗" readonly=""> <span>Double Low Line</span></div>
			<div class="hiddenChar"><input type="text" value="‘" readonly=""> <span>Left Single Quotation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="’" readonly=""> <span>Right Single Quotation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="‚" readonly=""> <span>Single Low-9 Quotation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="‛" readonly=""> <span>Single High-reversed-9 Quotation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="“" readonly=""> <span>Left Double Quotation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="”" readonly=""> <span>Right Double Quotation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="„" readonly=""> <span>Double Low-9 Quotation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="‟" readonly=""> <span>Double High-reversed-9 Quotation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="†" readonly=""> <span>Dagger</span></div>
			<div class="hiddenChar"><input type="text" value="‡" readonly=""> <span>Double Dagger</span></div>
			<div class="hiddenChar"><input type="text" value="•" readonly=""> <span>Bullet</span></div>
			<div class="hiddenChar"><input type="text" value="‣" readonly=""> <span>Triangular Bullet</span></div>
			<div class="hiddenChar"><input type="text" value="․" readonly=""> <span>One Dot Leader</span></div>
			<div class="hiddenChar"><input type="text" value="‥" readonly=""> <span>Two Dot Leader</span></div>
			<div class="hiddenChar"><input type="text" value="…" readonly=""> <span>Horizontal Ellipsis</span></div>
			<div class="hiddenChar"><input type="text" value="‧" readonly=""> <span>Hyphenation Point</span></div>
			<div class="hiddenChar"><input type="text" value=" " readonly=""> <span>Line Separator</span></div>
			<div class="hiddenChar"><input type="text" value=" " readonly=""> <span>Paragraph Separator</span></div>
			<div class="hiddenChar"><input type="text" value="‰" readonly=""> <span>Per Mille Sign</span></div>
			<div class="hiddenChar"><input type="text" value="‱" readonly=""> <span>Per Ten Thousand Sign</span></div>
			<div class="hiddenChar"><input type="text" value="′" readonly=""> <span>Prime</span></div>
			<div class="hiddenChar"><input type="text" value="″" readonly=""> <span>Double Prime</span></div>
			<div class="hiddenChar"><input type="text" value="‴" readonly=""> <span>Triple Prime</span></div>
			<div class="hiddenChar"><input type="text" value="‵" readonly=""> <span>Reversed Prime</span></div>
			<div class="hiddenChar"><input type="text" value="‶" readonly=""> <span>Reversed Double Prime</span></div>
			<div class="hiddenChar"><input type="text" value="‷" readonly=""> <span>Reversed Triple Prime</span></div>
			<div class="hiddenChar"><input type="text" value="‸" readonly=""> <span>Caret</span></div>
			<div class="hiddenChar"><input type="text" value="‹" readonly=""> <span>Single Left-pointing Angle Quotation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="›" readonly=""> <span>Single Right-pointing Angle Quotation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="※" readonly=""> <span>Reference Mark</span></div>
			<div class="hiddenChar"><input type="text" value="‼" readonly=""> <span>Double Exclamation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="‽" readonly=""> <span>Interrobang</span></div>
			<div class="hiddenChar"><input type="text" value="‾" readonly=""> <span>Overline</span></div>
			<div class="hiddenChar"><input type="text" value="‿" readonly=""> <span>Undertie</span></div>
			<div class="hiddenChar"><input type="text" value="⁀" readonly=""> <span>Character Tie</span></div>
			<div class="hiddenChar"><input type="text" value="⁁" readonly=""> <span>Caret Insertion Point</span></div>
			<div class="hiddenChar"><input type="text" value="⁂" readonly=""> <span>Asterism</span></div>
			<div class="hiddenChar"><input type="text" value="⁃" readonly=""> <span>Hyphen Bullet</span></div>
			<div class="hiddenChar"><input type="text" value="⁄" readonly=""> <span>Fraction Slash</span></div>
			<div class="hiddenChar"><input type="text" value="⁅" readonly=""> <span>Left Square Bracket With Quill</span></div>
			<div class="hiddenChar"><input type="text" value="⁆" readonly=""> <span>Right Square Bracket With Quill</span></div>
			<div class="hiddenChar"><input type="text" value="⁇" readonly=""> <span>Double Question Mark</span></div>
			<div class="hiddenChar"><input type="text" value="⁈" readonly=""> <span>Question Exclamation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="⁉" readonly=""> <span>Exclamation Question Mark</span></div>
			<div class="hiddenChar"><input type="text" value="⁊" readonly=""> <span>Tironian Sign Et</span></div>
			<div class="hiddenChar"><input type="text" value="⁋" readonly=""> <span>Reversed Pilcrow Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⁌" readonly=""> <span>Black Leftwards Bullet</span></div>
			<div class="hiddenChar"><input type="text" value="⁍" readonly=""> <span>Black Rightwards Bullet</span></div>
			<div class="hiddenChar"><input type="text" value="⁎" readonly=""> <span>Low Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="⁏" readonly=""> <span>Reversed Semicolon</span></div>
			<div class="hiddenChar"><input type="text" value="⁐" readonly=""> <span>Close Up</span></div>
			<div class="hiddenChar"><input type="text" value="⁑" readonly=""> <span>Two Asterisks Aligned Vertically</span></div>
			<div class="hiddenChar"><input type="text" value="⁒" readonly=""> <span>Commercial Minus Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⁓" readonly=""> <span>Swung Dash</span></div>
			<div class="hiddenChar"><input type="text" value="⁔" readonly=""> <span>Inverted Undertie</span></div>
			<div class="hiddenChar"><input type="text" value="⁕" readonly=""> <span>Flower Punctuation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="⁖" readonly=""> <span>Three Dot Punctuation</span></div>
			<div class="hiddenChar"><input type="text" value="⁗" readonly=""> <span>Quadruple Prime</span></div>
			<div class="hiddenChar"><input type="text" value="⁘" readonly=""> <span>Four Dot Punctuation</span></div>
			<div class="hiddenChar"><input type="text" value="⁙" readonly=""> <span>Five Dot Punctuation</span></div>
			<div class="hiddenChar"><input type="text" value="⁚" readonly=""> <span>Two Dot Punctuation</span></div>
			<div class="hiddenChar"><input type="text" value="⁛" readonly=""> <span>Four Dot Mark</span></div>
			<div class="hiddenChar"><input type="text" value="⁜" readonly=""> <span>Dotted Cross</span></div>
			<div class="hiddenChar"><input type="text" value="⁝" readonly=""> <span>Tricolon</span></div>
			<div class="hiddenChar"><input type="text" value="⁞" readonly=""> <span>Vertical Four Dots</span></div>
			<div class="hiddenChar"><input type="text" value="℀" readonly=""> <span>Account Of</span></div>
			<div class="hiddenChar"><input type="text" value="℁" readonly=""> <span>Addressed To The Subject</span></div>
			<div class="hiddenChar"><input type="text" value="ℂ" readonly=""> <span>Double-struck Capital C</span></div>
			<div class="hiddenChar"><input type="text" value="℃" readonly=""> <span>Degree Celsius</span></div>
			<div class="hiddenChar"><input type="text" value="℄" readonly=""> <span>Centre Line Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="℅" readonly=""> <span>Care Of</span></div>
			<div class="hiddenChar"><input type="text" value="℆" readonly=""> <span>Cada Una</span></div>
			<div class="hiddenChar"><input type="text" value="ℇ" readonly=""> <span>Euler Constant</span></div>
			<div class="hiddenChar"><input type="text" value="℈" readonly=""> <span>Scruple</span></div>
			<div class="hiddenChar"><input type="text" value="℉" readonly=""> <span>Degree Fahrenheit</span></div>
			<div class="hiddenChar"><input type="text" value="ℊ" readonly=""> <span>Script Small G</span></div>
			<div class="hiddenChar"><input type="text" value="ℋ" readonly=""> <span>Script Capital H</span></div>
			<div class="hiddenChar"><input type="text" value="ℌ" readonly=""> <span>Black-letter Capital H</span></div>
			<div class="hiddenChar"><input type="text" value="ℍ" readonly=""> <span>Double-struck Capital H</span></div>
			<div class="hiddenChar"><input type="text" value="ℎ" readonly=""> <span>Planck Constant</span></div>
			<div class="hiddenChar"><input type="text" value="ℏ" readonly=""> <span>Planck Constant Over Two Pi</span></div>
			<div class="hiddenChar"><input type="text" value="ℐ" readonly=""> <span>Script Capital I</span></div>
			<div class="hiddenChar"><input type="text" value="ℑ" readonly=""> <span>Black-letter Capital I</span></div>
			<div class="hiddenChar"><input type="text" value="ℒ" readonly=""> <span>Script Capital L</span></div>
			<div class="hiddenChar"><input type="text" value="ℓ" readonly=""> <span>Script Small L</span></div>
			<div class="hiddenChar"><input type="text" value="℔" readonly=""> <span>L B Bar Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="ℕ" readonly=""> <span>Double-struck Capital N</span></div>
			<div class="hiddenChar"><input type="text" value="№" readonly=""> <span>Numero Sign</span></div>
			<div class="hiddenChar"><input type="text" value="℗" readonly=""> <span>Sound Recording Copyright</span></div>
			<div class="hiddenChar"><input type="text" value="℘" readonly=""> <span>Script Capital P</span></div>
			<div class="hiddenChar"><input type="text" value="ℙ" readonly=""> <span>Double-struck Capital P</span></div>
			<div class="hiddenChar"><input type="text" value="ℚ" readonly=""> <span>Double-struck Capital Q</span></div>
			<div class="hiddenChar"><input type="text" value="ℛ" readonly=""> <span>Script Capital R</span></div>
			<div class="hiddenChar"><input type="text" value="ℜ" readonly=""> <span>Black-letter Capital R</span></div>
			<div class="hiddenChar"><input type="text" value="ℝ" readonly=""> <span>Double-struck Capital R</span></div>
			<div class="hiddenChar"><input type="text" value="℞" readonly=""> <span>Prescription Take</span></div>
			<div class="hiddenChar"><input type="text" value="℟" readonly=""> <span>Response</span></div>
			<div class="hiddenChar"><input type="text" value="℠" readonly=""> <span>Service Mark</span></div>
			<div class="hiddenChar"><input type="text" value="℡" readonly=""> <span>Telephone Sign</span></div>
			<div class="hiddenChar"><input type="text" value="™" readonly=""> <span>Trade Mark Sign</span></div>
			<div class="hiddenChar"><input type="text" value="℣" readonly=""> <span>Versicle</span></div>
			<div class="hiddenChar"><input type="text" value="ℤ" readonly=""> <span>Double-struck Capital Z</span></div>
			<div class="hiddenChar"><input type="text" value="℥" readonly=""> <span>Ounce Sign</span></div>
			<div class="hiddenChar"><input type="text" value="Ω" readonly=""> <span>Ohm Sign</span></div>
			<div class="hiddenChar"><input type="text" value="℧" readonly=""> <span>Inverted Ohm Sign</span></div>
			<div class="hiddenChar"><input type="text" value="ℨ" readonly=""> <span>Black-letter Capital Z</span></div>
			<div class="hiddenChar"><input type="text" value="℩" readonly=""> <span>Turned Greek Small Letter Iota</span></div>
			<div class="hiddenChar"><input type="text" value="K" readonly=""> <span>Kelvin Sign</span></div>
			<div class="hiddenChar"><input type="text" value="Å" readonly=""> <span>Angstrom Sign</span></div>
			<div class="hiddenChar"><input type="text" value="ℬ" readonly=""> <span>Script Capital B</span></div>
			<div class="hiddenChar"><input type="text" value="ℭ" readonly=""> <span>Black-letter Capital C</span></div>
			<div class="hiddenChar"><input type="text" value="℮" readonly=""> <span>Estimated Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="ℯ" readonly=""> <span>Script Small E</span></div>
			<div class="hiddenChar"><input type="text" value="ℰ" readonly=""> <span>Script Capital E</span></div>
			<div class="hiddenChar"><input type="text" value="ℱ" readonly=""> <span>Script Capital F</span></div>
			<div class="hiddenChar"><input type="text" value="Ⅎ" readonly=""> <span>Turned Capital F</span></div>
			<div class="hiddenChar"><input type="text" value="ℳ" readonly=""> <span>Script Capital M</span></div>
			<div class="hiddenChar"><input type="text" value="ℴ" readonly=""> <span>Script Small O</span></div>
			<div class="hiddenChar"><input type="text" value="ℵ" readonly=""> <span>Alef Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="ℶ" readonly=""> <span>Bet Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="ℷ" readonly=""> <span>Gimel Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="ℸ" readonly=""> <span>Dalet Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="ℹ" readonly=""> <span>Information Source</span></div>
			<div class="hiddenChar"><input type="text" value="℺" readonly=""> <span>Rotated Capital Q</span></div>
			<div class="hiddenChar"><input type="text" value="℻" readonly=""> <span>Facsimile Sign</span></div>
			<div class="hiddenChar"><input type="text" value="ℼ" readonly=""> <span>Double-struck Small Pi</span></div>
			<div class="hiddenChar"><input type="text" value="ℽ" readonly=""> <span>Double-struck Small Gamma</span></div>
			<div class="hiddenChar"><input type="text" value="ℾ" readonly=""> <span>Double-struck Capital Gamma</span></div>
			<div class="hiddenChar"><input type="text" value="ℿ" readonly=""> <span>Double-struck Capital Pi</span></div>
			<div class="hiddenChar"><input type="text" value="⅀" readonly=""> <span>Double-struck N-ary Summation</span></div>
			<div class="hiddenChar"><input type="text" value="⅁" readonly=""> <span>Turned Sans-serif Capital G</span></div>
			<div class="hiddenChar"><input type="text" value="⅂" readonly=""> <span>Turned Sans-serif Capital L</span></div>
			<div class="hiddenChar"><input type="text" value="⅃" readonly=""> <span>Reversed Sans-serif Capital L</span></div>
			<div class="hiddenChar"><input type="text" value="⅄" readonly=""> <span>Turned Sans-serif Capital Y</span></div>
			<div class="hiddenChar"><input type="text" value="ⅅ" readonly=""> <span>Double-struck Italic Capital D</span></div>
			<div class="hiddenChar"><input type="text" value="ⅆ" readonly=""> <span>Double-struck Italic Small D</span></div>
			<div class="hiddenChar"><input type="text" value="ⅇ" readonly=""> <span>Double-struck Italic Small E</span></div>
			<div class="hiddenChar"><input type="text" value="ⅈ" readonly=""> <span>Double-struck Italic Small I</span></div>
			<div class="hiddenChar"><input type="text" value="ⅉ" readonly=""> <span>Double-struck Italic Small J</span></div>
			<div class="hiddenChar"><input type="text" value="⅊" readonly=""> <span>Property Line</span></div>
			<div class="hiddenChar"><input type="text" value="⅋" readonly=""> <span>Turned Ampersand</span></div>
			<div class="hiddenChar"><input type="text" value="⅌" readonly=""> <span>Per Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⅍" readonly=""> <span>Aktieselskab</span></div>
			<div class="hiddenChar"><input type="text" value="ⅎ" readonly=""> <span>Turned Small F</span></div>
			<div class="hiddenChar"><input type="text" value="⅏" readonly=""> <span>Symbol For Samaritan Source</span></div>
			<div class="hiddenChar"><input type="text" value="∀" readonly=""> <span>For All</span></div>
			<div class="hiddenChar"><input type="text" value="∁" readonly=""> <span>Complement</span></div>
			<div class="hiddenChar"><input type="text" value="∂" readonly=""> <span>Partial Differential</span></div>
			<div class="hiddenChar"><input type="text" value="∃" readonly=""> <span>There Exists</span></div>
			<div class="hiddenChar"><input type="text" value="∄" readonly=""> <span>There Does Not Exist</span></div>
			<div class="hiddenChar"><input type="text" value="∅" readonly=""> <span>Empty Set</span></div>
			<div class="hiddenChar"><input type="text" value="∆" readonly=""> <span>Increment</span></div>
			<div class="hiddenChar"><input type="text" value="∇" readonly=""> <span>Nabla</span></div>
			<div class="hiddenChar"><input type="text" value="∈" readonly=""> <span>Element Of</span></div>
			<div class="hiddenChar"><input type="text" value="∉" readonly=""> <span>Not An Element Of</span></div>
			<div class="hiddenChar"><input type="text" value="∊" readonly=""> <span>Small Element Of</span></div>
			<div class="hiddenChar"><input type="text" value="∋" readonly=""> <span>Contains As Member</span></div>
			<div class="hiddenChar"><input type="text" value="∌" readonly=""> <span>Does Not Contain As Member</span></div>
			<div class="hiddenChar"><input type="text" value="∍" readonly=""> <span>Small Contains As Member</span></div>
			<div class="hiddenChar"><input type="text" value="∎" readonly=""> <span>End Of Proof</span></div>
			<div class="hiddenChar"><input type="text" value="∏" readonly=""> <span>N-ary Product</span></div>
			<div class="hiddenChar"><input type="text" value="∐" readonly=""> <span>N-ary Coproduct</span></div>
			<div class="hiddenChar"><input type="text" value="∑" readonly=""> <span>N-ary Summation</span></div>
			<div class="hiddenChar"><input type="text" value="−" readonly=""> <span>Minus Sign</span></div>
			<div class="hiddenChar"><input type="text" value="∓" readonly=""> <span>Minus-or-plus Sign</span></div>
			<div class="hiddenChar"><input type="text" value="∔" readonly=""> <span>Dot Plus</span></div>
			<div class="hiddenChar"><input type="text" value="∕" readonly=""> <span>Division Slash</span></div>
			<div class="hiddenChar"><input type="text" value="∖" readonly=""> <span>Set Minus</span></div>
			<div class="hiddenChar"><input type="text" value="∗" readonly=""> <span>Asterisk Operator</span></div>
			<div class="hiddenChar"><input type="text" value="∘" readonly=""> <span>Ring Operator</span></div>
			<div class="hiddenChar"><input type="text" value="∙" readonly=""> <span>Bullet Operator</span></div>
			<div class="hiddenChar"><input type="text" value="√" readonly=""> <span>Square Root</span></div>
			<div class="hiddenChar"><input type="text" value="∛" readonly=""> <span>Cube Root</span></div>
			<div class="hiddenChar"><input type="text" value="∜" readonly=""> <span>Fourth Root</span></div>
			<div class="hiddenChar"><input type="text" value="∝" readonly=""> <span>Proportional To</span></div>
			<div class="hiddenChar"><input type="text" value="∞" readonly=""> <span>Infinity</span></div>
			<div class="hiddenChar"><input type="text" value="∟" readonly=""> <span>Right Angle</span></div>
			<div class="hiddenChar"><input type="text" value="∠" readonly=""> <span>Angle</span></div>
			<div class="hiddenChar"><input type="text" value="∡" readonly=""> <span>Measured Angle</span></div>
			<div class="hiddenChar"><input type="text" value="∢" readonly=""> <span>Spherical Angle</span></div>
			<div class="hiddenChar"><input type="text" value="∣" readonly=""> <span>Divides</span></div>
			<div class="hiddenChar"><input type="text" value="∤" readonly=""> <span>Does Not Divide</span></div>
			<div class="hiddenChar"><input type="text" value="∥" readonly=""> <span>Parallel To</span></div>
			<div class="hiddenChar"><input type="text" value="∦" readonly=""> <span>Not Parallel To</span></div>
			<div class="hiddenChar"><input type="text" value="⊥" readonly=""> <span>Logical And</span></div>
			<div class="hiddenChar"><input type="text" value="⊦" readonly=""> <span>Logical Or</span></div>
			<div class="hiddenChar"><input type="text" value="∩" readonly=""> <span>Intersection</span></div>
			<div class="hiddenChar"><input type="text" value="∪" readonly=""> <span>Union</span></div>
			<div class="hiddenChar"><input type="text" value="∫" readonly=""> <span>Integral</span></div>
			<div class="hiddenChar"><input type="text" value="∬" readonly=""> <span>Double Integral</span></div>
			<div class="hiddenChar"><input type="text" value="∭" readonly=""> <span>Triple Integral</span></div>
			<div class="hiddenChar"><input type="text" value="∮" readonly=""> <span>Contour Integral</span></div>
			<div class="hiddenChar"><input type="text" value="∯" readonly=""> <span>Surface Integral</span></div>
			<div class="hiddenChar"><input type="text" value="∰" readonly=""> <span>Volume Integral</span></div>
			<div class="hiddenChar"><input type="text" value="∱" readonly=""> <span>Clockwise Integral</span></div>
			<div class="hiddenChar"><input type="text" value="∲" readonly=""> <span>Clockwise Contour Integral</span></div>
			<div class="hiddenChar"><input type="text" value="∳" readonly=""> <span>Anticlockwise Contour Integral</span></div>
			<div class="hiddenChar"><input type="text" value="∴" readonly=""> <span>Therefore</span></div>
			<div class="hiddenChar"><input type="text" value="∵" readonly=""> <span>Because</span></div>
			<div class="hiddenChar"><input type="text" value="∶" readonly=""> <span>Ratio</span></div>
			<div class="hiddenChar"><input type="text" value="∷" readonly=""> <span>Proportion</span></div>
			<div class="hiddenChar"><input type="text" value="∸" readonly=""> <span>Dot Minus</span></div>
			<div class="hiddenChar"><input type="text" value="∹" readonly=""> <span>Excess</span></div>
			<div class="hiddenChar"><input type="text" value="∺" readonly=""> <span>Geometric Proportion</span></div>
			<div class="hiddenChar"><input type="text" value="∻" readonly=""> <span>Homothetic</span></div>
			<div class="hiddenChar"><input type="text" value="∼" readonly=""> <span>Tilde Operator</span></div>
			<div class="hiddenChar"><input type="text" value="∽" readonly=""> <span>Reversed Tilde</span></div>
			<div class="hiddenChar"><input type="text" value="∾" readonly=""> <span>Inverted Lazy S</span></div>
			<div class="hiddenChar"><input type="text" value="∿" readonly=""> <span>Sine Wave</span></div>
			<div class="hiddenChar"><input type="text" value="≀" readonly=""> <span>Wreath Product</span></div>
			<div class="hiddenChar"><input type="text" value="≁" readonly=""> <span>Not Tilde</span></div>
			<div class="hiddenChar"><input type="text" value="≂" readonly=""> <span>Minus Tilde</span></div>
			<div class="hiddenChar"><input type="text" value="≃" readonly=""> <span>Asymptotically Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≄" readonly=""> <span>Not Asymptotically Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≅" readonly=""> <span>Approximately Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≆" readonly=""> <span>Approximately But Not Actually Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≇" readonly=""> <span>Neither Approximately Nor Actually Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≈" readonly=""> <span>Almost Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≉" readonly=""> <span>Not Almost Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≊" readonly=""> <span>Almost Equal Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≋" readonly=""> <span>Triple Tilde</span></div>
			<div class="hiddenChar"><input type="text" value="≌" readonly=""> <span>All Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≍" readonly=""> <span>Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="≎" readonly=""> <span>Geometrically Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="≏" readonly=""> <span>Difference Between</span></div>
			<div class="hiddenChar"><input type="text" value="≐" readonly=""> <span>Approaches The Limit</span></div>
			<div class="hiddenChar"><input type="text" value="≑" readonly=""> <span>Geometrically Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≒" readonly=""> <span>Approximately Equal To Or The Image Of</span></div>
			<div class="hiddenChar"><input type="text" value="≓" readonly=""> <span>Image Of Or Approximately Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≔" readonly=""> <span>Colon Equals</span></div>
			<div class="hiddenChar"><input type="text" value="≕" readonly=""> <span>Equals Colon</span></div>
			<div class="hiddenChar"><input type="text" value="≖" readonly=""> <span>Ring In Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≗" readonly=""> <span>Ring Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≘" readonly=""> <span>Corresponds To</span></div>
			<div class="hiddenChar"><input type="text" value="≙" readonly=""> <span>Estimates</span></div>
			<div class="hiddenChar"><input type="text" value="≚" readonly=""> <span>Equiangular To</span></div>
			<div class="hiddenChar"><input type="text" value="≛" readonly=""> <span>Star Equals</span></div>
			<div class="hiddenChar"><input type="text" value="≜" readonly=""> <span>Delta Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≝" readonly=""> <span>Equal To By Definition</span></div>
			<div class="hiddenChar"><input type="text" value="≞" readonly=""> <span>Measured By</span></div>
			<div class="hiddenChar"><input type="text" value="≟" readonly=""> <span>Questioned Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≠" readonly=""> <span>Not Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≡" readonly=""> <span>Identical To</span></div>
			<div class="hiddenChar"><input type="text" value="≢" readonly=""> <span>Not Identical To</span></div>
			<div class="hiddenChar"><input type="text" value="≣" readonly=""> <span>Strictly Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="≤" readonly=""> <span>Less-than Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≥" readonly=""> <span>Greater-than Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≦" readonly=""> <span>Less-than Over Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≧" readonly=""> <span>Greater-than Over Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≨" readonly=""> <span>Less-than But Not Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≩" readonly=""> <span>Greater-than But Not Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≪" readonly=""> <span>Much Less-than</span></div>
			<div class="hiddenChar"><input type="text" value="≫" readonly=""> <span>Much Greater-than</span></div>
			<div class="hiddenChar"><input type="text" value="≬" readonly=""> <span>Between</span></div>
			<div class="hiddenChar"><input type="text" value="≭" readonly=""> <span>Not Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="≮" readonly=""> <span>Not Less-than</span></div>
			<div class="hiddenChar"><input type="text" value="≯" readonly=""> <span>Not Greater-than</span></div>
			<div class="hiddenChar"><input type="text" value="≰" readonly=""> <span>Neither Less-than Nor Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≱" readonly=""> <span>Neither Greater-than Nor Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≲" readonly=""> <span>Less-than Or Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="≳" readonly=""> <span>Greater-than Or Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="≴" readonly=""> <span>Neither Less-than Nor Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="≵" readonly=""> <span>Neither Greater-than Nor Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="≶" readonly=""> <span>Less-than Or Greater-than</span></div>
			<div class="hiddenChar"><input type="text" value="≷" readonly=""> <span>Greater-than Or Less-than</span></div>
			<div class="hiddenChar"><input type="text" value="≸" readonly=""> <span>Neither Less-than Nor Greater-than</span></div>
			<div class="hiddenChar"><input type="text" value="≹" readonly=""> <span>Neither Greater-than Nor Less-than</span></div>
			<div class="hiddenChar"><input type="text" value="≺" readonly=""> <span>Precedes</span></div>
			<div class="hiddenChar"><input type="text" value="≻" readonly=""> <span>Succeeds</span></div>
			<div class="hiddenChar"><input type="text" value="≼" readonly=""> <span>Precedes Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≽" readonly=""> <span>Succeeds Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≾" readonly=""> <span>Precedes Or Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="≿" readonly=""> <span>Succeeds Or Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="⊀" readonly=""> <span>Does Not Precede</span></div>
			<div class="hiddenChar"><input type="text" value="⊁" readonly=""> <span>Does Not Succeed</span></div>
			<div class="hiddenChar"><input type="text" value="⊂" readonly=""> <span>Subset Of</span></div>
			<div class="hiddenChar"><input type="text" value="⊃" readonly=""> <span>Superset Of</span></div>
			<div class="hiddenChar"><input type="text" value="⊄" readonly=""> <span>Not A Subset Of</span></div>
			<div class="hiddenChar"><input type="text" value="⊅" readonly=""> <span>Not A Superset Of</span></div>
			<div class="hiddenChar"><input type="text" value="⊆" readonly=""> <span>Subset Of Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊇" readonly=""> <span>Superset Of Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊈" readonly=""> <span>Neither A Subset Of Nor Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊉" readonly=""> <span>Neither A Superset Of Nor Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊊" readonly=""> <span>Subset Of With Not Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊋" readonly=""> <span>Superset Of With Not Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊌" readonly=""> <span>Multiset</span></div>
			<div class="hiddenChar"><input type="text" value="⊍" readonly=""> <span>Multiset Multiplication</span></div>
			<div class="hiddenChar"><input type="text" value="⊎" readonly=""> <span>Multiset Union</span></div>
			<div class="hiddenChar"><input type="text" value="⊏" readonly=""> <span>Square Image Of</span></div>
			<div class="hiddenChar"><input type="text" value="⊐" readonly=""> <span>Square Original Of</span></div>
			<div class="hiddenChar"><input type="text" value="⊑" readonly=""> <span>Square Image Of Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊒" readonly=""> <span>Square Original Of Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊓" readonly=""> <span>Square Cap</span></div>
			<div class="hiddenChar"><input type="text" value="⊔" readonly=""> <span>Square Cup</span></div>
			<div class="hiddenChar"><input type="text" value="⊕" readonly=""> <span>Circled Plus</span></div>
			<div class="hiddenChar"><input type="text" value="⊖" readonly=""> <span>Circled Minus</span></div>
			<div class="hiddenChar"><input type="text" value="⊗" readonly=""> <span>Circled Times</span></div>
			<div class="hiddenChar"><input type="text" value="⊘" readonly=""> <span>Circled Division Slash</span></div>
			<div class="hiddenChar"><input type="text" value="⊙" readonly=""> <span>Circled Dot Operator</span></div>
			<div class="hiddenChar"><input type="text" value="⊚" readonly=""> <span>Circled Ring Operator</span></div>
			<div class="hiddenChar"><input type="text" value="⊛" readonly=""> <span>Circled Asterisk Operator</span></div>
			<div class="hiddenChar"><input type="text" value="⊜" readonly=""> <span>Circled Equals</span></div>
			<div class="hiddenChar"><input type="text" value="⊝" readonly=""> <span>Circled Dash</span></div>
			<div class="hiddenChar"><input type="text" value="⊞" readonly=""> <span>Squared Plus</span></div>
			<div class="hiddenChar"><input type="text" value="⊟" readonly=""> <span>Squared Minus</span></div>
			<div class="hiddenChar"><input type="text" value="⊠" readonly=""> <span>Squared Times</span></div>
			<div class="hiddenChar"><input type="text" value="⊡" readonly=""> <span>Squared Dot Operator</span></div>
			<div class="hiddenChar"><input type="text" value="⊢" readonly=""> <span>Right Tack</span></div>
			<div class="hiddenChar"><input type="text" value="⊣" readonly=""> <span>Left Tack</span></div>
			<div class="hiddenChar"><input type="text" value="⊤" readonly=""> <span>Down Tack</span></div>
			<div class="hiddenChar"><input type="text" value="⊥" readonly=""> <span>Up Tack</span></div>
			<div class="hiddenChar"><input type="text" value="⊦" readonly=""> <span>Assertion</span></div>
			<div class="hiddenChar"><input type="text" value="⊧" readonly=""> <span>Models</span></div>
			<div class="hiddenChar"><input type="text" value="⊨" readonly=""> <span>TRUE</span></div>
			<div class="hiddenChar"><input type="text" value="⊩" readonly=""> <span>Forces</span></div>
			<div class="hiddenChar"><input type="text" value="⊪" readonly=""> <span>Triple Vertical Bar Right Turnstile</span></div>
			<div class="hiddenChar"><input type="text" value="⊫" readonly=""> <span>Double Vertical Bar Double Right Turnstile</span></div>
			<div class="hiddenChar"><input type="text" value="⊬" readonly=""> <span>Does Not Prove</span></div>
			<div class="hiddenChar"><input type="text" value="⊭" readonly=""> <span>Not True</span></div>
			<div class="hiddenChar"><input type="text" value="⊮" readonly=""> <span>Does Not Force</span></div>
			<div class="hiddenChar"><input type="text" value="⊯" readonly=""> <span>Negated Double Vertical Bar Double Right Turnstile</span></div>
			<div class="hiddenChar"><input type="text" value="⊰" readonly=""> <span>Precedes Under Relation</span></div>
			<div class="hiddenChar"><input type="text" value="⊱" readonly=""> <span>Succeeds Under Relation</span></div>
			<div class="hiddenChar"><input type="text" value="⊲" readonly=""> <span>Normal Subgroup Of</span></div>
			<div class="hiddenChar"><input type="text" value="⊳" readonly=""> <span>Contains As Normal Subgroup</span></div>
			<div class="hiddenChar"><input type="text" value="⊴" readonly=""> <span>Normal Subgroup Of Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊵" readonly=""> <span>Contains As Normal Subgroup Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊶" readonly=""> <span>Original Of</span></div>
			<div class="hiddenChar"><input type="text" value="⊷" readonly=""> <span>Image Of</span></div>
			<div class="hiddenChar"><input type="text" value="⊸" readonly=""> <span>Multimap</span></div>
			<div class="hiddenChar"><input type="text" value="⊹" readonly=""> <span>Hermitian Conjugate Matrix</span></div>
			<div class="hiddenChar"><input type="text" value="⊺" readonly=""> <span>Intercalate</span></div>
			<div class="hiddenChar"><input type="text" value="⊻" readonly=""> <span>Xor</span></div>
			<div class="hiddenChar"><input type="text" value="⊼" readonly=""> <span>Nand</span></div>
			<div class="hiddenChar"><input type="text" value="⊽" readonly=""> <span>Nor</span></div>
			<div class="hiddenChar"><input type="text" value="⊾" readonly=""> <span>Right Angle With Arc</span></div>
			<div class="hiddenChar"><input type="text" value="⊿" readonly=""> <span>Right Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="⋀" readonly=""> <span>N-ary Logical And</span></div>
			<div class="hiddenChar"><input type="text" value="⋁" readonly=""> <span>N-ary Logical Or</span></div>
			<div class="hiddenChar"><input type="text" value="⋂" readonly=""> <span>N-ary Intersection</span></div>
			<div class="hiddenChar"><input type="text" value="⋃" readonly=""> <span>N-ary Union</span></div>
			<div class="hiddenChar"><input type="text" value="⋄" readonly=""> <span>Diamond Operator</span></div>
			<div class="hiddenChar"><input type="text" value="⋅" readonly=""> <span>Dot Operator</span></div>
			<div class="hiddenChar"><input type="text" value="⋆" readonly=""> <span>Star Operator</span></div>
			<div class="hiddenChar"><input type="text" value="⋇" readonly=""> <span>Division Times</span></div>
			<div class="hiddenChar"><input type="text" value="⋈" readonly=""> <span>Bowtie</span></div>
			<div class="hiddenChar"><input type="text" value="⋉" readonly=""> <span>Left Normal Factor Semidirect Product</span></div>
			<div class="hiddenChar"><input type="text" value="⋊" readonly=""> <span>Right Normal Factor Semidirect Product</span></div>
			<div class="hiddenChar"><input type="text" value="⋋" readonly=""> <span>Left Semidirect Product</span></div>
			<div class="hiddenChar"><input type="text" value="⋌" readonly=""> <span>Right Semidirect Product</span></div>
			<div class="hiddenChar"><input type="text" value="⋍" readonly=""> <span>Reversed Tilde Equals</span></div>
			<div class="hiddenChar"><input type="text" value="⋎" readonly=""> <span>Curly Logical Or</span></div>
			<div class="hiddenChar"><input type="text" value="⋏" readonly=""> <span>Curly Logical And</span></div>
			<div class="hiddenChar"><input type="text" value="⋐" readonly=""> <span>Double Subset</span></div>
			<div class="hiddenChar"><input type="text" value="⋑" readonly=""> <span>Double Superset</span></div>
			<div class="hiddenChar"><input type="text" value="⋒" readonly=""> <span>Double Intersection</span></div>
			<div class="hiddenChar"><input type="text" value="⋓" readonly=""> <span>Double Union</span></div>
			<div class="hiddenChar"><input type="text" value="⋔" readonly=""> <span>Pitchfork</span></div>
			<div class="hiddenChar"><input type="text" value="⋕" readonly=""> <span>Equal And Parallel To</span></div>
			<div class="hiddenChar"><input type="text" value="⋖" readonly=""> <span>Less-than With Dot</span></div>
			<div class="hiddenChar"><input type="text" value="⋗" readonly=""> <span>Greater-than With Dot</span></div>
			<div class="hiddenChar"><input type="text" value="⋘" readonly=""> <span>Very Much Less-than</span></div>
			<div class="hiddenChar"><input type="text" value="⋙" readonly=""> <span>Very Much Greater-than</span></div>
			<div class="hiddenChar"><input type="text" value="⋚" readonly=""> <span>Less-than Equal To Or Greater-than</span></div>
			<div class="hiddenChar"><input type="text" value="⋛" readonly=""> <span>Greater-than Equal To Or Less-than</span></div>
			<div class="hiddenChar"><input type="text" value="⋜" readonly=""> <span>Equal To Or Less-than</span></div>
			<div class="hiddenChar"><input type="text" value="⋝" readonly=""> <span>Equal To Or Greater-than</span></div>
			<div class="hiddenChar"><input type="text" value="⋞" readonly=""> <span>Equal To Or Precedes</span></div>
			<div class="hiddenChar"><input type="text" value="⋟" readonly=""> <span>Equal To Or Succeeds</span></div>
			<div class="hiddenChar"><input type="text" value="⋠" readonly=""> <span>Does Not Precede Or Equal</span></div>
			<div class="hiddenChar"><input type="text" value="⋡" readonly=""> <span>Does Not Succeed Or Equal</span></div>
			<div class="hiddenChar"><input type="text" value="⋢" readonly=""> <span>Not Square Image Of Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⋣" readonly=""> <span>Not Square Original Of Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⋤" readonly=""> <span>Square Image Of Or Not Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⋥" readonly=""> <span>Square Original Of Or Not Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⋦" readonly=""> <span>Less-than But Not Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="⋧" readonly=""> <span>Greater-than But Not Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="⋨" readonly=""> <span>Precedes But Not Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="⋩" readonly=""> <span>Succeeds But Not Equivalent To</span></div>
			<div class="hiddenChar"><input type="text" value="⋪" readonly=""> <span>Not Normal Subgroup Of</span></div>
			<div class="hiddenChar"><input type="text" value="⋫" readonly=""> <span>Does Not Contain As Normal Subgroup</span></div>
			<div class="hiddenChar"><input type="text" value="⋬" readonly=""> <span>Not Normal Subgroup Of Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⋭" readonly=""> <span>Does Not Contain As Normal Subgroup Or Equal</span></div>
			<div class="hiddenChar"><input type="text" value="⋮" readonly=""> <span>Vertical Ellipsis</span></div>
			<div class="hiddenChar"><input type="text" value="⋯" readonly=""> <span>Midline Horizontal Ellipsis</span></div>
			<div class="hiddenChar"><input type="text" value="⋰" readonly=""> <span>Up Right Diagonal Ellipsis</span></div>
			<div class="hiddenChar"><input type="text" value="⋱" readonly=""> <span>Down Right Diagonal Ellipsis</span></div>
			<div class="hiddenChar"><input type="text" value="⋲" readonly=""> <span>Element Of With Long Horizontal Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⋳" readonly=""> <span>Element Of With Vertical Bar At End Of Horizontal Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⋴" readonly=""> <span>Small Element Of With Vertical Bar At End Of Horizontal Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⋵" readonly=""> <span>Element Of With Dot Above</span></div>
			<div class="hiddenChar"><input type="text" value="⋶" readonly=""> <span>Element Of With Overbar</span></div>
			<div class="hiddenChar"><input type="text" value="⋷" readonly=""> <span>Small Element Of With Overbar</span></div>
			<div class="hiddenChar"><input type="text" value="⋸" readonly=""> <span>Element Of With Underbar</span></div>
			<div class="hiddenChar"><input type="text" value="⋹" readonly=""> <span>Element Of With Two Horizontal Strokes</span></div>
			<div class="hiddenChar"><input type="text" value="⋺" readonly=""> <span>Contains With Long Horizontal Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⋻" readonly=""> <span>Contains With Vertical Bar At End Of Horizontal Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⋼" readonly=""> <span>Small Contains With Vertical Bar At End Of Horizontal Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⋽" readonly=""> <span>Contains With Overbar</span></div>
			<div class="hiddenChar"><input type="text" value="⋾" readonly=""> <span>Small Contains With Overbar</span></div>
			<div class="hiddenChar"><input type="text" value="⋿" readonly=""> <span>Z Notation Bag Membership</span></div>
			<div class="hiddenChar"><input type="text" value="☀" readonly=""> <span>Black Sun With Rays</span></div>
			<div class="hiddenChar"><input type="text" value="☁" readonly=""> <span>Cloud</span></div>
			<div class="hiddenChar"><input type="text" value="☂" readonly=""> <span>Umbrella</span></div>
			<div class="hiddenChar"><input type="text" value="☃" readonly=""> <span>Snowman</span></div>
			<div class="hiddenChar"><input type="text" value="☄" readonly=""> <span>Comet</span></div>
			<div class="hiddenChar"><input type="text" value="★" readonly=""> <span>Black Star</span></div>
			<div class="hiddenChar"><input type="text" value="☆" readonly=""> <span>White Star</span></div>
			<div class="hiddenChar"><input type="text" value="☇" readonly=""> <span>Lightning</span></div>
			<div class="hiddenChar"><input type="text" value="☈" readonly=""> <span>Thunderstorm</span></div>
			<div class="hiddenChar"><input type="text" value="☉" readonly=""> <span>Sun</span></div>
			<div class="hiddenChar"><input type="text" value="☊" readonly=""> <span>Ascending Node</span></div>
			<div class="hiddenChar"><input type="text" value="☋" readonly=""> <span>Descending Node</span></div>
			<div class="hiddenChar"><input type="text" value="☌" readonly=""> <span>Conjunction</span></div>
			<div class="hiddenChar"><input type="text" value="☍" readonly=""> <span>Opposition</span></div>
			<div class="hiddenChar"><input type="text" value="☎" readonly=""> <span>Black Telephone</span></div>
			<div class="hiddenChar"><input type="text" value="☏" readonly=""> <span>White Telephone</span></div>
			<div class="hiddenChar"><input type="text" value="☐" readonly=""> <span>Ballot Box</span></div>
			<div class="hiddenChar"><input type="text" value="☑" readonly=""> <span>Ballot Box With Check</span></div>
			<div class="hiddenChar"><input type="text" value="☒" readonly=""> <span>Ballot Box With X</span></div>
			<div class="hiddenChar"><input type="text" value="☓" readonly=""> <span>Saltire</span></div>
			<div class="hiddenChar"><input type="text" value="☔" readonly=""> <span>Umbrella With Rain Drops</span></div>
			<div class="hiddenChar"><input type="text" value="☕" readonly=""> <span>Hot Beverage</span></div>
			<div class="hiddenChar"><input type="text" value="☖" readonly=""> <span>White Shogi Piece</span></div>
			<div class="hiddenChar"><input type="text" value="☗" readonly=""> <span>Black Shogi Piece</span></div>
			<div class="hiddenChar"><input type="text" value="☘" readonly=""> <span>Shamrock</span></div>
			<div class="hiddenChar"><input type="text" value="☙" readonly=""> <span>Reversed Rotated Floral Heart Bullet</span></div>
			<div class="hiddenChar"><input type="text" value="☚" readonly=""> <span>Black Left Pointing Index</span></div>
			<div class="hiddenChar"><input type="text" value="☛" readonly=""> <span>Black Right Pointing Index</span></div>
			<div class="hiddenChar"><input type="text" value="☜" readonly=""> <span>White Left Pointing Index</span></div>
			<div class="hiddenChar"><input type="text" value="☝" readonly=""> <span>White Up Pointing Index</span></div>
			<div class="hiddenChar"><input type="text" value="☞" readonly=""> <span>White Right Pointing Index</span></div>
			<div class="hiddenChar"><input type="text" value="☟" readonly=""> <span>White Down Pointing Index</span></div>
			<div class="hiddenChar"><input type="text" value="☠" readonly=""> <span>Skull And Crossbones</span></div>
			<div class="hiddenChar"><input type="text" value="☡" readonly=""> <span>Caution Sign</span></div>
			<div class="hiddenChar"><input type="text" value="☢" readonly=""> <span>Radioactive Sign</span></div>
			<div class="hiddenChar"><input type="text" value="☣" readonly=""> <span>Biohazard Sign</span></div>
			<div class="hiddenChar"><input type="text" value="☤" readonly=""> <span>Caduceus</span></div>
			<div class="hiddenChar"><input type="text" value="☥" readonly=""> <span>Ankh</span></div>
			<div class="hiddenChar"><input type="text" value="☦" readonly=""> <span>Orthodox Cross</span></div>
			<div class="hiddenChar"><input type="text" value="☧" readonly=""> <span>Chi Rho</span></div>
			<div class="hiddenChar"><input type="text" value="☨" readonly=""> <span>Cross Of Lorraine</span></div>
			<div class="hiddenChar"><input type="text" value="☩" readonly=""> <span>Cross Of Jerusalem</span></div>
			<div class="hiddenChar"><input type="text" value="☪" readonly=""> <span>Star And Crescent</span></div>
			<div class="hiddenChar"><input type="text" value="☫" readonly=""> <span>Farsi Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="☬" readonly=""> <span>Khanda</span></div>
			<div class="hiddenChar"><input type="text" value="☭" readonly=""> <span>Hammer And Sickle</span></div>
			<div class="hiddenChar"><input type="text" value="☮" readonly=""> <span>Peace Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="☯" readonly=""> <span>Yin Yang</span></div>
			<div class="hiddenChar"><input type="text" value="☰" readonly=""> <span>Trigram For Heaven</span></div>
			<div class="hiddenChar"><input type="text" value="☱" readonly=""> <span>Trigram For Lake</span></div>
			<div class="hiddenChar"><input type="text" value="☲" readonly=""> <span>Trigram For Fire</span></div>
			<div class="hiddenChar"><input type="text" value="☳" readonly=""> <span>Trigram For Thunder</span></div>
			<div class="hiddenChar"><input type="text" value="☴" readonly=""> <span>Trigram For Wind</span></div>
			<div class="hiddenChar"><input type="text" value="☵" readonly=""> <span>Trigram For Water</span></div>
			<div class="hiddenChar"><input type="text" value="☶" readonly=""> <span>Trigram For Mountain</span></div>
			<div class="hiddenChar"><input type="text" value="☷" readonly=""> <span>Trigram For Earth</span></div>
			<div class="hiddenChar"><input type="text" value="☸" readonly=""> <span>Wheel Of Dharma</span></div>
			<div class="hiddenChar"><input type="text" value="☹" readonly=""> <span>White Frowning Face</span></div>
			<div class="hiddenChar"><input type="text" value="☺" readonly=""> <span>White Smiling Face</span></div>
			<div class="hiddenChar"><input type="text" value="☻" readonly=""> <span>Black Smiling Face</span></div>
			<div class="hiddenChar"><input type="text" value="☼" readonly=""> <span>White Sun With Rays</span></div>
			<div class="hiddenChar"><input type="text" value="☽" readonly=""> <span>First Quarter Moon</span></div>
			<div class="hiddenChar"><input type="text" value="☾" readonly=""> <span>Last Quarter Moon</span></div>
			<div class="hiddenChar"><input type="text" value="☿" readonly=""> <span>Mercury</span></div>
			<div class="hiddenChar"><input type="text" value="♀" readonly=""> <span>Female Sign</span></div>
			<div class="hiddenChar"><input type="text" value="♁" readonly=""> <span>Earth</span></div>
			<div class="hiddenChar"><input type="text" value="♂" readonly=""> <span>Male Sign</span></div>
			<div class="hiddenChar"><input type="text" value="♃" readonly=""> <span>Jupiter</span></div>
			<div class="hiddenChar"><input type="text" value="♄" readonly=""> <span>Saturn</span></div>
			<div class="hiddenChar"><input type="text" value="♅" readonly=""> <span>Uranus</span></div>
			<div class="hiddenChar"><input type="text" value="♆" readonly=""> <span>Neptune</span></div>
			<div class="hiddenChar"><input type="text" value="♇" readonly=""> <span>Pluto</span></div>
			<div class="hiddenChar"><input type="text" value="♔" readonly=""> <span>White Chess King</span></div>
			<div class="hiddenChar"><input type="text" value="♕" readonly=""> <span>White Chess Queen</span></div>
			<div class="hiddenChar"><input type="text" value="♖" readonly=""> <span>White Chess Rook</span></div>
			<div class="hiddenChar"><input type="text" value="♗" readonly=""> <span>White Chess Bishop</span></div>
			<div class="hiddenChar"><input type="text" value="♘" readonly=""> <span>White Chess Knight</span></div>
			<div class="hiddenChar"><input type="text" value="♙" readonly=""> <span>White Chess Pawn</span></div>
			<div class="hiddenChar"><input type="text" value="♚" readonly=""> <span>Black Chess King</span></div>
			<div class="hiddenChar"><input type="text" value="♛" readonly=""> <span>Black Chess Queen</span></div>
			<div class="hiddenChar"><input type="text" value="♜" readonly=""> <span>Black Chess Rook</span></div>
			<div class="hiddenChar"><input type="text" value="♝" readonly=""> <span>Black Chess Bishop</span></div>
			<div class="hiddenChar"><input type="text" value="♞" readonly=""> <span>Black Chess Knight</span></div>
			<div class="hiddenChar"><input type="text" value="♟" readonly=""> <span>Black Chess Pawn</span></div>
			<div class="hiddenChar"><input type="text" value="♠" readonly=""> <span>Black Spade Suit</span></div>
			<div class="hiddenChar"><input type="text" value="♡" readonly=""> <span>White Heart Suit</span></div>
			<div class="hiddenChar"><input type="text" value="♢" readonly=""> <span>White Diamond Suit</span></div>
			<div class="hiddenChar"><input type="text" value="♣" readonly=""> <span>Black Club Suit</span></div>
			<div class="hiddenChar"><input type="text" value="♤" readonly=""> <span>White Spade Suit</span></div>
			<div class="hiddenChar"><input type="text" value="♥" readonly=""> <span>Black Heart Suit</span></div>
			<div class="hiddenChar"><input type="text" value="♦" readonly=""> <span>Black Diamond Suit</span></div>
			<div class="hiddenChar"><input type="text" value="♧" readonly=""> <span>White Club Suit</span></div>
			<div class="hiddenChar"><input type="text" value="♨" readonly=""> <span>Hot Springs</span></div>
			<div class="hiddenChar"><input type="text" value="♩" readonly=""> <span>Quarter Note</span></div>
			<div class="hiddenChar"><input type="text" value="♪" readonly=""> <span>Eighth Note</span></div>
			<div class="hiddenChar"><input type="text" value="♫" readonly=""> <span>Beamed Eighth Notes</span></div>
			<div class="hiddenChar"><input type="text" value="♬" readonly=""> <span>Beamed Sixteenth Notes</span></div>
			<div class="hiddenChar"><input type="text" value="♭" readonly=""> <span>Music Flat Sign</span></div>
			<div class="hiddenChar"><input type="text" value="♮" readonly=""> <span>Music Natural Sign</span></div>
			<div class="hiddenChar"><input type="text" value="♯" readonly=""> <span>Music Sharp Sign</span></div>
			<div class="hiddenChar"><input type="text" value="♰" readonly=""> <span>West Syriac Cross</span></div>
			<div class="hiddenChar"><input type="text" value="♱" readonly=""> <span>East Syriac Cross</span></div>
			<div class="hiddenChar"><input type="text" value="♲" readonly=""> <span>Universal Recycling Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="♳" readonly=""> <span>Recycling Symbol For Type-1 Plastics</span></div>
			<div class="hiddenChar"><input type="text" value="♴" readonly=""> <span>Recycling Symbol For Type-2 Plastics</span></div>
			<div class="hiddenChar"><input type="text" value="♵" readonly=""> <span>Recycling Symbol For Type-3 Plastics</span></div>
			<div class="hiddenChar"><input type="text" value="♶" readonly=""> <span>Recycling Symbol For Type-4 Plastics</span></div>
			<div class="hiddenChar"><input type="text" value="♷" readonly=""> <span>Recycling Symbol For Type-5 Plastics</span></div>
			<div class="hiddenChar"><input type="text" value="♸" readonly=""> <span>Recycling Symbol For Type-6 Plastics</span></div>
			<div class="hiddenChar"><input type="text" value="♹" readonly=""> <span>Recycling Symbol For Type-7 Plastics</span></div>
			<div class="hiddenChar"><input type="text" value="♺" readonly=""> <span>Recycling Symbol For Generic Materials</span></div>
			<div class="hiddenChar"><input type="text" value="♻" readonly=""> <span>Black Universal Recycling Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="♼" readonly=""> <span>Recycled Paper Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="♽" readonly=""> <span>Partially-recycled Paper Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="♾" readonly=""> <span>Permanent Paper Sign</span></div>
			<div class="hiddenChar"><input type="text" value="♿" readonly=""> <span>Wheelchair Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="⚀" readonly=""> <span>Die Face-1</span></div>
			<div class="hiddenChar"><input type="text" value="⚁" readonly=""> <span>Die Face-2</span></div>
			<div class="hiddenChar"><input type="text" value="⚂" readonly=""> <span>Die Face-3</span></div>
			<div class="hiddenChar"><input type="text" value="⚃" readonly=""> <span>Die Face-4</span></div>
			<div class="hiddenChar"><input type="text" value="⚄" readonly=""> <span>Die Face-5</span></div>
			<div class="hiddenChar"><input type="text" value="⚅" readonly=""> <span>Die Face-6</span></div>
			<div class="hiddenChar"><input type="text" value="⚆" readonly=""> <span>White Circle With Dot Right</span></div>
			<div class="hiddenChar"><input type="text" value="⚇" readonly=""> <span>White Circle With Two Dots</span></div>
			<div class="hiddenChar"><input type="text" value="⚈" readonly=""> <span>Black Circle With White Dot Right</span></div>
			<div class="hiddenChar"><input type="text" value="⚉" readonly=""> <span>Black Circle With Two White Dots</span></div>
			<div class="hiddenChar"><input type="text" value="⚊" readonly=""> <span>Monogram For Yang</span></div>
			<div class="hiddenChar"><input type="text" value="⚋" readonly=""> <span>Monogram For Yin</span></div>
			<div class="hiddenChar"><input type="text" value="⚌" readonly=""> <span>Digram For Greater Yang</span></div>
			<div class="hiddenChar"><input type="text" value="⚍" readonly=""> <span>Digram For Lesser Yin</span></div>
			<div class="hiddenChar"><input type="text" value="⚎" readonly=""> <span>Digram For Lesser Yang</span></div>
			<div class="hiddenChar"><input type="text" value="⚏" readonly=""> <span>Digram For Greater Yin</span></div>
			<div class="hiddenChar"><input type="text" value="⚐" readonly=""> <span>White Flag</span></div>
			<div class="hiddenChar"><input type="text" value="⚑" readonly=""> <span>Black Flag</span></div>
			<div class="hiddenChar"><input type="text" value="⚓" readonly=""> <span>Anchor</span></div>
			<div class="hiddenChar"><input type="text" value="⚔" readonly=""> <span>Crossed Swords</span></div>
			<div class="hiddenChar"><input type="text" value="⚕" readonly=""> <span>Staff Of Aesculapius</span></div>
			<div class="hiddenChar"><input type="text" value="⚖" readonly=""> <span>Scales</span></div>
			<div class="hiddenChar"><input type="text" value="⚗" readonly=""> <span>Alembic</span></div>
			<div class="hiddenChar"><input type="text" value="⚘" readonly=""> <span>Flower</span></div>
			<div class="hiddenChar"><input type="text" value="⚙" readonly=""> <span>Gear</span></div>
			<div class="hiddenChar"><input type="text" value="⚚" readonly=""> <span>Staff Of Hermes</span></div>
			<div class="hiddenChar"><input type="text" value="⚛" readonly=""> <span>Atom Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="⚜" readonly=""> <span>Fleur-de-lis</span></div>
			<div class="hiddenChar"><input type="text" value="⚝" readonly=""> <span>Outlined White Star</span></div>
			<div class="hiddenChar"><input type="text" value="⚞" readonly=""> <span>Three Lines Converging Right</span></div>
			<div class="hiddenChar"><input type="text" value="⚟" readonly=""> <span>Three Lines Converging Left</span></div>
			<div class="hiddenChar"><input type="text" value="⚠" readonly=""> <span>Warning Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⚡" readonly=""> <span>High Voltage Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⚢" readonly=""> <span>Doubled Female Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⚣" readonly=""> <span>Doubled Male Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⚤" readonly=""> <span>Interlocked Female And Male Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⚥" readonly=""> <span>Male And Female Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⚦" readonly=""> <span>Male With Stroke Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⚧" readonly=""> <span>Male With Stroke And Male And Female Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⚨" readonly=""> <span>Vertical Male With Stroke Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⚩" readonly=""> <span>Horizontal Male With Stroke Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⚪" readonly=""> <span>Medium White Circle</span></div>
			<div class="hiddenChar"><input type="text" value="⚫" readonly=""> <span>Medium Black Circle</span></div>
			<div class="hiddenChar"><input type="text" value="⚬" readonly=""> <span>Medium Small White Circle</span></div>
			<div class="hiddenChar"><input type="text" value="⚭" readonly=""> <span>Marriage Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="⚮" readonly=""> <span>Divorce Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="⚯" readonly=""> <span>Unmarried Partnership Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="⚰" readonly=""> <span>Coffin</span></div>
			<div class="hiddenChar"><input type="text" value="⚱" readonly=""> <span>Funeral Urn</span></div>
			<div class="hiddenChar"><input type="text" value="⚲" readonly=""> <span>Neuter</span></div>
			<div class="hiddenChar"><input type="text" value="⚳" readonly=""> <span>Ceres</span></div>
			<div class="hiddenChar"><input type="text" value="⚴" readonly=""> <span>Pallas</span></div>
			<div class="hiddenChar"><input type="text" value="⚵" readonly=""> <span>Juno</span></div>
			<div class="hiddenChar"><input type="text" value="⚶" readonly=""> <span>Vesta</span></div>
			<div class="hiddenChar"><input type="text" value="⚷" readonly=""> <span>Chiron</span></div>
			<div class="hiddenChar"><input type="text" value="⚸" readonly=""> <span>Black Moon Lilith</span></div>
			<div class="hiddenChar"><input type="text" value="⚹" readonly=""> <span>Sextile</span></div>
			<div class="hiddenChar"><input type="text" value="⚺" readonly=""> <span>Semisextile</span></div>
			<div class="hiddenChar"><input type="text" value="⚻" readonly=""> <span>Quincunx</span></div>
			<div class="hiddenChar"><input type="text" value="⚼" readonly=""> <span>Sesquiquadrate</span></div>
			<div class="hiddenChar"><input type="text" value="⚽" readonly=""> <span>Soccer Ball</span></div>
			<div class="hiddenChar"><input type="text" value="⚾" readonly=""> <span>Baseball</span></div>
			<div class="hiddenChar"><input type="text" value="⚿" readonly=""> <span>Squared Key</span></div>
			<div class="hiddenChar"><input type="text" value="⛀" readonly=""> <span>White Draughts Man</span></div>
			<div class="hiddenChar"><input type="text" value="⛁" readonly=""> <span>White Draughts King</span></div>
			<div class="hiddenChar"><input type="text" value="⛂" readonly=""> <span>Black Draughts Man</span></div>
			<div class="hiddenChar"><input type="text" value="⛃" readonly=""> <span>Black Draughts King</span></div>
			<div class="hiddenChar"><input type="text" value="⛄" readonly=""> <span>Snowman Without Snow</span></div>
			<div class="hiddenChar"><input type="text" value="⛅" readonly=""> <span>Sun Behind Cloud</span></div>
			<div class="hiddenChar"><input type="text" value="⛆" readonly=""> <span>Rain</span></div>
			<div class="hiddenChar"><input type="text" value="⛇" readonly=""> <span>Black Snowman</span></div>
			<div class="hiddenChar"><input type="text" value="⛈" readonly=""> <span>Thunder Cloud And Rain</span></div>
			<div class="hiddenChar"><input type="text" value="⛉" readonly=""> <span>Turned White Shogi Piece</span></div>
			<div class="hiddenChar"><input type="text" value="⛊" readonly=""> <span>Turned Black Shogi Piece</span></div>
			<div class="hiddenChar"><input type="text" value="⛋" readonly=""> <span>White Diamond In Square</span></div>
			<div class="hiddenChar"><input type="text" value="⛌" readonly=""> <span>Crossing Lanes</span></div>
			<div class="hiddenChar"><input type="text" value="⛍" readonly=""> <span>Disabled Car</span></div>
			<div class="hiddenChar"><input type="text" value="⛎" readonly=""> <span>Ophiuchus</span></div>
			<div class="hiddenChar"><input type="text" value="⛏" readonly=""> <span>Pick</span></div>
			<div class="hiddenChar"><input type="text" value="⛐" readonly=""> <span>Car Sliding</span></div>
			<div class="hiddenChar"><input type="text" value="⛑" readonly=""> <span>Helmet With White Cross</span></div>
			<div class="hiddenChar"><input type="text" value="⛒" readonly=""> <span>Circled Crossing Lanes</span></div>
			<div class="hiddenChar"><input type="text" value="⛓" readonly=""> <span>Chains</span></div>
			<div class="hiddenChar"><input type="text" value="⛔" readonly=""> <span>No Entry</span></div>
			<div class="hiddenChar"><input type="text" value="⛕" readonly=""> <span>Alternate One-way Left Way Traffic</span></div>
			<div class="hiddenChar"><input type="text" value="⛖" readonly=""> <span>Black Two-way Left Way Traffic</span></div>
			<div class="hiddenChar"><input type="text" value="⛗" readonly=""> <span>White Two-way Left Way Traffic</span></div>
			<div class="hiddenChar"><input type="text" value="⛘" readonly=""> <span>Black Left Lane Merge</span></div>
			<div class="hiddenChar"><input type="text" value="⛙" readonly=""> <span>White Left Lane Merge</span></div>
			<div class="hiddenChar"><input type="text" value="⛚" readonly=""> <span>Drive Slow Sign</span></div>
			<div class="hiddenChar"><input type="text" value="⛛" readonly=""> <span>Heavy White Down-pointing Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="⛜" readonly=""> <span>Left Closed Entry</span></div>
			<div class="hiddenChar"><input type="text" value="⛝" readonly=""> <span>Squared Saltire</span></div>
			<div class="hiddenChar"><input type="text" value="⛞" readonly=""> <span>Falling Diagonal In White Circle In Black Square</span></div>
			<div class="hiddenChar"><input type="text" value="⛟" readonly=""> <span>Black Truck</span></div>
			<div class="hiddenChar"><input type="text" value="⛠" readonly=""> <span>Restricted Left Entry-1</span></div>
			<div class="hiddenChar"><input type="text" value="⛡" readonly=""> <span>Restricted Left Entry-2</span></div>
			<div class="hiddenChar"><input type="text" value="⛢" readonly=""> <span>Astronomical Symbol For Uranus</span></div>
			<div class="hiddenChar"><input type="text" value="⛣" readonly=""> <span>Heavy Circle With Stroke And Two Dots Above</span></div>
			<div class="hiddenChar"><input type="text" value="⛤" readonly=""> <span>Pentagram</span></div>
			<div class="hiddenChar"><input type="text" value="⛥" readonly=""> <span>Right-handed Interlaced Pentagram</span></div>
			<div class="hiddenChar"><input type="text" value="⛦" readonly=""> <span>Left-handed Interlaced Pentagram</span></div>
			<div class="hiddenChar"><input type="text" value="⛧" readonly=""> <span>Inverted Pentagram</span></div>
			<div class="hiddenChar"><input type="text" value="⛨" readonly=""> <span>Black Cross On Shield</span></div>
			<div class="hiddenChar"><input type="text" value="⛩" readonly=""> <span>Shinto Shrine</span></div>
			<div class="hiddenChar"><input type="text" value="⛪" readonly=""> <span>Church</span></div>
			<div class="hiddenChar"><input type="text" value="⛫" readonly=""> <span>Castle</span></div>
			<div class="hiddenChar"><input type="text" value="⛬" readonly=""> <span>Historic Site</span></div>
			<div class="hiddenChar"><input type="text" value="⛭" readonly=""> <span>Gear Without Hub</span></div>
			<div class="hiddenChar"><input type="text" value="⛮" readonly=""> <span>Gear With Handles</span></div>
			<div class="hiddenChar"><input type="text" value="⛯" readonly=""> <span>Map Symbol For Lighthouse</span></div>
			<div class="hiddenChar"><input type="text" value="⛰" readonly=""> <span>Mountain</span></div>
			<div class="hiddenChar"><input type="text" value="⛱" readonly=""> <span>Umbrella On Ground</span></div>
			<div class="hiddenChar"><input type="text" value="⛲" readonly=""> <span>Fountain</span></div>
			<div class="hiddenChar"><input type="text" value="⛳" readonly=""> <span>Flag In Hole</span></div>
			<div class="hiddenChar"><input type="text" value="⛴" readonly=""> <span>Ferry</span></div>
			<div class="hiddenChar"><input type="text" value="⛵" readonly=""> <span>Sailboat</span></div>
			<div class="hiddenChar"><input type="text" value="⛶" readonly=""> <span>Square Four Corners</span></div>
			<div class="hiddenChar"><input type="text" value="⛷" readonly=""> <span>Skier</span></div>
			<div class="hiddenChar"><input type="text" value="⛸" readonly=""> <span>Ice Skate</span></div>
			<div class="hiddenChar"><input type="text" value="⛹" readonly=""> <span>Person With Ball</span></div>
			<div class="hiddenChar"><input type="text" value="⛺" readonly=""> <span>Tent</span></div>
			<div class="hiddenChar"><input type="text" value="⛻" readonly=""> <span>Japanese Bank Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="⛼" readonly=""> <span>Headstone Graveyard Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="⛽" readonly=""> <span>Fuel Pump</span></div>
			<div class="hiddenChar"><input type="text" value="⛾" readonly=""> <span>Cup On Black Square</span></div>
			<div class="hiddenChar"><input type="text" value="⛿" readonly=""> <span>White Flag With Horizontal Middle Black Stripe</span></div>
			<div class="hiddenChar"><input type="text" value="✁" readonly=""> <span>Upper Blade Scissors</span></div>
			<div class="hiddenChar"><input type="text" value="✂" readonly=""> <span>Black Scissors</span></div>
			<div class="hiddenChar"><input type="text" value="✃" readonly=""> <span>Lower Blade Scissors</span></div>
			<div class="hiddenChar"><input type="text" value="✄" readonly=""> <span>White Scissors</span></div>
			<div class="hiddenChar"><input type="text" value="✅" readonly=""> <span>White Heavy Check Mark</span></div>
			<div class="hiddenChar"><input type="text" value="✆" readonly=""> <span>Telephone Location Sign</span></div>
			<div class="hiddenChar"><input type="text" value="✇" readonly=""> <span>Tape Drive</span></div>
			<div class="hiddenChar"><input type="text" value="✈" readonly=""> <span>Airplane</span></div>
			<div class="hiddenChar"><input type="text" value="✉" readonly=""> <span>Envelope</span></div>
			<div class="hiddenChar"><input type="text" value="✊" readonly=""> <span>Raised Fist</span></div>
			<div class="hiddenChar"><input type="text" value="✋" readonly=""> <span>Raised Hand</span></div>
			<div class="hiddenChar"><input type="text" value="✌" readonly=""> <span>Victory Hand</span></div>
			<div class="hiddenChar"><input type="text" value="✍" readonly=""> <span>Writing Hand</span></div>
			<div class="hiddenChar"><input type="text" value="✎" readonly=""> <span>Lower Right Pencil</span></div>
			<div class="hiddenChar"><input type="text" value="✏" readonly=""> <span>Pencil</span></div>
			<div class="hiddenChar"><input type="text" value="✐" readonly=""> <span>Upper Right Pencil</span></div>
			<div class="hiddenChar"><input type="text" value="✑" readonly=""> <span>White Nib</span></div>
			<div class="hiddenChar"><input type="text" value="✒" readonly=""> <span>Black Nib</span></div>
			<div class="hiddenChar"><input type="text" value="✓" readonly=""> <span>Check Mark</span></div>
			<div class="hiddenChar"><input type="text" value="✔" readonly=""> <span>Heavy Check Mark</span></div>
			<div class="hiddenChar"><input type="text" value="✕" readonly=""> <span>Multiplication X</span></div>
			<div class="hiddenChar"><input type="text" value="✖" readonly=""> <span>Heavy Multiplication X</span></div>
			<div class="hiddenChar"><input type="text" value="✗" readonly=""> <span>Ballot X</span></div>
			<div class="hiddenChar"><input type="text" value="✘" readonly=""> <span>Heavy Ballot X</span></div>
			<div class="hiddenChar"><input type="text" value="✙" readonly=""> <span>Outlined Greek Cross</span></div>
			<div class="hiddenChar"><input type="text" value="✚" readonly=""> <span>Heavy Greek Cross</span></div>
			<div class="hiddenChar"><input type="text" value="✛" readonly=""> <span>Open Centre Cross</span></div>
			<div class="hiddenChar"><input type="text" value="✜" readonly=""> <span>Heavy Open Centre Cross</span></div>
			<div class="hiddenChar"><input type="text" value="✝" readonly=""> <span>Latin Cross</span></div>
			<div class="hiddenChar"><input type="text" value="✞" readonly=""> <span>Shadowed White Latin Cross</span></div>
			<div class="hiddenChar"><input type="text" value="✟" readonly=""> <span>Outlined Latin Cross</span></div>
			<div class="hiddenChar"><input type="text" value="✠" readonly=""> <span>Maltese Cross</span></div>
			<div class="hiddenChar"><input type="text" value="✡" readonly=""> <span>Star Of David</span></div>
			<div class="hiddenChar"><input type="text" value="✢" readonly=""> <span>Four Teardrop-spoked Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="✣" readonly=""> <span>Four Balloon-spoked Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="✤" readonly=""> <span>Heavy Four Balloon-spoked Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="✥" readonly=""> <span>Four Club-spoked Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="✦" readonly=""> <span>Black Four Pointed Star</span></div>
			<div class="hiddenChar"><input type="text" value="✧" readonly=""> <span>White Four Pointed Star</span></div>
			<div class="hiddenChar"><input type="text" value="✨" readonly=""> <span>Sparkles</span></div>
			<div class="hiddenChar"><input type="text" value="✩" readonly=""> <span>Stress Outlined White Star</span></div>
			<div class="hiddenChar"><input type="text" value="✪" readonly=""> <span>Circled White Star</span></div>
			<div class="hiddenChar"><input type="text" value="✫" readonly=""> <span>Open Centre Black Star</span></div>
			<div class="hiddenChar"><input type="text" value="✬" readonly=""> <span>Black Centre White Star</span></div>
			<div class="hiddenChar"><input type="text" value="✭" readonly=""> <span>Outlined Black Star</span></div>
			<div class="hiddenChar"><input type="text" value="✮" readonly=""> <span>Heavy Outlined Black Star</span></div>
			<div class="hiddenChar"><input type="text" value="✯" readonly=""> <span>Pinwheel Star</span></div>
			<div class="hiddenChar"><input type="text" value="✰" readonly=""> <span>Shadowed White Star</span></div>
			<div class="hiddenChar"><input type="text" value="✱" readonly=""> <span>Heavy Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="✲" readonly=""> <span>Open Centre Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="✳" readonly=""> <span>Eight Spoked Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="✴" readonly=""> <span>Eight Pointed Black Star</span></div>
			<div class="hiddenChar"><input type="text" value="✵" readonly=""> <span>Eight Pointed Pinwheel Star</span></div>
			<div class="hiddenChar"><input type="text" value="✶" readonly=""> <span>Six Pointed Black Star</span></div>
			<div class="hiddenChar"><input type="text" value="✷" readonly=""> <span>Eight Pointed Rectilinear Black Star</span></div>
			<div class="hiddenChar"><input type="text" value="✸" readonly=""> <span>Heavy Eight Pointed Rectilinear Black Star</span></div>
			<div class="hiddenChar"><input type="text" value="✹" readonly=""> <span>Twelve Pointed Black Star</span></div>
			<div class="hiddenChar"><input type="text" value="✺" readonly=""> <span>Sixteen Pointed Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="✻" readonly=""> <span>Teardrop-spoked Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="✼" readonly=""> <span>Open Centre Teardrop-spoked Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="✽" readonly=""> <span>Heavy Teardrop-spoked Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="✾" readonly=""> <span>Six Petalled Black And White Florette</span></div>
			<div class="hiddenChar"><input type="text" value="✿" readonly=""> <span>Black Florette</span></div>
			<div class="hiddenChar"><input type="text" value="❀" readonly=""> <span>White Florette</span></div>
			<div class="hiddenChar"><input type="text" value="❁" readonly=""> <span>Eight Petalled Outlined Black Florette</span></div>
			<div class="hiddenChar"><input type="text" value="❂" readonly=""> <span>Circled Open Centre Eight Pointed Star</span></div>
			<div class="hiddenChar"><input type="text" value="❃" readonly=""> <span>Heavy Teardrop-spoked Pinwheel Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="❄" readonly=""> <span>Snowflake</span></div>
			<div class="hiddenChar"><input type="text" value="❅" readonly=""> <span>Tight Trifoliate Snowflake</span></div>
			<div class="hiddenChar"><input type="text" value="❆" readonly=""> <span>Heavy Chevron Snowflake</span></div>
			<div class="hiddenChar"><input type="text" value="❇" readonly=""> <span>Sparkle</span></div>
			<div class="hiddenChar"><input type="text" value="❈" readonly=""> <span>Heavy Sparkle</span></div>
			<div class="hiddenChar"><input type="text" value="❉" readonly=""> <span>Balloon-spoked Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="❊" readonly=""> <span>Eight Teardrop-spoked Propeller Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="❋" readonly=""> <span>Heavy Eight Teardrop-spoked Propeller Asterisk</span></div>
			<div class="hiddenChar"><input type="text" value="❌" readonly=""> <span>Cross Mark</span></div>
			<div class="hiddenChar"><input type="text" value="❍" readonly=""> <span>Shadowed White Circle</span></div>
			<div class="hiddenChar"><input type="text" value="❎" readonly=""> <span>Negative Squared Cross Mark</span></div>
			<div class="hiddenChar"><input type="text" value="❏" readonly=""> <span>Lower Right Drop-shadowed White Square</span></div>
			<div class="hiddenChar"><input type="text" value="❐" readonly=""> <span>Upper Right Drop-shadowed White Square</span></div>
			<div class="hiddenChar"><input type="text" value="❑" readonly=""> <span>Lower Right Shadowed White Square</span></div>
			<div class="hiddenChar"><input type="text" value="❒" readonly=""> <span>Upper Right Shadowed White Square</span></div>
			<div class="hiddenChar"><input type="text" value="❓" readonly=""> <span>Black Question Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❔" readonly=""> <span>White Question Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❕" readonly=""> <span>White Exclamation Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❖" readonly=""> <span>Black Diamond Minus White X</span></div>
			<div class="hiddenChar"><input type="text" value="❗" readonly=""> <span>Heavy Exclamation Mark Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="❘" readonly=""> <span>Light Vertical Bar</span></div>
			<div class="hiddenChar"><input type="text" value="❙" readonly=""> <span>Medium Vertical Bar</span></div>
			<div class="hiddenChar"><input type="text" value="❚" readonly=""> <span>Heavy Vertical Bar</span></div>
			<div class="hiddenChar"><input type="text" value="❛" readonly=""> <span>Heavy Single Turned Comma Quotation Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❜" readonly=""> <span>Heavy Single Comma Quotation Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❝" readonly=""> <span>Heavy Double Turned Comma Quotation Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❞" readonly=""> <span>Heavy Double Comma Quotation Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❟" readonly=""> <span>Heavy Low Single Comma Quotation Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❠" readonly=""> <span>Heavy Low Double Comma Quotation Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❡" readonly=""> <span>Curved Stem Paragraph Sign Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❢" readonly=""> <span>Heavy Exclamation Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❣" readonly=""> <span>Heavy Heart Exclamation Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❤" readonly=""> <span>Heavy Black Heart</span></div>
			<div class="hiddenChar"><input type="text" value="❥" readonly=""> <span>Rotated Heavy Black Heart Bullet</span></div>
			<div class="hiddenChar"><input type="text" value="❦" readonly=""> <span>Floral Heart</span></div>
			<div class="hiddenChar"><input type="text" value="❧" readonly=""> <span>Rotated Floral Heart Bullet</span></div>
			<div class="hiddenChar"><input type="text" value="❨" readonly=""> <span>Medium Left Parenthesis Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❩" readonly=""> <span>Medium Right Parenthesis Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❪" readonly=""> <span>Medium Flattened Left Parenthesis Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❫" readonly=""> <span>Medium Flattened Right Parenthesis Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❬" readonly=""> <span>Medium Left-pointing Angle Bracket Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❭" readonly=""> <span>Medium Right-pointing Angle Bracket Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❮" readonly=""> <span>Heavy Left-pointing Angle Quotation Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❯" readonly=""> <span>Heavy Right-pointing Angle Quotation Mark Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❰" readonly=""> <span>Heavy Left-pointing Angle Bracket Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❱" readonly=""> <span>Heavy Right-pointing Angle Bracket Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❲" readonly=""> <span>Light Left Tortoise Shell Bracket Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❳" readonly=""> <span>Light Right Tortoise Shell Bracket Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❴" readonly=""> <span>Medium Left Curly Bracket Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❵" readonly=""> <span>Medium Right Curly Bracket Ornament</span></div>
			<div class="hiddenChar"><input type="text" value="❶" readonly=""> <span>Dingbat Negative Circled Digit One</span></div>
			<div class="hiddenChar"><input type="text" value="❷" readonly=""> <span>Dingbat Negative Circled Digit Two</span></div>
			<div class="hiddenChar"><input type="text" value="❸" readonly=""> <span>Dingbat Negative Circled Digit Three</span></div>
			<div class="hiddenChar"><input type="text" value="❹" readonly=""> <span>Dingbat Negative Circled Digit Four</span></div>
			<div class="hiddenChar"><input type="text" value="❺" readonly=""> <span>Dingbat Negative Circled Digit Five</span></div>
			<div class="hiddenChar"><input type="text" value="❻" readonly=""> <span>Dingbat Negative Circled Digit Six</span></div>
			<div class="hiddenChar"><input type="text" value="❼" readonly=""> <span>Dingbat Negative Circled Digit Seven</span></div>
			<div class="hiddenChar"><input type="text" value="❽" readonly=""> <span>Dingbat Negative Circled Digit Eight</span></div>
			<div class="hiddenChar"><input type="text" value="❾" readonly=""> <span>Dingbat Negative Circled Digit Nine</span></div>
			<div class="hiddenChar"><input type="text" value="❿" readonly=""> <span>Dingbat Negative Circled Number Ten</span></div>
			<div class="hiddenChar"><input type="text" value="➀" readonly=""> <span>Dingbat Circled Sans-serif Digit One</span></div>
			<div class="hiddenChar"><input type="text" value="➁" readonly=""> <span>Dingbat Circled Sans-serif Digit Two</span></div>
			<div class="hiddenChar"><input type="text" value="➂" readonly=""> <span>Dingbat Circled Sans-serif Digit Three</span></div>
			<div class="hiddenChar"><input type="text" value="➃" readonly=""> <span>Dingbat Circled Sans-serif Digit Four</span></div>
			<div class="hiddenChar"><input type="text" value="➄" readonly=""> <span>Dingbat Circled Sans-serif Digit Five</span></div>
			<div class="hiddenChar"><input type="text" value="➅" readonly=""> <span>Dingbat Circled Sans-serif Digit Six</span></div>
			<div class="hiddenChar"><input type="text" value="➆" readonly=""> <span>Dingbat Circled Sans-serif Digit Seven</span></div>
			<div class="hiddenChar"><input type="text" value="➇" readonly=""> <span>Dingbat Circled Sans-serif Digit Eight</span></div>
			<div class="hiddenChar"><input type="text" value="➈" readonly=""> <span>Dingbat Circled Sans-serif Digit Nine</span></div>
			<div class="hiddenChar"><input type="text" value="➉" readonly=""> <span>Dingbat Circled Sans-serif Number Ten</span></div>
			<div class="hiddenChar"><input type="text" value="➊" readonly=""> <span>Dingbat Negative Circled Sans-serif Digit One</span></div>
			<div class="hiddenChar"><input type="text" value="➋" readonly=""> <span>Dingbat Negative Circled Sans-serif Digit Two</span></div>
			<div class="hiddenChar"><input type="text" value="➌" readonly=""> <span>Dingbat Negative Circled Sans-serif Digit Three</span></div>
			<div class="hiddenChar"><input type="text" value="➍" readonly=""> <span>Dingbat Negative Circled Sans-serif Digit Four</span></div>
			<div class="hiddenChar"><input type="text" value="➎" readonly=""> <span>Dingbat Negative Circled Sans-serif Digit Five</span></div>
			<div class="hiddenChar"><input type="text" value="➏" readonly=""> <span>Dingbat Negative Circled Sans-serif Digit Six</span></div>
			<div class="hiddenChar"><input type="text" value="➐" readonly=""> <span>Dingbat Negative Circled Sans-serif Digit Seven</span></div>
			<div class="hiddenChar"><input type="text" value="➑" readonly=""> <span>Dingbat Negative Circled Sans-serif Digit Eight</span></div>
			<div class="hiddenChar"><input type="text" value="➒" readonly=""> <span>Dingbat Negative Circled Sans-serif Digit Nine</span></div>
			<div class="hiddenChar"><input type="text" value="➓" readonly=""> <span>Dingbat Negative Circled Sans-serif Number Ten</span></div>
			<div class="hiddenChar"><input type="text" value="➔" readonly=""> <span>Heavy Wide-headed Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➕" readonly=""> <span>Heavy Plus Sign</span></div>
			<div class="hiddenChar"><input type="text" value="➖" readonly=""> <span>Heavy Minus Sign</span></div>
			<div class="hiddenChar"><input type="text" value="➗" readonly=""> <span>Heavy Division Sign</span></div>
			<div class="hiddenChar"><input type="text" value="➘" readonly=""> <span>Heavy South East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➙" readonly=""> <span>Heavy Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➚" readonly=""> <span>Heavy North East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➛" readonly=""> <span>Drafting Point Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➜" readonly=""> <span>Heavy Round-tipped Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➝" readonly=""> <span>Triangle-headed Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➞" readonly=""> <span>Heavy Triangle-headed Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➟" readonly=""> <span>Dashed Triangle-headed Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➠" readonly=""> <span>Heavy Dashed Triangle-headed Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➡" readonly=""> <span>Black Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➢" readonly=""> <span>Three-d Top-lighted Rightwards Arrowhead</span></div>
			<div class="hiddenChar"><input type="text" value="➣" readonly=""> <span>Three-d Bottom-lighted Rightwards Arrowhead</span></div>
			<div class="hiddenChar"><input type="text" value="➤" readonly=""> <span>Black Rightwards Arrowhead</span></div>
			<div class="hiddenChar"><input type="text" value="➥" readonly=""> <span>Heavy Black Curved Downwards And Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➦" readonly=""> <span>Heavy Black Curved Upwards And Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➧" readonly=""> <span>Squat Black Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➨" readonly=""> <span>Heavy Concave-pointed Black Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➩" readonly=""> <span>Right-shaded White Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➪" readonly=""> <span>Left-shaded White Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➫" readonly=""> <span>Back-tilted Shadowed White Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➬" readonly=""> <span>Front-tilted Shadowed White Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➭" readonly=""> <span>Heavy Lower Right-shadowed White Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➮" readonly=""> <span>Heavy Upper Right-shadowed White Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➯" readonly=""> <span>Notched Lower Right-shadowed White Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➰" readonly=""> <span>Curly Loop</span></div>
			<div class="hiddenChar"><input type="text" value="➱" readonly=""> <span>Notched Upper Right-shadowed White Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➲" readonly=""> <span>Circled Heavy White Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➳" readonly=""> <span>White-feathered Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➴" readonly=""> <span>Black-feathered South East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➵" readonly=""> <span>Black-feathered Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➶" readonly=""> <span>Black-feathered North East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➷" readonly=""> <span>Heavy Black-feathered South East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➸" readonly=""> <span>Heavy Black-feathered Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➹" readonly=""> <span>Heavy Black-feathered North East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➺" readonly=""> <span>Teardrop-barbed Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➻" readonly=""> <span>Heavy Teardrop-shanked Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➼" readonly=""> <span>Wedge-tailed Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➽" readonly=""> <span>Heavy Wedge-tailed Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➾" readonly=""> <span>Open-outlined Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➿" readonly=""> <span>Double Curly Loop</span></div>
		</div>
		<div class="emocat" data-name="Arrows" id="emocat10">
			<div class="hiddenChar"><input type="text" value="⬆" readonly=""> <span>Up Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↗" readonly=""> <span>Up-Right Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➡" readonly=""> <span>Right Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↘" readonly=""> <span>Down-Right Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⬇" readonly=""> <span>Down Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↙" readonly=""> <span>Down-Left Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⬅" readonly=""> <span>Left Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↖" readonly=""> <span>Up-Left Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↕" readonly=""> <span>Up-Down Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↔" readonly=""> <span>Left-Right Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↩" readonly=""> <span>Right Arrow Curving Left</span></div>
			<div class="hiddenChar"><input type="text" value="↪" readonly=""> <span>Left Arrow Curving Right</span></div>
			<div class="hiddenChar"><input type="text" value="⤴" readonly=""> <span>Right Arrow Curving Up</span></div>
			<div class="hiddenChar"><input type="text" value="⤵" readonly=""> <span>Right Arrow Curving Down</span></div>
			<div class="hiddenChar"><input type="text" value="🔃" readonly=""> <span>Clockwise Vertical Arrows</span></div>
			<div class="hiddenChar"><input type="text" value="🔄" readonly=""> <span>Counterclockwise Arrows Button</span></div>
			<div class="hiddenChar"><input type="text" value="🔙" readonly=""> <span>Back Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="🔚" readonly=""> <span>End Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="🔛" readonly=""> <span>On! Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="🔜" readonly=""> <span>Soon Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="🔝" readonly=""> <span>Top Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="➤" readonly=""> <span>Right Arrowhead</span></div>
			<div class="hiddenChar"><input type="text" value="➧" readonly=""> <span>Squat Black Right Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="←" readonly=""> <span>Left Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="→" readonly=""> <span>Right Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↓" readonly=""> <span>Down Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↚" readonly=""> <span>Left Arrow With Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="↛" readonly=""> <span>Right Arrow With Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="↜" readonly=""> <span>Left Wave Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↝" readonly=""> <span>Right Wave Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↞" readonly=""> <span>Left Two Headed Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↟" readonly=""> <span>Up Two Headed Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↠" readonly=""> <span>Right Two Headed Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↡" readonly=""> <span>Down Two Headed Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↢" readonly=""> <span>Left Arrow With Tail</span></div>
			<div class="hiddenChar"><input type="text" value="↣" readonly=""> <span>Right Arrow With Tail</span></div>
			<div class="hiddenChar"><input type="text" value="↤" readonly=""> <span>Left Arrow From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="↥" readonly=""> <span>Up Arrow From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="↦" readonly=""> <span>Right Arrow From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="↧" readonly=""> <span>Down Arrow From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="↨" readonly=""> <span>Up Down Arrow With Base</span></div>
			<div class="hiddenChar"><input type="text" value="↫" readonly=""> <span>Left Arrow With Loop</span></div>
			<div class="hiddenChar"><input type="text" value="↬" readonly=""> <span>Right Arrow With Loop</span></div>
			<div class="hiddenChar"><input type="text" value="↭" readonly=""> <span>Left Right Wave Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↮" readonly=""> <span>Left Right Arrow With Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="↯" readonly=""> <span>Down Zigzag Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↰" readonly=""> <span>Up Arrow With Tip Left</span></div>
			<div class="hiddenChar"><input type="text" value="↱" readonly=""> <span>Up Arrow With Tip Right</span></div>
			<div class="hiddenChar"><input type="text" value="↲" readonly=""> <span>Down Arrow With Tip Left</span></div>
			<div class="hiddenChar"><input type="text" value="↳" readonly=""> <span>Down Arrow With Tip Right</span></div>
			<div class="hiddenChar"><input type="text" value="↴" readonly=""> <span>Right Arrow With Corner Down</span></div>
			<div class="hiddenChar"><input type="text" value="↶" readonly=""> <span>Anticlockwise Top Semicircle Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↷" readonly=""> <span>Clockwise Top Semicircle Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↸" readonly=""> <span>North West Arrow To Long Bar</span></div>
			<div class="hiddenChar"><input type="text" value="↹" readonly=""> <span>Left Arrow To Bar Over Right Arrow To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="↺" readonly=""> <span>Anticlockwise Open Circle Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↻" readonly=""> <span>Clockwise Open Circle Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↼" readonly=""> <span>Left Harpoon With Barb Up</span></div>
			<div class="hiddenChar"><input type="text" value="↽" readonly=""> <span>Left Harpoon With Barb Down</span></div>
			<div class="hiddenChar"><input type="text" value="↾" readonly=""> <span>Up Harpoon With Barb Right</span></div>
			<div class="hiddenChar"><input type="text" value="↿" readonly=""> <span>Up Harpoon With Barb Left</span></div>
			<div class="hiddenChar"><input type="text" value="⇀" readonly=""> <span>Right Harpoon With Barb Up</span></div>
			<div class="hiddenChar"><input type="text" value="⇁" readonly=""> <span>Right Harpoon With Barb Down</span></div>
			<div class="hiddenChar"><input type="text" value="⇂" readonly=""> <span>Down Harpoon With Barb Right</span></div>
			<div class="hiddenChar"><input type="text" value="⇃" readonly=""> <span>Down Harpoon With Barb Left</span></div>
			<div class="hiddenChar"><input type="text" value="⇄" readonly=""> <span>Right Arrow Over Left Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇅" readonly=""> <span>Up Arrow Left Of Down Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇆" readonly=""> <span>Left Arrow Over Right Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇇" readonly=""> <span>Left Paired Arrows</span></div>
			<div class="hiddenChar"><input type="text" value="⇈" readonly=""> <span>Up Paired Arrows</span></div>
			<div class="hiddenChar"><input type="text" value="⇉" readonly=""> <span>Right Paired Arrows</span></div>
			<div class="hiddenChar"><input type="text" value="⇊" readonly=""> <span>Downards Paired Arrows</span></div>
			<div class="hiddenChar"><input type="text" value="⇋" readonly=""> <span>Left Harpoon Over Right Harpoon</span></div>
			<div class="hiddenChar"><input type="text" value="⇌" readonly=""> <span>Right Harpoon Over Left Harpoon</span></div>
			<div class="hiddenChar"><input type="text" value="⇍" readonly=""> <span>Left Double Arrow With Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⇎" readonly=""> <span>Left Right Double Arrow With Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⇏" readonly=""> <span>Right Double Arrow With Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="↑" readonly=""> <span>Up Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇕" readonly=""> <span>Up Down Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇖" readonly=""> <span>North West Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇗" readonly=""> <span>North East Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇘" readonly=""> <span>South East Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇙" readonly=""> <span>South West Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇚" readonly=""> <span>Left Triple Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇛" readonly=""> <span>Right Triple Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇜" readonly=""> <span>Left Squiggle Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇝" readonly=""> <span>Right Squiggle Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇞" readonly=""> <span>Up Arrow With Double Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⇟" readonly=""> <span>Down Arrow With Double Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⇠" readonly=""> <span>Left Dashed Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇡" readonly=""> <span>Up Dashed Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇢" readonly=""> <span>Right Dashed Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇣" readonly=""> <span>Down Dashed Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇤" readonly=""> <span>Left Arrow To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⇥" readonly=""> <span>Right Arrow To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⇦" readonly=""> <span>Left White Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇧" readonly=""> <span>Up White Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇨" readonly=""> <span>Right White Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇩" readonly=""> <span>Down White Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇪" readonly=""> <span>Up White Arrow From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⇫" readonly=""> <span>Up White Arrow On Pedestal</span></div>
			<div class="hiddenChar"><input type="text" value="⇬" readonly=""> <span>Up White Arrow On Pedestal With Horizontal Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⇭" readonly=""> <span>Up White Arrow On Pedestal With Vertical Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⇮" readonly=""> <span>Up White Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇯" readonly=""> <span>Up White Double Arrow On Pedestal</span></div>
			<div class="hiddenChar"><input type="text" value="⇰" readonly=""> <span>Right White Arrow From Wall</span></div>
			<div class="hiddenChar"><input type="text" value="⇱" readonly=""> <span>North West Arrow To Corner</span></div>
			<div class="hiddenChar"><input type="text" value="⇲" readonly=""> <span>South East Arrow To Corner</span></div>
			<div class="hiddenChar"><input type="text" value="⇳" readonly=""> <span>Up Down White Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇴" readonly=""> <span>Right Arrow With Small Circle</span></div>
			<div class="hiddenChar"><input type="text" value="⇵" readonly=""> <span>Down Arrow Left Of Up Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇶" readonly=""> <span>Three Right Arrows</span></div>
			<div class="hiddenChar"><input type="text" value="⇷" readonly=""> <span>Left Arrow With Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⇸" readonly=""> <span>Right Arrow With Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⇹" readonly=""> <span>Left Right Arrow With Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⇺" readonly=""> <span>Left Arrow With Double Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⇻" readonly=""> <span>Right Arrow With Double Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⇼" readonly=""> <span>Left Right Arrow With Double Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⇽" readonly=""> <span>Left Open-headed Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇾" readonly=""> <span>Right Open-headed Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇿" readonly=""> <span>Left Right Open-headed Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⟰" readonly=""> <span>Up Quadruple Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⟱" readonly=""> <span>Down Quadruple Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⟲" readonly=""> <span>Anticlockwise Gapped Circle Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⟳" readonly=""> <span>Clockwise Gapped Circle Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⟴" readonly=""> <span>Right Arrow With Circled Plus</span></div>
			<div class="hiddenChar"><input type="text" value="⟵" readonly=""> <span>Long Left Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⟶" readonly=""> <span>Long Right Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⟷" readonly=""> <span>Long Left Right Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⟸" readonly=""> <span>Long Left Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⟹" readonly=""> <span>Long Right Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⟺" readonly=""> <span>Long Left Right Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⟻" readonly=""> <span>Long Left Arrow From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⟼" readonly=""> <span>Long Right Arrow From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⟽" readonly=""> <span>Long Left Double Arrow From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⟾" readonly=""> <span>Long Right Double Arrow From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⟿" readonly=""> <span>Long Right Squiggle Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤀" readonly=""> <span>Right Two-headed Arrow With Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⤁" readonly=""> <span>Right Two-headed Arrow With Double Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⤂" readonly=""> <span>Left Double Arrow With Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⤃" readonly=""> <span>Right Double Arrow With Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⤄" readonly=""> <span>Left Right Double Arrow With Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⤅" readonly=""> <span>Right Two-headed Arrow From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⤆" readonly=""> <span>Left Double Arrow From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⤇" readonly=""> <span>Right Double Arrow From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⤈" readonly=""> <span>Down Arrow With Horizontal Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⤉" readonly=""> <span>Up Arrow With Horizontal Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⤊" readonly=""> <span>Up Triple Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤋" readonly=""> <span>Down Triple Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤌" readonly=""> <span>Left Double Dash Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤍" readonly=""> <span>Right Double Dash Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤎" readonly=""> <span>Left Triple Dash Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤏" readonly=""> <span>Right Triple Dash Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤐" readonly=""> <span>Right Two-headed Triple Dash Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤑" readonly=""> <span>Right Arrow With Dotted Stem</span></div>
			<div class="hiddenChar"><input type="text" value="⤒" readonly=""> <span>Up Arrow To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⤓" readonly=""> <span>Down Arrow To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⤔" readonly=""> <span>Right Arrow With Tail With Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⤕" readonly=""> <span>Right Arrow With Tail With Double Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⤖" readonly=""> <span>Right Two-headed Arrow With Tail</span></div>
			<div class="hiddenChar"><input type="text" value="⤗" readonly=""> <span>Right Two-headed Arrow With Tail With Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⤘" readonly=""> <span>Right Two-headed Arrow With Tail With Double Vertical Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="⤙" readonly=""> <span>Left Arrow-tail</span></div>
			<div class="hiddenChar"><input type="text" value="⤚" readonly=""> <span>Right Arrow-tail</span></div>
			<div class="hiddenChar"><input type="text" value="⤛" readonly=""> <span>Left Double Arrow-tail</span></div>
			<div class="hiddenChar"><input type="text" value="⤜" readonly=""> <span>Right Double Arrow-tail</span></div>
			<div class="hiddenChar"><input type="text" value="⤝" readonly=""> <span>Left Arrow To Black Diamond</span></div>
			<div class="hiddenChar"><input type="text" value="⤞" readonly=""> <span>Right Arrow To Black Diamond</span></div>
			<div class="hiddenChar"><input type="text" value="⤟" readonly=""> <span>Left Arrow From Bar To Black Diamond</span></div>
			<div class="hiddenChar"><input type="text" value="⤠" readonly=""> <span>Right Arrow From Bar To Black Diamond</span></div>
			<div class="hiddenChar"><input type="text" value="⤡" readonly=""> <span>North West And South East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤢" readonly=""> <span>North East And South West Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤣" readonly=""> <span>North West Arrow With Hook</span></div>
			<div class="hiddenChar"><input type="text" value="⤤" readonly=""> <span>North East Arrow With Hook</span></div>
			<div class="hiddenChar"><input type="text" value="⤥" readonly=""> <span>South East Arrow With Hook</span></div>
			<div class="hiddenChar"><input type="text" value="⤦" readonly=""> <span>South West Arrow With Hook</span></div>
			<div class="hiddenChar"><input type="text" value="⤧" readonly=""> <span>North West Arrow And North East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤨" readonly=""> <span>North East Arrow And South East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤩" readonly=""> <span>South East Arrow And South West Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤪" readonly=""> <span>South West Arrow And North West Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤫" readonly=""> <span>Rising Diagonal Crossing Falling Diagonal</span></div>
			<div class="hiddenChar"><input type="text" value="⤬" readonly=""> <span>Falling Diagonal Crossing Rising Diagonal</span></div>
			<div class="hiddenChar"><input type="text" value="⤭" readonly=""> <span>South East Arrow Crossing North East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤮" readonly=""> <span>North East Arrow Crossing South East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤯" readonly=""> <span>Falling Diagonal Crossing North East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤰" readonly=""> <span>Rising Diagonal Crossing South East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤱" readonly=""> <span>North East Arrow Crossing North West Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤲" readonly=""> <span>North West Arrow Crossing North East Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤳" readonly=""> <span>Wave Arrow Pointing Directly Right</span></div>
			<div class="hiddenChar"><input type="text" value="⤶" readonly=""> <span>Arrow Pointing Down Then Curving Left</span></div>
			<div class="hiddenChar"><input type="text" value="⤷" readonly=""> <span>Arrow Pointing Down Then Curving Right</span></div>
			<div class="hiddenChar"><input type="text" value="⤸" readonly=""> <span>Right-side Arc Clockwise Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤹" readonly=""> <span>Left-side Arc Anticlockwise Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤺" readonly=""> <span>Top Arc Anticlockwise Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤻" readonly=""> <span>Bottom Arc Anticlockwise Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤼" readonly=""> <span>Top Arc Clockwise Arrow With Minus</span></div>
			<div class="hiddenChar"><input type="text" value="⤽" readonly=""> <span>Top Arc Anticlockwise Arrow With Plus</span></div>
			<div class="hiddenChar"><input type="text" value="⤾" readonly=""> <span>Lower Right Semicircular Clockwise Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⤿" readonly=""> <span>Lower Left Semicircular Anticlockwise Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⥀" readonly=""> <span>Anticlockwise Closed Circle Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⥁" readonly=""> <span>Clockwise Closed Circle Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⥂" readonly=""> <span>Right Arrow Above Short Left Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⥃" readonly=""> <span>Left Arrow Above Short Right Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⥄" readonly=""> <span>Short Right Arrow Above Left Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⥅" readonly=""> <span>Right Arrow With Plus Below</span></div>
			<div class="hiddenChar"><input type="text" value="⥆" readonly=""> <span>Left Arrow With Plus Below</span></div>
			<div class="hiddenChar"><input type="text" value="⥇" readonly=""> <span>Right Arrow Through X</span></div>
			<div class="hiddenChar"><input type="text" value="⥈" readonly=""> <span>Left Right Arrow Through Small Circle</span></div>
			<div class="hiddenChar"><input type="text" value="⥉" readonly=""> <span>Up Two-headed Arrow From Small Circle</span></div>
			<div class="hiddenChar"><input type="text" value="⥊" readonly=""> <span>Left Barb Up Right Barb Down Harpoon</span></div>
			<div class="hiddenChar"><input type="text" value="⥋" readonly=""> <span>Left Barb Down Right Barb Up Harpoon</span></div>
			<div class="hiddenChar"><input type="text" value="⥌" readonly=""> <span>Up Barb Right Down Barb Left Harpoon</span></div>
			<div class="hiddenChar"><input type="text" value="⥍" readonly=""> <span>Up Barb Left Down Barb Right Harpoon</span></div>
			<div class="hiddenChar"><input type="text" value="⥎" readonly=""> <span>Left Barb Up Right Barb Up Harpoon</span></div>
			<div class="hiddenChar"><input type="text" value="⥏" readonly=""> <span>Up Barb Right Down Barb Right Harpoon</span></div>
			<div class="hiddenChar"><input type="text" value="⥐" readonly=""> <span>Left Barb Down Right Barb Down Harpoon</span></div>
			<div class="hiddenChar"><input type="text" value="⥑" readonly=""> <span>Up Barb Left Down Barb Left Harpoon</span></div>
			<div class="hiddenChar"><input type="text" value="⥒" readonly=""> <span>Left Harpoon With Barb Up To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⥓" readonly=""> <span>Right Harpoon With Barb Up To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⥔" readonly=""> <span>Up Harpoon With Barb Right To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⥕" readonly=""> <span>Down Harpoon With Barb Right To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⥖" readonly=""> <span>Left Harpoon With Barb Down To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⥗" readonly=""> <span>Right Harpoon With Barb Down To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⥘" readonly=""> <span>Up Harpoon With Barb Left To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⥙" readonly=""> <span>Down Harpoon With Barb Left To Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⥚" readonly=""> <span>Left Harpoon With Barb Up From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⥛" readonly=""> <span>Right Harpoon With Barb Up From Bar</span></div>
			<div class="hiddenChar"><input type="text" value="⥜" readonly=""> <span>Up Harpoon With Barb Right From Bar</span></div>
		</div>
		<div class="emocat" data-name="Currency" id="emocat11">
			<div class="hiddenChar"><input type="text" value="💴" readonly=""> <span>Yen Banknote</span></div>
			<div class="hiddenChar"><input type="text" value="💵" readonly=""> <span>Dollar Banknote</span></div>
			<div class="hiddenChar"><input type="text" value="💶" readonly=""> <span>Euro Banknote</span></div>
			<div class="hiddenChar"><input type="text" value="💷" readonly=""> <span>Pound Banknote</span></div>
			<div class="hiddenChar"><input type="text" value="$" readonly=""> <span>Dollar Sign</span></div>
			<div class="hiddenChar"><input type="text" value="¢" readonly=""> <span>Cent Sign</span></div>
			<div class="hiddenChar"><input type="text" value="£" readonly=""> <span>Pound Sign</span></div>
			<div class="hiddenChar"><input type="text" value="€" readonly=""> <span>Euro Sign</span></div>
			<div class="hiddenChar"><input type="text" value="¥" readonly=""> <span>Yen Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₹" readonly=""> <span>Indian Rupee Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₽" readonly=""> <span>Ruble Sign</span></div>
			<div class="hiddenChar"><input type="text" value="元" readonly=""> <span>Yuan Character, In China</span></div>
			<div class="hiddenChar"><input type="text" value="¤" readonly=""> <span>Currency Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₠" readonly=""> <span>Euro-currency Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₡" readonly=""> <span>Colon Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₢" readonly=""> <span>Cruzeiro Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₣" readonly=""> <span>French Franc Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₤" readonly=""> <span>Lira Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₥" readonly=""> <span>Mill Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₦" readonly=""> <span>Naira Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₧" readonly=""> <span>Peseta Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₨" readonly=""> <span>Rupee Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₩" readonly=""> <span>Won Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₪" readonly=""> <span>New Sheqel Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₫" readonly=""> <span>Dong Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₭" readonly=""> <span>Kip Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₮" readonly=""> <span>Tugrik Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₯" readonly=""> <span>Drachma Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₰" readonly=""> <span>German Penny Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="₱" readonly=""> <span>Peso Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₲" readonly=""> <span>Guarani Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₳" readonly=""> <span>Austral Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₴" readonly=""> <span>Hryvnia Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₵" readonly=""> <span>Cedi Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₶" readonly=""> <span>Livre Tournois Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₸" readonly=""> <span>Tenge Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₺" readonly=""> <span>Turkish Lira Sign</span></div>
			<div class="hiddenChar"><input type="text" value="₼" readonly=""> <span>Manat Sign</span></div>
			<div class="hiddenChar"><input type="text" value="৲" readonly=""> <span>Bengali Rupee Mark</span></div>
			<div class="hiddenChar"><input type="text" value="৳" readonly=""> <span>Bengali Rupee Sign</span></div>
			<div class="hiddenChar"><input type="text" value="૱" readonly=""> <span>Gujarati Rupee Sign</span></div>
			<div class="hiddenChar"><input type="text" value="௹" readonly=""> <span>Tamil Rupee Sign</span></div>
			<div class="hiddenChar"><input type="text" value="฿" readonly=""> <span>Thai Currency Symbol Baht</span></div>
			<div class="hiddenChar"><input type="text" value="៛" readonly=""> <span>Khmer Currency Symbol Riel</span></div>
			<div class="hiddenChar"><input type="text" value="㍐" readonly=""> <span>Square Yuan</span></div>
			<div class="hiddenChar"><input type="text" value="円" readonly=""> <span>Yen Character</span></div>
			<div class="hiddenChar"><input type="text" value="圆" readonly=""> <span>Yen/yuan Character Variant One</span></div>
			<div class="hiddenChar"><input type="text" value="圎" readonly=""> <span>Yen/yuan Character Variant Two</span></div>
			<div class="hiddenChar"><input type="text" value="圓" readonly=""> <span>Yuan Character, In Hong Kong And Taiwan</span></div>
			<div class="hiddenChar"><input type="text" value="圜" readonly=""> <span>Yen/yuan Character Variant Three</span></div>
			<div class="hiddenChar"><input type="text" value="원" readonly=""> <span>Won Character</span></div>
			<div class="hiddenChar"><input type="text" value="﷼" readonly=""> <span>Rial Sign</span></div>
			<div class="hiddenChar"><input type="text" value="＄" readonly=""> <span>Fullwidth Dollar Sign</span></div>
			<div class="hiddenChar"><input type="text" value="￠" readonly=""> <span>Fullwidth Cent Sign</span></div>
			<div class="hiddenChar"><input type="text" value="￡" readonly=""> <span>Fullwidth Pound Sign</span></div>
			<div class="hiddenChar"><input type="text" value="￥" readonly=""> <span>Fullwidth Yen Sign</span></div>
			<div class="hiddenChar"><input type="text" value="￦" readonly=""> <span>Fullwidth Won Sign</span></div>
		</div>
		<div class="emocat" data-name="HTML4" id="emocat12">
			<div class="hiddenChar"><input type="text" value="©" readonly=""> <span>Copyright Sign</span></div>
			<div class="hiddenChar"><input type="text" value="&amp;" readonly=""> <span>Ampersand</span></div>
			<div class="hiddenChar"><input type="text" value="<" readonly=""> <span>Less Than</span></div>
			<div class="hiddenChar"><input type="text" value=">" readonly=""> <span>Greater Than</span></div>
			<div class="hiddenChar"><input type="text" value="&nbsp;" readonly=""> <span>Non-breaking Space</span></div>
			<div class="hiddenChar"><input type="text" value="¡" readonly=""> <span>Inverted Exclamation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="¢" readonly=""> <span>Cent Sign</span></div>
			<div class="hiddenChar"><input type="text" value="£" readonly=""> <span>Pound Sign</span></div>
			<div class="hiddenChar"><input type="text" value="¤" readonly=""> <span>Currency Sign</span></div>
			<div class="hiddenChar"><input type="text" value="¥" readonly=""> <span>Yen Sign</span></div>
			<div class="hiddenChar"><input type="text" value="¦" readonly=""> <span>Broken Bar</span></div>
			<div class="hiddenChar"><input type="text" value="§" readonly=""> <span>Section Sign</span></div>
			<div class="hiddenChar"><input type="text" value="¨" readonly=""> <span>Diaeresis</span></div>
			<div class="hiddenChar"><input type="text" value="ª" readonly=""> <span>Feminine Ordinal Indicator</span></div>
			<div class="hiddenChar"><input type="text" value="«" readonly=""> <span>Left-pointing Double Angle Quotation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="¬" readonly=""> <span>Not Sign</span></div>
			<div class="hiddenChar"><input type="text" value="&shy;" readonly=""> <span>Soft Hyphen</span></div>
			<div class="hiddenChar"><input type="text" value="®" readonly=""> <span>Registered Sign</span></div>
			<div class="hiddenChar"><input type="text" value="¯" readonly=""> <span>Macron</span></div>
			<div class="hiddenChar"><input type="text" value="°" readonly=""> <span>Degree Sign</span></div>
			<div class="hiddenChar"><input type="text" value="±" readonly=""> <span>Plus-minus Sign</span></div>
			<div class="hiddenChar"><input type="text" value="²" readonly=""> <span>Superscript Two</span></div>
			<div class="hiddenChar"><input type="text" value="³" readonly=""> <span>Superscript Three</span></div>
			<div class="hiddenChar"><input type="text" value="´" readonly=""> <span>Acute Accent</span></div>
			<div class="hiddenChar"><input type="text" value="Μ" readonly=""> <span>Micro Sign</span></div>
			<div class="hiddenChar"><input type="text" value="¶" readonly=""> <span>Paragraph Sign</span></div>
			<div class="hiddenChar"><input type="text" value="·" readonly=""> <span>Middle Dot</span></div>
			<div class="hiddenChar"><input type="text" value="¸" readonly=""> <span>Cedilla</span></div>
			<div class="hiddenChar"><input type="text" value="¹" readonly=""> <span>Superscript One</span></div>
			<div class="hiddenChar"><input type="text" value="º" readonly=""> <span>Masculine Ordinal Indicator</span></div>
			<div class="hiddenChar"><input type="text" value="»" readonly=""> <span>Right-pointing Double Angle Quotation Mark</span></div>
			<div class="hiddenChar"><input type="text" value="¼" readonly=""> <span>Vulgar Fraction One Quarter</span></div>
			<div class="hiddenChar"><input type="text" value="½" readonly=""> <span>Vulgar Fraction One Half</span></div>
			<div class="hiddenChar"><input type="text" value="¾" readonly=""> <span>Vulgar Fraction Three Quarters</span></div>
			<div class="hiddenChar"><input type="text" value="¿" readonly=""> <span>Inverted Question Mark</span></div>
			<div class="hiddenChar"><input type="text" value="À" readonly=""> <span>Latin Capital Letter A With Grave</span></div>
			<div class="hiddenChar"><input type="text" value="Á" readonly=""> <span>Latin Capital Letter A With Acute</span></div>
			<div class="hiddenChar"><input type="text" value="Â" readonly=""> <span>Latin Capital Letter A With Circumflex</span></div>
			<div class="hiddenChar"><input type="text" value="Ã" readonly=""> <span>Latin Capital Letter A With Tilde</span></div>
			<div class="hiddenChar"><input type="text" value="Ä" readonly=""> <span>Latin Capital Letter A With Diaeresis</span></div>
			<div class="hiddenChar"><input type="text" value="Å" readonly=""> <span>Latin Capital Letter A With Ring Above</span></div>
			<div class="hiddenChar"><input type="text" value="Æ" readonly=""> <span>Latin Capital Letter Ae</span></div>
			<div class="hiddenChar"><input type="text" value="Ç" readonly=""> <span>Latin Capital Letter C With Cedilla</span></div>
			<div class="hiddenChar"><input type="text" value="È" readonly=""> <span>Latin Capital Letter E With Grave</span></div>
			<div class="hiddenChar"><input type="text" value="É" readonly=""> <span>Latin Capital Letter E With Acute</span></div>
			<div class="hiddenChar"><input type="text" value="Ê" readonly=""> <span>Latin Capital Letter E With Circumflex</span></div>
			<div class="hiddenChar"><input type="text" value="Ë" readonly=""> <span>Latin Capital Letter E With Diaeresis</span></div>
			<div class="hiddenChar"><input type="text" value="Ì" readonly=""> <span>Latin Capital Letter I With Grave</span></div>
			<div class="hiddenChar"><input type="text" value="Í" readonly=""> <span>Latin Capital Letter I With Acute</span></div>
			<div class="hiddenChar"><input type="text" value="Î" readonly=""> <span>Latin Capital Letter I With Circumflex</span></div>
			<div class="hiddenChar"><input type="text" value="Ï" readonly=""> <span>Latin Capital Letter I With Diaeresis</span></div>
			<div class="hiddenChar"><input type="text" value="Ð" readonly=""> <span>Latin Capital Letter Eth</span></div>
			<div class="hiddenChar"><input type="text" value="Ñ" readonly=""> <span>Latin Capital Letter N With Tilde</span></div>
			<div class="hiddenChar"><input type="text" value="Ò" readonly=""> <span>Latin Capital Letter O With Grave</span></div>
			<div class="hiddenChar"><input type="text" value="Ó" readonly=""> <span>Latin Capital Letter O With Acute</span></div>
			<div class="hiddenChar"><input type="text" value="Ô" readonly=""> <span>Latin Capital Letter O With Circumflex</span></div>
			<div class="hiddenChar"><input type="text" value="Õ" readonly=""> <span>Latin Capital Letter O With Tilde</span></div>
			<div class="hiddenChar"><input type="text" value="Ö" readonly=""> <span>Latin Capital Letter O With Diaeresis</span></div>
			<div class="hiddenChar"><input type="text" value="×" readonly=""> <span>Multiplication Sign</span></div>
			<div class="hiddenChar"><input type="text" value="Ø" readonly=""> <span>Latin Capital Letter O With Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="Ù" readonly=""> <span>Latin Capital Letter U With Grave</span></div>
			<div class="hiddenChar"><input type="text" value="Ú" readonly=""> <span>Latin Capital Letter U With Acute</span></div>
			<div class="hiddenChar"><input type="text" value="Û" readonly=""> <span>Latin Capital Letter U With Circumflex</span></div>
			<div class="hiddenChar"><input type="text" value="Ü" readonly=""> <span>Latin Capital Letter U With Diaeresis</span></div>
			<div class="hiddenChar"><input type="text" value="Ý" readonly=""> <span>Latin Capital Letter Y With Acute</span></div>
			<div class="hiddenChar"><input type="text" value="Þ" readonly=""> <span>Latin Capital Letter Thorn</span></div>
			<div class="hiddenChar"><input type="text" value="SS" readonly=""> <span>Latin Small Letter Sharp S</span></div>
			<div class="hiddenChar"><input type="text" value="À" readonly=""> <span>Latin Small Letter A With Grave</span></div>
			<div class="hiddenChar"><input type="text" value="Á" readonly=""> <span>Latin Small Letter A With Acute</span></div>
			<div class="hiddenChar"><input type="text" value="Â" readonly=""> <span>Latin Small Letter A With Circumflex</span></div>
			<div class="hiddenChar"><input type="text" value="Ã" readonly=""> <span>Latin Small Letter A With Tilde</span></div>
			<div class="hiddenChar"><input type="text" value="Ä" readonly=""> <span>Latin Small Letter A With Diaeresis</span></div>
			<div class="hiddenChar"><input type="text" value="Å" readonly=""> <span>Latin Small Letter A With Ring Above</span></div>
			<div class="hiddenChar"><input type="text" value="Æ" readonly=""> <span>Latin Small Letter Ae</span></div>
			<div class="hiddenChar"><input type="text" value="Ç" readonly=""> <span>Latin Small Letter C With Cedilla</span></div>
			<div class="hiddenChar"><input type="text" value="È" readonly=""> <span>Latin Small Letter E With Grave</span></div>
			<div class="hiddenChar"><input type="text" value="É" readonly=""> <span>Latin Small Letter E With Acute</span></div>
			<div class="hiddenChar"><input type="text" value="Ê" readonly=""> <span>Latin Small Letter E With Circumflex</span></div>
			<div class="hiddenChar"><input type="text" value="Ë" readonly=""> <span>Latin Small Letter E With Diaeresis</span></div>
			<div class="hiddenChar"><input type="text" value="Ì" readonly=""> <span>Latin Small Letter I With Grave</span></div>
			<div class="hiddenChar"><input type="text" value="Í" readonly=""> <span>Latin Small Letter I With Acute</span></div>
			<div class="hiddenChar"><input type="text" value="Î" readonly=""> <span>Latin Small Letter I With Circumflex</span></div>
			<div class="hiddenChar"><input type="text" value="Ï" readonly=""> <span>Latin Small Letter I With Diaeresis</span></div>
			<div class="hiddenChar"><input type="text" value="Ð" readonly=""> <span>Latin Small Letter Eth</span></div>
			<div class="hiddenChar"><input type="text" value="Ñ" readonly=""> <span>Latin Small Letter N With Tilde</span></div>
			<div class="hiddenChar"><input type="text" value="Ò" readonly=""> <span>Latin Small Letter O With Grave</span></div>
			<div class="hiddenChar"><input type="text" value="Ó" readonly=""> <span>Latin Small Letter O With Acute</span></div>
			<div class="hiddenChar"><input type="text" value="Ô" readonly=""> <span>Latin Small Letter O With Circumflex</span></div>
			<div class="hiddenChar"><input type="text" value="Õ" readonly=""> <span>Latin Small Letter O With Tilde</span></div>
			<div class="hiddenChar"><input type="text" value="Ö" readonly=""> <span>Latin Small Letter O With Diaeresis</span></div>
			<div class="hiddenChar"><input type="text" value="÷" readonly=""> <span>Division Sign</span></div>
			<div class="hiddenChar"><input type="text" value="Ø" readonly=""> <span>Latin Small Letter O With Stroke</span></div>
			<div class="hiddenChar"><input type="text" value="Ù" readonly=""> <span>Latin Small Letter U With Grave</span></div>
			<div class="hiddenChar"><input type="text" value="Ú" readonly=""> <span>Latin Small Letter U With Acute</span></div>
			<div class="hiddenChar"><input type="text" value="Û" readonly=""> <span>Latin Small Letter U With Circumflex</span></div>
			<div class="hiddenChar"><input type="text" value="Ü" readonly=""> <span>Latin Small Letter U With Diaeresis</span></div>
			<div class="hiddenChar"><input type="text" value="Ý" readonly=""> <span>Latin Small Letter Y With Acute</span></div>
			<div class="hiddenChar"><input type="text" value="Þ" readonly=""> <span>Latin Small Letter Thorn</span></div>
			<div class="hiddenChar"><input type="text" value="Ÿ" readonly=""> <span>Latin Small Letter Y With Diaeresis</span></div>
			<div class="hiddenChar"><input type="text" value="Ƒ" readonly=""> <span>Latin Small F With Hook</span></div>
			<div class="hiddenChar"><input type="text" value="Α" readonly=""> <span>Greek Capital Letter Alpha</span></div>
			<div class="hiddenChar"><input type="text" value="Β" readonly=""> <span>Greek Capital Letter Beta</span></div>
			<div class="hiddenChar"><input type="text" value="Γ" readonly=""> <span>Greek Capital Letter Gamma</span></div>
			<div class="hiddenChar"><input type="text" value="Δ" readonly=""> <span>Greek Capital Letter Delta</span></div>
			<div class="hiddenChar"><input type="text" value="Ε" readonly=""> <span>Greek Capital Letter Epsilon</span></div>
			<div class="hiddenChar"><input type="text" value="Ζ" readonly=""> <span>Greek Capital Letter Zeta</span></div>
			<div class="hiddenChar"><input type="text" value="Η" readonly=""> <span>Greek Capital Letter Eta</span></div>
			<div class="hiddenChar"><input type="text" value="Θ" readonly=""> <span>Greek Capital Letter Theta</span></div>
			<div class="hiddenChar"><input type="text" value="Ι" readonly=""> <span>Greek Capital Letter Iota</span></div>
			<div class="hiddenChar"><input type="text" value="Κ" readonly=""> <span>Greek Capital Letter Kappa</span></div>
			<div class="hiddenChar"><input type="text" value="Λ" readonly=""> <span>Greek Capital Letter Lambda</span></div>
			<div class="hiddenChar"><input type="text" value="•" readonly=""> <span>Bullet</span></div>
			<div class="hiddenChar"><input type="text" value="…" readonly=""> <span>Horizontal Ellipsis</span></div>
			<div class="hiddenChar"><input type="text" value="′" readonly=""> <span>Prime / Minutes / Feet</span></div>
			<div class="hiddenChar"><input type="text" value="″" readonly=""> <span>Double Prime / Seconds / Inches</span></div>
			<div class="hiddenChar"><input type="text" value="‾" readonly=""> <span>Overline / Spacing Overscore</span></div>
			<div class="hiddenChar"><input type="text" value="⁄" readonly=""> <span>Fraction Slash</span></div>
			<div class="hiddenChar"><input type="text" value="℘" readonly=""> <span>Script Capital P / Power Set / Weierstrass P</span></div>
			<div class="hiddenChar"><input type="text" value="ℑ" readonly=""> <span>Blackletter Capital I / Imaginary Part</span></div>
			<div class="hiddenChar"><input type="text" value="ℜ" readonly=""> <span>Blackletter Capital R / Real Part Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="™" readonly=""> <span>Trade Mark Sign</span></div>
			<div class="hiddenChar"><input type="text" value="ℵ" readonly=""> <span>Alef Symbol</span></div>
			<div class="hiddenChar"><input type="text" value="←" readonly=""> <span>Leftwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↑" readonly=""> <span>Upwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="→" readonly=""> <span>Rightwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↓" readonly=""> <span>Downwards Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↔" readonly=""> <span>Left Right Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="↵" readonly=""> <span>Carriage Return</span></div>
			<div class="hiddenChar"><input type="text" value="⇐" readonly=""> <span>Leftwards Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇑" readonly=""> <span>Upwards Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇒" readonly=""> <span>Rightwards Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇓" readonly=""> <span>Downwards Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="⇔" readonly=""> <span>Left Right Double Arrow</span></div>
			<div class="hiddenChar"><input type="text" value="∀" readonly=""> <span>For All</span></div>
			<div class="hiddenChar"><input type="text" value="∂" readonly=""> <span>Partial Differential</span></div>
			<div class="hiddenChar"><input type="text" value="∃" readonly=""> <span>There Exists</span></div>
			<div class="hiddenChar"><input type="text" value="∅" readonly=""> <span>Empty Set / Null Set / Diameter</span></div>
			<div class="hiddenChar"><input type="text" value="∇" readonly=""> <span>Nabla / Backward Difference</span></div>
			<div class="hiddenChar"><input type="text" value="∈" readonly=""> <span>Element Of</span></div>
			<div class="hiddenChar"><input type="text" value="∉" readonly=""> <span>Not An Element Of</span></div>
			<div class="hiddenChar"><input type="text" value="∋" readonly=""> <span>Contains As Member</span></div>
			<div class="hiddenChar"><input type="text" value="∏" readonly=""> <span>N-ary Product / Product Sign</span></div>
			<div class="hiddenChar"><input type="text" value="∑" readonly=""> <span>N-ary Sumation</span></div>
			<div class="hiddenChar"><input type="text" value="−" readonly=""> <span>Minus Sign</span></div>
			<div class="hiddenChar"><input type="text" value="∗" readonly=""> <span>Asterisk Operator</span></div>
			<div class="hiddenChar"><input type="text" value="√" readonly=""> <span>Square Root / Radical Sign</span></div>
			<div class="hiddenChar"><input type="text" value="∝" readonly=""> <span>Proportional To</span></div>
			<div class="hiddenChar"><input type="text" value="∞" readonly=""> <span>Infinity</span></div>
			<div class="hiddenChar"><input type="text" value="∠" readonly=""> <span>Angle</span></div>
			<div class="hiddenChar"><input type="text" value="∧" readonly=""> <span>Logical And / Wedge</span></div>
			<div class="hiddenChar"><input type="text" value="∨" readonly=""> <span>Logical Or / Vee</span></div>
			<div class="hiddenChar"><input type="text" value="∩" readonly=""> <span>Intersection / Cap</span></div>
			<div class="hiddenChar"><input type="text" value="∪" readonly=""> <span>Union / Cup</span></div>
			<div class="hiddenChar"><input type="text" value="∫" readonly=""> <span>Integral</span></div>
			<div class="hiddenChar"><input type="text" value="∴" readonly=""> <span>Therefore</span></div>
			<div class="hiddenChar"><input type="text" value="∼" readonly=""> <span>Tilde Operator / Similar To</span></div>
			<div class="hiddenChar"><input type="text" value="≅" readonly=""> <span>Approximately Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≈" readonly=""> <span>Almost Equal To / Asymptotic To</span></div>
			<div class="hiddenChar"><input type="text" value="≠" readonly=""> <span>Not Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≡" readonly=""> <span>Identical To</span></div>
			<div class="hiddenChar"><input type="text" value="≤" readonly=""> <span>Less-than Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="≥" readonly=""> <span>Greater-than Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊂" readonly=""> <span>Subset Of</span></div>
			<div class="hiddenChar"><input type="text" value="⊃" readonly=""> <span>Superset Of</span></div>
			<div class="hiddenChar"><input type="text" value="⊄" readonly=""> <span>Not A Subset Of</span></div>
			<div class="hiddenChar"><input type="text" value="⊆" readonly=""> <span>Subset Of Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊇" readonly=""> <span>Superset Of Or Equal To</span></div>
			<div class="hiddenChar"><input type="text" value="⊕" readonly=""> <span>Circled Plus / Direct Sum</span></div>
			<div class="hiddenChar"><input type="text" value="⊗" readonly=""> <span>Circled Times / Vector Product</span></div>
			<div class="hiddenChar"><input type="text" value="⊥" readonly=""> <span>Up Tack / Perpendicular</span></div>
			<div class="hiddenChar"><input type="text" value="⋅" readonly=""> <span>Dot Operator</span></div>
			<div class="hiddenChar"><input type="text" value="⌈" readonly=""> <span>Left Ceiling / Apl Upstile</span></div>
			<div class="hiddenChar"><input type="text" value="⌉" readonly=""> <span>Right Ceiling</span></div>
			<div class="hiddenChar"><input type="text" value="⌊" readonly=""> <span>Left Floor / Apl Downstile</span></div>
			<div class="hiddenChar"><input type="text" value="⌋" readonly=""> <span>Right Floor</span></div>
			<div class="hiddenChar"><input type="text" value="〈" readonly=""> <span>Left-pointing Angle Bracket / Bra</span></div>
			<div class="hiddenChar"><input type="text" value="〉" readonly=""> <span>Right-pointing Angle Bracket / Ket</span></div>
			<div class="hiddenChar"><input type="text" value="◊" readonly=""> <span>Lozenge</span></div>
			<div class="hiddenChar"><input type="text" value="♠" readonly=""> <span>Black Spade Suit</span></div>
			<div class="hiddenChar"><input type="text" value="♣" readonly=""> <span>Black Club Suit / Shamrock</span></div>
			<div class="hiddenChar"><input type="text" value="♥" readonly=""> <span>Black Heart Suit / Valentine</span></div>
			<div class="hiddenChar"><input type="text" value="♦" readonly=""> <span>Black Diamond Suit</span></div>
		</div>
		<div class="emocat" data-name="Shapes" id="emocat13">
			<div class="hiddenChar"><input type="text" value="○" readonly=""> <span>White Circle</span></div>
			<div class="hiddenChar"><input type="text" value="◌" readonly=""> <span>Dotted Circle</span></div>
			<div class="hiddenChar"><input type="text" value="◍" readonly=""> <span>Circle With Vertical Fill</span></div>
			<div class="hiddenChar"><input type="text" value="◎" readonly=""> <span>Bullseye</span></div>
			<div class="hiddenChar"><input type="text" value="●" readonly=""> <span>Black Circle</span></div>
			<div class="hiddenChar"><input type="text" value="◐" readonly=""> <span>Circle With Left Half Black</span></div>
			<div class="hiddenChar"><input type="text" value="◑" readonly=""> <span>Circle With Right Half Black</span></div>
			<div class="hiddenChar"><input type="text" value="◒" readonly=""> <span>Circle With Lower Half Black</span></div>
			<div class="hiddenChar"><input type="text" value="◓" readonly=""> <span>Circle With Upper Half Black</span></div>
			<div class="hiddenChar"><input type="text" value="◔" readonly=""> <span>Circle With Upper Right Quadrant Black</span></div>
			<div class="hiddenChar"><input type="text" value="◕" readonly=""> <span>Circle With All But Upper Left Quadrant Black</span></div>
			<div class="hiddenChar"><input type="text" value="◖" readonly=""> <span>Left Half Black Circle</span></div>
			<div class="hiddenChar"><input type="text" value="◗" readonly=""> <span>Right Half Black Circle</span></div>
			<div class="hiddenChar"><input type="text" value="◘" readonly=""> <span>Inverse Bullet</span></div>
			<div class="hiddenChar"><input type="text" value="◙" readonly=""> <span>Inverse White Circle</span></div>
			<div class="hiddenChar"><input type="text" value="◚" readonly=""> <span>Upper Half Inverse White Circle</span></div>
			<div class="hiddenChar"><input type="text" value="◛" readonly=""> <span>Lower Half Inverse White Circle</span></div>
			<div class="hiddenChar"><input type="text" value="◜" readonly=""> <span>Upper Left Quadrant Circular Arc</span></div>
			<div class="hiddenChar"><input type="text" value="◝" readonly=""> <span>Upper Right Quadrant Circular Arc</span></div>
			<div class="hiddenChar"><input type="text" value="◞" readonly=""> <span>Lower Right Quadrant Circular Arc</span></div>
			<div class="hiddenChar"><input type="text" value="◟" readonly=""> <span>Lower Left Quadrant Circular Arc</span></div>
			<div class="hiddenChar"><input type="text" value="◠" readonly=""> <span>Upper Half Circle</span></div>
			<div class="hiddenChar"><input type="text" value="◡" readonly=""> <span>Lower Half Circle</span></div>
			<div class="hiddenChar"><input type="text" value="■" readonly=""> <span>Black Square</span></div>
			<div class="hiddenChar"><input type="text" value="□" readonly=""> <span>White Square</span></div>
			<div class="hiddenChar"><input type="text" value="▢" readonly=""> <span>White Square With Rounded Corners</span></div>
			<div class="hiddenChar"><input type="text" value="▣" readonly=""> <span>White Square Containing Black Small Square</span></div>
			<div class="hiddenChar"><input type="text" value="▤" readonly=""> <span>Square With Horizontal Fill</span></div>
			<div class="hiddenChar"><input type="text" value="▥" readonly=""> <span>Square With Vertical Fill</span></div>
			<div class="hiddenChar"><input type="text" value="▦" readonly=""> <span>Square With Orthogonal Crosshatch Fill</span></div>
			<div class="hiddenChar"><input type="text" value="▧" readonly=""> <span>Square With Upper Left To Lower Right Fill</span></div>
			<div class="hiddenChar"><input type="text" value="▨" readonly=""> <span>Square With Upper Right To Lower Left Fill</span></div>
			<div class="hiddenChar"><input type="text" value="▩" readonly=""> <span>Square With Diagonal Crosshatch Fill</span></div>
			<div class="hiddenChar"><input type="text" value="▪" readonly=""> <span>Black Small Square</span></div>
			<div class="hiddenChar"><input type="text" value="▫" readonly=""> <span>White Small Square</span></div>
			<div class="hiddenChar"><input type="text" value="▬" readonly=""> <span>Black Rectangle</span></div>
			<div class="hiddenChar"><input type="text" value="▭" readonly=""> <span>White Rectangle</span></div>
			<div class="hiddenChar"><input type="text" value="▮" readonly=""> <span>Black Vertical Rectangle</span></div>
			<div class="hiddenChar"><input type="text" value="▯" readonly=""> <span>White Vertical Rectangle</span></div>
			<div class="hiddenChar"><input type="text" value="▰" readonly=""> <span>Black Parallelogram</span></div>
			<div class="hiddenChar"><input type="text" value="▱" readonly=""> <span>White Parallelogram</span></div>
			<div class="hiddenChar"><input type="text" value="▲" readonly=""> <span>Black Up-pointing Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="△" readonly=""> <span>White Up-pointing Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="▴" readonly=""> <span>Black Up-pointing Small Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="▵" readonly=""> <span>White Up-pointing Small Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="▶" readonly=""> <span>Black Right-pointing Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="▷" readonly=""> <span>White Right-pointing Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="▸" readonly=""> <span>Black Right-pointing Small Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="▹" readonly=""> <span>White Right-pointing Small Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="►" readonly=""> <span>Black Right-pointing Pointer</span></div>
			<div class="hiddenChar"><input type="text" value="▻" readonly=""> <span>White Right-pointing Pointer</span></div>
			<div class="hiddenChar"><input type="text" value="▼" readonly=""> <span>Black Down-pointing Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="▽" readonly=""> <span>White Down-pointing Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="▾" readonly=""> <span>Black Down-pointing Small Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="▿" readonly=""> <span>White Down-pointing Small Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="◀" readonly=""> <span>Black Left-pointing Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="◁" readonly=""> <span>White Left-pointing Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="◂" readonly=""> <span>Black Left-pointing Small Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="◃" readonly=""> <span>White Left-pointing Small Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="◄" readonly=""> <span>Black Left-pointing Pointer</span></div>
			<div class="hiddenChar"><input type="text" value="◅" readonly=""> <span>White Left-pointing Pointer</span></div>
			<div class="hiddenChar"><input type="text" value="◆" readonly=""> <span>Black Diamond</span></div>
			<div class="hiddenChar"><input type="text" value="◇" readonly=""> <span>White Diamond</span></div>
			<div class="hiddenChar"><input type="text" value="◈" readonly=""> <span>White Diamond Containing Black Small Diamond</span></div>
			<div class="hiddenChar"><input type="text" value="◉" readonly=""> <span>Fisheye</span></div>
			<div class="hiddenChar"><input type="text" value="◊" readonly=""> <span>Lozenge</span></div>
			<div class="hiddenChar"><input type="text" value="◢" readonly=""> <span>Black Lower Right Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="◣" readonly=""> <span>Black Lower Left Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="◤" readonly=""> <span>Black Upper Left Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="◥" readonly=""> <span>Black Upper Right Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="◦" readonly=""> <span>White Bullet</span></div>
			<div class="hiddenChar"><input type="text" value="◧" readonly=""> <span>Square With Left Half Black</span></div>
			<div class="hiddenChar"><input type="text" value="◨" readonly=""> <span>Square With Right Half Black</span></div>
			<div class="hiddenChar"><input type="text" value="◩" readonly=""> <span>Square With Upper Left Diagonal Half Black</span></div>
			<div class="hiddenChar"><input type="text" value="◪" readonly=""> <span>Square With Lower Right Diagonal Half Black</span></div>
			<div class="hiddenChar"><input type="text" value="◫" readonly=""> <span>White Square With Vertical Bisecting Line</span></div>
			<div class="hiddenChar"><input type="text" value="◬" readonly=""> <span>White Up-pointing Triangle With Dot</span></div>
			<div class="hiddenChar"><input type="text" value="◭" readonly=""> <span>Up-pointing Triangle With Left Half Black</span></div>
			<div class="hiddenChar"><input type="text" value="◮" readonly=""> <span>Up-pointing Triangle With Right Half Black</span></div>
			<div class="hiddenChar"><input type="text" value="◯" readonly=""> <span>Large Circle</span></div>
			<div class="hiddenChar"><input type="text" value="◰" readonly=""> <span>White Square With Upper Left Quadrant</span></div>
			<div class="hiddenChar"><input type="text" value="◱" readonly=""> <span>White Square With Lower Left Quadrant</span></div>
			<div class="hiddenChar"><input type="text" value="◲" readonly=""> <span>White Square With Lower Right Quadrant</span></div>
			<div class="hiddenChar"><input type="text" value="◳" readonly=""> <span>White Square With Upper Right Quadrant</span></div>
			<div class="hiddenChar"><input type="text" value="◴" readonly=""> <span>White Circle With Upper Left Quadrant</span></div>
			<div class="hiddenChar"><input type="text" value="◵" readonly=""> <span>White Circle With Lower Left Quadrant</span></div>
			<div class="hiddenChar"><input type="text" value="◶" readonly=""> <span>White Circle With Lower Right Quadrant</span></div>
			<div class="hiddenChar"><input type="text" value="◷" readonly=""> <span>White Circle With Upper Right Quadrant</span></div>
			<div class="hiddenChar"><input type="text" value="◸" readonly=""> <span>Upper Left Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="◹" readonly=""> <span>Upper Right Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="◺" readonly=""> <span>Lower Left Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="◻" readonly=""> <span>White Medium Square</span></div>
			<div class="hiddenChar"><input type="text" value="◼" readonly=""> <span>Black Medium Square</span></div>
			<div class="hiddenChar"><input type="text" value="◽" readonly=""> <span>White Medium Small Square</span></div>
			<div class="hiddenChar"><input type="text" value="◾" readonly=""> <span>Black Medium Small Square</span></div>
			<div class="hiddenChar"><input type="text" value="◿" readonly=""> <span>Lower Right Triangle</span></div>
			<div class="hiddenChar"><input type="text" value="─" readonly=""> <span>Box Drawings Light Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="━" readonly=""> <span>Box Drawings Heavy Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="│" readonly=""> <span>Box Drawings Light Vertical</span></div>
			<div class="hiddenChar"><input type="text" value="┃" readonly=""> <span>Box Drawings Heavy Vertical</span></div>
			<div class="hiddenChar"><input type="text" value="┄" readonly=""> <span>Box Drawings Light Triple Dash Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="┅" readonly=""> <span>Box Drawings Heavy Triple Dash Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="┆" readonly=""> <span>Box Drawings Light Triple Dash Vertical</span></div>
			<div class="hiddenChar"><input type="text" value="┇" readonly=""> <span>Box Drawings Heavy Triple Dash Vertical</span></div>
			<div class="hiddenChar"><input type="text" value="┈" readonly=""> <span>Box Drawings Light Quadruple Dash Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="┉" readonly=""> <span>Box Drawings Heavy Quadruple Dash Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="┊" readonly=""> <span>Box Drawings Light Quadruple Dash Vertical</span></div>
			<div class="hiddenChar"><input type="text" value="┋" readonly=""> <span>Box Drawings Heavy Quadruple Dash Vertical</span></div>
			<div class="hiddenChar"><input type="text" value="┌" readonly=""> <span>Box Drawings Light Down And Right</span></div>
			<div class="hiddenChar"><input type="text" value="┍" readonly=""> <span>Box Drawings Down Light And Right Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┎" readonly=""> <span>Box Drawings Down Heavy And Right Light</span></div>
			<div class="hiddenChar"><input type="text" value="┏" readonly=""> <span>Box Drawings Heavy Down And Right</span></div>
			<div class="hiddenChar"><input type="text" value="┐" readonly=""> <span>Box Drawings Light Down And Left</span></div>
			<div class="hiddenChar"><input type="text" value="┑" readonly=""> <span>Box Drawings Down Light And Left Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┒" readonly=""> <span>Box Drawings Down Heavy And Left Light</span></div>
			<div class="hiddenChar"><input type="text" value="┓" readonly=""> <span>Box Drawings Heavy Down And Left</span></div>
			<div class="hiddenChar"><input type="text" value="└" readonly=""> <span>Box Drawings Light Up And Right</span></div>
			<div class="hiddenChar"><input type="text" value="┕" readonly=""> <span>Box Drawings Up Light And Right Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┖" readonly=""> <span>Box Drawings Up Heavy And Right Light</span></div>
			<div class="hiddenChar"><input type="text" value="┗" readonly=""> <span>Box Drawings Heavy Up And Right</span></div>
			<div class="hiddenChar"><input type="text" value="┘" readonly=""> <span>Box Drawings Light Up And Left</span></div>
			<div class="hiddenChar"><input type="text" value="┙" readonly=""> <span>Box Drawings Up Light And Left Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┚" readonly=""> <span>Box Drawings Up Heavy And Left Light</span></div>
			<div class="hiddenChar"><input type="text" value="┛" readonly=""> <span>Box Drawings Heavy Up And Left</span></div>
			<div class="hiddenChar"><input type="text" value="├" readonly=""> <span>Box Drawings Light Vertical And Right</span></div>
			<div class="hiddenChar"><input type="text" value="┝" readonly=""> <span>Box Drawings Vertical Light And Right Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┞" readonly=""> <span>Box Drawings Up Heavy And Right Down Light</span></div>
			<div class="hiddenChar"><input type="text" value="┟" readonly=""> <span>Box Drawings Down Heavy And Right Up Light</span></div>
			<div class="hiddenChar"><input type="text" value="┠" readonly=""> <span>Box Drawings Vertical Heavy And Right Light</span></div>
			<div class="hiddenChar"><input type="text" value="┡" readonly=""> <span>Box Drawings Down Light And Right Up Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┢" readonly=""> <span>Box Drawings Up Light And Right Down Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┣" readonly=""> <span>Box Drawings Heavy Vertical And Right</span></div>
			<div class="hiddenChar"><input type="text" value="┤" readonly=""> <span>Box Drawings Light Vertical And Left</span></div>
			<div class="hiddenChar"><input type="text" value="┥" readonly=""> <span>Box Drawings Vertical Light And Left Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┦" readonly=""> <span>Box Drawings Up Heavy And Left Down Light</span></div>
			<div class="hiddenChar"><input type="text" value="┧" readonly=""> <span>Box Drawings Down Heavy And Left Up Light</span></div>
			<div class="hiddenChar"><input type="text" value="┨" readonly=""> <span>Box Drawings Vertical Heavy And Left Light</span></div>
			<div class="hiddenChar"><input type="text" value="┩" readonly=""> <span>Box Drawings Down Light And Left Up Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┪" readonly=""> <span>Box Drawings Up Light And Left Down Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┫" readonly=""> <span>Box Drawings Heavy Vertical And Left</span></div>
			<div class="hiddenChar"><input type="text" value="┬" readonly=""> <span>Box Drawings Light Down And Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="┭" readonly=""> <span>Box Drawings Left Heavy And Right Down Light</span></div>
			<div class="hiddenChar"><input type="text" value="┮" readonly=""> <span>Box Drawings Right Heavy And Left Down Light</span></div>
			<div class="hiddenChar"><input type="text" value="┯" readonly=""> <span>Box Drawings Down Light And Horizontal Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┰" readonly=""> <span>Box Drawings Down Heavy And Horizontal Light</span></div>
			<div class="hiddenChar"><input type="text" value="┱" readonly=""> <span>Box Drawings Right Light And Left Down Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┲" readonly=""> <span>Box Drawings Left Light And Right Down Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┳" readonly=""> <span>Box Drawings Heavy Down And Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="┴" readonly=""> <span>Box Drawings Light Up And Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="┵" readonly=""> <span>Box Drawings Left Heavy And Right Up Light</span></div>
			<div class="hiddenChar"><input type="text" value="┶" readonly=""> <span>Box Drawings Right Heavy And Left Up Light</span></div>
			<div class="hiddenChar"><input type="text" value="┷" readonly=""> <span>Box Drawings Up Light And Horizontal Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┸" readonly=""> <span>Box Drawings Up Heavy And Horizontal Light</span></div>
			<div class="hiddenChar"><input type="text" value="┹" readonly=""> <span>Box Drawings Right Light And Left Up Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┺" readonly=""> <span>Box Drawings Left Light And Right Up Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="┻" readonly=""> <span>Box Drawings Heavy Up And Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="┼" readonly=""> <span>Box Drawings Light Vertical And Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="┽" readonly=""> <span>Box Drawings Left Heavy And Right Vertical Light</span></div>
			<div class="hiddenChar"><input type="text" value="┾" readonly=""> <span>Box Drawings Right Heavy And Left Vertical Light</span></div>
			<div class="hiddenChar"><input type="text" value="┿" readonly=""> <span>Box Drawings Vertical Light And Horizontal Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="╀" readonly=""> <span>Box Drawings Up Heavy And Down Horizontal Light</span></div>
			<div class="hiddenChar"><input type="text" value="╁" readonly=""> <span>Box Drawings Down Heavy And Up Horizontal Light</span></div>
			<div class="hiddenChar"><input type="text" value="╂" readonly=""> <span>Box Drawings Vertical Heavy And Horizontal Light</span></div>
			<div class="hiddenChar"><input type="text" value="╃" readonly=""> <span>Box Drawings Left Up Heavy And Right Down Light</span></div>
			<div class="hiddenChar"><input type="text" value="╄" readonly=""> <span>Box Drawings Right Up Heavy And Left Down Light</span></div>
			<div class="hiddenChar"><input type="text" value="╅" readonly=""> <span>Box Drawings Left Down Heavy And Right Up Light</span></div>
			<div class="hiddenChar"><input type="text" value="╆" readonly=""> <span>Box Drawings Right Down Heavy And Left Up Light</span></div>
			<div class="hiddenChar"><input type="text" value="╇" readonly=""> <span>Box Drawings Down Light And Up Horizontal Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="╈" readonly=""> <span>Box Drawings Up Light And Down Horizontal Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="╉" readonly=""> <span>Box Drawings Right Light And Left Vertical Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="╊" readonly=""> <span>Box Drawings Left Light And Right Vertical Heavy</span></div>
			<div class="hiddenChar"><input type="text" value="╋" readonly=""> <span>Box Drawings Heavy Vertical And Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="╌" readonly=""> <span>Box Drawings Light Double Dash Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="╍" readonly=""> <span>Box Drawings Heavy Double Dash Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="╎" readonly=""> <span>Box Drawings Light Double Dash Vertical</span></div>
			<div class="hiddenChar"><input type="text" value="╏" readonly=""> <span>Box Drawings Heavy Double Dash Vertical</span></div>
			<div class="hiddenChar"><input type="text" value="═" readonly=""> <span>Box Drawings Double Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="║" readonly=""> <span>Box Drawings Double Vertical</span></div>
			<div class="hiddenChar"><input type="text" value="╒" readonly=""> <span>Box Drawings Down Single And Right Double</span></div>
			<div class="hiddenChar"><input type="text" value="╓" readonly=""> <span>Box Drawings Down Double And Right Single</span></div>
			<div class="hiddenChar"><input type="text" value="╔" readonly=""> <span>Box Drawings Double Down And Right</span></div>
			<div class="hiddenChar"><input type="text" value="╕" readonly=""> <span>Box Drawings Down Single And Left Double</span></div>
			<div class="hiddenChar"><input type="text" value="╖" readonly=""> <span>Box Drawings Down Double And Left Single</span></div>
			<div class="hiddenChar"><input type="text" value="╗" readonly=""> <span>Box Drawings Double Down And Left</span></div>
			<div class="hiddenChar"><input type="text" value="╘" readonly=""> <span>Box Drawings Up Single And Right Double</span></div>
			<div class="hiddenChar"><input type="text" value="╙" readonly=""> <span>Box Drawings Up Double And Right Single</span></div>
			<div class="hiddenChar"><input type="text" value="╚" readonly=""> <span>Box Drawings Double Up And Right</span></div>
			<div class="hiddenChar"><input type="text" value="╛" readonly=""> <span>Box Drawings Up Single And Left Double</span></div>
			<div class="hiddenChar"><input type="text" value="╜" readonly=""> <span>Box Drawings Up Double And Left Single</span></div>
			<div class="hiddenChar"><input type="text" value="╝" readonly=""> <span>Box Drawings Double Up And Left</span></div>
			<div class="hiddenChar"><input type="text" value="╞" readonly=""> <span>Box Drawings Vertical Single And Right Double</span></div>
			<div class="hiddenChar"><input type="text" value="╟" readonly=""> <span>Box Drawings Vertical Double And Right Single</span></div>
			<div class="hiddenChar"><input type="text" value="╠" readonly=""> <span>Box Drawings Double Vertical And Right</span></div>
			<div class="hiddenChar"><input type="text" value="╡" readonly=""> <span>Box Drawings Vertical Single And Left Double</span></div>
			<div class="hiddenChar"><input type="text" value="╢" readonly=""> <span>Box Drawings Vertical Double And Left Single</span></div>
			<div class="hiddenChar"><input type="text" value="╣" readonly=""> <span>Box Drawings Double Vertical And Left</span></div>
			<div class="hiddenChar"><input type="text" value="╤" readonly=""> <span>Box Drawings Down Single And Horizontal Double</span></div>
			<div class="hiddenChar"><input type="text" value="╥" readonly=""> <span>Box Drawings Down Double And Horizontal Single</span></div>
			<div class="hiddenChar"><input type="text" value="╦" readonly=""> <span>Box Drawings Double Down And Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="╧" readonly=""> <span>Box Drawings Up Single And Horizontal Double</span></div>
			<div class="hiddenChar"><input type="text" value="╨" readonly=""> <span>Box Drawings Up Double And Horizontal Single</span></div>
			<div class="hiddenChar"><input type="text" value="╩" readonly=""> <span>Box Drawings Double Up And Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="╪" readonly=""> <span>Box Drawings Vertical Single And Horizontal Double</span></div>
			<div class="hiddenChar"><input type="text" value="╫" readonly=""> <span>Box Drawings Vertical Double And Horizontal Single</span></div>
			<div class="hiddenChar"><input type="text" value="╬" readonly=""> <span>Box Drawings Double Vertical And Horizontal</span></div>
			<div class="hiddenChar"><input type="text" value="╭" readonly=""> <span>Box Drawings Light Arc Down And Right</span></div>
			<div class="hiddenChar"><input type="text" value="╮" readonly=""> <span>Box Drawings Light Arc Down And Left</span></div>
			<div class="hiddenChar"><input type="text" value="╯" readonly=""> <span>Box Drawings Light Arc Up And Left</span></div>
			<div class="hiddenChar"><input type="text" value="╰" readonly=""> <span>Box Drawings Light Arc Up And Right</span></div>
			<div class="hiddenChar"><input type="text" value="╱" readonly=""> <span>Box Drawings Light Diagonal Upper Right To Lower Left</span></div>
			<div class="hiddenChar"><input type="text" value="╲" readonly=""> <span>Box Drawings Light Diagonal Upper Left To Lower Right</span></div>
			<div class="hiddenChar"><input type="text" value="╳" readonly=""> <span>Box Drawings Light Diagonal Cross</span></div>
			<div class="hiddenChar"><input type="text" value="╴" readonly=""> <span>Box Drawings Light Left</span></div>
			<div class="hiddenChar"><input type="text" value="╵" readonly=""> <span>Box Drawings Light Up</span></div>
			<div class="hiddenChar"><input type="text" value="╶" readonly=""> <span>Box Drawings Light Right</span></div>
			<div class="hiddenChar"><input type="text" value="╷" readonly=""> <span>Box Drawings Light Down</span></div>
			<div class="hiddenChar"><input type="text" value="╸" readonly=""> <span>Box Drawings Heavy Left</span></div>
			<div class="hiddenChar"><input type="text" value="╹" readonly=""> <span>Box Drawings Heavy Up</span></div>
			<div class="hiddenChar"><input type="text" value="╺" readonly=""> <span>Box Drawings Heavy Right</span></div>
			<div class="hiddenChar"><input type="text" value="╻" readonly=""> <span>Box Drawings Heavy Down</span></div>
			<div class="hiddenChar"><input type="text" value="╼" readonly=""> <span>Box Drawings Light Left And Heavy Right</span></div>
			<div class="hiddenChar"><input type="text" value="╽" readonly=""> <span>Box Drawings Light Up And Heavy Down</span></div>
			<div class="hiddenChar"><input type="text" value="╾" readonly=""> <span>Box Drawings Heavy Left And Light Right</span></div>
			<div class="hiddenChar"><input type="text" value="╿" readonly=""> <span>Box Drawings Heavy Up And Light Down</span></div>
			<div class="hiddenChar"><input type="text" value="▀" readonly=""> <span>Upper Half Block</span></div>
			<div class="hiddenChar"><input type="text" value="▁" readonly=""> <span>Lower One Eighth Block</span></div>
			<div class="hiddenChar"><input type="text" value="▂" readonly=""> <span>Lower One Quarter Block</span></div>
			<div class="hiddenChar"><input type="text" value="▃" readonly=""> <span>Lower Three Eighths Block</span></div>
			<div class="hiddenChar"><input type="text" value="▄" readonly=""> <span>Lower Half Block</span></div>
			<div class="hiddenChar"><input type="text" value="▅" readonly=""> <span>Lower Five Eighths Block</span></div>
			<div class="hiddenChar"><input type="text" value="▆" readonly=""> <span>Lower Three Quarters Block</span></div>
			<div class="hiddenChar"><input type="text" value="▇" readonly=""> <span>Lower Seven Eighths Block</span></div>
			<div class="hiddenChar"><input type="text" value="█" readonly=""> <span>Full Block</span></div>
			<div class="hiddenChar"><input type="text" value="▉" readonly=""> <span>Left Seven Eighths Block</span></div>
			<div class="hiddenChar"><input type="text" value="▊" readonly=""> <span>Left Three Quarters Block</span></div>
			<div class="hiddenChar"><input type="text" value="▋" readonly=""> <span>Left Five Eighths Block</span></div>
			<div class="hiddenChar"><input type="text" value="▌" readonly=""> <span>Left Half Block</span></div>
			<div class="hiddenChar"><input type="text" value="▍" readonly=""> <span>Left Three Eighths Block</span></div>
			<div class="hiddenChar"><input type="text" value="▎" readonly=""> <span>Left One Quarter Block</span></div>
			<div class="hiddenChar"><input type="text" value="▏" readonly=""> <span>Left One Eighth Block</span></div>
			<div class="hiddenChar"><input type="text" value="▐" readonly=""> <span>Right Half Block</span></div>
			<div class="hiddenChar"><input type="text" value="░" readonly=""> <span>Light Shade</span></div>
			<div class="hiddenChar"><input type="text" value="▒" readonly=""> <span>Medium Shade</span></div>
			<div class="hiddenChar"><input type="text" value="▓" readonly=""> <span>Dark Shade</span></div>
			<div class="hiddenChar"><input type="text" value="▔" readonly=""> <span>Upper One Eighth Block</span></div>
			<div class="hiddenChar"><input type="text" value="▕" readonly=""> <span>Right One Eighth Block</span></div>
			<div class="hiddenChar"><input type="text" value="▖" readonly=""> <span>Quadrant Lower Left</span></div>
			<div class="hiddenChar"><input type="text" value="▗" readonly=""> <span>Quadrant Lower Right</span></div>
			<div class="hiddenChar"><input type="text" value="▘" readonly=""> <span>Quadrant Upper Left</span></div>
			<div class="hiddenChar"><input type="text" value="▙" readonly=""> <span>Quadrant Upper Left And Lower Left And Lower Right</span></div>
			<div class="hiddenChar"><input type="text" value="▚" readonly=""> <span>Quadrant Upper Left And Lower Right</span></div>
			<div class="hiddenChar"><input type="text" value="▛" readonly=""> <span>Quadrant Upper Left And Upper Right And Lower Left</span></div>
			<div class="hiddenChar"><input type="text" value="▜" readonly=""> <span>Quadrant Upper Left And Upper Right And Lower Right</span></div>
			<div class="hiddenChar"><input type="text" value="▝" readonly=""> <span>Quadrant Upper Right</span></div>
			<div class="hiddenChar"><input type="text" value="▞" readonly=""> <span>Quadrant Upper Right And Lower Left</span></div>
			<div class="hiddenChar"><input type="text" value="▟" readonly=""> <span>Quadrant Upper Right And Lower Left And Lower Right</span></div>
		</div>
	</div>
	</div>
<script>

$(function() {
	// Display the emojis for the selected category
	$('#emojiSelector span').click(function() {
	  $('#emojiSelector span').removeClass("activeCat");
	  $(this).addClass("activeCat");
	  $('div.emocat div.visibleChar').removeClass("visibleChar").addClass("hiddenChar");	  
	  $('#emocat' + $(this).data('filter') + ' div').addClass("visibleChar").removeClass("hiddenChar");
	});
});	
</script>

Web Chat
========

Web Chat component for OSSN (Open Source Social Network)

V1.0
* First release - very much an early work in progress

Tested in OSSN 5.5 with GoBlue theme.

The zip name must be WebChat.zip and after extracting it must have a root folder named WebChat containing ossn_com.php

You must add the following lines to your "Private Network" exclusions to allow this component to work correctly:

							'api',
							'webchat',
							'chat_api',
							
This needs to be added to the "Allowed Pages" array in "PrivateNetwork.php" which can be found in the classes folder of the Private Network component.							
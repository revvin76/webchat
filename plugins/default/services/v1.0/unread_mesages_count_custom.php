<?php
$guid = input('guid');
$types      = input('types');
if($guid) {
		$user = ossn_user_by_guid($guid);
}
if($user && com_is_active('OssnNotifications') && com_is_active('OssnMessages')) {
		$OssnMessages = new OssnMessages;
		$args = array(
			'from' => 'ossn_messages as m',
			'params' =>  array("count(*) as total", 'm.message_from'),
			'wheres' => array("m.message_to={$user->guid} AND m.viewed=0"),
			'group_by' => 'm.message_from',
		);
		$total = $OssnMessages->select($args, true);
		if($total){
			$params['OssnServices']->successResponse((array)$total);
		} else {
			$params['OssnServices']->throwError('200', "No unread messages has been found");
		}
		
} else {
		$params['OssnServices']->throwError('200', ossn_print('ossnservices:nouser'));
}
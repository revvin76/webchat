<?php
/**
 * WebChat Messaging Class
 *
 * @author    Kevin Brown kjbtech.co.uk
 * @copyright (C) kjbtech.co.uk
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class WebChat extends OssnEntities {
		/**
		 * Initialize the objects.
		 *
		 * @return void
		 */
		public function __construct() {
				//php warnings when deleting a message #1353
				$this->data = new stdClass;
				
				/// ADD CODE HERE TO CREATE TABLES IF THEY DONT ALREADY EXIST
		}

		/* 	NEW TABLES

			CREATE TABLE WebChat_groups (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(60) DEFAULT NULL,
			owner INT(6) UNSIGNED NOT NULL,
			deleted INT(6) UNSIGNED DEFAULT 0
			);

			CREATE TABLE WebChat_groupmembers (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			groupid INT(6) UNSIGNED NOT NULL,
			userid INT(6) UNSIGNED NOT NULL
			);

			CREATE TABLE WebChat_messages (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			groupid INT(6) UNSIGNED NOT NULL,
			message_from INT(6) UNSIGNED NOT NULL,
			message VARCHAR(999) NOT NULL,
			time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			deleted TIMESTAMP DEFAULT NULL
			);

			CREATE TABLE WebChat_messagedata (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			userid INT(6) UNSIGNED NOT NULL,
			groupid INT(6) UNSIGNED NOT NULL,
			messageid INT(6) UNSIGNED NOT NULL,
			delivered INT(6) UNSIGNED DEFAULT 0,
			viewed INT(6) UNSIGNED DEFAULT 0,
			deleted INT(6) UNSIGNED DEFAULT 0
			);
*/
		/*	NEW FUNCTIONS */
		/**
		 * Create a new group
		 *
		 * @params  string   $name    Name of group
		 * @params  integer  $owner   Guid of user creating the group
		 *
		 * @return id|false
		*/
		public function createGroup($name, $owner) {
			if(empty($name) || empty($owner)) {
				return false;
			}
						
			$params['into']   = 'WebChat_groups';
			$params['names']  = array('name', 'owner');
			$params['values'] = array($name, $owner);
			if($this->insert($params)) {
				$this->lastId = $this->getLastEntry();
				return $this->lastId;
			}
			return false;
		}

		/**
		 * Add member to group
		 *
		 * @params  integer		$group		ID of group
		 * @params  integer		$userid		Guid of user modifying the group
		 *
		 * @return boolean
		*/
		public function addMember($group, $userid) {
			if(empty($userid) || empty($group)) {
				return false;
			}
			$params['into']   = 'WebChat_groupmembers';
			$params['names'] = array('groupid', 'userid');
			$params['values'] = array($groupid,$userid);
			if($this->insert($params)) {
				$this->lastId = $this->getLastEntry();
				return $this->lastId;
			}
			return false;
		}
		
		/**
		 * Send message to group
		 *
		 * @params  integer		$group		ID of group
		 * @params  integer		$userid		Guid of user posting data
		 * @params  string		$message	Message content
		 *
		 * @return boolean
		*/
		public function sendMessage($group, $userid, $message) {
			if(!strlen($message) || empty($userid) || empty($group)) {
				return false;
			}
			$message = trim(strip_tags($message));
			
			$params['into']   = 'WebChat_messages';
			$params['names']  = array('groupid', 'message_from', 'message');
			$params['values'] = array($group, $userid, $message);
			if($this->insert($params)) {
				$message_id = $this->getLastEntry();
				
				//Reset parms[] and request the group member ids
				$params           = array();
				$params['params'] = array('userid');
				$params['from']   = "WebChat_groupmembers";
				$params['wheres'] = array(
						"id='{$group}'"
				);
				$member_ids      = $this->select($params, true);
				
				if ($member_ids) {
				/// Need to get all the user ids of group members then loop through adding a message data entry for each
					foreach ($member_ids as $member) {
						$params=[];
						$params['into']   = 'WebChat_messagedata';
						$params['names']  = array('groupid', 'userid', 'messageid');
						$params['values'] = array($group, $member, $message_id);
						if(!$this->insert($params)) return false;
					}

				}
			}
			return false;
		}

		/**
		 * Remove member from group
		 *
		 * @params  integer		$group		ID of group
		 * @params  integer		$userid		Guid of user modifying the group
		 *
		 * @return boolean
		*/
		public function removeMember($group, $userid) {
			if(empty($userid) || empty($group)) {
				return false;
			}
			$params['into']   = 'WebChat_groupmembers';
			$params['wheres'] = array("groupid='{$group}' AND userid='{$userid}'");
			if($this->delete($params)) {
				$params=[];  // Rest for second query
				$params['into']   = 'WebChat_messagedata';
				$params['wheres'] = array("groupid='{$group}' AND userid='{$userid}'");
				if($this->delete($params)) {
					return true;
				}
			}
			return false;
		}

		/**
		 * Get group messages
		 *
		 * @params  integer		$group		ID of group
		 * @params  integer		$userid		Guid of user requesting data
		 *
		 * @return object|false
		*/
		public function getMessages ($group, $userid) {
			if(empty($userid) || empty($group)) {
				return false;
			}
			$params['params']= 'msg.id, msg.message_from, msg.message, msg.time';
			$params['from']   = 'WebChat_messagedata as msgdt';
			
			$params['wheres'] = array(
					"msgdt.userid = '{$userid}' AND msgdt.groupid = '{$group}' AND msg.deleted IS NULL"
			);
			$params['joins'][] = 'INNER JOIN WebChat_messages as msg ON msg.id = msgdt.messageid';
			return $this->select($params, true);
		}

		/**
		 * Delete a group
		 *
		 * @params  integer		$group		ID of group
		 * @params  integer		$userid		Guid of user modifying the group
		 *
		 * @return boolean
		*/
		public function deleteGroup($group, $userid) {
			if(empty($userid) || empty($group)) {
				return false;
			}
			$params['table']  = 'WebChat_groups';
			$params['names']  = array('deleted');
			$params['values'] = array(time());
			$params['wheres'] = array("id='{$group}' AND owner='{$userid}'");
			if($this->update($params)) {
					return true;
			}
			return false;
		}		

		/**
		 * Mark messages delivered
		 *
		 * @params  integer		$group		ID of group
		 * @params  integer		$userid		Guid of user triggering function
		 *
		 * @return boolean
		*/		
		public function markDelivered($group, $userid) {
			if(empty($userid) || empty($group)) {
				return false;
			}
			$params['table']  = 'WebChat_messagedata';
			$params['names']  = array('delivered');
			$params['values'] = array(1);
			$params['wheres'] = array("userid='{$userid}' AND groupid='{$group}'");
			if($this->update($params)) {
				return true;
			}
			return false;
		}
		/**
		 * Mark messages viewed
		 *
		 * @params  integer		$group		ID of group
		 * @params  integer		$userid		Guid of user triggering function
		 *
		 * @return boolean
		*/		
		public function markRead($group, $userid) {
			if(empty($userid) || empty($group)) {
				return false;
			}
			$params['table']  = 'WebChat_messagedata';
			$params['names']  = array('viewed');
			$params['values'] = array(1);
			$params['wheres'] = array("userid='{$userid}' AND groupid='{$group}'");
			if($this->update($params)) {
				return true;
			}
			return false;
		}		

		/**
		 * Delete message
		 *
		 * @params  integer		$group		ID of group
		 * @params  integer		$userid		Guid of user triggering function
		 * @params  integer		$messageid  ID of message to delete
		 *
		 * @return boolean
		*/	
		public function deleteMessage($messageid, $userid, $group) {
			if(empty($messageid) || empty($userid) || empty($group)) {
				return false;
			}
			$params['table']  = 'WebChat_messages';
			$params['names']  = array('deleted');
			$params['values']  = array(now());
			$params['wheres'] = array("id='{$messageid}' AND message_from='{$userid}' AND groupid='{$group}'");
			if($this->update($params)) {
					return true;
			}
			return false;
		} 
} //class
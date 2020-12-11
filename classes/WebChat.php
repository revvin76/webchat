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
			deleted INT(6) UNSIGNED DEFAULT 0,
			photo VARCHAR(60) DEFAULT NULL
			);

			CREATE TABLE WebChat_thumbnails (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			owner INT(6) UNSIGNED NOT NULL,
			groupid INT(6) DEFAULT NULL,
			photo VARCHAR(999) DEFAULT NULL
			);
			
			CREATE TABLE WebChat_groupsphotos (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			groupid INT(6) UNSIGNED NOT NULL,
			filename VARCHAR(60) UNSIGNED NOT NULL
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
			preview VARCHAR(999) DEFAULT NULL,
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
		 * Gets user ids of everyone in the same groups as the owner
		 *
		 * @params  integer  $owner   Guid of user to check against
		 *
		 * @return object|false
		*/
		public function getMemberIDs($owner) {
			if(empty($owner)) {
				return false;
			}
			$params['params']   = array('DISTINCT(userid)');
			$params['from']   = 'WebChat_groupmembers';
			$params['wheres'] = array(
					"groupid IN(SELECT groupid FROM WebChat_groupmembers WHERE userid = '{$owner}') AND userid <> '{$owner}'"
			);
			return $this->select($params, true);
		}
		/**
		 * Check if $userid is the group owner
		 *
		 * @params  integer  $groupid   Guid of group
		 * @params  integer  $userid   	ID of current user
		 *
		 * @return object|false
		*/
		public function ownerCheck($groupid) {
			if(empty($groupid)) {
				return false;
			}			
			$params['params'] = array('owner');
			$params['from']   = 'WebChat_groups';
			$params['wheres'] = array("id = '{$groupid}'");
			return $this->select($params, true);
		}
		/**
		 * Gets group photos
		 *
		 * @params  integer  $groupid   Guid of group
		 *
		 * @return object|false
		*/
		public function getGroupPhotos($groupid) {
			if(empty($groupid)) {
				return false;
			}			
			$params['from']   = 'WebChat_groupsphotos';
			$params['wheres'] = array("groupid = '{$groupid}'");
			return $this->select($params, true);
		}
		/**
		 * Rename the group
		 *
		 * @params  integer  $groupid   Guid of group
		 * @params  string   $name      New name of group
		 * @params  integer  $userid    ID of requestor
		 *
		 * @return object|false
		*/
		public function renameGroup($groupid, $name, $userid) {
			
			if(empty($groupid) || empty($userid)) {
				return false;
			}			
			$params['table']  = 'WebChat_groups';
			$params['names']  = array('name');
			$params['values'] = array($name);
			$params['wheres'] = array("id='{$groupid}' AND owner='{$userid}'");
			if($this->update($params)) {
				return true;
			}
			return false;
		}
		/**
		 * Gets groups user is a member of
		 *
		 * @params  integer  $owner   Guid of user to check membership
		 *
		 * @return object|false
		*/
		public function getGroups($owner) {
			if(empty($owner)) {
				return false;
			}
			$params['params'] = array('g.id as groupid, g.owner as owner, g.name, g.photo, (SELECT time FROM `WebChat_messages` WHERE groupid=g.id AND deleted IS NULL ORDER BY time DESC LIMIT 1) as time, (SELECT message_from FROM `WebChat_messages` WHERE groupid=g.id AND deleted IS NULL ORDER BY time DESC LIMIT 1) as message_from, (SELECT message FROM `WebChat_messages` WHERE groupid=g.id AND deleted IS NULL ORDER BY time DESC LIMIT 1) as preview');
			$params['from']   = 'WebChat_groups as g';
			$params['wheres'] = array(
					"gm.userid = '{$owner}'"
			);
			$params['joins'][] = 'INNER JOIN WebChat_groupmembers as gm on gm.groupid = g.id';
			$params['order_by'] = 'time DESC';
			return $this->select($params, true);
			
		}
		/**
		 * Gets group info
		 *
		 * @params  integer  $groupid   Guid of group to get
		 *
		 * @return object|false
		*/
		public function getGroup($groupid) {
			if(empty($groupid)) {
				return false;
			}
			$params['from']   = 'WebChat_groups';
			$params['wheres'] = array(
					"id = '{$groupid}'"
			);
			return $this->select($params, true);
		}
		/**
		 * Gets group members
		 *
		 * @params  integer  $groupid   Guid of group to get members
		 *
		 * @return object|false
		*/
		public function getGroupMembers($groupid) {
			if(empty($groupid)) {
				return false;
			}
			$params['from']   = 'WebChat_groupmembers';
			$params['wheres'] = array(
					"groupid = '{$groupid}'"
			);
			return $this->select($params, true);
		}
		/**
		 * Create a new group
		 *
		 * @params  string   $name    Name of group
		 * @params  integer  $owner   Guid of user creating the group
		 *
		 * @return id|false
		*/
		public function createGroup($name, $owner) {
			if(empty($owner)) {
				return false;
			}
			if (empty($owner)) $owner = "";
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
		 * Delegate new owner of the group
		 *
		 * @params  integer  $groupid   Guid of the group
		 * @params  integer  $userid   	Guid of user being promoted
		 * @params  integer  $owner  	Current owner
		 *
		 * @return boolean
		*/
		public function delegateAdmin($groupid, $userid, $owner) {
			if(empty($groupid) || empty($userid) || empty($owner)) {
				return false;
			}

			$params['table']  = 'WebChat_groups';
			$params['names']  = array('owner');
			$params['values'] = array($userid);
			$params['wheres'] = array("id='{$groupid}' AND owner='{$owner}'");
			if($this->update($params)) {
				return true;
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
			$params['values'] = array($group, intVal($userid));
			if($this->insert($params)) {
				$this->lastId = $this->getLastEntry();
				return $this->lastId;
			}
			return false;
		}
		/**
		 * Change group photo
		 *
		 * @params  integer		$group		ID of group
		 * @params  string		$filename	Name of image file
		 *
		 * @return boolean
		*/
		public function changePhoto($group, $filename, $userid, $selectOnly = false) {
			if(empty($filename) || empty($group) || empty($userid)) {
				return false;
			}
			if ($selectOnly) {
				$params['table']  = 'WebChat_groups';
				$params['names']  = array('photo');
				$params['values'] = array($filename);
				$params['wheres'] = array("id='{$group}' AND owner='{$userid}'");
				if($this->update($params)) {
					return true;
				}
				return false;				
			} else {
				$params['table']  = 'WebChat_groups';
				$params['names']  = array('photo');
				$params['values'] = array($filename);
				$params['wheres'] = array("id='{$group}' AND owner='{$userid}'");
				if($this->update($params)) {
					$params = [];
					$params['into']   = 'WebChat_groupsphotos';
					$params['names'] = array('groupid', 'filename');
					$params['values'] = array($group, $filename);
					if($this->insert($params)) {
						return $filename;
					}
					return false;	
				}
				return false;
			}
		}		
/**
		 * Remove photo
		 *
		 * @params  integer		$group		ID of group
		 * @params  integer		$photoid	ID of image file
		 * @params  integer		$user		ID of requestor
		 *
		 * @return boolean
		*/
		public function removePhoto($group, $photoid, $user) {
			if(empty($group) || empty($photoid) || empty($user)) {
				error_log ("WebChat->removePhoto: Empty parameters group:".$group." photo:".$photoid." user:".$user);
				return false;
			}
			
			// Grab the filename of the photoid
			$params           = array();
			$params['params'] = array('filename');
			$params['from']   = "WebChat_groupsphotos";
			$params['wheres'] = array(
					"groupid='{$group}' AND id='{$photoid}'"
			);
			$toReturn 	= $this->select($params, true);
			$filename	= json_decode(json_encode($toReturn),true);
			$filename	= $filename[0]['filename'];
			
			// Grab the filename of the current group photo
			$params           = array();
			$params['params'] = array('photo');
			$params['from']   = "WebChat_groups";
			$params['wheres'] = array(
					"id='{$group}'"
			);
			$current 	= $this->select($params, true);
			$current	= json_decode(json_encode($current),true);			
			$current	= $current[0]['photo'];
			
			if ($filename === $current) {
				// We are deleting the current photo, so need to remove the reference from the Group
				$params['table']  = 'WebChat_groups';
				$params['names']  = array('photo');
				$params['values'] = array('');
				$params['wheres'] = array("id='{$group}' AND owner='{$user}'");
				if(!$this->update($params)) {
					error_log ("WebChat->removePhoto: Error deleting group current image reference");
					return false;
				}
			}

			$params           = array();
			$params['from']   = 'WebChat_groupsphotos';
			$params['wheres'] = array("groupid='{$group}' AND id='{$photoid}'");
				
			$this->delete($params);
			error_log ("WebChat->removePhoto: Success, returning filename");
			return $toReturn;
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
		public function sendMessage($group, $userid, $message, $preview = false) {
			if(empty($message) || (empty($userid) && $userid <> 0) || empty($group)) {
				return "Empty parameter(s) parsed";
			}
			$message = trim(strip_tags($message));
			$thumbid = null;
			
			if ($preview){
				$params=[];
				$params['into']   = 'WebChat_thumbnails';
				$params['names']  = array('owner', 'groupid', 'photo');
				$params['values'] = array($userid, $group, $preview['image']);
				if(!$this->insert($params)) return "Error saving thumbnail.";
				$preview['thumbid'] = $this->getLastEntry();
			}
				
			$params['into']   = 'WebChat_messages';
			
			if ($preview) {
				$params['names']  = array('groupid', 'message_from', 'message', 'preview');
				$params['values'] = array($group, $userid, $message, json_encode($preview));
			} else {
				$params['names']  = array('groupid', 'message_from', 'message');
				$params['values'] = array($group, $userid, $message);
			}

			if($this->insert($params)) {		

				$message_id = $this->getLastEntry();
				
				//Reset parms[] and request the group member ids
				$params           = array();
				$params['params'] = array('userid');
				$params['from']   = "WebChat_groupmembers";
				$params['wheres'] = array(
						"groupid='{$group}'"
				);
				$member_ids      = $this->select($params, true);

				if ($member_ids) {
				/// Need to get all the user ids of group members then loop through adding a message data entry for each
					foreach ($member_ids as $member) {
						$params=[];
						$params['into']   = 'WebChat_messagedata';
						$params['names']  = array('groupid', 'userid', 'messageid');
						$params['values'] = array($group, $member->userid, $message_id);
						if(!$this->insert($params)) return false;
					}
				}
				return array("messageid" => $message_id, "preview" => $preview);
			} else {
				return false;
			}
			return false;
		}

		/**
		 * Remove member from group
		 *
		 * @params  integer		$groupid		ID of group
		 * @params  integer		$userid		Guid of user modifying the group
		 *
		 * @return boolean
		*/
		public function removeMember($groupid, $userid) {
			if(empty($userid) || empty($groupid)) {
				return false;
			}
			
			// Delete member from group
			$params['from']   = 'WebChat_groupmembers';
			$params['wheres'] = array("groupid='{$groupid}' AND userid='{$userid}'");
			if($this->delete($params)) {
				
				// Delete the message metadata for messages created by user in this group
				$params=[];  // Reset for next query
				$params['from']   = 'WebChat_messagedata';
				$params['wheres'] = array("messageid IN (SELECT id FROM `WebChat_messages` WHERE groupid = '{$groupid}' AND message_from = '{$userid}')");
				$this->delete($params);
				
				// Delete messages created by user
				$params=[];  // Reset for next query
				$params['from']   = 'WebChat_messages';
				$params['wheres'] = array("groupid = '{$groupid}' AND message_from = '{$userid}'");					
				$this->delete($params);
				
				return true;
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
			//$params['params']= array('msg.id, msg.message_from, msg.message, msg.time');
			$params['from']   = 'WebChat_messagedata as msgdt';
			
			$params['wheres'] = array(
					"msgdt.userid = '{$userid}' AND msgdt.groupid = '{$group}' AND msgdt.deleted=0 AND msg.deleted IS NULL"
			);
			$params['joins'][] = 'INNER JOIN WebChat_messages as msg ON msg.id = msgdt.messageid';
			$params['order_by'] = 'time ASC';
			return $this->select($params, true);
		}
		
		public function getThumbURL ($thumbid) {
			if(empty($thumbid)) {
				return false;
			}
			$params['params']= array('photo');
			$params['from']   = 'WebChat_thumbnails';
			
			$params['wheres'] = array(
					"id = '{$thumbid}'"
			);
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
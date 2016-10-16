<?php
	class SportComponent extends Component{



		public $components = array('Auth', 'Session', 'Cookie');


		//FUNCTION FOR ENCRYPTION START

		public function encrypt($data){

			$enc_data = base64_encode($data);

			return $enc_data;

		}

		//FUNCTION FOR ENCRYPTION END


		//FUNCTION FOR DECRYPTION START

		public function decrypt($data){

			$deenc_data = base64_decode($data);

			return $deenc_data;

		}

		//FUNCTION FOR DECRYPTION END


		//FUNCTION FOR CREATING A RANDOM STRING START

		public function random_string($length=8){

			$characters = '0123456789';

			$randomString = '';

			for($i = 0; $i < $length; $i++)

				$randomString .= $characters[rand(0, strlen($characters) - 1)];

			return $randomString;

		}

		//FUNCTION FOR CREATING A RANDOM STRING END


		//FUNCTION FOR UPLAODING A FILE START

		public function uploadFile($fileArr, $path, $replaceFileName=null){ //pr($fileArr);die;
			$fileExtArr = explode('.', $fileArr['name']); // file extension
			$fileName = $this->random_string(5).time().rand(1, 99).$this->random_string(5).'.'.end($fileExtArr); //unique file name

			if($replaceFileName != ''){ // replace the new file with old name
				$fileName = $replaceFileName;
			}

			$targetPath = $path.$fileName;
			 if(move_uploaded_file($fileArr['tmp_name'], $targetPath))
				 return $fileName;
			 else
				 return '';
		}
		//FUNCTION FOR UPLAODING A FILE END


		//FUNCTION TO UPLOAD THE FILE START(SAURABH)
		function uploadFiles($path, $ext, $formData){ //echo $path.' --- '.$ext.' --- '.$formData; die;
			$filename = $this->createTempPassword(15).'.'.$ext;
			$url = $path.$filename;
		
				if(move_uploaded_file($formData['tmp_name'], $url))
					return $filename;
				else
					return '';
		}
		//FUNCTION TO UPLOAD THE FILE END


		//FUNCTION FOR PARSING THE URL START

		public function parseParameterNew($title){
			$title = trim(strtolower($title),'.');
			$title = trim($title,'-');
			$title = str_replace(' ', '-', $title);
			$title = str_replace("'", '-', $title);
			$newParameter = str_replace(array('/',' ',',','.',':',"'",'?','!','&','#39;', '--', '---'),array('-'),$title);
			return $newParameter;
		}

		//FUNCTION FOR PARSING THE URL END


		//FUNCTION TO GENERATE PASSWORD START
		public function createTempPassword($len){
		$pass = '';
		$lchar = 0;
		$char = 0;
		for($i = 0; $i < $len; $i++){
			while($char == $lchar){
				$char = rand(48, 109);
				if($char > 57) $char += 7;
				if($char > 90) $char += 6;
			}
			$pass .= chr($char);
			$lchar = $char;
		}
		return $pass;
	}
   //FUNCTION TO GENERATE PASSWORD END



		//FUNCTION FOR FETCHING THE META TAGS START
		public function fetchCorrespondingMetaTags($controller, $action, $pass=NULL){
			App::import('Model', 'MetaTags');
			$this->MetaTags = new MetaTags();

			
			$conditions['MetaTags.controller'] = $controller;
			$conditions['MetaTags.action'] = $action;
			if($pass != '')
				$conditions['MetaTags.pass'] = $pass;
			$conditions['MetaTags.status'] = '1';

			$metaTagArr = $this->MetaTags->find('first', array('fields'=>array('MetaTags.page_title', 'MetaTags.page_keywords', 'MetaTags.page_description'), 'conditions'=>$conditions));

			if(!empty($metaTagArr['MetaTags']['page_title'])){
				$ret = $metaTagArr;				
			}else{
				App::import('Model', 'DefaultMetaTags');
				$this->DefaultMetaTags = new DefaultMetaTags();

				$defaultArr = $this->DefaultMetaTags->find('first', array('fields'=>array('DefaultMetaTags.page_title', 'DefaultMetaTags.page_keywords', 'DefaultMetaTags.page_description'), 'conditions'=>array('DefaultMetaTags.id'=>1)));
				$ret = array('MetaTags'=>array('page_title'=>$defaultArr['DefaultMetaTags']['page_title'], 'page_keywords'=>$defaultArr['DefaultMetaTags']['page_keywords'], 'page_description'=>$defaultArr['DefaultMetaTags']['page_description']));
			}

			return $ret;
		}
		//FUNCTION FOR FETCHING THE META TAGS END

		//FUNCTION FOR EMAIL VALIDATION START
		function validateEmail($email){
			$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
			if(preg_match($regex, $email))
				$ret = 'valid';
			else
				$ret = 'invalid';
			return $ret;
		}
		//FUNCTION FOR EMAIL VALIDATION END

		// FUNCTION TO FETCH THE INPUTS FROM THE WEB SERVICE HIT START
		public function fetchServiceInputBojectData(){
			$json = file_get_contents('php://input');
			return json_decode($json);
		}
		// FUNCTION TO FETCH THE INPUTS FROM THE WEB SERVICE HIT END

		// FUNCTION FOR FETCHING THE MEMBERS FROM A USER NETWORK START
		public function fetch_members_from_my_network($user_id){
			App::import('Model', 'Network');
			$this->Network = new Network();

			App::import('Model', 'Chat');
			$this->Chat = new Chat();

			$ret = '';
			$finalArr = '';

			$chatUsers = '';
			$definedChatOrderArr = '';

			// find all the users associated with the user in chat start
			$orChatConditions[0]['sender_id'] = $user_id;
			$orChatConditions[1]['receiver_id'] = $user_id; //pr($orChatConditions);die;
			$chatAssociatedUsersArr = $this->Chat->find('all', array('fields'=>array('Chat.sender_id', 'Chat.receiver_id'), 'conditions'=>array('OR'=>$orChatConditions))); //pr($chatAssociatedUsersArr);die;
			if(!empty($chatAssociatedUsersArr)){
				foreach($chatAssociatedUsersArr as $key => $val){ //pr($val);die;
					if($val['Chat']['sender_id'] != $user_id)
						$chatUsersArr[] = $val['Chat']['sender_id'];

					if($val['Chat']['receiver_id'] != $user_id)
						$chatUsersArr[] = $val['Chat']['receiver_id'];
				} //pr($chatUsersArr);die;

				if(!empty($chatUsersArr))
					$chatedUsers = array_values(array_unique($chatUsersArr)); //pr($chatedUsers);die;

				// find the latest messages for these id's
				if(!empty($chatedUsers)){
					foreach($chatedUsers as $id){ //echo $id;die;
						$orConditionsArr[0]['sender_id'] = $id;
						$orConditionsArr[0]['receiver_id'] = $user_id;
						$orConditionsArr[1]['sender_id'] = $user_id;
						$orConditionsArr[1]['receiver_id'] = $id; //pr($orConditionsArr);die;
						$chatChatUsersArr = $this->Chat->find('first', array('fields'=>array('Chat.id'), 'conditions'=>array('OR'=>$orConditionsArr), 'order'=>array('Chat.id'=>'DESC'))); //pr($chatChatUsersArr);die;

						if(!empty($chatChatUsersArr)){
							$definedChatOrderArr[$chatChatUsersArr['Chat']['id']] = $id;
						}
					} //pr($definedChatOrderArr);die;

					// sort the id's on basis of keys
					if(!empty($definedChatOrderArr)){
						ksort($definedChatOrderArr); 
						$chatUsers = array_reverse($definedChatOrderArr, true);
					} //pr($chatUsers); die;
				}
			}
			// find all the users associated with the user in chat end




			$conditions['Network.request_from'] = $user_id;
			$conditions['Network.request_to'] = $user_id;

			$networkArr = $this->Network->find('all', array('conditions'=>array('Network.status'=>'1', "OR"=>$conditions))); //pr($networkArr);die;
			if(!empty($networkArr)){
				$count = 1;
				foreach($networkArr as $listing){ //pr($listing);die;
					if($listing['Network']['request_from'] != $user_id)
						$ret[$count] = $listing['Network']['request_from'];
					else
						$ret[$count] = $listing['Network']['request_to'];
					$count++;
				}
			} //pr($ret);die;
			
			// sort network list as per the chats
			if((!empty($chatUsers)) && (!empty($ret))){
				foreach($chatUsers as $key => $val){ //echo "$key => $val";die;
					if(in_array($val, $ret)){
						// add to the final arr
						$finalArr[] = $val;

						// remove the element from the users array
						foreach($ret as $k => $v){ //echo "$k => $v";die;
							if($val == $v){
								unset($ret[$k]);
							}
						}
					}
				} //pr($finalArr);die;

				if((!empty($finalArr)) && (!empty($ret))){
					foreach($ret as $k => $val){
						$finalArr[] = $val;
					}

					$ret = $finalArr;
				}
			} //pr($ret);die;
			return $ret;
		}

		public function fetch_userIds_from_my_network($user_id){
			App::import('Model', 'Network');
			$this->Network = new Network();

			App::import('Model', 'Chat');
			$this->Chat = new Chat();

			// 1. FETCH MEMBERS FROM NETWORK LIST START
			$networkListArr = array();
			$conditions['Network.request_from'] = $user_id;
			$conditions['Network.request_to'] = $user_id;

			$networkArr = $this->Network->find('all', array('conditions'=>array('Network.status'=>'1', "OR"=>$conditions))); //pr($networkArr);die;
			if(!empty($networkArr)){
				$count = 1;
				foreach($networkArr as $listing){ //pr($listing);die;
					if($listing['Network']['request_from'] != $user_id)
						$networkListArr[$count] = $listing['Network']['request_from'];
					else
						$networkListArr[$count] = $listing['Network']['request_to'];
					$count++;
				}
			} //pr($networkListArr);die;
			// 1. FETCH MEMBERS FROM NETWORK LIST END

			// 2. FETCH MEMBERS FROM CHAT START
			$newListArr = array();
			$newList = array();
			/*	$orChatConditions[0]['sender_id'] = $user_id;
			$orChatConditions[1]['receiver_id'] = $user_id; //pr($orChatConditions);die;
			$chatAssociatedUsersArr = $this->Chat->find('all', array('fields'=>array('Chat.sender_id', 'Chat.receiver_id'), 'conditions'=>array('OR'=>$orChatConditions))); //pr($chatAssociatedUsersArr);die;

			if(!empty($chatAssociatedUsersArr)){
				foreach($chatAssociatedUsersArr as $listingArr){ //pr($listingArr);die;
					$newListArr[] = $listingArr['Chat']['sender_id'].','.$listingArr['Chat']['receiver_id'];
				} //pr($newListArr);

				foreach($chatAssociatedUsersArr as $listingArr){
					$checkList = '';
					$checkList = $listingArr['Chat']['receiver_id'].','.$listingArr['Chat']['sender_id'];
					if(in_array($checkList, $newListArr)){// reverted record present
						//echo $checkList;die;
						if($listingArr['Chat']['receiver_id'] != $user_id){
							$newListArrr[] = $listingArr['Chat']['receiver_id'];
						}else{
							$newListArrr[] = $listingArr['Chat']['sender_id'];
						}
					}
				}
				$newList = array_unique($newListArrr); //pr($newList);die;
			} */
			// 2. FETCH MEMBERS FROM CHAT END

			//MERGE BOTH ARRAYS
			$returnList = array_unique(array_merge($networkListArr, $newList)); //pr($returnList);die;

			return $returnList;
		}
		// FUNCTION FOR FETCHING THE MEMBERS FROM A USER NETWORK END

		// FUNCTION FOR FETCHING THE SWIPES ADDITIONAL SWIPES START
		public function fetch_members_from_my_swipes($user_id){
			App::import('Model', 'Network');
			$this->Network = new Network();

			$ret = '';
			$finalArr = '';

			// find all the users associated with the user in chat start
			$orChatConditions[0]['request_from'] = $user_id;
			$orChatConditions[1]['request_to'] = $user_id;

			//$swipeAssociatedUsersArr = $this->Network->find('all', array('conditions'=>array('OR'=>$orChatConditions, 'Network.status <>'=>'1')));  //pr($swipeAssociatedUsersArr);die;
			$swipeAssociatedUsersArr = $this->Network->find('all', array('conditions'=>array('OR'=>$orChatConditions)));  //pr($swipeAssociatedUsersArr);die;
			if(!empty($swipeAssociatedUsersArr)){
				foreach($swipeAssociatedUsersArr as $swipeArr){
					if($swipeArr['Network']['request_from'] != $user_id)
						$finalArr[] = $swipeArr['Network']['request_from'];
					else
						$finalArr[] = $swipeArr['Network']['request_to'];
				}// pr($finalArr);die;

				$ret = array_unique($finalArr);
			}
			return $ret;
		}
		// FUNCTION FOR FETCHING THE SWIPES ADDITIONAL SWIPES END

		//FUNCTION TO CALCULATE THE TIME DIFFERENCE START
		public function calculateTimeDiff($startDateTime, $endDateTime=NULL){ //echo $startDateTime;die;
			if($endDateTime == '')
				$endDateTime = date('Y-m-d H:i:s');

			$startDateTime = new DateTime($startDateTime);
			$endDateTime = new DateTime($endDateTime);

			$interval = $startDateTime->diff($endDateTime);

			$diffArr['Years'] = (int)$interval->y;
			$diffArr['Months'] = (int)$interval->m;
			$diffArr['Days'] = (int)$interval->d;
			$diffArr['Hours'] = (int)$interval->h;
			$diffArr['Minutes'] = (int)$interval->i; //pr($diffArr);die;

			$year = 'years';
			if($diffArr['Years'] == 1)
				$year = 'year';

			$month = 'months';
			if($diffArr['Months'] == 1)
				$month = 'month';

			$day = 'days';
			if($diffArr['Days'] == 1)
				$day = 'day';

			$hour = 'hours';
			if($diffArr['Hours'] == 1)
				$hour = 'hour';

			$min = 'minutes';
			if($diffArr['Minutes'] == 1)
				$min = 'minute';

			$ret = '';

			if($diffArr['Years'] > 0)
				$ret .= $diffArr['Years'].' '.$year.' ';

			if($diffArr['Months'] > 0)
				$ret .= $diffArr['Months'].' '.$month.' ';

			if($diffArr['Days'] > 0)
				$ret .= $diffArr['Days'].' '.$day.' ';

			if($diffArr['Hours'] > 0)
				$ret .= $diffArr['Hours'].' '.$hour.' ';

			if($diffArr['Minutes'] > 0)
				$ret .= $diffArr['Minutes'].' '.$min;

			if($ret != '')
				$ret .= ' ago';

			echo $ret;die;

			return $ret;
		}

		public function fetchLastInactive($startDateTime){ //echo 'S'.$startDateTime;
			$endDateTime = date('Y-m-d H:i:s');// echo ' E'.$endDateTime.'++';

			// return types
			$ret = '';

			$t1 = strtotime($endDateTime);
			$t2 = strtotime($startDateTime);
			$diff = $t1 - $t2;
			$hours = ($diff/(60 * 60));

			//1. if result hours are >= 24, show no. of days
			if($hours > 0){
				if($hours >= 24){
					$days = round($hours/24);
					if($days > 30){// i. show no. of months
						$mnth = floor(($days/30));
						$ret = $mnth.' Months';
						if($mnth == 1)
							$ret = $mnth.' Month';
					}else{ // show no. of days
						$ret = $days.' Days';
						if($days == 1){
							$ret = $days.' Day';
						}
					}
				}elseif(($hours < 24) && ($hours > 1)){ // 2. if result hours are < 24, show no. of hours
					$ret = round($hours).' Hours';
					if($hours == 1)
						$ret = round($hours).' Hour';
				}elseif($hours < 1){ // 3. if result hours are < 1, show no. of mins
					//$ret = round($hours * 60).' Minutes';
					$ret = round($hours * 60).' Min';
				} //pr($ret);die;

				$ret = $ret.' Ago'; //echo '<br/>'.$ret;die;
			}

			return $ret;
		}
		//FUNCTION TO CALCULATE THE TIME DIFFERENCE END

		// FUNCTION FOR FETCHING A USER DETAILS START
		public function fetchUserDetails($userId, $loggedInUserId=null){ //echo "$userId, $loggedInUserId"; die;
			App::import('Model', 'User');
			$this->User = new User();

			App::import('Model', 'UserImage');
			$this->UserImage = new UserImage();

			App::import('Model', 'Wealth');
			$this->Wealth = new Wealth();

			App::import('Model', 'Video');
			$this->Video = new Video();

			App::import('Model', 'Preference');
			$this->Preference = new Preference();

			App::import('Model', 'Profile');
			$this->Profile = new Profile();

			App::import('Model', 'UserSetting');
			$this->UserSetting = new UserSetting();

			App::import('Model', 'Chat');
			$this->Chat = new Chat();

			App::import('Model', 'Network');
			$this->Network = new Network();

			$userDetails = '';
			//$SITE_PATH = 'http://dev.codingexperts.in/top10/';
			$SITE_PATH = SITE_PATH;;
			
			$userArr = $this->User->find('first', array('conditions'=>array('User.id'=>$userId, 'User.status'=>'1'))); //pr($userArr);die;
			if(!empty($userArr)){
				$userDetails['User']['id'] = $userArr['User']['id'];
				$userDetails['User']['email'] = $userArr['User']['email'];
				$userDetails['User']['username'] = $userArr['User']['username'];
				$userDetails['User']['dob'] = $userArr['User']['dob'];
				$userDetails['User']['gender'] = $userArr['User']['gender'];
				$userDetails['User']['online_status'] = $userArr['User']['online_status'];
				$userDetails['User']['memberSince'] = date('M, Y', strtotime($userArr['User']['created']));
				$userDetails['User']['score'] = $userArr['User']['score'];

				// calculate last active
				$userDetails['User']['last_seen'] = '';
				if(($userArr['User']['last_inactive'] != '') && ($userArr['User']['online_status'] == '0')){
					//$userDetails['User']['last_seen'] = $this->calculateTimeDiff($userArr['User']['last_inactive']);
					$userDetails['User']['last_seen'] = $this->fetchLastInactive($userArr['User']['last_inactive']);
				}


				if(isset($userArr['Profile']) && (!empty($userArr['Profile']))){
					$userDetails['User']['education'] = $userArr['Profile']['education'];
					$userDetails['User']['college'] = '';
					if($userArr['Profile']['college'] != '')
						$userDetails['User']['college'] = $userArr['Profile']['college'];
					$userDetails['User']['profession'] = $userArr['Profile']['profession'];
					// for wealth
					if($userArr['Profile']['wealth_id'] != ''){
						$wealthArr = $this->Wealth->findById($userArr['Profile']['wealth_id']); //pr($wealthArr);die;
						if(!empty($wealthArr)){
							$userDetails['User']['wealth'] = $wealthArr['Wealth']['parameter_name'];
						}
					}
					$userDetails['User']['about_me'] = $userArr['Profile']['about_me']; //pr($userDetails);die;
				}

				// Fetch the user preferences start
				if(isset($userArr['Preference']) && !empty($userArr['Preference'])){
					$userDetails['Preference']['gender'] = $userArr['Preference']['gender'];
					$userDetails['Preference']['age_min'] = $userArr['Preference']['age_min'];
					$userDetails['Preference']['age_max'] = $userArr['Preference']['age_max'];
					$userDetails['Preference']['proximity'] = $userArr['Preference']['proximity'];
					$userDetails['Preference']['interests'] = $userArr['Preference']['interests'];
				}
				// Fetch the user preferences end

				// Fetch the user images
				$userDetails['Images'] = '';
				$userImagesArr = $this->UserImage->find('all', array('conditions'=>array('UserImage.status'=>'1', 'UserImage.user_id'=>$userId), 'order'=>array('UserImage.image_type'=>'ASC'), 'limit'=>6)); //pr($userImagesArr);die;
				if(!empty($userImagesArr)){
					$count = 1;
					foreach($userImagesArr as $listing){
						$userDetails['Images'][$count]['path'] = $SITE_PATH.'img/Users/'.$listing['UserImage']['image'];
						$userDetails['Images'][$count]['type'] = $listing['UserImage']['image_type'];
						$count++;
					}
				} //pr($userDetails);die;

				// fetch user uloaded video
				$userDetails['Video'] = '';
				$userVideoArr = $this->Video->find('first', array('conditions'=>array('Video.user_id'=>$userId), 'order'=>array('Video.id'=>'DESC'), 'limit'=>1));
				if(!empty($userVideoArr)){
					$userDetails['Video'] = $SITE_PATH.'img/videos/'.$userVideoArr['Video']['video'];
				} //pr($userDetails);die;

				// fetch user settings
				$userDetails['Settings'] = '';
				$userSettingArr = $this->UserSetting->findByUserId($userId); //pr($userSettingArr);die;
				if(!empty($userSettingArr)){
					$userDetails['Settings']['newMatch'] = $userSettingArr['UserSetting']['notification_new_match'];
					$userDetails['Settings']['message'] = $userSettingArr['UserSetting']['notification_message'];
					$userDetails['Settings']['memberProximitySound'] = $userSettingArr['UserSetting']['member_proximity_sound'];
					$userDetails['Settings']['myNetwork'] = $userSettingArr['UserSetting']['my_network'];
					$userDetails['Settings']['otherMembers'] = $userSettingArr['UserSetting']['other_members'];
					$userDetails['Settings']['topMembers'] = $userSettingArr['UserSetting']['all_top_members'];
				} //pr($userDetails);die;

				//FIND THE TOTAL UNREAD CHATS START
				if($loggedInUserId == null){
					$userDetails['UnreadMessages'] = 0;
					//$um = (int)$this->Chat->find('count', array('conditions'=>array('Chat.receiver_id'=>$userId, 'Chat.status'=>'0'), 'group'=>array('Chat.sender_id'))); 
					
					//PATCH TO FETCH ONLY NETWORK UNREAD CHATS
					$networkArr = $this->fetch_userIds_from_my_network($userId); //pr($networkArr);die;					
					if(!empty($networkArr)){
						$um = (int)$this->Chat->find('count', array('conditions'=>array('Chat.sender_id'=>$networkArr, 'Chat.receiver_id'=>$userId, 'Chat.status'=>'0'), 'group'=>array('Chat.sender_id'))); 
						if($um > 0)
							$userDetails['UnreadMessages'] = $um;
						}
					//pr($userDetails['UnreadMessages']);die;
				}
				//FIND THE TOTAL UNREAD CHATS END

				//Common interests start
				if(isset($loggedInUserId) && ($loggedInUserId != '')){
					if(isset($userDetails['Preference']['interests'])){
						$targetUserInterests = $userDetails['Preference']['interests'];
						$loggedInUserInterests = '';

						//logged in user preferences
						$this->Preference->recursive = -1;
						$loggedInUserPreferenceArr = $this->Preference->findByUserId($loggedInUserId); //pr($loggedInUserPreferenceArr);die;
						if(!empty($loggedInUserPreferenceArr)){
							$loggedInUserInterests = $loggedInUserPreferenceArr['Preference']['interests']; //echo $loggedInUserInterests;die;
						} //echo $loggedInUserInterests;die;

						if(($targetUserInterests != '') && ($loggedInUserInterests != '')){
							$targetUserInterestsArr = explode(',', $targetUserInterests);//pr($targetUserInterestsArr);
							$loggedInUserInterestsArr = explode(',', $loggedInUserInterests); //pr($loggedInUserInterestsArr);
							$commonInterestsArr = array_intersect($targetUserInterestsArr, $loggedInUserInterestsArr); //pr($commonInterestsArr);die;
							$commonInterests = implode(',', $commonInterestsArr); //echo $commonInterests;die;
							$userDetails['Common Interests'] = $commonInterests;
						}else
							$userDetails['Common Interests'] = '';
					}else
						$userDetails['Common Interests'] = '';

					// fetch last message start
					$userDetails['Chat Last Message'] = '';
					$orConditions[0]['Chat.sender_id'] = $userId;
					$orConditions[0]['Chat.receiver_id'] = $loggedInUserId;
					$orConditions[1]['Chat.sender_id'] = $loggedInUserId;
					$orConditions[1]['Chat.receiver_id'] = $userId;

					$chatArr = $this->Chat->find('first', array('conditions'=>array('OR'=>$orConditions), 'order'=>array('Chat.id'=>'DESC'))); //pr($chatArr);die; 
					if(!empty($chatArr)){
						$userDetails['Chat Last Message']['messageId'] = $chatArr['Chat']['id'];
						$userDetails['Chat Last Message']['senderId'] = $chatArr['Chat']['sender_id'];
						$userDetails['Chat Last Message']['receiverId'] = $chatArr['Chat']['receiver_id'];
						$userDetails['Chat Last Message']['message'] = $chatArr['Chat']['message'];
						$userDetails['Chat Last Message']['timestamp'] = $chatArr['Chat']['created'];
					}
					// fetch last message end

					// FETCH THE UNREAD MESSAGES START
					$userDetails['UnreadMessages'] = 0;
					if(isset($loggedInUserId) && ($loggedInUserId != '')){
						$um = (int)$this->Chat->find('count', array('conditions'=>array('Chat.status'=>'0', 'Chat.sender_id'=>$userId, 'Chat.receiver_id'=>$loggedInUserId)));
						if($um > 0)
							$userDetails['UnreadMessages'] = $um;
					}
					// FETCH THE UNREAD MESSAGES END

					// FIND DISTANCE BETWEEN 2 USERS START
					if(($userId != '') && ($loggedInUserId != '')){
						$userDetails['Distance'] = '';

						// end user co-ordinates
						$cord['lat1'] = 0;
						$cord['lon1'] = 0;
						if(!empty($userArr['Profile']['latitude']) && !empty($userArr['Profile']['longitude'])){
							$cord['lat1'] = $userArr['Profile']['latitude'];
							$cord['lon1'] = $userArr['Profile']['longitude']; //pr($cord);die;
						}

						// logged in user co-ordinates
						$cord['lat2'] = 0;
						$cord['lon2'] = 0;
						$loggedInUserArr = $this->Profile->find('first', array('fields'=>array('Profile.latitude', 'Profile.longitude'), 'conditions'=>array('Profile.user_id'=>$loggedInUserId))); //pr($loggedInUserArr);die;
						if(!empty($loggedInUserArr)){
							$cord['lat2'] = $loggedInUserArr['Profile']['latitude'];
							$cord['lon2'] = $loggedInUserArr['Profile']['longitude'];
						} //pr($cord);die;

						// find the distance
						$theta = $cord['lon1'] - $cord['lon2'];
						$dist = sin(deg2rad($cord['lat1'])) * sin(deg2rad($cord['lat2'])) +  cos(deg2rad($cord['lat1'])) * cos(deg2rad($cord['lat2'])) * cos(deg2rad($theta));
						$dist = acos($dist);
						$dist = rad2deg($dist);
						$miles = ($dist * 60 * 1.1515);
						//$miles = number_format($miles, 1); 
						$miles = (int)$miles;
						$userDetails['Distance'] = $miles.' Miles Away';
					}
					// FIND DISTANCE BETWEEN 2 USERS END

					// FIND NETWORK TYPE START
					if(($userId != '') && ($loggedInUserId != '')){
						$conditions[0]['Network.request_from'] = $userId;
						$conditions[0]['Network.request_to'] = $loggedInUserId;
						$conditions[1]['Network.request_to'] = $userId;
						$conditions[1]['Network.request_from'] = $loggedInUserId; //pr($conditions);die;

						$userDetails['networkType'] = 'Network';
						$networkArr = $this->Network->find('first', array('conditions'=>array("OR"=>$conditions))); //pr($networkArr);die;
						if(!empty($networkArr)){
							$userDetails['networkType'] = ucwords($networkArr['Network']['network_type']);
						}
					}
				// FIND NETWORK TYPE END
				}
			}
			//Common interests end
			//pr($userDetails);die;
			return $userDetails;
		}
		// FUNCTION FOR FETCHING A USER DETAILS END

		// FUNCTION FOR SAVING THE PROVIDED LAT LONG START
		public function saveUserLatLong($userId, $lat, $long){ //echo "$userId, $lat, $long";die;
			App::import('Model', 'Profile');
			$this->Profile = new Profile(); 

			App::import('Model', 'UserCoordinate');
			$this->UserCoordinate = new UserCoordinate(); 

			$ret = '';

			// search last record of User
			$coOrdinatesArr = $this->UserCoordinate->find('first', array('conditions'=>array('UserCoordinate.user_id'=>$userId), 'order'=>array('UserCoordinate.id'=>'DESC'), 'limit'=>1)); //pr($coOrdinatesArr);die;
			if(!empty($coOrdinatesArr)){
				if(($coOrdinatesArr['UserCoordinate']['latitude'] == $lat) && ($coOrdinatesArr['UserCoordinate']['longitude'] == $long)){// update the record
					$saveCordData['id'] = $coOrdinatesArr['UserCoordinate']['id'];
				}
			}

			// add the record in coordinates table
			$saveCordData['user_id'] = $userId;
			$saveCordData['latitude'] = $lat;
			$saveCordData['longitude'] = $long; //pr($saveCordData);die;
			$this->UserCoordinate->save($saveCordData, false);

			// find the user existence
			$this->Profile->recursive = -1;
			$profileArr = $this->Profile->findByUserId($userId); //pr($profileArr);die;
			if(!empty($profileArr)){
				$saveData['id'] = $profileArr['Profile']['id'];
			}

			$saveData['user_id'] = $userId;
			$saveData['latitude'] = $lat;
			$saveData['longitude'] = $long; //pr($saveData);die;

			$this->Profile->save($saveData, false);
			return $ret;
		}
		// FUNCTION FOR SAVING THE PROVIDED LAT LONG END

		//FUNCTION TO FIND USER PROXIMITY START
		public function fetchUserPreferences($userId){
			App::import('Model', 'Preference');
			$this->Preference = new Preference();

			$ret = '';

			$this->Preference->recursive = -1;
			$preferenceArr = $this->Preference->find('first', array('conditions'=>array('Preference.user_id'=>$userId)));
			if(!empty($preferenceArr)){
				$ret = $preferenceArr;
			}
			return $ret;
		}
		//FUNCTION TO FIND USER PROXIMITY END

		//FUNCTION FOR FETCHING THE EDUCATION LIST FOR SAVING START
		public function saveEducationDetails($userId, $educationList){ //echo "$userId, $educationList";die;
			App::import('Model', 'Profile');
			App::import('Model', 'User');
			$this->Profile = new Profile();
			$this->User = new User();

			$find = $educationList;

			$this->Profile->recursive = -1;
			$profileArr = $this->Profile->findByUserId($userId); //pr($profileArr);die;

			if(!empty($profileArr)){
				if($profileArr['Profile']['education'] != ''){
					$educationArr = explode(',', $profileArr['Profile']['education']); //pr($educationArr);die;
					
					if(in_array($educationList, $educationArr)){
						$find = $profileArr['Profile']['education'];
					}else{
						$find = $profileArr['Profile']['education'].','.$educationList;
					}
				}
			}
			return $find;
		}
		//FUNCTION FOR FETCHING THE EDUCATION LIST FOR SAVING END

		//FUNCTION FOR FETCHING THE BLOCK LIST START
		public function fetchBockedUsers($id){ //echo $id;die;
			App::import('Model', 'BlockList');
			$this->BlockList = new BlockList();

			$ret = array();

			$or['BlockList.request_from'] = $id;
			$or['BlockList.request_to'] = $id;

			$blockListArr = $this->BlockList->find('all', array('fields'=>array('BlockList.request_from', 'BlockList.request_to'), 'conditions'=>array("OR"=>$or))); //pr($blockListArr);die;

			if(!empty($blockListArr)){
				foreach($blockListArr as $list){ //pr($list);die;
					if($list['BlockList']['request_from'] != $id)
						$ret[] = $list['BlockList']['request_from'];
					else
						$ret[] = $list['BlockList']['request_to'];
				}
			}

			return $ret;
		}
		//FUNCTION FOR FETCHING THE BLOCK LIST END

		//FUNCTION FOR FETCHING THE "HIDE FROM MINGLE LIST" START
		public function fetchMingleOffListUsers($id){ //echo $id;die;
			App::import('Model', 'UserSetting');
			$this->UserSetting = new UserSetting();

			$ret = array();

			$offListArr = $this->UserSetting->find('list', array('fields'=>array('UserSetting.user_id'), 'conditions'=>array('UserSetting.my_network'=>'0', 'UserSetting.all_top_members'=>'0', 'UserSetting.other_members'=>'', 'UserSetting.user_id <>'=>$id))); //pr($offListArr);die;

			if(!empty($offListArr)){
				foreach($offListArr as $list){ //pr($list);die;
					$ret[] = $list;
				}
			}

			return $ret;
		}
		//FUNCTION FOR FETCHING THE "HIDE FROM MINGLE LIST" END

		// FUNCTION FOR UPDATING THE SWIPE FOR USER START
		public function updateUserSwipe($userId, $swipeType){ //echo "$userId, $swipeType";die;
			App::import('Model', 'User');
			$this->User = new User();

			if($swipeType == 'LIKE')
				$this->User->updateAll(array('User.positive_swipes'=>'User.positive_swipes+1'), array('User.id'=>$userId));
			else
				$this->User->updateAll(array('User.negative_swipes'=>'User.negative_swipes+1'), array('User.id'=>$userId));
		}
		// FUNCTION FOR UPDATING THE SWIPE FOR USER END
	}



?>

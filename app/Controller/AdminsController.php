<?php
App::uses('AppController', 'Controller');
/**
 * Admins Controller
 *
 * @property Admin $Admin
 * @property PaginatorComponent $Paginator
 */
class AdminsController extends AppController{
/**
 * Components
 *
 * @var array
 */

	//BEFORE FILTER START
	public function beforeFilter(){
		parent::beforeFilter();
		if(!empty($this->Auth)){
			$this->Auth->allow('admin_sign_in', 'admin_forgot_password');
		}
	}
	//BEFORE FILTER END

	/*------------------------------------ ADMIN SECTION START -----------------------------------------------*/
	//FUNCTION FOR ADMIN SIGN IN START
	public function admin_sign_in(){
		$this->layout = 'Admin/sign_in';  //echo $this->Auth->password('123456');

		$this->validateAfterLogin(); // validate after login

		if(!empty($this->request->data)){ //pr($this->request->data);die;
			$adminArr = $this->Admin->find('first', array('conditions'=>array('Admin.username'=>$this->request->data['Admin']['username'], 'Admin.password'=>$this->Auth->password($this->request->data['Admin']['password_1']))));

			if(!empty($adminArr)){ //pr($adminArr);die;
				if($adminArr['Admin']['type'] == 'SUP'){ //if SUPER ADMIN, then directly login
					if($this->Auth->login($adminArr)){
						$this->manageLastLogin($adminArr); // Manage the last login of admin
						$this->redirect('/admin/admins/dashboard/');
					}else
						$this->Session->setFlash('Unable to Authorize!', 'message', array('class'=>'msg_error'));
				}else{ // if SUB_ADMIN, then check the status
					if($adminArr['Admin']['status'] == '1')
						$this->redirect('/admin/admins/dashboard/');
					else
						$this->Session->setFlash('Inactive Account!', 'message', array('class'=>'msg_error'));
				}
			}else
				$this->Session->setFlash('Invalid Username or Password!', 'message', array('class'=>'msg_error'));
		}
	}
	//FUNCTION FOR ADMIN SIGN IN END

	//FUNCTION FOR ADMIN LOGOUT START
	public function admin_sign_out(){
		if($this->Auth->logout())
			$this->redirect('/admin/admins/sign_in');
		else
			$this->redirect('/admin/admins/dashboard/');
	}
	//FUNCTION FOR ADMIN LOGOUT END

	//FUNCTION FOR ADMIN SIGN OUT START
	public function admin_dashboard(){
		
	}
	//FUNCTION FOR ADMIN SIGN OUT END

	//FUNCTION FOR FORGOT PASSWORD START
	public function admin_forgot_password(){
		$this->layout = 'Admin/sign_in';

		$this->validateAfterLogin(); // validate after login

		if(!empty($this->request->data)){ //pr($this->request->data);die;
			$this->Admin->recursive = -1;
			$adminArr = $this->Admin->findByEmail($this->data['Admin']['email']);
			if(!empty($adminArr)){ //pr($adminArr);die;
				Controller::loadModel('User'); // load the User Model for using its function defined in Model
				$tempPass = $this->Sport->random_string(8);

				$saveData['id'] = $adminArr['Admin']['id'];
				$saveData['password'] = $this->Auth->password($tempPass);

				if($this->Admin->save($saveData, false)){
					//set the required data
					$this->set('adminArr', $adminArr);
					$this->set('tempPass', $tempPass);

					//Send Email Notification Carrying the Admin Login Credentials
					$this->Email->to = $adminArr['Admin']['email'];
					$this->Email->from = ADMIN_EMAIL_FROM;
					$this->Email->subject = 'Admin Username and Password!';
					$this->Email->layout = 'default';
					$this->Email->template = 'Admin/forgot_password';
					$this->Email->sendAs = 'html';
					$this->Email->send();
				
					$this->Session->setFlash('Your new password has been sent to your email!!', 'message', array('class'=>'msg_success'));
					$this->redirect('/admin/admins/sign_in');
				}else
					$this->Session->setFlash('Please Try Later!!', 'message', array('class'=>'msg_error'));
			}else
				$this->Session->setFlash('No Associated Email Found!!', 'message', array('class'=>'msg_error'));
		}
	}
	//FUNCTION FOR FORGOT PASSWORD END

	//FUNCTION VALIDATE PUBLIC PAGES AFTER LOGIN START
	public function validateAfterLogin(){
		$adminSessionId = $this->Session->read('Auth.Admin.Admin.id');
		if($adminSessionId != '')
			$this->redirect('/admin/admins/dashboard/');
	}
	//FUNCTION VALIDATE PUBLIC PAGES AFTER LOGIN END

	//FUNCTION FOR MANAGING THE LAST LOGIN OF ADMIN START
	public function manageLastLogin($adminArr){
		$saveData['id'] = $adminArr['Admin']['id'];
		$saveData['last_login'] = $adminArr['Admin']['modified'];
		if($this->Admin->save($saveData, false))
			return true;
	}
	//FUNCTION FOR MANAGING THE LAST LOGIN OF ADMIN END

	//FUNCTION FOR CHANGING THE ADMIN EMAIL START
	public function admin_change_email(){
		if(!empty($this->request->data)){ //pr($this->request->data);die;
			$saveData['id'] = $this->request->data['Admin']['id'];
			$saveData['email'] = $this->request->data['Admin']['email'];
			if($this->Admin->save($saveData, false))
				$this->Session->setFlash('Email Updated Successfully!!', 'message', array('class'=>'msg_success'));
			else
				$this->Session->setFlash('Please Try Later!!', 'message', array('class'=>'msg_error'));
		}

		$this->data = $this->Admin->findById($this->Session->read('Auth.Admin.Admin.id'));
	}
	//FUNCTION FOR CHANGING THE ADMIN EMAIL END

	//FUNCTION FOR ADMIN LOGIN CHANGE PASSWORD START
	public function admin_change_password(){
		if(!empty($this->request->data)){ //pr($this->request->data);die;
			$id = $this->Session->read('Auth.Admin.Admin.id');

			$adminArr = $this->Admin->find('first', array('conditions'=>array('Admin.id'=>$id, 'Admin.password'=>$this->Auth->password($this->request->data['Admin']['current_password'])))); //pr($adminArr);die;

			if(!empty($adminArr)){
				$saveData['id'] = $id;
				$saveData['password'] = $this->Auth->password($this->request->data['Admin']['new_password']);
				if($this->Admin->save($saveData)){
					$this->Session->setFlash('Password Changed Successfully!!', 'message', array('class'=>'msg_success'));
					$this->redirect('/admin/admins/change_password/');
				}else
					$this->Session->setFlash('Please Try Later!!', 'message', array('class'=>'msg_error'));
			}else
				$this->Session->setFlash('Invalid Current Password!!', 'message', array('class'=>'msg_error'));
		}
	}
	//FUNCTION FOR ADMIN LOGIN CHANGE PASSWORD END
	/*------------------------------------ ADMIN SECTION END   -----------------------------------------------*/

	/*------------------------------------ SETTING SECTION START SECTION START   -----------------------------------------------*/
	//FUNCTON FOR SETTINGS START
	public function admin_settings(){
		Controller::loadModel('Setting');
		$this->paginate = array('limit'=>PAGINATION, 'order'=>array('Setting.id'=>'ASC'));
		$this->set('viewListing', $this->paginate('Setting'));
	}
	//FUNCTON FOR SETTINGS END

	//FUNCTION FOR UPDATING THE SETTING START 
	public function admin_settings_edit($id){
		Controller::loadModel('Setting');
		if(!empty($this->request->data)){ //pr($this->request->data);die;
			if($this->Setting->save($this->request->data, false)){
				$this->Session->setFlash('Settings Updated Successfully!!', 'message', array('class'=>'msg_success'));
				$this->redirect('/admin/admins/settings/');
			}else
				$this->Session->setFlash('Please Try Later!!', 'message', array('class'=>'msg_error'));
		}

		$this->data = $this->Setting->findById($id);
	}
	//FUNCTION FOR UPDATING THE SETTING END

	//FUNCTION FOR SETTING THE STATUS START
	public function admin_set_settings_status($id=NULL, $newStatus=NULL){
		Controller::loadModel('Setting');
		if(($id != '') && ($newStatus != '')){
			$saveData['id'] = $id;
			$saveData['status'] = $newStatus;
			if($newStatus == '1')
				$msg = 'Activated';
			else
				$msg = 'Deactivated';
			if($this->Setting->save($saveData, false))
				$this->Session->setFlash('Setting '.$msg.' Successfully!!', 'message', array('class'=>'msg_success'));
			else
				$this->Session->setFlash('Please Try Later!!', 'message', array('class'=>'msg_error'));
			$this->redirect('/admin/admins/settings/');
		}else
			$this->redirect('/admin/admins/settings/');
		exit;	
	}

  public function admin_manage_fire_station(){
	  Controller::loadModel('Station');
		$cond = array();
	    $this->paginate = array('conditions'=>$cond,'limit'=>PAGINATION, 'order'=>array('Station.id'=>'ASC'));
		$this->set('fireListing', $this->paginate('Station'));
	}

	public function admin_add_fire_station() {
		Controller::loadModel('Station');
		if(!empty($this->request->data)){
			$saveData = $this->request->data;
			if($this->Station->save($saveData)){
				$this->Session->setFlash('Station Added Successfully!!', 'message', array('class'=>'msg_success'));
				$this->redirect('/admin/admins/manage_fire_station/');
			}else
				$this->Session->setFlash('Error! Please Correct Following Errors!', 'message', array('class'=>'msg_error'));
			/*---------- ALIAS NAME END -------------*/
		}
	}


    // FUNCTION FOR MANAGING THE STATUS START
	public function admin_station_status($id=NULL, $newStatus=NULL){
		Controller::loadModel('Station');
		if(($id != '') && ($newStatus != '')){
			$saveData['id'] = $id;
			$saveData['status'] = $newStatus;
			if($newStatus == '1')
				$msg = 'Activated';
			else
				$msg = 'Deactivated';
			if($this->Station->save($saveData, false))
				$this->Session->setFlash('Station '.$msg.' Successfully!!', 'message', array('class'=>'msg_success'));
			else
				$this->Session->setFlash('Please Try Later!!', 'message', array('class'=>'msg_error'));
			$this->redirect('/admin/admins/manage_fire_station/');
		}else
			$this->redirect('/admin/admins/manage_fire_station/');
		exit;
	}
//FUNCTION FOR DELETING A PRODUCT START
	public function admin_delete_station($id){
		Controller::loadModel('Station');
		if($id != ''){
			$userDetailsArr = $this->Station->findById($id);
			if(!empty($userDetailsArr)){ //pr($productDetailsArr);die;
				
				if($this->Station->delete($id))
					$this->Session->setFlash('Station Deleted Successfully!!', 'message', array('class'=>'msg_success'));
				else
					$this->Session->setFlash('Please Try Later!!', 'message', array('class'=>'msg_error'));
			}else
				$this->Session->setFlash('No Associated Product Found!!', 'message', array('class'=>'msg_error'));
		}
		$this->redirect('/admin/admins/manage_fire_station/');
	}
	
	
		public function admin_edit_station($id){
		Controller::loadModel('Station');
		if(!empty($this->request->data)){ 
			$saveData = $this->request->data;
			if($this->Station->save($saveData)){
				$this->Session->setFlash('Station Updated Successfully!!', 'message', array('class'=>'msg_success'));
				$this->redirect('/admin/admins/manage_fire_station/');
			}else
				$this->Session->setFlash('Error! Please Correct Following Errors!', 'message', array('class'=>'msg_error'));
			/*---------- ALIAS NAME END -------------*/
		}
		$stationArr = $this->Station->findById($id);
	if(!empty($stationArr)){
			$this->data = $stationArr;
		}else
			$this->redirect('/admin/admins/manage_fire_station/');
	}
	
	public function admin_fire_preview($id){
	Controller::loadModel('Station');
	$stationArr = $this->Station->findById($id);
	if(!empty($stationArr)){
			$this->data = $stationArr;
			//$this->set('stationDetail',$this->data);
		}else
			$this->redirect('/admin/admins/manage_fire_station/');
	}
		

/*******************Fire Station function ends here*****************************/

/******************Emergencey vehicle section******************************/

  public function admin_mange_emergency_vehicles(){
	  Controller::loadModel('Vehicle');
		$cond = array();
		$this->Vehicle->bindModel(array(
			  'belongsTo' => array(
			    'Station' => array(
			      'foreignKey' => false,
			      'conditions' => array('Vehicle.station_id = Station.id'),
			      'fields'     =>array('id','name')
			    )
			  )
		));
	    $this->paginate = array('conditions'=>$cond,'limit'=>PAGINATION, 'order'=>array('Vehicle.id'=>'ASC'));

		$this->set('fireListing', $this->paginate('Vehicle'));
	}

	public function admin_add_emergency_vehicles() {
		Controller::loadModel('Vehicle');
		Controller::loadModel('Station');
		$station=$this->Station->find('all',array('fields'=>array('id','name')));

        $this->set('stationData',$station);
		if(!empty($this->request->data)){
			$saveData = $this->request->data;
			if($this->Vehicle->save($saveData)){
				$this->Session->setFlash('Vehicle Added Successfully!!', 'message', array('class'=>'alert alert success'));
				$this->redirect('/admin/admins/mange_emergency_vehicles/');
			}else
				$this->Session->setFlash('Error! Please Correct Following Errors!', 'message', array('class'=>'msg_error'));
			/*---------- ALIAS NAME END -------------*/
		}
	}


	public function admin_edit_emergency_vehicles($id){
		Controller::loadModel('Vehicle');
		Controller::loadModel('Station');
		$station=$this->Station->find('all',array('fields'=>array('id','name')));

		$this->set('stationData',$station);
		if(!empty($this->request->data)){
			$saveData = $this->request->data;
			if($this->Vehicle->save($saveData)){
				$this->Session->setFlash('Vehicle Updated Successfully!!', 'message', array('class'=>'alert alert success'));
				$this->redirect('/admin/admins/mange_emergency_vehicles/');
			}else
				$this->Session->setFlash('Error! Please Correct Following Errors!', 'message', array('class'=>'msg_error'));
			/*---------- ALIAS NAME END -------------*/
		}
		$stationArr = $this->Vehicle->findById($id);
	if(!empty($stationArr)){
			$this->data = $stationArr;
		}else
			$this->redirect('/admin/admins/mange_emergency_vehicles/');
	}


    public function admin_emergency_vehicles_preview($id){
	Controller::loadModel('Vehicle');
	$this->Vehicle->bindModel(array(
		  'belongsTo' => array(
		    'Station' => array(
		      'foreignKey' => false,
		      'conditions' => array('Vehicle.station_id = Station.id'),
		      'fields'     =>array('id','name')
		    )
		  )
	));	
	$stationArr = $this->Vehicle->findById($id);
	if(!empty($stationArr)){
			$this->data = $stationArr;
		}else
			$this->redirect('/admin/admins/mange_emergency_vehicles/');
	}
		

	public function admin_delete_emergency_vehicles($id){
		Controller::loadModel('Vehicle');
		if($id != ''){
			$userDetailsArr = $this->Vehicle->findById($id);
			if(!empty($userDetailsArr)){ //pr($productDetailsArr);die;
				
				if($this->Vehicle->delete($id))
					$this->Session->setFlash('Vehicle Deleted Successfully!!', 'message', array('class'=>'msg_success'));
				else
					$this->Session->setFlash('Please Try Later!!', 'message', array('class'=>'msg_error'));
			}else
				$this->Session->setFlash('No Associated Product Found!!', 'message', array('class'=>'msg_error'));
		}
		$this->redirect('/admin/admins/mange_emergency_vehicles/');
	}
	

/******************Emergencey vehicle section ends here***********************/


/******************Call Log  section******************************************/

  public function admin_manage_log_call(){
	  Controller::loadModel('Station');
		$cond = array();
	    $this->paginate = array('conditions'=>$cond,'limit'=>PAGINATION, 'order'=>array('Station.id'=>'ASC'));
		$this->set('fireListing', $this->paginate('Station'));
	}


/******************Call Log section ends here********************************/
	
/*--------------- SETTING SECTION START SECTION END  ---------------------------*/
  
  
  public function admin_user(){
	  Controller::loadModel('User');
		$cond = array();
		if(!empty($_GET)){
		  if(isset($_GET['name']) && $_GET['name']!=''){
			   $cond['Product.name LIKE'] = '%'.$_GET['name'].'%';
			 }	
		   if(isset($_GET['data']['category']) && $_GET['data']['category']!=''){
			  $cond['Product.category_id']= $_GET['data']['category']; 
			 }	 

		 }
	    $this->paginate = array('conditions'=>$cond,'limit'=>PAGINATION, 'order'=>array('User.id'=>'ASC'));
		$this->set('userListing', $this->paginate('User'));
	}
	
	
	
	public function admin_add_user() {
		Controller::loadModel('User');
		if(!empty($this->request->data)){
			$saveData = $this->request->data;
			if($this->request->data['User']['image']['name'] != ''){
				$imgname = $this->Sport->uploadFile($this->request->data['User']['image'], '../webroot/img/Users/'); //upload file
			}
             unset($saveData['User']['image']);
             $saveData['User']['image'] = $imgname;
             $saveData['User']['password'] = md5($this->request->data['password']);
			if($this->User->save($saveData)){
				$this->Session->setFlash('User Added Successfully!!', 'message', array('class'=>'msg_success'));
				$this->redirect('/admin/admins/user/');
			}else
				$this->Session->setFlash('Error! Please Correct Following Errors!', 'message', array('class'=>'msg_error'));
			/*---------- ALIAS NAME END -------------*/
		}
	}


    // FUNCTION FOR MANAGING THE STATUS START
	public function admin_user_status($id=NULL, $newStatus=NULL){
		Controller::loadModel('User');
		if(($id != '') && ($newStatus != '')){
			$saveData['id'] = $id;
			$saveData['status'] = $newStatus;
			if($newStatus == '1')
				$msg = 'Activated';
			else
				$msg = 'Deactivated';
			if($this->User->save($saveData, false))
				$this->Session->setFlash('User '.$msg.' Successfully!!', 'message', array('class'=>'msg_success'));
			else
				$this->Session->setFlash('Please Try Later!!', 'message', array('class'=>'msg_error'));
			$this->redirect('/admin/admins/user/');
		}else
			$this->redirect('/admin/admins/user/');
		exit;
	}
	// FUNCTION FOR MANAGING THE STATUS START
	
//FUNCTION FOR DELETING A PRODUCT START
	public function admin_delete_user($id){
		Controller::loadModel('User');
		if($id != ''){
			$userDetailsArr = $this->User->findById($id);
			if(!empty($userDetailsArr)){ //pr($productDetailsArr);die;
				// delete the physical image
				$imagePath = '../webroot/img/Users/'.$userDetailsArr['User']['image'];
				if(is_file($imagePath)){
					unlink($imagePath);
				}
				if($this->User->delete($id))
					$this->Session->setFlash('User Deleted Successfully!!', 'message', array('class'=>'msg_success'));
				else
					$this->Session->setFlash('Please Try Later!!', 'message', array('class'=>'msg_error'));
			}else
				$this->Session->setFlash('No Associated Product Found!!', 'message', array('class'=>'msg_error'));
		}
		$this->redirect('/admin/admins/user/');
	}
	
	
		public function admin_edit_user($id){
		Controller::loadModel('User');
		if(!empty($this->request->data)){ //pr($this->request->data);die;
			$saveData['id'] = $this->request->data['User']['id'];
			$saveData = $this->request->data;
			if($this->request->data['User']['image']['name'] != ''){
				$imgname = $this->Sport->uploadFile($this->request->data['User']['image'], '../webroot/img/Users/'); //upload file

				// delete the previous image
				$imagePath = '../webroot/img/Users/'.$this->request->data['User']['pre_image'];
				if(is_file($imagePath)){
					unlink($imagePath);
				}
            $saveData['User']['image'] = $imgname;
			}else{
				unset($saveData['User']['image']);
				}
			
             
			if($this->User->save($saveData)){
				$this->Session->setFlash('User Updated Successfully!!', 'message', array('class'=>'msg_success'));
				$this->redirect('/admin/admins/user/');
			}else
				$this->Session->setFlash('Error! Please Correct Following Errors!', 'message', array('class'=>'msg_error'));
			/*---------- ALIAS NAME END -------------*/
		}
		$userArr = $this->User->findById($id);
	if(!empty($userArr)){
			$this->data = $userArr;
		}else
			$this->redirect('/admin/admins/user/');
	}
	
	
	public function admin_preview($id){
	Controller::loadModel('User');
	$userArr = $this->User->findById($id);
	if(!empty($userArr)){
			$this->data = $userArr;
			$this->set('userDetail',$this->data);
		}else
			$this->redirect('/admin/admins/user/');
	}
	
	
	public function admin_mange_water_tank(){
	  Controller::loadModel('Watertank');
		$cond = array();
		if(!empty($_GET)){
		  if(isset($_GET['name']) && $_GET['name']!=''){
			   $cond['Watertank.name LIKE'] = '%'.$_GET['name'].'%';
			 }	
		   if(isset($_GET['data']['category']) && $_GET['data']['category']!=''){
			  $cond['Product.category_id']= $_GET['data']['category']; 
			 }	 

		 }
	    $this->paginate = array('conditions'=>$cond,'limit'=>PAGINATION, 'order'=>array('Watertank.id'=>'ASC'));
		$this->set('userListing', $this->paginate('Watertank'));
	}
	
	
	
	public function admin_add_water_tank() {
		Controller::loadModel('Watertank');
		if(!empty($this->request->data)){
			$saveData = $this->request->data;
			if($this->Watertank->save($saveData)){
				$this->Session->setFlash('Water Tank Added Successfully!!', 'message', array('class'=>'msg_success'));
				$this->redirect('/admin/admins/mange_water_tank/');
			}else
				$this->Session->setFlash('Error! Please Correct Following Errors!', 'message', array('class'=>'msg_error'));
			/*---------- ALIAS NAME END -------------*/
		}
	}


    // FUNCTION FOR MANAGING THE STATUS START
	public function admin_water_tank_status($id=NULL, $newStatus=NULL){
		Controller::loadModel('Watertank');
		if(($id != '') && ($newStatus != '')){
			$saveData['id'] = $id;
			$saveData['status'] = $newStatus;
			if($newStatus == '1')
				$msg = 'Activated';
			else
				$msg = 'Deactivated';
			if($this->Watertank->save($saveData, false))
				$this->Session->setFlash('Water Tank '.$msg.' Successfully!!', 'message', array('class'=>'msg_success'));
			else
				$this->Session->setFlash('Please Try Later!!', 'message', array('class'=>'msg_error'));
			$this->redirect('/admin/admins/mange_water_tank/');
		}else
			$this->redirect('/admin/admins/mange_water_tank/');
		exit;
	}
	// FUNCTION FOR MANAGING THE STATUS START
	
//FUNCTION FOR DELETING A PRODUCT START
	public function admin_delete_water_tank($id){
		Controller::loadModel('Watertank');
		if($id != ''){
			$userDetailsArr = $this->User->findById($id);
			if(!empty($userDetailsArr)){ //pr($productDetailsArr);die;
				if($this->Watertank->delete($id))
					$this->Session->setFlash('Water Tank Deleted Successfully!!', 'message', array('class'=>'msg_success'));
				else
					$this->Session->setFlash('Please Try Later!!', 'message', array('class'=>'msg_error'));
			}else
				$this->Session->setFlash('No Associated Product Found!!', 'message', array('class'=>'msg_error'));
		}
		$this->redirect('/admin/admins/mange_water_tank/');
	}
	
	
		public function admin_edit_water_tank($id){
		Controller::loadModel('Watertank');
		if(!empty($this->request->data)){ //pr($this->request->data);die;
			$saveData['id'] = $this->request->data['Watertank']['id'];
			$saveData = $this->request->data;
			if($this->Watertank->save($saveData)){
				$this->Session->setFlash('Water Tank Updated Successfully!!', 'message', array('class'=>'msg_success'));
				$this->redirect('/admin/admins/mange_water_tank/');
			}else
				$this->Session->setFlash('Error! Please Correct Following Errors!', 'message', array('class'=>'msg_error'));
			/*---------- ALIAS NAME END -------------*/
		}
		$userArr = $this->Watertank->findById($id);
	if(!empty($userArr)){
			$this->data = $userArr;
		}else
			$this->redirect('/admin/admins/mange_water_tank/');
	}
	
	
	public function admin_water_tank_preview($id){
	Controller::loadModel('Watertank');
	$userArr = $this->Watertank->findById($id);
	if(!empty($userArr)){
			$this->data = $userArr;
			$this->set('userDetail',$this->data);
		}else
			$this->redirect('/admin/admins/mange_water_tank/');
	}
  
}

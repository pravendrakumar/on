<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::import('Vendor', 'constants');
App::uses('Controller', 'Controller');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller{
	public $components = array('Auth', 'Session', 'Cookie', 'Sport', 'Email');
	public $helpers = array('Html', 'Form', 'Session', 'Sport', 'Text', 'Image', 'Fck');

	//BEFORE FILTER START
	public function beforeFilter(){
		
		if($this->request->prefix == 'admin'){ //for admin panel
			$this->layout = 'Admin/default';
			AuthComponent::$sessionKey = 'Auth.Admin';
            $this->Auth->loginAction = array('controller'=>'admins', 'action'=>'sign_in');
            $this->Auth->logoutRedirect = array('controller'=>'admins', 'action'=>'sign_in');
			$this->Auth->authenticate = array(
                'Form'=>array(
                    'userModel'=>'Admin',
                )
            );
		}else{ //for front end
			$this->layout = 'Front/default';
			$this->Auth->loginAction = array('controller'=>'users', 'action'=>'sign_in');
			$this->Auth->authenticate = array(
                'Form'=>array(
                    'userModel'=>'User',
                )
            );
		}

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PUT');
	}
	//BEFORE FILTER END

	//FUNCTION FOR VALIDATING THE PAGES FOR USER START
	public function validateUser(){
		if($this->Session->check('Auth.User.User.id'))
		$this->redirect(SITE_PATH);
	}
	//FUNCTION FOR VALIDATING THE PAGES FOR USER END

	// FUNCTION FOR VALIDATING THE USER STATUS START
	public function validateUserStatus($status){
		$ret = '';
		if(($status == '0') || ($status == '1')){
			$ret = 'valid';
		}else{
			if($status == '2')
				$ret = 'Account Deactivated By Administrator!';
			if($status == '3')
				$ret = 'Account Deleted By Administrator!';
			if($status == '4')
				$ret = 'Account Deleted By User!';
		}
		return $ret;
	}
	// FUNCTION FOR VALIDATING THE USER STATUS END

	// FUNCTION FOR WRIRING A LOG START
	public function createLog($message){
		if($message != ''){
			$writeMessage = '';
			$logsFilePath = DOCUMENT_ROOT.'app/tmp/logs/'.LOGS_FILE_NAME;

			// if file not available, then create it
			if(!is_file($logsFilePath)){
				fopen($logsFilePath, 'w');
				chmod($logsFilePath, 0777);
			}

			// write log to the file
			$writeMessage = 'Timestamp: '.date('d M, Y, h:i A');
			$writeMessage .= '; Message: '.$message;
			$writeMessage .= nl2br($writeMessage);

			// write the message to the log fle
			$fh = fopen($logsFilePath, "a");
			fwrite($fh, $writeMessage);
			fclose($fh);
		}
	}
	// FUNCTION FOR WRIRING A LOG END
}

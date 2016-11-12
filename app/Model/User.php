<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Country $Country
 * @property State $State
 * @property Suburb $Suburb
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
    public $belongsTo = array(
        'Station' => array(
            'className' => 'Station',
            'foreignKey' => 'station_id'
        )
    );

/**
 * belongsTo associations
 *
 * @var array
 */

}

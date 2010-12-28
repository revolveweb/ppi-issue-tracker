<?php
class APP_Model_Ticket_Comment extends APP_Model_Application {
	
	protected $_table = 'ticket_comment';
	protected $_primary = 'id';
	
	function __construct() {
		parent::__construct($this->_table, $this->_primary);
	}
    
    function getComments(array $p_aParams = array()) {

    	if(!isset($p_aParams['ticket_id'])) {
    		throw new PPI_Exception('Missing ticket_id');
    	}
    	$comments = $this->select()
    		->columns('c.*, u.first_name, u.last_name')
    		->from($this->_table . ' c')
    		->leftJoin('users u', 'c.user_id = u.id')
    		->where('c.ticket_id = ' . $this->quote($p_aParams['ticket_id']))
    		->order('c.created DESC')
    		->getList();
    	
		return $comments; 	
    }
	
}
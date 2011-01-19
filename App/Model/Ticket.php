<?php
class APP_Model_Ticket extends APP_Model_Application {

	protected $_table = 'ticket';
	protected $_primary = 'id';

	function __construct() {
		parent::__construct($this->_table, $this->_primary);
	}

    function getAdminAddEditFormStructure($p_sMode = 'create') {
    	$structure = array(
            'fields' => array(
                    'title'            	    => array('type' => 'text', 'label' => 'Title', 'size' => 30),
                    'category_id'           => array('type' => 'dropdown', 'label' => 'Category', 'options' => array()),
                    'ticket_type'           => array('type' => 'dropdown', 'label' => 'Type', 'options' => array()),
            	    'severity'              => array('type' => 'dropdown', 'label' => 'Severity', 'options' => array()),
                    'status'                => array('type' => 'dropdown', 'label' => 'Status', 'options' => array()),
    		    'assigned_user_id'      => array('type' => 'dropdown', 'label' => 'Assign', 'options' => array()),
                    'content'               => array('type' => 'textarea', 'label' => 'Description', 'rows' => 10, 'cols' => 40),
    		    'submit'                => array('type' => 'submit', 'label' => '', 'value' => 'Create Ticket'),
    		),
            'rules' => array(
                    'title' => array('type' => 'required', 'message' => 'Title cannot be blank'),
                    'content' => array('type' => 'required', 'message' => 'You must enter a description')

            )
    	);

    	$structure['fields']['ticket_type']['options'] = array('feature_request' => 'Feature request','bug' => 'Bug', 'enhancement' => 'Enhancement');
    	$structure['fields']['severity']['options']    = array('minor' => 'minor','major' => 'major','critical' => 'critical');
    	$structure['fields']['status']['options']      = array('open' => 'open', 'assigned' => 'assigned', 'closed' => 'closed');
    	$oUser = new APP_Model_User();
    	$users = $this->convertGetListToDropdown($oUser->getList(), array('first_name', ' ', 'last_name'));
    	$structure['fields']['assigned_user_id']['options'] = $users;
    	return $structure;
    }


    function getAddEditFormStructure($p_sMode = 'create') {
    	$structure = array(
            'fields' => array(
                    'title'            	    => array('type' => 'text', 'label' => 'Title', 'size' => 70),
                    'category_id'           => array('type' => 'dropdown', 'label' => 'Category', 'options' => array()),
                    'ticket_type'           => array('type' => 'dropdown', 'label' => 'Type', 'options' => array()),
                    'content'               => array('type' => 'textarea', 'label' => 'Description', 'rows' => 20, 'cols' => 80),
    		    'submit'                => array('type' => 'static', 'label' => '', 'value' => '<div class="" style=""><button type="submit"><span class="button green" id="create-ticket-button">Create ticket</span></button></div>')

    		),
            'rules' => array(
                    'title' => array('type' => 'required', 'message' => 'Title cannot be blank'),
                    'content' => array('type' => 'required', 'message' => 'You must enter a description')

            )
    	);

        $oTicketCat = new APP_Model_Ticket_Category();
        $structure['fields']['category_id']['options'] = $this->convertGetListToDropdown($oTicketCat->getList(), 'title');
    	$structure['fields']['ticket_type']['options'] = array('feature_request' => 'Feature request','bug' => 'Bug', 'enhancement' => 'Enhancement');
    	$oUser = new APP_Model_User();
    	$users = $this->convertGetListToDropdown($oUser->getList(), array('first_name', ' ', 'last_name'));

    	return $structure;
    }

    function getTickets(array $p_aParams = array()) {
		$tickets = $this->select()
					->columns('t.*, u.first_name user_fn, u.last_name user_ln, uu.first_name user_assigned_fn, uu.last_name user_assigned_ln')
					->from($this->getTableName() . ' t')
					->leftJoin('users u', 't.user_id=u.id')
					->leftJoin('users uu', 't.assigned_user_id=uu.id');

		if(isset($p_aParams['keyword']) && $p_aParams['keyword'] != '') {
			$sSecureSearchKeyword = $this->quote('%' . $p_aParams['keyword'] . '%');
			$aOrWhere             = array(
				't.id = '           . $sSecureSearchKeyword,
				't.title LIKE '     . $sSecureSearchKeyword,
				'ticket_type LIKE ' . $sSecureSearchKeyword,
				't.severity LIKE '  . $sSecureSearchKeyword,
				't.status LIKE '    . $sSecureSearchKeyword,
				't.status LIKE '    . $sSecureSearchKeyword,
				't.status LIKE '    . $sSecureSearchKeyword,
			);
			$tickets = $tickets->where(implode(' OR ', $aOrWhere));
		}
		$tickets = $tickets->where("status NOT IN('closed')")
			->order('created desc')
			->getList();
		return $tickets;
    }
    function getTicket(array $p_aParams = array()) {

		$tickets = $this->select()
					->columns('t.*, u.first_name user_fn, u.last_name user_ln, uu.first_name user_assigned_fn, uu.last_name user_assigned_ln')
					->from($this->getTableName() . ' t')
					->leftJoin('users u', 't.user_id=u.id')
					->leftJoin('users uu', 't.assigned_user_id=uu.id');

		if(isset($p_aParams['keyword']) && $p_aParams['keyword'] != '') {
			$sSecureSearchKeyword = $this->quote('%'.$sSearchKeyword.'%');
			$aOrWhere             = array(
				't.id = '           . $sSecureSearchKeyword,
				't.title LIKE '     . $sSecureSearchKeyword,
				'ticket_type LIKE ' . $sSecureSearchKeyword,
				't.severity LIKE '  . $sSecureSearchKeyword,
				't.status LIKE '    . $sSecureSearchKeyword,
				't.status LIKE '    . $sSecureSearchKeyword,
				't.status LIKE '    . $sSecureSearchKeyword,
			);
			$tickets = $tickets->where(implode(' OR ', $aOrWhere));
		}
		$tickets = $tickets->where("status NOT IN('closed')")
			->where('t.id = ' . $this->quote($p_aParams['id']))
			->order('created desc')
			->getList()->fetch();
		return $tickets;
    }
}

<?php
class APP_Controller_Ticket extends APP_Controller_Application {

	function __construct() {
		parent::__construct();
		
	}

	function index() {
		$this->loginCheck();
		$ticket = new APP_Model_Ticket();
		$tickets = $ticket->select()
					->columns('t.*, u.first_name user_fn, u.last_name user_ln')
					->from($ticket->getTableName() . ' t')
					->leftJoin('users u', 't.user_id=u.id')
					->order('created desc')
					->getList();
		$this->load('ticket/index', array('tickets'=>$tickets));
	}
	
	function view() {
		$iTicketID = $this->get('view', 0);
		if($iTicketID < 1) {
			throw new PPI_Exception('Invalid Ticket ID');
		}
		$oTicket = new APP_Model_Ticket();
		$aTicket = $oTicket->getTicket(array('id' => $iTicketID));
		if(count($aTicket) == 0) {
			throw new PPI_Exception('Unable to find ticket data');
		}
		$oComment  = new APP_Model_Ticket_Comment();
		$aComments = $oComment->getComments(array('ticket_id' => $aTicket['id']));

		$this->addStylesheet(array('shThemeDefault.css'));		
		$this->addJavascript(array('highlight.pack.js'));

		$this->load('ticket/view', compact('aTicket', 'aComments'));
	}

	function create() {
		$this->addEditHandler('create');
	}

	private function addEditHandler($p_sMode = 'create') {
		$this->loginCheck();
		$oTicket = new APP_Model_Ticket();
		$oForm   = new PPI_Model_Form();
		$oForm->init('ticket_create');
		$oForm->disableSubmit();
		$oForm->setFormStructure($oTicket->getAddEditFormStructure($p_sMode));
		if($oForm->isSubmitted() && $oForm->isValidated()) {
			$aSubmitValues = $oForm->getSubmitValues();
			$aSubmitValues += array(
				'status'           => 'open', 
				'severity'         => 'minor', 
				'assigned_user_id' => 0, 
				'user_id'          => $this->getAuthData(false)->id, 
				'created'          => time()
			);
			$iTicketID = $oTicket->insert($aSubmitValues);
			$this->setFlashMessage('Ticket successfully created.');
			$this->redirect('ticket/view/' . $iTicketID . '/' . str_replace(' ', '-', $aSubmitValues['title']));
		}

		$this->load('ticket/create', array(
			'formBuilder' => $oForm->getRenderInformation()
		));

	}

	function delete() {
		$this->loginCheck();
		$iTicketID = $this->_input->get('delete');
		$oTicket   = new APP_Model_Ticket();
		$oTicket->delete($iTicketID);
		$this->redirect('ticket');
	}

	function cdelete() {
		$this->loginCheck();
		$iCommentID = $this->_input->get('cdelete');
		$iTicketID  = $this->_input->get('tid');
		$oComment   = new APP_Model_Comment();
		$oTicket->delete($iTicketID);
		$this->redirect('ticket');
	}

	function ccreate() {
		$this->loginCheck();
		$oComment = new APP_Model_Ticket_Comment();
		$oComment->insert(array(
			'created'   => time(),
			'content'   => $this->post('content'),
			'ticket_id' => $this->post('ticket_id'),
			'user_id'   => $this->getAuthData(false)->id
		));
		$this->setFlashMessage('Comment created.');
		$this->redirect('ticket/view/' . $this->post('ticket_id'));
	}






}
<?php
class APP_Controller_Home extends APP_Controller_Application {

	function index() {
		$oTicket = new APP_Model_Ticket();
		$oTicketCat = new APP_Model_Ticket_Category();
		$tickets = $oTicket->getTickets();
		$cats = $oTicketCat->getList();
		$this->addStylesheet('ticket-table');
		$this->load('home/index', compact('tickets', 'cats'));
	}

	function search() {
		if( ($keyword = $this->get('keyword', '')) == '') {
			$this->redirect('');
		}
		$oTicket = new APP_Model_Ticket();
		$tickets = $oTicket->getTickets(compact('keyword'));
		$this->load('home/index', compact('tickets', 'keyword'));
	}

}

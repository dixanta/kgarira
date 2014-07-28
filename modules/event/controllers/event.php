<?php

class Event extends Public_Controller
{
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('event','event_model');
		$this->load->module_model('venue','venue_model');
		$this->load->module_model('artist','artist_model');
        $this->lang->module_load('event','event');
        $this->load->module_model('country','country_model');
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'event';
		$data['view_page'] ="event/index";
		$data['module'] = 'event';
		$this->event_model->joins=array('VENUES','EVENT_TYPES','COUNTRIES');
		$data['events'] = $this->event_model->getEvents()->result_array();		
		$data['venues'] = $this->venue_model->getVenues()->result_array();
		$this->load->view($this->_container,$data);		
	}
	
	public function details($id)
	{
		// Display Page
		$data['header'] = 'event';
		$data['view_page'] ="event/detail";
		$data['module'] = 'event';
		$this->event_model->joins=array('VENUES','EVENT_TYPES','COUNTRIES');
		$data['event'] = $this->event_model->getById($id);
		$data['events'] = $this->event_model->getEvents()->result_array();		
		$data['venues'] = $this->venue_model->getVenues()->result_array();
		$data['artists'] = $this->artist_model->getArtists()->result_array();
		$this->load->view($this->_container,$data);		
	}

}
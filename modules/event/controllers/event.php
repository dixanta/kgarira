<?php

class Event extends Public_Controller
{
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('event','event_model');
		$this->load->module_model('venue','venue_model');
		$this->load->module_model('artist','artist_model');
		$this->load->module_model('event','event_type_model');
        $this->lang->module_load('event','event');
		$this->load->module_model('gallery','gallery_model');
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'event';
		$data['view_page'] ="event/index";
		$data['module'] = 'event';
		$this->event_model->joins=array('EVENT_TYPES');
		$data['events'] = $this->event_model->getEvents(null,'event_start_date desc')->result_array();
		$data['event_types'] = $this->event_type_model->getEventTypes()->result_array();
		$this->load->view($this->_container,$data);		
	}
	
	public function detail($id)
	{
		// Display Page
		$data['header'] = 'event';
		$data['view_page'] ="event/detail";
		$data['module'] = 'event';
		$this->event_model->joins=array('VENUES','EVENT_TYPES','COUNTRIES');
		$event= $this->event_model->getById($id);
		$event_type=$event['event_type_id'];
		$data['event'] =$event;
		$this->db->where("events.event_id <> '".$event['event_id']."'");
		$data['events'] = $this->event_model->getEvents(array('events.event_type_id'=>$event_type))->result_array();	
		$data['galleries'] = $this->gallery_model->getGalleries(array('event_id'=>$event['event_id']),null,array('limit'=>3))->result_array();		
		$data['venues'] = $this->venue_model->getVenues()->result_array();
		$data['artists'] = $this->artist_model->getArtists()->result_array();
		$this->load->view($this->_container,$data);		
	}
	
	function type($id)
	{
		$data['header'] = "Events";
		$data['view_page'] = 'event/index';
		$data['events'] = $this->event_model->getEvents()->result_array();
		 $data['galleries'] = $this->gallery_model->getGalleries()->result_array();
		//$this->artist_model->joins=array('EVENT_TYPES');
		$data['event_types'] = $this->event_type_model->getEventTypes()->result_array();
		$data['events']=$this->event_model->getEvents(array('event_type_id'=>$id))->result_array();
		$this->load->view($this->_container,$data);
	}
	
}
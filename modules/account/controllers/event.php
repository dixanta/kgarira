<?php

class Event extends Member_Controller
{
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('event','event_model');
		$this->load->module_model('gallery','gallery_model');
        $this->lang->module_load('event','event');
        $this->load->module_model('country','country_model');
    }
    
	public function index()
	{
		// Display Page
		$session_id = $this->session->userdata('id');
		$data['header'] = 'event';
		$data['session_id'] = $session_id;
		$data['view_page'] ="account/event/index";
		$data['module'] = 'event';
		$this->event_model->joins=array('VENUES','EVENT_TYPES','COUNTRIES');
		$events = $this->event_model->getEvents(array('promoter_id'=>$session_id))->result_array();		
		$data['events']=$events;
		foreach($events as $event)
		{
			$data['galleries']=$this->gallery_model->getGalleries(array('event_id'=>$event['event_id']))->result_array();	
		}
		
		$this->load->view($this->_container,$data);		
	}
	
	public function details($id)
	{
		// Display Page
		//$session_id = $this->session->userdata('id');
		$data['header'] = 'event';
		$data['view_page'] ="account/event/detail";
		$data['session_id'] = $session_id;
		$data['module'] = 'event';
		$this->event_model->joins=array('VENUES','EVENT_TYPES','COUNTRIES');
		$data['event'] = $this->event_model->getById($id);
		$data['events'] = $this->event_model->getEvents()->result_array();		
		$this->load->view($this->_container,$data);		
	}
	
	public function add()
	{
		$data['header'] = 'event';
		$data['view_page'] ="account/event/add";
		$data['module'] = 'event';
		$data['countries']=$this->country_model->getCountries()->result_array();
		$this->load->view($this->_container,$data);
		
	}
	
	public function edit($id)
	{
		$data['header'] = 'event';
		$data['view_page'] ="account/event/edit";
		$data['module'] = 'event';
		$this->event_model->joins=array('VENUES','EVENT_TYPES','COUNTRIES');
		$data['event'] = $this->event_model->getById($id);
		$this->load->view($this->_container,$data);
		
	}
	
	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('event_id'))
        {
            $success=$this->event_model->insert('EVENTS',$data);
        }
        else
        {
            $success=$this->event_model->update('EVENTS',$data,array('event_id'=>$data['event_id']));
        }
        
		if($success)
		{
			$success = TRUE;
			$msg=lang('success_message'); 
		} 
		else
		{
			$success = FALSE;
			$msg=lang('failure_message');
		}
		 
		 echo json_encode(array('msg'=>$msg,'success'=>$success));		
       $this->index();
	}
	
	
	 private function _get_posted_data()
   {
   		$data=array();
        $data['event_id'] = $this->input->post('event_id');
		$data['event_name'] = $this->input->post('event_name');
		$data['event_type_id'] = $this->input->post('event_type_id');
		$data['venue_id'] = $this->input->post('venue_id');
		$data['promoter_id'] = $this->input->post('promoter_id');
		$data['country_id'] = $this->input->post('country_id');
		$data['event_start_date'] = $this->input->post('event_start_date');
		$data['allow_ticket_sell'] = $this->input->post('allow_ticket_sell');
		$data['event_description'] = $this->input->post('event_description');
		$data['event_image'] = $this->input->post('event_image');
		$data['event_end_date'] = $this->input->post('event_end_date');
		$data['no_of_tickets'] = $this->input->post('no_of_tickets');
		$data['paid_tickets'] = $this->input->post('paid_tickets');
		$data['ticket_amount'] = $this->input->post('ticket_amount');
		$data['fb_event_id'] = $this->input->post('fb_event_id');
		$data['is_fb_event'] = $this->input->post('is_fb_event');
		$data['is_guest_event'] = $this->input->post('is_guest_event');
		$data['slug_id'] = $this->input->post('slug_id');
		$data['slug_name'] = $this->input->post('slug_name');
		$data['status'] = $this->input->post('status');

        return $data;
   }

}
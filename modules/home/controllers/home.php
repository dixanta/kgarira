<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->module_model('event','event_type_model');
        $this->load->module_model('event','event_model');
		 $this->load->module_model('venue','venue_model');
        $this->load->module_model('event','gallery_model');
        $this->lang->module_load('event','event');
	}

	function index()
	{
	    $id =  $this->_get_parameter();
        $data['header'] = "Home";
        $data['events'] = $this->event_model->getEvents()->result_array();
        $data['galleries'] = $this->gallery_model->getGalleries()->result_array();
		$this->event_model->joins=array('EVENT_TYPES');
		$data['venues'] = $this->event_type_model->getEventTypes()->result_array();
		$data['view_page'] = 'home/index';
        $data['event_types'] = $this->event_type_model->getEventTypes()->result_array();
		$this->load->view($this->_container,$data);
	}
    
	function type($id)
	{
		$data['header'] = "Home";
		$data['view_page'] = 'home/index';
		$data['events'] = $this->event_model->getEvents()->result_array();
		 $data['galleries'] = $this->gallery_model->getGalleries()->result_array();
		//$this->artist_model->joins=array('EVENT_TYPES');
		$data['event_types'] = $this->event_type_model->getEventTypes()->result_array();
		$data['events']=$this->event_model->getEvents(array('event_type_id'=>$id))->result_array();
		$this->load->view($this->_container,$data);
	}
    
    function _get_parameter()
    {
        if($this->input->get('id')!=null)
        {
            return $this->input->get('id');
        }
    }
}


/* End of file welcome.php */
/* Location: ./modules/welcome/controllers/welcome.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Venue extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->module_model('venue','venue_model');
		$this->load->module_model('venue','venue_type_model');
	}

	function index()
	{

		$data['header'] = "Venue";
		$data['view_page'] = 'venue/index';
		//$data['genres']=$this->genre_model->getGenres()->result_array();
		$data['venues']=$this->venue_model->getVenues()->result_array();
		$data['venue_types']=$this->venue_type_model->getVenueTypes()->result_array();
		$this->load->view($this->_container,$data);
	}
	
	function detail($id)
	{
		$data['header'] = "Venue Detail";
		$data['view_page']='venue/detail';
		$data['venue']=$this->venue_model->getById($id);
		$this->load->view($this->_container,$data);
		
	}
	
	function type($id)
		{
			$data['header'] = "Venue";
			$data['view_page'] = 'venue/index';
			$this->venue_model->joins=array('VENUE_TYPES');
			$data['venue_types']=$this->venue_type_model->getVenueTypes()->result_array();
			$data['venues']=$this->venue_model->type($id)->result_array();
			$this->load->view($this->_container,$data);
		}

}


<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Venue extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->module_model('venue','venue_model');
		//$this->load->module_model('genre','genre_model');
	}

	function index()
	{

		$data['header'] = "Venue";
		$data['view_page'] = 'venue/index';
		//$data['genres']=$this->genre_model->getGenres()->result_array();
		$data['venues']=$this->venue_model->getVenues()->result_array();
		$this->load->view($this->_container,$data);
	}
	
	function detail($id)
	{
		$data['header'] = "Venue Detail";
		$data['view_page']='venue/detail';
		$data['venue']=$this->venue_model->getById($id);
		$this->load->view($this->_container,$data);
		
	}
}


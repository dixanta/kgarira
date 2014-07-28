<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artist extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->module_model('artist','artist_model');
		$this->load->module_model('genre','genre_model');
	}

	function index()
	{
		$data['header'] = "Artist";
		$data['view_page'] = 'artist/index';
		$this->artist_model->joins=array('GENRES');
		$data['genres']=$this->genre_model->getGenres()->result_array();
		$data['ars']=$this->artist_model->getArtists()->result_array();
		$this->load->view($this->_container,$data);
	}
	
	function detail($id)
	{
		$data['header'] = "Artist Detail";
		$data['view_page']='artist/detail';
		$this->artist_model->joins=array('GENRES');
		$data['artist']=$this->artist_model->getById($id);
		$this->load->view($this->_container,$data);
		
	}
	
	function genre($id)
	{
		$data['header'] = "Artist";
		$data['view_page'] = 'artist/index';
		$this->artist_model->joins=array('GENRES');
		$data['genres']=$this->genre_model->getGenres()->result_array();
		$data['ars']=$this->artist_model->genre($id)->result_array();
		$this->load->view($this->_container,$data);
	}
	
	function upComingEvent()
	{
		
	}
	
	
}


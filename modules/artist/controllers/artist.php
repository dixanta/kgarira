<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artist extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->module_model('artist','artist_model');
		$this->load->module_model('genre','genre_model');
		$this->load->module_model('event_artist','event_artist_model');
		$this->load->module_model('event','event_model');
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
		$events = $this->event_artist_model->getEventArtists(array('artist_id'=>$id))->result_array();
		//echo $this->db->last_query(); 
		if($events!=null){
		foreach($events as $event){
			//echo "<pre>"; print_r($e_id['event_id']); exit;
			$where = array('event_id'=>$event['event_id']);
			$data['events'] = $this->event_model->getEvents($where)->result_array();
			//echo "<pre>"; print_r($data['events']); exit;
			//=$this->getEvent($date['event_start_date']);
		}
		}
		else
		{
			$data['events']=0;
		}
		$data['artist']=$this->artist_model->getById($id);
		$this->load->view($this->_container,$data);
		
	}
	
	public function getEvent($date)
	{
		return $this->event_model->getEvents(array($date>date('Y-m-d H:i:s')))->result_array();
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
	
	
}


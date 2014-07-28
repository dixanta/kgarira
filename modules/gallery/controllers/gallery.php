<?php

class Gallery extends Public_Controller
{
	var $gallerypath='uploads/gallery/';
	public function __construct(){
    	parent::__construct();
		$this->load->module_model('gallery','gallery_model');
        $this->lang->module_load('gallery','gallery');
		$this->load->module_model('event','event_model');
		$this->load->module_model('gallery','gallery_image_model');
		$this->bep_assets->load_asset_group('UPLOADER');
		$this->load->library('image_lib');
		$this->load->helper('date');
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'gallery';
		$data['view_page'] = "gallery/index";
		$data['module'] = 'event';
		//$this->gallery_model->joins=array('EVENTS');
		$data['gallery'] = $this->gallery_model->getGalleries()->result_array();
		$data['events'] = $this->event_model->getEvents()->result_array();	
		$this->load->view($this->_container,$data);		
	}
	
	public function details($id)
	{
		// Details Page
		$data['header'] = 'gallery';
		$data['view_page'] = "gallery/detail";
		$data['module'] = 'gallery';		
		$this->gallery_model->joins=array('GALLERY_IMAGE');
		$data['gallery'] = $this->gallery_model->getById($id);
		$where = array('gal.gallery_id'=>$id);
		$data['gallery_image'] = $this->gallery_image_model->getGalleryImages($where)->result_array();
//		echo "<pre>"; print_r($data['gallery_image']); exit;
		$this->load->view($this->_container,$data);		
	}


}
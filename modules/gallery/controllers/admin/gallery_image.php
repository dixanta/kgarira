<?php

class Gallery_image extends Admin_Controller
{
	protected $uploadPath = 'uploads/gallery_image';
protected $uploadthumbpath= 'uploads/gallery_image/thumb/';

	public function __construct(){
    	parent::__construct();
        $this->load->module_model('gallery_image','gallery_image_model');
        $this->lang->module_load('gallery_image','gallery_image');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'gallery_image';
		$data['page'] = $this->config->item('template_admin') . "gallery_image/index";
		$data['module'] = 'gallery_image';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->gallery_image_model->count();
		paging('gallery_image_id');
		$this->_get_search_param();	
		$rows=$this->gallery_image_model->getGalleryImages()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['gallery_id']!='')?$this->db->where('gallery_id',$params['search']['gallery_id']):'';

		}  

		
		if(!empty($params['date']))
		{
			foreach($params['date'] as $key=>$value){
				$this->_datewise($key,$value['from'],$value['to']);	
			}
		}
		               
        
	}

		
    
	public function combo_json()
    {
		$rows=$this->gallery_image_model->getGalleryImages()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->gallery_image_model->delete('GALLERY_IMAGE',array('gallery_image_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('gallery_image_id'))
        {
            $success=$this->gallery_image_model->insert('GALLERY_IMAGE',$data);
        }
        else
        {
            $success=$this->gallery_image_model->update('GALLERY_IMAGE',$data,array('gallery_image_id'=>$data['gallery_image_id']));
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
        
	}
   
   private function _get_posted_data()
   {
   		$data=array();
        $data['gallery_image_id'] = $this->input->post('gallery_image_id');
$data['gallery_image'] = $this->input->post('gallery_image');
$data['gallery_id'] = $this->input->post('gallery_id');
$data['added_on'] = $this->input->post('added_on');

        return $data;
   }
   
      function upload_image(){
		//Image Upload Config
		$config['upload_path'] = $this->uploadPath;
		$config['allowed_types'] = 'gif|png|jpg';
		$config['max_size']	= '10240';
		$config['remove_spaces']  = true;
		//load upload library
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload())
		{
			$data['error'] = $this->upload->display_errors('','');
			echo json_encode($data);
		}
		else
		{
		  $data = $this->upload->data();
 		  $config['image_library'] = 'gd2';
		  $config['source_image'] = $data['full_path'];
          $config['new_image']    = $this->uploadthumbpath;
		  //$config['create_thumb'] = TRUE;
		  $config['maintain_ratio'] = TRUE;
		  $config['height'] =100;
		  $config['width'] = 100;

		  $this->load->library('image_lib', $config);
		  $this->image_lib->resize();
		  echo json_encode($data);
	    }
	}
	
	function upload_delete(){
		//get filename
		$filename = $this->input->post('filename');
		@unlink($this->uploadPath . '/' . $filename);
	} 	
	    
}
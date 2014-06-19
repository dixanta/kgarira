<?php

class Artist extends Admin_Controller
{
	protected $uploadPath = 'uploads/artist';
protected $uploadthumbpath= 'uploads/artist/thumb/';

	public function __construct(){
    	parent::__construct();
        $this->load->module_model('artist','artist_model');
        $this->lang->module_load('artist','artist');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'artist';
		$data['page'] = $this->config->item('template_admin') . "artist/index";
		$data['module'] = 'artist';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->artist_model->count();
		paging('artist_id');
		$this->_get_search_param();	
		$rows=$this->artist_model->getArtists()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['artist_name']!='')?$this->db->like('artist_name',$params['search']['artist_name']):'';
($params['search']['contact_number']!='')?$this->db->where('contact_number',$params['search']['contact_number']):'';
($params['search']['genre_id']!='')?$this->db->where('genre_id',$params['search']['genre_id']):'';
(isset($params['search']['status']))?$this->db->where('status',$params['search']['status']):'';

		}  

		
		if(!empty($params['date']))
		{
			foreach($params['date'] as $key=>$value){
				$this->_datewise($key,$value['from'],$value['to']);	
			}
		}
		               
        
	}

	
	private function _datewise($field,$from,$to)
	{
			if(!empty($from) && !empty($to))
			{
				$this->db->where("(date_format(".$field.",'%Y-%m-%d') between '".date('Y-m-d',strtotime($from)).
						"' and '".date('Y-m-d',strtotime($to))."')");
			}
			else if(!empty($from))
			{
				$this->db->like($field,date('Y-m-d',strtotime($from)));				
			}		
	}	
    
	public function combo_json()
    {
		$rows=$this->artist_model->getArtists()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->artist_model->delete('ARTISTS',array('artist_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('artist_id'))
        {
			$data['created_date']=date('Y-m-d H:i:s');
            $success=$this->artist_model->insert('ARTISTS',$data);
        }
        else
        {
            $success=$this->artist_model->update('ARTISTS',$data,array('artist_id'=>$data['artist_id']));
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
        $data['artist_id'] = $this->input->post('artist_id');
$data['artist_name'] = $this->input->post('artist_name');
$data['artist_description'] = $this->input->post('artist_description');
$data['artist_image'] = $this->input->post('artist_image');
$data['contact_number'] = $this->input->post('contact_number');
$data['created_date'] = $this->input->post('created_date');
$data['genre_id'] = $this->input->post('genre_id');
$data['status'] = $this->input->post('status');

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
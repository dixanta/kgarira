<?php

class Gallery extends Admin_Controller
{
	var $gallerypath='uploads/gallery/';
	public function __construct(){
    	parent::__construct();
		$this->load->module_model('event','gallery_model');
        $this->lang->module_load('event','gallery');
		$this->load->module_model('event','event_model');
		$this->load->module_model('event','gallery_image_model');
		$this->bep_assets->load_asset_group('UPLOADER');
		$this->load->library('image_lib');
		$this->load->helper('date');
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'gallery';
		$data['page'] = $this->config->item('template_admin') . "gallery/index";
		$data['module'] = 'event';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->gallery_model->countGalleries();
		paging('gallery_id desc');
		$this->_get_search_param();	
		$rows=$this->gallery_model->getGalleries()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		$data=$this->input->post('data');
		if($data)
		{
			parse_str($data,$param);
			foreach($param['search'] as $key=>$value):
				$this->db->like($key,$value);	
			endforeach;
		}	
	}
    
	public function delete_json()
	{
		if($this->input->post('id'))
		{
			$this->gallery_model->delete('GALLERY',array('gallery_id'=>$this->input->post('id')));
		}
	}    

	public function form_json()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('gallery_id'))
        {
			$data['created_on'] = date('Y-m-d H:i:s');
            $success=$this->gallery_model->insert('GALLERY',$data);
        }
        else
        {
            $success=$this->gallery_model->update('GALLERY',$data,array('gallery_id'=>$data['gallery_id']));
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
        $data['gallery_id'] = $this->input->post('gallery_id');
		$data['event_id'] = $this->input->post('event_id');
		$data['gallery_title'] = $this->input->post('gallery_title');
		//$data['created_on'] = $this->input->post('created_on');
		$data['gallery_image_id'] = $this->input->post('gallery_image_id');
		$data['country_code'] = $this->input->post('country_code');
		$data['active'] = $this->input->post('active');

        return $data;
   }
   
   public function upload()
   {
	  	//Image Upload Config
		$event_id=$this->input->post('event_id');
		if(!$event_id)
		{
			return FALSE;
		}
		$gallery=$this->gallery_model->getGalleries(array('event_id'=>$event_id))->row_array();
		$gallery_id=0;
		if(!$gallery)
		{
			$event=$this->event_model->getEvents(array('event_id'=>$event_id))->row_array();
			$insert_data=array('gallery_title'=>$event['event_name'],'image_name'=>$event['event_image'],'event_id'=>$event_id,
							   'country_code'=>$event['country_id'],'active'=>'1','created_on'=> date('Y-m-d H:i:s'));
            $this->gallery_model->insert('GALLERY',$insert_data);
			$gallery_id=$this->db->insert_id();				   
		}
		else
		{
			$gallery_id=$gallery['gallery_id'];		
		}

		
		$uploadpath=$this->gallerypath.$gallery_id;
		@mkdir($uploadpath);
		$config['upload_path'] = $uploadpath;
		$config['allowed_types'] = 'jpeg|jpg|png|gif';
		$config['max_size'] = '10240';
		$config['remove_spaces'] = true;
        //load upload library
		$this->load->library('upload', $config);
		if($this->upload->do_upload('file'))
		{
			$data=$this->upload->data();
			//$this->_create_thumb($uploadpath,$data['full_path']);
			$this->_resize_image($data['full_path']);
			$this->_create_thumb($uploadpath,$data['full_path']);
			
			$file_data=array('gallery_image'=>$data['file_name'],
							 'gallery_id'=>$gallery_id,
							 'added_on'=>date('Y-m-d H:i:s',now()));
			
			$this->gallery_image_model->insert('GalleryImage',$file_data);
			//print_r($data);
		}
	  	
   }
   
   private function _create_thumb($path,$file)
   {
	   $thumbpath=$path.'/thumbs/';
	  @mkdir($thumbpath);
	  $config['image_library'] = 'gd2';
	  $config['source_image'] = $file;
	  $config['new_image']    = $thumbpath;
	  $config['create_thumb'] = TRUE;
	  $config['maintain_ratio'] = TRUE;
	  $config['height'] =120;
	  $config['width'] = 183;
	  $config['quality'] = 100;
	  $this->image_lib->initialize($config);
	  $this->image_lib->resize();	   
   }
   
   private function _resize_image($file)
   {
	  $config['image_library'] = 'gd2';
	  $config['source_image'] = $file;
	  $config['maintain_ratio'] = TRUE;
          list($width,$height)=getimagesize($file);
	  //$config['height'] =480;
	  $config['width'] = 600;
          $new_height = floor( $height * ( $config['width'] / $width ) );
          $config['height']=$new_height;
	  $config['quality'] = 100;
	  //$this->load->library('image_lib', $config);
	  $this->image_lib->initialize($config);
	  $this->image_lib->resize();		   
   }
   
   public function makecover()
   {
	   $gallery_id=$this->input->post('gallery_id');
	   $gallery_image_id=$this->input->post('image_id');	
	   $success=FALSE;  
	   $msg='';
	   if($gallery_id && $gallery_image_id)
	   {
		   $this->gallery_model->update('GALLERY',array('gallery_image_id'=>$gallery_image_id),array('gallery_id'=>$gallery_id));
		  $success=TRUE;
		  $msg='Cover Updated Successfully';
	   }
	    echo json_encode(array('msg'=>$msg,'success'=>$success));	
	   
   }

	public function facebook_fanpage_upload()
	{
		$this->load->library('curl');
		$this->curl->initialize();
		$gallery_id=$this->input->post('gallery_id');
		if($this->facebookUser && $gallery_id):
			$gallery=$this->model_gallery_model->getGalleries(array('gallery_id'=>$gallery_id),NULL);
			$gallery=$gallery->row_array();
			$images=$this->model_gallery_model->getGalleryImages($gallery_id);
			$link=site_url('models/view/'.$gallery['gallery_id'].'-'.make_seo_url($gallery['gallery_name']).'?type=models');	
			
		//$link=site_url('models/view/'.$gallery['gallery_id'].'-'.make_seo_url($gallery['gallery_name']));	
		$album_details = array(
				'message'=> $link,
				'name'=> $gallery['gallery_name'],
				
		);

		$fan_page_id=$this->preference->item('facebook_fan_page_id');
		
		$access_url = 'https://graph.facebook.com/'.$fan_page_id.'/albums?access_token=AAACWsPZCPj10BACVEAFtN2hoRhDt0y7xZCvREo435L3e5CX6xhXPIoIE7knztSIfCKihEpIDVE0EMEmaCTLOf6PlL11a5QmV3no8WfjNb5h88T2rQt';
		
		$data=$this->curl->PostURL($access_url,$album_details);  
		$album=json_decode($data);

		if($data):
			$i=1;
			foreach($images->result_array() as $row):
				if($i>5)
				{
					break;
				}
				$access_url='https://graph.facebook.com/'.$album->id.'/photos?access_token=AAAEXhlyOZBzABAKhH04nSZBg1KmIdsmGZCZCAUW6iO8ZCwZBJafB42FjEGyneHau4QCENN0zpQ2z15qJfhLeT36rcgolX2NBZBa0LtsGcNz8TfqUHrZAkptL';
				$args=array('message'=>$link);
				$file='assets/images/models/'.$gallery['model_id'].'/'.$row['image_name'];
		
				$args = array(
				   'message' => 'For More Hot And Sexy Models Please visit '.$link,
				);
				$args[basename($file)] = '@' . realpath($file);
				$data=$this->curl->PostURL($access_url,$args); 		
				//print_r($data);
			$i++;
			endforeach;
			echo 'finish';	
		endif;
		endif;	
	}	

	public function gallery_image($event_id)
	{
		$gallery=$this->gallery_image_model->getGalleryImages(array('event_id'=>$event_id))->row_array();
		if($gallery)
		{
			$data['images']=$this->gallery_image_model->getgalleryImage(array('gallery_id'=>$gallery['gallery_id']));
			$page = $this->config->item('template_admin') . "gallery/gallery_image";
			$data['module'] = 'event';
			$data['gallery_id']=$gallery['gallery_id'];
                        $data['event_id']=$gallery['event_id'];
			echo $this->load->view($page,$data,TRUE);					
		}
		else
		{
			echo 'No Images found';
		}
	}	

	public function delete_images()
	{
		$images=$this->input->post('image_id');
		$gallery_id=$this->input->post('gallery_id');
		if($images && is_array($images))
		{
			foreach($images as $image_id)
			{
				$image_info=$this->gallery_image_model->getgalleryImage(array('gallery_image_id'=>$image_id))->row_array();
				@unlink('uploads/gallery/'.$gallery_id .'/'.$image_info['gallery_image']);
				@unlink('uploads/gallery/'.$gallery_id .'/thumbs/'.$image_info['gallery_image']);				
				$this->gallery_image_model->delete('GalleryImage',array('gallery_image_id'=>$image_id));
			}
		}
	}

	public function combogrid_json()
	{
		//$this->_get_search_param();	
		$q=$this->input->post('q');
		if($q)
		{
			$this->db->like('gallery_id',$q);

			$this->db->or_like('gallery_title',$q);
		}
		$total=$this->gallery_model->countGalleries();
		paging('gallery_id');
		//$this->_get_search_param();	
		if($q)
		{
			$this->db->like('gallery_id',$q);

			$this->db->or_like('gallery_title',$q);
		}
		//$this->db->select('venue_id,venue_name');
		$this->gallery_model->_FIELDS='gallery_id,gallery_title';
		$rows=$this->gallery_model->getGalleries()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));		
	}
	
/*	public function update_date()
	{
		$sql="update be_gallery set created_on='".date('Y-m-d H:i:s')."' where gallery_id in (739,740,741,742)";
		$this->db->query($sql);
		
	}
*/
}
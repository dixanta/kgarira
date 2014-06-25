<?php

class Event extends Admin_Controller
{
	protected $uploadPath = 'uploads/event';
protected $uploadthumbpath= 'uploads/event/thumb/';

	public function __construct(){
    	parent::__construct();
        $this->load->module_model('event','event_model');
        $this->lang->module_load('event','event');
        $this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
		$this->bep_assets->load_asset('tinymce');
		$this->bep_assets->load_asset('jquery.upload');	
		$this->bep_assets->load_asset_group('UPLOADER');
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'event';
		$data['page'] = $this->config->item('template_admin') . "event/index";
		$data['module'] = 'event';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		//$this->_get_search_param();
		$this->event_model->joins=array('VENUES','EVENT_TYPES','COUNTRIES');
		$total=$this->event_model->count();
		paging('event_id');
		$this->_get_search_param();	
		$rows=$this->event_model->getEvents()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['event_name']!='')?$this->db->like('event_name',$params['search']['event_name']):'';
			($params['search']['event_type_id']!='')?$this->db->where('events.event_type_id',$params['search']['event_type_id']):'';
			($params['search']['venue_id']!='')?$this->db->where('venues.venue_id',$params['search']['venue_id']):'';
			($params['search']['promoter_id']!='')?$this->db->where('promoter_id',$params['search']['promoter_id']):'';
			($params['search']['country_id']!='')?$this->db->like('countries.country_id',$params['search']['country_id']):'';
			(isset($params['search']['allow_ticket_sell']))?$this->db->where('allow_ticket_sell',$params['search'][						'allow_ticket_sell']):'';
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
		$rows=$this->event_model->getEvents()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function form_json()
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
        
	}
	
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->event_model->delete('EVENTS',array('event_id'=>$row));
            endforeach;
		}
	}    

	
	public function save_notify()
	{
		$this->save();		
        //email section
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
		@unlink($this->uploadthumbpath . '/' . $filename);
	} 	
	    
}
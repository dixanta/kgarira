<?php

class Ticket extends Admin_Controller
{
	protected $uploadPath = 'uploads/ticket';
protected $uploadthumbpath= 'uploads/ticket/thumb/';

	public function __construct(){
    	parent::__construct();
        $this->load->module_model('ticket','ticket_model');
        $this->lang->module_load('ticket','ticket');
        $this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'ticket';
		$data['page'] = $this->config->item('template_admin') . "ticket/index";
		$data['module'] = 'ticket';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$this->ticket_model->joins=array('EVENTS');
		$total=$this->ticket_model->count();
		paging('ticket_id');
		$this->_get_search_param();	
		$rows=$this->ticket_model->getTickets()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['ticket_number']!='')?$this->db->where('ticket_number',$params['search']['ticket_number']):'';
($params['search']['event_id']!='')?$this->db->where('event_id',$params['search']['event_id']):'';

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
		$rows=$this->ticket_model->getTickets()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->ticket_model->delete('TICKETS',array('ticket_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('ticket_id'))
        {
			$data['created_date']=date('Y-m-d H:i:s');
            $success=$this->ticket_model->insert('TICKETS',$data);
        }
        else
        {
            $success=$this->ticket_model->update('TICKETS',$data,array('ticket_id'=>$data['ticket_id']));
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
        $data['ticket_id'] = $this->input->post('ticket_id');
$data['ticket_image'] = $this->input->post('ticket_image');
$data['ticket_number'] = $this->input->post('ticket_number');
$data['event_id'] = $this->input->post('event_id');
$data['created_date'] = $this->input->post('created_date');

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
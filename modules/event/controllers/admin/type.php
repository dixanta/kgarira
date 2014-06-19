<?php

class Type extends Admin_Controller
{
	
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('event','event_type_model');
        $this->lang->module_load('event','event_type');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'event_type';
		$data['page'] = $this->config->item('template_admin') . "type/index";
		$data['module'] = 'event';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->event_type_model->count();
		paging('event_type_id');
		$this->_get_search_param();	
		$rows=$this->event_type_model->getEventTypes()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['event_type']!='')?$this->db->like('event_type',$params['search']['event_type']):'';

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
		$rows=$this->event_type_model->getEventTypes()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->event_type_model->delete('EVENT_TYPES',array('event_type_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('event_type_id'))
        {
            $data['created_date'] = date("Y-m-d H:i:s");
            $success=$this->event_type_model->insert('EVENT_TYPES',$data);
        }
        else
        {
            $success=$this->event_type_model->update('EVENT_TYPES',$data,array('event_type_id'=>$data['event_type_id']));
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
        $data['event_type_id'] = $this->input->post('event_type_id');
$data['event_type'] = $this->input->post('event_type');

        return $data;
   }
   
   	
	    
}
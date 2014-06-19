<?php

class Type extends Admin_Controller
{
	
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('venue','venue_type_model');
        $this->lang->module_load('venue','venue_type');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'venue_type';
		$data['page'] = $this->config->item('template_admin') . "venue_type/index";
		$data['module'] = 'venue';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->venue_type_model->count();
		paging('venue_type_id');
		$this->_get_search_param();	
		$rows=$this->venue_type_model->getVenueTypes()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['venue_type']!='')?$this->db->like('venue_type',$params['search']['venue_type']):'';

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
		$rows=$this->venue_type_model->getVenueTypes()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->venue_type_model->delete('VENUE_TYPES',array('venue_type_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('venue_type_id'))
        {
            $success=$this->venue_type_model->insert('VENUE_TYPES',$data);
        }
        else
        {
            $success=$this->venue_type_model->update('VENUE_TYPES',$data,array('venue_type_id'=>$data['venue_type_id']));
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
   
   public function save_notify()
    {
     $this->save();
     //email code
    }
   private function _get_posted_data()
   {
   		$data=array();
        $data['venue_type_id'] = $this->input->post('venue_type_id');
$data['venue_type'] = $this->input->post('venue_type');

        return $data;
   }
   
   	
	    
}
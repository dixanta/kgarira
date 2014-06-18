<?php

class Test extends Admin_Controller
{
	
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('test','test_model');
        $this->lang->module_load('test','test');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'test';
		$data['page'] = $this->config->item('template_admin') . "test/index";
		$data['module'] = 'test';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->test_model->count();
		paging('test_id');
		$this->_get_search_param();	
		$rows=$this->test_model->getTests()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['test_name']!='')?$this->db->like('test_name',$params['search']['test_name']):'';
(isset($params['search']['status']))?$this->db->where('status',$params['search']['status']):'';

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
		$rows=$this->test_model->getTests()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->test_model->delete('TEST',array('test_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('test_id'))
        {
            $success=$this->test_model->insert('TEST',$data);
        }
        else
        {
            $success=$this->test_model->update('TEST',$data,array('test_id'=>$data['test_id']));
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
        $data['test_id'] = $this->input->post('test_id');
$data['test_name'] = $this->input->post('test_name');
$data['test_description'] = $this->input->post('test_description');
$data['status'] = $this->input->post('status');

        return $data;
   }
   
   	
	    
}
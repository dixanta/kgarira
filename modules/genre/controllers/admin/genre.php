<?php

class Genre extends Admin_Controller
{
	
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('genre','genre_model');
        $this->lang->module_load('genre','genre');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'genre';
		$data['page'] = $this->config->item('template_admin') . "genre/index";
		$data['module'] = 'genre';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->genre_model->count();
		paging('genre_id');
		$this->_get_search_param();	
		$rows=$this->genre_model->getGenres()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['genre_name']!='')?$this->db->like('genre_name',$params['search']['genre_name']):'';

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
		$rows=$this->genre_model->getGenres()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->genre_model->delete('GENRES',array('genre_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('genre_id'))
        {
			$data['created_date']= date('Y-m-d H:i:s');
            $success=$this->genre_model->insert('GENRES',$data);
        }
        else
        {
            $success=$this->genre_model->update('GENRES',$data,array('genre_id'=>$data['genre_id']));
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
        $data['genre_id'] = $this->input->post('genre_id');
$data['genre_name'] = $this->input->post('genre_name');
$data['created_date'] = $this->input->post('created_date');

        return $data;
   }
   
   	
	    
}
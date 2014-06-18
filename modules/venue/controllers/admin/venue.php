<?php

class Venue extends Admin_Controller
{
	
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('venue','venue_model');
        $this->lang->module_load('venue','venue');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'venue';
		$data['page'] = $this->config->item('template_admin') . "venue/index";
		$data['module'] = 'venue';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
		$total=$this->venue_model->count();
		paging('venue_id');
		$this->_get_search_param();	
		$rows=$this->venue_model->getVenues()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['venue_name']!='')?$this->db->like('venue_name',$params['search']['venue_name']):'';
($params['search']['venue_type_id']!='')?$this->db->where('venue_type_id',$params['search']['venue_type_id']):'';
($params['search']['venue_location']!='')?$this->db->like('venue_location',$params['search']['venue_location']):'';
($params['search']['venue_city']!='')?$this->db->like('venue_city',$params['search']['venue_city']):'';
($params['search']['cusine']!='')?$this->db->like('cusine',$params['search']['cusine']):'';
($params['search']['food_price_range']!='')?$this->db->like('food_price_range',$params['search']['food_price_range']):'';
($params['search']['drink_price_range']!='')?$this->db->like('drink_price_range',$params['search']['drink_price_range']):'';
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
		$rows=$this->venue_model->getVenues()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->venue_model->delete('VENUES',array('venue_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('venue_id'))
        {
            $data['created_date'] = date('Y-m-d H:i:s');
            $success=$this->venue_model->insert('VENUES',$data);
        }
        else
        {
            $success=$this->venue_model->update('VENUES',$data,array('venue_id'=>$data['venue_id']));
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
        $data['venue_id'] = $this->input->post('venue_id');
$data['venue_name'] = $this->input->post('venue_name');
$data['venue_type_id'] = $this->input->post('venue_type_id');
$data['venue_location'] = $this->input->post('venue_location');
$data['venue_city'] = $this->input->post('venue_city');
$data['venue_description'] = $this->input->post('venue_description');
$data['venue_longitude'] = $this->input->post('venue_longitude');
$data['venue_latitude'] = $this->input->post('venue_latitude');
$data['cusine'] = $this->input->post('cusine');
$data['venue_drink'] = $this->input->post('venue_drink');
$data['venue_food'] = $this->input->post('venue_food');
$data['food_price_range'] = $this->input->post('food_price_range');
$data['drink_price_range'] = $this->input->post('drink_price_range');
$data['created_date'] = $this->input->post('created_date');
$data['status'] = $this->input->post('status');

        return $data;
   }
   
   	
	    
}
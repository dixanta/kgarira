<?php

class Event_artist extends Admin_Controller
{
	
	public function __construct(){
    	parent::__construct();
        $this->load->module_model('event_artist','event_artist_model');
        $this->lang->module_load('event_artist','event_artist');
        //$this->bep_assets->load_asset('jquery.upload'); // uncomment if image ajax upload
    }
    
	public function index()
	{
		// Display Page
		$data['header'] = 'event_artist';
		$data['page'] = $this->config->item('template_admin') . "event_artist/index";
		$data['module'] = 'event_artist';
		$this->load->view($this->_container,$data);		
	}

	public function json()
	{
		$this->_get_search_param();	
        $this->event_artist_model->joins=array('ARTISTS','EVENTS');
		$total=$this->event_artist_model->count();
		paging('event_artist_id');
		$this->_get_search_param();	
		$rows=$this->event_artist_model->getEventArtists()->result_array();
		echo json_encode(array('total'=>$total,'rows'=>$rows));
	}
	
	public function _get_search_param()
	{
		// Search Param Goes Here
		parse_str($this->input->post('data'),$params);
		if(!empty($params['search']))
		{
			($params['search']['artist_id']!='')?$this->db->where('artists.artist_id',$params['search']['artist_id']):'';
($params['search']['event_id']!='')?$this->db->where('events.event_id',$params['search']['event_id']):'';

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
		$rows=$this->event_artist_model->getEventArtists()->result_array();
		echo json_encode($rows);    	
    }    
    
	public function delete_json()
	{
    	$id=$this->input->post('id');
		if($id && is_array($id))
		{
        	foreach($id as $row):
				$this->event_artist_model->delete('EVENT_ARTISTS',array('event_artist_id'=>$row));
            endforeach;
		}
	}    

	public function save()
	{
		
        $data=$this->_get_posted_data(); //Retrive Posted Data		

        if(!$this->input->post('event_artist_id'))
        {
            $data['created_date'] = date('Y-m-d H:i:s');
            $success=$this->event_artist_model->insert('EVENT_ARTISTS',$data);
        }
        else
        {
            $success=$this->event_artist_model->update('EVENT_ARTISTS',$data,array('event_artist_id'=>$data['event_artist_id']));
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
        $data['event_artist_id'] = $this->input->post('event_artist_id');
$data['artist_id'] = $this->input->post('artist_id');
$data['event_id'] = $this->input->post('event_id');
$data['created_date'] = $this->input->post('created_date');

        return $data;
   }
   
   	
	    
}
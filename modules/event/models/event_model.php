<?php
class Event_model extends MY_Model
{
	var $joins=array();
    public function __construct()
    {
    	parent::__construct();
        $this->prefix='tbl_';
        $this->_TABLES=array('EVENTS'=>$this->prefix.'events','EVENT_TYPES'=>$this->prefix.'event_types',
							 'VENUES'=>$this->prefix.'venues','COUNTRIES'=>$this->prefix.'countries' );
		
		$this->_JOINS=array('VENUES'=>array('join_type'=>'LEFT','join_field'=>'venues.venue_id=events.venue_id',
                                           'select'=>'venues.venue_name','alias'=>'venues'),
							'EVENT_TYPES'=>array('join_type'=>'LEFT','join_field'=>'event_types.event_type_id=events.event_type_id',
                                           'select'=>'event_type','alias'=>'event_types'),
										   
							'COUNTRIES'=>array('join_type'=>'LEFT','join_field'=>'countries.country_id=events.country_id',
                                           'select'=>'country_name','alias'=>'countries'),
                           
                            );
        
    }
    
    public function getEvents($where=NULL,$order_by=NULL,$limit=array('limit'=>NULL,'offset'=>''))
    {
       $fields='events.*';
       
		foreach($this->joins as $key):
			$fields=$fields . ','.$this->_JOINS[$key]['select'];
		endforeach;
                
        $this->db->select($fields);
        $this->db->from($this->_TABLES['EVENTS']. ' events');
		
		foreach($this->joins as $key):
                    $this->db->join($this->_TABLES[$key]. ' ' .$this->_JOINS[$key]['alias'],$this->_JOINS[$key]['join_field'],$this->_JOINS[$key]['join_type']);
		endforeach;	        
        
		(! is_null($where))?$this->db->where($where):NULL;
		(! is_null($order_by))?$this->db->order_by($order_by):NULL;

		if( ! is_null($limit['limit']))
		{
			$this->db->limit($limit['limit'],( isset($limit['offset'])?$limit['offset']:''));
		}
		return $this->db->get();	    
    }
    
    public function count($where=NULL)
    {
		
        $this->db->from($this->_TABLES['EVENTS'].' events');
        
        foreach($this->joins as $key):
        $this->db->join($this->_TABLES[$key]. ' ' .$this->_JOINS[$key]['alias'],$this->_JOINS[$key]['join_field'],$this->_JOINS[$key]['join_type']);
        endforeach;        
       
       (! is_null($where))?$this->db->where($where):NULL;
		
        return $this->db->count_all_results();
    }
	
	public function getById($id)
	{
		return $this->getEvents(array('event_id'=>$id))->row_array();
	}
}
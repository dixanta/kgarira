<?php
class Event_type_model extends MY_Model
{
	var $joins=array();
    public function __construct()
    {
    	parent::__construct();
        $this->prefix='tbl_';
        $this->_TABLES=array('EVENT_TYPES'=>$this->prefix.'event_types');
		$this->_JOINS=array('KEY'=>array('join_type'=>'LEFT','join_field'=>'join1.id=join2.id',
                                           'select'=>'field_names','alias'=>'alias_name'),
                           
                            );        
    }
    
    public function getEventTypes($where=NULL,$order_by=NULL,$limit=array('limit'=>NULL,'offset'=>''))
    {
       $fields='event_types.*';
       
		foreach($this->joins as $key):
			$fields=$fields . ','.$this->_JOINS[$key]['select'];
		endforeach;
                
        $this->db->select($fields);
        $this->db->from($this->_TABLES['EVENT_TYPES']. ' event_types');
		
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
		
        $this->db->from($this->_TABLES['EVENT_TYPES'].' event_types');
        
        foreach($this->joins as $key):
        $this->db->join($this->_TABLES[$key]. ' ' .$this->_JOINS[$key]['alias'],$this->_JOINS[$key]['join_field'],$this->_JOINS[$key]['join_type']);
        endforeach;        
       
       (! is_null($where))?$this->db->where($where):NULL;
		
        return $this->db->count_all_results();
    }
}
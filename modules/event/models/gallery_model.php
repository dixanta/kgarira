<?php
class Gallery_model extends MY_Model
{
	var $joins=array();
    public function __construct()
    {
    	parent::__construct();
        $this->prefix='tbl_';
        $this->_TABLES=array('GALLERY'=>$this->prefix.'gallery','EVENTS'=>$this->prefix.'events');
		$this->_JOINS=array('EVENTS'=>array('join_type'=>'LEFT','join_field'=>'events.gallery_id=gallery.gallery_id',
                                           'select'=>'gallery_image','alias'=>'gallery'),
                           
                            );        
    }
    
    public function getGalleries($where=NULL,$order_by=NULL,$limit=array('limit'=>NULL,'offset'=>''))
    {
       $fields='galleries.*';
       
		foreach($this->joins as $key):
			$fields=$fields . ','.$this->_JOINS[$key]['select'];
		endforeach;
                
        $this->db->select($fields);
        $this->db->from($this->_TABLES['GALLERY']. ' galleries');
		
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
		
        $this->db->from($this->_TABLES['GALLERY'].' galleries');
        
        foreach($this->joins as $key):
        $this->db->join($this->_TABLES[$key]. ' ' .$this->_JOINS[$key]['alias'],$this->_JOINS[$key]['join_field'],$this->_JOINS[$key]['join_type']);
        endforeach;        
       
       (! is_null($where))?$this->db->where($where):NULL;
		
        return $this->db->count_all_results();
    }
	
	
	function getgalleryImage($where = NULL,$sort_by=NULL, $limit = array('limit' => NULL, 'offset' => ''))
	{
		// Load the khacl config file so we can get the correct table name
		$this->load->config('khaos', true, true);
		$options = $this->config->item('acl', 'khaos');
		$acl_tables = $options['tables'];

		$this->db->select('*');
		$this->db->from($this->_TABLES['GALLERY']);
		
		
		if( ! is_null($where))
		{
			$this->db->where($where);
		}
		
		if( ! is_null($sort_by))
		{
			$this->db->order_by($sort_by);
		}
		
		if( ! is_null($limit['limit']))
		{
			$this->db->limit($limit['limit'],( isset($limit['offset'])?$limit['offset']:''));
		}
		return $this->db->get();
	}
}
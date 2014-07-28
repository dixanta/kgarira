<?php
class Artist_model extends MY_Model
{
	var $joins=array();
    public function __construct()
    {
    	parent::__construct();
        $this->prefix='tbl_';
        $this->_TABLES=array('ARTISTS'=>$this->prefix.'artists',
								'GENRES'=>$this->prefix.'genres');
		$this->_JOINS=array('GENRES'=>array('join_type'=>'LEFT','join_field'=>'artists.genre_id=genres.genre_id',
                                           'select'=>'genres.genre_name','alias'=>'genres'),
										   
                           
                            );        
    }
    
    public function getArtists($where=NULL,$order_by=NULL,$limit=array('limit'=>NULL,'offset'=>''))
    {
       $fields='artists.*';
       
		foreach($this->joins as $key):
			$fields=$fields . ','.$this->_JOINS[$key]['select'];
		endforeach;
                
        $this->db->select($fields);
        $this->db->from($this->_TABLES['ARTISTS']. ' artists');
		
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
		
        $this->db->from($this->_TABLES['ARTISTS'].' artists');
        
        foreach($this->joins as $key):
        $this->db->join($this->_TABLES[$key]. ' ' .$this->_JOINS[$key]['alias'],$this->_JOINS[$key]['join_field'],$this->_JOINS[$key]['join_type']);
        endforeach;        
       
       (! is_null($where))?$this->db->where($where):NULL;
		
        return $this->db->count_all_results();
    }
	public function getById($id)
	{
		return $this->getArtists(array('artist_id'=>$id))->row_array();
	}
	
	public function genre($id)
	{
		return $this->getArtists(array('artists.genre_id'=>$id));
	}
	
}
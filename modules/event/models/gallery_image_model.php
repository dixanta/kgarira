<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_image_model extends MY_model
{
	function __construct()
	{
		parent::__construct();
		$this->_prefix = 'tbl_';
		$this->_TABLES = array('GalleryImage' => $this->_prefix . 'gallery_image',
								'Gallery' => $this->_prefix . 'gallery');

		log_message('debug','BackendPro : Gallery_image_model class loaded');
	}
	
	function getGalleryImages($where = NULL,$sort_by=NULL, $limit = array('limit' => NULL, 'offset' => ''))
	{
		// Load the khacl config file so we can get the correct table name
		$this->load->config('khaos', true, true);
		$options = $this->config->item('acl', 'khaos');
		$acl_tables = $options['tables'];

		$this->db->select('*');
		$this->db->from($this->_TABLES['GalleryImage'] . " galimg");
		$this->db->join($this->_TABLES['Gallery'] . " gal",'galimg.gallery_id=gal.gallery_id');
		
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
	 function paginationMostViewed($where = NULL)
    {
	
		if( ! is_null($where))
			{
				$this->db->where($where);
			}
			
			
			$this->db->select('count(*) numrows');
		$this->db->from($this->_TABLES['GalleryImage'] . " galimg");
		$this->db->join($this->_TABLES['Gallery'] . " gal",'galimg.gallery_id=gal.gallery_id');
			$query=$this->db->get();
			
			if ($query->num_rows() == 0)
			{
				return '0';
				
			}
	
			$row = $query->row();
			return $row->numrows;
	
  }
	
	function getgalleryImage($where = NULL,$sort_by=NULL, $limit = array('limit' => NULL, 'offset' => ''))
	{
		// Load the khacl config file so we can get the correct table name
		$this->load->config('khaos', true, true);
		$options = $this->config->item('acl', 'khaos');
		$acl_tables = $options['tables'];

		$this->db->select('*');
		$this->db->from($this->_TABLES['GalleryImage']);
		
		
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
	/*function insert_image($gallery_image,$gallery_id)
	{
		$dates=(date("Y-m-d",time()));
		$sql="insert into `be_gallery_image` (`gallery_image`,`gallery_id`,'added_on') values('$gallery_image','$gallery_id','$dates')";
		echo $sql;
		exit;
		mysql_query($sql);
		return;
	}*/
    
	function photoCommentsRate($where = NULL,$sort_by=NULL, $limit = array('limit' => NULL, 'offset' => ''))
	{
		$this->db->select('*');
		$this->db->from($this->_TABLES['GalleryImage']);
		
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
	
    
	
	function countPhotos($where = NULL,$sort_by=NULL, $limit = array('limit' => NULL, 'offset' => ''))
    {
	
		if( ! is_null($where))
			{
				$this->db->where($where);
			}
			$this->db->select('count(*) numrows');
			$this->db->from($this->_TABLES['GalleryImage']." gallery_image");
			$query=$this->db->get();
			
			if ($query->num_rows() == 0)
			{
				return '0';
				
			}
	
			$row = $query->row();
			return $row->numrows;
	
  }
 function paginationLastAdded($where = NULL,$sort_by=NULL, $limit = array('limit' => NULL, 'offset' => ''))
    {
	
		if( ! is_null($where))
			{
				$this->db->where($where);
			}
			
			if( ! is_null($sort_by))
		{
			$this->db->order_by($sort_by);
		}
			$this->db->select('count(*) numrows');
			$this->db->from($this->_TABLES['GalleryImage']." gallery_image");
			$this->db->join($this->_TABLES['Gallery'] . " gallery",'gallery_image.gallery_id=gallery.gallery_id');
			$query=$this->db->get();
			
			if ($query->num_rows() == 0)
			{
				return '0';
				
			}
	
			$row = $query->row();
			return $row->numrows;
	
  }

}
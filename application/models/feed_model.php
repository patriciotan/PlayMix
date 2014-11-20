<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Feed_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function get_songs()
    {
        return $this->db->get("audio");
    }
  
}
?>
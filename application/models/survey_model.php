<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Survey_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function get_surveys()
    {
        return $this->db->get("survey");
    }
  
}
?>
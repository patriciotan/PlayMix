<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Question_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function assoc_to_sur($sur_id)
    {
        $data=array(
        'sur_id'         =>$sur_id,
        'sur_title'      =>$this->input->post('sur_title')
        );
        $this->db->insert('question',$data);

    }
  
}
?>
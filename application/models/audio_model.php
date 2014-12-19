<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class audio_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function fetch_audio_id($audio_title)
    {
    
    $query = $this->db->query("SELECT * FROM `audio` WHERE `audio_title`= '$audio_title' ");
        
        
        foreach($query->result('user') as $row)
        {
            $newdata = array(        
            'audio_id'        => $row->audio_id,
            'audio_title'     => $row->audio_title,
            'audio_genre'     => $row->audio_genre,
            );
        }
        
        return $newdata;

    }

    public function add_audio($file_name)
    {
        $data=array(
        'user_id'           =>$this->session->userdata('user_id'),
        'audio_title'       =>$this->input->post('audio_title'),
        'audio_genre'       =>$this->input->post('audio_genre'),  
        'audio_date_added'  =>date("Y/m/d"),      
        'audio_file'        =>$file_name
        );
        //$this->db->from('audio');
        //$this->db->join('user', 'audio.user_id = user.user_id');
        $this->db->insert('audio',$data);
    }

    

}

?>
<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class playlist_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function add_playlist()
    {
        $data=array(
        'user_id'              =>$this->session->userdata('user_id'),
        'playlist_name'        =>$this->input->post('playlist_name'),
        'playlist_date_added'  =>date("Y/m/d"), 
        'playlist_audio_count' => 0
        );
        $this->db->insert('playlist',$data);
    }

    public function get_playlists()
    {
        $user_id= $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('playlist');
        $this->db->where('user_id',$user_id);
        $query = $this->db->get();
      
            return $query;
     
    }
    public function row_delete($id)
    {
        $this->db->where('playlist_id', $id);
        $this->db->delete('playlist');
    }

}

?>
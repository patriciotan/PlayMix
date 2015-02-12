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
        'playlist_date_added'  =>date("Y/m/d")
        );
        $this->db->insert('playlist',$data);
    }

    public function rename_playlist()
    {
        $data=array(
        'playlist_name'        =>$this->input->post('rename')
        );
        $this->db->where('playlist_id',$this->input->post('rename_id'));
        $this->db->update('playlist',$data);
    }

    public function add2playlist($data){
        $playlist_id=$data['playlist_id'];
        // (int)$playlist_audio_count=(int)$test;
        // $playlist_count = 0;
        // $playlist_count = $playlist_count + (int)$data['playlist_audio_count'];
        // $playlist_count = $playlist_count + 1;
        $this->db->select('*');
        $this->db->from('playlist');
        // $i=(int)$i;
        // $i=(int)1;
        $this->db->where('playlist_id', $playlist_id);
        $data=array(
        'user_id'              =>$this->session->userdata('user_id'),
        // 'playlist_audio_count' =>$playlist_audio_count
        );
        
        $this->db->update('playlist',$data);  
      
    }

    public function get_count($playlist_id)
    {
        $this->db->select('playlist_audio_count');
        $this->db->from('playlist');
        $this->db->where('playlist_id', $playlist_id);
        $query=$this->db->get();

        return $query;


    }

    public function add2sequence($data){
        $this->db->insert('sequence', $data);
    }
    
    public function fetch_playlist_seq($playlist_id){
        
        $this->db->where('playlist_id', $playlist_id);
        $this->db->join('audio', 'audio.audio_id = sequence.audio_id');
        $query = $this->db->get('sequence');
        if($query->num_rows() > 0)
            return $query->result();
    }

    public function get_playlist_owner($playlist_id)
    {
        $this->db->select('user.user_username');
        $this->db->from('user');
        $this->db->join('playlist', 'user.user_id = playlist.user_id');
        $query = $this->db->get();
        
        return $query->row()->user_username;
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
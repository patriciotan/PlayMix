<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function login($email,$password)
    {
        $this->db->where("user_email",$email);
        $this->db->where("user_password",$password);
        
        $query=$this->db->get("user");
        if ($query->num_rows()>0) {
            foreach($query->result() as $rows)
            {
                $newdata = array(
                'user_id'    => $rows->user_id,
                'user_username'  => $rows->user_username,
                'user_email' => $rows->user_email,
                'user_type' => $rows->user_type,
                'logged_in'  => TRUE
                );
            }
            $this->session->set_userdata($newdata);
            return true;
        }
        return false;
    }

    public function add_user()
    {
        $data=array(
        'user_username'   =>$this->input->post('user_username'),
        'user_email'      =>$this->input->post('user_email'),
        'user_password'   =>md5($this->input->post('user_password'))
        );
        $this->db->insert('user',$data);
    }

    public function get_songs()
    {
        $this->db->select('audio.audio_title');
        $this->db->select('user.user_username');
        $this->db->select('audio.audio_date_added');
        $this->db->select('audio.audio_play_count');
        //$this->db->select('*');
        $this->db->from('user');
        $this->db->join('audio', 'user.user_id = audio.user_id');
        $this->db->order_by('audio.audio_play_count','desc');
        $this->db->where('audio.audio_private','Public');
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            return $query;
        }
    }

    public function get_all_users()
    {
        $query = $this->db->get("user");
        if ($query->num_rows()>0) {
            return $query;
        }
    }

    public function get_all_songs()
    {
        $query = $this->db->get("audio");
        if ($query->num_rows()>0) {
            return $query;
        }
    }

    public function get_ban_list()
    {
        $query = $this->db->get("ban_list");
        if ($query->num_rows()>0) {
            return $query;
        }
    }

    public function get_delete_list()
    {
        $query = $this->db->get("delete_list");
        if ($query->num_rows()>0) {
            return $query;
        }
    }

    public function get_banned_list()
    {
        $this->db->where("user_status","Banned");
        $query = $this->db->get("user");
        if ($query->num_rows()>0) {
            return $query;
        }
    }
    public function add_ban($user)
    {
        $this->db->where("user_id",$user);
        $query = $this->db->get("user");
        if ($query->num_rows()>0) {
            foreach($query->result() as $row)
            {
                $data=array(
                'user_id' => $row->user_id,
                'user_username' =>$row->user_username
                );

                $this->db->where("user_id",$row->user_id);
                $query = $this->db->get("ban_list");

                if ($query->num_rows()<1) {
                    $this->db->insert('ban_list',$data);
                }
            }
        }
    }
    public function add_delete($song)
    {
        $this->db->where("audio_id",$song);
        $query = $this->db->get("audio");
        if ($query->num_rows()>0) {
            foreach($query->result() as $row)
            {
                $data=array(
                'audio_id' => $row->audio_id,
                'audio_title' =>$row->audio_title
                );

                $this->db->where("audio_id",$row->audio_id);
                $query = $this->db->get("delete_list");

                if ($query->num_rows()<1) {
                    $this->db->insert('delete_list',$data);
                }
            }
        }
    }
    public function unban($user)
    {
        $this->db->where("user_id",$user);
        $query = $this->db->get("user");

        if ($query->num_rows()>0) {
            foreach($query->result() as $row)
            {
                $data = array(
                'user_status' => "Okay"
                ); 

                $this->db->where("user_id",$row->user_id);
                $this->db->update("user", $data);
            }
        }
    }
    public function ban_list()
    {
        $query = $this->db->get('ban_list');
        $data = array(
        'user_status' => "Banned"
        ); 
        if ($query->num_rows()>0) {
            foreach($query->result() as $row)
            {
                $this->db->where("user_id",$row->user_id);
                $this->db->update("user", $data);
            }
        }
    }
    public function delete_list()
    {
        $query = $this->db->get('delete_list');
        if ($query->num_rows()>0) {
            foreach($query->result() as $row)
            {
                $this->db->where("audio_id",$row->audio_id);
                $this->db->delete("audio");
            }
        }
    }
    public function ban_reset()
    {
        $this->db->truncate('ban_list');
    }
    public function delete_reset()
    {
        $this->db->truncate('delete_list');
    }

    public function check_username($username)
    {
        $this->db->where("user_username",$username);

        $query=$this->db->get("user");
        if ($query->num_rows()>0) {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function check_email($email)
    {
        $this->db->where("user_email",$email);

        $query=$this->db->get("user");
        if ($query->num_rows()>0) {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function validate_email($email)
    {
        $this->db->where("user_email",$email);
        
        $query=$this->db->get("user");
        if ($query->num_rows()>0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function validate_emailpass($email,$password)
    {
        $this->db->where("user_email",$email);
        $this->db->where("user_password",$password);
        
        $query=$this->db->get("user");
        if ($query->num_rows()>0) {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function change_password($email,$newpass)
    {
        $data = array(
            'user_password' => md5($newpass)
        );

        $this->db->where("user_email",$email);
        $this->db->update('user', $data); 

    }

    public function get_records()
    {
        return $this->db->get("user");
    }

    public function row_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    public function row_update($user_id)
    {
        $this->load->database();
        
        $data = array(
        'username' =>$this->input->post('user_name'),
        
        'firstname'=>$this->input->post('user_fname'),
        
        'lastname' =>$this->input->post('user_lname'),
        
        'password' =>md5($this->input->post('user_password'))

        
        
        );
        
        $this->db->where('id',$user_id);
        
        $this->db->update('user',$data);     
    }
    
    public function get_info($id)
    {
        $query = $this->db->query("SELECT * FROM `user` WHERE `user_id`=$id");
        
        
        foreach($query->result() as $row)
        {
            $newdata = array(
            'user_email'    => $row->user_email,
            'user_name'     => $row->user_username,
            'user_fname'    => $row->user_fname,
            'user_lname'    => $row->user_lname,
            'user_city'     => $row->user_city,
            'user_country'  => $row->user_country,
            'user_bio'      => $row->user_bio,
            'user_fb'       => $row->user_fb,
            'user_google'   => $row->user_google,     
            'user_twitter'  => $row->user_twitter,  
            'user_photo'    => $row->user_photo,                                                   
            );
        }
        
        return $newdata;
        
    }

    public function get_user_songs($id)
    {
        $this->db->select('audio.audio_title');
        $this->db->select('user.user_username');
        $this->db->select('audio.audio_date_added');
        $this->db->select('audio.audio_play_count');
        //$this->db->select('*');
        $this->db->from('user');
        $this->db->join('audio', 'user.user_id = audio.user_id');
        $this->db->order_by('audio.audio_play_count','desc');
        $this->db->where('audio.user_id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            return $query;
        }
    }

}
?>
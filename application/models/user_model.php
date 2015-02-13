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
                'user_status' => $rows->user_status,
                'logged_in'  => TRUE
                );
            }
            if($rows->user_status == "Banned"){
                return "banned";
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
        $user_username=$this->input->post('user_username');

        $this->add_notifOnRegister($user_username);
       

    }
    public function add_notifOnRegister($user_username)
    {
        $this->db->select('user.user_id');
        $this->db->from('user');
        $this->db->where('user_username', $user_username);
        $query=$this->db->get();
        foreach($query->result() as $row){
            $uid= $row->user_id;
        }
        $data=array(
            'user_id' =>$uid,
            'notif_count'=>0
        );
        $this->db->insert('notification', $data);
    }

    public function get_songs()
    {
        $this->db->select('audio.audio_title');
        $this->db->select('audio.audio_id');
        $this->db->select('audio.audio_file');
        $this->db->select('audio.audio_id');
        $this->db->select('audio.audio_photo');
        $this->db->select('user.user_username');
        $this->db->select('user.user_id');
        $this->db->select('audio.audio_date_added');
        $this->db->select('audio.audio_play_count');
        //$this->db->select('*');
        $this->db->from('user');
        $this->db->join('audio', 'user.user_id = audio.user_id');
        $this->db->order_by('audio.audio_play_count','desc');
        $this->db->where('audio.audio_private', 0);
        $this->db->where('audio.audio_status','Okay');
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            return $query;
        }
    }

    public function get_all_users()
    {
        $this->db->where("user_status",'Okay');
        $query = $this->db->get("user");
        if ($query->num_rows()>0) {
            return $query;
        }
    }

    public function get_all_songs()
    {
        $this->db->where("audio_status",'Okay');
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
                $this->ban_reset();
            }
        }
    }
    public function delete_list()
    {
        $query = $this->db->get('delete_list');
        $data = array(
        'audio_status' => "Removed"
        ); 
        if ($query->num_rows()>0) {
            foreach($query->result() as $row)
            {
                $this->db->where("audio_id",$row->audio_id);
                $this->db->update("audio", $data);
                $this->delete_reset();
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

    public function check_password($uid, $pass)
    {

        $query = $this->db->query("SELECT `user_password` FROM `user` WHERE `user_id`=$uid");
        foreach($query->result() as $row){
            $cur_pass = $row->user_password;
        }
        
        if($pass === $cur_pass)
            {
            return true;
            }
        else
            {
            return false;
            }

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

    public function user_account_update($user_id, $user_username, $user_email)
    {
        $this->load->database();      

        $query = $this->db->query("SELECT `user_username`,`user_email` FROM `user` WHERE `user_id`=$user_id");
        foreach($query->result() as $row){
            $cur_username = $row->user_username;
            $cur_user_email = $row->user_email;
        }       

        if($user_username !== $cur_username)
                {
                
                $data = array(
                    'user_username' => $user_username,
                );

                $this->db->where('user_id',$user_id);
                $this->db->update('user', $data);    
                }

        if($user_email !== $cur_user_email)
                {
                
                $data = array(
                    'user_email' => $user_email,
                );

                $this->db->where('user_id',$user_id);
                $this->db->update('user',$data);    
                }    


//       $this->db->where('user_id',$user_id);       
//       $this->db->update('user',$data);     
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

    public function get_account_info($id)
    {
        $query = $this->db->query("SELECT * FROM `user` WHERE `user_id`=$id");
        
        
        foreach($query->result() as $row)
        {
            $newdata = array(
            'user_email'    => $row->user_email,
            'user_name'     => $row->user_username,                                                  
            );
        }
        
        return $newdata;
        
    }


    public function get_user_songs($id)
    {
        $this->db->select('audio.audio_id');
        $this->db->select('audio.audio_title');
        $this->db->select('user.user_username');
        $this->db->select('audio.audio_date_added');
        $this->db->select('audio.audio_photo');        
        $this->db->select('audio.audio_play_count');
        $this->db->select('audio.audio_file');
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

    public function update_personal_info($uid, $fname, $lname, $city, $cntry, $fb, $google, $twitter, $bio, $photo)
    {

        
        $data = array(
            'user_fname' => $fname,
            'user_lname' => $lname,
            'user_city' => $city,
            'user_country' => $cntry,
            'user_fb' => $fb,
            'user_google' => $google,
            'user_twitter' => $twitter,
            'user_bio' => $bio,
            'user_photo'    => $photo,
        );

        $this->db->select('*', 'user');
        $this->db->where('user_id', $uid);
        $this->db->update('user', $data);
    }

    public function check_notif_id($username)
    {
        $this->db->where("user_id",$username);

        $query=$this->db->get("notification");
        if ($query->num_rows()>0) {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function get_user_id($email){
        $this->db->select('user.user_id');
        $this->db->from('user');
        $this->db->where('user.user_email',$email);
        $query = $this->db->get();
        foreach($query->result() as $row)
        {
            $newdata = array(
                'user_id'    => $row->user_id,                                                 
            );
        }
        
        return $newdata;

    }

    public function add_notification($uid){

        if($this->check_notif_id($uid)){
            $thing['count'] = $this->get_notification_count($uid);
            //$test = $thing['notif_count'];
            //echo "<script type='text/javascript'>alert('$test');</script>";
            $count = $thing['count']['notif_count'];
            $count = $count+1;
            //echo "<script type='text/javascript'>alert('$count');</script>";
            $data = array(
                'user_id'     => $uid,
                'notif_count' => $count

            );
        
            $this->db->select('*', 'notification');
            $this->db->where('user_id', $uid);
            $this->db->update('notification', $data);          
        }

        else{
            $count = 1;
            $data = array(
                'user_id'     => $uid,
                'notif_count' => $count

            );
            $this->db->insert('notification',$data); 
        }            

    }

    public function get_notification_count($uid){

        $query = $this->db->query("SELECT * FROM `notification` WHERE `user_id`=$uid");

        foreach($query->result() as $row)
        {
            $newdata = array(
                'notif_id'       => $row->notif_id,
                'notif_count'    => $row->notif_count,                                                 
            );
        }
        
        return $newdata;        
    }

    public function reset_notif($uid)
    {
    	$newdata = array(
            'notif_count'    => 0
        );

    	$this->db->select('*', 'notification');
        $this->db->where('user_id', $uid);
        $this->db->update('notification', $newdata); 
    }

    public function increment_play($id)
    {
        $this->db->where('audio_id',$id);
        $num = $this->db->get('audio');
        $nume=$num->row();
        if(!empty($num))
            $numM = $nume->audio_play_count + 1;

        $data = array(
            'audio_play_count'    => $numM
        );

        // $this->db->select('*', 'audio');
        $this->db->where('audio_id', $id);
        $this->db->update('audio', $data);
    }


}
?>
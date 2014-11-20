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
                //add all data to session
                $newdata = array(
                'user_id'    => $rows->user_id,
                'user_username'  => $rows->user_username,
                'user_email' => $rows->user_email,
                //'user_role'  => 'User', //User gets a role, user.
               // 'logged_in'  => TRUE,
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
        'user_password'   =>md5($this->input->post('user_password')),
        
        );
        $this->db->insert('user',$data);
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
    
    public function fetch_data($id)
    {
        $query = $this->db->query("SELECT * FROM `user` WHERE `id`=$id");
        
        
        foreach($query->result('user') as $row)
        {
            $newdata = array(
            'user_id'       => $row->id,
            'user_name'     => $row->username,
            'user_fname'    => $row->firstname,
            'user_lname'    => $row->lastname,
            'user_password' => $row->password,
            'user_role'     => 'User'
            );
        }
        
        return $newdata;
        
    }

}
?>
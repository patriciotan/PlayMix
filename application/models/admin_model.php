<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function login($email,$password)
    {
        $this->db->where("email",$email);
        $this->db->where("password",$password);
        
        $query=$this->db->get("user");
        if ($query->num_rows()>0) {
            foreach($query->result() as $rows)
            {
                //add all data to session
                $newdata = array(
                'user_id'    => $rows->id,
                'user_name'  => $rows->username,
                'user_email' => $rows->email,
                'user_fname' => $rows->firstname,
                'user_lname' => $rows->lastname,
                'user_role'  => 'Admin', 
                'logged_in'  => TRUE,
                );
            }
            $this->session->set_userdata($newdata);
            return true;
        }
        return false;
    }

    public function add_admin()
    {
        $data=array(
        'username'   =>$this->input->post('user_name'),
        'email'      =>$this->input->post('email_address'),
        'firstname'  =>$this->input->post('user_fname'),
        'lastname'   =>$this->input->post('user_lname'),
        'password'   =>md5($this->input->post('password')),
        'user_role'  =>'Admin'
        );
        $this->db->insert('user',$data);
    }

     public function add_survey()
    {
        $data=array(
        'sur_title'   =>$this->input->post('sur_title'),
        'sur_purpose'      =>$this->input->post('sur_purpose'),
        'sur_source'  =>$this->input->post('sur_source')
        );
        $this->db->insert('survey',$data);
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
            'user_role'     => 'Admin'
            );
        }
        
        return $newdata;
        
    }

}
?>
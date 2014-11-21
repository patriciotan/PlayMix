<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
<<<<<<< HEAD
    {
       
        if (($this->session->userdata('user_username')!="")) 
        {
            $this->Feed();
        } 
        else 
        {
            $data['title']= 'Home';
            
            $this->load->view('header_view_user',$data);
          
            $this->load->view("registration_view.php", $data);

=======
    {      
        if (($this->session->userdata('user_username')!="")) {
            $this->feed();
        } else {
            $data['title']= 'Home';        
            $this->load->view('header_view_user',$data);         
            $this->load->view("login_view.php", $data);
>>>>>>> 5924ede82539d6831a6f7178f3d5fe41e806aa1e
        }
    }


<<<<<<< HEAD
    public function Feed()
    {
        if($this->session->userdata('logged_in')) 
        {
            $data['title']= 'Feed';
            $this->load->view('header_view_user',$data);
            $this->display_feed();
            $this->load->view('footer_view',$data);
        }
    }

    public function login()
    {
        if(! $this->session->userdata('logged_in')) 
        {
            
            $email=$this->input->post('user_email');
            $password=md5($this->input->post('user_password'));
            
            $result=$this->user_model->login($email,$password);
            if ($result) 
            {
                $this->Feed();      
                
            } 
            else 
            {
                $this->index();
                $this->login_error();
            }
        }
    }
    
    public function forgot_login()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_email', 'Your Email', 'trim|required|valid_email');
         if ($this->form_validation->run() == FALSE) 
         {
=======
    public function login()
    {
        $email=$this->input->post('user_email');
        $password=md5($this->input->post('user_password'));
        
        $result=$this->user_model->login($email,$password);
        if ($result) {
            $this->feed();      
>>>>>>> 5924ede82539d6831a6f7178f3d5fe41e806aa1e
            
        } 
        else 
        {
            $this->send_email();
            $this->index();
        }
    }

    public function send_email()
    {
        $this->load->library('form_validation');

        $this->email->from('your@example.com', 'Your Name');
        $this->email->to('someone@example.com'); 

        $this->email->subject('PlayMix Forgot Password');
        $this->email->message('');

        if (! $this->email->send())
        {
            // Generate error
        }
    }

    public function registration()
    {
        $data['title']= 'Registration';  
        $this->load->view('header_view_user',$data);  
        $this->load->view("registration_view.php", $data);
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_username', 'User Name', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('user_email', 'Your Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('user_conpassword', 'Password Confirmation', 'trim|required|matches[user_password]');
      
<<<<<<< HEAD
         if ($this->form_validation->run() == FALSE) 
         {
=======
        if ($this->form_validation->run() == FALSE) {
>>>>>>> 5924ede82539d6831a6f7178f3d5fe41e806aa1e
            
        } 
        else 
        {
            $this->user_model->add_user();
            $this->index();
        }
    }

    public function forgot()
    {        
        $data['title']= 'Forgot Password';  
        $this->load->view('header_view_user',$data);  
        $this->load->view('login_forgot_view', $data);
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_email', 'Your Email', 'trim|required|valid_email');      
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            //$this->user_model->add_user();
            $this->index();
        }
    }
    
    public function logout()
    {
        $newdata = array(
        'user_id'    =>'',
        'user_username'  =>'',
        'user_email' =>'',
        'user_role'  =>'',
        'logged_in'  =>FALSE,
        );
        $this->session->unset_userdata($newdata );
        $this->session->sess_destroy();
        $this->index();
    }


    public function feed()
    {
        $data['title']= 'Feed';
        $this->load->view('header_view_user',$data);
        $this->display_feed();
        $this->load->view('footer_view',$data);
    }

    public function display_feed()
    {
	    $data['rec'] = $this->user_model->get_songs();
	    $this->load->view('feed_view', $data);
    }
    
    public function show_update_rec()
    {
        $data['id']=$this->input->post('id');
        
        $id=$data['id'];
        
        $data=$this->user_model->fetch_data($id);
        
        $this->load->view('update_view', $data);
        
    }
    

    public function update_rec($user_id)
    {
        $this->user_model->row_update($user_id);
        $this->welcome();  
    }
    
    public function delete_rec()
    {   
        $id=$this->input->post('id');
        $this->load->model('user_model');
        $this->user_model->row_delete($id);
        $this->welcome();    
    }

    public function about()
    { 
      $data['title']= 'Home';          
      $this->load->view('header_view_user',$data);
      $this->load->view('about_view');
      $this->load->view('footer_view',$data);
    }
    public function about_log_user()
    { 
      $data['title']= 'Home';          
      $this->load->view('header_view_user',$data);
      $this->load->view('about_view_log_user');
      $this->load->view('footer_view',$data);
    }
    
    public function login_error()
    {
      $this->load->view('login_error_view');
    }

    public function sel_role_error()
    {
      $this->load->view('sel_role_error_view');
    }

}
?>
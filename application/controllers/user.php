<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {      
        if (($this->session->userdata('user_username')!="")) {
            $this->feed();
        } else {
            $data['title']= 'Home';        
            $this->load->view('header_view_user',$data);         
            $this->load->view("login_view.php", $data);
        }
    }
    public function login()
    {
        $email=$this->input->post('user_email');
        $password=md5($this->input->post('user_password'));
        
        $result=$this->user_model->login($email,$password);
        if ($result) {
            $this->feed();      
            
        } else {
            $this->index();
            $this->login_error();
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
      
        if ($this->form_validation->run() == FALSE) {
            
        } else {
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
        $this->load->view('navbar',$data);
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
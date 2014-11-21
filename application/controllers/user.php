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
        if (($this->session->userdata('logged_in')!=FALSE)) {
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
    }
    public function reg_validation()
    {
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
    }
    public function forgot_validation()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_email', 'Your Email', 'trim|required|valid_email');      
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $this->send_email();
        }
    }
    public function send_email()
    {
        $from = 'mictest12345678910@gmail.com';
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => $from, // change it to yours
            'smtp_pass' => '123456789Ten', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
            $email = $this->input->post('user_email');
            $newpass = random_string('alnum','8');
            $message = "New password: "+$newpass; //new password

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from($from); // change it to yours
            $this->email->to($email); // change it to yours
            $this->email->subject('PlayMix Forgot Password');
            $this->email->message($message);

            if($this->email->send())
            {
                $this->index();
            }
            else
            {

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
        if (($this->session->userdata('logged_in')!=FALSE)) {
            $data['title']= 'Feed';
            $this->load->view('header_view_user',$data);
            $this->load->view('navbar',$data);
            $this->display_feed();
            $this->load->view('footer_view',$data);
        }
        else
        {
            $this->index();
        }
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
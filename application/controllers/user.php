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
        if (($this->session->userdata('logged_in')==FALSE)) 
        {
            $data['title']= 'Home'; 
        	$this->load->view('header_view_user',$data); 
            $this->load->view("login_view.php", $data);
        } 
        else 
        {
            if($this->session->userdata('user_type')=='Admin')
            {
                $navbar = 'navbar_admin';
            }
            else
            {
                $navbar = 'navbar_user';
            }
            $this->feed($navbar);
        }
    }
    public function login()
    {
        $email=$this->input->post('user_email');
        $password=md5($this->input->post('user_password'));
        if($this->log_validation())
        {
            $this->index();  
        }
        else
        {
            $result=$this->user_model->login($email,$password);
        }
        if (!$result && $this->session->userdata('logged_in')==FALSE) 
        { 
            $this->index();        
        } 
        else 
        {
        	if($this->session->userdata('user_type')=='Admin')
        	{
        		$navbar = 'navbar_admin';
        	}
        	else
        	{
        		$navbar = 'navbar_user';
        	}
            $this->feed($navbar);
        }
    }
    public function log_validation()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_email', 'Email address', 'trim|required|valid_email|callback_validate_emailpass');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required');
      
        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            return true;
        }
    }
    public function validate_emailpass() {
        if($this->user_model->validate_emailpass($this->input->post('user_email'),$this->input->post('user_password'))) {
            return true;
        }
        else {
            $this->form_validation->set_message('validate_emailpass','Email address and password do not match!');
            return false;
        }
    } 
    public function registration()
    {
        $data['title']= 'Registration';  
        $this->load->view('header_view_user',$data);  
        $this->load->view("registration_view", $data);
    }
    public function reg_validation()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_username', 'User name', 'trim|required|min_length[4]|xss_clean|callback_check_username');
        $this->form_validation->set_rules('user_email', 'Email address', 'trim|required|valid_email|callback_check_email');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('user_conpassword', 'Password Confirmation', 'trim|required|matches[user_password]');
      
        if ($this->form_validation->run() == FALSE) {
            $this->registration();
        } else {
            $this->user_model->add_user();
            $this->index();
            $this->load->view('registered_script');
        }
    }
    public function check_username() {
        if($this->user_model->check_username($this->input->post('user_username'))) {
            return true;
        }
        else {
            $this->form_validation->set_message('check_username','This user name already exists!');
            return false;
        }
    } 
    public function check_email() {
        if($this->user_model->check_email($this->input->post('user_email'))) {
            return true;
        }
        else {
            $this->form_validation->set_message('check_email','This email address already exists!');
            return false;
        }
    } 
    /*public function terms()
    {        
        $data['title']= 'Terms of Agreement';  
        $this->load->view('header_view_user',$data);  
        $this->load->view('terms_view', $data);
    }
    public function terms_agree()
    {
        $this->user_model->add_user();
        $this->index();
    }*/
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
        $this->form_validation->set_rules('user_email', 'Email address', 'trim|required|valid_email');      
        if ($this->form_validation->run() == FALSE) {
            $this->forgot();
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
            $newpass = random_string('alnum','8'); //new password

            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_email', 'Email address', 'trim|required|valid_email|callback_validate_email');

            if ($this->form_validation->run() == FALSE)
            {
                $this->forgot();
            }
            else
            {
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from($from); // change it to yours
                $this->email->to($email); // change it to yours
                $this->email->subject('PlayMix Forgot Password');
                $this->email->message('This is your new password: '. $newpass . '. You may change it in your profile page.');

                if($this->email->send())
                {
                    $this->user_model->change_password($email,$newpass);
                    $this->index();
                    $this->load->view('sent_email_script');
                }
                
                $this->forgot();
            }

    }
    public function validate_email() {
        if($this->user_model->validate_email($this->input->post('user_email'))) {
            return true;
        }
        else {
            $this->form_validation->set_message('validate_email','This email address does not exist!');
            return false;
        }
    } 
    public function logout()
    {
        $newdata = array(
        'user_id'    =>'',
        'user_username'  =>'',
        'user_email' =>'',
        'logged_in'  => FALSE
        );
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        $this->index();
    }
    public function feed($navbar)
    {
        if (($this->session->userdata('logged_in')==FALSE)) 
        {
            $this->index();
        }
        else
        {
            $data['title']= 'Feed';
            $this->load->view('header_view_user',$data);
            $this->load->view($navbar,$data);
            $this->display_feed();
        }
    }
    public function display_feed()
    {
        if (($this->session->userdata('logged_in')==FALSE)) 
        {
            $this->index();
        }
        else
        {
            $data['rec'] = $this->user_model->get_songs();
            $this->load->view('feed_view', $data);
        }
    }
    public function admin()
    {
        if (($this->session->userdata('logged_in')==FALSE)) 
        {
            $this->index();
        }
        else
        {
            $data['title'] = 'Admin';
            $data['ban'] = $this->load->view('ban_tab','',true);
            $data['banned'] = $this->load->view('banned_tab','',true);
            $data['delete'] = $this->load->view('delete_tab','',true);
            $this->load->view('header_view_user',$data);
            $this->load->view('navbar_admin',$data);
            $this->load->view('admin_view', $data);
        }
    }

    public function profile()
    {
        if (($this->session->userdata('logged_in')==FALSE)) 
        {
            $this->index();
        }
        else
        {
            $uid = $this->session->userdata('user_id');
            $data['rec'] = $this->user_model->get_user_songs($uid);            
            $data['info'] = $this->user_model->get_info($uid);            
            $data['title'] = 'Profile';  
            $data['personal_info'] = $this->load->view('personal_info_tab',$data,true);  
            $data['uploaded'] = $this->load->view('uploaded_tab',$data,true);      
            $data['playlists'] = $this->load->view('playlists_tab',$data,true); 
            $data['account'] = $this->load->view('account_tab',$data,true);
            $data['edit_personal_info'] = $this->load->view('edit_personal_info_tab',$data,true);
            $data['edit_account'] = $this->load->view('edit_account_tab',$data,true);
            $this->load->view('header_view_user',$data);
            return $data;
        }
    }

    public function profile_user()
    {
        if (($this->session->userdata('logged_in')==FALSE)) 
        {
            $this->index();
        }
        else
        {
            $data = $this->profile();
            $this->load->view('navbar_user');
            $this->load->view('profile_view', $data);
        }
    }

    public function profile_admin()
    {
        if (($this->session->userdata('logged_in')==FALSE)) 
        {
            $this->index();
        }
        else
        {
            $data = $this->profile();
            $this->load->view('navbar_admin');
            $this->load->view('profile_view', $data);
        }
    }

    public function edit_account_info()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_name', 'User name', 'trim|required|min_length[4]|xss_clean|callback_check_username');
        $this->form_validation->set_rules('user_email', 'Email address', 'trim|required|valid_email|callback_check_email');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[4]');       
        /*
        if ($this->form_validation->run() == FALSE) {
            $this->registration();
        } else {
            $this->user_model->add_user();
            $this->index();
            $this->load->view('registered_script');
        }
        */
    }
        

}
?>
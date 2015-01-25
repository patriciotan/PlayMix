<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class User extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }
    
    public function index()
    {      
        if (($this->session->userdata('logged_in')===FALSE)) 
        {
            $data['title']= 'Home'; 
        	$this->load->view('header_view_user',$data); 
            $this->load->view("login_view.php", $data);
        } 
        else 
        {
            $this->feed();
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
        if($result === "banned")
        {
            $this->index();
            $this->load->view("banned_login_script");
        }
        else
        {
            if ($this->session->userdata('logged_in')===FALSE) 
            { 
                $this->index();        
            } 
            else 
            {
                $this->feed();
            }
        }
    }
    public function log_validation()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_email', 'Email address', 'trim|required|valid_email|callback_validate_emailpass');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required');
      
        if ($this->form_validation->run() === FALSE) {
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
        if ($this->form_validation->run() === FALSE) {
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

            if ($this->form_validation->run() === FALSE)
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
    public function feed()
    {
        if (($this->session->userdata('logged_in')===FALSE)) 
        {
            $this->index();
        }
        else
        {
            $data['title']= 'Feed';
            $this->load->view('header_view_user',$data);

            if($this->session->userdata('user_type')==='Admin')
            {
                $this->load->view('navbar_admin',$data);
            }
            else
            {
                $this->load->view('navbar_user',$data);
            }

            $this->display_feed();
        }
    }
    public function display_feed()
    {
        if (($this->session->userdata('logged_in')===FALSE)) 
        {
            $this->index();
        }
        else
        {
            $data['rec'] = $this->user_model->get_songs();
            $this->load->view('feed_view', $data);
            $this->load->view('player');
        }
    }
    public function admin()
    {
        if (($this->session->userdata('logged_in')===FALSE)) 
        {
            $this->index();
        }
        else
        {
            $data['users'] = $this->user_model->get_all_users();
            $data['songs'] = $this->user_model->get_all_songs();
            $data['banlist'] = $this->user_model->get_ban_list();
            $data['bannedlist'] = $this->user_model->get_banned_list();
            $data['deletelist'] = $this->user_model->get_delete_list();

            $data['title'] = 'Admin';
            $data['ban'] = $this->load->view('ban_tab',$data,true);
            $data['banned'] = $this->load->view('banned_tab',$data,true);
            $data['delete'] = $this->load->view('delete_tab',$data,true);

            $this->load->view('header_view_user',$data);
            $this->load->view('navbar_admin',$data);
            $this->load->view('admin_view', $data);
            $this->load->view('player');
        }
    }
    public function add_ban()
    {
        $users = $this->input->post('users');
        if(is_array($users))
        {
            foreach($users as $user)
            {
                $this->user_model->add_ban($user);
            }
        }
        $this->admin();
    }
    public function add_delete()
    {
        $songs = $this->input->post('songs');
        if(is_array($songs))
        {
            foreach($songs as $song)
            {
                $this->user_model->add_delete($song);
            }
        }
        $this->admin();
    }
    public function ban()
    {
        $this->user_model->ban_list();
        $this->admin();
        $this->load->view('banned_script');
    }
    public function delete()
    {
        $this->user_model->delete_list();
        $this->admin();
        $this->load->view('deleted_script');
    }
    public function unban()
    {
        $users = $this->input->post('users');
        if(is_array($users))
        {
            foreach($users as $user)
            {
                $this->user_model->unban($user);
            }
        }
        $this->admin();
        $this->load->view('unbanned_script');
    }
    public function ban_reset()
    {
        $this->user_model->ban_reset();
        $this->admin();
    }
    public function delete_reset()
    {
        $this->user_model->delete_reset();
        $this->admin();
    }

    public function profile()
    {
        if (($this->session->userdata('logged_in')===FALSE)) 
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
            if($this->session->userdata('user_type')=='Admin')
                {
                $navbar = 'navbar_admin';
                }
            else
                {
                $navbar = 'navbar_user';
                }
            $this->load->view($navbar,$data);
            $this->load->view('profile_view', $data);
            $this->load->view('player');
            return $data;
        }
    }

    public function edit_account_info()
    {
        $uid = $this->session->userdata('user_id');
        $user_username = $this->input->post('user_username');       
        $user_email = $this->input->post('user_email');       
        $user_password = md5($this->input->post('user_password'));
        
        if($this->edit_account_info_validation() && $this->user_model->check_password($uid, $user_password))
        {
            $this->user_model->user_account_update($uid, $user_username, $user_email);
            $this->profile();
            echo "<script type='text/javascript'>alert('Changes are saved.');</script>";
        }
        else
        {
            $this->profile(); 
            echo "<script type='text/javascript'>alert('Error. Changes are not saved. Please try again.');</script>";  
        }        

    }

    public function edit_account_info_validation()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_username', 'User name', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('user_email', 'Email address', 'trim|required|valid_email|');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[4]');
        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {           
            return true;
        }
    }

    function do_uploadaudio()
    {   
        $config['upload_path'] = './uploads/mp3';
        $config['allowed_types'] = 'audio/mpeg|mp3|audio/x-wav|audio/x-aiff|application/ogg';
        $config['max_size'] = '50000';
        $config['file_name'] = 'audio';
        //$config['max_width']  = '1024';
        //$config['max_height']  = '1050';
        $this->load->library('upload', $config);


        if ( ! $this->upload->do_upload("audio_file"))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->upload_error($audio_title, $audio_genre); 
      
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());          
            return $data;
        }
  
    }

    public function upload_error($audio_title, $audio_genre)
    {
    $data['title']='Upload';
    $data['audio_title']= $audio_title;
    $data['audio_genre']=$audio_genre;
    $this->load->view('header_view_user',$data);

    if($this->session->userdata('user_type')=='Admin')
    {
        $this->load->view('navbar_admin',$data);
    }
    else
    {
        $this->load->view('navbar_user',$data);
    }

    $this->load->view('upload_view', $data); 
    $this->load->view('upload_error');
    $this->load->view('player');
    }

    public function upload()
    {
        $data['title']='Upload';
        $data['audio_title']= '';
        $data['audio_file']='';
        $data['audio_genre']='';        

        $this->load->view('header_view_user',$data);

        if($this->session->userdata('user_type')==='Admin')
        {
            $this->load->view('navbar_admin',$data);
        }
        else
        {
            $this->load->view('navbar_user',$data);
        }

        $this->load->view('upload_view');
        $this->load->view('player');

    }
    public function addAudio()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('audio_title', 'Song Title', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('audio_genre', 'Audio Genre', 'trim|max_length[20]');
     
        if ($this->form_validation->run() === FALSE) {
            echo "<script type='text/javascript'>alert('Upload failed. Please check your inputs and try again.');</script>";  
        } 
        else {


            $data = $this->do_uploadaudio();

            $filename = $data['upload_data']['file_name'];
            //$audiopath = "/uploads/mp3/".$filename;     
            $private = $this->input->post('audio_private');
            if($private = false)
                { $private = 0;}
            else
                { $private = 1;}


            $data=array(
                'user_id'           =>$this->session->userdata('user_id'),
                'audio_title'       =>$this->input->post('audio_title'),
                'audio_genre'       =>$this->input->post('audio_genre'),
                'audio_private'     =>$private,
                'audio_date_added'  =>date("Y/m/d"),      
                'audio_file'        =>$filename
            );


          
            $this->load->model('audio_model');
            $this->audio_model->add_audio($data); 
            echo "<script type='text/javascript'>alert('Song is successfully uploaded.');</script>";
            redirect('/user/feed', 'refresh');     
        }
    }  
    //public function upload_error()
    //{
    //    $this->load->view('upload_error_view');
    //}
    //public function upload_success()
    //{
    //    $this->load->view('upload_succes_view');
    //    
    //}

    public function update_personal_info() 
    {
        $this->load->helper('url');
        $id = $this->session->userdata('user_id');
        $getdata = $this->user_model->get_info($id);


        $fname = $this->input->post('user_fname');

        if($fname == '') {
            $fname = $getdata['user_fname'];
        }            

        $lname = $this->input->post('user_lname');

        if($lname == '') {
            $lname = $getdata['user_lname'];
        }

        $city = $this->input->post('user_city');
        
        if($city == '') {
            $city = $getdata['user_city'];
        }

        $country = $this->input->post('user_country');

        if($country == '') {
            $country = $getdata['user_country'];
        }        

        $fb = $this->input->post('user_fb');
        if($fb == '') {
            $fb = $getdata['user_fb'];
        }        

        $google = $this->input->post('user_google');
        if($google == '') {
            $google = $getdata['user_google'];
        }        
        $twitter = $this->input->post('user_twitter');
        if($twitter == '') {
            $twitter = $getdata['user_twitter'];
        }

        $bio = $this->input->post('user_bio');

        if($bio == '') {
            $bio = $getdata['user_bio'];
        }

        $data = $this->do_uploadphoto();
        $filename = $data['upload_data']['file_name'];
        $picpath = "/uploads/pp/".$filename;

        if($picpath == "/uploads/pp/") {
            $picpath = $getdata['user_photo'];

        }

        $this->user_model->update_personal_info($id, $fname, $lname, $city, $country, $fb, $google, $twitter, $bio, $picpath);

        redirect('/user/profile/', 'refresh');

    }

    public function do_uploadphoto()
    {   
        $config['upload_path'] = './uploads/pp/';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '3000';
        $config['file_name'] = 'pp';
        //$config['max_width']  = '1024';
        //$config['max_height']  = '1050';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload("user_new_photo"))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view("testerror", $error);
      
        }
        else
        {
            
            $data = array('upload_data' => $this->upload->data());
            return $data;           
        }
        
        //$data = $this->upload->data();
        //$picpath = $data['full_path'];
        //echo "<script type='text/javascript'>alert('$picpath');</script>";
    }
 
    public function send_collab()
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


                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from($from); // change it to yours
                $this->email->to($email); // change it to yours
                $this->email->subject('PlayMix Collaboration from:');
                $this->email->message('This is your new password: '. $newpass . '. You may change it in your profile page.');

                $this->email->send();
    }

    public function artistProfile()
    {
        if (($this->session->userdata('logged_in')===FALSE)) 
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
            $this->load->view('header_view_user',$data);
            if($this->session->userdata('user_type')=='Admin')
                {
                $navbar = 'navbar_admin';
                }
            else
                {
                $navbar = 'navbar_user';
                }
            $this->load->view($navbar,$data);
            $this->load->view('profile_view', $data);
            return $data;
        }
    }


}
?>
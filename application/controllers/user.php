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
        $this->log_validation();
    }
    public function login_success()
    {
        $email=$this->input->post('user_email');
        $password=md5($this->input->post('user_password'));
        $result = $this->user_model->login($email,$password);
        if($result === "banned")
        {
            $this->logout();
            $this->load->view("script_banned_login");
        }
        else
        {
            if ($this->session->userdata('logged_in')===false) 
            { 
                $this->index();     
            } 
            else 
            {
                $this->feed();
                $this->load->view("script_logged_in");   
            }
        }
    }
    public function log_validation()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_email', 'Email address', 'trim|required|valid_email|callback_validate_emailpass');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required');
      
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $this->login_success();
        }
    }
    public function validate_emailpass() {
        if($this->user_model->validate_emailpass($this->input->post('user_email'),md5($this->input->post('user_password')))) {
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
            $this->load->view('script_registered');
        }
    }
    public function check_username() {
        if($this->user_model->check_username($this->input->post('user_username'))) {
            return true;
        }
        else {
            $this->form_validation->set_message('check_username','This user name is already taken!');
            return false;
        }
    } 
    public function check_email() {
        if($this->user_model->check_email($this->input->post('user_email'))) {
            return true;
        }
        else {
            $this->form_validation->set_message('check_email','This email address is already taken!');
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
                    $this->load->view('script_sent_email');
                }
                else
                {
                	$this->forgot();
                	$this->load->view('script_failed_email');
                }
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
            $data['uid'] = $this->session->userdata('user_id');
            $data['title']= 'Feed';
            $data['notif']  = $this->user_model->get_notification_count($data['uid']);
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

            $data['rec1'] = $this->playlist_model->get_playlists();

            $this->load->view('feed_view', $data);
            $this->load->view('playlist_add_song', $data);
            $this->load->view('player');
        }
    }
    public function admin($tab = 'ban')
    {
        if (($this->session->userdata('logged_in')===FALSE)) 
        {
            $this->index();
        }
        else
        {
        	$data['tab'] = $tab;
            $data['users'] = $this->user_model->get_all_users();
            $data['songs'] = $this->user_model->get_all_songs();
            $data['banlist'] = $this->user_model->get_ban_list();
            $data['bannedlist'] = $this->user_model->get_banned_list();
            $data['deletelist'] = $this->user_model->get_delete_list();
            $data['uid'] = $this->session->userdata('user_id');
            $data['title'] = 'Admin';
            $data['notif']  = $this->user_model->get_notification_count($data['uid']);
            $data['ban'] = $this->load->view('ban_tab',$data,true);
            $data['banned'] = $this->load->view('banned_tab',$data,true);
            $data['delete'] = $this->load->view('delete_tab',$data,true);

            $this->load->view('header_view_user',$data);
            $this->load->view('navbar_admin',$data);
            $this->load->view('admin_view', $data);
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
        $this->admin('ban');
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
        $this->admin('delete');
    }
    public function ban()
    {
        $bool = $this->user_model->ban_list();
        $this->admin('ban');
        if($bool)
            $this->load->view('script_banned');
    }
    public function delete()
    {
        $bool = $this->user_model->delete_list();
        $this->admin('delete');
        if($bool)
            $this->load->view('script_deleted');
    }
    public function add2playlist()
    {
        $added_from = $this->input->post('added_from');
        $data=array(
                'playlist_id'     =>$this->input->post('playlist_id'),
                'audio_id'        =>$this->input->post('audio_id')
                 );
        $this->playlist_model->add2sequence($data); 
        $data=array(
                'playlist_id'     =>$this->input->post('playlist_id'),
                // 'playlist_audio_count' => $this->playlist_model->get_count($this->input->post('playlist_id')),
                'playlist_name'    =>$this->input->post('playlist_name'),
                'audio_id'        =>$this->input->post('audio_id')
                 );
       //  error_reporting(0);
       // (int)$test=(int)$data['playlist_audio_count'];
                
        $this->playlist_model->add2playlist($data);
        $playlist_name=$this->input->post('playlist_name');
        // echo "<script type='text/javascript'>alert('Song has been successfully added to $playlist_name'.);</script>";
        if($added_from === "feed")       
        	$this->feed();
        else
        	$this->profile('personal_info');
        $this->load->view('script_added_to_playlist');
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
        $this->admin('banned');
        $this->load->view('script_unbanned');
    }
    public function ban_reset()
    {
        $this->user_model->ban_reset();
        $this->admin('ban');
    }
    public function delete_reset()
    {
        $this->user_model->delete_reset();
        $this->admin('delete');
    }

    public function profile($tab = 'personal_info')
    {
        if (($this->session->userdata('logged_in')===FALSE)) 
        {
            $this->index();
        }
        else
        {
        	$data['tab'] = $tab;
            $data['rec1'] = $this->playlist_model->get_playlists();
            $data['uid'] = $this->session->userdata('user_id');
            $data['rec'] = $this->user_model->get_user_songs($data['uid']);            
            $data['info'] = $this->user_model->get_info($data['uid']);
            $data['playlists']=$this->playlist_model->get_playlists();
            $data['title'] = 'Profile';
            $data['notif']  = $this->user_model->get_notification_count($data['uid']);
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
            $this->load->view('playlist_add_song', $data);
            $this->load->view('player');
            return $data;
        }
    }

    public function edit_account_info()
    {
        $uid = $this->session->userdata('user_id');
        $user_username = $this->input->post('user_username');       
        $user_email = $this->input->post('user_email');


        
        if($this->edit_account_info_validation())
        {
            //echo "<script type='text/javascript' src='base_url('assets/sweetAlerts/sweet-alert.js')'>swal('Saved!','Changes are saved.','success');</script>";
 
            $this->user_model->user_account_update($uid, $user_username, $user_email);
            

            if($this->input->post('user_password')!='' && $this->input->post('new_user_password')!=''){
                if($this->password_validation()){
                    $user_password = md5($this->input->post('user_password'));
                    $new_user_password = md5($this->input->post('new_user_password'));
                    if($this->user_model->check_password($uid, $user_password)){
                        $this->user_model->change_password2($uid, $new_user_password);
                        $this->profile('account');
                        $this->load->view('script_account_edited');
                    }
                    else{ 
                        $this->profile('account');
                        $this->load->view('script_account_not_edited');  
                    }
                }
                else{
                    $this->profile('account');
                    $this->load->view('script_account_not_edited');                     
                }
            }      
        }
        else
        {
            $this->profile('account');
        	$this->load->view('script_account_not_edited');  
        }        

    }

    public function edit_account_info_validation()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_username', 'User name', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('user_email', 'Email address', 'trim|required|valid_email|');
        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {           
            return true;
        }
    }

    public function password_validation()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('new_user_password', 'Password', 'trim|required|min_length[4]');
        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {           
            return true;
        }
    }       

    public function upload_error($audio_title, $audio_genre)
    {
    $data['uid'] = $this->session->userdata('user_id');
    $data['title']='Upload';
    $data['audio_title']= $audio_title;
    $data['audio_genre']=$audio_genre;
    $data['notif']  = $this->user_model->get_notification_count($data['uid']);
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
    $this->load->view('upload_error_view');
    }

    public function upload()
    {
        if (($this->session->userdata('logged_in')===FALSE)) 
        {
            $this->index();
        }
        else
        {
            $data['uid'] = $this->session->userdata('user_id');
            $data['title']='Upload';
            $data['audio_title']='';
            $data['audio_file']='';
            $data['audio_genre']=''; 
            $data['notif']  = $this->user_model->get_notification_count($data['uid']);       

            $this->load->view('header_view_user',$data);

            if($this->session->userdata('user_type')==='Admin')
            {
                $this->load->view('navbar_admin',$data);
            }
            else
            {
                $this->load->view('navbar_user',$data);
            }

            $this->load->view('upload_view',$data);
        }
    }

    public function addAudio()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('audio_title', 'Song Title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('audio_genre', 'Audio Genre', 'trim|max_length[20]');
        //$this->form_validation->set_rules('audio_file', 'Audio File', 'required');     
        if ($this->form_validation->run() === FALSE) {
            $this->upload();
            $this->load->view('script_not_uploaded');
        } 
        else 
        {

            $audio_title = $this->input->post('audio_title');
            $audio_genre = $this->input->post('audio_genre');
   
            $private = $this->input->post('audio_private');
            if($private == false)
                { $private = 0;}
            else
                { $private = 1;}
            
            

            $data = $this->do_uploadaudio($audio_title, $audio_genre);
            $filename = $data['upload_data']['file_name'];
            
            if($filename != ''){

                $data=array(
                    'user_id'           =>$this->session->userdata('user_id'),
                    'audio_title'       =>$audio_title,
                    'audio_genre'       =>$audio_genre,
                    'audio_private'     =>$private,
                    'audio_date_added'  =>date("Y/m/d"),      
                    'audio_file'        =>$filename,
                );
          
                $this->load->model('audio_model');
                $this->audio_model->add_audio($data); 
                $this->upload();
                $this->load->view('script_uploaded');
            }
        }
    }  

    function do_uploadaudio($audio_title, $audio_genre)
    {   
        $config['upload_path'] = './uploads/mp3';
        $config['allowed_types'] = 'audio/mpeg|mp3|audio/x-wav|audio/x-aiff|application/ogg';
        $config['max_size'] = '50000';
        $config['file_name'] = 'audio';
        $this->load->library('upload', $config);


        if (!$this->upload->do_upload("audio_file"))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->upload_error($audio_title, $audio_genre); 
            $this->load->view('script_not_uploaded');
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            return $data;
        }
    }

    public function do_uploadaphoto()
    {   
        $config['upload_path'] = './uploads/audio_pics';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '3000';
        $config['file_name'] = 'apic';
        //$config['max_width']  = '1024';
        //$config['max_height']  = '1050';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload("audio_photo"))
        {
            $error = array('error' => $this->upload->display_errors());
            //$this->load->view("testerror", $error);
      
        }
        else
        {
            
            $data2 = array('upload_data' => $this->upload->data());
            return $data2;           
        }
    }    

    public function update_personal_info() 
    {
        $this->load->helper('url');
        $id = $this->session->userdata('user_id');
        $getdata = $this->user_model->get_info($id);


        $fname = $this->input->post('user_fname');
        $lname = $this->input->post('user_lname');
        $city = $this->input->post('user_city');
        $country = $this->input->post('user_country');       
        $fb = $this->input->post('user_fb');
        $google = $this->input->post('user_google'); 
        $twitter = $this->input->post('user_twitter');    
        $bio = $this->input->post('user_bio');

        $data = $this->do_uploadphoto();
        $filename = $data['upload_data']['file_name'];
        $picpath = "/uploads/pp/".$filename;

        if($picpath == "/uploads/pp/") {
            $picpath = $getdata['user_photo'];

        }

        $this->user_model->update_personal_info($id, $fname, $lname, $city, $country, $fb, $google, $twitter, $bio, $picpath);

        $this->profile('personal_info');
        $this->load->view('script_account_edited');

    }

    public function updatePhoto()
    {
    	$data['aid'] = $this->input->post('aid');
    	$data['atitle'] = $this->input->post('atitle');

        $data['uid'] = $this->session->userdata('user_id');
        $data['title']="Update audio photo";
        $data['notif']  = $this->user_model->get_notification_count($data['uid']);       

        $this->load->view('header_view_user',$data);

        if($this->session->userdata('user_type')==='Admin')
        {
            $this->load->view('navbar_admin',$data);
        }
        else
        {
            $this->load->view('navbar_user',$data);
        }

    	$this->load->view('update_view',$data);
    }

    public function update_audphoto()
    {
    	$aid = $this->input->post('aid');
    	$atitle = $this->input->post('atitle');
    	$data = $this->do_uploadaphoto();
        $pfilename = $data['upload_data']['file_name'];

        $this->load->model('audio_model');
        $this->audio_model->update_photo($aid,$pfilename); 
        $this->profile('uploaded');
        $this->load->view('script_updated');
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


    public function rename_playlist()
    {
        $this->playlist_model->rename_playlist();
        $this->profile('playlists');
        $this->load->view('script_playlist_renamed');
    }
    public function add_playlist()
    {
        $this->playlist_model->add_playlist();
        $this->profile('playlists');
        $this->load->view('script_playlist_added');
    }
    public function delete_playlist()
    {
        $id=$this->input->post('delete');
        $this->playlist_model->row_delete($id);
        $this->profile('playlists');
        $this->load->view('script_playlist_deleted');
    }
    public function delfrom_playlist()
    {
        $pId=$this->input->post('pId');
        $aId=$this->input->post('aId');
        $this->playlist_model->song_delete($pId,$aId);
        $this->profile('playlists');
        $this->load->view('script_playlist_song_deleted');
    }
    public function playlist()
    {
        $data['playlist_id']=$this->input->post('playlist_id');
        $data['playlist_name']=$this->playlist_model->get_pName($data['playlist_id']);
        $data['uid'] = $this->session->userdata('user_id');
        $data['notif']  = $this->user_model->get_notification_count($data['uid']);
        $data['rec']=$this->playlist_model->fetch_playlist_seq($data['playlist_id']);
        $data['owner']=$this->playlist_model->get_playlist_owner($data['playlist_id']);


        $data['title']= 'Playlist';

            $this->load->view('header_view_user',$data);

            if($this->session->userdata('user_type')==='Admin')
            {
                $this->load->view('navbar_admin',$data);
            }
            else
            {
                $this->load->view('navbar_user',$data);
            }
            $this->load->view('playlist_view', $data);
            $this->load->view('player');
    }

    public function artist_profile()
    {
        
        //echo "<script type='text/javascript'>alert($user_id);</script>";

        if (($this->session->userdata('logged_in')===FALSE)) 
        {
            $this->index();
        }
        else
        {
            $user_id=$this->input->post('uid');
            $my_id = $this->session->userdata('user_id');
            $data['rec'] = $this->user_model->get_artist_songs($user_id); 
            $data['rec1'] = $this->playlist_model->get_playlists();           
            $data['info'] = $this->user_model->get_info($user_id);
            $artistname = $data['info']['user_name'];           
            $data['title'] = $artistname.'\'s Profile' ;  
            $data['notif']  = $this->user_model->get_notification_count($my_id);
            $data['personal_info'] = $this->load->view('artist_personal_info_tab',$data,true);  
            $data['uploaded'] = $this->load->view('artist_uploaded_tab',$data,true);      
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
            if($user_id!=$my_id)
                {
                $this->load->view("artist_profile_view", $data);    
                $this->load->view('playlist_add_song', $data);            
                $this->load->view('player');   
                }
            else{
                redirect('/user/profile/', 'refresh');
                }


            //return $data;
        }
    }

    public function send_collab()
    {
        if($_POST):

    
        /*config email*/    
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
            
            /*Recepient info*/
            $email = $this->input->post('user_email');
            //echo "<script type='text/javascript'>alert('$email');</script>";;

            /*Sender info*/
            $user_email = $this->session->userdata('user_email');
            $user_id = $this->session->userdata('user_id');
            $user_name = $this->session->userdata('user_username');
            
            $data['info'] = $this->user_model->get_info($user_id);             
            $user_fb = $data['info']['user_fb'];
            $user_google = $data['info']['user_google'];
            $user_twitter = $data['info']['user_twitter'];


            /*Construct Message*/
            $subject = 'PlayMix Collaboration from: '.$user_name;
            $message = 'Artist '.$user_name.' thinks you\'re awesome and wants to collaborate with you! You may reach him here: <br><br>
            E-mail address: <br>'.$user_email.'<br> <br>Websites: <br>'.$user_fb.'<br>'.$user_google.'<br>'.$user_twitter;

            //echo $message;
                
            /*Prepare email*/
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from($from); // change it to yours
            $this->email->to($email); // change it to yours
            $this->email->subject($subject);
            $this->email->message($message);
    
                if($this->email->send())
              
                {
                    //echo 'sent to email!';
                    $getid = $this->user_model->get_user_id($email);
                    $uid = $getid['user_id'];
                    $this->user_model->add_notification($uid);
                	// $this->load->view('script_sent_collab');
                 //    return true;
                }          
                else
                {
                	// $this->load->view('script_failed_email');
                 //    return false;
                }
            


        endif;


    }

    public function reset_notif()
    {
        $this->user_model->reset_notif($this->session->userdata('user_id'));
    }

    public function shuffle_songs()
    {
        $count = $this->input->post('count');
        $count -= 2;
        $songs = range(0,$count);
        shuffle($songs);
        $shuffled = "";
        foreach($songs as $num)
        {
            $shuffled = $shuffled.$num;
            $shuffled = $shuffled."%";
        }

        print $shuffled;
    }

    public function increment_play()
    {
    	$id = $this->input->post('sId');
    	
    	$this->user_model->increment_play($id);
    }
}
?>
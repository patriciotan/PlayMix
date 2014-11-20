<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
       
    }

    public function index()
    {
       
            $data['title']= 'Home';
            $this->load->view('header_view',$data);
            $this->admin_area();
            $this->load->view('registration_view_admin');

        
    }

 

    public function login()
    {
        $email=$this->input->post('email');
        $password=md5($this->input->post('pass'));
        $result=$this->admin_model->login($email,$password);
        if ($result) {
            /*show admin panel*/
            $this->admin_panel();  

        } else {
            $this->index();
            $this->login_error();
        }
    }

    public function thank()
    {
        $data['title']= 'Thank you for joining us!';
        $this->load->view('header_view',$data);
        $this->load->view('thank_view_admin.php', $data);
        $this->load->view('footer_view',$data);
    }

    public function registration()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('email_address', 'Your Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

         if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $this->admin_model->add_admin();
            $this->thank();
        }
    }
    
 public function logout()
    {
        $newdata = array(
        'user_id'    =>'',
        'user_name'  =>'',
        'user_email' =>'',
        'user_fname' =>'',
        'user_lname' =>'',
        'user_role'  =>'',
        'logged_in'  =>FALSE,
        );
        $this->session->unset_userdata($newdata );
        $this->session->sess_destroy();
        $this->index();
    }
    
public function sel_role_error()
    {
      $this->load->view('sel_role_error_view');
    }

 public function admin_area()
 {  
    $this->load->view('admin_area_view');
 }   
 public function about()
    { 
      $data['title']= 'Home';          
      $this->load->view('header_view',$data);
      $this->load->view('about_view_admin');
      $this->load->view('footer_view',$data);
    }

    public function about_log()
    { 
      $data['title']= 'Home';          
      $this->load->view('header_view',$data);
      $this->load->view('about_view_admin_log');
      $this->load->view('footer_view',$data);
    }
public function login_error()
    {
      $this->load->view('login_error_view');
    }
public function admin_panel()
    {
    $data['title']= 'Home';          
    $this->load->view('header_view',$data); 
    $this->admin_functions();
    $this->display_sur(); 

    }

public function admin_functions()
    {
      $this->load->view('admin_functions_view');

    }
    public function show_update_prod()
    {
        $data['prod_id']=$this->input->post('prod_id');
        
        $prod_id=$data['prod_id'];

        $this->load->model('product_model');
   
        $data=$this->product_model->fetch_data($prod_id);
          
        $this->load->view('update_prod_view', $data); 

    }
   
    public function delete_prod()
    {
        $prod_id=$this->input->post('prod_id');
        $this->load->model('product_model');
        $this->product_model->row_delete($prod_id);
        $this->admin_panel();   

    }
    public function update_prod($prod_id)
    {
        $this->product_model->row_update($prod_id);
        $this->admin_panel();   
    }
    public function add_prod()
    {
        $data['title']= 'Add Product';
        $this->load->view('header_view',$data);
       // $this->load->view('upload_form', array('error' => ' ' ));
        $this->load->view('add_prod_view');

    }
     function register_prod()
    {
      

        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('prod_name', 'Product Name', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('prod_desc', 'Your Description', 'trim|max_length[300]');
        $this->form_validation->set_rules('prod_stock', 'Stock', 'trim|required|max_length[32]');
        $this->form_validation->set_rules('prod_price', 'Product Price', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->admin_panel();
        } 
        else {
            
            $this->load->model('product_model');
            $this->product_model->add_product();             
            $this->admin_panel();           
        }

            // $this->register_prod();
     
    }

    function do_upload()
    {   
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '800';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $this->input->is_ajax_request();
        $this->load->library('upload', $config);
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name'];

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            $this->upload_error();
      
        }
        else
        {
            // $this->register_prod();
            $data = array('upload_data' => $this->upload->data());
           
        
        }
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('prod_name', 'Product Name', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('prod_desc', 'Your Description', 'trim|max_length[300]');
        $this->form_validation->set_rules('prod_stock', 'Stock', 'trim|required|max_length[32]');
        $this->form_validation->set_rules('prod_price', 'Product Price', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->admin_panel();
        } 
        else {
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $file_name = $upload_data['file_name'];             
            $this->load->model('product_model');
            $this->product_model->add_product($file_name); 
            $prod_name=$this->input->post('prod_name');
            
            $this->fetch_prod_id($prod_name);
            
                       
        }
    }
    public function fetch_prod_id($data)
    {
    $data=$this->product_model->fetch_prod_id($data);
    $this->load->view('show_temp_prod_view', $data); 
    }

    public function fetch_prod_id1($data)
    {
    $data=$this->product_model->fetch_prod_id($data);   
    $prod_id=$data['prod_id'];
    $this->product_model->add_final($prod_id);
    }

   
    public function add_final()
    {
        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('prod_name', 'Product Name', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('prod_desc', 'Your Description', 'trim|max_length[300]');
        $this->form_validation->set_rules('prod_stock', 'Stock', 'trim|required|max_length[32]');
        $this->form_validation->set_rules('prod_price', 'Product Price', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->admin_panel();
        } 
        else {
            
            $this->load->model('product_model');
            $prod_name=$this->input->post('prod_name');
            $this->fetch_prod_id1($prod_name);
            $this->admin_panel();             
        }


    }

    public function upload_error()
    {
        $this->load->view('upload_error_view');
    }
    public function upload_success()
    {
        $this->load->view('upload_succes_view');
        
    }
    public function add_survey()
    {
        $this->load->view('add_survey_view');
    }
    public function reg_survey()
    {

        $this->load->library('form_validation');
        // field name, error message, validation rules
        $this->form_validation->set_rules('sur_title', 'Survey Title', 'trim|required|min_length[4]|xss_clean');
        $this->form_validation->set_rules('sur_purpose', 'Survey Purpose', 'trim|max_length[1000]');
        $this->form_validation->set_rules('sur_source', 'Survey Source', 'trim|required|max_length[500]');
    

        if ($this->form_validation->run() == FALSE) {
            $this->admin_panel();
        } 
        else {
            $this->admin_model->add_survey();           
            $this->admin_panel();
                      
        }

    }
    public function display_sur()
    {
    $data['rec'] = $this->survey_model->get_surveys();
    $this->load->view('surveys_view', $data);
    }
}
?>
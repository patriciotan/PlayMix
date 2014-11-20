<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Feed extends CI_Controller{

	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	$this->load->view('header_view.php');
    	$this->display_feed();
    }

    public function display_feed()
    {
    $data['rec'] = $this->feed_model->get_songs();
    $this->load->view('feed_view', $data);
    }

}
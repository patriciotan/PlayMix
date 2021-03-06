<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class PersonalInfo extends CI_Model {

    public $db;
    private $uid;
    private $fn;
    private $ln;
    private $city;
    private $cntry;
    private $fb;
    private $google;
    private $twitter;
    private $bio;
    private $pic;
    private $is_valid;

    function __construct($newid = FALSE) {
        parent::__construct();
        $this->db = $this->load->database();
        if ($newid) {
            $this->uid = $newid;
            $query = $this->db->query("SELECT * FROM `user` WHERE user_id = '$uid'");
            if ($query->num_rows() > 0) {
                $row = $query->row_array();
                $this->fn = $row['user_fname'];
                $this->ln = $row['user_lname'];
                $this->city = $row['user_city'];
                $this->cntry = $row['user_country'];
                $this->fb = $row['user_fb'];
                $this->google = $row['user_google'];
                $this->twitter = $row['user_twitter'];
                $this->bio = $row['user_bio'];
                $this->pic = $row['user_photo'];
                $this->is_valid = TRUE;
            } else {
                $this->is_valid = FALSE;
            }
        }
    }

    function update_personal_info($uid, $fname, $lname, $city, $cntry, $fb, $google, $twitter, $bio, $pic) {

        
        $data = array(
            'user_fname' => $fn,
            'user_lname' => $ln,
            'user_city' => $city,
            'user_country' => $cntry,
            'user_fb' => $fb,
            'user_google' => $google,
            'user_twitter' => $twitter,
            'user_bio' => $bio,
            'user_photo' => $pic,
        );

        $this->db->select('*', 'user');
        $this->db->where('user_id', $uid);
        $this->db->update('user', $data);
    }
}
?>
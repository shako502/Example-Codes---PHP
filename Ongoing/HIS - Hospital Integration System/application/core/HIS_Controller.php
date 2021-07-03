<?php

class HIS_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('user_session');

        $userdata = $this->session->userdata('logged_in');

        if(isset($userdata)){
            if($userdata['sTime'] < time()-1200){
                if($userdata['remember'] == 'yes'){
                    redirect('UserLogin/logoutWithRemember');
                } else {
                    redirect('UserLogin/logout');
                }
            } else {
                $userdata['sTime'] = time();
                $this->session->set_userdata('logged_in', $userdata);
            }
        }
    }

    public function sidebar_data(){
        return $this->user_session->userInfo();
    }

}

?>
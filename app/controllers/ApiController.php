<?php

namespace App\Controllers;

use Core\Controller as CoreController;

use App\Models\Email;

class ApiController extends CoreController{

    public function index()
    {
        $this->return_json(array('msg' => 'Welcome'));
    }

    public function submit_email()
    {
        $address = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

        if(empty($address) == true)
        {
            $this->return_json(array('status' => false,'msg' => 'email param is missing or not valid email'));    
        }

        $email_model = new Email();
        $email_model->setAddress($address);
        $status = $email_model->save();
        $msg = $status == true ? 'Save successfully' : 'Something went wrong during saving process';
        
        $ret = array(
            'status' => $status,
            'msg' => $msg
        );

        $this->return_json($ret);
    }

}
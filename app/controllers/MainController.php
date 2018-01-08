<?php

namespace App\Controllers;

use Core\Controller as CoreController;
use App\Models\Email as EmailModel;

class MainController extends CoreController{

    public function index()
    {
        $email_list = EmailModel::getAllEmail();        
        $this->render('main/index',array('email_list' => $email_list));
    }

}
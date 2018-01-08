<?php
    $base_url = $this->base_url;

    $this->addCSS('main',$base_url.'/public/css/main.css');
    
    $this->addJS('jquery',"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js");
    $this->addJS('main',$base_url.'/public/js/main.js');
?>
<h1>Challenger from Koodiviidakko</h1>
<form id="collectForm" name="collectForm" method="post" action="<?php echo Core\Application::$instance->makeUrl("/api/submit_email/") ?>">
    <div>        
        <span class="error_msg"></span><br/>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <input type="button" name="saveBtn" id="saveBtn" value="Save" ?>
    </div>
</form>

<h1>Email list</h1>
<table>
 <thead>
  <tr>
     <th>ID</th>
     <th>Address</th>
  </tr>
 </thead>
<tbody>
<?php
    if(empty($this->email_list) == false)
    {   
        foreach($this->email_list as $id => $address)
        {
            echo "<tr><td>{$id}</td><td>{$address}</td></tr>";
        }
    }
    else{
        echo 'List is empty';
    }
?>
</tbody>
</table>
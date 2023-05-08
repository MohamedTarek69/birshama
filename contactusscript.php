<?php
if(isset($_POST['submit'])){
    $new_message=array(
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "message" => $_POST['subject']
    );
    if(filesize("messages.json")==0){
        $first_record = array($new_message);
        $data_to_save = $first_record; 
    }
    else{
        $old_records = json_decode(file_get_contents("messages.json"), true);
        array_push($old_records,$new_message);
        $data_to_save = $old_records;
    }
    if(!file_put_contents("messages.json",json_encode($data_to_save,JSON_PRETTY_PRINT),LOCK_EX)){
        $error = "error storing your message, please try again";
    }
    else{
        $success = "message is stored";
    }
}
?>
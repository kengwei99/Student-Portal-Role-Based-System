<?php 

  function expertToCsv($file)
  {
    

    echo $file; 

    die();
        
    //This should be absolute path of the upload folder where all the images are stored

        $file_path=$_SERVER["DOCUMENT_ROOT"]."/EWSP/uploads/";

        
        $zip = new ZipArchive(); //Call the ZIP constructor

        $zip_file_name=time().".zip"; //create zip filename with current datetime

        if($zip->open($zip_file_name,ZipArchive::CREATE)===true)

        {      

            if(file_exists($file_path.$file))
            {
                $zip->addFile($file_path.stripslashes($file),stripslashes($file));                     
           }                  
        }


        else
        {
            die("There is some error while creating the zip file.");
        }
         
        $zip->close();//close
        if(file_exists($zip_file_name)){            
            //download the zip file
            header('Content-type: application/zip');
            header('Content-Disposition: attachment; filename="'.$zip_file_name.'"');
            readfile($zip_file_name);
            //After download the zip file which is created deleted it
            unlink($zip_file_name);
        }
  }

  function mailToUser($to, $subject,$message)
  {
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <alok@itrsh.com>' . "\r\n";
    $headers .= 'Cc: alok@itrsh.com' . "\r\n";

    $sendMail = mail($to,$subject,$message,$headers);
    if(isset($sendMail))
    {
      return true;
    }
    else {
      return flase;
    }
    
  }

  function messageToUser($message)
  {

  ?>
    <div class="alert alert-warning">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $message;?>
    </div>
  <?php

  }
?>


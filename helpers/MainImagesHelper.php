<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('AdminUsersHelper.php');
require_once('URLHelper.php');

class MainImagesHelper extends BaseHelper
{

    public function __construct()
    {
        parent::__construct();
        $this->urlHelper       = new URLHelper();
    }

    public function Get()
    {
        global $xpdo;

        if (isset($_POST['currID'])) {
            $ID = $_POST['currID'];
            $item = $xpdo->getObject('Home', array('ID' => $ID));
            return json_encode($item->toArray());
        }
    }

    public function Edit()
    {
        global $xpdo;

        date_default_timezone_set('Africa/Cairo');
        $updatedOn      = date("Y-m-d H:i:s");

        $item = $xpdo->getObject('MainImages', array('ID' => $_POST['currID']));

        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']      = $updatedOn;

        if(isset($_FILES['image1']) && $_FILES['image1']['size'] > 0)
        {
         $response = $this->UploadFile($_FILES['image1'],'/../uploads/mainImages/', $x = 1920);
         $response = json_decode($response);

         if($response->res == 0)
         {
              return UtilityHelper::Response('error',$response->message);
         }
         else{
          unlink('../'.$item->get('AboutUs'));
          $fields['AboutUs'] = $response->message;
         }
        }

        if(isset($_FILES['image2']) && $_FILES['image2']['size'] > 0)
        {
         $response = $this->UploadFile($_FILES['image2'],'/../uploads/mainImages/', $x = 1920);
         $response = json_decode($response);

         if($response->res == 0)
         {
              return UtilityHelper::Response('error',$response->message);
         }
         else{
          unlink('../'.$item->get('Members'));
          $fields['Members'] = $response->message;
         }
        }

        if(isset($_FILES['image3']) && $_FILES['image3']['size'] > 0)
        {
         $response = $this->UploadFile($_FILES['image3'],'/../uploads/mainImages/', $x = 1920);
         $response = json_decode($response);

         if($response->res == 0)
         {
              return UtilityHelper::Response('error',$response->message);
         }
         else{
          unlink('../'.$item->get('Awareness'));
          $fields['Awareness'] = $response->message;
         }
        }

        if(isset($_FILES['image4']) && $_FILES['image4']['size'] > 0)
        {
         $response = $this->UploadFile($_FILES['image4'],'/../uploads/mainImages/', $x = 1920);
         $response = json_decode($response);

         if($response->res == 0)
         {
              return UtilityHelper::Response('error',$response->message);
         }
         else{
          unlink('../'.$item->get('Events'));
          $fields['Events'] = $response->message;
         }
        }

        if(isset($_FILES['image5']) && $_FILES['image5']['size'] > 0)
        {
         $response = $this->UploadFile($_FILES['image5'],'/../uploads/mainImages/', $x = 1920);
         $response = json_decode($response);

         if($response->res == 0)
         {
              return UtilityHelper::Response('error',$response->message);
         }
         else{
          unlink('../'.$item->get('Media'));
          $fields['Media'] = $response->message;
         }
        }

        if(isset($_FILES['image6']) && $_FILES['image6']['size'] > 0)
        {
         $response = $this->UploadFile($_FILES['image6'],'/../uploads/mainImages/', $x = 1920);
         $response = json_decode($response);

         if($response->res == 0)
         {
              return UtilityHelper::Response('error',$response->message);
         }
         else{
          unlink('../'.$item->get('News'));
          $fields['News'] = $response->message;
         }
        }

        if(isset($_FILES['image7']) && $_FILES['image7']['size'] > 0)
        {
         $response = $this->UploadFile($_FILES['image7'],'/../uploads/mainImages/', $x = 1920);
         $response = json_decode($response);

         if($response->res == 0)
         {
              return UtilityHelper::Response('error',$response->message);
         }
         else{
          unlink('../'.$item->get('Books'));
          $fields['Books'] = $response->message;
         }
        }

        if(isset($_FILES['image8']) && $_FILES['image8']['size'] > 0)
        {
         $response = $this->UploadFile($_FILES['image8'],'/../uploads/mainImages/', $x = 1920);
         $response = json_decode($response);

         if($response->res == 0)
         {
              return UtilityHelper::Response('error',$response->message);
         }
         else{
          unlink('../'.$item->get('OurWork'));
          $fields['OurWork'] = $response->message;
         }
        }

        if(isset($_FILES['image9']) && $_FILES['image9']['size'] > 0)
        {
         $response = $this->UploadFile($_FILES['image9'],'/../uploads/mainImages/', $x = 1920);
         $response = json_decode($response);

         if($response->res == 0)
         {
              return UtilityHelper::Response('error',$response->message);
         }
         else{
          unlink('../'.$item->get('Questions'));
          $fields['Questions'] = $response->message;
         }
        }

        if(isset($_FILES['image10']) && $_FILES['image10']['size'] > 0)
        {
         $response = $this->UploadFile($_FILES['image10'],'/../uploads/mainImages/', $x = 1920);
         $response = json_decode($response);

         if($response->res == 0)
         {
              return UtilityHelper::Response('error',$response->message);
         }
         else{
          unlink('../'.$item->get('ContactUs'));
          $fields['ContactUs'] = $response->message;
         }
        }

        if(isset($_FILES['image11']) && $_FILES['image11']['size'] > 0)
        {
         $response = $this->UploadFile($_FILES['image11'],'/../uploads/mainImages/', $x = 1920);
         $response = json_decode($response);

         if($response->res == 0)
         {
              return UtilityHelper::Response('error',$response->message);
         }
         else{
          unlink('../'.$item->get('Search'));
          $fields['Search'] = $response->message;
         }
        }

        $item->fromArray($fields);

        return  $item->save();
    }
}

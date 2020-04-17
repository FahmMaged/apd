<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('AdminUsersHelper.php');
require_once('URLHelper.php');

class AboutHelper extends BaseHelper
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
            $item = $xpdo->getObject('AboutUs', array('ID' => $ID));
            return json_encode($item->toArray());
        }
    }

    public function Edit()
    {
        global $xpdo;

        date_default_timezone_set('Africa/Cairo');
        $updatedOn      = date("Y-m-d H:i:s");

        $item = $xpdo->getObject('AboutUs', array('ID' => $_POST['currID']));

        $fields = array(
                      'FirstTitle_en'        => $_POST['first_edit_title_en'],
                      'FirstTitle_ar'        => $_POST['first_edit_title_ar'],
                      'FirstDescription_en'  => $_POST['first_edit_description_en'],
                      'FirstDescription_ar'  => $_POST['first_edit_description_ar'],

                    //   'SecondTitle_en'       => $_POST['second_edit_title_en'],
                    //   'SecondTitle_ar'       => $_POST['second_edit_title_ar'],
                    //   'SecondDescription_en' => $_POST['second_edit_description_en'],
                    //   'SecondDescription_ar' => $_POST['second_edit_description_ar'],

                    //   'ThirdTitle_en'       => $_POST['third_edit_title_en'],
                    //   'ThirdTitle_ar'       => $_POST['third_edit_title_ar'],
                    //   'ThirdDescription_en' => $_POST['third_edit_description_en'],
                    //   'ThirdDescription_ar' => $_POST['third_edit_description_ar'],

                    //   'FourthTitle_en'       => $_POST['fourth_edit_title_en'],
                    //   'FourthTitle_ar'       => $_POST['fourth_edit_title_ar'],
                    //   'FourthDescription_en' => $_POST['fourth_edit_description_en'],
                    //   'FourthDescription_ar' => $_POST['fourth_edit_description_ar'],
                      'UpdatedBy'            => $_SESSION['AdminUser']['Name'],
                      'UpdatedOn'            => $updatedOn
                      );
        if(isset($_FILES['firstPicture']) && $_FILES['firstPicture']['size'] > 0){
             $response = $this->UploadFile($_FILES['firstPicture'],'/../uploads/aboutImages/', $x = 500);
             $response = json_decode($response);

             if($response->res == 0)
             {
              return UtilityHelper::Response('error',$response->message);
             }
             else
               $fields['FirstImage'] = $response->message;
        }

        // if(isset($_FILES['secondPicture']) && $_FILES['secondPicture']['size'] > 0){
        //      $response = $this->UploadFile($_FILES['secondPicture'],'/../uploads/aboutImages/', $x = 500);
        //      $response = json_decode($response);

        //      if($response->res == 0)
        //      {
        //       return UtilityHelper::Response('error',$response->message);
        //      }
        //      else
        //        $fields['SecondImage'] = $response->message;
        // }

        $item->fromArray($fields);

        return  $item->save();
    }

    // Alternatives Functions
    public function GetAlter()
    {
        global $xpdo;

        if (isset($_POST['currID'])) {
            $ID = $_POST['currID'];
            $item = $xpdo->getObject('Alternatives', array('ID' => $ID));
            return json_encode($item->toArray());
        }
    }

    public function EditAlter()
    {
        global $xpdo;

        date_default_timezone_set('Africa/Cairo');
        $updatedOn      = date("Y-m-d H:i:s");

        $item = $xpdo->getObject('Alternatives', array('ID' => $_POST['currID']));

        $fields = array(
                      'FirstTitle_en'        => $_POST['first_edit_title_en'],
                      'FirstTitle_ar'        => $_POST['first_edit_title_ar'],
                      'FirstDescription_en'  => $_POST['first_edit_description_en'],
                      'FirstDescription_ar'  => $_POST['first_edit_description_ar'],

                      'SecondTitle_en'       => $_POST['second_edit_title_en'],
                      'SecondTitle_ar'       => $_POST['second_edit_title_ar'],
                      'SecondDescription_en' => $_POST['second_edit_description_en'],
                      'SecondDescription_ar' => $_POST['second_edit_description_ar'],

                      'ThirdTitle_en'       => $_POST['third_edit_title_en'],
                      'ThirdTitle_ar'       => $_POST['third_edit_title_ar'],
                      'ThirdDescription_en' => $_POST['third_edit_description_en'],
                      'ThirdDescription_ar' => $_POST['third_edit_description_ar'],

                      'FourthTitle_en'       => $_POST['fourth_edit_title_en'],
                      'FourthTitle_ar'       => $_POST['fourth_edit_title_ar'],
                      'FourthDescription_en' => $_POST['fourth_edit_description_en'],
                      'FourthDescription_ar' => $_POST['fourth_edit_description_ar'],
                      'UpdatedBy'            => $_SESSION['AdminUser']['Name'],
                      'UpdatedOn'            => $updatedOn
                      );
        if(isset($_FILES['firstPicture']) && $_FILES['firstPicture']['size'] > 0){
             $response = $this->UploadFile($_FILES['firstPicture'],'/../uploads/aboutImages/', $x = 500);
             $response = json_decode($response);

             if($response->res == 0)
             {
              return UtilityHelper::Response('error',$response->message);
             }
             else
               $fields['FirstImage'] = $response->message;
        }

        if(isset($_FILES['secondPicture']) && $_FILES['secondPicture']['size'] > 0){
             $response = $this->UploadFile($_FILES['secondPicture'],'/../uploads/aboutImages/', $x = 500);
             $response = json_decode($response);

             if($response->res == 0)
             {
              return UtilityHelper::Response('error',$response->message);
             }
             else
               $fields['SecondImage'] = $response->message;
        }

        $item->fromArray($fields);

        return  $item->save();
    }

    // Your Project Functions
    public function GetPage()
    {
        global $xpdo;

        if (isset($_POST['currID'])) {
            $ID = $_POST['currID'];
            $item = $xpdo->getObject('YourProject', array('ID' => $ID));
            return json_encode($item->toArray());
        }
    }

    public function EditPage()
    {
        global $xpdo;

        date_default_timezone_set('Africa/Cairo');
        $updatedOn      = date("Y-m-d H:i:s");

        $item = $xpdo->getObject('YourProject', array('ID' => $_POST['currID']));

        $fields = array(
                        'SecondTitle_en'       => $_POST['second_edit_title_en'],
                        'SecondTitle_ar'       => $_POST['second_edit_title_ar'],
                        'SecondDescription_en' => $_POST['second_edit_description_en'],
                        'SecondDescription_ar' => $_POST['second_edit_description_ar'],
                        'UpdatedBy'            => $_SESSION['AdminUser']['Name'],
                        'UpdatedOn'            => $updatedOn
                        );

        if(isset($_FILES['secondPicture']) && $_FILES['secondPicture']['size'] > 0){
                $response = $this->UploadFile($_FILES['secondPicture'],'/../uploads/aboutImages/', $x = 500);
                $response = json_decode($response);

                if($response->res == 0)
                {
                return UtilityHelper::Response('error',$response->message);
                }
                else
                $fields['SecondImage'] = $response->message;
        }

        $item->fromArray($fields);

        return  $item->save();
    }

    // Members Functions
    public function AddMember()
    {

        global $xpdo;

        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('AboutMembers');
      
        $fields['Title_en']       = $_POST['title_en'];
        $fields['Title_ar']       = $_POST['title_ar'];
        $fields['Sort']           = $_POST['sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedOn']      = $createdOn;

        $item->fromArray($fields);
       
        return $item->save();
    }


    public function GetAllMembers()
    {
        global $xpdo;

          $query = $xpdo->newQuery('AboutMembers');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('AboutMembers', $query);
          $limit = 100;
          $totalpages  = ceil($categoriesCount / $limit);

          if (isset($_POST['currentpage']) && is_numeric($_POST['currentpage'])) {
            $currentpage = (int) $_POST['currentpage'];
          } else {
                  $currentpage = 1;
          }

          if ($currentpage > $totalpages) {
                  $currentpage = $totalpages;
          }

              if ($currentpage < 1) {
                  $currentpage = 1;
          }

          $offset = ($currentpage - 1) * $limit;

          $query->limit($limit, $offset);

          $allObj = $xpdo->getCollection('AboutMembers' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('aboutMemberItem', 'admin/aboutMembers', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title_en'),
                                                'name_ar'        =>  $currObj->Get('Title_ar'),
                                                'currID'         =>  $currObj->Get('ID')
                                            ),'../');
          }
          return $output;
    }

    public function GetMember()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('AboutMembers', array('ID' => $itemID));
        $itemObj = json_encode($item->toArray());
        return $itemObj;
    }

    public function EditMember()
    {
        global $xpdo;
        date_default_timezone_set('Africa/Cairo'); 
        $updatedOn      = date("Y-m-d H:i:s");

        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('AboutMembers', array('ID' => $itemID));
        
        $fields['Title_en']       = $_POST['edit_title_en'];
        $fields['Title_ar']       = $_POST['edit_title_ar'];
        $fields['Sort']           = $_POST['edit_sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']      = $updatedOn;

        $item->fromArray($fields);
        return $item->save();

    }

    public function DeleteMember()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('AboutMembers', array('ID' => $itemID));
        return $item->remove();
    }

    // Parteners Functions
    public function AddPartener()
    {

        global $xpdo;

        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('AboutPartners');
      
        $fields['Title_en']       = $_POST['title_en'];
        $fields['Sort']           = $_POST['sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedOn']      = $createdOn;

        if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0){
             $response = $this->UploadFile($_FILES['picture'],'/../uploads/aboutImages/', $x = 500);
             $response = json_decode($response);

             if($response->res == 0)
             {
              return UtilityHelper::Response('error',$response->message);
             }
             else
               $fields['Image'] = $response->message;
        }

        $item->fromArray($fields);
       
        return $item->save();
    }


    public function GetAllParteners()
    {
        global $xpdo;

          $query = $xpdo->newQuery('AboutPartners');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('AboutPartners', $query);
          $limit = 100;
          $totalpages  = ceil($categoriesCount / $limit);

          if (isset($_POST['currentpage']) && is_numeric($_POST['currentpage'])) {
            $currentpage = (int) $_POST['currentpage'];
          } else {
                  $currentpage = 1;
          }

          if ($currentpage > $totalpages) {
                  $currentpage = $totalpages;
          }

              if ($currentpage < 1) {
                  $currentpage = 1;
          }

          $offset = ($currentpage - 1) * $limit;

          $query->limit($limit, $offset);

          $allObj = $xpdo->getCollection('AboutPartners' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('partener', 'admin/aboutParteners', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title_en'),
                                                'image'          =>  $currObj->Get('Image'),
                                                'currID'         =>  $currObj->Get('ID')
                                            ),'../');
          }
          return $output;
    }

    public function GetPartener()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('AboutPartners', array('ID' => $itemID));
        $itemObj = json_encode($item->toArray());
        return $itemObj;
    }

    public function EditPartener()
    {
        global $xpdo;
        date_default_timezone_set('Africa/Cairo'); 
        $updatedOn      = date("Y-m-d H:i:s");

        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('AboutPartners', array('ID' => $itemID));
        
        $fields['Title_en']       = $_POST['edit_title_en'];
        $fields['Sort']           = $_POST['edit_sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']      = $updatedOn;

        if(isset($_FILES['edit_picture']) && $_FILES['edit_picture']['size'] > 0){
             $response = $this->UploadFile($_FILES['edit_picture'],'/../uploads/aboutImages/', $x = 500);
             $response = json_decode($response);

             if($response->res == 0)
             {
              return UtilityHelper::Response('error',$response->message);
             }
             else{
                if (!empty($item->get('Image'))) {
                      unlink('../'.$item->get('Image'));
                    }
               $fields['Image'] = $response->message;
             }
        }

        $item->fromArray($fields);
        return $item->save();

    }

    public function DeletePartener()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('AboutPartners', array('ID' => $itemID));
        if (!empty($item->get('Image'))) {
          unlink('../'.$item->get('Image'));
        }
        return $item->remove();
    }
}

<?php
if (!isset($_SESSION)) session_start();
require_once('AdminUsersHelper.php');
require_once('PasswordHelper.php');

class MembersHelper extends BaseHelper
{

    public function AddItem()
    {

        global $xpdo;

        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('Members');
        // $xpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($_POST['password'] !== $_POST['confirmPassword'])
        return json_encode(array('saved' => 3 ));

        $checkUserExistence = $xpdo->getCount('Members', array('Email' => $_POST['email']));
        if (!empty($checkUserExistence))
            return json_encode(array('saved' => 2 ));

        $fields['FirstName']     = $_POST['first_name'];
        $fields['LastName']      = $_POST['last_name'];
        $fields['Email']         = $_POST['email'];
        $fields['Phone']         = $_POST['phone'];
        $fields['Bio']           = $_POST['bio'];
        $fields['Password']      = password_hash($_POST['password'], PASSWORD_BCRYPT);;
        $fields['City']          = $_POST['cityName'];
        $fields['LocationID']    = $_POST['locationID'];
        $fields['IsActive']      = 0;
        if(isset($_POST['FacebookLink'])){
            $fields['FacebookLink']  = $_POST['FacebookLink'];
        }
        if(isset($_POST['TwitterLink'])){
            $fields['TwitterLink']   = $_POST['TwitterLink'];
        }
        if(isset($_POST['InstagramLink'])){
            $fields['InstagramLink'] = $_POST['InstagramLink'];
        }
        if(isset($_POST['LinkedinLink'])){
            $fields['LinkedinLink']  = $_POST['LinkedinLink'];
        }
        $fields['CreatedOn']     = $createdOn;

        if(isset($_FILES['image']) && $_FILES['image']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['image'],'/../uploads/members/', $x = 1920);
             $response = json_decode($response);

             if($response->res == 0)
             {
                  return UtilityHelper::Response('error',$response->message);
             }
             else
                 $fields['File'] = $response->message;
        }

        $item->fromArray($fields);
        // return $item->save();
        return json_encode(array('saved' => $item->save() ));
    }

    public function GetItems()
    {
        global $xpdo;

          $query = $xpdo->newQuery('Members');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('Members', $query);
          $limit = 20;
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

          $allObj = $xpdo->getCollection('Members' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('member', 'admin/members', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title_ar'),
                                                'description_en' =>  $currObj->Get('JobTitle_ar'),
                                                'image'          =>  $currObj->Get('Image'),
                                                'currID'         =>  $currObj->Get('ID')
                                            ),'../');
          }
          return $output;
    }

    public function GetItem()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Members', array('ID' => $itemID));
        $itemObj = json_encode($item->toArray());
        return $itemObj;
    }

    public function EditItem()
    {
        global $xpdo;
        date_default_timezone_set('Africa/Cairo'); 
        $updatedOn      = date("Y-m-d H:i:s");

        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Members', array('ID' => $itemID));
        
        $fields['Title_en']       = $_POST['edit_title_en'];
        $fields['JobTitle_en']    = $_POST['edit_job_title_en'];
        $fields['Description_en'] = $_POST['edit_description_en'];
        $fields['Title_ar']       = $_POST['edit_title_ar'];
        $fields['JobTitle_ar']    = $_POST['edit_job_title_ar'];
        $fields['Description_ar'] = $_POST['edit_description_ar'];
        $fields['Sort']           = $_POST['edit_sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']      = $updatedOn;

        if(isset($_FILES['edit_picture']) && $_FILES['edit_picture']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['edit_picture'],'/../uploads/members/', $x = 1920);
             $response = json_decode($response);

             if($response->res == 0)
             {
                  return UtilityHelper::Response('error',$response->message);
             }
             else{
              unlink("../".$item->get('Image'));
              $fields['Image'] = $response->message;
             }
                 
        }
        $item->fromArray($fields);
        return $item->save();

    }

    public function DeleteItem()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Members', array('ID' => $itemID));
        if (!empty($item->get('Image'))) {
          unlink("../".$item->get('Image'));
        }
        
        return $item->remove();
    }
	
}
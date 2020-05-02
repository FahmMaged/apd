<?php
if (!isset($_SESSION)) session_start();
require_once('AdminUsersHelper.php');

class ServicesHelper extends BaseHelper
{
    public function AddItem()
    {

        global $xpdo;

        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('Services');
      
        $fields['Title_en']       = $_POST['title_en'];
        $fields['Description_en'] = $_POST['description_en'];
        $fields['Title_ar']       = $_POST['title_ar'];
        $fields['Description_ar'] = $_POST['description_ar'];
        $fields['Sort']           = $_POST['sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedOn']      = $createdOn;

        if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['picture'],'/../uploads/sliderItems/', $x = 120);
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


    public function GetItems()
    {
        global $xpdo;

          $query = $xpdo->newQuery('Services');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('Services', $query);
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

          $allObj = $xpdo->getCollection('Services' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('servicesItem', 'admin/services', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title_ar'),
                                                'image'        =>  $currObj->Get('Image'),
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
        $item = $xpdo->getObject('Services', array('ID' => $itemID));
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
        $item = $xpdo->getObject('Services', array('ID' => $itemID));
        
        $fields['Title_en']       = $_POST['edit_title_en'];
        $fields['Description_en'] = $_POST['edit_description_en'];
        $fields['Title_ar']       = $_POST['edit_title_ar'];
        $fields['Description_ar'] = $_POST['edit_description_ar'];
        $fields['Sort']           = $_POST['edit_sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']      = $updatedOn;
        
        if(isset($_FILES['edit_picture']) && $_FILES['edit_picture']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['edit_picture'],'/../uploads/sliderItems/', $x = 32);
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

    public function DeleteItem()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Services', array('ID' => $itemID));
        if (!empty($item->get('Image'))) {
          unlink("../".$item->get('Image'));
        }
        return $item->remove();
    }
	
}
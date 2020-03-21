<?php
if (!isset($_SESSION)) session_start();
require_once('AdminUsersHelper.php');

class ImagesHelper extends BaseHelper
{
    public function AddItem()
    {

        global $xpdo;

        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('Images');
      
        $fields['Title_en']       = $_POST['title_en'];
        $fields['Title_ar']       = $_POST['title_ar'];
        $fields['Sort']           = $_POST['sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedOn']      = $createdOn;

        if(isset($_FILES['picture']) && is_numeric($_FILES['picture']['size']) > 0)
        {
             $response = $this->UploadFile($_FILES['picture'],'/../uploads/imagesItems/', $x = 1920);
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

          $query = $xpdo->newQuery('Images');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('Images', $query);
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

          $allObj = $xpdo->getCollection('Images' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('image', 'admin/images', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title_ar'),
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
        $item = $xpdo->getObject('Images', array('ID' => $itemID));
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
        $item = $xpdo->getObject('Images', array('ID' => $itemID));
        
        $fields['Title_en']       = $_POST['edit_title_en'];
        $fields['Title_ar']       = $_POST['edit_title_ar'];
        $fields['Sort']           = $_POST['edit_sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']      = $updatedOn;
        
        if(isset($_FILES['edit_picture']) && $_FILES['edit_picture']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['edit_picture'],'/../uploads/imagesItems/', $x = 1920);
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
        $item = $xpdo->getObject('Images', array('ID' => $itemID));
        if (!empty($item->get('Image'))) {
          unlink("../".$item->get('Image'));
        }
        return $item->remove();
    }

    public function UploadAlbumPhotos()
    {
        global $xpdo;
        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        if (isset($_FILES['qqfile']) && $_FILES['qqfile']['size'] > 0) {
          $response = $this->UploadPhoto($_FILES['qqfile'], '/../uploads/imagesItems/');
          $response = json_decode($response, true);

          if ($response['res'] == 0) {
            return json_encode(array('success' => false));
          } else {
                    $fields['Image']     = $response['message'];
                    $fields['Title_ar']  = $_POST['title_ar'];
                    $fields['Title_en']  = $_POST['title_en'];
                    $fields['CreatedBy'] = $_SESSION['AdminUser']['Name'];
                    $fields['UpdatedBy'] = $_SESSION['AdminUser']['Name'];
                    $fields['CreatedOn'] = $createdOn;

                    $newObj = $xpdo->newObject('Images');
                    $newObj->fromArray($fields);
                    // $newObj->save();
                    // print_r($newObj);
                    // die();

                    if ($newObj->save())
                      return json_encode(array('success' => true));
                    else
                      return json_encode(array('success' => false));
          }
            }
    }

    private function UploadPhoto($file, $directory = '/../uploads/imagesItems/')
    {
        $timestamp = time();
        if (is_uploaded_file($file['tmp_name'])) {
            $handle = new upload($file);
            if ($handle->uploaded) {
                $handle->file_name_body_pre = $timestamp .'-';
                $handle->file_safe_name     = true;
                $handle->allowed            = array('image/*');

                if ($file['type'] != 'image/gif' && $handle->image_src_x > 500) {
                    $handle->image_resize       = true;
                    $handle->image_x            = 500;
                    $handle->image_ratio_y      = true;
                }

                $handle->process(__DIR__ . $directory);

                if ($handle->processed) {
                    $filePath = str_replace('/../', '', $directory);
                    return json_encode(array('res' => 1, 'message' => $filePath . $handle->file_dst_name));
                } else {
                    return json_encode(array('res' => 0, 'message' => 'Photo upload error, please try again.'));
                }
            } else {
                return json_encode(array('res' => 0, 'message' => 'Photo upload error, please try again.'));
            }
        }
    }
	
}
<?php
if (!isset($_SESSION)) session_start();
require_once('AdminUsersHelper.php');
require_once('URLHelper.php');

class SliderHelper extends BaseHelper
{

  public function __construct()
    {
        parent::__construct();
        $this->urlHelper       = new URLHelper();
    }

    public function AddItem()
    {
        

        global $xpdo;
        $xpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('SliderItems');

        $fields['Title_en']       = $_POST['title_en'];
        $fields['Title_ar']       = $_POST['title_ar'];
        $fields['ButtonText_ar']  = $_POST['bText_ar'];
        $fields['ButtonText_en']  = $_POST['bText_en'];
        // $fields['SubTitle_en']    = $_POST['subTitle_en'];
        // $fields['SubTitle_ar']    = $_POST['subTitle_ar'];
        $fields['Sort']           = $_POST['sort'];
        $fields['Link']           = $_POST['link'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['FirstName'];
        $fields['CreatedBy']      = $_SESSION['AdminUser']['FirstName'];
        $fields['CreatedOn']      = $createdOn;

        if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['picture'],'/../uploads/sliderItems/', $x = 1920);
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

    public function AddVideo()
    {

        global $xpdo;

        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");
        $link = '';

        $item = $xpdo->newObject('SliderVideos');
        if (!empty($_POST['link'])) {
          $link = $this->urlHelper->getEmbedURL($_POST['link']);
        }

        $fields['Title']       = $_POST['title'];
        $fields['Link']        = $link;
        $fields['Sort']        = $_POST['sort'];
        $fields['UpdatedBy']   = $_SESSION['AdminUser']['Name'];
        $fields['CreatedBy']   = $_SESSION['AdminUser']['Name'];
        $fields['CreatedOn']   = $createdOn;

        $item->fromArray($fields);
        $item->save();
    }

    public function GetItems()
    {
        global $xpdo;

          $query = $xpdo->newQuery('SliderItems');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('SliderItems', $query);
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

          $allObj = $xpdo->getCollection('SliderItems' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('sliderItem', 'admin/slider', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title_ar'),
                                                'description_en' =>  $currObj->Get('Description_ar'),
                                                'image'          =>  $currObj->Get('Image'),
                                                'currID'         =>  $currObj->Get('ID')
                                            ),'../');
          }
          return $output;
    }

    public function GetVideos()
    {
        global $xpdo;

          $query = $xpdo->newQuery('SliderVideos');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('SliderVideos', $query);
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

          $allObj = $xpdo->getCollection('SliderVideos' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('sliderItem', 'admin/videosSlider', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title'),
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
        $item = $xpdo->getObject('SliderItems', array('ID' => $itemID));
        $itemObj = json_encode($item->toArray());
        return $itemObj;
    }

    public function GetVideo()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('SliderVideos', array('ID' => $itemID));
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
        $item = $xpdo->getObject('SliderItems', array('ID' => $itemID));
        
        $fields['Title_en']       = $_POST['edit_title_en'];
        // $fields['SubTitle_en']    = $_POST['edit_sub_title_en'];
        $fields['ButtonText_ar']  = $_POST['edit_bText_ar'];
        $fields['ButtonText_en']  = $_POST['edit_bText_en'];
        $fields['Title_ar']       = $_POST['edit_title_ar'];
        // $fields['SubTitle_ar']    = $_POST['edit_sub_title_ar'];
        $fields['Sort']           = $_POST['edit_sort'];
        $fields['Link']           = $_POST['edit_link'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['FirstName'];
        $fields['UpdatedOn']      = $updatedOn;

        if(isset($_FILES['edit_picture']) && $_FILES['edit_picture']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['edit_picture'],'/../uploads/sliderItems/', $x = 1920);
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

    public function EditVideo()
    {
        global $xpdo;
        date_default_timezone_set('Africa/Cairo'); 
        $updatedOn      = date("Y-m-d H:i:s");

        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }

        $link = '';

        $item = $xpdo->newObject('SliderVideos');
        $item = $xpdo->getObject('SliderVideos', array('ID' => $itemID));
        if (!empty($_POST['edit_link']) && ($_POST['edit_link'] != $item->get('Link'))) {
          $link = $this->urlHelper->getEmbedURL($_POST['edit_link']);
        } else {
          $link = $item->get('Link');
        }

        $fields['Title']       = $_POST['edit_title'];
        $fields['Link']        = $link;
        $fields['Sort']        = $_POST['edit_sort'];
        $fields['UpdatedBy']   = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']   = $updatedOn;

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
        $item = $xpdo->getObject('SliderItems', array('ID' => $itemID));
        if (!empty($item->get('Image'))) {
          unlink("../".$item->get('Image'));
        }
        
        return $item->remove();
    }

    public function DeleteVideo()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('SliderVideos', array('ID' => $itemID));
        
        return $item->remove();
    }
	
}
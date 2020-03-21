<?php
if (!isset($_SESSION)) session_start();
require_once('AdminUsersHelper.php');
require_once('URLHelper.php');

class VideosHelper extends BaseHelper
{
    public function AddItem()
    {

        global $xpdo;

        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('Videos');
        $urlHelper = new URLHelper();
        $fields['Title_en']       = $_POST['title_en'];
        $fields['Title_ar']       = $_POST['title_ar'];
        $fields['Link']           = $_POST['link'];
        $fields['Sort']           = $_POST['sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedOn']      = $createdOn;

        if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['picture'],'/../uploads/videosItems/', $x = 1920);
             $response = json_decode($response);

             if($response->res == 0)
             {
                  return UtilityHelper::Response('error',$response->message);
             }
             else
                 $fields['Image'] = $response->message;
        } else{
            $image = $urlHelper->getThumbnail($_POST['link']);
            $fields['Image'] = $image;
        }

        $item->fromArray($fields);
       
        return $item->save();
    }


    public function GetItems()
    {
        global $xpdo;

          $query = $xpdo->newQuery('Videos');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('Videos', $query);
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

          $allObj = $xpdo->getCollection('Videos' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('video', 'admin/videos', array(
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
        $item = $xpdo->getObject('Videos', array('ID' => $itemID));
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
        $item = $xpdo->getObject('Videos', array('ID' => $itemID));
        
        $fields['Title_en']       = $_POST['edit_title_en'];
        $fields['Title_ar']       = $_POST['edit_title_ar'];
        $fields['Link']           = $_POST['edit_link'];
        $fields['Sort']           = $_POST['edit_sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']      = $updatedOn;
        
        if(isset($_FILES['edit_picture']) && $_FILES['edit_picture']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['edit_picture'],'/../uploads/videosItems/', $x = 1920);
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
        $item = $xpdo->getObject('Videos', array('ID' => $itemID));
        if (!empty($item->get('Image'))) {
          unlink("../".$item->get('Image'));
        }
        return $item->remove();
    }


    // Front Function

    public function GetMedia()
    {
      global $xpdo;
      $mediaTPL = '';
      $lang       = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';

      $media = $xpdo->query("SELECT ID As id, Title_en AS title_en, Title_ar AS title_ar, Image AS image, Link AS link, 'video' AS type  FROM Videos  UNION ALL SELECT ID As id, Title_en AS title_en, Title_ar AS title_ar, Image AS image, Null AS link, 'image' AS type FROM Images");

      $result = $media->fetchAll(PDO::FETCH_ASSOC);

      if (!empty($result)) {
        foreach ($result as $res) {
          $hide      = '';
          $classType = '';
          $link      = '';
          if ($res['type'] == 'video') {
            $hide      = '';
            $classType = 'mediaVideos';
            $link      = $res['link'];
          }elseif ($res['type'] == 'image') {
            $hide      = 'hidden';
            $classType = 'mediaImages';
            $link      = $res['image'];
          }
          if($classType == 'mediaVideos'){
            $mediaTPL .= new LoadChunk('itemVideo', 'front/media', array(
                'title' => $res['title_'.$lang],
                'image' => $res['image'],
                'link'  => $link,
                'hide'  => $hide,
                'type'  => $classType
                 ), '../');
          } elseif($classType == 'mediaImages'){
            $mediaTPL .= new LoadChunk('itemPic', 'front/media', array(
                'title' => $res['title_'.$lang],
                'image' => $res['image'],
                'link'  => $link,
                'hide'  => $hide,
                'type'  => $classType
                 ), '../');
          }
          
        }
      }
      return $mediaTPL;

    }

    public function GetMedia2()
    {
      global $xpdo;
      $onclickFn  = 'getMedia';
      $mediaTPL   = '';
      $lang       = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
      $langFile   = json_decode(file_get_contents('../lang/books.json'), true);

      $media = $xpdo->query("SELECT ID As id, Title_en AS title_en, Title_ar AS title_ar, Image AS image, Link AS link, 'video' AS type  FROM Videos  UNION ALL SELECT ID As id, Title_en AS title_en, Title_ar AS title_ar, Image AS image, Null AS link, 'image' AS type FROM Images");

      $result    = $media->fetchAll(PDO::FETCH_ASSOC);
      $numrows   = count($result);
      $pagination='';
      $rowsperpage = 18;
      $totalpages  = ceil($numrows / $rowsperpage);

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

      $offset = ($currentpage - 1) * $rowsperpage;

      $media2 = $xpdo->query("SELECT * FROM (SELECT ID As id, Sort AS sort, Title_en AS title_en, Title_ar AS title_ar, Image AS image, Link AS link, 'video' AS type  FROM Videos  UNION ALL SELECT ID As id, Sort AS sort, Title_en AS title_en, Title_ar AS title_ar,
       Image AS image, Null AS link, 'image' AS type FROM Images) dum ORDER BY sort ASC LIMIT $offset,$rowsperpage");
      $result2    = $media2->fetchAll(PDO::FETCH_ASSOC);
      
      if (!empty($result2)) {
        foreach ($result2 as $res) {
          $hide      = '';
          $classType = '';
          $link      = '';
          if ($res['type'] == 'video') {
            $hide      = '';
            $classType = 'mediaVideos';
            $link      = $res['link'];
          }elseif ($res['type'] == 'image') {
            $hide      = 'hidden';
            $classType = 'mediaImages';
            $link      = $res['image'];
          }
          if($classType == 'mediaVideos'){
            $mediaTPL .= new LoadChunk('itemVideo', 'front/media', array(
                'title' => $res['title_'.$lang],
                'image' => $res['image'],
                'link'  => $link,
                'hide'  => $hide,
                'type'  => $classType
                 ), '../');
          } elseif($classType == 'mediaImages'){
            $mediaTPL .= new LoadChunk('itemPic', 'front/media', array(
                'title' => $res['title_'.$lang],
                'image' => $res['image'],
                'link'  => $link,
                'hide'  => $hide,
                'type'  => $classType
                 ), '../');
          }
          
        }
      }
      // Build up the Pagination
      if ($totalpages > 1) {
        $pagination .= '<div class="pagination">';

        if ($currentpage > 1) {
            $pagination .= '<a href="javascript:void(0)" onclick="'.$onclickFn.'(' . ($currentpage - 1) .')"> '. $langFile['previous'][$lang]. '</a>';
        }

        for ($i = 1; $i <= $totalpages; $i++) {
            if ($i <= $currentpage + 3 && $i >= $currentpage - 2) {
                if ($i == $currentpage) {
                    $pagination.= '<a href="javascript:void(0)" class="active">' . $i . '</a>';
                } else {
                    $pagination.= '<a href="javascript:void(0)" onclick="'.$onclickFn.'(' . $i .')">' . $i . '</a>';
                }
            }
        }
        if ($currentpage != $totalpages) {
            $pagination .= '<a href="javascript:void(0)" onclick="'.$onclickFn.'(' . ($currentpage + 1) .')">'. $langFile['next'][$lang]. '</a>';

            // $pagination .= '<li class="waves-effect waves-dark"><a onclick="'.$onclickFn.'(' . $totalpages . ','.$parentID.')">...</a></li>';
        }

        $pagination .= '</div>';
        }
        return json_encode(array('media' => $mediaTPL, 'pagination' => $pagination ));
        

    }
	
}
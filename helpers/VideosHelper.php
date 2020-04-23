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
        $fields['ForMembers']     = $_POST['forMembers'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedOn']      = $createdOn;

        // if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0)
        // {
        //      $response = $this->UploadFile($_FILES['picture'],'/../uploads/videosItems/', $x = 1920);
        //      $response = json_decode($response);

        //      if($response->res == 0)
        //      {
        //           return UtilityHelper::Response('error',$response->message);
        //      }
        //      else
        //          $fields['Image'] = $response->message;
        // } else{
        //     $image = $urlHelper->getThumbnail($_POST['link']);
        //     $fields['Image'] = $image;
        // }

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
                                                // 'image'          =>  $currObj->Get('Image'),
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
        $fields['ForMembers']     = $_POST['edit_forMembers'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']      = $updatedOn;
        
        // if(isset($_FILES['edit_picture']) && $_FILES['edit_picture']['size'] > 0)
        // {
        //      $response = $this->UploadFile($_FILES['edit_picture'],'/../uploads/videosItems/', $x = 1920);
        //      $response = json_decode($response);

        //      if($response->res == 0)
        //      {
        //           return UtilityHelper::Response('error',$response->message);
        //      }
        //      else{
        //         if (!empty($item->get('Image'))) {
        //           unlink('../'.$item->get('Image'));
        //         }
        //         $fields['Image'] = $response->message;
        //      }
                 
        // }

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
        // if (!empty($item->get('Image'))) {
        //   unlink("../".$item->get('Image'));
        // }
        return $item->remove();
    }


    // Front Function

    public function GetAllVideosFront()
    {
      global $xpdo;
      $onclickFn  = 'fnGetVideos';
      $mediaTPL   = '';
      $lang       = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
      $logged     = (isset($_POST['logged'])) ? $_POST['logged'] : 0;

      $query = $xpdo->newQuery('Videos');
      if($logged == 0){
        $query->where(array('ForMembers' => 0));
      }
      $videos = $xpdo->getCollection('Videos', $query);
      $numrows      = count($videos);

      $pagination='';
      $rowsperpage = 9;
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

      $query = $xpdo->newQuery('Videos');
      if($logged == 0){
        $query->where(array('ForMembers' => 0));
      }
      $query->sortby('Sort', 'ASC');
      $query->limit($rowsperpage,$offset);
      $videos = $xpdo->getCollection('Videos', $query);
      
      if (!empty($videos)) {
        foreach ($videos as $video) {
          
          $mediaTPL .= new LoadChunk('videoItem', 'front/videos', array(
            'title' => $video->get('Title_'.$lang),
            // 'image' => $video['image'],
            'link'  => $video->get('Link'),
             ), '../');
          
        }
      }
      // Build up the Pagination
      if ($totalpages > 1) {
        $pagination .= '<ul class="pagination">';

        if ($currentpage > 1) {
            $pagination .= '<li class="waves-effect"><a href="javascript:void(0)" onclick="'.$onclickFn.'(' . ($currentpage - 1) .')"> <i class="fa fa-chevron-right"></i></a></li>';
        }

        for ($i = 1; $i <= $totalpages; $i++) {
            if ($i <= $currentpage + 3 && $i >= $currentpage - 2) {
                if ($i == $currentpage) {
                    $pagination.= '<li class="active"><a href="javascript:void(0)">' . $i . '</a></li>';
                } else {
                    $pagination.= '<li class="waves-effect"><a href="javascript:void(0)" onclick="'.$onclickFn.'(' . $i .')">' . $i . '</a></li>';
                }
            }
        }
        if ($currentpage != $totalpages) {
            $pagination .= '<li class="waves-effect"><a href="javascript:void(0)" onclick="'.$onclickFn.'(' . ($currentpage + 1) .')"><i class="fa fa-chevron-left"></i></a></li>';

            // $pagination .= '<li class="waves-effect waves-dark"><a onclick="'.$onclickFn.'(' . $totalpages . ','.$parentID.')">...</a></li>';
        }

        $pagination .= '</ul>';
     }
        return json_encode(array('output' => $mediaTPL, 'pagination' => $pagination ));
        

    }
	
}
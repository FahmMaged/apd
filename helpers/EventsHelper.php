<?php
if (!isset($_SESSION)) session_start();
require_once('AdminUsersHelper.php');
// require_once('../libs/PHPExcel.php');
require_once('URLHelper.php');

class EventsHelper extends BaseHelper
{
    public function __construct()
    {
        parent::__construct();
        $this->urlHelper       = new URLHelper();
    }

    // Add News
    public function Add() 
    {
      global $xpdo;
      $xpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      date_default_timezone_set('Africa/Cairo'); 
      $createdOn          = date("Y-m-d H:i:s");
      $fields['Alias_en'] = ($_POST['alias_en']!="")? $this->urlHelper->getAliasFormat($_POST['alias_en']) : $this->urlHelper->getAliasFormat($_POST['title_en']);

      $fields['Alias_ar'] = ($_POST['alias_ar']!="")? $this->urlHelper->getAliasFormat($_POST['alias_ar']) : $this->urlHelper->getAliasFormat($_POST['title_ar']);

      if (!empty($_POST['publish_date'])) {
        $publish_date          = $_POST['publish_date'];
      } else{
        date_default_timezone_set('Africa/Cairo');
        $publish_date          = date("Y-m-d");
      }

      $cat_obj = $xpdo->newObject('Events');

      $fields['Title_en']    = $_POST['title_en'];
      $fields['Title_ar']    = $_POST['title_ar'];
      $fields['Time_en']    = $_POST['time_en'];
      $fields['Time_ar']    = $_POST['time_ar'];
      $fields['Location_en']    = $_POST['location_en'];
      $fields['Location_ar']    = $_POST['location_ar'];
      // $fields['StartTime']   = $_POST['start'];
      // $fields['EndTime']     = $_POST['end'];
      $fields['Sort']        = $_POST['sort'];
      // $fields['InHome']      = $_POST['inHome'];
      $fields['IsActive']    = $_POST['isActive'];
      // $fields['LocationID']  = $_POST['locationID'];
      $fields['CreatedOn']   = $createdOn;
      if (!empty($_POST['description_en'])) {
        $fields['Description_en'] = $_POST['description_en'];
      }
      
      if (!empty($_POST['description_ar'])) {
        $fields['Description_ar'] = $_POST['description_ar'];
      }
      
      $fields['PublishDate']   = $publish_date;
      $fields['UpdatedBy']     = $_SESSION['AdminUser']['Name'];
      $fields['CreatedBy']     = $_SESSION['AdminUser']['Name'];

      if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0){
             $response  = $this->UploadFile($_FILES['picture'],'/../uploads/eventsImages/', $x = 500);
             $responseI = $this->UploadFile($_FILES['picture'],'/../uploads/imagesItems/', $x = 800);
             $responseI = json_decode($responseI);
             $response  = json_decode($response);

             if($response->res == 0)
             {
              return UtilityHelper::Response('error',$response->message);
             }
             else
               $fields['Image'] = $response->message;
            // save image to images
            if($responseI->res == 0)
             {
              return UtilityHelper::Response('error',$responseI->message);
             }
             else{
              $item = $xpdo->newObject('Images');
              $fields2['Title_en']   = $_POST['title_en'];
              $fields2['Title_ar']   = $_POST['title_ar'];
              $fields2['UpdatedBy']  = $_SESSION['AdminUser']['Name'];
              $fields2['CreatedBy']  = $_SESSION['AdminUser']['Name'];
              $fields2['CreatedOn']  = $createdOn;
              $fields2['Image']      = $responseI->message;
              $item->fromArray($fields2);
              $item->save();
             }
        }

      $cat_obj->fromArray($fields);
      return $cat_obj->save();

    }

    public function GetAll()
    {
       global $xpdo;

          $query = $xpdo->newQuery('Events');
          $query->sortby('PublishDate', 'DESC');

          $categoriesCount = $xpdo->getCount('Events', $query); 
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

          $allObj = $xpdo->getCollection('Events' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('event_details', 'admin/events', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title_ar'),
                                                'description_en' =>  $currObj->Get('Description_ar'),
                                                'image'          =>  $currObj->Get('Image'),
                                                'currID'         =>  $currObj->Get('ID')
                                            ),'../');
          }
          return $output;
    }

    public function Get()
    {
      global $xpdo;

      if(isset($_POST['itemID'])) {
        $news_id = $_POST['itemID'];

        $news = $xpdo->getObject('Events', array('ID' => $news_id));
        return json_encode($news->toArray());
      }
    }

    public function Edit()
    {
      global $xpdo;
      date_default_timezone_set('Africa/Cairo'); 
      $updatedOn  = date("Y-m-d H:i:s");

      $news = $xpdo->getObject('Events', array('ID' => $_POST['itemID']));

      $fields = array(
                      'Title_en'     => $_POST['edit_title_en'],
                      'Title_ar'     => $_POST['edit_title_ar'],
                      'Time_en'     => $_POST['edit_time_en'],
                      'Time_ar'     => $_POST['edit_time_ar'],
                      'Location_en' => $_POST['edit_location_en'],
                      'Location_ar' => $_POST['edit_location_ar'],
                      'Description_en'  => $_POST['edit_description_en'],
                      'Description_ar'  => $_POST['edit_description_ar'],
                      'PublishDate'  => $_POST['edit_publish_date'],
                      // 'StartTime'    => $_POST['edit_start'],
                      // 'EndTime'      => $_POST['edit_end'],
                      'Sort'         => $_POST['edit_sort'],
                      // 'InHome'       => $_POST['edit_inHome'],
                      'IsActive'     => $_POST['edit_isActive'],
                      // 'LocationID'   => $_POST['edit_locationID'],
                      'UpdatedOn'    => $updatedOn,
                      'Alias_en'     =>($_POST['edit_alias_en']!="")? $this->urlHelper->getAliasFormat($_POST['edit_alias_en']) : $this->urlHelper->getAliasFormat($_POST['edit_title_en']),
                      'Alias_ar'        =>($_POST['edit_alias_ar']!="")? $this->urlHelper->getAliasFormat($_POST['edit_alias_ar']) : $this->urlHelper->getAliasFormat($_POST['edit_title_ar']),
                      'UpdatedBy'    => $_SESSION['AdminUser']['Name']
                      );

      if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0){

             $response = $this->UploadFile($_FILES['picture'],'/../uploads/eventsImages/', $x = 500);
             $response = json_decode($response);

             if($response->res == 0)
             {
              return UtilityHelper::Response('error',$response->message);
             }
             else{
                if (!empty($news->get('Image'))) {
                  unlink('../'.$news->get('Image'));
                }
               $fields['Image'] = $response->message;
             }
        }

      $news->fromArray($fields);

      return  $news->save();
    }

    public function Delete()
    {
      global $xpdo;
      if(isset($_POST['itemID']))
      {
        $events    = $xpdo->getObject('Events', array('ID' => $_POST['itemID']));
        if (!empty($events->get('Image'))) {
          unlink('../'.$events->get('Image'));
        }
        
        return $events->remove();
      }
    }


    public function GetPageContent()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('NewsPage', array('ID' => $itemID));
        $itemObj = json_encode($item->toArray());
        return $itemObj;
    }

    public function EditPageContent()
    {
        global $xpdo;
        date_default_timezone_set('Africa/Cairo'); 
        $updatedOn      = date("Y-m-d H:i:s");

        if (isset($_POST['itemID'])) 
        {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('NewsPage', array('ID' => 1));
        
        $fields['Title']       = $_POST['title'];
        $fields['HeadTitle']   = $_POST['edit_hTitle'];
        $fields['Description'] = $_POST['description'];
        $fields['UpdatedBy']   = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']   = $updatedOn;

        if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['picture'],'/../uploads/eventsImages/', $x = 1920);
             $response = json_decode($response);

             if($response->res == 0)
             {
                  return UtilityHelper::Response('error',$response->message);
             }
             else{
              unlink("../".$item->get('HeadImage'));
              $fields['HeadImage'] = $response->message;
             }
                 
        }
        $item->fromArray($fields);
        return $item->save();
    }

    public function Upload()
    {
        global $xpdo;
        $objReader   = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($_FILES['newsFile']['tmp_name']);
        
        $objPHPExcel->setActiveSheetIndex(0);
        
        $rows = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        
        $rows = array_filter($rows, function ($array) {
            return !strlen(implode($array)) == 0;
        });

        // Remove Header Row
        unset($rows[1]);

        // print_r($rows[1]);
        foreach ($rows as $index => $row) {
          // echo($row['C']);
          
          date_default_timezone_set('Africa/Cairo'); 
          $createdOn          = date("Y-m-d H:i:s");
            if (!empty(addslashes($row['D']))) {
                    $date = DateTime::createFromFormat('m-d-y', $row['D']);
                    $publish_date = $date->format('Y-m-d');

                  } else{
                    date_default_timezone_set('Africa/Cairo');
                    $publish_date          = date("Y-m-d");
                  }

          $description = str_replace('_x000D_', '', $row['C']);
          // echo $description;
          $fields['Title']       = addslashes($row['A']);
          $fields['Alias']       = addslashes($this->urlHelper->getAliasFormat($row['A']));
          $fields['Intro']       = addslashes($row['B']);
          $fields['Description'] = $description;
          $fields['IsActive']    = addslashes($row['E']);
          $fields['Image']       = addslashes($row['F']);
          $fields['PublishDate'] = $publish_date;
          $fields['CreatedOn']   = $createdOn;
          $fields['UpdatedBy']   = $_SESSION['AdminUser']['Name'];
          $fields['CreatedBy']   = $_SESSION['AdminUser']['Name'];
          $obj = $xpdo->newObject('News');
          $obj->fromArray($fields);
          $obj->save();
          // exit();
        }
    }

    public function getAllEventsFront()
    {

      // Arabic months
        $months = array(
          "Jan" => "يناير",
          "Feb" => "فبراير",
          "Mar" => "مارس",
          "Apr" => "أبريل",
          "May" => "مايو",
          "Jun" => "يونيو",
          "Jul" => "يوليو",
          "Aug" => "أغسطس",
          "Sep" => "سبتمبر",
          "Oct" => "أكتوبر",
          "Nov" => "نوفمبر",
          "Dec" => "ديسمبر"
        );

      global $xpdo;
      $lang       = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
      $langFile  = json_decode(file_get_contents('../lang/events.json'), true);
      $eventDate;
      $montheventsTPL = '';
      $eventWithImage = '';
      $eventWithoutImage = '';
      $eventsTPL = '';

      $query = $xpdo->newQuery('Events');
      $query->where(array('IsActive' => 1));
      $query->sortby('PublishDate', 'DESC');
      $events = $xpdo->getCollection('Events', $query);
      
      foreach ($events as $e) {
          
          $day  = date("d", strtotime($e->get('PublishDate')));
          $month  = date("m", strtotime($e->get('PublishDate')));
          $year     = date("Y", strtotime($e->get('PublishDate')));
          
          // $hide = (empty($em->get('StartTime')))? 'hidden' : "";
          $size = strlen($e->get('Description_'.$lang));
          if($size > 100) {
            $description = mb_substr($e->get('Description_'.$lang), 0, 100,'utf-8').' ...';
          } else{
            $description = mb_substr($e->get('Description_'.$lang), 0, 100,'utf-8').' ...';
          }

          $eventsTPL   .= new LoadChunk('eventWithImage', 'front/events', array(
            'id'          => $e->get('ID'),
            'lang'        => $lang,
            'hide'        => $hide,
            'image'       => $e->get('Image'),
            'date'        => $e->get('PublishDate'),
            'time'       => $e->get('Time_'.$lang),
            'location'   => $e->get('Location_'.$lang),
            'title'       => $e->get('Title_'.$lang),
            'alias'       => $e->get('Alias_'.$lang),
            'day'         => $day,
            'month'       => $month,
            'year'        => $year,
            'description' => $description,
            ), '../');

        $montheventsTPL   .= new LoadChunk('monthEvents', 'front/events', array(
                                   'monthName'  => $month,
                                   'eventsTPL'  => $eventsTPL,
                                   'month2'     => $langFile['month2'][$lang],
                                   ), '../');
      }
      return json_encode(array('output' => $this->urlHelper->changeToAlias($eventsTPL)));
    }
	
}
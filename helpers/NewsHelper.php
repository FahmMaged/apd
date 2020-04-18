<?php
if (!isset($_SESSION)) session_start();
require_once('AdminUsersHelper.php');
// require_once('../libs/PHPExcel.php');
require_once('URLHelper.php');

class NewsHelper extends BaseHelper
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

      date_default_timezone_set('Africa/Cairo'); 
      $createdOn          = date("Y-m-d H:i:s");
      // $Title              = $_POST['name'];
      // $Intro              = $_POST['intro'];
      // $Description        = $_POST['description'];
      $fields['Alias_en'] = ($_POST['alias_en']!="")? $this->urlHelper->getAliasFormat($_POST['alias_en']) : $this->urlHelper->getAliasFormat($_POST['title_en']);

      $fields['Alias_ar'] = ($_POST['alias_ar']!="")? $this->urlHelper->getAliasFormat($_POST['alias_ar']) : $this->urlHelper->getAliasFormat($_POST['title_ar']);

      if (!empty($_POST['publish_date'])) {
        $publish_date          = $_POST['publish_date'];
      } else{
        date_default_timezone_set('Africa/Cairo');
        $publish_date          = date("Y-m-d");
      }
      
      $inHome           = $_POST['inHome'];

      $cat_obj = $xpdo->newObject('News');

      $fields['Title_en']    = $_POST['title_en'];
      $fields['Intro_en']    = $_POST['intro_en'];
      $fields['Title_ar']    = $_POST['title_ar'];
      $fields['Intro_ar']    = $_POST['intro_ar'];
      $fields['InHome']      = $inHome;
      $fields['IsActive']    = $_POST['isActive'];
      $fields['ForMembers']  = $_POST['forMembers'];
      $fields['CreatedOn']   = $createdOn;
      if (!empty($_POST['description_en'])) {
        $fields['Description_en'] = $_POST['description_en'];
      }
          
      if (!empty($_POST['description_ar'])) {
        $fields['Description_ar'] = $_POST['description_ar'];
      }

      if (!empty($_POST['sort'])) {
        $fields['Sort'] = $_POST['sort'];
      } else{
        $fields['Sort'] = 1;
      }

      $fields['PublishDate']   = $publish_date;
      $fields['UpdatedBy']     = $_SESSION['AdminUser']['Name'];
      $fields['CreatedBy']     = $_SESSION['AdminUser']['Name'];

      if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0){
             $response = $this->UploadFile($_FILES['picture'],'/../uploads/newsImages/', $x = 500);
            //  $responseI = $this->UploadFile($_FILES['picture'],'/../uploads/imagesItems/', $x = 800);
             $response = json_decode($response);
            //  $responseI = json_decode($responseI);

             if($response->res == 0)
             {
              return UtilityHelper::Response('error',$response->message);
             }
             else
               $fields['Image'] = $response->message;
            // save image to images
            // if($responseI->res == 0)
            //  {
            //   return UtilityHelper::Response('error',$responseI->message);
            //  }
            //  else{
            //   $item = $xpdo->newObject('Images');
            //   $fields2['Title_en']   = $_POST['title_en'];
            //   $fields2['Title_ar']   = $_POST['title_ar'];
            //   $fields2['UpdatedBy']  = $_SESSION['AdminUser']['Name'];
            //   $fields2['CreatedBy']  = $_SESSION['AdminUser']['Name'];
            //   $fields2['CreatedOn']  = $createdOn;
            //   $fields2['Image']      = $responseI->message;
            //   $item->fromArray($fields2);
            //   $item->save();
            //  }  
        } else{
          $fields['Image'] = '/uploads/newsImages/default-news.png';
        }

      $cat_obj->fromArray($fields);
      return $cat_obj->save();

    }

    public function GetAll()
    {
       global $xpdo;

          $query = $xpdo->newQuery('News');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('News', $query); 
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

          $allObj = $xpdo->getCollection('News' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('news_details', 'admin/news', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title_ar'),
                                                'description_en' =>  $currObj->Get('Intro_ar'),
                                                'image'          =>  $currObj->Get('Image'),
                                                'currID'         =>  $currObj->Get('ID')
                                            ),'../');
          }
          return $output;
    }

    public function GetNews()
    {
      global $xpdo;

      if(isset($_POST['itemID'])) {
        $news_id = $_POST['itemID'];

        $news = $xpdo->getObject('News', array('ID' => $news_id));
        return json_encode($news->toArray());
      }
    }

    public function EditNews()
    {
      global $xpdo;
      date_default_timezone_set('Africa/Cairo'); 
      $updatedOn  = date("Y-m-d H:i:s");

      $news = $xpdo->getObject('News', array('ID' => $_POST['itemID']));

      $fields = array(
                      'Title_en'       => $_POST['edit_title_en'],
                      'Intro_en'       => $_POST['edit_intro_en'],
                      'Description_en' => $_POST['edit_description_en'],
                      'Title_ar'       => $_POST['edit_title_ar'],
                      'Intro_ar'       => $_POST['edit_intro_ar'],
                      'Description_ar' => $_POST['edit_description_ar'],
                      'PublishDate'    => $_POST['edit_publish_date'],
                      'InHome'         => $_POST['edit_inHome'],
                      'IsActive'       => $_POST['edit_isActive'],
                      'ForMembers'     => $_POST['edit_forMembers'],
                      'Sort'           => $_POST['edit_sort'],
                      'UpdatedOn'      => $updatedOn,
                      'Alias_en'       =>($_POST['edit_alias_en']!="")? $this->urlHelper->getAliasFormat($_POST['edit_alias_en']) : $this->urlHelper->getAliasFormat($_POST['edit_title_en']),
                      'Alias_ar'       =>($_POST['edit_alias_ar']!="")? $this->urlHelper->getAliasFormat($_POST['edit_alias_ar']) : $this->urlHelper->getAliasFormat($_POST['edit_title_ar']),
                      'UpdatedBy'    => $_SESSION['AdminUser']['Name']
                      );

      if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0){
        
             $response = $this->UploadFile($_FILES['picture'],'/../uploads/newsImages/', $x = 500);
             $response = json_decode($response);

             if($response->res == 0)
             {
              return UtilityHelper::Response('error',$response->message);
             }
             else{
                if (!empty($news->get('Image')) && $news->get('Image') != '/uploads/newsImages/default-news.png') {
                  unlink('../'.$news->get('Image'));
                }
               $fields['Image'] = $response->message;
             }
        }

      $news->fromArray($fields);

      return  $news->save();
    }

    public function DeleteNews()
    {
      global $xpdo;
      if(isset($_POST['itemID']))
      {
        $news    = $xpdo->getObject('News', array('ID' => $_POST['itemID']));
        if( $news->get('Image') != '/uploads/newsImages/default-news.png'){
          unlink('../'.$news->get('Image'));
        }
        return $news->remove();
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
        // $itemObj = json_encode($item->toArray());
        return $item;
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
             $response = $this->UploadFile($_FILES['picture'],'/../uploads/newsImages/', $x = 1920);
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


    // Front Functions
    public function GetAllNewsFront()
    {
      global $xpdo;
      date_default_timezone_set('Africa/Cairo');
      $currentDate = date("Y-m-d");
      $onclickFn   = 'fnGetNews';
      $newsChunk   = '';
      $lang        = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
      $logged     = (isset($_POST['logged'])) ? $_POST['logged'] : 0;
      $langFile  = json_decode(file_get_contents('../lang/home.json'), true);

      // $news = $xpdo->getCollection('News');
      
      $query = $xpdo->newQuery('News');
      if($logged == 0){
        $query->where(array('ForMembers' => 0));
      }
      $query->where(array(
        'IsActive'       => 1,
        'PublishDate:<=' => $currentDate
      ));
      $news = $xpdo->getCollection('News', $query);
      $numrows      = count($news);

      $pagination='';
      $rowsperpage = 2;
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

      $query = $xpdo->newQuery('News');
      if($logged == 0){
        $query->where(array('ForMembers' => 0));
      }
      $query->where(array(
        'IsActive'       => 1,
        'PublishDate:<=' => $currentDate
      ));
      // $query->sortby('Sort', 'ASC');
      $query->sortby('PublishDate', 'DESC');
      $query->limit($rowsperpage,$offset);
      $allNews = $xpdo->getCollection('News', $query);
      if ($allNews) {
        foreach($allNews as $news)
        {
          $size = strlen($news->get('Title_'.$lang));
          if($size > 50) {
            $title = mb_substr($news->get('Title_'.$lang), 0, 50,'utf-8').' ...';
          } else{
            $title = mb_substr($news->get('Title_'.$lang), 0, 50,'utf-8');
          }

          $size = strlen($news->get('Intro_'.$lang));
          if($size > 100) {
            $description = mb_substr($news->get('Intro_'.$lang), 0, 100,'utf-8').' ...';
          } else{
            $description = mb_substr($news->get('Intro_'.$lang), 0, 100,'utf-8');
          }

          $newsChunk .=  new LoadChunk('newsItem','front/news',array(
                                                                    // 'title'  =>  $news->get('Title_'.$lang),
                                                                    'title'  =>  $title,
                                                                    'readMore'    => $langFile['readMore'][$lang],
                                                                    'description'  =>  $description,
                                                                    'alias'  =>  $news->get('Alias_'.$lang),
                                                                    'image'  =>  $news->get('Image'),
                                                                    'id'     =>  $news->get('ID'),
                                                                    'lang'   =>  $lang,
                                                                    'publishDate' => $news->get('PublishDate')
                                                            ),'../');

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

      return json_encode(array('output' => $this->urlHelper->changeToAlias($newsChunk), 'pagination' => $this->urlHelper->changeToAlias($pagination) ));

    }
	
}
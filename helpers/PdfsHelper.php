<?php
if (!isset($_SESSION)) session_start();
require_once('AdminUsersHelper.php');
require_once('URLHelper.php');

class PdfsHelper extends BaseHelper
{
    public function AddItem()
    {

        global $xpdo;

        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('Pdfs');
        $urlHelper = new URLHelper();
        $fields['Title_en']       = $_POST['title_en'];
        $fields['Title_ar']       = $_POST['title_ar'];
        $fields['ForMembers']     = $_POST['forMembers'];
        $fields['Sort']           = $_POST['sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedOn']      = $createdOn;

        if(isset($_FILES['pdfFile']) && $_FILES['pdfFile']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['pdfFile'],'/../uploads/pdfsItems/', $x = 1920);
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

          $query = $xpdo->newQuery('Pdfs');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('Pdfs', $query);
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

          $allObj = $xpdo->getCollection('Pdfs' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('pdf', 'admin/pdfs', array(
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
        $item = $xpdo->getObject('Pdfs', array('ID' => $itemID));
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
        $item = $xpdo->getObject('Pdfs', array('ID' => $itemID));
        
        $fields['Title_en']       = $_POST['edit_title_en'];
        $fields['Title_ar']       = $_POST['edit_title_ar'];
        $fields['ForMembers']     = $_POST['edit_forMembers'];
        $fields['Sort']           = $_POST['edit_sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']      = $updatedOn;
        
        if(isset($_FILES['edit_pdfFile']) && $_FILES['edit_pdfFile']['size'] > 0)
        {
             $response = $this->UploadFile($_FILES['edit_pdfFile'],'/../uploads/pdfsItems/', $x = 1920);
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
        $item = $xpdo->getObject('Pdfs', array('ID' => $itemID));
        if (!empty($item->get('Image'))) {
          unlink("../".$item->get('Image'));
        }
        return $item->remove();
    }


    // Front Function

    public function GetAllPdfsFront()
    {
      global $xpdo;
      $onclickFn  = 'fnGetPdfs';
      $mediaTPL   = '';
      $lang       = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
      $langFile   = json_decode(file_get_contents('../lang/books.json'), true);

      $pdfs = $xpdo->getCollection('Pdfs');
      $numrows      = count($pdfs);


      $pagination='';
      $rowsperpage = 1;
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

      $query = $xpdo->newQuery('Pdfs');

      // $query->sortby('Sort', 'ASC');
      $query->sortby('Sort', 'ASC');
      $query->limit($rowsperpage,$offset);
      $pdfs = $xpdo->getCollection('Pdfs', $query);
      
      if (!empty($pdfs)) {
        foreach ($pdfs as $pdf) {
        
          $mediaTPL .= new LoadChunk('pdf', 'front/pdfs', array(
            'title' => $pdf->get('Title_'.$lang),
            // 'image' => $pdf['image'],
            'file'  => $pdf->get('Image'),
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
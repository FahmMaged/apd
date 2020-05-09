<?php
if (!isset($_SESSION)) session_start();
require_once('AdminUsersHelper.php');

class EventCategoriesHelper extends BaseHelper
{

    public function AddItem()
    {

        global $xpdo;

        $item = $xpdo->newObject('EventCategories');

        $fields['Title_en']  = $_POST['Title_en'];
        $fields['Title_ar']  = $_POST['Title_ar'];
        $fields['Sort']     = $_POST['sort'];

        $item->fromArray($fields);
        return $item->save();
    }

    public function GetItems()
    {
        global $xpdo;

          $query = $xpdo->newQuery('EventCategories');
          $query->sortby('Sort', 'ASC');

        //   $categoriesCount = $xpdo->getCount('EventCategories', $query);
        //   $limit = 20;
        //   $totalpages  = ceil($categoriesCount / $limit);

        //   if (isset($_POST['currentpage']) && is_numeric($_POST['currentpage'])) {
        //     $currentpage = (int) $_POST['currentpage'];
        //   } else {
        //           $currentpage = 1;
        //   }

        //   if ($currentpage > $totalpages) {
        //           $currentpage = $totalpages;
        //   }

        //       if ($currentpage < 1) {
        //           $currentpage = 1;
        //   }

        //   $offset = ($currentpage - 1) * $limit;

        //   $query->limit($limit, $offset);

          $allObj = $xpdo->getCollection('EventCategories' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }
          else{
            foreach($allObj as $currObj)
            {
                $output .= new LoadChunk('date', 'admin/eventCategories', array(
                                                    // 'totalPages'     =>  $totalpages,
                                                    'Title_en'  =>  $currObj->Get('Title_en'),
                                                    'Title_ar'  =>  $currObj->Get('Title_ar'),
                                                    'sort'     =>  $currObj->Get('Sort'),
                                                    'currID'   =>  $currObj->Get('ID')
                                                ),'../');
            }
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
        $item = $xpdo->getObject('EventCategories', array('ID' => $itemID));
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
        $item = $xpdo->getObject('EventCategories', array('ID' => $itemID));
        
        $fields['Title_en']  = $_POST['edit_Title_en'];
        $fields['Title_ar']  = $_POST['edit_Title_ar'];
        $fields['Sort']     = $_POST['edit_sort'];

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
        $item = $xpdo->getObject('EventCategories', array('ID' => $itemID));
        
        return $item->remove();
    }
	
}
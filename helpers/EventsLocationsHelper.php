<?php
if (!isset($_SESSION)) session_start();
require_once('AdminUsersHelper.php');

class EventsLocationsHelper extends BaseHelper
{
    public function AddItem()
    {

        global $xpdo;
        date_default_timezone_set('Africa/Cairo'); 
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('EventsLocations');
      
        $fields['Title_ar']    = $_POST['title_ar'];
        $fields['Title_en']    = $_POST['title_en'];
        $fields['Sort']        = $_POST['sort'];
        $fields['UpdatedBy']   = $_SESSION['AdminUser']['Name'];
        $fields['CreatedBy']   = $_SESSION['AdminUser']['Name'];
        $fields['CreatedOn']   = $createdOn;
        $fields['UpdatedOn']   = $createdOn;

        $item->fromArray($fields);
       
        return $item->save();
    }


    public function GetItems()
    {
        global $xpdo;

          $query = $xpdo->newQuery('EventsLocations');
          $query->sortby('CreatedOn', 'DESC');

          $categoriesCount = $xpdo->getCount('EventsLocations', $query);
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

          $allObj = $xpdo->getCollection('EventsLocations' ,$query);

          $output = '';

          if (empty($allObj)) {
              $output .= new LoadChunk('no-data','admin/master', array(), '../');
          }

          foreach($allObj as $currObj)
          {
              $output .= new LoadChunk('location', 'admin/eventsLocations', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title_ar'),
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
        $item = $xpdo->getObject('EventsLocations', array('ID' => $itemID));
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
        $item = $xpdo->getObject('EventsLocations', array('ID' => $itemID));
        
        $fields['Title_ar']    = $_POST['edit_title_ar'];
        $fields['Title_en']    = $_POST['edit_title_en'];
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
        $item = $xpdo->getObject('EventsLocations', array('ID' => $itemID));
        return $item->remove();
    }
	
}
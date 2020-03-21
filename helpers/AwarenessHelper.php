<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('AdminUsersHelper.php');
require_once('URLHelper.php');

class AwarenessHelper extends BaseHelper
{
    public function __construct()
    {
        parent::__construct();
        $this->urlHelper       = new URLHelper();
    }

    public function AddItem()
    {
        global $xpdo;

        date_default_timezone_set('Africa/Cairo');
        $createdOn      = date("Y-m-d H:i:s");

        $item = $xpdo->newObject('Awareness');
        $xpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fields['PageID']         = $_POST['pageID'];
        $fields['Title_en']       = $_POST['title_en'];
        $fields['Title_ar']       = $_POST['title_ar'];
        $fields['Description_en'] = $_POST['description_en'];
        $fields['Description_ar'] = $_POST['description_ar'];
        $fields['Sort']           = $_POST['sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['CreatedOn']      = $createdOn;
        // Upload Image
        if (isset($_FILES['picture']) && $_FILES['picture']['size'] > 0) {
            $response = $this->UploadFile($_FILES['picture'], '/../uploads/awarenessItems/', $x = 1920);
            $response = json_decode($response);

            if ($response->res == 0) {
                return UtilityHelper::Response('error', $response->message);
            } else {
                $fields['Image'] = $response->message;
            }
        }
        // Upload File
        if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
            $response = $this->UploadFile($_FILES['file'], '/../uploads/awarenessItems/', $x = 1920);
            $response = json_decode($response);

            if ($response->res == 0) {
                return UtilityHelper::Response('error', $response->message);
            } else {
                $fields['File'] = $response->message;
            }
        }

        $item->fromArray($fields);
        return $item->save();
    }

    public function GetItems()
    {
        global $xpdo;

        $query = $xpdo->newQuery('Awareness');
        $query->sortby('CreatedOn', 'DESC');

        $categoriesCount = $xpdo->getCount('Awareness', $query);
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

        $allObj = $xpdo->getCollection('Awareness', $query);

        $output = '';

        if (empty($allObj)) {
            $output .= new LoadChunk('no-data', 'admin/master', array(), '../');
        }

        foreach ($allObj as $currObj) {
            $output .= new LoadChunk('item', 'admin/awareness', array(
                                                'totalPages'     =>  $totalpages,
                                                'name_en'        =>  $currObj->Get('Title_ar'),
                                                'description_en' =>  $currObj->Get('Description_ar'),
                                                'currID'         =>  $currObj->Get('ID')
                                            ), '../');
        }
        return $output;
    }

    public function GetItem()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Awareness', array('ID' => $itemID));
        $itemObj = json_encode($item->toArray());
        return $itemObj;
    }

    public function EditItem()
    {
        global $xpdo;
        date_default_timezone_set('Africa/Cairo');
        $updatedOn      = date("Y-m-d H:i:s");

        if (isset($_POST['itemID'])) {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Awareness', array('ID' => $itemID));

        $fields['PageID']         = $_POST['edit_page'];
        $fields['Title_en']       = $_POST['edit_title_en'];
        $fields['Description_en'] = $_POST['edit_description_en'];
        $fields['Title_ar']       = $_POST['edit_title_ar'];
        $fields['Description_ar'] = $_POST['edit_description_ar'];
        $fields['Sort']           = $_POST['edit_sort'];
        $fields['UpdatedBy']      = $_SESSION['AdminUser']['Name'];
        $fields['UpdatedOn']      = $updatedOn;

        // Upload Image
        if (isset($_FILES['edit_picture']) && $_FILES['edit_picture']['size'] > 0) {
            $response = $this->UploadFile($_FILES['edit_picture'], '/../uploads/awarenessItems/', $x = 1920);
            $response = json_decode($response);

            if ($response->res == 0) {
                return UtilityHelper::Response('error', $response->message);
            } else {
                if (!empty($item->get('Image'))) {
                    unlink("../".$item->get('Image'));
                }
                $fields['Image'] = $response->message;
            }
        }
        // Upload File
        if (isset($_FILES['edit_file']) && $_FILES['edit_file']['size'] > 0) {
            $response = $this->UploadFile($_FILES['edit_file'], '/../uploads/awarenessItems/', $x = 1920);
            $response = json_decode($response);

            if ($response->res == 0) {
                return UtilityHelper::Response('error', $response->message);
            } else {
                if (!empty($item->get('File'))) {
                    unlink("../".$item->get('File'));
                }
                $fields['File'] = $response->message;
            }
        }

        $item->fromArray($fields);
        return $item->save();
    }
    public function UploadFiles()
    {
        global $xpdo;
        date_default_timezone_set('Africa/Cairo');
        $createdOn      = date("Y-m-d H:i:s");

        if (isset($_FILES['qqfile']) && $_FILES['qqfile']['size'] > 0) {
            $response = $this->UploadFile($_FILES['qqfile'], '/../uploads/files/', $x = 1920);
            $response = json_decode($response, true);

            if ($response['res'] == 0) {
                return json_encode(array('success' => false));
            } else {
                $fields['File']     = $response['message'];
                $fields['Title']  = $_POST['title'];
                $fields['AwarenessID']  = $_POST['itemID'];
                $fields['CreatedBy'] = $_SESSION['AdminUser']['Name'];
                $fields['UpdatedBy'] = $_SESSION['AdminUser']['Name'];
                $fields['CreatedOn'] = $createdOn;

                $newObj = $xpdo->newObject('Files');
                $newObj->fromArray($fields);
                // $newObj->save();
                // print_r($newObj);
                // die();

                if ($newObj->save()) {
                    return json_encode(array('success' => true));
                } else {
                    return json_encode(array('success' => false));
                }
            }
        }
    }

    public function GetItemfiles()
    {
        global $xpdo;

        if (!isset($_POST['currID']) || empty($_POST['currID'])) {
			return json_encode(array('res' => 0, 'message' => 'ID is missing.'));
        }
        $filesQuery = $xpdo->newQuery('Files');
        $filesQuery->where(array('AwarenessID'=>$_POST['currID']));
        $filesQuery->sortby('Title','ASC');		
        $files = $xpdo->getCollection('Files',$filesQuery);
       // $files = $xpdo->getCollection('files', array('AlbumID' => $_POST['currID']));

        if (empty($files)) {
            return json_encode(array('res' => 0, 'message' => 'No files exist.'));
        }

        $filesChunk = '';

        foreach ($files as $file) {
            $filesChunk .= new LoadChunk('fileItem', 'admin/awareness', array(
                                                                    'path'       =>	$file->get('File'),
                                                                    'title'      => $file->get('Title'),
                                                                    'fileID'    =>	$file->get('ID')
                                                                ), '../');
        }

        return json_encode(array('res' => 1, 'message' => $filesChunk));
    }

    public function DeleteItem()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Awareness', array('ID' => $itemID));
        if (!empty($item->get('File'))) {
            unlink("../".$item->get('File'));
        }
        if (!empty($item->get('Image'))) {
            unlink("../".$item->get('Image'));
        }
        return $item->remove();
    }

    public function DeleteFile()
    {
        global $xpdo;
        if (isset($_POST['itemID'])) {
            $itemID = $_POST['itemID'];
        }
        $item = $xpdo->getObject('Files', array('ID' => $itemID));
        if (!empty($item->get('File'))) {
            unlink("../".$item->get('File'));
        }
        return $item->remove();
    }
}

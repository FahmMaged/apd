<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('AdminUsersHelper.php');

class MetaTagsHelper extends BaseHelper
{
    public function Get()
    {
        global $xpdo;

        if (isset($_POST['currID'])) {
            $ID = $_POST['currID'];

            $item = $xpdo->getObject('MetaTags', array('ID' => $ID));
            return json_encode($item->toArray());
        }
    }

    public function Edit()
    {
        global $xpdo;

        date_default_timezone_set('Africa/Cairo');
        $updatedOn      = date("Y-m-d H:i:s");
        $abotItem = $xpdo->getObject('MetaTags', array('id' => 1));

        echo( $_POST['AboutDescription']);
        exit;

            $fields = array(
                'AboutTitle_en'           => $_POST['AboutTitle'],
                'AboutDescription_en'     => $_POST['AboutDescription'],
                'AboutTitle_ar'           => $_POST['AboutTitle_ar'],
                'AboutDescription_ar'     => $_POST['AboutDescription_ar'],

                'HomeTitle_en'            => $_POST['HomeTitle'],
                'HomeDescription_en'      => $_POST['HomeDescription'],
                'HomeTitle_ar'            => $_POST['HomeTitle_ar'],
                'HomeDescription_ar'      => $_POST['HomeDescription_ar'],

                'FacilitiesTitle_en'        => $_POST['FacilitiesTitle'],
                'FacilitiesDescription_en'  => $_POST['FacilitiesDescription'],
                'FacilitiesTitle_ar'        => $_POST['FacilitiesTitle_ar'],
                'FacilitiesDescription_ar'  => $_POST['FacilitiesDescription_ar'],

                'NewsTitle_en'            => $_POST['NewsTitle'],
                'NewsDescription_en'      => $_POST['NewsDescription'],
                'NewsTitle_ar'            => $_POST['NewsTitle_ar'],
                'NewsDescription_ar'      => $_POST['NewsDescription_ar'],

                'GalleryTitle_en'       => $_POST['GalleryTitle'],
                'GalleryDescription_en' => $_POST['GalleryDescription'],
                'GalleryTitle_ar'       => $_POST['GalleryTitle_ar'],
                'GalleryDescription_ar' => $_POST['GalleryDescription_ar'],

                'ContactTitle_en'          => $_POST['ContactTitle'],
                'ContactDescription_en'    => $_POST['ContactDescription'],
                'ContactTitle_ar'          => $_POST['ContactTitle_ar'],
                'ContactDescription_ar'    => $_POST['ContactDescription_ar'],
                

                'UpdatedBy'        => $_SESSION['AdminUser']['FirstName'],
                'UpdatedOn'        => $updatedOn
                );
            $abotItem->fromArray($fields);
            $abotItem->save();
        
    }
}

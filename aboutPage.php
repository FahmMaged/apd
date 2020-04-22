<?php
require_once('helpers/LoadChunk.php');
require_once('helpers/PageLoadHelper.php');
require_once('helpers/AdminUsersHelper.php');

global $xpdo;
$itemsTPL = '';
$id       = $_GET['id'];
$langFile  = json_decode(file_get_contents('lang/awareness.json'), true);
$langFile2  = json_decode(file_get_contents('lang/main.json'), true);

if ($id == 1) {
    $title = $langFile2['page1'][$lang];
} elseif ($id == 2) {
    $title = $langFile2['page2'][$lang];
} elseif ($id == 3) {
    $title = $langFile2['page3'][$lang];
}
// Head Chunk
$head        = new LoadChunk('head', 'front/master', array(
                                                           'pageTitle' => $title,
                                                           'baseUrl'   => $server,
                                                           'ogImage'   => $ogImage,
                                                           'enLink'    => $enLink
                                                           ), '');

// Questions
$x = 0;
$query = $xpdo->newQuery('Awareness');
$query->where(array('PageID' => $id));
$query->sortby('Sort', 'ASC');
$awareness = $xpdo->getCollection('Awareness', $query);
if (!empty($awareness)) {
    foreach ($awareness as $a) {
            $itemsTPL   .= new LoadChunk('item', 'front/awareness', array(
                                                        'active'       => $active,
                                                        'title'        => $a->get('Title_'.$lang),
                                                        'image'        => $a->get('Image'),
                                                        'description'  => $a->get('Description_'.$lang),
                                                        ), '');
    }
} else {
    $itemsTPL   .= new LoadChunk('no-data', 'front/master', array('noData' => $noData), '');
}
    


$output = new LoadChunk('awareness', 'front/awareness', array(
                                                       'head'               => $head,
                                                       'header'             => $header,
                                                       'itemsTPL'           => $itemsTPL,
                                                       'footer'             => $footer,
                                                       'headerTitle'        => $title,
                                                       'mainImage'          => $mainImage->get('Awareness'),
                                                       
                                                   ), '');
$output = $urlHelper->changeToAlias($output);
echo $output;

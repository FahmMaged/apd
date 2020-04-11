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
    $title = $langFile2['awarness'][$lang];
} elseif ($id == 2) {
    $title = $langFile2['abilities'][$lang];
} elseif ($id == 3) {
    $title = $langFile2['protection'][$lang];
} elseif ($id == 4) {
    $title = $langFile2['cooperation'][$lang];
} elseif ($id == 5) {
    $title = $langFile2['legislative'][$lang];
} elseif ($id == 6) {
    $title = $langFile2['strategies'][$lang];
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
        $filesTPL = '';
        $files = $xpdo->getCollection('Files', array('AwarenessID'=>$a->get('ID')));
        if ($files) {
            foreach ($files as $f) {
                $filesTPL   .= new LoadChunk('file', 'front/awareness', array(
                                                    'file'         => $f->get('File'),
                                                    'Title'         => $f->get('Title'),
                                                    'download'     => $langFile['download'][$lang]
                                                    ), '');
            }
        }
        if ($x == 0) {
            $active = 'active';
            $itemsTPL   .= new LoadChunk('item', 'front/awareness', array(
                                                        'active'       => $active,
                                                        'title'        => $a->get('Title_'.$lang),
                                                        'image'        => $a->get('Image'),
                                                        'files'         => $filesTPL,
                                                        'description'  => $a->get('Description_'.$lang),
                                                        ), '');
            $x++;
        } else {
            $active = '';
            $itemsTPL   .= new LoadChunk('item', 'front/awareness', array(
                                                        'active'       => $active,
                                                        'title'        => $a->get('Title_'.$lang),
                                                        'image'        => $a->get('Image'),
                                                        'files'         => $filesTPL,
                                                        'description'  => $a->get('Description_'.$lang),
                                                        ), '');
        }
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

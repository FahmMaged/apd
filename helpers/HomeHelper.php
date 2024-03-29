<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('AdminUsersHelper.php');
require_once('URLHelper.php');

class HomeHelper extends BaseHelper
{

    public function __construct()
    {
        parent::__construct();
        $this->urlHelper       = new URLHelper();
    }

    public function Get()
    {
        global $xpdo;

        if (isset($_POST['currID'])) {
            $ID = $_POST['currID'];
            $item = $xpdo->getObject('Home', array('ID' => $ID));
            return json_encode($item->toArray());
        }
    }

    public function Edit()
    {
        global $xpdo;

        date_default_timezone_set('Africa/Cairo');
        $updatedOn      = date("Y-m-d H:i:s");

        $item = $xpdo->getObject('Home', array('ID' => $_POST['currID']));

        if (!empty($_POST['edit_link']) && ($_POST['edit_link'] != $item->get('Link'))) {
          $link = $this->urlHelper->getEmbedURL($_POST['edit_link']);
        } else {
          $link = $item->get('Link');
        }

        $fields = array(
                      'Title_en'       => $_POST['edit_title_en'],
                      'Title_ar'       => $_POST['edit_title_ar'],
                      'Description_en' => $_POST['edit_description_en'],
                      'Description_ar' => $_POST['edit_description_ar'],
                      'Link'           => $link,
                      'NumberOfViews'  => $_POST['edit_views'],
                      'UpdatedBy'      => $_SESSION['AdminUser']['Name'],
                      'UpdatedOn'      => $updatedOn
                      );

        $item->fromArray($fields);

        return  $item->save();
    }

    // Front functions

    // Slider Items
    public function GetSliderItems(){

        global $xpdo;
        $lang  = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
        $query = $xpdo->newQuery('SliderItems');
        $query->sortby('Sort', 'ASC');
        $sliderItemsTpl  = '';
        $sliderItems = $xpdo->getCollection('SliderItems', $query);
        foreach ($sliderItems as $sliderItem) {
            $sliderItemsTpl  .= new LoadChunk('sliderItem', 'front/home', array(
                                                                    'title'       => $sliderItem->get('Title_'.$lang),
                                                                    'description' => $sliderItem->get('Description_'.$lang),
                                                                    'buttonText' => $sliderItem->get('ButtonText_'.$lang),
                                                                    'image'    	  => $sliderItem->get('Image'),
                                                                    'link'    	  => $sliderItem->get('Link'),
                                                                        ), '../');
        }
        $sliderTpl  = new LoadChunk('slider', 'front/home', array('sliderItemsTpl' => $sliderItemsTpl), '../');
        // echo $sliderTpl;
        return json_encode(array('output' => $this->urlHelper->changeToAlias($sliderTpl)));
    }
    // About Section
    public function GetAboutSection(){

        global $xpdo;
        $lang  = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
        $langFile  = json_decode(file_get_contents('../lang/home.json'), true);
        // $query = $xpdo->newQuery('AboutHome');
        // $query->sortby('Sort', 'ASC');
        // $aboutItems = $xpdo->getCollection('AboutHome', $query);
        $item = $xpdo->getObject('AboutUs', array('ID' => 1));
        // foreach ($aboutItems as $aboutItem) {
        //     $aboutItemsTPL  .= new LoadChunk('aboutItem', 'front/home', array(
        //                                                                 'title'       => $aboutItem->get('Title_'.$lang),
        //                                                                 'description' => $aboutItem->get('Description_'.$lang),
        //                                                                 'image'       => $aboutItem->get('Image')
        //                                                                 ), '../');
        // }
        $aboutSectionTpl  = new LoadChunk('aboutSection', 'front/home', array(
            // 'aboutItemsTPL' => $aboutItemsTPL,
            'readMore'    => $langFile['readMore'][$lang],
            'title' => $item->get('FirstTitle_'.$lang),
            'description' => $item->get('FirstDescription_'.$lang),
            'image' => $item->get('FirstImage'),
        ), '../');
        return json_encode(array('output' => $this->urlHelper->changeToAlias($aboutSectionTpl)));
    }
    // News Section
    public function GetNewsSection(){

        global $xpdo;
        $lang  = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
        $langFile  = json_decode(file_get_contents('../lang/home.json'), true);
        $newsItemsTPL    = '';
        $featuredNewsItemTPL = '';
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
        $currentDate  = date("Y-m-d");
        $logged     = (isset($_POST['logged'])) ? $_POST['logged'] : 0;
        $query = $xpdo->newQuery('News');
        if($logged == 0){
            $query->where(array('ForMembers' => 0));
          }
        $query->where(array(
            'InHome'         => 1,
            'IsActive'       => 1,
            'PublishDate:<=' => $currentDate
        ));
        $query->sortby('Sort', 'ASC');
        $query->sortby('PublishDate', 'DESC');
        $query->limit(3,0);

        $newsItems = $xpdo->getCollection('News', $query);
        foreach ($newsItems as $newsItem) {
            $month = '';
                $month1 = date("M", strtotime($newsItem->get('PublishDate')));
                $month_en = date("F", strtotime($newsItem->get('PublishDate')));
                $year   = date("Y", strtotime($newsItem->get('PublishDate')));
                $day    = date("d", strtotime($newsItem->get('PublishDate')));
                if ($lang == 'ar') {
                foreach ($months as $en => $ar) {
                if ($en == $month1) {
                $month = $ar;
                }
                }
                } else{
                    $month = $month_en;
                }

                $newsItemsTPL  .= new LoadChunk('newsItem', 'front/home', array(
                                                                            'lang'        => $lang,
                                                                            'id'          => $newsItem->get('ID'),
                                                                            'title'       => $newsItem->get('Title_'.$lang),
                                                                            'alias'       => $newsItem->get('Alias_'.$lang),
                                                                            'intro'       => $newsItem->get('Intro_'.$lang),
                                                                            'image'       => $newsItem->get('Image'),
                                                                            // 'publishDate' => $newsItem->get('PublishDate'),
                                                                            'month' => $month,
                                                                            'day' => $day,
                                                                            'readMore'    => $langFile['readMore'][$lang]
                                                                        ), '../');
        }
        
        $newsSectionTpl  = new LoadChunk('newsSection', 'front/home', array('lang'        => $lang,
                                                                        'newsItemsTPL'    => $newsItemsTPL,
                                                                        // 'featuredNewsItemTPL' => $featuredNewsItemTPL,
                                                                        'newsTitle'       => $langFile['newsTitle'][$lang],
                                                                        'newsSubTitle'    => $langFile['newsSubTitle'][$lang],
                                                                        'allNewsButton'   => $langFile['allNewsButton'][$lang]), '../');


        return json_encode(array('output' => $this->urlHelper->changeToAlias($newsSectionTpl)));
    }

    // Events Section
    public function GetEventsSection(){

        global $xpdo;
        $lang  = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
        $langFile  = json_decode(file_get_contents('../lang/home.json'), true);
        $currentDate  = date("Y-m-d");
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
        $query = $xpdo->newQuery('Events');
        $query->where(array(
            'InHome'         => 1,
            'IsActive'       => 1,
            'PublishDate:<=' => $currentDate
        ));
        $query->sortby('Sort', 'ASC');
        $query->sortby('PublishDate', 'DESC');
        $query->limit(4,0);
        $eventsItems = $xpdo->getCollection('Events', $query);
        foreach ($eventsItems as $eventItem) {
                $location = $xpdo->getObject('EventsLocations', array('ID' => $eventItem->get('LocationID')));
                $month = '';
                $month1 = date("M", strtotime($eventItem->get('PublishDate')));
                $month_en = date("F", strtotime($eventItem->get('PublishDate')));
                $year   = date("Y", strtotime($eventItem->get('PublishDate')));
                $day    = date("d", strtotime($eventItem->get('PublishDate')));
                if ($lang == 'ar') {
                foreach ($months as $en => $ar) {
                if ($en == $month1) {
                $month = $ar;
                }
                }
                } else{
                    $month = $month_en;
                }

            $eventsItemsTPL  .= new LoadChunk('eventsItem', 'front/home', array(
                                                                    'title'    => $eventItem->get('Title_'.$lang),
                                                                    'alias'    => $eventItem->get('Alias_'.$lang),
                                                                    'start'    => $eventItem->get('StartTime'),
                                                                    'end'      => $eventItem->get('EndTime'),
                                                                    'id'      => $eventItem->get('ID'),
                                                                    'location' => $location->get('Title_'.$lang),
                                                                    'day'      => $day,
                                                                    'month'    => $month,
                                                                    'lang'     => $lang,
                                                                        ), '../');
        }
        $eventsSectionTpl  = new LoadChunk('eventsSection', 'front/home', array(
                                                                    'lang'           => $lang,
                                                                    'eventsItemsTPL' => $eventsItemsTPL,
                                                                    'eventsTitle'    => $langFile['eventsTitle'][$lang],
                                                                    'allEventsButton'=> $langFile['allEventsButton'][$lang],
                                                                    ), '../');
        return json_encode(array('output' => $this->urlHelper->changeToAlias($eventsSectionTpl)));
    }

    // Services Section
    public function GetServicesSection(){

        global $xpdo;
        $lang  = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
        $langFile  = json_decode(file_get_contents('../lang/home.json'), true);
        $query = $xpdo->newQuery('Services');
        $query->sortby('Sort', 'ASC');
        $servicesItems = $xpdo->getCollection('Services', $query);
        foreach ($servicesItems as $servicesItem) {
            $servicesItemsTPL  .= new LoadChunk('servicesItem', 'front/home', array(
                                                                        'title'       => $servicesItem->get('Title_'.$lang),
                                                                        'description' => $servicesItem->get('Description_'.$lang),
                                                                        'image'       => $servicesItem->get('Image')
                                                                        ), '../');
        }
        $aboutSectionTpl  = new LoadChunk('servicesSection', 'front/home', array(
            'servicesItemsTPL' => $servicesItemsTPL,
            'servicesTitle'    => $langFile['servicesTitle'][$lang],
            'servicesSubTitle' => $langFile['servicesSubTitle'][$lang],
        ), '../');
        return json_encode(array('output' => $this->urlHelper->changeToAlias($aboutSectionTpl)));
    }
    // Testimonial Sectioon
    public function GetTestimonialSection(){

        global $xpdo;
        $lang  = (isset($_POST['lang'])) ? $_POST['lang'] : 'ar';
        $langFile  = json_decode(file_get_contents('../lang/home.json'), true);
        $query = $xpdo->newQuery('OurWork');
        // $query->sortby('Sort', 'ASC');
        $testimonialItems = $xpdo->getCollection('OurWork', $query);
        foreach ($testimonialItems as $testimonialItem) {
            $testimonialItemsTPL  .= new LoadChunk('testimonialItem', 'front/home', array(
                                                                        'name'        => $testimonialItem->get('Title_'.$lang),
                                                                        'job_title'   => $testimonialItem->get('JobTitle_'.$lang),
                                                                        'description' => $testimonialItem->get('Description_'.$lang),
                                                                        'image'       => $testimonialItem->get('Image')
                                                                        ), '../');
        }
        $aboutSectionTpl  = new LoadChunk('testimonialSection', 'front/home', array(
            'testimonialItems' => $testimonialItemsTPL,
            'testimonialTitle'    => $langFile['testimonialTitle'][$lang],
            'testimonialSubTitle' => $langFile['testimonialSubTitle'][$lang],
        ), '../');
        return json_encode(array('output' => $this->urlHelper->changeToAlias($aboutSectionTpl)));
    }
}

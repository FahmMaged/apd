<?php

Class URLHelper{

  function getThumbnail($videoURL){
    $thumbnail='';
    if(strpos($videoURL,"youtube.com")){
      $videoURL=str_replace(";list=","&list=",$videoURL);
      $videoURL=str_replace(";index","&index",$videoURL);
      $step = explode("watch?v=",$videoURL)[1];
      $step = explode("&list=",$step)[0];
      $step = explode("&index=",$step)[0];
      $thumbnail="http://img.youtube.com/vi/".$step."/0.jpg";
    }
    elseif(strpos($videoURL,"facebook.com")){
      $fbID='';
      $tmp = explode('/', $videoURL);
      $fbID=$tmp[count($tmp)-2];
      if($fbID!=''){
        $thumbnail="https://graph.facebook.com/".$fbID."/picture";
      }
    }
    elseif(strpos($videoURL,"dailymotion.com")){
      $dmID='';
      $tmp = explode('/', $videoURL);
      $dmID=explode('_',$tmp[4])[0];
      if($dmID!=''){
        $thumbnail="http://www.dailymotion.com/thumbnail/video/".$dmID;
      }
    }
    elseif(strpos($videoURL,"vimeo.com")){
      $vmID='';
      $tmp = explode('/', $videoURL);
      $vmID=$tmp[2];
      if($vmID!=''){
        $thumbnail="https://i.vimeocdn.com/video/".$vmID;
      }
    }

    return $thumbnail;
  }

  function getEmbedURL($videoURL){
    $url='';
    if(strpos($videoURL,"youtube.com")==true){
      $videoURL=str_replace(";list=","&list=",$videoURL);
      $videoURL=str_replace(";index","&index",$videoURL);
      // $url=str_replace("watch?v=", "embed/",$videoURL);
      // $url=str_replace("&list","?list",$url);
      // $url=str_replace("&index=",htmlspecialchars("&amp;ecver="),$url);
      $step = explode("watch?v=",$videoURL)[1];
      $step = explode("&list=",$step)[0];
      $step = explode("&index=",$step)[0];
      $url  = "https://www.youtube.com/embed/".$step;
    }
    elseif(strpos($videoURL,"facebook.com")==true){
      $fbID='';
      $tmp = explode('/', $videoURL);
      $user=$tmp[2];
      $fbID=$tmp[count($tmp)-2];
      if($fbID!=''){
        $url="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F".$user."%2Fvideos%2F".$fbID."%2F&show_text=0";
      }
    }
    elseif(strpos($videoURL,"dailymotion.com")==true){
      $dmID='';
      $tmp = explode('/', $videoURL);
      $dmID=explode('_',$tmp[4])[0];
      if($dmID!=''){
        $url="http://www.dailymotion.com/embed/video/".$dmID;
      }
    }
    elseif(strpos($videoURL,"vimeo.com")){
      $vmID='';
      $tmp = explode('/', $videoURL);
      $vmID=$tmp[2];
      if($vmID!=''){
        $url="http://player.vimeo.com/video/".$vmID;
      }
    }
    return $url;
  }

  function getAliasFormat($string){
    $alias=preg_replace('/[^\w\s]+/u', ' ', $string); // Removes special chars.
    $alias=preg_replace('/\s+/', '-', $alias); // remove all whitespaces
    $alias=strtolower($alias); // switch to lower case
    return $alias;
  }

  function changeToAlias($string){
    // $lang = (isset($_GET['lang'])) ? $_GET['lang'] : 'ar';
    $patterns     = array();
    $patterns[0]  = 'index.php';
    $patterns[1]  = 'aboutUs.php';
    $patterns[2]  = 'awareness.php?id=';
    $patterns[3]  = 'books.php';
    $patterns[4]  = 'contactUs.php';
    $patterns[5]  = 'events.php';
    $patterns[6]  = 'media.php';
    $patterns[7]  = 'news.php';
    $patterns[8]  = 'ourWork.php';
    $patterns[9]  = 'questions.php';
    $patterns[10] = 'newsDetails.php?id=';
    $patterns[11] = 'eventsDetails.php?id=';
    $patterns[12] = 'alternatives.php';
    $patterns[13] = 'program.php';
    $patterns[16] = 'alias=';
    // $patterns[17] = 'val=';
    $patterns[19] = '&/';
    $patterns[20] = '/&';
    $patterns[22] = '404.php';
    $patterns[23] = 'members.php';
    $patterns[24] = 'search.php?val=';
    // $lang = (isset($_GET['lang'])) ? $_GET['lang'] : 'ar';
    if(isset($_GET['lang'])){
      $lang = $_GET['lang'];
    } elseif(isset($_SESSION['lang'])){
      $lang = $_SESSION['lang'];
    } else{
      $lang = 'ar';
    }

    $replacements     = array();
    $replacements[0]  = 'index.php?lang='.$lang;
    $replacements[1]  = 'aboutUs.php?lang='.$lang;
    $replacements[2]  = 'awareness.php?lang='.$lang.'&id=';
    $replacements[3]  = 'books.php?lang='.$lang;
    $replacements[4]  = 'contactUs.php?lang='.$lang;
    $replacements[5]  = 'events.php?lang='.$lang;
    $replacements[6]  = 'media.php?lang='.$lang;
    $replacements[7]  = 'news.php?lang='.$lang;
    $replacements[8]  = 'ourWork.php?lang='.$lang;
    $replacements[9]  = 'questions.php?lang='.$lang;
    $replacements[10] = 'newsDetails.php?lang='.$lang.'&id=';
    $replacements[11] = 'eventsDetails.php?lang='.$lang.'&id=';
    $replacements[12] = 'alternatives.php?lang='.$lang;
    $replacements[13] = 'program.php?lang='.$lang;
    $replacements[16] = 'alias=';
    // $replacements[17] = 'val=';
    $replacements[19] = '&/';
    $replacements[20] = '/&';
    $replacements[22] = '404.php?lang='.$lang;
    $replacements[23] = 'members.php?lang='.$lang;
    $replacements[24] = 'search.php?lang='.$lang.'&val=';
    $string = str_replace($patterns, $replacements, $string);

    if(strtolower($_SERVER['HTTP_HOST'])!='localhost')
    {
      $patterns     = array();
      $patterns         = $replacements;
      
      $replacements     = array();
      $replacements[0]  = "$lang/Home";
      $replacements[1]  = "$lang/AboutUs/";
      $replacements[2]  = "$lang/Awareness/";
      $replacements[3]  = "$lang/Books/";
      $replacements[4]  = "$lang/ContactUs/";
      $replacements[5]  = "$lang/Events/";
      $replacements[6]  = "$lang/Media/";
      $replacements[7]  = "$lang/News/";
      $replacements[8]  = "$lang/OurWork/";
      $replacements[9]  = "$lang/Questions/";
      $replacements[10] = "$lang/Article/";
      $replacements[11] = "$lang/Event/";
      $replacements[12] = "$lang/Alternatives/";
      $replacements[13] = "$lang/program/";
      $replacements[16] = '/';
      // $replacements[17] = '/';
      $replacements[19] = '/';
      $replacements[20] = '/';
      $replacements[22] = "/$lang/Not-Found/";
      $replacements[23] = "/$lang/Members/";
      $replacements[24] = "/$lang/Search/";

      $string = str_replace($patterns, $replacements, $string);
   
    }
    return $string;
  }
}

?>

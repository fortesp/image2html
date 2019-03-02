<?                  
error_reporting(0); 
require "lib/webpage.class.php";
    
# IMAGE TO HTML  :-)  
# fortesp (c) 2008
   

function rgb2hex($r, $g=-1, $b=-1) {

    if (is_array($r) && sizeof($r) == 3)
        list($r, $g, $b) = $r;

    $r = intval($r); $g = intval($g);
    $b = intval($b);

    $r = dechex($r<0?0:($r>255?255:$r));
    $g = dechex($g<0?0:($g>255?255:$g));
    $b = dechex($b<0?0:($b>255?255:$b));

    $color = (strlen($r) < 2?'0':'').$r;
    $color .= (strlen($g) < 2?'0':'').$g;
    $color .= (strlen($b) < 2?'0':'').$b;
  
  return $color;
}

function get_rgb($rs, $x, $y) {

    $rgb = imagecolorat($rs, $x, $y);
    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;
    
  return array("r" => $r, "g" => $g, "b" => $b);
}

##  
  
$webpage = new webpage();
$webpage -> doctype();
$webpage -> meta();   
$webpage -> css("css/website.css");  

$webpage -> begin();
 
    $src = "test.jpg";

    $image_size = getimagesize($src);
    $img_rs = imagecreatefromjpeg($src);
    
    $html = "";
    for($y = 0; $y < $image_size[1]; $y++) {          
        for($x = 0; $x < $image_size[0]; $x++) {
        
           $color = get_rgb($img_rs, $x, $y);
           
           $hex = rgb2hex($color['r'], $color['g'], $color['b']);
           
           $html .= "<div style=\"top:".$y."px; left:".$x."px; background:#".$hex.";\"></div>";
        }        
    }
    
?>
<br />
<div id="holder" style="width:<?=$image_size[0]?>px; height:<?=$image_size[1]?>px;"><?=$html?></div>
<?

$webpage -> show();
?>
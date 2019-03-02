<?
# fortesp - 2008
class webpage {

  private $html_head;
  private $html;
  private $doctype;
  
  public function __construct() {
      
    ob_start("ob_gzhandler");
  }
   
  public function title($title) {
  
    $this -> html_head .= "<title>".$title."</title>";
  }
  
  public function meta() {
             
    $this -> html_head .= "<meta name='Cache-Control' content='private'  />\n";         
    $this -> html_head .= "<meta content = 'text/html' http-equiv = 'content-type' charset = 'UTF-8' />\n";  
  }
  
  public function js($src) {
    
    $this -> html_head .= "<script type=\"text/javascript\" src=\"$src\"></script>\n";
  }
  
  public function css($src) {
    
    $this -> html_head .= "<link rel=\"styleSheet\" href=\"$src\" type=\"text/css\" />\n";
  }  
  
  public function rss($src, $title = "") {
  
    $this -> html_head .= "<link href=\"$src\" type=\"application/rss+xml\" rel=\"alternate\" title=\"$title\" />\n";
  }
  
  public function doctype($doctype = "") {
  
    switch($doctype) {
    
      case "strict" : $this -> doctype = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
                      
      break;
      
      case "transitional" : $this -> doctype = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
                      
      break;      
        
       default: $this -> doctype = "<!DOCTYPE html>";
    }
  }
 
  public function begin() {
            
    #if($this -> doctype) $xmlns = " xmlns = 'http://www.w3.org/1999/xhtml'";        
            
    echo $this -> doctype."<html$xmlns lang=\"en\" dir=\"ltr\"><head>\n";      
    echo $this -> html_head;
  }
  
 
  public function __toString() {    
      
    $this -> html .= ob_get_clean("ob_gzhandler");       
    $this -> html .= "\n</body></html>";
    
    return $this -> html;
  }  
  
  
  public function show() {     
        
   echo $this;
  }



}


?>
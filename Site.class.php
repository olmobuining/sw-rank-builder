<?php
class Site {
    
    private $url;

    public function __construct($url = '')
    {
        if(empty($url))
            return false;
        
        $this->setUrl($url);
        
        return $this;
    }
    
    public function setUrl($url = '')
    {
        if(empty($url))
            return false;
        
        // Remove all instances of http(s)://
        $url = preg_replace("#http[s]*:\/\/[w{3}\.]*#i", "",$url);
        // Remove trailing slash
        $url = preg_replace("#\/^#","",$url);
        
        $this->url = $url;
        
        return $this;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    
}

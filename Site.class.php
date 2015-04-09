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
        
        // Get the host of the URL
        $url = parse_url($url);
        $url = $url['host'];
        
        // Remove all instances of http(s)://  if present (previous parse_url should remove it)
        $url = preg_replace("#http[s]*:\/\/[w{3}\.]*#i", "",$url);
        // Remove www. 
        $url = preg_replace("#(w{3}\.)#i", "",$url);
        // Remove trailing slash
        $url = preg_replace("#\/^#","",$url);
        
        // Assign the URL
        $this->url = $url;
        
        return $this;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    
}

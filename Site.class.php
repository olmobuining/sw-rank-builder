<?php
class Site {
    
    private $url;
    
    /* Saves all the data */
    private $data;
    
    private $filename;
    
    private $visitsfilename;

    private $smapi;

    public function __construct($url = '')
    {
        if(empty($url))
            return false;
        
        $this->setUrl($url);

        $this->smapi = new smapi($this->getUrl());

        $this->loadData();
        
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
    
    public function getvisits()
    {
        echo "Does nothing yet";
        return $this;
    }

    public function save() 
    {
        // return file_put_contents($this->getFilename(),json_encode($this->getData()));
    }
    
    public function getData($key = '')
    {
        if($key != '') {
            if(isset($this->data[$key])) {
                return $this->data[$key];
            }
        }
        return $this->data;
    }
    
    public function addData($data = array(), $key = '')
    {
        if(is_array($data)) {
            if($key != '')
                $data = array($key => $data);
            
            $data = array_merge($this->getData(), $data);
            $this->data = $data;
        } else {
            $this->data[$key] = $data;
        }
        
        return $this;
    }
    
    private function loadData()
    {

        if($this->checkVisitsFile()) {
            $this->addData( json_decode(file_get_contents($this->getVisitesFilename())), 'visits'  );
        }
        return $this;
    }
    
    private function getFilename()
    {
        if($this->visitsfilename == "") {
            $this->visitsfilename = 'data/' . $this->getUrl() . ".json";
        }
        return $this->visitsfilename;
    }
    
    private function getVisitesFilename()
    {
        if($this->visitsfilename == "") {
            $this->visitsfilename = 'data/' . $this->getUrl() . ".visits.json";
        }
        return $this->visitsfilename;
    }
    
    public function downloadVisites()
    {
        // Exit if we already have a visits file! ( To prevent double download )
        if($this->checkVisitsFile()) return false;
        
        $json = file_get_contents($this->smapi->getVisitesURL());

        if($json === false) {
            echo $this->smapi->getVisitesURL();
            echo "\n " . $this->url . " failed to download \n";
            return false;
        }

        if(file_put_contents($this->getVisitesFilename(),$json) !== false){
            return true;
        }
        return false;
    }
    
    public function checkVisitsFile()
    {
        if(file_exists($this->getVisitesFilename())) 
            return true;
        
        return false;
    }
}

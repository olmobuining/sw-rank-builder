<?php
class Site {
    
    private $url;
    
    /* Saves all the data */
    private $data;
    
    private $filename;
    
    private $rankfilename;

    public function __construct($url = '')
    {
        if(empty($url))
            return false;
        
        $this->setUrl($url);
        
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
    
    public function getRank()
    {
        echo "Does nothing yet";
        return $this;
    }

    public function save() 
    {
        return file_put_contents($this->getFilename(),json_encode($this->getData()));
    }
    
    public function getData()
    {
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
        if(file_exists('data/'.$this->getUrl().".data")) {
            $this->addData( json_decode(file_get_contents($this->getFilename())), 'general' );
        }
        if($this->checkRankFile()) {
            $this->addData( json_decode(file_get_contents($this->getRankFilename())), 'rank'  );
        }
        $this->data = array();
        return $this;
    }
    
    private function getFilename()
    {
        if($this->filename == "") {
            $this->filename = 'data/' . $this->getUrl() . ".json";
        }
        return $this->filename;
    }
    
    private function getRankFilename()
    {
        if($this->rankfilename == "") {
            $this->rankfilename = 'data/' . $this->getUrl() . ".rank.json";
        }
        return $this->rankfilename;
    }
    
    public function downloadRank()
    {
        // Exit if we already have a rank file! ( To prevent double download )
        if($this->checkRankFile()) return false;
        
        $json = file_get_contents('http://date.jsontest.com/');
        
        if(file_put_contents($this->getRankFilename(),$json) !== false){
            return true;
        }
        return false;
    }
    
    public function checkRankFile()
    {
        if(file_exists($this->getRankFilename())) 
            return true;
        
        return false;
    }
}

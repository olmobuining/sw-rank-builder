<?php

class Sites {
    public $urls = array();
    
    public function addSites(array $urls)
    {
        foreach($urls as $url) {
            $site = new Site($url);
            if(in_array($site->getUrl(), $this->urls)) {
                echo "\033[31m".$site->getUrl()." is already in the array\033[0m\n";
            } else {
                $this->urls[] = $site->getUrl();
                echo "\033[32mAdded: ".$site->getUrl()."\033[0m\n";
            }
        }
        return $this;
    }
}

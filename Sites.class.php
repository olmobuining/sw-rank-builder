<?php

class Sites {
    public $urls = array();
    
    public function addSites(array $urls)
    {
        foreach($urls as $url) {
            $site = new Site($url);
            if(in_array($site->getUrl(), $this->urls)) {
                echo "\r\033[31m".$site->getUrl()." is already in the array\033[0m";
            } else {
                $this->urls[] = $site->getUrl();
                echo "\r\033[32mAdded: ".$site->getUrl()."\033[0m                                  ". PHP_EOL;
                echo "Downloaded rank: "; var_dump($site->downloadRank());
                $site->save();
            }
        }
        return $this;
    }
}

<?php

class Sites {
    public $urls = array();
    public $sites = array();
    
    public function addSites(array $urls)
    {
        foreach($urls as $url) {
            $site = new Site($url);
            if(in_array($site->getUrl(), $this->urls)) {
                // echo "\r\033[31m".$site->getUrl()." is already in the array\033[0m";
            } else {
                $this->urls[] = $site->getUrl();
                $this->sites[] = $site;
                // echo "\r\033[32mAdded: ".$site->getUrl()."\033[0m                                  ". PHP_EOL;
                if($site->downloadVisites()) {
                    echo "Downloaded visits for ".$site->getUrl().": "; var_dump($site->downloadVisites());
                }
                $site->save();
            }
        }
        return $this;
    }

    public function printTable()
    {
        $countm = range(1, 12);
        echo "<table>";
            echo "<tr>";
                echo "<th>Sitename</th>";
                foreach ($countm as $monthnumber) {
                    echo "<th>";
                    echo $monthnumber . "-2015";
                    echo "</th>";
                }
                echo "<th>Total</th>";
            echo "</tr>";
            foreach($this->sites as $s) {
                $v = $s->getData('visits');
                $vtotal = 0;
                echo "<tr>";
                    echo "<td>";
                        echo $s->getUrl();
                    echo "</td>";
                    foreach ($v->Values as $months) {
                        foreach ($months as $k => $m) {
                            if($k != "Value") continue;
                            echo "<td>";
                                echo $m;
                            echo "</td>";
                            $vtotal+=$m;
                        }
                    }
                    echo "<td>";
                        echo $vtotal;
                    echo "</td>";
                echo "</tr>";
            }
        echo "</table>";

    }
}

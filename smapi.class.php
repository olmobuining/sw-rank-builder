<?php


class smapi {
	
	const BASEURL = 'http://api.similarweb.com/Site/';
	const APIKEY = 'cc8dbf315665d098666e6554cf2a4930';

	public function __construct($domain)
	{
		$this->urlparams = '?Format=JSON&UserKey='.SELF::APIKEY;
		$this->domain = $domain;
	}

	public function getTrafficURL()
	{
		return self::BASEURL . $this->domain . '/traffic' . $this->urlparams;
	}

	public function getVisitesURL()
	{
		return self::BASEURL . $this->domain . '/v1/visits' . $this->urlparams.'&start=01-2014&end=12-2014&gr=monthly';
	}
}
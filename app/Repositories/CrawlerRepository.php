<?php namespace App\Repositories;

use Goutte\Client;
use App\Sites;
use App\SitesUrls;
use App\configHeaders;

class CrawlerRepository
{
    protected $configHeaders;

    public function __construct()
    {
        $this->configHeaders = configHeaders::all();
    }

    public function isLiveUrl($url)
    {
        $clientNewUrl = new Client();
        $crawlerNewUrl = $clientNewUrl->request('GET', $url);
        $response = $clientNewUrl->getResponse();
        if ($response->getStatus()==200) {
            return true;
        }
        return false;
    }

    public function talentier($siteObj)
    {
        $client = new Client();
        $crawler = $client->request('GET', $siteObj->url);

        $crawler->filter('a')->each(function ($node) use ($siteObj) {
            if (strrpos($node->attr('href'), 'www')>0) {
                $siteURL = $node->attr('href');
                $clientNewUrl = new Client();
                $isVisited = $this->isVisited($siteURL, $siteObj);
                    
                $crawlerNewUrl = $clientNewUrl->request('GET', $siteURL);
                $response = $clientNewUrl->getResponse();
                if ($response->getStatus()==200 && !$isVisited) {
                    $urlHeaders = $this->checkHeaders($siteObj, $response->getHeaders());
                    $siteUrlObj = new SitesUrls();
                    $siteUrlObj->site_id = $siteObj->id;
                    $siteUrlObj->url =$siteURL;
                    $siteUrlObj->visited =1;
                    $siteUrlObj->url_headers =json_encode($urlHeaders);
                    $siteUrlObj->url_headers_date =date('Y-m-d h:i:s', time());
                    $siteUrlObj->save();
                    printf($siteURL);
                }
            }
        });

        return $crawler;
    }

    private function checkHeaders($siteObj, $urlHeaders)
    {
        $headersFound = [];
        foreach ($this->configHeaders as $item) {
            if (array_key_exists($item->name, $urlHeaders)) {
                $headersFound[] = [$item->name=>$urlHeaders[$item->name]];
            }
        }
        return $headersFound;
    }

    private function isVisited($url, $siteObj)
    {
        foreach ($siteObj->urls as $siteUrl) {
            if ($siteUrl->url == $url) {
                return true;
            }
        }
        return false;
    }
}

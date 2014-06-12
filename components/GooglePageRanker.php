<?php

class GooglePageRanker
{
    public $googleDomains = array("toolbarqueries.google.com",
                                  "www.google.com",
                                  "toolbarqueries.google.com.tr",
                                  "www.google.com.tr",
                                  "toolbarqueries.google.de",
                                  "www.google.de",
                                  "64.233.187.99",
                                  "72.14.207.99");
    public $GOOGLE_MAGIC = 0xE6359A60;
    public $PageRank = -1;
    public $cacheExpired = false;
    public $debug = false;

    function getPageRank($url, $additionalServerUrl = false)
    {
        $pageRank = 0;
        $url = ((substr(strtolower($url), 0, 7) != "http://") ? "http://" . $url : $url);
        $queryUrl = "http://" . $this->googleDomains[mt_rand(0, count($this->googleDomains) - 1)];
        $queryUrl .= sprintf("/tbr?client=navclient-auto&ch=6%s&features=Rank&q=info:%s", $this->googleCh($this->strord("info:" . $url)), urlencode($url));

        $httpClient = new HttpClient();

        if ($additionalServerUrl) {
            $httpClient->additionalServerUrl = $additionalServerUrl;
        }

        $content = $httpClient->getSiteContent($queryUrl, false);

        if ($this->debug) {
            echo $content;
        }

        if (preg_match("#Rank_1:\d:(\d{1,2})#", $content, $matches)) {
            $pageRank = $matches[1];
        }

        return $pageRank;
    }

    function zeroFill($a, $b)
    {
        $z = hexdec(80000000);
        if ($z & $a) {
            $a = ($a >> 1);
            $a &= (~$z);
            $a |= 0x40000000;
            $a = ($a >> ($b - 1));
        } else {
            $a = ($a >> $b);
        }

        return $a;
    }

    function xor32($a, $b)
    {
        return $this->int32($a) ^ $this->int32($b);
    }

    function int32($x)
    {
        $z = hexdec(80000000);
        $y = (int) $x;

        if ($y == -$z && $x < -$z) {
            $y = (int) ((-1) * $x);
            $y = (-1) * $y;
        }

        return $y;
    }

    function mix($a, $b, $c)
    {
        $a -= $b;
        $a -= $c;
        $a = $this->xor32($a, $this->zeroFill($c, 13));
        $b -= $c;
        $b -= $a;
        $b = $this->xor32($b, $a << 8);
        $c -= $a;
        $c -= $b;
        $c = $this->xor32($c, $this->zeroFill($b, 13));
        $a -= $b;
        $a -= $c;
        $a = $this->xor32($a, $this->zeroFill($c, 12));
        $b -= $c;
        $b -= $a;
        $b = $this->xor32($b, $a << 16);
        $c -= $a;
        $c -= $b;
        $c = $this->xor32($c, $this->zeroFill($b, 5));
        $a -= $b;
        $a -= $c;
        $a = $this->xor32($a, $this->zeroFill($c, 3));
        $b -= $c;
        $b -= $a;
        $b = $this->xor32($b, $a << 10);
        $c -= $a;
        $c -= $b;
        $c = $this->xor32($c, $this->zeroFill($b, 15));
        return array($a, $b, $c);
    }

    function googleCh($url, $length = null)
    {
        if (is_null($length)) {
            $length = sizeof($url);
        }

        $a = $b = 0x9E3779B9;
        $c = $this->GOOGLE_MAGIC;
        $k = 0;
        $len = $length;

        while ($len >= 12) {
            $a += ($url[$k + 0] + ($url[$k + 1] << 8) + ($url[$k + 2] << 16) + ($url[$k + 3] << 24));
            $b += ($url[$k + 4] + ($url[$k + 5] << 8) + ($url[$k + 6] << 16) + ($url[$k + 7] << 24));
            $c += ($url[$k + 8] + ($url[$k + 9] << 8) + ($url[$k + 10] << 16) + ($url[$k + 11] << 24));
            $mix = $this->mix($a, $b, $c);
            $a = $mix[0];
            $b = $mix[1];
            $c = $mix[2];
            $k += 12;
            $len -= 12;
        }

        $c += $length;
        switch ($len) {
            case 11:
                $c += ($url[$k + 10] << 24);
            case 10:
                $c += ($url[$k + 9] << 16);
            case 9:
                $c += ($url[$k + 8] << 8);

            case 8:
                $b += ($url[$k + 7] << 24);
            case 7:
                $b += ($url[$k + 6] << 16);
            case 6:
                $b += ($url[$k + 5] << 8);
            case 5:
                $b += ($url[$k + 4]);
            case 4:
                $a += ($url[$k + 3] << 24);
            case 3:
                $a += ($url[$k + 2] << 16);
            case 2:
                $a += ($url[$k + 1] << 8);
            case 1:
                $a += ($url[$k + 0]);
        }

        $mix = $this->mix($a, $b, $c);

        return $mix[2];
    }

    function strord($string)
    {
        for ($i = 0; $i < strlen($string); $i++) {
            $result[$i] = ord($string{$i});
        }

        return $result;
    }
}

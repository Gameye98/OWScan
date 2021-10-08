<?php
// Requests Type = 0 for GET
// Requests Type = 1 for POST
function requests($url, $ua, $type=0, $params="") {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	if($type == 1) {
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, $ua);
	$res = curl_exec($ch);
	curl_close($ch);
	return $res;
}
$ua = "Mozilla/5.0 (Linux; Android 5.1.1; Andromax A16C3H Build/LMY47V) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.111 Mobile Safari/537.36";
system("clear");
$red = "\033[1;31m";
$yellow = "\033[1;33m";
$white = "\033[1;37m";
$normal = "\033[0m";
echo "\n$yellow
$yellow _____     __      __    ______                                    $normal
$yellow/\  __`\  /\ \  __/\ \  /\  __ \                                   $normal
$yellow\ \ \/\ \ \ \ \/\ \ \ \ \ \ \,\_\      ____     ____       ____    $normal
$yellow \ \ \ \ \ \ \ \ \ \ \ \ \/_____ \    /'___\   /'__`\     / _ `\   $normal
$yellow  \ \ \_\ \ \ \ \_\ \_\ \  /\`\_\ \  /\ \__/  /\ \L\.\_  /\ \/\ \  $normal
$yellow   \ \_____\ \ \____x___/  \ \_____\ \ \____\ \ \__/.\_\ \ \_\ \_\ $normal
$yellow    \/_____/  \,/__//__/    \/_____/  \/____/  \/__/\/_/  \/_/\/_/ $normal";
echo "\n     $yellow:::$white OWScan v1.0 - 19 March 2018 (05:50)      $normal";
echo "\n     $yellow:::$white Author: DedSecTL/DTL | Codename: Alone.  $normal";
echo "\n     $yellow:::$white Team: BlackHole Security | O~WEB Scanner $normal";
echo $yellow."\n     [#]$white Enter Website to Scan$red(".$white."ex: www.example.com$red):$normal ";
$webURL = trim(fgets(STDIN));
if ( $webURL != NULL ) {
	echo "\n\n$yellow:::$white Whois Lookup$yellow:$normal\n";
	$whoisURL = "http://api.hackertarget.com/whois/?q=".$webURL;
	$whoisDATA = file_get_contents($whoisURL);
	echo $whoisDATA;
	echo "\n\n$yellow:::$white DNS Lookup$yellow:$normal\n";
	$dnsURL = "http://api.hackertarget.com/dnslookup/?q=".$webURL;
	$dnsDATA = file_get_contents($dnsURL);
	echo $dnsDATA;
	echo "\n\n$yellow:::$white Zone Transfer$yellow:$normal\n";
	$zonetransURL = "http://api.hackertarget.com/zonetransfer/?q=".$webURL;
	$zonetransDATA = file_get_contents($zonetransURL);
	echo $zonetransDATA;
	echo "\n\n$yellow:::$white Traceroute$yellow:$normal\n";
	$traceURL = "https://api.hackertarget.com/mtr/?q=".$webURL;
	$traceDATA = file_get_contents($traceURL);
	echo $traceDATA;
	echo "\n\n$yellow:::$white PORT Scan$yellow:$normal\n";
	$pscanURL = "http://api.hackertarget.com/nmap/?q=".$webURL;
	$pscanDATA = file_get_contents($pscanURL);
	echo $pscanDATA;
	echo "\n\n$yellow:::$white Link Grabber$yellow:$normal\n";
	$linkgrabURL = "https://api.hackertarget.com/pagelinks/?q=http://".$webURL;
	$linkgrabDATA = file_get_contents($linkgrabURL);
	echo $linkgrabDATA;
	echo "\n\n$yellow:::$white IPGeolocation$yellow:$normal\n";
	$geoipDATA = requests("https://tools.keycdn.com/geo.json?host=".$webURL, "keycdn-tools:https://".$webURL);
	echo $geoipDATA;
	echo "\n\n$yellow:::$white HTTP Header Grabber$yellow:$normal\n";
	$httphgrabURL = "http://api.hackertarget.com/httpheaders/?q=".$webURL;
	$httphgrabDATA = file_get_contents($httphgrabURL);
	echo $httphgrabDATA;
	echo "\n\n$yellow:::$white Certificate Search$yellow:$normal\n";
	$crtshData = requests("https://crt.sh/?q=".$webURL."&output=json", $ua);
	echo $crtshData;
	echo "\n\n$yellow:::$white Reverse IP Domain Check$yellow:$normal\n";
	$ygsrevIPData = requests("https://domains.yougetsignal.com/domains.php", $ua, 1, "remoteAddress=".$webURL."&key=");
	echo $ygsrevIPData;
	echo "\n$yellow:::$white Thanks for Using our Program\n$yellow:::$white Have a Nice Day, Bye Bye$normal\n";
}
else {
	echo "\n$red:::$white Please, Enter the Website to Scan$normal\n";
}
?>
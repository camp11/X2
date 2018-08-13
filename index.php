<?php
/*
pyupyu
*/

require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');

$channelAccessToken = 'MKVCHqyfjAIonWJAXU90m4G0tDsgiXh4xj0gmIBIIIkbn9CofGqBlSDso5Md8neAyyDXQjNLjp2HbWu1P+BZ9h6iBk/2CwTB4/0PjPz/W+pyKCX7DyHTODfdWLXlQ3cJNECe/dKIbkiWaDDbWcc2ygdB04t89/1O/w1cDnyilFU='; //sesuaikan 
$channelSecret = '84ad98dcf6e30482cc82f756a02a97ac';//sesuaikan

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$userId 	= $client->parseEvents()[0]['source']['userId'];
$groupId 	= $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$type 		= $client->parseEvents()[0]['type'];

$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];

$profil = $client->profil($userId);

$pesan_datang = explode(" ", $message['text']);
$msg_type = $message['type'];
$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}
#-------------------------[Function]-------------------------#
function quotes($keyword) {
    $uri = "http://quotes.rest/qod.json?category=" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Result : ";
	$result .= $json['success']['total'];
	$result .= "\nQuotes : ";
	$result .= $json['contents']['quotes']['quote'];
	$result .= "\nAuthor : ";
	$result .= $json['contents']['quotes']['author'];
    return $result;
}
#-------------------------[Function]-------------------------#
function tren($keyword) {
    $uri = "http://api.secold.com/translate/en/" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Type : English";
    $result .= "\nTranslate : ";
	$result .= $json['result'];
    return $result;
}
#-------------------------[Function]-------------------------#
function trid($keyword) {
    $uri = "http://api.secold.com/translate/id/" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Type : Indonesian";
    $result .= "\nTranslate : ";
	$result .= $json['result'];
    return $result;
}
#-------------------------[Function]-------------------------#
function trja($keyword) {
    $uri = "http://api.secold.com/translate/ja/" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Type : Japanese";
    $result .= "\nTranslate : ";
	$result .= $json['result'];
    return $result;
}
#-------------------------[Function]-------------------------#
function trar($keyword) {
    $uri = "http://api.secold.com/translate/ar/" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Type : Arabic";
    $result .= "\nTranslate : ";
	$result .= $json['result'];
    return $result;
}
#-------------------------[Function]-------------------------#
function film_syn($keyword) {
    $uri = "http://www.omdbapi.com/?t=" . $keyword . '&plot=full&apikey=d5010ffe';

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Judul : \n";
	$result .= $json['Title'];
	$result .= "\n\nSinopsis : \n";
	$result .= $json['Plot'];
    return $result;
}
#-------------------------[Function]-------------------------#
function film($keyword) {
    $uri = "http://www.omdbapi.com/?t=" . $keyword . '&plot=full&apikey=d5010ffe';

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Judul : ";
	$result .= $json['Title'];
	$result .= "\nRilis : ";
	$result .= $json['Released'];
	$result .= "\nTipe : ";
	$result .= $json['Genre'];
	$result .= "\nActors : ";
	$result .= $json['Actors'];
	$result .= "\nBahasa : ";
	$result .= $json['Language'];
	$result .= "\nNegara : ";
	$result .= $json['Country'];
    return $result;
}
#-------------------------[Function]-------------------------#
function ytdownload($keyword) {
    $uri = "http://wahidganteng.ga/process/api/0470be5f700802ef5bc1db694e61d720/youtube-downloader?url=" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Judul : \n";
	$result .= $json['title'];
	$result .= "\nType : ";
	$result .= $json['data']['type'];
	$result .= "\nUkuran : ";
	$result .= $json['data']['size'];
	$result .= "\nLink : ";
	$result .= $json['data']['link'];
    return $result;
}
#-------------------------[Function]-------------------------#
function ps($keyword) { 
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20171227T171852Z.fda4bd604c7bf41f.f939237fb5f802608e9fdae4c11d9dbdda94a0b5&text=" . $keyword . "&lang=id-id"; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result .= "Name : ";
    $result .= $json['text']['0'];
    $result .= "\nLink: ";
    $result .= "https://play.google.com/store/search?q=" . $keyword . "";
    $result .= "\n\nPencarian : PlayStore";
    return $result; 
}
#-------------------------[Function]-------------------------#
function say($keyword) { 
    $uri = "https://script.google.com/macros/exec?service=AKfycbw7gKzP-WYV2F5mc9RaR7yE3Ve1yN91Tjs91hp_jHSE02dSv9w&nama=" . $keyword . "&tanggal=10-05-2003"; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
 $result .= $json['data']['nama']; 
    return $result; 
}
#-------------------------[Function]-------------------------#
function lirik($keyword) { 
    $uri = "http://ide.fdlrcn.com/workspace/yumi-apis/joox?songname=" . $keyword . ""; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result = "====[Lyrics]====";
    $result .= "\nJudul : ";
    $result .= $json['0']['0'];
    $result .= "\nLyrics :\n";
    $result .= $json['0']['5'];
    $result .= "\n\nPencarian : Google";
    $result .= "\n====[Lyrics]====";
    return $result; 
}
#-------------------------[Function]-------------------------#
function music($keyword) { 
    $uri = "http://ide.fdlrcn.com/workspace/yumi-apis/joox?songname=" . $keyword . ""; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result = "====[Music]====";
    $result .= "\nJudul : ";
    $result .= $json['0']['0'];
    $result .= "\nDurasi : ";
    $result .= $json['0']['1'];
    $result .= "\nLink : ";
    $result .= $json['0']['4'];
    $result .= "\n\nPencarian : Google";
    $result .= "\n====[Music]====";
    return $result; 
}
#-------------------------[Function]-------------------------#
function img_search($keyword) {
    $uri = 'https://www.google.co.id/search?q=' . $keyword . '&safe=off&source=lnms&tbm=isch';

    $response = Unirest\Request::get("$uri");

    $hasil = str_replace(">", "&gt;", $response->raw_body);
    $arrays = explode("<", $hasil);
    return explode('"', $arrays[291])[3];
}
#-------------------------[Function]-------------------------#
function shalat($keyword) {
    $uri = "https://time.siswadi.com/pray/" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "====[JadwalShalat]====";
    $result .= "\nLokasi : ";
	$result .= $json['location']['address'];
	$result .= "\nTanggal : ";
	$result .= $json['time']['date'];
	$result .= "\n\nShubuh : ";
	$result .= $json['data']['Fajr'];
	$result .= "\nDzuhur : ";
	$result .= $json['data']['Dhuhr'];
	$result .= "\nAshar : ";
	$result .= $json['data']['Asr'];
	$result .= "\nMaghrib : ";
	$result .= $json['data']['Maghrib'];
	$result .= "\nIsya : ";
	$result .= $json['data']['Isha'];
	$result .= "\n\nPencarian : Google";
	$result .= "\n====[JadwalShalat]====";
    return $result;
}
#-------------------------[Function]-------------------------#
#-------------------------[Function]-------------------------#
function kalender($keyword) {
    $uri = "https://time.siswadi.com/pray/" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "====[Kalender]====";
    $result .= "\nLokasi : ";
	$result .= $json['location']['address'];
	$result .= "\nTanggal : ";
	$result .= $json['time']['date'];
	$result .= "\n\nPencarian : Google";
	$result .= "\n====[Kalender]====";
    return $result;
}
#-------------------------[Function]-------------------------#
function waktu($keyword) {
    $uri = "https://time.siswadi.com/pray/" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "====[Time]====";
    $result .= "\nLokasi : ";
	$result .= $json['location']['address'];
	$result .= "\nJam : ";
	$result .= $json['time']['time'];
	$result .= "\nSunrise : ";
	$result .= $json['debug']['sunrise'];
	$result .= "\nSunset : ";
	$result .= $json['debug']['sunset'];
	$result .= "\n\nPencarian : Google";
	$result .= "\n====[Time]====";
    return $result;
}
#-------------------------[Function]-------------------------#
function saveitoffline($keyword) {
    $uri = "https://www.saveitoffline.com/process/?url=" . $keyword . '&type=json';

    $response = Unirest\Request::get("$uri");


    $json = json_decode($response->raw_body, true);
	$result = "====[SaveOffline]====\n";
	$result .= "Judul : \n";
	$result .= $json['title'];
	$result .= "\n\nUkuran : \n";
	$result .= $json['urls'][0]['label'];
	$result .= "\n\nURL Download : \n";
	$result .= $json['urls'][0]['id'];
	$result .= "\n\nUkuran : \n";
	$result .= $json['urls'][1]['label'];
	$result .= "\n\nURL Download : \n";
	$result .= $json['urls'][1]['id'];
	$result .= "\n\nUkuran : \n";
	$result .= $json['urls'][2]['label'];	
	$result .= "\n\nURL Download : \n";
	$result .= $json['urls'][2]['id'];
	$result .= "\n\nUkuran : \n";
	$result .= $json['urls'][3]['label'];	
	$result .= "\n\nURL Download : \n";
	$result .= $json['urls'][3]['id'];	
	$result .= "\n\nPencarian : Google\n";
	$result .= "====[SaveOffline]====";
    return $result;
}
#-------------------------[Function]-------------------------#
function qibla($keyword) { 
    $uri = "https://time.siswadi.com/qibla/" . $keyword; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
 $result .= $json['data']['image'];
    return $result; 
}
// ----- LOCATION BY FIDHO -----
function lokasi($keyword) { 
    $uri = "https://time.siswadi.com/pray/" . $keyword; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
 $result['address'] .= $json['location']['address'];
 $result['latitude'] .= $json['location']['latitude'];
 $result['longitude'] .= $json['location']['longitude'];
    return $result; 
}

#-------------------------[Function]-------------------------#
function cuaca($keyword) {
    $uri = "http://api.openweathermap.org/data/2.5/weather?q=" . $keyword . ",ID&units=metric&appid=e172c2f3a3c620591582ab5242e0e6c4";
    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "====[InfoCuaca]====";
    $result .= "\nKota : ";
	$result .= $json['name'];
	$result .= "\nCuaca : ";
	$result .= $json['weather']['0']['main'];
	$result .= "\nDeskripsi : ";
	$result .= $json['weather']['0']['description'];
	$result .= "\n\nPencariaan : Google";
	$result .= "\n====[InfoCuaca]====";
    return $result;
}
#-------------------------[Function]-------------------------#
function urb_dict($keyword) {
    $uri = "http://api.urbandictionary.com/v0/define?term=" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = $json['list'][0]['definition'];
    $result .= "\n\nExamples : \n";
    $result .= $json['list'][0]['example'];
    return $result;
}
#-------------------------[Function]-------------------------#
function qrcode($keyword) {
    $uri = "http://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=" . $keyword;

    return $uri;
}
#-------------------------[Function]-------------------------#

function zodiak($keyword) {
    $uri = "https://script.google.com/macros/exec?service=AKfycbw7gKzP-WYV2F5mc9RaR7yE3Ve1yN91Tjs91hp_jHSE02dSv9w&nama=ervan&tanggal=" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "====[Zodiak]====";
    $result .= "\nLahir : ";
	$result .= $json['data']['lahir'];
	$result .= "\nUsia : ";
	$result .= $json['data']['usia'];
	$result .= "\nUltah : ";
	$result .= $json['data']['ultah'];
	$result .= "\nZodiak : ";
	$result .= $json['data']['zodiak'];
	$result .= "\n\nPencarian : Google";
	$result .= "\n====[Zodiak]====";
    return $result;
}
#-------------------------[Function]-------------------------#
//show menu, saat join dan command,menu
if ($type == 'join' || $command == 'Help') {
    $text .= "==[Main Keywords]==";
    $text .= "> \n";
    $text .= "> Welcome\n"; 
    $text .= "> Admin\n";
    $text .= "> Program\n";
    $text .= "> Struktur\n";
    $text .= "> Visi\n";
    $text .= "> Key\n";
    $text .= "> Creator\n";
    $text .= "> /shalat [namakota]\n";
    $text .= "> /zodiak [tanggallahir]\n";
    $text .= "> /lokasi [namakota]\n";
    $text .= "> /time [namakota]\n";
    $text .= "> /kalender [namakota]\n";
    $text .= "> /cuaca [namakota]\n";
    $text .= "> /qiblat [namakota]\n";
    $text .= "> /myinfo\n";
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}
#-------------------------[Function]-------------------------#
//show menu, saat join dan command,menu
if ($type == 'join' || $command == 'Dev') {
    $text .= " \n";
    $text .= " 􀀹⚡⚡⚡⚡⚡⚡⚡⚡􀀹\n";
    $text .= "======[HALLO KBS]======";
    $text .= " \n";
    $text .= "Terima Kasih Atas Invite nya\n";
    $text .= "=======================\n";	
    $text .= "=>Developer BOT ketik Creator\n";
    $text .= "=>Jangan Lupa BOTnya di-Add\n";
    $text .= "    dulu ya 􀀅􀀰\n";
    $text .= " 􀀹⚡⚡⚡⚡⚡⚡⚡⚡􀀹\n";
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}
#-------------------------[Function]-------------------------#
if ($type == 'text' || $command == 'Wc') {
    $text .= "====[HALLO WELCOME]====";
    $text .= " \n";
    $text .= "       ⤵Selamat Datang di⤵\n";
    $text .= "=======================\n";	
    $text .= "           >Family NEW-KBS<\n";	
    $text .= " KOMUNITAS BERNYANYI SMULE";
    $text .= " \n";
    $text .= "=======================\n";	
    $text .= "  Jangan Lupa Cek Note ya\n";
    $text .= "[Salken dari Saya]->$profil->displayName\n";
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}
#-------------------------[Function]-------------------------#
//show menu, saat join dan command,menu
if ($type == 'text' || $command == 'Key') {
    $text .= "==[Additional Keywords]==";
    $text .= "> \n";
    $text .= "> Bot\n"; 
    $text .= "> Pagi\n";
    $text .= "> Siang\n";
    $text .= "> Sore\n";
    $text .= "> Malam\n";
    $text .= "> Haha\n";
    $text .= "> Sepi\n";
    $text .= "> Assalamualaikum\n";
    $text .= "> waalaikumsalam\n";
    $text .= "> Hai\n";
    $text .= "> Halo\n";
    $text .= "> Ok\n";
    $text .= "> Udah";
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}
if($message['type']=='text') {
	    if ($command == '/qiblat') {
        $hasil = qibla($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $hasil,
                    'previewImageUrl' => $hasil
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/myinfo') {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(

										'type' => 'text',					
										'text' => '====[InfoProfile]====
Nama: '.$profil->displayName.'

Status: '.$profil->statusMessage.'

Picture: '.$profil->pictureUrl.'

====[InfoProfile]===='
									)
							)
						);
				
	}
}
//pesan bergambar
if ($message['type'] == 'text') {
    if ($command == '/def') {


        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Definition : ' . urb_dict($options)
                )
            )
        );
    }
}
if($msg_type == 'text'){
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'apakah') {
        $balas = send(jawabs(), $replyToken);
    } else {}
} if($msg_type == 'text'){
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'bisakah') {
        $balas = send(bisa(), $replyToken);
    } else {}
} if($msg_type == 'text'){
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'kapankah') {
        $balas = send(kapan(), $replyToken);
    } else {}
} if($msg_type == 'text'){
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'rate') {
        $balas = send(dosa(), $replyToken);
    } else {}
} if($msg_type == 'text'){
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == 'dosanya') {
		$balas = send(dosa2(), $replyToken);
		$balas = send(dosa(), $replyToken);
		$balas = send(dosa3(), $replyToken);
    } else {}
} else {}
//translate//
if($message['type']=='text') {
	    if ($command == '/tr-ar') {

        $result = trar($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/tr-ja') {

        $result = trja($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/tr-id') {

        $result = trid($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/tr-en') {

        $result = tren($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/say') {

        $result = say($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/yt-get') {

        $result = yt-download($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => yt-download($options)
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/github-repo') {

        $result = githubrepo($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/qiblat') {
        $hasil = qibla($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $hasil,
                    'previewImageUrl' => $hasil
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/cuaca') {

        $result = cuaca($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/qr') {

        $result = qrcode($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $qrcode($options),
                    'previewImageUrl' => qrcode($options)
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/playstore') {

        $result = ps($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text'  => 'Searching...'
                ),
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }

}
if($message['type']=='text') {
	    if ($command == '/quotes') {

        $result = quotes($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text'  => $result
                )
            )
        );
    }

}                
//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/convert') {
        $result = saveitoffline($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => saveitoffline($options)
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/shorten') {
        $result = adfly($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $data
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/qiblat') {
        $hasil = qibla($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $hasil,
                    'previewImageUrl' => $hasil
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/yt') {
        $keyword = '';
        $image = 'https://img.youtube.com/vi/' . $keyword . '/2.jpg';
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $image,
                    'previewImageUrl' => $image
                ), array(
                    'type' => 'video',
                    'originalContentUrl' => vid_search($keyword),
                    'previewImageUrl' => $image
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '/film') {

        $result = film($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/lirik') {

        $result = lirik($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
        if ($command == '/film-syn') {
        $result = film_syn($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array( 
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//pesan bergambar
// ----- LOKASI BY FIDHO -----
if($message['type']=='text') {
	    if ($command == '/lokasi' || $command == '/Lokasi') {

        $result = lokasi($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'location',
                    'title' => 'Lokasi',
                    'address' => $result['address'],
                    'latitude' => $result['latitude'],
                    'longitude' => $result['longitude']
                ),
            )
        );
    }

}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/kalender') {

        $result = kalender($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ('Apakah' == $command) {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $acak
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/time') {

        $result = waktu($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/music') {

        $result = music($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/zodiak') {

        $result = zodiak($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Bot' || $command == 'bot' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => ' kenapa manggil manggil??'.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Bot' || $command == 'bot' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Ada apa sebut saya??'.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Pagi' || $command == 'pagi' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Pagi juga, Senyum ya! '.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Siang' || $command == 'siang' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Siang juga, Jangan lupa makan siang ya '.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Assalamualaikum' || $command == 'assalamualaikum' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'waalaikumsalam wr.wb '.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Waalaikumsalam' || $command == 'Waalaikumsalam wr.wb' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Makasih dah jawab salamnya kk '.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Sore' || $command == 'sore' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Ngopi dulu '.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Malam' || $command == 'Night' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Malam juga, '.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'baik' || $command == 'Baik' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Tetap Semangat Ya! '.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Halo' || $command == 'Hallo' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'HALLO apa kabar'.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Hai' || $command == 'hai' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Hai juga '.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Udh' || $command == 'udh' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'pinter kamu '.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Udah' || $command == 'udah' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'pinter kamu '.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Ok' || $command == 'ok' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'pinter kamu '.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'gila' || $command == 'peak' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'ish ish kok gitu ka( '.$profil->displayName
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Welcome' || $command == 'wc' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
  'type' => 'imagemap',
  'baseUrl' => 'https://res.cloudinary.com/eds0101/image/upload/v1534162853/KBS/1',
  'altText' => 'WELCOME Family NEW KBS',
  'baseSize' => 
  array (
    'height' => 1040,
    'width' => 1040,
  ),
  'actions' => 
  array (
    0 => 
    array (
      'type' => 'uri',
      'linkUri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
      'area' => 
      array (
        'x' => 0,
        'y' => 0,
        'width' => 520,
        'height' => 1040,
      ),
    ),
    1 => 
    array (
      'type' => 'message',
      'text' => 'Staff',
      'area' => 
      array (
        'x' => 520,
        'y' => 0,
        'width' => 520,
        'height' => 1040,
      ),
    ),
  ),
)
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Creator' || $command == 'creator' ) {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
  'type' => 'template',
  'altText' => 'CREATOR',
  'template' => 
  array (
    'type' => 'image_carousel',
    'columns' => 
    array (
      0 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/eds0101/image/upload/v1527926484/Creator/1040.jpg',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'CHAT PM',
          'uri' => 'http://line.me/ti/p/8jX6OIm-AS',
        ),
      ),
    ),
  ),
)
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Staff' || $command == 'staff' ) {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
  'type' => 'template',
  'altText' => 'ALL STAFF NEW KBS',
  'template' => 
  array (
    'type' => 'image_carousel',
    'columns' => 
    array (
      0 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1526286335/line/EVENT/NOTAVAILABLE/1040.jpg',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'SMULE',
          'uri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
        ),
      ),
      1 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1526286335/line/EVENT/NOTAVAILABLE/1040.jpg',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'SMULE',
          'uri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
        ),
      ),
      2 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1526286335/line/EVENT/NOTAVAILABLE/1040.jpg',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'SMULE',
          'uri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
        ),
      ),
      3 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1526286335/line/EVENT/NOTAVAILABLE',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'SMULE',
          'uri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
        ),
      ),
      4 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1526286335/line/EVENT/NOTAVAILABLE/1040.jpg',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'SMULE',
          'uri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
        ),
      ),
      5 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1526286335/line/EVENT/NOTAVAILABLE/1040.jpg',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'SMULE',
          'uri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
        ),
      ),
    ),
  ),
),
                array (
  'type' => 'template',
  'altText' => 'ALL STAFF NEW KBS',
  'template' => 
  array (
    'type' => 'image_carousel',
    'columns' => 
    array (
      0 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1526286335/line/EVENT/NOTAVAILABLE/1040.jpg',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'SMULE',
          'uri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
        ),
      ),
      1 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1526286335/line/EVENT/NOTAVAILABLE/1040.jpg',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'SMULE',
          'uri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
        ),
      ),
      2 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1526286335/line/EVENT/NOTAVAILABLE/1040.jpg',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'SMULE',
          'uri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
        ),
      ),
      3 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1526286335/line/EVENT/NOTAVAILABLE',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'SMULE',
          'uri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
        ),
      ),
      4 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1526286335/line/EVENT/NOTAVAILABLE/1040.jpg',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'SMULE',
          'uri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
        ),
      ),
      5 => 
      array (
        'imageUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1526286335/line/EVENT/NOTAVAILABLE/1040.jpg',
        'action' => 
        array (
          'type' => 'uri',
          'label' => 'SMULE',
          'uri' => 'https://www.smule.com/NEW_KBS_OFFICIAL',
        ),
      ),
    ),
  ),
),
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == '/shalat') {

        $result = shalat($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Nnestore' || $command == 'nnestore' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
  'type' => 'imagemap',
  'baseUrl' => 'https://res.cloudinary.com/eds0101/image/upload/v1528021812/ANNE/READY',
  'altText' => 'NNESTORE - READY',
  'baseSize' => 
  array (
    'height' => 1040,
    'width' => 1040,
  ),
  'actions' => 
  array (
    0 => 
    array (
      'type' => 'uri',
      'linkUri' => 'https://line.me/R/ti/p/%40zuu3727b',
      'area' => 
      array (
        'x' => 0,
        'y' => 0,
        'width' => 1040,
        'height' => 1040,
      ),
    ),
  ),
)
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Struktur' || $command == 'struktur' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
  'type' => 'imagemap',
  'baseUrl' => 'https://res.cloudinary.com/eds0101/image/upload/v1534129121/KBS/5',
  'altText' => 'Staff Organization New KBS',
  'baseSize' => 
  array (
    'height' => 1040,
    'width' => 1040,
  ),
  'actions' => 
  array (
    0 => 
    array (
      'type' => 'message',
      'text' => 'Struktur',
      'area' => 
      array (
        'x' => 520,
        'y' => 0,
        'width' => 520,
        'height' => 1040,
      ),
    ),
  ),
)
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Program' || $command == 'program' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
  'type' => 'imagemap',
  'baseUrl' => 'https://res.cloudinary.com/eds0101/image/upload/v1534075430/KBS/3',
  'altText' => 'Program New KBS',
  'baseSize' => 
  array (
    'height' => 1040,
    'width' => 1040,
  ),
  'actions' => 
  array (
    0 => 
    array (
      'type' => 'message',
      'text' => 'Program',
      'area' => 
      array (
        'x' => 520,
        'y' => 0,
        'width' => 520,
        'height' => 1040,
      ),
    ),
  ),
)
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Visi' || $command == 'Misi' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
  'type' => 'imagemap',
  'baseUrl' => 'https://res.cloudinary.com/eds0101/image/upload/v1534075454/KBS/4',
  'altText' => 'VISI & MISI New KBS',
  'baseSize' => 
  array (
    'height' => 1040,
    'width' => 1040,
  ),
  'actions' => 
  array (
    0 => 
    array (
      'type' => 'message',
      'text' => 'Visi',
      'area' => 
      array (
        'x' => 520,
        'y' => 0,
        'width' => 520,
        'height' => 1040,
      ),
    ),
  ),
)
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Haha' || $command == 'Hahaha' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
  'type' => 'imagemap',
  'baseUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1532322034/Stiker/3',
  'altText' => 'Team VoLS mengirim sticker',
  'baseSize' => 
  array (
    'height' => 1040,
    'width' => 1040,
  ),
  'actions' => 
  array (
    0 => 
    array (
      'type' => 'message',
      'text' => 'Haha',
      'area' => 
      array (
        'x' => 520,
        'y' => 0,
        'width' => 520,
        'height' => 1040,
      ),
    ),
  ),
)
            )
        );
    }
}
//pesan bergambar
if($message['type']=='text') {
	    if ($command == 'Sepi' || $command == 'sepi' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array (
  'type' => 'imagemap',
  'baseUrl' => 'https://res.cloudinary.com/tes5566/image/upload/v1532323952/Stiker/4',
  'altText' => 'Team VoLS mengirim sticker',
  'baseSize' => 
  array (
    'height' => 1040,
    'width' => 1040,
  ),
  'actions' => 
  array (
    0 => 
    array (
      'type' => 'message',
      'text' => 'Sepi',
      'area' => 
      array (
        'x' => 520,
        'y' => 0,
        'width' => 520,
        'height' => 1040,
      ),
    ),
  ),
)
            )
        );
    }
}
if (isset($balas)) {
    $result = json_encode($balas);
//$result = ob_get_clean();

    file_put_contents('./balasan.json', $result);


    $client->replyMessage($balas);
}
?>

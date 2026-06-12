<?php

use App\Models\RequestEksport;
use App\Models\SettingNumberSKA;


//list device
function listDevice(){
   $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.starsender.online/api/devices',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type:application/json',
        'Authorization: ' . config('services.blast.starsender_key')
    ),
));

    $response = curl_exec($curl);
    return $response;
}
function detailDevice($idDevice){
    $curl = curl_init();
    curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.starsender.online/api/devices/'.$idDevice,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:application/json',
    'Authorization: ' . config('services.blast.starsender_key')
  ),
));


    $response = curl_exec($curl);
    return $response;
}
function relogDevice($idDevice){
    $curl = curl_init();
   curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.starsender.online/api/devices/'.$idDevice.'/relog',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Content-Type:application/json',
    'Authorization: ' . config('services.blast.starsender_key')
  ),
));

    $response = curl_exec($curl);
    return $response;
}
function addDevices($name){
    $curl = curl_init();
    $data = [
        "name" => $name
    ];
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.starsender.online/api/devices/create/scan',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
        'Content-Type:application/json',
        'Authorization: ' . config('services.blast.starsender_key')
    ),
    ));

    $response = curl_exec($curl);
    return $response;
}
function deleteDevice($id){
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.starsender.online/api/whatsapp/devices/'.$id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'DELETE',
    CURLOPT_HTTPHEADER => array(
        'Content-Type:application/json',
        'Authorization: ' . config('services.blast.starsender_key')
    ),
    ));

    $response = curl_exec($curl);
    return $response;
}
function sendWhatshapp($to,$message){
    $curl = curl_init();
    $pesan = [
    "messageType" => "text",
    "to" => $to,
    "body" => $message,
    ];

    curl_setopt_array($curl, array(
    CURLOPT_URL => env('WA_URL') . '/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($pesan),
    CURLOPT_HTTPHEADER => array(
        'Content-Type:application/json',
        'Authorization: ' . config('services.blast.device_key')
    ),
    ));

    $response = curl_exec($curl);
    return $response;
}

function sendWhatshappGroup($groupNam,$message){
   $curl = curl_init();

    $pesan = [
        "messageType" => "text",
        "to" => $groupNam,
        "body" => $message,
        
    ];

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.starsender.online/api/send/grup',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($pesan),
    CURLOPT_HTTPHEADER => array(
        'Content-Type:application/json',
        'Authorization: ' . config('services.blast.device_key')
    ),
    ));

    $response = curl_exec($curl);
    return $response;
}

function listGroupWa(){
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.starsender.online/api/whatsapp/groups',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type:application/json',
        'Authorization: ' . config('services.blast.device_key')
    ),
    ));

    $response = curl_exec($curl);
    return $response;
}

/**
 * Kirim WA Blast ke banyak penerima via StarSender Rotator API
 *
 * @param  array  $messages  Array of ['to' => '62xxx', 'body' => '...', 'delay' => 15]
 * @param  array  $devices   Array of ['device_id' => id, 'limit' => 50]
 */
function sendWaBlast(array $messages, array $devices = [])
{
    // Ensure numeric fields are proper integers (Go API is strict about types)
    $devices = array_map(function ($d) {
        return [
            'device_id' => (int) ($d['device_id'] ?? 0),
            'limit'     => (int) ($d['limit']     ?? 100),
        ];
    }, $devices);

    $messages = array_map(function ($m) {
        $m['delay'] = (int) ($m['delay'] ?? 15);
        return $m;
    }, $messages);

    $payload = [
        'mode'     => 'round_robin',
        'devices'  => $devices,
        'messages' => $messages,
    ];

    try {
        $client   = new \GuzzleHttp\Client(['timeout' => 30]);
        $response = $client->post('https://api.starsender.online/api/send/rotator', [
            'headers' => [
                'Content-Type'  => 'application/json',
                'Authorization' =>  config('services.blast.starsender_key'),
            ],
            'json' => $payload,
        ]);

        return (string) $response->getBody();
    } catch (\Throwable $e) {
        return json_encode(['status' => false, 'message' => $e->getMessage()]);
    }
}

function toEmpatDigit($number){
  if ($number < 10) {
    return "000".$number;
  }else if ($number < 100) {
    return "00".$number;
  }else if ($number < 1000) {
    return "0".$number;
  }else{
    return $number;
  }
}
function toDuaDigit($number){
  
  if ($number < 10) {
    return "00".$number;
  }
  if ($number < 100) {
    return "0".$number;
  }else{
    return $number;
  }
}
function getTahun(){
  $tahun = [];
  $tahun_sekarang = date('Y');
  for ($i=$tahun_sekarang - 1; $i <= date('Y') ; $i++) { 
    $tahun[$i] = $i;
  }
  return $tahun;

}
function getBulan(){
  return [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
  ];

}

function intToMonth($num)
{
   switch ($num) {
       case 1:
            return "Januari";
            break;
       case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
       
       default:
           return "";
           break;
   }
}

function integerToRoman($integer)
{
    $integer = intval($integer);
    $result = '';
    
    // Create a lookup array that contains all of the Roman numerals.
    $lookup = ['M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1];

    foreach ($lookup as $roman => $value) {
        $matches = intval($integer/$value);
        $result .= str_repeat($roman, $matches);
        $integer = $integer % $value;
    }

    return $result;
}
 function integerToHuruf($integer)
{
    switch ($integer) {
        case 0:
            return "Kosong";
            break;
        case 1:
            return "Pertama";
            break;
        case 2:
            return "Kedua";
            break;
        case 3:
            return "Ketiga";
            break;
        default:
            return "";
            break;
    }
}

function terbilang($bilangan) {

    $angka = array('0','0','0','0','0','0','0','0','0','0',
                   '0','0','0','0','0','0');
    $kata = array('','satu','dua','tiga','empat','lima',
                  'enam','tujuh','delapan','sembilan');
    $tingkat = array('','ribu','juta','milyar','triliun');
  
    $panjang_bilangan = strlen($bilangan);
  
    /* pengujian panjang bilangan */
    if ($panjang_bilangan > 15) {
      $kalimat = "Diluar Batas";
      return $kalimat;
    }
  
    /* mengambil angka-angka yang ada dalam bilangan,
       dimasukkan ke dalam array */
    for ($i = 1; $i <= $panjang_bilangan; $i++) {
      $angka[$i] = substr($bilangan,-($i),1);
    }
  
    $i = 1;
    $j = 0;
    $kalimat = "";
  
  
    /* mulai proses iterasi terhadap array angka */
    while ($i <= $panjang_bilangan) {
  
      $subkalimat = "";
      $kata1 = "";
      $kata2 = "";
      $kata3 = "";
  
      /* untuk ratusan */
      if ($angka[$i+2] != "0") {
        if ($angka[$i+2] == "1") {
          $kata1 = "seratus";
        } else {
          $kata1 = $kata[$angka[$i+2]] . " ratus";
        }
      }
  
      /* untuk puluhan atau belasan */
      if ($angka[$i+1] != "0") {
        if ($angka[$i+1] == "1") {
          if ($angka[$i] == "0") {
            $kata2 = "sepuluh";
          } elseif ($angka[$i] == "1") {
            $kata2 = "sebelas";
          } else {
            $kata2 = $kata[$angka[$i]] . " belas";
          }
        } else {
          $kata2 = $kata[$angka[$i+1]] . " puluh";
        }
      }
  
      /* untuk satuan */
      if ($angka[$i] != "0") {
        if ($angka[$i+1] != "1") {
          $kata3 = $kata[$angka[$i]];
        }
      }
  
      /* pengujian angka apakah tidak nol semua,
         lalu ditambahkan tingkat */
      if (($angka[$i] != "0") OR ($angka[$i+1] != "0") OR
          ($angka[$i+2] != "0")) {
        $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
      }
  
      /* gabungkan variabe sub kalimat (untuk satu blok 3 angka)
         ke variabel kalimat */
      $kalimat = $subkalimat . $kalimat;
      $i = $i + 3;
      $j = $j + 1;
  
    }
  
    /* mengganti satu ribu jadi seribu jika diperlukan */
    if (($angka[5] == "0") AND ($angka[6] == "0")) {
      $kalimat = str_replace("satu ribu","seribu",$kalimat);
    }
  
    return trim($kalimat);
  
  } 

  function tgl_indo($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

?>
<?php namespace Codecheck;
$jsonUrl = "memo.json"; //JSONファイルの場所とファイル名を記述
if(file_exists($jsonUrl)){
  $json = file_get_contents($jsonUrl);
  $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $memo = json_decode($json,true);
}else {
  echo "データがありません";
}

function run ($argc, $argv){
	if ($argc == 2) {
		$seed = $argv[0];
		$n = intval($argv[1]);

		printf("%d", f($n,$seed));
		$memo_str = json_encode($memo);
		file_put_contents("memo.json" , $memo_str);
	} elseif ($argc > 2) {
		printf("Too many input");
		exit(1);
	} else {
		printf("Please input something more");
		exit(1);
	}
}

//再起関数
function f($n,$seed) {
	if ($n == 0) {
		return 1;
	} elseif ($n == 2) {
		return 2;
	} elseif (($n %2) == 0) {
		return f($n - 1, $seed) + f($n - 2, $seed) + f($n - 3, $seed) + f($n - 4, $seed);
	} else {
		$temp = isset($memo[$seed][$n]) ? $memo[$seed][$n] : askServer($n,$seed);
		return $temp;
	}
}

function askServer($n,$seed){
	$curl = curl_init();
  $base_url = 'http://challenge-server.code-check.io/api/recursive/ask';

	// curlの設定
	curl_setopt($curl, CURLOPT_URL, $base_url.'?seed='.$seed.'&n='.$n);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	//APIから結果を入手
	$response = curl_exec($curl);
	$result = json_decode($response, true);
	$http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);

	//ステータスコードで条件分岐
	if ($http_status == '503') {
		printf("Ooops, Service Unavailable");	
	} elseif ($http_status == '200') {
		$hash = intval($result['result']);
		$memo[$seed][$n] = $hash;
		return $hash;
	} else {
		printf("Ooops, there is a glitch...");
		exit(1);
	}
}

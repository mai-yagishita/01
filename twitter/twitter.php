<?php

require_once ('vendor/autoload.php');

use Abraham\TwitterOAuth\TwitterOAuth;

//設定
$consumerKey = "UhuBsj54DbRnnHGQYaPywHmAi";
$consumerSecret = "e1zSaGoQorVKzyW5W7U8LaAmkUsf3nnjdIHCxh45Y03bnnBj86";
$accessToken = "42566916-5CI2BDtmiUQdWFKtTY6ajgxmLlYjURI4ftW2K88h3";
$accessTokenSecret = "YHfdFB1RJxIcHQ6XOriX0GZhmZmFpNmI5wegaBIRDflIU";

//認証
$twObj = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);

$keyword = "JustinBieber"; //検索キーワード

//検索結果の取得
$req = $twObj->OAuthRequest(
		'https://api.twitter.com/1.1/search/tweets.json',
		'GET',
		array(
				"q"=>rawurlencode($keyword), //検索キーワード
				"result_type"=>"recent",	//新着順に取得
				"count"=>30,					//取得件数（100件が上限）
				"include_entities"=>true,	//trueにすると添付URLについての情報を追加で取得できる
				'filter' => 'images',
				"exclude"=>"retweets"
		)
);
$req = mb_convert_encoding($req, "SJIS", "UTF-8");
$reqset = json_decode($req, true);

date_default_timezone_set( 'Asia/Tokyo' );
$count = 0;
foreach ($reqset['statuses'] as $result){
	$img = "";

	if(isset($result['entities']['media']) && $count < 10){
		if(isset($result['entities']['media'][0]['media_url']) && $result['entities']['media'][0]['media_url'] != ''){
			$img = $result['entities']['media'][0]['media_url'];

			//画像のURLからファイル名を生成
			$filename = basename($img);

			//ファイル名をユニークにするために、ダウンロード時のタイムスタンプを付ける
			$filename = date('Ymdhis').$filename;
			sleep(1);

			//画像の取得と保存
			$data = file_get_contents($img);
			file_put_contents('./download/'.$filename,$data);

			$count += 1;

		}
	}
}


<?php
	require_once("debbuger/Kint.class.php");
	require_once("config.php");
	$json = file_get_contents('https://www.googleapis.com/youtube/v3/search?part=snippet&order=date&channelId='.$idchannel.'&maxResults=50&fields=etag%2CeventId%2Citems%2Ckind%2CnextPageToken%2CpageInfo%2CprevPageToken%2CregionCode%2CtokenPagination%2CvisitorId&key='.$key);
    $data=json_decode($json,true);
    $jsonvideo = file_get_contents('https://www.googleapis.com/youtube/v3/search?part=snippet&channelId='.$idchannel.'&maxResults=50&fields=etag%2CeventId%2Citems%2Ckind%2CnextPageToken%2CpageInfo%2CprevPageToken%2CregionCode%2CtokenPagination%2CvisitorId&key='.$key);
    $datavideo=json_decode($json,true);
    array_shift($datavideo['items']);
?>
<html>
	<head>
		<link rel="stylesheet" href='header.css'>
		<script src="header.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-rc1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<title></title>
	</head>
	<body>
		<header class="main-header">
		  <h1 style='margin-top:10px;margin-left:40px;'> 
		  	<a href="/portal/">
		  		<img class="img img-responsive" src="http://www.lamandaukab.go.id/portal/theme/front/img/logo-text-black-color.png" style="position:absolute;top:6px">
		  		<!--  <img class="img img-responsive" src="<?php echo $data['items'][0]['snippet']['thumbnails']['default']['url'];?>" style="position:absolute;top:6px"> -->
		  	</a>
		  </h1>
		</header>
		<main class="content">
			<div class="panel panel-default">
			  <div class="panel-body">
					<img src="<?php echo $data['items'][0]['snippet']['thumbnails']['medium']['url'];?>">
					<h1><?php echo $data['items'][0]['snippet']['title'];?></h1>
					<h5>Deskripsi 
						<?php
					  	if(empty($data['items'][0]['snippet']['description'])){
					  		echo "Deskripsi Kosong";
					  	}else{
					  		echo $data['items'][0]['snippet']['description'];
					  	}
					  	?>
					</h5>
					<?php foreach($datavideo['items'] as $key=>$val){?>
						<li class="list-group-item">
				    		<a href="play_video.php?video=<?php echo $val['id']['videoId'];?>">
				    		<img src="<?php echo $val['snippet']['thumbnails']['default']['url'];?>">
				    		</a>&nbsp;<?php echo $val['snippet']['title']; ?>
					<?php
					}
					?>
				</div>
			</div>
		</main>
	</body>
</html>
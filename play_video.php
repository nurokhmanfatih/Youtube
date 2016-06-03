<?php
	require_once("function.php");
	require_once("config.php");
	$videoid=$_GET['video'];
	$json = file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=status%2Csnippet%2C+statistics%2C+topicDetails&id='.$videoid.'&key='.$key);
    $data=json_decode($json,true);
    $tanggal=$data['items'][0]['snippet']['publishedAt'];
    $tgl=explode('T',$tanggal);
    // echo "<pre>";
    // print_r($data);
    // exit();
?>
	<html>
		<head>
			<link rel="stylesheet" href='header.css'>
			<script src="header.js"></script>
			<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
    		<script src="http://mediaelementjs.com/js/mejs-2.9.2/mediaelement-and-player.min.js"></script>
    		<link rel="stylesheet" href="http://mediaelementjs.com/js/mejs-2.9.2/mediaelementplayer.min.css" />
			<script type="text/javascript">
				jQuery(document).ready(function($) {
    			var player = new MediaElementPlayer('#player1');
				});
				$(document).ready(function(){
    				$("#loadcomment").click(function(){
    					var idvideo=$('#idvideo').val();
    					$.ajax({
                              type:"POST",
                              url:"get_comment.php",
                              data:"video="+idvideo+"",
                              success:function(data){
                                 $("#show").html(data);
                            }
                        });
    				});
    			});
			</script>
			<style>
				.tags {
				  list-style: none;
				  margin: 0;
				  overflow: hidden; 
				  padding: 0;
				}

				.tags li {
				  float: left; 
				}

				.tag {
				  background: #eee;
				  border-radius: 3px 0 0 3px;
				  color: #999;
				  display: inline-block;
				  height: 26px;
				  line-height: 26px;
				  padding: 0 20px 0 23px;
				  position: relative;
				  margin: 0 10px 10px 0;
				  text-decoration: none;
				  -webkit-transition: color 0.2s;
				}

				.tag::before {
				  background: #fff;
				  border-radius: 10px;
				  box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
				  content: '';
				  height: 6px;
				  left: 10px;
				  position: absolute;
				  width: 6px;
				  top: 10px;
				}

				.tag::after {
				  background: #fff;
				  border-bottom: 13px solid transparent;
				  border-left: 10px solid #eee;
				  border-top: 13px solid transparent;
				  content: '';
				  position: absolute;
				  right: 0;
				  top: 0;
				}

				.tag:hover {
				  background-color: crimson;
				  color: white;
				}

				.tag:hover::after {
				   border-left-color: crimson; 
				}
			</style>
			<title><?php echo $data['items'][0]['snippet']['title'];?></title>
		</head>
		<body>
			<header class="main-header">
			  <h1 style='margin-top:10px;margin-left:40px;'> 
			  	<a href="/portal/">
			  		<img class="img img-responsive" src="http://www.lamandaukab.go.id/portal/theme/front/img/logo-text-black-color.png" style="position:absolute;top:6px">
			  		 <!-- <img class="img img-responsive" src="<?php echo $data['items'][0]['snippet']['thumbnails']['default']['url'];?>" style="position:absolute;top:6px"> -->
			  	</a>
			  </h1>
			</header>
			<main class="content">
			<div class="panel panel-default">
			  <div class="panel-body">
				<div class='videoku' style="margin-left:30px;margin-top:30px;">
					<video width="640" height="360" id="player1" preload="none">
		            	<source type="video/youtube" src="http://www.youtube.com/watch?v=<?php echo $videoid;?>" />
		        	</video>
	        	</div>
		        	<ul class="list-group" style="margin:30px;">
					  <li class="list-group-item">Nama Channel: <?php echo $data['items'][0]['snippet']['channelTitle'];?></li>
					  <li class="list-group-item">Judul Video: <?php echo $data['items'][0]['snippet']['title'];?></li>
					  <li class="list-group-item">Tanggal Publikasi: <?php echo date_id(date('d F Y',strtotime($tgl[0])));?></li>
					  <li class="list-group-item">Deskripsi Video:  
					  	<?php
					  	if(empty($data['items'][0]['snippet']['description'])){
					  		echo "Deskripsi Kosong";
					  	}else{
					  		echo $data['items'][0]['snippet']['description'];
					  	}
					  	?>
					  </li>
					  <li class="list-group-item">Tags :
					  	<ul class='tags'>
					  		<?php 
					  		if(empty($data['items'][0]['snippet']['tags'])){
					  			echo "Tag Kosong";
					  		}else{
						  		foreach($data['items'][0]['snippet']['tags'] as $tags){ ?>
						  			<li class='tag'><?php echo $tags;?></li>
						  		<?php 
					  			}
					  		}
					  		?>
					  	</ul>
					  </li>
					   <li class="list-group-item">
					   	<img src="like.png" width="30" height="30" title="Suka">&nbsp;<strong title="<?php echo Terbilang($data['items'][0]['statistics']['likeCount']);?>"><?php echo number_format($data['items'][0]['statistics']['likeCount'],0,'.','.');?></strong>&nbsp;
					   	<img src="dislike.png" width="30" height="30" title="Tidak Suka">&nbsp;<strong title="<?php echo Terbilang($data['items'][0]['statistics']['dislikeCount']);?>"><?php echo number_format($data['items'][0]['statistics']['dislikeCount'],0,'.','.');?></strong>&nbsp;
					   	<img src="view.png" width="30" height="30" title="Di Lihat">&nbsp;<strong title="<?php echo Terbilang($data['items'][0]['statistics']['viewCount']);?>"><?php echo number_format($data['items'][0]['statistics']['viewCount'],0,'.','.');?></strong>&nbsp;
					   	<img src="favorite.png" width="30" height="30" title="Favorit">&nbsp;<strong title="<?php echo Terbilang($data['items'][0]['statistics']['favoriteCount']);?>"><?php echo number_format($data['items'][0]['statistics']['favoriteCount'],0,'.','.');?></strong>&nbsp;
					   	<img src="comment.png" width="30" height="30" title="Komentar">&nbsp;<strong title="<?php echo Terbilang($data['items'][0]['statistics']['commentCount']);?>"><?php echo number_format($data['items'][0]['statistics']['commentCount'],0,'.','.');?></strong>&nbsp;
					   </li>
					</ul>
				</div>
			</div>
		</body>
	</html>

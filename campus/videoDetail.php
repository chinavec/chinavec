
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>微电影学院-视频素材</title>
<?php date_default_timezone_set("Asia/Shanghai");?>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/base.css" />
<script src="js/html5media.min.js"></script>
<!--<script type="text/javascript" src="http://html5media.googlecode.com/svn/trunk/src/html5media.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="css/movieDetail.css" />
</head>

<style type="text/css">
body {
	text-align:center;
	background:#333 repeat 0px 1px;
}
</style>
<script type="text/javascript">
	function promot(b){
	     return confirm(b);
	}
</script>
<body>
<?php 
		session_start();
		$id = $_GET['id'];
		//<!--登录-->
		require "../common/checkLog.php";
		if(!(isset($_SESSION['islogin']) && $_SESSION['islogin'] = true))
		{
			include "login.php"; 
			//include "siteview.php";
		}else{
			include "../LoginSuccess.php";
			//include "userview.php";
		};
		
		//<!--登录-->
		//检查该页面是否已合法获取视频ID及ID是否为数值型
		if (!(isset($_GET['id']) && ctype_digit($_GET['id']))) {
			header("Location:movie.php?msg=invalid");
			exit;
		}
		
		require "lib/connect.php";
		
		function sec2time($sec){	
			$sec = round($sec/60);
			if ($sec >= 60){
				$hour = floor($sec/60);
				$min = $sec%60;
				$res = $hour.'小时';
				$min != 0  &&  $res .= $min.'分';
			}else{
				$res = $sec.'分钟';
			}
			return $res;
			}
			
		$sql="select * from material WHERE `id` = $id";
		$result=mysql_query($sql);
		$row=mysql_fetch_object($result);
		$form=explode("/",$row->file_url);
		$name=$form[5];
		//print_r($row);
	?>
<?php if(!(isset($_SESSION['islogin']) && $_SESSION['islogin'] == true)){
	$i=1;
	}else{
	$i=0;	
	}; 

?>
<script type="text/javascript">
	//function promot(b){
	//     return confirm(b);
	//}
$(function() {
  $("#download").click(function() {
	if(<?php echo $i; ?>){
	alert('请先登录');
	window.location.href='index.php';
	event.preventDefault();
	return false;
	};
	return confirm("下载该素材需5积分");
  });
})
</script>
<!--<p style="float:right; color:#FFFFFF; font-size:14px; margin:10px 25px 0 0;"><span class="orange12">admin</span>，您好</p>-->

<div id="layout">
<br/><br/>
<?php include "common/table1.php";?>

    	<div id="movieTitle">
			<div style="float:left;">
            <p style="color:#FFFFFF; font-size:15px;"><?php echo $row->title;?>
            &nbsp;&nbsp;<span style="color:#AAAAAA;font-size:12px;"><?php echo $row->title;?></span></p>
            <span style="color:#AAAAAA;font-size:12px;">ChinaVEC首页 >微电影学院 >微元素 >视频素材&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
        <!--<div style="float:right;">
            <form action="searchList.php" method="get">
                <input type="text" name="keyWord" placeholder="输入名称查询"  class="searchBlock"/>
                <input type="submit" value="搜索" class="searchButton"/>
            </form>
            </div>-->
        </div>
		
        <div style="margin-left:0;width:100%">
        <!--HTML5的video标签-->
			<video width="960" height="550" controls id="video">
            	<?php 
					/*是否存在id.jpg的文件
					若存在$poster = $row['id'].".jpg"
					否则 $poster = 0.jpg*/
					//$config['videoRoot'] = '../../chvec_cd/';
					//$config['video']   =  'material';
					$file = $row->file_url;
					//echo $row->video_url;
					//echo $file;
					//echo $config['videoRoot'];
					//exit;
					if(file_exists($file)){
						$videoUrl = $file;
						//echo $videoUrl."存在";
						//exit;
					}
					else{
						$videoUrl = $config['videoRoot'].$config['video']."0.mp4";
						//echo $videoUrl;
						//exit;
						}
				?>
			 	<source src="<?php echo $videoUrl;?>" type="video/mp4">
				<p>抱歉，您的浏览器不支持视频video标签</p>
                

				
			</video>
    	</div> 
</div> 
<br/>
<a href="videodown.php?id=<?php echo $row->id; ?>&name=<?php echo $name; ?>" id="download" />
<img src="img/download.png" width="250px" style="margin:0px 0px 0px 0px; "></a>
<!--movieDetail Start-->        
	<?php 
		//$sec = $row->dur;onclick="return promot('下载该素材需5积分');"
		//$min = sec2time($sec);
	?>
    <div class="movieDetail" style="height:390px;"> 
    	<br/>
		<div class="movieDetail2" style="height:350px;">
            <div style="width:600px;margin:25px 10px 0px 30px;float:left;">
                <br/>
                <p class="jieshaoT">视频信息</p>
                <br/><br/>
                <!--<p>名称：<span><?php echo $row->title_cn;?></span></p>
                <p>制片人：<span><?php echo $row->producer;?></span></p>
                <p>导演：<span><?php echo $row->director;?></span></p>
                <p>演员：<span><?php echo $row->stars;?></span></p>
                <p>片长：<span><?php echo $min;?></span></p>
                <p>标签：<span><?php echo $row->tags;?></span></p>
                <br/><br/>
                <p>简介：<span class="greySmall"><?php echo $row->dscrp;?></span></p>-->
                <div class="p_half">
						<span class='gray14'>名称：</span>
                        <span class='black14'><?php echo $row->title;?></span>
                   </div>
					<!--<div class="p_half">
                    	<span class='gray14'>主演：</span>
                        <span class='black14'><?php echo $row->stars;?></span><br/>
                    </div>
                    <div class="p_half">
                        <span class='gray14'>标签：</span>	
                        <span class='black14'><?php 
							$tags = $row->tags;
							$array = explode('；',$tags);
							//print_r($array);
							foreach((array)$array as $key => $tag){
								echo "<a href='searchTagList.php?tag=".$tag."'>".$tag."</a>";
								echo " ";
							}
						?></span><br/>
                    </div>-->
                    <div class="p_half">
                        <span class='gray14'>类别：</span>	
                        <span class='black14'><?php echo '视频素材';?></span><br/>
                    </div>
                    <!--<div class="p_half">
                        <span class='gray14'>年份：</span>	
                        <span class='black14'><?php echo $row->year;?></span><br/>
                    </div>-->
                    <div class="p_half">
                    <?php 
						//$sec = $row->dur;
						//$min = sec2time($sec);
					?>
                        <span class='gray14'>时间：</span>	
                        <span class='black14'><?php echo $row->create_time;?></span><br/>
                    </div>
                    <div style=" margin-top:30px;">   
                        <span class='gray14'>简介：</span>
                        <span class='gray14'><?php echo $row->abstract;?></span><br/>
                	</div>
 <br/><br/>
                    <a style="margin-left:15px" href="videomore.php">返回</a><br/><br/>
            </div>

            <!--<div style="margin:25px 5px 0px 5px;float:right;">
            	<br/>
                <p class="jieshaoT">本周热播榜</p>
                <br/><br/>
                <table width="300px">
                <tr>
                    <td>1</td>
                    <td class="grey12">阿根达斯</td>
                    <td class="grey12">微电影</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td class="grey12">音乐星期五</td>
                    <td class="grey12">微栏目</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td class="grey12">爱的画工</td>
                    <td class="grey12">微动漫</td>
                </tr>
                <tr>
                	<td>4</td>
                    <td class="grey12">千百个</td>
                    <td class="grey12">微纪录</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td class="grey12">寒战</td>
                    <td class="grey12">微电影</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td class="grey12">假面骑士</td>
                    <td class="grey12">创意视频</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td class="grey12">爱嘉</td>
                    <td class="grey12">微电影</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td class="grey12">蠕动</td>
                    <td class="grey12">微电影</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td class="grey12">爱情的样子</td>
                    <td class="grey12">微电影</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td class="grey12">27岁</td>
                    <td class="grey12">微电影</td>
                </tr>
                </table>
              </div>-->
        </div>
    </div>
<!--movieDetail END-->       
    
    

<?php
	//require('common/footer.php');
?>
<div style="width:100%; float:auto; margin-top:50px; margin-bottom:20px;clear:both" >
	<!--<p align="center" style="color:#FFF; padding-top:15px">支持单位与合作媒体</p>-->
		<div style="width:480px; height:180px; margin:0 auto;">
		</br>
        <img src="img/logo_wall.jpg" width="480px" height="140px" style="margin:0 auto;"/>
		<p align="center" style=" color:#FFF; padding-top:1px; font-size:14px;">copyright © 2013-2014 中国微视频协作与交易平台<br/>All Rights Reserved. 中国传媒大学 新媒体研究院</p>type="text/javascript"
		<!--<img src="img/cuc_logo.jpg" width="130px" height="90px" style="margin:5px auto auto 10px; float:left"  />
		<img src="img/zg_logo.jpg" width="130px" height="90px" style="margin:5px auto auto 35px; float:left"  />
		<img src="img/xhs_logo.jpg" width="130px" height="90px" style="margin:5px auto auto 35px; float:left" />-->
		</div>
	</div>
	<!--logo-->

</body>
</html>

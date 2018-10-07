<?php
date_default_timezone_set("Asia/Calcutta");
include('config.php');
include('func.php');
$api_url = NEWS_API_URL."top-headlines?country=in&apiKey=".NEWS_API_KEY;
$top_headline = get_news_api_info($api_url);
//pre($top_headline);
?> 
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
	<style type="text/css">
		.card-img-top{
			height: 200px;
		}
	</style>
	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="card-deck">
			
			<?php
				if(!empty($top_headline['articles'])){
					$i=1;
					foreach ($top_headline['articles'] as $key => $value) {
						//pre($value);
						?>
						
							<div class="card" style="">
								<?php if(!empty($value['urlToImage'])){ ?>
							  		<img class="card-img-top" src="<?php e($value['urlToImage']) ?>" alt="Card image cap">
							  	<?php }?>
							  <div class="card-body">
							    <h5 class="card-title"><?php e($value['title']) ?></h5>
							    <p class="card-text"><?php e($value['description']) ?></p>
							    <p class="card-text"><small><?php e($value['author']) ?></small></p>
							    <input type="hidden" class="hid_news_det" value="<?php e(json_encode($value)) ?>" />
							    <a href="javascript:void(0);" data-url="<?php e($value['url']) ?>"  class=" news_det btn btn-primary">View detail</a>
							  </div>
							  <div class="card-footer">
							      <small class="text-muted"><?php e(date('j D F Y h:i A',strtotime($value['publishedAt']))) ?></small>
							    </div>
							</div>
							
							
						
						<?php
						if($i%2 ==0){
							?>
							</div>
							<br><br>
							<div class="card-deck">
							<?php
						}
						$i++;
					}
				}
			?>
			
		</div>
		
	</div>
	<div class="modal fade" tabindex="-1" role="dialog" id="news_mod">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">News detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="news_mod_body">
            <iframe src="" id="news_i" style="width: 100%;height: 100vh; border:0;"></iframe>
          </div>
          <div class="modal-footer">
           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
</div>
<script  type="text/javascript">
    $(function(){
        $('.news_det').click(function(){
            var e = $(this);
            var data_url = e.attr('data-url');
           $('#news_i').attr('src',data_url);
            /*swal({
              title: "Please Wait..",
              closeOnClickOutside: false,
              closeOnEsc: false,
              buttons: false
            });
            $.ajax( {
                  url:'result.html',
                  success:function(data) {
                     $('#stage').html(data);
                  }
            });
            $('#news_mod_body').load(data_url,function(result){      
	            
	            swal.close();
	        });*/
            $('#news_mod').modal('show');  
            $('#news_mod').modal('handleUpdate')         
        })
    })
</script>
</body>
</html>
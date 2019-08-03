<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<script type="text/javascript" src="/ui/js/jquery.min.js"></script>
<script type="text/javascript" src="/ui/js/bootstrap.min.js"></script>

<title>403</title>
<style>
	h3{
		font-size:60px;
		color:#0;
		text-align:center;
		padding-top:30px;
		font-weight:normal;
	}
</style>
</head>

<body>
<?php $error_msg =  isset($_REQUEST['error_msg'])? $_REQUEST['error_msg']: "服务器上文件或目录拒绝访问!";
      $return_url = isset($_REQUEST['return_url'])? $_REQUEST['return_url']: "";
?>
<div class="container">
<div class="row">
<h3>403, <?php echo $error_msg; ?></h3>
</div>
<?php if (!empty(return_url)):?>
<div class="row">
<div class="col-md-*-auto">
<p class="text-center"><button type="button" id="btn-back" class="btn btn-big btn-primary">返回</button></p>
</div>
</div>
<?php endif ?>
</div>
<?php if (!empty(return_url)):?>
<script>
    $(document).ready(function(){
        $("#bnt-back").click(function(){
           window.location="<?php echo $return_url; ?>";     
        });
    });
</script>
<?php endif ?>
</body>
</html>
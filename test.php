<?php include_once '/eduGraph/config/config.php';?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $siteName;?></title>
        <script>
        $('#nav').affix({
      offset: {
        top: $('header').height()
      }
});	

$('#sidebar').affix({
      offset: {
        top: 200
      }
});	
</script>
<style>
.navbar-form input, .form-inline input {
	width:auto;
}



header {
	height:280px;
}

#nav.affix {
    position: fixed;
    top: 0;
    width: 100%;
    z-index:10;
}

#sidebar.affix-top {
    position: static;
}

#sidebar.affix {
    position: fixed;
    top: 80px;
}
</style>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</head>
<body>
<header class="masthead">
  <div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h1><a href="#" title="scroll down for your viewing pleasure">Bootstrap 3 Layout Template</a><p class="lead">Big Top Header and Fixed Sidebar</p></h1>
    </div>
    <div class="col-sm-6">
      <div class="pull-right hidden-sm">    
        <h1><a href="#"><i class="glyphicon glyphicon-user"></i> <i class="glyphicon glyphicon-chevron-down"></i></a></h1>
      </div>
    </div>
  </div>
  </div>
</header>	  	  	
  	
  	
<!-- Begin Navbar -->
<div id="nav">
  <div class="navbar navbar-default navbar-static">
    <div class="container">
      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="glyphicon glyphicon-bar"></span>
        <span class="glyphicon glyphicon-bar"></span>
        <span class="glyphicon glyphicon-bar"></span>
      </a>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li class="divider"></li>
          <li><a href="#">Link</a></li>
          <li><a href="#">Link</a></li>
        </ul>
        <ul class="nav pull-right navbar-nav">
          <li>
            <form class="navbar-form">
          <input type="text" class="form-control" placeholder="Search">
          <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
        </form>
          </li>
          <li>
            <a href="#"><i class="glyphicon glyphicon-flag"></i> <span class="badge">2</span></a>
          </li>
        </ul>
      </div>		
    </div>
  </div><!-- /.navbar -->
</div>

<!-- Begin Body -->
<div class="container">
	<div class="row">
  			<div class="col-sm-3">
      			<ul id="sidebar" class="nav nav-pills nav-stacked">
                  	<li><a href="#">Side</a></li>
          			<li><a href="#">Side</a></li>
 					<li class="divider"></li>
          			<li><a href="#">Side</a></li>
          			<li><a href="#">Side</a></li>
				</ul>
      		</div>  
      		<div class="col-sm-9">
              	<h2>Content</h2>
                <img src="//placehold.it/300x300/EEEEEE/EEEEEE" class="img-circle pull-right">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, 
                totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae 
                dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia cor magni dolores 
                eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, 
                sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. 
                Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?
              
              	<hr class="col-sm-12">
              
              	<h2>Content</h2>
                <img src="/assets/example/bg_dogcat.jpg" style="height:300px;width:300px;" class="img-circle pull-right">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, 
                totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae 
                dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia cor magni dolores 
                eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, 
                sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. 
                Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut
              
              	<hr class="col-sm-12">
              
              	<h2>Content</h2>
      			<img src="/assets/example/bg_blueplane.jpg" style="height:300px;width:300px;" class="img-circle pull-right">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, 
                totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae 
                dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia cor magni dolores 
                eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, 
                sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. 
                Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut
              
              	<hr class="col-sm-12">
              
              	<h2>Content</h2>
      			Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, 
                totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae 
                dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia cor magni dolores 
                eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, 
                sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. 
                Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut
              
              	<h2>Content</h2>
      			Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, 
                totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae 
                dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia cor magni dolores 
                eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, 
                sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. 
                Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut
              
              
              	<hr>
              	<h4><a href="http://bootply.com/69848">Edit on Bootply</a></h4>
              	<hr>
              	
      		</div> 
  	</div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>left</title>
    
  
</head>
<style>
body,html{
    height: 100%;
  }
.modal {
  padding-top:0%; 
  padding-left:0%;
  padding-right:0%; 
}



  nav.sidebar, .main{
    -webkit-transition: margin 200ms ease-out;
      -moz-transition: margin 200ms ease-out;
      -o-transition: margin 200ms ease-out;
      transition: margin 200ms ease-out;
  }

  .main{
    padding: 10px 10px 0 10px;
  }

 @media (min-width: 765px) {

    .main{
      position: absolute;
      width: calc(100% - 40px); 
      margin-left: 40px;
      float: right;
    }

    nav.sidebar:hover + .main{
      margin-left: 200px;
    }

    nav.sidebar.navbar.sidebar>.container .navbar-brand, .navbar>.container-fluid .navbar-brand {
      margin-left: 0px;
    }

    nav.sidebar .navbar-brand, nav.sidebar .navbar-header{
      text-align: center;
      width: 100%;
      margin-left: 0px;
    }
    
    nav.sidebar a{
      padding-right: 13px;
    }

    nav.sidebar .navbar-nav > li:first-child{
      border-top: 1px #e5e5e5 solid;
    }

    nav.sidebar .navbar-nav > li{
      border-bottom: 1px #e5e5e5 solid;
    }

    nav.sidebar .navbar-nav .open .dropdown-menu {
      position: static;
      float: none;
      width: auto;
      margin-top: 0;
      background-color: transparent;
      border: 0;
      -webkit-box-shadow: none;
      box-shadow: none;
    }

    nav.sidebar .navbar-collapse, nav.sidebar .container-fluid{
      padding: 0 0px 0 0px;
    }

    .navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
      color: #777;
    }

    nav.sidebar{
      width: 200px;
      height: 100%;
      margin-left: -160px;
      float: left;
      margin-bottom: 0px;
    }

    nav.sidebar li {
      width: 100%;
    }

    nav.sidebar:hover{
      margin-left: 0px;
    }

    .forAnimate{
      opacity: 0;
    }
  }
   
  @media (min-width: 1330px) {

    .main{
      width: calc(100% - 200px);
      margin-left: 200px;
    }

    nav.sidebar{
      margin-left: 0px;
      float: left;
    }

    nav.sidebar .forAnimate{
      opacity: 1;
    }
  }

  nav.sidebar .navbar-nav .open .dropdown-menu>li>a:hover, nav.sidebar .navbar-nav .open .dropdown-menu>li>a:focus {
    color: #CCC;
    background-color: transparent;
  }

  nav:hover .forAnimate{
    opacity: 1;
  }
  section{
    padding-left: 15px;
  }
  
 #modal-dialog{
	overflow:auto;
position: relative;
  width: 60%;	
 }
.footer_msg{
	position:absolute;
	width:50%;
}
.footer_close{
	float:right;
	
	width:50%;
}
.modal.modal-wide .modal-dialog {
  width: 75%;
  height:100%;
  margin-bottom:10%;
 
}
.modal-wide .modal-body {
  overflow-y: auto;
}
.running{
	  border-color: #b92c28;
	  padding-left:19px;
	  
}
.Finished{
	  border-color: #b92c28;
	  padding-left:19px;
	  
}
.aborted{
	border-color:blue;
	 padding-left:19px;

}
</style>

</head>
<body>
	<nav class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
      <div id="accordian">
	<ul>
		<li>
			<h3><span class="icon-dashboard"></span>Dashboard</h3>
			<ul>
				<li><a href="#">Reports</a></li>
				<li><a href="#">Search</a></li>
				<li><a href="#">Graphs</a></li>
				<li><a href="#">Settings</a></li>
			</ul>
		</li>
		<!-- we will keep this LI open by default -->
		<li class="active">
			<h3><span class="icon-tasks"></span>Tasks</h3>
			<ul>
				<li><a href="#">Today's tasks</a></li>
				<li><a href="#">Urgent</a></li>
				<li><a href="#">Overdues</a></li>
				<li><a href="#">Recurring</a></li>
				<li><a href="#">Settings</a></li>
			</ul>
		</li>
		<li>
			<h3><span class="icon-calendar"></span>Calendar</h3>
			<ul>
				<li><a href="#">Current Month</a></li>
				<li><a href="#">Current Week</a></li>
				<li><a href="#">Previous Month</a></li>
				<li><a href="#">Previous Week</a></li>
				<li><a href="#">Next Month</a></li>
				<li><a href="#">Next Week</a></li>
				<li><a href="#">Team Calendar</a></li>
				<li><a href="#">Private Calendar</a></li>
				<li><a href="#">Settings</a></li>
			</ul>
		</li>
		<li>
			<h3><span class="icon-heart"></span>Favourites</h3>
			<ul>
				<li><a href="#">Global favs</a></li>
				<li><a href="#">My favs</a></li>
				<li><a href="#">Team favs</a></li>
				<li><a href="#">Settings</a></li>
			</ul>
		</li>
	</ul>
</div>

<!-- prefix free to deal with vendor prefixes -->
<script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript"></script>

<!-- jQuery -->
<script src="http://thecodeplayer.com/uploads/js/jquery-1.7.1.min.js" type="text/javascript"></script>
    </div>
  </div>
</nav>
	<div class="TasksContainer"></div>
	</body>
	
	function getRunning(){
		
$('.TasksContainer').append('<div class="container">'+
				'<div class="row clearfix">'+
				'<div class="col-md-12 column">'+

					
					'<div class="modal modal-wide fade" id="modal-container-659890" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header">'+
									 '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
									'<h4 class="modal-title" id="myModalLabel">'+
										'Tasks-Running'+
									'</h4>'+
								'</div>'+
								'<div class="modal-body">'+
								
								+'<div class="row selectioncontainer">'

+'<table id="example" class="table table-striped table-bordered tableContainer" cellspacing="0" width="100%">'
        +'<thead>'
            +'<tr >'
						+'<th class="sorting_asc sorting">'
							+"JobID"
						+'</th>'
						+'<th>'
							+"JobName"
						+'</th>'
						+'<th>'
							+"createdAt"
						+'</th>'
						
						+'<th>'
							+"Progress"
						+'</th>'
						+'<th>'
							+"Hosts"
						+'</th>'
						+'<th>'
							+"filers"
						+'</th>'
						+'<th>'
							+"Stop"
						+'</th>'
						+'<th>'
							+"Logs"
						+'</th>'
						
            +'</tr>'
        +'</thead>'
		
		
		//sample
		   +'<tbody>'
            
        +'</tbody>'
		
		
         
        
					
			+'</table>'+

								
								'</div>'+
								'<div class="modal-footer">'+
								'<div class="footer_msg">'
								+'* Please click on View to obtain logs'
								+'</div>'
									 +'<div class="footer_close">'
									 +'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
                                      + '</div>'+
										'</div>'+
							'</div>'+
							
						'</div>'+  
						
					'</div>'+
					
				'</div>'+
			'</div>'+
		'</div>'+
		'</div>');
		
		
		$.ajax({ 
		type: "GET", 
		url: "/nlab/getRunning", 
		
		dataType: "JSON",
		success: function(data){
			
			
		
			$.each(data,function(i,RunningJobs){
				//console.log(resources);
				
				$.each(RunningJobs,function(i,RunningJob){
					
						//RunningInfo=RunningInfo+" * "+RunningJob.id+"<br/>";
		$('#example').append('<tr><th>'+RunningJob.id+'</th><th>'+RunningJob.job_name+'</th><th>'+RunningJob.createdAt+'</th><th>'+RunningJob.status+'</th><th>'+RunningJob.hosts_num+'</th><th>'+RunningJob.filers_num+'</th><th>'+'<a href="">'+"cancel"+'</a>'+'</th><th>'+'<a href="user/example2" onclick="fun()" target="_blank" >'+"View"+'</a>'+'</th></tr>');

						
					
					 
					});

				});
				
				//ocument.getElementById('Running').innerHTML=RunningInfo;
		   
			console.log('Success!');
			
	      }
	   
	   
		}) ;
        
	}
	
	function getFinished(){
		
$('.TasksContainer').append('<div class="container">'+
				'<div class="row clearfix">'+
				'<div class="col-md-12 column">'+

					
					'<div class="modal modal-wide fade" id="modal-container-659892" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header">'+
									 '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
									'<h4 class="modal-title" id="myModalLabel">'+
										'Tasks-Finshed'+
									'</h4>'+
								'</div>'+
								'<div class="modal-body">'+
								
								+'<div class="row selectioncontainer">'

+'<table id="tasks_finshed" class="table table-striped table-bordered tableContainer" cellspacing="0" width="100%">'
        +'<thead>'
            +'<tr >'
						+'<th class="sorting_asc sorting">'
							+"JobID"
						+'</th>'
						+'<th>'
							+"JobName"
						+'</th>'
						+'<th>'
							+"createdAt"
						+'</th>'
						
						+'<th>'
							+"Progress"
						+'</th>'
						+'<th>'
							+"Hosts"
						+'</th>'
						+'<th>'
							+"filers"
						+'</th>'
						+'<th>'
							+"Stop"
						+'</th>'
						+'<th>'
							+"Logs"
						+'</th>'
						
            +'</tr>'
        +'</thead>'
		
		
		//sample
		   +'<tbody>'
            
        +'</tbody>'
		
		
         
        
					
			+'</table>'+

								
								'</div>'+
								'<div class="modal-footer">'+
								'<div class="footer_msg">'
								+'* Please click on View to obtain logs'
								+'</div>'
									 +'<div class="footer_close">'
									 +'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'
                                      + '</div>'+
										'</div>'+
							'</div>'+
							
						'</div>'+  
						
					'</div>'+
					
				'</div>'+
			'</div>'+
		'</div>'+
		'</div>');
		
		
		$.ajax({ 
		type: "GET", 
		url: "/nlab/getFinished", 
		
		dataType: "JSON",
		success: function(data){
			
			
		
			$.each(data,function(i,FinishedJobs){
				//console.log(resources);
				
				$.each(FinishedJobs,function(i,FinishedJob){
					
						//RunningInfo=RunningInfo+" * "+RunningJob.id+"<br/>";
		$('#tasks_finshed').append('<tr><th>'+FinishedJob.id+'</th><th>'+FinishedJob.job_name+'</th><th>'+FinishedJob.createdAt+'</th><th>'+FinishedJob.status+'</th><th>'+FinishedJob.hosts_num+'</th><th>'+FinishedJob.filers_num+'</th><th>'+ '<a href="">'+"cancel"+'</a>'+'</th><th>' +'<a href="user/example2">'+"View"+'</a>'+'</th></tr>');

						
					
					 
					});

				});
				
				//ocument.getElementById('Running').innerHTML=RunningInfo;
		   
			console.log('Success!');
			
	      }
	   
	   
		}) ;
        
	}
		
		function getAborted(){
			alert("no code has been included");
		}
	
	$(".modal-wide").on("show.bs.modal", function() {
  var height = $(window).height() - 200;
  $(this).find(".modal-body").css("max-height", height);
});
	
	</script>
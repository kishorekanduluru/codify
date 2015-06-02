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

.modal-title {
  color: black;
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
.queue{
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
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/nlab/login" method="post">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tasks<span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
		  <li><div class="queue"><a id="modal-queue" href="#modal-container-queue"  data-toggle="modal" onclick="getQueuedTasks()">Queued</a></div></li>
		  <li><div class="running"><a id="modal-659890" href="#modal-container-659890"  data-toggle="modal" onclick="getRunning()">Running</a></div></li>
           <li><div class="Finished"><a id="modal-659892" href="#modal-container-659892"  data-toggle="modal" onclick="getFinished()">Finished</a></div></li>  
           <li><div class="aborted"><a id="modal-659893" href="#modal-container-659893"  data-toggle="modal" onclick="getAborted()">Aborted</a></div></li>  
          
            
          </ul>
        </li>          
		
        <li><a id="modal-template" href="#modal-container-template"  data-toggle="modal" onclick="getTemplate()">Templates<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>        
		<div class="template"> </div>
       
		<li><a href="#modal-container-659893">History<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
		
	 </ul>
    </div>
  </div>
</nav>
	<div class="TasksContainer"></div>
	</body>
	<script>
	function getQueuedTasks(){
		
$('.TasksContainer').append('<div class="container">'+
				'<div class="row clearfix">'+
				'<div class="col-md-12 column">'+

					
					'<div class="modal modal-wide fade" id="modal-container-queue" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header">'+
									 '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
									'<h4 class="modal-title" id="myModalLabel">'+
										'Tasks-Queued'+
									'</h4>'+
								'</div>'+
								'<div class="modal-body">'+
								
								+'<div class="row selectioncontainer">'

+'<table id="queue" class="table table-striped table-bordered tableContainer" cellspacing="0" width="100%">'
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
							+"Manage"
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
		url: "/nlab/getQueueInfo", 
		
		dataType: "JSON",
		success: function(data){
			
			$("#TasksContainer tbody").html();
		
			$.each(data,function(i,QueuedJobs){
				//console.log(QueuedJobs);
				$('#queue tbody').empty();
				$.each(QueuedJobs,function(i,QueuedJob){
					//console.log(RunningJob);
					
					//RunningInfo=RunningInfo+" * "+RunningJob.id+"<br/>";
		$('#queue').append('<tr><th>'+QueuedJob.id+'</th><th>'+QueuedJob.job_name+'</th><th>'+QueuedJob.createdAt+'</th><th>'+QueuedJob.status+'</th><th>'+QueuedJob.hosts_num+'</th><th>'+QueuedJob.filers_num+'</th><th>'+'<a id='+QueuedJob.id+' href="" onclick="removeFrmQueue(this,'+QueuedJob.id+'); return false;">'+"kill"+'</a>'+'</th><th>'+'<a href="/nlab/user/logs" onclick="fun()" target="_blank" >'+"View"+'</a>'+'</th></tr>');

						
					
					 
					});

				});
				
				//ocument.getElementById('Running').innerHTML=RunningInfo;
		   
			console.log('Success!');
			
	      }
	   
	   
		}) ;
		
        
	}
	
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

+'<table id="running" class="table table-striped table-bordered tableContainer" cellspacing="0" width="100%">'
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
							+"Manage"
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
			
			$("#TasksContainer tbody").html();
		
			$.each(data,function(i,RunningJobs){
				//console.log(data);
				$('#running tbody').empty();
				$.each(RunningJobs,function(i,RunningJob){
					console.log(RunningJob);
					
					//RunningInfo=RunningInfo+" * "+RunningJob.id+"<br/>";
		$('#running').append('<tr><th>'+RunningJob.id+'</th><th>'+RunningJob.job_name+'</th><th>'+RunningJob.createdAt+'</th><th>'+RunningJob.status+'</th><th>'+RunningJob.hosts_num+'</th><th>'+RunningJob.filers_num+'</th><th>'+'<a id='+RunningJob.id+' href="" onclick="setTerminating(this,'+RunningJob.id+');return false;">'+"abort"+'</a>'+'</th><th>'+'<a href="/nlab/user/logs" onclick="fun()" target="_blank" >'+"View"+'</a>'+'</th></tr>');

						
					
					 
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
							+"Manage"
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
			
			$('#tasks_finshed tbody').empty();
		
			$.each(data,function(i,FinishedJobs){
				//console.log(resources);
				
				$.each(FinishedJobs,function(i,FinishedJob){
					
						//RunningInfo=RunningInfo+" * "+RunningJob.id+"<br/>";
		$('#tasks_finshed').append('<tr><th>'+FinishedJob.id+'</th><th>'+FinishedJob.job_name+'</th><th>'+FinishedJob.createdAt+'</th><th>'+FinishedJob.status+'</th><th>'+FinishedJob.hosts_num+'</th><th>'+FinishedJob.filers_num+'</th><th>'+ '<a id= href="" onclick="restart(this,'+FinishedJob.id+'); return false;">'+"Restart"+'</a>'+'</th><th>' +'<a href="user/logs">'+"View"+'</a>'+'</th></tr>');

						
					
					 
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
	function getTemplate(){
		//alert("iam in");
		$('.template').append('<div class="container">'+
				'<div class="row clearfix">'+
				'<div class="col-md-12 column">'+

					
					'<div class="modal modal-wide fade" id="modal-container-template" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'+
						'<div class="modal-dialog">'+
							'<div class="modal-content">'+
								'<div class="modal-header">'+
									 '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
									'<h4 class="modal-title" id="myModalLabel">'+
										'Templates Information'+
									'</h4>'+
								'</div>'+
								'<div class="modal-body">'+
								
								+'<div class="row selectioncontainer">'

+'<table id="template_Info" class="table table-striped table-bordered tableContainer" cellspacing="0" width="100%">'
        +'<thead>'
            +'<tr >'
						+'<th class="sorting_asc sorting">'
							+"Template_Name"
						+'</th>'
						//+'<th>'
						//	+"Job_name"
						//+'</th>'
						+'<th>'
							+"createdAt"
						+'</th>'
						
						+'<th>'
							+"Owner"
						+'</th>'
						+'<th>'
							+"Hosts"
						+'</th>'
						+'<th>'
							+"filers"
						+'</th>'
						+'<th>'
							+"clone"
						+'</th>'
						+'<th>'
							+"Delete"
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
								+'* Please click on clone to create a new job'
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
		url: "/nlab/getTemplates", 
		
		dataType: "JSON",
		success: function(data){
			    $('#template_Info tbody').empty();
				$.each(data,function(i,TemplateDetails){
				//console.log(resources);
				
				$.each(TemplateDetails,function(i,TemplateInfo){
					
						//RunningInfo=RunningInfo+" * "+RunningJob.id+"<br/>";
		$('#template_Info').append('<tr><th>'+TemplateInfo.template_name+'</th><th>'+TemplateInfo.time+'</th><th>'+TemplateInfo.owner+'</th><th>'+TemplateInfo.no_Hosts+'</th><th>'+TemplateInfo.no_Filers+'</th><th>'+'<a href="">'+"clone"+'</a>'+'</th><th>'+'<a href="" onclick="fun()" target="_blank" >'+"Delete"+'</a>'+'</th></tr>');

						
					
					 
					});

				});
				
		
		
				
				//ocument.getElementById('Running').innerHTML=RunningInfo;
		   console.log(data);
			console.log('Success!');
			
	      }
	   
	   
		}) ;
		
		
	}
	
	
	$(".modal-wide").on("show.bs.modal", function() {
  var height = $(window).height() - 200;
  $(this).find(".modal-body").css("max-height", height);
});
	
	function removeFrmQueue(selectedJob,jobId){
		$.ajax({ 
		type: "GET", 
		url: "/nlab/removeTaskFrmQueue", 
		data :{'jobId':jobId},
		dataType: "JSON",
		success: function(data){
			console.log(data);
			getQueuedTasks();
			
		}
	   }) ;
	   return false;
	}
	function setTerminating(selectedJob,jobId){
		$.ajax({ 
		type: "GET", 
		url: "/nlab/setTerminatingFrmRunning", 
		data :{'jobId':jobId},
		dataType: "JSON",
		success: function(data){
			getRunning();
			console.log(data);
		}
	   
	  }) ;
	}
	
	function restart(selectedJob,jobId){
		
			$.ajax({ 
		type: "GET", 
		url: "/nlab/restart", 
		data :{'jobId':jobId},
		dataType: "JSON",
		success: function(data){
			if(data =="false"){
				alert("Resoources are busy");
				return false;
			}
			getFinished();
		}
	   
	  }) ;
	}
	</script>
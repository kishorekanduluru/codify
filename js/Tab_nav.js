$(function() {
	//Get the first tab in document and will assume only one
	var $tabs = $("#tabs");
    $tabs.tabs();
    var HostsArr = [];
	var selectedTab = $(document).find('div[class^="ui-tabs"]').first();
	var UId=$("#tabs .ui-tabs-panel:visible").attr("id");
	
	  var last = $(".ui-tabs-nav li").last().index();
	  arr=[];
	  for(i=1;i<=last;i++){
	  arr.push(i);
	  }
	  $( "#tabs" ).tabs('option','disabled', arr);
	 
	  
	  
	 //	alert("function loaded "+UId);
	//console.log(selectedTab);
	//Navigation button, select tab when button click.
	$(".Footer").on(
			'click',
			':button',
			function() {

				var selected = selectedTab.tabs("option", "active");

				if (this.id == "btnMoveLeftTab") {
						if (selected >= 1) {
						$tabs.tabs("option", 'disabled', selected);	
						$tabs.tabs('enable', selected-1);
						selectedTab.tabs("option", "active", selected - 1);
					}
				} else if (this.id == "btnMoveRightTab") {
					$tabs.tabs("option", 'disabled', selected);
					$tabs.tabs('enable', selected+1);
					
					selectedTab.tabs("option", "active", selected + 1);
				} else {
					
					
					
					var UId=$("#tabs .ui-tabs-panel:visible").attr("id");
					var OSSelect = document.getElementById('os' + UId).options[document
					                                       					.getElementById('os' + UId).selectedIndex].text;
					confirm('Are you sure you want to tab away without saving?');
					if (OSSelect == "Select") {
						alert("Please Select something");
						selected = selectedTab.tabs("option", "active");
						confirm('Are you sure you want to tab away without saving?');
					}
					
					
				
					
				$('#tabs .ui-tabs-nav a').each(function () {

					 function Host(hostId,osType,version,architecture,protocol){
						  this.hostId=hostId;
						  this.osType=osType;
						  this.version=version;
						  this.architecture=architecture;
						  this.protocol=protocol;
					  }
					 
				var hostId=$(this).attr('UId');
				var OSSelect = document.getElementById('os' + hostId).options[document.getElementById('os' + hostId).selectedIndex].text;
				var version = document.getElementById('versions' + hostId).options[document.getElementById('versions' + hostId).selectedIndex].text;
				
				var architecture=document.querySelector('[name='+'architecture'+UId+']:checked').value;
				
				var protocol=document.querySelector('[name='+'protocol'+UId+']:checked').value;
				
				var object=new Host(hostId,OSSelect,version,architecture,protocol);
				
				HostsArr.push(object);
				
				});
				
				
				var hostsJSON = JSON.stringify(HostsArr);
//				console.log(hostsJSON);
//				var hostsOptn =  { HostsArr : HostsArr };

//				hostObjects =  '{"data" :' + JSON.stringify(hostsJSON) +'}';
				$.ajax({ 
					type: "POST", 
					url: "hostOptions", 
					data :{	'jsondata':	hostsJSON},
					
				   
				   
					}) 
					
					
				}

				selected = selectedTab.tabs("option", "active");
			});

	//Tab activated, only display next on first tab, and previous in last tab
	
	selectedTab.tabs({
		
		beforeActivate : function(event, ui) {
			
			var UId = ui.oldPanel.attr('id');
//			alert("beforeactive");
			var selected = selectedTab.tabs("option", "active");

//			if (selectedTab.find("li:not(li[style='display:active'])").size()== selected){
//			UId=ui.oldPanel.attr('id');
//			 alert("iam  ***********"+UId);
//			 }
			var OSSelect = document.getElementById('os' + UId).options[document
					.getElementById('os' + UId).selectedIndex].text;
			if (OSSelect == "Select") {
				alert("Please Select something");
				return false;
			}
		}
	});

	selectedTab.tabs({

		activate : function(event, ui) {
//			alert("active");
			//        	var UId=ui.newPanel.attr('id');
			var active = selectedTab.tabs("option", "active");
			var selected = selectedTab.tabs("option", "active");
			if (active == 0) {
				$("#btnMoveLeftTab").hide();
				$("#submitTab").hide();
			} else if (selectedTab.find("li:not(li[style='display:active'])").size()-1== selected) {
				$("#btnMoveRightTab").hide();
				$("#submitTab").show();
			} else {
				$("#btnMoveLeftTab").show();
				$("#btnMoveRightTab").show();
				$("#submitTab").hide();
			}

		}
	});
	
//	$('ul li').each(function(i)
//			{
//			   $(this).attr('rel'); // This is your rel value
//			});

	//First load
	$("#btnMoveLeftTab").hide();
	$("#submitTab").hide();

});


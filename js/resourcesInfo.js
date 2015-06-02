$(function() {
	//Get the first tab in document and will assume only one
	var $tabs = $("#tabs");
    $tabs.tabs();
    var HostsArr = [];
	var selectedTab = $(document).find('div[class^="ui-tabs"]').first();
	var UId=$("#tabs .ui-tabs-panel:visible").attr("id");
	
	  var last = $(".ui-tabs-nav li").last().index();
	  if(last>=1){
		  arr=[];
		  for(i=1;i<=last;i++){
		  arr.push(i);
		  }
		  $( "#tabs" ).tabs('option','disabled', arr);
		  }
		
		
	//	alert("function loaded "+UId);
	//console.log(selectedTab);
	//Navigation button, select tab when button click.
	$(".Footer").on(
			'click',
			':button',
			function() { 
				
				var UId;
				
				var selected = selectedTab.tabs("option", "active");
                 
				if (this.id == "btnMoveLeftTab") {
				
				
						if (selected >= 1) {

						$tabs.tabs("option", 'disabled', selected);	
						$tabs.tabs('enable', selected-1);
						selectedTab.tabs("option", "active", selected - 1);
					}
				} else if (this.id == "btnMoveRightTab") {
					
					UId=$("#tabs .ui-tabs-panel:visible").attr("id");
					
						
					//alert("iam selected");
					$tabs.tabs("option", 'disabled', selected);
					$tabs.tabs('enable', selected+1);
					
					selectedTab.tabs("option", "active", selected + 1);
				} else {
					
					resourcesConfirm();
					//UId=$("#tabs .ui-tabs-panel:visible").attr("id");
					//console.log("iam in ");
					//console.log(hosts);
					//confirm('Are you sure you want to Submit');
					
				}

				selected = selectedTab.tabs("option", "active");
				
			});

	//Tab activated, only display next on first tab, and previous in last tab
	
	selectedTab.tabs({
		
		beforeActivate : function(event, ui) {
			
			var UId = ui.oldPanel.attr('id');
			//alert("beforeactive");
			var selected = selectedTab.tabs("option", "active");

//			if (selectedTab.find("li:not(li[style='display:active'])").size()== selected){
//			UId=ui.oldPanel.attr('id');
//			 alert("iam  ***********"+UId);
//			 }
//			var OSSelect = document.getElementById('os' + UId).options[document
//					.getElementById('os' + UId).selectedIndex].text;
//			if (OSSelect == "Select") {
//				alert("Please Select something before active");
//				return false;
//			}
		}
	});

	selectedTab.tabs({

		activate : function(event, ui) {
//			alert("active");
			//        	var UId=ui.newPanel.attr('id');
			var active = selectedTab.tabs("option", "active");
			var selected = selectedTab.tabs("option", "active");
			var last = $(".ui-tabs-nav li").last().index();  
			
			 if (selectedTab.find("li:not(li[style='display:active'])").size()-1== selected) {
				 if(last == 1){
					$("#btnMoveLeftTab").show();
				 }
				$("#btnMoveRightTab").hide();
				$("#submitTab").show();
				
			}else if (active == 0 ) {
				$("#btnMoveRightTab").show();
				$("#btnMoveLeftTab").hide();
				$("#submitTab").hide();
			} 
			else {
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
	if(last==0){
		  
		    $("#btnMoveLeftTab").hide();
			$("#btnMoveRightTab").hide();
			$("#submitTab").show();
	  }
	else{
	$("#btnMoveLeftTab").hide();
	$("#submitTab").hide();
	}
});




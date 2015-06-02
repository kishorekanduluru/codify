<!DOCTYPE html>
<html lang="en">


<style>

.navbar-custom{
/* background-color:#ffffff; */
background-color: #e7e7e7;
font-family:   Comic Sans, Comic Sans MS, cursive;
font-size:      1.3em;
font-weight:500;    
 height:7%;
 
 position:relative;
 /*background-color:green; */
 margin-bottom:4px;
}
.navbar{
}
li a {
  color: rgb(0, 103, 196);
}
.navbar-default .navbar-nav>li>a {
  color: rgb(0, 103, 196);
}
.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus {
  color: rgb(0, 103, 196);
}  
.left{
	position:relative;
	width:50%;
	height:100%;
	float:left;
}
.right{
	position:relative;
	width:50%;
	float:left;
	height:100%;
}
.mainContainer{
	position:relative;
	width:100%;
	height:100%;
}
.menubar{
	position:relative;
	width:100%;
	height:100%;
}
</style>
<body>
<div class="navbar navbar-custom">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
<!--           <a class="navbar-brand" href="#">BootstrapBay</a> -->
        </div>
        <div class="navbar-collapse menubar">
		<div class="mainContainer">
		<div class="left">
		<ul id="left_menu" class="nav navbar-nav navbar-left">
         
         </ul>
		 </div>
		 <div class="right" style="display:inline-block">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="/nlab/login">Home</a></li>       
            <li><a href="#about">ELMS</a></li>
            <li><a href="#about">LabRaTT</a></li>          
            <li><a href="#">MyAccount</a></li>
          </ul>
		  </div>
        </div>
		</div><!--/.nav-collapse -->
      </div>
    </div>
</body>
</html>                                		
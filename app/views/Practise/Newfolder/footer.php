< ?php
 $conn = mysql_connect('localhost', 'root', 'kishore@123');
 $db   = mysql_select_db('nlab');
 $sql = "SELECT * FROM os";
 $res = mysql_query($sql);
 $result = array();
 while( $row = mysql_fetch_array($res) )
 array_push($result, array('os_id' => $row[0],
			                'software_name'  => $row[1],
						  );
 
		echo json_encode(array("result" => $result));
?>
<html>
<head>
<title>Fetch/Extract Data From Database: jQuery + JSON + PHP+ AJAX</title>
</head>
<body>
<ul></ul>
<script type="text/javascript" src="../../../js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="script/my_script.js"></script>
</body>
</html>
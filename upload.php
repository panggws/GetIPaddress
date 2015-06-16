<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
//header('content-type:text/plain');
if(!file_exists("upload")){
	mkdir("upload");
}
if($_FILES["file"]["error"] > 0){
	$er = "ERROR Return Code: ".$_FILES["file"]["error"]."<br/>";
}else{
	$data = $_FILES["file"]["name"];
	move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"]);
	$filedata = fopen("upload/".$_FILES["file"]["name"],"r");
	
	while(($line = fgetcsv($filedata)) !==FALSE){
		$csv[] = $line;
	}
	$arrlength = count($csv);
	
?>
<table border="2" cellspacing="3" > 
<thead>
<th>no.</th>
<th>Subdomain</th>
<th>ip address</th>
</thead>
<?php
 for($i=1;$i<$arrlength;$i++){
   // echo $csv[$i][2]."\n";
?>
  <tr><td><?php echo $i ;?>
  <td>
<?php
  $url = $csv[$i][2];
  echo "$url";
?>
</td>
<td>
<?php
  $ip = gethostbyname($url);
  echo("   $ip  " ."\n");
?>
  </td></tr>
<?php
 }
 ?>
 </table> 
 <?php
	/*for($i=1;$i<$arrlength;$i++){
		$ip[$i] = gethostbyname($csv[$i][2]); 
		echo $ip[$i]."\t" ."\t";
		echo $csv[$i][2]."\n";
		
		
	}*/
	fclose($filedata);
}
?>
</body>
</html>
<?php // custom WordPress database error page

  header('HTTP/1.1 503 Service Temporarily Unavailable');
  header('Status: 503 Service Temporarily Unavailable');
  header('Retry-After: 600'); // 1 hour = 3600 seconds
$ip = $_SERVER['REMOTE_ADDR'];
$hostaddress = gethostbyaddr($ip);
$browser = $_SERVER['HTTP_USER_AGENT'];
$referred = $_SERVER['HTTP_REFERER'];
$currentFile = dirname(__FILE__).$_SERVER["PHP_SELF"];
if( $referred == "" ) $referred = 'Direct Page Request';
  // If you wish to email yourself upon an error
if( stripos($currentFile, 'wp-content') === false ):
  mail('admin@imagedesignpros.com', "URGENT: Database Error - ".$_SERVER['HTTP_HOST'], "There is a problem with the database connection for ".$_SERVER['HTTP_HOST']."!\n\nUser IP: $ip\nUser Host: $hostaddress\nUser Browser: $browser\nReferred: $referred\nCurrent File: $currentFile\n\n\n", "From: alert@".$_SERVER['HTTP_HOST']);
else:
  echo 'Direct Access Fail'; exit;
endif;

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Website Unavailable - Database Error</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<style type="text/css">
body{
	font-family:Georgia, "Times New Roman", Times, serif;
	min-width:600px;
}
#Container{
	width:500px;
	margin:200px auto;
	text-align:center;
}
#logo{
	background:url(/logo.png) no-repeat top center;
	height:165px;
	text-indent: -9999px;
}
a{
	color:	#343591;
	font-weight:bold;
	text-decoration:none;
	border-bottom: dashed 1px #343591;
}
a:hover, a:active, a:focus{
	color: #6BB445;
	border-color:#6BB445;
}
a img{
	border:none;	
}
p.icons a{
	border:none;
	margin: 0 5px;
}
p{
	margin: 20px 0;	
	font-size: 12px;
}
</style>

</head>
<body>
<div id="Container">
	<h1 id="logo">imageDESIGN</h1>
    <p><strong>This website is temporarily unavailable.  Please check back soon.</strong></p>

    <p>Need something to do in the meantime?<br />
    View our work at <a href="http://imagedesignpros.com">imagedesignpros.com</a></p>
    <p class="icons"><a href="http://www.facebook.com/imageDESIGN"><img src="/facebook.png" width="32px" height="32px" alt="Facebook" /></a>
       <a href="http://twitter.com/imageDESIGN"><img src="/twitter.png" width="32px" height="32px" alt="Twitter" /></a>
       <a href="http://www.linkedin.com/companies/image-design-professionals-inc.?trk=ppro_cprof&lnk=vw_cprofile"><img src="/linkedin.png" width="32px" height="32px" alt="LinkedIn" /></a></p>
</div>
</body>
</html>
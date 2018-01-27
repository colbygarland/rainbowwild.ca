<?php // custom WordPress Maintenance Page

$protocol = $_SERVER["SERVER_PROTOCOL"];
if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol ) $protocol = 'HTTP/1.0';
header( "$protocol 503 Service Unavailable", true, 503 );
header( 'Content-Type: text/html; charset=utf-8' );
header( 'Retry-After: 60' ); // 1 minute


?>
<!DOCTYPE HTML>
<html>
<head>
<title>Website Unavailable - Maintenance</title>
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
    <p><strong>This website is temporarily unavailable due to automated maintenance. <br>We should be back online in a minute.</strong></p>

    <p>Need something to do in the meantime?<br />
    View our work at <a href="http://imagedesignpros.com">imagedesignpros.com</a></p>
    <p class="icons"><a href="http://www.facebook.com/imageDESIGN"><img src="/facebook.png" width="32px" height="32px" alt="Facebook" /></a>
       <a href="http://twitter.com/imageDESIGN"><img src="/twitter.png" width="32px" height="32px" alt="Twitter" /></a>
       <a href="http://www.linkedin.com/companies/image-design-professionals-inc.?trk=ppro_cprof&lnk=vw_cprofile"><img src="/linkedin.png" width="32px" height="32px" alt="LinkedIn" /></a></p>
</div>
</body>
</html>
	<div class="container">     
            <footer class="main">
                        <p>&copy;2015 <?php echo get_option('blogname');?> <span>|</span>
                        <a href="http://imagedesignpros.com" target="_blank">Website by imageDESIGN</a></p>
            </footer>
    </div><!-- End .container -->


<!-- Outdated Browser -->
<div id="outdated">
     <h6>Your browser is out-of-date!</h6>
     <!--[if lt IE 9]>
         <p><strong>You are using an extremely <strong>outdated</strong> browser version (It's over 10 years old!).</strong></p>
         <![endif]-->
     <p>Please update your browser to view this website correctly. <a id="btnUpdateBrowser" href="http://outdatedbrowser.com/">Update my browser now </a></p>
     <p class="last"><a href="#" id="btnCloseUpdateBrowser" title="Close">&times;</a></p>
</div>
    
<!-- Font Activation -->    
<script type="text/javascript">
var MTIProjectId='';
 (function() {
        var mtiTracking = document.createElement('script');
        mtiTracking.type='text/javascript';
        mtiTracking.async='true';
        mtiTracking.src=('https:'==document.location.protocol?'https:':'http:')+'//fast.fonts.net/t/trackingCode.js';
        (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild( mtiTracking );
   })();
</script>
<?php wp_footer(); ?>
</body>
</html>
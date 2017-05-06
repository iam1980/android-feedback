<div class="container">
    <div class="row">
        <div class="span12">
            <br/>

            <div class="well well-small">
                <strong>
                    <small>Copyright &copy; <?php echo date('Y'); ?> <a href="http://www.suredigit.com">SUREDIGIT</a></small>
                </strong>

                <div class="pull-right">
                    <small>
                        <a href="https://plus.google.com/110189242197157809025" rel="publisher">Google+</a><?php echo sprintf(lang('website_page_rendered_in_x_seconds'), $this->benchmark->elapsed_time()); ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?skin=desert"</script>


<script>!function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (!d.getElementById(id)) {
        js = d.createElement(s);
        js.id = id;
        js.src = "//platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);
    }
}(document, "script", "twitter-wjs");</script>
<script type="text/javascript">
    (function () {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
    })();
</script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-3512796-16']);
    _gaq.push(['_trackPageview']);

    (function () {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();

</script>
</body>
</html>
<div class="row page_margin_top">
    <div class="share_box clearfix">
        <label>Share:</label>
        <ul class="social_icons clearfix">
            <li>
                <div id="ok_shareWidget"></div>
            </li>
            <li>
                <div class="fb-like" data-width="80" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
            </li>
        </ul>
    </div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=643449299009004&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<script>
    !function (d, id, did, st) {
        var js = d.createElement("script");
        js.src = "http://connect.ok.ru/connect.js";
        js.onload = js.onreadystatechange = function () {
            if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                if (!this.executed) {
                    this.executed = true;
                    setTimeout(function () {
                        OK.CONNECT.insertShareWidget(id,did,st);
                    }, 0);
                }
            }};
        d.documentElement.appendChild(js);
    }(document,"ok_shareWidget","http://eunews.idol-it.com/","{width:145,height:30,st:'rounded',sz:20,ck:1}");
</script>

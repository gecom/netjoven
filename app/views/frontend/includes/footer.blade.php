<nav id="footer_nav">
    @include('frontend.pages.partials.footer_nav')
</nav>
<div class="search_footer">
    <label>Buscar:</label>
    <div class="box">
        <input class="input_search" type="text" value="">
        <input class="btn_search" type="button" value="">
    </div>
</div>
<div class="footer_social">
    <ul>
        <li class="fb"><span class="d1">Hazte fan</span><a href="http://www.facebook.com/netjoven"></a></li>
        <li class="tw"><span class="d1">Síguenos es</span><a href="https://twitter.com/#!/netjoven"></a></li>
        <li class="gp"><span class="d1">Únete a</span><a href="#"></a></li>
    </ul>
</div>
<div class="footer_devices">
    <span class="fd1">
        MIRANOS DESDE TU:<br/>
            Smarth Phone<br/>
            o Tablet
    </span>
    <span class="fd2"></span>
</div>
<div class="tags">

    <?php 

        $tags = Helpers::getTags()->keywords;

        $data_tags = explode(',', $tags);

        //echo 


       // $preview_default = preg_replace('/<code>(.*)<\/code>/is', "<code class=\"prettyprint\">$1</code>", $preview);


        
    ?>


    TAGS: {{Helpers::getTags()->keywords}}
</div>
<div class="sponsors">
    <ul>
        <li ><a class="sp1" href="http://www.divas.pe/"></a></li>
        <li ><a class="sp2" href="http://www.netjoven.pe/"></a></li>
        <li ><a class="sp3" href="http://iabperu.com/"></a></li>
        <li ><a class="sp4" href="http://www.comscore.com/"></a></li>
        <li ><a class="sp5" href="http://gecom.pe/"></a></li>
    </ul>
</div>
<div class="footer_rights">
    ©Copyright Grupo Emprendedor de Comunicaciones. Derechos Reservados: Prohibida su reproducción sin autorización. / Calle Arica 115 oficina 504
</div>
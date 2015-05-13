<?php
$json_type = json_decode($_GET['menuParam']);
$type = (isset($json_type)) ? $json_type : '';
?>
<div style="width:100%; height:100%;">
    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="960" height="576" id="Poker" align="middle">
        <param name="movie" value="<?php echo $json_type->flash_name ?>" />
        <param name="quality" value="high" />
        <param name="bgcolor" value="#202021" />
        <param name="play" value="true" />
        <param name="loop" value="true" />
        <param name="wmode" value="window" />
        <param name="scale" value="showall" />
        <param name="menu" value="true" />
        <param name="devicefont" value="false" />
        <param name="salign" value="" />
        <param name="allowScriptAccess" value="sameDomain" />
        <param name="allowFullScreen" value="true" />
        <!--[if !IE]>-->
        <object type="application/x-shockwave-flash" data="<?php echo $json_type->flash_name ?>" width="960" height="576">
            <param name="movie" value="<?php echo $json_type->flash_name ?>" />
            <param name="quality" value="high" />
            <param name="bgcolor" value="#202021" />
            <param name="play" value="true" />
            <param name="loop" value="true" />
            <param name="wmode" value="window" />
            <param name="scale" value="showall" />
            <param name="menu" value="true" />
            <param name="devicefont" value="false" />
            <param name="salign" value="" />
            <param name="allowScriptAccess" value="sameDomain" />
            <param name="allowFullScreen" value="true" />
            <!--<![endif]-->
            <a href="http://www.adobe.com/go/getflash">
                <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
            </a>
            <!--[if !IE]>-->
        </object>
        <!--<![endif]-->
    </object>
</div>
<?php /* Smarty version 2.6.20, created on 2011-05-07 09:38:26
         compiled from /homez.387/lilibio/www2/site2.0/modules/DDLX_Slider_Free/ddlxslider.tpl */ ?>
<!-- Module ddlxslider -->
<link href="modules/DDLX_Slider_Free/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="modules/DDLX_Slider_Free/jquery.cycle.js"></script>
<?php echo '
<script type="text/javascript">
$(document).ready(function(){
  $("#banner-imgs").cycle({
    fx: \'scrollHorz\',
    speed: \'500\',
    next: \'#arrow_right\',
    prev: \'#arrow_left\',
    timeout: 8000
  });
  $(\'#subscribe_btn\').click(function () { $(\'#subscribe_box\').slideToggle(\'fast\'); });
});
</script>
'; ?>


  <div id="banner" class="grid_16">
    <div id="banner-imgs">
     <a href="#" style="display: none;" ><img  src="modules/DDLX_Slider_Free/images/1.jpg" alt="" /></a>
     <a href="#" style="display: none;" ><img src="modules/DDLX_Slider_Free/images/2.jpg" alt="" /></a>
     <a href="#" style="display: none;" ><img src="modules/DDLX_Slider_Free/images/3.jpg" alt="" /></a>
     <a href="#" style="display: none;" ><img src="modules/DDLX_Slider_Free/images/4.jpg" alt="" /></a>
    </div>
    <div> 
     <img src="modules/DDLX_Slider_Free/images/prev.png" alt="" id="arrow_left" />
     <img src="modules/DDLX_Slider_Free/images/next.png" alt="" id="arrow_right" />
    </div>
  </div><br></Br>

<table>
<tr><Td width="100">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td>
</Tr>
</table>
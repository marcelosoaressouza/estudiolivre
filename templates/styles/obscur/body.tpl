<!-- body.tpl begin -->


<body {if $show_comzone eq 'y'}onload="javascript:flip('comzone');"{/if}{if $section} class="tiki_{$section}"{/if}>

  {include file="el-lightbox.tpl"}

  {if $minical_reminders>100}
    <iframe width='0' height='0' frameborder="0" src="tiki-minical_reminders.php"></iframe>
  {/if}

  {if $feature_community_mouseover}
    {popup_init src="lib/overlib.js"}
  {/if}
  
	{* Tiki main contains all page *}
	  {if $isIE}
	    <center>
	  	  <div style="text-align:left; width:760px; border-right:2px solid gray; border-left:2px solid gray">
	  {/if}
	
		<div id="tiki-main">
	    	{if $feature_top_bar eq 'y'}
		        {include file="tiki-top_bar.tpl"}
		    {/if}
		    {include file="content.tpl"}
		    {include file="footer.tpl"}
		</div>

	  {if $isIE}
	    </div>
	      <center>
	  {/if}
	  
</body>

<!-- body.tpl end -->

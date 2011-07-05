<!-- body.tpl begin -->


<body{* load tooltip images first *}
		onLoad="preloadImgsNow('{$style|replace:".css":""}')"
	 {* --- *}>
	
  {include file="el-lightbox.tpl"}

  {if $feature_community_mouseover}
    {popup_init src="lib/js/overlib_mini.js"}
  {/if}
  
	{* Tiki main contains all page *}
	  {if $isIE}
	    <center>
	  	  <div style="text-align:left; width:954px">
	  {/if}
	
		<div id="tiki-main">
	    	{if $feature_top_bar eq 'y'}
		        {include file="tiki-top_bar.tpl"}
		    {/if}
		    {include file="content.tpl"}
		</div>

	  {if $isIE}
	    </div>
	      <center>
	  {/if}

</body>

<!-- body.tpl end -->

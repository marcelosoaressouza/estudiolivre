<!-- body.tpl begin -->


<body>

  {include file="el-lightbox.tpl"}


  {if $feature_community_mouseover}
    {popup_init src="lib/overlib.js"}
  {/if}
  
	{* Tiki main contains all page *}
	  {if $isIE}
	    <center>
	  	  <div style="text-align:left; width:760px; border-right:2px solid gray; border-left:2px solid gray">
	  {/if}
	
		<div id="tiki-main">
	    	 +Festival Internacional+
		<div class=head>SUBMIDIALOGIA #2</div>
        <a href="javascript:saiDesseShowBizzz();">[ ]</a><span class=grey> Cultura</span>
		    {include file="content.tpl"}
		</div>

	  {if $isIE}
	    </div>
	      <center>
	  {/if}
	  
</body>

<!-- body.tpl end -->

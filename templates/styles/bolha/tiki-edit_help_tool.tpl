<div class="quicktag">
	{literal}
		<script language="javascript" type="text/javascript">
			<!--
				function taginsert($area_name,$tagid)
				{
				//fill variables{/literal}
				  var tag = new Array();
				  {section name=qtg loop=$quicktags}
				  tag[{$quicktags[qtg].tagId}]='{$quicktags[qtg].taginsert|escape:"javascript"}';
				  {/section}
				//done{literal}  
				  insertAt($area_name,tag[$tagid]);
				}
			-->
		</script>
	{/literal}

	<div id='quicktags{$qtnum}' >
	<div class="quicktagsbar">
			{cycle name='cycle'|cat:$qtnum values=$qtcycle|default:",,," advance=false print=false}
				{section name=qtg loop=$quicktags} &nbsp; 
					<a title="{tr}{$quicktags[qtg].taglabel}{/tr}" href="javascript:taginsert('{$area_name}','{$quicktags[qtg].tagId}');">
						<img src='{$quicktags[qtg].tagicon}' alt='{tr}{$quicktags[qtg].taglabel}{/tr}' title='{tr}{$quicktags[qtg].taglabel}{/tr}' border='0' />
					</a>
					{cycle name='cycle'|cat:$qtnum}
				{/section}
<!--
					<a title="{tr}special chars{/tr}" class="link" href="#" onclick="javascript:window.open('tiki-special_chars.php?area_name={$area_name}','','menubar=no,width=252,height=25');">
					<img src='images/ed_charmap.gif' alt='{tr}special characters{/tr}' title='{tr}special characters{/tr}' border='0' /></a>
-->
		</div>
<br/>
</div>
</div>

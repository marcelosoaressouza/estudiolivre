<!-- begin freetag.tpl -->
{if $feature_freetags eq 'y'}
	<script language="JavaScript">
		{literal}
		  function addTag(tag) {
		      var currentTags = document.getElementById('tagBox');
    
		      if (currentTags.value != '') {
			  	currentTags.value += ', ';
		      }
		      
		      currentTags.value += tag.innerHTML;
		      tag.style.display = 'none';
		      document.getElementById(tag.innerHTML+"-v").style.display = "none";
		  }
		{/literal}
	</script>
	<div id="freetager">
	{tr}Tags{/tr}:
	<br> 
	    {tooltip text="Escreva aqui as tags dessa página (separadas por <b>vírgula</b>)"}
		<input type="text" id="tagBox" name="freetag_string" value="{$taglist|escape}" size="60" />{/tooltip}<br />
		<div style="width:500px">{foreach from=$tag_suggestion item=t name=tag_suggest}
		<b><span onclick="addTag(this)" class="pointer">{$t}</span></b><span id="{$t}-v"{if $smarty.foreach.tag_suggest.last} style="display:none"{/if}>,</span>
		{/foreach}
		</div>
	</div>
{/if}
<!--end freetag.tpl-->
{* $feature_freetags eq 'y' *}

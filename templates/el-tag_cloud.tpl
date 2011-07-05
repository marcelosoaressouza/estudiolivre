{css}
<div id="tagCloud">
	<h1>
		{if $tagsForUser}
			Tags do usuário {$tagsForUser|userlink}
		{else}
			Tags do estúdiolivre.org
		{/if}
	</h1>
	
	<h5>
		<span class="pointer" onclick="javascript:flip('tagOptions');toggleImage(document.getElementById('TArrowTag'),'iArrowGreyDown.png');">
			Especificar... {$module_title}<img id="TArrowTag"  src="styles/{$style|replace:".css":""}/img/iArrowGreyLeft.png">
		</span>
		<div id="tagOptions" style="display: none;">
			<form method="get" action="el-tag_cloud.php">
				Usuário: <br>
				<input name="tagsForUser" value="" class="input" type="text"><br>
			    <input value="buscar" type="submit">
		    </form>
		</div>
	</h5>
	<span>
	{foreach from=$popularTags item=tag}
		<a href="tiki-browse_freetags.php?tag={$tag.tag}" style="font-size:{$tag.size+6}pt">{$tag.tag}</a>&nbsp;&nbsp;
	{foreachelse}
		Esse usuário não tem tags! Veja uma lista com <a href="el-tag_cloud.php">todas</a> as tags.
	{/foreach}
	</span>
	{if $tagsForUser}
		<h5>
			<a href="el-tag_cloud.php">Ver tags de todos</a>
		</h5>
	{/if}
</div>
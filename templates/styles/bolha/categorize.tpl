{if $feature_categories eq 'y' and (count($categories) gt 0 or $tiki_p_admin_categories eq 'y')}
	<span class="hiddenPointer"  onclick="javascript:flip('categorizator');toggleImage(document.getElementById('catTArrow'),'iArrowGreyDown.png');">
		<img id="catTArrow" class="pointer" src="styles/{$style|replace:".css":""}/img/iArrowGreyRight.png">
		<b>{tr}Categorize{/tr}</b>
	</span>
	  {*
	  [ <a class="link" href="javascript:show('categorizator');">{tr}show categories{/tr}</a>
	  | <a class="link" href="javascript:hide('categorizator');">{tr}hide categories{/tr}</a> ]
	  *}
	 {* tirei isso pra seção com as categorias sempre ficar escondida. talvez colocar na setinha e deixar?
	  {if $cat_categorize eq 'n' and $categ_checked ne 'y'}style="display:none;"{else}style="display:block;"{/if}
	  *}
	<div id="categorizator" style="display:none;">
		{if $feature_help eq 'y'}
			<!--div class="simplebox">{tr}Tip: hold down CTRL to select multiple categories{/tr}</div-->
		{/if}
		{if count($categories) gt 0}
	   		<div style="display:none">
		   		<select name="cat_categories[]" multiple="multiple" size="5" id="categorySelect">
		   			{section name=ix loop=$categories}
				    	{if $categories[ix].incat eq 'y'}
				    		<option value="{$categories[ix].categId|escape}" selected="selected">
					    		{$categories[ix].categpath}
					    	</option>
				   		{/if}
				   	{/section}
		   		</select>
				<input type="checkbox" name="cat_categorize" id="cat-check" {if $cat_categorize eq 'y' or $categ_checked eq 'y'}checked="checked"{/if}/>
	   	    </div>
	   		<div id="selected" style="float:right">
	   			{tr}Remover{/tr} {tr}categorias{/tr}:<BR/>
	   			{section name=ix loop=$categories}
			    	{if $categories[ix].incat eq 'y'}
				    	<span class="pointer" id="linkToRemove{$categories[ix].categId|escape}" onclick="removeCategory({$categories[ix].categId|escape})" style="display:block">
				    		{$categories[ix].categpath}
				    	</span>
			    	{else}
				    	<span class="pointer" id="linkToRemove{$categories[ix].categId|escape}" onclick="removeCategory({$categories[ix].categId|escape})" style="display:none">
				    		{$categories[ix].categpath}
				    	</span>
			    	{/if}
			   	{/section}
	   		</div>
	   		<div id="notSelected" style="float:left">
	   			{tr}Adicionar{/tr} {tr}categorias{/tr}:<BR/>
	   			{section name=ix loop=$categories}
			    	{if $categories[ix].incat eq 'n'}
				    	<span class="pointer" id="linkToAdd{$categories[ix].categId|escape}" onclick="addCategory('{$categories[ix].categpath}',{$categories[ix].categId|escape})" style="display:block">
				    		{$categories[ix].categpath}
				    	</span>
			    	{else}
				    	<span class="pointer" id="linkToAdd{$categories[ix].categId|escape}" onclick="addCategory('{$categories[ix].categpath}',{$categories[ix].categId|escape})" style="display:none">
				    		{$categories[ix].categpath}
				    	</span>
			    	{/if}
			   	{/section}
	   		</div>
	   				
			{if $feature_help eq 'y'}
			    <!--div class="simplebox">{tr}Tip: uncheck the above checkbox to uncategorize this page/object{/tr}</div-->
			{/if}
		{else}
		   	{tr}No categories defined{/tr} <br />
		{/if}
		
	</div>
	{if $tiki_p_admin_categories eq 'y'}
			&nbsp;&nbsp;&nbsp;<a href="tiki-admin_categories.php" class="link">{tr}Admin categories{/tr}</a>
	{/if}
	{literal}
		<script language="javascript" type="text/javascript">
			var options=document.getElementById('categorySelect').options;
			var checkbox=document.getElementById('cat-check');
			addCategory = function(nome,id){
				//new Option(text, value, defaultSelected, selected)
				options[options.length]=new Option(nome, id, true, true);
				document.getElementById('linkToAdd'+id).style.display='none';
				document.getElementById('linkToRemove'+id).style.display='block';
				checkbox.checked=true;
			}
			removeCategory = function(id){
				//new Option(text, value, defaultSelected, selected)
				for (i in options){
					if(options[i]!=null)
						if(options[i].value==id){
							var remove=i;
						}
				}
				options[remove]=null;
				document.getElementById('linkToAdd'+id).style.display='block';
				document.getElementById('linkToRemove'+id).style.display='none';
				if(options.length==0){
					checkbox.checked=false;
				}	
			}
		</script>
	{/literal}
{/if}
{* $feature_categories eq 'y' *}

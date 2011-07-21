<br/><br/>
<center>
<h1>{tr}Error{/tr}</h1>
{if ($errortype eq "404")}
	{if $likepages}
    	{tr}Perhaps you were looking for:{/tr}
			<ul>
				{section name=back loop=$likepages}
					<li><a  href="tiki-index.php?page={$likepages[back]|escape:"url"}" class="wiki">{$likepages[back]}</a></li>
				{/section}
			</ul>       
	{else}
		{tr}There are no wiki pages similar to '{$page}'{/tr}
			<br/><br/>
	{/if}
        
{else}
	<div class="warning"> {$msg} </div>
	<br /><br />
{/if}
	
{if $page and $create eq 'y' and ($tiki_p_admin eq 'y' or $tiki_p_admin_wiki eq 'y'  or $tiki_p_edit eq 'y')}
	<a href="tiki-editpage.php?page={$page}" class="linkmenu">{tr}Create this page{/tr}</a>
	{tr}(page will be orphaned){/tr}<br /><br/>
{/if}
<a href="/" class="linkmenu">{tr}Return to home page{/tr}</a>
</center>

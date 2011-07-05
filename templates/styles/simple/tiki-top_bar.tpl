

{if $feature_phplayers eq 'y' and $feature_siteidentity eq 'y' and $feature_sitemenu eq 'y'}
{phplayers id=42 type=horiz}
{/if}
{if $feature_siteloc eq 'y' and $feature_breadcrumbs eq 'y'}
<div id="sitelocbar">
{if $feature_sitetitle eq 'n'}{tr}Location : {/tr}{/if}
		{if $trail}{breadcrumbs type="trail" loc="site" crumbs=$trail}{if $trail}{breadcrumbs type="desc" loc="site" crumbs=$trail}{else}{breadcrumbs type="desc" loc="site" crumbs=$crumbs}{/if} 
		{else}
                        <a title="{tr}{$crumbs[0]->description}{/tr}" href="{$crumbs[0]->url}" accesskey="1">{$crumbs[0]->title}</a>
			{if $structure eq 'y'}
				{section loop=$structure_path name=ix}
					{$site_crumb_seper|escape:"html"}
					{if $structure_path[ix].pageName ne $page or $structure_path[ix].page_alias ne $page_info.page_alias}
					<a href="tiki-index.php?page_ref_id={$structure_path[ix].page_ref_id}">
					{/if}
					{if $structure_path[ix].page_alias}
						{$structure_path[ix].page_alias}
					{else}
						{$structure_path[ix].pageName}
					{/if}
					{if $structure_path[ix].pageName ne $page or $structure_path[ix].page_alias ne $page_info.page_alias}
					</a>
					{/if}
				{/section}
			{else}
				{if $page ne ''}{$site_crumb_seper|escape:"html"} {$page}
				{elseif $title ne ''}{$site_crumb_seper|escape:"html"} {$title}
				{elseif $thread_info.title ne ''}{$site_crumb_seper|escape:"html"} {$thread_info.title}
				{elseif $forum_info.name ne ''}{$site_crumb_seper|escape:"html"} {$forum_info.name}
				{/if}
			{/if}
		{/if}
</div>{* bar with location indicator *}
{/if}

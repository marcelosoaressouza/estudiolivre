{* $Header: /cvsroot/tikiwiki/tiki/templates/tiki-user_menu.tpl,v 1.17.2.16 2007/08/13 14:15:13 luciash Exp $ *}
{assign var=opensec value='0'}
{assign var=sep value=''}

{foreach key=pos item=chdata from=$channels}
{assign var=cname value=$menu_info.menuId|cat:'__'|cat:$chdata.position}

{* ----------------------------- section *}
{if $chdata.type ne 'o' and  $chdata.type ne '-'}

{if $opensec > 0}
{assign var=sectionType value=$chdata.type}
{php}
global $smarty;
$opensec = $smarty->get_template_vars('opensec');
$sectionType= $smarty->get_template_vars('sectionType');
if ($sectionType == 's' or $sectionType == 'r') {
	$sectionType = 0;
}
while ($opensec > $sectionType) {
	--$opensec;
	echo '</div>';
}
$smarty->assign('opensec', $opensec);
{/php}
{/if}

<div class="separator{$sep}">
{if $sep eq 'line'}{assign var=sep value=''}{/if}
{if $menu_info.type eq 'e' or $menu_info.type eq 'd'}
	{if $feature_menusfolderstyle eq 'y'}
	<a class='separator' href="#" onclick="javascript:icntoggle('menu{$cname}'); return false" title="{tr}Toggle options{/tr}"><img src="img/icons/{if $menu_info.type ne 'd'}o{/if}fo.gif" border="0" name="menu{$cname}icn" alt='{tr}Toggle{/tr}'/></a>
	{else}
	<a class='separator' href="#" onclick="javascript:toggle('menu{$cname}'); return false">[-]</a>
	{/if}
{/if} 
{if $chdata.url}
<a href="{$chdata.url|escape}" class="separator">{tr}{$chdata.name}{/tr}</a>
{else}
<a class='separator' href="#" onclick="javascript:icntoggle('menu{$cname}'); return false">{tr}{$chdata.name}{/tr}</a>
{/if}
{if ($menu_info.type eq 'e' or $menu_info.type eq 'd') and $feature_menusfolderstyle ne 'y'}<a class='separator' href="#" onclick="javascript:toggle('menu{$cname}'); return false">[+]</a>{/if} 
</div> {* separator *}

{assign var=opensec value=$opensec+1}
{if $menu_info.type eq 'e' or $menu_info.type eq 'd'}
<div class="menuSection" {if $menu_info.type eq 'd' and $smarty.cookies.menu ne ''}style="display:none;"{else}style="display:block;"{/if} id='menu{$cname}'>
{else}
<div class="menuSection">
{/if}

{* ----------------------------- option *}
{elseif $chdata.type eq 'o'}
<div class="option{$sep}"><a href="{$chdata.url|escape}" class="linkmenu">{tr}{$chdata.name}{/tr}</a></div>
{if $sep eq 'line'}{assign var=sep value=''}{/if}

{* ----------------------------- separator *}
{elseif $chdata.type eq '-'}
{if $opensec > 0}</div>{assign var=opensec value=$opensec-1}{/if}
{assign var=sep value="line"}
{/if}
{/foreach}

{if $opensec > 0}
{php}
global $smarty;
$opensec = $smarty->get_template_vars('opensec');
while ($opensec) {
	--$opensec;
	echo '</div>';
}
{/php}
{/if}

{* --------------------Dynamic menus *}
{if $menu_info.type eq 'e' or $menu_info.type eq 'd'}
<script type='text/javascript'>
{foreach key=pos item=chdata from=$channels}
{if $chdata.type ne 'o' and $chdata.type ne '-'}
  {if $feature_menusfolderstyle eq 'y'}
    setfolderstate('menu{$menu_info.menuId|cat:'__'|cat:$chdata.position}', '{$menu_info.type}');
  {else}
    setsectionstate('menu{$menu_info.menuId|cat:'__'|cat:$chdata.position}', '{$menu_info.type}');
  {/if}
{/if}
{/foreach}
</script>
{/if}


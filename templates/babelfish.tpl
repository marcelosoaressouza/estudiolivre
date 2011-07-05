{* $Header: /cvsroot/tikiwiki/tiki/templates/babelfish.tpl,v 1.3.6.1 2004/07/29 17:06:25 mose Exp $ *}

{if $feature_babelfish eq 'y' and $feature_babelfish_logo eq 'y'}

{assign var=links value=0}
{section loop=$babelfish_links name=i}
	{assign var=links value=$links+1}
{/section}

<div id="babelfish" align="center">
{if $links>0}
<table width="100%">
  {section loop=$babelfish_links name=i}
    <tr>
      {if $smarty.section.i.index == 0}
        <td>
          <a href="{$babelfish_links[i].href}" target="{$babelfish_links[i].target}"> {$babelfish_links[i].msg} </a>
        </td>
        <td rowspan="{$smarty.section.i.total}" align="right">
          {$babelfish_logo}
        </td>
      {else}
        <td>
          <a href="{$babelfish_links[i].href}" target="{$babelfish_links[i].target}">{$babelfish_links[i].msg}</a>
        </td>
      {/if}
    </tr>
  {/section}
</table>
{else if $tiki_p_admin eq 'y'}
<small><strong>Babelfish ({tr}debug{/tr}): {tr}Fatal error{/tr}</strong></small>
{/if}
</div>

{elseif $feature_babelfish eq 'y' and $feature_babelfish_logo eq 'n'}

<div id="babelfish" align="center">
{if $links>0}
<table width="100%">
  {section loop=$babelfish_links name=i}
  <tr><td align="center">
    <a href="{$babelfish_links[i].href}" target="{$babelfish_links[i].target}">{$babelfish_links[i].msg}</a>
  </td> </tr>
  {/section}
</table>
{else if $tiki_p_admin eq 'y'}
<small><strong>Babelfish ({tr}debug{/tr}): {tr}Fatal error{/tr}</strong></small>
{/if}
</div>

{elseif $feature_babelfish eq 'n' and $feature_babelfish_logo eq 'y'}

<div id="babelfish" align="center">
  {$babelfish_logo}
</div>

{/if}

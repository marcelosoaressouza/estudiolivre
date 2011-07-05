{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/Attic/mod-eph.tpl,v 1.5.10.3 2005/02/23 21:12:46 michael_davey Exp $ *}

{tikimodule title="<a class=\"cboxtlink\" href=\"tiki-eph.php\">{tr}Ephemerides{/tr}</a>" name="eph" flip=$module_params.flip decorations=$module_params.decorations}
{if $modephdata}
  <table>
  {if $modephdata.filesize}
    <tr>
      <td text-align="center" class="module"><img src="tiki-view_eph.php?ephId={$modephdata.ephId}" alt="{tr}image{/tr}" /></td>
    </tr>
  {/if}
  <tr>
    <td class="module">{$modephdata.textdata}</td>
  </tr>
  </table>
{/if}
{/tikimodule}

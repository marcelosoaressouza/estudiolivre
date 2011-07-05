{* $Header: /cvsroot/tikiwiki/tiki/templates/styles/simple/modules/mod-switch_lang2.tpl,v 1.1.2.3 2006/01/29 20:29:40 luciash Exp $ *}

{tikimodule title="{tr}Language{/tr}: `$language`" name="switch_lang2"}
<ul class='floatlist'>
{capture}{$languages|@sort}{/capture}{* use php sort() as modifier for the array and do not print the '1' *}
{section name=ix loop=$languages}
  <li>
    <a title="{$languages[ix].name|escape}" class="linkmodule" href="tiki-switch_lang.php?language={$languages[ix].value|escape}">
      {$languages[ix].display|escape}
    </a>
  </li>
{/section}
</ul>
{/tikimodule}

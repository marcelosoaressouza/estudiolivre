{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-google.tpl,v 1.14.2.1 2005/02/23 15:35:08 michael_davey Exp $ *}

{tikimodule title="{tr}Google Search{/tr}" name="google" flip=$module_params.flip decorations=$module_params.decorations}
<form method="get" action="http://www.google.com/search" target="Google" style="margin-bottom:2px;">
  <input type="hidden" name="hl" value="en"/>
  <input type="hidden" name="oe" value="UTF-8"/>
  <input type="hidden" name="ie" value="UTF-8"/>
  <input type="hidden" name="btnG" value="Google Search"/>
  <input name="googles" type="image" src="img/googleg.gif" alt="Google" align="left" />&nbsp;
  <input type="text" name="q" size="12"  maxlength="100" />
  {if $http_domain ne ''}
    <input type="hidden" name="domains" value="{$http_domain}" /><br />
    <input type="radio" name="sitesearch" value="{$http_domain}" checked="checked" />{$http_domain}<br />
    <input type="radio" name="sitesearch" value="" />WWW
  {/if}
</form>
{/tikimodule}

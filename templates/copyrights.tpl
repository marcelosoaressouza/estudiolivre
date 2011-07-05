<h2>{tr}Copyrights{/tr}: <a href="tiki-index.php?page={$page|escape:"url"}">{$page}</a></h2>

<table border="0">
{section name=i loop=$copyrights}
  <tr><td class="formcolor">
    <form action="copyrights.php?page={$page}" method="post">
    <input type="hidden" name="page" value="{$page|escape}" />
    <input type="hidden" name="copyrightId" value="{$copyrights[i].copyrightId|escape}" />
    <table border="0">
      <tr class="formcolor"><td><label for="copyleft-title">{tr}Title{/tr}:</label></td><td><input size="40" class="wikitext" type="text" name="copyrightTitle" id="copyleft-title" value="{$copyrights[i].title|escape}" /></td></tr>
      <tr class="formcolor"><td><label for="copyleft-year">{tr}Year{/tr}:</label></td><td><input size="4" class="wikitext" type="text" name="copyrightYear" id="copyleft-year" value="{$copyrights[i].year|escape}" /></td></tr>
      <tr class="formcolor"><td><label for="copyleft-authors">{tr}Authors{/tr}:</label></td><td><input size="40" class="wikitext" type="text" name="copyrightAuthors" id="copyleft-authors" value="{$copyrights[i].authors|escape}" /></td></tr>
    </table>
  </td><td class="formcolor" align="right">
    <input type="submit" name="editcopyright" value="{tr}edit{/tr}" /><br />
    <a title="{tr}delete{/tr}" href="copyrights.php?page={$page|escape:"url"}&amp;action=delete&amp;copyrightId={$copyrights[i].copyrightId}" 
><img src="img/icons2/delete.gif" border="0" width="16" height="16" alt='{tr}Remove{/tr}' /></a>
    <a href="copyrights.php?page={$page|escape:"url"}&amp;action=up&amp;copyrightId={$copyrights[i].copyrightId}">{tr}up{/tr}</a>
    <a href="copyrights.php?page={$page|escape:"url"}&amp;action=down&amp;copyrightId={$copyrights[i].copyrightId}">{tr}down{/tr}</a>
    </form>
  </td></tr>
{/section}
<tr><td class="formcolor">
<form action="copyrights.php?page={$page}">
    <table border="0">
      <tr><td class="formcolor"><label for="copyleft-tit">{tr}Title{/tr}:</label></td><td><input size="40" class="wikitext" type="text" name="copyrightTitle" id="copyleft-tit" value="{$copyrights[i].title|escape}" /></td></tr>
      <tr><td class="formcolor"><label for="copyleft-yyyy">{tr}Year{/tr}:</label></td><td><input size="4" class="wikitext" type="text" name="copyrightYear" id="copyleft-yyyy" value="{$copyrights[i].year|escape}" /></td></tr>
      <tr><td class="formcolor"><label for="copyleft-auth">{tr}Authors{/tr}:</label></td><td><input size="40" class="wikitext" type="text" name="copyrightAuthors" id="copyleft-auth" value="{$copyrights[i].authors|escape}" /></td></tr>
      <tr><td class="formcolor"><input type="submit" name="addcopyright" value="{tr}add{/tr}" /></td></tr>
    </table><input type="hidden" name="page" value="{$page|escape}" />
</form>
</td></tr>
</table>

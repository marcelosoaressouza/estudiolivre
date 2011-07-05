<h1><a class="pagetitle" href="tiki-contact.php">{tr}Contact us{/tr}</a></h1>
{if $feature_messages eq 'y' and $tiki_p_messages eq 'y'}
{if $message}
{$message}
{/if}
<h2>{tr}Send a message to us{/tr}</h2>
  <form method="post" action="tiki-contact.php">
  <input type="hidden" name="to" value="{$contact_user|escape}" />
  <table class="normalnoborder">
  <tr>
    <td class="form">{tr}Priority{/tr}:</td><td class="form">
    <select name="priority">
      <option value="1" {if $priority eq 1}selected="selected"{/if}>1 -{tr}Lowest{/tr}-</option>
      <option value="2" {if $priority eq 2}selected="selected"{/if}>2 -{tr}Low{/tr}-</option>
      <option value="3" {if $priority eq 3}selected="selected"{/if}>3 -{tr}Normal{/tr}-</option>
      <option value="4" {if $priority eq 4}selected="selected"{/if}>4 -{tr}High{/tr}-</option>
      <option value="5" {if $priority eq 5}selected="selected"{/if}>5 -{tr}Very High{/tr}-</option>
    </select>
    <input type="submit" name="send" value="{tr}send{/tr}" />
    </td>
  </tr>

{if $feature_antibot eq 'y' && $user eq ''}
{include file=antibot.tpl}
{/if}
  
  <tr>
    <td class="form">{tr}Subject{/tr}:</td><td class="form"><input type="text" name="subject" value="" size="80" maxlength="255"/></td>
  </tr>
  <tr><td class="form">&nbsp;</td>
      <td class="form"><textarea rows="20" cols="80" name="body"></textarea></td>
  </tr>
</table>
</form>
{/if}
{if strlen($email)>0}
<h2>{tr}Contact us by email{/tr}</h2>                              
{tr}click here to send us an email{/tr}: {mailto address="$email" encode="javascript" extra='class="link"'}
{/if}

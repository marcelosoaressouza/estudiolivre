<h1>{tr}Change password enforced{/tr}</h1>
<form method="post" action="tiki-change_password.php" >
<table class="normal">
<tr>
  <td class="formcolor">{tr}User{/tr}:</td>
  <td class="formcolor"><input type="text" name="user" value="{$user|escape}" /></td>
</tr>  
<tr>
  <td class="formcolor">{tr}Old password{/tr}:</td>
  <td class="formcolor"><input type="password" name="oldpass" value="{$oldpass|escape}" /></td>
</tr>     
<tr>
  <td class="formcolor">{tr}New password{/tr}:</td>
  <td class="formcolor"><input type="password" name="pass" /></td>
</tr>  
<tr>
  <td class="formcolor">{tr}Again please{/tr}:</td>
  <td class="formcolor"><input type="password" name="pass2" /></td>
</tr>  
<tr>
  <td class="formcolor">&nbsp;</td>
  <td class="formcolor"><input type="submit" name="change" value="{tr}change{/tr}" /></td>
</tr>  
</table>
</form>

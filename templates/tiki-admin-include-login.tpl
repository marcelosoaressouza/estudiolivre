<div class="cbox">
<div class="cbox-title">{tr}Users &amp; groups{/tr}</div>
<div class="cbox-data">
<br />
<span class="button2"><a href="tiki-admingroups.php" class="linkbut">{tr}Admin groups{/tr}</a></span>
<span class="button2"><a href="tiki-adminusers.php" class="linkbut">{tr}Admin users{/tr}</a></span>
<br /><br />
</div>
</div>

<div class="cbox">
<div class="cbox-title">
  {tr}User registration and login{/tr}
  {help url="Login+Config" desc="{tr}User registration and login{/tr}"}
</div>
<div class="cbox-data">
<form action="tiki-admin.php?page=login" method="post" name="login">
<table class="admin">
<tr><td class="form">{tr}Authentication method{/tr}</td><td>
<select name="auth_method">
<option value="tiki" {if $auth_method eq 'tiki'} selected="selected"{/if}>{tr}Just Tiki{/tr}</option>
<option value="ws" {if $auth_method eq 'ws'} selected="selected"{/if}>{tr}Web Server{/tr}</option>
<option value="auth" {if $auth_method eq 'auth'} selected="selected"{/if}>{tr}Tiki and PEAR::Auth{/tr}</option>
<option value="pam" {if $auth_method eq 'pam'} selected="selected"{/if}>{tr}Tiki and PAM{/tr}</option>
<option value="cas" {if $auth_method eq 'cas'} selected="selected"{/if}>{tr}CAS (Central Authentication Service){/tr}</option>
<option value="intertiki" {if $feature_intertiki eq 'y'} selected="selected"{/if}>{tr}InterTiki{/tr}</option>
<!--option value="http" {if $auth_method eq 'http'} selected="selected"{/if}>{tr}Tiki and HTTP Auth{/tr}</option-->
</select></td></tr>
<!--<tr><td class="form">{tr}Use WebServer authentication for Tiki{/tr}:</td><td><input type="checkbox" name="webserverauth" {if $webserverauth eq 'y'}checked="checked"{/if}/></td></tr>-->
<tr><td class="form">{tr}Users can register{/tr}:</td><td><input type="checkbox" name="allowRegister" {if $allowRegister eq 'y'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}... but need admin validation{/tr}:</td><td><input type="checkbox" name="validateRegistration" {if $validateRegistration eq 'y'}checked="checked"{/if}/>
{if empty($sender_email)}
<div class="highlight">{tr}You need to set <a href="tiki-admin.php?page=general">Sender Email</a>{/tr}</div>
{/if} 
</td></tr>
<tr><td class="form">{tr}Create a group for each user <br />(with the same
name as the user){/tr}:</td><td><input type="checkbox"
name="eponymousGroups" {if $eponymousGroups eq 'y'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}Use tracker for more user information{/tr}:</td><td><input type="checkbox" name="userTracker" {if $userTracker eq 'y'}checked="checked"{/if} /></td></tr>
<tr><td class="form">{tr}Use tracker for more group information{/tr}:</td><td><input type="checkbox" name="groupTracker" {if $groupTracker eq 'y'}checked="checked"{/if} /></td></tr>

<tr><td class="form">{tr}Request passcode to register{/tr}:</td><td><input type="checkbox" name="useRegisterPasscode" {if $useRegisterPasscode eq 'y'}checked="checked"{/if}/><input type="text" name="registerPasscode" value="{$registerPasscode|escape}"/></td></tr>
<tr><td class="form">{tr}Prevent automatic/robot registration{/tr}{php}if (!function_exists("gd_info")){ {/php} {tr} - Php GD library required{/tr}{php}}{/php}:</td><td><input type="checkbox" name="rnd_num_reg" {if $rnd_num_reg eq 'y'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}Validate users by email{/tr}:</td><td><input type="checkbox" name="validateUsers" {if $validateUsers eq 'y'}checked="checked"{/if}/>
{if empty($sender_email)}
<div class="highlight">{tr}You need to set <a href="tiki-admin.php?page=general">Sender Email</a>{/tr}</div>
{/if}
</td></tr>
<tr><td class="form">{tr}Validate email address (may not work){/tr}:</td><td><input type="checkbox" name="validateEmail" {if $validateEmail eq 'y'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}Users can opt-out internal messages{/tr}:</td><td><input type="checkbox" name="allowmsg_is_optional" {if $allowmsg_is_optional eq 'y'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}Users accept internal messages by default{/tr}:</td><td><input type="checkbox" name="allowmsg_by_default" {if $allowmsg_by_default eq 'y'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}Remind passwords by email (if "Store plaintext passwords" is activated.) Else, Reset passwords by email{/tr}:</td><td><input type="checkbox" name="forgotPass" {if $forgotPass ne 'n'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}Store plaintext passwords{/tr}:</td><td><input type="checkbox" name="feature_clear_passwords" {if $feature_clear_passwords eq 'y'}checked="checked"{/if}/></td></tr>

<tr>
  <td class="form">{tr}Reg users can change password{/tr}:</td>
  <td><input type="checkbox" name="change_password" {if $change_password eq 'y'}checked="checked"{/if}/></td>
</tr>
<tr>
  <td class="form">{tr}Reg users can change theme{/tr}:</td>
  <td>
    <table><tr>
    <td style="width: 20px"><input type="checkbox" name="change_theme" {if $change_theme eq 'y'}checked="checked"{/if}/></td>
    <td>
      <div id="select_available_styles" {if count($available_styles) > 0}style="display:none;"{else}style="display:block;"{/if}>
        <a class="link" href="javascript:show('available_styles');hide('select_available_styles');">{tr}Restrict available themes{/tr}</a>
      </div>
      <div id="available_styles" {if count($available_styles) == 0}style="display:none;"{else}style="display:block;"{/if}>
        {tr}Available styles:{/tr}<br />
        <select name="available_styles[]" multiple="multiple" size="5">
          {section name=ix loop=$styles}
            <option value="{$styles[ix]|escape}"
              {if in_array($styles[ix], $available_styles)}selected="selected"{/if}>
              {$styles[ix]}
            </option>
          {/section}
        </select>
      </div>
    </td>
    </tr></table>
  </td>
</tr>
<tr>
  <td class="form">{tr}Reg users can change language{/tr}:</td>
  <td>
    <table><tr>
    <td style="width: 20px"><input type="checkbox" name="change_language" {if $change_language eq 'y'}checked="checked"{/if}/></td>
    <td>
      <div id="select_available_languages" {if count($available_languages) > 0}style="display:none;"{else}style="display:block;"{/if}>
        <a class="link" href="javascript:show('available_languages');hide('select_available_languages');">{tr}Restrict available languages{/tr}</a>
      </div>
      <div id="available_languages" {if count($available_languages) == 0}style="display:none;"{else}style="display:block;"{/if}>
        {tr}Available languages:{/tr}<br />
        <select name="available_languages[]" multiple="multiple" size="5">
          {section name=ix loop=$languages}
            <option value="{$languages[ix].value|escape}"
              {if in_array($languages[ix].value, $available_languages)}selected="selected"{/if}>
              {$languages[ix].name}
            </option>
          {/section}
        </select>
      </div>
    </td>
    </tr></table>
  </td>
</tr>

<tr><td class="form">{tr}Maximum mailbox size (messages, 0=unlimited){/tr}:</td><td><input type="text" name="messu_mailbox_size" value="{$messu_mailbox_size|escape}" /></td></tr>
<tr><td class="form">{tr}Maximum mail archive size (messages, 0=unlimited){/tr}:</td><td><input type="text" name="messu_archive_size" value="{$messu_archive_size|escape}" /></td></tr>
<tr><td class="form">{tr}Maximum sent box size (messages, 0=unlimited){/tr}:</td><td><input type="text" name="messu_sent_size" value="{$messu_sent_size|escape}" /></td></tr>

<tr><td class="form">{tr}Use challenge/response authentication{/tr}:</td><td><input type="checkbox" name="feature_challenge" {if $feature_challenge eq 'y'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}Force to use chars and nums in passwords{/tr}:</td><td><input type="checkbox" name="pass_chr_num" {if $pass_chr_num eq 'y'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}Minimum password length{/tr}:</td><td><input type="text" name="min_pass_length" value="{$min_pass_length|escape}" /></td></tr>
<tr><td class="form">{tr}Password invalid after days{/tr}:</td><td><input type="text" name="pass_due" value="{$pass_due|escape}" /></td></tr>
<!-- # not implemented
<tr><td class="form">{tr}Require HTTP Basic authentication{/tr}:</td><td><input type="checkbox" name="http_basic_auth" {if $http_basic_auth eq 'y'}checked="checked"{/if}/></td></tr>
-->
<tr><td class="form">{tr}Allow secure (https) login{/tr}:</td><td><input type="checkbox" name="https_login" {if $https_login eq 'y'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}Require secure (https) login{/tr}:</td><td><input type="checkbox" name="https_login_required" {if $https_login_required eq 'y'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}HTTP server name{/tr}:</td><td><input type="text" name="http_domain" value="{$http_domain|escape}" size="50" /></td></tr>
<tr><td class="form">{tr}HTTP port{/tr}:</td><td><input type="text" name="http_port" size="5" value="{$http_port|escape}" /></td></tr>
<tr><td class="form">{tr}HTTP URL prefix{/tr}:</td><td><input type="text" name="http_prefix" value="{$http_prefix|escape}" size="50" /></td></tr>
<tr><td class="form">{tr}HTTPS server name{/tr}:</td><td><input type="text" name="https_domain" value="{$https_domain|escape}" size="50" /></td></tr>
<tr><td class="form">{tr}HTTPS port{/tr}:</td><td><input type="text" name="https_port" size="5" value="{$https_port|escape}" /></td></tr>
<tr><td class="form">{tr}HTTPS URL prefix{/tr}:</td><td><input type="text" name="https_prefix" value="{$https_prefix|escape}" size="50" /></td></tr>
<tr><td class="form">{tr}Remember me feature{/tr}:</td><td class="form">
<select name="rememberme">
<option value="disabled" {if $rememberme eq 'disabled'}selected="selected"{/if}>{tr}Disabled{/tr}</option>
<!--<option value="noadmin" {if $rememberme eq 'noadmin'}selected="selected"{/if}>{tr}Only for users{/tr}</option>-->
<option value="all" {if $rememberme eq 'all'} selected="selected"{/if}>{tr}Users and admins{/tr}</option>
</select><br />
{tr}Duration:{/tr}
<select name="remembertime">
<option value="300" {if $remembertime eq 300} selected="selected"{/if}>5 {tr}minutes{/tr}</option>
<option value="900" {if $remembertime eq 900} selected="selected"{/if}>15 {tr}minutes{/tr}</option>
<option value="1800" {if $remembertime eq 1800} selected="selected"{/if}>30 {tr}minutes{/tr}</option>
<option value="3600" {if $remembertime eq 3600} selected="selected"{/if}>1 {tr}hour{/tr}</option>
<option value="7200" {if $remembertime eq 7200} selected="selected"{/if}>2 {tr}hours{/tr}</option>
<option value="36000" {if $remembertime eq 36000} selected="selected"{/if}>10 {tr}hours{/tr}</option>
<option value="72000" {if $remembertime eq 72000} selected="selected"{/if}>20 {tr}hours{/tr}</option>
<option value="86400" {if $remembertime eq 86400} selected="selected"{/if}>1 {tr}day{/tr}</option>
<option value="604800" {if $remembertime eq 604800} selected="selected"{/if}>1 {tr}week{/tr}</option>
<option value="2629743" {if $remembertime eq 2629743} selected="selected"{/if}>1 {tr}month{/tr}</option>
<option value="31556926" {if $remembertime eq 31556926} selected="selected"{/if}>1 {tr}year{/tr}</option>
</select>
</td></tr>
<tr><td class="form">{tr}Remember me name{/tr}:</td><td><input type="text" name="cookie_name" value="{$cookie_name|escape}" size="50" /></td></tr>
<tr><td class="form">{tr}Remember me domain{/tr}:</td><td><input type="text" name="cookie_domain" value="{$cookie_domain|escape}" size="50" /></td></tr>
<tr><td class="form">{tr}Remember me path{/tr}:</td><td><input type="text" name="cookie_path" value="{$cookie_path|escape}" size="50" /></td></tr>
<tr><td class="form">{tr}Protect against CSRF with a confirmation step{/tr}:</td>
<td><input type="checkbox" name="feature_ticketlib" {if $feature_ticketlib eq 'y'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}Protect against CSRF with a ticket{/tr}:</td>
<td><input type="checkbox" name="feature_ticketlib2" {if $feature_ticketlib2 eq 'y'}checked="checked"{/if}/></td></tr>
<tr><td class="form">{tr}Highlight Group{/tr}:</td><td>
<select name="highlight_group">
<option value="0">{tr}choose a group ...{/tr}</option>
{foreach key=g item=gr from=$listgroups}
<option value="{$gr|escape}" {if $gr eq $highlight_group} selected="selected"{/if}>{$gr|truncate:"52":" ..."}</option>
{/foreach}
</select>
</td></tr>

<tr><td colspan="2" class="button"><input type="submit" name="loginprefs" value="{tr}Change preferences{/tr}" /></td></tr>
</table>
</form>
</div>
</div>

<div class="cbox">
<div class="cbox-title">
  {tr}PEAR::Auth{/tr}
  {help url="LDAP+authentication" desc="{tr}LDAP{/tr}"}
</div>
<div class="cbox-data">
<form action="tiki-admin.php?page=login" method="post">
<table class="admin">
<tr><td class="form">{tr}Auth Type{/tr}:</td><td>
<select name="auth_type">
<option value="LDAP" {if $auth_type eq "LDAP"} selected="selected"{/if}>LDAP</option>
<option value="IMAP" {if $auth_type eq "IMAP"} selected="selected"{/if}>IMAP</option>
<option value="POP3" {if $auth_type eq "POP3"} selected="selected"{/if}>POP3</option>
<option value="vpopmail" {if $auth_type eq "vpopmail"} selected="selected"{/if}>vpopmail</option>
</select></td></tr>
<tr><td class="form">{tr}IMAP/POP3/LDAP Host{/tr}:</td><td><input type="text" name="auth_pear_host" value="{$auth_pear_host|escape}" size="50" /></td></tr>
<tr><td class="form">{tr}IMAP/POP3/LDAP Port{/tr}:</td><td><input type="text" name="auth_pear_port" value="{$auth_pear_port|escape}" /></td></tr>
<tr><td class="form">{tr}IMAP/POP3 BaseDSN{/tr}:</td><td><input type="text" name="auth_imap_pop3_basedsn" value="{$auth_imap_pop3_basedsn|escape}" /></td></tr>
<tr><td class="form">{tr}Create user if not in Tiki?{/tr}</td><td><input type="checkbox" name="auth_create_user_tiki" {if $auth_create_user_tiki eq 'y'}checked="checked"{/if} /></td></tr>
<tr><td class="form">{tr}Create user if not in Auth?{/tr}</td><td><input type="checkbox" name="auth_create_user_auth" {if $auth_create_user_auth eq 'y'}checked="checked"{/if} /></td></tr>
<tr><td class="form">{tr}Just use Tiki auth for admin?{/tr}</td><td><input type="checkbox" name="auth_skip_admin" {if $auth_skip_admin eq 'y'}checked="checked"{/if} /></td></tr>
<tr><td class="form">{tr}LDAP URL<br />(if set, this will override the Host and Port below){/tr}:</td><td><input type="text" name="auth_ldap_url" value="{$auth_ldap_url|escape}" size="50" /></td></tr>
<tr><td class="form">{tr}LDAP Scope{/tr}:</td><td>
<select name="auth_ldap_scope">
<option value="sub" {if $auth_ldap_scope eq "sub"} selected="selected"{/if}>sub</option>
<option value="one" {if $auth_ldap_scope eq "one"} selected="selected"{/if}>one</option>
<option value="base" {if $auth_ldap_scope eq "base"} selected="selected"{/if}>base</option>
</select>
</td></tr>
<tr><td class="form">{tr}LDAP Base DN{/tr}:</td><td><input type="text" name="auth_ldap_basedn" value="{$auth_ldap_basedn|escape}" /></td></tr>
<tr><td class="form">{tr}LDAP User DN{/tr}:</td><td><input type="text" name="auth_ldap_userdn" value="{$auth_ldap_userdn|escape}" /></td></tr>
<tr><td class="form">{tr}LDAP User Attribute{/tr}:</td><td><input type="text" name="auth_ldap_userattr" value="{$auth_ldap_userattr|escape}" /></td></tr>
<tr><td class="form">{tr}LDAP User OC{/tr}:</td><td><input type="text" name="auth_ldap_useroc" value="{$auth_ldap_useroc|escape}" /></td></tr>
<tr><td class="form">{tr}LDAP Group DN{/tr}:</td><td><input type="text" name="auth_ldap_groupdn" value="{$auth_ldap_groupdn|escape}" /></td></tr>
<tr><td class="form">{tr}LDAP Group Attribute{/tr}:</td><td><input type="text" name="auth_ldap_groupattr" value="{$auth_ldap_groupattr|escape}" /></td></tr>
<tr><td class="form">{tr}LDAP Group OC{/tr}:</td><td><input type="text" name="auth_ldap_groupoc" value="{$auth_ldap_groupoc|escape}" /></td></tr>
<tr><td class="form">{tr}LDAP Member Attribute{/tr}:</td><td><input type="text" name="auth_ldap_memberattr" value="{$auth_ldap_memberattr|escape}" /></td></tr>
<tr><td class="form">{tr}LDAP Member Is DN{/tr}:</td><td><input type="text" name="auth_ldap_memberisdn" value="{$auth_ldap_memberisdn|escape}" /></td></tr>
<tr><td class="form">{tr}LDAP Admin User{/tr}:</td><td><input type="text" name="auth_ldap_adminuser" value="{$auth_ldap_adminuser|escape}" /></td></tr>
<tr><td class="form">{tr}LDAP Admin Pwd{/tr}:</td><td><input type="password" name="auth_ldap_adminpass" value="{$auth_ldap_adminpass|escape}" /></td></tr>
<tr><td colspan="2" class="button"><input type="submit" name="auth_pear" value="{tr}Change preferences{/tr}" /></td></tr>
</table>
</form>
</div>
</div>

<div class="cbox">
<div class="cbox-title">
  {tr}PAM{/tr}
  {help url="PAM+authentication" desc="{tr}PAM{/tr}"}
</div>
<div class="cbox-data">
<form action="tiki-admin.php?page=login" method="post">
<table class="admin">
<tr><td class="form">{tr}Create user if not in Tiki?{/tr}</td><td><input type="checkbox" name="pam_create_user_tiki" {if $pam_create_user_tiki eq 'y'}checked="checked"{/if} /></td></tr>
<tr><td class="form">{tr}Just use Tiki auth for admin?{/tr}</td><td><input type="checkbox" name="pam_skip_admin" {if $pam_skip_admin eq 'y'}checked="checked"{/if} /></td></tr>
<tr><td class="form">{tr}PAM service{/tr} ({tr}Currently unused{/tr})</td><td><input type="text" name="pam_service" value="{$pam_service|escape}"/></td></tr>
<tr><td colspan="2" class="button"><input type="submit" name="auth_pam" value="{tr}Change preferences{/tr}" /></td></tr>
</table>
</form>
</div>
</div>

<div class="cbox">
<div class="cbox-title">
  {tr}CAS (Central Authentication Service){/tr}
  {help url="CAS+authentication" desc="{tr}CAS (Central Authentication Service){/tr}"}
</div>
<div class="cbox-data">

<div class="rbox" name="tip">
<div class="rbox-title" name="tip">{tr}Tip{/tr}</div>
<div class="rbox-data" name="tip">{tr}You also need to upload the <a target="_blank" href="http://esup-phpcas.sourceforge.net/">phpCAS library</a> separately to lib/phpcas/.{/tr}</div>
</div>

<form action="tiki-admin.php?page=login" method="post">
<table class="admin">
<tr><td class="form">{tr}Create user if not in Tiki?{/tr}</td><td><input type="checkbox" name="cas_create_user_tiki" {if $cas_create_user_tiki eq 'y'}checked="checked"{/if} /></td></tr>
<tr><td class="form">{tr}Just use Tiki auth for admin?{/tr}</td><td><input type="checkbox" name="cas_skip_admin" {if $cas_skip_admin eq 'y'}checked="checked"{/if} /></td></tr>
<tr><td class="form">{tr}CAS server version{/tr}:</td><td>
<select name="cas_version">
<option value="none" {if $cas_version neq "1" && $cas_version neq "2"} selected="selected"{/if}></option>
<option value="1.0" {if $cas_version eq "1.0"} selected="selected"{/if}>{tr}Version 1.0{/tr}</option>
<option value="2.0" {if $cas_version eq "2.0"} selected="selected"{/if}>{tr}Version 2.0{/tr}</option>
</select>
</td></tr>
<tr><td class="form">{tr}CAS server hostname{/tr}:</td><td><input type="text" name="cas_hostname" value="{$cas_hostname|escape}" size="50" /></td></tr>
<tr><td class="form">{tr}CAS server port{/tr}:</td><td><input type="text" name="cas_port" size="5" value="{$cas_port|escape}" /></td></tr>
<tr><td class="form">{tr}CAS server path{/tr}:</td><td><input type="text" name="cas_path" value="{$cas_path|escape}" size="50" /></td></tr>
<tr><td colspan="2" class="button"><input type="submit" name="auth_cas" value="{tr}Change CAS preferences{/tr}" /></td></tr>
</table>
</form>
</div>
</div>

<div class="cbox">
<div class="cbox-title">{tr}InterTiki{/tr}
{help url="Intertiki" desc="{tr}Intertiki exchange feature{/tr}"}
</div>
<div class="rbox" name="tip">
<div class="rbox-title" name="tip">{tr}Tip{/tr}</div>
<div class="rbox-data" name="tip"><a href="tiki-admin.php?page=intertiki">{tr}Configure InterTiki here{/tr}</a></div>
</div>
</div>
{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-live_support.tpl,v 1.10.2.2 2005/03/17 12:45:50 jmjuzan Exp $ *}

{if $feature_live_support eq 'y'}
{tikimodule title="{tr}Live support{/tr}" name="live_support" flip=$module_params.flip decorations=$module_params.decorations}
{if $modsupport > 0}
<a href="#" onclick='javascript:window.open("tiki-live_support_client.php","","menubar=,scrollbars=yes,resizable=yes,height=450,width=300");'><img border="0" src="tiki-live_support_server.php?operators_online=1" alt="image" /></a>
{else}
<img border="0" src="tiki-live_support_server.php?operators_online=0" width="120" height="45" alt="image" />
{/if}
{if $tiki_p_live_support_admin eq 'y' or $user_is_operator eq 'y'}
<br /><a class="linkmodule" {jspopup href="tiki-live_support_console.php"}>{tr}Open operator console{/tr}</a>
{/if}
{/tikimodule}
{/if}

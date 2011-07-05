{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-logged_users.tpl,v 1.6.10.1 2005/02/23 21:15:42 michael_davey Exp $ *}

{tikimodule title="{tr}Online users{/tr}" name="logged_users" flip=$module_params.flip decorations=$module_params.decorations}
  <span class="user-box-text">{tr}We have{/tr} {$logged_users} {tr}online users{/tr}</span>  
{/tikimodule}


{* $Header: /cvsroot/tikiwiki/tiki/templates/styles/moreneat/tiki.tpl,v 1.14.2.8 2006/09/10 18:06:02 ohertel Exp $ *}
{include file="header.tpl"}
{* Index we display a wiki page here *}
{if $feature_bidi eq 'y'}
<table dir="rtl" ><tr><td>
{/if}

<div id="tiki-main">

{if $feature_top_bar eq 'y'}
<div id="tiki-top">
{include file="tiki-top_bar.tpl"}
</div>
{/if}
							
{if $user}

<div id="tiki-top-menu">
{if $feature_userPreferences eq 'y'}&nbsp;<a class="tikitopmenu" href="tiki-user_preferences.php">{tr}Preferences{/tr}</a>{/if}
{if $feature_userPreferences eq 'y'}::&nbsp;<a class="tikitopmenu" href="tiki-my_tiki.php">{tr}MyTiki{/tr}</a>{/if}
{if $feature_messages eq 'y' and $tiki_p_messages eq 'y'}::&nbsp;<a class="tikitopmenu" href="messu-mailbox.php">{tr}Messages{/tr}</a>{/if}
{if $feature_userfiles eq 'y' and $tiki_p_userfiles eq 'y'}::&nbsp;<a class="tikitopmenu" href="tiki-userfiles.php">{tr}User files{/tr}</a>{/if}
{if $feature_minical eq 'y'}::&nbsp;<a class="tikitopmenu" href="tiki-minical.php">{tr}Calendar{/tr}</a>{/if}
{if $feature_usermenu eq 'y'}::&nbsp;<a class="tikitopmenu" href="tiki-usermenu.php">{tr}Favorites{/tr}</a>{/if}
{if $feature_tasks eq 'y' and $tiki_p_tasks eq 'y'}::&nbsp;<a class="tikitopmenu" href="tiki-user_tasks.php">{tr}Tasks{/tr}</a>{/if}
{if $feature_user_bookmarks eq 'y' and $tiki_p_create_bookmarks eq 'y'}::&nbsp;<a class="tikitopmenu" href="tiki-user_bookmarks.php">{tr}Bookmarks{/tr}</a>{/if}
{if $feature_newsreader eq 'y' and $tiki_p_newsreader eq 'y'}::&nbsp;<a class="tikitopmenu" href="tiki-newsreader_servers.php">{tr}Newsreader{/tr}</a>{/if}
{if $user_assigned_modules eq 'y' and $tiki_p_configure_modules eq 'y'}::&nbsp;<a class="tikitopmenu" href="tiki-user_assigned_modules.php">{tr}Modules{/tr}</a>{/if}
{if $feature_webmail eq 'y' and $tiki_p_use_webmail eq 'y'}::&nbsp;<a class="tikitopmenu" href="tiki-webmail.php">{tr}Webmail{/tr}</a>{/if}
{if $feature_notepad eq 'y' and $tiki_p_notepad eq 'y'}::&nbsp;<a class="tikitopmenu" href="tiki-notepad_list.php">{tr}Notepad{/tr}</a>{/if}
{if $feature_user_watches eq 'y'}::&nbsp;<a class="tikitopmenu" href="tiki-user_watches.php">{tr}Watches{/tr}</a>{/if}
&nbsp;&nbsp;
</div>

{if $feature_usermenu eq 'y'}	
<div id="usermenu">
&nbsp;&nbsp;<a href="tiki-usermenu.php?url={$smarty.server.REQUEST_URI|escape:"url"}" title='{tr}add{/tr}' class="linkmenu"><b>+</b></a>
{section name=ix loop=$usr_user_menus}
&nbsp;<a {if $usr_user_menus[ix].mode eq 'n'}target='_new'{/if} href="{$usr_user_menus[ix].url}" class="linkmenu"><b style="color:#999999;">&gt;</b>{$usr_user_menus[ix].name}</a>
{/section}
</div>
{/if}

{/if}



<div id="tiki-mid">
<table id="tikimidtbl" border="0" cellpadding="0" cellspacing="0" >
  {if $feature_left_column eq 'user' or $feature_right_column eq 'user'}
    <tr><td id="tiki-columns" colspan="0" width="100%">
      {if $feature_left_column eq 'user'}
        <span style="float: left"><a class="flip" href="javascript:icntoggle('leftcolumn');">
        <img name="leftcolumnicn" class="colflip" src="img/icons/ofo.gif" border="0" alt="+/-" />&nbsp;{tr}Show/Hide Left Menus{/tr}&nbsp;</a>
        </span>
      {/if}
      {if $feature_right_column eq 'user'}
        <span style="float: right"><a class="flip" href="javascript:icntoggle('rightcolumn');">
        <img name="rightcolumnicn" class="colflip" src="img/icons/ofo.gif" border="0" alt="+/-" />&nbsp;{tr}Show/Hide Right Menus{/tr}&nbsp;</a>
        </span>
      {/if}
      <br />
    </td></tr>
  {/if}
<tr>
{if $feature_left_column ne 'n'}
<td id="leftcolumn">
{section name=homeix loop=$left_modules}
{$left_modules[homeix].data}
{/section}
          {if $feature_left_column eq 'user'}
            <img src="images/none.gif" width="100%" height="0" />
            {literal}
              <script type="text/javascript">
                setfolderstate("leftcolumn");
              </script>
            {/literal}
          {/if}
</td>
{/if}
<td id="centercolumn">
<div id="tiki-center">
{if $pagetop_msg ne ''}
<span class="pagetop_msg">{$pagetop_msg}</span>
{/if}
<!-- content -->
{include file=$mid}
<!-- end of content -->
</div>
</td>
{if $feature_right_column ne 'n'}
<td id="rightcolumn">
{section name=homeix loop=$right_modules}
{$right_modules[homeix].data}
{/section}
          {if $feature_right_column eq 'user'}
            <img src="images/none.gif" width="100%" height="0" />
            {literal}
              <script type="text/javascript"> 
                setfolderstate("rightcolumn");
              </script>
            {/literal}
          {/if}
</td>
{/if}
</tr></table>
</div>

{if $feature_bot_bar eq 'y'}
<div id="tiki-bot">
{include file="tiki-bot_bar.tpl"}
</div>
{/if}

</div>

{if $feature_bidi eq 'y'}
</td></tr></table>
{/if}

{include file="footer.tpl"}


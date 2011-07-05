<script type="text/javascript" src="lib/js/toggleImage.js"></script>

{include file="header.tpl"}
{* Index we display a wiki page here *}
{*if $feature_bidi eq 'y'}
<table dir="rtl" ><tr><td>
{/if*}

<div id="tiki-main">
  {if $feature_top_bar eq 'y'}
    <div id="tiki-top">
      {include file="tiki-top_bar.tpl"}
    </div>
  {/if}

  
  {if $feature_usermenu eq 'y'}	
	  <div id="usermenu">
	  	&nbsp;&nbsp;<a href="tiki-usermenu.php?url={$smarty.server.REQUEST_URI|escape:"url"}"><img src='img/icons/add.gif' border='0' alt='{tr}add{/tr}' title='{tr}add{/tr}' /></a>
	  	{section name=ix loop=$usr_user_menus}
  			&nbsp;&nbsp;<img style="vertical-align:bottom;" src="styles/neat/logoIcon.gif" /><a {if $usr_user_menus[ix].mode eq 'n'}target='_blank'{/if} href="{$usr_user_menus[ix].url}" class="tikitopmenu2">{$usr_user_menus[ix].name}</a>
  		{/section}
  		
	  </div>
  {/if}
 
<div id="tiki-mid-tudo">
  <div id="tiki-mid-fundo">
  
    {if $category eq "Vídeo"}
      <span class="page-title">
      video||LAB
      </span>
    {elseif $category eq "Áudio"}
      <span class="page-title">
      audio||LAB
      </span>
    {elseif $category eq "Gráfico"}
      <span class="page-title">
      grafi||LAB
      </span>

    {/if}

    <div id="tiki-mid">
    {$mid_data}
    </div>

   
  </div>

  {if $category eq "Vídeo"}
	  {include file="mod-el_menu_video.tpl"}
	  <link rel="StyleSheet"  href="styles/estudiolivre_orig/css/estudiolivre_video.css" type="text/css" />
  {elseif $category eq "Áudio"}
  	  {include file="mod-el_menu_audio.tpl"}
  	  <link rel="StyleSheet"  href="styles/estudiolivre_orig/css/estudiolivre_audio.css" type="text/css" />
  {elseif $category eq "Gráfico"}
  	  {include file="mod-el_menu_grafico.tpl"}
  	  <link rel="StyleSheet"  href="styles/estudiolivre_orig/css/estudiolivre_grafico.css" type="text/css" />
  {/if}

  <div id="tiki-coluna-direita">
  
    {if $feature_right_column ne 'n'}
     {section name=homeix loop=$right_modules}
       {$right_modules[homeix].data}
     {/section}
      
    {/if}
  
  </div>
  
  
</div>
  

</div>

{*if $feature_bidi eq 'y'}
</td></tr></table>
{/if*}

     {*section name=homeix loop=$left_modules}
      {$left_modules[homeix].data}
      {/section*}

{include file="footer.tpl"}

{*

  { if $feature_bot_bar eq 'y'}
    <div id="tiki-bot">
    <	/div>
  {/if }

  { if $user }
	  <div id="tiki-top-menu">
			{if $tiki_p_admin eq 'y' and $feature_debug_console eq 'y'}
			  &nbsp;<a class="tikitopmenu" href="javascript:toggle('debugconsole');">{tr}debug{/tr}</a> //
			{/if}
		  {if $feature_userPreferences eq 'y'}
		  	&nbsp;&nbsp;<img src='styles/neat/user.gif' /><a class="tikitopmenu" href="tiki-user_preferences.php">{tr}Preferences{/tr}</a>
		  {/if}
		  &nbsp;&nbsp;<img src='styles/neat/user.gif' /><a class="tikitopmenu" href="tiki-my_tiki.php">{tr}MyTiki{/tr}</a>
		  {if $feature_messages eq 'y' and $tiki_p_messages eq 'y'}
		  	&nbsp;&nbsp;<img src='styles/neat/linkOpaque.gif' /><a class="tikitopmenu" href="messu-mailbox.php">{tr}Messages{/tr}</a>
		  {/if}
		  {if $feature_userfiles eq 'y' and $tiki_p_userfiles eq 'y'}
		  	&nbsp;&nbsp;<img src='styles/neat/linkOpaque.gif' /><a class="tikitopmenu" href="tiki-userfiles.php">{tr}User files{/tr}</a>
		  {/if}
		  {if $feature_minical eq 'y'}
		  	&nbsp;&nbsp;<img src='styles/neat/linkOpaque.gif' /><a class="tikitopmenu" href="tiki-minical.php">{tr}Calendar{/tr}</a>
		  {/if}
		  {if $feature_usermenu eq 'y'}
		  	&nbsp;&nbsp;<img src='styles/neat/linkOpaque.gif' /><a class="tikitopmenu" href="tiki-usermenu.php">{tr}Favorites{/tr}</a>
		  {/if}
 	      {if $feature_tasks eq 'y' and $tiki_p_tasks eq 'y'}
		  	&nbsp;&nbsp;<img src='styles/neat/linkOpaque.gif' /><a class="tikitopmenu" href="tiki-user_tasks.php">{tr}Tasks{/tr}</a>
		  {/if}
		  {if $feature_user_bookmarks eq 'y' and $tiki_p_create_bookmarks eq 'y'}
		  	&nbsp;&nbsp;<img src='styles/neat/linkOpaque.gif' /><a class="tikitopmenu" href="tiki-user_bookmarks.php">{tr}Bookmarks{/tr}</a>
		  {/if}
		  {if $feature_newsreader eq 'y' and $tiki_p_newsreader eq 'y'}
		  	&nbsp;&nbsp;<img src='styles/neat/linkOpaque.gif' /><a class="tikitopmenu" href="tiki-newsreader_servers.php">{tr}Newsreader{/tr}</a>
		  {/if}
		  {if $user_assigned_modules eq 'y' and $tiki_p_configure_modules eq 'y'}
		  	&nbsp;&nbsp;<img src='styles/neat/linkOpaque.gif' /><a class="tikitopmenu" href="tiki-user_assigned_modules.php">{tr}Modules{/tr}</a>
		  {/if}
		  {if $feature_webmail eq 'y' and $tiki_p_use_webmail eq 'y'}
		  	&nbsp;&nbsp;<img src='styles/neat/linkOpaque.gif' /><a class="tikitopmenu" href="tiki-webmail.php">{tr}Webmail{/tr}</a>
		  {/if}
		  {if $feature_notepad eq 'y' and $tiki_p_notepad eq 'y'}
		  	&nbsp;&nbsp;<img src='styles/neat/linkOpaque.gif' /><a class="tikitopmenu" href="tiki-notepad_list.php">{tr}Notepad{/tr}</a>
		  {/if}
		  {if $feature_user_watches eq 'y'}
		  	&nbsp;&nbsp;<img src='styles/neat/linkOpaque.gif' /><a class="tikitopmenu" href="tiki-user_watches.php">{tr}Watches{/tr}</a>
		  {/if}
		  &nbsp;&nbsp;&nbsp;&nbsp;
	  </div>
  { /if }

    <table border="0" cellpadding="0" cellspacing="0" >
    <tr>
      {if $feature_left_column ne 'n'}
      <td id="leftcolumn">
      {section name=homeix loop=$left_modules}
      {$left_modules[homeix].data}
      {/section}
      
      </td>
      {/if}
      <td id="centercolumn"><div id="tiki-center">
      </div>
      </td>

    </tr>
    </table>
    {include file="tiki-bot_bar.tpl"}
 *}
 
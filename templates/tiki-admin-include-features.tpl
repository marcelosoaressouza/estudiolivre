
{* this is the very top most box of the feature section in tiki-admin.php?page=features,
 * each td is a cell,each tr is a row, not to be confused with tr-smarty-tag which means translate...
 * there are five cells for every row, the middle cell is empty to keep feature and ckboxes separate
 *}

<div class="rbox" name="tip">
<div class="rbox-title" name="tip">{tr}Tip{/tr}</div>  
<div class="rbox-data" name="tip">{tr}Please see the <a class="rbox-link" target="tikihelp" href="http://doc.tikiwiki.org/tiki-index.php?page=Features">evaluation of each feature</a> on Tiki's developer site.{/tr}</div>
</div>
<br /> 
 
<form action="tiki-admin.php?page=features" method="post">
  <div class="cbox">
    <div class="cbox-title">
      {tr}{$crumbs[$crumb]->title}{/tr}
      {help crumb=$crumbs[$crumb]}
    </div>
{* the heading of the  box *}
<div class="cbox-data">
<table width="100%" class="admin">
  <tr>
    <td class="heading" colspan="7" align="center">{tr}Tiki sections and features{/tr}</td>
  </tr>
  {* top left wiki ck box ... each of the function option boxes here begin with td class form *}
  <tr>
    <td ><input type="checkbox" name="feature_wiki"
            {if $feature_wiki eq 'y'}checked="checked"{/if}/></td>
    <td class="form" > {if $feature_help eq 'y'}<a href="{$helpurl}Wiki" target="tikihelp" class="tikihelp" title="{tr}Wiki{/tr}">{/if} {tr}Wiki{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    {* here is the blank cell *}
    <td >&nbsp;</td>
    <td><input type="checkbox" name="feature_blogs"
            {if $feature_blogs eq 'y'}checked="checked"{/if}/></td>
    {* here is the beginning of the new cell for blogs followed by a check box cell *}
    <td class="form" > {if $feature_help eq 'y'}<a href="{$helpurl}Blog" target="tikihelp" class="tikihelp" title="{tr}Wiki{/tr}">{/if} {tr}Blogs{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  {* end of the first row *}
  <tr>
    <td><input type="checkbox" name="feature_galleries"
            {if $feature_galleries eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Image+Gallery" target="tikihelp" class="tikihelp" title="{tr}Image Galleries{/tr}">{/if} {tr}Image Galleries{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_file_galleries"
            {if $feature_file_galleries eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}File+Gallery" target="tikihelp" class="tikihelp" title="{tr}File Galleries{/tr}">{/if} {tr}File Galleries{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_articles"
            {if $feature_articles eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Articles" target="tikihelp" class="tikihelp" title="{tr}Articles{/tr}">{/if} {tr}Articles{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_forums"
            {if $feature_forums eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Forum" target="tikihelp" class="tikihelp" title="{tr}Forums{/tr}">{/if} {tr}Forums{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_faqs"
            {if $feature_faqs eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}FAQ" target="tikihelp" class="tikihelp" title="{tr}FAQs{/tr}">{/if} {tr}FAQs{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_shoutbox"
            {if $feature_shoutbox eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Shoutbox" target="tikihelp" class="tikihelp" title="{tr}Shoutbox{/tr}">{/if} {tr}Shoutbox{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_chat"
            {if $feature_chat eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Chat" target="tikihelp" class="tikihelp" title="{tr}Chat{/tr}">{/if} {tr}Chat{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_trackers"
            {if $feature_trackers eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Trackers" target="tikihelp" class="tikihelp" title="{tr}Trackers{/tr}">{/if} 
{tr}Trackers{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_directory"
            {if $feature_directory eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Directory" target="tikihelp" class="tikihelp" title="{tr}Directory{/tr}">{/if} {tr}Directory{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_webmail"
            {if $feature_webmail eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Webmail" target="tikihelp" class="tikihelp" title="{tr}Webmail{/tr}">{/if} {tr}Webmail{/tr} {if $feature_help eq 'y'}</a>{/if} </td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_newsreader"
            {if $feature_newsreader eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Newsreader" target="tikihelp" class="tikihelp" title="{tr}Newsreader{/tr}">{/if} {tr}Newsreader{/tr} {if $feature_help eq 'y'}</a>{/if} </td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_surveys"
            {if $feature_surveys eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Survey" target="tikihelp" class="tikihelp" title="{tr}Surveys{/tr}">{/if} {tr}Surveys{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_polls"
            {if $feature_polls eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Polls" target="tikihelp" class="tikihelp" title="{tr}Polls{/tr}">{/if} {tr}Polls{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_eph"
            {if $feature_eph eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Ephemerides" target="tikihelp" class="tikihelp" title="{tr}Ephemerides{/tr}">{/if} {tr}Ephemerides{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_quizzes"
            {if $feature_quizzes eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Quiz" target="tikihelp" class="tikihelp" title="{tr}Quizzes{/tr}">{/if} {tr}Quizzes{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td ><input type="checkbox" name="feature_search"
            {if $feature_search eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Search" target="tikihelp" class="tikihelp" title="{tr}Search{/tr}">{/if} {tr}Search{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_featuredLinks"
            {if $feature_featuredLinks eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Featured+Links" target="tikihelp" class="tikihelp" title="{tr}Featured Help{/tr}">{/if} {tr}Featured links{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_banners"
            {if $feature_banners eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Banners" target="tikihelp" class="tikihelp" title="{tr}Banners{/tr}">{/if} {tr}Banners{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_games" 
            {if $feature_games eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Games" target="tikihelp" class="tikihelp" title="{tr}Games{/tr}">{/if} {tr}Games{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_workflow"
            {if $feature_workflow eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Workflow" target="tikihelp" class="tikihelp" title="{tr}Workflow{/tr}">{/if} {tr}Workflow engine{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_newsletters"
            {if $feature_newsletters eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Newsletters" target="tikihelp" class="tikihelp" title="{tr}Newsletters{/tr}">{/if} {tr}Newsletters{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_live_support"
            {if $feature_live_support eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Live+Support" target="tikihelp" class="tikihelp" title="{tr}Live Support{/tr}">{/if} {tr}Live support system{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr> {* beginning of mini calendar function option *}
      <td><input type="checkbox" name="feature_minical"
            {if $feature_minical eq 'y'}checked="checked"{/if}/></td>
      <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Calendar" target="tikihelp" class="tikihelp" title="{tr}Mini Calendar{/tr}">{/if} {tr}Mini Calendar{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
      <td>&nbsp;</td>
      <td><input type="checkbox" name="feature_maps"
            {if $feature_maps eq 'y'}checked="checked"{/if}/></td>
      <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Map" target="tikihelp" class="tikihelp" title="{tr}Maps{/tr}">{/if} 
{tr}Maps{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
      {* here is the categories option *}      </tr>
  {* Calendar option on left side of first row of table*}
  <tr>
    <td>&nbsp; </td>
    <td class="form"><a href="tiki-admin.php?page=general#help">{tr}Help System{/tr}</a></td>
    <td>&nbsp;</td>
    
    <td></td>
    <td class="form"> <a href="tiki-admin.php?page=category">{tr}Categories{/tr}</a> </td>
  </tr>
  <tr>
    <td></td>
    <td class="form"> <a href="tiki-admin.php?page=module">{tr}Show Module Controls{/tr}</a></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_calendar"
					{if $feature_calendar eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Calendar" target="tikihelp" class="tikihelp" title="{tr}Calendar{/tr}">{/if} {tr}Tiki Calendar{/tr} {if $feature_help eq 'y'}</a>{/if}</td></tr>
    <tr>
    <td><input type="checkbox" name="feature_mailin"
				{if $feature_mailin eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Mail-in" target="tikihelp" class="tikihelp" title="{tr}Mail-in{/tr}">{/if} 
{tr}Mail-in{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td></td>
    <td class="form"> <a href="tiki-admin.php?page=theme"> {tr}Tiki Template Viewing{/tr} </a></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_integrator"
            {if $feature_integrator eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Integrator" target="tikihelp" class="tikihelp" title="{tr}Integrator{/tr}">{/if} {tr}Integrator{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_phplayers" {if $feature_phplayers eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="http://themes.tikiwiki.org/tiki-index.php?page=PhpLayersMenu" 
target="tikihelp" class="tikihelp" title="{tr}PHPLayers{/tr}">{/if} {tr}PhpLayers Dynamic menus{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_jscalendar" {if $feature_jscalendar eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Js+Calendar" target="tikihelp" class="tikihelp" title="{tr}JsCalendar{/tr}">{/if} {tr}JsCalendar{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td class="form"> <a href="tiki-admin.php?page=theme">{tr}Use Tabs{/tr}</a> </td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_score" {if $feature_score eq 'y'}checked="checked"{/if} /></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Score" target="tikihelp" class="tikihelp" title="{tr}Score{/tr}">{/if} {tr}Score{/tr}{if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_sheet" {if $feature_sheet eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Spreadsheet" target="tikihelp" class="tikihelp" title="{tr}TikiSheet{/tr}">{/if} {tr}Tiki Sheet{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
  </tr><tr>
    <td><input type="checkbox" name="feature_friends" {if $feature_friends eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Friendship+Network" target="tikihelp" class="tikihelp" title="{tr}Friendship Network{/tr}">{/if} {tr}Friendship Network{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_siteidentity" {if $feature_siteidentity eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Site+Identity" target="tikihelp" class="tikihelp" title="{tr}Site Logo and Identity{/tr}">{/if} {tr}Site Logo and Identity{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
  </tr><tr>
    <td><input type="checkbox" name="feature_mobile" {if $feature_mobile eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Mobile" target="tikihelp" class="tikihelp" title="{tr}Mobile{/tr}">{/if} {tr}Mobile{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_gmap" {if $feature_gmap eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Gmap" target="tikihelp" class="tikihelp" title="{tr}Google Maps{/tr}">{/if} {tr}Google Maps{/tr} {if $feature_help eq 'y'}</a>{/if}</td>    
  </tr></table>    
{* ---------- Content features ------------ *}
<table width="100%" class="admin">
  <tr>
    <td class="heading" colspan="5"
            align="center">{tr}Content Features{/tr}</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_hotwords" 
            {if $feature_hotwords eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Hotwords" target="tikihelp" class="tikihelp" title="{tr}Hotwords{/tr}">{/if} {tr}Hotwords{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td class="form">&nbsp;</td>

    <td><input type="checkbox" name="feature_hotwords_nw"
            {if $feature_hotwords_nw eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Hotwords" target="tikihelp" class="tikihelp" title="{tr}Hotwords in New Windows{/tr}">{/if} {tr}Hotwords in New Windows{/tr} {if $feature_help eq 'y'}</a>{/if}</td>

  </tr>
  <tr>
    <td><input type="checkbox" name="feature_custom_home"
            {if $feature_custom_home eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Custom+Home" target="tikihelp" class="tikihelp" title="{tr}Custom Home{/tr}">{/if} {tr}Custom Home{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td class="form">&nbsp;</td>
    
    <td><input type="checkbox" name="feature_html_pages"
            {if $feature_html_pages eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Html+Pages" target="tikihelp" class="tikihelp" title="{tr}HTML Pages{/tr}">{/if} {tr}HTML pages{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_drawings"
            {if $feature_drawings eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Drawings" target="tikihelp" class="tikihelp" title="{tr}Drawings{/tr}">{/if} {tr}Drawings{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td class="form">&nbsp;</td>
    <td><input type="checkbox" name="feature_dynamic_content"
            {if $feature_dynamic_content eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Dynamic+Content" target="tikihelp" class="tikihelp" title="{tr}Dynamic Content System{/tr}">{/if} {tr}Dynamic Content System{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_charts"
            {if $feature_charts eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Charts" target="tikihelp" class="tikihelp" title="{tr}Charts{/tr}">{/if} {tr}Charts{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td class="form">&nbsp;</td>
    <td>
    </td>
    <td class="form"> <a href="tiki-admin.php?page=textarea">{tr}Allow Smileys{/tr}</a> </td>
  </tr>
  <tr>
    <td></td>
    <td class="form"><a href="tiki-admin.php?page=textarea"> {tr}AutoLinks{/tr} </a> </td>
    <td class="form">&nbsp;</td>
    <td><input type="checkbox" name="feature_use_quoteplugin"
            {if $feature_use_quoteplugin eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {tr}Use Quote plugin rather than &ldquo;>&rdquo; for quoting{/tr} </td>
  </tr>
</table>
{* ---------- Administration features ------------ *}
<table width="100%" class="admin">
  <tr>
    <td class="heading" colspan="5" 
            align="center">{tr}Administration Features{/tr}</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_banning"
            {if $feature_banning eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Banning" target="tikihelp" class="tikihelp" title="{tr}Banning System{/tr}">{/if} {tr}Banning system{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_debug_console"
            {if $feature_debug_console eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Debugger+Console" target="tikihelp" class="tikihelp" title="{tr}Debugger Console{/tr}">{/if} {tr}Debugger Console{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_stats"
            {if $feature_stats eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Stats" target="tikihelp" class="tikihelp" title="{tr}Stats{/tr}">{/if} {tr}Stats{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_comm"
            {if $feature_comm eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Communication+Center" target="tikihelp" class="tikihelp" title="{tr}Communications (send/receive objects){/tr}">{/if} {tr}Communications (send/receive objects){/tr} {if $feature_help eq 'y'}</a>{/if} </td>
    </tr>
  <tr>
    <td></td>
    <td class="form"> <a href="tiki-admin.php?page=theme">{tr}Theme Control{/tr}</a></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_xmlrpc"
            {if $feature_xmlrpc eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Xmlrpc" target="tikihelp" class="tikihelp" title="{tr}XMLRPC API{/tr}">{/if} {tr}XMLRPC API{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_referer_stats"
            {if $feature_referer_stats eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Stats" target="tikihelp" class="tikihelp" title="{tr}Referer Stats{/tr}">{/if} {tr}Referer Stats{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_contact"
            {if $feature_contact eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Contact" target="tikihelp" class="tikihelp" title="{tr}Contact Us{/tr}">{/if} {tr}Contact Us{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    </tr>
  <tr>
    <td><input type="checkbox" name="contact_anon"
            {if $contact_anon eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Contact" target="tikihelp" class="tikihelp" title="{tr}Contact Us{/tr}">{/if} {tr}Contact Us (Anonymous){/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_redirect_on_error"
    	{if $feature_redirect_on_error eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {tr}Redirect On Error{/tr} </td>
    </tr>
</table>
{* --- User Features --- *}
<table width="100%" class="admin">
  <tr>
    <td class="heading" colspan="5"
            align="center">{tr}User Features{/tr}</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_userPreferences"
            {if $feature_userPreferences eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}User+Preferences" target="tikihelp" class="tikihelp" title="{tr}User Preferences Screen{/tr}">{/if} {tr}User Preferences Screen{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td align="right"><div align="right">
      <input type="checkbox" name="user_assigned_modules"
            {if $user_assigned_modules eq 'y'}checked="checked"{/if}/>
    </div></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Users+Configure+Modules" target="tikihelp" class="tikihelp" title="{tr}Users can Configure Modules{/tr}">{/if} {tr}Users can Configure Modules{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_user_bookmarks"
            {if $feature_user_bookmarks eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Bookmarks" target="tikihelp" class="tikihelp" title="{tr}User Bookmarks{/tr}">{/if} {tr}User Bookmarks{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td><select name="user_flip_modules">
      <option value="y" {if $user_flip_modules eq 'y'}selected="selected"{/if}>{tr}always{/tr}</option>
      <option value="module" {if $user_flip_modules eq 'module'}selected="selected"{/if}>{tr}module decides{/tr}</option>
      <option value="n" {if $user_flip_modules eq 'n'}selected="selected"{/if}>{tr}never{/tr}</option>
    </select></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Users+Shade+Modules" target="tikihelp" class="tikihelp" title="{tr}Users can Shade Modules{/tr}">{/if} {tr}Users can Shade Modules{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_user_watches"
            {if $feature_user_watches eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Watch" target="tikihelp" class="tikihelp" title="{tr}User Watches{/tr}">{/if} {tr}User Watches{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td align="right"><div align="right">
      <input type="checkbox" name="feature_user_watches_translations"
            {if $feature_user_watches_translations eq 'y'}checked="checked"{/if}/>
    </div></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Watch" target="tikihelp" class="tikihelp" title="{tr}User Watches Translations{/tr}">{/if} {tr}User Watches Translations{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_usermenu"
            {if $feature_usermenu eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}User+Menu" target="tikihelp" class="tikihelp" title="{tr}User Menu{/tr}">{/if} {tr}User Menu{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td align="right"><div align="right">
      <input type="checkbox" name="feature_tasks"
            {if $feature_tasks eq 'y'}checked="checked"{/if}/>
    </div></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Task" target="tikihelp" class="tikihelp" title="{tr}User Tasks{/tr}">{/if} {tr}User Tasks{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_messages"
            {if $feature_messages eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Inter-User+Messages" target="tikihelp" class="tikihelp" title="{tr}User Messages{/tr}">{/if} {tr}User Messages{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
    <td align="right"><div align="right">
      <input type="checkbox" name="feature_userfiles"
            {if $feature_userfiles eq 'y'}checked="checked"{/if}/>
    </div></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}User+Files" target="tikihelp" class="tikihelp" title="{tr}User Files{/tr}">{/if} {tr}User Files{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_notepad"
            {if $feature_notepad eq 'y'}checked="checked"{/if}/></td>
    <td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Notepad" target="tikihelp" class="tikihelp" title="{tr}User Notepad{/tr}">{/if} {tr}User Notepad{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
    <td>&nbsp;</td>
  </tr>
</table>
{* --- General Layout options --- *}
<table class="admin" width="100%">
<tr>


        <td class="heading" colspan="5" 
            align="center">{tr}General Layout options{/tr}</td>
      </tr><tr>
        <td class="form">
	        	{if $feature_help eq 'y'}<a href="{$helpurl}Users+Flip+Columns" target="tikihelp" class="tikihelp" title="{tr}Users can Flip Columns{/tr}">{/if}
        		{tr}Left column{/tr}
        		{if $feature_help eq 'y'}</a>{/if}
        		:</td>
        <td><select name="feature_left_column">
            <option value="y" {if $feature_left_column eq 'y'}selected="selected"{/if}>{tr}always{/tr}</option>
            <option value="user" {if $feature_left_column eq 'user'}selected="selected"{/if}>{tr}user decides{/tr}</option>
            <option value="n" {if $feature_left_column eq 'n'}selected="selected"{/if}>{tr}never{/tr}</option>
        </select></td>

      </tr><tr>
        <td class="form">
	        	{if $feature_help eq 'y'}<a href="{$helpurl}Users+Flip+Columns" target="tikihelp" class="tikihelp" title="{tr}Users can Flip Columns{/tr}">{/if}
        		{tr}Right column{/tr}
        		{if $feature_help eq 'y'}</a>{/if}
        		:</td>
        <td><select name="feature_right_column">
            <option value="y" {if $feature_right_column eq 'y'}selected="selected"{/if}>{tr}always{/tr}</option>
            <option value="user" {if $feature_right_column eq 'user'}selected="selected"{/if}>{tr}user decides{/tr}</option>
            <option value="n" {if $feature_right_column eq 'n'}selected="selected"{/if}>{tr}never{/tr}</option>
        </select></td>

      </tr><tr>
        <td class="form">{tr}Layout per section{/tr}</td>
        <td><input type="checkbox" name="layout_section"
            {if $layout_section eq 'y'}checked="checked"/> <a href="tiki-admin_layout.php" class="link">{tr}Admin layout per section{/tr}</a> {/if}
	</td>
      </tr><tr>
        <td class="form">{tr}Top bar{/tr}</td>
        <td><input type="checkbox" name="feature_top_bar"
            {if $feature_top_bar eq 'y'}checked="checked"{/if}/></td>
        <td colspan="3">&nbsp;</td>
      </tr><tr>
        <td class="form">{tr}Bottom bar{/tr}</td>
        <td><input type="checkbox" name="feature_bot_bar"
            {if $feature_bot_bar eq 'y'}checked="checked"{/if}/></td>
        <td colspan="3">&nbsp;</td>
      </tr><tr>
      <td class="form">{tr}Bottom bar icons{/tr}</td>
        <td><input type="checkbox" name="feature_bot_bar_icons"
            {if $feature_bot_bar_icons eq 'y'}checked="checked"{/if}/></td>
        <td colspan="3">&nbsp;</td>
      </tr><tr>
        <td class="form">{tr}Bottom bar debug{/tr}</td>
        <td><input type="checkbox" name="feature_bot_bar_debug"
	    {if $feature_bot_bar_debug eq 'y'}checked="checked"{/if}/></td>
	<td colspan="3">&nbsp;</td>
      </tr><tr>
        <td colspan="5" class="button">
          <input type="submit" name="features" value="{tr}Change preferences{/tr}" />
        </td>
      </tr></table>
    </div>
  </div>
</form>

{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/estudiolivre/tiki-edit_help.tpl,v 1.3 2006-07-12 01:34:35 rhwinter Exp $ *}
{* Show wiki syntax and plugins help *}
{* TODO: Add links to add samples to edit form *}

{tooltip text="Ver ou esconder a <b>ajuda</b> do wiki"}
	<span id="editHelp" class="pointer" onclick="flip('edithelpzone')"><img src="images/ed_help.gif"></span>
{/tooltip}

<div class="wiki-edithelp"  id='edithelpzone'  style="display:none">
<div id="wikihelp-tab">
<br/><br/>
{if count($plugins) ne 0}
  <div style="text-align: right;">
    <a href="javascript:hide('wikihelp-tab');show('wikiplhelp-tab');">{tr}Show Plugins Help{/tr}</a>
    <a title="{tr}Close{/tr}" href="javascript:flip('edithelpzone');">[x]</a>
  </div>
{/if}
<br />

<p>{tr}For more information, please see <a href="{$helpurl}WikiSyntax">WikiSyntax</a>{/tr}</p>

<table width="100%">
<tr><td width="20%"><strong>{tr}Emphasis{/tr}:</strong></td><td> '<strong></strong>' {tr}for{/tr} <em>{tr}italics{/tr}</em>, _<em></em>_ {tr}for{/tr} <strong>{tr}bold{/tr}</strong>, '<strong></strong>'_<em></em>_ {tr}for{/tr} <em><strong>{tr}both{/tr}</strong></em></td></tr>
<tr><td><strong>{tr}Lists{/tr}:</strong></td><td> * {tr}for bullet lists{/tr}, # {tr}for numbered lists{/tr}, ;{tr}term{/tr}:{tr}definition{/tr} {tr}for definiton lists{/tr}</td></tr>
<tr><td><strong>{tr}Wiki References{/tr}:</strong></td><td> {tr}JoinCapitalizedWords or use{/tr} (({tr}page{/tr})) {tr}or{/tr} (({tr}page|desc{/tr})) {tr}for wiki references{/tr}, )){tr}SomeName{/tr}(( {tr}prevents referencing{/tr}</td></tr>
{if $feature_drawings eq 'y'}
<tr><td><strong>{tr}Drawings{/tr}:</strong></td><td> {literal}{{/literal}draw name=foo} {tr}creates the editable drawing foo{/tr}</td></tr>
{/if}
<tr><td><strong>{tr}External links{/tr}:</strong></td><td> {tr}use square brackets for an external link: [URL] or [URL|link_description] or [URL|description|nocache]  (that last form prevents the local Wiki from caching the page; please use that form for large pages!).{/tr}<br />{tr}For an external Wiki, use ExternalWikiName:PageName or ((External Wiki Name: Page Name)){/tr}</td></tr>
<tr><td><strong>{tr}Multi-page pages{/tr}:</strong></td><td>{tr}use ...page... to separate pages{/tr}</td></tr>
<tr><td><strong>{tr}Headings{/tr}:</strong></td><td> "!", "!!", "!!!" {tr}make_headings{/tr}</td></tr>
<tr><td><strong>{tr}Show/Hide{/tr}:</strong></td><td> "!+", "!!-" {tr}show/hide heading section. + (shown) or - (hidden) by default{/tr}.</td></tr>
<tr><td><strong>{tr}Misc{/tr}:</strong></td><td> "-<em></em>-<em></em>-<em></em>-" {tr}makes a horizontal rule{/tr} "==={tr}text{/tr}===" {tr}underlines text{/tr}.</td></tr>
<tr><td><strong>{tr}Title bar{/tr}:</strong></td><td> "-={tr}title{/tr}=-" {tr}creates a title bar{/tr}.</td></tr>
<tr><td><strong>{tr}Wiki File Attachments{/tr}:</strong></td><td> {literal}{{/literal}file name=file.ext desc="description text" page="wiki page name" showdesc=1} {tr}Creates a link to the named file.  If page is not given, the file must be attached to the current page.  If desc is not given, the file name is used for the link text, unless showdesc is used, which makes the file description be used for the link text.  If image=1 is given, the attachment is treated as an image and is displayed directly on the page; no link is generated.{/tr}</td></tr>
<tr><td><strong>{tr}Images{/tr}:</strong></td><td> "{literal}{{/literal}img src=http://example.com/foo.jpg width=200 height=100 align=center imalign=right link=http://www.yahoo.com desc=foo alt=txt usemap=name}" {tr}displays an image{/tr} {tr}height width desc link and align are optional{/tr}</td></tr>
<tr><td><strong>{tr}Non cacheable images{/tr}:</strong></td><td> "{literal}{{/literal}img src=http://example.com/foo.jpg?nocache=1 width=200 height=100 align=center link=http://www.yahoo.com desc=foo}" {tr}displays an image{/tr} {tr}height width desc link and align are optional{/tr}</td></tr>
{if $feature_wiki_tables eq 'new'}
<tr><td><strong>{tr}Tables{/tr}:</strong></td><td> "||row1-col1|row1-col2|row1-col3<br />row2-col1|row2-col2|row2-col3||" {tr}creates a table{/tr}</td></tr>
{else}
<tr><td><strong>{tr}Tables{/tr}:</strong></td><td> "||row1-col1|row1-col2|row1-col3||row2-col1|row2-col2col3||" {tr}creates a table{/tr}</td></tr>
{/if}
<tr><td><strong>{tr}RSS feeds{/tr}:</strong></td><td> "{literal}{{/literal}rss id=n max=m{literal}}{/literal}" {tr}displays rss feed with id=n maximum=m items{/tr}</td></tr>
<tr><td><strong>{tr}Simple box{/tr}:</strong></td><td> "^{tr}Box content{/tr}^" {tr}Creates a box with the data{/tr}</td></tr>
<tr><td><strong>{tr}Dynamic content{/tr}:</strong></td><td> "{literal}{{/literal}content id=n}" {tr}Will be replaced by the actual value of the dynamic content block with id=n{/tr}</td></tr>
<tr><td><strong>{tr}Colored text{/tr}:</strong></td><td> "~~#FFEE33:{tr}some text{/tr}~~" {tr}Will display using the indicated HTML color{/tr}</td></tr>
<tr><td><strong>{tr}Center{/tr}:</strong></td><td> "::{tr}some text{/tr}::" {tr}Will display the text centered{/tr}</td></tr>
<tr><td><strong>{tr}Non parsed sections{/tr}:</strong></td><td> "~np~ {tr}data{/tr} ~/np~" {tr}Prevents wiki parsing of the enclosed data.{/tr}</td></tr>
<tr><td><strong>{tr}Preformated sections{/tr}:</strong></td><td> "~pp~ {tr}data{/tr} ~/pp~" {tr}Displays preformated text/code; no Wiki processing is done inside these sections (as with np), and the spacing is fixed (no word wrapping is done).{/tr}</td></tr>
<tr><td><strong>{tr}Square Brackets{/tr}:</strong></td><td> {tr}Use [[foo] to show [foo].{/tr}</td></tr>
<tr><td><strong>{tr}Block Preformatting{/tr}:</strong></td><td> {tr}Indent text with any number of spaces to turn it into a monospaced block that still follows other Wiki formatting instructions. It will be indended with the same number of spaces that you used.  Note that this mode does not preserve exact spacing and line breaks; use ~pp~...~/pp~ for that.{/tr}</td></tr>
<tr><td><strong>{tr}Dynamic variables{/tr}:</strong></td><td> "%{tr}name{/tr}%" {tr}Inserts an editable variable{/tr}</td></tr>
<tr><td><strong>{tr}Insert Module Output{/tr}:</strong></td><td> {tr}{literal}{MODULE(module=>some_module)}text{MODULE}{/literal}  can be used to insert the output of module "some_module" into your Wiki page. See <a href="{$helpurl}PluginModule">PluginModule</a> for more information. {/tr}</td></tr>
<tr><td><strong>{tr}Rendering Program Code{/tr}:</strong></td><td> {tr}{literal}{CODE()}some code{CODE} {/literal} will render "some code" as program code. This plugin has other options; see <a href="{$helpurl}PluginCode">PluginCode</a>.{/tr}</td></tr>
<tr><td><strong>{tr}Direction{/tr}:</strong></td><td>"{literal}{r2l}{/literal}", "{literal}{l2r}{/literal}", "{literal}{rm}{/literal}", "{literal}{lm}{/literal}" Insert resp. right-to-left and left-to-right text direction DIV (up to end of text) and markers for langages as arabic or hebrew.</td></tr>
<tr><td><strong>{tr}Table of contents{/tr}</strong></td><td>{tr}"{literal}{toc}{/literal}", "{literal}{maketoc}{/literal}" prints out a table of contents for the current page based on structures (toc) or ! headings (maketoc){/tr}</td></tr>
<tr><td><strong>{tr}Line break{/tr}:</strong></td><td>"%%%" {tr}(very useful especially in tables){/tr}</td></tr>
<tr><td><strong>{tr}Misc{/tr}:</strong></td><td>"{literal}{cookie}, {poll}{/literal}"</td></tr>
</table>
</div>

{if count($plugins) ne 0}
<div id="wikiplhelp-tab" style="display:none;">
  <div style="text-align: right;">
    <a href="javascript:hide('wikiplhelp-tab');show('wikihelp-tab');">{tr}Show Text Formatting Rules{/tr}</a>
    <a title="{tr}Close{/tr}" href="javascript:flip('edithelpzone');">[x]</a>
  </div>
<br />

{tr}Note that plugin arguments can be closed in double quotes (&quot;); this allows them to contain , or = or &gt;.{/tr}

<table width="100%">
{section name=i loop=$plugins}
 <tr>
  <td width="20%"><code>{$plugins[i].name}</code></td>
  <td>{if $plugins[i].help eq ''}{tr}No description available{/tr}{else}{$plugins[i].help}{/if}</td>
 </tr>
{/section}
</table>
</div>
{/if}

{tooltip text="Ver ou esconder a <b>ajuda</b> do wiki"}
	<span style="float:right;margin-right:50px" class="pointer" onclick="flip('edithelpzone')"><img src="images/ed_help.gif"></span>
{/tooltip}
</div>

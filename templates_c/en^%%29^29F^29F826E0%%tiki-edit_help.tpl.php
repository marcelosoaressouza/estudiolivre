<?php /* Smarty version 2.6.18, created on 2011-04-19 20:28:13
         compiled from styles/bolha/tiki-edit_help.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tooltip', 'styles/bolha/tiki-edit_help.tpl', 5, false),array('block', 'tr', 'styles/bolha/tiki-edit_help.tpl', 20, false),)), $this); ?>




<?php $this->_tag_stack[] = array('tooltip', array('text' => "Ver ou esconder a <b>ajuda</b> do wiki")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<span id="editHelp" class="pointer" onclick="flip('edithelpzone')"><img src="images/ed_help.gif"></span>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="wiki-edithelp"  id='edithelpzone'  style="display:none">
<div id="wikihelp-tab">
<br/><br/>
<?php if (count ( $this->_tpl_vars['plugins'] ) != 0): ?>
  <div style="text-align: right;">
    <a href="javascript:hide('wikihelp-tab');show('wikiplhelp-tab');">Show Plugins Help</a>
    <a title="Close" href="javascript:flip('edithelpzone');">[x]</a>
  </div>
<?php endif; ?>
<br />

<p><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>For more information, please see <a href="<?php echo $this->_tpl_vars['helpurl']; ?>
WikiSyntax">WikiSyntax</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></p>

<table width="100%">
<tr><td width="20%"><strong>Emphasis:</strong></td><td> '<strong></strong>' for <em>italics</em>, _<em></em>_ for <strong>bold</strong>, '<strong></strong>'_<em></em>_ for <em><strong>both</strong></em></td></tr>
<tr><td><strong>Lists:</strong></td><td> * for bullet lists, # for numbered lists, ;term:definition for definiton lists</td></tr>
<tr><td><strong>Wiki References:</strong></td><td> JoinCapitalizedWords or use ((page)) or ((page|desc)) for wiki references, ))SomeName(( prevents referencing</td></tr>
<?php if ($this->_tpl_vars['feature_drawings'] == 'y'): ?>
<tr><td><strong>Drawings:</strong></td><td> <?php echo '{'; ?>
draw name=foo} creates the editable drawing foo</td></tr>
<?php endif; ?>
<tr><td><strong>External links:</strong></td><td> use square brackets for an external link: [URL] or [URL|link_description] or [URL|description|nocache]  (that last form prevents the local Wiki from caching the page; please use that form for large pages!).<br />For an external Wiki, use ExternalWikiName:PageName or ((External Wiki Name: Page Name))</td></tr>
<tr><td><strong>Multi-page pages:</strong></td><td>use ...page... to separate pages</td></tr>
<tr><td><strong>Headings:</strong></td><td> "!", "!!", "!!!" make_headings</td></tr>
<tr><td><strong>Show/Hide:</strong></td><td> "!+", "!!-" show/hide heading section. + (shown) or - (hidden) by default.</td></tr>
<tr><td><strong>Misc:</strong></td><td> "-<em></em>-<em></em>-<em></em>-" makes a horizontal rule "===text===" underlines text.</td></tr>
<tr><td><strong>Title bar:</strong></td><td> "-=title=-" creates a title bar.</td></tr>
<tr><td><strong>Wiki File Attachments:</strong></td><td> <?php echo '{'; ?>
file name=file.ext desc="description text" page="wiki page name" showdesc=1} Creates a link to the named file.  If page is not given, the file must be attached to the current page.  If desc is not given, the file name is used for the link text, unless showdesc is used, which makes the file description be used for the link text.  If image=1 is given, the attachment is treated as an image and is displayed directly on the page; no link is generated.</td></tr>
<tr><td><strong>Images:</strong></td><td> "<?php echo '{'; ?>
img src=http://example.com/foo.jpg width=200 height=100 align=center imalign=right link=http://www.yahoo.com desc=foo alt=txt usemap=name}" displays an image height width desc link and align are optional</td></tr>
<tr><td><strong>Non cacheable images:</strong></td><td> "<?php echo '{'; ?>
img src=http://example.com/foo.jpg?nocache=1 width=200 height=100 align=center link=http://www.yahoo.com desc=foo}" displays an image height width desc link and align are optional</td></tr>
<?php if ($this->_tpl_vars['feature_wiki_tables'] == 'new'): ?>
<tr><td><strong>Tables:</strong></td><td> "||row1-col1|row1-col2|row1-col3<br />row2-col1|row2-col2|row2-col3||" creates a table</td></tr>
<?php else: ?>
<tr><td><strong>Tables:</strong></td><td> "||row1-col1|row1-col2|row1-col3||row2-col1|row2-col2col3||" creates a table</td></tr>
<?php endif; ?>
<tr><td><strong>RSS feeds:</strong></td><td> "<?php echo '{'; ?>
rss id=n max=m<?php echo '}'; ?>
" displays rss feed with id=n maximum=m items</td></tr>
<tr><td><strong>Simple box:</strong></td><td> "^Box content^" Creates a box with the data</td></tr>
<tr><td><strong>Dynamic content:</strong></td><td> "<?php echo '{'; ?>
content id=n}" Will be replaced by the actual value of the dynamic content block with id=n</td></tr>
<tr><td><strong>Colored text:</strong></td><td> "~~#FFEE33:some text~~" Will display using the indicated HTML color</td></tr>
<tr><td><strong>Center:</strong></td><td> "::some text::" Will display the text centered</td></tr>
<tr><td><strong>Non parsed sections:</strong></td><td> "~np~ data ~/np~" Prevents wiki parsing of the enclosed data.</td></tr>
<tr><td><strong>Preformated sections:</strong></td><td> "~pp~ data ~/pp~" Displays preformated text/code; no Wiki processing is done inside these sections (as with np), and the spacing is fixed (no word wrapping is done).</td></tr>
<tr><td><strong>Square Brackets:</strong></td><td> Use [[foo] to show [foo].</td></tr>
<tr><td><strong>Block Preformatting:</strong></td><td> Indent text with any number of spaces to turn it into a monospaced block that still follows other Wiki formatting instructions. It will be indended with the same number of spaces that you used.  Note that this mode does not preserve exact spacing and line breaks; use ~pp~...~/pp~ for that.</td></tr>
<tr><td><strong>Dynamic variables:</strong></td><td> "%name%" Inserts an editable variable</td></tr>
<tr><td><strong>Insert Module Output:</strong></td><td> <?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo '{MODULE(module=>some_module)}text{MODULE}'; ?>
  can be used to insert the output of module "some_module" into your Wiki page. See <a href="<?php echo $this->_tpl_vars['helpurl']; ?>
PluginModule">PluginModule</a> for more information. <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td></tr>
<tr><td><strong>Rendering Program Code:</strong></td><td> <?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo '{CODE()}some code{CODE} '; ?>
 will render "some code" as program code. This plugin has other options; see <a href="<?php echo $this->_tpl_vars['helpurl']; ?>
PluginCode">PluginCode</a>.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td></tr>
<tr><td><strong>Direction:</strong></td><td>"<?php echo '{r2l}'; ?>
", "<?php echo '{l2r}'; ?>
", "<?php echo '{rm}'; ?>
", "<?php echo '{lm}'; ?>
" Insert resp. right-to-left and left-to-right text direction DIV (up to end of text) and markers for langages as arabic or hebrew.</td></tr>
<tr><td><strong>Table of contents</strong></td><td>"<?php echo '{toc}'; ?>
", "<?php echo '{maketoc}'; ?>
" prints out a table of contents for the current page based on structures (toc) or ! headings (maketoc)</td></tr>
<tr><td><strong>Line break:</strong></td><td>"%%%" (very useful especially in tables)</td></tr>
<tr><td><strong>Misc:</strong></td><td>"<?php echo '{cookie}, {poll}'; ?>
"</td></tr>
</table>
</div>

<?php if (count ( $this->_tpl_vars['plugins'] ) != 0): ?>
<div id="wikiplhelp-tab" style="display:none;">
  <div style="text-align: right;">
    <a href="javascript:hide('wikiplhelp-tab');show('wikihelp-tab');">Show Text Formatting Rules</a>
    <a title="Close" href="javascript:flip('edithelpzone');">[x]</a>
  </div>
<br />

Note that plugin arguments can be closed in double quotes (&quot;); this allows them to contain , or = or &gt;.

<table width="100%">
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['plugins']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
 <tr>
  <td width="20%"><code><?php echo $this->_tpl_vars['plugins'][$this->_sections['i']['index']]['name']; ?>
</code></td>
  <td><?php if ($this->_tpl_vars['plugins'][$this->_sections['i']['index']]['help'] == ''): ?>No description available<?php else: ?><?php echo $this->_tpl_vars['plugins'][$this->_sections['i']['index']]['help']; ?>
<?php endif; ?></td>
 </tr>
<?php endfor; endif; ?>
</table>
</div>
<?php endif; ?>

<?php $this->_tag_stack[] = array('tooltip', array('text' => "Ver ou esconder a <b>ajuda</b> do wiki")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<span style="float:right;margin-right:50px" class="pointer" onclick="flip('edithelpzone')"><img src="images/ed_help.gif"></span>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>
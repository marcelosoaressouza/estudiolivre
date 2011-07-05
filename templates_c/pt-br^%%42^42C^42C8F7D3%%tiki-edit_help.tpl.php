<?php /* Smarty version 2.6.18, created on 2011-06-27 19:52:23
         compiled from styles/geral/tiki-edit_help.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tooltip', 'styles/geral/tiki-edit_help.tpl', 5, false),)), $this); ?>




<?php $this->_tag_stack[] = array('tooltip', array('text' => "Ver ou esconder a <b>ajuda</b> do wiki")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<span id="editHelp" class="pointer" onclick="flip('edithelpzone')"><img src="images/ed_help.gif"></span>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="wiki-edithelp"  id='edithelpzone'  style="display:none">
<div id="wikihelp-tab">
<br/><br/>
<?php if (count ( $this->_tpl_vars['plugins'] ) != 0): ?>
  <div style="text-align: right;">
    <a href="javascript:hide('wikihelp-tab');show('wikiplhelp-tab');">Exibir Auxílio para Plugins</a>
    <a title="Fechar" href="javascript:flip('edithelpzone');">[x]</a>
  </div>
<?php endif; ?>
<br />

<p>Para mais informações acesse o endereço <a href="<?php echo $this->_tpl_vars['helpurl']; ?>
WikiSyntax">WikiSyntax</a></p>

<table width="100%">
<tr><td width="20%"><strong>Ênfase:</strong></td><td> '<strong></strong>' para <em>itálico</em>, _<em></em>_ para <strong>negrito</strong>, '<strong></strong>'_<em></em>_ para <em><strong>ambos</strong></em></td></tr>
<tr><td><strong>Listas:</strong></td><td> * para listas de itens, # para listas numeradas, ;termo:definição para listas de definições</td></tr>
<tr><td><strong>Referências Wiki:</strong></td><td> UnirPalavrasComMaiusculas ou use ((página)) ou ((página|desc)) para referências Wiki, ))AlgumNome(( prevenir referência</td></tr>
<?php if ($this->_tpl_vars['feature_drawings'] == 'y'): ?>
<tr><td><strong>Desenhos:</strong></td><td> <?php echo '{'; ?>
draw name=foo} cria o desenho editável foo</td></tr>
<?php endif; ?>
<tr><td><strong>Links externos:</strong></td><td> use colchetes para links externos: [URL] ou [URL|link_description] or [URL|description|nocache]  (essa última forma impede que o wiki coloque essa página no cache; use essa função para páginas grandes!)!).<br />Para um Wiki externo, use ExternalWikiName:PageName or ((External Wiki Name: Page Name))</td></tr>
<tr><td><strong>Páginas multi-página:</strong></td><td>utilize ...page... para separar páginas</td></tr>
<tr><td><strong>Cabeçalhos:</strong></td><td> "!", "!!", "!!!" criar_cabecalhos</td></tr>
<tr><td><strong>Mostrar/esconder:</strong></td><td> "!+", "!!-" mostrar/esconder sessão do cabeçalho. + (mostra) or - (esconde) por padrão.</td></tr>
<tr><td><strong>Misc:</strong></td><td> "-<em></em>-<em></em>-<em></em>-" criar uma linha horizontal "===texto===" sublinhar texto.</td></tr>
<tr><td><strong>Barra de título:</strong></td><td> "-=título=-" Cria uma barra de título.</td></tr>
<tr><td><strong>Anexos do arquivo wiki:</strong></td><td> <?php echo '{'; ?>
file name=file.ext desc="description text" page="wiki page name" showdesc=1} Creates a link to the named file.  If page is not given, the file must be attached to the current page.  If desc is not given, the file name is used for the link text, unless showdesc is used, which makes the file description be used for the link text.  If image=1 is given, the attachment is treated as an image and is displayed directly on the page; no link is generated.</td></tr>
<tr><td><strong>Imagens:</strong></td><td> "<?php echo '{'; ?>
img src=http://example.com/foo.jpg width=200 height=100 align=center imalign=right link=http://www.yahoo.com desc=foo alt=txt usemap=name}" exibe uma imagem height, width, desc, link e align são opcionais</td></tr>
<tr><td><strong>Imagens não armazenáveis em cache:</strong></td><td> "<?php echo '{'; ?>
img src=http://example.com/foo.jpg?nocache=1 width=200 height=100 align=center link=http://www.yahoo.com desc=foo}" exibe uma imagem height, width, desc, link e align são opcionais</td></tr>
<?php if ($this->_tpl_vars['feature_wiki_tables'] == 'new'): ?>
<tr><td><strong>Tabelas:</strong></td><td> "||row1-col1|row1-col2|row1-col3<br />row2-col1|row2-col2|row2-col3||" cria uma tabela</td></tr>
<?php else: ?>
<tr><td><strong>Tabelas:</strong></td><td> "||row1-col1|row1-col2|row1-col3||row2-col1|row2-col2col3||" cria uma tabela</td></tr>
<?php endif; ?>
<tr><td><strong>Fontes RSS:</strong></td><td> "<?php echo '{'; ?>
rss id=n max=m<?php echo '}'; ?>
" exibe fonte rss com itens id=n maximum=m</td></tr>
<tr><td><strong>Caixa simples:</strong></td><td> "^Conteúdo da caixa^" Cria uma caixa com os dados</td></tr>
<tr><td><strong>Conteúdo dinâmico:</strong></td><td> "<?php echo '{'; ?>
content id=n}" Será substituído pelo valor real do bloco de conteúdo dinâmico com id=n</td></tr>
<tr><td><strong>Texto colorido:</strong></td><td> "~~#FFEE33:algum texto~~" Será exibido com a cor HTML indicada</td></tr>
<tr><td><strong>Centralizar:</strong></td><td> "::algum texto::" Exibirá o texto centralizado</td></tr>
<tr><td><strong>Seções não interpretadas:</strong></td><td> "~np~ dados ~/np~" O conteúdo entre as tags não é interpretado como código wiki.</td></tr>
<tr><td><strong>Seções pré-formatadas:</strong></td><td> "~pp~ dados ~/pp~" Displays preformated text/code; no Wiki processing is done inside these sections (as with np), and the spacing is fixed (no word wrapping is done).</td></tr>
<tr><td><strong>Colchetes:</strong></td><td> Usa [[foo] para mostrar [foo].</td></tr>
<tr><td><strong>Pré-formatar bloca:</strong></td><td> Indent text with any number of spaces to turn it into a monospaced block that still follows other Wiki formatting instructions. It will be indended with the same number of spaces that you used.  Note that this mode does not preserve exact spacing and line breaks; use ~pp~...~/pp~ for that.</td></tr>
<tr><td><strong>Variáveis dinâmicas:</strong></td><td> "%nome%" Inserir uma váriavel editável</td></tr>
<tr><td><strong>Inserir saída de módulo:</strong></td><td> <?php echo '{MODULE(module=>some_module)}text{MODULE}'; ?>
 pode ser usado para colocar a saída do módulo "some_module" dentro de uma página wiki. Veja <a href="<?php echo $this->_tpl_vars['helpurl']; ?>
PluginModule">PluginModule</a> para mais informações. </td></tr>
<tr><td><strong>Mostra código do programa:</strong></td><td> <?php echo '{CODE()}some code{CODE} '; ?>
 vai mostrar "some code" como código do programa. Esse plugin tem outras opções; veja <a href="<?php echo $this->_tpl_vars['helpurl']; ?>
PluginCode">PluginCode</a>.</td></tr>
<tr><td><strong>Direção:</strong></td><td>"<?php echo '{r2l}'; ?>
", "<?php echo '{l2r}'; ?>
", "<?php echo '{rm}'; ?>
", "<?php echo '{lm}'; ?>
" Insert resp. right-to-left and left-to-right text direction DIV (up to end of text) and markers for langages as arabic or hebrew.</td></tr>
<tr><td><strong>Tabela de conteúdo</strong></td><td>"<?php echo '{toc}'; ?>
", "<?php echo '{maketoc}'; ?>
" mostrar uma tabela de conteúdo para a página atual baseada em estruturas (toc) ou ! cabeçalhos (maketoc)</td></tr>
<tr><td><strong>Quebra de linha:</strong></td><td>"%%%" (muito útil especialmente em tabelas)</td></tr>
<tr><td><strong>Misc:</strong></td><td>"<?php echo '{cookie}, {poll}'; ?>
"</td></tr>
</table>
</div>

<?php if (count ( $this->_tpl_vars['plugins'] ) != 0): ?>
<div id="wikiplhelp-tab" style="display:none;">
  <div style="text-align: right;">
    <a href="javascript:hide('wikiplhelp-tab');show('wikihelp-tab');">Exibir Regras de Formatação de Texto</a>
    <a title="Fechar" href="javascript:flip('edithelpzone');">[x]</a>
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
  <td><?php if ($this->_tpl_vars['plugins'][$this->_sections['i']['index']]['help'] == ''): ?>Descrição não disponível<?php else: ?><?php echo $this->_tpl_vars['plugins'][$this->_sections['i']['index']]['help']; ?>
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
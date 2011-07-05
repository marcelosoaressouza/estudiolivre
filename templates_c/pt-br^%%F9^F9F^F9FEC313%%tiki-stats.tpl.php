<?php /* Smarty version 2.6.18, created on 2011-04-04 18:12:42
         compiled from tiki-stats.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tiki_long_date', 'tiki-stats.tpl', 30, false),array('modifier', 'string_format', 'tiki-stats.tpl', 33, false),)), $this); ?>


<h1><a href="tiki-stats.php" class="pagetitle">Estatísticas</a></h1>

<div id="page-bar">
<p>
<span class="button2"> <a class="linkbut" href="#site_stats">Site</a></span>
<?php if ($this->_tpl_vars['wiki_stats']): ?><span class="button2"> <a class="linkbut" href="#wiki_stats">Wiki</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['igal_stats']): ?><span class="button2"> <a class="linkbut" href="#igal_stats">Galerias de imagens</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['fgal_stats']): ?><span class="button2"> <a class="linkbut" href="#fgal_stats">Galerias de Arquivos</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['cms_stats']): ?><span class="button2"> <a class="linkbut" href="#cms_stats">CMS</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['forum_stats']): ?><span class="button2"> <a class="linkbut" href="#forum_stats">Fóruns</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['blog_stats']): ?><span class="button2"> <a class="linkbut" href="#blog_stats">Blogs</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['poll_stats']): ?><span class="button2"> <a class="linkbut" href="#poll_stats">Enquetes</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['faq_stats']): ?><span class="button2"> <a class="linkbut" href="#faq_stats">FAQs</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['user_stats']): ?><span class="button2"> <a class="linkbut" href="#user_stats">Usuári@</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['quiz_stats']): ?><span class="button2"> <a class="linkbut" href="#quiz_stats">Testes</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['feature_referer_stats'] == 'y' && $this->_tpl_vars['tiki_p_view_referer_stats'] == 'y'): ?><span class="button2"> <a class="linkbut" href="tiki-referer_stats.php">Estatísticas de referência</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['best_objects_stats']): ?><span class="button2"> <a class="linkbut" href="#best_objects_stats">Objetos mais vistos</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['best_objects_stats_lastweek']): ?><span class="button2"> <a class="linkbut" href="#best_objects_stats_lastweek">Objetos mais vistos nos últimos 7 dias</a></span><?php endif; ?>

</p>
</div>

<table class="normal">


<tr><td colspan="2"><a name="site_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Estatísticas do Site</td></tr>
<tr><td class="even">Iniciado</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['site_stats']['started'])) ? $this->_run_mod_handler('tiki_long_date', true, $_tmp) : smarty_modifier_tiki_long_date($_tmp)); ?>
</td></tr>
<tr><td class="odd">Dias on-line</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['site_stats']['days']; ?>
</td></tr>
<tr><td class="even">Total de visualizações de páginas</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['site_stats']['pageviews']; ?>
</td></tr>
<tr><td class="odd">Média de visualizações de páginas diárias</td><td class="odd" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['site_stats']['ppd'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="even">Melhor dia</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['site_stats']['bestday'])) ? $this->_run_mod_handler('tiki_long_date', true, $_tmp) : smarty_modifier_tiki_long_date($_tmp)); ?>
 (<?php echo $this->_tpl_vars['site_stats']['bestpvs']; ?>
 pvs)</td></tr>
<tr><td class="odd">Pior dia</td><td class="odd" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['site_stats']['worstday'])) ? $this->_run_mod_handler('tiki_long_date', true, $_tmp) : smarty_modifier_tiki_long_date($_tmp)); ?>
 (<?php echo $this->_tpl_vars['site_stats']['worstpvs']; ?>
 pvs)</td></tr>



<?php if ($this->_tpl_vars['wiki_stats']): ?>
<tr><td colspan="2"><a name="wiki_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Estatísticas Wiki</td></tr>
<tr><td class="even">Páginas Wiki</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['pages']; ?>
</td></tr>
<tr><td class="odd">Tamanho das Páginas Wiki</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['size']; ?>
 Mb</td></tr>
<tr><td class="even">Tamanho médio das páginas</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['wiki_stats']['bpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 bytes</td></tr>
<tr><td class="odd">Versões</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['versions']; ?>
</td></tr>
<tr><td class="even">Média de versões por página</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['wiki_stats']['vpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Visitas a páginas Wiki</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['visits']; ?>
</td></tr>
<tr><td class="even">Páginas órfãs</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['orphan']; ?>
</td></tr>
<tr><td class="odd">Média de links por página</td><td class="odd" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['wiki_stats']['lpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['igal_stats']): ?>
<tr><td colspan="2"><a name="igal_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Estatísticas de galerias de imagens</td></tr>
<tr><td class="even">Galerias</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['igal_stats']['galleries']; ?>
</td></tr>
<tr><td class="odd">Imagens</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['igal_stats']['images']; ?>
</td></tr>
<tr><td class="even">Número médio de imagens por galeria</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['igal_stats']['ipg'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Tamanho total das imagens</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['igal_stats']['size']; ?>
 Mb</td></tr>
<tr><td class="even">Tamanho médio das imagens</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['igal_stats']['bpi'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 bytes</td></tr>
<tr><td class="odd">Visitas as galerias de imagens</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['igal_stats']['visits']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['fgal_stats']): ?>
<tr><td colspan="2"><a name="fgal_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Estatísticas das galerias de arquivos</td></tr>
<tr><td class="even">Galerias</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['galleries']; ?>
</td></tr>
<tr><td class="odd">Arquivos</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['files']; ?>
</td></tr>
<tr><td class="even">Número médio de arquivos por galeria</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['fgal_stats']['fpg'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Tamanho total dos arquivos</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['size']; ?>
 Mb</td></tr>
<tr><td class="even">Tamanho médio dos arquivos</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['fgal_stats']['bpf'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 Mb</td></tr>
<tr><td class="odd">Visitas as galerias de arquivos</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['visits']; ?>
</td></tr>
<tr><td class="even">Downloads</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['downloads']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['cms_stats']): ?>
<tr><td colspan="2"><a name="cms_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Estatísticas de CMS</td></tr>
<tr><td class="even">Artigos</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['cms_stats']['articles']; ?>
</td></tr>
<tr><td class="odd">Total de leituras</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['cms_stats']['reads']; ?>
</td></tr>
<tr><td class="even">Média de leituras por artigos</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['cms_stats']['rpa'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Tamanho total dos artigos</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['cms_stats']['size']; ?>
 bytes</td></tr>
<tr><td class="even">Tamanho médio dos artigos</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['cms_stats']['bpa'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 bytes</td></tr>
<tr><td class="odd">Assuntos</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['cms_stats']['topics']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['forum_stats']): ?>
<tr><td colspan="2"><a name="forum_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Estatísticas dos fóruns</td></tr>
<tr><td class="even">Fóruns</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['forum_stats']['forums']; ?>
</td></tr>
<tr><td class="odd">Total de assuntos</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['forum_stats']['topics']; ?>
</td></tr>
<tr><td class="even">Média de assuntos por fórum</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['forum_stats']['tpf'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Número total de seqüências</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['forum_stats']['threads']; ?>
</td></tr>
<tr><td class="even">Média de seqüências por tópico</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['forum_stats']['tpt'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Visitas aos fóruns</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['forum_stats']['visits']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['blog_stats']): ?>
<tr><td colspan="2"><a name="blog_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Estatísticas de Blogs</td></tr>
<tr><td class="even">Weblogs</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['blog_stats']['blogs']; ?>
</td></tr>
<tr><td class="odd">Total de mensagens</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['blog_stats']['posts']; ?>
</td></tr>
<tr><td class="even">Média de mensagens por weblog</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['blog_stats']['ppb'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Tamanho total das mensagens de blogs</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['blog_stats']['size']; ?>
</td></tr>
<tr><td class="even">Tamanho médio das mensagens</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['blog_stats']['bpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Visitas aos weblogs</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['blog_stats']['visits']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['poll_stats']): ?>
<tr><td colspan="2"><a name="poll_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Estatísticas das enquetes</td></tr>
<tr><td class="even">Enquetes</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['poll_stats']['polls']; ?>
</td></tr>
<tr><td class="odd">Total de votos</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['poll_stats']['votes']; ?>
</td></tr>
<tr><td class="even">Média de votos por enquete</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['poll_stats']['vpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['faq_stats']): ?>
<tr><td colspan="2"><a name="faq_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Estatísticas de FAQ</td></tr>
<tr><td class="even">FAQs</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['faq_stats']['faqs']; ?>
</td></tr>
<tr><td class="odd">Total de perguntas</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['faq_stats']['questions']; ?>
</td></tr>
<tr><td class="even">Média de perguntas por FAQ</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['faq_stats']['qpf'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['user_stats']): ?>
<tr><td colspan="2"><a name="user_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Estatísticas de usuári@s</td></tr>
<tr><td class="even">Usuári@s</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['user_stats']['users']; ?>
</td></tr>
<tr><td class="odd">Bookmarks de usuári@s</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['user_stats']['bookmarks']; ?>
</td></tr>
<tr><td class="even">Média de bookmarks por usuári@</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['user_stats']['bpu'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['quiz_stats']): ?>
<tr><td colspan="2"><a name="quiz_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Estatísticas de testes</td></tr>
<tr><td class="even">Testes</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['quiz_stats']['quizzes']; ?>
</td></tr>
<tr><td class="odd">Perguntas</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['quiz_stats']['questions']; ?>
</td></tr>
<tr><td class="even">Média de perguntas por teste</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['quiz_stats']['qpq'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Testes realizados</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['quiz_stats']['visits']; ?>
</td></tr>
<tr><td class="even">Nota média nos testes</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['quiz_stats']['avg'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Tempo médio por teste</td><td class="odd" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['quiz_stats']['avgtime'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 s</td></tr>
<?php endif; ?>

</table>
<br />
<br />
<br />
<?php if ($this->_tpl_vars['best_objects_stats']): ?>
<table class="normal">
<tr><td colspan="3"><a name="best_objects_stats"></a></td></tr>
<tr><td class="heading" colspan="3">Objetos mais vistos</td></tr>
<tr><td class="heading">Objeto</td><td class="heading">Seção</td><td class="heading">Visitas</td></tr>
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['best_objects_stats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if ($this->_sections['i']['index'] % 2): ?>
<td class="even"><?php echo $this->_tpl_vars['best_objects_stats'][$this->_sections['i']['index']]->object; ?>
</td>
<td class="even"><?php echo $this->_tpl_vars['best_objects_stats'][$this->_sections['i']['index']]->type; ?>
</td>
<td class="even"><?php echo $this->_tpl_vars['best_objects_stats'][$this->_sections['i']['index']]->hits; ?>
</td>
<?php else: ?>
<td class="odd"><?php echo $this->_tpl_vars['best_objects_stats'][$this->_sections['i']['index']]->object; ?>
</td>
<td class="odd"><?php echo $this->_tpl_vars['best_objects_stats'][$this->_sections['i']['index']]->type; ?>
</td>
<td class="odd"><?php echo $this->_tpl_vars['best_objects_stats'][$this->_sections['i']['index']]->hits; ?>
</td>
<?php endif; ?>
</tr>
<?php endfor; endif; ?>
</table>
<?php endif; ?>
<br />
<?php if ($this->_tpl_vars['best_objects_stats_lastweek']): ?>
<table class="normal">
<tr><td colspan="3"><a name="best_objects_stats_lastweek"></a></td></tr>
<tr><td class="heading" colspan="3">Objetos mais vistos nos últimos 7 dias</td></tr>
<tr><td class="heading">Objeto</td><td class="heading">Seção</td><td class="heading">Visitas</td></tr>
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['best_objects_stats_lastweek']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if ($this->_sections['i']['index'] % 2): ?>
<td class="even"><?php echo $this->_tpl_vars['best_objects_stats_lastweek'][$this->_sections['i']['index']]->object; ?>
</td>
<td class="even"><?php echo $this->_tpl_vars['best_objects_stats_lastweek'][$this->_sections['i']['index']]->type; ?>
</td>
<td class="even"><?php echo $this->_tpl_vars['best_objects_stats_lastweek'][$this->_sections['i']['index']]->hits; ?>
</td>
<?php else: ?>
<td class="odd"><?php echo $this->_tpl_vars['best_objects_stats_lastweek'][$this->_sections['i']['index']]->object; ?>
</td>
<td class="odd"><?php echo $this->_tpl_vars['best_objects_stats_lastweek'][$this->_sections['i']['index']]->type; ?>
</td>
<td class="odd"><?php echo $this->_tpl_vars['best_objects_stats_lastweek'][$this->_sections['i']['index']]->hits; ?>
</td>
<?php endif; ?>
</tr>
<?php endfor; endif; ?>
</table>
<?php endif; ?>
<br />
<br />
<br />
<a href="tiki-stats.php?chart=usage" class="link">Gráfico de uso</a><br /><br />

<?php if ($this->_tpl_vars['usage_chart'] == 'y'): ?>
<br /> 
<div align="center">
<img src="tiki-usage_chart.php" alt='Imagem do gráfico de uso'/>
</div>
<br />
<div align="center">
<img src="tiki-usage_chart.php?type=daily" alt='Uso diário'/>
</div>
<br /><br />
<?php endif; ?>


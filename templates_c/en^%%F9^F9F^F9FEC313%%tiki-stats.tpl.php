<?php /* Smarty version 2.6.18, created on 2011-04-09 20:13:53
         compiled from tiki-stats.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tiki_long_date', 'tiki-stats.tpl', 30, false),array('modifier', 'string_format', 'tiki-stats.tpl', 33, false),)), $this); ?>


<h1><a href="tiki-stats.php" class="pagetitle">Stats</a></h1>

<div id="page-bar">
<p>
<span class="button2"> <a class="linkbut" href="#site_stats">Site</a></span>
<?php if ($this->_tpl_vars['wiki_stats']): ?><span class="button2"> <a class="linkbut" href="#wiki_stats">Wiki</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['igal_stats']): ?><span class="button2"> <a class="linkbut" href="#igal_stats">Image galleries</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['fgal_stats']): ?><span class="button2"> <a class="linkbut" href="#fgal_stats">File galleries</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['cms_stats']): ?><span class="button2"> <a class="linkbut" href="#cms_stats">CMS</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['forum_stats']): ?><span class="button2"> <a class="linkbut" href="#forum_stats">Forums</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['blog_stats']): ?><span class="button2"> <a class="linkbut" href="#blog_stats">Blogs</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['poll_stats']): ?><span class="button2"> <a class="linkbut" href="#poll_stats">Polls</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['faq_stats']): ?><span class="button2"> <a class="linkbut" href="#faq_stats">FAQs</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['user_stats']): ?><span class="button2"> <a class="linkbut" href="#user_stats">User</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['quiz_stats']): ?><span class="button2"> <a class="linkbut" href="#quiz_stats">Quizzes</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['feature_referer_stats'] == 'y' && $this->_tpl_vars['tiki_p_view_referer_stats'] == 'y'): ?><span class="button2"> <a class="linkbut" href="tiki-referer_stats.php">Referer stats</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['best_objects_stats']): ?><span class="button2"> <a class="linkbut" href="#best_objects_stats">Most viewed objects</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['best_objects_stats_lastweek']): ?><span class="button2"> <a class="linkbut" href="#best_objects_stats_lastweek">Most viewed objects in the last 7 days</a></span><?php endif; ?>

</p>
</div>

<table class="normal">


<tr><td colspan="2"><a name="site_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Site Stats</td></tr>
<tr><td class="even">Started</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['site_stats']['started'])) ? $this->_run_mod_handler('tiki_long_date', true, $_tmp) : smarty_modifier_tiki_long_date($_tmp)); ?>
</td></tr>
<tr><td class="odd">Days online</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['site_stats']['days']; ?>
</td></tr>
<tr><td class="even">Total pageviews</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['site_stats']['pageviews']; ?>
</td></tr>
<tr><td class="odd">Average pageviews per day</td><td class="odd" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['site_stats']['ppd'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="even">Best day</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['site_stats']['bestday'])) ? $this->_run_mod_handler('tiki_long_date', true, $_tmp) : smarty_modifier_tiki_long_date($_tmp)); ?>
 (<?php echo $this->_tpl_vars['site_stats']['bestpvs']; ?>
 pvs)</td></tr>
<tr><td class="odd">Worst day</td><td class="odd" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['site_stats']['worstday'])) ? $this->_run_mod_handler('tiki_long_date', true, $_tmp) : smarty_modifier_tiki_long_date($_tmp)); ?>
 (<?php echo $this->_tpl_vars['site_stats']['worstpvs']; ?>
 pvs)</td></tr>



<?php if ($this->_tpl_vars['wiki_stats']): ?>
<tr><td colspan="2"><a name="wiki_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Wiki Stats</td></tr>
<tr><td class="even">Wiki Pages</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['pages']; ?>
</td></tr>
<tr><td class="odd">Size of Wiki Pages</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['size']; ?>
 Mb</td></tr>
<tr><td class="even">Average page length</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['wiki_stats']['bpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 bytes</td></tr>
<tr><td class="odd">Versions</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['versions']; ?>
</td></tr>
<tr><td class="even">Average versions per page</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['wiki_stats']['vpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Visits to wiki pages</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['visits']; ?>
</td></tr>
<tr><td class="even">Orphan pages</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['orphan']; ?>
</td></tr>
<tr><td class="odd">Average links per page</td><td class="odd" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['wiki_stats']['lpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['igal_stats']): ?>
<tr><td colspan="2"><a name="igal_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Image galleries Stats</td></tr>
<tr><td class="even">Galleries</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['igal_stats']['galleries']; ?>
</td></tr>
<tr><td class="odd">Images</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['igal_stats']['images']; ?>
</td></tr>
<tr><td class="even">Average images per gallery</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['igal_stats']['ipg'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Total size of images</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['igal_stats']['size']; ?>
 Mb</td></tr>
<tr><td class="even">Average image size</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['igal_stats']['bpi'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 bytes</td></tr>
<tr><td class="odd">Visits to image galleries</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['igal_stats']['visits']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['fgal_stats']): ?>
<tr><td colspan="2"><a name="fgal_stats"></a></td></tr>
<tr><td class="heading" colspan="2">File galleries Stats</td></tr>
<tr><td class="even">Galleries</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['galleries']; ?>
</td></tr>
<tr><td class="odd">Files</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['files']; ?>
</td></tr>
<tr><td class="even">Average files per gallery</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['fgal_stats']['fpg'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Total size of files</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['size']; ?>
 Mb</td></tr>
<tr><td class="even">Average file size</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['fgal_stats']['bpf'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 Mb</td></tr>
<tr><td class="odd">Visits to file galleries</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['visits']; ?>
</td></tr>
<tr><td class="even">Downloads</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['downloads']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['cms_stats']): ?>
<tr><td colspan="2"><a name="cms_stats"></a></td></tr>
<tr><td class="heading" colspan="2">CMS Stats</td></tr>
<tr><td class="even">Articles</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['cms_stats']['articles']; ?>
</td></tr>
<tr><td class="odd">Total reads</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['cms_stats']['reads']; ?>
</td></tr>
<tr><td class="even">Average reads per article</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['cms_stats']['rpa'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Total articles size</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['cms_stats']['size']; ?>
 bytes</td></tr>
<tr><td class="even">Average article size</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['cms_stats']['bpa'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 bytes</td></tr>
<tr><td class="odd">Topics</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['cms_stats']['topics']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['forum_stats']): ?>
<tr><td colspan="2"><a name="forum_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Forum Stats</td></tr>
<tr><td class="even">Forums</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['forum_stats']['forums']; ?>
</td></tr>
<tr><td class="odd">Total topics</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['forum_stats']['topics']; ?>
</td></tr>
<tr><td class="even">Average topics per forums</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['forum_stats']['tpf'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Total threads</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['forum_stats']['threads']; ?>
</td></tr>
<tr><td class="even">Average threads per topic</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['forum_stats']['tpt'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Visits to forums</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['forum_stats']['visits']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['blog_stats']): ?>
<tr><td colspan="2"><a name="blog_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Blog Stats</td></tr>
<tr><td class="even">Weblogs</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['blog_stats']['blogs']; ?>
</td></tr>
<tr><td class="odd">Total posts</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['blog_stats']['posts']; ?>
</td></tr>
<tr><td class="even">Average posts per weblog</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['blog_stats']['ppb'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Total size of blog posts</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['blog_stats']['size']; ?>
</td></tr>
<tr><td class="even">Average posts size</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['blog_stats']['bpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Visits to weblogs</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['blog_stats']['visits']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['poll_stats']): ?>
<tr><td colspan="2"><a name="poll_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Poll Stats</td></tr>
<tr><td class="even">Polls</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['poll_stats']['polls']; ?>
</td></tr>
<tr><td class="odd">Total votes</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['poll_stats']['votes']; ?>
</td></tr>
<tr><td class="even">Average votes per poll</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['poll_stats']['vpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['faq_stats']): ?>
<tr><td colspan="2"><a name="faq_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Faq Stats</td></tr>
<tr><td class="even">FAQs</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['faq_stats']['faqs']; ?>
</td></tr>
<tr><td class="odd">Total questions</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['faq_stats']['questions']; ?>
</td></tr>
<tr><td class="even">Average questions per FAQ</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['faq_stats']['qpf'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['user_stats']): ?>
<tr><td colspan="2"><a name="user_stats"></a></td></tr>
<tr><td class="heading" colspan="2">User Stats</td></tr>
<tr><td class="even">Users</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['user_stats']['users']; ?>
</td></tr>
<tr><td class="odd">User bookmarks</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['user_stats']['bookmarks']; ?>
</td></tr>
<tr><td class="even">Average bookmarks per user</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['user_stats']['bpu'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['quiz_stats']): ?>
<tr><td colspan="2"><a name="quiz_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Quiz Stats</td></tr>
<tr><td class="even">Quizzes</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['quiz_stats']['quizzes']; ?>
</td></tr>
<tr><td class="odd">Questions</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['quiz_stats']['questions']; ?>
</td></tr>
<tr><td class="even">Average questions per quiz</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['quiz_stats']['qpq'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Quizzes taken</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['quiz_stats']['visits']; ?>
</td></tr>
<tr><td class="even">Average quiz score</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['quiz_stats']['avg'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Average time per quiz</td><td class="odd" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['quiz_stats']['avgtime'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 secs</td></tr>
<?php endif; ?>

</table>
<br />
<br />
<br />
<?php if ($this->_tpl_vars['best_objects_stats']): ?>
<table class="normal">
<tr><td colspan="3"><a name="best_objects_stats"></a></td></tr>
<tr><td class="heading" colspan="3">Most viewed objects</td></tr>
<tr><td class="heading">Object</td><td class="heading">Section</td><td class="heading">Hits</td></tr>
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
<tr><td class="heading" colspan="3">Most viewed objects in the last 7 days</td></tr>
<tr><td class="heading">Object</td><td class="heading">Section</td><td class="heading">Hits</td></tr>
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
<a href="tiki-stats.php?chart=usage" class="link">Usage chart</a><br /><br />

<?php if ($this->_tpl_vars['usage_chart'] == 'y'): ?>
<br /> 
<div align="center">
<img src="tiki-usage_chart.php" alt='Usage chart image'/>
</div>
<br />
<div align="center">
<img src="tiki-usage_chart.php?type=daily" alt='Daily Usage'/>
</div>
<br /><br />
<?php endif; ?>


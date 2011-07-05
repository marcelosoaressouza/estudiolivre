<?php /* Smarty version 2.6.18, created on 2011-04-25 05:06:17
         compiled from tiki-stats.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tiki_long_date', 'tiki-stats.tpl', 30, false),array('modifier', 'string_format', 'tiki-stats.tpl', 33, false),)), $this); ?>


<h1><a href="tiki-stats.php" class="pagetitle">Статистика</a></h1>

<div id="page-bar">
<p>
<span class="button2"> <a class="linkbut" href="#site_stats">Сайт</a></span>
<?php if ($this->_tpl_vars['wiki_stats']): ?><span class="button2"> <a class="linkbut" href="#wiki_stats">Wiki</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['igal_stats']): ?><span class="button2"> <a class="linkbut" href="#igal_stats">Фотогалереи</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['fgal_stats']): ?><span class="button2"> <a class="linkbut" href="#fgal_stats">Файловые галереи</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['cms_stats']): ?><span class="button2"> <a class="linkbut" href="#cms_stats">CMS</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['forum_stats']): ?><span class="button2"> <a class="linkbut" href="#forum_stats">Форумы</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['blog_stats']): ?><span class="button2"> <a class="linkbut" href="#blog_stats">Блоги</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['poll_stats']): ?><span class="button2"> <a class="linkbut" href="#poll_stats">Опросы</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['faq_stats']): ?><span class="button2"> <a class="linkbut" href="#faq_stats">ЧаВо</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['user_stats']): ?><span class="button2"> <a class="linkbut" href="#user_stats">Пользователь</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['quiz_stats']): ?><span class="button2"> <a class="linkbut" href="#quiz_stats">Тесты</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['feature_referer_stats'] == 'y' && $this->_tpl_vars['tiki_p_view_referer_stats'] == 'y'): ?><span class="button2"> <a class="linkbut" href="tiki-referer_stats.php">Статистика по Referer</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['best_objects_stats']): ?><span class="button2"> <a class="linkbut" href="#best_objects_stats">Наиболее просматриваемые объекты</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['best_objects_stats_lastweek']): ?><span class="button2"> <a class="linkbut" href="#best_objects_stats_lastweek">Наиболее просматриваемые объекты за 7 дней</a></span><?php endif; ?>

</p>
</div>

<table class="normal">


<tr><td colspan="2"><a name="site_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Статистика сайта</td></tr>
<tr><td class="even">Запущено</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['site_stats']['started'])) ? $this->_run_mod_handler('tiki_long_date', true, $_tmp) : smarty_modifier_tiki_long_date($_tmp)); ?>
</td></tr>
<tr><td class="odd">Дней в онлайне</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['site_stats']['days']; ?>
</td></tr>
<tr><td class="even">Число просмотров</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['site_stats']['pageviews']; ?>
</td></tr>
<tr><td class="odd">В среднем за день просмотров</td><td class="odd" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['site_stats']['ppd'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="even">Лучший день</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['site_stats']['bestday'])) ? $this->_run_mod_handler('tiki_long_date', true, $_tmp) : smarty_modifier_tiki_long_date($_tmp)); ?>
 (<?php echo $this->_tpl_vars['site_stats']['bestpvs']; ?>
 просмотров стр.)</td></tr>
<tr><td class="odd">Худший день</td><td class="odd" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['site_stats']['worstday'])) ? $this->_run_mod_handler('tiki_long_date', true, $_tmp) : smarty_modifier_tiki_long_date($_tmp)); ?>
 (<?php echo $this->_tpl_vars['site_stats']['worstpvs']; ?>
 просмотров стр.)</td></tr>



<?php if ($this->_tpl_vars['wiki_stats']): ?>
<tr><td colspan="2"><a name="wiki_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Статистика Wiki</td></tr>
<tr><td class="even">Страницы Wiki</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['pages']; ?>
</td></tr>
<tr><td class="odd">Размер страниц Wiki</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['size']; ?>
 Мбайт</td></tr>
<tr><td class="even">Средний размер страницы</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['wiki_stats']['bpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 байт</td></tr>
<tr><td class="odd">Версии</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['versions']; ?>
</td></tr>
<tr><td class="even">Среднее число версий на страницу</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['wiki_stats']['vpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Посещения страниц Wiki</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['visits']; ?>
</td></tr>
<tr><td class="even">Страницы-сироты</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['wiki_stats']['orphan']; ?>
</td></tr>
<tr><td class="odd">Среднее число ссылок на странице</td><td class="odd" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['wiki_stats']['lpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['igal_stats']): ?>
<tr><td colspan="2"><a name="igal_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Статистика фотогалерей</td></tr>
<tr><td class="even">Галереи</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['igal_stats']['galleries']; ?>
</td></tr>
<tr><td class="odd">Изображения</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['igal_stats']['images']; ?>
</td></tr>
<tr><td class="even">Среднее число изображений на галерею</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['igal_stats']['ipg'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Общее число изображений</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['igal_stats']['size']; ?>
 Мбайт</td></tr>
<tr><td class="even">Средний размер изображения</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['igal_stats']['bpi'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 байт</td></tr>
<tr><td class="odd">Посещений в фотогалереях</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['igal_stats']['visits']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['fgal_stats']): ?>
<tr><td colspan="2"><a name="fgal_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Статистика файловых галерей</td></tr>
<tr><td class="even">Галереи</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['galleries']; ?>
</td></tr>
<tr><td class="odd">Файлы</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['files']; ?>
</td></tr>
<tr><td class="even">Среднее число файлов на галерею</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['fgal_stats']['fpg'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Суммарный размер файлов</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['size']; ?>
 Мбайт</td></tr>
<tr><td class="even">Средний размер файла</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['fgal_stats']['bpf'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 Мбайт</td></tr>
<tr><td class="odd">Число посещений галерей</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['visits']; ?>
</td></tr>
<tr><td class="even">Закачки</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['fgal_stats']['downloads']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['cms_stats']): ?>
<tr><td colspan="2"><a name="cms_stats"></a></td></tr>
<tr><td class="heading" colspan="2">CMS статистика</td></tr>
<tr><td class="even">Статьи</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['cms_stats']['articles']; ?>
</td></tr>
<tr><td class="odd">Общее число прочтений</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['cms_stats']['reads']; ?>
</td></tr>
<tr><td class="even">Среднее число прочтений на 1 статью</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['cms_stats']['rpa'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Суммарный размер статей</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['cms_stats']['size']; ?>
 байт</td></tr>
<tr><td class="even">Средний размер статьи</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['cms_stats']['bpa'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 байт</td></tr>
<tr><td class="odd">Темы</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['cms_stats']['topics']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['forum_stats']): ?>
<tr><td colspan="2"><a name="forum_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Статистика форума</td></tr>
<tr><td class="even">Форумы</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['forum_stats']['forums']; ?>
</td></tr>
<tr><td class="odd">Всего тем</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['forum_stats']['topics']; ?>
</td></tr>
<tr><td class="even">Средне число тем на форуме</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['forum_stats']['tpf'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Всего веток обсуждения</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['forum_stats']['threads']; ?>
</td></tr>
<tr><td class="even">Среднее число веток на 1 тему</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['forum_stats']['tpt'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Посещения форумов</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['forum_stats']['visits']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['blog_stats']): ?>
<tr><td colspan="2"><a name="blog_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Статистика блогов</td></tr>
<tr><td class="even">Веблоги</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['blog_stats']['blogs']; ?>
</td></tr>
<tr><td class="odd">Суммарное количество сообщений</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['blog_stats']['posts']; ?>
</td></tr>
<tr><td class="even">Average posts per weblog</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['blog_stats']['ppb'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Суммарный размер всех сообщений</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['blog_stats']['size']; ?>
</td></tr>
<tr><td class="even">Средний размер сообщения</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['blog_stats']['bpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Посещений веблогов</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['blog_stats']['visits']; ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['poll_stats']): ?>
<tr><td colspan="2"><a name="poll_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Статистика опросов</td></tr>
<tr><td class="even">Опросы</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['poll_stats']['polls']; ?>
</td></tr>
<tr><td class="odd">Всего отдано голосов</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['poll_stats']['votes']; ?>
</td></tr>
<tr><td class="even">В среднем число голосов на опрос</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['poll_stats']['vpp'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['faq_stats']): ?>
<tr><td colspan="2"><a name="faq_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Статистика ЧаВо</td></tr>
<tr><td class="even">ЧаВо</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['faq_stats']['faqs']; ?>
</td></tr>
<tr><td class="odd">Всего вопросов</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['faq_stats']['questions']; ?>
</td></tr>
<tr><td class="even">В среднем вопросов на 1 ЧаВо</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['faq_stats']['qpf'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['user_stats']): ?>
<tr><td colspan="2"><a name="user_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Статистика пользователей</td></tr>
<tr><td class="even">Пользователи</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['user_stats']['users']; ?>
</td></tr>
<tr><td class="odd">Личные закладки</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['user_stats']['bookmarks']; ?>
</td></tr>
<tr><td class="even">Среднее число закладок на пользователя</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['user_stats']['bpu'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['quiz_stats']): ?>
<tr><td colspan="2"><a name="quiz_stats"></a></td></tr>
<tr><td class="heading" colspan="2">Статискика теста</td></tr>
<tr><td class="even">Тесты</td><td class="even" style="text-align:right;"><?php echo $this->_tpl_vars['quiz_stats']['quizzes']; ?>
</td></tr>
<tr><td class="odd">Вопросы</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['quiz_stats']['questions']; ?>
</td></tr>
<tr><td class="even">Среднее число вопросов на тест</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['quiz_stats']['qpq'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Пройдено тестов</td><td class="odd" style="text-align:right;"><?php echo $this->_tpl_vars['quiz_stats']['visits']; ?>
</td></tr>
<tr><td class="even">Среднее число баллов на тест</td><td class="even" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['quiz_stats']['avg'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td></tr>
<tr><td class="odd">Среднее время на прохождение теста</td><td class="odd" style="text-align:right;"><?php echo ((is_array($_tmp=$this->_tpl_vars['quiz_stats']['avgtime'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 сек</td></tr>
<?php endif; ?>

</table>
<br />
<br />
<br />
<?php if ($this->_tpl_vars['best_objects_stats']): ?>
<table class="normal">
<tr><td colspan="3"><a name="best_objects_stats"></a></td></tr>
<tr><td class="heading" colspan="3">Наиболее просматриваемые объекты</td></tr>
<tr><td class="heading">Объект</td><td class="heading">Секция</td><td class="heading">Запросы</td></tr>
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
<tr><td class="heading" colspan="3">Наиболее просматриваемые объекты за 7 дней</td></tr>
<tr><td class="heading">Объект</td><td class="heading">Секция</td><td class="heading">Запросы</td></tr>
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
<a href="tiki-stats.php?chart=usage" class="link">График использования</a><br /><br />

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


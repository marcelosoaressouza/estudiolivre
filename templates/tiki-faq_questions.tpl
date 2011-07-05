<h1><a class="pagetitle" href="tiki-faq_questions.php?faqId={$faqId}">{tr}Admin FAQ{/tr}: {$faq_info.title}</a></h1>
<a href="tiki-list_faqs.php" class="linkbut">{tr}List FAQs{/tr}</a>
<a href="tiki-view_faq.php?faqId={$faqId}" class="linkbut">{tr}View FAQ{/tr}</a>
<a href="tiki-list_faqs.php?faqId={$faqId}" class="linkbut">{tr}Edit this FAQ{/tr}</a>
<a class="linkbut" href="tiki-faq_questions.php?faqId={$faqId}">{tr}new question{/tr}</a><br />
<br />
<h2>{tr}Edit FAQ questions{/tr}</h2>
<form action="tiki-faq_questions.php" method="post">
<input type="hidden" name="questionId" value="{$questionId|escape}" />
<input type="hidden" name="faqId" value="{$faqId|escape}" />

{* begin table *}
<table class="normal">
<tr>
<td class="formcolor">{tr}Question{/tr}:</td>
<td class="formcolor" >
<textarea type="text" rows="2" cols="80" name="question">{$question|escape}</textarea>
</td>
</tr>
<tr>
<td class="formcolor">{tr}Answer{/tr}:
<br />{include file=tiki-edit_help_tool.tpl area_name="faqans"}
</td>
<td class="formcolor" >
<textarea id='faqans' type="text" rows="8" cols="80" name="answer">{$answer|escape}</textarea>
</td>
</tr>
<tr>
<td  class="formcolor">&nbsp;</td>
<td class="formcolor" >
<input type="submit" name="save" value="{tr}Save{/tr}" />
{* set your changes and save 'em *}
</td>
</tr>
</table>
{* end table *}

</form>
{* This is the area for choosing questions from the db... it really should support choosing options from the answers *}

<h2> {tr}Use a question from another FAQ{/tr}</h2>
<form action="tiki-faq_questions.php" method="post">
<input type="hidden" name="questionId" value="{$questionId|escape}" />
<input type="hidden" name="faqId" value="{$faqId|escape}" />
<table class="normal">
<tr>
<td class="formcolor">{tr}Filter{/tr}</td>
<td class="formcolor">
<input type="text" name="filter" value="{$filter|escape}" />
<input type="submit" name="filteruseq" value="{tr}filter{/tr}" />
</td>
</tr>
<tr>
<td class="formcolor">{tr}Question{/tr}:</td>
<td class="formcolor" >
<select name="usequestionId">
{section name=ix loop=$allq}
{* Ok, here's where you change the truncation field for this field *}
<option value="{$allq[ix].questionId|escape|truncate:20:"":true}">{$allq[ix].question|escape|truncate:110:"":true}</option>
{/section}
</select>
</td>
</tr>
<tr>
<td class="formcolor">&nbsp;</td>
<td class="formcolor">
<input type="submit" name="useq" value="{tr}use{/tr}" />
</td>
</tr>
</table>
</form>
<br />

{* next big chunk *}

<h2>{tr}FAQ questions{/tr}</h2>
<div  align="center">
<table class="findtable">
<tr><td class="findtable">{tr}Find{/tr}</td>
   <td class="findtable">
   <form method="get" action="tiki-faq_questions.php">
     <input type="text" name="find" value="{$find|escape}" />
     <input type="submit" value="{tr}find{/tr}" name="search" />
     <input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
   </form>
   </td>
</tr>
</table>
<table class="normal">
<tr>
<td class="heading">
<a class="tableheading" href="tiki-faq_questions.php?faqId={$faqId}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'questionId_desc'}questionId_asc{else}questionId_desc{/if}">{tr}ID{/tr}</a>
</td>
<td class="heading"><a class="tableheading" href="tiki-faq_questions.php?faqId={$faqId}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'question_desc'}question_asc{else}question_desc{/if}">{tr}question{/tr}</a>
</td>
<td class="heading">{tr}action{/tr}</td>
</tr>
{cycle values="odd,even" print=false}
{section name=user loop=$channels}
<tr>
<td  class="{cycle advance=false}">{$channels[user].questionId}</td>
<td class="{cycle advance=false}">{$channels[user].question}</td>
<td  class="{cycle}">
   <a class="link" href="tiki-faq_questions.php?faqId={$faqId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;remove={$channels[user].questionId}"><img src="img/icons2/delete.gif" border="0" width="16" height="16"  alt='{tr}remove{/tr}' title='{tr}remove{/tr}' /></a>
   <a class="link" href="tiki-faq_questions.php?faqId={$faqId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;questionId={$channels[user].questionId}">{html_image file='img/icons/edit.gif' border='0' alt='{tr}edit{/tr}' title='{tr}edit{/tr}'}</a>
</td>
</tr>
{/section}
</table>

<br />
<div class="mini">
{if $prev_offset >= 0}
[<a class="prevnext" href="tiki-faq_questions.php?find={$find}&amp;faqId={$faqId}&amp;offset={$prev_offset}&amp;sort_mode={$sort_mode}">{tr}prev{/tr}</a>]&nbsp;
{/if}
{tr}Page{/tr}: {$actual_page}/{$cant_pages}
{if $next_offset >= 0}
&nbsp;[<a class="prevnext" href="tiki-faq_questions.php?find={$find}&amp;faqId={$faqId}&amp;offset={$next_offset}&amp;sort_mode={$sort_mode}">{tr}next{/tr}</a>]
{/if}
{if $direct_pagination eq 'y'}
<br />
{section loop=$cant_pages name=foo}
{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
<a class="prevnext" href="tiki-faq_questions.php?find={$find}&amp;faqId={$faqId}&amp;offset={$selector_offset}&amp;sort_mode={$sort_mode}">
{$smarty.section.foo.index_next}</a>&nbsp;
{/section}
{/if}
</div>
</div>
{if count($suggested) > 0}

{* this is the next section *}

<h2>{tr}Suggested questions{/tr}</h2>
<table class="normal">
<tr>
  <td class="heading">{tr}question{/tr}</td>
  <td class="heading">{tr}answer{/tr}</td>
</tr>
{cycle values="odd,even" print=false}
{section name=ix loop=$suggested}
<tr>
  <td class="{cycle advance=false}">{$suggested[ix].question} (<a class="link" href="tiki-faq_questions.php?faqId={$faqId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;remove_suggested={$suggested[ix].sfqId}"><small>{tr}remove{/tr}</small></a>)
  (<a class="link" href="tiki-faq_questions.php?faqId={$faqId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;approve_suggested={$suggested[ix].sfqId}"><small>{tr}approve{/tr}</small></a>)
  </td>
  <td class="{cycle}">{$suggested[ix].answer}</td>
</tr>
{/section}
</table>
{else}
<h2>{tr}No suggested questions{/tr}</h2>
{/if}


<h1>{tr}Rollback page{/tr}: {$page} {tr}to_version{/tr}: {$version}</h1>
<div class="wikitext">{$preview.data}</div>
<div align="center">
<form action="tiki-rollback.php?page={$page|escape}&amp;version={$version|escape}&amp;rollback=y" method="post">
<input type="hidden"  name="page" value="{$page|escape}" />
<input type="hidden" name="version" value="{$version|escape}" />
<input type="submit" name="rollback" value="{tr}rollback{/tr}" />
</form>
</div>

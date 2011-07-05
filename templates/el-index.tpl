<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

	{include file="head.tpl"}
	{css extra=tiki-show_page}
	{* --- CSS com fixes do IE --- *}
	{if $isIE}
		<link rel="StyleSheet"  href="styles/{$style|replace:".css":""}/css/ie.css" type="text/css" />
	{/if}
	{* ---- END ---- *}
	<body style="">
	    <div id="estatica">
			{$estatica}
		</div>
		<div style="text-align:center">
			<form action="el-index.php" method="post">
				<input type="checkbox" name="el_nao_ver_apresentacao" onclick="document.forms[0].submit()"> Não quero mais que essa página seja exibida.
			</form>
		</div>
	</body>
</html>
<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

  {include file="head.tpl"}
  
  {include file="body.tpl"}

  	{* --- CSS com fixes do IE --- *}
	{if $isIE}
		<link rel="StyleSheet"  href="styles/{$style|replace:".css":""}/css/ie.css" type="text/css" />
	{/if}
	{* ---- END ---- *}
</html>
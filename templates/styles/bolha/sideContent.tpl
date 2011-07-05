{css extra='modules'}
<div id="sideContent">
  {if $category eq "Áudio"}
  {********AUDIO*********}
    <a href="tiki-index.php?page=Áudio&bl"><img src="styles/{$style|replace:".css":""}/img/logoAudio.png"></a>
	<div id="localMenu">
	<ul>
    {if $page eq "Softwares de Áudio"}
       <li class="selectedAudio">{tr}softwares{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Softwares de Áudio">softwares</li>
    {/if}

    {if $page eq "equipamentos audio"}
       <li class="selectedAudio">{tr}equipamentos{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=equipamentos audio&bl">{tr}equipamentos{/tr}</a></li>
    {/if}

    {if $page eq "Produzindo Audio"}
       <li class="selectedAudio">{tr}produzindo{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Produzindo+Audio&bl">{tr}produzindo{/tr}</a></li>
    {/if}
    
    {if $page eq "Links de Áudio"}
       <li class="selectedAudio">links</li>
    {else}
        <li><a href="tiki-index.php?page=Links+de+%C3%81udio&bl">{tr}links{/tr}</a></li>
    {/if}
	</ul>
	</div>
  {elseif $category eq "Gráfico"}
  {*********GRAFICO********}
    <a href="tiki-index.php?page=Gráfico&bl"><img src="styles/{$style|replace:".css":""}/img/logoGrafi.png"></a>
	<div id="localMenu">
	<ul>
    {if $page eq "Softwares de Gráfico"}
       <li class="selectedGraf">{tr}softwares{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Softwares de Gráfico&bl">softwares</a></li>
    {/if}
    
    {if $page eq "equipamentos grafico"}
       <li class="selectedGraf">{tr}equipamentos{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=equipamentos grafico&bl">{tr}equipamentos{/tr}</a></li>
    {/if}

    {if $page eq "Produzindo Gráfico"}
       <li class="selectedGraf">{tr}produzindo{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Produzindo+Gráfico&bl">{tr}produzindo{/tr}</a></li>
    {/if}

    {if $page eq "Links de Gráfico"}
       <li class="selectedGraf">{tr}links{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Links de Gráfico&bl">{tr}links{/tr}</a></li>
    {/if}
	</ul>
	</div>
  {elseif $category eq "Vídeo"}
  {*********VIDEO********}
    <a href="tiki-index.php?page=Vídeo&bl"><img src="styles/{$style|replace:".css":""}/img/logoVideo.png"></a>
	<div id="localMenu">
	<ul>
    {if $page eq "Softwares de Vídeo"}
       <li class="selectedVideo">{tr}softwares{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Softwares de Vídeo&bl">{tr}softwares{/tr}</a></li>
    {/if}

    {if $page eq "equipamentos video"}
       <li class="selectedVideo">{tr}equipamentos{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=equipamentos video&bl">{tr}equipamentos{/tr}</a></li>
    {/if}
    
    {if $page eq "Produzindo Vídeo"}
       <li class="selectedVideo">{tr}produzindo{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Produzindo+Vídeo&bl">{tr}produzindo{/tr}</a></li>
    {/if}

    {if $page eq "Links de Vídeo"}
       <li class="selectedVideo">{tr}links{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Links de Vídeo&bl">{tr}links{/tr}</a></li>
    {/if}
	</ul>
	</div>
  {elseif $category eq "gallery"}
  {*********ACERVO********}
    <a href="el-gallery_home.php"><img src="styles/{$style|replace:".css":""}/img/logoAcervo.png"></a>
	<div id="localMenu">
	<ul>
    {if $current_location eq "el-gallery_upload.php"}      
      	<li class="selectedAcervo">{tr}compartilhe sua obra{/tr}</li>
    {else}
    	{if $user}
        	<li><a href="el-gallery_upload.php">{tr}compartilhe sua obra{/tr}</a></li>
        {else}
      		<div id="precisaLogar" class="none" style="width:200px;padding:5px">
      			{tr}Para compartilhar a sua obra no <b>Acervo Livre</b> é necessário se <a href="tiki-register.php">cadastrar</a> no site.{/tr}<br><br>
      			{tr}Se for cadastrado, efetue o login{/tr}:<br>

					    <form id="uLoginBox" action="tiki-login.php" method="post">
					      <input type="hidden" name="redirect" value="el-gallery_upload.php">
					      <input class="uText" type="text" name="user" id="login-user" size="12" value="{tr}user{/tr}" onFocus="this.value=''"/>
					      senha:<input class="uText" type="{if $isIE}password{else}text{/if}" name="pass" id="login-pass" size="{if $isIE}8{else}10{/if}" {if !$isIE}value="{tr}senha{/tr}" onFocus="this.value='';this.type='password'"{/if}/>
					      <input type="image" name="login" src="styles/{$style|replace:".css":""}/img/iLogin.png" />      
					      <div id="uLoginOptions">
					        <a href="tiki-remind_password.php">&raquo; {tr}recuperar{/tr} {tr}senha{/tr}</a><br>
					      </div>
					   </form>

			  <br><br>
				{tr}Se preferir{/tr}, <a href="tiki-index.php?page=faq Acervo&bl">{tr}leia mais{/tr}</a> {tr}sobre o <b>Acervo Livre</b>{/tr}.
      		</div>
      		<li onclick="showLightbox('precisaLogar')" style="cursor:pointer"><a>{tr}compartilhe sua obra{/tr}</a></li>
        {/if}   
    {/if}
    
    {if $current_location eq "el-gallery_upload.php"}      
      	<li class="selectedAcervo">{tr}canais ao vivo{/tr}</li>
    {else}
     	<li><a href="elIce.php">{tr}canais ao vivo{/tr}</a></li>
    {/if}
     <li><a href="tiki-index.php?page=faq">{tr}sobre o{/tr} {tr}acervo{/tr}</a></li>
	</ul>
	</div>
  {/if}
  
  {foreach from=$right_modules item=module}
    {$module.data}
  {/foreach}
</div>
<?php

require_once "tiki-setup.php";

if ($tiki_p_admin == 'y') {
	$amb = array('sobre', 'projeto', 'vídeo', 'áudio', 'Áudio', 'gráfico', 'tradução', 'tutoriais', 'texto', 'equipamentos', 'teste', 'sistema', 'colabore', 'contato', 'distribuição', 'links', 'se', 'performance', 'computadores', 'to', 'instalação', 'textos', 'rede', 'particular', 'minc', 'about', 'participantes', 'premio', 'homepage', 'bahia', 'recife', 'explorando', 'osasco', 'vassouras', 'bagulho', 'cameras', 'ficção', 'al', 'es', 'configure', 'ma', 'go', 'ac', 'cozinha', 'sp', 'rs', 'pa', 'pr', 'mg', 'rio', 'rn', 'ce', 'pe', 'kitchen', 'pós-produção', 'dev', 'hardware');
	
	$result = $tikilib->query('select pageName, data, ip, description from tiki_pages;');
	
	$pages = array();
	while ($row = $result->fetchrow()) {
		$pages[] = $row;
	}
	
	$links = 0;
	
	$totalModif = 0;
		
	foreach ($pages as $page) {
		
		$data = $page['data'];
		
		$total = 0;
		foreach ($pages as $pageName) {
			$pageName = $pageName['pageName'];
			
			if (in_array(strtolower($pageName), $amb)) {
				break;
			}
			
			$regex = preg_replace('/([^a-zA-Z0-9])/', "\\$1", $pageName);
			
			$regex = '/(?<!\(\([^\)]*)' . $regex . '(?![^\(]*\)\))/';
			print($regex);exit;
			preg_match_all($regex, $data, $matches);
			
			if ($total = count($matches[0])) {
				preg_replace($regex, "(($pageName))", $data);
				$totalModif += $total;
				// faz qq coisa com $total
			}
		}
		
		if ($total) {
			print "$pageName<br> " . $page['data'] . "<br><hr>$data<br><br><hr><hr>";
		}
	}
	/*
	foreach ($pages as $page) {
		preg_match_all('/[^ ,.:\'\";&\n\/!?\-][^ ,.:\'\";&\n\/!?\-]+/', $page['data'], $matches);
		
		$modif = false;
		$data = $page['data'];
		$replaced = array();
		for ($i = 0; $i < count($matches[0]); $i++) {
			if (!in_array(strtolower($matches[0][$i]), $amb) &&
				strtolower($matches[0][$i]) != strtolower($page['pageName']) &&
				!in_array($matches[0][$i], $replaced)) {
				if ($tikilib->page_exists($matches[0][$i])) {
					$links++;
					print($matches[0][$i].'<br>');
					$replaced[] = $matches[0][$i];
					$modif = true;
					$data = preg_replace("/([^(])" . $matches[0][$i] ."/", "$1((" . $matches[0][$i] ."))", $data);
				}
			}
		}
		if($modif) {
			print($page['pageName'] . '<br><br>' . $page['data'] . '<br><br>' . $data); exit;
			$tikilib->update_page($page['pageName'], 
							      $page[$data],
							      $page['linkando conteúdo wiki'],
							      $page['robôDeLinks'],
							      $page['ip'],
							      $page['description']);
		}
	}
	*/
	print("<br><center><h1>Pronto para fazer $totalModif links</h1></center><br>");
}


exit;
?>
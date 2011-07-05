<?php
// $Header: /cvsroot/tikiwiki/tiki/lib/diff/difflib.php,v 1.1.4.4 2004/10/19 16:34:32 sylvieg Exp $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

include_once("lib/diff/Diff.php");
include_once("lib/diff/Renderer.php");

/* @brief modif tiki for the renderer lib	*/
class Tiki_Text_Diff_Renderer extends Text_Diff_Renderer {
     function _lines($lines, $prefix = '', $suffix = '')
//ADD $suffix
    {
        foreach ($lines as $line) {
            echo "$prefix$line$suffix\n";
        }
    }
  function render($diff)
    {
        $xi = $yi = 1;
        $block = false;
        $context = array();

        $nlead = $this->_leading_context_lines;
        $ntrail = $this->_trailing_context_lines;

        $this->_startDiff();

        foreach ($diff->getDiff() as $edit) {
            if (is_a($edit, 'Text_Diff_Op_copy')) {
                if (is_array($block)) {
                    if (count($edit->orig) <= $nlead + $ntrail) {
                        $block[] = $edit;
                    } else {
                        if ($ntrail) {
                            $context = array_slice($edit->orig, 0, $ntrail);
                            $block[] = &new Text_Diff_Op_copy($context);
                        }
                        $this->_block($x0, $ntrail + $xi - $x0,
                                      $y0, $ntrail + $yi - $y0,
                                      $block);
                        $block = false;
                    }
                }
                $context = $edit->orig;
            } else {
                if (!is_array($block)) {
//BUG if compare on all the length:                    $context = array_slice($context, count($context) - $nlead);
                    $context = array_slice($context, -$nlead, $nlead);
                    $x0 = $xi - count($context);
                    $y0 = $yi - count($context);
                    $block = array();
                    if ($context) {
                        $block[] = &new Text_Diff_Op_copy($context);
                    }
                }
                $block[] = $edit;
            }

            if ($edit->orig) {
                $xi += count($edit->orig);
            }
            if ($edit->final) {
                $yi += count($edit->final);
            }
        }

        if (is_array($block)) {
            $this->_block($x0, $xi - $x0,
                          $y0, $yi - $y0,
                          $block);
        }

        return $this->_endDiff();
    }
}

function diff2($page1, $page2, $type='sidediff') {
	$page1 = split("\n", $page1);
	$page2 = split("\n", $page2);
	$z = new Text_Diff($page1, $page2);
	if ($z->isEmpty()) {
		$html = '';
	} else {
//echo "<pre>";print_r($z);echo "</pre>";
		if ($type == 'unidiff') {
			require_once('renderer_unified.php');
			$renderer = new Text_Diff_Renderer_unified(2);
		} else if ($type == 'minsidediff') {
			require_once('renderer_sidebyside.php');
			$renderer = new Text_Diff_Renderer_sidebyside(2);
		} else {
			require_once('renderer_sidebyside.php');
			$renderer = new Text_Diff_Renderer_sidebyside(sizeof($page1));
		}
		$html = $renderer->render($z);
	}
	return $html;
}
/* @brief compute the characters differences between a list of lines
 * @param $orig array list lines in the original version
 * @param $final array the same lines in the final version
 */
function diffChar($orig, $final) {
	$line1 = preg_split('//', implode("<br />", $orig), -1, PREG_SPLIT_NO_EMPTY);
	$line2 = preg_split('//', implode("<br />", $final), -1, PREG_SPLIT_NO_EMPTY);
	$z = new Text_Diff($line1, $line2);
	if ($z->isEmpty())
		return array($orig[0], $final[0]);
//echo "<pre>";print_r($z);echo "</pre>";
	require_once('renderer_character.php');
	$renderer = new Text_Diff_Renderer_character(sizeof($line1));
	return $renderer->render($z);
}

// Tiki's current PHP requirement is 4.1, but is_a() requires PHP 4.2+,
// so we define it here if function doesn't exist
if (!function_exists('is_a')) {
	function is_a($object, $class_name) {
		$class = get_class($object);
		if ($class == $class_name) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>

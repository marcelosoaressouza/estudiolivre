<?php
// $Header: /cvsroot/tikiwiki/tiki/lib/wiki-plugins/wikiplugin_tracker.php,v 1.17.2.43 2007/04/05 12:45:18 sylvieg Exp $
// Includes a tracker field
// Usage:
// {TRACKER()}{TRACKER}

function wikiplugin_tracker_help() {
	$help = tra("Displays an input form for tracker submit").":\n";
	$help.= "~np~{TRACKER(trackerId=>1, fields=>id1:id2:id3, action=>Name of submit button, showtitle=>y|n, showdesc=>y|n, showmandatory=>y|n, embedded=>y|n)}Notice{TRACKER}~/np~";
	return $help;
}
function wikiplugin_tracker_name($fieldId, $name, $field_errors) {
	foreach($field_errors['err_mandatory'] as $f) {
		if ($fieldId == $f['fieldId'])
			return '<span class="highlight">'.$name.'</span>';
	}
	foreach($field_errors['err_value'] as $f) {
		if ($fieldId == $f['fieldId'])
			return '<span class="highlight">'.$name.'</span>';
	}
	return $name;
}
function wikiplugin_tracker($data, $params) {
	global $tikilib, $userlib, $dbTiki, $user, $group, $page, $tiki_p_admin, $tiki_p_create_tracker_items, $smarty, $feature_multilingual, $userTracker;
	global $trklib; include_once('lib/trackers/trackerlib.php');

	//var_dump($_REQUEST);
	extract ($params,EXTR_SKIP);
	if (!isset($embedded)) {
		$embedded = "n";
	}
	if (!isset($showtitle)) {
		$showtitle = "n";
	}
	if (!isset($showdesc)) {
		$showdesc = "n";
	}
	if (empty($trackerId) && !empty($view) && $view == 'user' && $userTracker == 'y') {
		$utid = $userlib->get_usertrackerid($group);
		if (!empty($utid) && !empty($utid['usersTrackerId'])) {
			$itemId = $trklib->get_item_id($utid['usersTrackerId'],$utid['usersFieldId'],$user);
			$trackerId = $utid['usersTrackerId'];
			if (!empty($itemId) && empty($_REQUEST['ok']))
				return('<b>Item already created</b>');
		}
	}
	if (!isset($trackerId)) {
		return ("<b>missing tracker ID for plugin TRACKER</b><br />");
	}
	if (!isset($action)) {
		$action = tra("Save");
	}
	if (!isset($showmandatory)) {
		$showmandatory = 'y';
	}
	if (!isset($permMessage)) {
		$permMessage = tra("You do not have permission to insert an item");
	}

	if ($userlib->object_has_one_permission($trackerId, 'tracker')) {
		if ($tiki_p_admin != 'y') {
			$perms = $userlib->get_permissions(0, -1, 'permName_desc', '', 'trackers');
			foreach ($perms["data"] as $perm) {
				$permName = $perm["permName"];
				if ($userlib->object_has_permission($user, $trackerId, 'tracker', $permName)) {
					$$permName = 'y';
					$smarty->assign("$permName", 'y');
				} else {
					$$permName = 'n';
					$smarty->assign("$permName", 'n');
				}
			}
		}
	}

	// permission checking
	if($tiki_p_create_tracker_items != 'y') {
		return '<b>'.$permMessage.'</b>';
	}

	$tracker = $tikilib->get_tracker($trackerId);

	$thisIsThePlugin = isset($_REQUEST['trackit']) && $_REQUEST['trackit'] == $trackerId && ((isset($_REQUEST['fields']) && isset($params['fields']) && $_REQUEST['fields'] == $params['fields']) || (!isset($_REQUEST['fields']) && !isset($params['fields'])));

	if (!isset($_REQUEST["ok"]) || $_REQUEST["ok"]  == "n" || !$thisIsThePlugin) {
	
		$field_errors = array('err_mandatory'=>array(), 'err_value'=>array());
	
		if ($tracker) {
			global $notificationlib; include_once('lib/notifications/notificationlib.php');	
			$tracker = array_merge($tracker,$trklib->get_tracker_options($trackerId));
			$flds = $trklib->list_tracker_fields($trackerId,0,-1,"position_asc","");
			$back = '';
			$bad = array();
			$embeddedId = false;
			$onemandatory = false;
			$full_fields = array();
			$mainfield = '';

			if ($thisIsThePlugin) {
				$cpt = 0;
				foreach ($flds['data'] as $fl) {
					// store value to display it later if form
					// isn't fully filled.
					if(isset($_REQUEST['track'][$fl['fieldId']])) {
						$flds['data'][$cpt]['value'] = $_REQUEST['track'][$fl['fieldId']];
					}
					else {
						$flds['data'][$cpt]['value'] = '';
					}
					if (!empty($_REQUEST['track_other'][$fl['fieldId']])) {
						$flds['data'][$cpt]['value'] = $_REQUEST['track_other'][$fl['fieldId']];
					}
					$full_fields[$fl['fieldId']] = $fl;
					
					if ($embedded == 'y' and $fl['name'] == 'page') {
						$embeddedId = $fl['fieldId'];
					}
					if ($fl['isMain'] == 'y')
						$mainfield = $flds['data'][$cpt]['value'];
					if ($fl['type'] == 'e')
						$ins_fields['data'][] = array_merge(array('value' => ''), $fl);
					$cpt++;
				}

				if (isset($_REQUEST['track'])) {
					foreach ($_REQUEST['track'] as $fld=>$val) {
						//$ins_fields["data"][] = array('fieldId' => $fld, 'value' => $val, 'type' => 1);
						if (!empty($_REQUEST["track_other"][$fld])) {
							$val = $_REQUEST["track_other"][$fld];
						}
						$ins_fields["data"][] = array_merge(array('value' => $val), $full_fields[$fld]);
					}
				}
				if (isset($_FILES['track'])) {// image fields
					foreach ($_FILES['track'] as $label=>$w) {
						foreach ($w as $fld=>$val) {
							if ($label == 'tmp_name' && is_uploaded_file($val)) {
								$fp = fopen( $val, 'rb' );
								$data = '';
								while (!feof($fp)) {
									$data .= fread($fp, 8192 * 16);
								}
								fclose ($fp);
								$files[$fld]['value'] = $data;
							} else {
								$files[$fld]['file_'.$label] = $val;
							}
						}
					}
					foreach ($files as $fld=>$file) {
						$ins_fields['data'][] = array_merge($file, $full_fields[$fld]);
					}
				}

				if (isset($_REQUEST['authorfieldid']) and $_REQUEST['authorfieldid']) {
					$ins_fields["data"][] = array('fieldId' => $_REQUEST['authorfieldid'], 'value' => $user, 'type' => 'u', 'options' => 1);
				}
				if (isset($_REQUEST['authorgroupfieldid']) and $_REQUEST['authorgroupfieldid']) {
					$ins_fields["data"][] = array('fieldId' => $_REQUEST['authorgroupfieldid'], 'value' => $group, 'type' => 'g', 'options' => 1);
				}
				if ($embedded == 'y') {
					$ins_fields["data"][] = array('fieldId' => $embeddedId, 'value' => $_REQUEST['page']);
				}
				$ins_categs = array();
				$categorized_fields = array();
				while (list($postVar, $postVal) = each($_REQUEST)) {
					if(preg_match("/^ins_cat_([0-9]+)/", $postVar, $m)) {
						foreach ($postVal as $v)
 	   						$ins_categs[] = $v;
						$categorized_fields[] = $m[1];
					}
		 		}
				// Check field values for each type and presence of mandatory ones
				$field_errors = $trklib->check_field_values($ins_fields, $categorized_fields);
			
				// values are OK, then lets add a new item
				if( count($field_errors['err_mandatory']) == 0  && count($field_errors['err_value']) == 0 ) {
					$rid = $trklib->replace_item($trackerId,0,$ins_fields,$tracker['newItemStatus']);
					$trklib->categorized_item($trackerId, $rid, $mainfield, $ins_categs);
					if (!empty($email)) {
						global $sender_email;
						$emailOptions = split("\|", $email);
						if (is_numeric($emailOptions[0])) {
							$emailOptions[0] = $trklib->get_item_value($trackerId, $rid, $emailOptions[0]);
						}
						if (empty($emailOptions[0])) { // from
							$emailOptions[0] = $sender_email;
						}
						if (empty($emailOptions[1])) { // to
							$emailOptions[1][0] = $sender_email;
						} else {
							$emailOptions[1] = split(',', $emailOptions[1]);
							foreach ($emailOptions[1] as $key=>$email) {
								if (is_numeric($email))
									$emailOptions[1][$key] = $trklib->get_item_value($trackerId, $rid, $email);
							}
						}
						if (!empty($emailOptions[2])) { //tpl
							if (!preg_match('/\.tpl$/', $emailOptions[2]))
								$emailOptions[2] .= '.tpl';
							$tplSubject = str_replace('.tpl', '_subject.tpl', $emailOptions[2]);
						} else {
							$emailOptions[2] = 'tracker_changed_notification.tpl';
						}
						if (empty($tplSubject)) {
							$tplSubject = 'tracker_changed_notification_subject.tpl';
						}							
						include_once('lib/webmail/tikimaillib.php');
						$mail = new TikiMail();
						@$mail_data = $smarty->fetch('mail/'.$tplSubject);
						if (empty($mail_data))
							$mail_data = tra('Tracker was modified at '). $_SERVER["SERVER_NAME"];
						$mail->setSubject($mail_data);
						$mail_data = $smarty->fetch('mail/'.$emailOptions[2]);
						$mail->setText($mail_data);
						$mail->setHeader('From', $emailOptions[0]);
						$mail->send($emailOptions[1]);
					}
					if (empty($url)) {
						$url = "tiki-index.php?page=".urlencode($page)."&ok=y&trackit=$trackerId";
						if (!empty($params['fields']))
							$url .= "&fields=".urlencode($params['fields']);
					}
					header("Location: $url");
					die;
					// return "<div>$data</div>";
				}
			}
			// initialize fields with blank values
			else {
				for($i = 0; $i < count($flds['data']); $i++) {
					$flds['data'][$i]['value'] = '';
				}
			}
			
			$optional = array();
			$outf = array();
			if (isset($fields)) {
				$fl = split(":",$fields);
			
				foreach ($fl as $l) {
					if (substr($l,0,1) == '-') {
						$l = substr($l,1);
						$optional[] = $l;
					}
					$outf[] = $l;
				}
			}

			// Display warnings when needed
			if(count($field_errors['err_mandatory']) > 0) {
				$back.= '<div class="simplebox highlight">';
				$back.= tra('Following mandatory fields are missing').'&nbsp;:<br/>';
				$coma_cpt = count($field_errors['err_mandatory']);
				foreach($field_errors['err_mandatory'] as $f) {
					$back.= $f['name'];
					$back.= --$coma_cpt > 0 ? ',&nbsp;' : '';
				}
				$back.= '</div><br />';
			}

			if(count($field_errors['err_value']) > 0) {
				$back.= '<div class="simplebox highlight">';
				$back.= tra('Following fields are incorrect').'&nbsp;:<br/>';
				$coma_cpt = count($field_errors['err_value']);
				foreach($field_errors['err_value'] as $f) {
					$back.= $f['name'];
					$back.= --$coma_cpt > 0 ? ',&nbsp;' : '';
				}
				$back.= '</div><br />';
			}
				
			$back.= '~np~<form enctype="multipart/form-data" method="post"><input type="hidden" name="trackit" value="'.$trackerId.'" />';
			if (isset($fields))
				$back .= '<input type="hidden" name="fields" value="'.$params['fields'].'" />';//if plugin inserted twice with the same trackerId
			if (!empty($_REQUEST['page']))
				$back.= '<input type="hidden" name="page" value="'.$_REQUEST["page"].'" />';
			$back.= '<input type="hidden" name="refresh" value="1" />';
			if ($showtitle == 'y') {
				$back.= '<div class="titlebar">'.$tracker["name"].'</div>';
			}
			if ($showdesc == 'y') {
				$back.= '<div class="wikitext">'.$tracker["description"].'</div><br />';
			}

			// Loop on tracker fields and display form
			$back.= '<table>';
			foreach ($flds['data'] as $f) {
				if ($f['type'] == 'u' and $f['options'] == '1') {
					$back.= '<input type="hidden" name="authorfieldid" value="'.$f['fieldId'].'" />';
				}
				if ($f['type'] == 'g' and $f['options'] == '1') {
					$back.= '<input type="hidden" name="authorgroupfieldid" value="'.$f['fieldId'].'" />';
				}
				if (in_array($f['fieldId'],$outf)) {

					if (in_array($f['fieldId'],$optional)) {
						$f['name'] = "<i>".$f['name']."</i>";
					}
					// numeric or text field
					if ($f['type'] == 't' or $f['type'] == 'n' and $f["fieldId"] != $embeddedId or $f['type'] == 'm') {
						$back.= "<tr><td>".wikiplugin_tracker_name($f['fieldId'], $f['name'], $field_errors);
						if ($showmandatory == 'y' and $f['isMandatory'] == 'y') {
							$back.= "&nbsp;<b>*</b>&nbsp;";
							$onemandatory = true;
						}
						$back.= "</td><td>";
						$back.= '<input type="text" name="track['.$f["fieldId"].']" value="'.$f['value'].'"';
						if (isset($f['options_array'][1])) {
							$back.= 'size="'.$f['options_array'][1].'" maxlength="'.$f['options_array'][1].'"';
						} else {
							$back.= 'size="30"';
						}
						$back.= '/>';
					// item link
					} elseif ($f['type'] == 'r') {
						$list = $trklib->get_all_items($f['options_array'][0],$f['options_array'][1],'o');
						$back.= "<tr><td>".wikiplugin_tracker_name($f['fieldId'], $f['name'], $field_errors);
						if ($showmandatory == 'y' and $f['isMandatory'] == 'y') {
							$back.= "&nbsp;<b>*</b>&nbsp;";
							$onemandatory = true;
						}
						$back.= "</td><td>";
						$back.= '<select name="track['.$f["fieldId"].']">';
						$back.= '<option value=""></option>';
						foreach ($list as $key=>$item) {
							$selected = $f['value'] == $item ? 'selected="selected"' : '';
							$back.= '<option value="'.$item.'" '.$selected.'>'.$item.'</option>';
						}
						$back.= "</select>";
					// country
					} elseif ($f['type'] == 'y') {
							$back.= "<tr><td>".wikiplugin_tracker_name($f['fieldId'], $f['name'], $field_errors);
						if ($showmandatory == 'y' and $f['isMandatory'] == 'y') {
							$back.= "&nbsp;<b>*</b>&nbsp;";
							$onemandatory = true;
						}
						$back.= "</td><td>";
						$back.= '<select name="track['.$f["fieldId"].']">';
						$flags = $trklib->get_flags();
						foreach ($flags as $flag) {
							$selected = $f['value'] == $flag ? 'selected="selected"' : '';
							if (!isset($f['options']) ||  $f['options'] != '1')
								$selected .= ' style="background-image:url(\'img/flags/'.$flag.'.gif\');background-repeat:no-repeat;padding-left:25px;padding-bottom:3px;"';
							$back.= '<option value="'.$flag.'" '.$selected.'>'.$flag.'</option>';
						}
						$back.= "</select>";
					// textarea
					} elseif ($f['type'] == 'a') {
						$back.= "<tr><td>".wikiplugin_tracker_name($f['fieldId'], $f['name'], $field_errors);
						if ($showmandatory == 'y' and $f['isMandatory'] == 'y') {
							$back.= "&nbsp;<b>*</b>&nbsp;";
							$onemandatory = true;
						}
						$back.= "</td><td>";
						if( isset($f['options_array'][1]) ) {
							$back.= '<textarea cols='.$f['options_array'][1].' rows='.$f['options_array'][2].' name="track['.$f["fieldId"].']" wrap="soft">'.$f['value'].'</textarea>';
						} else {
							$back.= '<textarea cols="29" rows="7" name="track['.$f["fieldId"].']" wrap="soft">'.$f['value'].'</textarea>';
						}
					// user selector
					} elseif ($f['type'] == 'u' and $f['options'] == '1') {
						$back.= '<tr><td>'.wikiplugin_tracker_name($f['fieldId'], $f['name'], $field_errors).'</td><td>'.$user;
					// drop down, user selector or group selector
					} elseif ($f['type'] == 'd' or $f['type'] == 'D' or $f['type'] == 'u' or $f['type'] == 'g' or $f['type'] == 'r') {
						if ($f['type'] == 'd' or $f['type'] == 'D') {
							$list = $f['options_array'];
						} elseif ($f['type'] == 'u') {
							if ($f['options'] == 1 or $f['options'] == 2) {
								$list = false;
							} else {
								$list = $userlib->list_all_users();
							}
						} elseif ($f['type'] == 'g') {
							$list = $userlib->list_all_groups();
						}
						if ($list) {
							$back.= "<tr><td>".wikiplugin_tracker_name($f['fieldId'], $f['name'], $field_errors);
							if ($showmandatory == 'y' and $f['isMandatory'] == 'y') {
								$back.= "&nbsp;<b>*</b>&nbsp;";
								$onemandatory = true;
							}
							$back.= "</td><td>";
							$back.= '<select name="track['.$f["fieldId"].']">';
							$back .= '<option value=""></option>';
							$otherValue = $f['value'];
							foreach ($list as $item) {
								if ($f['value'] == $item) {
									$selected = 'selected="selected"';
									$otherValue = '';
								} else {
									$selected = '';
								}
								$back.= '<option value="'.$item.'" '.$selected.'>'.$item.'</option>';
							}

							$back.= "</select>";
							if ($f['type'] == 'D') {
								$back .= '<br />'.tra('Other:').' <input type="text" name="track_other['.$f["fieldId"].']" value="'.$otherValue.'" />';
							}
						} else {
							$back.= '<input type="hidden" name="track['.$f["fieldId"].']" value="'.$user.'" />';
						}
					} elseif ($f['type'] == 'h') {
						$back .= "</td></tr></table><h2>".wikiplugin_tracker_name($f['fieldId'], $f['name'], $field_errors)."</h2><table><tr><td>";
					} elseif ($f['type'] == 'e') {
						$back .="<tr><td>".wikiplugin_tracker_name($f['fieldId'], $f['name'], $field_errors);
						if ($showmandatory == 'y' and $f['isMandatory'] == 'y') {
							$back.= "&nbsp;<b>*</b>&nbsp;";
							$onemandatory = true;
						}
						$back .= "</td><td>";
						$k = $f["options_array"][0];
						global $categlib; include_once('lib/categories/categlib.php');
						$cats = $categlib->get_child_categories($k);
						$i = 0;
						if (!empty($f['options_array'][2]) && ($f['options_array'][2] == '1' || $f['options_array'][2] == 'y')) { 
							$back .= '<script type="text/javascript"> /* <![CDATA[ */';
							$back .= "document.write('<div class=\"categSelectAll\"><input type=\"checkbox\" onclick=\"switchCheckboxes(this.form,\'ins_cat_{$f['fieldId']}[]\',this.checked)\"/>";
							$back .= tra('select all');
							$back .= "</div>')/* ]]> */</script>";
						}
						foreach ($cats as $cat) {
							$checked = $f['value'] == $cat['categId'] ? 'checked="checked"' : '';
							$back .= '<input type="checkbox" name="ins_cat_'.$f['fieldId'].'[]" value="'.$cat["categId"].'" '.$checked.'>'.$cat['name'].'</input><br />';
						}
					} elseif ($f['type'] == 'c') {
						$back .="<tr><td>".wikiplugin_tracker_name($f['fieldId'], $f['name'], $field_errors);
						if ($showmandatory == 'y' and $f['isMandatory'] == 'y') {
							$back.= "&nbsp;<b>*</b>&nbsp;";
							$onemandatory = true;
						}
						$checked = $f['value'] == 'y' ? 'checked="checked"' : '';
						$back .= '</td><td><input type="checkbox" name="track['.$f["fieldId"].']" value="y" '.$checked.'/>';
					} elseif ($f['type'] == 'i') {
						$back.= "<tr><td>".wikiplugin_tracker_name($f['fieldId'], $f['name'], $field_errors);
						if ($showmandatory == 'y' and $f['isMandatory'] == 'y') {
							$back.= "&nbsp;<b>*</b>&nbsp;";
							$onemandatory = true;
						}
						$back .= "</td><td>";
						$back .= '<input type="file" name="track['.$f["fieldId"].']" />';
					} else {
					}
					$back.= "</td></tr>";
				}
			}
			$back.= "<tr><td></td><td><input type='submit' name='action' value='".$action."'>";
			if ($showmandatory == 'y' and $onemandatory) {
				$back.= "<br /><i>".tra("Fields marked with a * are mandatory.")."</i>";
			}
			$back.= "</td></tr>";
			$back.= "</table>";
			$back.= "</form>~/np~";
		} else {
			$back = "No such id in trackers.";
		}
		return $back;
	}
	else {
		$back = '';
		if ($showtitle == 'y') {
			$back.= '<div class="titlebar">'.$tracker["name"].'</div>';
		}
		if ($showdesc == 'y') {
			$back.= '<div class="wikitext">'.$tracker["description"].'</div><br />';
		}
		$back.= '<div>'.$data.'</div>';
		return $back;
	}
}

?>

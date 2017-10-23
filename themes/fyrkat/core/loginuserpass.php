<!DOCTYPE html>
<title><?php echo $this->t('{login:user_pass_header}'); ?></title>
<link rel="stylesheet" href="<?php echo SimpleSAML_Module::getModuleURL('themefyrkat/normalize.css'); ?>" type="text/css">
<link rel="stylesheet" href="<?php echo SimpleSAML_Module::getModuleURL('themefyrkat/fyrkat.css'); ?>" type="text/css">
<link rel="stylesheet" href="<?php echo SimpleSAML_Module::getModuleURL('themefyrkat/auth.css'); ?>" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
<?php
$this->data['header'] = $this->t('{login:user_pass_header}');

if (strlen($this->data['username']) > 0) {
	$this->data['autofocus'] = 'password';
} else {
	$this->data['autofocus'] = 'username';
}

?>

<form action="?" method="post" id="loginform">
<h1><?php echo (isset($this->data['header']) ? $this->data['header'] : 'SimpleSAMLphp'); ?></h1>

	<div class="inputstack">
		<p><input id="username"<?php echo ($this->data['forceUsername']) ? ' disabled="disabled"' : ''; ?> type="text" name="username" placeholder="<?php echo $this->t('{login:username}'); ?>" required
		<?php if (!$this->data['forceUsername']) {
			echo 'tabindex="1"';
			if (!$this->data['username']) {
				echo ' autofocus';
			}
		} ?> value="<?php echo htmlspecialchars($this->data['username']); ?>" onkeyup="setSubmit()">
		<p><input id="password" type="password" tabindex="2" name="password" placeholder="<?php echo $this->t('{login:password}'); ?>" required
		<?php if ($this->data['username']) {
			echo ' autofocus';
		} ?> onkeyup="setSubmit()">
	</div>
	<?php
	if ($this->data['rememberMeEnabled']) {
		// display the remember me checkbox (keep me logged in)
	?>
	<p><input type="checkbox" id="remember_me" tabindex="5"
		<?php echo ($this->data['rememberMeChecked']) ? 'checked="checked"' : ''; ?>
			name="remember_me" value="Yes"/>
	<small><?php echo $this->t('{login:remember_me}'); ?></small>
<?php
}
?>
<?php
if ($this->data['rememberUsernameEnabled'] && !$this->data['forceUsername']) {
	// display the "remember my username" checkbox
?>
	<p><input type="checkbox" id="remember_username" tabindex="4"
		<?php echo ($this->data['rememberUsernameChecked']) ? 'checked="checked"' : ''; ?>
		name="remember_username" value="Yes"/>
	<small><?php echo $this->t('{login:remember_username}'); ?></small>
<?php
}
?>
<?php
if (array_key_exists('organizations', $this->data)) {
	?>
		<p><label for="organization"><?php echo $this->t('{login:organization}'); ?></label></p>
		<p><select name="organization" tabindex="3">
				<?php
				if (array_key_exists('selectedOrg', $this->data)) {
					$selectedOrg = $this->data['selectedOrg'];
				} else {
					$selectedOrg = null;
				}

				foreach ($this->data['organizations'] as $orgId => $orgDesc) {
					if (is_array($orgDesc)) {
						$orgDesc = $this->t($orgDesc);
					}

					if ($orgId === $selectedOrg) {
						$selected = 'selected="selected" ';
					} else {
						$selected = '';
					}

					echo '<option '.$selected.'value="'.htmlspecialchars($orgId).'">'.htmlspecialchars($orgDesc).'</option>';
				}
				?>
			</select></p>
<?php
}
?>
<?php
if ($this->data['errorcode'] !== null) {
	?>
		<p class="error"><?php
			echo htmlspecialchars($this->t(
				'{errors:title_'.$this->data['errorcode'].'}',
				$this->data['errorparams']
			)); ?></p>
<?php
}

?>

	<p><input id="submit" type="submit" value="<?php echo $this->t('{login:login_button}'); ?>" tabindex="6">
	<?php
	foreach ($this->data['stateparams'] as $name => $value) {
		echo('<input type="hidden" name="'.htmlspecialchars($name).'" value="'.htmlspecialchars($value).'" />');
	}
	?>
	</form>

<?php
if (!empty($this->data['links'])) {
	echo '<ul style="margin-top: 2em">';
	foreach ($this->data['links'] as $l) {
		echo '<li><a href="'.htmlspecialchars($l['href']).'">'.htmlspecialchars($this->t($l['text'])).'</a></li>';
	}
	echo '</ul>';
}
?>
<script src="<?php echo SimpleSAML_Module::getModuleURL('themefyrkat/scripts.js'); ?>" async></script>
	<?php return;
	
	$includeLanguageBar = TRUE;
	if (!empty($_POST)) 
		$includeLanguageBar = FALSE;
	if (isset($this->data['hideLanguageBar']) && $this->data['hideLanguageBar'] === TRUE) 
		$includeLanguageBar = FALSE;
	
	if ($includeLanguageBar) {
		
		$languages = $this->getLanguageList();
		if ( count($languages) > 1 ) {
			echo '<ul id="languagebar">';
			$langnames = array(
						'no' => 'Bokmål', // Norwegian Bokmål
						'nn' => 'Nynorsk', // Norwegian Nynorsk
						'se' => 'Sámegiella', // Northern Sami
						'sam' => 'Åarjelh-saemien giele', // Southern Sami
						'da' => 'Dansk', // Danish
						'en' => 'English',
						'de' => 'Deutsch', // German
						'sv' => 'Svenska', // Swedish
						'fi' => 'Suomeksi', // Finnish
						'es' => 'Español', // Spanish
						'fr' => 'Français', // French
						'it' => 'Italiano', // Italian
						'nl' => 'Nederlands', // Dutch
						'lb' => 'Lëtzebuergesch', // Luxembourgish
						'cs' => 'Čeština', // Czech
						'sl' => 'Slovenščina', // Slovensk
						'lt' => 'Lietuvių kalba', // Lithuanian
						'hr' => 'Hrvatski', // Croatian
						'hu' => 'Magyar', // Hungarian
						'pl' => 'Język polski', // Polish
						'pt' => 'Português', // Portuguese
						'pt-br' => 'Português brasileiro', // Portuguese
						'ru' => 'русский язык', // Russian
						'et' => 'eesti keel', // Estonian
						'tr' => 'Türkçe', // Turkish
						'el' => 'ελληνικά', // Greek
						'ja' => '日本語', // Japanese
						'zh' => '简体中文', // Chinese (simplified)
						'zh-tw' => '繁體中文', // Chinese (traditional)
						'ar' => 'العربية', // Arabic
						'fa' => 'پارسی', // Persian
						'ur' => 'اردو', // Urdu
						'he' => 'עִבְרִית', // Hebrew
						'id' => 'Bahasa Indonesia', // Indonesian
						'sr' => 'Srpski', // Serbian
						'lv' => 'Latviešu', // Latvian
						'ro' => 'Românește', // Romanian
						'eu' => 'Euskara', // Basque
			);
			
			$textarray = array();
			foreach ($languages AS $lang => $current) {
				$lang = strtolower($lang);
				if ($current) {
					$textarray[] = '<li>' . $langnames[$lang];
				} else {
					$textarray[] = '<li><a href="' . htmlspecialchars(\SimpleSAML\Utils\HTTP::addURLParameters(\SimpleSAML\Utils\HTTP::getSelfURL(), array($this->languageParameterName => $lang))) . '">' .
						$langnames[$lang] . '</a>';
				}
			}
			echo join("\n", $textarray);
			echo '</ul>';
		}

	}



	?>

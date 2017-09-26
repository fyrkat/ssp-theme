# fyrkat theme for SimpleSamlPhp

Clone this repo to your modules directory

	git clone https://github.com/fyrkat/ssp-theme.git themefyrkat

Make the following changes in your SSP setup:

## config/config.php

	'module.enable' => [
		'themefyrkat' => TRUE,
	],

	'theme.use' => 'themefyrkat:fyrkat',

<?php

$redux_opt_name = REDUX_OPT_NAME;

// Place any extra hooks/configs in here for extensions and
// place the actual extension within the /extensions dir


// The loader will load all of the extensions automatically.
// Alternatively you can run the include/init statements below.
require_once(get_template_directory().'/framework/admin/redux-extensions/loader.php');

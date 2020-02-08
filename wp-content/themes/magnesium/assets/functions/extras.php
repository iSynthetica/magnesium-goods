<?php
function joints_google_map_api($api)
{
	$api['key'] = 'AIzaSyDBeGNjLt_srVFXjDjduGyHtGu-fzn_Pt4';
	return $api;
}
add_filter('acf/fields/google_map/api', 'joints_google_map_api');
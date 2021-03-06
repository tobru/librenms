<?php
require 'includes/graphs/common.inc.php';
$i             = 0;
$scale_min     = 0;
$nototal       = 1;
$unit_text     = 'Per Sec.';
$rrd_filename  = rrd_name($device['hostname'], array('app', 'freeradius-auth', $app['app_id']));
$fr_auth_array = array(
    'responses' => 'Responses',
    'duplicate_requests' => 'Duplicate Requests',
    'malformed_requests' => 'Malformed Requests',
    'invalid_requests' => 'Invalid Requests',
    'dropped_requests' => 'Dropped Requests',
    'unknown_types' => 'Unknown Types'
);
$colours      = 'mixed';
$rrd_list     = array();
if (rrdtool_check_rrd_exists($rrd_filename)) {
    foreach ($fr_auth_array as $ds => $descr) {
        $rrd_list[$i]['filename'] = $rrd_filename;
        $rrd_list[$i]['descr']    = $descr;
        $rrd_list[$i]['ds']       = $ds;
        $i++;
    }
} else {
    echo "file missing: $rrd_filename";
}
require 'includes/graphs/generic_multi_line.inc.php';

<?php

# Collectd Yoctopuce plugin

require_once 'conf/common.inc.php';
require_once 'type/Default.class.php';
require_once 'inc/collectd.inc.php';

## LAYOUT
# yoctopuce-MODULENAME_SERIAL/gauge-FUNCTION.rrd

$obj = new Type_Default($CONFIG);
$obj->ds_names = array(
        'value' => 'Value'
);

$obj->width  = $width;
$obj->heigth = $heigth;

switch($obj->args['type']) {
case 'humidity':
        $obj->rrd_title = sprintf('Humidity (%s)', $obj->args['pinstance']);
        $obj->rrd_vertical = '% Relative Humidity';
        $obj->rrd_format = '%5.1lf';
        break;
case 'pressure':
        $obj->rrd_title = sprintf('Pressure (%s)', $obj->args['pinstance']);
        $obj->rrd_vertical = 'mBar';
        $obj->rrd_format = '%5.1lf';
        break;
case 'temperature':
        $obj->rrd_title = sprintf('Temperature (%s)', $obj->args['pinstance']);
        $obj->rrd_vertical = 'Degrees Celsius';
        $obj->rrd_format = '%5.1lf%s';
        break;
}

collectd_flush($obj->identifiers);
$obj->rrd_graph();

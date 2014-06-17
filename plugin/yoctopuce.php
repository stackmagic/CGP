<?php

# Collectd yoctopuce plugin

require_once 'conf/common.inc.php';
require_once 'type/Default.class.php';
require_once 'inc/collectd.inc.php';

## LAYOUT
# yoctopuce-MODULENAME_SERIAL/yoctopuce-FUNCTION.rrd

$obj = new Type_Default($CONFIG);

//$obj->width  = $width;
//$obj->heigth = $heigth;

switch($obj->args['type']) {
case 'yoctopuce_humidity':
        $obj->rrd_title = sprintf('Humidity (%s)', $obj->args['pinstance']);
        $obj->rrd_vertical = '% Relative Humidity';
        $obj->rrd_format = '%5.1lf';
        $obj->ds_names = array(
                'yoctopuce_humidity'    => 'Humidity'
        );
        break;
case 'yoctopuce_pressure':
        $obj->rrd_title = sprintf('Pressure (%s)', $obj->args['pinstance']);
        $obj->rrd_vertical = 'mBar';
        $obj->rrd_format = '%5.1lf';
        $obj->ds_names = array(
                'yoctopuce_pressure'    => 'Pressure'
        );
        break;
case 'yoctopuce_temperature':
        $obj->rrd_title = sprintf('Temperature (%s)', $obj->args['pinstance']);
        $obj->rrd_vertical = 'Degrees Celsius';
        $obj->rrd_format = '%5.1lf%s';
        $obj->ds_names = array(
                'yoctopuce_temperature' => 'Temperature'
        );
        break;
}

collectd_flush($obj->identifiers);
$obj->rrd_graph();

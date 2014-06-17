<?php

# Collectd layzapp solr plugin

require_once 'conf/common.inc.php';
require_once 'type/GenericStacked.class.php';
require_once 'inc/collectd.inc.php';

## LAYOUT
# solr-CORE/solr_origin-ORIGIN.rrd

$obj = new Type_GenericStacked($CONFIG);
$obj->rrd_title = sprintf('Solr (%s)', $obj->args['pinstance']);
$obj->rrd_vertical = '#';
$obj->rrd_format = '%5.1lf';

collectd_flush($obj->identifiers);
$obj->rrd_graph();

<?php

# Collectd snmp plugin

require_once 'conf/common.inc.php';
require_once 'inc/collectd.inc.php';


switch(GET('t')) {
	case 'net_if_octets':
		require_once 'type/GenericIO.class.php';
		$obj = new Type_GenericIO($CONFIG);
		$obj->data_sources = array('ifInOctets', 'ifOutOctets');
		$obj->ds_names = array(
			'ifInOctets' => 'Receive',
			'ifOutOctets' => 'Transmit',
		);
		$obj->colors = array(
			'ifInOctets' => '0000ff',
			'ifOutOctets' => '00b000',
		);
		$obj->rrd_title = sprintf('Interface Traffic (%s)', $obj->args['tinstance']);
		$obj->rrd_vertical = sprintf('%s per second', ucfirst($CONFIG['network_datasize']));
		$obj->scale = $CONFIG['network_datasize'] == 'bits' ? 8 : 1;
		break;

	case 'net_if_errors':
		require_once 'type/GenericIO.class.php';
		$obj = new Type_GenericIO($CONFIG);
		$obj->data_sources = array('ifInErrors', 'ifOutErrors');
		$obj->ds_names = array(
			'ifInErrors' => 'Receive',
			'ifOutErrors' => 'Transmit',
		);
		$obj->colors = array(
			'ifInErrors' => '0000ff',
			'ifOutErrors' => '00b000',
		);
		$obj->rrd_title = sprintf('Interface Errors (%s)', $obj->args['tinstance']);
		$obj->rrd_vertical = sprintf('%s per second', ucfirst($CONFIG['network_datasize']));
		$obj->scale = $CONFIG['network_datasize'] == 'bits' ? 8 : 1;
		break;

	case 'net_if_discards':
		require_once 'type/GenericIO.class.php';
		$obj = new Type_GenericIO($CONFIG);
		$obj->data_sources = array('ifInDiscards', 'ifOutDiscards');
		$obj->ds_names = array(
			'ifInDiscards' => 'Receive',
			'ifOutDiscards' => 'Transmit',
		);
		$obj->colors = array(
			'ifInDiscards' => '0000ff',
			'ifOutDiscards' => '00b000',
		);
		$obj->rrd_title = sprintf('Interface Discards (%s)', $obj->args['tinstance']);
		$obj->rrd_vertical = sprintf('%s per second', ucfirst($CONFIG['network_datasize']));
		$obj->scale = $CONFIG['network_datasize'] == 'bits' ? 8 : 1;
		break;

	case 'net_if_unicast_pkts':
		require_once 'type/GenericIO.class.php';
		$obj = new Type_GenericIO($CONFIG);
		$obj->data_sources = array('ifInUcastPkts', 'ifOutUcastPkts');
		$obj->ds_names = array(
			'ifInUcastPkts' => 'Receive',
			'ifOutUcastPkts' => 'Transmit',
		);
		$obj->colors = array(
			'ifInUcastPkts' => '0000ff',
			'ifOutUcastPkts' => '00b000',
		);
		$obj->rrd_title = sprintf('Interface Unicast Packets (%s)', $obj->args['tinstance']);
		$obj->rrd_vertical = sprintf('%s per second', ucfirst($CONFIG['network_datasize']));
		$obj->scale = $CONFIG['network_datasize'] == 'bits' ? 8 : 1;
		break;

	case 'net_if_broadcast_pkts':
		require_once 'type/GenericIO.class.php';
		$obj = new Type_GenericIO($CONFIG);
		$obj->data_sources = array('ifInBroadcastPkts', 'ifOutBroadcastPkts');
		$obj->ds_names = array(
			'ifInBroadcastPkts' => 'Receive',
			'ifOutBroadcastPkts' => 'Transmit',
		);
		$obj->colors = array(
			'ifInBroadcastPkts' => '0000ff',
			'ifOutBroadcastPkts' => '00b000',
		);
		$obj->rrd_title = sprintf('Interface Broadcast Packets (%s)', $obj->args['tinstance']);
		$obj->rrd_vertical = sprintf('%s per second', ucfirst($CONFIG['network_datasize']));
		$obj->scale = $CONFIG['network_datasize'] == 'bits' ? 8 : 1;
		break;

	case 'net_if_multicast_pkts':
		require_once 'type/GenericIO.class.php';
		$obj = new Type_GenericIO($CONFIG);
		$obj->data_sources = array('ifInMulticastPkts', 'ifOutMulticastPkts');
		$obj->ds_names = array(
			'ifInMulticastPkts' => 'Receive',
			'ifOutMulticastPkts' => 'Transmit',
		);
		$obj->colors = array(
			'ifInMulticastPkts' => '0000ff',
			'ifOutMulticastPkts' => '00b000',
		);
		$obj->rrd_title = sprintf('Interface Multicast Packets (%s)', $obj->args['tinstance']);
		$obj->rrd_vertical = sprintf('%s per second', ucfirst($CONFIG['network_datasize']));
		$obj->scale = $CONFIG['network_datasize'] == 'bits' ? 8 : 1;
		break;

	case 'if_octets':
		require_once 'type/GenericIO.class.php';
		$obj = new Type_GenericIO($CONFIG);
		$obj->data_sources = array('rx', 'tx');
		$obj->ds_names = array(
			'rx' => 'Receive',
			'tx' => 'Transmit',
		);
		$obj->colors = array(
			'rx' => '0000ff',
			'tx' => '00b000',
		);
		$obj->rrd_title = sprintf('Interface Traffic (%s)', $obj->args['tinstance']);
		$obj->rrd_vertical = sprintf('%s per second', ucfirst($CONFIG['network_datasize']));
		$obj->scale = $CONFIG['network_datasize'] == 'bits' ? 8 : 1;
		break;

	default:
		require_once 'type/Default.class.php';
		$obj = new Type_Default($CONFIG);
		$obj->rrd_title = sprintf('SNMP: %s (%s)', $obj->args['type'], $obj->args['tinstance']);
		return;
}

$obj->rrd_format = '%5.1lf%s';

collectd_flush($obj->identifiers);
$obj->rrd_graph();


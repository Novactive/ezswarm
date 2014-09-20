<?php
/**
 * Swarm module views configuration
 *
 * @category  eZpublish
 * @package   eZpublish.eZSwarm
 * @author    Novactive <contact@novactive.com>
 * @copyright 2014 Novactive
 */
$Module = array( 'name' => 'Swarm Users', 'variable_params' => true );

$ViewList           = array();
$ViewList['user'] = array(
    'functions'  => array( 'user' ),
    'ui_context' => 'administration',
    'script'     => 'user.php',
    'params'     => array( 'id' )
);

$FunctionList         = array();
$FunctionList['user'] = array();

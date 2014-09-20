<?php
/**
 * eZSwarm extension
 *
 * @category  eZpublish
 * @package   eZpublish.eZSwarm
 * @author    Novactive <contact@novactive.com>
 * @copyright 2014 Novactive
 * @license   OSL-3
 */

$eZTemplateOperatorArray = array();

$eZTemplateOperatorArray[] = array(
    'script'         => 'extension/ezswarm/autoloads/ezswarmoperators.php',
    'class'          => 'eZSwarmOperators',
    'operator_names' => array(
        'get_swarm_users',
        'swarm_fields_mapping'
    )
);

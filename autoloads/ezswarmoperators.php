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

/**
 * Swarm operators class
 *
 * @category  eZpublish
 * @package   eZpublish.eZSwarm
 * @author    Novactive <contact@novactive.com>
 * @copyright 2014 Novactive
 */
class eZSwarmOperators
{
    /**
     * class constructor
     */
    function eZSwarmOperators()
    {

    }

    /**
     * Retrieve class operators list
     *
     * @return array
     */
    function operatorList()
    {
        return array( 'get_swarm_users', 'swarm_fields_mapping' );
    }

    /**
     * Define if the operators have named parameters
     *
     * @return bool
     */
    function namedParameterPerOperator()
    {
        return false;
    }

    /**
     *
     *
     * @param $tpl
     * @param $operatorName
     * @param $operatorParameters
     * @param $rootNamespace
     * @param $currentNamespace
     * @param $operatorValue
     * @param $namedParameters
     */
    function modify(
        $tpl,
        $operatorName,
        $operatorParameters,
        &$rootNamespace,
        &$currentNamespace,
        &$operatorValue,
        &$namedParameters
    ) {
        switch ( $operatorName )
        {
            case 'get_swarm_users':
            {
                $operatorValue = $this->getSwarmUsers();
            } break;

            case 'swarm_fields_mapping':
            {
                $swarmApi      = new swarmApi();
                $operatorValue = json_encode( $swarmApi->getFieldMapping(), JSON_HEX_APOS );
            } break;
        }
    }

    /**
     * Retrieve user logins in JSon format
     *
     * @return string
     */
    protected function getSwarmUsers()
    {
        $swarmApi   = new swarmApi();
        $swarmUsers = json_decode( $swarmApi->getUsers() );
        $users      = array();
        foreach ( $swarmUsers as $user )
        {
            $users[] = array( 'label' => $user->user, 'fullname' => 'test' );
            //$users[] = $user->user;
        }

        return json_encode( $users, JSON_HEX_APOS );
    }
}

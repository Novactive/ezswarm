<?php
/**
 * Retrieve user data for provided login
 *
 * @category  eZpublish
 * @package   eZpublish.eZSwarm
 * @author    Novactive <contact@novactive.com>
 * @copyright 2014 Novactive
 */

eZDebug::updateSettings(
    array(
        'debug-enabled' => false
    )
);

$userId = $Params['id'];

if ( !$userId )
{
    $returnData = array( 'notif' => 'No user login provided' );
}
else
{
    $swarmApi = new swarmApi();
    $userData = $swarmApi->getUserData( $userId );
    if ( $userData)
    {
        $returnData = array( 'account' => $userData );
    }
    else
    {
        $returnData = array( 'notif' => 'No user data found for login : ' . $userId );
    }
}

$Result               = array();
$Result['pagelayout'] = false;
$Result['content']    = json_encode( $returnData, JSON_HEX_TAG );

return $Result;

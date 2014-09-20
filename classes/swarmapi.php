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
 * Swarm server API class
 *
 * @category  eZpublish
 * @package   eZpublish.eZSwarm
 * @author    Novactive <contact@novactive.com>
 * @copyright 2014 Novactive
 */
class swarmApi extends eZPersistentObject
{
    protected $serverUrl;
    protected $domainName;
    protected $apiKey;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $swarmIni         = eZINI::instance( 'ezswarm.ini' );
        $this->serverUrl  = $swarmIni->variable( 'SwarmSettings', 'ServerUrl' );
        $this->domainName = $swarmIni->variable( 'SwarmSettings', 'DomainName' );
        $this->apiKey     = $swarmIni->variable( 'SwarmSettings', 'ApiKey' );
    }

    /**
     * Retrieve users data from swarm server
     *
     * @return boolean/string
     */
    public function getUsers()
    {
        $client   = new GuzzleHttp\Client();
        $response = $client->get(
            $this->serverUrl, array(
                'query' => array(
                    'domainName' => $this->domainName
                ),
                'headers' => array(
                    'swarm-api-key' => $this->apiKey,
                    'Content-Type'  => 'application/x-www-form-urlencoded',
                )
            )
        );
        $data = false;
        if ( $response->getStatusCode() == 200 )
        {
            $data = $response->getBody();
        }

        return $data;
    }

    /**
     * Retrieve mapping between content attribute css id and swarm attribute identifier
     *
     * @return array
     */
    public function getFieldMapping()
    {
        $siteIni              = eZINI::instance( 'site.ini' );
        $swarmIni             = eZINI::instance( 'ezswarm.ini' );
        $userAttribMapping    = $swarmIni->variable( 'SwarmSettings' , 'UserAttributeMapping' );
        $userClassId          = $siteIni->variable( 'UserSettings' , 'UserClassID' );
        $userAccountAttribute = $swarmIni->variable( 'SwarmSettings' , 'UserAccountAttribute' );
        $userClass            = eZContentClass::fetch( $userClassId );
        $userClassAttributes  = $userClass->dataMap();
        $fieldMapping         = array();

        $userAccountAttributeId = $userClassAttributes[$userAccountAttribute]->attribute( 'id' );
        $fieldMapping["#ezcoa-" . $userAccountAttributeId . "_" . $userAccountAttribute . "_email"] = 'email';
        if ( $siteIni->variable( 'UserSettings', 'RequireConfirmEmail' ) == 'true' )
        {
            $fieldMapping["#ezcoa-" . $userAccountAttributeId . "_" . $userAccountAttribute . "_email_confirm"] = 'email';
        }

        foreach ( $userAttribMapping as $attribIdentifier => $swarmField )
        {
            $attributeId = $userClassAttributes[$attribIdentifier]->attribute( 'id' );
            $fieldMapping["#ezcoa-" . $attributeId . "_" . $attribIdentifier] = $swarmField;
        }

        return $fieldMapping;
    }

    /**
     * Retrieve user data
     *
     * @param string $userId user login
     *
     * @return bool|array
     */
    public function getUserData( $userId )
    {
        $users = json_decode( $this->getUsers(), true );

        $userData = array_filter(
            $users,
            function ( $user ) use ( $userId ) {
                 return $userId == $user['user'];
            }
        );

        $returnValue = false;
        if ( count( $userData ) == 1 )
        {
            $returnValue = array_shift( $userData );
        }

        return $returnValue;
    }
}

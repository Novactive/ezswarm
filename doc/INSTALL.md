Installing eZSwarm
=================

Requirements:
-------------
- eZ Publish 4.x or eZ Publish Legacy
- a Swarm server
- Use composer for dependency installation 

Installing:
-----------

1. Edit your composer.json file to add the new dependency

   ```json
    "require": {
        "novactive/ezswarm": "@dev"
    },
    "repositories" : [
        {
             "type": "vcs",
             "url": "https://github.com/Novactive/ezswarm.git"
        }
    ]
   ```

2. Install the dependency with composer

   ```bash
   $ php composer.phar update novactive/ezswarm --prefer-dist
   ```
   
3. Enable the extension for the backoffice siteaccess in eZ Publish. Do this by opening settings/siteaccess/<backoffice_siteaccess>/site.ini.append.php ,
   and add in the `[ExtensionSettings]` block:

   ```ini
   ActiveAccessExtensions[]=ezswarm
   ```
4. Update the class autoloads by running the script:

   ```bash
   $ php bin/php/ezpgenerateautoloads.php -e
   ```

Configuration:
--------------

*. Cloning the ini file ezswarm/settings/ezswarm.ini.append.php in settings/siteaccess/<backoffice_siteaccess>
   and edit the `[SwarmSettings]` block:

   ```ini
   # Swarm server url
   ServerUrl=
   # Users domaine name
   DomainName=
   # API Key for authentication
   ApiKey=
   # eZ publish content class attribute for user account informations (login, email, password)
   UserAccountAttribute=user_account
   # User attributes mapping between Swarm and eZ publish content class
   UserAttributeMapping[]
   #UserAttributeMapping[<ez_attribute_identifier>]=<swarm_attribute_identifier>
   UserAttributeMapping[first_name]=first
   UserAttributeMapping[last_name]=last
   ```

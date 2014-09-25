Installing eZSwarm
=================

Requirements:
-------------
- eZ Publish 4.x or eZ Publish Legacy
- a Swarm server

Installing:
-----------
1. Extract the ezswarm extension and place it in the extensions folder.
2. Enable the extension for the backoffice siteaccess in eZ Publish. Do this by opening settings/siteaccess/<backoffice_siteaccess>/site.ini.append.php ,
   and add in the `[ExtensionSettings]` block:

   ```ini
   ActiveAccessExtensions[]=ezswarm
   ```
3. Update the class autoloads by running the script:

   ```bash
   $ php bin/php/ezpgenerateautoloads.php -e
   ```

Configuration:
--------------

* Configuring eZ Publish:
  See `extension/ezswarm/settings/ezswarm.ini.append.php` for options.

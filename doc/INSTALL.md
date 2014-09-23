Installing eZSwarm
=================

Requirements:
-------------
- eZ Publish 4.x or eZ Publish Legacy
- a Swarm server

Installing:
-----------
1. Extract the ezswarm extension and place it in the extensions folder.
2. Enable the extension in eZ Publish. Do this by opening settings/override/site.ini.append.php ,
   and add in the `[ExtensionSettings]` block:

   ```ini
   ActiveExtensions[]=ezswarm
   ```
3. Update the class autoloads by running the script:

   ```bash
   $ php bin/php/ezpgenerateautoloads.php
   ```

Configuration:
--------------

* Configuring eZ Publish:
  See `extension/ezswarm/settings/ezswarm.ini.append.php` for options.

## Overview
DiscordConnect is a MediaWiki extension that aids in identifying users on a Discord server of a wiki. Users can add their global Discord username in their preferences, which can then be read via the API. In combination with a Discord bot, this then allows for one- or bidirectional matching and identification of Discord and wiki users. This extension alone is not capable of doing this; it only provides the necessary interface to authenticate wiki users.

## Installation

1. Download all files from git
```bat
cd extensions/
git clone https://github.com/RobbiRobb/DiscordConnect.git
```
2. Add the following code at the bottom of your LocalSettings.php file:
```php
wfLoadExtension( 'DiscordConnect' );
```
3. ✓ done. No additional configuration required
<?php

/**
* adds all necessities to save and load global discord user names in a users preferences
*
* @method void onSaveUserOptions($user, &$modifiedOptions, $originalOptions)
* @method void onGetPreferences($user, &$preferences)
*
* @author RobbiRobb
*/
class DiscordConnectHooks  {
	
	/**
	* adds a new field to the preferences page allowing users to add their global discord username
	*
	* @access public
	* @static
	*/
	public static function onGetPreferences($user, &$preferences) : void {
		$preferences["discordname"] = [
			"type" => "text",
			"section" => "personal/info",
			"maxlength" => 32,
			"label-message" => "discordconnect-preferences-label",
			"help-message" => "discordconnect-preferences-help"
		];
	}
	
	/**
	* makes sure the global discord user name is always lower case when saved to the database
	*
	* @access public
	* @static
	*/
	public static function onSaveUserOptions($user, &$modifiedOptions, $originalOptions) : void {
		$modifiedOptions["discordname"] = strtolower(trim($modifiedOptions["discordname"]));
	}
}
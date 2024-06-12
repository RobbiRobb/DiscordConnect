<?php

use MediaWiki\MediaWikiServices;
use Wikimedia\ParamValidator\ParamValidator;
use MediaWiki\ParamValidator\TypeDef\UserDef;

/**
* outputs the discord name of requested users via the api
* if an invalid user is requested, the output will mark this accordingly
* if a user has not set their discord name in their preferences, an empty string is returned
*
* @method void execute()
* @method array getAllowedParams()
*
* @author RobbiRobb
*/
class DiscordConnectApi extends ApiQueryBase {
	
	public function __construct(ApiQuery $query, $moduleName) {
		parent::__construct($query, $moduleName, "dc");
	}
	
	/**
	* execute the api query
	*
	* @access public
	*/
	public function execute() : void {
		$params = $this->extractRequestParams();
		$users = $params['user'];
		
		$result = $this->getResult();
		foreach($users as $user) {
			if($user->getId() === 0) {
				 $vals = [
					"user" => $user->getName(),
					"invalid" => true
				 ];
			} else {
				$vals = [
					"user" => $user->getName(),
					"userid" => $user->getId(),
					"discordname" => MediaWikiServices::getInstance()->getUserOptionsLookup()->getOption($user, "discordname")
				];
			}
			$result->addValue(["query", $this->getModuleName()], null, $vals);
		}
		$result->addIndexedTagName(["query", $this->getModuleName()], "dcuser");
	}
	
	/**
	* returns all allowed params
	*
	* @return array
	* @access protected
	*/
	protected function getAllowedParams() : array {
		return [
			"user" => [
				ParamValidator::PARAM_TYPE => "user",
				UserDef::PARAM_ALLOWED_USER_TYPES => ["name"],
				UserDef::PARAM_RETURN_OBJECT => true,
				ParamValidator::PARAM_ISMULTI => true,
				ParamValidator::PARAM_REQUIRED => true
			]
		];
	}
}
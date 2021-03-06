<?php
/**
 * LinkedinOAuthService class file.
 *
 * Register application: https://www.linkedin.com/secure/developer
 * Note: Intagration URL should be filled with a valid callback url.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://github.com/Nodge/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

require_once dirname(dirname(__FILE__)) . '/EOAuthService.php';

/**
 * LinkedIn provider class.
 *
 * @package application.extensions.eauth.services
 */
class LinkedinOAuthService extends EOAuthService {

	protected $name = 'linkedin';
	protected $title = 'LinkedIn';
	protected $type = 'OAuth';
	protected $jsArguments = array('popup' => array('width' => 900, 'height' => 550));

	protected $key = '';
	protected $secret = '';
	protected $scope = 'r_basicprofile r_emailaddress'; // 'r_fullprofile r_emailaddress';
	protected $providerOptions = array(
		'request' => 'https://api.linkedin.com/uas/oauth/requestToken',
		'authorize' => 'https://www.linkedin.com/uas/oauth/authenticate', // https://www.linkedin.com/uas/oauth/authorize
		'access' => 'https://api.linkedin.com/uas/oauth/accessToken',
	);

	protected function fetchAttributes() {
		$info = $this->makeSignedRequest('http://api.linkedin.com/v1/people/~:(id,first-name,email-address,picture-urls::(original),last-name,public-profile-url,positions:(id,title,summary,start-date,end-date,is-current,company))?format=json', array(), false); // json format not working :(
        $info = $this->parseInfo($info);

		$this->attributes['name'] = @$info['first-name'] . ' ' . @$info['last-name'];
		$this->attributes['link'] = @$info['public-profile-url'];
        $this->attributes['email'] = @$info['email-address'];
        $this->attributes['first_name'] = @$info['first-name'];
        $this->attributes['last_name'] = @$info['last-name'];
        $this->attributes['network'] = 'linkedin';

        if(@$info['picture-urls']['@attributes']['total'] == 1) {
            $this->attributes['avatar'] = @$info['picture-urls']['picture-url'];
        }

        if(@$info['positions']['@attributes']['total'] > 1) {
            foreach(@$info['positions']['position'] as $position) {
                if($position->{'is-current'}) {
                    $this->attributes['company'] = @$position->company->name;
                    $this->attributes['description'] = @$position->summary;
                    $this->attributes['position'] = @$position->title;
                }
                return;
            }
        } elseif(@$info['positions']['@attributes']['total'] == 1) {
            $this->attributes['company'] = @$info['positions']['position']['company']['name'];
            $this->attributes['description'] = @$info['positions']['position']['summary'];
            $this->attributes['position'] = @$info['positions']['position']['title'];
        }
	}

	/**
	 *
	 * @param string $xml
	 * @return array
	 */
	protected function parseInfo($xml) {
		/* @var $simplexml SimpleXMLElement */
		$simplexml = simplexml_load_string($xml);
		return $this->xmlToArray($simplexml);
	}

	/**
	 *
	 * @param SimpleXMLElement $element
	 * @return array
	 */
	protected function xmlToArray($element) {
		$array = (array)$element;
		foreach ($array as $key => $value) {
			if (is_object($value)) {
				$array[$key] = $this->xmlToArray($value);
			}
		}
		return $array;
	}
}
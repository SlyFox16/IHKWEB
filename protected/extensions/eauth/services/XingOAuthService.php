<?php
/**
 * XingOAuthService class file.
 *
 * Register application: https://www.xing.com/developer
 * Note: Intagration URL should be filled with a valid callback url.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://github.com/Nodge/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

require_once dirname(dirname(__FILE__)) . '/EOAuthService.php';

/**
 * Xing provider class.
 *
 * @package application.extensions.eauth.services
 */
class XingOAuthService extends EOAuthService {
	protected $name = 'xing';
	protected $title = 'Xing';
	protected $type = 'OAuth';
	protected $jsArguments = array('popup' => array('width' => 900, 'height' => 550));

	protected $key = '';
	protected $secret = '';
    protected $scope = '';
	protected $providerOptions = array(
		'request' => 'https://api.xing.com/v1/request_token',
		'authorize' => 'https://api.xing.com/v1/authorize',
		'access' => 'https://api.xing.com/v1/access_token',
	);

	protected function fetchAttributes() {
        $info = (object)$this->makeSignedRequest('https://api.xing.com/v1/users/me.json', array(
            'query' => array(
                'fields' => 'id, active_email, display_name, first_name, last_name, permalink',
            ),
        ), true);
        print_r($info); die();

        $this->attributes['id'] = $info['id'];
        $this->attributes['name'] = $info['first-name'] . ' ' . $info['last-name'];
        $this->attributes['link'] = $info['public-profile-url'];
        $this->attributes['email'] = $info['email-address'];
        $this->attributes['first_name'] = $info['first-name'];
        $this->attributes['last_name'] = $info['last-name'];
        $this->attributes['network'] = 'linkedin';
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
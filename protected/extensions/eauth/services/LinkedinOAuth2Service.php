<?php
/**
 * LinkedinOAuth2Service class file.
 *
 * Register application: https://www.linkedin.com/secure/developer
 * Note: Intagration URL should be filled with a valid callback url.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://github.com/Nodge/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

require_once dirname(dirname(__FILE__)) . '/EOAuth2Service.php';

/**
 * LinkedIn provider class.
 *
 * @package application.extensions.eauth.services
 */
class LinkedinOAuth2Service extends EOAuth2Service {

    protected $name = 'linkedin';
    protected $title = 'LinkedIn';
    protected $type = 'OAuth2';
    protected $jsArguments = array('popup' => array('width' => 585, 'height' => 290));

    protected $client_id = '';
    protected $client_secret = '';
    protected $scope = 'r_basicprofile';
    protected $providerOptions = array(
        'authorize' => 'https://www.linkedin.com/uas/oauth2/authorization',
        'access_token' => 'https://www.linkedin.com/uas/oauth2/accessToken',
    );

    protected function fetchAttributes() {
        $info = (object)$this->makeSignedRequest('http://api.linkedin.com/v1/people/~', array(
            'query' => array(
                'format' => 'json',
            )
        ));

        $this->attributes['id'] = $info->id;
        $this->attributes['name'] = $info->name;
        $this->attributes['url'] = $info->link;
    }
}

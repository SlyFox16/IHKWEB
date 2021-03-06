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
                'fields' => 'active_email, display_name, first_name, last_name, permalink, photo_urls, professional_experience',
            ),
        ), true);

        $this->attributes['name'] = $info->users[0]->display_name;
        $this->attributes['link'] = $info->users[0]->permalink;
        $this->attributes['email'] = $info->users[0]->active_email;
        $this->attributes['first_name'] = $info->users[0]->first_name;
        $this->attributes['last_name'] = $info->users[0]->last_name;
        $this->attributes['network'] = 'xing';

        $this->attributes['avatar'] = @$info->users[0]->photo_urls->size_1024x1024;

        $this->attributes['company'] = @$info->users[0]->professional_experience->primary_company->name;
        $this->attributes['description'] = @$info->users[0]->professional_experience->primary_company->description;
        $this->attributes['position'] = @$info->users[0]->professional_experience->primary_company->title;
	}
}
<?php
class IhkFacebookService extends FacebookOAuthService {
	/**
	 * https://developers.facebook.com/docs/authentication/permissions/
	 */
	protected $scope = 'email,user_birthday,user_hometown,user_location';

	/**
	 * http://developers.facebook.com/docs/reference/api/user/
	 *
	 * @see FacebookOAuthService::fetchAttributes()
	 */
	protected function fetchAttributes() {
		$this->attributes = (array)$this->makeSignedRequest('https://graph.facebook.com/v2.5/me', array(
			'query' => array(
				'fields' => join(',', array(
					'name',
                    'link',
					'email',
					'first_name',
					'last_name',
                    'picture.width(290).height(290)',
				))
			)
		));

        $this->attributes['network'] = 'facebook';
        $this->attributes['avatar'] = @$this->attributes['picture']->data->url;
	}
}

<?php

namespace yedincisenol\UserProviderTwitter;

use Illuminate\Contracts\Validation\Rule;

class TwitterTokenValidationRule implements Rule
{

    public function passes($attribute, $value)
    {
        return $this->validate($value);
    }

    private function validate($accessToken)
    {
        @list($access_token, $access_token_secret) = explode('|', $accessToken);
        $twitter = new Twitter([
            'consumer_key'      =>  config('twitter.consumer_key'),
            'consumer_secret'   =>  config('twitter.consumer_secret'),
            'oauth_token'       =>  $access_token,
            'oauth_token_secret'=>  $access_token_secret
        ]);

        try {
            $twitter->get('account/verify_credentials');
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function message()
    {
        return ':attribute is invalid or scopes are not match!';
    }
}
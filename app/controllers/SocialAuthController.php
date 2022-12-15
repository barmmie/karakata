<?php

/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 11/8/15
 * Time: 11:55 PM
 */
class SocialAuthController extends BaseController
{

    public function loginWithFacebook()
    {

        $code = Input::get('code');

        $fb = OAuth::consumer('Facebook');

        // check if code is valid

        // if code is provided get user data and sign in
        if (!empty($code)) {

            $token = $fb->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($fb->request('/me?fields=id,name,first_name,last_name,gender,birthday,email,picture.type(large),location,religion'),
                true);
            if (array_key_exists('name', $result)) {
                $email_confirmation_required = Setting::get('require_email_confirmation');

                try {
                    $user = User::where('email', $result['email'])
                        ->orWhere('facebook_oauth_id', $result['id'])
                        ->firstOrFail();

                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

                    Setting::set('require_email_confirmation', '0');
                    $user = User::register($result['name'], $result['email'], str_random(), 'N/A');
                    Setting::set('require_email_confirmation', $email_confirmation_required);
                }

                $user->facebook_oauth_id = $result['id'];
                $user->save();

                Auth::login($user, true);
                flashSuccess(trans('phrases.authentication_successful'));

                return Redirect::route('pages.homepage');
            } else {
                flashError(trans('phrases.authentication_error'));

                return Redirect::route('pages.homepage');

            }


        } // if not ask for permission first
        else {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
            return Redirect::to((string)$url);
        }

    }

    public function loginWithGoogle()
    {
        $code = Input::get('code');
        OAuth::setHttpClient('CurlClient');

        $googleService = OAuth::consumer('Google');

        if (!empty($code)) {

            $token = $googleService->requestAccessToken($code);

            $result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);
            if (array_key_exists('name', $result)) {

                $email_confirmation_required = Setting::get('require_email_confirmation');

                try {
                    $user = User::where('email', $result['email'])
                        ->orWhere('google_oauth_id', $result['id'])
                        ->firstOrFail();


                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

                    Setting::set('require_email_confirmation', '0');
                    $user = User::register($result['name'], $result['email'], str_random(), 'N/A');

                    Setting::set('require_email_confirmation', $email_confirmation_required);
                }

                $user->google_oauth_id = $result['id'];
                $user->save();

                Auth::login($user, true);
                flashSuccess(trans('phrases.authentication_successful'));

                return Redirect::route('pages.homepage');

            } else {
                flashError(trans('phrases.authentication_error'));


                return Redirect::route('pages.homepage');

            }

        } // if not ask for permission first
        else {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();

            // return to google login url
            return Redirect::to((string)$url);
        }
    }
}
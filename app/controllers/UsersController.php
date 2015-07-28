<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
        $user = $this->execute('Enclassified\User\Command\RegisterUserCommand');

        flashSuccess('Registration successful', "A confirmation email has been sent to {$user->email}. You need to click the link in the message to activate your account");

        return Redirect::route('pages.homepage');

	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @return Response
	 */
	public function edit()
	{
        $user = Auth::user();
		return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @return Response
	 */
	public function update()
	{
        $result = $this->execute('Enclassified\User\Command\UpdateProfileCommand');

        if($result['success']) {
            flashSuccess('Update Successful', $result['message']);
            return Redirect::route('dash.myitems');
        } else {
            flashError('Operation failed', $result['message']);
            return Redirect::back()
                ->withInput()
                ->withErrors();
        }
	}

    public function updatePassword()
    {
        $result = $this->execute('Enclassified\User\Command\UpdatePasswordCommand');

        if($result['success']) {
            flashSuccess('Password update Successful', $result['message']);
            return Redirect::route('dash.myitems');
        } else {
            flashError('Operation failed', $result['message']);
            return Redirect::back()
                ->withInput()
                ;
        }
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function confirm($token)
    {

        try {
            $user = User::where('confirmation_token', $token)->firstOrFail();
            $user->confirmEmail();
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            flashError('Invalid verification link.', 'The link you clicked has either expired or is invalid.');
            return Redirect::route('pages.homepage');
        }


        flashSuccess('Verification successful', "{$user->full_name}, You can proceed to login");

        return Redirect::route('pages.homepage');
    }

}
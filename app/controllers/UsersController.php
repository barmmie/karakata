<?php

class UsersController extends \BaseController
{

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
        $user = $this->execute('Karakata\User\Command\RegisterUserCommand');

        flashSuccess(trans('phrases.registration_successful'),
            trans( 'phrases.confirmation_email_sent', ['email' => $user->email]));

        return Redirect::route('pages.homepage');

    }

    /**
     * Display the specified resource.
     * GET /users/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $items = $user->items()->approved();

        $items = $items->with('location', 'picture', 'category');

        $item_count = $items->count();

        $items = $items->paginate(10);

        return View::make('users.show', compact('user', 'items', 'item_count'));
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
        $result = $this->execute('Karakata\User\Command\UpdateProfileCommand');

        if ($result['success']) {
            flashSuccess(trans('phrases.update_successful'), $result['message']);

            return Redirect::route('dash.myitems');
        } else {
            flashError(trans('phrases.operation_failed'), $result['message']);

            return Redirect::back()
                ->withInput()
                ->withErrors();
        }
    }

    public function updatePassword()
    {
        $result = $this->execute('Karakata\User\Command\UpdatePasswordCommand');

        if ($result['success']) {
            flashSuccess(trans('phrases.password_update_successful'), $result['message']);

            return Redirect::route('dash.myitems');
        } else {
            flashError(trans('phrases.operation_failed'), $result['message']);

            return Redirect::back()
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /users/{id}
     *
     * @param  int $id
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
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            flashError(trans('phrases.invalid_verification_link'), trans('phrases.expired_link'));

            return Redirect::route('pages.homepage');
        }


        flashSuccess(trans('phrases.verification_successful'), trans('phrases.proceed_to_login', ['name' => $user->full_name]));

        return Redirect::route('pages.homepage');
    }


}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     * @throws ValidationException
     */
    public function register_employer(Request $request)
    {
        $this->employer_validator($request->all())->validate();

        try {
            event(new Registered($user = $this->create_employer($request)));
        } catch (ModelNotFoundException $e) {
            $request->session()->flash('status', __('Registration failed. Contact the administrator.'));
            Log::error($e->getMessage() . ' Do you seeded database?');
            return redirect(route('register'));
        }

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirect_employer());
    }

    /**
     * Get a validator for an incoming employer registration request.
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function employer_validator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'max:191'],
            'company-name' => ['required', 'string', 'max:191'],
            'company-size' => ['required', 'integer'],
            'company-website' => ['required', 'url'],
        ]);
    }

    /**
     * Create a new user instance with employer profile after a valid registration.
     *
     * @param Request $request
     * @return User
     * @throws ModelNotFoundException
     */
    protected function create_employer(Request $request): User
    {
        $data = $request->all();
        $user = User::createWithRole([
            'name' => Str::slug($data['company-name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'employer'
        ]);
        if (null !== $user && null !== $user->profile()) {
            $user->profile()->create([
                'name' => $data['company-name'],
                'size' => $data['company-size'],
                'website' => $data['company-website']
            ]);
            return $user;
        }
        throw new ModelNotFoundException('Profile wasn\'t attached to user or user doesn\'t exists.', 2137);
    }

    /**
     * Additional work after registration.
     *
     * @param Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered(Request $request, User $user)
    {
        $request->session()->flash('status', __('Hello :name, you has been successfully registered.', ['name' => $user->profile->name]));
    }

    /**
     * Return route to redirect after successful registration of employer
     */
    public function redirect_employer()
    {
        return route('home');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     * @throws ValidationException
     */
    public function register_client(Request $request)
    {
        $this->client_validator($request->all())->validate();

        try {
            event(new Registered($user = $this->create_client($request)));
        } catch (ModelNotFoundException $e) {
            $request->session()->flash('status', __('Registration failed. Contact the administrator.'));
            Log::error($e->getMessage() . ' Do you seeded database?');
            return redirect(route('register'));
        }

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirect_client());
    }

    /**
     * Get a validator for an incoming client registration request.
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function client_validator(array $data): \Illuminate\Validation\Validator
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'max:191'],
            'name' => ['required', 'string', 'max:191'],
            'links' => ['required', 'string'],
            'file' => ['required', 'file', 'mimetypes:application/pdf'],
        ]);
    }

    /**
     * Create a new user instance with client profile after a valid registration.
     *
     * @param Request $request
     * @return User
     * @throws ModelNotFoundException
     */
    protected function create_client(Request $request): User
    {
        $data = $request->all();
        $user = User::createWithRole([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'client'
        ]);
        if (null !== $user && null !== $user->profile()) {
            $user->profile()->create([
                'name' => $data['name'],
                'links' => $data['links'],
                'file' => $data['file']
            ]);
            $user->profile->setFile($request);
            return $user;
        }
        throw new ModelNotFoundException('Profile wasn\'t attached to user or user doesn\'t exists.', 2137);
    }

    /**
     * Return route to redirect after successful registration of client
     */
    public function redirect_client()
    {
        return route('home');
    }
}

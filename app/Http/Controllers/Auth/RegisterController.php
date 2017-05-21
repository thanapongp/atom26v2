<?php

namespace Atom26\Http\Controllers\Auth;

use Atom26\User;
use Atom26\Sports\Sport;
use Illuminate\Http\Request;
use Atom26\Accounts\Department;
use Atom26\Accounts\University;
use Illuminate\Validation\Rule;
use Atom26\Http\Controllers\Controller;
use Atom26\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/register-completed';

    /**
     * An instance of UserRepository.
     * 
     * @var \Atom26\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Atom26\Repositories\UserRepository $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('guest');

        $this->userRepository = $userRepository;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $universities = University::all();
        $departments = Department::all();
        $sports = Sport::all();

        return view('auth.register', compact('universities', 'departments', 'sports'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        return redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'gender' => 'required|in:ชาย,หญิง',
            'title' => 'required',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birthdate' => 'required|date',
            'citizen_id' => 'required|numeric',
            'student_id' => 'nullable|numeric',
            'tel' => 'required',
            'tel_alt' => 'nullable',

            'user_type_id' => 'required|exists:user_types,id',
            'department_id' => 'nullable|exists:departments,id',
            'university_id' => 'required|exists:universities,id',
            'pic' => 'required|file|image|max:5000',

            'username' => 'required|alpha_dash|unique:users',
            'password' => 'required|min:6|max:20|confirmed',
            'email' => 'required|email|max:255|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return void
     */
    protected function create(array $data)
    {
        $this->userRepository->register($data);
    }
}

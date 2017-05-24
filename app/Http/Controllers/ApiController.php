<?php

namespace Atom26\Http\Controllers;

use Illuminate\Http\Request;
use Atom26\Repositories\UserRepository;

class ApiController extends Controller
{
    /**
     * Instance of UserRepository
     * 
     * @var \Atom26\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * Create new instance of ApiController.
     * 
     * @param \Atom26\Repositories\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * * Get all athletes by University ID and Sport ID.
     * 
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getAthletes(Request $request)
    {
        return $this->userRepository->getAthletes($request->uni_id, $request->sport_id);
    }
}

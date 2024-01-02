<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class for storing user info from extracted input
 */
class UserInfo
{
    public string $name;
    public int $age;
    public string $city;

    public function __construct(string $name, int $age, string $city)
    {
        $this->name = $name;
        $this->age = $age;
        $this->city = $city;
    }

    public static function getUserInfo(string $input): UserInfo
    {
        $allInput = strtoupper($input);

        // remove any 'TAHUN', 'THN', 'TH' from the input
        $allInput = str_ireplace(['TAHUN', 'THN', 'TH'], '', $allInput);

        // find the age
        $ageIndex = 0;
        $allInput = explode(' ', $allInput);
        foreach ($allInput as $key => $value) {
            if (is_numeric($value)) {
                $ageIndex = $key;
                break;
            }
        }
        $age = $allInput[$ageIndex];

        // get name and city
        $name = implode(' ', array_slice($allInput, 0, $ageIndex));
        $city = implode(' ', array_slice($allInput, $ageIndex + 1, count($allInput)));

        return new UserInfo($name, $age, $city);
    }
}

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $allInput = request()->input;
        $userInfo = UserInfo::getUserInfo($allInput);

        User::create([
            'name' => $userInfo->name,
            'age' => $userInfo->age,
            'city' => $userInfo->city,
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

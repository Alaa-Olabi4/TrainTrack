<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetMail;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{

    // Start Authorization
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::findOrFail(auth()->user()->id);
            $token = $user->createToken('auth_token')->plainTextToken;

            $user->section;
            $user->role;

            return response()->json([
                'message' => 'Logged in successfully ',
                'token' => $token,
                'user' => $user,
            ], 200);
        }

        return response()->json([
            'message' => 'Incorrect login credentials'
        ], 401);
    }
    public function profile()
    {
        $user = User::findOrFail(auth()->user()->id);
        return $user;
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout successfully '
        ], 200);
    }
    // End Authorrization




    // Start Forget Password

    public function forget_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Always return success to prevent email enumeration
            return response()->json([
                "status" => 200,
                "message" => "If email exists, code will be sent",
            ]);
        }

        $code = rand(11111, 99999);
        $user->update([
            'code' => $code,
        ]);

        Mail::to($user->email)->send(new ForgetMail($code));

        return response()->json([
            "status" => 200,
            "message" => "Code sent successfully",
        ]);
    }

    public function check_forget_code(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:5'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->code != $request->code) {
            return response()->json([
                "status" => 401,
                "message" => "Invalid code or email",
            ]);
        }

        return response()->json([
            "status" => 200,
            "message" => "Code is valid",
        ]);
    }
    public function reset_password(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "code" => "required|digits:5",
            "password" => "required|confirmed|min:8",
        ]);

        $user = User::where('email', $request->email)->first();

        if (
            !$user ||
            $user->code != $request->code
        ) {
            return response()->json([
                "status" => 401,
                "message" => "Invalid request",
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'code' => null,
        ]);

        return response()->json([
            "status" => 200,
            "message" => "Password updated successfully",
        ]);
    }
    // End Forget Password


    // Start Users for admin




    // Users :
    public function index()
    {
        return User::all();
    }
    public function blockedUsers()
    {
        return User::where('status', false)->get();
    }
    public function userRoles($role_id)
    {
        return User::where('role_id', $role_id)->get();
    }
    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'section_id' => 'nullable|integer|max:10|exists:sections,id',
            'role_id' => 'required|integer|in:2,3,4,5',
            'delegation_id' => ['integer', 'exists:users,id'],
            'image' => ['image']
        ]);

        if ($request->image) {
            $photo = $request->image;
            $photoName = time() . $photo->getClientOriginalName();
            $photo->move('uploads/users', $photoName);
            $request->merge(['img_url' => 'uploads/users/' . $photoName]);
        }

        if ($request['role_id'] != 3) {
            $request['delegation_id'] = null;
        }

        $request['password'] = Hash::make($request['password']);
        $request['status'] = 1;

        $user = User::Create($request->all());

        // $user = User::create([
        //     'name' => $validatedData['name'],
        //     'email' => $validatedData['email'],
        //     'password' => Hash::make($request['password']),
        //     'role_id' => $validatedData['role_id'],
        //     'section_key' => $validatedData['section_key'] ?? null,
        // ]);

        // $user->update(['status' => 1]);

        return response()->json([
            'message' => 'User added successfully!',
            'user' => $user
        ], 201);
    }
    public function block(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'status' => ['required', 'boolean']
        ]);

        $user = User::findOrFail($request['user_id']);
        if ($user->status == $request['status']) {
            if ($request['status'] == true) return response()->json(['message' => 'user is already active !'], 400);
            if ($request['status'] == false) return response()->json(['message' => 'user is already blocked !'], 400);
        }
        $user->update(['status' => $request['status']]);
        if ($request['status'] == false) return response()->json(['message' => 'user has been blocked successfully !']);
        if ($request['status'] == true) return response()->json(['message' => 'user has been unblocked successfully !']);
    }
    public function changeRole(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'role_id' => ['required', 'numeric', 'exists:roles,id'],
        ]);

        User::findOrFail($request['user_id'])->update(['role_id' => $request['role_id']]);
        return response()->json(['message' => 'user\'s roles has been changed successfully!']);
    }
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['string'],
            'email' => ['email', Rule::unique('users')->ignore($id)],
            'position' => ['string'],
            'section_id' => ['numeric', 'exists:sections,id'],
            'password' => ['string', 'confirmed', 'min:8'],
            'image' => ['image'],
            'role_id' => ['integer','exists:roles,id'],
            'delegation_id' => ['integer', 'exists:users,id'],
        ]);

        $user = User::findOrFail($id);

        if ($request['delegation_id'] != null) {
            if ($user->role_id != 3) {
                return response()->json(['message' => 'Sorry ! the trainer only who can has a delegation , Thank you for your understanding !'], 400);
            }
            if(User::findOrFail($request['delegation_id'])->role_id != 3){
                return response()->json(['message' => 'Sorry! the delegation should onlu be a trainer !'],400);
            }

            $user->update(['delegation_id'=>$request['delegation_id']]);
            $categories = Category::where('owner_id', $user->id)->get();
            foreach ($categories as $cat) {
                $cat->update(['delegation_id' => $request['delegation_id']]);
            }
        }

        if ($request->image) {
            $photo = $request->image;
            $photoName = time() . $photo->getClientOriginalName();
            $photo->move('uploads/users', $photoName);
            $request->merge(['img_url' => 'uploads/products/' . $photoName]);
        }

        $user->update($request->all());
        return response()->json(['message' => 'user updated successfully !']);
    }
}

<?php

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\EmailVerification;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\EmailVerificationRepositoryInterface;
use Illuminate\Validation\ValidationException;


class AuthServices
{

    public function __construct(
        private UserRepositoryInterface $userRepo,
        private EmailVerificationRepositoryInterface $emailRepo,
        private TokenServices $tokenService
    ) {}

    public function registerUser($request): array
    {
        return DB::transaction(function () use ($request) {
            $user = $this->userRepo->create($request);
            $this->userRepo->assignRole($user, 'user');
            $this->emailRepo->sendCode($user);
            $data = $this->tokenService->createAuthTokens($user);
            $code = 200;
            $message = 'User created successfully!';
            return ['data' => $data, 'message' => $message, 'code' => $code];
        });
    }
    public function login($request): array
    {
        $user = $this->userRepo->findByEmail($request['email']);
        if (!$user || !Hash::check($request['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }
         $user->refresh();
         if (!$user->email_verified_at) {
            throw new \Exception('يجب تفعيل البريد الإلكتروني قبل تسجيل الدخول');
        }

        $data = $this->tokenService->createAuthTokens($user);
        $message = 'Login successful';
        $code = 200;
        return [
            'data' => $data,
            'message' => $message,
            'code' => $code
        ];
    }
    public function logout($user): array
    {
        $this->tokenService->revokeAllTokens($user);
        $data = [];
        $message = 'Logged out successfully';
        $code = 200;
        return [
            'data' => $data,
            'message' => $message,
            'code' => $code
        ];
    }
    public function refreshToken($request): array
    {
        $data = $this->tokenService->refreshTokens($request['refresh_token']);
        $message = 'Token refreshed successfully';
        $code = 200;
        return [
            'data' => $data,
            'message' => $message,
            'code' => $code
        ];
    }

        public function resendCode($email): array
    {
        $data = $this->emailRepo->resendCode($email);
        $message = 'Resend successfully';

        return [
            'data'    => $data,
            'message' => $message,
            'code'    => 200
        ];
    }

        public function verifyCode($request): array
    {
        $user = $this->userRepo->findByEmail($request['email']);

        if (!$user) {
            throw new \Exception('البريد الإلكتروني غير موجود');
        }

        $ok = $this->emailRepo->verify($user, $request['code']);

        if (!$ok) {
            throw new \Exception('رمز التحقق غير صالح أو منتهي');
        }
        $user->refresh(); 
        $message ='تم تفعيل الحساب بنجاح';
        return [
            'data'    => [],
            'message' => $message,
            'code'    => 200
        ];
    }







    // public function login($request)
    // {
    //     $user = User::query()->where('email', $request['email'])->first();
    //     if (!is_null($user)) {
    //         if (!Auth::attempt($request->only(['email', 'password']))) {
    //             $data = null;
    //             $message = 'User email & password does not match with our record';
    //             $code = 401;
    //         } else {
    //             if (isset($request['fcm_token'])) {
    //                 $user->update(['fcm_token' => $request['fcm_token']]);
    //             }

    //             if ($user->email_verified_at === null) {
    //                 return [
    //                     'user' => null,
    //                     'message' => 'يجب تفعيل البريد الإلكتروني الجديد قبل تسجيل الدخول.',
    //                     'code' => 403
    //                 ];
    //             }


    //             $user = $this->appendRolesAndPermissions($user);
    //             $user['token'] = $user->createToken("token")->plainTextToken;
    //             $data['token'] = $user['token'];
    //             $data['roles'] = $user['roles'];
    //             $notificationService = new NotificationService();
    //             $notificationService->send(
    //                 $user,
    //                 "تم تسجيل دخولك ",
    //                 "مرحباً {$user->first_name}،"
    //             );
    //             $message = 'User login successfully';
    //             $code = 200;
    //         }
    //     } else {
    //         $data = null;
    //         $message = 'User Email not found';
    //         $code = 404;
    //     }
    //     return ['user' => $data, 'message' => $message, 'code' => $code];
    // }

    // public function logout()
    // {
    //     $user = Auth::user();
    //     if (!is_null(Auth::user())) {
    //         Auth::user()->tokens()->delete();
    //         $message = 'ueser logout successfully';
    //         $code = 200;
    //     } else {
    //         $message = 'invaild token ';
    //         $code = 404;
    //     }
    //     return ['user' => $user, 'message' => $message, 'code' => $code];
    // }

    // public function details()
    // {
    //     return auth()->user();
    // }


    // private function appendRolesAndPermissions($user)
    // {
    //     $roles = [];
    //     foreach ($user->roles as $role) {
    //         $roles[] = $role->name;
    //     }
    //     unset($user['roles']);
    //     $user['roles'] = $roles;
    //     $permissions = [];
    //     foreach ($user->permissions as $permission) {
    //         $permissions[] = $permission->name;
    //     }
    //     unset($user['permissions']);
    //     $user['permissions'] = $permissions;

    //     return $user;
    // }
    // public function getUsersWithRoles(): array
    // {
    //     $data['users'] = null;
    //     if (Auth::user()->hasRole('SuperAdmin')) {
    //         $users = User::with('roles:id,name')->get();
    //         $data['users'] = $users->map(function ($user) {
    //             return [
    //                 'id' => $user->id,
    //                 'first_name' => $user->first_name,
    //                 'last_name' => $user->last_name,
    //                 'email' => $user->email,
    //                 'roles' => $user->roles->pluck('name')
    //             ];
    //         });
    //         return ['data' => $data, 'message' => 'succesfully!'];
    //     } else {
    //         return ['data' => $data, 'message' => 'Unauthorized access!'];
    //     }
    // }
}

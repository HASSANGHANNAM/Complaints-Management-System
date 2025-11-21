<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface

{
    public function __construct(private User $user) {}

    public function create(array $data): User
    {
        return $this->user->create([
            'FirstnameAr' => $data['FirstnameAr'],
            'FirstnameEn' => $data['FirstnameEn'] ?? null,
            'MiddlenameAr' => $data['MiddlenameAr'] ?? null,
            'MiddlenameEn' => $data['MiddlenameEn'] ?? null,
            'LastnameAr' => $data['LastnameAr'],
            'LastnameEn' => $data['LastnameEn'] ?? null,
            'BirthPlaceAr' => $data['BirthPlaceAr'],
            'BirthPlaceEn' => $data['BirthPlaceEn'] ?? null,
            'BirthDate' => $data['BirthDate'],
            'NationalNumber' => $data['NationalNumber'],
            'IdFrontFace' => $data['IdFrontFace'] ?? null,
            'IdBackFace' => $data['IdBackFace'] ?? null,
            'CurrentLocationAr' => $data['CurrentLocationAr'],
            'CurrentLocationEn' => $data['CurrentLocationEn'] ?? null,
            'ContactNumber' => $data['ContactNumber'],
            'Email' => $data['Email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function findByEmail(string $Email): ?User
    {
        return $this->user->where('Email', $Email)->first();
    }

    public function findById(int $id): ?User
    {
        return $this->user->find($id);
    }

    public function assignRole(User $user, string $roleName): void
    {
        $user->assignRole($roleName);
    }

    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }
    public function getProfile(User $user): array
    {
        return [
            'id' => $user->id,
            'first_name_ar' => $user->FirstnameAr,
            'first_name_en' => $user->FirstnameEn,
            'middle_name_ar' => $user->MiddlenameAr,
            'middle_name_en' => $user->MiddlenameEn,
            'last_name_ar' => $user->LastnameAr,
            'last_name_en' => $user->LastnameEn,
            'birth_place_ar' => $user->BirthPlaceAr,
            'birth_place_en' => $user->BirthPlaceEn,
            'birth_date' => $user->BirthDate,
            'national_number' => $user->NationalNumber,
            'current_location_ar' => $user->CurrentLocationAr,
            'current_location_en' => $user->CurrentLocationEn,
            'contact_number' => $user->ContactNumber,
            'email' => $user->Email,
            'id_front_url' => $user->IdFrontFace ? url("/api/users/{$user->id}/id-front") : null,
            'id_back_url' => $user->IdBackFace ? url("/api/users/{$user->id}/id-back") : null,
        ];
    }
}

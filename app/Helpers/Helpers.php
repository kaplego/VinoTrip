<?php

namespace App\Helpers;

use App\Models\Client;
use App\Models\User;
use Auth;
use Illuminate\Http\UploadedFile;
use Storage;

enum Role: int {
    case Client = 1;
    case ServiceMarketing = 2;
    case ServiceVente = 3;
    case Dirigeant = 4;
}

class Helpers {
    public static function AuthIsRole(Role $role) {
        return Auth::check() && Auth::user()->role->idrole == $role->value;
    }
    public static function IsRole(User|Client|null $user, Role $role) {
        return $user?->role?->idrole == $role->value;
    }

    public static function Upload(UploadedFile $file, string $filename, string $dirname) {
        try {
            $file->storeAs($dirname, $filename, 'public');

            if (!file_exists(public_path('storage'))) {
                Storage::link();
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

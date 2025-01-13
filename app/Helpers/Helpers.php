<?php

namespace App\Helpers;

use App\Models\Client;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\UploadedFile;
use Storage;

enum Role: int {
    case Client = 1;
    case ServiceVente = 2;
    case DPO = 3;
    case Dirigeant = 4;
}

class Helpers {
      public static function AuthIsRole(Role $role) {
        return Auth::check() && Helpers::IsRole(Auth::user(), $role);
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

    public static function ClientPhone(Client|User|Authenticatable $client) {
        return '+33'.substr($client->telephoneclient, 1);
    }
}

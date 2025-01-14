<?php

namespace App\Helpers;

use App\Models\Client;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\UploadedFile;
use Storage;

enum Role: int
{
    case Client = 1;
    case ServiceVente = 2;
    case DPO = 3;
    case Dirigeant = 4;
}

class Helpers
{
    public static function AuthIsRole(Role $role)
    {
        return Auth::check() && Helpers::IsRole(Auth::user(), $role);
    }
    public static function IsRole(User|Client|null $user, Role $role)
    {
        return $user?->role?->idrole == $role->value;
    }

    public static function Upload(UploadedFile $file, string $filename, string $dirname)
    {
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

    public static function ClientPhone(Client|User|Authenticatable $client)
    {
        return '+33' . substr($client->telephoneclient, 1);
    }

    public static function CreditCardEncrypt(string $data, string $crypto)
    {
        // Générer le "Vecteur d'Initialisation"
        $iv = random_bytes(12);

        // Chiffrer les données et générer le tag
        $encryptedData = openssl_encrypt(
            $data,
            'AES-256-GCM',
            $crypto,
            0,
            $iv,
            $tag,
        );

        // Renvoyer le Vecteur d'Initialisation, les données chiffrées et le tag en base64
        // Les trois variables sont nécéssaires au déchiffrement
        return base64_encode($iv) . '.' . base64_encode($encryptedData) . '.' . base64_encode($tag);
    }

    public static function CreditCardDecrypt(string $data, string $crypto)
    {
        // Séparer le Vecteur d'Initialisation, les données chiffrées et le tag
        $parts = explode('.', $data);

        // Vérifier qu'il y a bien les trois
        if (sizeof($parts) !== 3)
            throw new Exception('Invalid encrypted data format.');

        // Récupérer les trois parties
        $iv = base64_decode($parts[0]);
        $encryptedData = base64_decode($parts[1]);
        $tag = base64_decode($parts[2]);

        // Déchiffrer les données
        // Renvoie 'false' si les données ne peuvent pas être déchiffrées
        return openssl_decrypt(
            $encryptedData,
            'AES-256-GCM',
            $crypto,
            0,
            $iv,
            $tag,
        );
    }
}

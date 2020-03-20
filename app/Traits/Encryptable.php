<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait Encryptable
{
    public array $encryptedValues = [];

    private function addToEncryptedValues(string $key, string $value): void
    {
        $this->encryptedValues[$key] = $value;
    }

    public function getAttribute(string $key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable)) {
            $this->addToEncryptedValues($key, $value);
            $value = Crypt::decrypt($value);
        }

        return $value;
    }

    public function setAttribute(string $key, string $value)
    {
        if (in_array($key, $this->encryptable)) {
            $this->addToEncryptedValues($key, $value);
            $value = Crypt::encrypt($value);
        }

        return parent::setAttribute($key, $value);
    }
}

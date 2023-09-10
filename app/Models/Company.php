<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'fantasy_name',
        'company_name',
        'cnpj',
        'workers_number',
        'company_area',
        'description'
    ];
    
    public function address()
    {
        return $this->hasOne(CompanyAddress::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function isCnpjTaken($cnpj)
    {
        return $this->where('cnpj', $cnpj)->exists();
    }

    public function validateCNPJ($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
    
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
    
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;
    
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;
    
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;
    
        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

}

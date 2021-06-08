<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypoUser extends Typo
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'name',
    ];

    protected $table = 'fe_users';

    public $uidg_old = 0;
    public $uidg_count = 1;

    public function matchGroup($uidg)
    {
        if($this->uidg_old === $uidg){
            return TRUE;
        }

        $this->uidg_old = $uidg;

        return FALSE;
    }

}

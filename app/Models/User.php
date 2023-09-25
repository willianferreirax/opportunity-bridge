<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use HasUuids;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 
        'cpf', 
        'birth_date', 
        'is_pcd', 
        'email', 
        'password',
        'type',
        'company_id',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        // 'profile_photo_url',
    ];

    public static function validateCPF(string $cpf): bool{

        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    public function verifyCurriculumIsComplete(): bool{
       
        //verify has resume
        if(!$this->curriculumResume()->first()){

            if($this->hasCurriculum()){
                $this->steps()->update([
                    'hasCurriculum' => false,
                ]);
            }

            return false;
        }

        //verify has professional experiences
        if(!$this->curriculumProExperiences()->first()){

            if($this->hasCurriculum()){
                $this->steps()->update([
                    'hasCurriculum' => false,
                ]);
            }

            return false;
        }

        //verify has academic experiences
        if(!$this->curriculumAcadExperiences()->first()){

            if($this->hasCurriculum()){
                $this->steps()->update([
                    'hasCurriculum' => false,
                ]);
            }

            return false;
        }

        //verify has courses
        if(!$this->curriculumCourses()->first()){

            if($this->hasCurriculum()){
                $this->steps()->update([
                    'hasCurriculum' => false,
                ]);
            }

            return false;
        }

        //verify has languages
        if(!$this->curriculumLanguages()->first()){

            if($this->hasCurriculum()){
                $this->steps()->update([
                    'hasCurriculum' => false,
                ]);
            }

            return false;
        }

        //set curriculum as complete
        $this->steps()->update([
            'hasCurriculum' => true,
        ]);

        return true;

    }

    public static function existsByCpf(string $cpf): bool{
        $user = User::where('cpf', $cpf)->first();
        return $user ? true : false;
    }

    public static function existsByEmail(string $email): bool{
        $user = User::where('email', $email)->first();
        return $user ? true : false;
    }

    public static function isEmailTaken(string $email): bool{
        return self::existsByEmail($email);
    }

    public function hasCurriculum(): bool{
        return $this->steps()?->first()->hasCurriculum ?? false;
    }

    public function address(): HasOne{
        return $this->hasOne(UserAddress::class);
    }

    public function certificate(): HasOne{
        return $this->hasOne(Certificate::class);
    }

    public function contact(): HasOne{
        return $this->hasOne(UserContact::class);
    }

    public function personal(): HasOne{
        return $this->hasOne(UserPersonalData::class);
    }

    public function deficiences(){
        return $this->belongsToMany(Deficiency::class, 'user_deficiency')
            ->using(UserDeficiency::class);
    }

    public function steps(){
        return $this->hasOne(UserStep::class);
    }

    public function curriculumResume(){
        return $this->hasOne(CurriculumResume::class);
    }

    public function curriculumProExperiences(){
        return $this->hasMany(CurriculumProExperience::class);
    }

    public function curriculumCourses(){
        return $this->hasMany(CurriculumCourse::class);
    }

    public function curriculumLanguages(){
        return $this->hasMany(CurriculumLanguage::class);
    }

    public function curriculumAcadExperiences(){
        return $this->hasMany(CurriculumAcadExperience::class);
    }

    public function creativeCurriculums(){
        return $this->hasMany(CreativeCurriculum::class);
    }

    public function appliedOpportunities(){
        return $this->belongsToMany(Opportunity::class, 'opportunity_user')
            ->using(OpportunityUser::class)
            ->withPivot(['current_step', 'status'])
            ->withTimestamps()
        ;
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

}

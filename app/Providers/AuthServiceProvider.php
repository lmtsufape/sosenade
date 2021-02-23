<?php

namespace SimuladoENADE\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'SimuladoENADE\Model' => 'SimuladoENADE\Policies\ModelPolicy',
        \SimuladoENADE\Usuario::class=>\SimuladoENADE\Policies\UsuarioPolicy::class,
        \SimuladoENADE\Aluno::class=>\SimuladoENADE\Policies\AlunoPolicy::class,
        \SimuladoENADE\Instituicao::class=>\SimuladoENADE\Policies\InstituicaoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

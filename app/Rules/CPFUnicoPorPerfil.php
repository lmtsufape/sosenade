<?php

namespace SimuladoENADE\Rules;

use Illuminate\Contracts\Validation\Rule;
use SimuladoENADE\Usuario;

class CPFUnicoPorPerfil implements Rule
{
    protected $id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !Usuario::where([
            ['id', '!=', $this->id],
            ['tipousuario_id', Usuario::find($this->id)->tipousuario_id],
            ['cpf', $value]
        ])->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Já existe um usuário com o seu perfil para este CPF.';
    }
}

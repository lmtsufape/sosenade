<?php

namespace SimuladoENADE;

use Illuminate\Database\Eloquent\Model;

class FlashMessage extends Model
{
    public static function cadastroSuccess() {
        return 'Cadastro realizado com sucesso!';
    }

    public static function alteracoesSuccess() {
        return 'As alterações foram salvas!';
    }

    public static function senhaAlteradaSuccess() {
        return 'Senha alterada com sucesso!';
    }

    public static function removeUsuarioSuccess() {
        return 'Usuário removido com sucesso!';
    }

    public static function removeAlunoSuccess() {
        return 'Aluno removido com sucesso!';
    }

    public static function removeProfessorSuccess() {
        return 'Professor removido com sucesso!';
    }

    public static function removeInstituicaoSuccess($instituicao_nome) {
        return 'A instituição '.$instituicao_nome.' foi removida com sucesso!';
    }

    public static function removeInstituicaoFail($instituicao_nome) {
        return 'A instituição '.$instituicao_nome.' não pode ser removida! Remova as dependências (Unidades Academicas) vinculadas anteriormente!';
    }

    public static function removeUnidadeSuccess($unidade_nome) {
        return 'A unidade '.$unidade_nome.' foi removida com sucesso!';
    }

    public static function removeUnidadeFail($unidade_nome) {
        return 'A unidade '.$unidade_nome.' não pode ser removida! Remova as dependências (Cursos) vinculadas anteriormente!';
    }

    public static function removeCicloSuccess($ciclo_nome) {
        return 'O ciclo '.$ciclo_nome.' foi removido com sucesso!';
    }

    public static function removeCicloFail($ciclo_nome) {
        return 'O ciclo '.$ciclo_nome.' não pode ser removido! Remova as dependências (Cursos) vinculadas anteriormente!';
    }

    public static function removeCursoSuccess($curso_nome) {
        return 'O curso '.$curso_nome.' foi removido com sucesso!';
    }

    public static function removeCursoFail($curso_nome) {
        return 'O curso '.$curso_nome.' não pode ser removido! Remova as dependências (Usuarios / Alunos / Disciplinas) vinculadas anteriormente!';
    }

    public static function removeDisciplinaSuccess($disciplina_nome) {
        return 'A disciplina '.$disciplina_nome.' foi removida com sucesso!';;
    }

    public static function removeDisciplinaFail($disciplina_nome) {
        return 'A disciplina '.$disciplina_nome.' não pode ser removida! Remova as dependências (Questões) vinculadas anteriormente!';
    }

    public static function removeQuestaoSuccess() {
        return 'Questão removida com sucesso!';
    }

    public static function removeQuestaoFail() {
        return 'A questão não pode ser removida! Remova as dependências (Simulados) vinculadas anteriormente!';
    }

    public static function importAlunoSuccess($dados_duplicados) {
        return 'Alunos importados com sucesso! '.$dados_duplicados;
    }

    public static function importAlunoFail() {
        return 'Arquivo vazio! Verifique se existe registros de alunos no seu documento!';
    }

    public static function updateRespostaSuccess() {
        return 'Resposta salva com sucesso!';
    }
    /*
        \SimuladoENADE\FlashMessage::cadastroSuccess()
        \SimuladoENADE\FlashMessage::alteracoesSuccess()

        \SimuladoENADE\FlashMessage::senhaAlteradaSuccess()

        \SimuladoENADE\FlashMessage::removeUsuarioSuccess()
        \SimuladoENADE\FlashMessage::removeAlunoSuccess()
        \SimuladoENADE\FlashMessage::removeProfessorSuccess()

        \SimuladoENADE\FlashMessage::removeInstituicaoSuccess($instituicao_nome)
        \SimuladoENADE\FlashMessage::removeInstituicaoFail($instituicao_nome)

        \SimuladoENADE\FlashMessage::removeUnidadeSuccess($unidade_nome)
        \SimuladoENADE\FlashMessage::removeUnidadeFail($unidade_nome)

        \SimuladoENADE\FlashMessage::removeCicloSuccess($ciclo_nome)
        \SimuladoENADE\FlashMessage::removeCicloFail($ciclo_nome)

        \SimuladoENADE\FlashMessage::removeCursoSuccess($curso_nome)
        \SimuladoENADE\FlashMessage::removeCursoFail($curso_nome)

        \SimuladoENADE\FlashMessage::removeDisciplinaSuccess($disciplina_nome)
        \SimuladoENADE\FlashMessage::removeDisciplinaFail($disciplina_nome)

        \SimuladoENADE\FlashMessage::removeQuestaoSuccess()
        \SimuladoENADE\FlashMessage::removeQuestaoFail()

        \SimuladoENADE\FlashMessage::importAlunoSuccess($dados_duplicados)
        \SimuladoENADE\FlashMessage::importAlunoFail()

        \SimuladoENADE\FlashMessage::updateRespostaSuccess()

    */
}

<?php

namespace Domain\Usuario\Services;

use Domain\Usuario\DTO\UsuarioDTO;
use Domain\Usuario\Exceptions\UsuarioException;
use Domain\Usuario\Interfaces\IUsuario;

class UsuarioService
{
    public function __construct(private readonly IUsuario $usuarioRepository)
    {
    }

    public function cadastro(UsuarioDTO $usuarioDTO): UsuarioException|array {
        if (!empty($this->consultaEmailExistente($usuarioDTO->getEmailUsuario()))) return UsuarioException::emailExistente($usuarioDTO->getEmailUsuario());
        $usuarioDTO->setSenhaUsuario($this->criptografaSenha($usuarioDTO->getSenhaUsuario()));
        $email = $this->usuarioRepository->cadastro($usuarioDTO);
        $codigo = $this->gerarCodigoVerificacao($email);
        return [
            'email' => $email,
            'codigo_verificacao' => $codigo
        ];
    }

    /**
     * @throws UsuarioException
     */
    public function validaCodigoVerificacao(string $hash, int $cod): bool|UsuarioException {
        $usuario = $this->consultaEmailExistente(base64_decode($hash));
        if($usuario['codigo_verificacao'] != $cod) {
            return UsuarioException::codigoDifereDoEmail();
        }
        $this->atualizaStatusVerificado($usuario['usuario_email'], 'S');
        return true;

    }

    public function consultaEmailExistente(string $email): string|array {
        return $this->usuarioRepository->queryUsuarioPorEmail($email);
    }

    private function criptografaSenha(string $senha): string {
        return password_hash($senha, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    private function gerarCodigoVerificacao(string $email): int {
        $usuario = $this->consultaEmailExistente($email);
        $codigo = mt_rand(100000, 999999);

        $this->usuarioRepository->adicionaCodigoDeVerificacao($codigo, $email);

        return $codigo;
    }

    private function atualizaStatusVerificado(string $email, string $verificado): void {
        $this->usuarioRepository->atualizaStatusVerificado($email, $verificado);
    }
}
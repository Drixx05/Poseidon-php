<?php

class User
{
    private string $pseudo;
    private string $email;
    private string $password;
    private string $role;

    public function __construct(
        string $pseudo,
        string $email,
        string $password,
        string $role = "user"
    ) {
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getPseudo(): string
    {
     return $this->pseudo;
    }

    public function getEmail(): string
    {
     return $this->email;
    }

    public function getPassword(): string
    {
     return $this->password;
    }

    public function getRole(): string
    {
      return $this->role;
    }
}
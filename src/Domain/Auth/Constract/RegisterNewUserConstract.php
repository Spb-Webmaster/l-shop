<?php

namespace Domain\Auth\Constract;

interface RegisterNewUserConstract
{
    public function __invoke(string $name, string $email, string  $password);
}

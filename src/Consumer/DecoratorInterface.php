<?php

namespace pavlomr\Service\Consumer;

interface DecoratorInterface
{
    public function getAuth(): array;

    /**
     * @param $auth
     *
     * @return $this
     */
    public function setAuth($auth): static;

    public function getPath(): string;

    /**
     * @param string $path
     *
     * @return $this
     */
    public function setPath(string $path): static;

    public function getBase(): string;

    /**
     * @param string $base
     *
     * @return $this
     */
    public function setBase(string $base): static;
}

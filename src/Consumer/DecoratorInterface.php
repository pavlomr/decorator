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
    public function setAuth($auth): DecoratorInterface;

    public function getPath(): string;

    /**
     * @param string $path
     * @return $this
     */
    public function setPath(string $path): DecoratorInterface;

    public function getBase(): string;

    /**
     * @param string $base
     * @return $this
     */
    public function setBase(string $base): DecoratorInterface;
}

<?php

namespace pavlomr\Service;

trait SingletonTrait
{
    /**
     * @var static[]
     */
    private static array $_map = [];

    /**
     * @return static
     */
    public static function getInstance(): static
    {
        if (!isset(self::$_map[static::class])) {
            self::$_map[static::class] = new static();
        }

        return self::$_map[static::class];
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        return static::getInstance()->$name(...$arguments);
    }

}

<?php

namespace pavlomr\Service;

use Exception;
use ReflectionClass;

use function curl_version;

trait UserAgentTrait
{
    protected function userAgent(string $internal = ''): string
    {
        $parentsChain = [];
        try {
            $parent          = $reflection = new ReflectionClass(static::class);
            $callerClass     = $reflection->getShortName();
            $callerNamespace = $reflection->getNamespaceName();
            while ($parent = $parent->getParentClass()) {
                $parentsChain[] = $parent->getShortName();
            }
        } catch (Exception) {
            $callerClass     = $callerClass ?? 'UnknownCaller';
            $callerNamespace = $callerNamespace ?? __NAMESPACE__;
        }

        return trim(
            sprintf(
                '%s/%s/%s-%s (%s) %s %s',
                explode('\\', $callerNamespace)[0],
                $callerClass,
                $this->_callerVersionMajor(),
                $this->_callerVersionMinor(),
                $this->_callerApplication(),
                implode(' ', $parentsChain),
                $this->_callerExposeInternals() ? sprintf(
                    '%s PHP/%s curl/%s',
                    $internal,
                    PHP_VERSION,
                    curl_version()['version']
                ) : ''
            )
        );
    }

    /**
     * @return string
     */
    protected function _callerVersionMajor(): string
    {
        return $_SERVER['TIER'] ?? 'dev';
    }

    /**
     * @return string
     */
    protected function _callerVersionMinor(): string
    {
        return $_SERVER['TAG'] ?? '*';
    }

    /**
     * @return string
     */
    protected function _callerApplication(): string
    {
        return $_SERVER['APP'] ?? pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_BASENAME);
    }

    /**
     * Does decorator exposes internals
     * @return bool
     */
    protected function _callerExposeInternals(): bool
    {
        return defined('static::EXPOSE_INTERNALS') ? constant('static::EXPOSE_INTERNALS') : true;
    }
}


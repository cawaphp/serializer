<?php

/*
 * This file is part of the Сáша framework.
 *
 * (c) tchiotludo <http://github.com/tchiotludo>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Cawa\Serializer;

abstract class Json
{
    /**
     * @param string $json
     * @param bool $assoc
     *
     * @return mixed
     */
    public static function decode(string $json, bool $assoc = true)
    {
        $decoded = json_decode($json, $assoc);

        if ((unset) $decoded === $decoded) {
            throw new \InvalidArgumentException(sprintf(
                "Json decode failed (%s) with '%s' and data '%s'",
                json_last_error(),
                json_last_error_msg(),
                strlen($json) > 50 ? substr($json, 0, 150) . '...' : $json
            ));
        }

        return $decoded;
    }

    /**
     * @param mixed $value
     * @param int $options
     *
     * @return string
     */
    public static function encode($value, int $options = null) : string
    {
        if ($options) {
            $encoded = json_encode($value, $options);
        } else {
            $encoded = json_encode($value);
        }

        if (!is_string($encoded)) {
            throw new \InvalidArgumentException(sprintf(
                "Json encode failed (%s) with '%s' and type '%s'",
                json_last_error(),
                json_last_error_msg(),
                gettype($encoded)
            ));
        }

        return $encoded;
    }
}

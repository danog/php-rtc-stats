<?php

/**
 * This file is part of the PHP WebRTC package.
 *
 * (c) Amin Yazdanpanah <https://www.aminyazdanpanah.com/#contact>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webrtc\Stats;

use DateTimeImmutable;
use Error;
use Webrtc\Mixin\DataClass;
use Webrtc\Stats\enum\StatType;

/**
 * Base class for statistics.
 *
 * Some stats are created for every RTCP report: their time is only read with microtime(), and the
 * DateTimeImmutable of {@see self::$dateTime} only created when it's read.
 */
#[DataClass]
class RTCStats
{
    /** The time of the stats, in milliseconds since the Unix epoch (as the DOMHighResTimeStamp of WebRTC's). */
    public float $timestamp;

    /**
     * The time of the stats, created from {@see self::$timestamp} when it's first read.
     *
     * @psalm-suppress PropertyNotSetInConstructor Unset in the constructor: created by __get().
     */
    public DateTimeImmutable $dateTime;

    /**
     * @param string $id The id associated with this stat.
     * @param StatType $type The type of the stat.
     * @param DateTimeImmutable|null $dateTime The timestamp associated with this object (now, if null).
     */
    public function __construct(
        public string $id,
        public StatType $type,
        ?DateTimeImmutable $dateTime = null
    )
    {
        if ($dateTime === null) {
            $this->timestamp = microtime(true) * 1000.0;
            unset($this->dateTime);
        } else {
            $this->timestamp = (float) $dateTime->format('U.u') * 1000.0;
            $this->dateTime = $dateTime;
        }
    }

    public function __get(string $name): mixed
    {
        if ($name !== 'dateTime') {
            throw new Error('Undefined property: '.static::class.'::$'.$name);
        }
        $dateTime = DateTimeImmutable::createFromFormat('U.u', \sprintf('%.6F', $this->timestamp / 1000.0));
        if ($dateTime === false) {
            throw new Error('Invalid stats timestamp!');
        }
        return $this->dateTime = $dateTime;
    }

    public function __wakeup(): void
    {
        /** @psalm-suppress RedundantPropertyInitializationCheck It may be unset. */
        if (!isset($this->dateTime)) {
            // Uninitialized again: created when read.
            unset($this->dateTime);
        }
    }
}

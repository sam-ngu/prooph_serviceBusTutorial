<?php
/**
 * This file is part of the prooph/service-bus.
 * (c) 2014-2017 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2017 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\ServiceBus\Exception;

class EventListenerException extends MessageDispatchException
{
    /**
     * @var \Throwable[]
     */
    private $exceptionCollection;

    public static function collected(\Throwable ...$exceptions): self
    {
        $msgs = '';

        foreach ($exceptions as $exception) {
            $msgs .= $exception->getMessage() . "\n";
        }

        $self = new self("At least one event listener caused an exception. Check listener exceptions for details:\n$msgs");

        $self->exceptionCollection = $exceptions;

        return $self;
    }

    /**
     * @return \Throwable[]
     */
    public function listenerExceptions(): array
    {
        return $this->exceptionCollection;
    }
}

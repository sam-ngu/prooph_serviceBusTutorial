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

namespace Prooph\ServiceBus\Plugin\Guard;

interface AuthorizationService
{
    /**
     * Check if the permission is granted to the current identity
     *
     * @param string $messageName
     * @param mixed  $context
     *
     * @return bool
     */
    public function isGranted(string $messageName, $context = null): bool;
}

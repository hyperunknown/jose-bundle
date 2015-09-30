<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace SpomkyLabs\TestJoseBundle;

use SpomkyLabs\TestJoseBundle\DependencyInjection\TestExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class TestJoseBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new TestExtension('sl_jose_test');
    }
}

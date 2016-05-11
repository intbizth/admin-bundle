<?php

namespace Intbizth\Bundle\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IntbizthAdminBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SyliusUiBundle';
    }
}

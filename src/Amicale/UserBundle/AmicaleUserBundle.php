<?php

namespace Amicale\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AmicaleUserBundle extends Bundle {

    public function getParent() {
        return 'FOSUserBundle';
    }

}

<?php

namespace Composers;

use Kernel\AbstractComposer;

class SliderComposer extends AbstractComposer
{
    public function compose(): object {
        return (object) [
            'slider' => 'TEST'
        ];
    }
}
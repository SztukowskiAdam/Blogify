<?php

namespace Composers;

use Kernel\AbstractComposer;
use Models\Article;
use Models\Settings;

class StylesComposer extends AbstractComposer
{
    public function compose(): object {
        $settings = new Settings();
        $colors = $settings->find(1);
        return (object) [
            'settings' => $colors,
        ];
    }
}
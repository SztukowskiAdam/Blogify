<?php

namespace Composers;

use Kernel\AbstractComposer;
use Models\Article;

class SliderComposer extends AbstractComposer
{
    public function compose(): object {
        $article = new Article();
        return (object) [
            'slider' => $article->where('inSlider', '=', 1, 'createdAt', 'DESC'),
        ];
    }
}
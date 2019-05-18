<?php

namespace Composers;

use Kernel\AbstractComposer;
use Models\Article;

class SliderComposer extends AbstractComposer
{
    public function compose(): object {
        $article = new Article();
        $params = [
            'inSlider' => 1,
            'status' => 2,
        ];
        return (object) [
            'slider' => $article->whereData($params),
        ];
    }
}
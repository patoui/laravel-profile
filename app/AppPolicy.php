<?php

declare(strict_types=1);

namespace App;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policies\Basic;

class AppPolicy extends Basic
{
    public function configure()
    {
        parent::configure();

        $this->addDirective(Directive::STYLE, [
            Keyword::SELF,
            'https://use.fontawesome.com/releases/v5.8.1/css/all.css',
        ])->addDirective(Directive::SCRIPT, [
             Keyword::SELF,
             'https://cdn.jsdelivr.net',
         ]);
    }
}
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
            'use.fontawesome.com',
        ])->addDirective(Directive::SCRIPT, [
             Keyword::SELF,
             'cdn.jsdelivr.net',
             'unsafe-inline',
         ])->addDirective(Directive::FONT, [
             Keyword::SELF,
             'use.fontawesome.com',
        ]);
    }
}
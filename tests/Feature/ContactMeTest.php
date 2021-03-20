<?php

namespace Tests\Feature;

use App\Mail\ContactMe;
use Tests\TestCase;
use Illuminate\Mail\Mailable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactMeTest extends TestCase
{
    public function testBuild(): void
    {
        $contactMeMailable = new ContactMe(
            'John Doe',
            'john.doe@gmail.com',
            '9059220633',
            'Hey just wanted to chat'
        );

        $result = $contactMeMailable->build();

        self::assertInstanceOf(Mailable::class, $result);
    }
}

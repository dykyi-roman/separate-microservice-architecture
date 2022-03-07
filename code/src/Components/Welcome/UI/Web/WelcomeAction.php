<?php

declare(strict_types=1);

namespace Travel\Components\Welcome\UI\Web;

use Symfony\Component\HttpFoundation\Response;

final class WelcomeAction
{
    public function __invoke(): Response
    {
        return new Response(
            '<head>
                        <title>Welcome</title>
                        <style>.ascii-art { font-family: monospace; white-space: pre; }</style>
                    </head>
                    <body>
                        <div class="ascii-art">
                        Welcome page
<body></div>'
        );
    }
}

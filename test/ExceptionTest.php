<?php

/**
 * @see       https://github.com/mezzio/mezzio-template for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-template/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-template/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace MezzioTest\Template;

use Generator;
use Mezzio\Template\Exception\ExceptionInterface;
use PHPUnit\Framework\TestCase;

use function basename;
use function glob;
use function is_a;
use function strrpos;
use function substr;

class ExceptionTest extends TestCase
{
    public function exception() : Generator
    {
        $namespace = substr(ExceptionInterface::class, 0, strrpos(ExceptionInterface::class, '\\') + 1);

        $exceptions = glob(__DIR__ . '/../src/Exception/*.php');
        foreach ($exceptions as $exception) {
            $class = substr(basename($exception), 0, -4);

            yield $class => [$namespace . $class];
        }
    }

    /**
     * @dataProvider exception
     */
    public function testExceptionIsInstanceOfExceptionInterface(string $exception) : void
    {
        self::assertContains('Exception', $exception);
        self::assertTrue(is_a($exception, ExceptionInterface::class, true));
    }
}

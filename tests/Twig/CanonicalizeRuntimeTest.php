<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\Form\Tests\Twig;

use PHPUnit\Framework\TestCase;
use Sonata\Form\Twig\CanonicalizeRuntime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class CanonicalizeRuntimeTest extends TestCase
{
    private Request $request;

    private CanonicalizeRuntime $canonicalizeRuntime;

    protected function setUp(): void
    {
        $this->request = new Request();
        $requestStack = new RequestStack();
        $requestStack->push($this->request);
        $this->canonicalizeRuntime = new CanonicalizeRuntime($requestStack);
    }

    /**
     * @dataProvider momentLocalesProvider
     */
    public function testCanonicalizedLocaleForMoment(?string $expected, string $original): void
    {
        $this->changeLocale($original);
        static::assertSame($expected, $this->canonicalizeRuntime->getCanonicalizedLocaleForMoment());
    }

    /**
     * @return array<array{?string, string}>
     */
    public function momentLocalesProvider(): array
    {
        return [
            ['af', 'af'],
            ['ar-dz', 'ar-dz'],
            ['ar', 'ar'],
            ['ar-ly', 'ar-ly'],
            ['ar-ma', 'ar-ma'],
            ['ar-sa', 'ar-sa'],
            ['ar-tn', 'ar-tn'],
            ['az', 'az'],
            ['be', 'be'],
            ['bg', 'bg'],
            ['bn', 'bn'],
            ['bo', 'bo'],
            ['br', 'br'],
            ['bs', 'bs'],
            ['ca', 'ca'],
            ['cs', 'cs'],
            ['cv', 'cv'],
            ['cy', 'cy'],
            ['da', 'da'],
            ['de-at', 'de-at'],
            ['de', 'de'],
            ['de', 'de-de'],
            ['dv', 'dv'],
            ['el', 'el'],
            [null, 'en'],
            [null, 'en-us'],
            ['en-au', 'en-au'],
            ['en-ca', 'en-ca'],
            ['en-gb', 'en-gb'],
            ['en-ie', 'en-ie'],
            ['en-nz', 'en-nz'],
            ['eo', 'eo'],
            ['es-do', 'es-do'],
            ['es', 'es-ar'],
            ['es', 'es-mx'],
            ['es', 'es'],
            ['et', 'et'],
            ['eu', 'eu'],
            ['fa', 'fa'],
            ['fi', 'fi'],
            ['fo', 'fo'],
            ['fr-ca', 'fr-ca'],
            ['fr-ch', 'fr-ch'],
            ['fr', 'fr-fr'],
            ['fr', 'fr'],
            ['fy', 'fy'],
            ['gd', 'gd'],
            ['gl', 'gl'],
            ['he', 'he'],
            ['hi', 'hi'],
            ['hr', 'hr'],
            ['hu', 'hu'],
            ['hy-am', 'hy-am'],
            ['id', 'id'],
            ['is', 'is'],
            ['it', 'it'],
            ['ja', 'ja'],
            ['jv', 'jv'],
            ['ka', 'ka'],
            ['kk', 'kk'],
            ['km', 'km'],
            ['ko', 'ko'],
            ['ky', 'ky'],
            ['lb', 'lb'],
            ['lo', 'lo'],
            ['lt', 'lt'],
            ['lv', 'lv'],
            ['me', 'me'],
            ['mi', 'mi'],
            ['mk', 'mk'],
            ['ml', 'ml'],
            ['mr', 'mr'],
            ['ms', 'ms'],
            ['ms-my', 'ms-my'],
            ['my', 'my'],
            ['nb', 'nb'],
            ['ne', 'ne'],
            ['nl-be', 'nl-be'],
            ['nl', 'nl'],
            ['nl', 'nl-nl'],
            ['nn', 'nn'],
            ['pa-in', 'pa-in'],
            ['pl', 'pl'],
            ['pt-br', 'pt-br'],
            ['pt', 'pt'],
            ['ro', 'ro'],
            ['ru', 'ru'],
            ['se', 'se'],
            ['si', 'si'],
            ['sk', 'sk'],
            ['sl', 'sl'],
            ['sq', 'sq'],
            ['sr-cyrl', 'sr-cyrl'],
            ['sr', 'sr'],
            ['ss', 'ss'],
            ['sv', 'sv'],
            ['sw', 'sw'],
            ['ta', 'ta'],
            ['te', 'te'],
            ['tet', 'tet'],
            ['th', 'th'],
            ['tlh', 'tlh'],
            ['tl-ph', 'tl-ph'],
            ['tr', 'tr'],
            ['tzl', 'tzl'],
            ['tzm', 'tzm'],
            ['tzm-latn', 'tzm-latn'],
            ['uk', 'uk'],
            ['uz', 'uz'],
            ['vi', 'vi'],
            ['x-pseudo', 'x-pseudo'],
            ['yo', 'yo'],
            ['zh-cn', 'zh-cn'],
            ['zh-hk', 'zh-hk'],
            ['zh-tw', 'zh-tw'],
        ];
    }

    private function changeLocale(string $locale): void
    {
        $this->request->setLocale($locale);
    }
}

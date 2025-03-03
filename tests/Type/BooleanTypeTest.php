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

namespace Sonata\Form\Tests\Type;

use Sonata\Form\Type\BooleanType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class BooleanTypeTest extends TypeTestCase
{
    public function testParentIsChoiceType(): void
    {
        $form = new BooleanType();

        static::assertSame(ChoiceType::class, $form->getParent());
    }

    public function testGetDefaultOptions(): void
    {
        $type = new BooleanType();

        $type->configureOptions($optionResolver = new OptionsResolver());

        $options = $optionResolver->resolve();

        static::assertCount(2, $options['choices']);
    }

    public function testAddTransformerCall(): void
    {
        $type = new BooleanType();

        $type->configureOptions($optionResolver = new OptionsResolver());

        $builder = $this->createMock(FormBuilderInterface::class);
        $builder->expects(static::once())->method('addModelTransformer');

        $type->buildForm($builder, $optionResolver->resolve([
            'transform' => true,
        ]));
    }

    /**
     * The default behavior is not to transform to real boolean value .... don't ask.
     */
    public function testDefaultBehavior(): void
    {
        $type = new BooleanType();

        $type->configureOptions($optionResolver = new OptionsResolver());

        $builder = $this->createMock(FormBuilderInterface::class);
        $builder->expects(static::never())->method('addModelTransformer');

        $type->buildForm($builder, $optionResolver->resolve([]));
    }

    public function testOptions(): void
    {
        $type = new BooleanType();

        $type->configureOptions($optionResolver = new OptionsResolver());

        $builder = $this->createMock(FormBuilderInterface::class);
        $builder->expects(static::never())->method('addModelTransformer');

        $resolvedOptions = $optionResolver->resolve([
            'translation_domain' => 'fooTrans',
            'choices' => [1 => 'foo_yes', 2 => 'foo_no'],
        ]);

        $type->buildForm($builder, $resolvedOptions);

        $expectedOptions = [
            'transform' => false,
            'choice_translation_domain' => 'SonataFormBundle',
            'choices' => [1 => 'foo_yes', 2 => 'foo_no'],
            'translation_domain' => 'fooTrans',
        ];

        static::assertSame($expectedOptions, $resolvedOptions);
    }
}

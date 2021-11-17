<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\PaymentPlatform;
use App\Resolvers\PaymentPlatformResolver;
use App\Services\{PayPalService, StripeService};
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentPlatformResolverTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_should_throw_an_exception_when_payment_service_is_not_in_the_configuration()
    {
        $model = PaymentPlatform::create([
            'name' => 'not-exists-in-config',
            'image' => 'not-exists-in-config.jpg',
            'subscriptions_enabled' => true
        ]);

        $this->expectException(\Exception::class);

        (new PaymentPlatformResolver())->resolveService($model->id);
    }

    /** @test **/
    public function it_must_return_a_paypal_service_instance()
    {
        $model = PaymentPlatform::create([
            'name' => 'PayPal',
            'image' => 'img/payment-platforms/paypal.jpg',
            'subscriptions_enabled' => true
        ]);

        $instance = (new PaymentPlatformResolver())->resolveService($model->id);

        $this->assertInstanceOf(PayPalService::class, $instance);
    }

    /** @test **/
    public function it_must_return_a_stripe_service_instance()
    {
        $model = PaymentPlatform::create([
            'name' => 'Stripe',
            'image' => 'img/payment-platforms/stripe.jpg',
            'subscriptions_enabled' => true
        ]);

        $instance = (new PaymentPlatformResolver())->resolveService($model->id);

        $this->assertInstanceOf(StripeService::class, $instance);
    }
}

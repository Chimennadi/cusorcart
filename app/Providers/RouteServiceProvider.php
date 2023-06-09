<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
  /**
   * This namespace is applied to your controller routes.
   *
   * In addition, it is set as the URL generator's root namespace.
   *
   * @var string
   */
  protected $namespace = 'App\Http\Controllers';

  /**
   * Define your route model bindings, pattern filters, etc.
   *
   * @return void
   */
  public function boot()
  {
    //

    parent::boot();
  }

  /**
   * Define the routes for the application.
   *
   * @return void
   */
  public function map()
  {
    $this->mapApiRoutes();

    $this->mapAdminRoutes();

    $this->mapAffiliateRoutes();

    $this->mapRefundRoutes();

    $this->mapClubPointsRoutes();

    $this->mapOtpRoutes();

    $this->mapOfflinePaymentRoutes();

    $this->mapAfricanPaymentGatewayRoutes();

    $this->mapPaytmRoutes();

    $this->mapPosRoutes();

    $this->mapSellerPackageRoutes();

    $this->mapDeliveryBoyRoutes();

    $this->mapWebRoutes();

    $this->configureRateLimiting();
    
    //$this->mapInstallRoutes();

    //$this->mapUpdateRoutes();
  }

  /**
   * Define the "delivery boy" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapDeliveryBoyRoutes()
  {
    Route::middleware('web')
        ->namespace($this->namespace)
        ->group(base_path('routes/delivery_boy.php'));
  }

  /**
   * Define the "seller package" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapSellerPackageRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/seller_package.php'));
  }

  /**
   * Define the "affiliate" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapAffiliateRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/affiliate.php'));
  }

  /**
   * Define the "offline payment" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapOfflinePaymentRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/offline_payment.php'));
  }


  /**
   * Define the "offline payment" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapPaytmRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/paytm.php'));
  }

  /**
   * Define the "offline payment" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapAfricanPaymentGatewayRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/african_pg.php'));
  }

  /**
   * Define the "refund" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapRefundRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/refund_request.php'));
  }

  /**
   * Define the "club points" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapClubPointsRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/club_points.php'));
  }

  /**
   * Define the "OTP System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapOtpRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/otp.php'));
  }

  /**
   * Define the "POS System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapPosRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/pos.php'));
  }

  /**
   * Define the "updating" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapUpdateRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/update.php'));
  }

  /**
   * Define the "installation" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapInstallRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/install.php'));
  }

  /**
   * Define the "web" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/web.php'));
  }

  /**
   * Define the "admin" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapAdminRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/admin.php'));
  }

  /**
   * Define the "api" routes for the application.
   *
   * These routes are typically stateless.
   *
   * @return void
   */
  protected function mapApiRoutes()
  {
    Route::prefix('api')
       ->middleware('api')
       ->namespace($this->namespace)
       ->group(base_path('routes/api.php'));
  }

  
  
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(120*1000)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}

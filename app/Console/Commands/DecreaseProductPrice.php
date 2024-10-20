<?php

namespace App\Console\Commands;

use App\Models\Product;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Console\Command;

class DecreaseProductPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Product:DecreasePrice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Decrease a percent of product\'s price every month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Mark expired products:
        foreach (
            Product::where('is_lifetime','0')
                ->whereNotIn('status',['expired', 'sold'])
                ->whereDate('until','<',date('Y-m-d', now()->timestamp))
                ->get() as $product
        ) $product->update(['status' => 'expired', 'price'=>0]);

        // Decrease the price over time
        foreach (
            Product::where('is_lifetime','0')
                ->whereIn('status',['available','under_verify'])
                ->whereDate('updated_at','<=',Carbon::make('1 month ago'))
                ->get() as $product)
        {
            // old_price/month of expiry ... $ - ($/month * months_passed)
            $months = CarbonPeriod::create($product->created_at, '1 month', $product->until)->count();
            $months_passed = $months - CarbonPeriod::create(Carbon::now(), '1 month', $product->until)->count();
            $product->update(['price'=>round($product->old_price - (($product->old_price / $months) * $months_passed),2, PHP_ROUND_HALF_UP)]);
        }
        return self::SUCCESS;
    }
}

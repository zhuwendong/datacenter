<?php

namespace App\Providers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $info = DB::table('sysmodule')
            ->where(['sd_pid'=>0,'sd_type'=>1])
            ->select('sd_id','sd_name','sd_url','icon')->orderBy('sd_sort','asc')->orderBy('sd_id','asc')->get();
        $sonList = json_decode(json_encode($info), true);
        View::share('sonList', $sonList);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::enableQueryLog();  // 开启QueryLog

        $where[] = ["isdelete" , "=" , 0] ;
        $where[] = ["parent_id" , "=" , 0];
        $where[] = ["flag" , "=" , 1];
        $nav =  DB::table("cmf_nav")
                    ->where($where)
                    ->select("id","name","parent_id")
                    ->orderBy("list_order" , "desc")
                    ->limit(5)
                    ->get()
                    ->toArray();
        foreach ($nav as $k=>$v){
            $v->children = DB::table('cmf_nav')
                            ->where(["parent_id"=>$v->id])
                            ->select("id","name")->get()->toArray();
        }

        view()->share('nav',$nav);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
        $this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
    }
}

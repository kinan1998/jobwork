<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;


class SetAppLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next):Response
    {

        app()->setLocale('ar');

        if(isset($request -> lang)  && $request -> lang == 'en' )
            app()->setLocale('en');

        return $next($request);

        // $locale = $request->segment(2); // نفترض أن اللغة هي الجزء الثاني من المسار

        // // احصل على قائمة اللغات المتاحة من ملف الإعدادات
        // $availableLocales = config('app.available_locales', []);

        // if (!in_array($locale, $availableLocales)) {
        //     abort(400, 'Invalid locale');
        // }

        // App::setLocale($locale);

        // return $next($request);

     
    }
}

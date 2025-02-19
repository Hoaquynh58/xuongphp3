<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $age = $request->query('age'); // Lấy tuổi từ query string

        if (is_null($age) || !is_numeric($age) || $age < 18) {
            session()->flash('error', 'Bạn chưa đủ 18 tuổi để truy cập vào trang này.');
            // return redirect('/?message=' . urlencode('Bạn chưa đủ 18 tuổi để truy cập trang này.'));
            return redirect('/');
        }

        return $next($request); // Tiếp tục nếu đủ tuổi
    }
}

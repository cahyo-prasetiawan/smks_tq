<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;
use Carbon\Carbon;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $date = Carbon::today();

        // Cek apakah IP ini sudah berkunjung HARI INI?
        // Jika belum, simpan data baru.
        $visitor = Visitor::where('ip_address', $ip)
            ->where('visit_date', $date)
            ->first();

        if (!$visitor) {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'visit_date' => $date,
            ]);
        }

        return $next($request);
    }
}

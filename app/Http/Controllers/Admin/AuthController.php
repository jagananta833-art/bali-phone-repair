<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use Illuminate\Http\Request; use Illuminate\Support\Facades\RateLimiter; use Illuminate\Support\Str; use Illuminate\Validation\ValidationException;
class AuthController extends Controller {
 public function show(){ return view('admin.auth.login'); }
 public function login(Request $request){ $data=$request->validate(['email'=>'required|email','password'=>'required']); $key=$this->throttleKey($request); if(RateLimiter::tooManyAttempts($key,5)){throw ValidationException::withMessages(['email'=>'Terlalu banyak percobaan login. Coba lagi dalam '.RateLimiter::availableIn($key).' detik.']);} if(auth()->attempt($data,$request->boolean('remember'))){RateLimiter::clear($key);$request->session()->regenerate();return redirect()->route('admin.dashboard');} RateLimiter::hit($key,60); return back()->withErrors(['email'=>'Email atau password salah.'])->onlyInput('email'); }
 public function logout(Request $request){ auth()->logout();$request->session()->invalidate();$request->session()->regenerateToken();return redirect()->route('admin.login'); }
 private function throttleKey(Request $request): string { return Str::lower((string) $request->input('email')).'|'.$request->ip(); }
}

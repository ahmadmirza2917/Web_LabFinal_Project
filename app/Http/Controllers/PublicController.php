<?php
namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class PublicController extends Controller {
    public function home() {
        $doctors = Doctor::with('user')->where('is_available', true)->take(6)->get();
        return view('public.home', compact('doctors'));
    }
    public function about() { return view('public.about'); }
    public function doctors() {
        $doctors = Doctor::with('user')->where('is_available', true)->get();
        return view('public.doctors', compact('doctors'));
    }
    public function contact() { return view('public.contact'); }
}
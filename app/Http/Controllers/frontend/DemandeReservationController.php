<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DemandeReservationController extends Controller
{
    //
    public function AddReservation($id){
        $seller = User::where('status','active')->where('role','seller')->latest()->get();
        $cat = Category::latest()->get();
        $product = Product::findOrFail($id);
        return view('frontend.reservation.add', compact('cat', 'seller', 'product'));
    }

    public function AddDemande($id){
        $seller = User::where('status','active')->where('role','seller')->latest()->get();
        $cat = Category::latest()->get();
        $product = Product::findOrFail($id);
        return view('frontend.demande.add', compact('cat', 'seller', 'product'));
    }

    public function StoreReservation(Request $request){
        $product = $request->product_id;
        Reservation::insert([
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'user_id' => Auth::user()->id,
            'product_id' => $product,
        ]);

        $notification = array(
            'message' => 'Réservation faite avec succès',
            'alert-type' => 'success'
        );

        return redirect('/')->with($notification);
    }

    public function StoreDemande(Request $request){
        $product = $request->product_id;
        Demande::insert([
            'date_demande' => Carbon::now(),
            'user_id' => Auth::user()->id,
            'product_id' => $product,
            'desc' => $request->desc,
        ]);

        $notification = array(
            'message' => 'Demande faite avec succès',
            'alert-type' => 'success'
        );

        return redirect('/')->with($notification);
    }

    public function AllDemandes(){
        $demandes = Demande::latest()->get();
        return view('backend.demande.all', compact('demandes'));
    }

    public function AllReservations(){
        $reservations = Reservation::latest()->get();
        return view('backend.reservation.all', compact('reservations'));
    }
}

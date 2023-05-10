<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use App\Models\Rezerwacje;
use App\Models\Klienci;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function index_potwierdzenie(Request $request)
    {
        $validated = $request->validate([
            'imie' => 'required|String|min:2|max:15',
            'nazwisko' => 'required|String|min:2|max:30',
            'email' => 'required|String|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}$/',
            'telefon' => 'required|integer|regex:/^([0-9]{9})$/',
        ]);

        if($validated) {
            $klient = new Klienci();
            $klient->imie = $request->imie;
            $klient->nazwisko = $request->nazwisko;
            $klient->email = $request->email;
            $klient->telefon = $request->telefon;
            if ($request->imie == "admin")
                return view('klienci.message',['message'=>'Access denied','type_of_message'=>'Error']);
            else {
                //$bylyKlient;
                //$MyKlienci = Klienci::all();
                //foreach ($MyKlienci as $byly) {
                //   if ($byly->$email == $request->$email) {
                //    $klient = $byly;
                //    $bylyKlient = $byly;
                //   }
                //}

                //if ($klient != $bylyKlient) 
                $klient->save();

                if($validated) {

                    $rezerwacja = new Rezerwacje();
                    $rezerwacja->id_klienta = $klient->id_klienta;
                    $rezerwacja->id_samochodu = $request->id_samochodu;
                    $rezerwacja->data_pocz = $request->data_pocz;
                    $rezerwacja->data_kon = $request->data_kon;
                    $rezerwacja->ochrona = $request->ochrona;
                    $rezerwacja->pakiet = $request->pakiet;

                    $rezerwacja->save();
                    return redirect('/pokaz/'.$rezerwacja->id_rezerwacji);
                }
                

            }
        }
    }

    public function pokaz_potwierdzenie($id)
    {
        $myRezerwacja = Rezerwacje::find($id);
        if ($myRezerwacja==null) {
            $error_message = "Id rezerwacjaa=".$id." not found";
            return view('rezerwacje.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
        if ($myRezerwacja->count() > 0) {
            return view('potwierdzenie',['rezerwacje'=>$myRezerwacja,]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function zmienStanUwierzytelnienia()
    {
     if (auth()->check()) {
        $user = auth()->user();
        Auth::logout();
        return view('wylogowano');
     }
     else return redirect('/login');
    }
}

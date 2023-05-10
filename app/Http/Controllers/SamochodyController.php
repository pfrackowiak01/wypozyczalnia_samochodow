<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Samochody;
use App\Models\Ubezpieczenia;

class SamochodyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $MySamochody = Samochody::all();
        if (auth()->user()->name != "admin")
            return view('samochody.message',['message'=>'Access denied','type_of_message'=>'Error']);
        else
            return view('samochody.list',['samochody'=>$MySamochody]);
    }

    public function index_api()
    {
        $myAPI_URL = config('app.url')."/api/samochody/list";
        $res = Http::get($myAPI_URL);
        $json = $res->json();
        if (!empty($json) && array_key_exists('data', $json)) {
            $MySamochody = json_decode(json_encode($json['data']), FALSE);
        //$MySamochody = json_decode(json_encode($res->json()['data']), FALSE);
        if (auth()->user()->name != "admin")
            return view('samochody.message',['message'=>'Access denied','type_of_message'=>'Error']);
        else
            return view('samochody.list',['samochody'=>$MySamochody]);
        }
        else return view('home');
    }

    public function index_wynajem()
    {
        $MySamochody = Samochody::all();
        return view('wynajem',['samochody'=>$MySamochody]);
    }

    public function index_wynajmowanie($id)
    {
        $mySamochod = Samochody::find($id);
        if ($mySamochod==null) {
            $error_message = "Id samochoda=".$id." not found";
            return view('samochody.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
        return view('wynajmowanie',['samochody'=>$mySamochod]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $MySamochod = Samochody::all();
        $MyUbezpieczenie = Ubezpieczenia::all();
        if (auth()->user()->name != "admin")
            return view('samochody.message',['message'=>'Access denied','type_of_message'=>'Error']);
        else
            return view('samochody.add',['ubezpieczenia'=>$MyUbezpieczenie]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nazwa' => 'required|String',
            'skrzynia_bieg' => 'required|String',
            'klasa' => 'required|String',
            'miejsca' => 'required|integer',
            'bagaz' => 'required|integer',
            'stawka_dzienna' => 'required|integer',
            'kaucja' => 'required|integer',
            'id_ubezpieczenia' => 'required|integer',
            'silnik' => 'required|String',
            'spalanie' => 'required|integer',
            'obrazek' => 'required|String',
        ]);

        if($validated) {
            $samochod = new Samochody();
            $samochod->nazwa = $request->nazwa;
            $samochod->skrzynia_bieg = $request->skrzynia_bieg;
            $samochod->klasa = $request->klasa;
            $samochod->miejsca = $request->miejsca;
            $samochod->bagaz = $request->bagaz;
            $samochod->stawka_dzienna = $request->stawka_dzienna;
            $samochod->kaucja = $request->kaucja;
            $samochod->id_ubezpieczenia = $request->id_ubezpieczenia;
            $samochod->silnik = $request->silnik;
            $samochod->spalanie = $request->spalanie;
            $samochod->obrazek = $request->obrazek;
            if (auth()->user()->name != "admin")
                return view('samochody.message',['message'=>'Access denied','type_of_message'=>'Error']);
            else {
                $samochod->save();
                return redirect('/samochody/list');
            }
        }
    }

    public function store_api(Request $request)
    {
        $validated = $request->validate([
            'nazwa' => 'required|String',
            'skrzynia_bieg' => 'required|String',
            'klasa' => 'required|String',
            'miejsca' => 'required|integer',
            'bagaz' => 'required|integer',
            'stawka_dzienna' => 'required|integer',
            'kaucja' => 'required|integer',
            'id_ubezpieczenia' => 'required|integer',
            'silnik' => 'required|String',
            'spalanie' => 'required|integer',
            'obrazek' => 'required|String',
        ]);

        $myAPI_URL = config('app.url')."/api/samochody/new";
        $response = Http::post($myAPI_URL, $request);
        return redirect('samochody/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mySamochod = Samochody::find($id);
        $MyUbezpieczenie = $mySamochod->id_ubezpieczenia;
        if ($mySamochod==null) {
            $error_message = "Id samochoda=".$id." not found";
            return view('samochody.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
        if ($mySamochod->count() > 0) {
            if(auth()->user()->name != "admin")
                return view('samochody.message',['message'=>'Access denied','type_of_message'=>'Error']);
            else
                return view('samochody.show',['samochody'=>$mySamochod]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mySamochod = Samochody::find($id);
        $MyUbezpieczenie = Ubezpieczenia::all();
        if ($mySamochod == null) {
            $error_message = "Id samochoda=".$id." not found";
            return view('samochody.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
        if ($mySamochod->count() > 0) {
            if (auth()->user()->name != "admin")
                return view('samochody.message',['message'=>'Access denied','type_of_message'=>'Error']);
            else
                return view('samochody.edit',['samochody'=>$mySamochod,'ubezpieczenia'=>$MyUbezpieczenie]);
        }
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
        $validated = $request->validate([
            'nazwa' => 'required|integer',
            'skrzynia_bieg' => 'required|integer',
            'klasa' => 'required|String',
            'miejsca' => 'required|integer',
            'bagaz' => 'required|integer',
            'stawka_dzienna' => 'required|integer',
            'kaucja' => 'required|integer',
            'id_ubezpieczenia' => 'required|integer',
            'silnik' => 'required|String',
            'spalanie' => 'required|integer',
            'obrazek' => 'required|String',
        ]);

        if ($validated) {
            $samochod = Samochody::find($id);
            if ($samochod!=null) {
                $samochod->nazwa = $request->nazwa;
                $samochod->skrzynia_bieg = $request->skrzynia_bieg;
                $samochod->klasa = $request->klasa;
                $samochod->miejsca = $request->miejsca;
                $samochod->bagaz = $request->bagaz;
                $samochod->stawka_dzienna = $request->stawka_dzienna;
                $samochod->kaucja = $request->kaucja;
                $samochod->id_ubezpieczenia = $request->id_ubezpieczenia;
                $samochod->silnik = $request->silnik;
                $samochod->spalanie = $request->spalanie;
                $samochod->obrazek = $request->obrazek;
                if (auth()->user()->name != "admin")
                    return view('samochody.message',['message'=>'Access denied','type_of_message'=>'Error']);
                else {
                    $samochod->save();
                    return redirect('/samochody/list');
                }
            }
            else {
                $error_message = "Id samochoda=".$id." not found";
                return view('samochody.message',['message'=>$error_message,'type_of_message'=>'Error']);
            }
        }
    }

    public function update_api(Request $request, $id)
    {
        $myAPI_URL = config('app.url')."/api/samochody/update/".$id;
        $response = Http::patch($myAPI_URL,$request);
        return redirect('samochody/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $samochod = Samochody::find($id);
        if ($samochod!=null) {
            if (auth()->user()->name != "admin")
                return view('samochody.message',['message'=>'Access denied','type_of_message'=>'Error']);
            else {
                $samochod->delete();
                return redirect('/samochody/list');
            }     
        }
        else {
            $error_message = "Id samochoda=".$id." not found";
            return view('samochody.message',['message'=>$error_message,'type_of_message'=>'Error']);
        }
    }

    public function destroy_api(Request $request, $id)
    {
        $myAPI_URL = config('app.url')."/api/samochody/delete/".$id;
        $response = Http::delete($myAPI_URL);
        return redirect('samochody/list');
    }

}

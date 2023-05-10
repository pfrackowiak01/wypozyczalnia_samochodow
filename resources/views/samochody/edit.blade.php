<!DOCTYPE html>
<html>
@include('partials.head')
<body class="bg-gray-100">
    @include('partials.navi')
    <div class="flex flex-col items-center p-2">
        <h2 class="p-4 text-3xl"><b>Edytuj samochód o id: {{$samochody->id_samochodu}}</b></h2>
        <form class="form-inline rounded-md bg-gray-500" action="<?=config('app.url'); ?>/samochody/update/{{$samochody->id_samochodu}}" method="post">
        @csrf
        <p class="p-4">
                <label for="id_samochodu">Id samochodu:</label>
                <input id="id_samochodu" name="id_samochodu" type="number" value="{{$samochody->id_samochodu}}" readonly>
            </p>
            <p class="p-4">
                <label for="nazwa">Nazwa:</label>
                <input id="nazwa" name="nazwa" type="string" value="{{$samochody->nazwa}}" required>
            </p>
            <p class="p-4">
                <label for="skrzynia_bieg">Skrzynia biegów:</label>
                <input type="radio" name="skrzynia_bieg" id="skrzynia_bieg1" value="manualna" @if ($samochody->skrzynia_bieg=="manualna") checked @endif required>
                <label for="skrzynia_bieg">manualna</label>
                <input type="radio" name="skrzynia_bieg" id="skrzynia_bieg2" value="automatyczna" @if ($samochody->skrzynia_bieg=="automatyczna") checked @endif required>
                <label for="skrzynia_bieg">automatyczna</label>
            </p>
            <p class="p-4">
                <label for="klasa">Klasa:</label>
                <input id="klasa" name="klasa" type="string" value="{{$samochody->klasa}}" required>
            </p>
            <p class="p-4">
                <label for="miejsca">Ilość siedzeń:</label>
                <input id="miejsca" name="miejsca" type="number" min=1 value="{{$samochody->miejsca}}" required>
            </p>
            <p class="p-4">
                <label for="bagaz">Pojemność bagażnika [l]:</label>
                <input id="bagaz" name="bagaz" type="number" min=10 value="{{$samochody->bagaz}}" required>
            </p>
            <p class="p-4">
                <label for="stawka_dzienna">Stawka dzienna [zł]:</label>
                <input id="stawka_dzienna" name="stawka_dzienna" type="number" min=10 value="{{$samochody->stawka_dzienna}}" required>
            </p>
            <p class="p-4">
                <label for="kaucja">Kaucja [zł]:</label>
                <input id="kaucja" name="kaucja" type="number" min=100 value="{{$samochody->kaucja}}" required>
            </p>
            <p class="p-4">
                <label for="id_ubezpieczenia">Rodzaj ubezpieczenia:</label>
                <select id="id_ubezpieczenia" name="id_ubezpieczenia" required>
                @foreach($ubezpieczenia as $el)
                    <option value="{{$el->id_ubezpieczenia}}" @if ($samochody->id_ubezpieczenia==$el->id_ubezpieczenia) selected @endif>{{$el->nazwa}}</option>
                @endforeach
                </select>
            </p>
            <p class="p-4">
            <label for="silnik">Rodzaj paliwa:</label>
                <input type="radio" name="silnik" id="silnik1" value="benzyna" @if ($samochody->silnik=="benzyna") checked @endif required>
                <label for="silnik">benzyna</label>
                <input type="radio" name="silnik" id="silnik2" value="desiel" @if ($samochody->silnik=="diesel") checked @endif required>
                <label for="silnik">desiel</label>
                <input type="radio" name="silnik" id="silnik3" value="elektryczny" @if ($samochody->silnik=="elektryczny") checked @endif required>
                <label for="silnik">elektryczny</label>
                <input type="radio" name="silnik" id="silnik4" value="hybryda" @if ($samochody->silnik=="hybryda") checked @endif required>
                <label for="silnik">hybryda</label>
            </p>
            <p class="p-4">
                <label for="spalanie">@if ($samochody->silnik == "elektryczny") Zasięg [km]: @else Spalanie [l/100km]: @endif</label>
                <input id="spalanie" name="spalanie" type="number" min=1 value="{{$samochody->spalanie}}" required>
            </p>
            <p class="p-4">
                <label for="obrazek">Zdjęcie:</label>
                <input id="obrazek" name="obrazek" type="string" value="{{$samochody->obrazek}}" required>
            </p>
            <p class="p-4"><button type="submit" class="text-white p-2 rounded-md bg-gray-800 hover:text-gray-800 hover:bg-red-500 duration-150">Zaktualizuj</button></p>
        </form>
        @include('partials.error')
    </div>
    @include('partials.footer')
</body>
</html>
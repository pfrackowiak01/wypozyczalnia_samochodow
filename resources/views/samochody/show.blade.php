<!DOCTYPE html>
<html>
@include('partials.head')
<body class="bg-gray-100">
    @include('partials.navi')
    <div class="flex flex-col items-center p-2">
        <h2 class="p-4 text-3xl"><b>Podgląd samochodu do usunięcia o id: {{$samochody->id_samochodu}}</b></h2>
        <form class="form-inline rounded-md bg-gray-500" action="<?=config('app.url'); ?>/samochody/delete/{{$samochody->id_samochodu}}" method="post">
        @csrf
            <p class="p-4">
                <label for="id_samochodu">Id samochodu:</label>
                <input id="id_samochodu" name="id_samochodu" type="number" value="{{$samochody->id_samochodu}}" readonly>
            </p>
            <p class="p-4">
                <label for="nazwa">Nazwa:</label>
                <input id="nazwa" name="nazwa" type="string" value="{{$samochody->nazwa}}" readonly required>
            </p>
            <p class="p-4">
            <label for="skrzynia_bieg">Skrzynia biegów:</label>
                <input type="radio" name="skrzynia_bieg" id="skrzynia_bieg" value="manualna" disabled @if ($samochody->skrzynia_bieg=="manualna") checked @endif  >
                <label for="skrzynia_bieg">manualna</label>
                <input type="radio" name="skrzynia_bieg" id="skrzynia_bieg" value="automatyczna" disabled @if ($samochody->skrzynia_bieg=="automatyczna") checked @endif  >
                <label for="skrzynia_bieg">automatyczna</label>
            </p>
            <p class="p-4">
                <label for="klasa">Klasa:</label>
                <input id="klasa" name="klasa" type="string" value="{{$samochody->klasa}}" readonly required>
            </p>
            <p class="p-4">
                <label for="miejsca">Ilość siedzeń:</label>
                <input id="miejsca" name="miejsca" type="number" value="{{$samochody->miejsca}}" readonly required>
            </p>
            <p class="p-4">
                <label for="bagaz">Pojemność bagażnika [l]:</label>
                <input id="bagaz" name="bagaz" type="number" value="{{$samochody->bagaz}}" readonly required>
            </p>
            <p class="p-4">
                <label for="stawka_dzienna">Stawka dzienna [zł]:</label>
                <input id="stawka_dzienna" name="stawka_dzienna" type="number" value="{{$samochody->stawka_dzienna}}" readonly required>
            </p>
            <p class="p-4">
                <label for="kaucja">Kaucja [zł]:</label>
                <input id="kaucja" name="kaucja" type="number" value="{{$samochody->kaucja}}" readonly required>
            </p>
            <p class="p-4">
                <label for="id_ubezpieczenia">Id ubezpieczenia:</label>
                <input id="id_ubezpieczenia" name="id_ubezpieczenia" type="number" value="{{$samochody->id_ubezpieczenia}}" readonly required>
            </p>
            <p class="p-4">
            <label for="silnik">Silnik:</label>
                <input type="radio" name="silnik" id="silnik" value="benzyna" disabled @if ($samochody->silnik=="benzyna") checked @endif readonly >
                <label for="silnik">benzyna</label>
                <input type="radio" name="silnik" id="silnik" value="desiel" disabled @if ($samochody->silnik=="diesel") checked @endif readonly >
                <label for="silnik">desiel</label>
                <input type="radio" name="silnik" id="silnik" value="elektryczny" disabled @if ($samochody->silnik=="elektryczny") checked @endif readonly >
                <label for="silnik">elektryczny</label>
                <input type="radio" name="silnik" id="silnik" value="hybryda" disabled @if ($samochody->silnik=="hybryda") checked @endif readonly >
                <label for="silnik">hybryda</label>
            </p>
            <p class="p-4">
            <label for="spalanie">@if ($samochody->silnik == "elektryczny") Zasięg [km]: @else Spalanie [l/100km]: @endif</label>
                <input id="spalanie" name="spalanie" type="number" step="0.01" value="{{$samochody->spalanie}}" readonly required>
            </p>
            <p class="p-4">
                <label for="obrazek">Zdjęcie:</label>
                <input id="obrazek" name="obrazek" type="string" value="{{$samochody->obrazek}}" readonly required>
            </p>
            <p class="p-4"><button type="submit" class="text-white p-2 rounded-md bg-gray-800 hover:text-gray-800 hover:bg-red-500 duration-150">Usuń</button></p>
        </form>
    </div>
    @include('partials.footer')
</body>
</html>
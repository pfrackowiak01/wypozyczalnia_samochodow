<!DOCTYPE html>
<html>
@include('partials.head')
<body class="bg-gray-100">
    @include('partials.navi')
    <div class="flex flex-col items-center p-2">
        <h2 class="p-4 text-3xl"><b>Dodaj nowy samochód:</b></h2>
        <form class="form-inline rounded-md bg-gray-500" action="<?=config('app.url'); ?>/samochody/save" method="post">
            @csrf
            <p class="p-4">
                <label for="nazwa">Nazwa:</label>
                <input id="nazwa" name="nazwa" type="string" required>
            </p>
            <p class="p-4">
                <label for="skrzynia_bieg">Skrzynia biegów:</label>
                <input type="radio" name="skrzynia_bieg" id="skrzynia_bieg1" value="manualna" checked required>
                <label for="skrzynia_bieg">manualna</label>
                <input type="radio" name="skrzynia_bieg" id="skrzynia_bieg2" value="automatyczna" required>
                <label for="skrzynia_bieg">automatyczna</label>
            </p>
            <p class="p-4">
                <label for="klasa">Klasa:</label>
                <input id="klasa" name="klasa" type="string" required>
            </p>
            <p class="p-4">
                <label for="miejsca">Ilość siedzeń:</label>
                <input id="miejsca" name="miejsca" type="number" min=1 required>
            </p>
            <p class="p-4">
                <label for="bagaz">Pojemność bagażnika [l]:</label>
                <input id="bagaz" name="bagaz" type="number" min=10 required>
            </p>
            <p class="p-4">
                <label for="stawka_dzienna">Stawka dzienna [zł]:</label>
                <input id="stawka_dzienna" name="stawka_dzienna" min=10 type="number" required>
            </p>
            <p class="p-4">
                <label for="kaucja">Kaucja [zł]:</label>
                <input id="kaucja" name="kaucja" type="number" min=100 required>
            </p>
            <p class="p-4">
                <label for="id_ubezpieczenia">Rodzaj ubezpieczenia:</label>
                <select id="id_ubezpieczenia" name="id_ubezpieczenia"  required>
                @foreach($ubezpieczenia as $el)
                    <option value="{{$el->id_ubezpieczenia}}">{{$el->nazwa}}</option>
                @endforeach
                </select>
            </p>
            <p class="p-4">
            <label for="silnik">Rodzaj paliwa:</label>
                <input type="radio" name="silnik" id="silnik1" value="benzyna" checked required>
                <label for="silnik">benzyna</label>
                <input type="radio" name="silnik" id="silnik2" value="desiel" required>
                <label for="silnik">desiel</label>
                <input type="radio" name="silnik" id="silnik3" value="elektryczny" required>
                <label for="silnik">elektryczny</label>
                <input type="radio" name="silnik" id="silnik4" value="hybryda" required>
                <label for="silnik">hybryda</label>
            </p>
            <p class="p-4">
                <label for="spalanie">Spalanie [l/100km] / Zasięg [km]:</label>
                <input id="spalanie" name="spalanie" type="number" min=1 required>
            </p>
            <p class="p-4">
                <label for="obrazek">Zdjęcie:</label>
                <input id="obrazek" name="obrazek" type="string" required>
            </p>
            <p class="p-4"><button type="submit" class="text-white p-2 rounded-md bg-gray-800 hover:text-gray-800 hover:bg-red-500 duration-150">Zapisz</button></p>
        </form>
        @include('partials.error')
    </div>
    @include('partials.footer')
</body>
</html>
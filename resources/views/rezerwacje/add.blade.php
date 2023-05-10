<!DOCTYPE html>
<html>
@include('partials.head')
<body class="bg-gray-100">
    @include('partials.navi')
    <div class="flex flex-col items-center p-2">
        <h2 class="p-4 text-3xl"><b>Dodaj nową rezerwacje:</b></h2>
        <form class="form-inline rounded-md bg-gray-500" action="<?=config('app.url'); ?>/rezerwacje/save" method="post">
            @csrf
            <p class="p-4">
                <label for="id_klienta">Klient: </label>
                <select id="id_klienta" name="id_klienta" required>
                @foreach($klienci as $el)
                    <option value="{{$el->id_klienta}}">{{$el->imie}} {{$el->nazwisko}}</option>
                @endforeach
                </select>
            </p>
            <p class="p-4">
                <label for="id_samochodu">Samochód: </label>
                <select id="id_samochodu" name="id_samochodu"  required>
                @foreach($samochody as $el)
                    <option value="{{$el->id_samochodu}}">{{$el->nazwa}}</option>
                @endforeach
                </select>
            </p>
            <p class="p-4">
                <label for="data_pocz">Data początkowa: </label>
                <input id="data_pocz" name="data_pocz" type="date" min="2023-02-03" required>
            </p>
            <p class="p-4">
                <label for="data_kon">Data końcowa: </label>
                <input id="data_kon" name="data_kon" type="date" min="2023-02-03" required>
            </p>
            <p class="p-4">
                <label for="ochrona">Ochrona: </label>
                <input type="radio" name="ochrona" id="ochrona1" value="pelna" checked required>
                <label for="ochrona">Pełna</label>
                <input type="radio" name="ochrona" id="ochrona2" value="czesciowa" required>
                <label for="ochrona">Częściowa</label>
                <input type="radio" name="ochrona" id="ochrona3" value="brak" required>
                <label for="ochrona">Brak</label>
            </p>
            <p class="p-4">
                <label for="pakiet">Pakiet: </label>
                <input type="radio" name="pakiet" id="pakiet1" value="premium" checked required>
                <label for="pakiet">Premium</label>
                <input type="radio" name="pakiet" id="pakiet2" value="elastyczny" required>
                <label for="pakiet">Elastyczny</label>
                <input type="radio" name="pakiet" id="pakiet3" value="comfort" required>
                <label for="pakiet">Comfort</label>
                <input type="radio" name="pakiet" id="pakiet4" value="brak" required>
                <label for="pakiet">Brak</label>
            </p>
            <p class="p-4"><button type="submit" class="text-white p-2 rounded-md bg-gray-800 hover:text-gray-800 hover:bg-red-500 duration-150">Zapisz</button></p>
        </form>
        @include('partials.error')
    </div>
    @include('partials.footer')
</body>
</html>
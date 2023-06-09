<!DOCTYPE html>
<html>
@include('partials.head')
<body class="bg-gray-100">
    @include('partials.navi')
    <div class="flex flex-col items-center p-2">
        <h2 class="p-4 text-3xl"><b>Edytuj rezerwacje o id: {{$rezerwacje->id_rezerwacji}}</b></h2>
        <form class="form-inline rounded-md bg-gray-500" action="<?=config('app.url'); ?>/rezerwacje/update/{{$rezerwacje->id_rezerwacji}}" method="post">
            @csrf
            <p class="p-4">
                <label for="id_rezerwacji">Id rezerwacji:</label>
                <input id="id_rezerwacji" name="id_rezerwacji" value="{{$rezerwacje->id_rezerwacji}}" readonly>
            </p>
            <p class="p-4">
                <label for="id_klienta">Klient: </label>
                <select id="id_klienta" name="id_klienta" required>
                @foreach($klienci as $el)
                    <option value="{{$el->id_klienta}}" @if ($rezerwacje->id_klienta==$el->id_klienta) selected @endif>{{$el->imie}} {{$el->nazwisko}}</option>
                @endforeach
                </select>
            </p>
            <p class="p-4">
                <label for="id_samochodu">Samochód: </label>
                <select id="id_samochodu" name="id_samochodu"  required>
                @foreach($samochody as $el)
                    <option value="{{$el->id_samochodu}}" @if ($rezerwacje->id_samochodu==$el->id_samochodu) selected @endif>{{$el->nazwa}}</option>
                @endforeach
                </select>
            </p>
            <p class="p-4">
                <label for="data_pocz">Data początkowa:</label>
                <input id="data_pocz" name="data_pocz" type="date" min="2023-02-03" value="{{$rezerwacje->data_pocz}}" required>
            </p>
            <p class="p-4">
                <label for="data_kon">Data końcowa:</label>
                <input id="data_kon" name="data_kon" type="date" min="2023-02-03" value="{{$rezerwacje->data_kon}}" required>
            </p>
            <p class="p-4">
            <label for="ochrona">Ochrona:</label>
                <input type="radio" name="ochrona" id="ochrona" value="pelna" @if ($rezerwacje->ochrona=="pelna") checked @endif required>
                <label for="ochrona">pełna</label>
                <input type="radio" name="ochrona" id="ochrona" value="czesciowa" @if ($rezerwacje->ochrona=="czesciowa") checked @endif required>
                <label for="ochrona">częściowa</label>
                <input type="radio" name="ochrona" id="ochrona" value="brak" @if ($rezerwacje->ochrona=="brak") checked @endif required>
                <label for="ochrona">brak</label>
            </p>
            <p class="p-4">
                <label for="pakiet">Pakiet:</label>
                <input type="radio" name="pakiet" id="pakiet" value="premium" @if ($rezerwacje->pakiet=="premium") checked @endif required>
                <label for="pakiet">premium</label>
                <input type="radio" name="pakiet" id="pakiet" value="comfort" @if ($rezerwacje->pakiet=="comfort") checked @endif required>
                <label for="pakiet">comfort</label>
                <input type="radio" name="pakiet" id="pakiet" value="elastyczny" @if ($rezerwacje->pakiet=="elastyczny") checked @endif required>
                <label for="pakiet">elastyczny</label>
                <input type="radio" name="pakiet" id="pakiet" value="brak" @if ($rezerwacje->pakiet=="brak") checked @endif required>
                <label for="pakiet">brak</label>
            </p>
            <p class="p-4"><button type="submit" class="text-white p-2 rounded-md bg-gray-800 hover:text-gray-800 hover:bg-red-500 duration-150">Zaktualizuj</button></p>
        </form>
        @include('partials.error')
    </div>
    @include('partials.footer')
</body>
</html>
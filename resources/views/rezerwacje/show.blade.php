<!DOCTYPE html>
<html>
@include('partials.head')
<body class="bg-gray-100">
    @include('partials.navi')
    <div class="flex flex-col items-center p-2">
        <h2 class="p-4 text-3xl"><b>Podgląd rezerwacji do usunięcia o id: {{$rezerwacje->id_rezerwacji}}</b></h2>
        <form class="form-inline rounded-md bg-gray-500" action="<?=config('app.url'); ?>/rezerwacje/delete/{{$rezerwacje->id_rezerwacji}}" method="post">
        @csrf
            <p class="p-4">
                <label for="id_rezerwacji">Id rezerwacji:</label>
                <input id="id_rezerwacji" name="id_rezerwacji" value="{{$rezerwacje->id_rezerwacji}}" readonly>
            </p>
            <p class="p-4">
                <label for="id_klienta">Id klienta:</label>
                <input id="id_klienta" name="id_klienta" value="{{$rezerwacje->id_klienta}}" readonly required>
            </p>
            <p class="p-4">
                <label for="id_samochodu">Id Samochodu:</label>
                <input id="id_samochodu" name="id_samochodu" value="{{$rezerwacje->id_samochodu}}" readonly required>
            </p>
            <p class="p-4">
                <label for="data_pocz">Data początkowa:</label>
                <input id="data_pocz" name="data_pocz" type="date" value="{{$rezerwacje->data_pocz}}" readonly required>
            </p>
            <p class="p-4">
                <label for="data_kon">Data końcowa:</label>
                <input id="data_kon" name="data_kon" type="date" value="{{$rezerwacje->data_kon}}" readonly required>
            </p>
            <p class="p-4">
            <label for="ochrona">Ochrona:</label>
                <input type="radio" name="ochrona" id="ochrona" value="pelna" disabled @if ($rezerwacje->ochrona=="pelna") checked @endif readonly >
                <label for="ochrona">pełna</label>
                <input type="radio" name="ochrona" id="ochrona" value="czesciowa" disabled @if ($rezerwacje->ochrona=="czesciowa") checked @endif readonly >
                <label for="ochrona">częściowa</label>
                <input type="radio" name="ochrona" id="ochrona" value="brak" disabled @if ($rezerwacje->ochrona=="brak") checked @endif readonly >
                <label for="ochrona">brak</label>
            </p>
            <p class="p-4">
                <label for="pakiet">Pakiet:</label>
                <input type="radio" name="pakiet" id="pakiet" value="premium" disabled @if ($rezerwacje->pakiet=="premium") checked @endif readonly >
                <label for="pakiet">premium</label>
                <input type="radio" name="pakiet" id="pakiet" value="comfort" disabled @if ($rezerwacje->pakiet=="comfort") checked @endif readonly >
                <label for="pakiet">comfort</label>
                <input type="radio" name="pakiet" id="pakiet" value="elastyczny" disabled @if ($rezerwacje->pakiet=="elastyczny") checked @endif readonly >
                <label for="pakiet">elastyczny</label>
                <input type="radio" name="pakiet" id="pakiet" value="brak" disabled @if ($rezerwacje->pakiet=="brak") checked @endif readonly >
                <label for="pakiet">brak</label>
            </p>
            <p class="p-4"><button type="submit" class="text-white p-2 rounded-md bg-gray-800 hover:text-gray-800 hover:bg-red-500 duration-150">Usuń</button></p>
        </form>
    </div>
    @include('partials.footer')
</body>
</html>
<!DOCTYPE html>
<html>
@include('partials.head')
<body class="bg-gray-100">
    @include('partials.navi')
    <div class="flex flex-col items-center p-2">
        <h2 class="p-4 text-3xl"><b>Dodaj nowy raport:</b></h2>
        <form class="form-inline rounded-md bg-gray-500" action="<?=config('app.url'); ?>/wypozyczenia/save" method="post">
            @csrf
            <p class="p-4">
                <label for="id_rezerwacji">Id rezerwacji:</label>
                <select id="id_rezerwacji" name="id_rezerwacji"  required>
                @foreach($rezerwacje as $el)
                    <option value="{{$el->id_rezerwacji}}">{{$el->id_rezerwacji}}</option>
                @endforeach
                </select>
            </p>
            <p class="p-4">
                <label for="stan_zwrotu">Stan:</label>
                <input type="radio" name="stan_zwrotu" id="stan_zwrotu1" value="zarezerwowany" checked required>
                <label for="stan_zwrotu">Zarezerwowany</label>
                <input type="radio" name="stan_zwrotu" id="stan_zwrotu2" value="uszkodzony" required>
                <label for="stan_zwrotu">Uszkodzony</label>
                <input type="radio" name="stan_zwrotu" id="stan_zwrotu3" value="nieuszkodzony" required>
                <label for="stan_zwrotu">Nieuszkodzony</label>
            </p>
            <p class="p-4 flex">
                <label for="opis">Opis:</label>
                <textarea id="opis" name="opis" rows="4" cols="40" type="string" ></textarea>
            </p>
            <p class="p-4">
                <label for="koszt_uszkodzen">Koszt uszkodzeń:</label>
                <input id="koszt_uszkodzen" name="koszt_uszkodzen" type="number" min=0 required>
            </p>
            <p class="p-4">
                <label for="czy_wszystko_oplacone">Czy wszystko jest opłacone:</label>
                <input type="radio" name="czy_wszystko_oplacone" id="czy_wszystko_oplacone1" value="tak" checked required>
                <label for="czy_wszystko_oplacone">Tak</label>
                <input type="radio" name="czy_wszystko_oplacone" id="czy_wszystko_oplacone2" value="nie" required>
                <label for="czy_wszystko_oplacone">Nie</label>
            </p>
            <p class="p-4"><button type="submit" class="text-white p-2 rounded-md bg-gray-800 hover:text-gray-800 hover:bg-red-500 duration-150">Zapisz</button></p>
        </form>
        @include('partials.error')
    </div>
    @include('partials.footer')
</body>
</html>
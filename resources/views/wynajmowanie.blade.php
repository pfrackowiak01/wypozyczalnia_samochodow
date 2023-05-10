<!DOCTYPE html>
<html>
@include('partials.head')
<body class="bg-gray-100">
    @include('partials.navi')
    <div class="flex flex-col items-center p-2">
    <h2 class="p-4 text-3xl"><b>Wpisz swoje dane:</b></h2>
        <form class="form-inline rounded-md bg-gray-500" action="<?=config('app.url'); ?>/potwierdzenie" method="get">
            @csrf
            <p class="p-4">
                <label for="imie">Imię:</label>
                <input id="imie" name="imie" type="string" size="15" value="{{auth()->user()->name}}" required>
            </p>
            <p class="p-4">
                <label for="nazwisko">Nazwisko:</label>
                <input id="nazwisko" name="nazwisko" type="string" size="30" required>
            </p>
            <p class="p-4">
                <label for="email">Email:</label>
                <input id="email" name="email" size="40" type="email" value="{{auth()->user()->email}}" required>
            </p>
            <p class="p-4">
                <label for="telefon">Nr telefonu: (+48)</label>
                <input id="telefon" name="telefon" type="tel" pattern="[0-9]{9}" required>
            </p>
            <p class="p-4">
                <label for="samochod">Samochód:</label>
                <input id="samochod" name="samochod" type="string" value="{{$samochody->nazwa}}" readonly>
            </p>
            <p class="p-4 .hidden">
                <label for="id_samochodu">Id samochodu:</label>
                <input id="id_samochodu" name="id_samochodu" type="number" value="{{$samochody->id_samochodu}}" readonly>
            </p>
            <!--<script>
                const data_pocz = document.getElementById("data_pocz");
                const today = new Date().toISOString().substring(0, 10);
                data_pocz.setAttribute("min", today);
                const data_kon = document.getElementById("data_kon");
                data_kon.setAttribute("min", today);
            </script>-->
            <p class="p-4">
                <label for="data_pocz">Data początkowa:</label>
                <input id="data_pocz" name="data_pocz" type="date" min="2023-02-03" required>
            </p>
            <p class="p-4">
                <label for="data_kon">Data końcowa:</label>
                <input id="data_kon" name="data_kon" type="date" min="2023-02-03" required>
            </p>
            <p class="p-4">
                <label for="ochrona1">Ochrona:</label>
                <input type="radio" name="ochrona" id="ochrona1" value="pelna" checked required>
                <label for="ochrona1">Pełna</label>
                <input type="radio" name="ochrona" id="ochrona2" value="czesciowa" required>
                <label for="ochrona2">Częściowa</label>
                <input type="radio" name="ochrona" id="ochrona3" value="brak" required>
                <label for="ochrona3">Brak</label>
            </p>
            <p class="p-4">
                <label for="pakiet1">Pakiet:</label>
                <input type="radio" name="pakiet" id="pakiet1" value="premium" checked required>
                <label for="pakiet1">Premium</label>
                <input type="radio" name="pakiet" id="pakiet2" value="elastyczny" required>
                <label for="pakiet2">Elastyczny</label>
                <input type="radio" name="pakiet" id="pakiet3" value="comfort" required>
                <label for="pakiet3">Comfort</label>
                <input type="radio" name="pakiet" id="pakiet4" value="brak" required>
                <label for="pakiet4">Brak</label>
            </p>
            <p class="p-4 items-center"><button id="wynajem" type="submit" class="text-white p-2 rounded-md bg-gray-800 hover:text-gray-800 hover:bg-red-500 duration-150">Wynajmij {{$samochody->nazwa}}</button></p>
        </form>
        <br>
        @include('partials.error')
        <br>
        <div id="kwota" class="form-inline rounded-md bg-gray-500 p-4 hidden">
        <h2 class="p-4 text-3xl"><b>Kwota do zapłaty:</b></h2>
            <div class="form-inline rounded-md bg-gray-800 text-white p-4">
                <p class="p-4" id="dni"></p>
                <p class="p-4" id="zaDzien"></p>
                <p class="p-4" id="wynik"></p>
                <p class="p-4" id="kaucja"></p>
            </div>
        </div>
        <script>
            const kwota = document.getElementById("kwota");
            const wynajem = document.getElementById("wynajem");
            const calculateBtn = document.getElementById("wyliczanieKwoty");
            const startDate = document.getElementById("data_pocz");
            const endDate = document.getElementById("data_kon");
            const result = document.getElementById("wynik");
            const kaucja = document.getElementById("kaucja");
            const zaDzien = document.getElementById("zaDzien");
            const dni = document.getElementById("dni");
            const radioButtons = document.querySelectorAll('input[type="radio"]');

            wynajem.addEventListener("click", wyliczanieKosztow);

            //calculateBtn.addEventListener("click", wyliczanieKosztow);
            
            radioButtons.forEach(button => {button.addEventListener("click", wyliczanieKosztow);});

            startDate.addEventListener("change", wyliczanieKosztow);
            endDate.addEventListener("change", wyliczanieKosztow);

            function wyliczanieKosztow() {

                kwota.style.display = "block";
                let sumaDodatkow = 0;

                radioButtons.forEach(button => {
                    if (button.checked) {
                        const selectedValue = button.value;
                        console.log(`Wybrana wartość: ${selectedValue}`);
                        switch (selectedValue) {
                            case "pelna":
                                sumaDodatkow = sumaDodatkow + 100;
                                break;
                            case "czesciowa":
                                sumaDodatkow = sumaDodatkow + 60;
                                break;
                            case "premium":
                                sumaDodatkow = sumaDodatkow + 200;
                                break;
                            case "elastyczny":
                                sumaDodatkow = sumaDodatkow + 140;
                                break;
                            case "comfort":
                                sumaDodatkow = sumaDodatkow + 80;
                                break;
                            default:
                                sumaDodatkow = sumaDodatkow + 0;
                                break;
                        }
                    }
                });
                
                let komunikat = 'cos';
                const start = new Date(startDate.value);
                const end = new Date(endDate.value);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                const zaplataZaDzien = {{$samochody->stawka_dzienna}} + sumaDodatkow;
                const wynik = diffDays * zaplataZaDzien;

                if (isNaN(diffDays)) {
                    komunikat = 'Wybierz date!';
                    komunikat2 = '---';
                }
                else {
                    komunikat = diffDays + ' dni';
                    komunikat2 = wynik + ' zł';
                }

                dni.innerHTML = `Wynajem na <i class="text-red-600 font-bold">${komunikat}</i>`;

                zaDzien.innerHTML = `Kwota za dzień to <i class="text-red-600 font-bold">${zaplataZaDzien} zł</i>`;

                result.innerHTML = `Zatem całość wynosi <i class="text-red-600 font-bold">${komunikat2}</i>`;

                kaucja.innerHTML = `+ kaucja: <i class="text-red-600 font-bold">{{$samochody->kaucja}} zł</i>`;

                sesja_kaucja = {{$samochody->kaucja}};

                try {
                    sessionStorage.setItem("dni", `${diffDays}`);
                    sessionStorage.setItem("zaDzien", `${zaplataZaDzien}`);
                    sessionStorage.setItem("wynik", `${wynik}`);
                    sessionStorage.setItem("kaucja", `${sesja_kaucja}`);
                } catch (e) {
                    console.error(e);
                } 
            }

        </script>
    </div>
    @include('partials.footer')
</body>
</html>
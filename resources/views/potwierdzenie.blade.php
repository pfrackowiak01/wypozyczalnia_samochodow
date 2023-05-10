<!DOCTYPE html> 
<html lang="pl"> 
  @include('partials.head') 
  <body class="bg-gray-100"> 
    @include('partials.navi') 
    <div class="p-2 text-center text-xl"> 
      <br>
      <h1 class="text-3xl font-bold underline">Gratulacje</h1> 
      <br>
      <h3><i>Udało się <b>{{auth()->user()->name}}</b>!</i>
      <br>Pomyślnie zajerestrowano twoją rezerwacje na <b><i id="dni"></i></b> dni!
      <br>Jest już w naszej bazie danych i jej numer id to <i><b>{{$rezerwacje->id_rezerwacji}}</b></i>
      <br>Twoje wzięte dodatki z naszej oferty to ochrona: <i><b>{{$rezerwacje->ochrona}}</b></i> i pakiet: <i><b>{{$rezerwacje->pakiet}}</b></i>
      <br>Za jeden dzień wynajmu płacisz: <b><i id="zaDzien"></i> zł</b>
      <br><i class="text-gray-500">(koszt_wynajmu = koszt_samochodu + koszt_ochrony + koszt_pakietu)</i>
      <br>
      <br>Jedyne co teraz musisz zrobić to zapłacić kaucje do 24 godzin o wysokości: <b><i id="kaucja"></i> zł</b>
      <br>Lub możesz od razu przelać całą kwotę <b><i id="wynik"></i> zł</b> na numer 10 1160 6000 5432 2011 0000 2137.
      <br><i class="text-red-600">(Jeżeli tego nie zrobisz to twoja rezerwacja przepadnie! Masz 24 godziny od teraz!)</i>
      <br>
      <br>W razie wszelkich pytań lub do upewnienia się, czy dane się zgadzają zachęcamy do kontaktu: <b>667-230-819</b>
      <br><i class="text-red-600">(Uwaga: jeżeli chcesz zmienić plany, dane lub anulować rezerwacje to również prosimy dzwonić pod ten numer!)</i>
      <br>
      <br>Potwierdzenie i szczegóły rezerwacji wysłaliśmy na emaila. 
      <br>Prosimy o kontakt co do ustalenia godziny i miejsca odbioru auta. DZIĘKUJEMY, że nas wspieracie!
      <br>Życzymy miłego dnia oraz podróży w dzień wynajmu!  <i>~zespół BudgetExpress24</i>
      <br></h3>
      <br>
      <br>
      <br>
      <br>
      <script>
        // Deklaracja zmiennej, w której będą przechowywane dane
        var wynik;
        var kaucja;
        var dni;
        var zaDzien;

        // Funkcja, która odczytuje dane z session storage i wyświetla je na stronie
        function getDataFromSessionStorage() {
            wynik = sessionStorage.getItem("wynik");
            document.getElementById("wynik").innerHTML = wynik;
            kaucja = sessionStorage.getItem("kaucja");
            document.getElementById("kaucja").innerHTML = kaucja;
            dni = sessionStorage.getItem("dni");
            document.getElementById("dni").innerHTML = dni;
            zaDzien = sessionStorage.getItem("zaDzien");
            document.getElementById("zaDzien").innerHTML = zaDzien;
        }

        // Wywołanie funkcji po załadowaniu strony
        window.onload = function() {
            getDataFromSessionStorage();
        }
      </script>
    </div> 
    @include('partials.footer')
  </body> 
</html>
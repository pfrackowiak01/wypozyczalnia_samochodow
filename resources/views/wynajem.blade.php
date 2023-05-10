<!DOCTYPE html> 
<html lang="pl"> 
  @include('partials.head') 
  <body class="bg-gray-100"> 
    @include('partials.navi') 
    <div class="p-2 text-center text-xl md:text-3xl"> 
      <br>
      <h1 class="text-3xl font-bold underline">WYNAJEM SAMOCHODÓW</h1> 
      <br><p><b>Najtańsze auta do wynajmu w Trójmieście!</b>
      <br>- ekspresowy odbiór
      <br>- bezpłatne odwołanie rezerwacji do 24 godzin przed odbiorem
      <br>- obsługa klienta czynna 24 godziny na dobe
      <br></p>
      <br>
      <div class="flex flex-wrap items-center justify-center p-2" style="flex-wrap:wrap;">
        @foreach($samochody as $el)
        <div class="p-6">
            <p><b class="text-3xl">{{$el->nazwa}}</b>
            <br><img class="p-4" src="{{ asset('images/'.$el->obrazek) }}" alt="{{$el->obrazek}}" width="350" height="250">
            <br>
            <br>Skrzynia biegów <b>{{$el->skrzynia_bieg}}</b>
            <br>Klasa: {{$el->klasa}}
            <br>Ilość miejsc: {{$el->miejsca}}
            <br>Pojemność bagażnika: {{$el->bagaz}} l
            <br>Już od {{$el->stawka_dzienna}} brutto
            <br>Silnik: {{$el->silnik}}
            <br> 
            @if ($el->silnik == "elektryczny") 
            Zasięg: {{$el->spalanie}} km
            @else 
            Spalanie: {{$el->spalanie}} l/100 km 
            @endif
            <br>
            <br><a href="<?=config('app.url'); ?>/wynajem/{{$el->id_samochodu}}" class="text-white p-2 rounded-md bg-red-600 hover:bg-red-500 duration-150">wynajmij</a>
            </p>
        </div>
        @endforeach
        </tbody>
        </table>
    </div>
      <br>
      <br>
    </div> 
    @include('partials.footer')
  </body> 
</html>
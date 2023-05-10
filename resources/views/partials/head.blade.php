<head>
<meta charset="UTF-8">
<title>BudgetExpress24h</title>
<!-- <link rel="stylesheet" href="{{ URL::asset('styles.css') }}" /> -->
<!-- @vite('resources/css/app.css') -->
<link rel="stylesheet" href="{{ tailwindcss('css/app.css') }}" />
<style>

th, td {
  border-bottom: 1px solid #ddd;
  padding: 5px;
}

tr:nth-child(even) {
  background-color: #e5e5e5;
}

thead {
  background-color: rgb(156 163 175);
}

tbody tr:hover {
  background-color: #d9d9d9;
}

@media (min-width: 0px) {
  body {
    font-size: 180%;
  }
}

@media (min-width: 600px) {
  body {
    font-size: 160%;
  }
}

@media (min-width: 800px) {
  body {
     font-size: 140%;
  }
}

@media (min-width: 1000px) {
  body {
     font-size: 120%;
  }
}

@media (min-width: 1200px) {
  body {
     font-size: 100%;
  }
}
</style>
</head>
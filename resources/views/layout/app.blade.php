<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @if (isset($title)){{ $title }}
        @else
        Backend79
        @endif
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    @stack('css')
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url("/") }}">Latihan 79</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->segment(1)==""||request()->segment(1)==trim("
                                customer")?"active":"") }}" aria-current="page" href="{{ url("customer")
                                }}">Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->segment(1)== trim(" transaction")?"active":"") }}"
                                aria-current="page" href="{{ url("transaction") }}">Transaction</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->segment(1)== trim(" tabungan")?"active":"") }}"
                                aria-current="page" href="{{ url("tabungan") }}">Report Tabungan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->segment(1)== trim(" poin")?"active":"") }}"
                                aria-current="page" href="{{ url("poin") }}">Poin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>

    @stack('js')
</body>

</html>
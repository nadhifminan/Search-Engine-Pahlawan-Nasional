<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>SearchPahlawan</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<body>

    <header>
        <nav style="background-image: linear-gradient(to right, red, white);" class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded">
            <a class="navbar-brand" href="#">Searching pahlawan > Nadhif Fajrul Minan (22041111000060)</a>
        </nav>
    </header>

    <main role="main" style="height:200px; background-color:rgba(128, 128, 128, 0.5);">
        <div class="container pt-5" style="text-align: center;">
            <!-- Another variation with a button -->
            <form action="#" method="GET" onsubmit="return false">
            <h1 style="color:white; font-size:45px;">Search Engine Pahlawan Nasional</h1>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Pahlawan" name="q" id="cari">
                <div class="col-lg-1">
                <select class="form-control" name="rank" id="rank">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                  </select>
                </div>
                <select class="form-control" name="provinsi" id="provinsi">
                    <option value="semua">Semua</option>
                    <option value="Jawa Tengah">Jawa Tengah</option>
                    <option value="Jawa Timur">Jawa Timur</option>
                    <option value="Jawa Barat">Jawa Barat</option>
                    <option value="Sumatera Barat">Sumatera Barat</option>
                    <option value="Sumatera Utara">Sumatera Utara</option>
                    <option value="Sumatera Selatan">Sumatera Selatan</option>
                    <option value="Sumatera Tengah">Sumatera Tengah</option>
                    <option value="Sumatera Timur">Sumatera Timur</option>
                    <option value="Riau">Riau</option>
                    <option value="DIY (Yogyakarta)">DIY (Yogyakarta)</option>
                    <option value="maluku">Maluku</option>
                    <option value="Maluku Utara">Maluku Utara</option>
                    <option value="Papua">Papua</option>
                    <option value="Bali">Bali</option>
                    <option value="Banten">Banten</option>
                    <option value="NAD (Aceh)">NAD (Aceh)</option>
                    <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                    <option value="Kalimantan Barat">Kalimantan Barat</option>
                    <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                    <option value="NTT (Nusa Tenggara Timur)">NTT (Nusa Tenggara Timur)</option>
                    <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                    <option value="Sulawesi Utara">Sulawesi Utara</option>
                </select>
                <div class="input-group-append">
                    <input class="btn btn-secondary fas fa-search" id="search" type="submit" value="Search">
                </div>
            </div>
        </form>
        </div>
    </main>

    <div class="row m-4" id="content">
     
    </div>

    <script>
    $(document).ready(function() {
        $("#search").click(function(){
            var cari = $("#cari").val();
            var rank = $("#rank").val();
            var provinsi = $("#provinsi").val();
            $.ajax({
                url:'/search?q='+cari+'&rank='+rank+'&provinsi='+provinsi,
                dataType : "json",
                success: function(data){
                         $('#content').html(data);
                    },
                    error: function(data){
                        alert("Please insert your command");
                    }
            });
        });
    });
</script>
</body>
</html>
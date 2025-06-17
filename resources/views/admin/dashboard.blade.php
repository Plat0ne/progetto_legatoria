@extends('admin.main-layout')


@section('main')

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">

   </div>
 


    <div class="row">

        <!-- Area Chart -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Overview Temperature Ambiente</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <hr class="hr-color-black">
    <h2 class="mb-4 text-fill">Orari Fasi giornata {{ date('d/m/Y') }}</h2>

    <div class="row">
        <!-- Orari Fasi -->
        @foreach ($orari_giornata_fase as $fase => $orario)
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 ">
                <div class="card article-card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Orari totali {{ $fase }}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        {{ $orario }}
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection


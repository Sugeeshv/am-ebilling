@extends('layouts.app')

@section('content')
<main class="main" id="top">
    @include('layouts.menu')

    <div class="content">
        <div class="pb-5">
            @canany(['role-list'])
            <div class="row g-4">

                <div class="col-12 col-xxl-9">
                    <!-- <div class="chart-container"> -->
                    <div style="margin-bottom:10px;">
                        <select id="viewType" onchange="changeView()">
                            <option value="day">Day</option>
                            <option value="month">Month</option>
                            <option value="year">Year</option>
                        </select>

                        <button onclick="previousRange()">◀ Previous</button>
                        <button onclick="nextRange()">Next ▶</button>
                    </div>

                    <canvas id="chart" style="height:400px;"></canvas>
                    <!-- </div> -->

                </div>
                <div class="col-12 col-xxl-3">
                    <div class="row g-3">
                        <div class="col-12 col-md-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="mb-1">Total orders<span
                                                    class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2"><span
                                                        class="badge-label">-6.8%</span></span></h5>
                                            <h6 class="text-body-tertiary">Last 7 days</h6>
                                        </div>
                                        <h4>16,247</h4>
                                    </div>
                                    <div class="d-flex justify-content-center px-4 py-6">
                                        <div class="echart-total-orders" style="height:85px;width:115px"></div>
                                    </div>
                                    <div class="mt-2">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bullet-item bg-primary me-2"></div>
                                            <h6 class="text-body fw-semibold flex-1 mb-0">Completed</h6>
                                            <h6 class="text-body fw-semibold mb-0">52%</h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="bullet-item bg-primary-subtle me-2"></div>
                                            <h6 class="text-body fw-semibold flex-1 mb-0">Pending payment</h6>
                                            <h6 class="text-body fw-semibold mb-0">48%</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="mb-1">New customers<span
                                                    class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2">
                                                    <span class="badge-label">+26.5%</span></span></h5>
                                            <h6 class="text-body-tertiary">Last 7 days</h6>
                                        </div>
                                        <h4>356</h4>
                                    </div>
                                    <div class="pb-0 pt-4">
                                        <div class="echarts-new-customers" style="height:180px;width:100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcanany
            <div class="row g-4">
                <div class="col-12 col-xxl-12">
                    <div class="row g-3">
                        <div class="col-12 col-md-8">
                            <div class="card shadow-none border mb-3">
                                <div class="card-header p-4 border-bottom bg-body">
                                    <div class="row g-3 justify-content-between align-items-center">
                                        <div class="col-12 col-md">

                                            
                                            @php
                                            $currentDate = \Carbon\Carbon::now()->toDateString();
                                            @endphp

                                                
                                            
                                            <h3>{{$routeid[0]->route_name}}</h3>
                                            <hr>
                                            <h4 class="text-body mb-0"> Date : {{ \Carbon\Carbon::parse($date)->format('D / M / Y') }}</h4>
                                        </div>
                                        <div class="col-3 ">
                                            <form class="input-group " method="POST"
                                                action="{{ route('filter.stocks') }}">
                                                @csrf
                                                <input class="form-control" type="date" name="date"
                                                    value="{{ $date ?? '' }}" placeholder="Recipient's username"
                                                    aria-label="Recipient's username" aria-describedby="basic-addon2"
                                                    required>
                                                <button type="submit" class="input-group-text"
                                                    id="basic-addon2">Go</button>
                                            </form>
                                        </div>
                                        <div class="col col-md-auto">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="p-4 code-to-copy">
                                        <div id="">
                                            
                                            <ul class="nav nav-underline fs-9" id="myTab" role="tablist">
                                            @foreach($routeid as $route)
                                            
                                                <li class="nav-item" role="presentation"><a class="nav-link @if($route->id == ($tab ?? '')) active @endif" id="home-tab" data-bs-toggle="tab" href="#tab-home{{$route->id}}" role="tab" aria-controls="tab-home{{$route->id}}" aria-selected="true">{{$route->sub_route}}</a></li>
                                            @endforeach
                                            </ul>
                                            <div class="tab-content mt-3" id="myTabContent">
                                            @foreach($routeid as $route)
                                                <div class="tab-pane fade show @if($route->id == ($tab ?? '')) active @endif" id="tab-home{{$route->id}}" role="tabpanel" aria-labelledby="home-tab">
                                                    <button type="button" class="btn btn-success btn-sm addRow mb-5" data-route="{{$route->id}}">+ Add Row</button>
                                                    <br>
                                                     <form method="POST" action="{{ route('create.stock') }}">
                                                    @csrf
                                                    <input type="hidden" name="route_id" value="{{ $route->id }}">

                                                    <table class="table table-bordered stockTable" id="stockTable{{$route->id}}">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:50px">#</th>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th width="100">Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @if($stocks->count() > 0)

                                                            @php $row = 1; @endphp

                                                            @foreach($stocks as $stock)
                                                            @if($route->id == $stock->routedate_id)
                                                            @php
                                                            $totalrouteorder=0;
                                                            @endphp
                                                            <tr>
                                                                <td class="row-number">
                                                                    <p class="ml-2">{{ $row++ }}</p>
                                                                </td>

                                                                <td>
                                                                    <select name="product_id[]" class="form-control">
                                                                        @foreach($products as $product)
                                                                        <option value="{{ $product->id }}"
                                                                            {{ $stock->item_name == $product->item_name ? 'selected' : '' }}>
                                                                            {{ $product->item_name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>

                                                                <td>
                                                                    <input type="number" class="form-control"
                                                                        value="{{ $stock->unit_price }}" disabled="">
                                                                </td>

                                                                <td>
                                                                    <input type="number" name="quantity[]"
                                                                        class="form-control"
                                                                        value="{{ $stock->quantity }}" required>
                                                                </td>

                                                                <td>
                                                                    <a href="{{ route('stock.delete', $stock->id) }}"
                                                                        class="btn btn-danger btn-sm">X</a>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @php
                                                            $totalrouteorder += $stock->quantity;
                                                            $productprice = $stock->unit_price ?? 0;
                                                            @endphp
                                                            @endforeach

                                                            @else

                                                            <tr>
                                                                <td class="row-number">
                                                                    <p class="ms-2">1</p>
                                                                </td>

                                                                <td>
                                                                    <select name="product_id[]"
                                                                        class="form-control product-select" required>
                                                                        <option value="">Select Product</option>
                                                                        @foreach($products as $product)
                                                                        <option value="{{ $product->id }}"
                                                                            data-price="{{ $product->price }}">
                                                                            {{ $product->item_name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>

                                                                <td>
                                                                    <input type="number" name="price[]"
                                                                        class="form-control price" disabled="" readonly>
                                                                </td>

                                                                <td>
                                                                    <input type="number" name="quantity[]"
                                                                        class="form-control qty" required>
                                                                </td>


                                                                <td>
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-sm removeRow">X</button>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        <tfoot>
                                                            <tr>
                                                                <td></td>
                                                                <td><b>Total order</b></td>
                                                                <td colspan="1">
                                                                    <p>{{ $productprice ?? 0 }}</p>
                                                                </td>
                                                                <td colspan="2" class="text-right"><b
                                                                        id="totalOrderAmount">
                                                                        {{ number_format($totalrouteorder ?? 0, 2) }}
                                                                    </b></td>
                                                            </tr>
                                                        </tfoot>
                                                        </tbody>
                                                    </table>
                                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                </form>
                                                </div>
                                            @endforeach
                                            </div>
                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer position-absolute">
                <div class="row g-0 justify-content-between align-items-center h-100">
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 mt-2 mt-sm-0 text-body">Thank you for creating with Phoenix<span
                                class="d-none d-sm-inline-block"></span><span
                                class="d-none d-sm-inline-block mx-1">|</span><br class="d-sm-none" />2025 &copy;<a
                                class="mx-1" href="https://themewagon.com/">Themewagon</a></p>
                    </div>
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-body-tertiary text-opacity-85">v1.24.0</p>
                    </div>
                </div>
            </footer>
        </div>
</main>
@endsection

@push('chartscripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
<!-- chart -->

<script>
let rowCount = document.querySelectorAll("#stockTable tbody tr").length;
document.addEventListener("click", function(e){

if(e.target.classList.contains("addRow")){

let routeId = e.target.dataset.route;

let table = document.querySelector("#stockTable"+routeId+" tbody");

let rowCount = table.querySelectorAll("tr").length + 1;

let row = `

<tr>

<td class="row-number">${rowCount}</td>

<td>

<select name="product_id[]" class="form-control">

<option value="">Select Product</option>

@foreach($products as $product)

<option value="{{ $product->id }}">

{{ $product->item_name }}

</option>

@endforeach

</select>

</td>

<td>

<input type="number" name="price[]" class="form-control" disabled>

</td>

<td>

<input type="number" name="quantity[]" class="form-control" required>

</td>

<td>

<button type="button" class="btn btn-danger btn-sm removeRow">X</button>

</td>

</tr>

`;

table.insertAdjacentHTML('beforeend',row);

}

});
</script>

<script>
// sample stock data (any size)

const stockData = [
    @foreach($stocks as $stock) {
        x: '{{ $stock->stock_date }}',
        y: {
            {
                $stock - > total_quantity
            }
        }
    },
    @endforeach
];

let viewType = 'day';
let startDate, endDate;

// default range
setInitialRange();

const chart = new Chart(document.getElementById('chart'), {
    type: 'bar',
    data: {
        datasets: [{
            label: 'Stock',
            data: stockData,
            backgroundColor: 'rgba(40,107,242,0.3)',
            borderColor: 'rgb(56,134,229)',
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            x: {
                type: 'time',
                min: startDate,
                max: endDate,
                time: {
                    unit: viewType
                }
            },
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            zoom: {
                pan: {
                    enabled: true,
                    mode: 'x'
                },
                zoom: {
                    wheel: {
                        enabled: true
                    },
                    pinch: {
                        enabled: true
                    },
                    drag: {
                        enabled: true // optional box zoom
                    },
                    mode: 'x'
                }
            }
        }
    }
});

// 🔄 Change Day / Month / Year
function changeView() {
    viewType = document.getElementById('viewType').value;
    setInitialRange();
    updateChart();
}

// ⏪ Previous
function previousRange() {
    moveRange(-1);
}

// ⏩ Next
function nextRange() {
    moveRange(1);
}

// 🧠 Helpers
function setInitialRange() {
    endDate = new Date();

    startDate = new Date(endDate);
    if (viewType === 'day') startDate.setDate(endDate.getDate() - 7);
    if (viewType === 'month') startDate.setMonth(endDate.getMonth() - 6);
    if (viewType === 'year') startDate.setFullYear(endDate.getFullYear() - 5);
}

function moveRange(direction) {
    if (viewType === 'day') {
        startDate.setDate(startDate.getDate() + direction * 7);
        endDate.setDate(endDate.getDate() + direction * 7);
    }
    if (viewType === 'month') {
        startDate.setMonth(startDate.getMonth() + direction * 6);
        endDate.setMonth(endDate.getMonth() + direction * 6);
    }
    if (viewType === 'year') {
        startDate.setFullYear(startDate.getFullYear() + direction * 5);
        endDate.setFullYear(endDate.getFullYear() + direction * 5);
    }

    // prevent future dates
    if (endDate > new Date()) {
        endDate = new Date();
    }

    updateChart();
}

function updateChart() {
    chart.options.scales.x.min = startDate;
    chart.options.scales.x.max = endDate;
    chart.options.scales.x.time.unit = viewType;
    chart.update();
}
</script>
@endpush
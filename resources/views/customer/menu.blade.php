@extends('customer.layouts.master')

@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Menu</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item active text-primary">Berbagai pilihan menu terbaik</li>
    </ol>
</div>
<!-- Single Page Header End -->
<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-3">
                    <div class="col-lg">
                        <div class="row g-4 justify-content-center">

                            @foreach ($items as $item)
                            <div class="col-md-6 col-lg-6 col-xl-4">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="{{ asset('img_item_upload/'. $item->img) }}" class="img-fluid w-100 rounded-top" alt="" onerror="this.onerror=null;this.src='{{  $item->img }}';">
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute
                                        @if ($item->category->cat_name == 'Makanan')
                                            bg-warning
                                        @elseif ($item->category->cat_name == 'Minuman')
                                            bg-info
                                        @else
                                            bg-primary
                                        @endif" style="top: 10px; left: 10px;">
                                            {{ $item->category->cat_name }}
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4>{{ $item->name }}</h4>
                                        <p class="text-limited">{{ $item->description }}</p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0">{{ 'Rp'. number_format($item->price, 0, ',','.') }}</p>
                                            <a href="#" onclick="addToCart({{ $item->id }})" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Tambah Keranjang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->
@endsection

@section('script')
    <script>
        function addToCart(menuId) {
            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: menuId })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message)
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    </script>
@endsection

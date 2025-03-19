@extends('customer.layouts.master')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (empty($cart))
            <h4 class="text-center">Keranjang anda kosong</h4>
        @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Gambar</th>
                    <th scope="col">Menu</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>

                    @php
                        $subTotal = 0;
                    @endphp

                    {{-- kemarin sampai sini --}}
                    @foreach ($cart as $item)
                        @php
                            $itemTotal = $item['price'] * $item['qty'];
                            $subTotal += $itemTotal;
                        @endphp
                    <tr>
                        <th scope="row">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('img_item_upload/'. $item['image']) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="" onerror="this.onerror=null;this.src='{{  $item['image'] }}';">
                            </div>
                        </th>
                        <td>
                            <p class="mb-0 mt-4">{{ $item['name'] }}</p>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">{{ 'Rp'. number_format($item['price'], 0, ',','.') }}</p>
                        </td>
                        <td>
                            <div class="input-group quantity mt-4" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm text-center border-0" value="{{ $item['qty'] }}" readonly>
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="mb-0 mt-4">{{ 'Rp'. number_format($item['price'] * $item['qty'], 0, ',','.') }}</p>
                        </td>
                        <td>
                            <button class="btn btn-md rounded-circle bg-light border mt-4" >
                                <i class="fa fa-times text-danger"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @php
            $tax = $subTotal * 0.1;
            $total = $subTotal + $tax;
        @endphp

        <div class="row g-4 justify-content-end mt-1">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h2 class="display-6 mb-4">Total <span class="fw-normal">Pesanan</span></h2>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal</h5>
                            <p class="mb-0">Rp{{ number_format($subTotal, 0, ',','.') }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="mb-0 me-4">Pajak (10%)</p>
                            <div class="">
                                <p class="mb-0">Rp{{ number_format($tax, 0, ',','.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-4 mb-4 border-top d-flex justify-content-between">
                        <h4 class="mb-0 ps-4 me-4">Total</h4>
                        <h5 class="mb-0 pe-4">Rp{{ number_format($total, 0, ',','.') }}</h5>
                    </div>

                </div>
                <div class="d-flex justify-content-end">
                    <div class="mb-0 mb-3">
                        <a href="{{ route('checkout') }}" class="btn border-secondary py-3 text-primary text-uppercase mb-4" type="button">Lanjut ke Pembayaran</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

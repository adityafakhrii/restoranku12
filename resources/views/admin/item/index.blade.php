@extends('admin.layouts.master')
@section('title', 'Daftar Menu')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/table-datatable.css') }}">
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Menu</h3>
                <p class="text-subtitle text-muted">Berbagai pilihan menu terbaik</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <a href="{{ route('items.create') }}" class="btn btn-primary float-start float-lg-end">
                    <i class="bi bi-plus"></i>
                    Tambah Menu
                </a>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Item</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('img_item_upload/'. $item->img) }}" width="60" class="img-fluid rounded-top" alt="" onerror="this.onerror=null;this.src='{{  $item->img }}';">
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ Str::limit($item->description,15) }}</td>
                            <td>{{ 'Rp'. number_format($item->price, 0, ',','.') }}</td>
                            <td>
                                <span class="badge {{ $item->category->cat_name == 'Makanan' ? 'bg-warning' : 'bg-info' }}">
                                    {{ $item->category->cat_name }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $item->is_active == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Ubah
                                </a>
                            </td>
                            <td>
                                @if ($item->is_active == 1)
                                    <form action="{{ route('items.updateStatus', $item->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="is_active" value="0">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menonaktifkan menu ini?')">
                                            <i class="bi bi-x"></i> Nonaktifkan
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('items.updateStatus', $item->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="is_active" value="1">
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah anda yakin ingin mengaktifkan menu ini?')">
                                            <i class="bi bi-check"></i> Aktifkan
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/admin/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/admin/static/js/pages/simple-datatables.js') }}"></script>
@endsection

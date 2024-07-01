@extends('layouts.app')
@section('content')
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="" src="{{ Vite::asset('resources/images/LOGO.png') }}" alt="" style="width: 180px; height: 130px;">
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{route('home')}}" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dasbor</a>
                    <a href="{{route('ProductCategories.index')}}" class="nav-item nav-link"><i class="fa fa-shopping-cart me-2"></i>Kategori Prduk</a>
                    <a href="{{route('Product.index')}}" class="nav-item nav-link"><i class="fa fa-shopping-cart me-2"></i>Produk</a>
                    <a href="{{route('customer.index')}}" class="nav-item nav-link"><i class="fa fa-user-friends me-2"></i>Pelanggan</a>
                    <a href="{{ route('transaction.create', AppHelper::transaction_code())}}" class="nav-item nav-link"><i class="fa fa-cash-register me-2"></i>Transaksi</a>
                    <a href="{{route('transaction.index')}}" class="nav-item nav-link active"><i class="fa fa-chart-bar me-2"></i>Penjualan</a>
                    <a href="{{route('company.index')}}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Profil</a>
                    <a href="{{ route('logout') }}" class="nav-item nav-link"><i class="fa fa-sign-out-alt me-2"
                     onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        </i>
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <div class="content">
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto me-3">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="rounded-circle me-lg-2 fa fa-user me-2"></i>
                            <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
                        </a>
                    </div>
                </div>
            </nav>
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="ms-4 mt-4">Penjualan Terbaru</h4>
                <a href="" class="btn btn-success mt-4 me-4">Buka POS</a>
            </div>

            <div class="container-fluid pt-4 px-4">

                <div class="bg-secondary text-center rounded p-4">
                    <div class="row g-2">
                        <div class="col-md-12">
                            <form action="">
                                <div class="row">
                                    <div class="col-md 5">
                                        <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" style="background-color: #ffffff" />
                                    </div>
                                    <div class="col-md-5">
                                        <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}"style="background-color: #ffffff"  />
                                    </div>
                                    <div class="col-md-2 ms-5 ">
                                        <button class="btn btn-dark" type="submit" style="background-color: #358EE0"><i class="fas fa-filter"></i> Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr style="color:#ffffff ">
                        <table class="table text-start align-middle table-bordered table-hover mt-4">
                            <thead>
                                <tr class="text-white">
                                    <th class="text-center" scope="col">No</th>
                                    <th scope="col">Kode Transaksi</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Tanggal</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $item->transaction_code }}</td>
                                        <td>{{ $item->customer->name }}</td>
                                        <td>{{ number_format($item->sub_total, 0,',',',') }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('transaction.show', $item->transaction_code) }}" class="btn btn-primary btn-icon icon-left">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            Belum ada data transaksi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>


                        {{-- <!-- Footer Start -->
                        <div class="container-fluid pt-4 px-4">
                            <div class="bg-secondary rounded-top p-4">
                                <div class="row">
                                    <div class="col-12 col-sm-6 text-center text-sm-start">
                                        &copy; <a href="#">RYPOS SYSTEM</a>, All Right Reserved.
                                    </div>
                                    <div class="col-12 col-sm-6 text-center text-sm-end">
                                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                                        Designed By <a href="https://htmlcodex.com">ThreeDeveloper</a>
                                        <br>Distributed By: <a href="https://themewagon.com" target="_blank">RYPOS SYSTEM</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Footer End --> --}}
                    </div>
@endsection

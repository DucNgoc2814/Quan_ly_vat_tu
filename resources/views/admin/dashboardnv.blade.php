@extends('admin.layouts.masternv')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">NFT Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                    <li class="breadcrumb-item active">NFT Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row dash-nft">
    <div class="col-xxl-9">
        <div class="row">
            <div class="col-xl-6">
                <div class="card overflow-hidden">
                    <div class="card-body bg-marketplace d-flex">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 lh-base mb-0">Discover, Collect, Sell and Create <br> your own <span class="text-success">NFTs.</span> </h4>
                            <p class="mb-0 mt-2 pt-1 text-muted">The world's first and largest digital marketplace.</p>
                            <div class="d-flex gap-3 mt-4">
                                <a href="#!" class="btn btn-primary">Discover Now </a>
                                <a href="#!" class="btn btn-success">Create Your Own</a>
                            </div>
                        </div>
                        <img src="{{asset('themes/admin/assets/images/bg-d.png')}}" alt="" class="img-fluid" />
                    </div>
                </div>
            </div><!--end col-->
            <div class="col-xl-3 col-md-6">
                <div class="card card-height-100">
                    <div class="card-body">
                        <div class="float-end">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted fs-18"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Last Week</a>
                                    <a class="dropdown-item" href="#">Last Month</a>
                                    <a class="dropdown-item" href="#">Current Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-info-subtle rounded fs-3">
                                    <i class="bx bx-dollar-circle text-info"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ps-3">
                                <h5 class="text-muted text-uppercase fs-13 mb-0">Total Revenue</h5>
                            </div>
                        </div>
                        <div class="mt-4 pt-1">
                            <h4 class="fs-22 fw-semibold ff-secondary mb-0">$<span class="counter-value" data-target="559526.564"></span> </h4>
                            <p class="mt-4 mb-0 text-muted"><span class="badge bg-danger-subtle text-danger mb-0 me-1"> <i class="ri-arrow-down-line align-middle"></i> 3.96 % </span> vs. previous month</p>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
            <div class="col-xl-3 col-md-6">
                <div class="card card-height-100">
                    <div class="card-body">
                        <div class="float-end">
                            <div class="dropdown card-header-dropdown">
                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="text-muted fs-18"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Last Week</a>
                                    <a class="dropdown-item" href="#">Last Month</a>
                                    <a class="dropdown-item" href="#">Current Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-info-subtle rounded fs-3">
                                    <i class="bx bx-wallet text-info"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ps-3">
                                <h5 class="text-muted text-uppercase fs-13 mb-0">Estimated</h5>
                            </div>
                        </div>
                        <div class="mt-4 pt-1">
                            <h4 class="fs-22 fw-semibold ff-secondary mb-0">$<span class="counter-value" data-target="624562.564"></span> </h4>
                            <p class="mt-4 mb-0 text-muted"><span class="badge bg-success-subtle text-success mb-0"> <i class="ri-arrow-up-line align-middle"></i> 16.24 % </span> vs. previous month</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-xxl-8">
                                <div class="">
                                    <div class="card-header border-0 align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Marketplace</h4>
                                        <div>
                                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                                ALL
                                            </button>
                                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                                1M
                                            </button>
                                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                                6M
                                            </button>
                                            <button type="button" class="btn btn-soft-primary btn-sm">
                                                1Y
                                            </button>
                                        </div>
                                    </div><!-- end card header -->
                                    <div class="row g-0 text-center">
                                        <div class="col-6 col-sm-4">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value" data-target="36.48">0</span>k</h5>
                                                <p class="text-muted mb-0">Aetworks</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-4">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value" data-target="92.54">0</span>k</h5>
                                                <p class="text-muted mb-0">Auction</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-4">
                                            <div class="p-3 border border-dashed border-end-0">
                                                <h5 class="mb-1"><span class="counter-value" data-target="8.62">0</span>k</h5>
                                                <p class="text-muted mb-0">Creators</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <div id="line_chart_basic" data-colors='["--vz-primary","--vz-success", "--vz-light"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>

                            <div class="col-xxl-4">
                                <div class="border-start p-4 h-100 d-flex flex-column">

                                    <div class="w-100">
                                        <div class="d-flex align-items-center">
                                            <img src="https://img.themesbrand.com/velzon/images/img-2.gif" class="img-fluid avatar-xs rounded-circle object-fit-cover" alt="">
                                            <div class="ms-3 flex-grow-1">
                                                <h5 class="fs-16 mb-1">Trendy Fashion Portraits</h5>
                                                <p class="text-muted mb-0">Artwork</p>
                                            </div>
                                            <div class="dropdown">
                                                <a href="javascript:void(0);" class="align-middle text-muted" role="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-share-line fs-18"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                                    <li>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ri-twitter-fill text-primary align-bottom me-1"></i> Twitter
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ri-facebook-circle-fill text-info align-bottom me-1"></i> Facebook
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="dropdown-item">
                                                            <i class="ri-google-fill text-danger align-bottom me-1"></i> Google
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <h3 class="ff-secondary fw-bold mt-4"><i class="mdi mdi-ethereum text-primary"></i> 346.12 ETH</h3>
                                        <p class="text-success mb-3">+586.85 (40.6%)</p>

                                        <p class="text-muted">NFT art is a digital asset that is collectable, unique, and non-transferrable, Cortes explained Every NFT is unique duplicated.</p>

                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <p class="fs-14 text-muted mb-1">Current Bid</p>
                                                <h4 class="fs-20 ff-secondary fw-semibold mb-0">342.74 ETH</h4>
                                            </div>

                                            <div>
                                                <p class="fs-14 text-muted mb-1">Highest Bid</p>
                                                <h4 class="fs-20 ff-secondary fw-semibold mb-0">346.67 ETH</h4>
                                            </div>
                                        </div>

                                        <div class="dash-countdown mt-4 pt-1">
                                            <div id="countdown" class="countdownlist"></div>
                                        </div>

                                        <div class="row mt-4 pt-2">
                                            <div class="col">
                                                <a href="apps-nft-item-details.html" class="btn btn-primary w-100">View Details</a>
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-info w-100">Bid Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div><!--end row-->
    </div><!--end col-->

    <div class="col-xxl-3">
        <div class="card">
            <div class="card-header border-0 pb-0">
                <h6 class="card-title mb-0">Popularity</h6>
            </div>
            <div>
                <div id="market-overview" data-colors='["--vz-success", "--vz-warning"]' class="apex-charts mt-n4"></div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h6 class="card-title mb-0 flex-grow-1">History of Bids</h6>
                <a class="text-muted" href="apps-nft-item-details.html">
                    See All <i class="ri-arrow-right-line align-bottom"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <div data-simplebar style="max-height: 365px;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('themes/admin/assets/images/users/avatar-10.jpg')}}" alt="" class="avatar-xs object-fit-cover rounded-circle">
                                    <div class="ms-3 flex-grow-1">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="fs-14 mb-1">Herbert Stokes</h6>
                                        </a>
                                        <p class="mb-0 text-muted">@herbert10</p>
                                    </div>
                                    <div>
                                        <h6>174.36 ETH</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('themes/admin/assets/images/nft/img-01.jpg')}}" alt="" class="avatar-xs object-fit-cover rounded-circle">
                                    <div class="ms-3 flex-grow-1">
                                        <a href="#!">
                                            <h6 class="fs-14 mb-1">Nancy Martino</h6>
                                        </a>
                                        <p class="mb-0 text-muted">@nancyMt</p>
                                    </div>
                                    <div>
                                        <h6>346.47 ETH</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('themes/admin/assets/images/nft/img-04.jpg')}}" alt="" class="avatar-xs object-fit-cover rounded-circle">
                                    <div class="ms-3 flex-grow-1">
                                        <a href="#!">
                                            <h6 class="fs-14 mb-1">Timothy Smith</h6>
                                        </a>
                                        <p class="mb-0 text-muted">@timothy</p>
                                    </div>
                                    <div>
                                        <h6>349.08 ETH</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('themes/admin/assets/images/nft/img-06.jpg')}}" alt="" class="avatar-xs object-fit-cover rounded-circle">
                                    <div class="ms-3 flex-grow-1">
                                        <a href="#!">
                                            <h6 class="fs-14 mb-1">Glen Matney</h6>
                                        </a>
                                        <p class="mb-0 text-muted">@matney10</p>
                                    </div>
                                    <div>
                                        <h6>852.34 ETH</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('themes/admin/assets/images/users/avatar-8.jpg')}}" alt="" class="avatar-xs object-fit-cover rounded-circle">
                                    <div class="ms-3 flex-grow-1">
                                        <a href="#!">
                                            <h6 class="fs-14 mb-1">Michael Morris</h6>
                                        </a>
                                        <p class="mb-0 text-muted">@michael</p>
                                    </div>
                                    <div>
                                        <h6>4.071 ETH</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('themes/admin/assets/images/nft/img-03.jpg')}}" alt="" class="avatar-xs object-fit-cover rounded-circle">
                                    <div class="ms-3 flex-grow-1">
                                        <a href="#!">
                                            <h6 class="fs-14 mb-1">Alexis Clarke</h6>
                                        </a>
                                        <p class="mb-0 text-muted">@alexis_30</p>
                                    </div>
                                    <div>
                                        <h6>30.749 ETH</h6>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('themes/admin/assets/images/nft/img-05.jpg')}}" alt="" class="avatar-xs object-fit-cover rounded-circle">
                                    <div class="ms-3 flex-grow-1">
                                        <a href="#!">
                                            <h6 class="fs-14 mb-1">Timothy Smith</h6>
                                        </a>
                                        <p class="mb-0 text-muted">@timothy</p>
                                    </div>
                                    <div>
                                        <h6>349.08 ETH</h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end col-->
</div>
<!--end row-->

@endsection



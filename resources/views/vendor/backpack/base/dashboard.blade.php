@extends(backpack_view('blank'))

@section('content')
    <div class="container-fluid  bg-white">
        <div class="row mt-3">
            <div class="col-sm-6 col-lg-3 mt-4">
                <div class="card text-white bg-primary mb-2">
                    <div class="card-body">
                        <a class="text-white" href="https://dev.z1platform.com/admin/docs-api-v2">
                            <div class="text-value color-white">Official Docs</div>
                            <div>Api v2 for mobile app</div>
                            <div class="progress progress-white progress-xs my-2">
                                <div class="progress-bar" role="progressbar" style="width: 1320%" aria-valuenow="1320" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-muted">-122 more until next milestone.</small>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mt-4">
                <div class="card text-white bg-warning mb-2">
                    <div class="card-body">
                        <a class="text-white" href="https://xd.adobe.com/view/85a5cd85-9921-477b-7e41-e4af001a335f-f394/"
                            target="_blank">
                            <div class="text-value">Ux &amp; UI</div>
                            <div>Interface of Z1 App</div>
                            <div class="progress progress-white progress-xs my-2">
                                <div class="progress-bar" role="progressbar" style="width: 280%" aria-valuenow="280"  aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-muted">Easier to sell less than 75 products.</small>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mt-4">
                <div class="card text-white bg-success border-0 mb-2">
                    <div class="card-body">
                        <a class="text-white" href="https://dev.z1platform.com/api-explorer">
                            <div class="text-value">API Explorer</div>
                            <div>Show all api</div>
                            <div class="progress progress-white progress-xs my-2">
                                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-muted">Great! Don't stop.</small>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mt-4">
                <div class="card text-white bg-danger mb-2">
                    <div class="card-body">
                        <div class="text-value">16 days</div>
                        <div>Since last article.</div>
                        <div class="progress progress-white progress-xs my-2">
                            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted">Post an article every 3-4 days.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

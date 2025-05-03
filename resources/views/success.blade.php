@if (session()->has('success'))
<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="col col-7">
            <div class="alert alert-info text-dark fs-3 text-center">{{ucfirst(session()->get('success')) }}</div>
        </div>
    </div>
</div>
@endif

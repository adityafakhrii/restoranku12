<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="#" class="navbar-brand"><h1 class="text-primary display-6">Restoranku</h1></a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="#" class="nav-item nav-link">Home</a>
                    <a href="/" class="nav-item nav-link active">Menu</a>
                    <a href="#" class="nav-item nav-link">Kontak</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <a href="{{ route('cart') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>



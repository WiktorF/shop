@if (session('status'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success">
                        {{ session('status') }}
                        <button class="btn-close float-end" data-bs-dismiss="alert" aria-hidden="true">
                            &times;
                        </button>
                    </div>
                </div>
            </div>
        @endif

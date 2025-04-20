@extends("layout")

@section("content")
    <x-navbar active="todos"/>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="fw-bold fs-4 p-1">Todos</div>
                        <div style="height: fit-content;">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">New</button>
                        </div>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Priority</th>
                                    <th>Until</th>
                                    <th>Repeat</th>
                                    <th>Status</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="fw-bold fs-4 p-1">Filter Todos</div>
                    </div>
                    <div class="card-body">
                        <input class="visually-hidden" name="id" type="text" value=""/>
                        <div class="form-group">
                            <label class="form-label" for="">Filter</label>
                            <select class="form-select" id="" name="filter">
                                <option value="a">Title</option>
                                <option value="b">Priority</option>
                                <option value="c">Until</option>
                                <option value="d">Repeat</option>
                                <option value="d">Status</option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label class="form-label" for="">Find</label>
                            <input class="form-control" name="find" type="text" value=""/>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end p-3 gap-2">
                        <button class="btn btn-secondary">Clear</button>
                        <button class="btn btn-primary">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modal -->
    <div id="modal" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="fw-bold fs-4">Manage Todo</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="visually-hidden" name="id" type="text" value=""/>
                    <div class="form-group">
                        <label class="form-label" for="">Title</label>
                        <input class="form-control" name="title" type="text" value=""/>
                    </div>
                    <div class="form-group mt-4">
                        <label class="form-label" for="">Priority</label>
                        <select class="form-select" id="" name="priority">
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <label class="form-label" for="">Until</label>
                        <input class="form-control" name="until" type="date" value=""/>
                    </div>
                    <div class="form-check form-switch mt-4">
                        <label class="form-label" for="">Repeat</label>
                        <input class="form-check-input" name="" type="checkbox" value=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->

@endsection

@push("scripts")
<script>
    $(() => {
        console.log(2)
    })
</script>
@endpush

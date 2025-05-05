@extends("layout")

@section("content")
    <x-navbar active="todos"/>

    <div class="container mt-4">
        <div class="row g-4">
            <div class="col-12 col-lg-9 order-1 order-lg-0">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="fw-bold fs-4 p-1">Todos</div>
                        <div style="height: fit-content;">
                            <button class="btn btn-primary btn-clear" data-bs-toggle="modal" data-bs-target="#modal">New</button>
                        </div>
                    </div>
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Priority</th>
                                    <th>Until</th>
                                    <th>Repeat</th>
                                    <th>Status</th>
                                    <th>Streak</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <div class="fw-bold fs-4 p-1">Filter Todos</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label" for="">Title</label>
                            <input class="form-control" name="filter-title" type="text" value=""/>
                        </div>
                        <div class="form-group mt-4">
                            <label class="form-label" for="">Priority</label>
                            <select class="form-select" id="" name="filter-priority">
                                <option value="all">All</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label class="form-label" for="">Until</label>
                            <input class="form-control" name="filter-until" type="date" value=""/>
                        </div>
                        <div class="form-group mt-4">
                            <label class="form-label" for="">Repeat</label>
                            <select class="form-select" id="" name="filter-repeat">
                                <option value="all">All</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label class="form-label" for="">Status</label>
                            <select class="form-select" id="" name="filter-status">
                                <option value="all">All</option>
                                <option value="done today">Done Today</option>
                                <option value="not done today">Not Done Today</option>
                                <option value="todo">todo</option>
                                <option value="doing">doing</option>
                                <option value="done">done</option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label class="form-label" for="">Streak</label>
                            <input class="form-control" name="filter-streak" type="number" value=""/>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end p-3 gap-2">
                        <button class="btn btn-secondary" onclick="clearFilter()">Clear</button>
                        <button class="btn btn-primary" onclick="filterTodos()">Filter</button>
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
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <div class="form-group mt-4">
                        <label class="form-label" for="">Until</label>
                        <input class="form-control" name="until" type="date" value=""/>
                    </div>
                    <div class="form-check form-switch mt-4">
                        <label class="form-label" for="">Repeat</label>
                        <input class="form-check-input" name="repeat" type="checkbox" value=""/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="storeTodo()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->

@endsection

@push("scripts")
<script>
    function filterTodos() {
        const filter = {
            title: $("input[name='filter-title']").val(),
            priority: $("select[name='filter-priority']").val(),
            until: $("input[name='filter-until']").val(),
            repeat: $("select[name='filter-repeat']").val(),
            status: $("select[name='filter-status']").val(),
            streak: $("input[name='filter-streak']").val()
        }

        fetchTodos(records => {
            if(filter.title != "") {
                records = records.filter(record =>
                    record.title.toLowerCase().includes(filter.title))
            }

            if(filter.priority.toLowerCase() != "all") {
                records = records.filter(record =>
                    record.priority.toLowerCase() == filter.priority)
            }

            if(filter.until != "") {
                const filterUntil = (new UDate(filter.until, "yyyy-mm-dd")).date
                records = records.filter(record => (new Date(record.until)) <= filterUntil)
            }

            if(filter.repeat == "yes") {
                records = records.filter(record =>
                    record.repeat == true)
            }else if(filter.repeat == "no") {
                records = records.filter(record =>
                    record.repeat == false)
            }

            if(filter.status == "done today") {
                records = records.filter(record =>
                    record.status == true)
            }else if(filter.status == "not done today") {
                records = records.filter(record =>
                    record.status == false)
            }else if(filter.status == "todo") {
                records = records.filter(record =>
                    record.sub_status == "todo")
            }else if(filter.status == "doing") {
                records = records.filter(record =>
                    record.sub_status == "doing")
            }else if(filter.status == "done") {
                records = records.filter(record =>
                    record.sub_status == "done")
            }

            if(filter.streak != "") {
                records = records.filter(record =>
                    record.streak == filter.streak)
            }
            
            return records
        })
    }

    function clearFilter() {
        $("input").val("")
        $("select[name='filter-priority']").val("all")
        $("select[name='filter-repeat']").val("all")
        $("select[name='filter-status']").val("all")
        fetchTodos()
    }
    
    function doneTodo(id) {
        $.ajax({
            url: `{{route('api.todos.find', ':id')}}`.replace(':id', id),
            dataType: "json",
            method: "GET",
            success: (response) => {
                if(response.status == 200) {
                    if(response.record.repeat) {
                        delete response.record.id

                        let date = new Date()
                        date.setDate(date.getDate() + 1)

                        response.record.last = (new UDate(date)).toStructure("yyyy-mm-dd")
                        response.record.until = (new UDate(date)).toStructure("yyyy-mm-dd")
                        response.record.status = 1
                        response.record.streak += 1

                        delete response.record.created_at
                        delete response.record.updated_at

                        $.ajax({
                            url: `{{route('api.todos.update', ':id')}}`.replace(':id', id),
                            dataType: "json",
                            method: "PUT",
                            data: response.record,
                            success: (_response) => {
                                fetchTodos()
                            }
                        })
                    }else {
                        $.ajax({
                            url: `{{route('api.todos.destroy', ':id')}}`.replace(':id', id),
                            dataType: "json",
                            method: "DELETE",
                            success: (_response) => {
                                fetchTodos()
                            }
                        })
                    }
                    
                    Toastify({
                        text: "Todo updated successfully",
                        duration: 3000,
                        style: {
                            background: "#93c54b"
                        }
                    }).showToast();
                }else {
                    Toastify({
                        text: "Error, unable to update todo",
                        duration: 3000,
                        style: {
                            background: "#d9534f"
                        }
                    }).showToast();    
                }
            }
        })
    }
    
    function fetchTodos(callback = null) {
        $.ajax({
            url: "{{route('api.todos.index')}}",
            dataType: "json",
            method: "GET",
            success: (response) => {
                if(response.status == 200) {
                    const $table = $("table")
                    $table.find("tbody").children().remove()
                    let row = ""

                    // filter records
                    if(callback) {
                        response.records = callback(response.records)
                    }

                    response.records.forEach(record => {
                        row = ``
                        row += `<tr>`
                        row += `<td>${record.title}</td>`

                        switch(record.priority) {
                            case "A":
                                row += `<td><span class="badge bg-danger">A</span></td>`
                                break
                            case "B":
                                row += `<td><span class="badge bg-warning">B</span></td>`
                                break
                            case "C":
                                row += `<td><span class="badge bg-primary">C</span></td>`
                                break
                            case "D":
                                row += `<td><span class="badge bg-success">D</span></td>`
                                break
                        }
                        
                        row += `<td>${record.until}</td>`

                        if(record.repeat) {
                            row += `<td><span class="badge bg-light">Yes</span></td>`
                        }else {
                            row += `<td><span class="badge bg-dark">No</span></td>`
                        }

                        if((new UDate(record.last, "dd/mm/yyyy")) <= new Date()) {
                            if(record.repeat) {
                                row += `<td><span class="badge bg-danger">Not Done Today</span></td>`
                            }else {
                                switch(record.sub_status) {
                                    case "backlog":
                                        row += `<td><span class="badge bg-dark">${record.sub_status}</span></td>`
                                        break
                                    case "todo":
                                        row += `<td><span class="badge bg-danger">${record.sub_status}</span></td>`
                                        break
                                    case "doing":
                                        row += `<td><span class="badge bg-warning">${record.sub_status}</span></td>`
                                        break
                                    case "done":
                                        row += `<td><span class="badge bg-success">${record.sub_status}</span></td>`
                                        break
                                }
                            }
                            
                            let _record = record
                            _record.status = 0

                            if(daysBetweenDates((new UDate(record.last, "dd/mm/yyyy")), new Date()) >= 1) {
                                console.log(2)
                                let _record = record
                                delete _record.created_at
                                delete _record.updated_at
                                _record.last = (new UDate(new Date())).toStructure("yyyy-mm-dd")
                                _record.until = (new UDate(_record.until, "dd/mm/yyyy")).toStructure("yyyy-mm-dd")
                                _record.streak = 0
                                
                                $.ajax({
                                    url: "{{route('api.todos.update', ':id')}}".replace(":id", _record.id),
                                    method: "PUT",
                                    dataType: "json",
                                    data: _record
                                })
                            }

                            $.ajax({
                                url: "{{route('api.todos.patch', ':id')}}".replace(":id", _record.id),
                                method: "PATCH",
                                dataType: "json",
                                data: {
                                    status: _record.status
                                }
                            })
                        }else {
                            row += `<td><span class="badge bg-success">Done Today</span></td>`
                        }

                        row += `<td><span class="translate-start badge bg-dark"><i class="fa fa-fire"></i>${" " + record.streak}</span></td>`
                        row += `<td><div class="d-flex justify-content-end gap-2">`
                        row += `<button class="btn btn-danger" onclick="destroyTodo(${record.id})"><i class="fa fa-trash"></i></button>`
                        row += `<button class="btn btn-warning" onclick="modifyTodo(${record.id})"><i class="fa fa-pencil"></i></button>`
                        row += `<button class="btn btn-success position-relative" onclick="doneTodo(${record.id})"><i class="fa fa-check"></i></button>`
                        row += `</div></td>`
                        row += `</tr>`

                        $table.find("tbody").append(row)
                    })
                }
            }
        })
    }

    function storeTodo() {
        if($("input[name='id']").val() == "") {
            let date = new Date()
            date.setDate(date.getDate() - 1)
            
            let todo = {
                title: $("input[name='title']").val(),
                priority: $("select[name='priority']").val(),
                until: $("input[name='until']").val(),
                repeat: ($("input[name='repeat']").prop("checked"))? 1: 0,
                last: (new UDate(date)).toStructure("yyyy-mm-dd"),
                streak: 0,
                status: 0
            }

            $.ajax({
                url: "{{route('api.todos.store')}}",
                method: "POST",
                dataType: "json",
                data: todo,
                success: (response) => {
                    if(response.status == 200) {
                        fetchTodos()
                        Toastify({
                            text: "Todo added successfully",
                            duration: 3000,
                            style: {
                                background: "#93c54b"
                            }
                        }).showToast();
                    }else {
                        Toastify({
                            text: "Error, unable to add todo",
                            duration: 3000,
                            style: {
                                background: "#d9534f"
                            }
                        }).showToast();
                    }
                }
            })
        }else {
            let todo = {
                title: $("input[name='title']").val(),
                priority: $("select[name='priority']").val(),
                until: $("input[name='until']").val(),
                repeat: ($("input[name='repeat']").prop("checked"))? 1: 0,
            }

            $.ajax({
                url: "{{route('api.todos.patch', ':id')}}".replace(":id", $("input[name='id']").val()),
                method: "PATCH",
                dataType: "json",
                data: todo,
                success: (response) => {
                    if(response.status == 200) {
                        fetchTodos()
                        Toastify({
                            text: "Todo updated successfully",
                            duration: 3000,
                            style: {
                                background: "#93c54b"
                            }
                        }).showToast();
                    }else {
                        Toastify({
                            text: "Error, unable to update todo",
                            duration: 3000,
                            style: {
                                background: "#d9534f"
                            }
                        }).showToast();
                    }
                }
            })
        }

        $("input").val("")
        $("#modal").modal("hide")
    }

    function modifyTodo(id) {
        $.ajax({
            url: "{{route('api.todos.find', ':id')}}".replace(":id", id),
            method: "GET",
            dataType: "json",
            success: (response) => {
                if(response.status == 200) {
                    $("input[name='id']").val(response.record.id)
                    $("input[name='title']").val(response.record.title)
                    $("select[name='priority']").val(response.record.priority)
                    $("input[name='until']").val(response.record.until)
                    $("input[name='repeat']").prop("checked", response.record.repeat)
                    $("#modal").modal("show");
                }
            }
        })
    }

    function destroyTodo(id) {
        $.ajax({
            url: "{{route('api.todos.destroy', ':id')}}".replace(":id", id),
            method: "DELETE",
            dataType: "json",
            success: response => {
                if(response.status == 200) {
                    fetchTodos()
                    Toastify({
                        text: "Todo deleted successfully",
                        duration: 3000,
                        style: {
                            background: "#93c54b"
                        }
                    }).showToast();
                }else {
                    Toastify({
                        text: "Error, unable to delete todo",
                        duration: 3000,
                        style: {
                            background: "#d9534f"
                        }
                    }).showToast();
                }
            }
        })
    }
    
    $(() => {
        fetchTodos()

        $(".btn-clear").click(() => $("input").val(""))
    })
</script>
@endpush

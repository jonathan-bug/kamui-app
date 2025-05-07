@extends("layout")

@section("content")
    <x-navbar active="kanban"/>

    <div class="container mt-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body" style="padding: 8px 16px !important;">
                        <div class="fw-bold fs-4 p-1">Kanban</div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row g-4">
                    <div class="col-12 col-md-4">
                        <div class="card shadow-sm" style="height: 100%;">
                            <div class="card-body flex-column d-flex" style="min-height: 200px;">
                                <h5 class="card-title fs-5 fw-bold badge bg-danger mb-3">TODO</h5>
                                <div class="card-left d-flex flex-column gap-3" style="height: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card shadow-sm" style="height: 100%;">
                            <div class="card-body flex-column d-flex" style="min-height: 200px;">
                                <h5 class="card-title fs-5 fw-bold badge bg-warning mb-3">DOING</h5>
                                <div class="card-middle d-flex flex-column gap-3" style="height: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card shadow-sm" style="height: 100%;">
                            <div class="card-body flex-column d-flex" style="min-height: 200px;">
                                <h5 class="card-title fs-5 fw-bold badge bg-success mb-3">DONE</h5>
                                <div class="card-right d-flex flex-column gap-3" style="height: 100%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card shadow-sm" style="height: 100%;">
                            <div class="card-body flex-column d-flex" style="min-height: 200px;">
                                <h5 class="card-title fs-5 fw-bold badge bg-dark mb-3">BACKLOG</h5>
                                <div class="card-backlog d-flex flex-column gap-3" style="height: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
<script>
    function fetchTodos() {
        $.ajax({
            url: "{{route('api.todos.index')}}",
            dataType: "json",
            method: "GET",
            success: (response) => {
                let todos = response.records.filter(record => !record.repeat)

                todos.forEach(record => {
                    let card = ``
                    card += `<div class="card tr-draggable bg-light flex-grow-0 shadow-sm" draggable="true">`
                    card += `<div class="card-body">`
                    card += `<div class="d-flex justify-content-between">`
                    card += `<h5 class="fw-bold pe-2 fs-5">${record.title}</h5>`
                    card += `<i class="fa-solid fa-grip-vertical" style="color: #909090;"></i>`
                    card += `</div>`
                    card += `<div class="mt-2">`
                    switch(record.priority) {
                        case "A":
                            card += `<span class="badge bg-danger">A</span>`
                            break
                        case "B":
                            card += `<span class="badge bg-warning">B</span>`
                            break
                        case "C":
                            card += `<span class="badge bg-primary">C</span>`
                            break
                        case "D":
                            card += `<span class="badge bg-success">D</span>`
                            break
                    }
                    card += `</div>`
                    card += `<div class="mt-2">`
                    card += `<span class="badge bg-primary">${record.until}</span>`
                    card += `</div>`
                    card += `</div>`
                    card += `</div>`
                    card += `</div>`
                    card = $(card)


                    const backlog = $(".card-backlog")
                    const left = $(".card-left")
                    const middle = $(".card-middle")
                    const right = $(".card-right")
                    
                    card.on("dragstart", event => {
                        let active = event.target

                        backlog.on("click", event => {
                            event.preventDefault()
                        })
                        
                        backlog.on("dragover", event => {
                            event.preventDefault()
                        })
                        
                        backlog.on("drop", event => {
                            if(active != null) {
                                backlog.append(active)
                                active = null

                                $.ajax({
                                    url: "{{route('api.todos.patch', ':id')}}".replace(":id", record.id),
                                    dataType: "json",
                                    method: "PATCH",
                                    data: {
                                        sub_status: "backlog"
                                    }
                                })
                            }
                        })

                        left.on("click", event => {
                            event.preventDefault()
                        })
                        
                        left.on("dragover", event => {
                            event.preventDefault()
                        })
                        
                        left.on("drop", event => {
                            if(active != null) {
                                left.append(active)
                                active = null
                                
                                $.ajax({
                                    url: "{{route('api.todos.patch', ':id')}}".replace(":id", record.id),
                                    dataType: "json",
                                    method: "PATCH",
                                    data: {
                                        sub_status: "todo"
                                    }
                                })
                            }
                        })

                        middle.on("click", event => {
                            event.preventDefault()
                        })
                        
                        middle.on("dragover", event => {
                            event.preventDefault()
                        })
                        
                        middle.on("drop", event => {
                            if(active != null) {
                                middle.append(active)
                                active = null

                                $.ajax({
                                    url: "{{route('api.todos.patch', ':id')}}".replace(":id", record.id),
                                    dataType: "json",
                                    method: "PATCH",
                                    data: {
                                        sub_status: "doing"
                                    }
                                })
                            }
                        })

                        right.on("click", event => {
                            event.preventDefault()
                        })
                        
                        right.on("dragover", event => {
                            event.preventDefault()
                        })
                        
                        right.on("drop", event => {
                            if(active != null) {
                                right.append(active)
                                active = null

                                $.ajax({
                                    url: "{{route('api.todos.patch', ':id')}}".replace(":id", record.id),
                                    dataType: "json",
                                    method: "PATCH",
                                    data: {
                                        sub_status: "done"
                                    }
                                })
                            }
                        })
                    })

                    switch(record.sub_status) {
                        case "backlog":
                            $(".card-backlog").append(card)
                            break
                        case "todo":
                            $(".card-left").append(card)
                            break
                        case "doing":
                            $(".card-middle").append(card)
                            break
                        case "done":
                            $(".card-right").append(card)
                            break
                    }
                })
            }
        })
    }
    
    $(() => {
        fetchTodos()
    })
</script>
@endpush

@extends("layout")

@section("content")
    <x-navbar active="kanban"/>

    <div class="container mt-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="padding: 8px 16px !important;">
                        <div class="fw-bold fs-4 p-1">Kanban - Backlog</div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row g-4">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body card-left" style="min-height: 100px;">
                                <h5 class="card-title text-danger fw-bold">TODO</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body card-middle" style="min-height: 100px;">
                                <h5 class="card-title text-warning fw-bold">DOING</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body card-right" style="min-height: 100px;">
                                <h5 class="card-title text-success fw-bold">DONE</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body card-backlog" style="min-height: 100px;">
                                <h5 class="card-title fw-bold">BACKLOG</h5>
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
                    card += `<div class="card tr-draggable mt-3 bg-light" draggable="true">`
                    card += `<div class="card-body">`
                    card += `<div class="d-flex justify-content-between">`
                    card += `<h5 class="">${record.title}</h5>`
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

                    
                    const left = $(".card-left")
                    const middle = $(".card-middle")
                    const right = $(".card-right")
                    
                    card.on("dragstart", event => {
                        let active = event.target

                        left.on("click", event => {
                            event.preventDefault()
                        })
                        
                        left.on("dragover", event => {
                            event.preventDefault()
                        })
                        
                        left.on("drop", event => {
                            left.append(active)
                            active = null
                        })

                        middle.on("click", event => {
                            event.preventDefault()
                        })
                        
                        middle.on("dragover", event => {
                            event.preventDefault()
                        })
                        
                        middle.on("drop", event => {
                            middle.append(active)
                            active = null
                        })

                        right.on("click", event => {
                            event.preventDefault()
                        })
                        
                        right.on("dragover", event => {
                            event.preventDefault()
                        })
                        
                        right.on("drop", event => {
                            right.append(active)
                            active = null
                        })
                    })

                    $(".card-backlog").append(card)
                })
            }
        })
    }
    
    $(() => {
        fetchTodos()
    })
</script>
@endpush

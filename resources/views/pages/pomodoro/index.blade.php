@extends("layout")

@section("content")
    <x-navbar active="pomodoro"/>

    <div class="container mt-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="fw-bold fs-4 p-1">Pomodoro</div>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="fw-bold timer" style="font-size: 90px;"></div>
                    </div>
                    <div class="card-footer d-flex justify-content-center gap-2 p-3">
                        <button class="btn-start btn btn-success">Start</button>
                        <button class="btn-stop btn btn-danger">Stop</button>
                        <button class="btn-restart btn btn-warning">Restart</button>
                        <button class="btn-switch btn btn-primary">
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
<script>
    let timerInterval
    let seconds = 0
    let minutes = 1
    let started = false
    let timerMinutes = 25
    let mode = true
    const audio = new Audio("/bubble.wav")

    function outputTime(time) {
        return (time < 10)? '0' + time: time
    }

    function updateTimer() {
        seconds += 1

        if(seconds == 60) {
            seconds = 0
            minutes += 1
        }

        if((60 - seconds) == 60) {
            $(".timer").text(`${outputTime(timerMinutes - minutes)}:00`)
        }else {
            $(".timer").text(`${outputTime(timerMinutes - minutes)}:${outputTime(60 - seconds)}`)
        }

        if(((timerMinutes + 1) - minutes) == 0) {
            $(".timer").text(`00:00`)
            clearInterval(timerInterval)
            started = false
            audio.play()

            if(mode) {
                timerMinutes = 5
                
                $(".timer").text(`${timerMinutes}:00`)
                $(".timer").css({
                    color: "#d9534f"
                })

                mode = !mode
            }else {
                timerMinutes = 25
                
                $(".timer").text(`${timerMinutes}:00`)
                $(".timer").css({
                    color: "#93c54b"
                })

                mode = !mode
            }

            seconds = 0
            minutes = 1
        }
    }
    
    $(() => {
        $(".timer").text(`${timerMinutes}:00`)
        $(".timer").css({
            color: "#93c54b"
        })
        
        $(".btn-start").click(() => {
            if(!started) {
                started = true
                timerInterval = setInterval(updateTimer, 1000)
            }
        })

        $(".btn-stop").click(() => {
            if(started) {
                clearInterval(timerInterval)
                started = false
            }
        })

        $(".btn-restart").click(() => {
            clearInterval(timerInterval)
            
            started = false
            seconds = 0
            minutes = 1
            
            $(".timer").text(`${timerMinutes}:00`)
        })

        $(".btn-switch").click(() => {
            if(mode) {
                timerMinutes = 5
                
                $(".timer").text(`${timerMinutes}:00`)
                $(".timer").css({
                    color: "#d9534f"
                })

                mode = !mode
            }else {
                timerMinutes = 25
                
                $(".timer").text(`${timerMinutes}:00`)
                $(".timer").css({
                    color: "#93c54b"
                })

                mode = !mode
            }

            clearInterval(timerInterval)
            started = false
            seconds = 0
            minutes = 1
        })
    })
</script>
@endpush

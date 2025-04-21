<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta name="csrf-token" content="{{csrf_token()}}"/>
        <title>@yield("title", "KAMUI")</title>
        <link href="{{url('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @stack("styles")
    </head>
    <body class="bg-light">
        @yield("content")
        
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                }
            })

            function invertStringDate(date) {
                date = date.split("/")
                let _date = `${date[2]}/${date[1]}/${date[0]}`

                return _date
            }

            function stringToDate(date) {
                date = date.split("/")
                let _date = `${date[1]}/${date[0]}/${date[2]}`

                return new Date(_date)
            }

            function dateToString(date) {
                date = date.toISOString().split("T")[0].split("-")
                let _date = `${date[2]}/${date[1]}/${date[0]}`

                return _date
            }

            function daysBetweenDates(date1, date2) {
                return Math.floor(Math.abs((date1 - date2) / 86400000))
            }
        </script>
        @stack("scripts")
    </body>
</html>

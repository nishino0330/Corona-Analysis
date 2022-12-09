<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>新型コロナウイルス関連情報</title>
    <!-- Load c3.css -->
    <link rel="stylesheet" href="{{ asset('static/app1/c3.css') }}">
</head>

<body>
    <!-- Load d3.js and c3.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.16.0/d3.min.js"
        integrity="sha512-FHsFVKQ/T1KWJDGSbrUhTJyS1ph3eRrxI228ND0EGaEp6v4a/vGwPWd3Dtd/+9cI7ccofZvl/wulICEurHN1pg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('static/app1/c3.min.js') }}"></script>

    <h1>新型コロナウイルス関連情報</h1>
    <form method="POST" action="/">
        <select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="dateUpdate(this.value)">
            <option selected value="weekly">１週間</option>
            <option value="monthly">１ヶ月</option>
            <option value="half_year">半年</option>
            <option value="year">１年</option>
        </select>
          
        <div class="mb-3">
            <label for="exampleInputuser_name" class="form-label">新規感染者グラフ</label>
        </div>

        <div id="access_count"></div>
        <div id="infected_chart"></div>

        <div class="mb-3">
            <label for="exampleInputuser_name" class="form-label">死亡者グラフ</label>
        </div>

        <select class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="intervalUpdate(this.value)">
            <option selected value="every_other_day">１日毎の死亡者数</option>
            <option value="Cumulative">累計死亡者数</option>
        </select>

        <div id="access_count"></div>
        <div id="deceased_chart"></div>
    </form>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script>
        let weekly = @json($datelist['Week_Date']),
            monthly = @json($datelist['Manth_Date']),
            half_year = @json($datelist['HalfYear_Date']),
            year = @json($datelist['Year_Date']),
            intervallist = @json($datelist['intervallist']),
            AllGraph = @json($infected['AllGraph']),
            TokyoGraph = @json($infected['TokyoGraph']);

        let every_other_day = intervallist['Deaths_Per_Day'],
            Cumulative = intervallist['Cumulative_deceased'];

        let deceased = [
            weekly,
            every_other_day['AllGraph'],
            every_other_day['TokyoGraph'],
        ];

        // console.log(every_other_day);
        // console.log(Cumulative);
    </script>
    <script src="{{ asset('static/js/main.js') }}"></script>
</body>

</html>

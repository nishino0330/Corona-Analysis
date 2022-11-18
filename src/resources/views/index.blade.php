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
        <script type="text/javascript">
            function dateUpdate(selectGenre) {
                console.log(selectGenre);
                if (selectGenre === "weekly") {
                    // weekly
                    createChart(weekly);
                } else if (selectGenre === "monthly") {
                    // monthly
                    createChart(monthly);
                } else if (selectGenre === "half_year") {
                    // half_year
                    createChart(half_year);
                } else if (selectGenre === "year") {
                    // year
                    createChart(year);
                }
            }

            function createChart(dateList) {
                infected_chart = c3.generate({
                    bindto: '#infected_chart',
                    data: {
                        x: '日付',
                        xFormat: '%Y-%m-%d',
                        columns: [
                            dateList,
                            @json($infected['AllGraph']),
                            @json($infected['TokyoGraph'])
                        ]
                    },
                    axis: {
                        x: {
                            type: 'timeseries',
                            tick: {
                                format: '%m月%d日'
                            },
                            label: {
                                text: '日付',
                                position: 'outer-middle'
                            }
                        },
                        y: {
                            label: {
                                text: '新規感染者数',
                                position: 'outer-middle'
                            }
                        }
                    }
                });

                deceased_chart = c3.generate({
                    bindto: '#deceased_chart',
                    data: {
                        x: '日付',
                        xFormat: '%Y-%m-%d',
                        columns: [
                            dateList,
                            @json($deceased['AllGraph']),
                            @json($deceased['TokyoGraph'])
                        ]
                    },
                    axis: {
                        x: {
                            type: 'timeseries',
                            tick: {
                                format: '%m月%d日'
                            },
                            label: {
                                text: '日付',
                                position: 'outer-middle'
                            }
                        },
                        y: {
                            label: {
                                text: '新規感染者数',
                                position: 'outer-middle'
                            }
                        }
                    }
                });
            }

            let weekly = @json($datelist['Week_Date']) ,
                monthly = @json($datelist['Manth_Date']) ,
                half_year = @json($datelist['HalfYear_Date']) ,
                year = @json($datelist['Year_Date'])
            
            var infected_chart = c3.generate({
                bindto: '#infected_chart',
                data: {
                    x: '日付',
                    xFormat: '%Y-%m-%d',
                    columns: [
                        weekly,
                        @json($infected['AllGraph']),
                        @json($infected['TokyoGraph'])
                    ]
                },
                axis: {
                    x: {
                        type: 'timeseries',
                        tick: {
                            format: '%m月%d日'
                        },
                        label: {
                            text: '日付',
                            position: 'outer-middle'
                        }
                    },
                    y: {
                        label: {
                            text: '新規感染者数',
                            position: 'outer-middle'
                        }
                    }
                }
            });
            
            

        </script>

        <div class="mb-3">
            <label for="exampleInputuser_name" class="form-label">累計死亡者グラフ</label>
        </div>

        <div id="access_count"></div>
        <div id="deceased_chart"></div>
        <script type="text/javascript">
            
            var deceased_chart = c3.generate({
                bindto: '#deceased_chart',
                data: {
                    x: '日付',
                    xFormat: '%Y-%m-%d',
                    columns: [
                        weekly,
                        @json($deceased['AllGraph']),
                        @json($deceased['TokyoGraph'])
                    ]
                },
                axis: {
                    x: {
                        type: 'timeseries',
                        tick: {
                            format: '%m月%d日'
                        },
                        label: {
                            text: '日付',
                            position: 'outer-middle'
                        }
                    },
                    y: {
                        label: {
                            text: '新規感染者数',
                            position: 'outer-middle'
                        }
                    }
                }
            });

        </script>
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
</body>

</html>
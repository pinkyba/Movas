<!DOCTYPE html>
<html lang="{{ \Lang::getLocale() }}">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</head>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        text-align: center;
    }

    th {
        width: 100px;
        font-weight: bold;

    }

    td {
        font-size: 15px;
    }

</style>

<body>
    <div class="container-fluid mt-5 ">
       
        <table>
            <thead>
                <tr>
                    <th rowspan="2">စဉ်</th>
                    <th rowspan="2">အမည်</th>
                    <th rowspan="2">နိုင်ငံသား</th>
                    <th rowspan="2">လိင်</th>
                    <th rowspan="2">နိုင်ငံကူးလက်မှတ်အမှတ်</th>
                <!-- <th rowspan="2">ပြည်၀◌င်ခွင့်ဗီဇာအမှတ်</th> -->
                    <th rowspan="2">သက်တမ်းကုန်ဆုံးသည့်နေ့</th>
                    <th rowspan="2">ဗီဇာအမျိုးအစား</th>
                    <th rowspan="2">နေထိုင်ခွင့်(ကာလ)</th>
                    <th rowspan="2">နေထိုင်ခွင့်(မှ)</th>
                    <th rowspan="2">နေထိုင်ခွင့်(သို့)</th>
                    <th rowspan="2">လက်ရှိအလုပ်အကိုင်/ရာထူး</th>
                    <th rowspan="2">တော်စပ်ပုံ</th>
                    <th rowspan="2">Sector</th>
                    <th rowspan="2">ကုမ္ပဏီအမည်</th>
                    <th rowspan="2">လိပ်စာ</th>
                    <th rowspan="2">ခွင့်ပြုမိန့်(သို့)အတည်ပြုမိန့်အမှတ်</th>
                    <th colspan="3">ထောက်ခံသည့်နေ့</th>
                </tr>
                <tr>
                    <th style="width: 80px;">ရက်</th>
                    <th style="width: 80px;">လ</th>
                    <th style="width: 80px;">နှစ်</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $row)
                    <tr>
                        @foreach ($row as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>

</html>

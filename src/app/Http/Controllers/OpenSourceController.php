<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;
use League\Csv\Statement;

class OpenSourceController extends Controller
{
    public function index(){
        // 感染者
        // cURL or file_get_contentsでCSVテキストデータを取得
        $url = "https://covid19.mhlw.go.jp/public/opendata/newly_confirmed_cases_daily.csv";
        $ch = curl_init(); // はじめ

        // オプション
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // ヘッダの出力 (true=出力する false=出力しない)
        curl_setopt($ch, CURLOPT_HEADER, false);
        // HTTPヘッダフィールドを追加する
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['User-Agent: AppleWebKit/10000']);
        // 返り値を文字列で受け取る (true=受け取る false=受け取らない)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // リダイレクトしている場合、Locationをたどる場合に設定する
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // リダイレクトの際にヘッダのRefererを自動的に追加させる
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        $infected =  curl_exec($ch);
        curl_close($ch); //終了

        // 死亡者
        // cURL or file_get_contentsでCSVテキストデータを取得
        $url = "https://covid19.mhlw.go.jp/public/opendata/deaths_cumulative_daily.csv";
        $ch = curl_init(); // はじめ

        // オプション
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // ヘッダの出力 (true=出力する false=出力しない)
        curl_setopt($ch, CURLOPT_HEADER, false);
        // HTTPヘッダフィールドを追加する
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['User-Agent: AppleWebKit/10000']);
        // 返り値を文字列で受け取る (true=受け取る false=受け取らない)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // リダイレクトしている場合、Locationをたどる場合に設定する
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // リダイレクトの際にヘッダのRefererを自動的に追加させる
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        $deceased =  curl_exec($ch);
        curl_close($ch); //終了

        // league/csvを使ってCSVテキストデータを解析
        $infected_csv = Reader::createFromString($infected); // 感染者
        $infected_csv->setHeaderOffset(0);
        $deceased_csv = Reader::createFromString($deceased); // 死亡者
        $deceased_csv->setHeaderOffset(0);

        $records = $infected_csv->getRecords();
        $infected = [
            "date" => [],
            "AllGraph" => [],
            "TokyoGraph" => [] ,
        ];
        foreach($records as $idx => $row) {
            $infected['date'][] = date("Y-m-d", strtotime($row['Date']));
            $infected['AllGraph'][] = $row['ALL'];
            $infected['TokyoGraph'][] = $row['Tokyo'];
        }
        // TASU or unshift
        $infected['date'][] = "日付";
        $infected['AllGraph'][] = "全国";
        $infected['TokyoGraph'][] = "東京";
        // 逆順にデータを格納
        $infected['date'] = array_reverse($infected['date']);
        $infected['AllGraph'] = array_reverse($infected['AllGraph']);
        $infected['TokyoGraph'] = array_reverse($infected['TokyoGraph']);

        $Week_Date = array_slice($infected['date'], 0, 7);
        $Manth_Date = array_slice($infected['date'], 0, 30);
        $HalfYear_Date = array_slice($infected['date'], 0, 120);
        $Year_Date = array_slice($infected['date'], 0, 365);

        // echo "<pre>";
        // var_dump($Week_Date);

        $records = $deceased_csv->getRecords();
        $deceased = [
            "date" => [],
            "AllGraph" => [],
            "TokyoGraph" => []
        ];

        $All_DeceasedBefore = 0;
        $Tokyo_DeceasedBefore = 0;
        foreach($records as $idx => $row) {
            // １日毎
            $Deaths_Per_Day['date'][] = date("Y-m-d", strtotime($row['Date']));
            $Deaths_Per_Day['AllGraph'][] = $row['ALL'] - $All_DeceasedBefore;
            $Deaths_Per_Day['TokyoGraph'][] = $row['Tokyo'] - $Tokyo_DeceasedBefore;

            // 累計
            $Cumulative_deceased['date'][] = date("Y-m-d", strtotime($row['Date']));
            $Cumulative_deceased['AllGraph'][] = $row['ALL'];
            $Cumulative_deceased['TokyoGraph'][] = $row['Tokyo'];

            $All_DeceasedBefore = $row['ALL'];
            $Tokyo_DeceasedBefore = $row['Tokyo'];
        }
        // TASU or unshift
        $Deaths_Per_Day['date'][] = "日付";
        $Deaths_Per_Day['AllGraph'][] = "全国";
        $Deaths_Per_Day['TokyoGraph'][] = "東京";

        $Cumulative_deceased['date'][] = "日付";
        $Cumulative_deceased['AllGraph'][] = "全国";
        $Cumulative_deceased['TokyoGraph'][] = "東京";

        // 逆順にデータを格納
        $Deaths_Per_Day['date'] = array_reverse($Deaths_Per_Day['date']);
        $Deaths_Per_Day['AllGraph'] = array_reverse($Deaths_Per_Day['AllGraph']);
        $Deaths_Per_Day['TokyoGraph'] = array_reverse($Deaths_Per_Day['TokyoGraph']);

        $Cumulative_deceased['date'] = array_reverse($Cumulative_deceased['date']);
        $Cumulative_deceased['AllGraph'] = array_reverse($Cumulative_deceased['AllGraph']);
        $Cumulative_deceased['TokyoGraph'] = array_reverse($Cumulative_deceased['TokyoGraph']);

        // echo "<pre>";
        // var_dump($Deaths_Per_Day['AllGraph']);
        // var_dump($Deaths_Per_Day['TokyoGraph']);        

        // 配列データに格納
        $datas = [
            "infected" => $infected,
            "deceased" => $deceased,
            "datelist" => [
                "Week_Date" => $Week_Date ,
                "Manth_Date" => $Manth_Date ,
                "HalfYear_Date" => $HalfYear_Date ,
                "Year_Date" => $Year_Date ,

                "intervallist" => [
                    "Deaths_Per_Day" => $Deaths_Per_Day ,
                    "Cumulative_deceased" => $Cumulative_deceased
                ]
            ],
        ];
        
        // echo "<pre>";
        // var_dump($datas['datelist']['intervallist']['Deaths_Per_Day']);

        return view('index', $datas);
    }
}
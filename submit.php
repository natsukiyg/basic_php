<?php

//CSVファイルのパス
$csvFile = 'members.csv';

//フォームが送信された時の処理
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // メンバー情報の取得
    $name = htmlspecialchars($_POST['name']);
    $gender = htmlspecialchars($_POST['gender']);
    $birthday = htmlspecialchars($_POST['birthday']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $facility = htmlspecialchars($_POST['facility']);

    // アンケート情報の取得
    $whereDidYouHear = htmlspecialchars($_POST['whereDidYouHear']);
    $expectations = htmlspecialchars($_POST['expectations']);

    //CSVファイルが存在する場合は、最後の会員番号を取得
    $lastId = 1;
    if(file_exists($csvFile)) {
        //CSVファイルを開いてデータを読み込む
        if(($handle = fopen($csvFile, 'r')) !== FALSE) {
            //最初の行（ヘッダー行）はスキップ
            fgetcsv($handle);

            //CSVの各行を最後まで読み込んで配列に保存
            while(($row = fgetcsv($handle)) !== FALSE) {
                $lastId = $row[0]; //最後の行の会員番号を取得
            }
            fclose($handle);
        }
    }

    //新しい会員番号を設定
    $memberId = $lastId + 1;

    //新しいデータ行を作成
    $newData = [
        $memberId, //会員番号
        $name, 
        $gender, 
        $birthday, 
        $email, 
        $address, 
        $facility, 
        $whereDidYouHear,
        $expectations
    ];

    //新しいデータ行をCSVファイルに追加
    if(($handle = fopen($csvFile, 'a')) !== FALSE) {
        //ヘッダーがない場合は最初に書き込む
        if(filesize($csvFile) === 0) {
            fputcsv($handle, ['会員番号', '氏名', '性別', '誕生日', 'メールアドレス', '住所', '所属施設', 'どこで知りましたか？', 'どんな機能を期待しますか？']);
        }
        //データをCSVファイルに書き込む
        fputcsv($handle, $newData);
        fclose($handle);

        // 登録完了メッセージの表示
        echo "<h1>登録が完了しました！</h1>";
        echo "<ul>";
        echo "<li>会員番号: $memberId</li>";
        echo "<li>氏名: $name</li>";
        echo "<li>性別: $gender</li>";
        echo "<li>誕生日: $birthday</li>";
        echo "<li>メールアドレス: $email</li>";
        echo "<li>住所: $address</li>";
        echo "<li>所属施設: $facility</li>";
        echo "<li>どこで知りましたか？: $whereDidYouHear</li>";
        echo "<li>どんな機能を期待しますか？: $expectations</li>";
        echo "</ul>";
        echo "<a href='index.html'>メンバー登録ページに戻る</a>";
    } else {
        echo "エラー：データを保存できませんでした。";
        echo "<a href='index.html'>メンバー登録ページに戻る</a>";
    }
}
?>

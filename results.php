<?php
// CSVファイルのパス
$csvFile = 'members.csv';

// CSVファイルが存在するか確認
if (!file_exists($csvFile)) {
    die("登録データのファイルが見つかりません。");
}

// CSVファイルを読み込む
$membersData = array();
if (($handle = fopen($csvFile, 'r')) !== FALSE) {
    // 最初の行（ヘッダー行）はスキップ
    $headers = fgetcsv($handle);

    // CSVの各行を読み込んで配列に保存
    while (($row = fgetcsv($handle)) !== FALSE) {
        $membersData[] = $row;
    }
    fclose($handle);
} else {
    die("登録データのファイルを開けませんでした。");
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録データ</title>
    <link rel="stylesheet" href="basic_php.css">
</head>
<body>
    <h1>登録データ</h1>

    <?php if (count($membersData) > 0): ?>
        <table>
            <thead>
                <tr>
                    <!-- CSVのヘッダーを表示 -->
                    <th>氏名</th>
                    <th>性別</th>
                    <th>誕生日</th>
                    <th>メールアドレス</th>
                    <th>住所</th>
                    <th>所属施設</th>
                    <th>知ったきっかけ</th>
                    <th>期待する機能</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($membersData as $row): ?>
                    <tr>
                        <!-- CSVのデータを表示 -->
                        <td><?php echo htmlspecialchars($row[0]); ?></td>  <!-- 氏名 -->
                        <td><?php echo htmlspecialchars($row[1]); ?></td>  <!-- 性別 -->
                        <td><?php echo htmlspecialchars($row[2]); ?></td>  <!-- 誕生日 -->
                        <td><?php echo htmlspecialchars($row[3]); ?></td>  <!-- メールアドレス -->
                        <td><?php echo htmlspecialchars($row[4]); ?></td>  <!-- 住所 -->
                        <td><?php echo htmlspecialchars($row[5]); ?></td>  <!-- 所属施設 -->
                        <td><?php echo htmlspecialchars($row[6]); ?></td>  <!-- 知ったきっかけ -->
                        <td><?php echo htmlspecialchars($row[7]); ?></td>  <!-- 期待する機能 -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>登録データはまだありません。</p>
    <?php endif; ?>
</body>
</html>

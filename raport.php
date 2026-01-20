<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['namasiswa'] ?? '';
    $nisn = $_POST['nisn'] ?? '';
    $nilai1 = $_POST['nilai1'] ?? '';
    $nilai2 = $_POST['nilai2'] ?? '';
    $nilai3 = $_POST['nilai3'] ?? '';
    $nilai4 = $_POST['nilai4'] ?? '';
    $nilai5 = $_POST['nilai5'] ?? '';

    $error = '';
    if (!is_numeric($nilai1) || !is_numeric($nilai2) || !is_numeric($nilai3) || !is_numeric($nilai4) || !is_numeric($nilai5) || !is_numeric($nisn)) {
        $error = 'Semua nilai harus berupa angka.';
    } else {
        $grades = [$nilai1, $nilai2, $nilai3, $nilai4, $nilai5];
        $lulus = true;
        foreach ($grades as $nilai) {
            if ($nilai < 75) {
                $lulus = false;
                break;
            }
        }
        $status = $lulus ? 'Lulus' : 'Tidak Lulus';
        $rata_rata = array_sum($grades) / count($grades);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Nilai Siswa</title>
</head>
<body bgcolor="#ccffff">
    <h1 style="color: rgb(255, 165, 0); text-align: center;">Laporan Nilai Siswa</h1>
    <hr style="color: black;">

    <h2 style="color: green; text-align: center;">Masukkan Data Siswa</h2>
    <form method="post" action="">
        <table cellpadding="10" cellspacing="0" border="0" style="margin: 0 auto; vertical-align: top;">
            <tr>
                <td><label for="namasiswa">Nama:</label></td>
                <td><input type="text" id="namasiswa" name="namasiswa" value="<?php echo htmlspecialchars($nama ?? ''); ?>" required></td>
            </tr>
            <tr>
                <td><label for="nisn">NISN:</label></td>
                <td><input type="number" id="nisn" name="nisn" max="9999999999" pattern="[0-9]{1,10}" value="<?php echo htmlspecialchars($nisn ?? ''); ?>" required></td>
            </tr>
        </table>

        <h2 style="color: green; text-align: center;">Masukkan Nilai Siswa</h2>
        <table cellpadding="10" cellspacing="0" border="0" style="margin: 0 auto; vertical-align: top;">
            <tr>
                <td><label for="nilai1">B. Indonesia:</label></td>
                <td><input type="number" id="nilai1" name="nilai1" value="<?php echo htmlspecialchars($nilai1 ?? ''); ?>" required></td>
            </tr>
            <tr>
                <td><label for="nilai2">B. Inggris:</label></td>
                <td><input type="number" id="nilai2" name="nilai2" value="<?php echo htmlspecialchars($nilai2 ?? ''); ?>" required></td>
            </tr>
            <tr>
                <td><label for="nilai3">Matematika:</label></td>
                <td><input type="number" id="nilai3" name="nilai3" value="<?php echo htmlspecialchars($nilai3 ?? ''); ?>" required></td>
            </tr>
            <tr>
                <td><label for="nilai4">Dasar PPLG:</label></td>
                <td><input type="number" id="nilai4" name="nilai4" value="<?php echo htmlspecialchars($nilai4 ?? ''); ?>" required></td>
            </tr>
            <tr>
                <td><label for="nilai5">Informatika:</label></td>
                <td><input type="number" id="nilai5" name="nilai5" value="<?php echo htmlspecialchars($nilai5 ?? ''); ?>" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><input type="submit" value="Hitung Rata-rata"></td>
            </tr>
        </table>
    </form>

    <hr>


    <h2 style="color: blue; text-align: center;">Hasil Rata-rata Nilai</h2>
    <?php if (isset($error) && $error): ?>
        <p style="color: red; text-align: center;"><?php echo $error; ?></p>
    <?php elseif (isset($rata_rata)): ?>
        <p style="text-align: center;">Rata-rata nilai siswa adalah: <strong><?php echo number_format($rata_rata, 2); ?></strong></p>
        <p style="text-align: center;">Status: <strong><?php echo $status; ?></strong></p>
    <?php endif; ?>
</body>
</html>

<?php
ob_start();
include 'config.php';

$i = 0;

$gunsay        = date('w', strtotime('-' . $i . ' days'));

if ($gunsay == 6) {
    $i             = $i - 1;
    $gunsay2    = date('w', strtotime('-' . $i . ' days'));

    if ($gunsay2 == 0) {
        $i    = $i - 1;
    }
}

$gun        = date('d', strtotime('-' . $i . ' days'));
$ay            = date('m', strtotime('-' . $i . ' days'));
$yil        = date('Y', strtotime('-' . $i . ' days'));
$tarihimiz    = date('Y-m-d H:i:s', strtotime('-' . $i . ' days'));

$doviz = simplexml_load_file('https://www.tcmb.gov.tr/kurlar/' . $yil . $ay . '/' . $gun . $ay . $yil . '.xml');

$usd_doviz_alis     = $doviz->Currency[0]->ForexBuying;
$usd_doviz_satis     = $doviz->Currency[0]->ForexSelling;
$usd_efektif_alis     = $doviz->Currency[0]->BanknoteBuying;
$usd_efektif_satis     = $doviz->Currency[0]->BanknoteSelling;
$usd_CurrencyCode     = $doviz->Currency[0]->attributes()->CurrencyCode;
$usd_unit             = $doviz->Currency[0]->Unit;

$euro_doviz_alis     = $doviz->Currency[3]->ForexBuying;
$euro_doviz_satis     = $doviz->Currency[3]->ForexSelling;
$euro_efektif_alis     = $doviz->Currency[3]->BanknoteBuying;
$euro_efektif_satis = $doviz->Currency[3]->BanknoteSelling;
$euro_CurrencyCode     = $doviz->Currency[3]->attributes()->CurrencyCode;
$euro_unit             = $doviz->Currency[3]->Unit;

$query = $db->prepare("INSERT INTO DovizKur SET
						DovizCurrencyID = :DovizCurrencyID,
						DovizTarih = :DovizTarih,
						DovizForexBuying = :DovizForexBuying,
						DovizForexSelling = :DovizForexSelling,
						DovizBanknoteBuying = :DovizBanknoteBuying,
						DovizBanknoteSelling = :DovizBanknoteSelling,
						DovizUnit = :DovizUnit");

// Dolar
$insert = $query->execute(array(
    "DovizCurrencyID" => 2,
    "DovizTarih" => $tarihimiz,
    "DovizForexBuying" => $usd_doviz_alis,
    "DovizForexSelling" => $usd_doviz_satis,
    "DovizBanknoteBuying" => $usd_efektif_alis,
    "DovizBanknoteSelling" => $usd_efektif_satis,
    "DovizUnit" => $usd_unit
));

// Euro
$insert = $query->execute(array(
    "DovizCurrencyID" => 3,
    "DovizTarih" => $tarihimiz,
    "DovizForexBuying" => $euro_doviz_alis,
    "DovizForexSelling" => $euro_doviz_satis,
    "DovizBanknoteBuying" => $euro_efektif_alis,
    "DovizBanknoteSelling" => $euro_efektif_satis,
    "DovizUnit" => $euro_unit
));

ob_end_flush();

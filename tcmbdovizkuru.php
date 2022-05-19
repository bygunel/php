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

$query = $db->prepare("INSERT INTO RotaDovizKur SET
						RotaDovizCurrencyID = :RotaDovizCurrencyID,
						RotaDovizTarih = :RotaDovizTarih,
						RotaDovizForexBuying = :RotaDovizForexBuying,
						RotaDovizForexSelling = :RotaDovizForexSelling,
						RotaDovizBanknoteBuying = :RotaDovizBanknoteBuying,
						RotaDovizBanknoteSelling = :RotaDovizBanknoteSelling,
						RotaDovizUnit = :RotaDovizUnit");

// Dolar
$insert = $query->execute(array(
    "RotaDovizCurrencyID" => 2,
    "RotaDovizTarih" => $tarihimiz,
    "RotaDovizForexBuying" => $usd_doviz_alis,
    "RotaDovizForexSelling" => $usd_doviz_satis,
    "RotaDovizBanknoteBuying" => $usd_efektif_alis,
    "RotaDovizBanknoteSelling" => $usd_efektif_satis,
    "RotaDovizUnit" => $usd_unit
));

// Euro
$insert = $query->execute(array(
    "RotaDovizCurrencyID" => 3,
    "RotaDovizTarih" => $tarihimiz,
    "RotaDovizForexBuying" => $euro_doviz_alis,
    "RotaDovizForexSelling" => $euro_doviz_satis,
    "RotaDovizBanknoteBuying" => $euro_efektif_alis,
    "RotaDovizBanknoteSelling" => $euro_efektif_satis,
    "RotaDovizUnit" => $euro_unit
));

ob_end_flush();

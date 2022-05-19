CREATE TABLE `DovizKur` (
	`DovizKurID` INT(11) NOT NULL AUTO_INCREMENT,
	`DovizCurrencyID` INT(11) NOT NULL,
	`DovizTarih` DATE NOT NULL,
	`DovizForexBuying` DECIMAL(12,4) NOT NULL,
	`DovizForexSelling` DECIMAL(12,4) NOT NULL,
	`DovizBanknoteBuying` DECIMAL(12,4) NOT NULL,
	`DovizBanknoteSelling` DECIMAL(12,4) NOT NULL,
	`DovizUnit` INT(11) NOT NULL,
	`DovizOlusturma` DATETIME NOT NULL DEFAULT current_timestamp(),
	`DovizGuncelleme` DATETIME NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`DovizKurID`) USING BTREE
)COLLATE='utf8mb4_turkish_ci' ENGINE=InnoDB AUTO_INCREMENT=1;
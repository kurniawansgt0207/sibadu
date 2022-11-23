INSERT INTO `simu`.`master_anggota`
(`noAnggota`,`namaAnggota`,`tglLahir`,`jnsKelamin`,`level`,
`stsKeluarga`,`pekerjaan`,`pendidikanAkhir`,`wali`,`departemen`,`unit`,
`created_date`,`created_by`,`ip_address`)
SELECT a.`NO`,a.`NAMA`,a.`TGLLAHIR`,a.`LK_PR`,b.`id` lvlid,
IFNULL(e.`id`,0) stskel,IFNULL(c.`id`,0) pekerjaanid,IFNULL(d.id,0) pendidikanid,a.`WALI`,6 dept,1 unit,
NOW() createdate,'Admin' createby,'127.0.0.1' ipaddress
FROM importexcel_6 a
INNER JOIN master_level b ON a.`LEVEL`=b.`level`
LEFT JOIN master_pekerjaan c ON a.`PEKERJAAN`=c.`pekerjaan`
LEFT JOIN master_pendidikan d ON a.`PEND_TERAKHIR`=d.`pendidikan`
LEFT JOIN master_status_keluarga e ON a.`STS_KELUARGA`=e.`status_keluarga`
ORDER BY a.NO;

UPDATE importexcel_6 a SET a.`LEVEL`='PRA' WHERE a.`LEVEL` IS NULL;
UPDATE importexcel_6 a SET a.`LEVEL`=REPLACE(a.`LEVEL`,'.0','');

SELECT * FROM master_anggota a WHERE LEFT(a.`noAnggota`,4)='RT03';
UPDATE master_anggota a SET a.`departemen`=3 WHERE LEFT(a.`noAnggota`,4)='RT03';
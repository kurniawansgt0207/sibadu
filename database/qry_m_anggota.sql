SELECT a.noAnggota,a.namaAnggota,a.tglLahir,a.jnsKelamin,a.`level` levelId,
b.`level`,a.`stsKeluarga` stsKeluargaId, c.`status_keluarga`,a.`pekerjaan` pekerjaanId,
d.`pekerjaan`,a.`pendidikanAkhir` pendidikanId,e.`pendidikan`,a.`WALI` wali,
a.`created_date`,a.`created_by`,a.`updated_date`,a.`updated_by`,a.`ip_address`
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
INNER JOIN master_status_keluarga c ON a.`stsKeluarga`=c.`id`
INNER JOIN master_pekerjaan d ON a.`pekerjaan`=d.`id`
INNER JOIN master_pendidikan e ON a.`pendidikanAkhir`=e.`id`;
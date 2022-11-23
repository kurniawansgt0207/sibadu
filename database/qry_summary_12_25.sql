SELECT lvl,SUM(JmlLK) JmlLK,MAX(genderLK) `LK`,
SUM(JmlPR) JmlPR,MAX(genderPR) `PR`
FROM
(
SELECT 'PRA' lvl,COUNT(malk.noAnggota) JmlLK,'LK' genderLK,
0 jmlPR,'' genderPR
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='LK' AND b.`level`='PRA'
) AS malk WHERE (maLK.usia >= 41)
UNION ALL
SELECT '0' lvl,COUNT(malk.noAnggota) JmlLK,'LK' genderLK,
0 jmlPR,'' genderPR
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='LK' AND b.`level`='0'
) AS malk WHERE (maLK.usia >= 41)
UNION ALL
SELECT '1' lvl,COUNT(malk.noAnggota) JmlLK,'LK' genderLK,
0 jmlPR,'' genderPR
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='LK' AND b.`level`='1'
) AS malk WHERE (maLK.usia >= 41)
UNION ALL
SELECT '2' lvl,COUNT(malk.noAnggota) JmlLK,'LK' genderLK,
0 jmlPR,'' genderPR
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='LK' AND b.`level`='2'
) AS malk WHERE (maLK.usia >= 41)
UNION ALL
SELECT '3' lvl,COUNT(malk.noAnggota) JmlLK,'LK' genderLK,
0 jmlPR,'' genderPR
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='LK' AND b.`level`='3'
) AS malk WHERE (maLK.usia >= 41)
UNION ALL

SELECT 'PRA' lvl,0 JmlLK,'' genderLK,
COUNT(maPR.noAnggota) jmlPR,'PR' genderPR
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='PR' AND b.`level`='PRA'
) AS maPR WHERE (maPR.usia >= 41)
UNION ALL
SELECT '0' lvl,0 JmlLK,'' genderLK,
COUNT(maPR.noAnggota) jmlPR,'PR' genderPR
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='PR' AND b.`level`='0'
) AS maPR WHERE (maPR.usia >= 41)
UNION ALL
SELECT '1' lvl,0 JmlLK,'' genderLK,
COUNT(maPR.noAnggota) jmlPR,'PR' genderPR
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='PR' AND b.`level`='1'
) AS maPR WHERE (maPR.usia >= 41)
UNION ALL
SELECT '2' lvl,0 JmlLK,'' genderLK,
COUNT(maPR.noAnggota) jmlPR,'PR' genderPR
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='PR' AND b.`level`='2'
) AS maPR WHERE (maPR.usia >= 41)
UNION ALL
SELECT '3' lvl,0 JmlLK,'' genderLK,
COUNT(maPR.noAnggota) jmlPR,'PR' genderPR
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='PR' AND b.`level`='3'
) AS maPR WHERE (maPR.usia >= 41)
) AS rs
GROUP BY rs.lvl


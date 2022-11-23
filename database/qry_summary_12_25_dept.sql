SELECT lvl `Level`,SUM(JmlLK) JmlLK,MAX(genderLK) `LK`,
SUM(JmlPR) JmlPR,MAX(genderPR) `PR`,md.`description` Dept
FROM
(
SELECT ml.`level` lvl, IFNULL(JmlLK,0) JmlLK,
IFNULL(genderLK,'LK') genderLK,
jmlPR,genderPR,IFNULL(dept,10) dept
FROM
(
SELECT 'PRA' lvl,COUNT(malk.noAnggota) JmlLK,'LK' genderLK,
0 jmlPR,'' genderPR,IFNULL(departemen,99) dept
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,a.`departemen`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='LK' AND b.`level`='PRA' AND a.`departemen`=10
) AS malk WHERE (maLK.usia >=41)
GROUP BY dept
UNION ALL
SELECT '0' lvl,COUNT(malk.noAnggota) JmlLK,'LK' genderLK,
0 jmlPR,'' genderPR,IFNULL(departemen,99) dept
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,a.`departemen`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='LK' AND b.`level`='0' AND a.`departemen`=10
) AS malk WHERE (maLK.usia >=41)
GROUP BY dept
UNION ALL
SELECT '1' lvl,COUNT(malk.noAnggota) JmlLK,'LK' genderLK,
0 jmlPR,'' genderPR,IFNULL(departemen,99) dept
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,a.`departemen`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='LK' AND b.`level`='1' AND a.`departemen`=10
) AS malk WHERE (maLK.usia >=41)
GROUP BY dept
UNION ALL
SELECT '2' lvl,COUNT(malk.noAnggota) JmlLK,'LK' genderLK,
0 jmlPR,'' genderPR,IFNULL(departemen,99) dept
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,a.`departemen`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='LK' AND b.`level`='2' AND a.`departemen`=10
) AS malk WHERE (maLK.usia >=41)
GROUP BY dept
UNION ALL
SELECT '3' lvl,COUNT(malk.noAnggota) JmlLK,'LK' genderLK,
0 jmlPR,'' genderPR,IFNULL(departemen,99) dept
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,b.`level`,a.`departemen`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
INNER JOIN master_level b ON a.`level`=b.`id`
WHERE a.`jnsKelamin`='LK' AND b.`level`='3' AND a.`departemen`=10
) AS malk WHERE (maLK.usia >=41)
GROUP BY dept
) AS rsLK 
RIGHT JOIN master_level ml ON ml.`level`=rsLK.lvl
UNION ALL
SELECT ml.`level` lvl,0 JmlLK, '' genderLK,
IFNULL(jmlPR,0) JmlPR,IFNULL(genderPR,'PR') genderPR,
IFNULL(dept,10) dept
FROM 
(
SELECT 'PRA' lvl,0 JmlLK,'' genderLK,
COUNT(maPR.noAnggota) jmlPR,'PR' genderPR,IFNULL(departemen,99) dept
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,a.`level`,a.`departemen`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
WHERE a.`jnsKelamin`='PR' AND a.`level`=5 AND a.`departemen`=10
) AS maPR WHERE (maPR.usia >=41)
GROUP BY dept
UNION ALL
SELECT '0' lvl,0 JmlLK,'' genderLK,
COUNT(maPR.noAnggota) jmlPR,'PR' genderPR,IFNULL(departemen,99) dept
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,a.`level`,a.`departemen`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
WHERE a.`jnsKelamin`='PR' AND a.`level`=1 AND a.`departemen`=10
) AS maPR WHERE (maPR.usia >=41)
GROUP BY dept
UNION ALL
SELECT '1' lvl,0 JmlLK,'' genderLK,
COUNT(maPR.noAnggota) jmlPR,'PR' genderPR,IFNULL(departemen,99) dept
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,a.`level`,a.`departemen`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
WHERE a.`jnsKelamin`='PR' AND a.`level`=2 AND a.`departemen`=10
) AS maPR WHERE (maPR.usia >=41)
GROUP BY dept
UNION ALL
SELECT '2' lvl,0 JmlLK,'' genderLK,
COUNT(maPR.noAnggota) jmlPR,'PR' genderPR,IFNULL(departemen,99) dept
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,a.`level`,a.`departemen`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
WHERE a.`jnsKelamin`='PR' AND a.`level`=3 AND a.`departemen`=10
) AS maPR WHERE (maPR.usia >=41)
GROUP BY dept
UNION ALL
SELECT '3' lvl,0 JmlLK,'' genderLK,
COUNT(maPR.noAnggota) jmlPR,'PR' genderPR,IFNULL(departemen,99) dept
FROM
(
SELECT a.`noAnggota`,a.`namaAnggota`,a.`level`,a.`departemen`,
IFNULL(YEAR(CURDATE())-YEAR(a.`tglLahir`),0) usia 
FROM master_anggota a
WHERE a.`jnsKelamin`='PR' AND a.`level`=4 AND a.`departemen`=10
) AS maPR WHERE (maPR.usia >=41)
GROUP BY dept
) AS rsPR
RIGHT JOIN master_level ml 
ON ml.`level`=rsPR.lvl
) AS rs
INNER JOIN master_department md ON md.`departmentid`=rs.dept
GROUP BY rs.lvl


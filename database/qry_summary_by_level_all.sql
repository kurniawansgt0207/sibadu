SELECT md.`description` dept,SUM(jml_0) jml_0,SUM(jml_1) jml_1,SUM(jml_2) jml_2,
SUM(jml_3) jml_3,SUM(jml_pra) jml_pra
FROM
(
SELECT a.`departemen`,COUNT(a.`noAnggota`) jml_0,0 jml_1,0 jml_2,0 jml_3,0 jml_pra 
FROM master_anggota a 
WHERE a.`level`=1 AND a.`jnsKelamin` IN ('LK','PR')
GROUP BY a.`departemen`
UNION ALL
SELECT a.`departemen`,0 jml_0,COUNT(a.`noAnggota`) jml_1,0 jml_2,0 jml_3,0 jml_pra 
FROM master_anggota a 
WHERE a.`level`=2 AND a.`jnsKelamin` IN ('LK','PR')
GROUP BY a.`departemen`
UNION ALL
SELECT a.`departemen`,0 jml_0,0 jml_1,COUNT(a.`noAnggota`) jml_2,0 jml_3,0 jml_pra 
FROM master_anggota a 
WHERE a.`level`=3 AND a.`jnsKelamin` IN ('LK','PR')
GROUP BY a.`departemen`
UNION ALL
SELECT a.`departemen`,0 jml_0,0 jml_1,0 jml_2,COUNT(a.`noAnggota`) jml_3,0 jml_pra 
FROM master_anggota a 
WHERE a.`level`=4 AND a.`jnsKelamin` IN ('LK','PR')
GROUP BY a.`departemen`
UNION ALL
SELECT a.`departemen`,0 jml_0,0 jml_1,0 jml_2,0 jml_3,COUNT(a.`noAnggota`) jml_pra 
FROM master_anggota a 
WHERE a.`level`=5 AND a.`jnsKelamin` IN ('LK','PR')
GROUP BY a.`departemen`
) AS rs
INNER JOIN master_department md ON rs.departemen=md.`departmentid`
GROUP BY rs.departemen
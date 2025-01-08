## TODO LIST: Rancangan Database

[ ] DATABASE
1. **USER**
    - Nama tabel: users
    - Gunakan breeze
    - 
2. **JURNAL**
    - Nama tabel: jurnal
    - Nama Kolom:
    - id_anak_pkl
    - id_jurnal
    - aktifitas
    - tanggal_jurnal
    - waktu_mulai_aktifitas
    - waktu_selesai_aktifitas
    - durasi
    - keterangan
    - gambar pendukung
    *Foreign dengan users 

3. **MENTOR**
    - Nama tabel: mentor
    - Nama Kolom:
    - id_mentor
    - id_user
    - nama_mentor
    - alamat_mentor
    - no_telp_mentor
    - email_mentor
    - foto_mentor
    - ttd_mentor
    *Foreign dengan users

4. **ANAK PKL**
    - Nama tabel: anak_pkl
    - Nama Kolom:
    - id_anak_pkl
    - id_user
    - id_mentor
    - nama_anak_pkl
    - alamat_anak_pkl
    - no_telp_anak_pkl
    - email_anak_pkl
    - foto_anak_pkl
    *Foreign dengan users
    *Foreign dengan mentor

5. **FEEDBACK MENTOR**
    - Nama tabel: feedback_mentor
    - Nama Kolom:
    - id_feedback_mentor
    - id_anak_pkl
    - id_mentor
    - feedback
    - tanggal_feedback
    - keterangan
    *Foreign dengan anak_pkl
    *Foreign dengan mentor

6. **FEEDBACK ANAK PKL**
    - Nama tabel: feedback_anak_pkl
    - Nama Kolom:
    - id_feedback_anak_pkl
    - id_anak_pkl
    - id_mentor
    - feedback
    - tanggal_feedback
    - keterangan
    *Foreign dengan anak_pkl
    *Foreign dengan mentor

7. **JADWAL PKL**
    - Nama tabel: jadwal_pkl
    - Nama Kolom:
    - id_sekolah
    - id_anak_pkl
    - id_mentor
    - tanggal_pkl
    - jam_pkl
    - keterangan
    *Foreign dengan anak_pkl
    *Foreign dengan mentor

8.  **KETERAMPILAN**
    - Nama tabel: keterampilan
    - Nama Kolom:
    - id_keterampilan
    - nama_keterampilan
    - keterangan

9. **PENILAIAN**
    - Nama tabel: penilaian
    - Nama Kolom:
    - id_penilaian
    - id_anak_pkl
    - id_mentor
    - id_keterampilan
    - tanggal_penilaian
    - nilai
    - keterangan
    *Foreign dengan anak_pkl
    *Foreign dengan mentor

10. **SERTIFIKAT**
    - Nama tabel: sertifikat
    - Nama Kolom:
    - id_sertifikat
    - id_anak_pkl
    - id_keterampilan
    - id_penilaian
    - tanggal_sertifikat
    - keterangan
    *Foreign dengan anak_pkl
    *Foreign dengan mentor
    *Foreign dengan keterampilan
    *Foreign dengan penilaian

11. **SEKOLAH**
    - Nama tabel: sekolah
    - Nama Kolom:
    - id_sekolah
    - nama_sekolah
    - alamat_sekolah
    - status (boolean)
    - keterangan

11. **PERIODE_PKL**
    - Nama tabel: periode_pkl
    - Nama Kolom:
    - id_periode_pkl
    - id_sekolah
    - tanggal_mulai
    - tanggal_selesai
    - keterangan
    *Foreign dengan sekolah

\*note
Semua koding wajib clean code, pakai model, dan jelas, terutama untuk code API karena API ini multitenant.

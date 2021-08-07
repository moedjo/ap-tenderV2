<?php return [
    'plugin' => [
        'name' => 'Angkasa Pura',
        'description' => ''
    ],
    'permission' => [
        'tab' => [
            'master' => 'Master Data',
        ],
        'access_offices' => 'Akses Kantor',
        'access_positions' => 'Akses Jabatan',
        'access_business_entities' => 'Akses Bidang Usaha',
        'access_summaries' => 'Akses Kesimpulan',
        'access_verifications' => 'Akses Verifikasi',
        'access_regions' => 'Akses Wilayah',

    ],
    'global' => [
        'created_at' => 'Waktu Buat',
        'updated_at' => 'Waktu Ubah',
        'yes' => 'Ya',
        'no' => 'Tidak',
        'legal' => 'Legal',
        'finance' => 'Finance',
        'commercial' => 'Commercial',
        'invalid_token' => 'Invalid Token',
    ],
    'button' => [
        'back' => 'Kembali',
        'register' => 'Registrasi',
        'submit' => 'Kirim',
        'back' => 'Kembali',
        'next' => 'Selanjutnya',
    ],
    'office' => [
        'singular' => 'Kantor',
        'plural' => 'Daftar Kantor',

        'id' => 'Id Kantor',
        'name' => 'Nama Kantor',
        'description' => 'Keterangan',

        'create' => 'Buat Kantor',
        'update' => 'Ubah Kantor',
        'delete' => 'Hapus Kantor',
    ],
    'business_entity' => [
        'singular' => 'Badan Usaha',
        'plural' => 'Daftar Badan Usaha',

        'id' => 'Id Badan Usaha',
        'name' => 'Nama Badan Usaha',
        'description' => 'Keterangan',

        'create' => 'Buat Badan Usaha',
        'update' => 'Ubah Badan Usaha',
        'delete' => 'Hapus Badan Usaha',
    ],
    'business_field' => [
        'singular' => 'Bidang Usaha',
        'plural' => 'Daftar Bidang Usaha',

        'id' => 'Id Bidang Usaha',
        'name' => 'Nama Bidang Usaha',
        'description' => 'Keterangan',

        'create' => 'Buat Bidang Usaha',
        'update' => 'Ubah Bidang Usaha',
        'delete' => 'Hapus Bidang Usaha',
    ],
    'verification' => [
        'singular' => 'Verifikasi',
        'plural' => 'Daftar Verifikasi',

        'id' => 'Id Verifikasi',
        'type' => 'Tipe Verifikasi',
        'number' => 'No',
        'name' => 'Kategori',
        'description' => 'Informasi Umum',
        'fields' => 'Bidang',

        'create' => 'Buat Verifikasi',
        'update' => 'Ubah Verifikasi',
        'delete' => 'Hapus Verifikasi',
    ],
    'position' => [
        'singular' => 'Jabatan',
        'plural' => 'Daftar Jabatan',

        'id' => 'Id Jabatan',
        'name' => 'Nama Jabatan',
        'description' => 'Keterangan',

        'create' => 'Buat Jabatan',
        'update' => 'Ubah Jabatan',
        'delete' => 'Hapus Jabatan',
    ],
    'summary' => [
        'singular' => 'Kesimpulan',
        'plural' => 'Daftar Kesimpulan',

        'id' => 'Id Kesimpulan',
        'name' => 'Nama Kesimpulan',
        'description' => 'Keterangan',

        'create' => 'Buat Kesimpulan',
        'update' => 'Ubah Kesimpulan',
        'delete' => 'Hapus Kesimpulan',
    ],
    'region' => [
        'singular' => 'Wilayah',
        'plural' => 'Daftar Wilayah',

        'id' => 'Id Wilayah',
        'name' => 'Nama Wilayah',
        'lat' => 'Latitude',
        'long' => 'Longitude',
        'type' => 'Tipe Wilayah',
        'postal_codes'=> 'Kode Pos',
        'parent' => 'Induk Wilayah',

        'create' => 'Buat Wilayah',
        'update' => 'Ubah Wilayah',
        'delete' => 'Hapus Wilayah',

        'province' => 'Provinsi',
        'regency' => 'Kota/Kabupaten',
        'district' => 'Kecamatan'
    ],
    'tenant' => [
        'short_form' => 'Pendaftaran Tenant',

        'short_form_section1' => 'Informasi Perusahaan',
        'short_form_section2' => 'Alamat Perusahaan',
        'short_form_section3' => 'Kontak Perusahaan',

        'legal_section1' => 'Informasi Perusahaan',
        'legal_section2' => 'Untuk Perusahaan Tunggal',
        'legal_section3' => 'Untuk Perusahaan Konsorsium',
        'legal_section4' => 'Perwakilan Hukum Konsorsium',
        'legal_section5' => 'Kualifikasi Perusahaan',
        'legal_section6' => 'Penanggung Jawab Perusahaan',
        'legal_section7' => 'Kontak Perusahaan',
        'legal_section8' => 'Dokumen Legal Perusahaan',

        'legal' => 'Informasi Umum',

        'name' => 'Nama Perusahaan',
        'npwp' => 'NPWP Tahun Terakhir',
        'collaborate' => 'Telah Bekerjasama dengan Angkasa Pura I sebelumnya?',
        'address' => 'Alamat Perusahaan',
        'konsorsium_comment' => 'Perusahaan Konsorsium atau Non Konsorsium ',
        'konsorsium' => 'Konsorsium',
        'non_konsorsium' => 'Non Konsorsium',
        'directors' => 'Daftar Direktur',
        'commissioners' => 'Daftar Komisaris',
        'director' => 'Direktur',
        'commissioner' => 'Komisaris',
        'konsorsium_total' => 'Jumlah Perusahaan',
        'konsorsium_name' => 'Nama Wakil Hukum',
        'konsorsium_function' => 'Fungsi Dalam Perusahaan',
        'business_fields' => 'Kategori Bisnis',
        'business_activity' => 'Kegiatan Usaha Pokok',
        'business_kbli' => 'Bidang Usaha (KBLI)',
        'contact_email' => 'Email',


        'business_entity' => 'Badan Usaha',

        'experience' => 'Pengalaman Perusahaan',
        'financial_ability' => 'Kemampuan Keuangan',

        'summary' => 'Kesimpulan',
        'summary_comment' => 'Silahkan cek statement yang telah tersedia pada tabel di bawah ini, kemudian klik SIMPAN untuk menyimpan
        dan dilanjutkan mengusulkan jadwal Verifikasi Dokumen.',
        'verification_office' => 'Lokasi Verifikasi Data',
        'region' => 'Wilayah',

        'contact_full_name' => 'Nama Lengkap',
        'contact_phone_number' => 'Nomor Telepon',
        'contact_position' => 'Jabatan',
        'phone_number' => 'Nomor Telepon',
        'fax_number' => 'Nomor Fax',
        'email' => 'Email',
        'website' =>  'Website',
        'konsorsium_role' => 'Peran Dalam Perusahaan',

        'pic' => 'Penanggung Jawab Perusahaan',
        'pic_full_name' => 'Nama',
        'pic_position' => 'Jabatan',
        'pic_phone_number' => 'Nomor Handphone',
        'pic_ktp' => 'Nomor KTP',
        'pic_email' => 'Email',

        'doc_legal_cooperation' => 'Surat Keterangan Bukti Kerja Sama',
        'doc_legal_akta' => 'Akta Perusahaan',
        'doc_legal_siup' =>'Surat Izin Usaha Perdagangan (SIUP)',
        'doc_legal_tdp' => 'Tanda Daftar Perusahaan (TDP)',
        'doc_legal_domisili' => 'Surat Keterangan Domisili tahun terakhir',
        'doc_legal_npwp' => 'Nomor Pokok Wajib Pajak (NPWP)',
        'doc_legal_ktp' => 'KTP Penanggung Jawab',
        'doc_legal_sk' => 'Surat Kuasa',
        'doc_legal_other' => 'Lainnya',
        'doc_legal_konsorsium' => 'Surat Perjanjian Konsorsium ',
        'doc_legal_cv' => 'Form Penyataan Upgrade dari CV ke PT',


        'doc_legal_cooperation_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_akta_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_siup_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_tdp_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_domisili_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_npwp_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_ktp_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_sk_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_other_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_konsorsium_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_cv_comment' => 'File (*pdf - max 40MB)',



        'token_activation' => 'Aktivasi Token'
    ],
    'card' => [
        'general' => 'Registrasi Awal',
        'first' => 'Informasi Umum',
        'second' => 'Pengalaman',
        'tree' => 'Kemampuan Keuangan',
        'four' => 'Ringkasan',
    ]
];

<?php return [
    'plugin' => [
        'name' => 'Angkasa Pura',
        'description' => ''
    ],
    'permission' => [
        'tab' => [
            'master' => 'Master Data',
            'role' => 'Tugas'
        ],
        'access_offices' => 'Akses Kantor',
        'access_positions' => 'Akses Jabatan',
        'access_business_entities' => 'Akses Badan Usaha',
        'access_business_fields' => 'Akses Bidang Usaha',
        'access_summaries' => 'Akses Kesimpulan',
        'access_verifications' => 'Akses Verifikasi',
        'access_regions' => 'Akses Wilayah',
        'access_tenants' => 'Akses Tenant',
        'access_tenders' => 'Akses Tender',
        'access_airports' => 'Akses Bandara',


        'is_tenant' => 'Sebagai Tenant',
        'is_legal' => 'Sebagai Legal',
        'is_commercial' => 'Sebagai Commercial',
        'is_finance' => 'Sebagai Finance',
        'is_admin_tender' => 'Sebagai Admin Tender',

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
        'approve' => 'Setuju'
    ],
    'button' => [
        'back' => 'Kembali',
        'register' => 'Registrasi',
        'submit' => 'Kirim',
        'back' => 'Kembali',
        'next' => 'Selanjutnya',
        'send_invitation' => 'Kirim Undangan',


        'approve' => 'Setuju',
        'reject' => 'Tidak Setuju'
    ],
    'status' => [
        'reject' => 'Reject',
        'short_listed'=> 'Short Listed', 
        'pre_clarificated'=> 'Pre Clarificated', 
        'pre_evaluated'=> 'Pre Evaluated', 
        'evaluated'=> 'Evaluated', 
        'register'=> 'Register', 
        'short_form'=> 'Short Form', 
        'pre_register'=> 'Pre Register', 
        'request_update' => 'Request Update',
        'request_update_approved' => 'Request Update Approved'
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
        'yes_or_no' => ' Ya (Centang Jika Sesuai)',
        
        'note' => 'Catatan',

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
        'singular' => 'Tenant',
        'plural' => 'Daftar Tenant',
        'my_tenant' => 'Tenant Saya',



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


        'commercial_section1' => 'Pengalaman Perusahaan',

        'finance_section1' => 'Kemampuan Keuangan',
        'finance_section2' => 'Dokumen Keuangan',

        'summary_section1' => 'Kesimpulan',
        'summary_section1_comment' => 'Silahkan cek statement yang telah tersedia pada tabel di bawah ini, kemudian klik SIMPAN untuk menyimpan
        dan dilanjutkan mengusulkan jadwal Verifikasi Dokumen.',

        'invite_section1' => 'Informasi Undangan',

        

        'legal' => 'Informasi Umum',
        'commercial' => 'Pengalaman Perusahaan',
        'finance' => 'Kemampuan Keuangan',
        'finances' => 'Kemampuan Keuangan',
        'verification' => 'Verifikasi Tenant',
        'invite' => 'Undangan Tenant',
        'on_verification' => 'Evaluasi',
        'on_last_verification' => 'Evaluasi Tahap Akhir',
        'off_last_verification' => 'Klarifikasi Tahap Akhir',
        'off_verification' => 'Klarifikasi',
        'verification_legals' => 'Verifikasi Data Legal',
        'verification_finances' => 'Verifikasi Data Finance',
        'verification_commercials' => 'Verifikasi Data Commercial',

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
        'konsorsium_function' => 'Jabatan dalam Perwakilan Konsorsium',
        'konsorsium_companies' => 'Nama Perusahaan dan Komposisi Ekuitas',
        'konsorsium_company' => 'Nama Perusahaan',
        'konsorsium_equity' => 'Komposisi Ekuitas',
        'business_fields' => 'Kategori Bisnis',
        'business_activity' => 'Kegiatan Usaha Pokok',
        'business_kbli' => 'Bidang Usaha (KBLI)',
        'contact_email' => 'Email',


        'business_entity' => 'Badan Usaha',

        'experience' => 'Pengalaman Perusahaan',
        'experiences' => 'Pengalaman Perusahaan',
        'has_experience' => 'Sudah Memiliki Pengalaman ?',
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
        'konsorsium_role' => 'Kedudukan Dalam Konsorsium',

        'pic' => 'Penanggung Jawab Perusahaan',
        'pic_full_name' => 'Nama',
        'pic_position' => 'Jabatan',
        'pic_phone_number' => 'Nomor Handphone',
        'pic_ktp' => 'Nomor KTP',
        'pic_email' => 'Email',


        'invite_name'=>'Agenda',
        'invite_location'=>'Lokasi Undangan',
        'invite_pic_phone_number'=>'Kontak PIC',
        'invite_date'=>'Tanggal Undangan',
        'invite_hour_start'=>'Waktu Mulai',
        'invite_hour_end'=>'Waktu Berakhir',
        'invite_description'=>'Deskripsi Pengumuman',


        'legal_status' => 'Legal Status',
        'finance_status' =>  'Finance Status',
        'commercial_status' => 'Commercial Status',

        'status' => 'Tenant Status',



        'doc_legal_cooperation' => 'Surat Keterangan Bukti Kerja Sama',
        'doc_legal_akta' => 'Akta Perusahaan',
        'doc_legal_nib' =>'NIB / Surat Izin Usaha',
        'doc_legal_domisili' => 'Surat Keterangan Domisili tahun terakhir',
        'doc_legal_npwp' => 'Nomor Pokok Wajib Pajak (NPWP)',
        'doc_legal_ktp' => 'KTP Penanggung Jawab',
        'doc_legal_sk' => 'Surat Kuasa (Apabila Dikuasakan)',
        'doc_legal_other' => 'Lainnya',
        'doc_legal_konsorsium' => 'Perjanjian/Nota Kesepahaman Konsorsium',
        'doc_legal_cv' => 'Form Penyataan Upgrade dari CV ke PT',


        'doc_legal_cooperation_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_akta_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_nib_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_domisili_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_npwp_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_ktp_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_sk_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_other_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_konsorsium_comment' => 'File (*pdf - max 40MB)',
        'doc_legal_cv_comment' => 'File (*pdf - max 40MB)',


        
        'doc_finance_sppkp' => 'Surat Pengukuhan Pengusaha Kena Pajak (SPPKP)',
        'doc_finance_spt' => 'SPT Pajak Tahunan',
        'doc_finance_blp' => 'Bukti Lapor Pajak',
        'doc_finance_bsp' => 'Bukti Setoran Pajak',
        'doc_finance_sklp' => 'Surat Keterangan Kelancaran Pembayaran',
        'doc_finance_other' => 'Lainnya',   
        'doc_finance_collaborate' => 'Bukti Dokumen Kerjasama',


        'doc_finance_sppkp_comment' => 'File (*pdf - max 40MB)',
        'doc_finance_spt_comment' => 'File (*pdf - max 40MB)',
        'doc_finance_blp_comment' => 'File (*pdf - max 40MB)',
        'doc_finance_bsp_comment' => 'File (*pdf - max 40MB)',
        'doc_finance_sklp_comment' => 'File (*pdf - max 40MB)',
        'doc_finance_other_comment' => 'File (*pdf - max 40MB)',
        'doc_finance_collaborate_comment' => 'File (*pdf - max 40MB)',

        'token_activation' => 'Aktivasi Token',
        'token_activation_success' => 'Aktivasi Token Sukses',
        'user_registration' => 'Registrasi Pengguna',


        'request_update' => 'Minta Pembaharuan', 
    ],
    'card' => [
        'general' => 'Registrasi Awal',
        'first' => 'Informasi Umum',
        'second' => 'Pengalaman',
        'tree' => 'Kemampuan Keuangan',
        'four' => 'Ringkasan',
    ],
    'experience' => [

        'singular' => 'Pengalaman Perusahaan',

        'business_field' => 'Kategori Pengalaman',
        'name' => 'Nama Pengalaman',
        'region_area' => 'Luas Area (m2)',
        'region' => 'Wilayah',
        'region_text' => 'Wilayah Luar Negri',
        'total_income' => 'Total Pendapatan (Rp.)',
        'cooperation_period' => 'Masa Kerjasama',
        'operational_hour' => 'Jam Operasional',
        'cooperation_period_start' => 'Masa Kerjasama (Awal)',
        'cooperation_period_end' => 'Masa Kerjasama (Akhir)',
        'operational_hour_start' => 'Jam Operasional (Awal)',
        'operational_hour_end' => 'Jam Operasional (Akhir)',
        'doc_experience' => 'Dokumen Perjanjian',
        'doc_experience_comment' => 'File (*pdf - max 40MB)',

        'create' => 'Buat Pengalaman Perusahaan',
        'update' => 'Ubah Pengalaman Perusahaan',
        'delete' => 'Hapus Pengalaman Perusahaan',
    ],
    'finance' => [
        'singular' => 'Keuangan Perusahaan',

        'year' => 'Tahun',
        'total_income' => 'Total Penghasilan (Rp.)',
        'doc_finance' => 'Dokumen Keuangan',
        'doc_finance_comment' => 'File (*pdf - max 40MB)',
    ],

    'tender' => [
        'singular' => 'Tender',
        'plural' => 'Daftar Tender',

        'create' => 'Buat Tender',
        'update' => 'Ubah Tender',

        'section1' => 'Informasi Tender',

        'name' => 'Nama Tender',
        'package' => 'Paket Tender',
        'business_field' => 'Kategori Bisnis',

        'airport' => 'Bandara',

        'pic_full_name' => 'Nama PIC',
        'pic_email' => 'Kontak PIC (email)',

        'description' => 'Deskripsi Pengumuman',


        'rooms' => 'Ruangan',
        'pic_full_name' => 'Nama PIC',
        'pic_email' => 'Kontak PIC (email)',


        'section2' => 'Jadwal Pendaftaran', 
        'date_start' => 'Tanggal Dimulai',
        'date_end' => 'Tanggal Berakhir',
    ],

    'airport' => [
        'singular' => 'Bandara',
        'plural' => 'Daftar Bandara',

        'id' => 'Id Bandara',
        'name' => 'Nama Bandara',
        'description' => 'Keterangan',

        'create' => 'Buat Bandara',
        'update' => 'Ubah Bandara',
        'delete' => 'Hapus Bandara',
    ]
];

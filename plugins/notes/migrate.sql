ALTER TABLE ap_tender_tenders_tenants ADD is_candidate_winner tinyint(1) DEFAULT 0 NOT NULL;

ALTER TABLE ap_tender_tenders_tenants ADD invite_negotiation_name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD invite_negotiation_description varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD invite_negotiation_location varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD invite_negotiation_pic_phone_number varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD invite_negotiation_date timestamp DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD invite_negotiation_hour_start timestamp DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD invite_negotiation_hour_end timestamp DEFAULT NULL NULL;

-Submit RFP (Notif Ke admin tenant & Finance)
-Approval reject atau approve (Notif ke Tenant)
-Udangan aanwijzing Ke tenant (Bulk ke ynag udah bayar) -
- Discuss 
-Masukin dokumen envelope I & II
-Kirim Undangan Klarifikasi Ke Tenant (per tenant)
-Pembukaan&Scoring Envelope I (Lolos/Tidak lolos notif ke tenant)
-Pembukaan&Scoring Envelope II (Hanya bagi yang lolos Envelope I)
-Undangan Nego (Per vendor)
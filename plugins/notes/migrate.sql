ALTER TABLE ap_tender_tenders ADD invite_name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders ADD invite_description varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders ADD invite_location varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders ADD invite_pic_phone_number varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders ADD invite_date timestamp DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders ADD invite_hour_start timestamp DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders ADD invite_hour_end timestamp DEFAULT NULL NULL;

ALTER TABLE ap_tender_tenders_tenants ADD invite_name varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD invite_description varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD invite_location varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD invite_pic_phone_number varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD invite_date timestamp DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD invite_hour_start timestamp DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD invite_hour_end timestamp DEFAULT NULL NULL;


ALTER TABLE ap_tender_tenders_tenants ADD is_payment_rfp tinyint(1) DEFAULT 0 NOT NULL;

ALTER TABLE ap_tender_tenders_tenants ADD envelope1_score decimal(15,2) unsigned DEFAULT NULL NULL;
ALTER TABLE ap_tender_tenders_tenants ADD envelope2_score decimal(15,2) unsigned DEFAULT NULL NULL;

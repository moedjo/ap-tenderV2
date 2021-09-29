ALTER TABLE ap_tender_tenders ADD winner_tender_tenant_id int(10) unsigned DEFAULT NULL NULL;

ALTER TABLE ap_tender_tenders_tenants DROP COLUMN is_candidate_winner;
ALTER TABLE ap_tender_tenders_tenants DROP COLUMN is_winner;
ALTER TABLE ap_tender_tenders_tenants DROP COLUMN is_winner_publish;

ALTER TABLE ap_tender_tenders_tenants ADD last_total_price decimal(15,0) unsigned DEFAULT NULL NULL;

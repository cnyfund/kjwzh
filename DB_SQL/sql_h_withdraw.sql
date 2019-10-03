ALTER TABLE h_withdraw ADD COLUMN api_key varchar(128) NULL COMMENT '';
ALTER TABLE h_withdraw ADD FOREIGN KEY (h_userName, api_key)
        REFERENCES h_member(h_userName, api_key)
        ON DELETE CASCADE
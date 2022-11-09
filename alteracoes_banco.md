

ALTER TABLE wwlink_system.finances_payments ADD COLUMN fees bigint;
ALTER TABLE wwlink_system.finances_payments ADD COLUMN fine bigint;
ALTER TABLE wwlink_system.finances_payments ADD COLUMN recurrent boolean;
ALTER TABLE wwlink_system.finances_payments ADD COLUMN division bigint;







ALTER TABLE wwlink_system.finances_receipts ADD COLUMN fees bigint;
ALTER TABLE wwlink_system.finances_receipts ADD COLUMN fine bigint;
ALTER TABLE wwlink_system.finances_receipts ADD COLUMN recurrent boolean;
ALTER TABLE wwlink_system.finances_receipts ADD COLUMN division bigint;
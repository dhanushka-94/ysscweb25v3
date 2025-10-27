-- =====================================================
-- ROLLBACK SCRIPT - USE ONLY IF NEEDED
-- This will undo all team category changes
-- =====================================================

-- STEP 1: REMOVE FOREIGN KEY CONSTRAINT
ALTER TABLE teams DROP FOREIGN KEY fk_teams_category_id;

-- STEP 2: REMOVE NEW COLUMNS
ALTER TABLE teams DROP COLUMN category_id;
ALTER TABLE fixtures DROP COLUMN home_team_logo;
ALTER TABLE fixtures DROP COLUMN away_team_logo;

-- STEP 3: DROP NEW TABLE
DROP TABLE team_categories;

-- STEP 4: RESTORE FROM BACKUP (if needed)
-- Uncomment these lines only if you need to restore data:
-- DELETE FROM teams;
-- INSERT INTO teams SELECT * FROM teams_backup;
-- DELETE FROM fixtures;
-- INSERT INTO fixtures SELECT * FROM fixtures_backup;

-- STEP 5: CLEAN UP BACKUP TABLES (after confirming everything works)
-- DROP TABLE teams_backup;
-- DROP TABLE fixtures_backup;
-- DROP TABLE settings_backup;

SELECT 'Rollback completed successfully!' as status;

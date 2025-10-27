-- =====================================================
-- YSSC WEBSITE DATABASE UPDATE SCRIPT
-- Safe Database Migration with Data Backup
-- =====================================================

-- STEP 1: CREATE BACKUP TABLES (SAFETY FIRST)
-- =====================================================

-- Backup existing teams table
CREATE TABLE teams_backup AS SELECT * FROM teams;

-- Backup existing fixtures table  
CREATE TABLE fixtures_backup AS SELECT * FROM fixtures;

-- Backup existing settings table
CREATE TABLE settings_backup AS SELECT * FROM settings;

-- Show backup confirmation
SELECT 'Backup tables created successfully' as status;

-- =====================================================
-- STEP 2: CREATE NEW TABLES
-- =====================================================

-- Create team_categories table
CREATE TABLE IF NOT EXISTS team_categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NULL,
    color VARCHAR(7) DEFAULT '#facc15',
    `order` INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_order (order),
    INDEX idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- STEP 3: ADD NEW COLUMNS TO EXISTING TABLES
-- =====================================================

-- Add category_id to teams table (if not exists)
SET @column_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'teams' 
    AND COLUMN_NAME = 'category_id'
);

SET @sql = IF(@column_exists = 0, 
    'ALTER TABLE teams ADD COLUMN category_id BIGINT UNSIGNED NULL AFTER is_active',
    'SELECT "category_id column already exists" as message'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Add team logos to fixtures table (if not exists)
SET @column_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'fixtures' 
    AND COLUMN_NAME = 'home_team_logo'
);

SET @sql = IF(@column_exists = 0, 
    'ALTER TABLE fixtures ADD COLUMN home_team_logo VARCHAR(255) NULL AFTER home_team, ADD COLUMN away_team_logo VARCHAR(255) NULL AFTER away_team',
    'SELECT "team logo columns already exist" as message'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =====================================================
-- STEP 4: ADD FOREIGN KEY CONSTRAINTS
-- =====================================================

-- Add foreign key constraint for teams.category_id
SET @fk_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'teams' 
    AND COLUMN_NAME = 'category_id'
    AND CONSTRAINT_NAME != 'PRIMARY'
);

SET @sql = IF(@fk_exists = 0, 
    'ALTER TABLE teams ADD CONSTRAINT fk_teams_category_id FOREIGN KEY (category_id) REFERENCES team_categories(id) ON DELETE SET NULL ON UPDATE CASCADE',
    'SELECT "Foreign key constraint already exists" as message'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =====================================================
-- STEP 5: INSERT SAMPLE DATA
-- =====================================================

-- Insert team categories
INSERT IGNORE INTO team_categories (name, slug, description, color, `order`, is_active, created_at, updated_at) VALUES
('Main Team', 'main-team', 'Senior team members and first team players', '#facc15', 1, TRUE, NOW(), NOW()),
('Under 16 Team', 'under-16-team', 'Youth team players under 16 years old', '#3b82f6', 2, TRUE, NOW(), NOW()),
('Under 18 Team', 'under-18-team', 'Youth team players under 18 years old', '#10b981', 3, TRUE, NOW(), NOW()),
('Coaching Staff', 'coaching-staff', 'Coaches, assistant coaches, and technical staff', '#8b5cf6', 4, TRUE, NOW(), NOW()),
('Management', 'management', 'Team management and administrative staff', '#f59e0b', 5, TRUE, NOW(), NOW()),
('Reserve Team', 'reserve-team', 'Reserve team players and substitutes', '#ef4444', 6, TRUE, NOW(), NOW());

-- =====================================================
-- STEP 6: VERIFICATION QUERIES
-- =====================================================

-- Verify team_categories table
SELECT 'Team Categories Table' as table_name, COUNT(*) as record_count FROM team_categories;

-- Verify teams table structure
SELECT 'Teams Table Structure' as info;
DESCRIBE teams;

-- Verify fixtures table structure  
SELECT 'Fixtures Table Structure' as info;
DESCRIBE fixtures;

-- Check foreign key constraints
SELECT 
    TABLE_NAME,
    COLUMN_NAME,
    CONSTRAINT_NAME,
    REFERENCED_TABLE_NAME,
    REFERENCED_COLUMN_NAME
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
WHERE TABLE_SCHEMA = DATABASE() 
AND TABLE_NAME = 'teams' 
AND COLUMN_NAME = 'category_id';

-- =====================================================
-- STEP 7: ROLLBACK SCRIPT (IN CASE OF ISSUES)
-- =====================================================

/*
-- UNCOMMENT ONLY IF YOU NEED TO ROLLBACK:

-- Drop foreign key constraint
ALTER TABLE teams DROP FOREIGN KEY fk_teams_category_id;

-- Drop new columns
ALTER TABLE teams DROP COLUMN category_id;
ALTER TABLE fixtures DROP COLUMN home_team_logo, DROP COLUMN away_team_logo;

-- Drop new table
DROP TABLE IF EXISTS team_categories;

-- Restore from backup (if needed)
-- INSERT INTO teams SELECT * FROM teams_backup WHERE id NOT IN (SELECT id FROM teams);
-- INSERT INTO fixtures SELECT * FROM fixtures_backup WHERE id NOT IN (SELECT id FROM fixtures);

-- Drop backup tables (after confirming everything works)
-- DROP TABLE teams_backup;
-- DROP TABLE fixtures_backup;
-- DROP TABLE settings_backup;
*/

-- =====================================================
-- COMPLETION MESSAGE
-- =====================================================

SELECT 'Database update completed successfully!' as status,
       'All team category functionality is now available' as message,
       'Backup tables created for safety' as backup_info;

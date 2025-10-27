-- =====================================================
-- SIMPLE YSSC DATABASE UPDATE
-- Execute these queries one by one in phpMyAdmin/cPanel
-- =====================================================

-- STEP 1: CREATE BACKUP (SAFETY FIRST)
CREATE TABLE teams_backup AS SELECT * FROM teams;
CREATE TABLE fixtures_backup AS SELECT * FROM fixtures;
CREATE TABLE settings_backup AS SELECT * FROM settings;

-- STEP 2: CREATE TEAM CATEGORIES TABLE
CREATE TABLE team_categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NULL,
    color VARCHAR(7) DEFAULT '#facc15',
    `order` INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- STEP 3: ADD CATEGORY COLUMN TO TEAMS TABLE
ALTER TABLE teams ADD COLUMN category_id BIGINT UNSIGNED NULL AFTER is_active;

-- STEP 4: ADD TEAM LOGO COLUMNS TO FIXTURES TABLE
ALTER TABLE fixtures ADD COLUMN home_team_logo VARCHAR(255) NULL AFTER home_team;
ALTER TABLE fixtures ADD COLUMN away_team_logo VARCHAR(255) NULL AFTER away_team;

-- STEP 5: ADD FOREIGN KEY CONSTRAINT
ALTER TABLE teams ADD CONSTRAINT fk_teams_category_id 
FOREIGN KEY (category_id) REFERENCES team_categories(id) 
ON DELETE SET NULL ON UPDATE CASCADE;

-- STEP 6: INSERT SAMPLE TEAM CATEGORIES
INSERT INTO team_categories (name, slug, description, color, `order`, is_active) VALUES
('Main Team', 'main-team', 'Senior team members and first team players', '#facc15', 1, TRUE),
('Under 16 Team', 'under-16-team', 'Youth team players under 16 years old', '#3b82f6', 2, TRUE),
('Under 18 Team', 'under-18-team', 'Youth team players under 18 years old', '#10b981', 3, TRUE),
('Coaching Staff', 'coaching-staff', 'Coaches, assistant coaches, and technical staff', '#8b5cf6', 4, TRUE),
('Management', 'management', 'Team management and administrative staff', '#f59e0b', 5, TRUE),
('Reserve Team', 'reserve-team', 'Reserve team players and substitutes', '#ef4444', 6, TRUE);

-- STEP 7: VERIFY EVERYTHING WORKS
SELECT 'Team Categories' as table_name, COUNT(*) as count FROM team_categories;
SELECT 'Teams with categories' as info, COUNT(*) as count FROM teams WHERE category_id IS NOT NULL;
SELECT 'Backup tables created' as status, 'teams_backup, fixtures_backup, settings_backup' as tables;

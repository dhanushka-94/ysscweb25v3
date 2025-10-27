-- =====================================================
-- VERIFICATION SCRIPT
-- Run this after the database update to verify everything works
-- =====================================================

-- Check if team_categories table exists and has data
SELECT 
    'Team Categories Table' as check_name,
    CASE 
        WHEN COUNT(*) > 0 THEN 'SUCCESS - Table exists with data'
        ELSE 'FAILED - Table empty or missing'
    END as status,
    COUNT(*) as record_count
FROM team_categories;

-- Check if teams table has category_id column
SELECT 
    'Teams Table Structure' as check_name,
    CASE 
        WHEN COUNT(*) > 0 THEN 'SUCCESS - category_id column exists'
        ELSE 'FAILED - category_id column missing'
    END as status,
    COUNT(*) as column_count
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() 
AND TABLE_NAME = 'teams' 
AND COLUMN_NAME = 'category_id';

-- Check if fixtures table has team logo columns
SELECT 
    'Fixtures Table Structure' as check_name,
    CASE 
        WHEN COUNT(*) = 2 THEN 'SUCCESS - Both logo columns exist'
        WHEN COUNT(*) = 1 THEN 'PARTIAL - Only one logo column exists'
        ELSE 'FAILED - Logo columns missing'
    END as status,
    COUNT(*) as column_count
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() 
AND TABLE_NAME = 'fixtures' 
AND COLUMN_NAME IN ('home_team_logo', 'away_team_logo');

-- Check foreign key constraint
SELECT 
    'Foreign Key Constraint' as check_name,
    CASE 
        WHEN COUNT(*) > 0 THEN 'SUCCESS - Foreign key exists'
        ELSE 'FAILED - Foreign key missing'
    END as status,
    COUNT(*) as constraint_count
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
WHERE TABLE_SCHEMA = DATABASE() 
AND TABLE_NAME = 'teams' 
AND COLUMN_NAME = 'category_id'
AND CONSTRAINT_NAME != 'PRIMARY';

-- Show sample team categories
SELECT 
    'Sample Team Categories' as info,
    id,
    name,
    color,
    is_active
FROM team_categories 
ORDER BY `order`;

-- Check backup tables exist
SELECT 
    'Backup Tables' as check_name,
    CASE 
        WHEN COUNT(*) = 3 THEN 'SUCCESS - All backup tables created'
        ELSE 'WARNING - Some backup tables missing'
    END as status,
    COUNT(*) as backup_count
FROM INFORMATION_SCHEMA.TABLES 
WHERE TABLE_SCHEMA = DATABASE() 
AND TABLE_NAME IN ('teams_backup', 'fixtures_backup', 'settings_backup');

-- Final status
SELECT 
    'OVERALL STATUS' as summary,
    CASE 
        WHEN (SELECT COUNT(*) FROM team_categories) > 0 
        AND (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'teams' AND COLUMN_NAME = 'category_id') > 0
        AND (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'fixtures' AND COLUMN_NAME = 'home_team_logo') > 0
        THEN '✅ DATABASE UPDATE SUCCESSFUL!'
        ELSE '❌ DATABASE UPDATE FAILED - Check individual results above'
    END as final_status;

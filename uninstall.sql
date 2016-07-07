SET @configuration_group_id=0;
SELECT @configuration_group_id:=configuration_group_id
FROM configuration_group
WHERE configuration_group_title= 'YOUR MODULE NAME'
LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @configuration_group_id;
DELETE FROM configuration_group WHERE configuration_group_id = @configuration_group_id;

DELETE FROM admin_pages WHERE page_key = 'configYOUR_MODULE_NAME' LIMIT 1;
DELETE FROM admin_pages WHERE page_key = 'toolsYOUR_MODULE_NAME' LIMIT 1;
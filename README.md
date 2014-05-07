# Plugin Settings Mapping

A Wordpress plugin to allow plugin settings mapping. This will enable the ability to map a network activated plugin settings and control their values.

This can be used for plugins like 'Advanced Site Creation Plugin' to randomize the plugin settings.

Plugin settings mapping can be saved using a JSON file with filename as format as ``[plugin-slug].json`` under ``/data`` directory.

Plugin will fetch JSON values from ``/data/`` directory and use the configuration mapping setup in the file. 

Currently works only on Wordpress Multisite.

## Usage
1. Copy the plugin directory into your `wp-content/plugins` directory
2. Create JSON files per plugin you want settings to be mapped. 
Example Format ``virtual-pages-with-templates.json``:
```
{
	"name" : "Virtual Pages with Templates",
	"path" : "virtual-pages-with-templates/virtualpages-with-templates.php",
	"options" : [
		{
			"name" : "vpt_options",
			"settings" : [
				{
					"id" : "use_custom_permalink_structure",
					"values" : [0, 1]
				},
				{
					"id" : "page_template",
					"values" : [1]
				},
				{
					"id": "affect_search",
					"values" : [0, 1]
				},
				{
					"id" : "hide_post_id",
					"values" : [0, 1]
				}
			]

		}
	]
}
```
3. Activate this plugin
4. To use in any plugin (get the plugin mapping array), simply create a new mapping object e.g. ``$plugin_mapping = new L7_Plugin_Settings``.
``plugin_json_files`` property contains the json paths of plugin data stored in ``/data`` folder.
To fetch plugin info by slug, use ``get_plugin_info(plugin_slug)`` e.g. ``get_plugin_info('virtual-pages-with-templates')``. Json file name must be the same value as the plugin slug.

## TODO
Add the ability to manipulate JSON config via Wordpress Dashboard.

##Contributors
[@ramalveyra](https://github.com/ramalveyra)
This module integrates the CKEditor templates plugin.

It provides a dialog to offer predefined content templates - with page layout, 
text formatting and styles. Thus, end users can easily insert pre-defined 
snippets of html in CKEditor fields.

AUDIENCE
---------
This module is intended for themers who can manage custom ckeditor templates 
from their theme. As is, it doesn't provide any fonctionnality.

DEPENDENCIES
-------------
This module requires to install the CKEditor "Templates" plugin.
HOW TO INSTALL :
- Download the plugin on the project page : http://ckeditor.com/addon/templates
- Create a libraries folder in your drupal root if it doesn't exist
- Extract the plugin archive in the librairies folder

HOW TO USE
-----------
- First, you need to add the plugin button in your editor toolbar. 
Go to the format and editor config page and click configure on the format your 
want to edit : 
http://drupalvm.dev/admin/config/content/formats
- Add the templates button to the toolbar
- copy the file ckeditor_templates.js.example to your theme template folder, 
rename it without .example and customize it :
    x edit the image_path variable to link to you thumbnail folder
    x change the templates to you will be editing the templates array

That's it.

If you want to place your template file in a different folder, you can set the 
path on the Editor config page.

WARNING
--------
Depending on the configuration of your formats, CKEditor can be restrictive 
about authorized HTML tags. Make sure to use compatible HTML tags in your 
templates.

ROAD MAP
---------
Two features could be added :
- Allowing to add multiple template files so that you don't have to write all
your templates in one big file
- Allow to restrict for one editor the template displayed. Thus you could have 
10 templates in a file and display only 3 of them on a specific format. 

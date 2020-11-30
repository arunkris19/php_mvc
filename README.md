# php_mvc

This is a lightweight MVC framework created in PHP 7.2.
This package includes a script "mvc" in the root folder that can be used to generate controllers, views, or both together as a component.

### Usage:
Create a component by running the following command from the root directory.
By a component what I mean here is a **Controller+View set**. For example you can create a home component using the following command, which will create a HomeController class + a default view set for this controllelr in a directory named home.

> php `mvc` -g component home

This will create a controller file **homecontroller.php** inside /application/controllers/ folder which will contain the controller class **HomeController**. It will check if the controller file already exists and if it exists, the component will not be created. 
It will also create a corresponding view with the same name, **home** here in this case, inside /application/views/ and will create three template files inside the newly created view directory.

- view.php
- header.php
- footer.php

Create a controller alone by running the following command from the root directory.

> php `mvc` -g controller store

This will create a controller file homecontroller.php which will contain the controller class **HomeController**.
It will check if the controller file already exists and if it exists, the controller will not be created.

Create a view alone by running the following command from the root directory

> php `mvc` -g view store/list

This will create a new view with the specified name, **store/list** here in this case, and if the view folder is already present, it will ask for a new name and you can specify the new name and it will create the view. The name of the view can be a deep directory path like **/store/max/jeans** and the script will automatically create those directories for you and will keep the view files inside the last directory.

Create a Widget by running the following command from the root directory. 

> php `mvc` -g widget login

Widgets are tiny HTML components that you can embed in the main view files. For example, you can create a login widget and embed the same widget anywhere you want it. You can add widgets as given below.

**In your controller class**
> // Add the *login* widget with reference name:*login_widget*

> `$this`->_view->addWidget('login_widget','login'); 

**In your view file**
> // render the widget using the reference name

> `$this`->renderWidget('login_widget');



### Disclaimer
This is an experimental project and these scripts does not come with any guarentee. So please use it carefully and responsibly.


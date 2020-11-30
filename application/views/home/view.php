<hr>
<h1>Welcome to php_mvc</h1>
<hr>
<p>This is a light weight MVC framework created in PHP 7.2. This packege includes a script "mvc" in the root folder that can be used to generate controllers, views, or both together as a component.</p>
<h3>Usage:</h3>
<p>Create a component by running the following command from the root directory. By a component what I mean here is a Controller+View set. For example you can create a home component using the following command, which will create a HomeController class + a default view set for this controllelr in a directory named home.</p>
<code>
php mvc -g component home
</code>

<p>This will create a controller file homecontroller.php inside <u>/application/controllers/</u> folder which will contain the controller class HomeController. It will check if the controller file already exists and if it exists, the component will not be created. It will also create a corresponding view with the same name, home here in this case, inside <u>/application/views/</u> and will create three template files inside the newly created view directory.</p>
<ul>
<li>view.php</li>
<li>header.php</li>
<li>footer.php</li>
</ul>
<p>Create a controller alone by running the following command from the root directory.</p>
<code>
php mvc -g controller store
</code>
<p>
This will create a controller file homecontroller.php which will contain the controller class HomeController. It will check if the controller file already exists and if it exists, the controller will not be created.
</p>
<p>Create a view alone by running the following command from the root directory</p>
<code>
php mvc -g view store/list
</code>
<p>This will create a new view with the specified name, store/list here in this case, and if the view folder is already present, it will ask for a new name and you can specify the new name and it will create the view. The name of the view can be a deep directory path like /store/max/jeans and the script will automatically create those directories for you and will keep the view files inside the last directory.</p>
<p>
Create a Widget by running the following command from the root directory.
</p>
<code>php mvc -g widget login</code>
<p>
Widgets are tiny HTML components that you can embed in the main view files. For example, you can create a login widget and embed the same widget anywhere you want it. You can add widgets as given below.
</p>
<p>In your controller class</p>

<code>// Add the login widget with reference name:login_widget</code>

<code>$this->_view->addWidget('login_widget','login');</code>

<p>In your view file</p>

<code>// render the widget using the reference name</code>

<code>$this->renderWidget('login_widget');</code>

<h3>Disclaimer</h3>
<p>This is an experimental project and these scripts does not come with any guarentee. So please use it carefully and responsibly.</p>
<hr>
More details: <a href="https://github.com/arunkris19/php_mvc">https://github.com/arunkris19/php_mvc</a>
<hr>
<style>
code{
    display:block;
    padding:10px;
    background-color:#f1f1f1;
    border-left:4px solid #99f;
}
body{
    max-width:800px;
    margin:auto;
}
h1,h2,h3{
    color:#046;
}
</style>
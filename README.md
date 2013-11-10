<<<<<<< HEAD
This project was written to get access to a inaccessible web system inside City University's internal dns.

The web address I'm interested in browsing is http://hospitality.city.ac.uk/ViewMenu.aspx which belongs to the Catering department and hosts the menu and prices. It is only visible through physically networked computers inside City University. It is inaccessible over wifi inside university.

I take advantage of the fact that scripts residing on the student.city.ac.uk domain can route to this internal system. Unfortunately the LAMP stack on student.city does not have cURL installed, so I'm limited to using file_get_contents().

Scripts and their functionality:
Index.php - Performs main connections, handles cookies, rebuilds $_POST and $_GET parameters to be passed on to server
ScriptResource.php - Gets necessary JS code from hospitality.city . Note this code is gzipped
WebResource.php - Gets more necessary JS code from hospitality.city. Not this code is not gzipped

Improvements to the script:
Take headers from hospitality.city and pass them back to client connecting "as is". This will allow merger of ScriptResource and WebResource Scripts, and removal of conditional block in file.php
Store Cookies on student.city in a text file, so browsers which refuse to/dont store cookies can also get access to the Menu.
Comment a bit more?
||||||| merged common ancestors
=======
City-Internal-Catering-Menu
===========================

A php script that fetches the catering menu from the internal City network, and delivers it to outsiders!
>>>>>>> remotes/github/master
